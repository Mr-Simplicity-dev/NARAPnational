
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

    /* ===== BLOG HEADER ===== */
    .blog-header {
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-700) 100%);
        color: white;
        padding: 100px 0 80px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .blog-header::before {
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

    /* ===== BLOG SECTION ===== */
    .blog-section {
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

    /* ===== BLOG CARDS ===== */
    .blog-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .blog-image {
        height: 250px;
        overflow: hidden;
        position: relative;
    }

    .blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .blog-card:hover .blog-image img {
        transform: scale(1.05);
    }

    .blog-content {
        padding: 24px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .blog-meta {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 12px;
        font-size: 14px;
        color: var(--muted);
    }

    .blog-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 12px;
        line-height: 1.4;
    }

    .blog-title a {
        color: var(--ink);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .blog-title a:hover {
        color: var(--brand);
    }

    .blog-excerpt {
        color: var(--muted);
        line-height: 1.6;
        margin-bottom: 20px;
        flex-grow: 1;
    }

    .read-more {
        color: var(--brand);
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        margin-top: auto;
    }

    .read-more:hover {
        color: var(--brand-700);
        text-decoration: none;
        gap: 12px;
    }

    /* ===== SIDEBAR ===== */
    .sidebar-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin-bottom: 24px;
    }

    .sidebar-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: var(--ink);
    }

    .recent-post {
        display: flex;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .recent-post:last-child {
        border-bottom: none;
    }

    .recent-post-image {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .recent-post-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .recent-post-content h6 {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 4px;
        line-height: 1.3;
    }

    .recent-post-content h6 a {
        color: var(--ink);
        text-decoration: none;
    }

    .recent-post-content h6 a:hover {
        color: var(--brand);
    }

    .recent-post-date {
        font-size: 12px;
        color: var(--muted);
    }

    /* ===== PAGINATION ===== */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 60px;
    }

    .pagination .page-link {
        border: 2px solid #e9ecef;
        color: var(--ink);
        padding: 12px 16px;
        margin: 0 4px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        background: var(--brand);
        border-color: var(--brand);
        color: white;
    }

    .pagination .page-item.active .page-link {
        background: var(--brand);
        border-color: var(--brand);
        color: white;
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

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .blog-header {
            padding: 60px 0 40px;
        }
        
        .blog-section {
            padding: 40px 0;
        }
        
        .search-box {
            margin-bottom: 40px;
        }
    }
</style>

<!-- Blog Header Section -->
<div class="blog-header">
    <a href="/" class="back-link">
        <i class="fas fa-arrow-left me-2"></i>Back to Home
    </a>
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Our Blog & News</h1>
        <p class="lead mb-0">Stay updated with the latest news, insights, and updates from NARAP</p>
    </div>
</div>

<!-- Main Blog Content -->
<div class="container blog-section">
    <!-- Search Box -->
    <div class="search-box">
        <input type="text" class="form-control search-input" id="blogSearch" placeholder="Search blog posts..." onkeyup="searchBlogs()">
    </div>

    <div class="row">
        <!-- Blog Posts -->
        <div class="col-lg-8 mb-5">
            <div id="blogContainer">
                <!-- Loading State -->
                <div class="loading-spinner" id="loadingSpinner">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading blogs...</span>
                    </div>
                    <p class="mt-2 text-muted">Loading blog posts...</p>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper" id="paginationWrapper" style="display: none;">
                <nav aria-label="Blog pagination">
                    <ul class="pagination" id="paginationList">
                        <!-- Pagination items will be inserted here -->
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Recent Posts -->
            <div class="sidebar-card">
                <h5 class="sidebar-title">Recent Posts</h5>
                <div id="recentPosts">
                    <!-- Recent posts will be loaded here -->
                </div>
            </div>

            <!-- Quick Links -->
            <div class="sidebar-card">
                <h5 class="sidebar-title">Quick Links</h5>
                <div class="d-grid gap-2">
                    <a href="register.php" class="btn btn-outline-primary">Become a Member</a>
                    <a href="faq.php" class="btn btn-outline-secondary">FAQs</a>
                    <a href="contact.php" class="btn btn-outline-info">Contact Us</a>
                    <a href="/" class="btn btn-outline-success">Back to Home</a>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="sidebar-card">
                <h5 class="sidebar-title">Get in Touch</h5>
                <p class="text-muted mb-3">Have questions or want to contribute? Contact us.</p>
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    let currentPage = 1;
    let totalPages = 1;
    let allBlogs = [];
    let filteredBlogs = [];

    // Format date helper
    function formatDate(dateString) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('en-US', options);
    }

    // Truncate text helper
    function truncateText(text, maxLength = 150) {
        if (!text) return '';
        return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
    }

    // Load blogs from API
    async function loadBlogs(page = 1) {
        try {
            const response = await fetch(`/api/blogs?page=${page}&limit=6`);
            
            if (!response.ok) {
                throw new Error(`API returned ${response.status}`);
            }
            
            const result = await response.json();
            const blogs = result.data || result;
            const count = result.count || blogs.length;
            
            allBlogs = blogs;
            filteredBlogs = blogs;
            totalPages = Math.ceil(count / 6);
            currentPage = page;
            
            renderBlogs(blogs);
            renderPagination();
            loadRecentPosts();
            
        } catch (error) {
            console.error('Error loading blogs:', error);
            renderErrorState();
        }
    }

    // Render blogs
    function renderBlogs(blogs) {
        const container = document.getElementById('blogContainer');
        const spinner = document.getElementById('loadingSpinner');
        
        if (spinner) spinner.style.display = 'none';
        
        if (!blogs || blogs.length === 0) {
            container.innerHTML = `
                <div class="no-results">
                    <i class="fas fa-newspaper fa-3x mb-3 text-muted"></i>
                    <h5>No Blog Posts Found</h5>
                    <p>Check back later for new content or try a different search.</p>
                </div>
            `;
            return;
        }

        container.innerHTML = `
            <div class="row">
                ${blogs.map(blog => `
                    <div class="col-md-6 mb-4">
                        <article class="blog-card">
                            ${blog.imageUrl ? `
                                <div class="blog-image">
                                    <img src="${blog.imageUrl}" alt="${blog.title}" loading="lazy">
                                </div>
                            ` : ''}
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <span><i class="fas fa-user me-1"></i>${blog.author || 'Admin'}</span>
                                    <span><i class="fas fa-calendar me-1"></i>${formatDate(blog.publishedAt || blog.createdAt)}</span>
                                    ${blog.views ? `<span><i class="fas fa-eye me-1"></i>${blog.views} views</span>` : ''}
                                </div>
                                <h3 class="blog-title">
                                    <a href="post.php?slug=${blog.slug}">${blog.title}</a>
                                </h3>
                                <p class="blog-excerpt">${truncateText(blog.excerpt || blog.content?.replace(/<[^>]*>/g, ''))}</p>
                                <a href="post.php?slug=${blog.slug}" class="read-more">
                                    Read More <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                `).join('')}
            </div>
        `;
    }

    // Render pagination
    function renderPagination() {
        const wrapper = document.getElementById('paginationWrapper');
        const list = document.getElementById('paginationList');
        
        if (totalPages <= 1) {
            wrapper.style.display = 'none';
            return;
        }
        
        wrapper.style.display = 'flex';
        
        let paginationHTML = '';
        
        // Previous button
        if (currentPage > 1) {
            paginationHTML += `
                <li class="page-item">
                    <a class="page-link" href="#" onclick="loadBlogs(${currentPage - 1}); return false;">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            `;
        }
        
        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            if (i === currentPage) {
                paginationHTML += `
                    <li class="page-item active">
                        <span class="page-link">${i}</span>
                    </li>
                `;
            } else {
                paginationHTML += `
                    <li class="page-item">
                        <a class="page-link" href="#" onclick="loadBlogs(${i}); return false;">${i}</a>
                    </li>
                `;
            }
        }
        
        // Next button
        if (currentPage < totalPages) {
            paginationHTML += `
                <li class="page-item">
                    <a class="page-link" href="#" onclick="loadBlogs(${currentPage + 1}); return false;">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            `;
        }
        
        list.innerHTML = paginationHTML;
    }

    // Load recent posts for sidebar
    async function loadRecentPosts() {
        try {
            const response = await fetch('/api/blogs?limit=5');