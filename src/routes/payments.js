import express from 'express';
import axios from 'axios';
import Payment from '../models/payment.js';
import User from '../models/User.js';
import { requireAuth } from '../middleware/auth.js';

const router = express.Router();
const PAYSTACK_SECRET = process.env.PAYSTACK_SECRET;

// (Optional) health check
router.get('/health', (_req, res) => res.json({ ok: true }));

/**
 * POST /api/payments/init
 * Body: { amount: number (kobo), purpose?: 'membership'|'idcard'|'certificate'|'other' }
 * Requires: Authorization Bearer <JWT>
 * Returns: { reference, amount, currency, purpose }
 */
router.post('/init', requireAuth, async (req, res) => {
  try {
    // Strict, server-side validation for amount
    const amt = Math.round(Number(req.body?.amount));
    const purposeRaw = String(req.body?.purpose || 'membership').toLowerCase();
    const purpose = ['membership','idcard','certificate','other'].includes(purposeRaw)
      ? purposeRaw : 'other';

    if (!Number.isFinite(amt) || amt < 100) {
      return res.status(400).json({ message: 'amount (kobo) must be a positive integer >= 100' });
    }

    const uid   = (req.user && (req.user.id || req.user.uid || req.user._id)) || undefined;
    const email = (req.user && req.user.email) || req.body.email || undefined;

    // Generate unique reference with duplicate-key retry
    const MAX_ATTEMPTS = 5;
    let lastErr;

    for (let i = 0; i < MAX_ATTEMPTS; i++) {
      const reference = `NARAP-${Date.now()}-${Math.floor(Math.random() * 1e9)}`;

      try {
        await Payment.create({
          userId: uid,
          email,
          amount: amt,
          currency: 'NGN',
          reference,
          purpose,
          status: 'initialised',
        });

        return res.json({ reference, amount: amt, currency: 'NGN', purpose });
      } catch (e) {
        // Duplicate key on reference? try again with a new reference
        const isDup =
          (e?.code === 11000 && e?.keyPattern && e.keyPattern.reference) ||
          (typeof e?.message === 'string' && e.message.includes('E11000') && e.message.includes('reference'));

        if (isDup) {
          // brief jitter to avoid same-ms collisions
          await new Promise(r => setTimeout(r, 5));
          continue;
        }

        lastErr = e;
        break; // non-duplicate error -> stop retrying
      }
    }

    // If we’re here, retries exhausted OR non-duplicate error caught
    console.error('[payments/init] error:', { name: lastErr?.name, code: lastErr?.code, message: lastErr?.message });
    return res.status(500).json({
      message: lastErr?.message || 'init failed',
      code: lastErr?.code || 'INIT_ERROR'
    });
  } catch (e) {
    console.error('[payments/init] unexpected error:', e);
    return res.status(500).json({ message: e?.message || 'init failed' });
  }
});


/**
 * POST /api/payments/verify
 * Body: { reference: string }
 * Requires: Authorization Bearer <JWT>
 * Verifies with Paystack, updates Payment record, and (optionally) flags the user.
 */
router.post('/verify', requireAuth, async (req, res) => {
  try{
    const { reference } = req.body || {};
    if(!reference) return res.status(400).json({ message: 'reference required' });
    if(!PAYSTACK_SECRET) return res.status(500).json({ message: 'PAYSTACK_SECRET missing on server' });

    const { data } = await axios.get(`https://api.paystack.co/transaction/verify/${reference}`, {
      headers: { Authorization: `Bearer ${PAYSTACK_SECRET}` }
    });

    const vr = data && data.data;
    if(!vr) return res.status(400).json({ message: 'Invalid verification response' });

    const status = vr.status === 'success' ? 'success' : 'failed';
    const paidAt = vr.paid_at ? new Date(vr.paid_at) : undefined;
    const purposeFromMeta = (() => {
      const cf = (vr.metadata && (vr.metadata.custom_fields || vr.metadata.customFields)) || [];
      const match = cf.find(x => (x.display_name === 'Purpose' || x.variable_name === 'purpose'));
      return match ? String(match.value||'').toLowerCase() : undefined;
    })();

    // Update payment record
    const update = {
      status,
      amount: vr.amount,
      currency: vr.currency,
      channel: vr.channel,
      paidAt,
      raw: vr
    };
    if(purposeFromMeta) update.purpose = purposeFromMeta;
    await Payment.findOneAndUpdate({ reference }, update, { upsert: true });

    // Optionally flag the user account after successful payment
    try{
      const uid = (req.user && (req.user.id || req.user.uid || req.user._id)) || undefined;
      if(uid && status === 'success'){
        const set = {};
        const p = purposeFromMeta || 'membership';
        if (p === 'membership') { set['membershipActive'] = true; set['hasPaidMembership'] = true; }
        if (p === 'idcard')     { set['idCardPaid']       = true; set['hasPaidIdCard']     = true; }
        if (p === 'certificate'){ set['certificatePaid']  = true; set['hasPaidCertificate']= true; }
        if(Object.keys(set).length){
          await User.findByIdAndUpdate(uid, { $set: set });
        }
      }
    }catch(_e){ /* non-fatal */ }

    return res.json({ ok: (status==='success'), status, paidAt, amount: vr.amount, currency: vr.currency, purpose: purposeFromMeta });
  }catch(e){
    return res.status(400).json({ message: e.message || 'verify failed' });
  }
});

export default router;
