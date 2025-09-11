import mongoose from 'mongoose';

const BlogSchema = new mongoose.Schema({
  title: { type: String, required: true },
  slug: { type: String, required: true, unique: true, index: true },
  excerpt: { type: String },
  content: { type: String }, // HTML
  imageUrl: { type: String },
  author: { type: String, default: 'Admin' },
  views: { type: Number, default: 0 },
  publishedAt: { type: Date, default: Date.now }
}, { timestamps: true });

export default mongoose.model('Blog', BlogSchema);
