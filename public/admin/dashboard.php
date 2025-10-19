<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NARAP Admin Dashboard</title>
    <link rel="icon" type="image/png" href="/uploads/slider/Narap.png"/>
    
    <!-- Modern CSS Framework -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Modern CSS Variables */
        :root {
            --brand-primary: #0a7f41;
            --brand-secondary: #086d37;
            --brand-light: #e8f5e8;
            --dark: #1a1d29;
            --dark-light: #2d3748;
            --text-primary: #2d3748;
            --text-secondary: #718096;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --gradient-brand: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-secondary) 100%);
            --gradient-glass: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        }

        /* Modern Body & Layout */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* Glassmorphism Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255, 255, 255, 0.18);
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--brand-primary);
            text-decoration: none;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            margin: 0.25rem 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.875rem 1rem;
            border-radius: 12px;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            cursor: pointer;
        }

        .nav-link:hover {
            background: rgba(10, 127, 65, 0.1);
            color: var(--brand-primary);
            transform: translateX(4px);
        }

        .nav-link.active {
            background: var(--gradient-brand);
            color: white;
            box-shadow: var(--shadow-md);
        }

        /* Dropdown styles */
        .nav-dropdown {
            margin-left: 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .nav-dropdown.show {
            max-height: 500px;
        }

        .dropdown-toggle::after {
            transition: transform 0.3s ease;
            margin-left: auto;
        }

        .dropdown-toggle[aria-expanded="true"]::after {
            transform: rotate(90deg);
        }

        .dropdown-item {
            padding: 0.75rem 1rem;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: 8px;
            margin: 0.25rem 0;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover,
        .dropdown-item.active {
            background: rgba(10, 127, 65, 0.1);
            color: var(--brand-primary);
        }

        /* Modern Main Content */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Modern Header */
        .dashboard-header {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* Modern Stats Cards */
        .stats-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-brand);
        }

        .stats-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: white;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: var(--gradient-brand);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Modern Cards */
        .modern-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 20px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .modern-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        /* Modern Buttons */
        .btn-modern {
            background: var(--gradient-brand);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        /* Dark Mode Support */
        [data-theme="dark"] {
            --text-primary: #e2e8f0;
            --text-secondary: #a0aec0;
            --border-color: #2d3748;
        }

        [data-theme="dark"] body {
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
        }

        [data-theme="dark"] .sidebar {
            background: rgba(26, 32, 44, 0.9);
        }

        [data-theme="dark"] .modern-card {
            background: rgba(45, 55, 72, 0.9);
        }

        /* Content Tabs Styling */
        .content-tab-pane {
            display: none;
        }

        .content-tab-pane.active {
            display: block;
        }

        /* Styles from dashboard copy 2 for forms */
        .nav-pills .nav-link.active { 
            background: var(--brand-primary); 
        }
        .btn-brand { 
            background: var(--brand-primary); 
            color: #fff; 
        }
        .btn-brand:hover { 
            filter: brightness(0.95); 
        }
        .img-thumb { 
            width: 84px; 
            height: 56px; 
            object-fit: cover; 
            border-radius: 8px; 
            border: 1px solid #e5e7eb; 
        }
        .sticky-actions { 
            position: sticky; 
            bottom: 0; 
            background: #fff; 
            padding: 12px 0; 
            border-top: 1px solid #eee; 
        }
        .req::after { 
            content: " *"; 
            color: #e11d48; 
            font-weight: 600; 
        }
        .table td, .table th { 
            vertical-align: middle; 
        }
        .image-upload-container { 
            border: 2px dashed #dee2e6; 
            border-radius: 8px; 
            padding: 20px; 
            text-align: center; 
            background: #f8f9fa; 
            cursor: pointer;
        }
        .image-preview { 
            max-width: 200px; 
            max-height: 150px; 
            margin: 10px auto; 
            display: none; 
        }
        .upload-placeholder { 
            color: #6c757d; 
        }
        .notification { 
            position: fixed; 
            top: 20px; 
            right: 20px; 
            z-index: 1050; 
            min-width: 300px; 
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Modern Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">
                <img src="/uploads/slider/Narap.png" alt="NARAP" width="32" height="32">
                NARAP Admin
            </a>
        </div>
        
        <div class="sidebar-nav">
            <!-- Dashboard -->
            <div class="nav-item">
                <a href="#" class="nav-link active" data-target="dashboard">
                    <i class="fas fa-chart-pie"></i>
                    Dashboard
                </a>
            </div>

            <!-- Content Management Dropdown -->
            <div class="nav-item">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                    <i class="fas fa-edit"></i>
                    Content Management
                    <i class="fas fa-chevron-right ms-auto" style="font-size: 0.8rem;"></i>
                </a>
                <div class="nav-dropdown">
                    <a href="#" class="dropdown-item" data-target="home-settings">Home Settings</a>
                    <a href="#" class="dropdown-item" data-target="sliders">Sliders</a>
                    <a href="#" class="dropdown-item" data-target="services">Services</a>
                    <a href="#" class="dropdown-item" data-target="projects">Projects</a>
                    <a href="#" class="dropdown-item" data-target="features">Features</a>
                    <a href="#" class="dropdown-item" data-target="offers">Offers</a>
                    <a href="#" class="dropdown-item" data-target="blogs">Blogs</a>
                    <a href="#" class="dropdown-item" data-target="faqs">FAQs</a>
                    <a href="#" class="dropdown-item" data-target="team">Team</a>
                </div>
            </div>

            <!-- Members Management Dropdown -->
            <div class="nav-item">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                    <i class="fas fa-users"></i>
                    Members
                    <i class="fas fa-chevron-right ms-auto" style="font-size: 0.8rem;"></i>
                </a>
                <div class="nav-dropdown">
                    <a href="#" class="dropdown-item" data-target="members-all">All Registrations</a>
                    <a href="#" class="dropdown-item" data-target="members-paid">Paid Members</a>
                    <a href="#" class="dropdown-item" data-target="members-unpaid">Unpaid Members</a>
                </div>
            </div>

            <!-- Donations -->
            <div class="nav-item">
                <a href="#" class="nav-link" data-target="donations">
                    <i class="fas fa-donate"></i>
                    Donations
                </a>
            </div>

            <!-- Settings -->
            <div class="nav-item">
                <a href="#" class="nav-link" data-target="settings">
                    <i class="fas fa-cog"></i>
                    Settings
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Modern Header -->
        <header class="dashboard-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h4 mb-0" id="pageTitle">Dashboard Overview</h1>
                    <p class="text-muted mb-0">Welcome back, Admin</p>
                </div>
                <div class="header-actions">
                    <button class="btn btn-outline-secondary" id="darkModeToggle">
                        <i class="fas fa-moon"></i>
                    </button>
                    <button class="btn btn-outline-secondary">
                        <i class="fas fa-bell"></i>
                    </button>
                    <button class="btn btn-outline-danger" id="logoutBtn">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="container-fluid p-4">
            <!-- Dashboard Content -->
            <div id="dashboard" class="content-tab-pane active">
                <!-- Modern Stats Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-card">
                            <div class="stats-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stats-number" id="totalMembers">0</div>
                            <div class="text-muted">Total Members</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-card">
                            <div class="stats-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stats-number" id="paidMembers">0</div>
                            <div class="text-muted">Paid Members</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-card">
                            <div class="stats-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stats-number" id="unpaidMembers">0</div>
                            <div class="text-muted">Pending Payments</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-card">
                            <div class="stats-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                <i class="fas fa-donate"></i>
                            </div>
                            <div class="stats-number" id="totalDonations">₦0</div>
                            <div class="text-muted">Total Donations</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions and Recent Activity -->
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="modern-card p-4">
                            <h5 class="mb-3">Recent Activity</h5>
                            <p class="text-muted">Recent system activities will appear here.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="modern-card p-4">
                            <h5 class="mb-3">Quick Actions</h5>
                            <div class="d-grid gap-2">
                                <button class="btn btn-modern">
                                    <i class="fas fa-plus me-2"></i>Add New Member
                                </button>
                                <button class="btn btn-modern">
                                    <i class="fas fa-edit me-2"></i>Edit Content
                                </button>
                                <button class="btn btn-modern">
                                    <i class="fas fa-chart-bar me-2"></i>View Reports
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- HOME SETTINGS -->
            <div id="home-settings" class="content-tab-pane">
                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">About Section</h5>
                        <form id="form-home-about" class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label req">About Title</label>
                                <input name="about.title" class="form-control" placeholder="About Us">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label req">About Headline</label>
                                <input name="about.headline" class="form-control" placeholder="Keeping you Cool, in Every Step">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Paragraphs (one per line)</label>
                                <textarea name="about.paragraphs" class="form-control" rows="4" placeholder="Line 1&#10;Line 2"></textarea>
                                <div class="form-text text-muted">Each line becomes a paragraph on the homepage.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">About Image</label>
                                <div class="image-upload-container" data-target="aboutImage">
                                    <div class="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                                        <p>Click to upload or drag and drop</p>
                                        <p class="small">PNG, JPG, GIF up to 5MB</p>
                                    </div>
                                    <img class="image-preview img-fluid rounded" id="aboutImagePreview">
                                    <input type="file" class="d-none" accept="image/*" id="aboutImageUpload">
                                    <input type="hidden" name="about.image" id="aboutImageUrl">
                                </div>
                                <div class="d-flex mt-2 gap-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-action="choose-image" data-target="aboutImage">
                                        <i class="fas fa-upload me-1"></i> Choose Image
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="aboutImage">
                                        <i class="fas fa-times me-1"></i> Clear
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 sticky-actions">
                                <button class="btn btn-modern" type="submit">Save About</button>
                                <small class="ms-2 text-muted" id="aboutStatus"></small>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">Section Titles & Subtitles</h5>
                        <form id="form-home-sections" class="row g-3">
                            <div class="col-md-4"><label class="form-label req">Services Title</label><input name="services.title" class="form-control" placeholder="What We Do"></div>
                            <div class="col-md-8"><label class="form-label">Services Subtitle</label><input name="services.subtitle" class="form-control"></div>
                            <div class="col-md-4"><label class="form-label req">Projects Title</label><input name="projects.title" class="form-control" placeholder="Our Projects"></div>
                            <div class="col-md-8"><label class="form-label">Projects Subtitle</label><input name="projects.subtitle" class="form-control"></div>
                            <div class="col-md-4"><label class="form-label req">Features Title</label><input name="features.title" class="form-control" placeholder="Why Choose Us"></div>
                            <div class="col-md-8"><label class="form-label">Features Headline</label><input name="features.headline" class="form-control"></div>
                            <div class="col-md-4"><label class="form-label">Offer Title</label><input name="offer.title" class="form-control"></div>
                            <div class="col-md-4"><label class="form-label">Blog Title</label><input name="blog.title" class="form-control" placeholder="Our Blog & News"></div>
                            <div class="col-md-4"><label class="form-label">Blog Show Count</label><input name="blog.showCount" type="number" min="1" max="12" class="form-control" placeholder="3"></div>
                            <div class="col-md-4"><label class="form-label">FAQs Title</label><input name="faqs.title" class="form-control" placeholder="Frequently Asked Questions"></div>
                            <div class="col-md-8">
                                <label class="form-label">FAQs Side Image</label>
                                <div class="image-upload-container" data-target="faqsImage">
                                    <div class="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                                        <p>Click to upload or drag and drop</p>
                                        <p class="small">PNG, JPG, GIF up to 5MB</p>
                                    </div>
                                    <img class="image-preview img-fluid rounded" id="faqsImagePreview">
                                    <input type="file" class="d-none" accept="image/*" id="faqsImageUpload">
                                    <input type="hidden" name="faqs.image" id="faqsImageUrl">
                                </div>
                                <div class="d-flex mt-2 gap-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-action="choose-image" data-target="faqsImage">
                                        <i class="fas fa-upload me-1"></i> Choose Image
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="faqsImage">
                                        <i class="fas fa-times me-1"></i> Clear
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4"><label class="form-label">Team Title</label><input name="team.title" class="form-control" placeholder="Meet Our Executive"></div>
                            <div class="col-12 sticky-actions">
                                <button class="btn btn-modern" type="submit">Save Sections</button>
                                <small class="ms-2 text-muted" id="sectionsStatus"></small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- SLIDERS -->
            <div id="sliders" class="content-tab-pane">
                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">Add / Edit Slider</h5>
                        <form id="form-slider" class="row g-3">
                            <input type="hidden" name="_id">
                            <div class="col-md-4"><label class="form-label req">Kicker</label><input name="kicker" class="form-control" placeholder="Providing Comfort"></div>
                            <div class="col-md-8"><label class="form-label req">Headline</label><input name="headline" class="form-control" placeholder="Across Sectors"></div>
                            <div class="col-12"><label class="form-label">Text</label><textarea name="text" class="form-control" rows="3"></textarea></div>
                            
                            <!-- CTA1 Fields -->
                            <div class="col-md-6"><label class="form-label">CTA1 Label</label><input name="cta1.label" class="form-control" placeholder="Watch Video"></div>
                            <div class="col-md-6"><label class="form-label">CTA1 Href</label><input name="cta1.href" class="form-control" placeholder="#video"></div>
                            
                            <!-- Video Fields -->
                            <div class="col-md-6">
                                <label class="form-label">CTA1 Video URL</label>
                                <input name="cta1.videoUrl" class="form-control" placeholder="https://youtube.com/watch?v=... or https://vimeo.com/...">
                                <div class="form-text">YouTube, Vimeo, or direct video URL</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Or Upload Video File</label>
                                <div class="image-upload-container" data-target="sliderVideo">
                                    <div class="upload-placeholder">
                                        <i class="fas fa-video fa-2x mb-2"></i>
                                        <p>Click to upload video or drag and drop</p>
                                        <p class="small">MP4, WEBM, OGV up to 50MB</p>
                                    </div>
                                    <video class="image-preview" id="sliderVideoPreview" controls style="display:none; max-width:200px; max-height:150px;"></video>
                                    <input type="file" class="d-none" accept="video/*" id="sliderVideoUpload">
                                    <input type="hidden" name="cta1.videoFile" id="sliderVideoUrl">
                                </div>
                                <div class="d-flex mt-2 gap-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-action="choose-video" data-target="sliderVideo">
                                        <i class="fas fa-upload me-1"></i> Choose Video
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-video" data-target="sliderVideo">
                                        <i class="fas fa-times me-1"></i> Clear
                                    </button>
                                </div>
                            </div>
                            
                            <!-- CTA2 Fields -->
                            <div class="col-md-6"><label class="form-label">CTA2 Label</label><input name="cta2.label" class="form-control" placeholder="Contact Us"></div>
                            <div class="col-md-6"><label class="form-label">CTA2 Href</label><input name="cta2.href" class="form-control" placeholder="#contact"></div>
                            
                            <!-- Slider Image -->
                            <div class="col-md-8">
                                <label class="form-label req">Slider Image</label>
                                <div class="image-upload-container" data-target="sliderImage">
                                    <div class="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                                        <p>Click to upload or drag and drop</p>
                                        <p class="small">PNG, JPG, GIF up to 5MB</p>
                                    </div>
                                    <img class="image-preview img-fluid rounded" id="sliderImagePreview">
                                    <input type="file" class="d-none" accept="image/*" id="sliderImageUpload">
                                    <input type="hidden" name="image" id="sliderImageUrl">
                                </div>
                                <div class="d-flex mt-2 gap-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-action="choose-image" data-target="sliderImage">
                                        <i class="fas fa-upload me-1"></i> Choose Image
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="sliderImage">
                                        <i class="fas fa-times me-1"></i> Clear
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Order Field -->
                            <div class="col-md-4"><label class="form-label">Order</label><input name="order" type="number" class="form-control" placeholder="1"></div>
                            
                            <!-- Form Actions -->
                            <div class="col-12 sticky-actions">
                                <button class="btn btn-modern" type="submit">Save Slider</button>
                                <button class="btn btn-outline-secondary" type="button" id="resetSliderForm">Reset</button>
                                <small class="ms-2 text-muted" id="sliderStatus"></small>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- All Slides Table -->
                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">All Slides</h5>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Preview</th>
                                        <th>Kicker</th>
                                        <th>Headline</th>
                                        <th>Buttons</th>
                                        <th>Video</th>
                                        <th>Order</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="list-sliders"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SERVICES -->
            <div id="services" class="content-tab-pane">
                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">Service</h5>
                        <form id="form-service" class="row g-3">
                            <input type="hidden" name="_id">
                            <div class="col-md-6"><label class="form-label req">Title</label><input name="title" class="form-control"></div>
                            <div class="col-md-6">
                                <label class="form-label">Service Image</label>
                                <div class="image-upload-container" data-target="serviceImage">
                                    <div class="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                                        <p>Click to upload or drag and drop</p>
                                        <p class="small">PNG, JPG, GIF up to 5MB</p>
                                    </div>
                                    <img class="image-preview img-fluid rounded" id="serviceImagePreview">
                                    <input type="file" class="d-none" accept="image/*" id="serviceImageUpload">
                                    <input type="hidden" name="image" id="serviceImageUrl">
                                </div>
                                <div class="d-flex mt-2 gap-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-action="choose-image" data-target="serviceImage">
                                        <i class="fas fa-upload me-1"></i> Choose Image
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="serviceImage">
                                        <i class="fas fa-times me-1"></i> Clear
                                    </button>
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
                            <div class="col-md-6"><label class="form-label">Link (optional)</label><input name="link" class="form-control" placeholder="/services#install"></div>
                            <div class="col-12 sticky-actions">
                                <button class="btn btn-modern" type="submit">Save Service</button>
                                <button class="btn btn-outline-secondary" type="button" data-reset="#form-service">Reset</button>
                                <small class="ms-2 text-muted" id="serviceStatus"></small>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">All Services</h5>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Preview</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Link</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="list-services"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add other sections similarly... -->

             <!-- PROJECTS -->
            <div id="projects" class="content-tab-pane">
                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">Project</h5>
                        <form id="form-project" class="row g-3">
                            <input type="hidden" name="_id">
                            <div class="col-md-6"><label class="form-label req">Title</label><input name="title" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label">Category</label><input name="category" class="form-control" placeholder="HVAC"></div>
                            <div class="col-md-6">
                                <label class="form-label">Project Image</label>
                                <div class="image-upload-container" data-target="projectImage">
                                    <div class="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                                        <p>Click to upload or drag and drop</p>
                                        <p class="small">PNG, JPG, GIF up to 5MB</p>
                                    </div>
                                    <img class="image-preview img-fluid rounded" id="projectImagePreview">
                                    <input type="file" class="d-none" accept="image/*" id="projectImageUpload">
                                    <input type="hidden" name="image" id="projectImageUrl">
                                </div>
                                <div class="d-flex mt-2 gap-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-action="choose-image" data-target="projectImage">
                                        <i class="fas fa-upload me-1"></i> Choose Image
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="projectImage">
                                        <i class="fas fa-times me-1"></i> Clear
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6"><label class="form-label">Link</label><input name="link" class="form-control" placeholder="/projects/slug"></div>
                            <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
                            <div class="col-12 sticky-actions">
                                <button class="btn btn-modern" type="submit">Save Project</button>
                                <button class="btn btn-outline-secondary" type="button" data-reset="#form-project">Reset</button>
                                <small class="ms-2 text-muted" id="projectStatus"></small>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">All Projects</h5>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Preview</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Link</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="list-projects"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

             <!-- FEATURES -->
            <div id="features" class="content-tab-pane">
                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">Feature</h5>
                        <form id="form-feature" class="row g-3">
                            <input type="hidden" name="_id">
                            <div class="col-md-6"><label class="form-label req">Title</label><input name="title" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label">Subtitle</label><input name="subtitle" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label">Icon (class or URL)</label><input name="icon" class="form-control" placeholder="fa-solid fa-snowflake"></div>
                            <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
                            <div class="col-12 sticky-actions">
                                <button class="btn btn-modern" type="submit">Save Feature</button>
                                <button class="btn btn-outline-secondary" type="button" data-reset="#form-feature">Reset</button>
                                <small class="ms-2 text-muted" id="featureStatus"></small>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">All Features</h5>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Icon</th>
                                        <th>Title</th>
                                        <th>Subtitle</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="list-features"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

             <!-- OFFERS -->
            <div id="offers" class="content-tab-pane">
                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">Offer</h5>
                        <form id="form-offer" class="row g-3">
                            <input type="hidden" name="_id">
                            <div class="col-md-6"><label class="form-label req">Title</label><input name="title" class="form-control"></div>
                            <div class="col-md-6">
                                <label class="form-label">Offer Image</label>
                                <div class="image-upload-container" data-target="offerImage">
                                    <div class="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                                        <p>Click to upload or drag and drop</p>
                                        <p class="small">PNG, JPG, GIF up to 5MB</p>
                                    </div>
                                    <img class="image-preview img-fluid rounded" id="offerImagePreview">
                                    <input type="file" class="d-none" accept="image/*" id="offerImageUpload">
                                    <input type="hidden" name="image" id="offerImageUrl">
                                </div>
                                <div class="d-flex mt-2 gap-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-action="choose-image" data-target="offerImage">
                                        <i class="fas fa-upload me-1"></i> Choose Image
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="offerImage">
                                        <i class="fas fa-times me-1"></i> Clear
                                    </button>
                                </div>
                            </div>
                            <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
                            <div class="col-12 sticky-actions">
                                <button class="btn btn-modern" type="submit">Save Offer</button>
                                <button class="btn btn-outline-secondary" type="button" data-reset="#form-offer">Reset</button>
                                <small class="ms-2 text-muted" id="offerStatus"></small>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">All Offers</h5>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Preview</th>
                                        <th>Title</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="list-offers"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <!-- BLOGS -->
            <div id="blogs" class="content-tab-pane">
                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">Blog</h5>
                        <form id="form-blog" class="row g-3">
                            <input type="hidden" name="_id">
                            <div class="col-md-6"><label class="form-label req">Title</label><input name="title" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label">Slug</label><input name="slug" class="form-control" placeholder="auto-generated if blank"></div>
                            <div class="col-12"><label class="form-label">Excerpt</label><textarea name="excerpt" class="form-control" rows="2"></textarea></div>
                            <div class="col-12"><label class="form-label">Content (HTML or Markdown)</label><textarea name="content" class="form-control" rows="6"></textarea></div>
                            <div class="col-md-6">
                                <label class="form-label">Blog Image</label>
                                <div class="image-upload-container" data-target="blogImage">
                                    <div class="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                                        <p>Click to upload or drag and drop</p>
                                        <p class="small">PNG, JPG, GIF up to 5MB</p>
                                    </div>
                                    <img class="image-preview img-fluid rounded" id="blogImagePreview">
                                    <input type="file" class="d-none" accept="image/*" id="blogImageUpload">
                                    <input type="hidden" name="image" id="blogImageUrl">
                                </div>
                                <div class="d-flex mt-2 gap-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-action="choose-image" data-target="blogImage">
                                        <i class="fas fa-upload me-1"></i> Choose Image
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="blogImage">
                                        <i class="fas fa-times me-1"></i> Clear
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 sticky-actions">
                                <button class="btn btn-modern" type="submit">Save Blog</button>
                                <button class="btn btn-outline-secondary" type="button" data-reset="#form-blog">Reset</button>
                                <small class="ms-2 text-muted" id="blogStatus"></small>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">All Blogs</h5>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Preview</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="list-blogs"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


          <!-- FAQS -->
            <div id="faqs" class="content-tab-pane">
                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">FAQ</h5>
                        <form id="form-faq" class="row g-3">
                            <input type="hidden" name="_id">
                            <div class="col-md-6"><label class="form-label req">Question</label><input name="question" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label">Keywords (for search)</label><input name="keywords" class="form-control" placeholder="e.g., membership benefits"></div>
                            <div class="col-12"><label class="form-label req">Answer</label><textarea name="answer" class="form-control" rows="3"></textarea></div>
                            <div class="col-12 sticky-actions">
                                <button class="btn btn-modern" type="submit">Save FAQ</button>
                                <button class="btn btn-outline-secondary" type="button" data-reset="#form-faq">Reset</button>
                                <small class="ms-2 text-muted" id="faqStatus"></small>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">All FAQs</h5>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="list-faqs"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TEAM -->
            <div id="team" class="content-tab-pane">
                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">Team Member</h5>
                        <form id="form-team" class="row g-3">
                            <input type="hidden" name="_id">
                            
                            <!-- Basic Information -->
                            <div class="col-12"><h6 class="text-primary border-bottom pb-2 mb-3">Basic Information</h6></div>
                            <div class="col-md-4"><label class="form-label req">Name</label><input name="name" class="form-control" required></div>
                            <div class="col-md-4"><label class="form-label req">Role</label><input name="role" class="form-control" required></div>
                            <div class="col-md-4"><label class="form-label">Department</label><input name="department" class="form-control" placeholder="e.g., Executive, Technical"></div>



                            <!-- Profile Image -->
                            <div class="col-12">
                                <label class="form-label">Team Member Image</label>
                                <div class="image-upload-container" data-target="teamImage">
                                    <div class="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                                        <p>Click to upload or drag and drop</p>
                                        <p class="small">PNG, JPG, GIF up to 5MB</p>
                                    </div>
                                    <img class="image-preview img-fluid rounded" id="teamImagePreview">
                                    <input type="file" class="d-none" accept="image/*" id="teamImageUpload">
                                    <input type="hidden" name="image" id="teamImageUrl">
                                </div>
                                <div class="d-flex mt-2 gap-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-action="choose-image" data-target="teamImage">
                                        <i class="fas fa-upload me-1"></i> Choose Image
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="teamImage">
                                        <i class="fas fa-times me-1"></i> Clear
                                    </button>
                                </div>
                            </div>

                            <!-- Biography -->
                            <div class="col-12">
                                <label class="form-label">Biography</label>
                                <textarea name="biography" class="form-control" rows="4" placeholder="Write a detailed biography about this team member..."></textarea>
                            </div>

                            <!-- Contact Information -->
                            <div class="col-12"><h6 class="text-primary border-bottom pb-2 mb-3 mt-4">Contact Information</h6></div>
                            <div class="col-md-6"><label class="form-label">Email</label><input name="email" type="email" class="form-control" placeholder="member@narapnational.org.ng"></div>
                            <div class="col-md-6"><label class="form-label">Phone</label><input name="phone" class="form-control" placeholder="+234 xxx xxx xxxx"></div>

                            <!-- Professional Information -->
                            <div class="col-12"><h6 class="text-primary border-bottom pb-2 mb-3 mt-4">Professional Information</h6></div>
                            <div class="col-md-6"><label class="form-label">Experience</label><input name="experience" class="form-control" placeholder="e.g., 10+ years in HVAC"></div>
                            <div class="col-md-6"><label class="form-label">Education</label><input name="education" class="form-control" placeholder="e.g., B.Sc Mechanical Engineering"></div>
                            
                            <!-- Specializations -->
                            <div class="col-12">
                                <label class="form-label">Specializations</label>
                                <input name="specializations" class="form-control" placeholder="Enter specializations separated by commas (e.g., HVAC Design, Refrigeration Systems, Energy Efficiency)">
                                <small class="form-text text-muted">Separate multiple specializations with commas</small>
                            </div>

                            <!-- Achievements -->
                            <div class="col-12">
                                <label class="form-label">Achievements</label>
                                <textarea name="achievements" class="form-control" rows="3" placeholder="Enter achievements separated by commas (e.g., Certified HVAC Professional, Best Engineer Award 2023, Published 15+ Research Papers)"></textarea>
                                <small class="form-text text-muted">Separate multiple achievements with commas</small>
                            </div>

                            <!-- Social Media -->
                            <div class="col-12"><h6 class="text-primary border-bottom pb-2 mb-3 mt-4">Social Media</h6></div>
                            <div class="col-md-4"><label class="form-label">Facebook</label><input name="facebook" class="form-control" placeholder="https://facebook.com/..."></div>
                            <div class="col-md-4"><label class="form-label">Twitter</label><input name="twitter" class="form-control" placeholder="https://twitter.com/..."></div>
                            <div class="col-md-4"><label class="form-label">LinkedIn</label><input name="linkedin" class="form-control" placeholder="https://linkedin.com/in/..."></div>
                            <div class="col-md-4"><label class="form-label">Instagram</label><input name="instagram" class="form-control" placeholder="https://instagram.com/..."></div>

                            <!-- Display Settings -->
                            <div class="col-12"><h6 class="text-primary border-bottom pb-2 mb-3 mt-4">Display Settings</h6></div>
                            <div class="col-md-6">
                                <label class="form-label">Display Order</label>
                                <input name="displayOrder" type="number" class="form-control" placeholder="0" min="0">
                                <small class="form-text text-muted">Lower numbers appear first</small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mt-4">
                                    <input name="isActive" type="checkbox" class="form-check-input" id="teamIsActive" checked>
                                    <label class="form-check-label" for="teamIsActive">Active (Show on website)</label>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="col-12 sticky-actions">
                                <button class="btn btn-modern" type="submit">Save Member</button>
                                <button class="btn btn-outline-secondary" type="button" data-reset="#form-team">Reset</button>
                                <small class="ms-2 text-muted" id="teamStatus"></small>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Team Members List -->
                <div class="modern-card">
                    <div class="card-body">
                        <h5 class="mb-3">All Team</h5>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Preview</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="list-team"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            

            <!-- MEMBERS SECTIONS -->
            <div id="members-all" class="content-tab-pane">
                <div class="modern-card">
                    <div class="card-body">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label">Search (name/email/member ID/state)</label>
                                <input id="allSearch" class="form-control" placeholder="Search…">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Filter by State:</label>
                                <select id="stateFilter" class="form-select">
                                    <option value="">All States</option>
                                    <!-- State options here -->
                                </select>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <button class="btn btn-modern" id="btnReloadAll">Reload</button>
                                <button class="btn btn-outline-secondary" id="btnExportAll">Export CSV</button>
                            </div>
                        </div>
                        <small class="text-muted d-block mt-2">Shows everyone who completed signup and has a dashboard.</small>
                    </div>
                </div>
                <div class="modern-card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Member ID</th>
                                        <th>State</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody id="list-members-all"></tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small class="text-muted" id="allCount"></small>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-secondary" id="allPrev">Prev</button>
                                <button class="btn btn-sm btn-outline-secondary" id="allNext">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add other member sections similarly... -->

            <!-- DONATIONS -->
            <div id="donations" class="content-tab-pane">
                <div class="modern-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">Donation Management</h5>
                            <div>
                                <button class="btn btn-outline-secondary btn-sm" id="exportDonations">
                                    <i class="fas fa-download"></i> Export
                                </button>
                                <button class="btn btn-modern btn-sm" id="refreshDonations">
                                    <i class="fas fa-sync-alt"></i> Refresh
                                </button>
                            </div>
                        </div>

                        <!-- Donation Statistics -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                        <i class="fas fa-donate"></i>
                                    </div>
                                    <div class="stats-number" id="totalDonationsAmount">₦0</div>
                                    <div class="text-muted">Total Raised</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="stats-number" id="totalDonors">0</div>
                                    <div class="text-muted">Total Donors</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <div class="stats-number" id="avgDonation">₦0</div>
                                    <div class="text-muted">Average Donation</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stats-card">
                                    <div class="stats-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <div class="stats-number" id="monthlyDonations">₦0</div>
                                    <div class="text-muted">This Month</div>
                                </div>
                            </div>
                        </div>

                        <!-- Donations Table -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Donor Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Reference</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="donationsTableBody">
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">
                                            <i class="fas fa-spinner fa-spin"></i> Loading donations...
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SETTINGS -->
            <div id="settings" class="content-tab-pane">
                <div class="modern-card p-4">
                    <h4>Settings</h4>
                    <p class="text-muted">System configuration and preferences</p>
                    <!-- Settings content will go here -->
                </div>
            </div>
        </div>
    </main>

    <!-- Notification Area -->
    <div id="notificationArea" class="notification"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    // Dark mode toggle
    document.getElementById('darkModeToggle').addEventListener('click', function() {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
    });

    // Load saved theme
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);

    // Navigation handling
    function showContent(targetId, linkElement) {
        // Hide all content panes
        document.querySelectorAll('.content-tab-pane').forEach(pane => {
            pane.classList.remove('active');
        });
        
        // Show target pane
        const targetPane = document.getElementById(targetId);
        if (targetPane) {
            targetPane.classList.add('active');
            
            // Update page title
            const pageTitle = document.getElementById('pageTitle');
            if (linkElement.classList.contains('dropdown-item')) {
                const parentSection = linkElement.closest('.nav-item').querySelector('.nav-link').textContent.trim();
                pageTitle.textContent = linkElement.textContent.trim() + ' - ' + parentSection;
            } else {
                pageTitle.textContent = linkElement.textContent.trim();
            }
        }
    }

    // Handle main nav links (Dashboard, Donations, Settings)
    document.querySelectorAll('.nav-link:not(.dropdown-toggle)').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all nav items
            document.querySelectorAll('.nav-link').forEach(nav => nav.classList.remove('active'));
            document.querySelectorAll('.dropdown-item').forEach(item => item.classList.remove('active'));
            
            // Add active class to clicked item
            this.classList.add('active');
            
            const target = this.getAttribute('data-target');
            if (target) {
                showContent(target, this);
            }
        });
    });

    // Handle dropdown items (Content Management and Members items)
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Remove active class from all nav items
            document.querySelectorAll('.nav-link').forEach(nav => nav.classList.remove('active'));
            document.querySelectorAll('.dropdown-item').forEach(dropdownItem => dropdownItem.classList.remove('active'));
            
            // Add active class to clicked dropdown item and its parent nav link
            this.classList.add('active');
            const parentNav = this.closest('.nav-item').querySelector('.nav-link');
            parentNav.classList.add('active');
            
            const target = this.getAttribute('data-target');
            if (target) {
                showContent(target, this);
            }
        });
    });

    // Handle dropdown toggle (just for opening/closing dropdown, not navigation)
    document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const dropdown = this.nextElementSibling;
            dropdown.classList.toggle('show');
            
            // Rotate chevron icon
            const chevron = this.querySelector('.fa-chevron-right');
            if (chevron) {
                chevron.style.transform = dropdown.classList.contains('show') ? 'rotate(90deg)' : 'rotate(0deg)';
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.nav-item')) {
            document.querySelectorAll('.nav-dropdown').forEach(dropdown => {
                dropdown.classList.remove('show');
            });
            document.querySelectorAll('.fa-chevron-right').forEach(chevron => {
                chevron.style.transform = 'rotate(0deg)';
            });
        }
    });

    // Initialize with dashboard active
    document.addEventListener('DOMContentLoaded', function() {
        const dashboardLink = document.querySelector('.nav-link[data-target="dashboard"]');
        if (dashboardLink) {
            dashboardLink.classList.add('active');
            showContent('dashboard', dashboardLink);
        }
    });
</script>
    <script src="/admin/admin.js"></script>
</body>
</html>