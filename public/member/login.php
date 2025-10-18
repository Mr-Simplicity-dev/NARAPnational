<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" type="image/png" href="/uploads/slider/Narap.png"/>
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
    
    /* Google Sign-In Button Styles */
    .google-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      padding: 12px;
      margin-bottom: 16px;
      border: 1px solid #dadce0;
      border-radius: 10px;
      background: #fff;
      color: #3c4043;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .google-btn:hover {
      box-shadow: 0 1px 3px rgba(0,0,0,0.12);
      background: #f8f9fa;
    }
    
    .google-btn:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }
    
    .google-icon {
      width: 18px;
      height: 18px;
      margin-right: 8px;
    }
    
    .divider-or {
      display: flex;
      align-items: center;
      margin: 20px 0;
      color: #5f6368;
      font-size: 14px;
    }
    
    .divider-or::before,
    .divider-or::after {
      content: '';
      flex: 1;
      height: 1px;
      background: #dadce0;
    }
    
    .divider-or span {
      padding: 0 16px;
    }
  </style>
</head>
<body>
  <div class="wrap">
    <h1>Member Login</h1>
    
    <!-- Custom Google Button -->
    <button class="google-btn" id="googleSignInBtn">
      <svg class="google-icon" viewBox="0 0 24 24">
        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
      </svg>
      Continue with Google
    </button>
    
    <div class="divider-or">
      <span>OR</span>
    </div>
    
    <!-- Traditional Login Form -->
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
// Prevent multiple simultaneous requests
let isProcessing = false;

// Google Sign-In Functions
function initiateGoogleSignIn() {
  if (isProcessing) return;
  
  isProcessing = true;
  const btn = document.getElementById('googleSignInBtn');
  btn.disabled = true;
  btn.textContent = 'Redirecting to Google...';
  
  console.log('🔵 Initiating Google Sign-In from LOGIN page'); // Debug log
  
  // Add source parameter for login
  setTimeout(() => {
    window.location.href = '/api/auth/google?source=login';
  }, 100);
}

// Check profile completeness and redirect
async function checkProfileAndRedirect(token) {
  if (isProcessing) return;
  
  try {
    const profileRes = await fetch('/api/member/profile', {
      headers: {
        'Authorization': 'Bearer ' + token,
        'Content-Type': 'application/json'
      }
    });

    if (profileRes.ok) {
      const profile = await profileRes.json();
      
      // FIXED: Profile completeness check - removed profileCompleted flag requirement
      const isProfileComplete = 
        (profile.surname || profile.lastName || profile.name) &&
        (profile.otherNames || profile.firstName || profile.name) &&
        profile.phone && 
        profile.state && 
        profile.passportUrl && 
        profile.signatureUrl;

      console.log('Frontend profile check:', {
        isComplete: isProfileComplete,
        profile: profile
      });

      if (isProfileComplete) {
        window.location.href = '/member/dashboard.php';
      } else {
        window.location.href = '/member/profile-setup.php';
      }
    } else {
      window.location.href = '/member/profile-setup.php';
    }
  } catch (error) {
    console.error('Profile check error:', error);
    window.location.href = '/member/profile-setup.php';
  }
}

// Add event listener for Google button
document.addEventListener('DOMContentLoaded', function() {
  // Check for token in URL (from Google callback)
  const urlParams = new URLSearchParams(window.location.search);
  const token = urlParams.get('token');
  const googleAuth = urlParams.get('google_auth');
  
  if (token && googleAuth === 'success') {
    // Store token and check profile
    localStorage.setItem('jwt', token);
    checkProfileAndRedirect(token);
    return;
  }
  
  const googleBtn = document.getElementById('googleSignInBtn');
  if (googleBtn) {
    googleBtn.addEventListener('click', initiateGoogleSignIn);
  }
});

// Traditional login form
document.getElementById('loginForm').addEventListener('submit', async (e)=>{
  e.preventDefault();
  
  if (isProcessing) return;
  isProcessing = true;
  
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value.trim();
  const msg = document.getElementById('msg');
  const submitBtn = e.target.querySelector('button[type="submit"]');
  
  msg.textContent = 'Signing in...';
  msg.style.color = 'blue';
  submitBtn.disabled = true;

  try{
    const res = await fetch('/api/auth/login', {
      method:'POST',
      headers:{'Content-Type':'application/json'},
      body: JSON.stringify({ email, password })
    });
    
    const data = await res.json();
    
    if(!res.ok){ 
      throw new Error(data.message || 'Login failed'); 
    }

    // Store token
    localStorage.setItem('jwt', data.token);
    if(data.user){ 
      localStorage.setItem('user', JSON.stringify(data.user)); 
    }

    // Check if user is a member
    if(data.user && data.user.role === 'member'){
      msg.textContent = 'Login successful! Checking profile...';
      
      // Check profile completeness and redirect
      await checkProfileAndRedirect(data.token);
    } else {
      msg.textContent = 'This account is not a member. Use Admin Login.';
      msg.style.color = 'red';
      isProcessing = false;
      submitBtn.disabled = false;
    }
  } catch(err) {
    // Check if it's a Google user trying to login with password
    if(err.message.includes('Google') || err.message.includes('Continue with Google')) {
      msg.innerHTML = 'This account was created with Google. Please use the <strong>"Continue with Google"</strong> button above.';
      msg.style.color = 'orange';
    } else {
      msg.textContent = err.message || 'Error logging in';
      msg.style.color = 'red';
    }
    console.error('Login error:', err);
    isProcessing = false;
    submitBtn.disabled = false;
  }
});

</script>
</body>
</html>