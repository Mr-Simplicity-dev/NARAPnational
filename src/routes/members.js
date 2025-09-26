import express from 'express';
import mongoose from 'mongoose';

const router = express.Router();

router.get('/', async (req, res) => {
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
    res.status(500).json({ message: e.message || 'Failed to load members' });
  }
});

// Add paid/unpaid endpoints if needed by admin dashboard
router.get('/paid', async (req, res) => {
  try {
    const db = mongoose.connection;
    let paidMembers = [];
    
    // Your logic to find paid members
    // This depends on how you track payments
    try {
      paidMembers = await db.collection('users')
        .find({ 
          role: 'member',
          $or: [
            { hasPaidMembership: true },
            { hasPaidCertificate: true },
            { hasPaidIdCard: true }
          ]
        })
        .sort({ createdAt: -1 })
        .toArray();
    } catch { /* ignore */ }

    res.json(paidMembers);
  } catch (e) {
    res.status(500).json({ message: e.message || 'Failed to load paid members' });
  }
});

router.get('/unpaid', async (req, res) => {
  try {
    const db = mongoose.connection;
    let unpaidMembers = [];
    
    // Your logic to find unpaid members
    try {
      unpaidMembers = await db.collection('users')
        .find({ 
          role: 'member',
          $and: [
            { hasPaidMembership: { $ne: true } },
            { hasPaidCertificate: { $ne: true } },
            { hasPaidIdCard: { $ne: true } }
          ]
        })
        .sort({ createdAt: -1 })
        .toArray();
    } catch { /* ignore */ }

    res.json(unpaidMembers);
  } catch (e) {
    res.status(500).json({ message: e.message || 'Failed to load unpaid members' });
  }
});

export default router;