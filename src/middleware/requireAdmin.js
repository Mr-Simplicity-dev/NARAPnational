// Middleware to ensure the requester is an admin.
// Assumes `requireAuth` has already populated req.user (with an id) via JWT.
import User from '../models/User.js';

export default async function requireAdmin(req, res, next) {
  try {
    const userId = req.user?.id || req.user?._id;
    if (!userId) {
      return res.status(401).json({ message: 'Unauthorized' });
    }
    const me = await User.findById(userId).select('role').lean();
    if (!me || me.role !== 'admin') {
      return res.status(403).json({ message: 'Forbidden: admin only' });
    }
    return next();
  } catch (e) {
    return res.status(500).json({ message: e?.message || 'Authorization check failed' });
  }
}
