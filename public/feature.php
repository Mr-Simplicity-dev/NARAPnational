<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feature - NARAP</title>
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

    /* ===== FEATURES HEADER ===== */
    .features-header {
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-700) 100%);
        color: white;
        padding: 100px 0 80px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .features-header::before {
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

    /* ===== FEATURES SECTION ===== */
    .features-section {
        padding: 80px 0;
    }

    .search-filter-section {
        background: white;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-bottom: 60px;
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

    /* ===== FEATURE CARDS ===== */
    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--brand), var(--brand-700));
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.15);
    }

    .feature-card:hover::before {
        transform: scaleX(1);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 24px;
        background: linear-gradient(135deg, var(--brand), var(--brand-700));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        transition: all 0.3s ease;
    }

    .feature-card:hover .feature-icon {
        transform: scale(1.1);
        box-shadow: 0 10px 30px rgba(10, 127, 65, 0.3);
    }

    .feature-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 16px;
        color: var(--ink);
    }

    .feature-subtitle {
        color: var(--brand);
        font-weight: 600;
        margin-bottom: 16px;
        font-size: 1rem;
    }

    .feature-description {
        color: var(--muted);
        line-height: 1.7;
        margin-bottom: 24px;
    }

    .learn-more {
        color: var(--brand);
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .learn-more:hover {
        color: var(--brand-700);
        text-decoration: none;
        gap: 12px;
    }

    /* ===== FEATURE MODAL ===== */
    .feature-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.8);
        z-index: 1050;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .feature-modal.show {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 20px;
        max-width: 700px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        animation: modalSlideIn 0.3s ease;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-close {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        border: none;
        background: rgba(0,0,0,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .modal-close:hover {
        background: rgba(0,0,0,0.2);
    }

    .modal-header {
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-700) 100%);
        color: white;
        padding: 40px;
        text-align: center;
        position: relative;
    }

    .modal-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 20px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
    }

    .modal-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .modal-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
    }

    .modal-body {
        padding: 40px;
    }

    .feature-details {
        margin-bottom: 30px;
    }

    .details-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--brand);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .details-content {
        color: var(--muted);
        line-height: 1.7;
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

    /* ===== CTA SECTION ===== */
    .cta-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 80px 0;
        text-align: center;
    }

    .btn-brand {
        background: var(--brand);
        border-color: var(--brand);
        color: white;
        padding: 16px 32px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .btn-brand:hover {
        background: var(--brand-700);
        border-color: var(--brand-700);
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
    }

    /* ===== LOADING & EMPTY STATES ===== */
    .loading-spinner {
        text-align: center;
        padding: 60px 20px;
    }

    .no-results {
        text-align: center;
        padding: 60px 20px;
        color: var(--muted);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .features-header {
            padding: 60px 0 40px;
        }
        
        .features-section {
            padding: 40px 0;
        }
        
        .feature-card {
            padding: 30px 20px;
        }
        
        .modal-content {
            margin: 10px;
            max-height: 95vh;
        }
        
        .modal-header, .modal-body {
            padding: 30px 20px;
        }
        
        .modal-title {
            font-size: 1.5rem;
        }
    }
</style>
</head>
<body>
<!-- Features Header Section -->
<div class="features-header">
    <a href="/" class="back-link">
        <i class="fas fa-arrow-left me-2"></i>Back to Home
    </a>
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Why Choose NARAP</h1>
        <p class="lead mb-0">Discover the features and benefits that make NARAP the leading choice for HVAC&R professionals</p>
    </div>
</div>

<!-- Main Features Content -->
<div class="container features-section">
    <!-- Search and Filter Section -->
    <div class="search-filter-section">
        <div class="row align-items-center">
            <div class="col-md-8">
                <input type="text" class="form-control search-input" id="featureSearch" placeholder="Search features..." onkeyup="searchFeatures()">
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <span class="text-muted">
                    <i class="fas fa-info-circle me-2"></i>
                    <span id="featureCount">Loading features...</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Features Grid -->
    <div id="featuresContainer">
        <!-- Loading State -->
        <div class="loading-spinner" id="loadingSpinner">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading features...</span>
            </div>
            <p class="mt-2 text-muted">Loading our amazing features...</p>
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

<!-- CTA Section -->
<div class="cta-section">
    <div class="container">
        <h3 class="mb-3">Ready to Experience These Features?</h3>
        <p class="mb-4">Join NARAP today and unlock access to all our professional features and benefits.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="register.php" class="btn btn-brand">
                <i class="fas fa-user-plus me-2"></i>Become a Member
            </a>
            <a href="contact.php" class="btn btn-outline-primary">
                <i class="fas fa-phone me-2"></i>Contact Us
            </a>
        </div>
    </div>
</div>

<!-- Feature Detail Modal -->
<div class="feature-modal" id="featureModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeFeatureModal()">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="modal-header">
            <div class="modal-icon" id="modalIcon">
                <i class="fas fa-star"></i>
            </div>
            <h2 class="modal-title" id="modalTitle"></h2>
            <p class="modal-subtitle" id="modalSubtitle"></p>
        </div>
        
        <div class="modal-body" id="modalBody">
            <!-- Feature details will be inserted here -->
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    let allFeatures = [];
    let filteredFeatures = [];

    // Load features from API
    async function loadFeatures() {
        try {
            const response = await fetch('/api/features');
            
            if (!response.ok) {
                throw new Error(`API returned ${response.status}`);
            }
            
            const result = await response.json();
            allFeatures = result.data || result;
            filteredFeatures = allFeatures;
            
            renderFeatures(allFeatures);
            updateFeatureCount(allFeatures.length);
            
        } catch (error) {
            console.error('Error loading features:', error);
            renderErrorState();
        }
    }

    // Render features grid
    function renderFeatures(features) {
        const container = document.getElementById('featuresContainer');
        const spinner = document.getElementById('loadingSpinner');
        
        if (spinner) spinner.style.display = 'none';
        
        if (!features || features.length === 0) {
            container.innerHTML = `
                <div class="no-results">
                    <i class="fas fa-star fa-3x mb-3 text-muted"></i>
                    <h5>No Features Found</h5>
                    <p>Our features information will be available soon.</p>
                </div>
            `;
            return;
        }

        container.innerHTML = `
            <div class="row">
                ${features.map((feature, index) => `
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="feature-card" onclick="showFeatureDetails('${feature._id}')">
                            <div class="feature-icon">
                                <i class="${feature.icon || 'fas fa-star'}"></i>
                            </div>
                            <h3 class="feature-title">${feature.title}</h3>
                            ${feature.subtitle ? `<p class="feature-subtitle">${feature.subtitle}</p>` : ''}
                            <p class="feature-description">${truncateText(feature.description, 120)}</p>
                            <span class="learn-more">
                                Learn More <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </div>
                `).join('')}
            </div>
        `;
    }

            // Show feature details in modal
        function showFeatureDetails(featureId) {
            const feature = allFeatures.find(f => f._id === featureId);
            if (!feature) return;

            // Update modal header
            document.getElementById('modalIcon').innerHTML = `<i class="${feature.icon || 'fas fa-star'}"></i>`;
            document.getElementById('modalTitle').textContent = feature.title;
            document.getElementById('modalSubtitle').textContent = feature.subtitle || '';

            // Update modal body with detailed information
            let modalBodyContent = '';

            // Main description
            if (feature.description) {
                modalBodyContent += `
                    <div class="feature-details">
                        <h4 class="details-title">
                            <i class="fas fa-info-circle"></i>
                            About This Feature
                        </h4>
                        <div class="details-content">${feature.description}</div>
                    </div>
                `;
            }

            // Benefits section (you can expand this based on your needs)
            modalBodyContent += `
                <div class="feature-details">
                    <h4 class="details-title">
                        <i class="fas fa-check-circle"></i>
                        Key Benefits
                    </h4>
                    <div class="details-content">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Professional excellence and industry standards</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Continuous learning and development opportunities</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Networking with industry professionals</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Access to latest industry insights and trends</li>
                        </ul>
                    </div>
                </div>
            `;

            // How it works section
            modalBodyContent += `
                <div class="feature-details">
                    <h4 class="details-title">
                        <i class="fas fa-cogs"></i>
                        How It Works
                    </h4>
                    <div class="details-content">
                        <p>This feature is designed to enhance your professional experience with NARAP. Our comprehensive approach ensures you get maximum value from your membership.</p>
                    </div>
                </div>
            `;

            document.getElementById('modalBody').innerHTML = modalBodyContent;

            // Show modal
            document.getElementById('featureModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        // Close feature modal
        function closeFeatureModal() {
            document.getElementById('featureModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Search functionality
        function searchFeatures() {
            const searchTerm = document.getElementById('featureSearch').value.toLowerCase().trim();
            
            if (searchTerm === '') {
                filteredFeatures = allFeatures;
            } else {
                filteredFeatures = allFeatures.filter(feature => 
                    feature.title.toLowerCase().includes(searchTerm) ||
                    (feature.subtitle && feature.subtitle.toLowerCase().includes(searchTerm)) ||
                    (feature.description && feature.description.toLowerCase().includes(searchTerm))
                );
            }
            
            renderFeatures(filteredFeatures);
            updateFeatureCount(filteredFeatures.length);
        }

        // Update feature count display
        function updateFeatureCount(count) {
            const countEl = document.getElementById('featureCount');
            if (count === 0) {
                countEl.textContent = 'No features found';
            } else if (count === 1) {
                countEl.textContent = '1 feature available';
            } else {
                countEl.textContent = `${count} features available`;
            }
        }

        // Truncate text helper
        function truncateText(text, maxLength = 120) {
            if (!text) return '';
            return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
        }

        // Error state
        function renderErrorState() {
            const container = document.getElementById('featuresContainer');
            const spinner = document.getElementById('loadingSpinner');
            
            if (spinner) spinner.style.display = 'none';
            
            container.innerHTML = `
                <div class="no-results">
                    <i class="fas fa-exclamation-triangle fa-3x mb-3 text-warning"></i>
                    <h5>Unable to Load Features</h5>
                    <p>There was an error loading the features. Please try again later.</p>
                    <button class="btn btn-brand" onclick="loadFeatures()">
                        <i class="fas fa-refresh me-2"></i>Try Again
                    </button>
                </div>
            `;
            updateFeatureCount(0);
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            loadFeatures();
            
            // Clear search when input is emptied
            document.getElementById('featureSearch').addEventListener('input', function(e) {
                if (e.target.value === '') {
                    searchFeatures();
                }
            });
        });

        // Close modal when clicking outside
        document.getElementById('featureModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeFeatureModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeFeatureModal();
            }
        });

        // Prevent modal content clicks from closing modal
        document.querySelector('.modal-content').addEventListener('click', function(e) {
            e.stopPropagation();
        });
    </script>
</body>
</html>