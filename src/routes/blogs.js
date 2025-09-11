import express from 'express';
import slugify from 'slugify';
import Blog from '../models/Blog.js';
import { buildCRUDRoutes } from './_util.js';

const router = express.Router();

// Public: list + by slug
router.get('/', async (req, res) => {
  try{
    const { page=1, limit=6 } = req.query;
    const docs = await Blog.find({}).sort('-publishedAt').skip((page-1)*limit).limit(Number(limit));
    const count = await Blog.countDocuments({});
    res.json({ data: docs, count });
  }catch(e){ res.status(400).json({ message: e.message }); }
});

router.get('/slug/:slug', async (req, res) => {
  try{
    const doc = await Blog.findOne({ slug: req.params.slug });
    if (!doc) return res.status(404).json({ message: 'Not found' });
    res.json(doc);
  }catch(e){ res.status(400).json({ message: e.message }); }
});

// Admin CRUD (id-based)
buildCRUDRoutes({ router, Model: Blog, resource: 'blogs' });

// Helper to generate slug on create/update
router.post('/', async (req, res, next) => next());
router.put('/:id', async (req, res, next) => next());

export default router;
