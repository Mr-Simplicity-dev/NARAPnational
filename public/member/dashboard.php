<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Member Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:#f8fafc;margin:0}
    header{background:#0ea5e9;color:#fff;padding:16px 20px;font-weight:700}
    .container{max-width:980px;margin:24px auto;padding:0 16px}
    .card{background:#fff;border-radius:14px;box-shadow:0 8px 26px rgba(0,0,0,.05);padding:18px;margin-bottom:18px}
    .profile{display:flex;gap:14px;align-items:center}
    .profile img{width:72px;height:72px;border-radius:50%;object-fit:cover;border:2px solid #e2e8f0;background:#fff}
    .muted{color:#6b7280;font-size:13px}
    .row{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:14px;margin-top:14px}
    button{padding:10px 14px;border:0;border-radius:10px;background:#ef4444;color:#fff;font-weight:700;cursor:pointer}
  </style>
</head>
<body>
  <header>Member Dashboard</header>
  <div class="container">
    <div class="card profile">
      <img id="passport" src="/uploads/slider/Narap.png" alt="passport">
      <div>
        <div id="name" style="font-weight:700">Welcome</div>
        <div id="email" class="muted"></div>
        <div class="muted" id="role"></div>
      </div>
    </div>

    <div class="row">
      <div class="card">
        <div style="font-weight:700;margin-bottom:8px">Quick Links</div>
        <div><a href="/" style="text-decoration:none;color:#0ea5e9">← Back to Home</a></div>
      </div>
      <div class="card">
        <div style="font-weight:700;margin-bottom:8px">Session</div>
        <button id="logoutBtn">Logout</button>
      </div>
    </div>
  </div>

<script>
(function(){
  const token = localStorage.getItem('jwt');
  if(!token){ window.location.href = '/member/login.php'; return; }

  fetch('/api/auth/me', { headers: { 'Authorization': 'Bearer ' + token } })
    .then(r => r.ok ? r.json() : Promise.reject())
    .then(user => {
      if(!user || user.role !== 'member'){
        window.location.href = '/admin/dashboard.php';
        return;
      }
      document.getElementById('name').textContent = 'Welcome, ' + (user.name || 'Member');
      document.getElementById('email').textContent = user.email || '';
      document.getElementById('role').textContent = 'Role: ' + (user.role || '');
      if(user.passportUrl){
        document.getElementById('passport').src = user.passportUrl;
      }
    })
    .catch(()=> window.location.href = '/member/login.php');

  document.getElementById('logoutBtn').addEventListener('click', ()=>{
    localStorage.removeItem('jwt');
    localStorage.removeItem('user');
    window.location.href = '/member/login.php';
  });
})();
</script>
</body>
</html>
