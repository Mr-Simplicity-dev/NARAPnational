import express from 'express';
import mongoose from 'mongoose';

const router = express.Router();

/**
 * Returns members who have paid.
 * Strategy (broad, resilient):
 * 1) members collection with hasPaid true OR paymentStatus in ['paid','success']
 * 2) union with members referenced by a payments collection (status 'success')
 */
router.get('/', async (req, res) => {
  try {
    const db = mongoose.connection;
    const membersCol = db.collection('members');
    const paymentsCol = db.collection('payments');

    // Strategy 1: direct flags on members
    const directPaid = await membersCol.find({
      $or: [
        { hasPaid: true },
        { paymentStatus: { $in: ['paid', 'success'] } }
      ]
    }).project({ password: 0, passwordHash: 0 }).toArray();

    // Strategy 2: payments that succeeded -> map to member IDs
    let paymentMemberIds = [];
    try {
      const successPays = await paymentsCol.find({ status: { $in: ['success', 'paid'] } }).project({ memberId: 1 }).toArray();
      paymentMemberIds = successPays.map(p => p.memberId).filter(Boolean);
    } catch { /* payments collection may not exist */ }

    let fromPayments = [];
    if (paymentMemberIds.length) {
      fromPayments = await membersCol.find({
        $or: [
          { _id: { $in: paymentMemberIds.map(id => (typeof id === 'string' ? new mongoose.Types.ObjectId(id) : id)) } },
          { memberId: { $in: paymentMemberIds } }
        ]
      }).project({ password: 0, passwordHash: 0 }).toArray();
    }

    // Merge unique by _id or memberCode
    const key = (x) => String(x._id || x.memberId || x.memberCode || Math.random());
    const map = new Map();
    [...directPaid, ...fromPayments].forEach(x => map.set(key(x), x));
    const list = Array.from(map.values());

    res.json(list);
  } catch (e) {
    res.status(500).json({ message: e.message || 'Failed to load paid members' });
  }
});

export default router;
