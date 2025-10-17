import mongoose from 'mongoose';
import bcrypt from 'bcryptjs';

const UserSchema = new mongoose.Schema({
  // Profile and payment fields
  passportUrl: { type: String },
  signatureUrl: { type: String },
  profileCompleted: { type: Boolean, default: false },
  membershipActive: { type: Boolean, default: false },
  hasPaidMembership: { type: Boolean, default: false },
  certificatePaid: { type: Boolean, default: false },
  hasPaidCertificate: { type: Boolean, default: false },
  idCardPaid: { type: Boolean, default: false },
  hasPaidIdCard: { type: Boolean, default: false },
  
  // Basic user information
  name: { type: String, trim: true },
  surname: { type: String, trim: true },
  otherNames: { type: String, trim: true },
  email: { type: String, required: true, unique: true, lowercase: true, trim: true },
  phone: { type: String, trim: true }, 
  password: { type: String, required: function() { return !this.googleId; } },
  role: { type: String, enum: ['admin', 'member'], default: 'member' },
  googleId: { type: String, sparse: true },

  // Additional member fields from profile form
  state: { type: String, trim: true },
  zone: { type: String, trim: true },
  guarantor: { type: String, trim: true },
  dob: { type: Date },
  declare_agree: { type: Boolean, default: false },
  
  // NEW FIELDS - Add these from your profile form
  sex: { type: String, trim: true },
  maritalStatus: { type: String, trim: true },
  lga: { type: String, trim: true },
  ward: { type: String, trim: true },
  businessName: { type: String, trim: true },
  businessAddress: { type: String, trim: true },
  specialization: { type: String, trim: true },
  position: { type: String, trim: true },
  address: { type: String, trim: true },
  nextOfKin: { type: String, trim: true },
  guarantorAddress: { type: String, trim: true },
  guarantorPosition: { type: String, trim: true }
}, { timestamps: true });

UserSchema.pre('validate', function(next){
  if (!this.name) {
    const s = (this.surname || '').trim();
    const o = (this.otherNames || '').trim();
    const combined = `${s} ${o}`.trim();
    if (combined) this.name = combined;
  }
  next();
});

UserSchema.pre('save', async function(next){
  // Skip password hashing if password is not set (Google users) or not modified
  if (!this.password || !this.isModified('password')) return next();
  
  const salt = await bcrypt.genSalt(10);
  this.password = await bcrypt.hash(this.password, salt);
  next();
});

UserSchema.methods.comparePassword = function(candidate){
  // If user has no password (Google user), return false
  if (!this.password) return Promise.resolve(false);
  
  return bcrypt.compare(candidate, this.password);
};

UserSchema.set('toJSON', {
  transform: (_doc, ret) => {
    delete ret.password;
    delete ret.__v;
    return ret;
  }
});

export default mongoose.models.User || mongoose.model('User', UserSchema);