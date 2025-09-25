
(function(){
  // utilities
  function text(x){ return (x==null?'':String(x)); }
  function esc(s){ return text(s).replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m])); }
  function fmtDate(s){ try{ return new Date(s).toLocaleDateString(); } catch(_){ return text(s); } }

  async function fetchJSON(url){
    const res = await fetch(url, { headers:{ 'Accept':'application/json' } });
    if(!res.ok){ throw new Error('HTTP ' + res.status); }
    return res.json();
  }

  // Render helpers
  function renderSliders(list){
    if(!list.length) return '<div class="text-muted">No slides yet.</div>';
    const items = list.map(s => `
      <div class="slide">
        ${s.imageUrl ? `<img src="${esc(s.imageUrl)}" alt="">` : ''}
        <div class="slide-caption">
          ${s.smallTitle ? `<h6>${esc(s.smallTitle)}</h6>` : ''}
          ${s.bigTitle ? `<h2>${esc(s.bigTitle)}</h2>` : ''}
          ${s.paragraph ? `<p>${esc(s.paragraph)}</p>` : ''}
          <div class="slide-actions">
            ${s.primaryBtnText && s.primaryBtnLink ? `<a class="btn btn-primary" href="${esc(s.primaryBtnLink)}">${esc(s.primaryBtnText)}</a>` : ''}
            ${s.secondaryBtnText && s.secondaryBtnLink ? `<a class="btn btn-outline-primary" href="${esc(s.secondaryBtnLink)}">${esc(s.secondaryBtnText)}</a>` : ''}
          </div>
        </div>
      </div>
    `).join('');
    return `<div class="owl-carousel">${items}</div>`;
  }

  function renderCards(list, mapper){
    if(!list.length) return '<div class="text-muted">No items yet.</div>';
    return `<div class="row g-4">` + list.map(mapper).join('') + `</div>`;
  }
  function col(md){ return `col-12 col-sm-6 col-md-${md||4}`; }

  const renderers = {
    services(list){
      return renderCards(list, s => `
        <div class="${col(4)}">
          <div class="card h-100 shadow-sm">
            ${s.imageUrl ? `<img class="card-img-top" src="${esc(s.imageUrl)}" alt="">` : ''}
            <div class="card-body">
              <h5 class="card-title">${esc(s.title || s.name || '')}</h5>
              <p class="card-text">${esc(s.description || '')}</p>
            </div>
          </div>
        </div>`);
    },
    products(list){
      return renderCards(list, p => `
        <div class="${col(3)}">
          <div class="card h-100 shadow-sm">
            ${p.imageUrl ? `<img class="card-img-top" src="${esc(p.imageUrl)}" alt="">` : ''}
            <div class="card-body">
              <h6 class="card-title">${esc(p.title || p.name || '')}</h6>
              ${p.description ? `<p class="card-text">${esc(p.description)}</p>` : ''}
              ${p.price ? `<div class="fw-bold">₦${esc(p.price)}</div>` : ''}
            </div>
          </div>
        </div>`);
    },
    portfolio(list){
      return renderCards(list, it => `
        <div class="${col(4)}">
          <a href="${esc(it.imageUrl||'')}" data-lightbox="portfolio" class="d-block">
            <img src="${esc(it.imageUrl||'')}" class="img-fluid rounded" alt="">
          </a>
          <div class="mt-2">${esc(it.title || it.name || '')}</div>
        </div>`);
    },
    team(list){
      return renderCards(list, m => `
        <div class="${col(3)}">
          <div class="text-center">
            ${m.imageUrl ? `<img src="${esc(m.imageUrl)}" class="rounded-circle mb-2" style="width:120px;height:120px;object-fit:cover" alt="">` : ''}
            <div class="fw-semibold">${esc(m.name || '')}</div>
            <div class="text-muted small">${esc(m.role || m.position || '')}</div>
          </div>
        </div>`);
    },
    blogs(list){
      return renderCards(list, b => `
        <div class="${col(4)}">
          <div class="card h-100 shadow-sm">
            ${b.imageUrl ? `<img class="card-img-top" src="${esc(b.imageUrl)}" alt="">` : ''}
            <div class="card-body">
              <div class="text-muted small">${fmtDate(b.createdAt)}</div>
              <h5 class="card-title">${esc(b.title || '')}</h5>
              <p class="card-text">${esc(b.excerpt || b.description || '')}</p>
              ${b.slug ? `<a class="btn btn-sm btn-outline-primary" href="/blog/${esc(b.slug)}">Read</a>` : ''}
            </div>
          </div>
        </div>`);
    },
    faqs(list){
      if(!list.length) return '<div class="text-muted">No FAQs yet.</div>';
      return `<div class="accordion" id="faqs-acc">` + list.map((f,i) => `
        <div class="accordion-item">
          <h2 class="accordion-header" id="h${i}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c${i}">${esc(f.question||'')}</button>
          </h2>
          <div id="c${i}" class="accordion-collapse collapse" data-bs-parent="#faqs-acc">
            <div class="accordion-body">${esc(f.answer||'')}</div>
          </div>
        </div>
      `).join('') + `</div>`;
    },
    offers(list){
      return renderCards(list, o => `
        <div class="${col(4)}">
          <div class="card h-100 shadow-sm">
            ${o.imageUrl ? `<img class="card-img-top" src="${esc(o.imageUrl)}" alt="">` : ''}
            <div class="card-body">
              <h5 class="card-title">${esc(o.title || '')}</h5>
              <p class="card-text">${esc(o.description || '')}</p>
            </div>
          </div>
        </div>`);
    },
    features(list){
      return renderCards(list, f => `
        <div class="${col(3)}">
          <div class="text-center p-3 border rounded h-100">
            <div class="fw-semibold">${esc(f.title || '')}</div>
            <div class="text-muted small">${esc(f.description || '')}</div>
          </div>
        </div>`);
    }
  };

  function ensureSlot(container, resource){
    let slot = container.querySelector('[data-public-slot="'+resource+'"]')
            || container.querySelector('[data-public-slot]')
            || container.querySelector('.admin-feed');
    if (!slot) {
      slot = document.createElement('div');
      slot.setAttribute('data-public-slot', resource);
      // add margin-top to separate from existing text/heading
      slot.style.marginTop = '1rem';
      container.appendChild(slot);
    }
    return slot;
  }

  async function hydrate(resource){
    const container = document.querySelector('[data-public="'+resource+'"]');
    if (!container) return; // nothing to render into
    try{
      const data = await fetchJSON('/api/' + resource);
      const list = Array.isArray(data) ? data : (data.data || data.items || []);
      const renderer = (resource === 'sliders') ? renderSliders : renderers[resource];
      const slot = ensureSlot(container, resource);
      slot.innerHTML = renderer ? renderer(list) : '<div class="text-muted">No renderer.</div>';
      // init optional plugins
      if (resource === 'sliders' && window.$ && $('.owl-carousel').owlCarousel) {
        $('.owl-carousel').owlCarousel({ items:1, loop:true, autoplay:true, autoplayTimeout:5000 });
      }
    }catch(e){
      const slot = ensureSlot(container, resource);
      slot.innerHTML = '<div class="text-danger">Failed to load '+resource+'</div>';
    }
  }

  // Kick off
  ['sliders','services','products','portfolio','team','blogs','faqs','offers','features'].forEach(hydrate);
})();
