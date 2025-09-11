import express from 'express';
import multer from 'multer';
import path from 'path';
import fs from 'fs';

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

function folderSafe(name){ return String(name || 'file').replace(/[^a-z0-9_-]/gi, ''); }

const upload = multer({ storage });

router.post('/', upload.single('file'), (req, res) => {
  const folder = (req.query.folder || 'misc').replace(/[^a-z0-9_-]/gi, '');
  const filename = req.file.filename;
  const urlPath = `/admin/uploads/${folder}/${filename}`;
  res.json({ url: urlPath });
});

export default router;
