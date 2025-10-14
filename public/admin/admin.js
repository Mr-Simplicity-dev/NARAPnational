// ===== IMAGE UPLOAD FUNCTIONALITY - FIXED VERSION =====

// Global flag to prevent multiple initializations
let imageUploadsInitialized = false;

// Store active upload references to prevent duplicates
const activeUploads = new Map();

// Initialize image uploads with better event delegation
function initializeImageUploads() {
  console.log('Initializing image uploads...');
  
  // Check if already initialized
  if (imageUploadsInitialized) {
    console.log('Image uploads already initialized, skipping...');
    return;
  }
  
  // Set up all image upload containers
  const containers = document.querySelectorAll('.image-upload-container');
  console.log('Found image upload containers:', containers.length);
  
  containers.forEach(container => {
    const target = container.getAttribute('data-target');
    console.log('Setting up:', target);
    
    const fileInput = document.getElementById(`${target}Upload`);
    const preview = document.getElementById(`${target}Preview`);
    const urlInput = document.getElementById(`${target}Url`);

    if (!fileInput || !preview || !urlInput) {
      console.warn(`Missing elements for target: ${target}`);
      return;
    }

    // Mark elements as initialized to prevent re-attachment
    if (container.dataset.initialized === 'true') {
      console.log('Already initialized:', target);
      return;
    }
    container.dataset.initialized = 'true';

    // Container click handler
    container.addEventListener('click', function(e) {
      // Don't trigger file input if clicking on buttons
      if (e.target.closest('button')) {
        return;
      }
      
      // Only trigger file input when clicking on container or placeholder
      if (e.target === container || 
          e.target.closest('.upload-placeholder') || 
          (e.target.classList && e.target.classList.contains('fa-cloud-upload-alt'))) {
        console.log('Container clicked, triggering file input for:', target);
        fileInput.click();
      }
    });

    // File input change handler
    fileInput.addEventListener('change', function(e) {
      console.log('File input changed for:', target);
      if (this.files && this.files[0]) {
        handleFileSelection(this.files[0], target);
      }
    });

    // Drag and drop handlers
    ['dragover', 'dragenter'].forEach(eventName => {
      container.addEventListener(eventName, function(e) {
        e.preventDefault();
        e.stopPropagation();
        container.style.borderColor = '#0a7f41';
        container.style.backgroundColor = '#e8f5e8';
      });
    });

    container.addEventListener('dragleave', function(e) {
      e.preventDefault();
      e.stopPropagation();
      if (!container.contains(e.relatedTarget)) {
        resetContainerStyle(container);
      }
    });

    container.addEventListener('drop', function(e) {
      e.preventDefault();
      e.stopPropagation();
      resetContainerStyle(container);
      
      if (e.dataTransfer.files && e.dataTransfer.files[0]) {
        console.log('File dropped for:', target);
        handleFileSelection(e.dataTransfer.files[0], target);
      }
    });
    
    console.log('Successfully initialized:', target);
  });
  
  // Setup button event handlers using event delegation
  setupImageUploadButtons();
  
  imageUploadsInitialized = true;
  console.log('Image uploads initialization complete');
}

// Helper function to reset container styling
// Helper function to reset container styling
function resetContainerStyle(container) {
  container.style.borderColor = '#dee2e6';
  container.style.backgroundColor = '#f8f9fa';
}

// Setup button event handlers - SINGLE FUNCTION ONLY
function setupImageUploadButtons() {
  console.log('Setting up image upload buttons...');
  
  // Remove any existing inline onclick handlers and replace with event listeners
  document.querySelectorAll('button[onclick]').forEach(button => {
    const onclick = button.getAttribute('onclick');
    
    // Handle "Choose Image" buttons - comprehensive pattern matching
    if (onclick.includes('.click()') || (onclick.includes('Upload') && onclick.includes('click'))) {
      let target = null;
      
      // Pattern: document.getElementById('targetUpload').click()
      let match = onclick.match(/getElementById\('([^']+)Upload'\)/);
      if (match) {
        target = match[1];
      }
      
      if (target) {
        button.removeAttribute('onclick');
        button.setAttribute('data-action', 'choose-image');
        button.setAttribute('data-target', target);
        console.log('✅ Converted choose button for:', target);
      }
    }
    
    // Handle "Clear" buttons
    if (onclick.includes('clearImageUpload')) {
      let match = onclick.match(/clearImageUpload\('([^']+)'\)/);
      if (match) {
        const target = match[1];
        button.removeAttribute('onclick');
        button.setAttribute('data-action', 'clear-image');
        button.setAttribute('data-target', target);
        console.log('✅ Converted clear button for:', target);
      }
    }
  });
}
// Handle file selection
function handleFileSelection(file, target) {
  if (!file) return;
  
  // Check if there's already an upload in progress for this target
  if (activeUploads.has(target)) {
    showNotification(`Upload already in progress for ${target}`, 'warning');
    return;
  }
  
  // Validate file type
  const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
  if (!validTypes.includes(file.type)) {
    showNotification('Please select a valid image file (PNG, JPG, GIF, WEBP)', 'error');
    return;
  }
  
  // Validate file size (5MB)
  const maxSize = 5 * 1024 * 1024;
  if (file.size > maxSize) {
    showNotification(`Image must be less than 5MB (current: ${(file.size / 1024 / 1024).toFixed(2)}MB)`, 'error');
    return;
  }
  
  // Show preview immediately
  showImagePreview(file, target);
  
  // Upload the file
  uploadImage(file, target);
}

// Show image preview
function showImagePreview(file, target) {
  const preview = document.getElementById(`${target}Preview`);
  const container = document.querySelector(`[data-target="${target}"]`);
  
  if (!preview || !container) return;
  
  const reader = new FileReader();
  reader.onload = function(e) {
    preview.src = e.target.result;
    preview.style.display = 'block';
    
    const placeholder = container.querySelector('.upload-placeholder');
    if (placeholder) {
      placeholder.style.display = 'none';
    }
  };
  reader.onerror = function() {
    showNotification('Failed to read image file', 'error');
  };
  reader.readAsDataURL(file);
}

// Clear image upload
function clearImageUpload(target) {
  console.log('Clearing image upload for:', target);
  
  // Cancel any active upload
  if (activeUploads.has(target)) {
    const controller = activeUploads.get(target);
    controller.abort();
    activeUploads.delete(target);
  }
  
  const fileInput = document.getElementById(`${target}Upload`);
  const preview = document.getElementById(`${target}Preview`);
  const urlInput = document.getElementById(`${target}Url`);
  const container = document.querySelector(`[data-target="${target}"]`);
  
  if (fileInput) fileInput.value = '';
  if (preview) {
    preview.src = '';
    preview.style.display = 'none';
  }
  if (urlInput) urlInput.value = '';
  if (container) {
    const placeholder = container.querySelector('.upload-placeholder');
    if (placeholder) {
      placeholder.style.display = 'block';
    }
  }
  
  showNotification('Image cleared', 'info');
}

