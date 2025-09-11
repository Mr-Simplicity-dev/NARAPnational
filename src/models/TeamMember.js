import mongoose from 'mongoose';

const TeamMemberSchema = new mongoose.Schema({
  name: { type: String, required: true },
  role: { type: String },
  imageUrl: { type: String },
  socials: {
    facebook: String,
    twitter: String,
    linkedin: String,
    instagram: String
  }
}, { timestamps: true });

export default mongoose.model('TeamMember', TeamMemberSchema);
