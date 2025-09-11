import mongoose from 'mongoose';

const SliderSchema = new mongoose.Schema({
  imageUrl: { type: String, required: true },
  smallTitle: { type: String },
  bigTitle: { type: String },
  paragraph: { type: String },
  primaryBtnText: { type: String },
  primaryBtnLink: { type: String },
  secondaryBtnText: { type: String },
  secondaryBtnLink: { type: String },
  order: { type: Number, default: 0 }
}, { timestamps: true });

export default mongoose.model('Slider', SliderSchema);
