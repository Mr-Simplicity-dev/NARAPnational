<?php
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
?>

<!DOCTYPE html>
<html>
<head>
<!-- Basic Meta Tags -->
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>NARAP – Agro Supply, Construction, ICT, Procurement, Oil &amp; Gas, and Mining Solutions</title>
<meta content="NARAP is a powerhouse company delivering high-quality solutions in agriculture, construction, ICT, procurement, oil &amp; gas, and mining. We empower businesses with reliable services and innovative strategies for sustainable growth." name="description"/>
<meta content="Time360 Farms, mytime360, mytime, farms, song, yola, Nigeria, dumne agriculture, agro supply, agriculture, construction, ICT, procurement, oil and gas, mining, sustainable solutions, business services Nigeria" name="keywords"/>
<!-- Open Graph (for social sharing) -->
<meta content="Time360 Farms– Agro Supply, Construction, ICT, Procurement, Oil &amp; Gas, and Mining Solutions" property="og:title"/>
<meta content="A powerhouse company offering expert solutions in agriculture, construction, ICT, procurement, oil &amp; gas, and mining. Trusted for sustainable growth." property="og:description"/>
<meta content="https://mytime360.com" property="og:url"/>
<meta content="website" property="og:type"/>
<meta content="https://mytime360.com/uploads/times.jpg" property="og:image"/>
<!-- Twitter Card -->
<meta content="summary_large_image" name="twitter:card"/>
<meta content="NARAP – Agro Supply, Construction, ICT, Procurement, Oil &amp; Gas, and Mining Solutions" name="twitter:title"/>
<meta content="Delivering high-quality solutions in agriculture, construction, ICT, procurement, oil &amp; gas, and mining for sustainable growth." name="twitter:description"/>
<meta content="https://mytime360.com/uploads/times.jpg" name="twitter:image"/>
<!-- Google Web Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&amp;family=Roboto:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
<meta content="ca-pub-8202473052675329" name="google-adsense-account"/>
<!-- Icon Font Stylesheet -->
<link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet"/>
<!-- Libraries Stylesheet -->
<link href="lib/animate/animate.min.css" rel="stylesheet">
<link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet"/>
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet"/>
<!-- owrul Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
<!-- Customized Bootstrap Stylesheet -->
<link href="css/bootstrap.min.css" rel="stylesheet"/>
<!-- Template Stylesheet -->
<link href="css/style.css" rel="stylesheet"/>
<!-- google adsense -->
<script async="" crossorigin="anonymous" src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8202473052675329"></script>

</link></link></link></link></link></link><link crossorigin="" href="https://use.fontawesome.com" rel="preconnect"/>
</head>
<body>
<div class="container" style="max-width:1200px;margin:40px auto;padding:20px;">
<h2 style="margin-bottom:10px;">Admin Dashboard</h2>
<div id="status" style="margin-bottom:20px;color:#888;font-size:14px;"></div>
<nav style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:20px;">
<button class="btn" data-tab="sliders">Sliders</button>
<button class="btn" data-tab="services">Services</button>
<button class="btn" data-tab="products">Products</button>
<button class="btn" data-tab="portfolio">Portfolio</button>
<button class="btn" data-tab="team">Team</button>
<button class="btn" data-tab="blogs">Blogs</button>
<button class="btn" data-tab="faqs">FAQs</button>
<button class="btn" data-tab="offers">Offers</button>
<button class="btn" data-tab="features">Features</button>
<!-- In your dashboard.php -->
<button class="btn" data-tab="paid">Paid Members</button>
<button class="btn" data-tab="registrations">Registrations</button>


<button class="btn" data-logout="true" style="margin-left:auto;">Logout</button>
</nav>
<section class="tab" id="tab-sliders">
  <div class="alert alert-info" data-example="sliders" style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin:10px 0;">
    <div><strong>Illustration:</strong> Add/edit items here; visitors will see them on the homepage.</div>
    <div class="btn-group">
      <button class="btn btn-sm" data-seed="sliders">Insert sample</button>
      <button class="btn btn-sm" data-clear="sliders">Clear sliders</button>
      <a class="btn btn-sm" href="/" target="_blank" rel="noopener">Open homepage</a>
    </div>
  </div>
