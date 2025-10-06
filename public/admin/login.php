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
  // clean any leaked query (?identifier=...&password=...) from URL bar
  try { history.replaceState(null,'',location.pathname); } catch(_) {}

  const msg  = document.getElementById('loginMsg');
  const form = document.getElementById('loginForm');
  const btn  = document.getElementById('loginBtn');

  const LOGIN_URL = '/api/auth/login';
  const ME_URL    = '/api/auth/me';

  function show(type, text){
    msg.style.display = 'block';
    msg.className = 'msg ' + (type === 'ok' ? 'ok' : 'err');
    msg.textContent = text;
  }
  function clearMsg(){ msg.style.display = 'none'; }

  async function verifyTokenAndRedirect(token) {
    try {
      console.log('Verifying token...');
      
      // Verify the token is valid by making an authenticated request
      const response = await fetch(ME_URL, {
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json'
        }
      });
      
      console.log('Token verification response:', response.status);
      
      if (response.ok) {
        show('ok', 'Login successful. Redirecting…');
        // Wait for the message to show, then redirect
        setTimeout(() => {
          console.log('Redirecting to dashboard...');
          window.location.href = '/admin/dashboard.php';
        }, 1500);
      } else {
        const errorData = await response.json().catch(() => ({}));
        throw new Error(errorData.message || 'Token verification failed');
      }
    } catch (error) {
      console.error('Token verification error:', error);
      show('err', 'Login verification failed: ' + error.message);
      btn.disabled = false;
      // Clear the invalid token
      localStorage.removeItem('jwt');
    }
  }

  async function login(email, password){
    btn.disabled = true; 
    clearMsg();
    
    try{
      console.log('Attempting login...');
      const res = await fetch(LOGIN_URL, {
        method: 'POST',
        headers: { 
          'Content-Type': 'application/json' 
        },
        body: JSON.stringify({ email, password })
      });
      
      const data = await res.json().catch(() => ({}));
      console.log('Login response:', data);
      
      if (!res.ok) {
        throw new Error(data.message || `Login failed (${res.status})`);
      }

      // Check if login was successful (new backend format)
      if (!data.success) {
        throw new Error(data.message || 'Login failed');
      }

      // Extract token from response
      const token = data.token;
      
      if (!token) {
        throw new Error('No authentication token received');
      }

      // Store the token
      localStorage.setItem('jwt', token);
      console.log('Token stored successfully:', token);

      // Verify token and redirect
      await verifyTokenAndRedirect(token);
      
    } catch(e){
      console.error('Login error:', e);
      show('err', e.message || 'Login failed');
      btn.disabled = false;
    }
  }

  form.addEventListener('submit', function(e){
    e.preventDefault();
    const email = document.getElementById('loginIdentifier').value.trim();
    const password = document.getElementById('loginPassword').value;
    if (!email || !password) { 
      show('err','Enter your email and password.'); 
      return; 
    }
    login(email, password);
  });

  // Check if already logged in
  const existingToken = localStorage.getItem('jwt');
  if (existingToken && existingToken !== 'cookie') {
    console.log('Found existing token, verifying...');
    verifyTokenAndRedirect(existingToken);
  }
})();
</script>
</body>
</html>
