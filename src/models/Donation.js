import mongoose from 'mongoose';

const donationSchema = new mongoose.Schema({
  donorName: {
    type: String,
    trim: true
  },
  email: {
    type: String,
    required: true,
    trim: true,
    lowercase: true
  },
  phone: {
    type: String,
    trim: true
  },
  donorType: {
    type: String,
    enum: ['individual', 'organization'],
    default: 'individual'
  },
  amount: {
    type: Number,
    required: true,
    min: 0
  },
  reference: {
    type: String,
    required: true,
    unique: true,
    trim: true
  },
  status: {
    type: String,
    enum: ['pending', 'success', 'failed'],
    default: 'pending'
  },
  message: {
    type: String,
    trim: true
  },
  paystackReference: {
    type: String,
    trim: true
  }
}, {
  timestamps: true // This creates createdAt and updatedAt automatically
});

// Create indexes for better performance
donationSchema.index({ email: 1 });
donationSchema.index({ reference: 1 });
donationSchema.index({ status: 1 });
donationSchema.index({ createdAt: -1 });

const Donation = mongoose.model('Donation', donationSchema);

export default Donation;