// Upload image to server
async function uploadImage(file, target) {
  const controller = new AbortController();
  activeUploads.set(target, controller);
  
  try {
    showNotification(`Uploading ${file.name}...`, 'info');
    
    const formData = new FormData();
    formData.append('image', file);
    
    const token = localStorage.getItem('jwt');
    if (!token) {
      throw new Error('Not authenticated. Please log in again.');
    }
    
    const response = await fetch('/api/upload', {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${token}`
      },
      body: formData,
      signal: controller.signal
    });
    
    activeUploads.delete(target);
    
    if (!response.ok) {
      const errorText = await response.text();
      throw new Error(`Upload failed (${response.status}): ${errorText || response.statusText}`);
    }
    
    const result = await response.json();
    
    if (result.success && result.url) {
      const urlInput = document.getElementById(`${target}Url`);
      if (urlInput) {
        urlInput.value = result.url;
        showNotification('Image uploaded successfully!', 'success');
      } else {
        throw new Error('URL input field not found');
      }
    } else {
      throw new Error(result.message || 'Upload failed - no URL returned');
    }
    
  } catch (error) {
    activeUploads.delete(target);
    
    if (error.name === 'AbortError') {
      console.log('Upload cancelled for:', target);
      showNotification('Upload cancelled', 'info');
    } else {
      console.error('Image upload error:', error);
      showNotification(`Upload failed: ${error.message}`, 'error');
      clearImageUpload(target);
    }
  }
}

// Set image from URL (for editing)
function setImageFromUrl(target, url) {
  if (!url) return;
  
  const preview = document.getElementById(`${target}Preview`);
  const urlInput = document.getElementById(`${target}Url`);
  const container = document.querySelector(`[data-target="${target}"]`);
  
  if (!preview || !urlInput || !container) {
    console.warn(`Cannot set image for ${target} - missing elements`);
    return;
  }
  
  urlInput.value = url;
  
  const testImg = new Image();
  testImg.onload = function() {
    preview.src = url;
    preview.style.display = 'block';
    
    const placeholder = container.querySelector('.upload-placeholder');
    if (placeholder) {
      placeholder.style.display = 'none';
    }
  };
  testImg.onerror = function() {
    console.error(`Failed to load image from URL: ${url}`);
    showNotification('Failed to load image from URL', 'warning');
  };
  testImg.src = url;
}

// Global event delegation for buttons
document.addEventListener('click', function(e) {
  // Handle Choose Image buttons
  if (e.target.matches('[data-action="choose-image"]') || 
      e.target.closest('[data-action="choose-image"]')) {
    
    const button = e.target.closest('[data-action="choose-image"]');
    const target = button.dataset.target;
    const fileInput = document.getElementById(`${target}Upload`);
    
    if (fileInput) {
      console.log('Choose Image button clicked for:', target);
      fileInput.click();
    }
  }
  
  // Handle Clear buttons
  if (e.target.matches('[data-action="clear-image"]') || 
      e.target.closest('[data-action="clear-image"]')) {
    
    const button = e.target.closest('[data-action="clear-image"]');
    const target = button.dataset.target;
    console.log('Clear button clicked for:', target);
    clearImageUpload(target);
  }
});

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
  console.log('DOM loaded, initializing all functionality...');
  
  // Initialize image uploads
  initializeImageUploads();
  
  // Also initialize when tabs are shown
  document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
    tab.addEventListener('shown.bs.tab', function() {
      console.log('Tab shown, reinitializing image uploads...');
      setTimeout(() => {
        initializeImageUploads();
      }, 100);
    });
  });
});

// Notification system
function showNotification(message, type = 'info') {
  const notificationArea = document.getElementById('notificationArea');
  if (!notificationArea) return;
  
  const alertClass = {
    'success': 'alert-success',
    'error': 'alert-danger',
    'warning': 'alert-warning',
    'info': 'alert-info'
  }[type] || 'alert-info';
  
  const icon = {
    'success': 'fa-check-circle',
    'error': 'fa-exclamation-circle',
    'warning': 'fa-exclamation-triangle',
    'info': 'fa-info-circle'
  }[type] || 'fa-info-circle';
  
  const notification = document.createElement('div');
  notification.className = `alert ${alertClass} alert-dismissible fade show`;
  notification.innerHTML = `
    <i class="fas ${icon} me-2"></i>
    ${message}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  `;
  
  notificationArea.appendChild(notification);
  
  setTimeout(() => {
    if (notification.parentNode) {
      notification.classList.remove('show');
      setTimeout(() => notification.remove(), 150);
    }
  }, 5000);
}

// Cleanup function
function cleanupUploads() {
  activeUploads.forEach((controller, target) => {
    console.log('Cancelling upload for:', target);
    controller.abort();
  });
  activeUploads.clear();
}


// Call cleanup on page unload
window.addEventListener('beforeunload', cleanupUploads);

// ===== VIDEO UPLOAD FUNCTIONALITY =====

// Add video upload functionality
function initializeVideoUploads() {
  console.log('Initializing video uploads...');
  
  // Setup video upload buttons
  document.addEventListener('click', function(e) {
    const button = e.target.closest('[data-action="choose-video"]');
    if (button) {
      e.preventDefault();
      const target = button.getAttribute('data-target');
      const fileInput = document.getElementById(`${target}Upload`);
      if (fileInput) fileInput.click();
    }

    const clearButton = e.target.closest('[data-action="clear-video"]');
    if (clearButton) {
      e.preventDefault();
      const target = clearButton.getAttribute('data-target');
      clearVideoUpload(target);
    }
  });

  // Setup video file input handlers
  document.querySelectorAll('input[type="file"][accept="video/*"]').forEach(input => {
    input.addEventListener('change', function(e) {
      if (this.files && this.files[0]) {
        const target = this.id.replace('Upload', '');
        handleVideoSelection(this.files[0], target);
      }
    });
  });
}

// Handle video file selection
function handleVideoSelection(file, target) {
  if (!file) return;
  
  // Validate video file
  const validTypes = ['video/mp4', 'video/webm', 'video/ogg', 'video/avi', 'video/mov'];
  if (!validTypes.includes(file.type)) {
    showNotification('Please select a valid video file (MP4, WEBM, OGV, AVI, MOV)', 'error');
    return;
  }
  
  // Validate file size (50MB)
  const maxSize = 50 * 1024 * 1024;
  if (file.size > maxSize) {
    showNotification(`Video must be less than 50MB (current: ${(file.size / 1024 / 1024).toFixed(2)}MB)`, 'error');
    return;
  }
  
  // Show video preview
  showVideoPreview(file, target);
  
  // Upload the video
  uploadVideo(file, target);
}

// Show video preview
function showVideoPreview(file, target) {
  const preview = document.getElementById(`${target}Preview`);
  const container = document.querySelector(`[data-target="${target}"]`);
  
  if (!preview || !container) return;
  
  const reader = new FileReader();
  reader.onload = function(e) {
    preview.src = e.target.result;
    preview.style.display = 'block';
    
    const placeholder = container.querySelector('.upload-placeholder');
    if (placeholder) {
      placeholder.style.display = 'none';
    }
  };
  reader.readAsDataURL(file);
}

// Upload video file
async function uploadVideo(file, target) {
  try {
    const formData = new FormData();
    formData.append('file', file);

    // Use the same JWT token as your other requests
    const token = localStorage.getItem('jwt');
    if (!token) {
      throw new Error('Not authenticated. Please log in again.');
    }

    const response = await fetch('/api/upload/video', {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${token}`
      },
      body: formData
    });

    const result = await response.json();
    
    if (result.success) {
      // Update hidden input with video URL
      const urlInput = document.getElementById(`${target}Url`);
      if (urlInput) {
        urlInput.value = result.url;
      }
      
      showNotification('Video uploaded successfully!', 'success');
    } else {
      throw new Error(result.error || 'Upload failed');
    }
  } catch (error) {
    console.error('Video upload error:', error);
    showNotification(`Video upload failed: ${error.message}`, 'error');
  }
}

