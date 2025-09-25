import mongoose from 'mongoose';

const HomeSettingsSchema = new mongoose.Schema({
  key: { type: String, default: 'home', unique: true, index: true },
  about: {
    title: { type: String, default: 'About Us' },
    headline: { type: String, default: '' },
    paragraphs: { type: [String], default: [] },
    image: { type: String, default: '' }
  },
  services: { title: {type:String, default:'What We Do'}, subtitle: {type:String, default:''} },
  projects: { title: {type:String, default:'Our Projects'}, subtitle: {type:String, default:''} },
  features: { title: {type:String, default:'Why Choose Us'}, headline: {type:String, default:''} },
  offer: { title: {type:String, default:'Our Offer'} },
  blog: { title: {type:String, default:'Our Blog & News'}, showCount: {type:Number, default:3} },
  faqs: { title: {type:String, default:'FAQs'}, image: {type:String, default:''} },
  team: { title: {type:String, default:'Meet Our Executive'} }
}, { timestamps: true });

export default mongoose.model('Setting', HomeSettingsSchema);
