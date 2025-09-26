import mongoose from 'mongoose';
import bcrypt from 'bcryptjs';

const UserSchema = new mongoose.Schema({
  passportUrl: { type:String },
  signatureUrl: { type:String },
  profileCompleted: { type:Boolean, default:false },
  membershipActive: { type: Boolean, default: false },
  hasPaidMembership: { type: Boolean, default: false },
  certificatePaid: { type: Boolean, default: false },
  hasPaidCertificate: { type: Boolean, default: false },
  idCardPaid: { type: Boolean, default: false },
  hasPaidIdCard: { type: Boolean, default: false },
  name:        { type: String, trim: true },
  surname:     { type: String, trim: true },
  otherNames:  { type: String, trim: true },
  email:       { type: String, required: true, unique: true, lowercase: true, trim: true }, // keep unique here
  phone:       { type: String, trim: true },
  password:    { type: String, required: true },
  role:        { type: String, enum: ['admin','member'], default: 'member' },
  passportUrl: { type: String, trim: true },
  state:       { type: String, trim: true },
  zone:        { type: String, trim: true },
  guarantor:   { type: String, trim: true },
  dob:         { type: Date },
  declare_agree: { type: Boolean, default: false }
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
  if (!this.isModified('password')) return next();
  const salt = await bcrypt.genSalt(10);
  this.password = await bcrypt.hash(this.password, salt);
  next();
});

UserSchema.methods.comparePassword = function(candidate){
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
