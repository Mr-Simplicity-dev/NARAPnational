import mongoose from 'mongoose';
import bcrypt from 'bcryptjs';

const UserSchema = new mongoose.Schema({
  // Core auth fields
  name:        { type: String, trim: true },            // auto-built if missing
  surname:     { type: String, trim: true },
  otherNames:  { type: String, trim: true },            // e.g., first/middle names
  email:       { type: String, required: true, unique: true, lowercase: true, trim: true },
  phone:       { type: String, trim: true },
  password:    { type: String, required: true },

  // Role & assets
  role:        { type: String, enum: ['admin','member'], default: 'member' },
  passportUrl: { type: String, trim: true },

  // Member profile fields
  state:       { type: String, trim: true },
  zone:        { type: String, trim: true },
  guarantor:   { type: String, trim: true },
  dob:         { type: Date },
  declare_agree: { type: Boolean, default: false }
}, { timestamps: true });

// Auto-derive `name` if not provided (e.g., "Surname OtherNames")
UserSchema.pre('validate', function(next){
  if (!this.name) {
    const s = (this.surname || '').trim();
    const o = (this.otherNames || '').trim();
    const combined = `${s} ${o}`.trim();
    if (combined) this.name = combined;
  }
  next();
});

// Hash password on change
UserSchema.pre('save', async function(next){
  if (!this.isModified('password')) return next();
  const salt = await bcrypt.genSalt(10);
  this.password = await bcrypt.hash(this.password, salt);
  next();
});

// Compare plaintext vs hashed
UserSchema.methods.comparePassword = function(candidate){
  return bcrypt.compare(candidate, this.password);
};

// Clean JSON output
UserSchema.set('toJSON', {
  transform: (_doc, ret) => {
    delete ret.password;
    delete ret.__v;
    return ret;
  }
});

// Helpful index (unique declared above)
UserSchema.index({ email: 1 }, { unique: true });

export default mongoose.models.User || mongoose.model('User', UserSchema);
