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
    .back-link{margin-top:16px;text-align:center}
    .back-link a{color:var(--brand);text-decoration:none;font-size:14px}
    .back-link a:hover{text-decoration:underline}

    /* Page fade-in transition */
body {
    opacity: 0;
    animation: fadeIn 0.5s ease-in forwards;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Link click transition */
.page-transition {
    transition: opacity 0.3s ease-out;
}

.page-transition.fade-out {
    opacity: 0;
}
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
    
    <!-- Back to unified login -->
    <div class="back-link">
      <a href="/login.php"><i class="fas fa-arrow-left"></i> Back to Login Options</a>
    </div>
  </main>

  <script>
  (function(){
    // Clean any leaked query (?identifier=...&password=...) from URL bar
    try { history.replaceState(null,'',location.pathname); } catch(_) {}

    // Clear any existing tokens to prevent auto-redirect issues
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

    console.log('🟢 Admin login page loaded');

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
        console.log('🔍 Verifying admin token validity...');
        
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
          
          // CRITICAL: Check if user is actually an admin
          if (userData.role !== 'admin') {
            throw new Error('Access denied. Admin privileges required.');
          }
          
          show('ok', 'Admin authentication successful. Redirecting to dashboard...');
          
          // Wait for the message to show, then redirect
          setTimeout(() => {
            console.log('🔄 Redirecting to admin dashboard...');
            window.location.href = '/admin/dashboard.php';
          }, 1500);
        } else {
          const errorData = await response.json().catch(() => ({}));
          throw new Error(errorData.message || `Token verification failed (${response.status})`);
        }
      } catch (error) {
        console.error('❌ Admin token verification error:', error);
        show('err', 'Authentication failed: ' + error.message);
        btn.disabled = false;
        btn.textContent = 'Login';
        
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
        console.log('🔄 Attempting admin login for:', email);
        
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
        let userRole = null;

        // Check for success flag (newer format)
        if (data.hasOwnProperty('success')) {
          success = data.success;
          token = data.token;
          userRole = data.user?.role;
        } 
        // Check for token directly (older format)
        else if (data.token || data.jwt) {
          success = true;
          token = data.token || data.jwt;
          userRole = data.user?.role;
        }
        // Check nested data object
        else if (data.data && data.data.token) {
          success = true;
          token = data.data.token;
          userRole = data.data.user?.role;
        }

        if (!success) {
          throw new Error(data.message || 'Login failed - no success flag');
        }
        
        if (!token) {
          throw new Error('No authentication token received from server');
        }

        // CRITICAL: Check if user is admin BEFORE storing token
        if (userRole !== 'admin') {
          throw new Error('Access denied. This account does not have admin privileges. Please use member login instead.');
        }

        console.log('✅ Admin login successful, token received');
        
        // Store the token
        saveJwt(token);

        // Verify token and redirect
        await verifyTokenAndRedirect(token);
        
      } catch(e){
        console.error('❌ Admin login error:', e);
        show('err', e.message || 'Admin login failed');
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
    const existingToken = localStorage.getItem('jwt');
    const isFromLogout = sessionStorage.getItem('justLoggedOut') === 'true';
    
    if (existingToken && existingToken !== 'cookie' && !isFromLogout) {
      console.log('🔍 Found existing token, verifying admin validity...');
      show('ok', 'Checking existing admin session...');
      verifyTokenAndRedirect(existingToken);
    } else if (isFromLogout) {
      console.log('ℹ️ Admin just logged out, clearing logout flag');
      sessionStorage.removeItem('justLoggedOut');
    } else {
      console.log('ℹ️ No existing token found, ready for fresh admin login');
    }

    // Focus on email field for better UX
    document.getElementById('loginIdentifier').focus();

  })();

  // Add to each PHP file or in a shared JS file
document.addEventListener('DOMContentLoaded', function() {
    // Fade in current page
    document.body.style.opacity = '0';
    setTimeout(() => {
        document.body.style.transition = 'opacity 0.5s ease-in';
        document.body.style.opacity = '1';
    }, 50);

    // Handle navigation links
    const navLinks = document.querySelectorAll('a[href$=".php"]');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            
            // Fade out current page
            document.body.style.transition = 'opacity 0.3s ease-out';
            document.body.style.opacity = '0';
            
            // Navigate after fade out
            setTimeout(() => {
                window.location.href = href;
            }, 300);
        });
    });
});
  </script>
</body>
</html>