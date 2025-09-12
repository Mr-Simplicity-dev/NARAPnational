import mongoose from 'mongoose';

const PaymentSchema = new mongoose.Schema({
  userId:    { type: mongoose.Schema.Types.ObjectId, ref: 'User' },
  email:     { type: String, index: true },
  amount:    { type: Number, required: true }, // in kobo
  currency:  { type: String, default: 'NGN' },
  reference: { type: String, unique: true, index: true },
  purpose:   { type: String, enum: ['membership','idcard','certificate','other'], default: 'other' },
  status:    { type: String, enum: ['initialised','success','failed'], default: 'initialised' },
  channel:   { type: String },
  paidAt:    { type: Date },
  raw:       { type: Object }
}, { timestamps: true });

export default mongoose.model('Payment', PaymentSchema);
