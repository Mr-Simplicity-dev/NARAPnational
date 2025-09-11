import mongoose from 'mongoose';

const ServiceSchema = new mongoose.Schema({
  title: { type: String, required: true },
  description: { type: String },
  imageUrl: { type: String }
}, { timestamps: true });

export default mongoose.model('Service', ServiceSchema);
