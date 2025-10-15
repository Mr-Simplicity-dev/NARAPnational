<!DOCTYPE html>

<html lang="en">
<head>
   <link rel="icon" type="image/png" href="/uploads/slider/Narap.png"/>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-Security-Policy" content="
    default-src 'self'; 
    style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://d2mpatx37cqexb.cloudfront.net https://use.fontawesome.com https://embed.tawk.to https://cdn.tawk.to https://*.tawk.to https://paystack.com https://*.paystack.com; 
    font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com https://use.fontawesome.com; 
    script-src 'self' 'unsafe-inline' https://js.paystack.co https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://api.paystack.com; 
    connect-src 'self' https://api.paystack.co https://checkout.paystack.com; 
    frame-src 'self' https://js.paystack.co https://*.paystack.com https://checkout.paystack.com;
    child-src 'self' https://js.paystack.co https://*.paystack.com https://checkout.paystack.com;
">
<title>Member Dashboard · Payments</title>
<<style>
    :root {
  --brand: #0a7f41;
  --brand-50: #eaf7f0;
  --brand-100: #d1efdd;
  --brand-600: #0a7f41;
  --brand-700: #086d37;
  --brand-800: #065a2d;
  --ink: #0b1220;
  --muted: #6b7280;
  --surface: #ffffff;
  --bg: #f8fafc;
  --border: #e2e8f0;
  --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  --gradient: linear-gradient(135deg, var(--brand-600), var(--brand-700));
  --ok: #16a34a; 
  --warn: #f59e0b; 
  --err: #ef4444;
}

* { 
  box-sizing: border-box; 
  margin: 0; 
  padding: 0; 
}

body {
  font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial, sans-serif;
  background: var(--bg); 
  color: var(--ink); 
  line-height: 1.6;
}

/* Header */
header {
  display: flex; 
  align-items: center; 
  justify-content: space-between;
  background: var(--gradient); 
  color: #fff; 
  padding: 16px 24px;
  position: sticky; 
  top: 0; 
  z-index: 100;
  box-shadow: var(--shadow-lg);
}

header .title { 
  font-weight: 700; 
  font-size: 1.25rem;
}

