import mongoose from 'mongoose';

const TeamMemberSchema = new mongoose.Schema({
  name: { type: String, required: true },
  role: { type: String },
  imageUrl: { type: String },
  
  // Enhanced detailed information fields
  biography: { type: String }, // Full biography/description
  email: { type: String },
  phone: { type: String },
  department: { type: String },
  experience: { type: String }, // Years of experience or description
  education: { type: String }, // Educational background
  specializations: [String], // Array of specialization areas
  achievements: [String], // Array of achievements/awards
  
  // Original social media (keeping your existing structure)
  socials: {
    facebook: String,
    twitter: String,
    linkedin: String,
    instagram: String
  },
  
  // Additional display and management fields
  isActive: { type: Boolean, default: true }, // To show/hide members
  displayOrder: { type: Number, default: 0 } // For custom ordering
}, { timestamps: true });

export default mongoose.model('TeamMember', TeamMemberSchema);