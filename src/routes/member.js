import express from 'express';
import mongoose from 'mongoose';
import { requireAuth } from '../middleware/auth.js';
import User from '../models/User.js';

const router = express.Router();

// GET /api/member/profile -> return current user's profile
router.get('/profile', requireAuth, async (req, res) => {
  try {
    console.log('GET /api/member/profile called');
    const uid = req.user && (req.user.id || req.user._id);
    if (!uid) {
      return res.status(401).json({ message: 'Not authorized' });
    }
    
    const user = await User.findById(uid).select('-password -__v');
    if (!user) {
      return res.status(404).json({ message: 'User not found' });
    }
    
    console.log('Profile retrieved successfully');
    return res.json(user);
  } catch (e) {
    console.error('Error in GET /api/member/profile:', e);
    return res.status(500).json({ 
      message: e.message || 'Failed to load profile'
    });
  }
});

// PATCH /api/member/profile -> update profile fields (without file handling)
router.patch('/profile', requireAuth, async (req, res) => {
  try {
    console.log('PATCH /api/member/profile called');
    const uid = req.user && (req.user.id || req.user._id);
    if (!uid) {
      return res.status(401).json({ message: 'Not authorized' });
    }

    const update = {};

    // Map allowed text fields from body
    const allowed = [
  'surname', 'firstName', 'lastName', 'otherNames', 'dob', 'gender', 'phone', 'email', 
  'address', 'state', 'organization', 'position', 'yearsExperience', 
  'specialization', 'certifications', 'profileCompleted', 'passportUrl', 'signatureUrl'
];
    
    allowed.forEach(k => {
      if (k in req.body && req.body[k] !== undefined && req.body[k] !== null && String(req.body[k]).length) {
        if (k === 'profileCompleted') {
          const v = req.body[k];
          update[k] = (v === true || v === 'true' || v === '1' || v === 1);
        } else {
          update[k] = req.body[k];
        }
      }
    });

    if (Object.keys(update).length === 0) {
      return res.status(400).json({ message: 'No changes provided' });
    }

    console.log('Updating user with:', update);
    const user = await User.findByIdAndUpdate(
      uid, 
      { $set: update }, 
      { new: true, runValidators: true }
    ).select('-password -__v');
    
    if (!user) {
      return res.status(404).json({ message: 'User not found' });
    }

    console.log('Profile updated successfully');
    return res.json({ 
      ok: true, 
      message: 'Profile updated successfully',
      user 
    });
  } catch (e) {
    console.error('Error in PATCH /api/member/profile:', e);
    return res.status(500).json({ 
      message: e.message || 'Failed to update profile'
    });
  }
});

export default router;