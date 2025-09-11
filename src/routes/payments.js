import express from 'express';
const router = express.Router();

// Initialize payment (stub)
router.post('/init', (_req, res) => {
  res.status(501).json({ message: 'Payments not configured yet (stub).' });
});

// Verify payment (stub)
router.get('/verify', (_req, res) => {
  res.status(501).json({ message: 'Payments not configured yet (stub).' });
});

export default router;
