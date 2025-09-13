import express from 'express';
import multer from 'multer';
import path from 'path';
import fs from 'fs';
import jwt from 'jsonwebtoken';
import User from '../models/User.js';

const router = express.Router();

/* ----------------------------- auth middleware ---------------------------- */
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

    return res.status(201).json({
      id: user._id,
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
      passportUrl: user.passportUrl || null
    });
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

export default router;