header .title span {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

/* Header Menu */
.menu {
  position: relative;
}

.menu-toggle {
  background: rgba(255, 255, 255, 0.1);
  color: white;
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 8px;
  padding: 8px 16px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s ease;
}

.menu-toggle:hover {
  background: rgba(255, 255, 255, 0.2);
}

.menu-list {
  position: absolute;
  top: 100%;
  right: 0;
  background: white;
  border-radius: 8px;
  box-shadow: var(--shadow-lg);
  min-width: 180px;
  padding: 8px 0;
  margin-top: 8px;
  display: none;
  z-index: 1000;
}

.menu-list.show {
  display: block;
}

.menu-list a {
  display: block;
  padding: 12px 16px;
  color: var(--ink);
  text-decoration: none;
  transition: background 0.2s ease;
}

.menu-list a:hover {
  background: var(--brand-50);
  color: var(--brand-700);
}

/* Header Actions */
.actions {
  display: flex;
  gap: 12px;
  align-items: center;
}

header a.btn, header button {
  background: rgba(255, 255, 255, 0.9); 
  color: var(--brand); 
  border: 0; 
  border-radius: 8px;
  padding: 10px 16px; 
  font-weight: 600; 
  text-decoration: none; 
  cursor: pointer;
  transition: all 0.2s ease;
  font-size: 0.9rem;
}

header a.btn:hover, header button:hover {
  background: white;
  transform: translateY(-1px);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Container */
.container { 
  max-width: 1200px; 
  margin: 24px auto; 
  padding: 0 20px; 
}

/* Grid */
.grid { 
  display: grid; 
  grid-template-columns: 1fr; 
  gap: 24px; 
}

@media (min-width: 900px) { 
  .grid { 
    grid-template-columns: 2fr 1fr; 
  } 
}

/* Panels */
.panel {
  background: var(--surface); 
  border-radius: 16px;
  box-shadow: var(--shadow); 
  padding: 24px;
  border: 1px solid var(--border);
  transition: all 0.3s ease;
}

.panel:hover {
  box-shadow: var(--shadow-lg);
  transform: translateY(-2px);
}

/* Profile Section */
.profile {
  display: flex; 
  gap: 16px; 
  align-items: center;
  padding-bottom: 20px; 
  border-bottom: 2px solid var(--brand-50);
  margin-bottom: 20px;
}

.profile img {
  width: 80px; 
  height: 80px; 
  border-radius: 50%;
  object-fit: cover; 
  border: 3px solid var(--brand-100); 
  background: #fff;
  transition: all 0.3s ease;
}

.profile img:hover {
  border-color: var(--brand);
  transform: scale(1.05);
}

/* Typography */
.muted { 
  color: var(--muted); 
  font-size: 14px; 
}

.list { 
  display: flex; 
  flex-direction: column; 
  gap: 12px; 
  margin-top: 20px; 
}

.item {
  display: flex; 
  justify-content: space-between; 
  gap: 12px;
  padding: 12px 0; 
  border-bottom: 1px solid var(--border);
  transition: all 0.2s ease;
}

.item:hover {
  padding-left: 8px;
  border-left: 3px solid var(--brand);
}

/* Pills/Badges */
.pill {
  display: inline-flex;
  align-items: center;
  background: var(--brand-50); 
  color: var(--brand-700);
  padding: 4px 12px; 
  border-radius: 20px; 
  font-size: 12px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Payment Cards */
.pay-card {
  display: flex; 
  flex-direction: column; 
  gap: 8px;
  border: 2px solid var(--brand-100); 
  border-radius: 16px; 
  padding: 20px;
  margin-bottom: 20px;
  background: linear-gradient(135deg, var(--brand-50), white);
  transition: all 0.3s ease;
}

.pay-card:hover {
  border-color: var(--brand);
  transform: translateY(-2px);
  box-shadow: var(--shadow-lg);
}

.pay-card .h { 
  font-weight: 700; 
  font-size: 1.1rem;
  color: var(--brand-700);
}

.pay-card .a { 
  font-size: 14px; 
  color: var(--muted); 
}

.pay-card .price { 
  font-size: 28px; 
  font-weight: 900; 
  color: var(--brand);
  margin-top: 8px;
}

/* Buttons */
.btn {
  padding: 12px 20px; 
  border: 0; 
  border-radius: 10px;
  background: var(--brand); 
  color: #fff; 
  font-weight: 600;
  cursor: pointer; 
  transition: all 0.3s ease; 
  margin-top: 12px;
  font-size: 0.95rem;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  text-decoration: none;
}

.btn:hover { 
  background: var(--brand-700);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(10, 127, 65, 0.3);
}

.btn:disabled { 
  background: #94a3b8; 
  cursor: not-allowed;
  transform: none;
  box-shadow: none;
}

.btn.secondary {
  background: transparent;
  color: var(--brand);
  border: 2px solid var(--brand);
}

.btn.secondary:hover {
  background: var(--brand);
  color: white;
}

/* Status Colors */
.ok { color: var(--ok); } 
.warn { color: var(--warn); } 
.err { color: var(--err); }

/* Status Panel */
.status-panel {
  display: flex; 
  justify-content: space-between; 
  flex-wrap: wrap;
  background: var(--brand-50); 
  padding: 16px 20px; 
  border-radius: 12px;
  margin-bottom: 24px;
  border: 1px solid var(--brand-100);
}

.status {
  display: flex; 
  align-items: center; 
  gap: 10px;
  margin: 6px 0;
  font-weight: 500;
}

.status-dot {
  width: 12px; 
  height: 12px; 
  border-radius: 50%;
  box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.8);
}

.connected { background: var(--ok); }
.disconnected { background: var(--err); }
.warning { background: var(--warn); }

/* Notification System */
.notification {
  position: fixed; 
  top: 24px; 
  right: 24px; 
  padding: 16px 24px;
  border-radius: 12px; 
  color: white; 
  background: var(--err);
  box-shadow: var(--shadow-lg); 
  z-index: 1000;
  transform: translateX(100%); 
  transition: transform 0.3s ease;
  max-width: 380px;
  font-weight: 500;
}

.notification.show { 
  transform: translateX(0); 
}

.notification.success { 
  background: var(--ok); 
}

/* Payment Methods */
.payment-methods {
  display: grid; 
  grid-template-columns: repeat(3, 1fr);
  gap: 12px; 
  margin: 20px 0;
}

.payment-method {
  border: 2px solid var(--border); 
  border-radius: 12px;
  padding: 16px; 
  text-align: center; 
  cursor: pointer;
  transition: all 0.3s ease;
  background: white;
}

.payment-method:hover {
  border-color: var(--brand); 
  transform: translateY(-3px);
  box-shadow: var(--shadow-lg);
}

.payment-method.active {
  border-color: var(--brand); 
  background: var(--brand-50);
}

.payment-method h4 {
  margin: 8px 0; 
  font-size: 15px;
  color: var(--ink);
  font-weight: 600;
}

.payment-method p {
  margin: 0; 
  font-size: 13px; 
  color: var(--muted);
}

/* Debug Panel */
.debug-panel {
  background: #f8f9fa; 
  border: 1px solid var(--border);
  border-radius: 12px; 
  padding: 20px; 
  margin-top: 24px;
  font-family: 'Monaco', 'Menlo', monospace; 
  font-size: 13px;
  max-height: 250px; 
  overflow-y: auto;
}

.debug-title {
  font-weight: 700; 
  margin-bottom: 12px; 
  color: var(--brand);
  font-size: 14px;
}

.debug-log { 
  margin: 6px 0; 
  padding: 6px; 
  border-bottom: 1px solid #eee; 
}

.debug-error { color: var(--err); }
.debug-success { color: var(--ok); }

/* Loading Indicator */
.loading {
  display: inline-block; 
  width: 20px; 
  height: 20px;
  border: 3px solid rgba(255,255,255,.3); 
  border-radius: 50%;
  border-top-color: #fff; 
  animation: spin 1s ease-in-out infinite;
}

@keyframes spin { 
  to { transform: rotate(360deg); } 
}

/* Modal */
.modal {
  position: fixed; 
  top: 0; 
  left: 0; 
  right: 0; 
  bottom: 0;
  background: rgba(0, 0, 0, 0.6); 
  display: flex;
  align-items: center; 
  justify-content: center; 
  z-index: 2000;
  opacity: 0; 
  visibility: hidden; 
  transition: all 0.3s ease;
}

.modal.show { 
  opacity: 1; 
  visibility: visible; 
}

.modal-content {
  background: white; 
  border-radius: 16px; 
  padding: 32px;
  width: 90%; 
  max-width: 420px; 
  box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}

.modal-title {
  font-size: 22px; 
  font-weight: 700; 
  margin-bottom: 16px;
  color: var(--err);
}

.modal-message { 
  margin-bottom: 28px; 
  color: var(--muted);
  line-height: 1.6;
}

.modal-actions {
  display: flex; 
  gap: 12px; 
  justify-content: flex-end;
}

/* Responsive Design */
@media (max-width: 768px) {
  .container {
    padding: 0 16px;
    margin: 16px auto;
  }
  
  header {
    padding: 12px 16px;
  }
  
  .panel {
    padding: 20px;
  }
  
  .profile {
    flex-direction: column;
    text-align: center;
    gap: 12px;
  }
  
  .payment-methods {
    grid-template-columns: 1fr;
  }
  
  .actions {
    flex-direction: column;
    gap: 8px;
  }
  
  header a.btn, header button {
    padding: 8px 12px;
    font-size: 0.85rem;
  }
}

@media (max-width: 480px) {
  .pay-card .price {
    font-size: 24px;
  }
  
  .modal-content {
    padding: 24px;
    margin: 20px;
  }
  
  .modal-actions {
    flex-direction: column;
  }
}
    
/* --- Header dropdown for Account Settings --- */
header .title { display:flex; align-items:center; gap:12px; position:relative; }
header .title .menu { position:relative; }
header .title .menu-toggle{
  background: rgba(255,255,255,0.2); color:#fff; border:0; border-radius:10px;
  padding:6px 10px; font-weight:700; cursor:pointer;
}
header .title .menu-toggle:focus{ outline: 2px solid rgba(255,255,255,.6); outline-offset:2px; }
header .title .menu-list{
  position:absolute; top:110%; left:0; min-width: 200px;
  background:#fff; color: var(--ink); border-radius: 12px;
  box-shadow: 0 10px 30px rgba(0,0,0,.15);
  padding:8px; display:none; z-index: 200;
}
header .title .menu-list a{
  display:block; padding:10px 12px; border-radius:8px; text-decoration:none;
  color: var(--ink); font-weight:600;
}
header .title .menu-list a:hover{ background:#f1f5f9; }
header .title .menu.open .menu-list{ display:block; }
@media (max-width: 480px){
  header .title .menu-toggle{ padding:6px 8px; font-size: 12px; }
}

/* --- Hide Account Settings section by default; reveal via header dropdown --- */
#member-settings{ display:none; }
#member-settings .settings-panel{ display:none; }
#member-settings .settings-panel.active{ display:block; }
</style>
<style>
#member-settings .icon-eye, #member-settings .icon-eye-slash { width: 1.1em; height: 1.1em; pointer-events: none; vertical-align: -2px; }
#member-settings [hidden] { display: none !important; }
#member-settings .card { border-radius: .75rem; }
</style>
<style>
:root{
  --narap-green: #198754;
  --narap-green-dark: #146c43;
  --narap-green-25: rgba(25,135,84,.25);
}
/* Section look */
#member-settings .section-kicker{
  font-size:.8rem; letter-spacing:.08em; color:var(--narap-green);
  text-transform:uppercase; font-weight:700;
}
#member-settings h2.h4{ color: var(--narap-green); font-weight:700; }
#member-settings .divider{ border-top: 2px solid var(--narap-green-25); }
/* Cards */
#member-settings .card{ border:1px solid var(--narap-green-25); border-radius:1rem; box-shadow:0 2px 8px rgba(0,0,0,.04); }
#member-settings .card .h5{ color:#0f5132; font-weight:700; }
/* Inputs & focus */
#member-settings .form-label{ font-weight:600; }
#member-settings .form-control:focus, #member-settings .form-select:focus{
  border-color: var(--narap-green);
  box-shadow: 0 0 0 .25rem var(--narap-green-25);
}
/* Buttons */
#member-settings .btn-success{
  background-color: var(--narap-green);
  border-color: var(--narap-green);
}
#member-settings .btn-success:hover{
  background-color: var(--narap-green-dark);
  border-color: var(--narap-green-dark);
}
/* Password eye icon */
#member-settings .icon-eye, #member-settings .icon-eye-slash {
  width: 1.1em; height: 1.1em; pointer-events: none; vertical-align: -2px;
}
#member-settings [hidden]{ display:none !important; }
#member-settings .passport-preview{ max-height:120px; width:auto; border:1px solid var(--narap-green-25); }