// Clear video upload
function clearVideoUpload(target) {
  const preview = document.getElementById(`${target}Preview`);
  const urlInput = document.getElementById(`${target}Url`);
  const fileInput = document.getElementById(`${target}Upload`);
  const container = document.querySelector(`[data-target="${target}"]`);
  
  if (preview) {
    preview.src = '';
    preview.style.display = 'none';
  }
  
  if (urlInput) {
    urlInput.value = '';
  }
  
  if (fileInput) {
    fileInput.value = '';
  }
  
  if (container) {
    const placeholder = container.querySelector('.upload-placeholder');
    if (placeholder) {
      placeholder.style.display = 'block';
    }
  }
}

// ===== BASIC AUTHENTICATION CHECK =====
// Only redirect if we're actually on a protected admin page
if (window.location.pathname.includes('/admin/') && !window.location.pathname.includes('/admin/login.php')) {
  const token = localStorage.getItem('jwt');
  if (!token) {
    console.log('No token found, redirecting to login');
    window.location.replace('/admin/login.php');
  } else {
    console.log('Token found, staying on admin page');
  }
}

// Define your API base URL
const API_BASE = '/api';

// Auth fetch function
async function authFetch(url, options = {}) {
  const token = localStorage.getItem('jwt');
  if (!token) {
    console.error('No JWT token found in authFetch');
    window.location.href = '/admin/login.php';
    return;
  }
  
  try {
    const response = await fetch(url, {
      ...options,
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
        ...options.headers
      }
    });

    // Handle token expiration
    if (response.status === 401 || response.status === 403) {
      console.warn('Token expired or invalid. Redirecting to login...');
      localStorage.removeItem('jwt');
      sessionStorage.clear();
      window.location.href = '/admin/login.php';
      return;
    }

    return response;
  } catch (error) {
    console.error('AuthFetch error:', error);
    throw error;
  }
}

// ===== LOGOUT FUNCTION =====
async function handleLogout() {
  if (!confirm('Are you sure you want to logout?')) {
    return;
  }

  try {
    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
      logoutBtn.disabled = true;
      logoutBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Logging out...';
    }

    // Call server logout API first
    const token = localStorage.getItem('jwt');
    if (token) {
      try {
        const response = await fetch('/api/auth/logout', {
          method: 'POST',
          headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
          }
        });
        
        if (!response.ok && response.status < 500) {
          console.warn('Server logout non-OK:', response.status);
        }
      } catch (error) {
        console.warn('Server logout failed:', error);
        // Continue with client cleanup anyway
      }
    }

    // Clear all authentication data
    localStorage.removeItem('jwt');
    localStorage.removeItem('token');
    sessionStorage.clear();
    
    // Clear all cookies
    document.cookie.split(';').forEach(cookie => {
      const eqPos = cookie.indexOf('=');
      const name = eqPos > -1 ? cookie.substr(0, eqPos).trim() : cookie;
      document.cookie = `${name}=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/`;
    });

    // Redirect to login page
    window.location.href = '/admin/login.php';

  } catch (error) {
    console.error('Logout error:', error);
    // Fallback redirect
    localStorage.clear();
    sessionStorage.clear();
    window.location.href = '/admin/login.php';
  }
}
// ===== SAFE HELPERS =====
const PAGE_SIZE = window.PAGE_SIZE || 20;
let allPage = 1, paidPage = 1, unpaidPage = 1;
let currentAllData = [], currentPaidData = [], currentUnpaidData = [];

// Helper for JSON requests
const json = (opts = {}) => ({
  ...opts,
  headers: { 'Content-Type': 'application/json', ...(opts.headers || {}) }
});

// Defensive selector
const $ = (sel) => document.querySelector(sel);

// ===== HELPER FUNCTIONS =====
function summarizePaidFlags(item) {
  const flags = {
    membership: item?.membershipPaid || false,
    certificate: item?.certificatePaid || false,
    idcard: item?.idCardPaid || false
  };
  
  // Check for alternative field names
  if (typeof item?.paidFlags === 'object') {
    flags.membership = flags.membership || item.paidFlags.membership || false;
    flags.certificate = flags.certificate || item.paidFlags.certificate || false;
    flags.idcard = flags.idcard || item.paidFlags.idcard || false;
  }
  
  return flags;
}

function unpaidListFromFlags(flags) {
  const unpaid = [];
  if (!flags.membership) unpaid.push('Membership');
  if (!flags.certificate) unpaid.push('Certificate');
  if (!flags.idcard) unpaid.push('ID Card');
  return unpaid.length ? unpaid.join(', ') : 'All paid';
}

function resetForm(sel) {
  const f = document.querySelector(sel);
  if (!f) return;
  f.reset();
  const id = f.querySelector('[name="_id"]');
  if (id) id.value = '';
  
  // Clear all image uploads in this form
  f.querySelectorAll('.image-upload-container').forEach(container => {
    const target = container.getAttribute('data-target');
    if (target) clearImageUpload(target);
  });
}

// ===== LOADING INDICATORS =====
function showLoading(selector) {
  const element = $(selector);
  if (element) {
    element.innerHTML = '<tr><td colspan="10" class="text-center py-4"><div class="spinner-border spinner-border-sm text-brand" role="status"></div> Loading...</td></tr>';
  }
}

