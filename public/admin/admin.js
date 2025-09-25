(function(){
  const token = localStorage.getItem('jwt');

  // Correct HOMEPAGE path - use your actual entry point
  const HOMEPAGE   = '/index.php'; // or '/' depending on your setup
  const LOGOUT_URL = '/api/auth/logout';

  // Guard: require token client-side
  if (!token) { 
    window.location.href = '/admin/login.php'; 
    return; 
  }
  
  const statusEl = document.getElementById('status');
  if (statusEl) statusEl.textContent = 'Authenticated ✓';

  async function serverLogout(){
    try{
      const response = await fetch(LOGOUT_URL, {
        method: 'POST',
        headers: token ? { 'Authorization': 'Bearer ' + token } : {},
        credentials: 'include'
      });
      
      if (!response.ok) {
        throw new Error(`Logout failed: ${response.status}`);
      }
    }catch(error){
      console.error('Logout error:', error);
      // Continue with client-side logout even if server fails
    }
  }

  // Expose for the Logout button
  window.logout = async function(){
    try {
      await serverLogout();
      
      // Clear all storage
      localStorage.removeItem('jwt');
      sessionStorage.removeItem('jwt');
      localStorage.removeItem('token');
      sessionStorage.removeItem('token');
      localStorage.removeItem('user');
      
      // More comprehensive cache clearing
      if ('caches' in window) {
        caches.keys().then(keys => {
          keys.forEach(key => caches.delete(key));
        });
      }
      
      // Clear any remaining storage
      if (window.indexedDB) {
        indexedDB.databases().then(dbs => {
          dbs.forEach(db => {
            if (db.name) indexedDB.deleteDatabase(db.name);
          });
        });
      }
      
      // Force redirect with timeout to ensure cleanup completes
      setTimeout(() => {
        // Use replace to prevent back button navigation to dashboard
        window.location.replace(HOMEPAGE);
      }, 100);
      
    } catch(error) {
      console.error('Logout process error:', error);
      // Force redirect even if there's an error
      window.location.replace(HOMEPAGE);
    }
  };



  // ------- tabs + API helpers (your existing logic preserved) -------
  window.showTab = function(name){
    document.querySelectorAll('.tab').forEach(t => t.style.display = 'none');
    const el = document.getElementById('tab-'+name);
    if (el) el.style.display = 'block';
    loadList(name);
  };

  async function api(path, opts = {}){
    const headers = Object.assign(
      {'Content-Type':'application/json'},
      token ? {'Authorization':'Bearer ' + token} : {},
      opts.headers || {}
    );
    const res = await fetch(path, Object.assign({}, opts, { headers, credentials:'include' }));
    const data = await res.json().catch(()=> ({}));
    if (!res.ok) throw new Error(data.message || ('HTTP ' + res.status));
    return data;
  }

  async function loadList(resource){
    const listWrap = document.querySelector(`[data-list="${resource}"]`);
    if (!listWrap) return;
    listWrap.innerHTML = 'Loading...';
    try{
      const data = await api('/api/' + resource);
      const items = Array.isArray(data) ? data : (data.data || []);
      if (typeof renderList === 'function') { renderList(resource, items); }
      else { listWrap.innerHTML = items.map(doc => itemRow(resource, doc)).join('') || '<div>No items yet.</div>'; }
      listWrap.querySelectorAll('[data-del]').forEach(btn => {
        btn.addEventListener('click', async (e) => {
          const id = e.currentTarget.getAttribute('data-del');
          if (!confirm('Delete this item?')) return;
          await api('/api/' + resource + '/' + id, { method: 'DELETE' });
          loadList(resource);
        });
      });
    }catch(e){
      listWrap.innerHTML = '<div style="color:#b00">' + (e.message || 'Failed') + '</div>';
    }
  }

  function itemRow(resource, doc){
    const title = doc.title || doc.name || doc.question || doc.bigTitle || ('#' + (doc._id || ''));
    const img = doc.imageUrl ? `<img src="${doc.imageUrl}" style="width:60px;height:40px;object-fit:cover;border-radius:4px;margin-right:8px" />` : '';
    return `<div class="card" style="display:flex;align-items:center;gap:8px;justify-content:space-between;margin:8px 0;padding:10px">
      <div style="display:flex;align-items:center;gap:8px">
        ${img}<div><div><strong>${escapeHtml(title)}</strong></div><div class="small" style="color:#777">${doc._id||''}</div></div>
      </div>
      <button data-del="${doc._id}" class="btn">Delete</button>
    </div>`;
  }

  function escapeHtml(s){ return String(s||'').replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m])); }

  window.createItem = async function(ev, resource){
    ev.preventDefault();
    const form = ev.target;
    const payload = {};
    Array.from(form.elements).forEach(el => {
      if (!el.name) return;
      if (el.type === 'number') payload[el.name] = parseFloat(el.value || '0');
      else if (el.type !== 'file') payload[el.name] = el.value;
    });
    try{
      await api('/api/' + resource, { method: 'POST', body: JSON.stringify(payload) });
      form.reset();
      loadList(resource);
      alert('Created');
    }catch(e){ alert(e.message || 'Failed'); }
    return false;
  };

  window.doUpload = async function(){
    const fileInput = document.getElementById('upload-file');
    const folder = document.getElementById('upload-folder')?.value?.trim() || 'misc';
    if (!fileInput?.files?.[0]) return alert('Choose a file');
    const fd = new FormData();
    fd.append('file', fileInput.files[0]);
    try{
      const res = await fetch('/api/upload?folder='+encodeURIComponent(folder), {
        method:'POST',
        headers: token ? { 'Authorization': 'Bearer ' + token } : {},
        credentials:'include',
        body: fd
      });
      const data = await res.json();
      if (!res.ok) throw new Error(data.message || 'Upload failed');
      const out = document.getElementById('upload-result');
      if (out) out.textContent = data.url || 'Uploaded.';
    }catch(e){
      const out = document.getElementById('upload-result');
      if (out) out.textContent = e.message || 'Failed';
    }
  };


  // ---- Custom renderers for new resources ----
  function renderList(resource, items){
    const wrap = document.querySelector(`[data-list="${resource}"]`);
    if (!wrap) return;
    if (resource === 'paid') {
      if (!items.length) { wrap.innerHTML = '<div>No paid members yet.</div>'; return; }
      const rows = items.map(u => `
        <tr>
          <td>${escapeHtml(u.name || (u.firstName ? (u.firstName + ' ' + (u.lastName||'')) : ''))}</td>
          <td>${escapeHtml(u.memberCode || u.code || '')}</td>
          <td>${escapeHtml(u.phone || u.phoneNumber || '')}</td>
          <td>${escapeHtml(u.email || '')}</td>
          <td>${escapeHtml(u.state || u.stateOfResidence || u.stateCode || '')}</td>
          <td>${escapeHtml(u.createdAt || u.joinedAt || '')}</td>
        </tr>`).join('');
      wrap.innerHTML = `<div class="table-responsive"><table class="table table-striped">
        <thead><tr><th>Name</th><th>Member Code</th><th>Phone</th><th>Email</th><th>State</th><th>Joined</th></tr></thead>
        <tbody>${rows}</tbody></table></div>`;
      return;
    }
    if (resource === 'registrations') {
      if (!items.length) { wrap.innerHTML = '<div>No registrations found.</div>'; return; }
      // Button list with viewer
      wrap.innerHTML = items.map((u, i) => `
        <div class="card" style="padding:10px;margin:8px 0;display:flex;justify-content:space-between;align-items:center">
          <div><strong>${escapeHtml(u.name || u.email || ('#' + (u._id||i)))}</strong><div class="small" style="color:#777">${escapeHtml(u.email||'')}</div></div>
          <button class="btn btn-sm" data-view="${u._id||i}">View</button>
        </div>`).join('');
      wrap.querySelectorAll('[data-view]').forEach(btn => {
        btn.addEventListener('click', () => {
          const id = btn.getAttribute('data-view');
          const obj = items.find(x => String(x._id||'') === id) || items[Number(id)] || {};
          alert('Registration details:\\n\\n' + JSON.stringify(obj, null, 2));
        });
      });
      return;
    }
    // default
    wrap.innerHTML = items.map(doc => itemRow(resource, doc)).join('') || '<div>No items yet.</div>';
  }


  // default tab
  showTab('sliders');
})();
