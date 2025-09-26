import express from 'express';
import mongoose from 'mongoose';
import multer from 'multer';
import path from 'path';
import fs from 'fs';
import { requireAuth } from '../middleware/auth.js';
import User from '../models/User.js';

const router = express.Router();
const upload = multer({ storage: multer.memoryStorage(), limits: { fileSize: 5 * 1024 * 1024 } }); // 5MB

// Helper to persist a buffer to /public/uploads/profile/<uid>/<field>.<ext>
function saveBufferToUploads(uid, field, originalname, buffer){
  const ext = (originalname && originalname.split('.').pop() || 'bin').toLowerCase();
  const relDir = `/uploads/profile/${uid}`;
  const absDir = path.join(process.cwd(), 'public', relDir);
  if (!fs.existsSync(absDir)) fs.mkdirSync(absDir, { recursive: true });
  const filename = `${field}.${ext}`;
  const absPath = path.join(absDir, filename);
  fs.writeFileSync(absPath, buffer);
  return `${relDir}/${filename}`; // web path
}

// GET /api/member/profile -> return current user's profile (selected fields)
router.get('/profile', requireAuth, async (req, res) => {
  try{
    const uid = req.user && (req.user.id || req.user._id);
    if (!uid) return res.status(401).json({ message: 'Not authorized' });
    const user = await User.findById(uid).select('-password -__v');
    if (!user) return res.status(404).json({ message: 'User not found' });
    return res.json(user);
  }catch(e){ return res.status(500).json({ message: e.message || 'Failed to load profile' }); }
});

// PATCH /api/member/profile -> update fields and handle optional files
router.patch('/profile', requireAuth, upload.any(), async (req, res) => {
  try{
    const uid = req.user && (req.user.id || req.user._id);
    if (!uid) return res.status(401).json({ message: 'Not authorized' });

    const update = {};

    // Map allowed text fields from body
    const allowed = ['firstName','lastName','otherNames','dob','gender','phone','email','address','state',
                     'organization','position','yearsExperience','specialization','certifications','profileCompleted'];
    allowed.forEach(k=>{
      if (k in req.body && req.body[k] !== undefined && req.body[k] !== null && String(req.body[k]).length){
        // normalize booleans
        if (k==='profileCompleted'){
          const v = req.body[k];
          update[k] = (v===true || v==='true' || v==='1' || v===1);
        } else {
          update[k] = req.body[k];
        }
      }
    });

    // Handle file fields if present
    if (Array.isArray(req.files)){
      for (const f of req.files){
        if (f.fieldname === 'passport' && f.buffer){
          const webPath = saveBufferToUploads(uid, 'passport', f.originalname, f.buffer);
          update['passportUrl'] = webPath;
        }
        if (f.fieldname === 'signature' && f.buffer){
          const webPath = saveBufferToUploads(uid, 'signature', f.originalname, f.buffer);
          update['signatureUrl'] = webPath;
        }
      }
    }

    if (!Object.keys(update).length){
      return res.status(400).json({ message: 'No changes' });
    }

    const user = await User.findByIdAndUpdate(uid, { $set: update }, { new: true }).select('-password -__v');
    return res.json({ ok:true, user });
  }catch(e){
    return res.status(500).json({ message: e.message || 'Failed to update profile' });
  }
});

export default router;