<h4>Sliders</h4>
<form class="card" onsubmit="return createItem(event,'sliders');">
<input class="form-control" name="imageUrl" placeholder="Image URL (/admin/uploads/slider/..)"/>
<input class="form-control" name="smallTitle" placeholder="Small Title"/>
<input class="form-control" name="bigTitle" placeholder="Big Title"/>
<input class="form-control" name="paragraph" placeholder="Paragraph"/>
<input class="form-control" name="primaryBtnText" placeholder="Primary Button Text"/>
<input class="form-control" name="primaryBtnLink" placeholder="Primary Button Link"/>
<input class="form-control" name="secondaryBtnText" placeholder="Secondary Button Text"/>
<input class="form-control" name="secondaryBtnLink" placeholder="Secondary Button Link"/>
<button class="btn">Create</button>
</form>
<div data-list="sliders"></div>
</section>
<section class="tab" id="tab-services" style="display:none">
  <div class="alert alert-info" data-example="services" style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin:10px 0;">
    <div><strong>Illustration:</strong> Add/edit items here; visitors will see them on the homepage.</div>
    <div class="btn-group">
      <button class="btn btn-sm" data-seed="services">Insert sample</button>
      <button class="btn btn-sm" data-clear="services">Clear services</button>
      <a class="btn btn-sm" href="/" target="_blank" rel="noopener">Open homepage</a>
    </div>
  </div>
<h4>Services</h4>
<form class="card" onsubmit="return createItem(event,'services');">
<input class="form-control" name="title" placeholder="Title"/>
<textarea class="form-control" name="description" placeholder="Description"></textarea>
<input class="form-control" name="imageUrl" placeholder="Image URL (/admin/uploads/services/...)"/>
<button class="btn">Create</button>
</form>
<div data-list="services"></div>
</section>
<section class="tab" id="tab-products" style="display:none">
  <div class="alert alert-info" data-example="products" style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin:10px 0;">
    <div><strong>Illustration:</strong> Add/edit items here; visitors will see them on the homepage.</div>
    <div class="btn-group">
      <button class="btn btn-sm" data-seed="products">Insert sample</button>
      <button class="btn btn-sm" data-clear="products">Clear products</button>
      <a class="btn btn-sm" href="/" target="_blank" rel="noopener">Open homepage</a>
    </div>
  </div>
<h4>Products</h4>
<form class="card" onsubmit="return createItem(event,'products');">
<input class="form-control" name="title" placeholder="Title"/>
<textarea class="form-control" name="description" placeholder="Description"></textarea>
<input class="form-control" name="price" placeholder="Price (optional)" step="0.01" type="number"/>
<input class="form-control" name="imageUrl" placeholder="Image URL (/admin/uploads/products/...)"/>
<button class="btn">Create</button>
</form>
<div data-list="products"></div>
</section>
<section class="tab" id="tab-portfolio" style="display:none">
  <div class="alert alert-info" data-example="portfolio" style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin:10px 0;">
    <div><strong>Illustration:</strong> Add/edit items here; visitors will see them on the homepage.</div>
    <div class="btn-group">
      <button class="btn btn-sm" data-seed="portfolio">Insert sample</button>
      <button class="btn btn-sm" data-clear="portfolio">Clear portfolio</button>
      <a class="btn btn-sm" href="/" target="_blank" rel="noopener">Open homepage</a>
    </div>
  </div>
