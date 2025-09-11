<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Login</title>
  <link rel="icon" type="image/png" href="/uploads/slider/Narap.png"/>
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body class="container py-5">
  <h3 class="mb-3">Admin Login</h3>
  <div class="card p-4">
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input id="email" type="email" class="form-control" placeholder="you@example.com" />
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input id="password" type="password" class="form-control" placeholder="••••••••" />
    </div>
    <button class="btn btn-primary" onclick="login()">Login</button>
    <div id="msg" class="mt-3 small text-danger"></div>
  </div>
  <script>
    async function login(){
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value;
      try{
        const res = await fetch('/api/auth/login', {
          method: 'POST', headers: {'Content-Type': 'application/json'},
          body: JSON.stringify({ email, password })
        });
        const data = await res.json();
        if(!res.ok){ throw new Error(data.message || 'Login failed'); }
        localStorage.setItem('jwt', data.token);
        document.getElementById('msg').classList.remove('text-danger');
        document.getElementById('msg').classList.add('text-success');
        document.getElementById('msg').textContent = 'Login successful!';
        setTimeout(()=>{ window.location.href = '/admin/dashboard.php'; }, 700);
      }catch(e){
        document.getElementById('msg').textContent = e.message;
      }
    }
  </script>
</body>
</html>
