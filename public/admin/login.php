<?php /* admin/login.php — AJAX login (JWT in localStorage) */ ?>
<!doctype html>
<html lang="en">
<head>
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

    <div class="hint" style="margin-top:10px;">
      Forgot password? <a href="/admin/forgot.php">Reset</a>
    </div>
  </main>

  <script>
  (function(){
    // Clean any leaked query (?identifier=...&password=...) from URL bar
    try { history.replaceState(null, '', location.pathname); } catch(_) {}

    const msg  = document.getElementById('loginMsg');
    const form = document.getElementById('loginForm');
    const btn  = document.getElementById('loginBtn');

    // Common bases and paths — we'll try them until one works (avoid 404 loops)
    const BASES = [
      '',                         // same origin (recommended when proxied)
      'http://localhost:5000',    // local dev API
      'https://narap-backend.onrender.com', // your Render base (if used)
    ];
    const PATHS = [
      '/api/auth/admin/login',
      '/api/auth/login',
      '/api/login',
      '/api/users/login'
    ];

    function show(type, text){
      msg.style.display = 'block';
      msg.className = 'msg ' + (type === 'ok' ? 'ok' : 'err');
      msg.textContent = text;
    }
    function clearMsg(){ msg.style.display = 'none'; }

    function saveJwt(tok){
      try { if (tok) localStorage.setItem('jwt', tok); } catch(_) {}
    }

    async function tryEndpoint(url, email, password){
      // If your backend expects "identifier", change to { identifier: email, password }
      const payload = { email, password };
      const res = await fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include', // allow cookie sessions too
        body: JSON.stringify(payload)
      });
      // If 404/405/500 etc, let caller handle
      let data = {};
      try { data = await res.json(); } catch(_) {}
      return { ok: res.ok, status: res.status, data };
    }

    async function login(email, password){
      // Disable button to prevent double submits
      btn.disabled = true;
      clearMsg();

      // Try each base+path until a non-404 result
      let lastErr = 'No matching login endpoint found.';
      for (const base of BASES) {
        for (const path of PATHS) {
          const url = (base + path).replace(/([^:]\/)\/+/g,'$1'); // collapse //
          try {
            const r = await tryEndpoint(url, email, password);
            if (r.status === 404) {
              // try next path
              continue;
            }
            if (!r.ok) {
              // Non-404 error from this endpoint; capture message and stop trying others on same base/path
              lastErr = r.data && (r.data.message || r.data.error) ? r.data.message || r.data.error : ('Login failed ('+r.status+')');
              // If unauthorized, don't try other endpoints as auth likely correct path but bad creds
              if (r.status === 401) throw new Error(lastErr);
              // Otherwise keep trying other endpoints in case path mismatch
              continue;
            }
            // Success
            const tok = r.data && (r.data.token || r.data.jwt || (r.data.data && r.data.data.token));
            saveJwt(tok || 'cookie'); // 'cookie' placeholder if backend uses httpOnly cookie-only auth
            show('ok', 'Login successful. Redirecting…');
            window.location.replace('/admin/dashboard.php');
            return;
          } catch (e) {
            lastErr = e && e.message ? e.message : 'Network error';
          }
        }
      }
      show('err', lastErr);
      btn.disabled = false;
    }

    form.addEventListener('submit', function(e){
      e.preventDefault(); // stop full page reload (prevents flicker)
      const email = document.getElementById('loginIdentifier').value.trim();
      const password = document.getElementById('loginPassword').value;
      if (!email || !password) { show('err','Enter your email and password.'); return; }
      login(email, password);
    });
  })();
  </script>
</body>
</html>
