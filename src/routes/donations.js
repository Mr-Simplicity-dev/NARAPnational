import express from 'express';
import mongoose from 'mongoose';
import Donation from '../models/Donation.js';

const router = express.Router();

// Get all donations (Admin only)
router.get('/', async (req, res) => {
  try {
    console.log('🟡 Fetching all donations...');
    
    // Check if mongoose is connected
    if (mongoose.connection.readyState !== 1) {
      console.error('🔴 MongoDB not connected. ReadyState:', mongoose.connection.readyState);
      return res.status(500).json({ message: 'Database not connected' });
    }

    const donations = await Donation.find({})
      .sort({ createdAt: -1 })
      .lean();

    console.log(`✅ Found ${donations.length} donations`);

    // Format response for admin dashboard
    const formattedDonations = donations.map(donation => ({
      id: donation._id,
      donor_name: donation.donorName,
      email: donation.email,
      phone: donation.phone,
      donor_type: donation.donorType,
      amount: donation.amount,
      reference: donation.reference,
      status: donation.status,
      message: donation.message,
      created_at: donation.createdAt,
      updated_at: donation.updatedAt
    }));

    res.json(formattedDonations);
  } catch (error) {
    console.error('🔴 Error fetching donations:', error);
    res.status(500).json({ error: 'Failed to fetch donations' });
  }
});

// Create a new donation record
router.post('/', async (req, res) => {
  try {
    const {
      donor_name,
      email,
      phone,
      donor_type,
      amount,
      reference,
      status = 'pending',
      message,
      paystack_reference
    } = req.body;

    // Validate required fields
    if (!email || !amount || !reference) {
      return res.status(400).json({ 
        error: 'Missing required fields: email, amount, reference' 
      });
    }

    // Check if donation with this reference already exists
    const existingDonation = await Donation.findOne({ reference });
    if (existingDonation) {
      return res.status(409).json({ 
        error: 'Donation with this reference already exists' 
      });
    }

    const donation = new Donation({
      donorName: donor_name,
      email,
      phone,
      donorType: donor_type,
      amount,
      reference,
      status,
      message,
      paystackReference: paystack_reference || reference
    });

    const savedDonation = await donation.save();

    console.log(`✅ New donation created: ${savedDonation._id}`);

    res.status(201).json({
      id: savedDonation._id,
      message: 'Donation recorded successfully'
    });

  } catch (error) {
    console.error('🔴 Error creating donation:', error);
    
    if (error.code === 11000) {
      return res.status(409).json({ error: 'Donation with this reference already exists' });
    }
    
    res.status(500).json({ error: 'Failed to record donation' });
  }
});

// Update donation status (for payment verification)
router.patch('/:id/status', async (req, res) => {
  try {
    const { id } = req.params;
    const { status } = req.body;

    if (!status) {
      return res.status(400).json({ error: 'Status is required' });
    }

    if (!mongoose.Types.ObjectId.isValid(id)) {
      return res.status(400).json({ error: 'Invalid donation ID' });
    }

    const donation = await Donation.findByIdAndUpdate(
      id,
      { status },
      { new: true }
    );

    if (!donation) {
      return res.status(404).json({ error: 'Donation not found' });
    }

    console.log(`✅ Donation status updated: ${id} -> ${status}`);

    res.json({ message: 'Donation status updated successfully' });

  } catch (error) {
    console.error('🔴 Error updating donation status:', error);
    res.status(500).json({ error: 'Failed to update donation status' });
  }
});

// Get donation by reference
router.get('/reference/:reference', async (req, res) => {
  try {
    const { reference } = req.params;

    const donation = await Donation.findOne({ reference }).lean();

    if (!donation) {
      return res.status(404).json({ error: 'Donation not found' });
    }

    // Format response
    const formattedDonation = {
      id: donation._id,
      donor_name: donation.donorName,
      email: donation.email,
      phone: donation.phone,
      donor_type: donation.donorType,
      amount: donation.amount,
      reference: donation.reference,
      status: donation.status,
      message: donation.message,
      created_at: donation.createdAt,
      updated_at: donation.updatedAt
    };

    res.json(formattedDonation);

  } catch (error) {
    console.error('🔴 Error fetching donation by reference:', error);
    res.status(500).json({ error: 'Failed to fetch donation' });
  }
});

// Send thank you email (placeholder - implement with your email service)
router.post('/thank-you', async (req, res) => {
  try {
    const { email, donorName } = req.body;

    if (!email || !donorName) {
      return res.status(400).json({ error: 'Email and donor name are required' });
    }

    // TODO: Implement actual email sending logic here
    // For now, just return success
    console.log(`📧 Thank you email would be sent to: ${email} (${donorName})`);
    
    res.json({ message: 'Thank you email sent successfully' });

  } catch (error) {
    console.error('🔴 Error sending thank you email:', error);
    res.status(500).json({ error: 'Failed to send thank you email' });
  }
});

// Get donation statistics
router.get('/stats', async (req, res) => {
  try {
    const currentDate = new Date();
    const currentMonth = currentDate.getMonth();
    const currentYear = currentDate.getFullYear();

    // Get overall stats for successful donations
    const successfulDonations = await Donation.find({ status: 'success' });
    
    const totalDonations = successfulDonations.length;
    const totalAmount = successfulDonations.reduce((sum, donation) => sum + donation.amount, 0);
    const averageAmount = totalDonations > 0 ? totalAmount / totalDonations : 0;
    
    // Get unique donors
    const uniqueEmails = new Set(successfulDonations.map(d => d.email));
    const uniqueDonors = uniqueEmails.size;

    // Get this month's donations
    const monthlyDonations = successfulDonations.filter(donation => {
      const donationDate = new Date(donation.createdAt);
      return donationDate.getMonth() === currentMonth && 
             donationDate.getFullYear() === currentYear;
    });
    
    const monthlyAmount = monthlyDonations.reduce((sum, donation) => sum + donation.amount, 0);

    const stats = {
      total_donations: totalDonations,
      total_amount: totalAmount,
      average_amount: Math.round(averageAmount),
      unique_donors: uniqueDonors,
      monthly_amount: monthlyAmount
    };

    console.log('📊 Donation stats:', stats);

    res.json(stats);

  } catch (error) {
    console.error('🔴 Error fetching donation stats:', error);
    res.status(500).json({ error: 'Failed to fetch donation statistics' });
  }
});

export default router;