/* --- Lightweight grid to mimic Bootstrap cols on the member settings section --- */
#member-settings .row{ display:flex; flex-wrap:wrap; gap:1.5rem; }
#member-settings .col-12{ flex:0 0 100%; max-width:100%; }
#member-settings .col-lg-7, #member-settings .col-lg-5{ flex:0 0 100%; max-width:100%; }
@media (min-width: 992px){
  #member-settings .col-lg-7{ flex:0 0 58.3333%; max-width:58.3333%; }
  #member-settings .col-lg-5{ flex:0 0 41.6667%; max-width:41.6667%; }
}
/* Ensure cards don't overlap and keep stacking context sane */
#member-settings .card{ position:relative; z-index:1; }
/* Avoid header overlap with sticky header */
main, #member-settings{ padding-top: 8px; }
</style>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
// Check if Paystack loaded properly
if (typeof PaystackPop === 'undefined') {
    console.error('Paystack script failed to load!');
} else {
    console.log('Paystack script loaded successfully');
}
</script>
</head>
<body>
<header>
<div class="title">
  <!-- Added logo image here -->
  <img src="/uploads/slider/Narap.png" alt="NARAP Logo" style="height: 32px; margin-right: 12px; vertical-align: middle;">
  <span>Member Dashboard</span>
  <div class="menu" id="mdMenu">
    <button class="menu-toggle" id="mdMenuToggle" aria-haspopup="true" aria-expanded="false">Account Settings ▾</button>
    <div class="menu-list" role="menu" aria-labelledby="mdMenuToggle">
      <a href="#" role="menuitem" id="linkEditProfile">Edit Profile</a>
      <a href="#" role="menuitem" id="linkChangePassword">Change Password</a>
      <a href="#" role="menuitem" id="linkShowAll">Show All</a>
      <a href="#" role="menuitem" id="linkHide">Hide Settings</a>
    </div>
  </div>
</div>
<div class="actions">
<a class="btn" href="/">Back to Site</a>
<button class="btn" id="logoutBtn">Logout</button>
</div>
</header>
<div class="notification" id="notification">
<span id="notification-text"></span>
</div>
<!-- Token Expiration Modal -->
<div class="modal" id="tokenExpiredModal">
<div class="modal-content">
<div class="modal-title">Session Expired</div>
<div class="modal-message">
                Your session has expired. Please log in again to continue.
            </div>
<div class="modal-actions">
<button class="btn secondary" id="modalCancel">Cancel</button>
<button class="btn" id="modalLogin">Log In</button>
</div>
</div>
</div>
<div class="container">

<div class="grid">
<div class="panel">
<div class="profile">
<img alt="passport" id="avatar" src="/uploads/slider/Narap.png" data-fallback="/uploads/slider/Narap.png"/>
<div>


<div id="hello" style="font-weight:800">Welcome</div>
<div class="muted"><span id="email"></span> · <span class="pill" id="rolePill">MEMBER</span></div>
</div>
</div>
<div style="margin-top:16px">
<div style="font-weight:800;margin-bottom:8px">Member Details</div>
<div class="list" id="recentList">
<div class="muted">No recent activity yet.</div>
</div>
</div>
</div>
<div class="panel">
<div style="font-weight:800;margin-bottom:8px">Payments</div>
<!-- Payment Method Selection -->
<div style="margin-bottom: 20px;">
<div style="font-weight: 600; margin-bottom: 8px;">Select Payment Method:</div>
<div class="payment-methods">
<div class="payment-method active" data-method="card">
  <div style="font-size: 24px; margin-bottom: 8px;">💳</div>
  <h4>Card</h4>
  <p>Debit/Credit Card</p>
</div>
<div class="payment-method" data-method="bank">
  <div style="font-size: 24px; margin-bottom: 8px;">🏦</div>
  <h4>Bank Transfer</h4>
  <p>Direct Bank Transfer</p>
</div>
<div class="payment-method" data-method="ussd">
  <div style="font-size: 24px; margin-bottom: 8px;">📱</div>
  <h4>USSD</h4>
  <p>USSD Code</p>
</div>
</div>
</div>
<div class="pay-card">
<div class="h">Membership Fee</div>
<div class="a">Access member benefits and dashboard tools.</div>
<div class="price">₦5,000</div>
<button class="btn" data-amount-kobo="500000" data-purpose="membership" id="payMembership">
<span id="payMembershipText">Pay Membership</span>
<span class="loading" id="payMembershipLoader" style="display: none;"></span>
</button>
</div>
<div class="pay-card">
<div class="h">ID Card Fee</div>
<div class="a">Get your official member ID card.</div>
<div class="price">₦3,000</div>
<button class="btn" data-amount-kobo="300000" data-purpose="idcard" id="payIdCard">
<span id="payIdCardText">Pay ID Card</span>
<span class="loading" id="payIdCardLoader" style="display: none;"></span>
</button>
</div>
<div class="pay-card">
<div class="h">Certificate Fee</div>
<div class="a">Generate and download membership certificate.</div>
<div class="price">₦10,000</div>
<button class="btn" data-amount-kobo="1000000" data-purpose="certificate" id="payCertificate">
<span id="payCertificateText">Pay Certificate</span>
<span class="loading" id="payCertificateLoader" style="display: none;"></span>
</button>
</div>
<!-- Debug Panel -->
<div class="debug-panel">
  <div class="debug-title">Payment Debug Log</div>
  <div id="debugLogs">
    <div class="debug-log">Dashboard initialized. Payment system ready...</div>
  </div>
</div>