function showButtonLoading(button, text = 'Loading...') {
  if (!button) return;
  button.disabled = true;
  const originalHTML = button.innerHTML;
  button.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ${text}`;
  button.setAttribute('data-original-html', originalHTML);
}

function hideButtonLoading(button) {
  if (!button) return;
  button.disabled = false;
  const originalHTML = button.getAttribute('data-original-html');
  if (originalHTML) {
    button.innerHTML = originalHTML;
  }
}

// ===== PAGINATION FUNCTIONS =====
function paginateData(data, page, pageSize = PAGE_SIZE) {
  const start = (page - 1) * pageSize;
  const end = start + pageSize;
  return data.slice(start, end);
}

function updatePagination(type, filteredData, currentPage) {
  const totalPages = Math.ceil(filteredData.length / PAGE_SIZE);
  const countEl = document.getElementById(`${type}Count`);
  const prevBtn = document.getElementById(`${type}Prev`);
  const nextBtn = document.getElementById(`${type}Next`);
  
  if (countEl) {
    countEl.textContent = `${filteredData.length} result(s) - Page ${currentPage} of ${totalPages}`;
  }
  
  if (prevBtn) {
    prevBtn.disabled = currentPage <= 1;
  }
  
  if (nextBtn) {
    nextBtn.disabled = currentPage >= totalPages;
  }
}

// ===== CSV EXPORT FUNCTIONALITY =====
function convertToCSV(data, type) {
  if (!data.length) return '';
  
  const headers = [];
  const rows = [];
  
  switch(type) {
    case 'all':
      headers.push(['Name', 'Email', 'Member ID', 'State', 'LGA', 'Phone', 'Registration Date']);
      data.forEach(item => {
        const date = item?.createdAt ? new Date(item.createdAt).toLocaleDateString() : '';
        rows.push([
          `"${item?.name || ''}"`,
          `"${item?.email || ''}"`,
          `"${item?.memberId || item?.memberCode || ''}"`,
          `"${item?.state || ''}"`,
          `"${item?.lga || ''}"`,
          `"${item?.phone || ''}"`,
          `"${date}"`
        ]);
      });
      break;
      
    case 'paid':
      headers.push(['Name', 'Email', 'Member ID', 'State', 'Paid Fees', 'Membership Paid', 'Certificate Paid', 'ID Card Paid']);
      data.forEach(item => {
        const flags = summarizePaidFlags(item);
        const paidList = [flags.membership ? 'Membership' : '', flags.certificate ? 'Certificate' : '', flags.idcard ? 'ID Card' : '']
          .filter(Boolean).join('; ');
        rows.push([
          `"${item?.name || ''}"`,
          `"${item?.email || ''}"`,
          `"${item?.memberId || item?.memberCode || ''}"`,
          `"${item?.state || ''}"`,
          `"${paidList}"`,
          `"${flags.membership ? 'Yes' : 'No'}"`,
          `"${flags.certificate ? 'Yes' : 'No'}"`,
          `"${flags.idcard ? 'Yes' : 'No'}"`
        ]);
      });
      break;
      
    case 'unpaid':
      headers.push(['Name', 'Email', 'Member ID', 'State', 'Unpaid Fees', 'Membership Due', 'Certificate Due', 'ID Card Due']);
      data.forEach(item => {
        const missing = unpaidListFromFlags(summarizePaidFlags(item));
        const flags = summarizePaidFlags(item);
        rows.push([
          `"${item?.name || ''}"`,
          `"${item?.email || ''}"`,
          `"${item?.memberId || item?.memberCode || ''}"`,
          `"${item?.state || ''}"`,
          `"${missing}"`,
          `"${flags.membership ? 'Paid' : 'Due'}"`,
          `"${flags.certificate ? 'Paid' : 'Due'}"`,
          `"${flags.idcard ? 'Paid' : 'Due'}"`
        ]);
      });
      break;
  }
  
  return [...headers, ...rows].map(row => row.join(',')).join('\n');
}

function downloadCSV(csv, filename) {
  const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
  const link = document.createElement('a');
  const url = URL.createObjectURL(blob);
  link.setAttribute('href', url);
  link.setAttribute('download', filename);
  link.style.visibility = 'hidden';
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

// ===== SEARCH AND FILTER FUNCTIONALITY =====
function filterMembers(data, searchTerm, type = 'all') {
  if (!searchTerm) return data;
  
  const term = searchTerm.toLowerCase();
  return data.filter(item => {
    const name = (item?.name || '').toLowerCase();
    const email = (item?.email || '').toLowerCase();
    const memberId = (item?.memberId || item?.memberCode || '').toLowerCase();
    const state = (item?.state || '').toLowerCase();
    const lga = (item?.lga || '').toLowerCase();
    
    return name.includes(term) || 
           email.includes(term) || 
           memberId.includes(term) || 
           state.includes(term) ||
           lga.includes(term);
  });
}

function filterPaidMembers(data, requireAll) {
  const membershipChecked = $('#paidFeeMembership')?.checked ?? true;
  const certificateChecked = $('#paidFeeCertificate')?.checked ?? true;
  const idcardChecked = $('#paidFeeIdcard')?.checked ?? true;
  
  return data.filter(item => {
    const flags = summarizePaidFlags(item);
    const conditions = [];
    
    if (membershipChecked) conditions.push(flags.membership);
    if (certificateChecked) conditions.push(flags.certificate);
    if (idcardChecked) conditions.push(flags.idcard);
    
    if (requireAll) {
      return conditions.every(condition => condition);
    } else {
      return conditions.some(condition => condition);
    }
  });
}

// ===== MEMBERS LOADING =====
async function loadMembersSimple(type) {
  try {
    let endpoint = '';
    switch(type) {
      case 'all': endpoint = `${API_BASE}/members`; break;
      case 'paid': endpoint = `${API_BASE}/members/paid`; break;
      case 'unpaid': endpoint = `${API_BASE}/members/unpaid`; break;
    }

    console.log(`Loading ${type} members from:`, endpoint);
    
    // Show loading indicator
    showLoading(`#list-members-${type}`);
    
    const res = await authFetch(endpoint);
    
    if (!res.ok) throw new Error(`HTTP ${res.status}: ${res.statusText}`);
    
    // FIX: Handle both response formats
    const response = await res.json();
    const items = response.data || response; // Use .data if it exists, otherwise use the response directly
    
    console.log(`Loaded ${items?.length || 0} ${type} members:`, items);
    
    // Store the data for filtering/export
    switch(type) {
      case 'all': currentAllData = items || []; break;
      case 'paid': currentPaidData = items || []; break;
      case 'unpaid': currentUnpaidData = items || []; break;
    }
    
    // Reset to page 1 when loading new data
    switch(type) {
      case 'all': allPage = 1; break;
      case 'paid': paidPage = 1; break;
      case 'unpaid': unpaidPage = 1; break;
    }
    
    // Apply filters and render
    renderFilteredMembers(type);
    
  } catch (err) {
    console.error(`loadMembersSimple(${type}) error:`, err);
    const tbody = document.getElementById(`list-members-${type}`);
    if (tbody) {
      tbody.innerHTML = '<tr><td colspan="6" class="text-center text-danger py-4">Failed to load members</td></tr>';
    }
  }
}

