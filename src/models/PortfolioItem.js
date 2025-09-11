import mongoose from 'mongoose';

const PortfolioItemSchema = new mongoose.Schema({
  title: { type: String, required: true },
  category: { type: String, default: 'web' }, // agriculture, construction, ict, mining, web
  description: { type: String },
  imageUrl: { type: String }
}, { timestamps: true });

export default mongoose.model('PortfolioItem', PortfolioItemSchema);