<script>
    (function(){
        // Debug logging
        function addDebugLog(message, isError = false) {
            const debugLogs = document.getElementById('debugLogs');
            if (!debugLogs) return; // Safety check
            const logEntry = document.createElement('div');
            logEntry.className = isError ? 'debug-log debug-error' : 'debug-log';
            logEntry.textContent = new Date().toLocaleTimeString() + ' - ' + message;
            debugLogs.appendChild(logEntry);
            debugLogs.scrollTop = debugLogs.scrollHeight;
            // Also log to console for debugging
            if (isError) {
                console.error(message);
            } else {
                console.log(message);
            }
        }

        // Notification system
        function showNotification(message, isSuccess = false) {
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notification-text');
            
            if (notification && notificationText) {
                notificationText.textContent = message;
                notification.className = isSuccess ? 'notification success show' : 'notification show';
                
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 5000);
            }
            
            addDebugLog(message, !isSuccess);
        }

        // Token expiration modal
        function showTokenExpiredModal() {
            const modal = document.getElementById('tokenExpiredModal');
            if (modal) modal.classList.add('show');
        }

        // Close modal
        document.getElementById('modalCancel')?.addEventListener('click', function() {
            document.getElementById('tokenExpiredModal')?.classList.remove('show');
        });

        // Redirect to login
        document.getElementById('modalLogin')?.addEventListener('click', function() {
            window.location.href = '/member/login.php';
        });

        // Logout button
        document.getElementById('logoutBtn')?.addEventListener('click', function() {
            // Clear all auth storage
            localStorage.removeItem('jwt');
            localStorage.removeItem('token');
            localStorage.removeItem('authToken');
            sessionStorage.removeItem('jwt');
            sessionStorage.removeItem('token');
            sessionStorage.removeItem('authToken');
            
            // Clear cookies
            document.cookie = 'jwt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'authToken=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            
            // Redirect to login
            window.location.href = '/member/login.php';
        });

        // Payment method selection
        let selectedPaymentMethod = 'card';
        document.querySelectorAll('.payment-method').forEach(method => {
            method.addEventListener('click', function() {
                document.querySelectorAll('.payment-method').forEach(m => {
                    m.classList.remove('active');
                });
                this.classList.add('active');
                selectedPaymentMethod = this.getAttribute('data-method');
                addDebugLog(`Payment method selected: ${selectedPaymentMethod}`);
            });
        });

        // Get current user data for payments
        let currentUser = null;
        
        async function getCurrentUser() {
            if (currentUser) return currentUser;
            
            try {
                addDebugLog('Fetching user profile data...');
                const response = await fetch('/api/member/profile', {
                    headers: {
                        'Authorization': 'Bearer ' + getToken(),
                        'Content-Type': 'application/json'
                    }
                });
                
                if (response.ok) {
                    currentUser = await response.json();
                    addDebugLog('User profile loaded successfully');
                    return currentUser;
                } else {
                    addDebugLog(`Failed to load user profile: ${response.status}`, true);
                }
            } catch (error) {
                addDebugLog('Error fetching user data: ' + error.message, true);
            }
            
            return null;
        }

        function getToken(){
            const ls = localStorage.getItem('jwt') || localStorage.getItem('token') || localStorage.getItem('authToken');
            const ss = sessionStorage.getItem('jwt') || sessionStorage.getItem('token') || sessionStorage.getItem('authToken');
            const ck = (document.cookie.match(/(?:^|;\s*)(?:jwt|token|authToken)=([^;]+)/)||[])[1];
            return ls || ss || ck || '';
        }

        function validateToken() {
            const token = getToken();
            if (!token) {
                addDebugLog('No token found', true);
                showTokenExpiredModal();
                return false;
            }
            
            // Simple token validation (check if it's a JWT format)
            const tokenParts = token.split('.');
            if (tokenParts.length !== 3) {
                addDebugLog('Invalid token format', true);
                showTokenExpiredModal();
                return false;
            }
            
            try {
                // Try to decode the payload
                const payload = JSON.parse(atob(tokenParts[1]));
                const expirationTime = payload.exp * 1000; // Convert to milliseconds
                const currentTime = Date.now();
                
                if (expirationTime < currentTime) {
                    addDebugLog('Token has expired', true);
                    showTokenExpiredModal();
                    return false;
                }
                
                addDebugLog('Token is valid');
                return true;
            } catch (e) {
                addDebugLog('Error decoding token: ' + e.message, true);
                showTokenExpiredModal();
                return false;
            }
        }

        function paymentsInit(amount, purpose='membership'){
            if (!validateToken()) {
                return Promise.reject(new Error('Invalid token'));
            }
            
            addDebugLog(`Initializing payment: ${purpose}, Amount: ${amount}, Method: ${selectedPaymentMethod}`);
            
            return fetch('/api/payments/init', {
                method:'POST',
                headers:{
                    'Content-Type':'application/json',
                    'Authorization':'Bearer ' + getToken()
                },
                body: JSON.stringify({ amount, purpose, method: selectedPaymentMethod })
            })
            .then(response => {
                addDebugLog(`Payment init response: ${response.status} ${response.statusText}`);
                
                if (response.status === 401) {
                    // Token is invalid or expired
                    showTokenExpiredModal();
                    return Promise.reject(new Error('Authentication failed'));
                }
                
                if (!response.ok) {
                    return response.json().then(errorData => {
                        return Promise.reject(new Error(errorData.message || 'Payment initialization failed'));
                    });
                }
                
                return response.json();
            })
            .catch(error => {
                addDebugLog(`Payment init error: ${error.message}`, true);
                throw error;
            });
        }

        // Payment verification function
        async function verifyPayment(reference) {
            try {
                addDebugLog(`Verifying payment with reference: ${reference}`);
                
                const response = await fetch('/api/payments/verify', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + getToken()
                    },
                    body: JSON.stringify({ reference })
                });
                
                const result = await response.json();
                addDebugLog(`Verification response: ${JSON.stringify(result)}`);
                
                if (result.ok && result.status === 'success') {
                    addDebugLog('Payment verified successfully!');
                    showNotification('Payment successful and verified!', true);
                    
                    // Refresh page to show updated payment status
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    addDebugLog('Payment verification failed: ' + result.message, true);
                    showNotification('Payment verification failed: ' + (result.message || 'Unknown error'));
                }
            } catch (error) {
                addDebugLog('Error verifying payment: ' + error.message, true);
                showNotification('Error verifying payment: ' + error.message);
            }
        }

        async function startPayment(amount, purpose, buttonId) {
    console.log(`Starting payment: ${purpose}, Amount: ${amount}, Button: ${buttonId}`);
    
    // Show loading state
    const button = document.getElementById(buttonId);
    const buttonText = document.getElementById(buttonId + 'Text');
    const buttonLoader = document.getElementById(buttonId + 'Loader');
    
    if (!button || !buttonText || !buttonLoader) {
        addDebugLog('Payment button elements not found', true);
        return;
    }
    
    button.disabled = true;
    buttonText.style.display = 'none';
    buttonLoader.style.display = 'inline-block';
    
    // Reduced timeout for faster feedback
    const paymentTimeout = setTimeout(() => {
        addDebugLog('Payment process timed out - Paystack modal may have failed to open', true);
        showNotification('Payment gateway is taking too long. Please check your popup blocker and try again.');
        resetButton(buttonId);
    }, 15000); // Reduced from 30s to 15s
    
    try {
        // Get user data for payment
        addDebugLog('Loading user data for payment...');
        const user = await getCurrentUser();
        if (!user || !user.email) {
            throw new Error('User data not available for payment');
        }
        
        addDebugLog(`User data loaded: ${user.email}`);
        
        // Initialize payment with backend
        addDebugLog('Calling paymentsInit API...');
        const paymentData = await paymentsInit(amount, purpose);
        console.log('Payment init response:', paymentData);
        
        if (!paymentData.reference) {
            throw new Error('No payment reference returned from server');
        }
        
        const reference = paymentData.reference;
        addDebugLog(`Payment initialized successfully. Reference: ${reference}`);
        
        // Enhanced Paystack availability check
        if (typeof PaystackPop === 'undefined') {
            addDebugLog('Paystack not loaded properly', true);
            showNotification('Payment gateway not available. Please refresh the page and try again.', false);
            resetButton(buttonId);
            clearTimeout(paymentTimeout);
            return;
        }

        // Validate amount
        if (typeof amount !== 'number' || amount <= 0) {
            throw new Error(`Invalid amount: ${amount}`);
        }

        // Enhanced Paystack Integration with better error handling
        addDebugLog('Setting up Paystack payment gateway...');
        
        const paystackOptions = {
            key: 'pk_live_24159afdd489928d4e500cff2eafb7d08b0f0d3f',
            email: user.email,
            amount: amount,
            currency: 'NGN',
            ref: reference,
            metadata: {
                purpose: purpose,
                user_id: user._id,
                custom_fields: [
                    {
                        display_name: "Purpose",
                        variable_name: "purpose",
                        value: purpose
                    },
                    {
                        display_name: "User ID", 
                        variable_name: "user_id",
                        value: user._id
                    }
                ]
            },
            callback: function(response) {
                clearTimeout(paymentTimeout);
                addDebugLog(`Payment successful! Reference: ${response.reference}`);
                showNotification('Payment successful! Verifying...', true);
                resetButton(buttonId);
                verifyPayment(response.reference);
            },
            onClose: function() {
                clearTimeout(paymentTimeout);
                addDebugLog('Payment window closed by user');
                showNotification('Payment was cancelled or window closed');
                resetButton(buttonId);
            }
        };

        // Add error handling for Paystack setup
        try {
            addDebugLog('Creating Paystack handler...');
            const paystackHandler = PaystackPop.setup(paystackOptions);
            
            // Small delay to ensure DOM is ready
            setTimeout(() => {
                try {
                    addDebugLog('Opening Paystack iframe...');
                    paystackHandler.openIframe();
                    addDebugLog('Paystack iframe opened successfully');
                } catch (iframeError) {
                    clearTimeout(paymentTimeout);
                    addDebugLog('Paystack iframe error: ' + iframeError.message, true);
                    showNotification('Failed to open payment window. Please check popup blockers.');
                    resetButton(buttonId);
                }
            }, 100);
            
        } catch (setupError) {
            clearTimeout(paymentTimeout);
            addDebugLog('Paystack setup error: ' + setupError.message, true);
            showNotification('Payment gateway configuration error. Please try again.');
            resetButton(buttonId);
        }
        
    } catch (e) {
        clearTimeout(paymentTimeout);
        addDebugLog(`Payment initialization error: ${e.message}`, true);
        console.error('Payment error:', e);
        
        if (e.message.includes('Authentication failed')) {
            showNotification('Your session has expired. Please log in again.');
            showTokenExpiredModal();
        } else {
            showNotification('Payment failed: ' + e.message);
        }
        
        resetButton(buttonId);
    }
}
        function resetButton(buttonId) {
            const button = document.getElementById(buttonId);
            const buttonText = document.getElementById(buttonId + 'Text');
            const buttonLoader = document.getElementById(buttonId + 'Loader');
            
            if (button && buttonText && buttonLoader) {
                button.disabled = false;
                buttonText.style.display = 'inline-block';
                buttonLoader.style.display = 'none';
            }
        }