function renderFilteredMembers(type) {
  let data = [];
  let searchTerm = '';
  let filteredData = [];
  let currentPage = 1;
  
  switch(type) {
    case 'all':
      data = currentAllData;
      searchTerm = $('#allSearch')?.value || '';
      filteredData = filterMembers(data, searchTerm, 'all');
      currentPage = allPage;
      break;
      
    case 'paid':
      data = currentPaidData;
      searchTerm = $('#paidSearch')?.value || '';
      const requireAll = $('#paidLogicAll')?.checked || false;
      let paidFiltered = filterMembers(data, searchTerm, 'paid');
      paidFiltered = filterPaidMembers(paidFiltered, requireAll);
      filteredData = paidFiltered;
      currentPage = paidPage;
      break;
      
    case 'unpaid':
      data = currentUnpaidData;
      searchTerm = $('#unpaidSearch')?.value || '';
      filteredData = filterMembers(data, searchTerm, 'unpaid');
      currentPage = unpaidPage;
      break;
  }
  
  const tbody = document.getElementById(`list-members-${type}`);
  const countEl = document.getElementById(`${type}Count`);
  
  if (!tbody) return;

  // Clear existing content
  tbody.innerHTML = '';

  if (!filteredData.length) {
    tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-4">No members found</td></tr>';
    if (countEl) countEl.textContent = '0 results';
    return;
  }

  // Apply pagination
  const paginatedData = paginateData(filteredData, currentPage);
  
  // Render rows
  paginatedData.forEach((item, i) => {
    const globalIndex = (currentPage - 1) * PAGE_SIZE + i + 1;
    const row = document.createElement('tr');
    
    if (type === 'all') {
      const created = item?.createdAt ? new Date(item.createdAt).toLocaleDateString() : '';
      row.innerHTML = `
        <td>${globalIndex}</td>
        <td>${item?.name || ''}</td>
        <td>${item?.email || ''}</td>
        <td>${item?.memberId || item?.memberCode || ''}</td>
        <td>${item?.state || item?.lga || ''}</td>
        <td>${created}</td>
      `;
    } 
    else if (type === 'paid') {
      const flags = summarizePaidFlags(item);
      const paidList = [flags.membership ? 'Membership' : '', flags.certificate ? 'Certificate' : '', flags.idcard ? 'ID Card' : '']
        .filter(Boolean).join(' / ');
      row.innerHTML = `
        <td>${globalIndex}</td>
        <td>${item?.name || ''}</td>
        <td>${item?.email || ''}</td>
        <td>${item?.memberId || item?.memberCode || ''}</td>
        <td>${item?.state || item?.lga || ''}</td>
        <td>${paidList || '-'}</td>
      `;
    }
    else if (type === 'unpaid') {
      const missing = unpaidListFromFlags(summarizePaidFlags(item));
      row.innerHTML = `
        <td>${globalIndex}</td>
        <td>${item?.name || ''}</td>
        <td>${item?.email || ''}</td>
        <td>${item?.memberId || item?.memberCode || ''}</td>
        <td>${item?.state || item?.lga || ''}</td>
        <td>${missing || 'All paid'}</td>
      `;
    }
    
    tbody.appendChild(row);
  });

  // Update pagination controls
  updatePagination(type, filteredData, currentPage);
}


// ===== MISSING FUNCTIONALITY IMPLEMENTATION =====

// 1. Form reset buttons for all forms
function setupFormResetButtons() {
  document.querySelectorAll('[data-reset]').forEach(btn => {
    btn.addEventListener('click', function() {
      const formSelector = this.getAttribute('data-reset');
      resetForm(formSelector);
      
      // Show feedback
      const form = document.querySelector(formSelector);
      const statusElement = form?.querySelector('.text-muted');
      if (statusElement) {
        statusElement.textContent = 'Form reset.';
        setTimeout(() => statusElement.textContent = '', 2000);
      }
    });
  });
}

// 2. Auto-slug generation for blogs
function setupAutoSlugGeneration() {
  const titleField = document.querySelector('#form-blog [name="title"]');
  const slugField = document.querySelector('#form-blog [name="slug"]');
  
  if (titleField && slugField) {
    titleField.addEventListener('blur', function() {
      // Only auto-generate if slug is empty and title has value
      if (!slugField.value && titleField.value) {
        const slug = titleField.value
          .toLowerCase()
          .replace(/[^a-z0-9 -]/g, '') // Remove invalid chars
          .replace(/\s+/g, '-')        // Replace spaces with -
          .replace(/-+/g, '-')         // Replace multiple - with single -
          .trim();
        slugField.value = slug;
        
        // Show feedback
        const statusElement = document.querySelector('#blogStatus');
        if (statusElement) {
          statusElement.textContent = 'Slug auto-generated.';
          setTimeout(() => statusElement.textContent = '', 2000);
        }
      }
    });
  }
}

// 3. Enhanced form submission feedback
function enhanceFormSubmissions() {
  // Add loading states to all form submit buttons
  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
      const submitBtn = this.querySelector('button[type="submit"]');
      if (submitBtn) {
        showButtonLoading(submitBtn, 'Saving...');
        
        // Re-enable button after 5 seconds (safety net)
        setTimeout(() => hideButtonLoading(submitBtn), 5000);
      }
    });
  });
}

// ===== PAGINATION HANDLERS =====
function setupPaginationHandlers() {
  // All members pagination
  $('#allPrev')?.addEventListener('click', () => {
    if (allPage > 1) {
      allPage--;
      renderFilteredMembers('all');
    }
  });
  
  $('#allNext')?.addEventListener('click', () => {
    const filteredData = filterMembers(currentAllData, $('#allSearch')?.value || '', 'all');
    const totalPages = Math.ceil(filteredData.length / PAGE_SIZE);
    if (allPage < totalPages) {
      allPage++;
      renderFilteredMembers('all');
    }
  });
  
  // Paid members pagination
  $('#paidPrev')?.addEventListener('click', () => {
    if (paidPage > 1) {
      paidPage--;
      renderFilteredMembers('paid');
    }
  });
  
  $('#paidNext')?.addEventListener('click', () => {
    const searchTerm = $('#paidSearch')?.value || '';
    const requireAll = $('#paidLogicAll')?.checked || false;
    let paidFiltered = filterMembers(currentPaidData, searchTerm, 'paid');
    paidFiltered = filterPaidMembers(paidFiltered, requireAll);
    const totalPages = Math.ceil(paidFiltered.length / PAGE_SIZE);
    if (paidPage < totalPages) {
      paidPage++;
      renderFilteredMembers('paid');
    }
  });
  
  // Unpaid members pagination
  $('#unpaidPrev')?.addEventListener('click', () => {
    if (unpaidPage > 1) {
      unpaidPage--;
      renderFilteredMembers('unpaid');
    }
  });
  
  $('#unpaidNext')?.addEventListener('click', () => {
    const filteredData = filterMembers(currentUnpaidData, $('#unpaidSearch')?.value || '', 'unpaid');
    const totalPages = Math.ceil(filteredData.length / PAGE_SIZE);
    if (unpaidPage < totalPages) {
      unpaidPage++;
      renderFilteredMembers('unpaid');
    }
  });
}

// ===== EXPORT HANDLERS =====
async function handleExport(type) {
  try {
    const button = $(`#btnExport${type.charAt(0).toUpperCase() + type.slice(1)}`);
    showButtonLoading(button, 'Exporting...');
    
    // Get current filtered data for export (all data, not just current page)
    let dataToExport = [];
    switch(type) {
      case 'all': dataToExport = filterMembers(currentAllData, $('#allSearch')?.value || '', 'all'); break;
      case 'paid': 
        let paidData = filterMembers(currentPaidData, $('#paidSearch')?.value || '', 'paid');
        const requireAll = $('#paidLogicAll')?.checked || false;
        dataToExport = filterPaidMembers(paidData, requireAll);
        break;
      case 'unpaid': dataToExport = filterMembers(currentUnpaidData, $('#unpaidSearch')?.value || '', 'unpaid'); break;
    }
    
    const csv = convertToCSV(dataToExport, type);
    const filename = `${type}-members-${new Date().toISOString().split('T')[0]}.csv`;
    
    downloadCSV(csv, filename);
    
    setTimeout(() => hideButtonLoading(button), 1000);
    
  } catch (err) {
    console.error(`Export ${type} error:`, err);
    const button = $(`#btnExport${type.charAt(0).toUpperCase() + type.slice(1)}`);
    hideButtonLoading(button);
    alert('Export failed. Please try again.');
  }
}

