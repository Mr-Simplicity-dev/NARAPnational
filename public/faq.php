<!-- Bootstrap CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<!-- Animate CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

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
    
    .faq-section {
        padding: 80px 0;
    }
    
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
    
    .faq-image {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    
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
    
    .contact-cta {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 60px 0;
        text-align: center;
    }
    
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
</style>

<div class="container faq-section">
    <!-- Search Box -->
    <div class="search-box">
        <input type="text" class="form-control search-input" id="faqSearch" placeholder="Search FAQs..." onkeyup="searchFAQs()">
    </div>

    <div class="row">
        <!-- FAQ Accordion -->
        <div class="col-lg-8 mb-5">
            <div class="accordion" id="faqAccordion">
                <!-- FAQ 1 -->
                <div class="accordion-item" data-keywords="industries sectors hvac refrigeration">
                    <h2 class="accordion-header" id="heading1">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                            What industries does NARAP operate in?
                        </button>
                    </h2>
                    <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            NARAP operates exclusively within the HVAC&R (Heating, Ventilation, Air Conditioning, and Refrigeration) industry. We serve sectors requiring climate control and preservation—such as commercial buildings, cold chain logistics, industrial cooling, and healthcare environmental systems—by advancing professional standards and expertise.
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="accordion-item" data-keywords="partnership collaboration air conditioning refrigeration">
                    <h2 class="accordion-header" id="heading2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                            How can I partner with NARAP in Air Conditioning & Refrigeration?
                        </button>
                    </h2>
                    <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We offer technical collaboration and partnership opportunities within the HVAC&R sector. Interested practitioners and organizations can contact our membership committee to discuss tailored opportunities for growth and innovation.
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="accordion-item" data-keywords="small practitioners membership individual technicians">
                    <h2 class="accordion-header" id="heading3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                            Can small practitioners be a member of NARAP?
                        </button>
                    </h2>
                    <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Absolutely. NARAP membership is designed to be inclusive and valuable for practitioners of all sizes, from individual technicians and small startups to large-scale contractors and established corporations. Our resources, training programs, and networking events are tailored to support growth at every level of the industry.
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="accordion-item" data-keywords="location based nigeria international collaboration">
                    <h2 class="accordion-header" id="heading4">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                            Where is NARAP based and is there any collaboration with international bodies/clients?
                        </button>
                    </h2>
                    <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We are based in Nigeria with operations across Africa and partnerships worldwide. We work with both local and international clients to provide global-standard services.
                        </div>
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="accordion-item" data-keywords="procurement members supply chain vendor">
                    <h2 class="accordion-header" id="heading5">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                            Do you handle procurement for Members?
                        </button>
                    </h2>
                    <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Yes. While NARAP itself is not a procurement agency, we provide our members with dedicated support and resources to streamline their supply chain. This includes access to trusted vendor networks, group purchasing discounts on tools and equipment, and guidance on sourcing quality materials—helping you save time, reduce costs, and ensure reliable supply for your projects.
                        </div>
                    </div>
                </div>
                
                <!-- FAQ 6 -->
                <div class="accordion-item" data-keywords="import equipment nigeria international manufacturers">
                    <h2 class="accordion-header" id="heading6">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                            Do you import equipment into Nigeria?
                        </button>
                    </h2>
                    <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Yes. While NARAP as an association does not directly import equipment, we support our members by facilitating connections with international manufacturers and certified distributors. We also provide guidance on import regulations, standards compliance (e.g., SON, NAFDAC), and sourcing reliable, high-efficiency HVAC&R equipment for the Nigerian market.
                        </div>
                    </div>
                </div>

                <!-- Additional FAQs -->
                <div class="accordion-item" data-keywords="membership benefits training certification">
                    <h2 class="accordion-header" id="heading7">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                            What are the benefits of NARAP membership?
                        </button>
                    </h2>
                    <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            NARAP members enjoy access to professional certification programs, technical training workshops, industry networking events, group purchasing discounts, regulatory compliance guidance, and exclusive business development opportunities. We also provide ongoing support for career advancement and business growth.
                        </div>
                    </div>
                </div>

                <div class="accordion-item" data-keywords="registration process membership application">
                    <h2 class="accordion-header" id="heading8">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                            How do I register for NARAP membership?
                        </button>
                    </h2>
                    <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            You can register for NARAP membership through our online portal. Simply visit our registration page, complete the membership application form, upload required documents, and make the membership payment. Our team will review your application and activate your membership within 48 hours.
                        </div>
                    </div>
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
                <a href="contact.php" class="btn btn-brand btn-sm">Contact Us</a>
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
