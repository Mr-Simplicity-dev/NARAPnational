import mongoose from 'mongoose';

const SliderSchema = new mongoose.Schema({
  imageUrl: { type: String }, // Removed required: true
  smallTitle: { type: String },
  bigTitle: { type: String },
  paragraph: { type: String },
  primaryBtnText: { type: String },
  primaryBtnLink: { type: String },
  primaryBtnVideoUrl: { type: String }, // Added
  primaryBtnVideoFile: { type: String }, // Added
  secondaryBtnText: { type: String },
  secondaryBtnLink: { type: String },
  order: { type: Number, default: 0 }
}, { timestamps: true });

// Custom validation: require either image or video
SliderSchema.pre('save', function(next) {
  if (!this.imageUrl && !this.primaryBtnVideoUrl && !this.primaryBtnVideoFile) {
    next(new Error('Either an image or video is required'));
  } else {
    next();
  }
});

export default mongoose.model('Slider', SliderSchema);