// ===== HOME SETTINGS =====
async function loadHomeSettings() {
  try {
    const res = await authFetch(`${API_BASE}/settings/home`);
    if (!res?.ok) return;

    const data = await res.json();

    const set = (name, val) => {
      const el = document.querySelector(`[name="${name}"]`);
      if (!el) return;
      el.value = (val ?? '') + '';
    };

    set('about.title', data?.about?.title);
    set('about.headline', data?.about?.headline);
    set('about.paragraphs',
      Array.isArray(data?.about?.paragraphs)
        ? data.about.paragraphs.join('\n')
        : (data?.about?.paragraphs || '')
    );
    
    // Set about image
    if (data?.about?.image) {
      setImageFromUrl('aboutImage', data.about.image);
    }

    const pairs = [
      ['services', 'title'], ['services', 'subtitle'],
      ['projects', 'title'], ['projects', 'subtitle'],
      ['features', 'title'], ['features', 'headline'],
      ['offer', 'title'],
      ['blog', 'title'], ['blog', 'showCount'],
      ['faqs', 'title'], ['faqs', 'image'],
      ['team', 'title']
    ];

    pairs.forEach(([k1, k2]) => {
      const el = document.querySelector(`[name="${k1}.${k2}"]`);
      if (!el) return;
      const v = data?.[k1]?.[k2];
      el.value = (v ?? '') + '';
    });
    
    // Set FAQs image
    if (data?.faqs?.image) {
      setImageFromUrl('faqsImage', data.faqs.image);
    }
  } catch (e) {
    console.error('loadHomeSettings error:', e);
  }
}

// ===== GENERIC CRUD (content sections) =====
const resources = {
  sliders: {
    endpoint: '/sliders', listEl: '#list-sliders', form: '#form-slider', status: '#sliderStatus',
    toPayload: (fd) => {
      const kicker = fd.get('kicker') || '';
      const headline = fd.get('headline') || '';
      const text = fd.get('text') || '';
      const c1Label = fd.get('cta1.label') || '';
      const c1Href = fd.get('cta1.href') || '';
      const c1VideoUrl = fd.get('cta1.videoUrl') || '';
      const c1VideoFile = document.getElementById('sliderVideoUrl')?.value || '';
      const c2Label = fd.get('cta2.label') || '';
      const c2Href = fd.get('cta2.href') || '';
      const image = document.getElementById('sliderImageUrl')?.value || '';
      const order = Number(fd.get('order') || 0) || 0;
      
      return {
        kicker, headline, text,
        cta1: c1Label || c1Href || c1VideoUrl || c1VideoFile ? { 
          label: c1Label, 
          href: c1Href,
          videoUrl: c1VideoUrl,
          videoFile: c1VideoFile
        } : undefined,
        cta2: c2Label || c2Href ? { label: c2Label, href: c2Href } : undefined,
        image,
        order,
        // Legacy field mappings for backward compatibility
        smallTitle: kicker, 
        bigTitle: headline, 
        paragraph: text,
        primaryBtnText: c1Label, 
        primaryBtnLink: c1Href,
        primaryBtnVideoUrl: c1VideoUrl,
        primaryBtnVideoFile: c1VideoFile,
        secondaryBtnText: c2Label, 
        secondaryBtnLink: c2Href,
        imageUrl: image
      };
    },
    renderRow: (item, i) => {
  const img = item.image || item.imageUrl || '';
  const kick = item.kicker || item.smallTitle || '';
  const head = item.headline || item.bigTitle || '';
  const c1 = (item.cta1 && item.cta1.label) || item.primaryBtnText || '';
  const c2 = (item.cta2 && item.cta2.label) || item.secondaryBtnText || '';
  const ord = (item.order ?? '') + '';
  
  // Check if video is configured
  const hasVideo = (item.cta1?.videoUrl || item.cta1?.videoFile || item.primaryBtnVideoUrl || item.primaryBtnVideoFile) ? '✅ Video' : '❌ No Video';
  
  return `<tr>
    <td>${i + 1}</td>
    <td>${img ? `<img class="img-thumb" src="${img}">` : ''}</td>
    <td>${kick}</td>
    <td>${head}</td>
    <td>${[c1, c2].filter(Boolean).join(' / ')}</td>
    <td>${hasVideo}</td>
    <td>${ord}</td>
    <td class="text-end">
      <button class="btn btn-sm btn-outline-primary" data-edit="sliders" data-id="${item._id}">Edit</button>
      <button class="btn btn-sm btn-outline-danger" data-del="sliders" data-id="${item._id}">Delete</button>
    </td>
  </tr>`;
}
  },
  services: {
    endpoint: '/services', listEl: '#list-services', form: '#form-service', status: '#serviceStatus',
    toPayload: (fd) => ({ 
      title: fd.get('title') || '', 
      description: fd.get('description') || '', 
      image: document.getElementById('serviceImageUrl')?.value || '', 
      link: fd.get('link') || '' 
    }),
    renderRow: (item, i) => `<tr><td>${i + 1}</td><td>${item.image ? '<img class="img-thumb" src="' + item.image + '">' : ''}</td><td>${item.title || ''}</td><td>${item.description || ''}</td><td>${item.link || ''}</td>
    <td class="text-end"><button class="btn btn-sm btn-outline-primary" data-edit="services" data-id="${item._id}">Edit</button>
    <button class="btn btn-sm btn-outline-danger" data-del="services" data-id="${item._id}">Delete</button></td></tr>`
  },
  projects: {
    endpoint: '/projects', listEl: '#list-projects', form: '#form-project', status: '#projectStatus',
    toPayload: (fd) => ({ 
      title: fd.get('title') || '', 
      category: fd.get('category') || '', 
      description: fd.get('description') || '', 
      image: document.getElementById('projectImageUrl')?.value || '', 
      link: fd.get('link') || '' 
    }),
    renderRow: (item, i) => `<tr><td>${i + 1}</td><td>${item.image ? '<img class="img-thumb" src="' + item.image + '">' : ''}</td><td>${item.title || ''}</td><td>${item.category || ''}</td><td>${item.link || ''}</td>
    <td class="text-end"><button class="btn btn-sm btn-outline-primary" data-edit="projects" data-id="${item._id}">Edit</button>
    <button class="btn btn-sm btn-outline-danger" data-del="projects" data-id="${item._id}">Delete</button></td></tr>`
  },
  features: {
    endpoint: '/features', listEl: '#list-features', form: '#form-feature', status: '#featureStatus',
    toPayload: (fd) => ({ title: fd.get('title') || '', subtitle: fd.get('subtitle') || '', description: fd.get('description') || '', icon: fd.get('icon') || '' }),
    renderRow: (item, i) => `<tr><td>${i + 1}</td><td>${item.icon || ''}</td><td>${item.title || ''}</td><td>${item.subtitle || ''}</td>
    <td class="text-end"><button class="btn btn-sm btn-outline-primary" data-edit="features" data-id="${item._id}">Edit</button>
    <button class="btn btn-sm btn-outline-danger" data-del="features" data-id="${item._id}">Delete</button></td></tr>`
  },
  offers: {
    endpoint: '/offers', listEl: '#list-offers', form: '#form-offer', status: '#offerStatus',
    toPayload: (fd) => ({ 
      title: fd.get('title') || '', 
      description: fd.get('description') || '', 
      image: document.getElementById('offerImageUrl')?.value || '' 
    }),
    renderRow: (item, i) => `<tr><td>${i + 1}</td><td>${item.image ? '<img class="img-thumb" src="' + item.image + '">' : ''}</td><td>${item.title || ''}</td>
    <td class="text-end"><button class="btn btn-sm btn-outline-primary" data-edit="offers" data-id="${item._id}">Edit</button>
    <button class="btn btn-sm btn-outline-danger" data-del="offers" data-id="${item._id}">Delete</button></td></tr>`
  },
  blogs: {
    endpoint: '/blogs', listEl: '#list-blogs', form: '#form-blog', status: '#blogStatus',
    toPayload: (fd) => ({ 
      title: fd.get('title') || '', 
      slug: fd.get('slug') || '', 
      excerpt: fd.get('excerpt') || '', 
      content: fd.get('content') || '', 
      image: document.getElementById('blogImageUrl')?.value || '' 
    }),
    renderRow: (item, i) => `<tr><td>${i + 1}</td><td>${item.image ? '<img class="img-thumb" src="' + item.image + '">' : ''}</td><td>${item.title || ''}</td><td>${item.slug || ''}</td>
    <td class="text-end"><button class="btn btn-sm btn-outline-primary" data-edit="blogs" data-id="${item._id}">Edit</button>
    <button class="btn btn-sm btn-outline-danger" data-del="blogs" data-id="${item._id}">Delete</button></td></tr>`
  },
  faqs: {
    endpoint: '/faqs', listEl: '#list-faqs', form: '#form-faq', status: '#faqStatus',
    toPayload: (fd) => ({ question: fd.get('question') || '', answer: fd.get('answer') || '' }),
    renderRow: (item, i) => `<tr><td>${i + 1}</td><td>${item.question || ''}</td><td>${item.answer || ''}</td>
    <td class="text-end"><button class="btn btn-sm btn-outline-primary" data-edit="faqs" data-id="${item._id}">Edit</button>
    <button class="btn btn-sm btn-outline-danger" data-del="faqs" data-id="${item._id}">Delete</button></td></tr>`
  },
  team: {
    endpoint: '/team', listEl: '#list-team', form: '#form-team', status: '#teamStatus',
    toPayload: (fd) => ({ 
      name: fd.get('name') || '', 
      role: fd.get('role') || '', 
      image: document.getElementById('teamImageUrl')?.value || '', 
      facebook: fd.get('facebook') || '', 
      twitter: fd.get('twitter') || '', 
      linkedin: fd.get('linkedin') || '' 
    }),
    renderRow: (item, i) => `<tr><td>${i + 1}</td><td>${item.image ? '<img class="img-thumb" src="' + item.image + '">' : ''}</td><td>${item.name || ''}</td><td>${item.role || ''}</td>
    <td class="text-end"><button class="btn btn-sm btn-outline-primary" data-edit="team" data-id="${item._id}">Edit</button>
    <button class="btn btn-sm btn-outline-danger" data-del="team" data-id="${item._id}">Delete</button></td></tr>`
  }
};

