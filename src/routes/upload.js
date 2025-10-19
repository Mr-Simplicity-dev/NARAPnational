import express from 'express';
import multer from 'multer';
import path from 'path';
import fs from 'fs';
import { requireAuth } from '../middleware/auth.js';
import requireAdmin from '../middleware/requireAdmin.js';

const router = express.Router();

const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    const folder = (req.query.folder || 'misc').replace(/[^a-z0-9_-]/gi, '');
    const dest = path.join(process.cwd(), 'public', 'admin', 'uploads', folder);
    fs.mkdirSync(dest, { recursive: true });
    cb(null, dest);
  },
  filename: (req, file, cb) => {
    const ts = Date.now();
    const ext = path.extname(file.originalname);
    cb(null, `${folderSafe(file.fieldname)}-${ts}${ext}`);
  }
});

// Video-specific storage configuration
const videoStorage = multer.diskStorage({
  destination: (req, file, cb) => {
    const dest = path.join(process.cwd(), 'public', 'admin', 'uploads', 'videos');
    fs.mkdirSync(dest, { recursive: true });
    cb(null, dest);
  },
  filename: (req, file, cb) => {
    const ts = Date.now();
    const ext = path.extname(file.originalname);
    cb(null, `video-${ts}${ext}`);
  }
});

function folderSafe(name) { 
  return String(name || 'file').replace(/[^a-z0-9_-]/gi, ''); 
}

const upload = multer({ storage });
const videoUpload = multer({ storage: videoStorage });

// Existing general file upload endpoint
router.post('/', requireAuth, requireAdmin, upload.single('file'), (req, res) => {
  const folder = (req.query.folder || 'misc').replace(/[^a-z0-9_-]/gi, '');
  const filename = req.file.filename;
  const urlPath = `/admin/uploads/${folder}/${filename}`;
  res.json({ url: urlPath });
});

// New video upload endpoint
router.post('/video', requireAuth, requireAdmin, videoUpload.single('file'), async (req, res) => {
  try {
    if (!req.file) {
      return res.status(400).json({ error: 'No video file provided' });
    }

    // Validate video file
    const allowedTypes = ['video/mp4', 'video/webm', 'video/ogg', 'video/avi', 'video/mov', 'video/quicktime'];
    if (!allowedTypes.includes(req.file.mimetype)) {
      return res.status(400).json({ error: 'Invalid video format. Use MP4, WEBM, OGV, AVI, or MOV' });
    }

    // Check file size (1GB limit) - UPDATED FROM 50MB
const maxSize = 1024 * 1024 * 1024; // 1GB in bytes
if (req.file.size > maxSize) {
  return res.status(400).json({ error: 'Video file too large. Maximum 1GB allowed.' });
}

    const videoUrl = `/admin/uploads/videos/${req.file.filename}`;
    res.json({ 
      success: true, 
      url: videoUrl,
      filename: req.file.filename,
      size: req.file.size,
      type: req.file.mimetype
    });
  } catch (error) {
    console.error('Video upload error:', error);
    res.status(500).json({ error: 'Video upload failed' });
  }
});

export default router;