<h4>Portfolio</h4>
<form class="card" onsubmit="return createItem(event,'portfolio');">
<input class="form-control" name="title" placeholder="Title"/>
<input class="form-control" name="category" placeholder="Category (e.g., web)"/>
<textarea class="form-control" name="description" placeholder="Description"></textarea>
<input class="form-control" name="imageUrl" placeholder="Image URL (/admin/uploads/portfolio/...)"/>
<button class="btn">Create</button>
</form>
<div data-list="portfolio"></div>
</section>
<section class="tab" id="tab-team" style="display:none">
  <div class="alert alert-info" data-example="team" style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin:10px 0;">
    <div><strong>Illustration:</strong> Add/edit items here; visitors will see them on the homepage.</div>
    <div class="btn-group">
      <button class="btn btn-sm" data-seed="team">Insert sample</button>
      <button class="btn btn-sm" data-clear="team">Clear team</button>
      <a class="btn btn-sm" href="/" target="_blank" rel="noopener">Open homepage</a>
    </div>
  </div>
<h4>Team</h4>
<form class="card" onsubmit="return createItem(event,'team');">
<input class="form-control" name="name" placeholder="Name"/>
<input class="form-control" name="role" placeholder="Role"/>
<input class="form-control" name="imageUrl" placeholder="Image URL (/admin/uploads/team/...)"/>
<button class="btn">Create</button>
</form>
<div data-list="team"></div>
</section>
<section class="tab" id="tab-blogs" style="display:none">
  <div class="alert alert-info" data-example="blogs" style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin:10px 0;">
    <div><strong>Illustration:</strong> Add/edit items here; visitors will see them on the homepage.</div>
    <div class="btn-group">
      <button class="btn btn-sm" data-seed="blogs">Insert sample</button>
      <button class="btn btn-sm" data-clear="blogs">Clear blogs</button>
      <a class="btn btn-sm" href="/" target="_blank" rel="noopener">Open homepage</a>
    </div>
  </div>
<h4>Blogs</h4>
<form class="card" onsubmit="return createItem(event,'blogs');">
<input class="form-control" name="title" placeholder="Title"/>
<input class="form-control" name="slug" placeholder="Slug (unique)"/>
<input class="form-control" name="excerpt" placeholder="Excerpt"/>
<textarea class="form-control" name="content" placeholder="HTML content"></textarea>
<input class="form-control" name="imageUrl" placeholder="Image URL (/admin/uploads/blogs/...)"/>
<button class="btn">Create</button>
</form>
<div data-list="blogs"></div>
</section>
<section class="tab" id="tab-faqs" style="display:none">
  <div class="alert alert-info" data-example="faqs" style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin:10px 0;">
    <div><strong>Illustration:</strong> Add/edit items here; visitors will see them on the homepage.</div>
    <div class="btn-group">
      <button class="btn btn-sm" data-seed="faqs">Insert sample</button>
      <button class="btn btn-sm" data-clear="faqs">Clear faqs</button>
      <a class="btn btn-sm" href="/" target="_blank" rel="noopener">Open homepage</a>
    </div>
  </div>
<h4>FAQs</h4>
<form class="card" onsubmit="return createItem(event,'faqs');">
<input class="form-control" name="question" placeholder="Question"/>
<textarea class="form-control" name="answer" placeholder="Answer"></textarea>
<button class="btn">Create</button>
</form>
<div data-list="faqs"></div>
</section>
<section class="tab" id="tab-offers" style="display:none">
  <div class="alert alert-info" data-example="offers" style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin:10px 0;">
    <div><strong>Illustration:</strong> Add/edit items here; visitors will see them on the homepage.</div>
    <div class="btn-group">
      <button class="btn btn-sm" data-seed="offers">Insert sample</button>
      <button class="btn btn-sm" data-clear="offers">Clear offers</button>
      <a class="btn btn-sm" href="/" target="_blank" rel="noopener">Open homepage</a>
    </div>
  </div>
<h4>Offers</h4>
<form class="card" onsubmit="return createItem(event,'offers');">
<input class="form-control" name="title" placeholder="Title"/>
<textarea class="form-control" name="description" placeholder="Description"></textarea>
<input class="form-control" name="imageUrl" placeholder="Image URL (/admin/uploads/offer/...)"/>
<button class="btn">Create</button>
</form>
<div data-list="offers"></div>
</section>
<section class="tab" id="tab-features" style="display:none">
  <div class="alert alert-info" data-example="features" style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin:10px 0;">
    <div><strong>Illustration:</strong> Add/edit items here; visitors will see them on the homepage.</div>
    <div class="btn-group">
      <button class="btn btn-sm" data-seed="features">Insert sample</button>
      <button class="btn btn-sm" data-clear="features">Clear features</button>
      <a class="btn btn-sm" href="/" target="_blank" rel="noopener">Open homepage</a>
    </div>
  </div>
