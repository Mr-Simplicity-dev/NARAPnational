<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - NARAP</title>
    <link rel="icon" type="image/png" href="/uploads/slider/Narap.png"/>
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --brand: #0a7f41;
            --brand-700: #086d37;
            --ink: #0b1220;
            --muted: #6b7280;
            --surface: #fff;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            color: var(--ink);
        }
        
        .contact-header {
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-700) 100%);
            color: white;
            padding: 80px 0 60px;
            text-align: center;
        }
        
        .contact-form {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-top: -40px;
            position: relative;
            z-index: 2;
        }
        
        .contact-info {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            height: 100%;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
        }
        
        .info-icon {
            width: 50px;
            height: 50px;
            background: var(--brand);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
            font-size: 18px;
        }
        
        .form-control {
            border-radius: 12px;
            border: 2px solid #e9ecef;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 0.2rem rgba(10, 127, 65, 0.25);
        }
        
        .btn-brand {
            background: var(--brand);
            border-color: var(--brand);
            color: white;
            padding: 12px 32px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-brand:hover {
            background: var(--brand-700);
            border-color: var(--brand-700);
            color: white;
            transform: translateY(-2px);
        }
        
        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            z-index: 10;
        }
        
        .back-link:hover {
            color: #f0f0f0;
            text-decoration: none;
        }

        /* Page fade-in transition */
body {
    opacity: 0;
    animation: fadeIn 0.5s ease-in forwards;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Link click transition */
.page-transition {
    transition: opacity 0.3s ease-out;
}

.page-transition.fade-out {
    opacity: 0;
}
    </style>
</head>
<body>
    <div class="contact-header position-relative">
        <a href="/" class="back-link">
            <i class="fas fa-arrow-left me-2"></i>Back to Home
        </a>
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Contact Us</h1>
            <p class="lead">Get in touch with NARAP for all your cooling and refrigeration needs</p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-8 mb-5">
                <div class="contact-form">
                    <h3 class="mb-4">Send us a Message</h3>
                    <form id="contactForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="service" class="form-label">Service Needed</label>
                                <select class="form-control" id="service">
                                    <option value="">Select a service</option>
                                    <option value="ac-installation">AC Installation</option>
                                    <option value="ac-repair">AC Repair</option>
                                    <option value="fridge-purchase">Fridge Purchase</option>
                                    <option value="fridge-repair">Fridge Repair</option>
                                    <option value="maintenance">Maintenance</option>
                                    <option value="consultation">Consultation</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject *</label>
                            <input type="text" class="form-control" id="subject" required>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="form-label">Message *</label>
                            <textarea class="form-control" id="message" rows="5" required placeholder="Tell us about your requirements..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-brand">
                            <i class="fas fa-paper-plane me-2"></i>Send Message
                        </button>
                    </form>
                    
                    <div id="formMessage" class="mt-3" style="display: none;"></div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-lg-4">
                <div class="contact-info">
                    <h3 class="mb-4">Get in Touch</h3>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Address</h6>
                            <p class="mb-0 text-muted">FCT, Abuja, Nigeria</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Phone</h6>
                            <p class="mb-0 text-muted">+234 706 701 2884</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Email</h6>
                            <p class="mb-0 text-muted">info@narapnational.org.ng</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Business Hours</h6>
                            <p class="mb-0 text-muted">Mon - Fri: 8:00 AM - 6:00 PM<br>Sat: 9:00 AM - 4:00 PM</p>
                        </div>
                    </div>

                    <!-- Social Media Links -->
                    <div class="mt-4">
                        <h6 class="mb-3">Follow Us</h6>
                        <div class="d-flex gap-3">
                            <a href="#" class="btn btn-outline-primary btn-sm rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-outline-info btn-sm rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-outline-success btn-sm rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="btn btn-outline-danger btn-sm rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const service = document.getElementById('service').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;
            
            // Simple validation
            if (!name || !email || !subject || !message) {
                showMessage('Please fill in all required fields.', 'error');
                return;
            }
            
            // Simulate form submission (you can replace this with actual form submission logic)
            showMessage('Thank you for your message! We will get back to you soon.', 'success');
            
            // Reset form
            this.reset();
        });
        
        function showMessage(text, type) {
            const messageDiv = document.getElementById('formMessage');
            messageDiv.style.display = 'block';
            messageDiv.className = `alert ${type === 'success' ? 'alert-success' : 'alert-danger'}`;
            messageDiv.textContent = text;
            
            // Hide message after 5 seconds
            setTimeout(() => {
                messageDiv.style.display = 'none';
            }, 5000);
        }

        // Add to each PHP file or in a shared JS file
document.addEventListener('DOMContentLoaded', function() {
    // Fade in current page
    document.body.style.opacity = '0';
    setTimeout(() => {
        document.body.style.transition = 'opacity 0.5s ease-in';
        document.body.style.opacity = '1';
    }, 50);

    // Handle navigation links
    const navLinks = document.querySelectorAll('a[href$=".php"]');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            
            // Fade out current page
            document.body.style.transition = 'opacity 0.3s ease-out';
            document.body.style.opacity = '0';
            
            // Navigate after fade out
            setTimeout(() => {
                window.location.href = href;
            }, 300);
        });
    });
});
    </script>
</body>
</html>