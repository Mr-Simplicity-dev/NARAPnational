<?php
session_start();
$token = $_SESSION['token'] ?? '';
function h($s){return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8');}
?><!doctype html><html><head>
<meta charset="utf-8"/><meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Homepage Settings</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>body{padding:24px}.card{border-radius:16px;box-shadow:0 8px 24px rgba(0,0,0,.06)}</style>
</head><body><div class="container-lg">
<h1 class="mb-3">Homepage Settings</h1>
<p class="text-muted">These titles and the About section are stored in your server database and used by the homepage.</p>
<div id="alert" class="alert d-none" role="alert"></div>
<form id="settingsForm" class="mb-5" onsubmit="return false;">
<div class="card mb-4"><div class="card-header"><strong>About</strong></div><div class="card-body row g-3">
<div class="col-md-6"><label class="form-label">Title</label><input class="form-control" name="about.title"></div>
<div class="col-md-6"><label class="form-label">Headline</label><input class="form-control" name="about.headline"></div>
<div class="col-12"><label class="form-label">Paragraphs (one per line)</label><textarea class="form-control" rows="5" name="about.paragraphs"></textarea></div>
<div class="col-md-6"><label class="form-label">About Image URL</label><input class="form-control" name="about.image"></div>
</div></div>
<div class="card mb-4"><div class="card-header"><strong>Section Titles</strong></div><div class="card-body row g-3">
<div class="col-md-6"><label class="form-label">Services Title</label><input class="form-control" name="services.title"></div>
<div class="col-md-6"><label class="form-label">Services Subtitle</label><input class="form-control" name="services.subtitle"></div>
<div class="col-md-6"><label class="form-label">Projects Title</label><input class="form-control" name="projects.title"></div>
<div class="col-md-6"><label class="form-label">Projects Subtitle</label><input class="form-control" name="projects.subtitle"></div>
<div class="col-md-6"><label class="form-label">Features Title</label><input class="form-control" name="features.title"></div>
<div class="col-md-6"><label class="form-label">Features Headline</label><input class="form-control" name="features.headline"></div>
<div class="col-md-6"><label class="form-label">Offer Title</label><input class="form-control" name="offer.title"></div>
<div class="col-md-6"><label class="form-label">Blog Title</label><input class="form-control" name="blog.title"></div>
<div class="col-md-6"><label class="form-label">Blog Show Count</label><input class="form-control" type="number" min="1" max="12" name="blog.showCount"></div>
<div class="col-md-6"><label class="form-label">FAQs Title</label><input class="form-control" name="faqs.title"></div>
<div class="col-md-6"><label class="form-label">FAQs Side Image URL</label><input class="form-control" name="faqs.image"></div>
<div class="col-md-6"><label class="form-label">Team Title</label><input class="form-control" name="team.title"></div>
</div></div>
<div class="d-flex gap-3"><button id="saveBtn" class="btn btn-primary px-4">Save Settings</button>
<a class="btn btn-outline-secondary" href="/admin/home-config.php">Switch to JSON editor</a></div>
</form></div>
<script>
const token = <?php echo json_encode($token); ?>;
const $ = (s,r=document)=>r.querySelector(s);
const val = (name, v) => { const el = document.querySelector('[name="'+name+'"]'); if (el) el.value = v ?? ''; };
const get = (name) => { const el = document.querySelector('[name="'+name+'"]'); return el ? el.value : ''; };
async function loadSettings(){
  const r = await fetch('/api/settings/home', {cache:'no-store'});
  const data = r.ok ? await r.json() : {};
  val('about.title', data.about?.title); val('about.headline', data.about?.headline);
  val('about.paragraphs', Array.isArray(data.about?.paragraphs)? data.about.paragraphs.join('\n'): '');
  val('about.image', data.about?.image);
  val('services.title', data.services?.title); val('services.subtitle', data.services?.subtitle);
  val('projects.title', data.projects?.title); val('projects.subtitle', data.projects?.subtitle);
  val('features.title', data.features?.title); val('features.headline', data.features?.headline);
  val('offer.title', data.offer?.title);
  val('blog.title', data.blog?.title); val('blog.showCount', data.blog?.showCount);
  val('faqs.title', data.faqs?.title); val('faqs.image', data.faqs?.image);
  val('team.title', data.team?.title);
}
function gather(){
  return {
    about: { title: get('about.title'), headline: get('about.headline'),
      paragraphs: get('about.paragraphs').split(/\r?\n/).map(s=>s.trim()).filter(Boolean),
      image: get('about.image') },
    services: { title: get('services.title'), subtitle: get('services.subtitle') },
    projects: { title: get('projects.title'), subtitle: get('projects.subtitle') },
    features: { title: get('features.title'), headline: get('features.headline') },
    offer: { title: get('offer.title') },
    blog: { title: get('blog.title'), showCount: Number(get('blog.showCount')||3) },
    faqs: { title: get('faqs.title'), image: get('faqs.image') },
    team: { title: get('team.title') }
  };
}
async function save(){
  const data = gather();
  const r = await fetch('/api/settings/home', {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json', ...(token ? {'Authorization': 'Bearer '+token}:{}) },
    body: JSON.stringify(data)
  });
  const ok = r.ok; const a = document.getElementById('alert');
  a.className = 'alert ' + (ok? 'alert-success':'alert-danger');
  a.textContent = ok ? 'Saved settings!' : 'Failed to save settings';
  a.classList.remove('d-none');
}
document.getElementById('saveBtn').addEventListener('click', save);
loadSettings();
</script></body></html>
