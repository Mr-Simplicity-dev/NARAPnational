<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<title>Register — Member</title>
<link href="/uploads/slider/Narap.png" rel="icon" type="image/png"/>
<link href="/css/bootstrap.min.css" rel="stylesheet"/>
<link href="/css/style.css" rel="stylesheet"/>
<style>.form-hint{font-size:.9rem;color:#6b7280}</style>
<style>
/* Make disabled submits clearly inactive */
button[disabled], input[type="submit"][disabled] {
  cursor: not-allowed !important;
}
/* If using Bootstrap, also support .btn.disabled */
.btn.disabled, .btn:disabled {
  cursor: not-allowed !important;
  opacity: .65; /* mirrors Bootstrap default */
}
</style>
<style>
.input-group .toggle-password { min-width: 4.5rem; }
</style>

<style>
.toggle-password i { pointer-events: none; } /* click goes to button */
</style>
<style>
/* Inline SVG icon sizing & behavior */
.toggle-password svg { width: 1.1em; height: 1.1em; pointer-events: none; }
[hidden] { display: none !important; }
</style></head>
<body>
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 shadow-sm">
<a class="navbar-brand px-4" href="/index.php">NARAP</a>
<button class="navbar-toggler me-4" data-bs-target="#navbarCollapse" data-bs-toggle="collapse" type="button">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarCollapse">
<div class="navbar-nav ms-auto p-4 p-lg-0">
<a class="nav-item nav-link" href="/register.php">Back</a>
<a class="nav-item nav-link" href="/member/login.php">Member Login</a>
</div>
</div>
</nav>
<div class="container py-5">
<div class="row justify-content-center">
<div class="col-lg-9">
<h1 class="mb-4">Member Registration</h1>
<form class="row g-3" enctype="multipart/form-data" id="memberForm">
<div class="col-12">
<div class="alert alert-warning mb-3" role="alert">
<div class="fw-bold mb-1">Please read before filling this form</div>
<ul class="mb-0 ps-3 small">
<li>Enter your full legal name exactly as it should appear on NARAP records.</li>
<li>Use a valid email address and phone number; confirmations <span class="fw-bold fst-italic">may</span> be sent there.</li>
<li>Upload a clear, recent passport photograph (JPG/PNG).</li>
<li>Select your correct Date of Birth and state.</li>
<li>Double-check all spellings and numbers before submitting.</li>
</ul>
</div>
</div>
<div class="col-md-6">
<label class="form-label">First Name:</label>
<input class="form-control" name="firstName" required=""/>
</div>
<div class="col-md-6">
<label class="form-label">Last Name:</label>
<input class="form-control" name="lastName" required=""/>
</div>
<div class="col-md-6">
<label class="form-label">Sex:</label>
<select class="form-control" name="state" required="">
<option disabled="" selected="" value="">Gender</option>
<option>Male</option>
<option>Female</option>
</select>
</div>
<div class="col-md-6">
<label class="form-label">Marital Status:</label>
<select class="form-control" name="state" required="">
<option disabled="" selected="" value="">Select Status</option>
<option>Single</option>
<option>Married</option>
</select>
</div>
<div class="col-md-6">
<label class="form-label">Mobile Number:</label>
<input class="form-control" name="Mobile Number" placeholder="Phone Number" required="" type="email"/>
</div>
<div class="col-md-6">
<label class="form-label">Email:</label>
<input class="form-control" name="email" placeholder="@gmail.com" required="" type="email"/>
</div>
<div class="col-md-6">
<label class="form-label">Residential Address:</label>
<input class="form-control" name="Residential Address" placeholder="Residential Address" required="" type="email"/>
</div>
<div class="col-md-6">
<label class="form-label">State:</label>
<select class="form-control" name="state" required="">
<option disabled="" selected="" value="">Select State</option>
<option>Abia</option>
<option>Adamawa</option>
<option>Akwa Ibom</option>
<option>Anambra</option>
<option>Bauchi</option>
<option>Bayelsa</option>
<option>Benue</option>
<option>Borno</option>
<option>Cross River</option>
<option>Delta</option>
<option>Ebonyi</option>
<option>Edo</option>
<option>Ekiti</option>
<option>Enugu</option>
<option>Gombe</option>
<option>Imo</option>
<option>Jigawa</option>
<option>Kaduna</option>
<option>Kano</option>
<option>Katsina</option>
<option>Kebbi</option>
<option>Kogi</option>
<option>Kwara</option>
<option>Lagos</option>
<option>Nasarawa</option>
<option>Niger</option>
<option>Ogun</option>
<option>Ondo</option>
<option>Osun</option>
<option>Oyo</option>
<option>Plateau</option>
<option>Rivers</option>
<option>Sokoto</option>
<option>Taraba</option>
<option>Yobe</option>
<option>Zamfara</option>
<option>FCT (Abuja)</option>
</select>
</div>
<div class="col-md-6">
<label class="form-label">Zone:</label>
<input class="form-control" name="Zone" placeholder="Zone"/>
</div>
<div class="col-md-6">
<label class="form-label">Ward:</label>
<input class="form-control" name="Ward" placeholder="Ward"/>
</div>
<div class="col-md-6">
<label class="form-label">Business Registered Name:</label>
<input class="form-control" name="Business Registered Name" placeholder="Business Registered Name" required="" type="email"/>
</div>
<div class="col-md-6">
<label class="form-label">Business Address:</label>
<input class="form-control" name="Businessl Address" placeholder="Business Address" required="" type="email"/>
</div>
<div class="col-md-6">
<label class="form-label">Area of Specialization</label>
<select class="form-control" name="state" required="">
<option disabled="" selected="" value="">Select Area of Specialization</option>
<option>Air Conditioning</option>
<option>Refrigeration</option>
<option>Air Conditioning &amp; Refrigeration</option>
</select>
</div>
<div class="col-md-6">
<label class="form-label">All Positions:</label>
<select class="form-control" name="state" required="">
<option disabled="" selected="" value="">Select Position</option>
<option>President</option>
<option>Deputy President</option>
<option>Vice President (North Central)</option>
<option>Vice President (North East)</option>
<option>Vice President (North West)</option>
<option>Vice President (South East)</option>
<option>Vice President (South South)</option>
<option>Vice President (South West)</option>
<option>Secretary</option>
<option>Assistant Secretary</option>
<option>Financial Secretary</option>
<option>Assistant Financial Secretary</option>
<option>Treasurer</option>
<option>Public Relation Officer (PRO)</option>
<option>Assistant Public Relation Officer (APRO)</option>
<option>Provost Marshal 1</option>
<option>Provost Marshal 2</option>
<option>State Welfare Coordinator</option>
<option>Coordinator</option>
<option>Assistant Coordinator</option>
<option>Chairman</option>
<option>Vice Chairman</option>
<option>State Secretary </option>
<option>State Assistant Secretary</option>
<option>State Financial Secretary</option>
<option>State Treasurer</option>
<option>Task Force</option>
<option>Old Member</option>
<option>New Member</option>
</select>
</div>
<div class="col-md-6">
<label class="form-label">Password:</label>
<div class="input-group mb-2"><input class="form-control" id="password" minlength="6" name="password" placeholder="*******" required="" type="password"/><button aria-label="Show password" class="btn btn-outline-secondary toggle-password" data-target="#password" title="Show password" type="button"><svg aria-hidden="true" class="icon-eye" height="16" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8z"></path>
<path d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
</svg><svg aria-hidden="true" class="icon-eye-slash" height="16" hidden="" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
<path d="M13.359 11.238C11.93 12.5 10.1 13.5 8 13.5 3 13.5 0 8 0 8a17.6 17.6 0 0 1 3.11-3.66l-.97-.97a.75.75 0 1 1 1.06-1.06l12 12a.75.75 0 1 1-1.06 1.06l-0.78-0.78z"></path>
<path d="M5.354 6.207A3 3 0 0 0 8 11a2.99 2.99 0 0 0 2.793-1.646l-5.44-5.44zM8 2.5C13 2.5 16 8 16 8c-.365.67-.81 1.32-1.32 1.93l-1.07-1.07C14.41 8.28 14.76 7.66 15 7.25 15 7.25 12 2.5 8 2.5 6.67 2.5 5.53 2.9 4.58 3.44l1.08 1.08C6.35 4.2 7.15 4 8 4z"></path>
</svg><span class="visually-hidden">Show</span></button></div>
</div>
<div class="col-md-6">
<label class="form-label">Confirm Password:</label>
<div class="input-group mb-2"><input class="form-control" id="confirmPassword" minlength="6" name="confim password" placeholder="*******" required="" type="password"/><button aria-label="Show password" class="btn btn-outline-secondary toggle-password" data-target="#confirmPassword" title="Show password" type="button"><svg aria-hidden="true" class="icon-eye" height="16" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8z"></path>
<path d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
</svg><svg aria-hidden="true" class="icon-eye-slash" height="16" hidden="" viewbox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
<path d="M13.359 11.238C11.93 12.5 10.1 13.5 8 13.5 3 13.5 0 8 0 8a17.6 17.6 0 0 1 3.11-3.66l-.97-.97a.75.75 0 1 1 1.06-1.06l12 12a.75.75 0 1 1-1.06 1.06l-0.78-0.78z"></path>
<path d="M5.354 6.207A3 3 0 0 0 8 11a2.99 2.99 0 0 0 2.793-1.646l-5.44-5.44zM8 2.5C13 2.5 16 8 16 8c-.365.67-.81 1.32-1.32 1.93l-1.07-1.07C14.41 8.28 14.76 7.66 15 7.25 15 7.25 12 2.5 8 2.5 6.67 2.5 5.53 2.9 4.58 3.44l1.08 1.08C6.35 4.2 7.15 4 8 4z"></path>
</svg><span class="visually-hidden">Show</span></button></div>
<div class="invalid-feedback">Passwords do not match.</div></div>
<div class="col-md-6">
<label class="form-label">Passport Photo:</label>
<input accept="image/*" class="form-control" name="passport" required="" type="file"/>
<div class="form-hint fst-italic">Upload a clear face photo (JPG/PNG).</div>
</div>
<div class="col-md-6">
<label class="form-label">Signature:</label>
<input accept="image/*" class="form-control" name="passport" required="" type="file"/>
<div class="form-hint fst-italic">Upload a Signature.</div>
</div>
<div class="col-12">
<label class="form-label fw-bold">Declaration:</label>
<div class="mb-3"><div class="form-check"><input class="form-check-input" id="declareAgree" name="declare_agree" required="" type="checkbox"/><label class="form-check-label" for="declareAgree">I agree to become a member of the Nigerian Association of Refrigeration &amp; Air Conditioning Practitioners (NARAP) and confirm that all information supplied in this form is correct. I understand that any false information will lead to dismembership from the Association.</label></div></div><button aria-disabled="true" class="btn btn-success disabled" disabled="disabled" type="submit">Create Member Account</button>
</div>
</form>
<div class="mt-3" id="memberMsg"></div>
</div>
</div>
</div>
<script>
function setMsg(el, text, ok=false) {
  el.innerHTML = '<div class="alert '+(ok?'alert-success':'alert-danger')+'">'+text+'</div>';
  el.scrollIntoView({behavior:'smooth', block:'nearest'});
}

document.getElementById('memberForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  const msg = document.getElementById('memberMsg');
  const fd = new FormData(e.target);

  try {
    const res = await fetch('/api/auth/register-member', {
      method: 'POST',
      body: fd
    });
    const data = await res.json().catch(() => ({}));
    if (!res.ok) throw new Error(data.message || 'Registration failed');

    setMsg(msg, 'Member account created. Redirecting to login…', true);
    setTimeout(()=> { window.location.href = '/member/login.php'; }, 1000);
  } catch (err) {
    setMsg(msg, err.message || 'Something went wrong.');
  }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var form = document.getElementById('memberForm') || document.querySelector('form');
  var checkbox = form ? form.querySelector('#declareAgree, [name="declare_agree"]') : null;
  // Prefer the submit labelled "Create Member"
  var submits = form ? Array.from(form.querySelectorAll('button[type="submit"], input[type="submit"]')) : [];
  var submitBtn = submits.find(function(el){
    var t = (el.innerText || el.value || '').toLowerCase();
    return t.includes('create member');
  }) || submits[0];

  function sync() {
    if (!checkbox || !submitBtn) return;
    submitBtn.disabled = !checkbox.checked;
    if (submitBtn.tagName === 'BUTTON') {
      submitBtn.setAttribute('aria-disabled', submitBtn.disabled ? 'true' : 'false');
    }
  }

  if (checkbox && submitBtn) {
    sync();
    checkbox.addEventListener('change', sync);
    form.addEventListener('submit', function(e){
      if (!checkbox.checked) {
        // This is defensive; the "required" attribute will already block submission.
        e.preventDefault();
        checkbox.focus();
      }
    });
  }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var form = document.getElementById('registerForm') || document.querySelector('form');
  if (!form) return;
  var checkbox = form.querySelector('#declareAgree, [name="declare_agree"]');
  var submits = Array.from(form.querySelectorAll('button[type="submit"], input[type="submit"]'));
  var submitBtn = submits.find(function(el){
    var t = (el.innerText || el.value || '').toLowerCase();
    return t.includes('create member');
  }) || submits[0];
  if (!checkbox || !submitBtn) return;

  function syncDisabled(){
    var enabled = !!checkbox.checked;
    submitBtn.disabled = !enabled;
    if (submitBtn.tagName === 'BUTTON') {
      submitBtn.setAttribute('aria-disabled', (!enabled).toString());
    }
    if (enabled) {
      submitBtn.classList.remove('disabled');
    } else {
      if (!submitBtn.classList.contains('disabled')) submitBtn.classList.add('disabled');
    }
  }

  syncDisabled();
  checkbox.addEventListener('change', syncDisabled);
});
</script>
\n<script>
document.addEventListener('DOMContentLoaded', function(){
  var form = document.getElementById('registerForm') || document.querySelector('form');
  if (!form) return;

  var checkbox = form.querySelector('#declareAgree, [name="declare_agree"]');
  var pass = form.querySelector('#password, [name="password"]');
  var confirm = form.querySelector('#confirmPassword, [name="confirm_password"]');
  var btns = Array.from(form.querySelectorAll('button[type="submit"], input[type="submit"]'));
  var submitBtn = btns.find(function(el){
    var t = (el.innerText || el.value || '').toLowerCase();
    return t.includes('create member');
  }) || btns[0];

  // Icon-based toggle (inline SVG)
  
form.querySelectorAll('.toggle-password').forEach(function(btn){
  var targetSel = btn.getAttribute('data-target');
  var target = targetSel ? form.querySelector(targetSel) : null;
  var eye = btn.querySelector('.icon-eye');
  var eyeSlash = btn.querySelector('.icon-eye-slash');
  var sr = btn.querySelector('.visually-hidden');
  function render(){
    var isPwd = target && target.type === 'password';
    if (eye && eyeSlash){
      eye.hidden = !isPwd;
      eyeSlash.hidden = isPwd;
    }
    if (sr){ sr.textContent = isPwd ? 'Show' : 'Hide'; }
    btn.setAttribute('aria-label', isPwd ? 'Show password' : 'Hide password');
    btn.setAttribute('title', isPwd ? 'Show password' : 'Hide password');
  }
  render();
  btn.addEventListener('click', function(){
    if (!target) return;
    target.type = (target.type === 'password') ? 'text' : 'password';
    render();
  });
});
// Validation for password match
  function passwordsMatch(){
    if (!pass || !confirm) return true;
    if (!confirm.value || !pass.value) return false;
    return pass.value === confirm.value;
  }

  function updateValidationUI(){
    if (!pass || !confirm) return;
    if (confirm.value.length === 0) {
      confirm.classList.remove('is-invalid');
      confirm.setCustomValidity('');
      return;
    }
    if (passwordsMatch()){
      confirm.classList.remove('is-invalid');
      confirm.setCustomValidity('');
    } else {
      confirm.classList.add('is-invalid');
      confirm.setCustomValidity('Passwords do not match');
    }
  }

  function syncDisabled(){
    if (!submitBtn) return;
    var declOK = checkbox ? checkbox.checked : true;
    var pwdOK = passwordsMatch();
    var enabled = declOK && pwdOK;
    submitBtn.disabled = !enabled;
    if (submitBtn.tagName === 'BUTTON') {
      submitBtn.setAttribute('aria-disabled', (!enabled).toString());
    }
    if (enabled) {
      submitBtn.classList.remove('disabled');
    } else {
      if (!submitBtn.classList.contains('disabled')) submitBtn.classList.add('disabled');
    }
    var wrapper = submitBtn.closest ? submitBtn.closest('.tooltip-wrapper') : (submitBtn.parentElement && submitBtn.parentElement.classList.contains('tooltip-wrapper') ? submitBtn.parentElement : null);
    if (wrapper) {
      wrapper.setAttribute('data-disabled', (!enabled).toString());
      if (!enabled) {
        wrapper.setAttribute('data-tip', checkbox && !checkbox.checked ? 'Please agree to the declaration first' : 'Passwords must match');
      } else {
        wrapper.removeAttribute('data-tip');
      }
    }
  }

  ['input','change','blur','keyup'].forEach(function(ev){
    if (pass) pass.addEventListener(ev, function(){ updateValidationUI(); syncDisabled(); });
    if (confirm) confirm.addEventListener(ev, function(){ updateValidationUI(); syncDisabled(); });
  });
  if (checkbox) checkbox.addEventListener('change', syncDisabled);

  updateValidationUI();
  syncDisabled();
});
</script></body>
</html>
