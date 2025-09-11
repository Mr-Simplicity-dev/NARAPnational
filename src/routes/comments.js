import express from 'express';
const router = express.Router();

// Public: fetch comments for a post (stubbed empty)
router.get('/', (req, res) => {
  // e.g. /api/comments?post=slug
  res.json([]);
});

// Public: submit a comment (stubbed accepted -> pending moderation)
router.post('/', (req, res) => {
  res.status(202).json({ message: 'Comment submitted (stub). Moderation pending.' });
});

// Admin moderation stubs
router.get('/admin', (_req, res) => res.json([]));
router.put('/:id/approve', (_req, res) => res.status(501).json({ message: 'Approve not implemented' }));
router.put('/:id/spam', (_req, res) => res.status(501).json({ message: 'Spam not implemented' }));
router.delete('/:id', (_req, res) => res.status(501).json({ message: 'Delete not implemented' }));

export default router;
