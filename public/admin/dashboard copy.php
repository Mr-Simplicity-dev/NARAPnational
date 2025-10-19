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
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* Enhanced CSS Variables */
    :root {
        --brand-primary: #0a7f41;
        --brand-secondary: #086d37;
        --brand-light: #e8f5e8;
        --brand-lighter: #f0f9f4;
        --dark: #1a1d29;
        --dark-light: #2d3748;
        --text-primary: #2d3748;
        --text-secondary: #718096;
        --text-muted: #a0aec0;
        --border-color: #e2e8f0;
        --border-light: #f1f5f9;
        --bg-white: #ffffff;
        --bg-light: #f8fafc;
        --bg-lighter: #f1f5f9;
        --shadow-xs: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        --gradient-brand: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-secondary) 100%);
        --gradient-glass: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        --gradient-subtle: linear-gradient(135deg, rgba(10,127,65,0.05) 0%, rgba(8,109,55,0.02) 100%);
        --border-radius-sm: 8px;
        --border-radius-md: 12px;
        --border-radius-lg: 16px;
        --border-radius-xl: 20px;
    }

    /* Enhanced Body & Layout */
    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        color: var(--text-primary);
        overflow-x: hidden;
        font-size: 14px;
        line-height: 1.5;
    }

    /* Enhanced Sidebar */
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
        border-radius: var(--border-radius-md);
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
        border-radius: var(--border-radius-sm);
        margin: 0.25rem 0;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover,
    .dropdown-item.active {
        background: rgba(10, 127, 65, 0.1);
        color: var(--brand-primary);
    }

    /* Enhanced Main Content */
    .main-content {
        margin-left: 280px;
        min-height: 100vh;
        transition: all 0.3s ease;
    }

    /* Enhanced Header */
    .dashboard-header {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--border-color);
        padding: 1.5rem 2rem;
        position: sticky;
        top: 0;
        z-index: 999;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    /* ENHANCED CONTENT STYLING - This is the key improvement */
    
    /* Professional Content Container */
    .content-container {
        padding: 2rem;
        background: transparent;
    }

    /* Modern Stats Cards */
    .stats-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--border-radius-xl);
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
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
        box-shadow: var(--shadow-xl);
        border-color: rgba(10, 127, 65, 0.2);
    }

    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: var(--border-radius-lg);
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

    /* Enhanced Modern Cards */
    .modern-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--border-radius-xl);
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .modern-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
        border-color: rgba(10, 127, 65, 0.1);
    }

    .modern-card .card-body {
        padding: 2rem;
    }

    /* Enhanced Card Headers */
    .modern-card h5,
    .modern-card h6 {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.75rem;
    }

    .modern-card h5::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: var(--gradient-brand);
        border-radius: 2px;
    }

    /* Enhanced Form Styling */
    .form-control {
        border: 2px solid var(--border-light);
        border-radius: var(--border-radius-md);
        padding: 0.75rem 1rem;
        font-size: 14px;
        transition: all 0.3s ease;
        background: var(--bg-white);
    }

    .form-control:focus {
        border-color: var(--brand-primary);
        box-shadow: 0 0 0 3px rgba(10, 127, 65, 0.1);
        background: var(--bg-white);
    }

    .form-label {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        font-size: 14px;
    }

    .form-select {
        border: 2px solid var(--border-light);
        border-radius: var(--border-radius-md);
        padding: 0.75rem 1rem;
        background: var(--bg-white);
        transition: all 0.3s ease;
    }

    .form-select:focus {
        border-color: var(--brand-primary);
        box-shadow: 0 0 0 3px rgba(10, 127, 65, 0.1);
    }

    /* Enhanced Buttons */
    .btn-modern {
        background: var(--gradient-brand);
        border: none;
        border-radius: var(--border-radius-md);
        padding: 0.875rem 1.75rem;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        font-size: 14px;
        box-shadow: var(--shadow-sm);
    }

    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: white;
        filter: brightness(1.05);
    }

    .btn-outline-modern {
        border: 2px solid var(--brand-primary);
        border-radius: var(--border-radius-md);
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        color: var(--brand-primary);
        background: transparent;
        transition: all 0.3s ease;
    }

    .btn-outline-modern:hover {
        background: var(--brand-primary);
        color: white;
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
    }

    /* Enhanced Tables */
    .table-modern {
        background: var(--bg-white);
        border-radius: var(--border-radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-xs);
        border: 1px solid var(--border-light);
    }

    .table-modern thead th {
        background: var(--gradient-subtle);
        border: none;
        padding: 1rem;
        font-weight: 600;
        color: var(--text-primary);
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-modern tbody td {
        border: none;
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--border-light);
    }

    .table-modern tbody tr:hover {
        background: var(--brand-lighter);
    }

    .table-modern tbody tr:last-child td {
        border-bottom: none;
    }

    /* Enhanced Image Upload */
    .image-upload-container {
        border: 2px dashed var(--border-color);
        border-radius: var(--border-radius-lg);
        padding: 2rem;
        text-align: center;
        background: var(--bg-lighter);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .image-upload-container:hover {
        border-color: var(--brand-primary);
        background: var(--brand-lighter);
    }

    .image-preview {
        max-width: 200px;
        max-height: 150px;
        margin: 10px auto;
        display: none;
        border-radius: var(--border-radius-md);
        box-shadow: var(--shadow-sm);
    }

    .upload-placeholder {
        color: var(--text-muted);
    }

    /* Enhanced Form Sections */
    .form-section {
        background: var(--bg-white);
        border-radius: var(--border-radius-lg);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-light);
    }

    .form-section h6 {
        color: var(--brand-primary);
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--brand-lighter);
    }

    /* Enhanced Sticky Actions */
    .sticky-actions {
        position: sticky;
        bottom: 0;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 1.5rem 0;
        border-top: 1px solid var(--border-light);
        border-radius: var(--border-radius-lg) var(--border-radius-lg) 0 0;
        margin-top: 2rem;
    }

    /* Enhanced Notifications */
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1050;
        min-width: 300px;
    }

    /* Enhanced Badges */
    .badge {
        border-radius: var(--border-radius-sm);
        font-weight: 500;
        padding: 0.375rem 0.75rem;
    }

    /* Enhanced Pagination */
    .pagination .page-link {
        border: 2px solid var(--border-light);
        color: var(--text-primary);
        padding: 0.5rem 0.75rem;
        border-radius: var(--border-radius-sm);
        margin: 0 2px;
    }

    .pagination .page-link:hover {
        background: var(--brand-lighter);
        border-color: var(--brand-primary);
        color: var(--brand-primary);
    }

    .pagination .page-item.active .page-link {
        background: var(--gradient-brand);
        border-color: var(--brand-primary);
    }

    /* Enhanced Content Tab Panes */
    .content-tab-pane {
        display: none;
        animation: fadeIn 0.3s ease-in-out;
    }

    .content-tab-pane.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Enhanced Search and Filter Section */
    .filter-section {
        background: rgba(255, 255, 255, 0.9);
        border-radius: var(--border-radius-lg);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-light);
        box-shadow: var(--shadow-xs);
    }

    /* Enhanced Statistics Section */
    .stats-section {
        margin-bottom: 2rem;
    }

    /* Enhanced Quick Actions */
    .quick-actions {
        background: var(--gradient-subtle);
        border-radius: var(--border-radius-lg);
        padding: 1.5rem;
    }

    /* Required field indicator */
    .req::after {
        content: " *";
        color: #e11d48;
        font-weight: 600;
    }

    /* Enhanced responsive design */
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

        .content-container {
            padding: 1rem;
        }

        .dashboard-header {
            padding: 1rem;
        }

        .stats-card {
            padding: 1.5rem;
        }

        .modern-card .card-body {
            padding: 1.5rem;
        }
    }

    /* Dark mode enhancements */
    [data-theme="dark"] {
        --text-primary: #e2e8f0;
        --text-secondary: #a0aec0;
        --border-color: #2d3748;
        --bg-white: #1a202c;
       --bg-light: #2d3748; 
       --bg-lighter: #374151; 
       --border-light: #374151; 
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

    [data-theme="dark"] .stats-card {
        background: rgba(45, 55, 72, 0.9);
    }

    [data-theme="dark"] .form-control {
        background: var(--bg-light);
        border-color: var(--border-color);
        color: var(--text-primary);
    }

    [data-theme="dark"] .table-modern {
        background: var(--bg-white);
    }

    [data-theme="dark"] .table-modern tbody tr:hover {
        background: var(--bg-light);
    }
</style>
</head>
<body>
<!-- Enhanced Sidebar -->
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

<!-- Enhanced Main Content -->
<main class="main-content">
    <!-- Enhanced Header -->
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

    <!-- Enhanced Content Area -->
    <div class="content-container">
        <!-- Dashboard Content -->
        <div id="dashboard" class="content-tab-pane active">
            <!-- Enhanced Stats Cards -->
            <div class="stats-section">
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
            </div>

            <!-- Enhanced Quick Actions and Recent Activity -->
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="modern-card">
                        <div class="card-body">
                            <h5>Recent Activity</h5>
                            <p class="text-muted">Recent system activities will appear here.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="modern-card">
                        <div class="card-body">
                            <h5>Quick Actions</h5>
                            <div class="d-grid gap-3">
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
        </div>

        <!-- Enhanced HOME SETTINGS -->
        <div id="home-settings" class="content-tab-pane">
            <div class="modern-card">
                <div class="card-body">
                    <h5>About Section</h5>
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
                                <button type="button" class="btn btn-outline-modern btn-sm" data-action="choose-image" data-target="aboutImage">
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
                    <h5>Section Titles & Subtitles</h5>
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
                                <button type="button" class="btn btn-outline-modern btn-sm" data-action="choose-image" data-target="faqsImage">
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

        <!-- Enhanced SLIDERS -->
        <div id="sliders" class="content-tab-pane">
            <div class="modern-card">
                <div class="card-body">
                    <h5>Add / Edit Slider</h5>
                    <form id="form-slider" class="row g-3">
                        <input type="hidden" name="_id">
                        
                        <div class="form-section">
                            <h6>Basic Information</h6>
                            <div class="row g-3">
                                <div class="col-md-4"><label class="form-label req">Kicker</label><input name="kicker" class="form-control" placeholder="Providing Comfort"></div>
                                <div class="col-md-8"><label class="form-label req">Headline</label><input name="headline" class="form-control" placeholder="Across Sectors"></div>
                                <div class="col-12"><label class="form-label">Text</label><textarea name="text" class="form-control" rows="3"></textarea></div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h6>Call-to-Action Buttons</h6>
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">CTA1 Label</label><input name="cta1.label" class="form-control" placeholder="Watch Video"></div>
                                <div class="col-md-6"><label class="form-label">CTA1 Href</label><input name="cta1.href" class="form-control" placeholder="#video"></div>
                                <div class="col-md-6"><label class="form-label">CTA2 Label</label><input name="cta2.label" class="form-control" placeholder="Contact Us"></div>
                                <div class="col-md-6"><label class="form-label">CTA2 Href</label><input name="cta2.href" class="form-control" placeholder="#contact"></div>
                            </div>
                        </div>

                        <div class="form-section">
    <h6>Video Configuration</h6>
    <div class="row g-3">
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
                <button type="button" class="btn btn-outline-modern btn-sm" data-action="choose-video" data-target="sliderVideo">
                    <i class="fas fa-upload me-1"></i> Choose Video
                </button>
                <button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-video" data-target="sliderVideo">
                    <i class="fas fa-times me-1"></i> Clear
                </button>
            </div>
        </div>
    </div>
</div>

<div class="form-section">
    <h6>Slider Image & Order</h6>
    <div class="row g-3">
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
                <button type="button" class="btn btn-outline-modern btn-sm" data-action="choose-image" data-target="sliderImage">
                    <i class="fas fa-upload me-1"></i> Choose Image
                </button>
                <button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="sliderImage">
                    <i class="fas fa-times me-1"></i> Clear
                </button>
            </div>
        </div>
        <div class="col-md-4"><label class="form-label">Order</label><input name="order" type="number" class="form-control" placeholder="1"></div>
    </div>
</div>

                        <div class="sticky-actions">
                            <button class="btn btn-modern" type="submit">Save Slider</button>
                            <button class="btn btn-outline-secondary" type="button" id="resetSliderForm">Reset</button>
                            <small class="ms-2 text-muted" id="sliderStatus"></small>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Enhanced All Slides Table -->
            <div class="modern-card">
                <div class="card-body">
                    <h5>All Slides</h5>
                    <div class="table-responsive">
                        <table class="table table-modern align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Preview</th>
                                    <th>Kicker</th>
                                    <th>Headline</th>
                                    <th>Buttons</th>
                                    <th>Video</th>
                                    <th>Order</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="list-sliders"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced SERVICES -->
        <div id="services" class="content-tab-pane">
            <div class="modern-card">
                <div class="card-body">
                    <h5>Service Management</h5>
                    <form id="form-service" class="row g-3">
                        <input type="hidden" name="_id">
                        
                        <div class="form-section">
                            <h6>Service Information</h6>
                            <div class="row g-3">
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
                                        <button type="button" class="btn btn-outline-modern btn-sm" data-action="choose-image" data-target="serviceImage">
                                            <i class="fas fa-upload me-1"></i> Choose Image
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="serviceImage">
                                            <i class="fas fa-times me-1"></i> Clear
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
                                <div class="col-md-6"><label class="form-label">Link (optional)</label><input name="link" class="form-control" placeholder="/services#install"></div>
                            </div>
                        </div>

                        <div class="sticky-actions">
                            <button class="btn btn-modern" type="submit">Save Service</button>
                            <button class="btn btn-outline-secondary" type="button" data-reset="#form-service">Reset</button>
                            <small class="ms-2 text-muted" id="serviceStatus"></small>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="modern-card">
                <div class="card-body">
                    <h5>All Services</h5>
                    <div class="table-responsive">
                        <table class="table table-modern align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Preview</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Link</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="list-services"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced PROJECTS -->
        <div id="projects" class="content-tab-pane">
            <div class="modern-card">
                <div class="card-body">
                    <h5>Project Management</h5>
                    <form id="form-project" class="row g-3">
                        <input type="hidden" name="_id">
                        
                        <div class="form-section">
                            <h6>Project Information</h6>
                            <div class="row g-3">
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
                                        <button type="button" class="btn btn-outline-modern btn-sm" data-action="choose-image" data-target="projectImage">
                                            <i class="fas fa-upload me-1"></i> Choose Image
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="projectImage">
                                            <i class="fas fa-times me-1"></i> Clear
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6"><label class="form-label">Link</label><input name="link" class="form-control" placeholder="/projects/slug"></div>
                                <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
                            </div>
                        </div>

                        <div class="sticky-actions">
                            <button class="btn btn-modern" type="submit">Save Project</button>
                            <button class="btn btn-outline-secondary" type="button" data-reset="#form-project">Reset</button>
                            <small class="ms-2 text-muted" id="projectStatus"></small>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="modern-card">
                <div class="card-body">
                    <h5>All Projects</h5>
                    <div class="table-responsive">
                        <table class="table table-modern align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Preview</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Link</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="list-projects"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced FEATURES -->
        <div id="features" class="content-tab-pane">
            <div class="modern-card">
                <div class="card-body">
                    <h5>Feature Management</h5>
                    <form id="form-feature" class="row g-3">
                        <input type="hidden" name="_id">
                        
                        <div class="form-section">
                            <h6>Feature Information</h6>
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label req">Title</label><input name="title" class="form-control"></div>
                                <div class="col-md-6"><label class="form-label">Subtitle</label><input name="subtitle" class="form-control"></div>
                                <div class="col-md-6"><label class="form-label">Icon (class or URL)</label><input name="icon" class="form-control" placeholder="fa-solid fa-snowflake"></div>
                                <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
                            </div>
                        </div>

                        <div class="sticky-actions">
                            <button class="btn btn-modern" type="submit">Save Feature</button>
                            <button class="btn btn-outline-secondary" type="button" data-reset="#form-feature">Reset</button>
                            <small class="ms-2 text-muted" id="featureStatus"></small>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="modern-card">
                <div class="card-body">
                    <h5>All Features</h5>
                    <div class="table-responsive">
                        <table class="table table-modern align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Icon</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="list-features"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced OFFERS -->
        <div id="offers" class="content-tab-pane">
            <div class="modern-card">
                <div class="card-body">
                    <h5>Offer Management</h5>
                    <form id="form-offer" class="row g-3">
                        <input type="hidden" name="_id">
                        
                        <div class="form-section">
                            <h6>Offer Information</h6>
                            <div class="row g-3">
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
                                        <button type="button" class="btn btn-outline-modern btn-sm" data-action="choose-image" data-target="offerImage">
                                            <i class="fas fa-upload me-1"></i> Choose Image
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="offerImage">
                                            <i class="fas fa-times me-1"></i> Clear
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
                            </div>
                        </div>

                        <div class="sticky-actions">
                            <button class="btn btn-modern" type="submit">Save Offer</button>
                            <button class="btn btn-outline-secondary" type="button" data-reset="#form-offer">Reset</button>
                            <small class="ms-2 text-muted" id="offerStatus"></small>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="modern-card">
                <div class="card-body">
                    <h5>All Offers</h5>
                    <div class="table-responsive">
                        <table class="table table-modern align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Preview</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="list-offers"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced BLOGS -->
        <div id="blogs" class="content-tab-pane">
            <div class="modern-card">
                <div class="card-body">
                    <h5>Blog Management</h5>
                    <form id="form-blog" class="row g-3">
    <input type="hidden" name="_id">
    
    <div class="form-section">
        <h6>Blog Information</h6>
        <div class="row g-3">
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
                    <button type="button" class="btn btn-outline-modern btn-sm" data-action="choose-image" data-target="blogImage">
                        <i class="fas fa-upload me-1"></i> Choose Image
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="blogImage">
                        <i class="fas fa-times me-1"></i> Clear
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Category</label>
                <input name="category" class="form-control" placeholder="e.g., News, Updates, Technical">
            </div>
            <div class="col-md-6">
                <label class="form-label">Author</label>
                <input name="author" class="form-control" placeholder="Author name">
            </div>
            <div class="col-md-6">
                <label class="form-label">Tags</label>
                <input name="tags" class="form-control" placeholder="Separate tags with commas">
                <small class="form-text text-muted">e.g., HVAC, refrigeration, news</small>
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="draft">Draft</option>
                    <option value="published" selected>Published</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
            <div class="col-md-6">
                <div class="form-check mt-4">
                    <input name="featured" type="checkbox" class="form-check-input" id="blogFeatured">
                    <label class="form-check-label" for="blogFeatured">Featured Article</label>
                </div>
            </div>
        </div>
    </div>

    <div class="sticky-actions">
        <button class="btn btn-modern" type="submit">Save Blog</button>
        <button class="btn btn-outline-secondary" type="button" data-reset="#form-blog">Reset</button>
        <small class="ms-2 text-muted" id="blogStatus"></small>
    </div>
</form>
                </div>
            </div>
            
            <div class="modern-card">
                <div class="card-body">
                    <h5>All Blogs</h5>
                    <div class="table-responsive">
                        <table class="table table-modern align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Preview</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="list-blogs"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced FAQS -->
        <div id="faqs" class="content-tab-pane">
            <div class="modern-card">
                <div class="card-body">
                    <h5>FAQ Management</h5>
                    <form id="form-faq" class="row g-3">
                        <input type="hidden" name="_id">
                        
                        <div class="form-section">
                            <h6>FAQ Information</h6>
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label req">Question</label><input name="question" class="form-control"></div>
                                <div class="col-md-6"><label class="form-label">Keywords (for search)</label><input name="keywords" class="form-control" placeholder="e.g., membership benefits"></div>
                                <div class="col-12"><label class="form-label req">Answer</label><textarea name="answer" class="form-control" rows="3"></textarea></div>
                            </div>
                        </div>

                        <div class="sticky-actions">
                            <button class="btn btn-modern" type="submit">Save FAQ</button>
                            <button class="btn btn-outline-secondary" type="button" data-reset="#form-faq">Reset</button>
                            <small class="ms-2 text-muted" id="faqStatus"></small>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="modern-card">
                <div class="card-body">
                    <h5>All FAQs</h5>
                    <div class="table-responsive">
                        <table class="table table-modern align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="list-faqs"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced TEAM -->
        <div id="team" class="content-tab-pane">
            <div class="modern-card">
                <div class="card-body">
                    <h5>Team Member Management</h5>
                    <form id="form-team" class="row g-3">
                        <input type="hidden" name="_id">
                        
                        <!-- Basic Information -->
                        <div class="form-section">
                            <h6>Basic Information</h6>
                            <div class="row g-3">
                                <div class="col-md-4"><label class="form-label req">Name</label><input name="name" class="form-control" required></div>
                                <div class="col-md-4"><label class="form-label req">Role</label><input name="role" class="form-control" required></div>
                                <div class="col-md-4"><label class="form-label">Department</label><input name="department" class="form-control" placeholder="e.g., Executive, Technical"></div>
                            </div>
                        </div>

                        <!-- Profile Image -->
                        <div class="form-section">
                            <h6>Profile Image</h6>
                            <div class="row g-3">
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
                                        <button type="button" class="btn btn-outline-modern btn-sm" data-action="choose-image" data-target="teamImage">
                                            <i class="fas fa-upload me-1"></i> Choose Image
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="teamImage">
                                            <i class="fas fa-times me-1"></i> Clear
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Biography -->
                        <div class="form-section">
                            <h6>Biography</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Biography</label>
                                    <textarea name="biography" class="form-control" rows="4" placeholder="Write a detailed biography about this team member..."></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="form-section">
                            <h6>Contact Information</h6>
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">Email</label><input name="email" type="email" class="form-control" placeholder="member@narapnational.org.ng"></div>
                                <div class="col-md-6"><label class="form-label">Phone</label><input name="phone" class="form-control" placeholder="+234 xxx xxx xxxx"></div>
                            </div>
                        </div>

                        <!-- Professional Information -->
                        <div class="form-section">
                            <h6>Professional Information</h6>
                            <div class="row g-3">
                                <div class="col-md-6"><label class="form-label">Experience</label><input name="experience" class="form-control" placeholder="e.g., 10+ years in HVAC"></div>
                                <div class="col-md-6"><label class="form-label">Education</label><input name="education" class="form-control" placeholder="e.g., B.Sc Mechanical Engineering"></div>
                                <div class="col-12">
                                    <label class="form-label">Specializations</label>
                                    <input name="specializations" class="form-control" placeholder="Enter specializations separated by commas (e.g., HVAC Design, Refrigeration Systems, Energy Efficiency)">
                                    <small class="form-text text-muted">Separate multiple specializations with commas</small>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Achievements</label>
                                    <textarea name="achievements" class="form-control" rows="3" placeholder="Enter achievements separated by commas (e.g., Certified HVAC Professional, Best Engineer Award 2023, Published 15+ Research Papers)"></textarea>
                                    <small class="form-text text-muted">Separate multiple achievements with commas</small>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="form-section">
                            <h6>Social Media</h6>
                            <div class="row g-3">
                                <div class="col-md-3"><label class="form-label">Facebook</label><input name="facebook" class="form-control" placeholder="https://facebook.com/..."></div>
                                <div class="col-md-3"><label class="form-label">Twitter</label><input name="twitter" class="form-control" placeholder="https://twitter.com/..."></div>
                                <div class="col-md-3"><label class="form-label">LinkedIn</label><input name="linkedin" class="form-control" placeholder="https://linkedin.com/in/..."></div>
                                <div class="col-md-3"><label class="form-label">Instagram</label><input name="instagram" class="form-control" placeholder="https://instagram.com/..."></div>
                            </div>
                        </div>

                        <!-- Display Settings -->
                        <div class="form-section">
                            <h6>Display Settings</h6>
                            <div class="row g-3">
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
                            </div>
                        </div>

                        <div class="sticky-actions">
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
                    <h5>All Team Members</h5>
                    <div class="table-responsive">
                        <table class="table table-modern align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Preview</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="list-team"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced MEMBERS SECTIONS -->
        <div id="members-all" class="content-tab-pane">
            <div class="filter-section">
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
                        <button class="btn btn-outline-modern" id="btnExportAll">Export CSV</button>
                    </div>
                </div>
                <small class="text-muted d-block mt-2">Shows everyone who completed signup and has a dashboard.</small>
            </div>
            
            <div class="modern-card">
                <div class="card-body">
                    <h5>All Registrations</h5>
                    <div class="table-responsive">
                        <table class="table table-modern align-middle">
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
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted" id="allCount"></small>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-secondary" id="allPrev">Prev</button>
                            <button class="btn btn-sm btn-outline-secondary" id="allNext">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced PAID MEMBERS -->
<div id="members-paid" class="content-tab-pane">
    <div class="filter-section">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Search (name/email/member ID/state)</label>
                <input id="paidSearch" class="form-control" placeholder="Search…">
            </div>
            <div class="col-md-3">
                <label class="form-label">Filter by State:</label>
                <select id="stateFilterPaid" class="form-select">
                    <option value="">All States</option>
                    <!-- State options here -->
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Count as "Paid" if…</label>
                <div class="d-flex gap-3 flex-wrap">
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="paidFeeMembership" checked><label class="form-check-label" for="paidFeeMembership">Membership fee</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="paidFeeCertificate" checked><label class="form-check-label" for="paidFeeCertificate">Certificate</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="paidFeeIdcard" checked><label class="form-check-label" for="paidFeeIdcard">ID card</label></div>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" id="paidLogicAll">
                    <label class="form-check-label" for="paidLogicAll">Require <strong>all selected</strong> fees (unchecked = any one)</label>
                </div>
            </div>
            <div class="col-md-2 text-md-end">
                <button class="btn btn-modern" id="btnReloadPaid">Reload</button>
                <button class="btn btn-outline-modern" id="btnExportPaid">Export CSV</button>
            </div>
        </div>
    </div>
    
    <div class="modern-card">
        <div class="card-body">
            <h5>Paid Members</h5>
            <div class="table-responsive">
                <table class="table table-modern align-middle">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Member ID</th>
                            <th>State</th>
                            <th>Paid</th>
                        </tr>
                    </thead>
                    <tbody id="list-members-paid"></tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted" id="paidCount"></small>
                <div class="btn-group">
                    <button class="btn btn-sm btn-outline-secondary" id="paidPrev">Prev</button>
                    <button class="btn btn-sm btn-outline-secondary" id="paidNext">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

           <!-- Enhanced UNPAID MEMBERS -->
<div id="members-unpaid" class="content-tab-pane">
    <div class="filter-section">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Search (name/email/member ID/state)</label>
                <input id="unpaidSearch" class="form-control" placeholder="Search…">
            </div>
            <div class="col-md-4">
                <label class="form-label">Filter by State:</label>
                <select id="stateFilterUnpaid" class="form-select">
                    <option value="">All States</option>
                    <!-- State options here -->
                </select>
            </div>
            <div class="col-md-4 text-md-end">
                <button class="btn btn-modern" id="btnReloadUnpaid">Reload</button>
                <button class="btn btn-outline-modern" id="btnExportUnpaid">Export CSV</button>
            </div>
        </div>
        <small class="text-muted d-block mt-2">Shows users who completed signup (have dashboards) but have not paid membership, certificate, or ID card fees.</small>
    </div>
    
    <div class="modern-card">
        <div class="card-body">
            <h5>Unpaid Members</h5>
            <div class="table-responsive">
                <table class="table table-modern align-middle">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Member ID</th>
                            <th>State</th>
                            <th>Unpaid Fees</th>
                        </tr>
                    </thead>
                    <tbody id="list-members-unpaid"></tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted" id="unpaidCount"></small>
                <div class="btn-group">
                    <button class="btn btn-sm btn-outline-secondary" id="unpaidPrev">Prev</button>
                    <button class="btn btn-sm btn-outline-secondary" id="unpaidNext">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>


            <!-- Enhanced DONATIONS -->
            <div id="donations" class="content-tab-pane">
                <div class="modern-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">Donation Management</h5>
                            <div>
                                <button class="btn btn-outline-modern btn-sm" id="exportDonations">
                                    <i class="fas fa-download"></i> Export
                                </button>
                                <button class="btn btn-modern btn-sm" id="refreshDonations">
                                    <i class="fas fa-sync-alt"></i> Refresh
                                </button>
                            </div>
                        </div>

                        <!-- Enhanced Donation Statistics -->
                        <div class="stats-section">
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
                        </div>

                        <!-- Enhanced Donations Table -->
                        <div class="table-responsive">
                            <table class="table table-modern table-hover">
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

            <!-- Enhanced SETTINGS -->
            <div id="settings" class="content-tab-pane">
                <div class="modern-card">
                    <div class="card-body">
                        <h5>System Settings</h5>
                        <div class="form-section">
                            <h6>General Configuration</h6>
                            <p class="text-muted">System configuration and preferences will be available here.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Enhanced Notification Area -->
    <div id="notificationArea" class="notification"></div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    // Enhanced Dark mode toggle
    document.getElementById('darkModeToggle').addEventListener('click', function() {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        
        // Update icon
        const icon = this.querySelector('i');
        icon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
    });

    // Load saved theme
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
    const themeIcon = document.querySelector('#darkModeToggle i');
    if (themeIcon) {
        themeIcon.className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
    }

    // Enhanced Navigation handling
    function showContent(targetId, linkElement) {
        // Hide all content panes with fade effect
        document.querySelectorAll('.content-tab-pane').forEach(pane => {
            pane.classList.remove('active');
        });
        
        // Show target pane with fade effect
        const targetPane = document.getElementById(targetId);
        if (targetPane) {
            setTimeout(() => {
                targetPane.classList.add('active');
            }, 50);
            
            // Update page title with enhanced formatting
            const pageTitle = document.getElementById('pageTitle');
            if (linkElement.classList.contains('dropdown-item')) {
                const parentSection = linkElement.closest('.nav-item').querySelector('.nav-link').textContent.trim();
                pageTitle.textContent = `${linkElement.textContent.trim()} - ${parentSection}`;
            } else {
                pageTitle.textContent = linkElement.textContent.trim();
            }
        }
    }

    // Enhanced main nav links handling
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

    // Enhanced dropdown items handling
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

    // Enhanced dropdown toggle handling
    document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const dropdown = this.nextElementSibling;
            dropdown.classList.toggle('show');
            
            // Rotate chevron icon with smooth animation
            const chevron = this.querySelector('.fa-chevron-right');
            if (chevron) {
                chevron.style.transform = dropdown.classList.contains('show') ? 'rotate(90deg)' : 'rotate(0deg)';
            }
        });
    });

    // Enhanced outside click handling
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

    // Enhanced mobile menu toggle
    function toggleMobileMenu() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('active');
    }

    // Add mobile menu button for small screens
    if (window.innerWidth <= 768) {
        const header = document.querySelector('.dashboard-header .d-flex');
        const menuButton = document.createElement('button');
        menuButton.className = 'btn btn-outline-secondary d-md-none';
        menuButton.innerHTML = '<i class="fas fa-bars"></i>';
        menuButton.onclick = toggleMobileMenu;
        header.insertBefore(menuButton, header.firstChild);
    }

    // Initialize with dashboard active
    document.addEventListener('DOMContentLoaded', function() {
        const dashboardLink = document.querySelector('.nav-link[data-target="dashboard"]');
        if (dashboardLink) {
            dashboardLink.classList.add('active');
            showContent('dashboard', dashboardLink);
        }
    });

    // Enhanced smooth scrolling for long forms
    document.querySelectorAll('.sticky-actions button[type="submit"]').forEach(button => {
        button.addEventListener('click', function() {
            // Scroll to top of form on submit for better UX
            const form = this.closest('form');
            if (form) {
                form.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Enhanced form validation feedback
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                // Show notification for validation errors
                if (window.showNotification) {
                    showNotification('Please fill in all required fields', 'error');
                }
            }
        });
    });

    // Enhanced input focus effects
    document.querySelectorAll('.form-control, .form-select').forEach(input => {
        input.addEventListener('focus', function() {
            this.closest('.col-md-6, .col-md-4, .col-md-8, .col-12')?.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.closest('.col-md-6, .col-md-4, .col-md-8, .col-12')?.classList.remove('focused');
        });
    });


    // Video upload handling
document.querySelectorAll('[data-action="choose-video"]').forEach(button => {
    button.addEventListener('click', function() {
        const target = this.getAttribute('data-target');
        const fileInput = document.getElementById(target + 'Upload');
        if (fileInput) fileInput.click();
    });
});

document.querySelectorAll('[data-action="clear-video"]').forEach(button => {
    button.addEventListener('click', function() {
        const target = this.getAttribute('data-target');
        const fileInput = document.getElementById(target + 'Upload');
        const preview = document.getElementById(target + 'Preview');
        const hiddenInput = document.getElementById(target.replace('Video', '') + 'VideoUrl');
        
        if (fileInput) fileInput.value = '';
        if (preview) {
            preview.style.display = 'none';
            preview.src = '';
        }
        if (hiddenInput) hiddenInput.value = '';
    });
});

// Video file upload preview
document.querySelectorAll('input[type="file"][accept="video/*"]').forEach(input => {
    input.addEventListener('change', function() {
        const file = this.files[0];
        const targetName = this.id.replace('Upload', '');
        const preview = document.getElementById(targetName + 'Preview');
        
        if (file && preview) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
});
    
    </script>
    
    <script src="/admin/admin.js"></script>
</body>
</html>