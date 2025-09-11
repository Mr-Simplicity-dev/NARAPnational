<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Member Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:#f7f7fb;margin:0}
    .wrap{max-width:420px;margin:6vh auto;background:#fff;border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,.06);padding:28px}
    h1{font-size:20px;margin:0 0 16px}
    label{display:block;margin:12px 0 6px;font-weight:600}
    input{width:100%;padding:10px 12px;border:1px solid #e5e7eb;border-radius:8px;font-size:14px}
    button{margin-top:16px;width:100%;padding:12px;border:0;border-radius:10px;background:#0ea5e9;color:#fff;font-weight:700;cursor:pointer}
    #msg{margin-top:10px;font-size:13px}
    a.small{display:inline-block;margin-top:12px;font-size:13px;color:#0ea5e9;text-decoration:none}
  </style>
</head>
<body>
  <div class="wrap">
    <h1>Member Login</h1>
    <form id="loginForm">
      <label>Email</label>
      <input type="email" id="email" required>
      <label>Password</label>
      <input type="password" id="password" required>
      <button type="submit">Login</button>
      <div id="msg"></div>
    </form>
    <a class="small" href="/admin/login.php">Are you an admin? Go to Admin Login</a>
  </div>

<script>
document.getElementById('loginForm').addEventListener('submit', async (e)=>{
  e.preventDefault();
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value.trim();
  document.getElementById('msg').textContent = 'Signing in...';
  try{
    const res = await fetch('/api/auth/login', {
      method:'POST',
      headers:{'Content-Type':'application/json'},
      body: JSON.stringify({ email, password })
    });
    const data = await res.json();
    if(!res.ok){ throw new Error(data.message || 'Login failed'); }
    localStorage.setItem('jwt', data.token);
    if(data.user){ localStorage.setItem('user', JSON.stringify(data.user)); }
    if(data.user && data.user.role === 'member'){
      document.getElementById('msg').textContent = 'Login successful! Redirecting...';
      setTimeout(()=>{ window.location.href = '/member/dashboard.php'; }, 600);
    }else{
      document.getElementById('msg').textContent = 'This account is not a member. Use Admin Login.';
    }
  }catch(err){
    document.getElementById('msg').textContent = err.message || 'Error logging in';
  }
});
</script>
</body>
</html>
