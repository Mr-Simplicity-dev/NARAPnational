import mongoose from 'mongoose';

const TestimonialSchema = new mongoose.Schema({
  name: { type: String, required: true },
  role: { type: String }, // e.g., "HVAC Engineer", "Company Owner"
  company: { type: String }, // Company/Organization name
  location: { type: String }, // City, State
  testimonial: { type: String, required: true }, // The testimonial text
  rating: { type: Number, min: 1, max: 5, default: 5 }, // Star rating
  imageUrl: { type: String }, // Profile photo
  
  // Additional fields
  email: { type: String }, // For verification
  isVerified: { type: Boolean, default: false }, // Admin verification
  isFeatured: { type: Boolean, default: false }, // Featured testimonials
  isActive: { type: Boolean, default: true }, // Show/hide
  displayOrder: { type: Number, default: 0 } // Custom ordering
}, { timestamps: true });

export default mongoose.model('Testimonial', TestimonialSchema);