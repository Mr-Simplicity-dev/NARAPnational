import express from 'express';
import mongoose from 'mongoose';

const router = express.Router();

router.get('/', async (req, res) => {
  try {
    const { filter, search, page = 1, limit = 20, logic, fees } = req.query;
    const db = mongoose.connection;

    // Build base query - try registrations collection first
    let members = [];
    let collectionName = 'registrations';
    
    try {
      const collection = db.collection(collectionName);
      members = await collection.find({}).sort({ createdAt: -1 }).toArray();
    } catch {
      // Fall back to users collection
      collectionName = 'users';
      try {
        const collection = db.collection(collectionName);
        members = await collection.find({ 
          role: { $in: ['member', 'registrant', 'user'] } 
        }).sort({ createdAt: -1 }).toArray();
      } catch (err) {
        console.error('Failed to fetch from users collection:', err);
        members = [];
      }
    }

    // Apply search filter if provided
    if (search && search.trim()) {
      const searchTerm = search.trim().toLowerCase();
      members = members.filter(member => 
        (member.name && member.name.toLowerCase().includes(searchTerm)) ||
        (member.email && member.email.toLowerCase().includes(searchTerm)) ||
        (member.memberId && member.memberId.toLowerCase().includes(searchTerm)) ||
        (member.memberCode && member.memberCode.toLowerCase().includes(searchTerm)) ||
        (member.state && member.state.toLowerCase().includes(searchTerm)) ||
        (member.lga && member.lga.toLowerCase().includes(searchTerm))
      );
    }

    // Apply payment filters if specified
    if (filter === 'paid' || filter === 'unpaid') {
      const paidFees = Array.isArray(fees) ? fees : (fees ? fees.split(',') : ['membership', 'certificate', 'idcard']);
      const requireAll = logic === 'all';
      
      members = members.filter(member => {
        const paymentFlags = summarizePaidFlags(member);
        const paidCount = paidFees.filter(fee => paymentFlags[fee]).length;
        
        if (filter === 'paid') {
          return requireAll ? (paidCount === paidFees.length) : (paidCount >= 1);
        } else { // unpaid
          return paidCount === 0;
        }
      });
    }

    // Pagination
    const pageNum = parseInt(page);
    const limitNum = parseInt(limit);
    const startIndex = (pageNum - 1) * limitNum;
    const endIndex = startIndex + limitNum;
    const paginatedMembers = members.slice(startIndex, endIndex);

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

    // Return in the format the dashboard expects
    res.json({
      items: paginatedMembers.map(mask),
      total: members.length,
      page: pageNum,
      limit: limitNum
    });

  } catch (e) {
    console.error('Members API error:', e);
    res.status(500).json({ message: e.message || 'Failed to load members' });
  }
});

// Helper function to determine payment status
function summarizePaidFlags(member) {
  const paid = { membership: false, certificate: false, idcard: false };
  
  // Check payments array
  if (Array.isArray(member?.payments)) {
    for (const p of member.payments) {
      const type = (p?.type || '').toLowerCase();
      if (['membership','certificate','idcard'].includes(type) && 
          (p?.status === 'success' || p?.status === 'paid')) {
        paid[type] = true;
      }
    }
  }
  
  // Check direct flags
  if (member?.hasPaidMembership) paid.membership = true;
  if (member?.hasPaidCertificate) paid.certificate = true;
  if (member?.hasPaidIdCard || member?.hasPaidIdcard) paid.idcard = true;
  
  return paid;
}

// Keep your existing paid/unpaid routes for backward compatibility
router.get('/paid', async (req, res) => {
  try {
    const db = mongoose.connection;
    let paidMembers = [];
    
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