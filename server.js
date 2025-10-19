import 'dotenv/config';
import express from 'express';
import path from 'path';
import { fileURLToPath } from 'url';
import mongoose from 'mongoose';
import cors from 'cors';
import helmet from 'helmet';
import morgan from 'morgan';
import fs from 'fs';
import session from 'express-session';
import passport from 'passport';


import authRoutes from './src/routes/auth.js';
import blogRoutes from './src/routes/blogs.js';
import serviceRoutes from './src/routes/services.js';
import portfolioRoutes from './src/routes/portfolio.js';
import sliderRoutes from './src/routes/sliders.js';
import teamRoutes from './src/routes/team.js';
import faqRoutes from './src/routes/faqs.js';
import offerRoutes from './src/routes/offers.js';
import productRoutes from './src/routes/products.js';
import featureRoutes from './src/routes/features.js';
import settingsRoutes from './src/routes/settings.js';
import uploadRoutes from './src/routes/upload.js'; // Admin uploads
import uploadsRoutes from './src/routes/uploads.js'; // Member uploads 
import { requireAuth } from './src/middleware/auth.js';
import requireAdmin from './src/middleware/requireAdmin.js';
import eventRoutes from './src/routes/events.js';
import commentRoutes from './src/routes/comments.js';
import paymentRoutes from './src/routes/payments.js';
import memberRoutes from './src/routes/member.js'; // singular - individual member operations
import membersRoutes from './src/routes/members.js'; // plural - admin member management
import paidRoutes from './src/routes/paid.js';
import unpaidRoutes from './src/routes/unpaid.js';
import donationsRoutes from './src/routes/donations.js';
import testimonialRoutes from './src/routes/testimonials.js';


const uploadDirs = [
  'public/admin/uploads/services',
  'public/admin/uploads/portfolio', 
  'public/admin/uploads/blogs',
  'public/admin/uploads/sections',
  'public/admin/uploads/team',
  'public/admin/uploads/partners',
  'public/admin/uploads/passports'
];

uploadDirs.forEach(dir => {
  try {
    fs.mkdirSync(dir, { recursive: true });
  } catch (e) {
    console.log(`Directory ${dir} already exists or couldn't be created`);
  }
});
const app = express();
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// DB
const MONGO_URI = process.env.MONGO_URI;
if (!MONGO_URI) {
  console.error('MONGO_URI environment variable is required');
  process.exit(1);
}


mongoose.connect(MONGO_URI).then(() => {
  console.log('✅ Mongo connected');
}).catch(e => {
  console.error('Mongo error', e);
  process.exit(1);
});

// Middlewares
app.use(helmet({
  crossOriginEmbedderPolicy: false,
  contentSecurityPolicy: {
    useDefaults: true,
    directives: {
      "default-src": ["'self'"],
      "script-src": [
  "'self'",
  "'unsafe-inline'",
  "https://code.jquery.com",
  "https://ajax.googleapis.com",
  "https://accounts.google.com",
  "https://apis.google.com",
  "https://www.gstatic.com",           // ⚠️ ADD THIS
  "https://ssl.gstatic.com",           // ⚠️ ADD THIS
  "https://cdnjs.cloudflare.com",
  "https://cdn.jsdelivr.net",
  "https://static.whatsapp.net",
  "https://wa.me",
  "https://api.whatsapp.com",
  "https://connect.facebook.net",
  "https://www.facebook.com",
  "https://embed.tawk.to",
  "https://cdn.tawk.to",
  "https://tawk.to",
  "https://*.tawk.to",
  "https://fonts.googleapis.com",
  "https://pagead2.googlesyndication.com",
  "https://googleads.g.doubleclick.net",
  "https://d2mpatx37cqexb.cloudfront.net",
  "https://use.fontawesome.com",
  "https://js.paystack.co"
],
      "style-src": [
        "'self'",
        "'unsafe-inline'",
        "https://fonts.googleapis.com",
        "https://cdnjs.cloudflare.com",
        "https://cdn.jsdelivr.net",
        "https://d2mpatx37cqexb.cloudfront.net",
        "https://use.fontawesome.com",
        "https://embed.tawk.to",
        "https://cdn.tawk.to",
        "https://*.tawk.to"
        
      ],
      "img-src": [
        "'self'",
        "data:",
        "blob:",
        "https://static.whatsapp.net",
        "https://www.facebook.com",
        "https://*.fbcdn.net",
        "https://cdn.tawk.to",
        "https://tawk.to",
        "https://*.tawk.to",
        "https://pagead2.googlesyndication.com"
      ],
      // ADD THIS NEW SECTION FOR VIDEO CONTENT
      "media-src": [
        "'self'",
        "data:",
        "blob:"
      ],
      "font-src": [
  "'self'",
  "data:",
  "https://fonts.gstatic.com",
  "https://use.fontawesome.com",
  "https://cdn.jsdelivr.net",
  "https://cdn.tawk.to",
  "https://*.tawk.to",
  "https://cdnjs.cloudflare.com"  // Add this line for FontAwesome
],
      "frame-src": [
        "'self'",
        "https://www.facebook.com",
        "https://wa.me",
        "https://tawk.to",
        "https://embed.tawk.to",
        "https://*.tawk.to",
        "https://pagead2.googlesyndication.com",
        "https://googleads.g.doubleclick.net",
        "https://js.paystack.co"],
      "connect-src": [
  "'self'",
  "https://tawk.to",
  "https://embed.tawk.to",
  "https://cdn.tawk.to",
  "https://va.tawk.to",
  "https://*.tawk.to",
  "wss://*.tawk.to",
  "https://ep1.adtrafficquality.google",
  "https://accounts.google.com",
  "https://apis.google.com",
  "https://www.googleapis.com",
  "https://api.paystack.co",
  "https://cdn.jsdelivr.net"
]
    }
  }
}));
// Add after other middleware (around line 145)
// Session configuration for Passport
app.use(session({
  secret: process.env.SESSION_SECRET || '507d337f93fe5e3663bcf9917a2355e4a66bc71a55430c6ae1822ccb35fa607761f99af13ce5f990c67481bb8735381e61a9a00aefd570942c3add407f0fa928',
  resave: false,
  saveUninitialized: false,
  cookie: { secure: false } // Set to true in production with HTTPS
}));

