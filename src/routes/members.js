import express from 'express';
import mongoose from 'mongoose';
import User from '../models/User.js';

const router = express.Router();

// GET /api/members - All registered members
router.get('/', async (req, res) => {
  try {
    console.log('🟡 Fetching all members...');
    
    // Check if mongoose is connected
    if (mongoose.connection.readyState !== 1) {
      console.error('🔴 MongoDB not connected. ReadyState:', mongoose.connection.readyState);
      return res.status(500).json({ message: 'Database not connected' });
    }
    
    // Check if User model exists
    if (!User) {
      console.error('🔴 User model not found');
      return res.status(500).json({ message: 'User model not available' });
    }
    
    // Simplified role query - only search for 'member' role
    const members = await User.find({ 
      role: 'member'
    })
    .select('-password -__v')
    .sort({ createdAt: -1 })
    .lean();

    console.log(`✅ Found ${members.length} members`);
    
    // Format response for admin dashboard
    const formattedMembers = members.map(member => ({
      _id: member._id,
      name: member.name || `${member.firstName || ''} ${member.lastName || ''}`.trim() || 'Unknown',
      email: member.email || '',
      memberId: member.memberId || member.memberCode || 'N/A',
      state: member.state || '',
      lga: member.lga || '',
      phone: member.phone || '',
      createdAt: member.createdAt,
      // Payment status
      membershipPaid: member.membershipActive || member.hasPaidMembership || false,
      certificatePaid: member.certificatePaid || member.hasPaidCertificate || false,
      idCardPaid: member.idCardPaid || member.hasPaidIdCard || false
    }));

    res.json(formattedMembers);

  } catch (e) {
    console.error('🔴 Error fetching members:', e);
    res.status(500).json({ message: 'Failed to load members: ' + e.message });
  }
});

// GET /api/members/paid - Paid members
router.get('/paid', async (req, res) => {
  try {
    const paidMembers = await User.find({
      role: 'member',
      $or: [
        { membershipActive: true },
        { hasPaidMembership: true },
        { certificatePaid: true },
        { hasPaidCertificate: true },
        { idCardPaid: true },
        { hasPaidIdCard: true }
      ]
    })
    .select('-password -__v')
    .sort({ createdAt: -1 })
    .lean();

    res.json(paidMembers);

  } catch (e) {
    res.status(500).json({ message: 'Failed to load paid members: ' + e.message });
  }
});

// GET /api/members/unpaid - Unpaid members
router.get('/unpaid', async (req, res) => {
  try {
    const unpaidMembers = await User.find({
      role: 'member',
      $and: [
        { membershipActive: { $ne: true } },
        { hasPaidMembership: { $ne: true } },
        { certificatePaid: { $ne: true } },
        { hasPaidCertificate: { $ne: true } },
        { idCardPaid: { $ne: true } },
        { hasPaidIdCard: { $ne: true } }
      ]
    })
    .select('-password -__v')
    .sort({ createdAt: -1 })
    .lean();

    res.json(unpaidMembers);

  } catch (e) {
    res.status(500).json({ message: 'Failed to load unpaid members: ' + e.message });
  }
});

export default router;