function checkPopupBlocker() {
    const popup = window.open('', '_blank', 'width=100,height=100');
    if (!popup || popup.closed || typeof popup.closed === 'undefined') {
        addDebugLog('Popup blocker detected', true);
        showNotification('Popup blocker detected! Please allow popups for this site to make payments.');
        return true;
    }
    popup.close();
    return false;
}

        // Set up payment button event listeners with better error handling
        function setupPaymentButton(buttonId) {
    const button = document.getElementById(buttonId);
    if (!button) {
        addDebugLog(`Payment button ${buttonId} not found`, true);
        return;
    }
    
    button.addEventListener('click', function(e) {
        e.preventDefault();
        console.log(`Payment button clicked: ${buttonId}`);
        
        // Check for popup blockers
        if (checkPopupBlocker()) {
            return;
        }
        
        const amount = Number(button.getAttribute('data-amount-kobo') || 0);
        const purpose = button.getAttribute('data-purpose') || 'membership';
        
        if(!amount) {
            showNotification('Amount missing');
            return;
        }
        
        addDebugLog(`Starting payment for ${purpose} with amount ${amount}`);
        startPayment(amount, purpose, buttonId);
    });
}

// Enhanced Paystack script loading verification
function verifyPaystackLoaded() {
    if (typeof PaystackPop === 'undefined') {
        addDebugLog('Paystack script not loaded properly', true);
        showNotification('Payment system is still loading. Please wait a moment and try again.', false);
        return false;
    }
    
    if (typeof PaystackPop.setup !== 'function') {
        addDebugLog('PaystackPop.setup function not available', true);
        showNotification('Payment gateway configuration error. Please refresh the page.', false);
        return false;
    }
    
    addDebugLog('Paystack script verified and ready');
    return true;
}
        // Initialize payment buttons
        document.addEventListener('DOMContentLoaded', function() {
            setupPaymentButton('payMembership');
            setupPaymentButton('payIdCard');
            setupPaymentButton('payCertificate');
            
            addDebugLog('Payment buttons initialized');
        });
        
        // Initialize
        addDebugLog('Dashboard loaded successfully');
        
        // Check token validity on page load
        if (!validateToken()) {
            addDebugLog('Token validation failed on page load', true);
        } else {
            addDebugLog('Token is valid on page load');
        }
        
        // Pre-load user data
        getCurrentUser().then(user => {
            if (user) {
                addDebugLog(`User data loaded: ${user.email}`);
                // Update UI with user data
                const helloEl = document.getElementById('hello');
                const emailEl = document.getElementById('email');
                
                if (helloEl) {
                    const fullName = `${user.surname || ''} ${user.otherNames || ''}`.trim() || user.name || 'Member';
                    helloEl.textContent = `Welcome, ${fullName}`;
                }
                
                if (emailEl) {
                    emailEl.textContent = user.email || 'No email';
                }
            }
        });
    })();
