import express from 'express';
import Setting from '../models/Setting.js';
import { requireAuth } from '../middleware/auth.js';

const router = express.Router();

router.get('/home', async (req, res) => {
  try {
    const doc = await Setting.findOne({ key: 'home' }).lean();
    res.json(doc || {});
  } catch (e) {
    console.error('GET /settings/home failed:', e);
    res.status(500).json({ error: 'Failed to load settings' });
  }
});

router.put('/home', requireAuth, async (req, res) => {
  try {
    const payload = req.body || {};
    const allowed = ['about','services','projects','features','offer','blog','faqs','team'];
    const update = { key: 'home' };
    for (const k of allowed) if (payload[k] != null) update[k] = payload[k];

    const doc = await Setting.findOneAndUpdate(
      { key: 'home' },
      { $set: update },
      { new: true, upsert: true, setDefaultsOnInsert: true }
    ).lean();

    res.json(doc);
  } catch (e) {
    console.error('PUT /settings/home failed:', e);
    res.status(500).json({ error: 'Failed to save settings' });
  }
});

export default router;
