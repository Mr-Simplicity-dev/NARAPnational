
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" type="image/png" href="/uploads/slider/Narap.png"/>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Donate to NARAP — Support Our Mission</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link href="/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  
  <style>
    :root {
      --brand: #0a7f41;
      --brand-50: #eaf7f0;
      --brand-100: #d1efdd;
      --brand-600: #0a7f41;
      --brand-700: #086d37;
      --brand-800: #065a2d;
      --ink: #0b1220;
      --muted: #6b7280;
      --surface: #ffffff;
      --bg: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      --gradient: linear-gradient(135deg, var(--brand-600), var(--brand-700));
      --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
      background: var(--bg);
      color: var(--ink);
      line-height: 1.6;
      min-height: 100vh;
    }

    /* Header */
    .header {
      background: var(--gradient);
      color: white;
      padding: 2rem 0;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .header::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -20%;
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
      border-radius: 50%;
    }

    .header-content {
      position: relative;
      z-index: 1;
      max-width: 800px;
      margin: 0 auto;
      padding: 0 2rem;
    }

    .header-logo {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      margin-bottom: 1.5rem;
      border: 4px solid rgba(255, 255, 255, 0.3);
    }

    .header-title {
      font-size: 3rem;
      font-weight: 800;
      margin-bottom: 1rem;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .header-subtitle {
      font-size: 1.3rem;
      opacity: 0.9;
      font-weight: 500;
    }

    /* Main Container */
    .container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 3rem 2rem;
    }

    /* Cards */
    .card {
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 20px;
      padding: 2.5rem;
      margin-bottom: 2rem;
      box-shadow: var(--shadow);
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-lg);
    }

    .card-title {
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--brand);
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .card-icon {
      font-size: 2rem;
      color: var(--brand);
    }

    /* Donation Amounts */
    .donation-amounts {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1.5rem;
      margin: 2rem 0;
    }

    .amount-card {
      background: rgba(255, 255, 255, 0.6);
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-radius: 16px;
      padding: 2rem;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
    }

    .amount-card:hover {
      transform: translateY(-4px);
      border-color: var(--brand);
      box-shadow: 0 8px 25px rgba(10, 127, 65, 0.2);
    }

    .amount-card.selected {
      border-color: var(--brand);
      background: var(--brand-50);
    }

    .amount-value {
      font-size: 2.5rem;
      font-weight: 800;
      color: var(--brand);
      margin-bottom: 0.5rem;
    }

    .amount-label {
      color: var(--muted);
      font-weight: 500;
    }

    /* Custom Amount */
    .custom-amount {
      margin: 2rem 0;
    }

    .amount-input {
      width: 100%;
      padding: 1rem 1.5rem;
      border: 2px solid var(--brand-100);
      border-radius: 12px;
      font-size: 1.2rem;
      font-weight: 600;
      text-align: center;
      transition: all 0.3s ease;
    }

    .amount-input:focus {
      outline: none;
      border-color: var(--brand);
      box-shadow: 0 0 0 3px rgba(10, 127, 65, 0.1);
    }

    /* Donate Button */
    .btn-donate {
      background: var(--gradient);
      color: white;
      border: none;
      border-radius: 16px;
      padding: 1.2rem 3rem;
      font-size: 1.2rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 1rem;
      text-decoration: none;
      box-shadow: 0 8px 25px rgba(10, 127, 65, 0.3);
      width: 100%;
      justify-content: center;
    }

    .btn-donate:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 35px rgba(10, 127, 65, 0.4);
    }

    .btn-back {
      background: transparent;
      color: var(--brand);
      border: 2px solid var(--brand);
      border-radius: 12px;
      padding: 0.8rem 2rem;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .btn-back:hover {
      background: var(--brand);
      color: white;
      transform: translateY(-2px);
    }

    /* Impact Section */
    .impact-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      margin: 2rem 0;
    }

    .impact-item {
      text-align: center;
      padding: 1.5rem;
      background: rgba(255, 255, 255, 0.5);
      border-radius: 16px;
      transition: all 0.3s ease;
    }

    .impact-item:hover {
      transform: translateY(-4px);
      background: rgba(255, 255, 255, 0.8);
    }

    .impact-icon {
      font-size: 3rem;
      color: var(--brand);
      margin-bottom: 1rem;
    }

    .impact-title {
      font-size: 1.2rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
      color: var(--ink);
    }

    .impact-desc {
      color: var(--muted);
      font-size: 0.95rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .header-title {
        font-size: 2.5rem;
      }
      
      .container {
        padding: 2rem 1rem;
      }
      
      .card {
        padding: 2rem;
      }
      
      .donation-amounts {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .amount-value {
        font-size: 2rem;
      }
    }

    @media (max-width: 480px) {
      .donation-amounts {
        grid-template-columns: 1fr;
      }
      
      .header-title {
        font-size: 2rem;
      }
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header class="header">
    <div class="header-content">
      <img src="/uploads/slider/Narap.png" alt="NARAP Logo" class="header-logo">
      <h1 class="header-title">Support NARAP</h1>
      <p class="header-subtitle">Help us advance climate control solutions and make them accessible to all</p>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <!-- Back Button -->
    <div style="margin-bottom: 2rem;">
      <a href="/" class="btn-back">
        <i class="fas fa-arrow-left"></i>
        Back to Home
      </a>
    </div>

    <!-- Mission Card -->
    <div class="card">
      <h2 class="card-title">
        <i class="fas fa-heart card-icon"></i>
        Our Mission
      </h2>
      <p style="font-size: 1.1rem; line-height: 1.8; color: var(--muted);">
        The Nigerian Association of Refrigeration & Air Conditioning Practitioners (NARAP) is dedicated to advancing climate control technology and making it accessible to businesses across Nigeria. Your donation helps us provide training, certification, and support to professionals in our industry.
      </p>
    </div>

    <!-- Donation Form -->
    <div class="card">
      <h2 class="card-title">
        <i class="fas fa-gift card-icon"></i>
        Make a Donation
      </h2>

      <!-- Preset Amounts -->
      <div class="donation-amounts">
        <div class="amount-card" data-amount="5000000">
          <div class="amount-value">₦5,000,000</div>
          <div class="amount-label">Supporter</div>
        </div>
        <div class="amount-card" data-amount="100000000">
          <div class="amount-value">₦100,000,000</div>
          <div class="amount-label">Advocate</div>
        </div>
        <div class="amount-card" data-amount="250000000">
          <div class="amount-value">₦250,000,000</div>
          <div class="amount-label">Champion</div>
        </div>
        <div class="amount-card" data-amount="50000000000">
          <div class="amount-value">₦50,000,000,000</div>
          <div class="amount-label">Partner</div>
        </div>
      </div>

      <!-- Custom Amount -->
      <div class="custom-amount">
        <label for="customAmount" style="font-weight: 600; margin-bottom: 0.5rem; display: block;">Or enter custom amount:</label>
        <input type="number" id="customAmount" class="amount-input" placeholder="Enter amount in Naira" min="1000">
      </div>

      <!-- Donate Button -->
      <button class="btn-donate" id="donateBtn">
        <i class="fas fa-heart"></i>
        Donate Now
      </button>
    </div>

    <!-- Impact Section -->
    <div class="card">
      <h2 class="card-title">
        <i class="fas fa-chart-line card-icon"></i>
        Your Impact
      </h2>
      
      <div class="impact-grid">
        <div class="impact-item">
          <div class="impact-icon">🎓</div>
          <div class="impact-title">Training Programs</div>
          <div class="impact-desc">Fund professional development and certification courses</div>
        </div>
        <div class="impact-item">
          <div class="impact-icon">🔧</div>
          <div class="impact-title">Equipment & Tools</div>
          <div class="impact-desc">Provide modern tools and equipment for training</div>
        </div>
        <div class="impact-item">
          <div class="impact-icon">🌍</div>
          <div class="impact-title">Community Outreach</div>
          <div class="impact-desc">Expand our reach to underserved communities</div>
        </div>
        <div class="impact-item">
          <div class="impact-icon">💡</div>
          <div class="impact-title">Innovation</div>
          <div class="impact-desc">Research and develop new climate solutions</div>
        </div>
      </div>
    </div>

    <!-- Contact Info -->
    <div class="card">
      <h2 class="card-title">
        <i class="fas fa-envelope card-icon"></i>
        Get in Touch
      </h2>
      <p style="color: var(--muted); line-height: 1.8;">
        Have questions about donations or want to discuss partnership opportunities? 
        <br><br>
        <strong>Email:</strong> info@narap.org.ng<br>
        <strong>Phone:</strong> +234 (0) 123 456 7890
      </p>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://js.paystack.co/v1/inline.js"></script>
  <script>
    // Amount selection
    const amountCards = document.querySelectorAll('.amount-card');
    const customAmount = document.getElementById('customAmount');
    const donateBtn = document.getElementById('donateBtn');
    let selectedAmount = 0;

    // Handle preset amount selection
    amountCards.forEach(card => {
      card.addEventListener('click', () => {
        amountCards.forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        selectedAmount = parseInt(card.dataset.amount);
        customAmount.value = '';
        updateDonateButton();
      });
    });

    // Handle custom amount
    customAmount.addEventListener('input', () => {
      amountCards.forEach(c => c.classList.remove('selected'));
      selectedAmount = parseInt(customAmount.value) || 0;
      updateDonateButton();
    });

    function updateDonateButton() {
      if (selectedAmount >= 1000) {
        donateBtn.textContent = `Donate ₦${selectedAmount.toLocaleString()}`;
        donateBtn.disabled = false;
      } else {
        donateBtn.innerHTML = '<i class="fas fa-heart"></i> Donate Now';
        donateBtn.disabled = false;
      }
    }

    // Handle donation
    donateBtn.addEventListener('click', () => {
      if (selectedAmount < 1000) {
        alert('Please select or enter an amount of at least ₦1,000');
        return;
      }

      // Initialize Paystack payment
      const handler = PaystackPop.setup({
        key: 'pk_test_your_paystack_public_key_here', // Replace with your Paystack public key
        email: 'donor@example.com', // You can ask for email or use a default
        amount: selectedAmount * 100, // Amount in kobo
        currency: 'NGN',
        ref: 'donation_' + Math.floor((Math.random() * 1000000000) + 1),
        metadata: {
          purpose: 'donation',
          donor_type: 'individual'
        },
        callback: function(response) {
          alert('Donation successful! Thank you for supporting NARAP. Reference: ' + response.reference);
          // You can redirect to a thank you page or send data to your backend
          window.location.href = '/?donation=success';
        },
        onClose: function() {
          alert('Donation cancelled');
        }
      });
      
      handler.openIframe();
    });

    // Check if Paystack loaded
    if (typeof PaystackPop === 'undefined') {
      console.error('Paystack script failed to load');
      donateBtn.addEventListener('click', () => {
        alert('Payment system is currently unavailable. Please try again later.');
      });
    }
  </script>
</body>
</html>