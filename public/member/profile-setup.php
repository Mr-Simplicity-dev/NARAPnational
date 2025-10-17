<?php
// profile-setup.php
// Client-side protected profile setup page for members.
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" type="image/png" href="/uploads/slider/Narap.png"/>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>NARAP — Profile Setup</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root{
      --brand:#0a7f41;
      --ink:#0b1220; --muted:#6b7280; --surface:#ffffff; --bg:#f7faf9;
      --ok:#16a34a; --warn:#f59e0b; --err:#ef4444;
      --ring: 0 0 0 3px rgba(10,127,65,.18);
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
      background:var(--bg); color:var(--ink); line-height:1.6;
    }
    .reg-topbar {
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      border-bottom: 1px solid #e5e7eb;
    }
    .reg-top-logo {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
    }
    .reg-logo {
      height: 40px;
    }
    .reg-title {
      color: var(--brand);
      font-weight: 700;
      border-bottom: 2px solid var(--brand);
      padding-bottom: 10px;
    }
    header{
      position:sticky; top:0; z-index:5;
      background:var(--brand); color:#fff; padding:14px 18px;
      display:flex; align-items:center; justify-content:space-between;
      box-shadow:0 2px 8px rgba(0,0,0,.1);
    }
    header .title{font-weight:800; letter-spacing:.2px}
    header .status{font-size:.9rem; opacity:.9}
    main{max-width:980px; margin:28px auto; padding:0 16px}
    .card{
      background:var(--surface); border-radius:16px; padding:28px;
      box-shadow:0 8px 24px rgba(2,6,23,.06);
      border:1px solid #e5efe9;
    }
    .grid{display:grid; grid-template-columns:1fr 1fr; gap:20px}
    .grid-3{display:grid; grid-template-columns:repeat(3,1fr); gap:20px}
    @media (max-width: 860px){
      .grid,.grid-3{grid-template-columns:1fr}
    }
    label{display:block; font-weight:600; margin:10px 0 6px; color:var(--ink)}
    input[type="text"], input[type="email"], textarea, select{
      width:100%; padding:12px 14px; border:1px solid #dbe7e0; border-radius:12px;
      background:#fff; color:var(--ink); outline:none; font-size:15px;
      transition:border-color .15s ease, box-shadow .15s ease;
    }
    input[type="text"]:focus, input[type="email"]:focus, textarea:focus, select:focus{
      border-color:var(--brand); box-shadow:var(--ring);
    }
    textarea{min-height:90px; resize:vertical}
    .muted{color:var(--muted); font-size:.92rem}
    .row{display:flex; gap:12px; align-items:center; flex-wrap:wrap}
    .btn{
      appearance:none; border:0; border-radius:12px; padding:14px 20px; font-weight:700;
      cursor:pointer; background:var(--brand); color:#fff; box-shadow:0 6px 16px rgba(10,127,65,.2);
      transition: transform .06s ease, box-shadow .15s ease, opacity .2s; font-size:15px;
    }
    .btn.secondary{background:#eef7f1; color:var(--brand); font-weight:700}
    .btn:active{transform:translateY(1px)}
    .btn[disabled]{opacity:.6; cursor:not-allowed}
    .actions{display:flex; gap:14px; justify-content:space-between; margin-top:24px}
    .actions-left{display:flex; gap:14px; justify-content:flex-start}
    .actions-center{display:flex; gap:14px; justify-content:center}
    .actions-right{display:flex; gap:14px; justify-content:flex-end}
    @media (max-width: 768px){
      .actions{flex-direction:column; align-items:stretch}
      .actions-left, .actions-center, .actions-right{justify-content:center}
    }
    .section-title{font-size:1.2rem; font-weight:800; margin:24px 0 18px; color:var(--brand); border-bottom:2px solid #eef7f1; padding-bottom:8px}
    .help{font-size:.9rem; color:var(--muted); margin-bottom:16px}
    .info{background:#eef7f1; color:#064e2d; padding:12px 16px; border-radius:10px; border:1px solid #d1ecda; margin-bottom:20px}
    .error{background:#fef2f2; color:#991b1b; padding:12px 16px; border-radius:10px; border:1px solid #ffe1e1; margin-bottom:20px}
    /* Upload + preview */
    .upload-wrap{display:grid; grid-template-columns:1fr 1fr; gap:24px}
    @media (max-width: 680px){
      .upload-wrap{grid-template-columns:1fr}
    }
    .preview-card{
      border:1px dashed #cfe3d7; border-radius:14px; padding:20px;
      display:flex; flex-direction:column; gap:14px; align-items:center; justify-content:center;
      min-height:230px; background:#fff; transition:border-color .2s ease;
    }
    .preview-card:hover{border-color:var(--brand)}
    .preview-box{display:flex; align-items:center; justify-content:center; width:100%}
    .passport-preview,.signature-preview{
      display:block; max-width:160px; max-height:160px; object-fit:cover; margin:auto; border-radius:10px;
      box-shadow:0 8px 18px rgba(2,6,23,.06);
    }
    .signature-preview{max-height:80px}
    @media (max-width:768px){
      .passport-preview,.signature-preview{max-width:120px; max-height:120px}
      .signature-preview{max-height:60px}
    }
    .file-upload-label{
      background:#eef7f1; color:var(--brand); padding:12px 18px; border-radius:10px; font-weight:700;
      border:1px solid #cfe3d7; cursor:pointer; transition:all .2s ease;
    }
    .file-upload-label:hover{filter:brightness(.95); transform:translateY(-1px)}
    .hidden{display:none}
    footer{margin:24px 0; text-align:center; color:var(--muted); font-size:.9rem}
    .form-group{margin-bottom:16px}
    .instructions{background:#f8faf9; border-left:4px solid var(--brand); padding:16px 20px; border-radius:8px; margin-bottom:24px}
    .instructions ul{margin:8px 0; padding-left:20px}
    .instructions li{margin-bottom:6px; font-size:0.9rem; line-height:1.5}
  </style>
</head>
<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 shadow-sm reg-topbar">
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
    <div class="reg-top-logo">
      <img alt="NARAP Logo" class="reg-logo img-fluid" src="/uploads/slider/Narap.png"/>
    </div>
  </nav>

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-9">
        <h1 class="mb-4 reg-title">Member Registration</h1>

        <div id="notice" class="info hidden"></div>
        <div id="error" class="error hidden"></div>

        <div class="card">
          <!-- Instructions Section -->
          <div class="instructions">
            <div class="fw-bold mb-1">Please read before filling this form</div>
            <ul class="mb-0 ps-3 small">
              <li>Enter your full legal name exactly as it should appear on NARAP records.</li>
              <li>Use a valid email address and phone number; confirmations <span class="fw-bold fst-italic">may</span> be sent there.</li>
              <li>Upload a clear, recent passport photograph (JPG/PNG).</li>
              <li>Select your correct Date of Birth and state.</li>
              <li>Double-check all spellings and numbers before submitting.</li>
            </ul>
          </div>

          <div class="section-title">Basic Information</div>
          <form id="profileForm">
            <div class="grid">
              <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="e.g., Aisha Bello" required />
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" required readonly />
              </div>
            </div>

            <div class="grid">
              <div class="form-group">
                <label for="sex">Sex</label>
                <select id="sex" name="sex" required>
                  <option disabled selected value="">Select Gender</option>
                  <option>Male</option>
                  <option>Female</option>
                </select>
              </div>
              <div class="form-group">
                <label for="maritalStatus">Marital Status</label>
                <select id="maritalStatus" name="maritalStatus" required>
                  <option disabled selected value="">Select Status</option>
                  <option>Single</option>
                  <option>Married</option>
                </select>
              </div>
            </div>

            <div class="grid">
              <div class="form-group">
                <label for="phoneNumber">Phone Number</label>
                <input type="text" id="phoneNumber" name="phoneNumber" placeholder="+234…" required />
              </div>
              <div class="form-group">
                <label for="state">State</label>
                <select id="state" name="state" required>
                  <option disabled selected value="">Select State</option>
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
            </div>

            <div class="grid">
              <div class="form-group">
                <label for="lga">LGA</label>
                <input type="text" id="lga" name="lga" placeholder="Local Government Area" />
              </div>
              <div class="form-group">
                <label for="zone">Zone</label>
                <input type="text" id="zone" name="zone" placeholder="e.g., North Central" />
              </div>
            </div>

            <div class="grid">
              <div class="form-group">
                <label for="ward">Ward</label>
                <input type="text" id="ward" name="ward" placeholder="Ward" />
              </div>
              <div class="form-group">
                <label for="businessName">Business Registered Name</label>
                <input type="text" id="businessName" name="businessName" placeholder="Business Registered Name" required />
              </div>
            </div>

            <div class="grid">
              <div class="form-group">
                <label for="businessAddress">Business Address</label>
                <input type="text" id="businessAddress" name="businessAddress" placeholder="Business Address" required />
              </div>
              <div class="form-group">
                <label for="specialization">Area of Specialization</label>
                <select id="specialization" name="specialization" required>
                  <option disabled selected value="">Select Area of Specialization</option>
                  <option>Air Conditioning</option>
                  <option>Refrigeration</option>
                  <option>Air Conditioning & Refrigeration</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="position">All Positions</label>
              <select id="position" name="position" required>
                <option disabled selected value="">Select Position</option>
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
                <option>State Secretary</option>
                <option>State Assistant Secretary</option>
                <option>State Financial Secretary</option>
                <option>State Treasurer</option>
                <option>Task Force</option>
                <option>Old Member</option>
                <option>New Member</option>
              </select>
            </div>

            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" id="address" name="address" placeholder="Street, city" />
            </div>

            <div class="section-title">Next of Kin & Guarantor</div>

            <div class="grid">
              <div class="form-group">
                <label for="nextOfKin">Next of Kin</label>
                <input type="text" id="nextOfKin" name="nextOfKin" placeholder="Next of Kin" />
              </div>
              <div class="form-group">
                <label for="guarantor">Guarantor <span class="muted">(must be a practitioner)</span></label>
                <input type="text" id="guarantor" name="guarantor" placeholder="Guarantor" required />
              </div>
            </div>

            <div class="grid">
              <div class="form-group">
                <label for="guarantorAddress">Guarantor's Address</label>
                <input type="text" id="guarantorAddress" name="guarantorAddress" placeholder="Address" required />
              </div>
              <div class="form-group">
                <label for="guarantorPosition">Guarantor's Position</label>
                <select id="guarantorPosition" name="guarantorPosition" required>
                  <option disabled selected value="">Select Position</option>
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
                  <option>State Secretary</option>
                  <option>State Assistant Secretary</option>
                  <option>State Financial Secretary</option>
                  <option>State Treasurer</option>
                  <option>Task Force</option>
                  <option>Member</option>
                </select>
              </div>
            </div>

            <div class="section-title">Passport &amp; Signature</div>
            <p class="help">Upload clear images. Previews appear instantly. Files upload securely before you submit.</p>

            <!-- Hidden fields populated after upload -->
            <input type="hidden" name="passportUrl" />
            <input type="hidden" name="signatureUrl" />

            <div class="upload-wrap">
              <div class="preview-card">
                <div class="preview-box">
                  <img class="passport-preview" alt="Passport preview" />
                </div>
                <label class="file-upload-label" for="passport">Upload Passport</label>
                <input id="passport" type="file" accept="image/*" class="hidden" />
              </div>

              <div class="preview-card">
                <div class="preview-box">
                  <img class="signature-preview" alt="Signature preview" />
                </div>
                <label class="file-upload-label" for="signature">Upload Signature</label>
                <input id="signature" type="file" accept="image/*" class="hidden" />
              </div>
            </div>

            <div class="actions">
              <div class="actions-left">
                <button type="button" class="btn secondary" onclick="finishLater()">Finish later</button>
              </div>
              <div class="actions-center">
                <button type="button" class="btn" id="btnSaveContinue">Save &amp; Continue</button>
              </div>
              <div class="actions-right">
                <button type="button" class="btn" id="btnSubmitAll">Submit Profile</button>
              </div>
            </div>
          </form>
        </div>

        <footer>Tip: If you leave, your progress is auto-saved on this device.</footer>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
  // Authentication and user data loading
  (function(){
  // Check for token in URL parameters first (from Google OAuth)
  const urlParams = new URLSearchParams(window.location.search);
  const urlToken = urlParams.get('token');
  
  let token = localStorage.getItem('jwt');
  
  // If token is in URL, save it to localStorage and clean URL
  if (urlToken) {
    localStorage.setItem('jwt', urlToken);
    token = urlToken;
    console.log('Token received from Google OAuth, saved to localStorage');
    
    // Clean the URL (remove token parameter)
    const newUrl = window.location.pathname;
    window.history.replaceState({}, document.title, newUrl);
  }
  
  if (!token) {
    console.log('No JWT token found, redirecting to login...');
    setTimeout(() => { 
      window.location.replace('/member/login.php'); 
    }, 400);
    return;
  }
    
    console.log('JWT token found, fetching user data...');
    
    // Fetch user data and pre-fill the form
    fetch('/api/member/profile', {
      headers: { 
        'Authorization': 'Bearer ' + token,
        'Content-Type': 'application/json'
      }
    })
    .then(res => {
      if (!res.ok) {
        throw new Error('Failed to load user data: ' + res.status);
      }
      return res.json();
    })
    .then(userData => {
      console.log('User data loaded:', userData);
      
      // Pre-fill the form with user data
      if (userData.email) {
        document.getElementById('email').value = userData.email;
        console.log('Email pre-filled:', userData.email);
      }
      if (userData.name) {
        document.getElementById('name').value = userData.name;
      }
      if (userData.phone) {
        document.getElementById('phoneNumber').value = userData.phone;
      }
      if (userData.state) {
        document.getElementById('state').value = userData.state;
      }
      if (userData.zone) {
        document.getElementById('zone').value = userData.zone;
      }
      if (userData.lga) {
        document.getElementById('lga').value = userData.lga;
      }
      if (userData.address) {
        document.getElementById('address').value = userData.address;
      }
      
    })
    .catch(err => {
      console.error('Error loading user data:', err);
      setTimeout(() => { 
        window.location.replace('/member/login.php'); 
      }, 400);
    });
  })();
  </script>

<script>
  // After user data is loaded, add this check:
if (userData && userData.profileCompleted === true) {
  console.log('✅ Profile already completed, redirecting to dashboard...');
  
  // Show a brief message and redirect
  const notice = document.getElementById('notice');
  if (notice) {
    notice.style.display = 'block';
    notice.style.color = 'green';
    notice.textContent = 'Profile already completed! Redirecting to dashboard...';
  }
  
  // Redirect to dashboard after 1 second
  setTimeout(() => {
    window.location.href = '/member/dashboard.php';
  }, 1000);
  
  return; // Stop further execution
}
</script>

  <script>
  // ===== Utilities & Draft Autosave =====
  (function(){
    const FORM_ID = 'profileForm';
    const DRAFT_KEY = 'profileDraft.v1';
    const form = document.getElementById(FORM_ID);
    const notice = document.getElementById('notice');
    const errorBox = document.getElementById('error');
    const btnSaveContinue = document.getElementById('btnSaveContinue');
    const btnSubmitAll = document.getElementById('btnSubmitAll');

    const show = (el, msg) => { el.textContent = msg; el.classList.remove('hidden'); };
    const hide = (el) => { el.classList.add('hidden'); };

    // Restore draft (if any) - but don't override pre-filled data
    try{
      const draft = localStorage.getItem(DRAFT_KEY);
      if (draft && form) {
        const data = JSON.parse(draft);
        Object.keys(data).forEach(k => {
          const el = form.elements.namedItem(k);
          // Only fill if the field is empty (don't override server data)
          if (el && el.type !== 'file' && !el.value) {
            el.value = data[k];
          }
        });
        show(notice, 'Draft restored — you can continue where you left off.');
        setTimeout(()=> hide(notice), 2500);
      }
    }catch(e){ /* ignore */ }

    // Auto-save any change (except email since it's readonly)
    form?.addEventListener('input', (e) => {
      if (e.target.name === 'email') return; // Don't save email changes
      
      const payload = {};
      Array.from(form.elements).forEach(el => {
        if (!el.name || el.type === 'file' || el.name === 'email') return;
        payload[el.name] = el.value;
      });
      try{
        localStorage.setItem(DRAFT_KEY, JSON.stringify(payload));
      }catch(e){ /* ignore quota */ }
    });

    // Expose finishLater()
    window.finishLater = () => {
      show(notice, 'Saved. You can return to complete your profile later.');
      setTimeout(()=> hide(notice), 2400);
    };

    // Expose clearDraft()
    window.clearDraft = () => localStorage.removeItem(DRAFT_KEY);

    // Small helper to attach Authorization header every time
    window.authFetch = (url, opts = {}) => {
      const token = localStorage.getItem('jwt');
      const headers = Object.assign(
        opts.headers || {},
        token ? { 'Authorization': 'Bearer ' + token } : {}
      );
      
      // Don't override Content-Type for FormData (file uploads)
      if (!opts.body || !(opts.body instanceof FormData)) {
        headers['Content-Type'] = 'application/json';
      }
      
      return fetch(url, Object.assign({}, opts, { headers, credentials: 'include' }));
    };

    // Upload + preview helpers
    function preview(input, imgSel){
      const img = document.querySelector(imgSel);
      if (!img || !input.files?.[0]) return;
      img.src = URL.createObjectURL(input.files[0]);
    }

    async function uploadFile(file, folder){
      const fd = new FormData(); 
      fd.append('file', file);
      const res = await authFetch('/api/uploads?folder='+encodeURIComponent(folder), { 
        method:'POST', 
        body: fd 
      });
      const data = await res.json().catch(()=> ({}));
      if (!res.ok) throw new Error(data?.message || 'Upload failed');
      return data.fileUrl || data.url;
    }

    // Wire file inputs
    const passportInput = document.getElementById('passport');
    passportInput?.addEventListener('change', async (e)=>{
      preview(e.target, '.passport-preview');
      try{
        const url = await uploadFile(e.target.files[0], 'passports');
        const hidden = form.elements.namedItem('passportUrl');
        if (hidden) hidden.value = url;
        show(notice, 'Passport uploaded successfully!');
        setTimeout(()=> hide(notice), 2000);
      }catch(err){
        show(errorBox, 'Passport upload failed: ' + err.message); 
        setTimeout(()=> hide(errorBox), 4000);
      }
    });

    const signatureInput = document.getElementById('signature');
    signatureInput?.addEventListener('change', async (e)=>{
      preview(e.target, '.signature-preview');
      try{
        const url = await uploadFile(e.target.files[0], 'signatures');
        const hidden = form.elements.namedItem('signatureUrl');
        if (hidden) hidden.value = url;
        show(notice, 'Signature uploaded successfully!');
        setTimeout(()=> hide(notice), 2000);
      }catch(err){
        show(errorBox, 'Signature upload failed: ' + err.message); 
        setTimeout(()=> hide(errorBox), 4000);
      }
    });

    // SAVE & CONTINUE FUNCTIONALITY
    btnSaveContinue.addEventListener('click', async ()=>{
      const btn = btnSaveContinue;
      btn.disabled = true; 
      btn.textContent = 'Saving…';

      hide(errorBox); 
      hide(notice);

      try{
        const body = {};
        Array.from(form.elements).forEach(el=>{
          if (!el.name || el.type === 'file') return;
          
          // Map phoneNumber to phone for backend consistency
          if (el.name === 'phoneNumber') {
            body['phone'] = (el.value || '').trim();
          } else {
            body[el.name] = (el.value || '').trim();
          }
        });

        // Save profile data - use the correct endpoint
        let res = await authFetch('/api/member/profile', {
          method:'PATCH',
          body: JSON.stringify(body)
        });

        const data = await res.json().catch(()=> ({}));

        if (!res.ok) {
          throw new Error(data?.message || 'Save failed: ' + res.status);
        }

        // Success - clear draft and redirect to dashboard
        window.clearDraft();
        show(notice, 'Profile saved successfully!');
        setTimeout(()=>{
          window.location.href = '/member/dashboard.php';
        }, 1000);
      }catch(err){
        show(errorBox, err.message); 
        btn.disabled = false; 
        btn.textContent = 'Save & Continue';
      }
    });

    // SUBMIT PROFILE FUNCTIONALITY
    btnSubmitAll.addEventListener('click', async ()=>{
      const btn = btnSubmitAll;
      btn.disabled = true; 
      btn.textContent = 'Submitting…';

      hide(errorBox); 
      hide(notice);

      try{
        // First save all form data
        const body = {};
        Array.from(form.elements).forEach(el=>{
          if (!el.name || el.type === 'file') return;
          
          // Map phoneNumber to phone for backend consistency
          if (el.name === 'phoneNumber') {
            body['phone'] = (el.value || '').trim();
          } else {
            body[el.name] = (el.value || '').trim();
          }
        });

        // Add profile completed flag
        body.profileCompleted = true;

        // Save profile data - use the correct endpoint
        let res = await authFetch('/api/member/profile', {
          method:'PATCH',
          body: JSON.stringify(body)
        });

        const data = await res.json().catch(()=> ({}));

        if (!res.ok) {
          throw new Error(data?.message || 'Submit failed: ' + res.status);
        }

        // Success
        window.clearDraft();
        show(notice, 'Profile submitted successfully! Redirecting to dashboard…');
        setTimeout(()=>{
          window.location.href = '/member/dashboard.php';
        }, 1000);
      }catch(err){
        show(errorBox, err.message); 
        btn.disabled = false; 
        btn.textContent = 'Submit Profile';
      }
    });
  })();
  </script>

</body>
</html>