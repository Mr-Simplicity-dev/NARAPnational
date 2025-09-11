import express from 'express';
import multer from 'multer';
import path from 'path';
import fs from 'fs';
import jwt from 'jsonwebtoken';
import User from '../models/User.js';

const router = express.Router();

const requireAuth = (req, res, next) => {
  try {
    const auth = req.headers.authorization || '';
    const token = auth.startsWith('Bearer ') ? auth.slice(7) : null;
    if (!token) return res.status(401).json({ message: 'Unauthorized' });
    const payload = jwt.verify(token, process.env.JWT_SECRET || 'secret');
    req.user = { id: payload.id };
    next();
  } catch (e) {
    return res.status(401).json({ message: 'Unauthorized' });
  }
};

const memberPassportDir = path.join(process.cwd(), 'public', 'admin', 'uploads', 'passports');
try { fs.mkdirSync(memberPassportDir, { recursive: true }); } catch(_){}
const uploadMember = multer({
  storage: multer.diskStorage({
    destination: (_req, _file, cb) => cb(null, memberPassportDir),
    filename: (_req, file, cb) => {
      const ext = path.extname(file.originalname).toLowerCase();
      const name = 'passportPhoto-' + Date.now() + '-' + Math.round(Math.random()*1e9) + ext;
      cb(null, name);
    }
  }),
  fileFilter: (_req, file, cb) => {
    const ok = /^image\/(png|jpe?g|gif|webp|bmp|tiff?)$/i.test(file.mimetype);
    cb(ok ? null : new Error('Only image files are allowed'), ok);
  },
  limits: { fileSize: 5 * 1024 * 1024 }
});

router.post('/register-admin', async (req, res) => {
  try{
    const { name = '', email = '', password = '', inviteCode = '' } = req.body || {};
    if(!name || !email || !password || !inviteCode){
      return res.status(400).json({ message: 'Name, email, password and invite code are required' });
    }
    const expected = process.env.ADMIN_INVITE_CODE || 'NARAP-ADMIN';
    if(inviteCode !== expected){
      return res.status(403).json({ message: 'Invalid invite code' });
    }
    const exists = await User.findOne({ email });
    if (exists) return res.status(400).json({ message: 'Email already exists' });
    const user = await User.create({ name, email, password, role: 'admin' });
    return res.json({ id: user._id, email: user.email, role: user.role });
  }catch(e){
    return res.status(400).json({ message: e.message });
  }
});

router.post('/register-member', uploadMember.single('passport'), async (req, res) => {
  try{
    const { firstName = '', lastName = '', email = '', password = '' } = req.body || {};
    const name = (firstName + ' ' + lastName).trim() || req.body.name;
    if(!name || !email || !password){
      return res.status(400).json({ message: 'Name, email and password are required' });
    }
    const exists = await User.findOne({ email });
    if (exists) return res.status(400).json({ message: 'Email already exists' });
    const passportUrl = req.file ? ('/admin/uploads/passports/' + req.file.filename) : undefined;
    const user = await User.create({ name, email, password, role: 'member', passportUrl });
    return res.json({ id: user._id, email: user.email, role: user.role, passportUrl });
  }catch(e){
    return res.status(400).json({ message: e.message });
  }
});

router.post('/login', async (req, res) => {
  try{
    const { email, password } = req.body || {};
    const user = await User.findOne({ email }).select('+password');
    if (!user) return res.status(400).json({ message: 'Invalid credentials' });
    const ok = await user.comparePassword(password);
    if (!ok) return res.status(400).json({ message: 'Invalid credentials' });
    const token = jwt.sign({ id: user._id }, process.env.JWT_SECRET || 'secret', { expiresIn: '7d' });
    res.json({
      token,
      user: {
        id: user._id,
        name: user.name,
        email: user.email,
        role: user.role,
        passportUrl: user.passportUrl || null
      }
    });
  }catch(e){
    res.status(400).json({ message: e.message });
  }
});

router.get('/me', requireAuth, async (req, res) => {
  try{
    const user = await User.findById(req.user.id).select('-password');
    if(!user) return res.status(404).json({ message: 'User not found' });
    res.json(user);
  }catch(e){
    res.status(400).json({ message: e.message });
  }
});

export default router;
