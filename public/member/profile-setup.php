<?php /* profile-setup.php — Guided multi-step profile completion
  - GET /api/member/profile   → prefill
  - PATCH /api/member/profile → autosave per section
  - Final submit can also PATCH with { profileCompleted: true }
  - Requires Bootstrap 5 (already in project). Uses jQuery if present; otherwise plain JS.
*/ ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>NARAP — Complete Your Profile</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    :root{ --brand:#0a7f41; --muted:#6b7280; }
    body{ background:#f6f8fa; font-family:Inter, system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial }
    .container-narrow{ max-width:980px }
    .card-setup{ background:#fff; border-radius:18px; box-shadow:0 10px 30px rgba(16,24,40,.08); padding:24px }
    .stepper{ display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px }
    .step{ display:flex; align-items:center; gap:8px; padding:8px 12px; border-radius:12px; background:#eef2f4; color:#111827; font-weight:600; cursor:pointer; user-select:none }
    .step.active{ background:#e6f6ee; color:#065f38; outline:2px solid rgba(10,127,65,.25) }
    .progress{ height:8px; border-radius:999px }
    .form-control, .form-select{ border-radius:12px; padding:.7rem .9rem }
    .actions{ display:flex; gap:12px; justify-content:flex-end }
    .btn-brand{ background:var(--brand); border-color:var(--brand); color:#fff; font-weight:600; padding:.7rem 1rem; border-radius:12px }
    .btn-outline-brand{ border-color:var(--brand); color:var(--brand); font-weight:600; border-radius:12px }
    .section{ display:none }
    .section.active{ display:block }
    .hint{ color:var(--muted); font-size:.95rem }
    .upload-preview{ display:flex; align-items:center; justify-content:center; border:1px dashed #cfd8dc; border-radius:12px; background:#fafafa; width:100%; height:180px; overflow:hidden }
    .upload-preview img{ max-width:100%; max-height:100%; object-fit:contain }
    @media (max-width: 576px){ .upload-preview{ height:140px } }
  </style>
</head>
<body>
  <div class="py-4">
    <div class="container container-narrow">
      <div class="mb-3">
        <h2 class="fw-bold mb-1">Complete your profile</h2>
        <div class="hint">Provide your personal, contact and professional information. You can save progress and finish later.</div>
      </div>

      <div class="card-setup mb-3">
        <!-- Stepper -->
        <div class="stepper" id="stepper">
          <div class="step active" data-step="personal">1. Personal</div>
          <div class="step" data-step="contact">2. Contact</div>
          <div class="step" data-step="professional">3. Professional</div>
          <div class="step" data-step="documents">4. Documents</div>
        </div>
        <div class="progress mb-3">
          <div class="progress-bar" id="progressBar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

        <!-- Sections -->
        <form id="profileForm">
          <!-- PERSONAL -->
          <section class="section active" id="section-personal">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" name="firstName" required />
              </div>
              <div class="col-md-6">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lastName" required />
              </div>
              <div class="col-md-6">
                <label class="form-label">Date of Birth</label>
                <input type="date" class="form-control" name="dob" />
              </div>
              <div class="col-md-6">
                <label class="form-label">Gender</label>
                <select class="form-select" name="gender">
                  <option value="" selected disabled>Select</option>
                  <option>Male</option><option>Female</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Marital Status</label>
                <select class="form-select" name="maritalStatus">
                  <option value="" selected disabled>Select</option>
                  <option>Single</option><option>Married</option>
                </select>
              </div>
            </div>
          </section>

          <!-- CONTACT -->
          <section class="section" id="section-contact">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Mobile Number</label>
                <input type="tel" class="form-control" name="phone" placeholder="e.g., 0803 000 0000" />
              </div>
              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="you@example.com" />
              </div>
              <div class="col-12">
                <label class="form-label">Residential Address</label>
                <input type="text" class="form-control" name="address" />
              </div>
              <div class="col-md-6">
                <label class="form-label">State</label>
                <select class="form-select" name="state">
                  <option value="" disabled selected>Select State</option>
                  <option>Abia</option><option>Adamawa</option><option>Akwa Ibom</option><option>Anambra</option>
                  <option>Bauchi</option><option>Bayelsa</option><option>Benue</option><option>Borno</option>
                  <option>Cross River</option><option>Delta</option><option>Ebonyi</option><option>Edo</option>
                  <option>Ekiti</option><option>Enugu</option><option>FCT</option><option>Gombe</option>
                  <option>Imo</option><option>Jigawa</option><option>Kaduna</option><option>Kano</option>
                  <option>Katsina</option><option>Kebbi</option><option>Kogi</option><option>Kwara</option>
                  <option>Lagos</option><option>Nasarawa</option><option>Niger</option><option>Ogun</option>
                  <option>Ondo</option><option>Osun</option><option>Oyo</option><option>Plateau</option>
                  <option>Rivers</option><option>Sokoto</option><option>Taraba</option><option>Yobe</option>
                  <option>Zamfara</option>
                </select>
              </div>
            </div>
          </section>

          <!-- PROFESSIONAL -->
          <section class="section" id="section-professional">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Occupation</label>
                <input type="text" class="form-control" name="occupation" />
              </div>
              <div class="col-md-6">
                <label class="form-label">Next of Kin</label>
                <input type="text" class="form-control" name="nok" />
              </div>
              <div class="col-md-6">
                <label class="form-label">Guarantor (must be a practitioner)</label>
                <input type="text" class="form-control" name="guarantor" />
              </div>
              <div class="col-md-6">
                <label class="form-label">Guarantor's Address</label>
                <input type="text" class="form-control" name="guarantorAddress" />
              </div>
              <div class="col-md-6">
                <label class="form-label">Guarantor's Position</label>
                <select class="form-select" name="guarantorPosition">
                  <option value="" selected disabled>Select Position</option>
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
                  <option>Public Relation Officer</option>
                  <option>Assistant PRO (APRO)</option>
                  <option>Welfare</option>
                  <option>State Welfare Coordinator</option>
                  <option>Member</option>
                  <option>Task Force</option>
                  <option>Provost Marshal 1</option>
                  <option>Provost Marshal 2</option>
                  <option>State Secretary</option>
                  <option>State Assistant Secretary</option>
                  <option>State Financial Secretary</option>
                  <option>State Treasurer</option>
                  <option>Chairman</option>
                  <option>Coordinator</option>
                  <option>Assistant Coordinator</option>
                </select>
              </div>
            </div>
          </section>

          <!-- DOCUMENTS -->
          <section class="section" id="section-documents">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Passport Photograph (JPG/PNG)</label>
                <div class="upload-preview" id="passportPreview"><span class="hint">No file chosen</span></div>
                <input class="form-control mt-2" type="file" name="passport" id="passport" accept="image/*" />
              </div>
              <div class="col-md-6">
                <label class="form-label">Signature (JPG/PNG)</label>
                <div class="upload-preview" id="signaturePreview"><span class="hint">No file chosen</span></div>
                <input class="form-control mt-2" type="file" name="signature" id="signature" accept="image/*" />
              </div>
            </div>
            <div class="hint mt-2">Images are centered and scaled to fit. You can replace them anytime before submitting.</div>
          </section>

          <div class="mt-4 actions">
            <button type="button" class="btn btn-outline-brand" id="btnFinishLater">Finish Later</button>
            <button type="button" class="btn btn-brand" id="btnNext">Save &amp; Continue</button>
            <button type="button" class="btn btn-brand d-none" id="btnSubmitAll">Submit Profile</button>
          </div>
        </form>

        <div id="saveMsg" class="mt-3"></div>
      </div>
    </div>
  </div>

  <script>
    (function(){
      const steps = ['personal','contact','professional','documents'];
      let current = 0;
      const form = document.getElementById('profileForm');
      const progressBar = document.getElementById('progressBar');
      const stepper = document.getElementById('stepper');
      const saveMsg = document.getElementById('saveMsg');
      const btnNext = document.getElementById('btnNext');
      const btnSubmitAll = document.getElementById('btnSubmitAll');
      const btnFinishLater = document.getElementById('btnFinishLater');

      function showStep(i){
        current = Math.max(0, Math.min(i, steps.length-1));
        steps.forEach((key, idx)=>{
          document.getElementById('section-'+key).classList.toggle('active', idx===current);
          const node = stepper.querySelector('[data-step="'+key+'"]');
          node.classList.toggle('active', idx===current);
        });
        const pct = Math.round(((current) / (steps.length-1)) * 100);
        progressBar.style.width = pct+'%'; progressBar.setAttribute('aria-valuenow', pct);
        btnNext.classList.toggle('d-none', current === steps.length-1);
        btnSubmitAll.classList.toggle('d-none', current !== steps.length-1);
      }

      stepper.querySelectorAll('.step').forEach(el=>{
        el.addEventListener('click', ()=>{ showStep(steps.indexOf(el.dataset.step)); });
      });

      function serializeSection(key){
        const sec = document.getElementById('section-'+key);
        const fd = new FormData();
        // collect only inputs inside this section
        sec.querySelectorAll('input, select, textarea').forEach(el=>{
          if (el.type === 'file') return; // handled separately
          if (el.name) fd.append(el.name, el.value);
        });
        fd.append('section', key);
        return fd;
      }

      async function patch(url, body){
        const res = await fetch(url, { method:'PATCH', body });
        const data = await res.json().catch(()=>({}));
        if (!res.ok) throw new Error(data.message||'Save failed');
        return data;
      }

      let saveTimer=null;
      function autosave(key){
        clearTimeout(saveTimer);
        saveTimer=setTimeout(async()=>{
          try{
            const fd = serializeSection(key);
            await patch('/api/member/profile', fd);
            saveMsg.innerHTML = '<div class="alert alert-success py-2 mb-0">Saved.</div>';
            setTimeout(()=> saveMsg.innerHTML='', 1200);
          }catch(err){ saveMsg.innerHTML = '<div class="alert alert-danger py-2">'+(err.message||'Save failed')+'</div>'; }
        }, 500);
      }

      // Hook change/blur on inputs for autosave
      steps.forEach(key=>{
        const sec = document.getElementById('section-'+key);
        sec.addEventListener('input', ()=> autosave(key));
        sec.addEventListener('change', ()=> autosave(key));
      });

      // Uploads with preview
      function bindUpload(inputId, previewId, field){
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        input.addEventListener('change', async ()=>{
          const file = input.files && input.files[0];
          if (!file) return;
          // preview
          const url = URL.createObjectURL(file);
          preview.innerHTML = '<img alt="preview" />';
          preview.querySelector('img').src = url;
          // upload
          try{
            const fd = new FormData();
            fd.append('section','documents');
            fd.append(field, file);
            await patch('/api/member/profile', fd);
            saveMsg.innerHTML = '<div class="alert alert-success py-2 mb-0">'+ field.charAt(0).toUpperCase()+field.slice(1)+' uploaded.</div>';
            setTimeout(()=> saveMsg.innerHTML='', 1200);
          }catch(err){ saveMsg.innerHTML = '<div class="alert alert-danger py-2">'+(err.message||'Upload failed')+'</div>'; }
        });
      }
      bindUpload('passport','passportPreview','passport');
      bindUpload('signature','signaturePreview','signature');

      // Navigation buttons
      btnNext.addEventListener('click', async ()=>{
        const key = steps[current];
        try{ await patch('/api/member/profile', serializeSection(key)); showStep(current+1); }
        catch(err){ saveMsg.innerHTML = '<div class="alert alert-danger">'+(err.message||'Save failed')+'</div>'; }
      });
      btnSubmitAll.addEventListener('click', async ()=>{
        try{
          const fd = new FormData(); fd.append('profileCompleted', 'true');
          await patch('/api/member/profile', fd);
          saveMsg.innerHTML = '<div class="alert alert-success">Profile submitted. Redirecting to your dashboard…</div>';
          setTimeout(()=>{ window.location.href = '/member/dashboard.php'; }, 800);
        }catch(err){ saveMsg.innerHTML = '<div class="alert alert-danger">'+(err.message||'Submit failed')+'</div>'; }
      });
      btnFinishLater.addEventListener('click', ()=>{ window.location.href = '/member/dashboard.php'; });

      // Prefill
      async function prefill(){
        try{
          const res = await fetch('/api/member/profile');
          const data = await res.json();
          if (data && typeof data === 'object'){
            Object.entries(data).forEach(([k,v])=>{
              const el = form.querySelector('[name="'+k+'"]');
              if (el) el.value = v == null ? '' : v;
              if (k==='passportUrl' && v){
                const prev=document.getElementById('passportPreview'); prev.innerHTML='<img alt="passport" src="'+v+'" />';
              }
              if (k==='signatureUrl' && v){
                const prev=document.getElementById('signaturePreview'); prev.innerHTML='<img alt="signature" src="'+v+'" />';
              }
            });
          }
        }catch(_){}
      }
      prefill();

      showStep(0);
    })();
  </script>
</body>
</html>
