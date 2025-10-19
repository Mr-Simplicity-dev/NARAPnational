<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs - NARAP</title>
    <link rel="icon" type="image/png" href="/uploads/slider/Narap.png"/>
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        /* ===== CSS VARIABLES ===== */
        :root {
            --brand: #0a7f41;
            --brand-700: #086d37;
            --ink: #0b1220;
            --muted: #6b7280;
            --surface: #fff;
        }

        /* ===== BASE STYLES ===== */
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            color: var(--ink);
        }

        /* ===== FAQ HEADER ===== */
        .faq-header {
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-700) 100%);
            color: white;
            padding: 100px 0 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .faq-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/uploads/slider/Narap.png') center/200px no-repeat;
            opacity: 0.1;
            pointer-events: none;
        }

        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #f0f0f0;
            text-decoration: none;
            transform: translateX(-5px);
        }

        /* ===== FAQ SECTION ===== */
        .faq-section {
            padding: 80px 0;
        }

        .search-box {
            max-width: 600px;
            margin: 0 auto 60px;
        }

        .search-input {
            border-radius: 50px;
            border: 2px solid #e9ecef;
            padding: 16px 24px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 0.2rem rgba(10, 127, 65, 0.25);
        }

        /* ===== ACCORDION STYLES ===== */
        .accordion-item {
            border: none;
            margin-bottom: 20px;
            border-radius: 16px !important;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .accordion-button {
            background: white;
            border: none;
            padding: 24px 30px;
            font-weight: 600;
            font-size: 16px;
            color: var(--ink);
            border-radius: 16px !important;
            box-shadow: none;
        }

        .accordion-button:not(.collapsed) {
            background: var(--brand);
            color: white;
            box-shadow: none;
        }

        .accordion-button:focus {
            box-shadow: none;
            border: none;
        }

        .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        .accordion-button.collapsed::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23333333'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }

        .accordion-body {
            padding: 24px 30px;
            background: #f8f9fa;
            color: var(--muted);
            line-height: 1.7;
            font-size: 15px;
        }

        /* ===== SIDEBAR STYLES ===== */
        .faq-image {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        /* ===== STATS SECTION ===== */
        .stats-section {
            background: var(--brand);
            color: white;
            padding: 60px 0;
            margin: 80px 0;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* ===== CONTACT CTA ===== */
        .contact-cta {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 60px 0;
            text-align: center;
        }

        /* ===== BUTTON STYLES ===== */
        .btn-brand {
            background: var(--brand);
            border-color: var(--brand);
            color: white;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-brand:hover {
            background: var(--brand-700);
            border-color: var(--brand-700);
            color: white;
            transform: translateY(-2px);
            text-decoration: none;
        }

        /* ===== UTILITY STYLES ===== */
        .no-results {
            text-align: center;
            padding: 40px;
            color: var(--muted);
        }

        .loading-spinner {
            text-align: center;
            padding: 40px;
        }
    </style>
</head>
<body>

    <!-- FAQ Header Section -->
    <div class="faq-header">
        <a href="/" class="back-link">
            <i class="fas fa-arrow-left me-2"></i>Back to Home
        </a>
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Frequently Asked Questions</h1>
            <p class="lead mb-0">Find answers to common questions about NARAP membership and services</p>
        </div>
    </div>

    <!-- Main FAQ Content -->
    <div class="container faq-section">
        <!-- Search Box -->
        <div class="search-box">
            <input type="text" class="form-control search-input" id="faqSearch" placeholder="Search FAQs..." onkeyup="searchFAQs()">
        </div>

        <div class="row">
            <!-- FAQ Accordion -->
            <div class="col-lg-8 mb-5">
                <div class="accordion" id="faqAccordion">
                    <!-- Loading State -->
                    <div class="loading-spinner">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading FAQs...</span>
                        </div>
                        <p class="mt-2 text-muted">Loading FAQs from database...</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="faq-image mb-4">
                    <img src="admin/uploads/sections/1756079209_91c9fe894c22dfe20d272ffd73db8225.jpg" class="img-fluid w-100" alt="NARAP Services">
                </div>

                <!-- Quick Links -->
                <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                    <h5 class="fw-bold mb-3">Quick Links</h5>
                    <div class="d-grid gap-2">
                        <a href="register.php" class="btn btn-outline-primary">Become a Member</a>
                        <a href="contact.php" class="btn btn-outline-secondary">Contact Support</a>
                        <a href="/" class="btn btn-outline-info">Back to Home</a>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="bg-white p-4 rounded-3 shadow-sm">
                    <h5 class="fw-bold mb-3">Still Have Questions?</h5>
                    <p class="text-muted mb-3">Can't find what you're looking for? Contact our support team.</p>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-phone text-primary me-2"></i>
                        <span>+234 706 701 2884</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-envelope text-primary me-2"></i>
                        <span>info@narapnational.org.ng</span>
                    </div>
                    <a href="contact.php" class="btn btn-brand btn-sm w-100">Contact Us</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Active Members</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Training Programs</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">1000+</div>
                        <div class="stat-label">Projects Completed</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Support Available</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact CTA -->
    <div class="contact-cta">
        <div class="container">
            <h3 class="mb-3">Need More Information?</h3>
            <p class="mb-4">Our team is ready to help you with any questions about NARAP membership and services.</p>
            <a href="contact.php" class="btn btn-brand">Get in Touch</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Static FAQs as fallback
        const staticFAQs = [
            {
                question: "What industries does NARAP operate in?",
                answer: "NARAP operates exclusively within the HVAC&R (Heating, Ventilation, Air Conditioning, and Refrigeration) industry. We serve sectors requiring climate control and preservation—such as commercial buildings, cold chain logistics, industrial cooling, and healthcare environmental systems—by advancing professional standards and expertise.",
                keywords: "industries sectors hvac refrigeration"
            },
            {
                question: "How can I partner with NARAP in Air Conditioning & Refrigeration?",
                answer: "We offer technical collaboration and partnership opportunities within the HVAC&R sector. Interested practitioners and organizations can contact our membership committee to discuss tailored opportunities for growth and innovation.",
                keywords: "partnership collaboration air conditioning refrigeration"
            },
            // ... include all 8 FAQs from your static list
        ];

        async function loadFAQs() {
    try {
        const response = await fetch('/api/faqs');
        
        if (!response.ok) {
            throw new Error(`API returned ${response.status}`);
        }
        
        const result = await response.json();
        // Handle the {data: [...], count: N} format
        const faqs = result.data || result; // Support both formats
        
        if (faqs && faqs.length > 0) {
            renderFAQs(faqs);
        } else {
            throw new Error('No FAQs returned from API');
        }
        
    } catch (error) {
        console.warn('Using static FAQs as fallback:', error.message);
        renderFAQs(staticFAQs);
    }
}

        function renderFAQs(faqs) {
            const accordion = document.getElementById('faqAccordion');
            
            if (!faqs || faqs.length === 0) {
                accordion.innerHTML = `
                    <div class="no-results">
                        <i class="fas fa-info-circle fa-3x mb-3 text-muted"></i>
                        <h5>No FAQs Available</h5>
                        <p>Please check back later or contact support.</p>
                    </div>
                `;
                return;
            }
            
            accordion.innerHTML = faqs.map((faq, index) => `
                <div class="accordion-item" data-keywords="${faq.keywords || ''}">
                    <h2 class="accordion-header" id="heading${index}">
                        <button class="accordion-button collapsed" type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#collapse${index}"
                                aria-expanded="false" 
                                aria-controls="collapse${index}">
                            ${faq.question}
                        </button>
                    </h2>
                    <div id="collapse${index}" class="accordion-collapse collapse" 
                         aria-labelledby="heading${index}" 
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">${faq.answer}</div>
                    </div>
                </div>
            `).join('');
        }

        function searchFAQs() {
            const searchTerm = document.getElementById('faqSearch').value.toLowerCase().trim();
            const faqItems = document.querySelectorAll('.accordion-item');
            let visibleCount = 0;
            
            faqItems.forEach(item => {
                const keywords = item.dataset.keywords || '';
                const question = item.querySelector('.accordion-button')?.textContent.toLowerCase() || '';
                const answer = item.querySelector('.accordion-body')?.textContent.toLowerCase() || '';
                
                const matches = searchTerm === '' || 
                               keywords.includes(searchTerm) || 
                               question.includes(searchTerm) || 
                               answer.includes(searchTerm);
                
                item.style.display = matches ? 'block' : 'none';
                if (matches) visibleCount++;
            });
            
            // Show no results message if no matches
            const accordion = document.getElementById('faqAccordion');
            let noResultsMsg = accordion.querySelector('.no-results-message');
            
            if (searchTerm !== '' && visibleCount === 0) {
                if (!noResultsMsg) {
                    noResultsMsg = document.createElement('div');
                    noResultsMsg.className = 'no-results no-results-message';
                    noResultsMsg.innerHTML = `
                        <i class="fas fa-search fa-3x mb-3 text-muted"></i>
                        <h5>No matching FAQs found</h5>
                        <p>Try searching with different keywords.</p>
                    `;
                    accordion.appendChild(noResultsMsg);
                }
            } else if (noResultsMsg) {
                noResultsMsg.remove();
            }
        }

        // Load FAQs when page loads
        document.addEventListener('DOMContentLoaded', loadFAQs);

        // Clear search when input is emptied
        document.getElementById('faqSearch').addEventListener('input', function(e) {
            if (e.target.value === '') {
                searchFAQs();
            }
        });
    </script>
</body>
</html>