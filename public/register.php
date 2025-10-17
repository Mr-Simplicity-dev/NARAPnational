<!doctype html>
<html lang="en">
<head>
  <link rel="icon" type="image/png" href="/uploads/slider/Narap.png"/>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>NARAP — Create Account</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link href="/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    :root{ --brand:#0a7f41; --brand-600:#0a7f41; --brand-700:#086d37; --brand-50:#eaf7f0; --ink:#0b1220; --muted:#6b7280; --surface:#fff }
    html,body{height:100%}
    body{ margin:0; background:#f6f8fa; color:var(--ink); font-family:Inter,system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial }

    /* Equal-height, perfectly aligned split */
    .page{ min-height:100vh; display:grid; grid-template-columns:1fr 1fr; gap:24px; padding:32px; align-items:stretch }
    .left-pane,.right-pane{ border-radius:16px; overflow:hidden }

    /* LEFT — branding */
    .left-pane{ position:relative; display:flex; align-items:center; justify-content:center; color:#fff; background:linear-gradient(135deg,var(--brand-600),var(--brand-700)) }
    .left-pane::before{ content:''; position:absolute; inset:0; background:url('/uploads/slider/Narap.png') center/360px no-repeat; opacity:.08; pointer-events:none }
    .branding{ position:relative; z-index:1; text-align:center; max-width:560px; padding:48px }
    .branding .logo{ width:92px; height:auto; margin-bottom:16px; filter:drop-shadow(0 2px 6px rgba(0,0,0,.25)) }
    .branding h1{ font-weight:700; margin:0 0 8px; font-size:1.8rem; line-height:1.2 }
    .branding p{ color:#e8f6ee; margin:0 auto; max-width:42ch; font-size:1rem; line-height:1.5 }

    /* RIGHT — the white panel with the form */
    .right-pane{ background:#fff; display:flex; align-items:center; justify-content:center; padding:0 }
    .card-auth{ width:min(560px,100%); margin:0; padding:40px 32px; background:transparent; box-shadow:none; display:flex; flex-direction:column; justify-content:center }
    .card-auth h2{ font-weight:700; margin:0 0 6px; font-size:1.5rem }
    .subtitle{ color:var(--muted); margin-bottom:16px; font-size:.95rem }

    .form-label{ font-weight:600; font-size:.95rem; margin-bottom:6px }
    .form-control{ padding:.75rem .9rem; border-radius:12px; min-height:44px; height:auto; font-size:1rem }
    .input-group .form-control{ border-top-left-radius:12px; border-bottom-left-radius:12px }

    .btn-brand{ background:var(--brand); border-color:var(--brand); color:#fff; font-weight:600; padding:.7rem 1rem; border-radius:12px; min-height:44px }
    .btn-brand:disabled{ opacity:.6; cursor:not-allowed }

    .form-check-input:checked{ background-color:var(--brand); border-color:var(--brand) }
    .form-check-label{ font-size:.95rem }
    .hint{ font-size:.9rem; color:var(--muted); margin-top:6px }
    .alert-guidelines{ background:var(--brand-50); border:1px solid rgba(10,127,65,.18); color:#084c2b; padding:12px; font-size:.9rem; border-radius:12px; margin-bottom:18px }
    .divider{ height:1px; background:#e5e7eb; margin:16px 0 8px }
    .pw-toggle{ cursor:pointer; user-select:none; font-size:.9rem }

    @media (max-width: 992px){ .page{ grid-template-columns:1fr; padding:20px } .left-pane{ display:none } .right-pane{ border-radius:16px } }
    @media (max-width: 576px){ .card-auth{ width:100%; padding:24px 16px } .card-auth h2{ font-size:1.3rem } }

    /* Google Sign-In Styles */
.google-signin-section { margin-bottom: 20px; }
.google-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  padding: 12px 16px;
  border: 2px solid #dadce0;
  border-radius: 12px;
  background: #fff;
  color: #3c4043;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
  text-decoration: none;
}
.google-btn:hover {
  box-shadow: 0 1px 3px rgba(0,0,0,0.1);
  border-color: #c1c7cd;
}
.google-icon {
  width: 20px;
  height: 20px;
  margin-right: 12px;
}
.divider-or {
  text-align: center;
  margin: 20px 0;
  position: relative;
}
.divider-or::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 1px;
  background: #e5e7eb;
}
.divider-or span {
  background: #fff;
  padding: 0 16px;
  color: #6b7280;
  font-size: 14px;
}
  </style>
</head>
<body>
  <div class="page">
    <!-- LEFT: Branding -->
    <aside class="left-pane">
      <div class="branding">
        <img src="/uploads/slider/Narap.png" alt="NARAP" class="logo" />
        <h1>Welcome to NARAP</h1>
        <p>Join the Nigerian Association of Refrigeration &amp; Air Conditioning Practitioners. Create your account to access your member dashboard.</p>
      </div>
    </aside>

       <main class="right-pane">
  <div class="card-auth">
    <h2>Create your account</h2>
    <div class="subtitle">Use a valid email you can access. You'll complete your full profile next.</div>

    <!-- Google Sign-In Section -->
    <div class="google-signin-section">
      <h6 class="mb-3">Quick signup with Google</h6>
      
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
    </div>

    <div class="divider-or">
      <span>OR</span>
    </div>

    <div class="alert alert-guidelines" role="alert">
      <div class="fw-bold mb-1">Before you start</div>
      <ul class="mb-0 ps-3">
        <li>Use your personal email (avoid shared inboxes).</li>
        <li>Choose a strong password (8+ chars, mix of letters &amp; numbers).</li>
        <li>You can fill your full details after creating this account.</li>
      </ul>
    </div>

    <form id="signupForm" class="needs-validation" novalidate>
      <!-- Hidden name that we derive from the email (local-part) -->
      <input type="hidden" id="name" name="name" />

      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
        <div class="invalid-feedback">Please enter a valid email.</div>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <input type="password" class="form-control" id="password" name="password" minlength="8" placeholder="••••••••" required>
          <button class="btn btn-outline-secondary pw-toggle" type="button" id="togglePassword" aria-label="Show password">Show</button>
        </div>
        <div class="hint mt-1" id="pwHint">Use at least 8 characters.</div>
        <div class="invalid-feedback">Please choose a password (min 8 characters).</div>
      </div>

      <div class="mb-3">
        <label for="confirm" class="form-label">Confirm password</label>
        <div class="input-group">
          <input type="password" class="form-control" id="confirm" name="confirm_password" minlength="8" placeholder="Repeat password" required>
          <button class="btn btn-outline-secondary pw-toggle" type="button" id="toggleConfirm" aria-label="Show password">Show</button>
        </div>
        <div class="invalid-feedback" id="confirmFeedback">Passwords must match.</div>
      </div>

      <div class="mb-3 form-check">
        <input class="form-check-input" type="checkbox" value="1" id="agree" required>
        <label class="form-check-label" for="agree">I agree to the NARAP Terms &amp; Privacy Policy</label>
        <div class="invalid-feedback">You must accept before continuing.</div>
      </div>

      <button type="submit" class="btn btn-brand w-100" id="submitBtn" disabled>Create Account</button>
    </form>

    <div class="divider"></div>
    <div class="text-center hint">Already have an account? <a href="/member/login.php" class="link-success">Sign in</a></div>

    <div id="signupMsg" class="mt-3"></div>
  </div>
</main>
  </div>
  <!-- Google Identity Services -->
<script src="https://accounts.google.com/gsi/client" async defer></script>

<script>
// Google Sign-In Functions
function initiateGoogleSignIn() {
  // Add source parameter
  window.location.href = '/api/auth/google?source=register';
}

function handleGoogleCredential(response) {
  console.log('Google credential received:', response);
  
  // Send the credential to your backend for verification
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
    if (data.success && data.token) {
      localStorage.setItem('jwt', data.token);
      document.getElementById('signupMsg').innerHTML = 
        '<div class="alert alert-success">Google sign-in successful! Redirecting...</div>';
      setTimeout(() => {
        window.location.href = '/member/profile-setup.php';
      }, 1500);
    } else {
      throw new Error(data.message || 'Google sign-in failed');
    }
  })
  .catch(err => {
    console.error('Google sign-in error:', err);
    document.getElementById('signupMsg').innerHTML = 
      '<div class="alert alert-danger">Google sign-in failed: ' + err.message + '</div>';
  });
}

// Add event listener for Google button
document.addEventListener('DOMContentLoaded', function() {
  const googleBtn = document.getElementById('googleSignInBtn');
  if (googleBtn) {
    googleBtn.addEventListener('click', initiateGoogleSignIn);
  }
});
</script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

  <script>
(function(){
  const form = document.getElementById('signupForm');
  const email = document.getElementById('email');
  const pass = document.getElementById('password');
  const confirm = document.getElementById('confirm');
  const agree = document.getElementById('agree');
  const submitBtn = document.getElementById('submitBtn');
  const msg = document.getElementById('signupMsg');
  const pwHint = document.getElementById('pwHint');
  const nameField = document.getElementById('name');

  function passwordsMatch(){ 
    return pass.value && confirm.value && pass.value === confirm.value; 
  }
  
  function sync(){
    const ok = form.checkValidity() && agree.checked && passwordsMatch();
    submitBtn.disabled = !ok;
    
    if (confirm.value.length > 0){
      if (passwordsMatch()) { 
        confirm.classList.remove('is-invalid'); 
        confirm.setCustomValidity(''); 
      } else { 
        confirm.classList.add('is-invalid'); 
        confirm.setCustomValidity('Passwords do not match'); 
      }
    } else { 
      confirm.classList.remove('is-invalid'); 
      confirm.setCustomValidity(''); 
    }
    
    pwHint.textContent = pass.value.length < 8 ? 
      'Use at least 8 characters.' : 
      'Looks good. Keep your password safe.';
  }

  // Initialize validation
  ['input','change','blur','keyup'].forEach(ev => { 
    [email,pass,confirm,agree].forEach(el => el && el.addEventListener(ev, sync)); 
  });
  sync();

  // Password toggle functionality
  document.getElementById('togglePassword').addEventListener('click', function(){
    const currentType = pass.getAttribute('type');
    if (currentType === 'password') {
      pass.setAttribute('type', 'text');
      this.textContent = 'Hide';
      this.setAttribute('aria-label', 'Hide password');
    } else {
      pass.setAttribute('type', 'password');
      this.textContent = 'Show';
      this.setAttribute('aria-label', 'Show password');
    }
  });
  
  document.getElementById('toggleConfirm').addEventListener('click', function(){
    const currentType = confirm.getAttribute('type');
    if (currentType === 'password') {
      confirm.setAttribute('type', 'text');
      this.textContent = 'Hide';
      this.setAttribute('aria-label', 'Hide password');
    } else {
      confirm.setAttribute('type', 'password');
      this.textContent = 'Show';
      this.setAttribute('aria-label', 'Show password');
    }
  });

  // Form submission
  form.addEventListener('submit', async function(e){
    e.preventDefault();
    if (!form.checkValidity()) { 
      form.classList.add('was-validated');
      return; 
    }

    // Auto-generate a simple name from email local-part
    const emailValue = email.value.trim();
    const nameFromEmail = emailValue.split('@')[0] || 'Member';
    nameField.value = nameFromEmail;

    submitBtn.disabled = true;
    submitBtn.textContent = 'Creating Account...';
    msg.innerHTML = '';
    
    try{
      const fd = new FormData();
      fd.append('name', nameFromEmail);
      fd.append('email', emailValue);
      fd.append('password', pass.value);
      fd.append('confirm_password', confirm.value);

      console.log('Sending registration request...');
      
      const res = await fetch('/api/auth/register-member', { 
        method: 'POST', 
        body: fd 
      });
      
      const data = await res.json().catch(() => ({}));
      
      console.log('Response status:', res.status);
      console.log('Response data:', data);
      
      if (!res.ok) {
        throw new Error(data.message || `Registration failed (${res.status})`);
      }

      // CRITICAL: Save the JWT token to localStorage
      if (data.token) {
        localStorage.setItem('jwt', data.token);
        console.log('Token saved to localStorage:', data.token.substring(0, 20) + '...');
      } else {
        console.warn('No token received in response');
      }

      msg.innerHTML = '<div class="alert alert-success">Account created successfully! Redirecting to profile setup...</div>';
      console.log('Redirecting to profile setup...');
      
      setTimeout(() => { 
        window.location.href = '/member/profile-setup.php'; 
      }, 1500);
      
    } catch(err) {
      console.error('Registration error:', err);
      submitBtn.disabled = false;
      submitBtn.textContent = 'Create Account';
      msg.innerHTML = '<div class="alert alert-danger">' + (err.message || 'Something went wrong. Please try again.') + '</div>';
    }
  });

  // Add Bootstrap validation styling
  form.addEventListener('input', function() {
    if (this.classList.contains('was-validated')) {
      this.classList.remove('was-validated');
    }
  });
})();
</script>
    
</body>
</html>