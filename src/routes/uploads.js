import express from 'express';
import multer from 'multer';
import path from 'path';
import fs from 'fs';
import { requireAuth } from '../middleware/auth.js';

const router = express.Router();

// Configure multer for member file uploads
const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    const folder = req.query.folder || 'uploads';
    const uploadPath = path.join(process.cwd(), 'public', 'uploads', folder);
    
    // Create directory if it doesn't exist
    if (!fs.existsSync(uploadPath)) {
      fs.mkdirSync(uploadPath, { recursive: true });
    }
    cb(null, uploadPath);
  },
  filename: (req, file, cb) => {
    // Generate unique filename
    const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1E9);
    const ext = path.extname(file.originalname);
    cb(null, file.fieldname + '-' + uniqueSuffix + ext);
  }
});

const upload = multer({ 
  storage: storage,
  limits: { fileSize: 5 * 1024 * 1024 }, // 5MB
  fileFilter: (req, file, cb) => {
    // Check file types
    const allowedTypes = /jpeg|jpg|png|gif|bmp|svg|webp/;
    const extname = allowedTypes.test(path.extname(file.originalname).toLowerCase());
    const mimetype = allowedTypes.test(file.mimetype);
    
    if (mimetype && extname) {
      return cb(null, true);
    } else {
      cb(new Error('Only image files are allowed'));
    }
  }
});

// POST /api/uploads - Handle member file uploads
router.post('/', requireAuth, upload.single('file'), async (req, res) => {
  try {
    console.log('Member upload request received:', {
      folder: req.query.folder,
      file: req.file ? req.file.originalname : 'no file',
      user: req.user.id
    });

    if (!req.file) {
      return res.status(400).json({ 
        ok: false,
        message: 'No file uploaded' 
      });
    }

    const fileUrl = `/uploads/${req.query.folder || 'general'}/${req.file.filename}`;
    
    console.log('Member file uploaded successfully:', fileUrl);
    
    res.json({
      ok: true,
      message: 'File uploaded successfully',
      fileUrl: fileUrl,
      filename: req.file.filename
    });
  } catch (error) {
    console.error('Member upload error:', error);
    res.status(500).json({ 
      ok: false,
      message: 'File upload failed',
      error: process.env.NODE_ENV === 'development' ? error.message : undefined
    });
  }
});

export default router;