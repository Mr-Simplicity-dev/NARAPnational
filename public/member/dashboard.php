<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Member Dashboard · Payments</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://use.fontawesome.com" crossorigin>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous">
  <style>
    :root{
      --brand:#0ea5e9; --ink:#0f172a; --muted:#64748b;
      --bg:#f8fafc; --card:#fff; --ok:#16a34a; --warn:#f59e0b; --err:#ef4444;
    }
    *{box-sizing:border-box}
    body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:var(--bg);color:var(--ink)}
    header{display:flex;align-items:center;justify-content:space-between;background:var(--brand);color:#fff;padding:14px 18px;position:sticky;top:0}
    header .title{font-weight:800}
    header a.btn, header button{background:#fff;color:var(--brand);border:0;border-radius:10px;padding:8px 12px;font-weight:700;text-decoration:none;cursor:pointer}
    .container{max-width:1140px;margin:18px auto;padding:0 16px}
    .grid{display:grid;grid-template-columns:1fr;gap:16px}
    @media (min-width: 900px){ .grid{grid-template-columns:2fr 1fr} }
    .panel{background:var(--card);border-radius:14px;box-shadow:0 8px 26px rgba(0,0,0,.06);padding:16px}
    .profile{display:flex;gap:14px;align-items:center}
    .profile img{width:72px;height:72px;border-radius:50%;object-fit:cover;border:2px solid #e2e8f0;background:#fff}
    .muted{color:var(--muted);font-size:13px}
    .list{display:flex;flex-direction:column;gap:10px}
    .item{display:flex;justify-content:space-between;gap:10px;padding:10px 0;border-bottom:1px solid #eef2f7}
    .pill{display:inline-block;background:#e2f2fd;color:var(--brand);padding:4px 8px;border-radius:999px;font-size:12px}
    .pay-card{display:flex;flex-direction:column;gap:6px;border:1px dashed #e5e7eb;border-radius:12px;padding:12px}
    .pay-card .h{font-weight:800}
    .pay-card .a{font-size:14px;color:var(--muted)}
    .pay-card .price{font-size:22px;font-weight:900}
    .btn{padding:10px 12px;border:0;border-radius:10px;background:var(--brand);color:#fff;font-weight:700;cursor:pointer}
    .btn.secondary{background:#fff;color:var(--brand);border:1px solid #bae6fd}
    .ok{color:var(--ok)} .warn{color:var(--warn)} .err{color:var(--err)}
  </style>
  <script src="https://js.paystack.co/v1/inline.js"></script>
</head>
<body>
  <header>
    <div class="title">Member Dashboard</div>
    <div class="actions">
      <a class="btn" href="/">Back to Site</a>
      <button class="btn" id="logoutBtn">Logout</button>
    </div>
  </header>

  <div class="container">
    <div class="grid">
      <div class="panel">
        <div class="profile">
          <img id="avatar" src="/uploads/slider/Narap.png" alt="passport">
          <div>
            <div id="hello" style="font-weight:800">Welcome</div>
            <div class="muted"><span id="email"></span> · <span class="pill" id="rolePill">MEMBER</span></div>
          </div>
        </div>

        <div style="margin-top:16px">
          <div style="font-weight:800;margin-bottom:8px">Recent Activity</div>
          <div class="list" id="recentList">
            <div class="muted">No recent activity yet.</div>
          </div>
        </div>
      </div>

      <div class="panel">
        <div style="font-weight:800;margin-bottom:8px">Payments</div>

        <div class="pay-card">
          <div class="h">Membership Fee</div>
          <div class="a">Access member benefits and dashboard tools.</div>
          <div class="price">₦5,000</div>
          <button class="btn" data-purpose="membership" data-amount-kobo="500000">Pay Membership</button>
        </div>

        <div class="pay-card" style="margin-top:10px">
          <div class="h">ID Card Fee</div>
          <div class="a">Get your official member ID card.</div>
          <div class="price">₦3,000</div>
          <button class="btn" data-purpose="idcard" data-amount-kobo="300000">Pay ID Card</button>
        </div>

        <div class="pay-card" style="margin-top:10px">
          <div class="h">Certificate Fee</div>
          <div class="a">Generate and download membership certificate.</div>
          <div class="price">₦10,000</div>
          <button class="btn" data-purpose="certificate" data-amount-kobo="1000000">Pay Certificate</button>
        </div>

        <div class="muted" style="margin-top:10px">
          After successful payment, you’ll be redirected here and your status will update automatically.
        </div>
      </div>
    </div>
  </div>

  <script>
  (function(){
    // Auth guard
    const token = localStorage.getItem('jwt') || localStorage.getItem('token');
    if(!token){ window.location.href = '/member/login.php'; return; }

    // Get member profile
    fetch('/api/auth/me', { headers: { 'Authorization': 'Bearer ' + token }})
      .then(r => r.ok ? r.json() : Promise.reject())
      .then(u => {
        if(!u || (u.role && u.role !== 'member')){
          // Not a member? send to admin dashboard
          window.location.href = '/admin/dashboard.php';
          return;
        }
        document.getElementById('hello').textContent = 'Welcome, ' + (u.name || 'Member');
        document.getElementById('email').textContent = (u.email || '');
        if(u.passportUrl){ document.getElementById('avatar').src = u.passportUrl; }
      })
      .catch(()=> window.location.href = '/member/login.php');

    // Payment handlers
    function initRef(amount){
      return fetch('/api/payments/init', {
        method:'POST',
        headers:{
          'Content-Type':'application/json',
          'Authorization':'Bearer ' + token
        },
        body: JSON.stringify({ amount })
      }).then(r => r.ok ? r.json() : r.json().then(x=>Promise.reject(x)));
    }
    function verify(reference){
      return fetch('/api/payments/verify', {
        method:'POST',
        headers:{
          'Content-Type':'application/json',
          'Authorization':'Bearer ' + token
        },
        body: JSON.stringify({ reference })
      }).then(r => r.ok ? r.json() : r.json().then(x=>Promise.reject(x)));
    }

    function pay(amount, purpose){
      const user = JSON.parse(localStorage.getItem('user')||'{}');
      const email = user?.email || document.getElementById('email')?.textContent || 'test@example.com';
      initRef(amount).then(({ reference }) => {
        const handler = PaystackPop.setup({
          key: (window.PAYSTACK_PUBLIC || '') || 'pk_test_xxx_replace_me',
          email, amount, currency:'NGN', ref: reference,
          metadata: { custom_fields: [{ display_name:'Purpose', variable_name:'purpose', value: purpose }]},
          callback: function(resp){
            verify(resp.reference).then(v => {
              if(v.ok){ alert('Payment successful!'); location.reload(); }
              else{ alert('Payment not verified: ' + (v.status||'failed')); }
            }).catch(e => alert('Verify failed: ' + (e?.message||'error')));
          },
          onClose: function(){ /* user closed */ }
        });
        handler.openIframe();
      }).catch(e => alert(e?.message || 'Unable to start payment'));
    }

    // Wire buttons
    document.querySelectorAll('.pay-card .btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const amt = Number(btn.getAttribute('data-amount-kobo')||0);
        const purpose = btn.getAttribute('data-purpose') || 'membership';
        if(!amt) return alert('Amount missing');
        pay(amt, purpose);
      });
    });

    // Logout
    function logout(){
      localStorage.removeItem('jwt'); localStorage.removeItem('token');
      localStorage.removeItem('user');
      window.location.href = '/member/login.php';
    }
    document.getElementById('logoutBtn')?.addEventListener('click', logout);
  })();
  </script>
</body>
</html>