<h4>Features</h4>
<form class="card" onsubmit="return createItem(event,'features');">
<input class="form-control" name="title" placeholder="Title"/>
<input class="form-control" name="subtitle" placeholder="Subtitle"/>
<textarea class="form-control" name="description" placeholder="Description"></textarea>
<input class="form-control" name="icon" placeholder="Icon class (optional)"/>
<button class="btn">Create</button>
</form>
<div data-list="features"></div>
</section>
<hr style="margin:30px 0"/>
<section>
<h4>Uploader</h4>
<div class="card">
<input id="upload-file" type="file"/>
<input id="upload-folder" placeholder="folder (blogs|services|products|portfolio|team|sections|offer|slider|about|features)"/>
<button class="btn" onclick="doUpload()">Upload</button>
<div class="small" id="upload-result" style="margin-top:10px;color:#555"></div>
</div>
</section>

<section class="tab" id="tab-paid" style="display:none">
  <h4>Paid Members</h4>
  <div class="card">
    <div id="paidMsg" class="mb-2" style="color:#6b7280;"></div>
    <div class="table-responsive">
      <table class="table table-striped" id="paidTable">
        <thead><tr>
          <th>Name</th><th>Member Code</th><th>Phone</th><th>Email</th><th>State</th><th>Joined</th>
        </tr></thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</section>

<section class="tab" id="tab-registrations" style="display:none">
  <h4>Registrations (All submitted forms)</h4>
  <div class="card">
    <div id="regMsg" class="mb-2" style="color:#6b7280;"></div>
    <div class="table-responsive">
      <table class="table table-bordered" id="regTable">
        <thead><tr><th>Name</th><th>Gender</th><th>Phone</th><th>Email</th><th>State</th><th>State Code</th><th>LGA</th><th>Address</th><th>Created</th><th>View</th></tr></thead>
        <tbody></tbody>
      </table>
    </div>
    <p class="text-muted mt-2">Passwords are masked for security; use "Reset password" when necessary.</p>
  </div>
</section>





