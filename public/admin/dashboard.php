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

            <!-- Content Management Sections -->
            <!-- These will be populated with the actual content from dashboard copy 2 -->
            <div id="home-settings" class="content-tab-pane">
                <div class="modern-card p-4">
                    <h4>Home Settings</h4>
                    <p class="text-muted">Configure homepage content and sections</p>
                    <!-- Home settings content from copy 2 will go here -->
                </div>
            </div>

            <div id="sliders" class="content-tab-pane">
                <div class="modern-card p-4">
                    <h4>Sliders Management</h4>
                    <p class="text-muted">Manage homepage sliders and banners</p>
                    <!-- Sliders content from copy 2 will go here -->
                </div>
            </div>

            <!-- Add other content sections similarly -->
            <div id="services" class="content-tab-pane"><div class="modern-card p-4"><h4>Services</h4></div></div>
            <div id="projects" class="content-tab-pane"><div class="modern-card p-4"><h4>Projects</h4></div></div>
            <div id="features" class="content-tab-pane"><div class="modern-card p-4"><h4>Features</h4></div></div>
            <div id="offers" class="content-tab-pane"><div class="modern-card p-4"><h4>Offers</h4></div></div>
            <div id="blogs" class="content-tab-pane"><div class="modern-card p-4"><h4>Blogs</h4></div></div>
            <div id="faqs" class="content-tab-pane"><div class="modern-card p-4"><h4>FAQs</h4></div></div>
            <div id="team" class="content-tab-pane"><div class="modern-card p-4"><h4>Team</h4></div></div>

            <!-- Members Management Sections -->
            <div id="members-all" class="content-tab-pane"><div class="modern-card p-4"><h4>All Members</h4></div></div>
            <div id="members-paid" class="content-tab-pane"><div class="modern-card p-4"><h4>Paid Members</h4></div></div>
            <div id="members-unpaid" class="content-tab-pane"><div class="modern-card p-4"><h4>Unpaid Members</h4></div></div>

            <!-- Donations Section -->
            <div id="donations" class="content-tab-pane"><div class="modern-card p-4"><h4>Donations</h4></div></div>

            <!-- Settings Section -->
            <div id="settings" class="content-tab-pane"><div class="modern-card p-4"><h4>Settings</h4></div></div>
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