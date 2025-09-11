(function(){
  const token = localStorage.getItem('jwt');
  if (!token) {
    window.location.href = '/admin/login.php';
    return;
  }
  document.getElementById('status').textContent = 'Authenticated ✓';

  window.logout = function(){
    localStorage.removeItem('jwt');
    window.location.href = '/admin/login.php';
  };

  window.showTab = function(name){
    document.querySelectorAll('.tab').forEach(t => t.style.display = 'none');
    const el = document.getElementById('tab-'+name);
    if (el) el.style.display = 'block';
    // refresh the list when shown
    loadList(name);
  };

  async function api(path, opts={}){
    const headers = Object.assign({'Content-Type':'application/json','Authorization':'Bearer '+token}, opts.headers||{});
    const res = await fetch(path, Object.assign({}, opts, { headers }));
    const data = await res.json().catch(()=>({}));
    if (!res.ok) throw new Error(data.message || ('HTTP '+res.status));
    return data;
  }

  async function loadList(resource){
    const listWrap = document.querySelector(`[data-list="${resource}"]`);
    if (!listWrap) return;
    listWrap.innerHTML = 'Loading...';
    try{
      const data = await api('/api/'+resource);
      const items = Array.isArray(data) ? data : (data.data || []);
      listWrap.innerHTML = items.map(doc => itemRow(resource, doc)).join('') || '<div>No items yet.</div>';
      // attach delete handlers
      listWrap.querySelectorAll('[data-del]').forEach(btn => {
        btn.addEventListener('click', async (e) => {
          const id = e.currentTarget.getAttribute('data-del');
          if (!confirm('Delete this item?')) return;
          await api('/api/'+resource+'/'+id, { method:'DELETE' });
          loadList(resource);
        });
      });
    }catch(e){
      listWrap.innerHTML = '<div style="color:#b00">'+e.message+'</div>';
    }
  }

  function itemRow(resource, doc){
    const title = doc.title || doc.name || doc.question || doc.bigTitle || ('#'+doc._id);
    const img = doc.imageUrl ? `<img src="${doc.imageUrl}" style="width:60px;height:40px;object-fit:cover;border-radius:4px;margin-right:8px" />` : '';
    return `<div class="card" style="display:flex;align-items:center;gap:8px;justify-content:space-between;margin:8px 0;padding:10px">
      <div style="display:flex;align-items:center;gap:8px">
        ${img}<div><div><strong>${escapeHtml(title)}</strong></div><div class="small" style="color:#777">${doc._id}</div></div>
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
      else payload[el.name] = el.value;
    });
    try{
      await api('/api/'+resource, { method:'POST', body: JSON.stringify(payload) });
      form.reset();
      loadList(resource);
      alert('Created');
    }catch(e){ alert(e.message); }
    return false;
  };

  window.doUpload = async function(){
    const fileInput = document.getElementById('upload-file');
    const folder = document.getElementById('upload-folder').value.trim() || 'misc';
    if (!fileInput.files[0]) return alert('Choose a file');
    const fd = new FormData();
    fd.append('file', fileInput.files[0]);
    try{
      const res = await fetch('/api/upload?folder='+encodeURIComponent(folder), {
        method:'POST',
        headers:{ 'Authorization': 'Bearer '+token },
        body: fd
      });
      const data = await res.json();
      if (!res.ok) throw new Error(data.message || 'Upload failed');
      document.getElementById('upload-result').textContent = data.url;
    }catch(e){
      document.getElementById('upload-result').textContent = e.message;
    }
  };

  // default tab
  showTab('sliders');
})(); 