// Initialize Passport
app.use(passport.initialize());
app.use(passport.session());

app.use(passport.initialize());
app.use(passport.session());
app.use(cors({ origin: process.env.CORS_ORIGIN?.split(',') || '*'}));
app.use(express.json({ limit: '1gb' }));
app.use(express.urlencoded({ extended: true }));
app.use(morgan('dev'));

// Serve real .php files as HTML (no PHP engine needed)
app.get(/\.php$/, (req, res, next) => {
  const filePath = path.join(__dirname, 'public', req.path);
  fs.access(filePath, fs.constants.F_OK, (err) => {
    if (err) return next();
    res.type('html');
    res.sendFile(filePath, (e) => (e ? next(e) : null));
  });
});

// Aliases: route index.php-like URLs to index.html
app.get(['/index.php', '/home.php', '/default.php'], (_req, res) => {
  res.type('html');
  res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

// Static (serve your HTML/CSS/JS exactly)
app.use(express.static(path.join(__dirname, 'public')));
// Make uploads accessible at the same paths the HTML expects:
app.use('/admin/uploads', express.static(path.join(__dirname, 'public/admin/uploads')));
app.use('/uploads', express.static(path.join(__dirname, 'public/uploads')));

// Map legacy PHP links to single-page anchors
app.get('/about.php', (req, res) => res.redirect('/#about'));

// APIs - Public routes (no authentication required)
app.use('/api/auth', authRoutes);
app.use('/api/blogs', blogRoutes);
app.use('/api/services', serviceRoutes);
app.use('/api/portfolio', portfolioRoutes);
app.use('/api/sliders', sliderRoutes);
app.use('/api/team', teamRoutes);
app.use('/api/faqs', faqRoutes);
app.use('/api/offers', offerRoutes);
app.use('/api/products', productRoutes);
app.use('/api/features', featureRoutes);
app.use('/api/settings', settingsRoutes);
app.use('/api/upload', uploadRoutes); // Admin uploads (dashboard)
app.use('/api/uploads', uploadsRoutes); // Member uploads
app.use('/api/events', eventRoutes);
app.use('/api/comments', commentRoutes);
app.use('/api/payments', paymentRoutes);
app.use('/api/testimonials', testimonialRoutes);

// Member routes - Individual member operations (authentication required but not admin)
app.use('/api/member', memberRoutes); // This handles /api/member/profile

// Admin routes - Require authentication and admin role
app.use('/api/members', requireAuth, requireAdmin, membersRoutes); // Admin member management
app.use('/api/members/paid', requireAuth, requireAdmin, paidRoutes);
app.use('/api/members/unpaid', requireAuth, requireAdmin, unpaidRoutes);
app.use('/api/donations', requireAuth, requireAdmin, donationsRoutes);

// Health check
app.get('/healthz', (_req, res) => res.json({ ok: true }));

// Global error handler
app.use((err, req, res, next) => {
  console.error('Error:', err);
  res.status(500).json({ error: 'Internal server error' });
});

// 404 handler
app.use((req, res) => {
  res.status(404).json({ error: 'Route not found' });
});

const PORT = process.env.PORT || 5000;
app.listen(PORT, () => console.log(`🚀 Server running on http://localhost:${PORT}`));
