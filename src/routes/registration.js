// src/routes/registrations.js (Revised)
router.get('/', async (_req, res) => {
  try {
    const usersCol = mongoose.connection.collection('users');
    const regs = await usersCol.find({ role: 'member' })
                  .project({ password: 0 }) // exclude password and any sensitive fields
                  .sort({ createdAt: -1 })
                  .toArray();
    return res.json(regs);
  } catch (e) {
    return res.status(500).json({ message: e.message || 'Failed to load registrations' });
  }
});
