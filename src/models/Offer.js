import mongoose from 'mongoose';

const OfferSchema = new mongoose.Schema({
  title: { type: String, required: true },
  description: { type: String },
  imageUrl: { type: String },
  order: { type: Number, default: 0 }
}, { timestamps: true });

export default mongoose.model('Offer', OfferSchema);
