import express from 'express';
import db from '../config/database.js';

const router = express.Router();

// Get all donations (Admin only)
router.get('/', async (req, res) => {
  try {
    const query = `
      SELECT 
        id,
        donor_name,
        email,
        phone,
        donor_type,
        amount,
        reference,
        status,
        message,
        created_at,
        updated_at
      FROM donations 
      ORDER BY created_at DESC
    `;
    
    const [donations] = await db.execute(query);
    res.json(donations);
  } catch (error) {
    console.error('Error fetching donations:', error);
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
      message
    } = req.body;

    // Validate required fields
    if (!email || !amount || !reference) {
      return res.status(400).json({ 
        error: 'Missing required fields: email, amount, reference' 
      });
    }

    const query = `
      INSERT INTO donations (
        donor_name, email, phone, donor_type, amount, 
        reference, status, message, created_at, updated_at
      ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
    `;

    const [result] = await db.execute(query, [
      donor_name,
      email,
      phone,
      donor_type,
      amount,
      reference,
      status,
      message
    ]);

    res.status(201).json({
      id: result.insertId,
      message: 'Donation recorded successfully'
    });

  } catch (error) {
    console.error('Error creating donation:', error);
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

    const query = `
      UPDATE donations 
      SET status = ?, updated_at = NOW() 
      WHERE id = ?
    `;

    const [result] = await db.execute(query, [status, id]);

    if (result.affectedRows === 0) {
      return res.status(404).json({ error: 'Donation not found' });
    }

    res.json({ message: 'Donation status updated successfully' });

  } catch (error) {
    console.error('Error updating donation status:', error);
    res.status(500).json({ error: 'Failed to update donation status' });
  }
});

// Get donation by reference
router.get('/reference/:reference', async (req, res) => {
  try {
    const { reference } = req.params;

    const query = `
      SELECT * FROM donations 
      WHERE reference = ?
    `;

    const [donations] = await db.execute(query, [reference]);

    if (donations.length === 0) {
      return res.status(404).json({ error: 'Donation not found' });
    }

    res.json(donations[0]);

  } catch (error) {
    console.error('Error fetching donation by reference:', error);
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
    console.log(`Thank you email would be sent to: ${email} (${donorName})`);
    
    res.json({ message: 'Thank you email sent successfully' });

  } catch (error) {
    console.error('Error sending thank you email:', error);
    res.status(500).json({ error: 'Failed to send thank you email' });
  }
});

// Get donation statistics
router.get('/stats', async (req, res) => {
  try {
    const statsQuery = `
      SELECT 
        COUNT(*) as total_donations,
        SUM(amount) as total_amount,
        AVG(amount) as average_amount,
        COUNT(DISTINCT email) as unique_donors
      FROM donations 
      WHERE status = 'success'
    `;

    const monthlyQuery = `
      SELECT SUM(amount) as monthly_amount
      FROM donations 
      WHERE status = 'success' 
      AND MONTH(created_at) = MONTH(CURRENT_DATE())
      AND YEAR(created_at) = YEAR(CURRENT_DATE())
    `;

    const [statsResult] = await db.execute(statsQuery);
    const [monthlyResult] = await db.execute(monthlyQuery);

    const stats = statsResult[0];
    const monthly = monthlyResult[0];

    res.json({
      total_donations: stats.total_donations || 0,
      total_amount: stats.total_amount || 0,
      average_amount: stats.average_amount || 0,
      unique_donors: stats.unique_donors || 0,
      monthly_amount: monthly.monthly_amount || 0
    });

  } catch (error) {
    console.error('Error fetching donation stats:', error);
    res.status(500).json({ error: 'Failed to fetch donation statistics' });
  }
});

export default router;