</script>
<!-- Rest of your HTML remains the same -->
<section class="container my-4" id="member-settings">
<div class="row g-4">
<div class="col-12">
<div class="section-kicker">Member Dashboard</div>
<h2 class="h4 mb-1">Account Settings</h2>
<p class="text-muted small mb-2">Update your profile details or change your password.</p>
<hr class="divider mt-2"/>
</div>
<!-- Profile Edit -->
<div class="col-lg-7 settings-panel" data-panel="edit-profile">
<div class="card shadow-sm">
<div class="card-body">
<h3 class="h5 mb-3">My Profile</h3>
<div class="alert d-none" id="profileAlert" role="alert"></div>
<form id="profileForm" novalidate="">
<div class="row g-3">
<div class="col-md-6">
<label class="form-label">Surname</label>
<input class="form-control" name="surname" placeholder="Surname" type="text"/>
</div>
<div class="col-md-6">
<label class="form-label">Other Names</label>
<input class="form-control" name="otherNames" placeholder="Other names" type="text"/>
</div>
<div class="col-md-6">
<label class="form-label">Phone</label>
<input class="form-control" name="phone" placeholder="Phone number" type="tel"/>
</div>
<div class="col-md-6">
<label class="form-label">Email</label>
<input class="form-control" name="email" placeholder="Email address" type="email"/>
</div>
<div class="col-md-6">
<label class="form-label">State</label>
<input class="form-control" name="state" placeholder="State" type="text"/>
</div>
<div class="col-md-6">
<label class="form-label">Zone</label>
<input class="form-control" name="zone" placeholder="Zone" type="text"/>
</div>
<div class="col-md-6">
<label class="form-label">Guarantor</label>
<input class="form-control" name="guarantor" placeholder="Guarantor (must be a practitioner)" type="text"/>
</div>
<div class="col-md-6">
<label class="form-label">Date of Birth</label>
<div class="row g-2">
<div class="col-4">
<select class="form-select" id="dob_day" name="dob_day">
<option value="">Day</option>
</select>
</div>
<div class="col-4">
<select class="form-select" id="dob_month" name="dob_month">
<option value="">Month</option>
</select>
</div>
<div class="col-4">
<select class="form-select" id="dob_year" name="dob_year">
<option value="">Year</option>
</select>
</div>
</div>
</div>
<div class="col-md-6">
<label class="form-label">Passport Photo</label>
<input accept="image/*" class="form-control" name="passport" type="file"/>
<div class="form-text">Optional: upload a new passport photo (JPG/PNG). Max 5MB.</div>
<img alt="Current passport photo preview" class="passport-preview mt-2 rounded d-none" id="passportPreview"/></div>
<div class="col-12 d-flex gap-2">
<button class="btn btn-success" id="btnSaveProfile" type="button">Save Profile</button>
<button class="btn btn-outline-secondary" id="btnReloadProfile" type="button">Reload</button>
</div>
</div>
</form>
</div>
</div>
</div>
<!-- Change Password -->
<div class="col-lg-5 settings-panel" data-panel="change-password">
<div class="card shadow-sm">
<div class="card-body">
<h3 class="h5 mb-3">Change Password</h3>
<div class="alert d-none" id="pwdAlert" role="alert"></div>
<form id="passwordForm" novalidate="">
<div class="mb-3">
<label class="form-label">Current Password</label>
<div class="input-group">
<input class="form-control" id="currentPassword" name="currentPassword" required="" type="password"/>
<button aria-label="Show password" class="btn btn-outline-secondary toggle-password" data-target="#currentPassword" title="Show password" type="button"><svg aria-hidden="true" class="icon-eye" height="16" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8z"></path>
<path d="M8 5a3 3 0 1 1 0 6A3 3 0 0 1 8 5z"></path>
</svg><svg aria-hidden="true" class="icon-eye-slash" height="16" hidden="" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
<path d="M13.359 11.238C11.93 12.5 10.1 13.5 8 13.5 3 13.5 0 8 0 8s3-5.5 8-5.5c1.09 0 2.094.214 3 .6"></path>
<path d="M3.35 3.35l9.3 9.3" stroke="currentColor" stroke-width="1.5"></path>
<path d="M6.5 6.5a3 3 0 0 0 4.243 4.243"></path>
</svg></button>
</div>
</div>
<div class="mb-3">
<label class="form-label">New Password</label>
<div class="input-group">
<input class="form-control" id="newPassword" name="newPassword" required="" type="password"/>
<button aria-label="Show password" class="btn btn-outline-secondary toggle-password" data-target="#newPassword" title="Show password" type="button"><svg aria-hidden="true" class="icon-eye" height="16" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8z"></path>
<path d="M8 5a3 3 0 1 1 0 6A3 3 0 0 1 8 5z"></path>
</svg><svg aria-hidden="true" class="icon-eye-slash" height="16" hidden="" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
<path d="M13.359 11.238C11.93 12.5 10.1 13.5 8 13.5 3 13.5 0 8 0 8s3-5.5 8-5.5c1.09 0 2.094.214 3 .6"></path>
<path d="M3.35 3.35l9.3 9.3" stroke="currentColor" stroke-width="1.5"></path>
<path d="M6.5 6.5a3 3 0 0 0 4.243 4.243"></path>
</svg></button>
</div>
</div>
<div class="mb-3">
<label class="form-label">Confirm New Password</label>
<div class="input-group">
<input class="form-control" id="confirmPassword" name="confirmPassword" required="" type="password"/>
<button aria-label="Show password" class="btn btn-outline-secondary toggle-password" data-target="#confirmPassword" title="Show password" type="button"><svg aria-hidden="true" class="icon-eye" height="16" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8z"></path>
<path d="M8 5a3 3 0 1 1 0 6A3 3 0 0 1 8 5z"></path>
</svg><svg aria-hidden="true" class="icon-eye-slash" height="16" hidden="" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
<path d="M13.359 11.238C11.93 12.5 10.1 13.5 8 13.5 3 13.5 0 8 0 8s3-5.5 8-5.5c1.09 0 2.094.214 3 .6"></path>
<path d="M3.35 3.35l9.3 9.3" stroke="currentColor" stroke-width="1.5"></path>
<path d="M6.5 6.5a3 3 0 0 0 4.243 4.243"></path>
</svg></button>
</div>
</div>
<div class="d-flex gap-2">
<button class="btn btn-success" id="btnChangePassword" type="button">Change Password</button>
<button class="btn btn-outline-secondary" id="btnResetPasswordForm" type="button">Reset</button>
</div>
</form>
</div>
</div>
</div>
</div>
</section>


