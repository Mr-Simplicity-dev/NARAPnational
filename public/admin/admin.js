(function () {
  const token = localStorage.getItem('jwt');

  // Adjust these for your setup
  const HOMEPAGE   = '/index.php';
  const LOGIN_PAGE = '/admin/login.php';
  const LOGOUT_URL = '/api/auth/logout';

  // Guard: require token client-side
  if (!token) {
    window.location.replace(LOGIN_PAGE);
    return;
  }

  // Small helper
  const esc = (s) => String(s ?? '').replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
  const fmtDate = (v) => {
    if (!v) return '';
    const d = new Date(v);
    return isNaN(d) ? esc(v) : d.toLocaleString();
  };

  const statusEl = document.getElementById('status');
  if (statusEl) statusEl.textContent = 'Authenticated ✓';

  async function serverLogout() {
    try {
      const response = await fetch(LOGOUT_URL, {
        method: 'POST',
        headers: token ? { 'Authorization': 'Bearer ' + token } : {},
        credentials: 'include'
      });
      // If server says 401/403 we still proceed with client cleanup
      if (!response.ok && response.status < 500) {
        console.warn('Server logout non-OK:', response.status);
      }
    } catch (error) {
      console.error('Logout error:', error);
      // Continue client-side regardless
    }
  }

  // Expose for the Logout button
  window.logout = async function () {
    try {
      await serverLogout();

      // Clear all storage
      localStorage.removeItem('jwt');
      sessionStorage.removeItem('jwt');
      localStorage.removeItem('token');
      sessionStorage.removeItem('token');
      localStorage.removeItem('user');

      // Clear caches (if any)
      if ('caches' in window) {
        try {
          const keys = await caches.keys();
          await Promise.all(keys.map(k => caches.delete(k)));
        } catch (e) {
          console.warn('Cache clear failed:', e);
        }
      }

      // Clear any remaining IndexedDB (best effort)
      if (window.indexedDB && indexedDB.databases) {
        try {
          const dbs = await indexedDB.databases();
          await Promise.all((dbs || []).map(db => db?.name ? new Promise((res) => {
            const req = indexedDB.deleteDatabase(db.name);
            req.onsuccess = req.onerror = req.onblocked = () => res();
          }) : Promise.resolve()));
        } catch (e) {
          console.warn('IndexedDB clear failed:', e);
        }
      }

    } catch (error) {
      console.error('Logout process error:', error);
    } finally {
      // Replace so back-button won't return to a protected page
      window.location.replace(HOMEPAGE);
    }
  };

  // Auto-bind logout button if present
  document.getElementById('logoutBtn')?.addEventListener('click', () => window.logout());


  // ------- Tabs + API helpers -------
  window.showTab = function (name) {
    document.querySelectorAll('.tab').forEach(t => t.style.display = 'none');
    const el = document.getElementById('tab-' + name);
    if (el) el.style.display = 'block';
    loadList(name);
  };

  async function api(path, opts = {}) {
    const headers = Object.assign(
      { 'Content-Type': 'application/json' },
      token ? { 'Authorization': 'Bearer ' + token } : {},
      opts.headers || {}
    );

    const res = await fetch(path, Object.assign({}, opts, { headers, credentials: 'include' }));
    // Try parse JSON, even on error responses
    let data = {};
    try { data = await res.json(); } catch (_) { /* ignore */ }

    // If token expired/invalid -> hard logout to avoid stuck state
    if (res.status === 401 || res.status === 403) {
      console.warn('Auth expired or invalid. Forcing logout.');
      await window.logout();
      throw new Error(data.message || 'Unauthorized');
    }

    if (!res.ok) {
      throw new Error(data.message || ('HTTP ' + res.status));
    }
    return data;
  }

  // Map dashboard resource names to API endpoints
  function resolveApi(resource) {
    switch (resource) {
      case 'registrations': return '/api/registrations';      // full members list
      case 'paid':          return '/api/members/paid';  // paid subset
      case 'unpaid':        return '/api/members/unpaid';// unpaid subset
      default:              return '/api/' + resource;
    }
  }

  // If you delete from paid/unpaid/registrations, you still delete a "member"
  function deleteBase(resource) {
    return (resource === 'paid' || resource === 'unpaid' || resource === 'registrations')
      ? 'members'
      : resource;
  }

  async function loadList(resource) {
    const listWrap = document.querySelector(`[data-list="${resource}"]`);
    if (!listWrap) return;

    listWrap.innerHTML = 'Loading...';
    try {
      const data = await api(resolveApi(resource));
      const items = Array.isArray(data) ? data : (data.data || []);

      if (typeof renderList === 'function') {
        renderList(resource, items);
      } else {
        listWrap.innerHTML = items.map(doc => itemRow(resource, doc)).join('') || '<div>No items yet.</div>';
      }

      // Attach delete handlers (if present in generic item renderer)
      listWrap.querySelectorAll('[data-del]').forEach(btn => {
        btn.addEventListener('click', async (e) => {
          const id = e.currentTarget.getAttribute('data-del');
          if (!confirm('Delete this item?')) return;
          await api(`/api/${deleteBase(resource)}/${id}`, { method: 'DELETE' });
          loadList(resource);
        });
      });

    } catch (e) {
      listWrap.innerHTML = `<div style="color:#b00">${esc(e.message || 'Failed')}</div>`;
    }
  }

  function itemRow(resource, doc) {
    const title = doc.title || doc.name || doc.question || doc.bigTitle || ('#' + (doc._id || ''));
    const img = doc.imageUrl
      ? `<img src="${esc(doc.imageUrl)}" style="width:60px;height:40px;object-fit:cover;border-radius:4px;margin-right:8px" />`
      : '';
    return `<div class="card" style="display:flex;align-items:center;gap:8px;justify-content:space-between;margin:8px 0;padding:10px">
      <div style="display:flex;align-items:center;gap:8px">
        ${img}
        <div>
          <div><strong>${esc(title)}</strong></div>
          <div class="small" style="color:#777">${esc(doc._id || '')}</div>
        </div>
      </div>
      <button data-del="${esc(doc._id || '')}" class="btn">Delete</button>
    </div>`;
  }

  // ---- Custom renderers for new resources ----
  function renderList(resource, items) {
    const wrap = document.querySelector(`[data-list="${resource}"]`);
    if (!wrap) return;

    // Paid members
    if (resource === 'paid') {
      if (!items.length) { wrap.innerHTML = '<div>No paid members yet.</div>'; return; }
      const rows = items.map(u => `
        <tr>
          <td>${esc(u.name || (u.firstName ? `${u.firstName} ${u.lastName || ''}` : ''))}</td>
          <td>${esc(u.memberCode || u.code || '')}</td>
          <td>${esc(u.phone || u.phoneNumber || '')}</td>
          <td>${esc(u.email || '')}</td>
          <td>${esc(u.state || u.stateOfResidence || u.stateCode || '')}</td>
          <td>${esc(fmtDate(u.createdAt || u.joinedAt))}</td>
        </tr>`).join('');
      wrap.innerHTML = `<div class="table-responsive"><table class="table table-striped">
        <thead><tr><th>Name</th><th>Member Code</th><th>Phone</th><th>Email</th><th>State</th><th>Joined</th></tr></thead>
        <tbody>${rows}</tbody></table></div>`;
      return;
    }

    // Unpaid members
    if (resource === 'unpaid') {
      if (!items.length) { wrap.innerHTML = '<div>All members have paid 🎉</div>'; return; }
      const rows = items.map(u => {
        const name = (u.name || (u.firstName ? `${u.firstName} ${u.lastName || ''}` : ''));
        const missing = [];
        if (!(u.membershipActive === true || u.hasPaidMembership === true)) missing.push('Membership');
        if (!(u.hasPaidCertificate === true)) missing.push('Certificate');
        if (!(u.hasPaidIdCard === true || u.idCardPaid === true)) missing.push('ID Card');
        return `<tr>
          <td>${esc(name)}</td>
          <td>${esc(u.memberCode || u.code || '')}</td>
          <td>${esc(u.phone || u.phoneNumber || '')}</td>
          <td>${esc(u.email || '')}</td>
          <td>${esc(u.state || u.stateOfResidence || u.stateCode || '')}</td>
          <td>${esc(missing.join(', ') || '—')}</td>
        </tr>`;
      }).join('');
      wrap.innerHTML = `<div class="table-responsive"><table class="table table-striped">
        <thead><tr><th>Name</th><th>Member Code</th><th>Phone</th><th>Email</th><th>State</th><th>Unpaid items</th></tr></thead>
        <tbody>${rows}</tbody></table></div>`;
      return;
    }

    // Registrations (all members — button list with quick viewer)
    if (resource === 'registrations') {
      if (!items.length) { wrap.innerHTML = '<div>No registrations found.</div>'; return; }
      wrap.innerHTML = items.map((u, i) => `
        <div class="card" style="padding:10px;margin:8px 0;display:flex;justify-content:space-between;align-items:center">
          <div>
            <strong>${esc(u.name || u.email || ('#' + (u._id || i)))}</strong>
            <div class="small" style="color:#777">${esc(u.email || '')}</div>
          </div>
          <button class="btn btn-sm" data-view="${esc(u._id || i)}">View</button>
        </div>`).join('');
      wrap.querySelectorAll('[data-view]').forEach(btn => {
        btn.addEventListener('click', () => {
          const id = btn.getAttribute('data-view');
          const obj = items.find(x => String(x._id || '') === id) || items[Number(id)] || {};
          alert('Registration details:\n\n' + JSON.stringify(obj, null, 2));
        });
      });
      return;
    }

    // Default list renderer (generic resources)
    wrap.innerHTML = items.map(doc => itemRow(resource, doc)).join('') || '<div>No items yet.</div>';
  }

  // Create (JSON payload)
  window.createItem = async function (ev, resource) {
    ev.preventDefault();
    const form = ev.target;
    const payload = {};
    Array.from(form.elements).forEach(el => {
      if (!el.name) return;
      if (el.type === 'number') payload[el.name] = parseFloat(el.value || '0');
      else if (el.type !== 'file') payload[el.name] = el.value;
    });
    try {
      await api('/api/' + resource, { method: 'POST', body: JSON.stringify(payload) });
      form.reset();
      loadList(resource);
      alert('Created');
    } catch (e) { alert(e.message || 'Failed'); }
    return false;
  };

  // Upload (multipart)
  window.doUpload = async function () {
    const fileInput = document.getElementById('upload-file');
    const folder = document.getElementById('upload-folder')?.value?.trim() || 'misc';
    if (!fileInput?.files?.[0]) return alert('Choose a file');
    const fd = new FormData();
    fd.append('file', fileInput.files[0]);
    try {
      const res = await fetch('/api/upload?folder=' + encodeURIComponent(folder), {
        method: 'POST',
        headers: token ? { 'Authorization': 'Bearer ' + token } : {},
        credentials: 'include',
        body: fd
      });
      let data = {};
      try { data = await res.json(); } catch (_) {}
      if (!res.ok) throw new Error((data && data.message) || 'Upload failed');
      const out = document.getElementById('upload-result');
      if (out) out.textContent = data.url || 'Uploaded.';
    } catch (e) {
      const out = document.getElementById('upload-result');
      if (out) out.textContent = e.message || 'Failed';
    }
  };

  // Default tab
  showTab('sliders');

  // Auto-refresh members tabs
  const MEMBERS_TABS = ['registrations', 'paid', 'unpaid'];
  const POLL_MS = 20000; // 20s
  setInterval(() => {
    const visibleTab = Array.from(document.querySelectorAll('.tab'))
      .find(t => t.style.display !== 'none' && t.id && t.id.startsWith('tab-'));
    if (!visibleTab) return;
    const name = visibleTab.id.replace('tab-', '');
    if (MEMBERS_TABS.includes(name)) {
      loadList(name);
    }
  }, POLL_MS);
})();

