// public/js/home-dynamic.js
(async () => {
  const qs = (sel, root=document) => root.querySelector(sel);
  const qsa = (sel, root=document) => Array.from(root.querySelectorAll(sel));

  // Helpers to inject HTML safely
  const html = (strings, ...vals) =>
    strings.reduce((acc, s, i) => acc + s + (vals[i] ?? ''), '');

  // 1) Load settings (About + section titles/subtitles) from API, else fallback to /admin/data/home.json
  let settings = null;
  try {
    const res = await fetch('/api/settings/home');
    if (res.ok) settings = await res.json();
  } catch (e) { /* ignore */ }

  if (!settings) {
    try {
      const res = await fetch('/admin/data/home.json'); // fallback (legacy)
      if (res.ok) {
        const data = await res.json();
        // Map legacy JSON keys to the new settings shape if needed
        settings = data.settings || data;
      }
    } catch (e) { /* ignore */ }
  }
  settings = settings || {};

  // Apply About
  if (settings.about) {
    const { title, headline, paragraphs, image } = settings.about;
    const aboutTitleEl = qs('[data-about-title]');
    const aboutHeadlineEl = qs('[data-about-headline]');
    const aboutBodyEl = qs('[data-about-body]');
    const aboutImgEl = qs('[data-about-image]');

    if (aboutTitleEl && title) aboutTitleEl.textContent = title;
    if (aboutHeadlineEl && headline) aboutHeadlineEl.textContent = headline;
    if (aboutBodyEl) {
      const paras = Array.isArray(paragraphs) ? paragraphs : (paragraphs ? [paragraphs] : []);
      aboutBodyEl.innerHTML = paras.map(p => `<p>${p}</p>`).join('');
    }
    if (aboutImgEl && image) aboutImgEl.setAttribute('src', image);
  }

  // Apply Section titles/subtitles
  const applyTitle = (prefix, obj) => {
    if (!obj) return;
    const titleEl = qs(`[data-${prefix}-title]`);
    const subEl = qs(`[data-${prefix}-subtitle]`);
    const headEl = qs(`[data-${prefix}-headline]`);
    if (titleEl && obj.title) titleEl.textContent = obj.title;
    if (subEl && obj.subtitle) subEl.textContent = obj.subtitle;
    if (headEl && obj.headline) headEl.textContent = obj.headline;
  };

  applyTitle('services', settings.services);
  applyTitle('projects', settings.projects);
  applyTitle('features', settings.features);
  applyTitle('offer', settings.offer);
  applyTitle('blog', settings.blog);
  applyTitle('faqs', settings.faqs);
  applyTitle('team', settings.team);

  // 2) Collections: sliders, services, projects, features, offers, blogs, faqs, team
  const safeFetch = async (url) => {
    try {
      const r = await fetch(url);
      if (!r.ok) return [];
      return await r.json();
    } catch { return []; }
  };

 
 // SLIDERS (accept dual schema)
const slidersData = await safeFetch('/api/sliders');
const sliders = (Array.isArray(slidersData) ? slidersData : [])
  .map(s => ({
      kicker:   s.kicker ?? s.smallTitle ?? '',
      headline: s.headline ?? s.bigTitle ?? '',
      text:     s.text ?? s.paragraph ?? '',
      cta1: {
        label: s.cta1?.label ?? s.primaryBtnText ?? '',
        href:  s.cta1?.href  ?? s.primaryBtnLink ?? ''
      },
      cta2: {
        label: s.cta2?.label ?? s.secondaryBtnText ?? '',
        href:  s.cta2?.href  ?? s.secondaryBtnLink ?? ''
      },
      image:    s.image ?? s.imageUrl ?? '',
      order:    s.order ?? 0
    }))
    .sort((a,b) => a.order - b.order);

  const heroTrack = qs('[data-hero-track]');
  if (heroTrack) {
    heroTrack.innerHTML = sliders.map(sl => html`
      <div class="hero-slide">
        <img class="hero-bg" src="${sl.image}" alt="">
        <div class="hero-inner">
          ${sl.kicker ? `<div class="kicker">${sl.kicker}</div>` : ''}
          ${sl.headline ? `<h1 class="headline">${sl.headline}</h1>` : ''}
          ${sl.text ? `<p class="text">${sl.text}</p>` : ''}
          <div class="cta-row">
            ${sl.cta1?.label && sl.cta1?.href ? `<a class="btn btn-primary" href="${sl.cta1.href}">${sl.cta1.label}</a>`:''}
            ${sl.cta2?.label && sl.cta2?.href ? `<a class="btn btn-outline" href="${sl.cta2.href}">${sl.cta2.label}</a>`:''}
          </div>
        </div>
      </div>
    `).join('');
  }

  // SERVICES
  const services = await safeFetch('/api/services');
  const servicesWrap = qs('[data-services-list]');
  if (servicesWrap) {
    servicesWrap.innerHTML = services.map(s => html`
      <div class="service-card">
        ${s.image?`<img src="${s.image}" alt="">`:''}
        <h3>${s.title||''}</h3>
        ${s.description?`<p>${s.description}</p>`:''}
        ${s.link?`<a class="more" href="${s.link}">Learn more</a>`:''}
      </div>
    `).join('');
  }

  // PROJECTS/PORTFOLIO
  const projects = await safeFetch('/api/projects');
  const projWrap = qs('[data-projects-list]');
  if (projWrap) {
    projWrap.innerHTML = projects.map(p => html`
      <div class="project-card">
        ${p.image?`<img src="${p.image}" alt="">`:''}
        <h4>${p.title||''}</h4>
        ${p.category?`<div class="muted">${p.category}</div>`:''}
        ${p.description?`<p>${p.description}</p>`:''}
        ${p.link?`<a class="more" href="${p.link}">View project</a>`:''}
      </div>
    `).join('');
  }

  // FEATURES
  const features = await safeFetch('/api/features');
  const featWrap = qs('[data-features-list]');
  if (featWrap) {
    featWrap.innerHTML = features.map(f => html`
      <div class="feature-item">
        ${f.icon?`<i class="${f.icon}"></i>`:''}
        <div>
          <h5>${f.title||''}</h5>
          ${f.subtitle?`<div class="muted">${f.subtitle}</div>`:''}
          ${f.description?`<p>${f.description}</p>`:''}
        </div>
      </div>
    `).join('');
  }

  // OFFERS
  const offers = await safeFetch('/api/offers');
  const offerWrap = qs('[data-offers-list]');
  if (offerWrap) {
    offerWrap.innerHTML = offers.map(o => html`
      <div class="offer-card">
        ${o.image?`<img src="${o.image}" alt="">`:''}
        <h4>${o.title||''}</h4>
        ${o.description?`<p>${o.description}</p>`:''}
      </div>
    `).join('');
  }

  // BLOGS (use settings.blog.showCount if present)
  const blogs = await safeFetch('/api/blogs');
  const showCount = Number(settings?.blog?.showCount || 0);
  const blogList = showCount ? blogs.slice(0, showCount) : blogs;
  const blogWrap = qs('[data-blogs-list]');
  if (blogWrap) {
    blogWrap.innerHTML = blogList.map(b => html`
      <article class="blog-card">
        ${b.image?`<img src="${b.image}" alt="">`:''}
        <h4>${b.title||''}</h4>
        ${b.excerpt?`<p>${b.excerpt}</p>`:''}
        <a class="more" href="/blog/${b.slug || b._id}">Read more</a>
      </article>
    `).join('');
  }

  // FAQS
  const faqs = await safeFetch('/api/faqs');
  const faqWrap = qs('[data-faqs-list]');
  if (faqWrap) {
    faqWrap.innerHTML = faqs.map(f => html`
      <div class="faq-item">
        <h6>${f.question||''}</h6>
        <p>${f.answer||''}</p>
      </div>
    `).join('');
  }
  const faqImg = qs('[data-faqs-image]');
  if (faqImg && settings?.faqs?.image) faqImg.src = settings.faqs.image;

  // TEAM
  const team = await safeFetch('/api/team');
  const teamWrap = qs('[data-team-list]');
  if (teamWrap) {
    teamWrap.innerHTML = team.map(m => html`
      <div class="team-card">
        ${m.image?`<img src="${m.image}" alt="">`:''}
        <h5>${m.name||''}</h5>
        <div class="muted">${m.role||''}</div>
        <div class="socials">
          ${m.facebook?`<a href="${m.facebook}" target="_blank">FB</a>`:''}
          ${m.twitter?`<a href="${m.twitter}" target="_blank">TW</a>`:''}
          ${m.linkedin?`<a href="${m.linkedin}" target="_blank">IN</a>`:''}
        </div>
      </div>
    `).join('');
  }
})();