async function loadList(key) {
  try {
    const cfg = resources[key];
    if (!cfg) return;
    const res = await authFetch(`${API_BASE}${cfg.endpoint}`);
    if (!res?.ok) return;
    
    // FIX: Handle both response formats
    const response = await res.json();
    const items = response.data || response; // Use .data if it exists, otherwise use the response directly
    
    const html = (items || [])
      .slice()
      .sort((a, b) => (Number(a?.order ?? 0)) - (Number(b?.order ?? 0)))
      .map(cfg.renderRow)
      .join('');
    const container = document.querySelector(cfg.listEl);
    if (container) container.innerHTML = html;
  } catch (e) {
    console.error(`loadList(${key}) error:`, e);
  }
}

function fillFormFromItem(formSel, item) {
  const form = document.querySelector(formSel);
  if (!form || !item) return;

  Object.keys(item).forEach(k => {
    const el = form.querySelector(`[name="${k}"]`);
    if (el) el.value = (item[k] ?? '') + '';
  });

  const idEl = form.querySelector('[name="_id"]');
  if (idEl) idEl.value = item._id || '';

  if (formSel === '#form-slider') {
    const map = {
      'kicker': item.kicker ?? item.smallTitle ?? '',
      'headline': item.headline ?? item.bigTitle ?? '',
      'text': item.text ?? item.paragraph ?? '',
      'cta1.label': item.cta1?.label ?? item.primaryBtnText ?? '',
      'cta1.href': item.cta1?.href ?? item.primaryBtnLink ?? '',
      'cta2.label': item.cta2?.label ?? item.secondaryBtnText ?? '',
      'cta2.href': item.cta2?.href ?? item.secondaryBtnLink ?? '',
      'image': item.image ?? item.imageUrl ?? '',
      'order': item.order ?? 0
    };
    Object.entries(map).forEach(([name, val]) => {
      const el = form.querySelector(`[name="${name}"]`);
      if (el) el.value = (val ?? '') + '';
    });
    
    // Set image preview for slider
    if (item.image || item.imageUrl) {
      setImageFromUrl('sliderImage', item.image || item.imageUrl);
    }
  }
  
  // Set image previews for other forms
  if (formSel === '#form-service' && (item.image)) {
    setImageFromUrl('serviceImage', item.image);
  }
  if (formSel === '#form-project' && (item.image)) {
    setImageFromUrl('projectImage', item.image);
  }
  if (formSel === '#form-offer' && (item.image)) {
    setImageFromUrl('offerImage', item.image);
  }
  if (formSel === '#form-blog' && (item.image)) {
    setImageFromUrl('blogImage', item.image);
  }
  if (formSel === '#form-team' && (item.image)) {
    setImageFromUrl('teamImage', item.image);
  }
}

async function createOrUpdate(e, key) {
  e.preventDefault();
  try {
    const cfg = resources[key];
    if (!cfg) return;
    const fd = new FormData(e.target);
    const id = fd.get('_id');
    const method = id ? 'PUT' : 'POST';
    const url = id ? `${API_BASE}${cfg.endpoint}/${id}` : `${API_BASE}${cfg.endpoint}`;
    const payload = cfg.toPayload(fd);
    const res = await authFetch(url, json({ method, body: JSON.stringify(payload) }));
    document.querySelector(cfg.status) && (document.querySelector(cfg.status).textContent = res.ok ? 'Saved.' : 'Failed.');
    if (res.ok) { resetForm(cfg.form); loadList(key); }
  } catch (err) {
    console.error(`createOrUpdate ${key} error:`, err);
   const statusElement = resources[key] && resources[key].status ? document.querySelector(resources[key].status) : null;
if (statusElement) statusElement.textContent = 'Failed.';
  }
}

async function deleteItem(key, id) {
  try {
    if (!confirm('Delete this item?')) return;
    const cfg = resources[key];
    if (!cfg) return;
    const res = await authFetch(`${API_BASE}${cfg.endpoint}/${id}`, { method: 'DELETE' });
    if (res?.ok) loadList(key);
  } catch (err) {
    console.error(`deleteItem ${key} error:`, err);
  }
}

