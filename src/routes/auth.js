import express from 'express';
import multer from 'multer';
import path from 'path';
import fs from 'fs';
import jwt from 'jsonwebtoken';
import User from '../models/User.js';
import { requireAuth } from '../middleware/auth.js';

const router = express.Router();



/* --------------------------------- uploads -------------------------------- */
const memberPassportDir = path.join(process.cwd(), 'public', 'admin', 'uploads', 'passports');
try { fs.mkdirSync(memberPassportDir, { recursive: true }); } catch { /* noop */ }

const uploadMember = multer({
  storage: multer.diskStorage({
    destination: (_req, _file, cb) => cb(null, memberPassportDir),
    filename: (_req, file, cb) => {
      const ext = path.extname(file.originalname || '').toLowerCase();
      const name = 'passportPhoto-' + Date.now() + '-' + Math.round(Math.random() * 1e9) + ext;
      cb(null, name);
    }
  }),
  fileFilter: (_req, file, cb) => {
    const ok = /^image\/(png|jpe?g|gif|webp|bmp|tiff?)$/i.test(file.mimetype || '');
    cb(ok ? null : new Error('Only image files are allowed'), ok);
  },
  limits: { fileSize: 5 * 1024 * 1024 }
});

/* ------------------------------- utilities -------------------------------- */
const trimOr = (v, fallback = '') => (typeof v === 'string' ? v.trim() : (v ?? fallback));
const asBool = (v) => {
  if (typeof v === 'boolean') return v;
  if (typeof v === 'string') return ['1','true','on','yes','y'].includes(v.toLowerCase());
  return !!v;
};
const buildDob = (b) => {
  const dd = trimOr(b.dob_day), mm = trimOr(b.dob_month), yy = trimOr(b.dob_year);
  if (yy && mm && dd) {
    const m = String(mm).padStart(2, '0');
    const d = String(dd).padStart(2, '0');
    const iso = `${yy}-${m}-${d}T00:00:00Z`;
    const dt = new Date(iso);
    return isNaN(dt.getTime()) ? undefined : dt;
  }
  if (b.dob) {
    const dt = new Date(b.dob);
    return isNaN(dt.getTime()) ? undefined : dt;
  }
  return undefined;
};

/* --------------------------------- routes --------------------------------- */

// Admin registration (invite code protected)
router.post('/register-admin', async (req, res) => {
  try {
    const { name = '', email = '', password = '', inviteCode = '' } = req.body || {};
    if (!name || !email || !password || !inviteCode) {
      return res.status(400).json({ message: 'Name, email, password and invite code are required' });
    }
    const expected = process.env.ADMIN_INVITE_CODE || 'NARAP-ADMIN';
    if (inviteCode !== expected) {
      return res.status(403).json({ message: 'Invalid invite code' });
    }
    const exists = await User.findOne({ email: email.toLowerCase().trim() });
    if (exists) return res.status(400).json({ message: 'Email already exists' });

    const user = await User.create({
      name: trimOr(name),
      email: email.toLowerCase().trim(),
      password: trimOr(password),
      role: 'admin'
    });

    return res.json({ id: user._id, email: user.email, role: user.role });
  } catch (e) {
    return res.status(400).json({ message: e.message || 'Registration failed' });
  }
});

// Member registration (accepts full form fields + optional passport file)
router.post('/register-member', uploadMember.single('passport'), async (req, res) => {
  try {
    const b = req.body || {};

    // Accept either firstName/lastName OR surname/otherNames OR a single name
    const surname     = trimOr(b.surname || b.Surname);
    const otherNames  = trimOr(b.otherNames || b['other_names'] || b.firstname || b.firstName);
    const nameDirect  = trimOr(b.name);
    const nameCombo   = `${surname} ${otherNames}`.trim();
    const name        = nameDirect || nameCombo || `${trimOr(b.firstName)} ${trimOr(b.lastName)}`.trim();

    const email       = trimOr((b.email || '').toLowerCase());
    const password    = trimOr(b.password);
    const confirm     = trimOr(b.confirm_password || b.confirmPassword);
    if (confirm && password !== confirm) {
      return res.status(400).json({ message: 'Passwords do not match' });
    }
    if (!name || !email || !password) {
      return res.status(400).json({ message: 'Name, email and password are required' });
    }

    const exists = await User.findOne({ email });
    if (exists) return res.status(400).json({ message: 'Email already exists' });

    // Optional additional fields from the form
    const phone       = trimOr(b.phone);
    const state       = trimOr(b.state);
    const zone        = trimOr(b.zone);
    const guarantor   = trimOr(b.guarantor || b.Guarantor);
    const declare     = asBool(b.declare_agree || b.declaration || b.declareAgree);
    const dob         = buildDob(b);

    // Passport file
    const passportUrl = req.file ? ('/admin/uploads/passports/' + req.file.filename) : undefined;

    const user = await User.create({
      name,
      surname: surname || undefined,
      otherNames: otherNames || undefined,
      email,
      phone: phone || undefined,
      password,
      role: 'member',
      passportUrl,
      state: state || undefined,
      zone: zone || undefined,
      guarantor: guarantor || undefined,
      dob,
      declare_agree: declare
    });

    const token = jwt.sign({ id: user._id }, process.env.JWT_SECRET || 'secret', { expiresIn: '7d' });
    return res.status(201).json({ token, user: { id: user._id,
      email: user.email,
      role: user.role,
      name: user.name,
      surname: user.surname || null,
      otherNames: user.otherNames || null,
      phone: user.phone || null,
      state: user.state || null,
      zone: user.zone || null,
      guarantor: user.guarantor || null,
      dob: user.dob || null,
      declare_agree: !!user.declare_agree,
      passportUrl: user.passportUrl || null } });
} catch (e) {
    // Duplicate email friendly message
    if (e && e.code === 11000) {
      return res.status(400).json({ message: 'Email already exists' });
    }
    return res.status(400).json({ message: e.message || 'Registration failed' });
  }
});

