<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Register — Admin</title>
  <link rel="icon" type="image/png" href="/uploads/slider/Narap.png"/>
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 shadow-sm">
  <a href="/index.php" class="navbar-brand px-4">NARAP</a>
  <button class="navbar-toggler me-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav ms-auto p-4 p-lg-0">
      <a href="/register.php" class="nav-item nav-link">Back</a>
      <a href="/admin/login.php" class="nav-item nav-link">Admin Login</a>
    </div>
  </div>
</nav>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-7">
      <h1 class="mb-4">Admin Registration</h1>
      <div class="alert alert-info">Admin registration requires a valid invite code.</div>
      <form id="adminForm" class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Full Name</label>
          <input name="name" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" minlength="6" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Admin Invite Code</label>
          <input name="inviteCode" class="form-control" placeholder="Set in .env as ADMIN_INVITE_CODE" required>
        </div>
        <div class="col-12">
          <button class="btn btn-primary" type="submit">Create Admin Account</button>
        </div>
      </form>
      <div id="adminMsg" class="mt-3"></div>
    </div>
  </div>
</div>

<script>
function setMsg(el, text, ok=false) {
  el.innerHTML = '<div class="alert '+(ok?'alert-success':'alert-danger')+'">'+text+'</div>';
  el.scrollIntoView({behavior:'smooth', block:'nearest'});
}

document.getElementById('adminForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  const msg = document.getElementById('adminMsg');
  const form = new FormData(e.target);
  const payload = Object.fromEntries(form.entries());

  try {
    const res = await fetch('/api/auth/register-admin', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    const data = await res.json().catch(() => ({}));
    if (!res.ok) throw new Error(data.message || 'Registration failed');

    setMsg(msg, 'Admin account created. Redirecting to login…', true);
    setTimeout(()=> { window.location.href = '/admin/login.php'; }, 1000);
  } catch (err) {
    setMsg(msg, err.message || 'Something went wrong.');
  }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