<script>
(function(){
  function fmtDate(s){ try{ return new Date(s).toLocaleString(); }catch(_){ return s||''; } }
  function text(x){ return (x==null?'':String(x)); }
  function safeName(u){ return text(u?.name || (u?.firstName? (u.firstName+' '+(u.lastName||'')) : '')); }

  async function fetchJSON(url){
    const token = localStorage.getItem('jwt') || localStorage.getItem('token') || '';
    const res = await fetch(url, { headers: token ? { 'Authorization':'Bearer '+token } : {} });
    if(!res.ok){ throw new Error((await res.text()) || ('HTTP '+res.status)); }
    return res.json();
  }

  async function loadPaid(){
    const msg = document.getElementById('paidMsg');
    const tbody = document.querySelector('#paidTable tbody');
    tbody.innerHTML = '<tr><td colspan="6">Loading…</td></tr>';
    try{
      const data = await fetchJSON('/api/members?status=paid');
      const list = Array.isArray(data) ? data : (data.items || data.data || []);
      if(!list.length){ tbody.innerHTML = '<tr><td colspan="6">No paid members yet.</td></tr>'; return; }
      tbody.innerHTML = '';
      list.forEach(u => {
        const tr = document.createElement('tr');
        tr.innerHTML = '<td>'+safeName(u)+'</td>' +
                       '<td>'+text(u.memberCode||u.code)+'</td>' +
                       '<td>'+text(u.phone||u.phoneNumber)+'</td>' +
                       '<td>'+text(u.email)+'</td>' +
                       '<td>'+text(u.state||u.stateOfResidence||u.stateCode)+'</td>' +
                       '<td>'+fmtDate(u.createdAt||u.joinedAt)+'</td>';
        tbody.appendChild(tr);
      });
      msg.textContent = 'Loaded '+list.length+' paid member(s).';
    }catch(e){
      msg.textContent = 'Failed to load paid members: '+(e.message||e);
    }
  }

  async function loadRegs(){
    const msg = document.getElementById('regMsg');
    const tbody = document.querySelector('#regTable tbody');
    tbody.innerHTML = '<tr><td colspan="6">Loading…</td></tr>';
    try{
      const data = await fetchJSON('/api/registrations');
      const list = Array.isArray(data) ? data : (data.items || data.data || []);
      if(!list.length){ tbody.innerHTML = '<tr><td colspan="6">No registrations found.</td></tr>'; return; }
      tbody.innerHTML = '';
      list.forEach(u => {
        const tr = document.createElement('tr');
        tr.innerHTML = '<td>'+safeName(u)+'</td>' +
                       '<td>'+text(u.phone||u.phoneNumber)+'</td>' +
                       '<td>'+text(u.email)+'</td>' +
                       '<td>'+text(u.state||u.stateOfResidence||u.stateCode)+'</td>' +
                       '<td>'+fmtDate(u.createdAt)+'</td>' +
                       '<td><button class="btn btn-sm" data-view-id="'+(u._id||u.id||'')+'">View</button></td>';
        tbody.appendChild(tr);
      });
      // View handler: show full JSON except password
      tbody.querySelectorAll('button[data-view-id]').forEach(btn => {
        btn.addEventListener('click', () => {
          const id = btn.getAttribute('data-view-id');
          const user = (list.find(x => (x._id||x.id||'')===id)) || {};
          const clone = JSON.parse(JSON.stringify(user));
          Object.keys(clone).forEach(k => {
            const lk = k.toLowerCase();
            if (lk.includes('password') || lk === 'pass' || lk === 'passwd') clone[k] = '[hidden]';
          });
          alert('Registration details:

'+JSON.stringify(clone, null, 2));
        });
      });
      msg.textContent = 'Loaded '+list.length+' registration(s).';
    }catch(e){
      msg.textContent = 'Failed to load registrations: '+(e.message||e);
    }
  }

  // Extend existing showTab (if defined); otherwise provide a basic one
  const prevShowTab = window.showTab;
  window.showTab = function(id){
    if (prevShowTab) prevShowTab(id);
    if (!prevShowTab) {
      document.querySelectorAll('.tab').forEach(s => s.style.display = 'none');
      const el = document.getElementById('tab-'+id) || document.getElementById(id);
      if(el) el.style.display = '';
    }
    if(id==='paid') loadPaid();
    if(id==='registrations') loadRegs();
  };
})();
</script>

<script>
(function(){
  function bindNav(){
    // Tabs
    document.querySelectorAll('nav [data-tab]').forEach(function(btn){
      btn.addEventListener('click', function(ev){
        ev.preventDefault();
        var tab = btn.getAttribute('data-tab');
        if (typeof window.showTab === 'function') {
          window.showTab(tab);
        } else {
          // basic fallback
          document.querySelectorAll('.tab').forEach(function(s){ s.style.display = 'none'; });
          var el = document.getElementById('tab-' + tab) || document.getElementById(tab);
          if (el) el.style.display = '';
        }
      });
    });
    // Logout
    document.querySelectorAll('nav [data-logout]').forEach(function(btn){
      btn.addEventListener('click', function(ev){
        ev.preventDefault();
        if (typeof window.logout === 'function') logout();
      });
    });
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bindNav);
  } else {
    bindNav();
  }
})();
</script>
<script>
(function(){
  function token(){ return localStorage.getItem('jwt') || localStorage.getItem('token') || ''; }
  async function api(url, opts){
    opts = opts || {};
    const headers = Object.assign(
      { 'Accept':'application/json','Content-Type':'application/json' },
      (opts.headers || {}),
      (token() ? { 'Authorization':'Bearer ' + token() } : {})
    );
    const res = await fetch(url, Object.assign({}, opts, { headers }));
    let data = null;
    try { data = await res.json(); } catch(_){}
    if (!res.ok) throw new Error((data && (data.message||data.error)) || ('HTTP '+res.status));
    return data==null?{}:data;
  }

  // Demo samples for illustration
  const DEMO = {
    sliders: [{ smallTitle:'Welcome to NARAP', bigTitle:'Cooling the Nation', paragraph:'Professional refrigeration & AC services across Nigeria.', primaryBtnText:'Join Now', primaryBtnLink:'/admin/register.php' }],
    services: [
      { title:'Installation & Maintenance', description:'Expert setup and servicing of HVAC systems.' },
      { title:'Cold Chain Solutions', description:'Food & pharma cold chain design and support.' }
    ],
    products: [
      { title:'Inverter AC (1.5HP)', description:'Energy-efficient split unit.', price:280000 },
      { title:'Deep Freezer 250L', description:'Reliable storage for cold rooms.', price:350000 }
    ],
    portfolio: [ { title:'Cold Room Build - Abuja' }, { title:'Office HVAC Upgrade - Lagos' } ],
    team: [ { name:'Engr. Adaobi N.', role:'Senior Technician' }, { name:'Umar Faruk', role:'Field Engineer' } ],
    blogs: [ { title:'Reduce Energy Costs with Inverter ACs', excerpt:'Five practical tips for homes & SMEs.', slug:'reduce-energy-costs' } ],
    faqs: [ { question:'Do you offer nationwide service?', answer:'Yes, across all states via NARAP members.' } ],
    offers: [ { title:'Seasonal Maintenance Promo', description:'15% off service plans this month.' } ],
    features: [ { title:'Certified Professionals', description:'Trained, vetted, and insured technicians.' } ]
  };

  async function seedResource(resource){
    const samples = DEMO[resource] || [];
    if (!samples.length) return alert('No demo samples for ' + resource);
    for (const s of samples){
      await api('/api/' + resource, { method:'POST', body: JSON.stringify(s) });
    }
    alert('Inserted ' + samples.length + ' sample ' + resource + ' item(s). Open the homepage to see them.');
    if (window.loadList) try { loadList(resource); } catch(_){}
  }

  async function clearResource(resource){
    if (!confirm('Delete all items in ' + resource + '?')) return;
    const data = await api('/api/' + resource);
    const list = Array.isArray(data) ? data : (data.data || data.items || []);
    for (const it of list){
      const id = it._id || it.id;
      if (!id) continue;
      await api('/api/' + resource + '/' + id, { method:'DELETE' });
    }
    alert('Cleared ' + resource + '.');
    if (window.loadList) try { loadList(resource); } catch(_){}
  }

  function bindDemoButtons(){
    document.querySelectorAll('[data-seed]').forEach(btn => {
      btn.addEventListener('click', (ev) => { ev.preventDefault(); seedResource(btn.getAttribute('data-seed')); });
    });
    document.querySelectorAll('[data-clear]').forEach(btn => {
      btn.addEventListener('click', (ev) => { ev.preventDefault(); clearResource(btn.getAttribute('data-clear')); });
    });
    // Bind nav tabs (CSP-safe)
    document.querySelectorAll('nav [data-tab]').forEach(btn => {
      btn.addEventListener('click', (ev) => {
        ev.preventDefault();
        const t = btn.getAttribute('data-tab');
        if (typeof window.showTab === 'function') window.showTab(t);
        else {
          document.querySelectorAll('.tab').forEach(s => s.style.display = 'none');
          const el = document.getElementById('tab-' + t) || document.getElementById(t);
          if (el) el.style.display = 'block';
        }
      });
    });
    document.querySelectorAll('nav [data-logout]').forEach(btn => {
      btn.addEventListener('click', (ev) => { ev.preventDefault(); if (typeof window.logout === 'function') logout(); });
    });
  }

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', bindDemoButtons);
  else bindDemoButtons();
})();
</script>
</body>
</html>