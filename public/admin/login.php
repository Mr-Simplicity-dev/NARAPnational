<?php /* admin/login.php — fixed AJAX login wired to your server */ ?>
<!doctype html>
<html lang="en">
<head>
  <link rel="icon" type="image/png" href="/uploads/slider/Narap.png"/>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Admin Login — NARAP</title>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
  <style>
    :root{--brand:#0a7f41;--ink:#0b1220;--muted:#6b7280}
    html,body{height:100%}
    body{margin:0;font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Arial;background:#f6f8fa;color:var(--ink);display:flex;align-items:center;justify-content:center}
    .card{width:min(420px,92vw);background:#fff;border-radius:16px;box-shadow:0 10px 30px rgba(16,24,40,.08);padding:22px}
    h1{font-size:1.25rem;margin:0 0 6px;font-weight:700}
    p.sub{color:var(--muted);margin:0 0 16px}
    .form-label{font-weight:600;margin-bottom:6px}
    .form-control{width:100%;padding:.7rem .85rem;border-radius:12px;border:1px solid #d1d5db;font-size:1rem}
    .row{display:grid;gap:12px}
    .actions{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-top:6px}
    .btn{display:inline-flex;align-items:center;justify-content:center;border-radius:12px;padding:.65rem 1rem;border:1px solid transparent;cursor:pointer;font-weight:600}
    .btn-primary{background:var(--brand);color:#fff}
    .btn-primary[disabled]{opacity:.6;cursor:not-allowed}
    .hint{font-size:.9rem;color:var(--muted)}
    .msg{border-radius:10px;padding:.55rem .8rem;margin:.25rem 0;font-size:.95rem}
    .msg.err{background:#fef2f2;color:#991b1b;border:1px solid #fecaca}
    .msg.ok{background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0}
  </style>
</head>
<body>
  <main class="card">
    <h1>Admin Sign in</h1>
    <p class="sub">Enter your credentials to access the admin dashboard.</p>

    <div id="loginMsg" class="msg" style="display:none"></div>

    <form id="loginForm" novalidate>
      <div class="row">
        <div>
          <label class="form-label" for="loginIdentifier">Email</label>
          <input id="loginIdentifier" class="form-control" type="text" name="identifier" placeholder="admin@example.com" required />
        </div>
        <div>
          <label class="form-label" for="loginPassword">Password</label>
          <input id="loginPassword" class="form-control" type="password" name="password" placeholder="••••••••" required />
        </div>
        <div class="actions">
          <label class="hint"><input type="checkbox" id="rememberMe" /> Remember me</label>
          <button id="loginBtn" class="btn btn-primary" type="submit">Login</button>
        </div>
      </div>
    </form>

    <div class="hint" style="margin-top:10px;">Forgot password? <a href="/admin/forgot.php">Reset</a></div>
  </main>

  <script>
  (function(){
    // Clean any leaked query (?identifier=...&password=...) from URL bar
    try { history.replaceState(null,'',location.pathname); } catch(_) {}

    // Clear any existing tokens to prevent auto-redirect issues
    // Only clear if we're specifically on login page and not redirected from dashboard
    try { 
      if (!document.referrer.includes('/admin/dashboard.php')) {
        const existingToken = localStorage.getItem('jwt');
        if (existingToken) {
          console.log('🔄 Clearing existing token on fresh login page visit');
          localStorage.removeItem('jwt');
          sessionStorage.clear();
        }
      } else {
        console.log('ℹ️ Keeping token - redirected from dashboard');
      }
    } catch(_) {}

    console.log('🟢 Login page loaded');
    console.log('📍 Current page:', window.location.pathname);
    console.log('🔑 Current JWT token:', localStorage.getItem('jwt') ? 'EXISTS' : 'NONE');

    // Check if admin.js is being loaded (it shouldn't be on login page)
    if (typeof authFetch !== 'undefined') {
      console.error('❌ admin.js is being loaded on login page - this will cause redirect issues');
    } else {
      console.log('✅ admin.js not loaded on login page');
    }

    const msg  = document.getElementById('loginMsg');
    const form = document.getElementById('loginForm');
    const btn  = document.getElementById('loginBtn');

    const LOGIN_URL = '/api/auth/login';
    const ME_URL    = '/api/auth/me';

    function show(type, text){
      msg.style.display = 'block';
      msg.className = 'msg ' + (type === 'ok' ? 'ok' : 'err');
      msg.textContent = text;
      console.log(`📢 Message: [${type}] ${text}`);
    }
    
    function clearMsg(){ 
      msg.style.display = 'none'; 
    }

    function saveJwt(tok){ 
      try { 
        if (tok) {
          localStorage.setItem('jwt', tok); 
          console.log('💾 JWT token saved to localStorage');
        }
      } catch(e) {
        console.error('❌ Failed to save JWT token:', e);
      } 
    }

    async function verifyTokenAndRedirect(token) {
      try {
        console.log('🔍 Verifying token validity...');
        
        if (!token || token === 'cookie') {
          throw new Error('Invalid token format');
        }
        
        // Verify the token is valid by making an authenticated request
        const response = await fetch(ME_URL, {
          headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
          },
          credentials: 'include'
        });
        
        console.log('🔍 Token verification response:', response.status);
        
        if (response.ok) {
          const userData = await response.json().catch(() => ({}));
          console.log('✅ Token verified successfully:', userData.email || 'user');
          
          show('ok', 'Authentication successful. Redirecting to dashboard...');
          
          // Wait for the message to show, then redirect
          setTimeout(() => {
            console.log('🔄 Redirecting to dashboard...');
            window.location.href = '/admin/dashboard.php';
          }, 1500);
        } else {
          const errorData = await response.json().catch(() => ({}));
          throw new Error(errorData.message || `Token verification failed (${response.status})`);
        }
      } catch (error) {
        console.error('❌ Token verification error:', error);
        show('err', 'Authentication failed: ' + error.message);
        btn.disabled = false;
        
        // Clear the invalid token
        localStorage.removeItem('jwt');
        sessionStorage.clear();
      }
    }

    async function login(email, password){
      btn.disabled = true; 
      btn.textContent = 'Logging in...';
      clearMsg();
      
      try{
        console.log('🔄 Attempting login for:', email);
        
        const res = await fetch(LOGIN_URL, {
          method: 'POST',
          headers: { 
            'Content-Type': 'application/json' 
          },
          credentials: 'include',
          body: JSON.stringify({ email, password })
        });
        
        const data = await res.json().catch(() => ({}));
        console.log('📡 Login response status:', res.status);
        console.log('📡 Login response data:', data);
        
        if (!res.ok) {
          throw new Error(data.message || `Login failed (${res.status})`);
        }

        // Handle different response formats
        let token = null;
        let success = false;

        // Check for success flag (newer format)
        if (data.hasOwnProperty('success')) {
          success = data.success;
          token = data.token;
        } 
        // Check for token directly (older format)
        else if (data.token || data.jwt) {
          success = true;
          token = data.token || data.jwt;
        }
        // Check nested data object
        else if (data.data && data.data.token) {
          success = true;
          token = data.data.token;
        }

        if (!success) {
          throw new Error(data.message || 'Login failed - no success flag');
        }
        
        if (!token) {
          throw new Error('No authentication token received from server');
        }

        console.log('✅ Login successful, token received');
        
        // Store the token
        saveJwt(token);

        // Verify token and redirect
        await verifyTokenAndRedirect(token);
        
      } catch(e){
        console.error('❌ Login error:', e);
        show('err', e.message || 'Login failed');
        btn.disabled = false;
        btn.textContent = 'Login';
      }
    }

    // Form submission handler
    form.addEventListener('submit', function(e){
      e.preventDefault();
      const email = document.getElementById('loginIdentifier').value.trim();
      const password = document.getElementById('loginPassword').value;
      
      if (!email || !password) { 
        show('err','Please enter both email and password.'); 
        return; 
      }
      
      // Basic email validation
      if (!email.includes('@')) {
        show('err','Please enter a valid email address.');
        return;
      }
      
      login(email, password);
    });

    // Check for existing valid token on page load
    // But only if we're not coming from a logout or fresh visit
    const existingToken = localStorage.getItem('jwt');
    const isFromLogout = sessionStorage.getItem('justLoggedOut') === 'true';
    
    if (existingToken && existingToken !== 'cookie' && !isFromLogout) {
      console.log('🔍 Found existing token, verifying validity...');
      show('ok', 'Checking existing session...');
      verifyTokenAndRedirect(existingToken);
    } else if (isFromLogout) {
      console.log('ℹ️ User just logged out, clearing logout flag');
      sessionStorage.removeItem('justLoggedOut');
    } else {
      console.log('ℹ️ No existing token found, ready for fresh login');
    }

    // Focus on email field for better UX
    document.getElementById('loginIdentifier').focus();

  })();
  </script>

  <!-- Debug information script -->
  <script>
  // Additional debugging for troubleshooting
  window.addEventListener('load', function() {
    console.log('🔧 Debug Info:');
    console.log('  - Page URL:', window.location.href);
    console.log('  - Referrer:', document.referrer);
    console.log('  - LocalStorage JWT:', localStorage.getItem('jwt') ? 'Present' : 'None');
    console.log('  - SessionStorage items:', Object.keys(sessionStorage));
    
    // Check if we're being redirected in a loop
    const redirectCount = sessionStorage.getItem('loginRedirectCount') || '0';
    const newCount = parseInt(redirectCount) + 1;
    sessionStorage.setItem('loginRedirectCount', newCount.toString());
    
    if (newCount > 3) {
      console.warn('⚠️ Multiple redirects detected - possible redirect loop');
      sessionStorage.removeItem('loginRedirectCount');
      localStorage.removeItem('jwt');
    } else {
      // Clear redirect count after successful page load
      setTimeout(() => {
        sessionStorage.removeItem('loginRedirectCount');
      }, 5000);
    }
  });
  </script>
</body>
</html>