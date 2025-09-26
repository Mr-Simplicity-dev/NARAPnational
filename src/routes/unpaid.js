import express from 'express';
import mongoose from 'mongoose';

const router = express.Router();

/**
 * Returns members who have NOT paid membership.
 * membershipActive !== true and hasPaidMembership !== true, role in ['member','user','registrant']
 */
router.get('/', async (_req, res) => {
  try {
    const db = mongoose.connection;
    const usersCol = db.collection('users');
    const list = await usersCol.find({
      role: { $in: ['member', 'user', 'registrant'] },
      $and: [
        { $or: [ { membershipActive: { $ne: true } }, { membershipActive: { $exists: false } } ] },
        { $or: [ { hasPaidMembership: { $ne: true } }, { hasPaidMembership: { $exists: false } } ] }
      ]
    }).project({ password: 0 }).sort({ createdAt: -1 }).toArray();
    res.json(list);
  } catch (e) {
    res.status(500).json({ message: e.message || 'Failed to load unpaid members' });
  }
});

export default router;
