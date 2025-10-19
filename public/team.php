<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team - NARAP</title>
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

    /* ===== TEAM HEADER ===== */
    .team-header {
        background: linear-gradient(135deg, var(--brand) 0%, var(--brand-700) 100%);
        color: white;
        padding: 100px 0 80px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .team-header::before {
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

    /* ===== TEAM SECTION ===== */
    .team-section {
        padding: 80px 0;
    }

    /* ===== TEAM CARDS ===== */
    .team-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        height: 100%;
        position: relative;
    }

    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.15);
    }

    .team-image {
        height: 300px;
        overflow: hidden;
        position: relative;
    }

    .team-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .team-card:hover .team-image img {
        transform: scale(1.05);
    }

    .team-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(10, 127, 65, 0.8), rgba(8, 109, 55, 0.8));
        opacity: 0;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .team-card:hover .team-overlay {
        opacity: 1;
    }

    .view-details {
        color: white;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        padding: 12px 24px;
        border: 2px solid white;
        border-radius: 30px;
        transition: all 0.3s ease;
    }

    .view-details:hover {
        background: white;
        color: var(--brand);
        text-decoration: none;
    }

    .team-info {
        padding: 30px 24px;
        text-align: center;
    }

    .team-name {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 8px;
        color: var(--ink);
    }

    .team-role {
        color: var(--brand);
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 16px;
    }

    .team-socials {
        display: flex;
        justify-content: center;
        gap: 12px;
    }

    .social-link {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--muted);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        background: var(--brand);
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
    }

    /* ===== MEMBER MODAL ===== */
    .member-modal {
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

    .member-modal.show {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 20px;
        max-width: 800px;
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

    .modal-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid white;
        margin: 0 auto 20px;
        overflow: hidden;
    }

    .modal-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .modal-name {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .modal-role {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 20px;
    }

    .modal-socials {
        display: flex;
        justify-content: center;
        gap: 16px;
    }

    .modal-social-link {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 1.2rem;
    }

    .modal-social-link:hover {
        background: white;
        color: var(--brand);
        text-decoration: none;
        transform: translateY(-2px);
    }

    .modal-body {
        padding: 40px;
    }

    .info-section {
        margin-bottom: 30px;
    }

    .info-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--brand);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-content {
        color: var(--muted);
        line-height: 1.7;
    }

    .contact-info {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 30px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .contact-item:last-child {
        margin-bottom: 0;
    }

    .contact-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--brand);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .specializations, .achievements {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .tag {
        background: var(--brand);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
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
        .team-header {
            padding: 60px 0 40px;
        }
        
        .team-section {
            padding: 40px 0;
        }
        
        .modal-content {
            margin: 10px;
            max-height: 95vh;
        }
        
        .modal-header, .modal-body {
            padding: 30px 20px;
        }
        
        .modal-name {
            font-size: 1.5rem;
        }
    }
</style>
</head>
<body>
    <!-- Team Header Section -->
<div class="team-header">
    <a href="/" class="back-link">
        <i class="fas fa-arrow-left me-2"></i>Back to Home
    </a>
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Meet Our Team</h1>
        <p class="lead mb-0">Get to know the dedicated professionals behind NARAP's success</p>
    </div>
</div>

<!-- Main Team Content -->
<div class="container team-section">
    <div id="teamContainer">
        <!-- Loading State -->
        <div class="loading-spinner" id="loadingSpinner">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading team members...</span>
            </div>
            <p class="mt-2 text-muted">Loading our amazing team...</p>
        </div>
    </div>
</div>

<!-- Member Detail Modal -->
<div class="member-modal" id="memberModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeMemberModal()">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="modal-header">
            <div class="modal-avatar" id="modalAvatar">
                <img src="" alt="" id="modalAvatarImg">
            </div>
            <h2 class="modal-name" id="modalName"></h2>
            <p class="modal-role" id="modalRole"></p>
            <div class="modal-socials" id="modalSocials">
                <!-- Social links will be inserted here -->
            </div>
        </div>
        
        <div class="modal-body" id="modalBody">
            <!-- Member details will be inserted here -->
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    let teamMembers = [];

    // Load team members from API
    async function loadTeamMembers() {
        try {
            const response = await fetch('/api/team');
            
            if (!response.ok) {
                throw new Error(`API returned ${response.status}`);
            }
            
            const result = await response.json();
            teamMembers = result.data || result;
            
            renderTeamMembers(teamMembers);
            
        } catch (error) {
            console.error('Error loading team members:', error);
            renderErrorState();
        }
    }

    // Render team members grid
    function renderTeamMembers(members) {
        const container = document.getElementById('teamContainer');
        const spinner = document.getElementById('loadingSpinner');
        
        if (spinner) spinner.style.display = 'none';
        
        if (!members || members.length === 0) {
            container.innerHTML = `
                <div class="no-results">
                    <i class="fas fa-users fa-3x mb-3 text-muted"></i>
                    <h5>No Team Members Found</h5>
                    <p>Our team information will be available soon.</p>
                </div>
            `;
            return;
        }

        // Sort by displayOrder if available
        const sortedMembers = members.sort((a, b) => (a.displayOrder || 0) - (b.displayOrder || 0));

        container.innerHTML = `
            <div class="row">
                ${sortedMembers.map(member => `
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="team-card" onclick="showMemberDetails('${member._id}')">
                            <div class="team-image">
                                <img src="${member.imageUrl || '/img/default-avatar.jpg'}" alt="${member.name}" loading="lazy">
                                <div class="team-overlay">
                                    <span class="view-details">View Details</span>
                                </div>
                            </div>
                            <div class="team-info">
                                <h3 class="team-name">${member.name}</h3>
                                <p class="team-role">${member.role || 'Team Member'}</p>
                                <div class="team-socials">
                                    ${member.socials?.facebook ? `<a href="${member.socials.facebook}" class="social-link" target="_blank"><i class="fab fa-facebook-f"></i></a>` : ''}
                                    ${member.socials?.twitter ? `<a href="${member.socials.twitter}" class="social-link" target="_blank"><i class="fab fa-twitter"></i></a>` : ''}
                                    ${member.socials?.linkedin ? `<a href="${member.socials.linkedin}" class="social-link" target="_blank"><i class="fab fa-linkedin-in"></i></a>` : ''}
                                    ${member.socials?.instagram ? `<a href="${member.socials.instagram}" class="social-link" target="_blank"><i class="fab fa-instagram"></i></a>` : ''}
                                </div>
                            </div>
                        </div>
                    </div>
                `).join('')}
            </div>
        `;
    }

    // Show member details in modal
    function showMemberDetails(memberId) {
        const member = teamMembers.find(m => m._id === memberId);
        if (!member) return;

        // Update modal header
        document.getElementById('modalAvatarImg').src = member.imageUrl || '/img/default-avatar.jpg';
        document.getElementById('modalAvatarImg').alt = member.name;
        document.getElementById('modalName').textContent = member.name;
        document.getElementById('modalRole').textContent = member.role || 'Team Member';

        // Update social links
        const socialLinks = [];
        if (member.socials?.facebook) socialLinks.push(`<a href="${member.socials.facebook}" class="modal-social-link" target="_blank"><i class="fab fa-facebook-f"></i></a>`);
         if (member.socials?.twitter) socialLinks.push(`<a href="${member.socials.twitter}" class="modal-social-link" target="_blank"><i class="fab fa-twitter"></i></a>`);
            if (member.socials?.linkedin) socialLinks.push(`<a href="${member.socials.linkedin}" class="modal-social-link" target="_blank"><i class="fab fa-linkedin-in"></i></a>`);
            if (member.socials?.instagram) socialLinks.push(`<a href="${member.socials.instagram}" class="modal-social-link" target="_blank"><i class="fab fa-instagram"></i></a>`);
            
            document.getElementById('modalSocials').innerHTML = socialLinks.join('');

            // Update modal body with detailed information
            let modalBodyContent = '';

            // Biography section
            if (member.biography) {
                modalBodyContent += `
                    <div class="info-section">
                        <h4 class="info-title">
                            <i class="fas fa-user-circle"></i>
                            Biography
                        </h4>
                        <div class="info-content">${member.biography}</div>
                    </div>
                `;
            }

            // Contact information
            if (member.email || member.phone) {
                modalBodyContent += `
                    <div class="contact-info">
                        <h4 class="info-title">
                            <i class="fas fa-address-card"></i>
                            Contact Information
                        </h4>
                        ${member.email ? `
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <strong>Email:</strong><br>
                                    <a href="mailto:${member.email}" style="color: var(--brand);">${member.email}</a>
                                </div>
                            </div>
                        ` : ''}
                        ${member.phone ? `
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <strong>Phone:</strong><br>
                                    <a href="tel:${member.phone}" style="color: var(--brand);">${member.phone}</a>
                                </div>
                            </div>
                        ` : ''}
                    </div>
                `;
            }

            // Professional information
            if (member.department || member.experience || member.education) {
                modalBodyContent += `
                    <div class="info-section">
                        <h4 class="info-title">
                            <i class="fas fa-briefcase"></i>
                            Professional Information
                        </h4>
                        <div class="info-content">
                            ${member.department ? `<p><strong>Department:</strong> ${member.department}</p>` : ''}
                            ${member.experience ? `<p><strong>Experience:</strong> ${member.experience}</p>` : ''}
                            ${member.education ? `<p><strong>Education:</strong> ${member.education}</p>` : ''}
                        </div>
                    </div>
                `;
            }

            // Specializations
            if (member.specializations && member.specializations.length > 0) {
                modalBodyContent += `
                    <div class="info-section">
                        <h4 class="info-title">
                            <i class="fas fa-star"></i>
                            Specializations
                        </h4>
                        <div class="specializations">
                            ${member.specializations.map(spec => `<span class="tag">${spec}</span>`).join('')}
                        </div>
                    </div>
                `;
            }

            // Achievements
            if (member.achievements && member.achievements.length > 0) {
                modalBodyContent += `
                    <div class="info-section">
                        <h4 class="info-title">
                            <i class="fas fa-trophy"></i>
                            Achievements
                        </h4>
                        <div class="achievements">
                            ${member.achievements.map(achievement => `<span class="tag">${achievement}</span>`).join('')}
                        </div>
                    </div>
                `;
            }

            // If no detailed information is available
            if (!modalBodyContent) {
                modalBodyContent = `
                    <div class="info-section">
                        <div class="info-content text-center">
                            <i class="fas fa-info-circle fa-3x mb-3 text-muted"></i>
                            <h5>More Information Coming Soon</h5>
                            <p>Detailed information about ${member.name} will be available soon.</p>
                        </div>
                    </div>
                `;
            }

            document.getElementById('modalBody').innerHTML = modalBodyContent;

            // Show modal
            document.getElementById('memberModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        // Close member modal
        function closeMemberModal() {
            document.getElementById('memberModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Error state
        function renderErrorState() {
            const container = document.getElementById('teamContainer');
            const spinner = document.getElementById('loadingSpinner');
            
            if (spinner) spinner.style.display = 'none';
            
            container.innerHTML = `
                <div class="no-results">
                    <i class="fas fa-exclamation-triangle fa-3x mb-3 text-warning"></i>
                    <h5>Unable to Load Team Members</h5>
                    <p>There was an error loading the team information. Please try again later.</p>
                    <button class="btn btn-brand" onclick="loadTeamMembers()">
                        <i class="fas fa-refresh me-2"></i>Try Again
                    </button>
                </div>
            `;
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            loadTeamMembers();
        });

        // Close modal when clicking outside
        document.getElementById('memberModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeMemberModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeMemberModal();
            }
        });

        // Prevent modal content clicks from closing modal
        document.querySelector('.modal-content').addEventListener('click', function(e) {
            e.stopPropagation();
        });
    </script>
</body>
</html>