<script>
// Unified Member Dashboard Controller - Consolidated and Optimized
(function() {
  const API_BASE = '/api';
  let userData = null;
  
  // Standardized token retrieval
  function getToken() {
    return localStorage.getItem('jwt') || 
           localStorage.getItem('token') || 
           localStorage.getItem('authToken') ||
           sessionStorage.getItem('jwt') || 
           sessionStorage.getItem('token') || 
           sessionStorage.getItem('authToken') || '';
  }
  
  // Clear authentication data
  function clearAuth() {
    localStorage.removeItem('jwt');
    localStorage.removeItem('token');
    localStorage.removeItem('authToken');
    sessionStorage.removeItem('jwt');
    sessionStorage.removeItem('token');
    sessionStorage.removeItem('authToken');
    userData = null;
  }
  
  // Alert functions for profile settings
  function showAlert(el, type, msg) {
    if (!el) return;
    el.classList.remove('d-none', 'alert-success', 'alert-danger', 'alert-warning');
    el.classList.add('alert', 'alert-' + type);
    el.textContent = msg;
  }
  
  function clearAlert(el) {
    if (!el) return;
    el.classList.add('d-none');
    el.textContent = '';
  }
  
  // Notification system
  function showNotification(message, isSuccess = false) {
    const notification = document.getElementById('notification');
    const notificationText = document.getElementById('notification-text');
    
    if (notification && notificationText) {
      notificationText.textContent = message;
      notification.className = isSuccess ? 'notification success show' : 'notification show';
      setTimeout(() => notification.classList.remove('show'), 5000);
    }
  }
  
  // Centralized user data loading
  async function loadUserData(forceRefresh = false) {
    if (userData && !forceRefresh) return userData;
    
    const token = getToken();
    if (!token) {
      window.location.href = '/member/login.php';
      return;
    }
    
    try {
      const response = await fetch(`${API_BASE}/member/profile`, {
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json'
        }
      });
      
      if (!response.ok) {
        if (response.status === 401) {
          clearAuth();
          window.location.href = '/member/login.php';
          return;
        }
        throw new Error(`HTTP ${response.status}: Failed to load profile`);
      }
      
      userData = await response.json();
      return userData;
      
    } catch (error) {
      console.error('Error loading user data:', error);
      showNotification('Failed to load member data. Please refresh the page.');
      throw error;
    }
  }
  
  // Update dashboard with user data
  function updateDashboard(user) {
    if (!user) return;
    
    // Update welcome message
    const fullName = `${user.surname || ''} ${user.otherNames || ''}`.trim() || 
                     user.name || 'Member';
    const helloEl = document.getElementById('hello');
    if (helloEl) helloEl.textContent = `Welcome, ${fullName}`;
    
    // Update email
    const emailEl = document.getElementById('email');
    if (emailEl) emailEl.textContent = user.email || 'No email';
    
    // Update avatar
    const avatar = document.getElementById('avatar');
    if (avatar && user.passportUrl) {
      const testImage = new Image();
      testImage.onload = () => avatar.src = user.passportUrl;
      testImage.onerror = () => avatar.src = avatar.getAttribute('data-fallback') || '/uploads/slider/Narap.png';
      testImage.src = user.passportUrl;
    }
    
    // Update member details
    const recentList = document.getElementById('recentList');
    if (recentList) {
      recentList.innerHTML = `
        <div class="item">
          <span>Full Name</span>
          <span style="font-weight: 600">${fullName}</span>
        </div>
        <div class="item">
          <span>Phone</span>
          <span style="font-weight: 600">${user.phone || 'Not provided'}</span>
        </div>
        <div class="item">
          <span>State</span>
          <span style="font-weight: 600">${user.state || 'Not provided'}</span>
        </div>
        <div class="item">
          <span>Zone</span>
          <span style="font-weight: 600">${user.zone || 'Not provided'}</span>
        </div>
        <div class="item">
          <span>Date of Birth</span>
          <span style="font-weight: 600">${user.dob ? new Date(user.dob).toLocaleDateString() : 'Not provided'}</span>
        </div>
        <div class="item">
          <span>Guarantor</span>
          <span style="font-weight: 600">${user.guarantor || 'Not provided'}</span>
        </div>
        <div class="item">
          <span>Member Since</span>
          <span style="font-weight: 600">${user.createdAt ? new Date(user.createdAt).toLocaleDateString() : 'Unknown'}</span>
        </div>
        <div class="item">
          <span>Membership Status</span>
          <span class="pill" style="background: ${user.hasPaidMembership ? 'var(--ok)' : 'var(--warn)'}; color: white;">
            ${user.hasPaidMembership ? 'ACTIVE' : 'PENDING'}
          </span>
        </div>
      `;
    }
  }
  
  // DOB selects initialization
  function initDOB() {
    const dSel = document.getElementById('dob_day');
    const mSel = document.getElementById('dob_month');
    const ySel = document.getElementById('dob_year');
    if (!dSel || !mSel || !ySel) return;
    
    // Days
    for (let d = 1; d <= 31; d++) {
      const o = document.createElement('option');
      o.value = d;
      o.textContent = d;
      dSel.appendChild(o);
    }
    
    // Months
    const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    for (let m = 1; m <= 12; m++) {
      const o = document.createElement('option');
      o.value = m;
      o.textContent = months[m-1];
      mSel.appendChild(o);
    }
    
    // Years
    const now = new Date().getFullYear();
    const latest = now - 16;
    for (let y = latest; y >= 1930; y--) {
      const o = document.createElement('option');
      o.value = y;
      o.textContent = y;
      ySel.appendChild(o);
    }
  }
  
  // Password visibility toggle
  function initPasswordToggle() {
    document.querySelectorAll('#member-settings .toggle-password').forEach(function(btn) {
      const sel = btn.getAttribute('data-target');
      const target = sel ? document.querySelector(sel) : null;
      const eye = btn.querySelector('.icon-eye');
      const slash = btn.querySelector('.icon-eye-slash');
      
      function render() {
        const isPwd = target && target.type === 'password';
        if (eye && slash) {
          eye.hidden = !isPwd;
          slash.hidden = isPwd;
        }
        btn.setAttribute('title', isPwd ? 'Show password' : 'Hide password');
        btn.setAttribute('aria-label', isPwd ? 'Show password' : 'Hide password');
      }
      
      render();
      btn.addEventListener('click', function() {
        if (!target) return;
        target.type = (target.type === 'password') ? 'text' : 'password';
        render();
      });
    });
  }
  
  // Load profile for settings form
  async function loadProfile() {
    const alert = document.getElementById('profileAlert');
    clearAlert(alert);
    
    try {
      const user = await loadUserData();
      if (!user) return;
      
      const f = document.getElementById('profileForm');
      if (!f) return;
      
      f.surname.value = user.surname || user.lastName || '';
      f.otherNames.value = user.otherNames || user.firstName || '';
      f.phone.value = user.phone || '';
      f.email.value = user.email || '';
      f.state.value = user.state || '';
      f.zone.value = user.zone || '';
      f.guarantor.value = user.guarantor || '';
      
      if (user.dob) {
        const dt = new Date(user.dob);
        if (!isNaN(dt)) {
          document.getElementById('dob_day').value = dt.getUTCDate();
          document.getElementById('dob_month').value = dt.getUTCMonth() + 1;
          document.getElementById('dob_year').value = dt.getUTCFullYear();
        }
      }
      
      // Show passport preview if available
      const preview = document.getElementById('passportPreview');
      if (user.passportUrl && preview) {
        preview.src = user.passportUrl;
        preview.classList.remove('d-none');
      }
      
    } catch (e) {
      showAlert(alert, 'danger', e.message || 'Could not load profile');
    }
  }
  
  // Save profile
  async function saveProfile() {
    const alert = document.getElementById('profileAlert');
    clearAlert(alert);
    const token = getToken();
    
    if (!token) {
      showAlert(alert, 'warning', 'You are not logged in. Please log in again.');
      return;
    }
    
    const f = document.getElementById('profileForm');
    const fd = new FormData(f);
    
    if (!fd.get('dob_day') || !fd.get('dob_month') || !fd.get('dob_year')) {
      fd.delete('dob_day');
      fd.delete('dob_month');
      fd.delete('dob_year');
    }
    
    try {
      const res = await fetch(`${API_BASE}/member/profile`, {
        method: 'PATCH',
        headers: { Authorization: 'Bearer ' + token },
        body: fd
      });
      
      const data = await res.json();
      if (!res.ok) throw new Error(data.message || 'Update failed');
      
      showAlert(alert, 'success', 'Profile updated successfully.');
      userData = null; // Clear cache to force refresh
      await loadProfile();
      await loadUserData(true); // Refresh dashboard
      updateDashboard(userData);
      
    } catch (e) {
      showAlert(alert, 'danger', e.message || 'Update failed');
    }
  }
  
  // Change password
  async function changePassword() {
    const alert = document.getElementById('pwdAlert');
    clearAlert(alert);
    const token = getToken();
    
    if (!token) {
      showAlert(alert, 'warning', 'You are not logged in. Please log in again.');
      return;
    }
    
    const f = document.getElementById('passwordForm');
    const currentPassword = f.currentPassword.value;
    const newPassword = f.newPassword.value;
    const confirmPassword = f.confirmPassword.value;
    
    if (!currentPassword || !newPassword || !confirmPassword) {
      showAlert(alert, 'warning', 'Please fill all password fields.');
      return;
    }
    
    if (newPassword !== confirmPassword) {
      showAlert(alert, 'warning', 'New passwords do not match.');
      return;
    }
    
    try {
      const res = await fetch(`${API_BASE}/auth/me/password`, {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json',
          Authorization: 'Bearer ' + token
        },
        body: JSON.stringify({ currentPassword, newPassword, confirmPassword })
      });
      
      const data = await res.json();
      if (!res.ok) throw new Error(data.message || 'Password change failed');
      
      showAlert(alert, 'success', 'Password updated.');
      f.reset();
      
    } catch (e) {
      showAlert(alert, 'danger', e.message || 'Password change failed');
    }
  }
  
  // Passport file preview
  function initPassportPreview() {
    const file = document.querySelector('#profileForm input[name="passport"]');
    const preview = document.getElementById('passportPreview');
    
    if (file && preview) {
      file.addEventListener('change', function() {
        if (file.files && file.files[0]) {
          const url = URL.createObjectURL(file.files[0]);
          preview.src = url;
          preview.classList.remove('d-none');
        }
      });
    }
  }
  
  // Header dropdown menu
  function initHeaderMenu() {
    const menu = document.getElementById('mdMenu');
    const toggle = document.getElementById('mdMenuToggle');
    if (!menu || !toggle) return;
    
    function close() {
      menu.classList.remove('open');
      toggle.setAttribute('aria-expanded', 'false');
    }
    
    function open() {
      menu.classList.add('open');
      toggle.setAttribute('aria-expanded', 'true');
    }
    
    toggle.addEventListener('click', (e) => {
      e.stopPropagation();
      if (menu.classList.contains('open')) close();
      else open();
    });
    
    document.addEventListener('click', (e) => {
      if (!menu.contains(e.target)) close();
    });
  }
  
  // Account Settings panel controller
  function initSettingsPanels() {
    const section = document.getElementById('member-settings');
    const panels = section ? Array.from(section.querySelectorAll('.settings-panel')) : [];
    
    function activate(panelName) {
      if (!section) return;
      section.style.display = 'block';
      panels.forEach(p => p.classList.remove('active'));
      
      if (panelName === 'all') {
        panels.forEach(p => p.classList.add('active'));
      } else {
        const target = section.querySelector(`.settings-panel[data-panel="${panelName}"]`);
        if (target) target.classList.add('active');
      }
      
      section.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    
    function hideAll() {
      if (!section) return;
      section.style.display = 'none';
      panels.forEach(p => p.classList.remove('active'));
    }
    
    document.getElementById('linkEditProfile')?.addEventListener('click', (e) => {
      e.preventDefault();
      activate('edit-profile');
    });
    
    document.getElementById('linkChangePassword')?.addEventListener('click', (e) => {
      e.preventDefault();
      activate('change-password');
    });
    
    document.getElementById('linkShowAll')?.addEventListener('click', (e) => {
      e.preventDefault();
      activate('all');
    });
    
    document.getElementById('linkHide')?.addEventListener('click', (e) => {
      e.preventDefault();
      hideAll();
    });
  }
  
  // Initialize dashboard
  async function initDashboard() {
    try {
      // Show loading state
      const helloEl = document.getElementById('hello');
      if (helloEl) helloEl.textContent = 'Loading...';
      
      // Load user data and update dashboard
      const user = await loadUserData();
      if (user) {
        updateDashboard(user);
        console.log('Dashboard initialized successfully');
      }
      
    } catch (error) {
      const helloEl = document.getElementById('hello');
      if (helloEl) helloEl.textContent = 'Welcome (Error loading data)';
      console.error('Dashboard initialization error:', error);
    }
  }
  
  // Event listeners
  function initEventListeners() {
    document.getElementById('btnSaveProfile')?.addEventListener('click', saveProfile);
    document.getElementById('btnReloadProfile')?.addEventListener('click', loadProfile);
    document.getElementById('btnChangePassword')?.addEventListener('click', changePassword);
    document.getElementById('btnResetPasswordForm')?.addEventListener('click', function() {
      document.getElementById('passwordForm')?.reset();
    });
  }
  
  // Make functions globally available
  window.loadUserData = loadUserData;
  window.refreshDashboard = () => loadUserData(true).then(updateDashboard);
  window.loadDashboardAvatar = () => loadUserData(true).then(updateDashboard); // For compatibility
  
  // Initialize everything when DOM is ready
  function init() {
    initDOB();
    initPasswordToggle();
    initPassportPreview();
    initHeaderMenu();
    initSettingsPanels();
    initEventListeners();
    loadProfile();
    initDashboard();
  }
  
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
</script>

</body>
</html>