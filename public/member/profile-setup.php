<?php
// profile-setup.php
// Client-side protected profile setup page for members.
// Assumes API endpoints:
//   - POST /api/upload?folder=passports|signatures  (auth: Bearer JWT)
//   - GET  /api/members/me                          (auth: Bearer JWT)
//   - PATCH /api/members/me                         (auth: Bearer JWT)  [fallback to PATCH /api/members/:id]
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>NARAP — Profile Setup</title>
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
      background:var(--surface); border-radius:16px; padding:20px;
      box-shadow:0 8px 24px rgba(2,6,23,.06);
      border:1px solid #e5efe9;
    }
    .grid{display:grid; grid-template-columns:1fr 1fr; gap:16px}
    .grid-3{display:grid; grid-template-columns:repeat(3,1fr); gap:16px}
    @media (max-width: 860px){
      .grid,.grid-3{grid-template-columns:1fr}
    }
    label{display:block; font-weight:600; margin:10px 0 6px}
    input[type="text"], input[type="email"], textarea, select{
      width:100%; padding:12px 12px; border:1px solid #dbe7e0; border-radius:12px;
      background:#fff; color:var(--ink); outline:none;
      transition:border-color .15s ease, box-shadow .15s ease;
    }
    input[type="text"]:focus, input[type="email"]:focus, textarea:focus, select:focus{
      border-color:var(--brand); box-shadow:var(--ring);
    }
    textarea{min-height:90px; resize:vertical}
    .muted{color:var(--muted); font-size:.92rem}
    .row{display:flex; gap:12px; align-items:center; flex-wrap:wrap}
    .btn{
      appearance:none; border:0; border-radius:12px; padding:12px 16px; font-weight:700;
      cursor:pointer; background:var(--brand); color:#fff; box-shadow:0 6px 16px rgba(10,127,65,.2);
      transition: transform .06s ease, box-shadow .15s ease, opacity .2s;
    }
    .btn.secondary{background:#eef7f1; color:var(--brand); font-weight:700}
    .btn:active{transform:translateY(1px)}
    .btn[disabled]{opacity:.6; cursor:not-allowed}
    .actions{display:flex; gap:12px; justify-content:flex-end; margin-top:12px}
    .section-title{font-size:1.1rem; font-weight:800; margin:6px 0 14px}
    .help{font-size:.9rem; color:var(--muted)}
    .info{background:#eef7f1; color:#064e2d; padding:8px 12px; border-radius:10px; border:1px solid #d1ecda}
    .error{background:#fef2f2; color:#991b1b; padding:8px 12px; border-radius:10px; border:1px solid #ffe1e1}
    /* Upload + preview */
    .upload-wrap{display:grid; grid-template-columns:1fr 1fr; gap:16px}
    @media (max-width: 680px){
      .upload-wrap{grid-template-columns:1fr}
    }
    .preview-card{
      border:1px dashed #cfe3d7; border-radius:14px; padding:14px;
      display:flex; flex-direction:column; gap:10px; align-items:center; justify-content:center;
      min-height:230px; background:#fff;
    }
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
      background:#eef7f1; color:var(--brand); padding:10px 14px; border-radius:10px; font-weight:700;
      border:1px solid #cfe3d7; cursor:pointer;
    }
    .file-upload-label:hover{filter:brightness(.98)}
    .hidden{display:none}
    footer{margin:24px 0; text-align:center; color:var(--muted); font-size:.9rem}
  </style>
</head>
<body>
  <header>
    <div class="title">NARAP — Profile Setup</div>
    <div class="status" id="authStatus">Checking authentication…</div>
  </header>

  <main>
    <div id="notice" class="info hidden"></div>
    <div id="error" class="error hidden"></div>

    <div class="card">
      <div class="section-title">Basic Information</div>
      <form id="profileForm" onsubmit="submitProfile(event)">
        <div class="grid">
          <div>
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="e.g., Aisha Bello" required />
          </div>
          <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="you@example.com" required />
          </div>
        </div>

        <div class="grid">
          <div>
            <label for="phoneNumber">Phone Number</label>
            <input type="text" id="phoneNumber" name="phoneNumber" placeholder="+234…" required />
          </div>
          <div>
            <label for="state">State</label>
            <input type="text" id="state" name="state" placeholder="State of residence" required />
          </div>
        </div>

        <div class="grid">
          <div>
            <label for="lga">LGA</label>
            <input type="text" id="lga" name="lga" placeholder="Local Government Area" />
          </div>
          <div>
            <label for="zone">Zone</label>
            <input type="text" id="zone" name="zone" placeholder="e.g., North Central" />
          </div>
        </div>

        <div>
          <label for="address">Address</label>
          <input type="text" id="address" name="address" placeholder="Street, city" />
        </div>

        <div class="section-title" style="margin-top:18px">Passport &amp; Signature</div>
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
          <button type="button" class="btn secondary" onclick="finishLater()">Finish later</button>
          <button type="submit" class="btn" id="submitBtn">Save &amp; Continue</button>
        </div>
      </form>
    </div>

    <footer>Tip: If you leave, your progress is auto-saved on this device.</footer>
  </main>

  <script>
  // Simple authentication check for profile-setup.php
  (function(){
    const statusEl = document.getElementById('authStatus');
    const token = localStorage.getItem('jwt');
    
    if (!token) {
      statusEl.textContent = 'Not authenticated. Redirecting…';
      setTimeout(() => { 
        window.location.replace('/member/login.php'); 
      }, 400);
      return;
    }
    
    statusEl.textContent = 'Authenticated ✓';
    
    // Optional: Verify token is still valid with server
    fetch('/api/auth/me', {
      headers: { 'Authorization': 'Bearer ' + token }
    }).then(res => {
      if (!res.ok) {
        throw new Error('Token invalid');
      }
    }).catch(err => {
      statusEl.textContent = 'Session expired. Redirecting…';
      setTimeout(() => { 
        window.location.replace('/member/login.php'); 
      }, 400);
    });
  })();
  </script>

  <script>
  // ===== Utilities & Draft Autosave =====
  (function(){
    const FORM_ID = 'profileForm';
    const DRAFT_KEY = 'profileDraft.v1';
    const form = document.getElementById(FORM_ID);
    const notice = document.getElementById('notice');
    const errorBox = document.getElementById('error');

    const show = (el, msg) => { el.textContent = msg; el.classList.remove('hidden'); };
    const hide = (el) => { el.classList.add('hidden'); };

    // Restore draft (if any)
    try{
      const draft = localStorage.getItem(DRAFT_KEY);
      if (draft && form) {
        const data = JSON.parse(draft);
        Object.keys(data).forEach(k => {
          const el = form.elements.namedItem(k);
          if (el && el.type !== 'file') el.value = data[k];
        });
        show(notice, 'Draft restored — you can continue where you left off.');
        setTimeout(()=> hide(notice), 2500);
      }
    }catch(e){ /* ignore */ }

    // Auto-save any change
    form?.addEventListener('input', () => {
      const payload = {};
      Array.from(form.elements).forEach(el => {
        if (!el.name || el.type === 'file') return;
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
        { },
        token ? { 'Authorization': 'Bearer ' + token } : {},
        opts.headers || {}
      );
      return fetch(url, Object.assign({}, opts, { headers, credentials: 'include' }));
    };

    // Upload + preview helpers
    function preview(input, imgSel){
      const img = document.querySelector(imgSel);
      if (!img || !input.files?.[0]) return;
      img.src = URL.createObjectURL(input.files[0]); // requires CSP img-src to allow blob:
    }

    async function uploadFile(file, folder){
      const fd = new FormData(); fd.append('file', file);
      const res = await authFetch('/api/upload?folder='+encodeURIComponent(folder), { method:'POST', body: fd });
      const data = await res.json().catch(()=> ({}));
      if (!res.ok) throw new Error(data?.message || 'Upload failed');
      return data.url; // { url: "https://..." }
    }

    // Wire file inputs
    const passportInput = document.getElementById('passport');
    passportInput?.addEventListener('change', async (e)=>{
      preview(e.target, '.passport-preview');
      try{
        const url = await uploadFile(e.target.files[0], 'passports');
        const hidden = form.elements.namedItem('passportUrl');
        if (hidden) hidden.value = url;
      }catch(err){
        show(errorBox, err.message); setTimeout(()=> hide(errorBox), 2600);
      }
    });

    const signatureInput = document.getElementById('signature');
    signatureInput?.addEventListener('change', async (e)=>{
      preview(e.target, '.signature-preview');
      try{
        const url = await uploadFile(e.target.files[0], 'signatures');
        const hidden = form.elements.namedItem('signatureUrl');
        if (hidden) hidden.value = url;
      }catch(err){
        show(errorBox, err.message); setTimeout(()=> hide(errorBox), 2600);
      }
    });

    // Submit profile
    window.submitProfile = async function(ev){
      ev.preventDefault();
      const btn = document.getElementById('submitBtn');
      btn.disabled = true; btn.textContent = 'Saving…';

      hide(errorBox); hide(notice);

      const body = {};
      Array.from(form.elements).forEach(el=>{
        if (!el.name || el.type === 'file') return;
        body[el.name] = (el.value || '').trim();
      });

      // PATCH /api/members/me, fallback to /api/members/:id
      let res = await authFetch('/api/members/me', {
        method:'PATCH',
        headers:{ 'Content-Type':'application/json' },
        body: JSON.stringify(body)
      });

      if (res.status === 404) {
        // fallback: find my id then PATCH /api/members/:id
        const meRes = await authFetch('/api/members/me');
        if (meRes.ok) {
          const me = await meRes.json();
          res = await authFetch('/api/members/' + (me?._id || ''), {
            method:'PATCH',
            headers:{ 'Content-Type':'application/json' },
            body: JSON.stringify(body)
          });
        }
      }

      const data = await res.json().catch(()=> ({}));

      if (!res.ok) {
        show(errorBox, data?.message || 'Submit failed');
        btn.disabled = false; btn.textContent = 'Save & Continue';
        return;
      }

      // Success
      window.clearDraft();
      show(notice, 'Profile saved successfully.');
      setTimeout(()=>{
        window.location.href = '/member/dashboard.php';
      }, 700);
    };
  })();
  </script>

</body>
</html>