router.post('/login', async (req, res) => {
  try {
    const { email = '', password = '' } = req.body || {};
    const user = await User.findOne({ email: email.toLowerCase().trim() }).select('+password');
    if (!user) return res.status(400).json({ message: 'Invalid credentials' });
    const ok = await user.comparePassword(password);
    if (!ok) return res.status(400).json({ message: 'Invalid credentials' });

    const token = jwt.sign({ id: user._id }, process.env.JWT_SECRET || 'secret', { expiresIn: '7d' });
    res.json({
      token,
      user: {
        id: user._id,
        name: user.name,
        surname: user.surname || null,
        otherNames: user.otherNames || null,
        email: user.email,
        phone: user.phone || null,
        role: user.role,
        state: user.state || null,
        zone: user.zone || null,
        guarantor: user.guarantor || null,
        dob: user.dob || null,
        declare_agree: !!user.declare_agree,
        passportUrl: user.passportUrl || null
      }
    });
  } catch (e) {
    res.status(400).json({ message: e.message || 'Login failed' });
  }
});

router.get('/me', requireAuth, async (req, res) => {
  try {
    const user = await User.findById(req.user.id).select('-password -__v');
    if (!user) return res.status(404).json({ message: 'User not found' });
    res.json(user);
  } catch (e) {
    res.status(400).json({ message: e.message || 'Failed to load user' });
  }
});

// Update my profile (fields + optional new passport photo)
router.patch('/me', requireAuth, uploadMember.single('passport'), async (req, res) => {
  try {
    const user = await User.findById(req.user.id).select('-__v');
    if (!user) return res.status(404).json({ message: 'User not found' });

    const b = req.body || {};

    // Allow-list of fields the member may edit
    const allowed = [
      'surname','otherNames','name','phone','state','zone','guarantor','declare_agree'
    ];

    // Email change (optional, keep or remove this block)
    if (typeof b.email === 'string' && b.email.trim()) {
      const newEmail = b.email.trim().toLowerCase();
      if (newEmail !== user.email) {
        const clash = await User.exists({ _id: { $ne: user._id }, email: newEmail });
        if (clash) return res.status(400).json({ message: 'Email already in use' });
        user.email = newEmail;
      }
    }

    // Simple fields
    for (const key of allowed) {
      if (b[key] !== undefined) {
        // normalize boolean for declare_agree
        if (key === 'declare_agree') {
          const v = String(b[key]).toLowerCase();
          user.declare_agree = ['1','true','on','yes','y'].includes(v);
        } else {
          user[key] = typeof b[key] === 'string' ? b[key].trim() : b[key];
        }
      }
    }

    // DOB support: either dob (ISO) OR split day/month/year
    if (b.dob || (b.dob_year && b.dob_month && b.dob_day)) {
      let dt;
      if (b.dob) dt = new Date(b.dob);
      else {
        const y = String(b.dob_year);
        const m = String(b.dob_month).padStart(2,'0');
        const d = String(b.dob_day).padStart(2,'0');
        dt = new Date(`${y}-${m}-${d}T00:00:00Z`);
      }
      if (!isNaN(dt.getTime())) user.dob = dt;
    }

    // New passport photo (multipart/form-data with field name "passport")
    if (req.file) {
      user.passportUrl = '/admin/uploads/passports/' + req.file.filename;
    }

    // If name not explicitly set, rebuild it from surname + otherNames
    if (!b.name && (b.surname || b.otherNames)) {
      const s = (user.surname || '').trim();
      const o = (user.otherNames || '').trim();
      const combined = `${s} ${o}`.trim();
      if (combined) user.name = combined;
    } else if (b.name) {
      user.name = String(b.name).trim();
    }

    await user.save();
    res.json(user.toJSON());
  } catch (e) {
    res.status(400).json({ message: e.message || 'Update failed' });
  }
});

// Change my password (requires current password)
router.patch('/me/password', requireAuth, async (req, res) => {
  try {
    const { currentPassword = '', newPassword = '', confirmPassword = '' } = req.body || {};
    if (!currentPassword || !newPassword || newPassword !== confirmPassword) {
      return res.status(400).json({ message: 'Provide currentPassword, newPassword and matching confirmPassword' });
    }

    const user = await User.findById(req.user.id).select('+password');
    if (!user) return res.status(404).json({ message: 'User not found' });

    const ok = await user.comparePassword(currentPassword);
    if (!ok) return res.status(400).json({ message: 'Current password is incorrect' });

    user.password = newPassword; // will be hashed by the pre-save hook
    await user.save();
    res.json({ message: 'Password updated' });
  } catch (e) {
    res.status(400).json({ message: e.message || 'Password change failed' });
  }
});


// Logout route
router.post('/logout', async (req, res) => {
  try {
    // You might want to blacklist the token or clear session data
    res.json({ message: 'Logged out successfully' });
  } catch (error) {
    res.status(500).json({ message: 'Logout failed' });
  }
});

export default router;
