CREATE TABLE IF NOT EXISTS donations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  donor_name VARCHAR(255),
  email VARCHAR(255) NOT NULL,
  phone VARCHAR(20),
  donor_type ENUM('individual', 'organization') DEFAULT 'individual',
  amount DECIMAL(15, 2) NOT NULL,
  reference VARCHAR(255) UNIQUE NOT NULL,
  status ENUM('pending', 'success', 'failed') DEFAULT 'pending',
  message TEXT,
  paystack_reference VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  
  INDEX idx_email (email),
  INDEX idx_reference (reference),
  INDEX idx_status (status),
  INDEX idx_created_at (created_at)
);