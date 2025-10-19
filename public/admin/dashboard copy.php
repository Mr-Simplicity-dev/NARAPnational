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

        /* Loading Animation */
        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
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
            <div class="nav-item">
                <a href="#dashboard" class="nav-link active">
                    <i class="fas fa-chart-pie"></i>
                    Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="#content" class="nav-link">
                    <i class="fas fa-edit"></i>
                    Content Management
                </a>
            </div>
            <div class="nav-item">
                <a href="#members" class="nav-link">
                    <i class="fas fa-users"></i>
                    Members
                </a>
            </div>
            <div class="nav-item">
                <a href="#analytics" class="nav-link">
                    <i class="fas fa-chart-bar"></i>
                    Analytics
                </a>
            </div>
            <div class="nav-item">
                <a href="#settings" class="nav-link">
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
                    <h1 class="h4 mb-0">Dashboard Overview</h1>
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

        <!-- Dashboard Content -->
        <div class="container-fluid p-4">
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

            <!-- Content Sections -->
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="modern-card p-4">
                        <h5 class="mb-3">Recent Activity</h5>
                        <!-- Activity content here -->
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
    </main>

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
    </script>
</body>
</html>