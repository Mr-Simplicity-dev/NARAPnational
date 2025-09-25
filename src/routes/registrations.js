import express from 'express';
import mongoose from 'mongoose';

const router = express.Router();

/**
 * Returns *all* submitted registrations exactly as stored.
 * Security: do NOT return raw passwords. Mask any password-like keys.
 */
router.get('/', async (_req, res) => {
  try {
    const db = mongoose.connection;

    // Try 'registrations' collection first
    let regs = [];
    try {
      regs = await db.collection('registrations')
        .find({})
        .sort({ createdAt: -1 })
        .toArray();
    } catch {
      regs = [];
    }

    // If not found/empty, fall back to 'users' where role=member
    if (!regs.length) {
      try {
        regs = await db.collection('users')
          .find({ role: { $in: ['member', 'registrant', 'user'] } })
          .sort({ createdAt: -1 })
          .toArray();
      } catch { /* ignore */ }
    }

    // Mask password-like fields
    const mask = (obj) => {
      const out = { ...obj };
      const keys = Object.keys(out);
      keys.forEach(k => {
        const lk = k.toLowerCase();
        if (lk.includes('password') || lk === 'pass' || lk === 'passwd') {
          out[k] = '[hidden]';
        }
      });
      return out;
    };

    res.json(regs.map(mask));
  } catch (e) {
    res.status(500).json({ message: e.message || 'Failed to load registrations' });
  }
});

export default router;