// ===== EVENT LISTENERS FOR ALL FEATURES =====
document.addEventListener('DOMContentLoaded', function() {
  // Add logout button event listener
  const logoutBtn = document.getElementById('logoutBtn');
  if (logoutBtn) {
    logoutBtn.addEventListener('click', handleLogout);
  }
   // Initialize video uploads
  initializeVideoUploads();

  // Search functionality
  $('#allSearch')?.addEventListener('input', () => {
    allPage = 1; // Reset to page 1 when searching
    renderFilteredMembers('all');
  });
  $('#paidSearch')?.addEventListener('input', () => {
    paidPage = 1; // Reset to page 1 when searching
    renderFilteredMembers('paid');
  });
  $('#unpaidSearch')?.addEventListener('input', () => {
    unpaidPage = 1; // Reset to page 1 when searching
    renderFilteredMembers('unpaid');
  });
  
  // Paid member filter options
  $('#paidFeeMembership')?.addEventListener('change', () => {
    paidPage = 1; // Reset to page 1 when changing filters
    renderFilteredMembers('paid');
  });
  $('#paidFeeCertificate')?.addEventListener('change', () => {
    paidPage = 1; // Reset to page 1 when changing filters
    renderFilteredMembers('paid');
  });
  $('#paidFeeIdcard')?.addEventListener('change', () => {
    paidPage = 1; // Reset to page 1 when changing filters
    renderFilteredMembers('paid');
  });
  $('#paidLogicAll')?.addEventListener('change', () => {
    paidPage = 1; // Reset to page 1 when changing filters
    renderFilteredMembers('paid');
  });
  
  // Export functionality
  $('#btnExportAll')?.addEventListener('click', () => handleExport('all'));
  $('#btnExportPaid')?.addEventListener('click', () => handleExport('paid'));
  $('#btnExportUnpaid')?.addEventListener('click', () => handleExport('unpaid'));
  
  // Reload buttons with loading states
  $('#btnReloadAll')?.addEventListener('click', async () => {
    showButtonLoading($('#btnReloadAll'), 'Reloading...');
    await loadMembersSimple('all');
    hideButtonLoading($('#btnReloadAll'));
  });
  
  $('#btnReloadPaid')?.addEventListener('click', async () => {
    showButtonLoading($('#btnReloadPaid'), 'Reloading...');
    await loadMembersSimple('paid');
    hideButtonLoading($('#btnReloadPaid'));
  });
  
  $('#btnReloadUnpaid')?.addEventListener('click', async () => {
    showButtonLoading($('#btnReloadUnpaid'), 'Reloading...');
    await loadMembersSimple('unpaid');
    hideButtonLoading($('#btnReloadUnpaid'));
  });
  
  // Setup missing functionality
  setupFormResetButtons();
  setupAutoSlugGeneration();
  enhanceFormSubmissions();
  setupPaginationHandlers(); // Setup pagination handlers
  
  // Add reset button handler for slider form
  $('#resetSliderForm')?.addEventListener('click', () => resetForm('#form-slider'));
  
  // Form submissions
  $('#form-home-about')?.addEventListener('submit', async (e) => {
    e.preventDefault();
    try {
      const fd = new FormData(e.target);
      const payload = {
        about: {
          title: fd.get('about.title') || '',
          headline: fd.get('about.headline') || '',
          paragraphs: (fd.get('about.paragraphs') || '')
            .replace(/\r\n/g, '\n')
            .split('\n')
            .map(s => s.trim())
            .filter(Boolean),
          image: document.getElementById('aboutImageUrl')?.value || ''
        }
      };
      const res = await authFetch(`${API_BASE}/settings/home`, json({ method: 'PUT', body: JSON.stringify(payload) }));
      $('#aboutStatus') && ($('#aboutStatus').textContent = res.ok ? 'Saved.' : 'Failed.');
      if (res.ok) loadHomeSettings();
    } catch (err) {
      console.error('About save error:', err);
      $('#aboutStatus') && ($('#aboutStatus').textContent = 'Failed.');
    }
  });

  $('#form-home-sections')?.addEventListener('submit', async (e) => {
    e.preventDefault();
    try {
      const fd = new FormData(e.target);
      const payload = {
        services: { title: fd.get('services.title') || '', subtitle: fd.get('services.subtitle') || '' },
        projects: { title: fd.get('projects.title') || '', subtitle: fd.get('projects.subtitle') || '' },
        features: { title: fd.get('features.title') || '', headline: fd.get('features.headline') || '' },
        offer: { title: fd.get('offer.title') || '' },
        blog: { title: fd.get('blog.title') || '', showCount: Number(fd.get('blog.showCount') || 3) || 3 },
        faqs: { title: fd.get('faqs.title') || '', image: document.getElementById('faqsImageUrl')?.value || '' },
        team: { title: fd.get('team.title') || '' }
      };
      const res = await authFetch(`${API_BASE}/settings/home`, json({ method: 'PUT', body: JSON.stringify(payload) }));
      $('#sectionsStatus') && ($('#sectionsStatus').textContent = res.ok ? 'Saved.' : 'Failed.');
      if (res.ok) loadHomeSettings();
    } catch (err) {
      console.error('Sections save error:', err);
      $('#sectionsStatus') && ($('#sectionsStatus').textContent = 'Failed.');
    }
  });

  // Generic CRUD form submissions
  Object.keys(resources).forEach(key => {
    const formSel = resources[key].form;
    document.querySelector(formSel)?.addEventListener('submit', (e) => createOrUpdate(e, key));
  });

  // Edit and delete buttons
  document.body.addEventListener('click', async (e) => {
    const editBtn = e.target.closest?.('[data-edit]');
    const delBtn = e.target.closest?.('[data-del]');
    if (editBtn) {
      const key = editBtn.getAttribute('data-edit');
      const id = editBtn.getAttribute('data-id');
      const cfg = resources[key];
      if (!cfg) return;
      const res = await authFetch(`${API_BASE}${cfg.endpoint}/${id}`);
      if (!res?.ok) return;
      const item = await res.json();
      fillFormFromItem(cfg.form, item);
    }
    if (delBtn) {
      const key = delBtn.getAttribute('data-del');
      const id = delBtn.getAttribute('data-id');
      deleteItem(key, id);
    }
  });
});



// ===== MISSING MEMBER LOADING FUNCTIONS =====
function loadAllMembers() {
  return loadMembersSimple('all');
}

function loadPaidMembers() {
  return loadMembersSimple('paid');
}

function loadUnpaidMembers() {
  return loadMembersSimple('unpaid');
}

// ===== INITIAL LOADS =====
loadHomeSettings();
Object.keys(resources).forEach(loadList);

// Load members when tabs are shown
document.getElementById('tab-members-all')?.addEventListener('shown.bs.tab', loadAllMembers);
document.getElementById('tab-members-paid')?.addEventListener('shown.bs.tab', loadPaidMembers);
document.getElementById('tab-members-unpaid')?.addEventListener('shown.bs.tab', loadUnpaidMembers);

// IMPORTANT: Load all members on initial page load
console.log('🟡 Loading members on page load...');
loadAllMembers();
loadPaidMembers(); 
loadUnpaidMembers();
