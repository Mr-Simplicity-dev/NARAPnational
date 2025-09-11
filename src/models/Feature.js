import mongoose from 'mongoose';

const FeatureSchema = new mongoose.Schema({
  title: { type: String, required: true },
  subtitle: { type: String },
  description: { type: String },
  icon: { type: String }
}, { timestamps: true });

export default mongoose.model('Feature', FeatureSchema);
