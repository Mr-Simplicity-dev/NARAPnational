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
    
    <!-- Google One Tap (hidden, auto-loads) -->
    <div id="g_id_onload"
         data-client_id="963092048723-a6bvo7dt81c8a0tk2tl50rapsjrfchpa.apps.googleusercontent.com"
         data-callback="handleGoogleCredential"
         data-auto_prompt="false"
         data-cancel_on_tap_outside="false">
    </div>
    
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

<!-- Google Identity Services -->
<script src="https://accounts.google.com/gsi/client" async defer></script>

<script>
// Google Sign-In Functions
function initiateGoogleSignIn() {
  // Redirect to your backend Google OAuth route
  window.location.href = '/api/auth/google';
}

// Handle Google One Tap credential
function handleGoogleCredential(response) {
  console.log('Google credential received:', response);
  
  // Send the credential to your backend
  fetch('/api/auth/google/verify', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      credential: response.credential
    })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      // Store token and redirect
      localStorage.setItem('jwt', data.token);
      if (data.user) {
        localStorage.setItem('user', JSON.stringify(data.user));
      }
      
      // Check profile completeness and redirect
      checkProfileAndRedirect(data.token);
    } else {
      document.getElementById('msg').textContent = data.message || 'Google sign-in failed';
      document.getElementById('msg').style.color = 'red';
    }
  })
  .catch(error => {
    console.error('Google sign-in error:', error);
    document.getElementById('msg').textContent = 'Google sign-in failed';
    document.getElementById('msg').style.color = 'red';
  });
}

// Check profile completeness and redirect
async function checkProfileAndRedirect(token) {
  try {
    const profileRes = await fetch('/api/member/profile', {
      headers: {
        'Authorization': 'Bearer ' + token,
        'Content-Type': 'application/json'
      }
    });

    if (profileRes.ok) {
      const profile = await profileRes.json();
      
      console.log('Profile data received:', profile); // Debug log
      
      const isProfileComplete = 
        (profile.surname || profile.lastName || profile.name) &&
        (profile.otherNames || profile.firstName || profile.name) &&
        profile.phone && 
        profile.state && 
        profile.passportUrl && 
        profile.signatureUrl &&
        profile.profileCompleted === true;

      console.log('Profile completeness check:', {
        surname: !!(profile.surname || profile.lastName),
        otherNames: !!(profile.otherNames || profile.firstName),
        name: !!profile.name,
        phone: !!profile.phone,
        state: !!profile.state,
        passportUrl: !!profile.passportUrl,
        signatureUrl: !!profile.signatureUrl,
        profileCompleted: profile.profileCompleted,
        isComplete: isProfileComplete
      });

      if (isProfileComplete) {
        console.log('Profile complete - redirecting to dashboard');
        window.location.href = '/member/dashboard.php';
      } else {
        console.log('Profile incomplete - redirecting to profile setup');
        window.location.href = '/member/profile-setup.php';
      }
    } else {
      console.log('Profile fetch failed - redirecting to profile setup');
      window.location.href = '/member/profile-setup.php';
    }
  } catch (error) {
    console.error('Profile check error:', error);
    window.location.href = '/member/profile-setup.php';
  }
}

// Add event listener for Google button
document.addEventListener('DOMContentLoaded', function() {
  const googleBtn = document.getElementById('googleSignInBtn');
  if (googleBtn) {
    googleBtn.addEventListener('click', initiateGoogleSignIn);
  }
});

// Traditional login form
document.getElementById('loginForm').addEventListener('submit', async (e)=>{
  e.preventDefault();
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value.trim();
  const msg = document.getElementById('msg');
  
  msg.textContent = 'Signing in...';
  msg.style.color = 'blue';

  try{
    // Step 1: Login
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
      checkProfileAndRedirect(data.token);
    } else {
      msg.textContent = 'This account is not a member. Use Admin Login.';
      msg.style.color = 'red';
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
  }
});
</script>
</body>
</html>