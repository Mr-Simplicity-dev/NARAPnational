import mongoose from 'mongoose';

const ProductSchema = new mongoose.Schema({
  title: { type: String, required: true },
  description: { type: String },
  price: { type: Number, default: 0 },
  imageUrl: { type: String }
}, { timestamps: true });

export default mongoose.model('Product', ProductSchema);
