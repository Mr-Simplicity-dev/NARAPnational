import express from 'express';
const router = express.Router();

// Public: list events (stubbed empty)
router.get('/', async (_req, res) => {
  res.json([]);
});

// Public: get single event by slug (stubbed 404)
router.get('/:slug', async (_req, res) => {
  res.status(404).json({ message: 'Event not found (stub)' });
});

// Admin stubs (not implemented yet)
router.post('/', (_req, res) => res.status(501).json({ message: 'Events create not implemented' }));
router.put('/:id', (_req, res) => res.status(501).json({ message: 'Events update not implemented' }));
router.delete('/:id', (_req, res) => res.status(501).json({ message: 'Events delete not implemented' }));

export default router;
