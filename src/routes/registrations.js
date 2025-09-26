import express from 'express';
import mongoose from 'mongoose';

const router = express.Router();

// GET /api/members - Main endpoint with filtering
router.get('/', async (req, res) => {
  try {
    const { filter = 'all', search = '', page = 1, limit = 20 } = req.query;
    
    const db = mongoose.connection;
    let query = { role: 'member' };

    // Search functionality
    if (search) {
      query.$or = [
        { name: { $regex: search, $options: 'i' } },
        { email: { $regex: search, $options: 'i' } },
        { memberId: { $regex: search, $options: 'i' } },
        { state: { $regex: search, $options: 'i' } }
      ];
    }

    const skip = (parseInt(page) - 1) * parseInt(limit);
    
    let members = [];
    let total = 0;

    // Try users collection first
    try {
      total = await db.collection('users').countDocuments(query);
      members = await db.collection('users')
        .find(query)
        .skip(skip)
        .limit(parseInt(limit))
        .sort({ createdAt: -1 })
        .toArray();
    } catch (error) {
      console.error('Error fetching from users:', error);
      // Fallback to registrations collection
      try {
        total = await db.collection('registrations').countDocuments(query);
        members = await db.collection('registrations')
          .find(query)
          .skip(skip)
          .limit(parseInt(limit))
          .sort({ createdAt: -1 })
          .toArray();
      } catch (fallbackError) {
        console.error('Error fetching from registrations:', fallbackError);
      }
    }

    // Mask password fields
    const maskPassword = (obj) => {
      const out = { ...obj };
      Object.keys(out).forEach(k => {
        if (k.toLowerCase().includes('password')) {
          out[k] = '[hidden]';
        }
      });
      return out;
    };

    members = members.map(maskPassword);

    res.json({
      items: members,
      total,
      page: parseInt(page),
      limit: parseInt(limit)
    });

  } catch (e) {
    console.error('Error in /api/members:', e);
    res.status(500).json({ message: e.message || 'Failed to load members' });
  }
});

// GET /api/members/paid - Paid members only
router.get('/paid', async (req, res) => {
  try {
    const db = mongoose.connection;
    let paidMembers = [];
    
    // Try users collection with payment filters
    try {
      paidMembers = await db.collection('users').find({
        role: 'member',
        $or: [
          { hasPaidMembership: true },
          { hasPaidCertificate: true },
          { hasPaidIdCard: true }
        ]
      }).sort({ createdAt: -1 }).toArray();
    } catch (error) {
      console.error('Error fetching paid members from users:', error);
      // Try registrations collection
      try {
        paidMembers = await db.collection('registrations').find({
          role: 'member',
          $or: [
            { hasPaidMembership: true },
            { hasPaidCertificate: true },
            { hasPaidIdCard: true }
          ]
        }).sort({ createdAt: -1 }).toArray();
      } catch (fallbackError) {
        console.error('Error fetching paid members from registrations:', fallbackError);
      }
    }

    // Mask passwords
    const maskPassword = (obj) => {
      const out = { ...obj };
      Object.keys(out).forEach(k => {
        if (k.toLowerCase().includes('password')) {
          out[k] = '[hidden]';
        }
      });
      return out;
    };

    res.json(paidMembers.map(maskPassword));
  } catch (e) {
    console.error('Error in /api/members/paid:', e);
    res.status(500).json({ message: e.message || 'Failed to load paid members' });
  }
});

// GET /api/members/unpaid - Unpaid members only
router.get('/unpaid', async (req, res) => {
  try {
    const db = mongoose.connection;
    let unpaidMembers = [];
    
    // Try users collection with unpaid filters
    try {
      unpaidMembers = await db.collection('users').find({
        role: 'member',
        $and: [
          { hasPaidMembership: { $ne: true } },
          { hasPaidCertificate: { $ne: true } },
          { hasPaidIdCard: { $ne: true } }
        ]
      }).sort({ createdAt: -1 }).toArray();
    } catch (error) {
      console.error('Error fetching unpaid members from users:', error);
      // Try registrations collection
      try {
        unpaidMembers = await db.collection('registrations').find({
          role: 'member',
          $and: [
            { hasPaidMembership: { $ne: true } },
            { hasPaidCertificate: { $ne: true } },
            { hasPaidIdCard: { $ne: true } }
          ]
        }).sort({ createdAt: -1 }).toArray();
      } catch (fallbackError) {
        console.error('Error fetching unpaid members from registrations:', fallbackError);
      }
    }

    // Mask passwords
    const maskPassword = (obj) => {
      const out = { ...obj };
      Object.keys(out).forEach(k => {
        if (k.toLowerCase().includes('password')) {
          out[k] = '[hidden]';
        }
      });
      return out;
    };

    res.json(unpaidMembers.map(maskPassword));
  } catch (e) {
    console.error('Error in /api/members/unpaid:', e);
    res.status(500).json({ message: e.message || 'Failed to load unpaid members' });
  }
});

export default router;