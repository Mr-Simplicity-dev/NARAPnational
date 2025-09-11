<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Register — Choose Type</title>
  <link rel="icon" type="image/png" href="/uploads/slider/Narap.png"/>
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <style>
    body{background:#f8fafc}
    .card{border:0; border-radius:16px; box-shadow:0 10px 30px rgba(2,6,23,.08)}
    .role-btn{display:block; border-radius:12px; padding:18px; text-decoration:none; border:2px solid #0d6efd1a}
    .role-btn:hover{background:#0d6efd0d}
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 shadow-sm">
  <a href="/index.php" class="navbar-brand px-4">NARAP</a>
  <button class="navbar-toggler me-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav ms-auto p-4 p-lg-0">
      <a href="/index.php" class="nav-item nav-link">Home</a>
      <a href="/member/login.php" class="nav-item nav-link">Member Login</a>
      <a href="/admin/login.php" class="nav-item nav-link">Admin Login</a>
    </div>
  </div>
</nav>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card p-4 p-md-5">
        <h1 class="mb-3">Create an Account</h1>
        <p class="text-muted">Choose what you want to register as and continue.</p>

        <div class="row g-3 mt-2">
          <div class="col-md-7">
            <label class="form-label fw-semibold">Register as</label>
            <select id="role" class="form-select form-select-lg">
              <option value="" selected disabled>— Select one —</option>
              <option value="member">Member</option>
              <option value="admin">Admin</option>
            </select>
          </div>
          <div class="col-md-5 d-flex align-items-end">
            <button id="goBtn" class="btn btn-primary btn-lg w-100">Continue</button>
          </div>
        </div>

        <hr class="my-4">

        <div class="row g-3">
          <div class="col-md-6">
            <a class="role-btn" href="/member/register.php">
              <div class="d-flex align-items-center gap-3">
                <div class="fs-3">👤</div>
                <div>
                  <div class="fw-bold">Register as Member</div>
                  <small class="text-muted">Create a member account and access the member dashboard.</small>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-6">
            <a class="role-btn" href="/admin/register.php">
              <div class="d-flex align-items-center gap-3">
                <div class="fs-3">🛡️</div>
                <div>
                  <div class="fw-bold">Register as Admin</div>
                  <small class="text-muted">Create an admin account (invite code required).</small>
                </div>
              </div>
            </a>
          </div>
        </div>

        <div id="msg" class="mt-3"></div>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('goBtn').addEventListener('click', function(){
  const role = document.getElementById('role').value;
  if(role === 'member') window.location.href = '/member/register.php';
  else if(role === 'admin') window.location.href = '/admin/register.php';
  else {
    const m = document.getElementById('msg');
    m.innerHTML = '<div class="alert alert-warning">Please choose one option.</div>';
    m.scrollIntoView({behavior:'smooth', block:'nearest'});
  }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
