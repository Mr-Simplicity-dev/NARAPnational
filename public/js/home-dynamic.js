
(async function () {
  const pick = (obj, keys) => keys.map(k => obj?.[k]).find(v => v != null);
  const text = (s) => (s == null ? '' : String(s));
  const by = (sel, root=document) => root.querySelector(sel);

  async function get(url) {
    try { const r = await fetch(url, {cache:'no-store'}); if (!r.ok) return null; return await r.json(); }
    catch { return null; }
  }
  // Try API first, then JSON fallback
  const [
    sliders, services, portfolio, team, faqs, features, blogs, offers, products, homeJson
  ] = await Promise.all([
    get('/api/sliders'),
    get('/api/services'),
    get('/api/portfolio'),
    get('/api/team'),
    get('/api/faqs'),
    get('/api/features'),
    get('/api/blogs?limit=6'),
    get('/api/offers'),
    get('/api/products'),
    get('/admin/data/home.json')
  ]);

  // Build a unified "home" object
  const home = homeJson || {};

  // HERO (sliders)
  const heroSlides = Array.isArray(sliders) ? sliders : (sliders?.data || sliders?.items || []);
  if (heroSlides?.length) {
    const inner = document.querySelector('#header-carousel .carousel-inner') ||
                  document.querySelector('.header-carousel .carousel-inner') ||
                  document.querySelector('#hero .carousel-inner');
    if (inner) {
      inner.innerHTML = '';
      heroSlides.forEach((s, i) => {
        const img = pick(s, ['image','imageUrl','photo','cover']);
        const kicker = pick(s, ['kicker','tagline','kickerText']);
        const headline = pick(s, ['headline','title','name']);
        const desc = pick(s, ['text','description','body']);
        const cta1 = pick(s, ['cta1','primaryCta']);
        const cta2 = pick(s, ['cta2','secondaryCta']);
        const item = document.createElement('div');
        item.className = 'carousel-item' + (i===0?' active':'');
        item.innerHTML = `
          <img class="w-100" src="${text(img||'')}" alt="${text(headline||'Slide')}">
          <div class="carousel-caption d-flex flex-column align-items-start justify-content-center text-start">
            ${kicker?`<h4 class="text-primary">${text(kicker)}</h4>`:''}
            ${headline?`<h1 class="display-4 text-white mb-3">${text(headline)}</h1>`:''}
            ${desc?`<p class="mb-4">${text(desc)}</p>`:''}
            <div class="d-flex gap-2 flex-wrap">
              ${cta1?`<a class="btn btn-primary rounded-pill py-2 px-4" href="${text(cta1.href||'#')}">${text(cta1.label||'Learn More')}</a>`:''}
              ${cta2?`<a class="btn btn-outline-light rounded-pill py-2 px-4" href="${text(cta2.href||'#')}">${text(cta2.label||'More')}</a>`:''}
            </div>
          </div>`;
        inner.appendChild(item);
      });
    }
  } else if (home.hero?.slides?.length) {
    // Fallback to JSON schema already supported by earlier version
    const inner = document.querySelector('#header-carousel .carousel-inner') ||
                  document.querySelector('.header-carousel .carousel-inner') ||
                  document.querySelector('#hero .carousel-inner');
    if (inner) {
      inner.innerHTML = '';
      home.hero.slides.forEach((s, i) => {
        const item = document.createElement('div');
        item.className = 'carousel-item' + (i===0?' active':'');
        item.innerHTML = `
          <img class="w-100" src="${text(s.image||'')}" alt="${text(s.headline||'Slide')}">
          <div class="carousel-caption d-flex flex-column align-items-start justify-content-center text-start">
            ${s.kicker?`<h4 class="text-primary">${text(s.kicker)}</h4>`:''}
            ${s.headline?`<h1 class="display-4 text-white mb-3">${text(s.headline)}</h1>`:''}
            ${s.text?`<p class="mb-4">${text(s.text)}</p>`:''}
            <div class="d-flex gap-2 flex-wrap">
              ${s.cta1?`<a class="btn btn-primary rounded-pill py-2 px-4" href="${text(s.cta1.href||'#')}">${text(s.cta1.label||'Learn More')}</a>`:''}
              ${s.cta2?`<a class="btn btn-outline-light rounded-pill py-2 px-4" href="${text(s.cta2.href||'#')}">${text(s.cta2.label||'More')}</a>`:''}
            </div>
          </div>`;
        inner.appendChild(item);
      });
    }
  }

  // ABOUT – prefers JSON (settings), since API may not have this
  (function renderAbout() {
    const data = home.about || {};
    const section = by('#about');
    if (!section) return;
    const h4 = section.querySelector('h4.text-primary'); if (h4 && data.title) h4.textContent = text(data.title);
    const h1 = section.querySelector('h1.display-5'); if (h1 && data.headline) h1.textContent = text(data.headline);
    const pWrap = section.querySelector('.col-xl-7') || section;
    if (Array.isArray(data.paragraphs)) {
      pWrap.querySelectorAll('p').forEach(p => p.remove());
      data.paragraphs.forEach(p => { const el = document.createElement('p'); el.className='mb-4'; el.innerHTML = p; pWrap.appendChild(el); });
    }
    const img = section.querySelector('img'); if (img && data.image) img.src = data.image;
  })();

  // SERVICES
  (function renderServices() {
    const section = document.querySelector('#what-we-do');
    if (!section) return;
    const items = Array.isArray(services) ? services : (services?.data || services?.items || home.services?.items || []);
    const header = section.querySelector('.text-center.mx-auto');
    if (header) {
      const h4 = header.querySelector('h4'); if (h4) h4.textContent = text(home.services?.title || 'What We Do');
      const h1 = header.querySelector('h1'); if (h1) h1.textContent = text(home.services?.subtitle || '');
    }
    const row = section.querySelector('.row.g-4'); if (!row) return;
    row.innerHTML = '';
    items.forEach((it, idx) => {
      const image = pick(it, ['image','imageUrl','photo']);
      const title = pick(it, ['title','name']);
      const desc = pick(it, ['text','description','body']);
      const href = pick(it, ['href','url','link']) || '/#what-we-do';
      const col = document.createElement('div');
      col.className = 'col-md-6 col-lg-4 wow fadeInUp'; col.dataset.wowDelay = ((idx%6)*0.2+0.2).toFixed(1)+'s';
      col.innerHTML = `<div class="service-item">
        <div class="service-img"><img src="${text(image||'')}" class="img-fluid rounded-top w-100" alt="${text(title||'')}"></div>
        <div class="rounded-bottom p-4">
          <a href="${text(href)}" class="h4 d-inline-block mb-4">${text(title||'')}</a>
          <p class="mb-4">${text(desc||'')}</p>
          <a class="btn btn-primary rounded-pill py-2 px-4" href="${text(href)}">Learn More</a>
        </div></div>`;
      row.appendChild(col);
    });
  })();

  // PROJECTS / PORTFOLIO
  (function renderProjects() {
    const section = document.querySelector('#projects');
    if (!section) return;
    const items = Array.isArray(portfolio) ? portfolio : (portfolio?.data || portfolio?.items || home.projects?.items || []);
    const header = section.querySelector('.text-center.mx-auto');
    if (header) {
      const h4 = header.querySelector('h4'); if (h4) h4.textContent = text(home.projects?.title || 'Our Projects');
      const h1 = header.querySelector('h1'); if (h1) h1.textContent = text(home.projects?.subtitle || '');
    }
    const row = section.querySelector('.row.g-4'); if (!row) return;
    row.innerHTML = '';
    items.forEach((it) => {
      const image = pick(it, ['image','imageUrl','photo']);
      const title = pick(it, ['title','name']);
      const desc = pick(it, ['text','description','body']);
      const category = (pick(it, ['category','tag']) || 'show') + ' show';
      const col = document.createElement('div');
      col.className = `col-md-6 col-lg-4 portfolio-item ${category}`;
      col.innerHTML = `<div class="service-item"><div class="service-img">
        <img src="${text(image||'')}" class="img-fluid rounded-top w-100" alt="${text(title||'')}">
        <div class="portfolio-overlay"><h5>${text(title||'')}</h5><p>${text(desc||'')}</p></div>
      </div></div>`;
      row.appendChild(col);
    });
  })();

  // FEATURES
  (function renderFeatures() {
    const section = document.querySelector('#why-us');
    if (!section) return;
    const items = Array.isArray(features) ? features : (features?.data || features?.items || home.features?.items || []);
    const header = section.querySelector('.text-center.mx-auto');
    if (header) {
      const h4 = header.querySelector('h4'); if (h4) h4.textContent = text(home.features?.title || 'Why Choose Us');
      const h1 = header.querySelector('h1'); if (h1) h1.textContent = text(home.features?.headline || '');
    }
    const row = section.querySelector('.row.g-4'); if (!row) return;
    row.innerHTML = '';
    items.forEach((it, idx) => {
      const icon = pick(it, ['icon','iconClass']) || 'fas fa-star';
      const title = pick(it, ['title','name']);
      const desc = pick(it, ['text','description','body']);
      const href = pick(it, ['href','url','link']);
      const col = document.createElement('div');
      col.className = 'col-md-6 col-lg-6 col-xl-3 wow fadeInUp'; col.dataset.wowDelay = ((idx%4)*0.2+0.2).toFixed(1)+'s';
      col.innerHTML = `<div class="feature-item p-4">
        <div class="feature-icon p-4 mb-4"><i class="${text(icon)} fa-4x text-primary"></i></div>
        <h4>${text(title||'')}</h4><p class="mb-4">${text(desc||'')}</p>
        ${href ? `<a class="btn btn-primary rounded-pill py-2 px-4" href="${text(href)}">Learn More</a>`:''}
      </div>`;
      row.appendChild(col);
    });
  })();

  // OFFERS (typo "officers" in some dashboards)
  ;(function renderOffers() {
    const section = document.querySelector('#offer'); if (!section) return;
    const items = Array.isArray(offers) ? offers : (offers?.data || offers?.items || home.offer?.items || []);
    const header = section.querySelector('.text-center.mx-auto');
    if (header && (home.offer?.title || home.offer?.headline)) {
      const h4 = header.querySelector('h4'); if (h4) h4.textContent = text(home.offer.title || 'Our Offer');
    }
    const tabCol = section.querySelector('.col-xl-5 .nav'); const contentCol = section.querySelector('.col-xl-7 .tab-content');
    if (!tabCol || !contentCol) return;
    tabCol.innerHTML = ''; contentCol.innerHTML = '';
    items.forEach((it, idx) => {
      const img = pick(it, ['image','imageUrl','photo']);
      const headline = pick(it, ['headline','title','name']);
      const tabTitle = pick(it, ['tabTitle','title','name']) || headline || 'Offer';
      const desc = pick(it, ['text','description','body']);
      const href = pick(it, ['href','url','link']);
      const id = 'offertab_'+idx;
      const a = document.createElement('a'); a.className='accordion-link p-4 mb-4'+(idx===0?' active':''); a.dataset.bsToggle='pill'; a.href='#'+id; a.innerHTML = `<h5 class="mb-0">${text(tabTitle)}</h5>`; tabCol.appendChild(a);
      const pane = document.createElement('div'); pane.id = id; pane.className='tab-pane fade p-0'+(idx===0?' show active':''); pane.innerHTML = `
        <div class="row g-4">
          <div class="col-md-7"><img src="${text(img||'')}" class="img-fluid w-100 rounded" alt=""></div>
          <div class="col-md-5"><h1 class="display-5 mb-4">${text(headline||'')}</h1><p class="mb-4">${text(desc||'')}</p>${href?`<a class="btn btn-primary rounded-pill py-2 px-4" href="${text(href)}">Learn More</a>`:''}</div>
        </div>`; contentCol.appendChild(pane);
    });
  })();

  // BLOGS
  ;(function renderBlogs() {
    const section = document.querySelector('#blog'); if (!section) return;
    const header = section.querySelector('.text-center.mx-auto');
    if (header) {
      const h4 = header.querySelector('h4'); if (h4) h4.textContent = text(home.blog?.title || 'Our Blog & News');
      const h1 = header.querySelector('h1'); if (h1) h1.textContent = text(home.blog?.subtitle || '');
    }
    const row = section.querySelector('.row'); if (!row) return;
    const arr = Array.isArray(blogs) ? blogs : (blogs?.data || blogs?.items || home.blog?.items || []);
    const count = home.blog?.showCount || 3;
    row.innerHTML = '';
    arr.slice(0, count).forEach((p) => {
      const image = pick(p, ['image','imageUrl','cover']);
      const title = pick(p, ['title','name','headline']);
      const href = pick(p, ['href','url','slug','link']) || '#';
      const author = pick(p, ['author','authorName']) || 'Admin';
      const date = pick(p, ['date','publishedAt','createdAt']) || '';
      const excerpt = pick(p, ['excerpt','summary','text','description','body']);
      const col = document.createElement('div');
      col.className = 'col-md-6 col-lg-4 mb-4';
      col.innerHTML = `<div class="blog-item p-4 h-100 d-flex flex-column">
        <div class="blog-img mb-4"><img src="${text(image||'')}" class="img-fluid w-100 rounded" alt=""></div>
        <div class="d-flex align-items-center flex-wrap mb-2 small text-muted">
          <span class="me-3"><i class="fas fa-user text-primary me-1"></i>${text(author)}</span>
          <span class="me-3"><i class="far fa-calendar-alt text-primary me-1"></i>${text(date)}</span>
        </div>
        <a href="${text(typeof href==='string'?href:('#/'+href))}" class="h5 d-inline-block mb-2">${text(title||'')}</a>
        <p class="mb-3 flex-grow-1">${text(excerpt||'')}</p>
        <a href="${text(typeof href==='string'?href:('#/'+href))}" class="btn btn-primary btn-sm mt-auto">Read Full Blog</a>
      </div>`;
      row.appendChild(col);
    });
  })();

  // FAQs
  ;(function renderFaqs() {
    const section = document.querySelector('#faqs'); if (!section) return;
    const arr = Array.isArray(faqs) ? faqs : (faqs?.data || faqs?.items || home.faqs?.items || []);
    const acc = section.querySelector('#accordionFlushSection'); if (!acc) return;
    acc.innerHTML = '';
    arr.forEach((qa, idx) => {
      const q = pick(qa, ['q','question','title']); const a = pick(qa, ['a','answer','text','body']);
      const qid = 'flush-q'+idx, cid = 'flush-c'+idx;
      const item = document.createElement('div'); item.className='accordion-item'; item.innerHTML = `
        <h2 class="accordion-header" id="${qid}">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#${cid}" aria-expanded="false" aria-controls="${cid}">${text(q||'')}</button>
        </h2>
        <div id="${cid}" class="accordion-collapse collapse" aria-labelledby="${qid}" data-bs-parent="#accordionFlushSection">
          <div class="accordion-body">${text(a||'')}</div>
        </div>`;
      acc.appendChild(item);
    });
    const img = section.querySelector('.bg-primary.rounded img, .bg-primary.rounded > img, .col-lg-6 img');
    const side = home.faqs?.image; if (img && side) img.src = side;
  })();

  // TEAM
  ;(function renderTeam() {
    const section = document.querySelector('#team'); if (!section) return;
    const arr = Array.isArray(team) ? team : (team?.data || team?.items || home.team?.items || []);
    const row = section.querySelector('.row.g-4'); if (!row) return;
    row.innerHTML = '';
    arr.forEach((m, idx) => {
      const image = pick(m, ['image','imageUrl','photo','avatar']);
      const name = pick(m, ['name','title']);
      const role = pick(m, ['role','position','headline']);
      const social = m.social || {};
      const col = document.createElement('div');
      col.className = 'col-md-6 col-lg-6 col-xl-3 wow fadeInUp'; col.dataset.wowDelay = ((idx%4)*0.2+0.2).toFixed(1)+'s';
      col.innerHTML = `<div class="team-item">
        <div class="team-img"><img src="${text(image||'')}" class="img-fluid" alt="${text(name||'')}"></div>
        <div class="team-title"><h4 class="mb-0">${text(name||'')}</h4><p class="mb-0">${text(role||'')}</p></div>
        <div class="team-icon">
          ${social.facebook?`<a class="btn btn-primary btn-sm-square rounded-circle me-3" href="${text(social.facebook)}"><i class="fab fa-facebook-f"></i></a>`:''}
          ${social.twitter?`<a class="btn btn-primary btn-sm-square rounded-circle me-3" href="${text(social.twitter)}"><i class="fab fa-twitter"></i></a>`:''}
          ${social.linkedin?`<a class="btn btn-primary btn-sm-square rounded-circle me-3" href="${text(social.linkedin)}"><i class="fab fa-linkedin-in"></i></a>`:''}
          ${social.instagram?`<a class="btn btn-primary btn-sm-square rounded-circle me-0" href="${text(social.instagram)}"><i class="fab fa-instagram"></i></a>`:''}
        </div></div>`;
      row.appendChild(col);
    });
  })();

  // PRODUCTS (optional homepage section — create if you add a #products block)
  ;(function renderProducts() {
    const section = document.querySelector('#our-products, #products');
    if (!section || !products) return;
    const arr = Array.isArray(products) ? products : (products?.data || products?.items || []);
    const row = section.querySelector('.row'); if (!row) return;
    row.innerHTML='';
    arr.forEach((p) => {
      const image = pick(p, ['image','imageUrl','photo']);
      const title = pick(p, ['title','name']);
      const desc = pick(p, ['text','description','body']);
      const href = pick(p, ['href','url','link']) || '#';
      const col = document.createElement('div'); col.className='col-md-6 col-lg-4 mb-4';
      col.innerHTML = `<div class="product-item p-4 h-100 d-flex flex-column">
        <div class="mb-3"><img src="${text(image||'')}" class="img-fluid w-100 rounded" alt=""></div>
        <a href="${text(href)}" class="h5 d-inline-block mb-2">${text(title||'')}</a>
        <p class="mb-3 flex-grow-1">${text(desc||'')}</p>
        <a href="${text(href)}" class="btn btn-primary btn-sm mt-auto">View</a>
      </div>`;
      row.appendChild(col);
    });
  })();

})();
