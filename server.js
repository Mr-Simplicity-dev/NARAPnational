import 'dotenv/config';
console.log('JWT_SECRET:', process.env.JWT_SECRET ? 'Loaded' : 'Missing'); // Add this line
import express from 'express';
import path from 'path';
import { fileURLToPath } from 'url';
import mongoose from 'mongoose';
import cors from 'cors';
import helmet from 'helmet';
import morgan from 'morgan';
import fs from 'fs';

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
import uploadRoutes from './src/routes/upload.js';
import { requireAuth } from './src/middleware/auth.js';
import requireAdmin from './src/middleware/requireAdmin.js';
import eventRoutes from './src/routes/events.js';
import commentRoutes from './src/routes/comments.js';
import paymentRoutes from './src/routes/payments.js';
import memberRoutes from './src/routes/member.js';
import registrationsRoutes from './src/routes/registrations.js';
import paidMembersRoutes from './src/routes/paid.js';
import unpaidMembersRoutes from './src/routes/unpaid.js';

const app = express();
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// DB
const MONGO_URI = process.env.MONGO_URI || 'mongodb+srv://moshood2uall_db_user:MTOscBfON6XDKbGi@narapsite.dscc9gw.mongodb.net/?';
mongoose.connect(MONGO_URI).then(() => console.log('✅ Mongo connected')).catch(e => {
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
        "https://js.paystack.co"],
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
        "https://static.whatsapp.net",
        "https://www.facebook.com",
        "https://*.fbcdn.net",
        "https://cdn.tawk.to",
        "https://tawk.to",
        "https://*.tawk.to",
        "https://pagead2.googlesyndication.com"
      ],
      "font-src": [
        "'self'",
        "data:",
        "https://fonts.gstatic.com",
        "https://use.fontawesome.com",
        "https://cdn.jsdelivr.net",
        "https://cdn.tawk.to",
        "https://*.tawk.to"
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
        "https://api.paystack.co"]
    }
  }
}));
app.use(cors({ origin: process.env.CORS_ORIGIN?.split(',') || '*'}));
app.use(express.json({ limit: '2mb' }));
app.use(express.urlencoded({ extended: true }));
app.use(morgan('dev'));

// Serve real .php files as HTML (no PHP engine needed)
app.get(/\.php$/, (req, res, next) => {
  const filePath = path.join(__dirname, 'public', req.path);
  fs.access(filePath, fs.constants.F_OK, (err) => {
    if (err) return next();
    res.type('html'); // Content-Type: text/html
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


// APIs
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
app.use('/api/upload', requireAuth, uploadRoutes);
app.use('/api/events', eventRoutes);
app.use('/api/comments', commentRoutes);
app.use('/api/payments', paymentRoutes);
app.use('/api/member', requireAuth, memberRoutes);
app.use('/api/members', requireAuth, requireAdmin, registrationsRoutes);
app.use('/api/members/paid', requireAuth, requireAdmin, paidMembersRoutes);
app.use('/api/members/unpaid', requireAuth, requireAdmin, unpaidMembersRoutes);



// Health
app.get('/healthz', (_req,res)=>res.json({ ok:true }));

const PORT = process.env.PORT || 5000;
app.listen(PORT, () => console.log(`🚀 Server running on http://localhost:${PORT}`));