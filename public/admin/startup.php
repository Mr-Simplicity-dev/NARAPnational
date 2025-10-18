<!doctype html>
<html lang="en">
<head>
  <link rel="icon" type="image/png" href="/uploads/slider/Narap.png"/>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>NARAP — Choose Registration Type</title>
  <!-- Fonts & Icons (align with your index.html includes) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
  <!-- Bootstrap CSS (assumes you have the same path as index.html) -->
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root{
    --brand:#0a7f41; --brand-700:#086d37; --ink:#0b1220; --muted:#6b7280; --surface:#fff;
  }
  html,body{height:100%}
  body{font-family:Inter, system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial; background:#f6f8fa; color:var(--ink)}
  .page{min-height:100vh; display:flex; align-items:center; justify-content:center; padding:32px}
  .chooser{ width:100%; max-width:980px }
  .header{ text-align:center; margin-bottom:22px }
  .header img{ width:72px; height:auto; margin-bottom:8px }
  .header h1{ font-weight:700; margin:0 0 6px }
  .header .sub{ color:var(--muted) }
  
  /* Updated role card styling */
  .role-card{ 
    background:var(--surface); 
    border-radius:18px; 
    padding:24px; 
    box-shadow:0 10px 30px rgba(16,24,40,.08); 
    transition: transform .12s ease, box-shadow .12s ease; 
    height:100%;
    text-align: center; /* Center all content in the card */
    display: flex;
    flex-direction: column;
    align-items: center; /* Center items horizontally */
  }
  
  .role-card:hover{ transform: translateY(-2px); box-shadow:0 14px 34px rgba(16,24,40,.12) }
  
  /* Centered icon */
  .role-icon{ 
    width:64px; 
    height:64px; 
    display:flex; 
    align-items:center; 
    justify-content:center; 
    border-radius:14px; 
    background:#eaf7f0; 
    color:var(--brand); 
    font-size:28px; 
    margin: 0 auto 14px auto; /* Center the icon and add bottom margin */
  }
  
  /* Centered title */
  .role-card h3{ 
    font-weight:700; 
    margin-bottom:6px;
    text-align: center; /* Explicitly center the title */
  }
  
  /* Centered description */
  .role-card p{ 
    color:var(--muted); 
    margin-bottom:18px;
    text-align: center; /* Center the description text */
  }
  
  .btn-brand{ background:var(--brand); border-color:var(--brand); color:#fff; font-weight:600; border-radius:12px; padding:.7rem 1rem; width: 100%; }
  .btn-outline-brand{ border-color:var(--brand); color:var(--brand); font-weight:600; border-radius:12px; padding:.7rem 1rem; width: 100%; }
  .back{ text-align:center; margin-top:16px }
  .back a{ color:var(--brand); text-decoration:none; font-weight:600 }
  
  /* Login link styling */
  .login-link {
    margin-top: 12px;
    text-align: center;
    width: 100%; /* Ensure full width for centering */
  }
  .login-link a {
    color: var(--brand);
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: color 0.2s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }
  .login-link a:hover {
    color: var(--brand-700);
    text-decoration: underline;
  }
  </style>
</head>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/68c11f4d2d363c192cba4ec1/1j4p64i0i';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<body>
  <main class="page">
    <div class="chooser">
      <div class="header">
        <img src="/uploads/slider/Narap.png" alt="NARAP" />
        <h1>Choose your registration type</h1>
        <div class="sub">Select whether you want to create a <strong>Member</strong> or <strong>Admin</strong> account.</div>
      </div>

      <div class="row g-4">
        <!-- Member card -->
        <div class="col-12 col-md-6">
          <div class="role-card h-100">
            <div class="role-icon" aria-hidden="true"><i class="fas fa-id-card"></i></div>
            <h3>Member</h3>
            <p>Create a member account to access the member dashboard, complete your profile, and manage your membership.
            </p>
           <a href="/register.php" class="btn btn-brand w-100" id="goMember">
              Continue as Member
            </a>
            <div class="login-link">
              <a href="/member/login.php">
                <i class="fas fa-sign-in-alt me-1"></i>
                Already have an account? Login here
              </a>
            </div>
          </div>
        </div>

        <!-- Admin card -->
        <div class="col-12 col-md-6">
          <div class="role-card h-100">
            <div class="role-icon" aria-hidden="true"><i class="fas fa-user-shield"></i></div>
            <h3>Admin</h3>
            <p>Register an administrator account to manage users, content, settings, and platform operations through the admin dashboard.</p>
            <a href="/admin/register.php" class="btn btn-outline-brand w-100" id="goAdmin">
              Continue as Admin
            </a>
            <div class="login-link">
              <a href="/admin/login.php">
                <i class="fas fa-shield-alt me-1"></i>
                Already have an admin account? Login here
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="back">
        <a href="/index.php" class="d-inline-flex align-items-center"><i class="fas fa-arrow-left me-2"></i> Back to Home</a>
      </div>
    </div>
  </main>

  <!-- Bootstrap JS bundle (optional if globally included) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>