<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>NARAP Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <style>
    :root{ --brand:#0a7f41; }
    body { background:#f7f8fa }
    .nav-pills .nav-link.active{ background:var(--brand) }
    .btn-brand { background:var(--brand); color:#fff }
    .btn-brand:hover { filter:brightness(0.95) }
    .card{ border-radius:14px; box-shadow:0 6px 18px rgba(0,0,0,.06) }
    .img-thumb{ width:84px; height:56px; object-fit:cover; border-radius:8px; border:1px solid #e5e7eb }
    .sticky-actions{ position:sticky; bottom:0; background:#fff; padding:12px 0; border-top:1px solid #eee }
    .req::after { content:" *"; color:#e11d48; font-weight:600 }
    .table td, .table th { vertical-align: middle; }
    .shadow-sm-soft{ box-shadow:0 10px 28px rgba(10,127,65,.08) }
  </style>
</head>
<body>
<div class="container py-4">
  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 m-0">Admin Dashboard</h1>
    <div>
      <button class="btn btn-outline-secondary btn-sm" id="logoutBtn" type="button">Logout</button>
    </div>
  </div>

  <!-- Tabs -->
  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation"><button class="nav-link active" id="tab-home-settings" data-bs-toggle="pill" data-bs-target="#pane-home-settings" type="button" role="tab">Home Settings</button></li>
    <li class="nav-item" role="presentation"><button class="nav-link" id="tab-sliders" data-bs-toggle="pill" data-bs-target="#pane-sliders" type="button" role="tab">Sliders</button></li>
    <li class="nav-item" role="presentation"><button class="nav-link" id="tab-services" data-bs-toggle="pill" data-bs-target="#pane-services" type="button" role="tab">Services</button></li>
    <li class="nav-item" role="presentation"><button class="nav-link" id="tab-projects" data-bs-toggle="pill" data-bs-target="#pane-projects" type="button" role="tab">Projects</button></li>
    <li class="nav-item" role="presentation"><button class="nav-link" id="tab-features" data-bs-toggle="pill" data-bs-target="#pane-features" type="button" role="tab">Features</button></li>
    <li class="nav-item" role="presentation"><button class="nav-link" id="tab-offers" data-bs-toggle="pill" data-bs-target="#pane-offers" type="button" role="tab">Offers</button></li>
    <li class="nav-item" role="presentation"><button class="nav-link" id="tab-blogs" data-bs-toggle="pill" data-bs-target="#pane-blogs" type="button" role="tab">Blogs</button></li>
    <li class="nav-item" role="presentation"><button class="nav-link" id="tab-faqs" data-bs-toggle="pill" data-bs-target="#pane-faqs" type="button" role="tab">FAQs</button></li>
    <li class="nav-item" role="presentation"><button class="nav-link" id="tab-team" data-bs-toggle="pill" data-bs-target="#pane-team" type="button" role="tab">Team</button></li>
    <li class="nav-item" role="presentation"><button class="nav-link" id="tab-members-all" data-bs-toggle="pill" data-bs-target="#pane-members-all" type="button" role="tab">Registrations</button></li>
    <li class="nav-item" role="presentation"><button class="nav-link" id="tab-members-paid" data-bs-toggle="pill" data-bs-target="#pane-members-paid" type="button" role="tab">Paid Members</button></li>
    <li class="nav-item" role="presentation"><button class="nav-link" id="tab-members-unpaid" data-bs-toggle="pill" data-bs-target="#pane-members-unpaid" type="button" role="tab">Unpaid Members</button></li>
  </ul>

  <div class="tab-content" id="pills-tabContent">

    <!-- HOME SETTINGS -->
    <div class="tab-pane fade show active" id="pane-home-settings" role="tabpanel">
      <div class="card shadow-sm-soft mb-4">
        <div class="card-body">
          <h5 class="mb-3">About Section</h5>
          <form id="form-home-about" class="row g-3">
            <div class="col-md-6">
              <label class="form-label req">About Title</label>
              <input name="about.title" class="form-control" placeholder="About Us">
            </div>
            <div class="col-md-6">
              <label class="form-label req">About Headline</label>
              <input name="about.headline" class="form-control" placeholder="Keeping you Cool, in Every Step">
            </div>
            <div class="col-12">
              <label class="form-label">Paragraphs (one per line)</label>
              <textarea name="about.paragraphs" class="form-control" rows="4" placeholder="Line 1&#10;Line 2"></textarea>
              <div class="form-text text-muted">Each line becomes a paragraph on the homepage.</div>
            </div>
            <div class="col-md-6">
              <label class="form-label">About Image URL</label>
              <input name="about.image" class="form-control" placeholder="/uploads/about.jpg">
            </div>
            <div class="col-12 sticky-actions">
              <button class="btn btn-brand" type="submit">Save About</button>
              <small class="ms-2 text-muted" id="aboutStatus"></small>
            </div>
          </form>
        </div>
      </div>

      <div class="card shadow-sm-soft">
        <div class="card-body">
          <h5 class="mb-3">Section Titles & Subtitles</h5>
          <form id="form-home-sections" class="row g-3">
            <div class="col-md-4"><label class="form-label req">Services Title</label><input name="services.title" class="form-control" placeholder="What We Do"></div>
            <div class="col-md-8"><label class="form-label">Services Subtitle</label><input name="services.subtitle" class="form-control"></div>
            <div class="col-md-4"><label class="form-label req">Projects Title</label><input name="projects.title" class="form-control" placeholder="Our Projects"></div>
            <div class="col-md-8"><label class="form-label">Projects Subtitle</label><input name="projects.subtitle" class="form-control"></div>
            <div class="col-md-4"><label class="form-label req">Features Title</label><input name="features.title" class="form-control" placeholder="Why Choose Us"></div>
            <div class="col-md-8"><label class="form-label">Features Headline</label><input name="features.headline" class="form-control"></div>
            <div class="col-md-4"><label class="form-label">Offer Title</label><input name="offer.title" class="form-control"></div>
            <div class="col-md-4"><label class="form-label">Blog Title</label><input name="blog.title" class="form-control" placeholder="Our Blog & News"></div>
            <div class="col-md-4"><label class="form-label">Blog Show Count</label><input name="blog.showCount" type="number" min="1" max="12" class="form-control" placeholder="3"></div>
            <div class="col-md-4"><label class="form-label">FAQs Title</label><input name="faqs.title" class="form-control" placeholder="Frequently Asked Questions"></div>
            <div class="col-md-8"><label class="form-label">FAQs Side Image URL</label><input name="faqs.image" class="form-control" placeholder="/uploads/faqs.jpg"></div>
            <div class="col-md-4"><label class="form-label">Team Title</label><input name="team.title" class="form-control" placeholder="Meet Our Executive"></div>
            <div class="col-12 sticky-actions">
              <button class="btn btn-brand" type="submit">Save Sections</button>
              <small class="ms-2 text-muted" id="sectionsStatus"></small>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- SLIDERS -->
    <div class="tab-pane fade" id="pane-sliders" role="tabpanel">
      <div class="card mb-4"><div class="card-body">
        <h5 class="mb-3">Add / Edit Slider</h5>
        <form id="form-slider" class="row g-3">
          <input type="hidden" name="_id">
          <div class="col-md-4"><label class="form-label req">Kicker</label><input name="kicker" class="form-control" placeholder="Providing Comfort"></div>
          <div class="col-md-8"><label class="form-label req">Headline</label><input name="headline" class="form-control" placeholder="Across Sectors"></div>
          <div class="col-12"><label class="form-label">Text</label><textarea name="text" class="form-control" rows="3"></textarea></div>
          <div class="col-md-6"><label class="form-label">CTA1 Label</label><input name="cta1.label" class="form-control" placeholder="Watch Video"></div>
          <div class="col-md-6"><label class="form-label">CTA1 Href</label><input name="cta1.href" class="form-control" placeholder="#video"></div>
          <div class="col-md-6"><label class="form-label">CTA2 Label</label><input name="cta2.label" class="form-control" placeholder="Contact Us"></div>
          <div class="col-md-6"><label class="form-label">CTA2 Href</label><input name="cta2.href" class="form-control" placeholder="#contact"></div>
          <div class="col-md-8"><label class="form-label req">Image URL</label><input name="image" class="form-control" placeholder="/uploads/slider/slide1.jpg"></div>
          <div class="col-md-4"><label class="form-label">Order</label><input name="order" type="number" class="form-control" placeholder="1"></div>
          <div class="col-12 sticky-actions">
            <button class="btn btn-brand" type="submit">Save Slider</button>
            <button class="btn btn-outline-secondary" type="button" id="resetSliderForm">Reset</button>
            <small class="ms-2 text-muted" id="sliderStatus"></small>
          </div>
        </form>
      </div></div>
      <div class="card"><div class="card-body">
        <h5 class="mb-3">All Slides</h5>
        <div class="table-responsive">
          <table class="table align-middle">
            <thead><tr><th>#</th><th>Preview</th><th>Kicker</th><th>Headline</th><th>Buttons</th><th>Order</th><th></th></tr></thead>
            <tbody id="list-sliders"></tbody>
          </table>
        </div>
      </div></div>
    </div>

    <!-- SERVICES -->
    <div class="tab-pane fade" id="pane-services" role="tabpanel">
      <div class="card mb-4"><div class="card-body">
        <h5 class="mb-3">Service</h5>
        <form id="form-service" class="row g-3">
          <input type="hidden" name="_id">
          <div class="col-md-6"><label class="form-label req">Title</label><input name="title" class="form-control"></div>
          <div class="col-md-6"><label class="form-label">Image URL</label><input name="image" class="form-control" placeholder="/uploads/services/1.jpg"></div>
          <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
          <div class="col-md-6"><label class="form-label">Link (optional)</label><input name="link" class="form-control" placeholder="/services#install"></div>
          <div class="col-12 sticky-actions">
            <button class="btn btn-brand" type="submit">Save Service</button>
            <button class="btn btn-outline-secondary" type="button" data-reset="#form-service">Reset</button>
            <small class="ms-2 text-muted" id="serviceStatus"></small>
          </div>
        </form>
      </div></div>
      <div class="card"><div class="card-body">
        <h5 class="mb-3">All Services</h5>
        <div class="table-responsive">
          <table class="table align-middle"><thead><tr><th>#</th><th>Preview</th><th>Title</th><th>Description</th><th>Link</th><th></th></tr></thead><tbody id="list-services"></tbody></table>
        </div>
      </div></div>
    </div>

    <!-- PROJECTS -->
    <div class="tab-pane fade" id="pane-projects" role="tabpanel">
      <div class="card mb-4"><div class="card-body">
        <h5 class="mb-3">Project</h5>
        <form id="form-project" class="row g-3">
          <input type="hidden" name="_id">
          <div class="col-md-6"><label class="form-label req">Title</label><input name="title" class="form-control"></div>
          <div class="col-md-6"><label class="form-label">Category</label><input name="category" class="form-control" placeholder="HVAC"></div>
          <div class="col-md-6"><label class="form-label">Image URL</label><input name="image" class="form-control" placeholder="/uploads/projects/1.jpg"></div>
          <div class="col-md-6"><label class="form-label">Link</label><input name="link" class="form-control" placeholder="/projects/slug"></div>
          <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
          <div class="col-12 sticky-actions">
            <button class="btn btn-brand" type="submit">Save Project</button>
            <button class="btn btn-outline-secondary" type="button" data-reset="#form-project">Reset</button>
            <small class="ms-2 text-muted" id="projectStatus"></small>
          </div>
        </form>
      </div></div>
      <div class="card"><div class="card-body">
        <h5 class="mb-3">All Projects</h5>
        <div class="table-responsive">
          <table class="table align-middle"><thead><tr><th>#</th><th>Preview</th><th>Title</th><th>Category</th><th>Link</th><th></th></tr></thead><tbody id="list-projects"></tbody></table>
        </div>
      </div></div>
    </div>

    <!-- FEATURES -->
    <div class="tab-pane fade" id="pane-features" role="tabpanel">
      <div class="card mb-4"><div class="card-body">
        <h5 class="mb-3">Feature</h5>
        <form id="form-feature" class="row g-3">
          <input type="hidden" name="_id">
          <div class="col-md-6"><label class="form-label req">Title</label><input name="title" class="form-control"></div>
          <div class="col-md-6"><label class="form-label">Subtitle</label><input name="subtitle" class="form-control"></div>
          <div class="col-md-6"><label class="form-label">Icon (class or URL)</label><input name="icon" class="form-control" placeholder="fa-solid fa-snowflake"></div>
          <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
          <div class="col-12 sticky-actions">
            <button class="btn btn-brand" type="submit">Save Feature</button>
            <button class="btn btn-outline-secondary" type="button" data-reset="#form-feature">Reset</button>
            <small class="ms-2 text-muted" id="featureStatus"></small>
          </div>
        </form>
      </div></div>
      <div class="card"><div class="card-body">
        <h5 class="mb-3">All Features</h5>
        <div class="table-responsive">
          <table class="table align-middle"><thead><tr><th>#</th><th>Icon</th><th>Title</th><th>Subtitle</th><th></th></tr></thead><tbody id="list-features"></tbody></table>
        </div>
      </div></div>
    </div>

    <!-- OFFERS -->
    <div class="tab-pane fade" id="pane-offers" role="tabpanel">
      <div class="card mb-4"><div class="card-body">
        <h5 class="mb-3">Offer</h5>
        <form id="form-offer" class="row g-3">
          <input type="hidden" name="_id">
          <div class="col-md-6"><label class="form-label req">Title</label><input name="title" class="form-control"></div>
          <div class="col-md-6"><label class="form-label">Image URL</label><input name="image" class="form-control" placeholder="/uploads/offers/1.jpg"></div>
          <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
          <div class="col-12 sticky-actions">
            <button class="btn btn-brand" type="submit">Save Offer</button>
            <button class="btn btn-outline-secondary" type="button" data-reset="#form-offer">Reset</button>
            <small class="ms-2 text-muted" id="offerStatus"></small>
          </div>
        </form>
      </div></div>
      <div class="card"><div class="card-body">
        <h5 class="mb-3">All Offers</h5>
        <div class="table-responsive">
          <table class="table align-middle"><thead><tr><th>#</th><th>Preview</th><th>Title</th><th></th></tr></thead><tbody id="list-offers"></tbody></table>
        </div>
      </div></div>
    </div>

    <!-- BLOGS -->
    <div class="tab-pane fade" id="pane-blogs" role="tabpanel">
      <div class="card mb-4"><div class="card-body">
        <h5 class="mb-3">Blog</h5>
        <form id="form-blog" class="row g-3">
          <input type="hidden" name="_id">
          <div class="col-md-6"><label class="form-label req">Title</label><input name="title" class="form-control"></div>
          <div class="col-md-6"><label class="form-label">Slug</label><input name="slug" class="form-control" placeholder="auto-generated if blank"></div>
          <div class="col-12"><label class="form-label">Excerpt</label><textarea name="excerpt" class="form-control" rows="2"></textarea></div>
          <div class="col-12"><label class="form-label">Content (HTML or Markdown)</label><textarea name="content" class="form-control" rows="6"></textarea></div>
          <div class="col-md-6"><label class="form-label">Image URL</label><input name="image" class="form-control" placeholder="/uploads/blog/1.jpg"></div>
          <div class="col-12 sticky-actions">
            <button class="btn btn-brand" type="submit">Save Blog</button>
            <button class="btn btn-outline-secondary" type="button" data-reset="#form-blog">Reset</button>
            <small class="ms-2 text-muted" id="blogStatus"></small>
          </div>
        </form>
      </div></div>
      <div class="card"><div class="card-body">
        <h5 class="mb-3">All Blogs</h5>
        <div class="table-responsive">
          <table class="table align-middle"><thead><tr><th>#</th><th>Preview</th><th>Title</th><th>Slug</th><th></th></tr></thead><tbody id="list-blogs"></tbody></table>
        </div>
      </div></div>
    </div>

    <!-- FAQS -->
    <div class="tab-pane fade" id="pane-faqs" role="tabpanel">
      <div class="card mb-4"><div class="card-body">
        <h5 class="mb-3">FAQ</h5>
        <form id="form-faq" class="row g-3">
          <input type="hidden" name="_id">
          <div class="col-md-6"><label class="form-label req">Question</label><input name="question" class="form-control"></div>
          <div class="col-12"><label class="form-label req">Answer</label><textarea name="answer" class="form-control" rows="3"></textarea></div>
          <div class="col-12 sticky-actions">
            <button class="btn btn-brand" type="submit">Save FAQ</button>
            <button class="btn btn-outline-secondary" type="button" data-reset="#form-faq">Reset</button>
            <small class="ms-2 text-muted" id="faqStatus"></small>
          </div>
        </form>
      </div></div>
      <div class="card"><div class="card-body">
        <h5 class="mb-3">All FAQs</h5>
        <div class="table-responsive">
          <table class="table align-middle"><thead><tr><th>#</th><th>Question</th><th>Answer</th><th></th></tr></thead><tbody id="list-faqs"></tbody></table>
        </div>
      </div></div>
    </div>

    <!-- TEAM -->
    <div class="tab-pane fade" id="pane-team" role="tabpanel">
      <div class="card mb-4"><div class="card-body">
        <h5 class="mb-3">Team Member</h5>
        <form id="form-team" class="row g-3">
          <input type="hidden" name="_id">
          <div class="col-md-4"><label class="form-label req">Name</label><input name="name" class="form-control"></div>
          <div class="col-md-4"><label class="form-label req">Role</label><input name="role" class="form-control"></div>
          <div class="col-md-4"><label class="form-label">Image URL</label><input name="image" class="form-control" placeholder="/uploads/team/1.jpg"></div>
          <div class="col-md-4"><label class="form-label">Facebook</label><input name="facebook" class="form-control" placeholder="https://facebook.com/..."></div>
          <div class="col-md-4"><label class="form-label">Twitter</label><input name="twitter" class="form-control" placeholder="https://twitter.com/..."></div>
          <div class="col-md-4"><label class="form-label">LinkedIn</label><input name="linkedin" class="form-control" placeholder="https://linkedin.com/in/..."></div>
          <div class="col-12 sticky-actions">
            <button class="btn btn-brand" type="submit">Save Member</button>
            <button class="btn btn-outline-secondary" type="button" data-reset="#form-team">Reset</button>
            <small class="ms-2 text-muted" id="teamStatus"></small>
          </div>
        </form>
      </div></div>
      <div class="card"><div class="card-body">
        <h5 class="mb-3">All Team</h5>
        <div class="table-responsive">
          <table class="table align-middle"><thead><tr><th>#</th><th>Preview</th><th>Name</th><th>Role</th><th></th></tr></thead><tbody id="list-team"></tbody></table>
        </div>
      </div></div>
    </div>

    <!-- REGISTRATIONS (ALL MEMBERS) -->
    <div class="tab-pane fade" id="pane-members-all" role="tabpanel">
      <div class="card mb-3"><div class="card-body">
        <div class="row g-3 align-items-end">
          <div class="col-md-6">
            <label class="form-label">Search (name/email/member ID/state)</label>
            <input id="allSearch" class="form-control" placeholder="Search…">
          </div>
          <div class="col-md-6 text-md-end">
            <button class="btn btn-brand" id="btnReloadAll">Reload</button>
            <button class="btn btn-outline-secondary" id="btnExportAll">Export CSV</button>
          </div>
        </div>
        <small class="text-muted d-block mt-2">Shows everyone who completed signup and has a dashboard.</small>
      </div></div>
      <div class="card"><div class="card-body">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead>
              <tr><th>#</th><th>Name</th><th>Email</th><th>Member ID</th><th>State</th><th>Created</th></tr>
            </thead>
            <tbody id="list-members-all"></tbody>
          </table>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-2">
          <small class="text-muted" id="allCount"></small>
          <div class="btn-group">
            <button class="btn btn-sm btn-outline-secondary" id="allPrev">Prev</button>
            <button class="btn btn-sm btn-outline-secondary" id="allNext">Next</button>
          </div>
        </div>
      </div></div>
    </div>

    <!-- PAID MEMBERS -->
    <div class="tab-pane fade" id="pane-members-paid" role="tabpanel">
      <div class="card mb-3"><div class="card-body">
        <div class="row g-3 align-items-end">
          <div class="col-md-4">
            <label class="form-label">Search (name/email/member ID/state)</label>
            <input id="paidSearch" class="form-control" placeholder="Search…">
          </div>
          <div class="col-md-5">
            <label class="form-label">Count as "Paid" if…</label>
            <div class="d-flex gap-3 flex-wrap">
              <div class="form-check"><input class="form-check-input" type="checkbox" id="paidFeeMembership" checked><label class="form-check-label" for="paidFeeMembership">Membership fee</label></div>
              <div class="form-check"><input class="form-check-input" type="checkbox" id="paidFeeCertificate" checked><label class="form-check-label" for="paidFeeCertificate">Certificate</label></div>
              <div class="form-check"><input class="form-check-input" type="checkbox" id="paidFeeIdcard" checked><label class="form-check-label" for="paidFeeIdcard">ID card</label></div>
            </div>
            <div class="form-check mt-2">
              <input class="form-check-input" type="checkbox" id="paidLogicAll">
              <label class="form-check-label" for="paidLogicAll">Require <strong>all selected</strong> fees (unchecked = any one)</label>
            </div>
          </div>
          <div class="col-md-3 text-md-end">
            <button class="btn btn-brand" id="btnReloadPaid">Reload</button>
            <button class="btn btn-outline-secondary" id="btnExportPaid">Export CSV</button>
          </div>
        </div>
      </div></div>
      <div class="card"><div class="card-body">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Member ID</th><th>State</th><th>Paid</th></tr></thead>
            <tbody id="list-members-paid"></tbody>
          </table>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-2">
          <small class="text-muted" id="paidCount"></small>
          <div class="btn-group">
            <button class="btn btn-sm btn-outline-secondary" id="paidPrev">Prev</button>
            <button class="btn btn-sm btn-outline-secondary" id="paidNext">Next</button>
          </div>
        </div>
      </div></div>
    </div>

    <!-- UNPAID MEMBERS -->
    <div class="tab-pane fade" id="pane-members-unpaid" role="tabpanel">
      <div class="card mb-3"><div class="card-body">
        <div class="row g-3 align-items-end">
          <div class="col-md-6">
            <label class="form-label">Search (name/email/member ID/state)</label>
            <input id="unpaidSearch" class="form-control" placeholder="Search…">
          </div>
          <div class="col-md-6 text-md-end">
            <button class="btn btn-brand" id="btnReloadUnpaid">Reload</button>
            <button class="btn btn-outline-secondary" id="btnExportUnpaid">Export CSV</button>
          </div>
        </div>
        <small class="text-muted d-block mt-2">Shows users who completed signup (have dashboards) but have not paid membership, certificate, or ID card fees.</small>
      </div></div>
      <div class="card"><div class="card-body">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Member ID</th><th>State</th><th>Unpaid Fees</th></tr></thead>
            <tbody id="list-members-unpaid"></tbody>
          </table>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-2">
          <small class="text-muted" id="unpaidCount"></small>
          <div class="btn-group">
            <button class="btn btn-sm btn-outline-secondary" id="unpaidPrev">Prev</button>
            <button class="btn btn-sm btn-outline-secondary" id="unpaidNext">Next</button>
          </div>
        </div>
      </div></div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

// Basic authentication check
const token = localStorage.getItem('jwt');
if (!token) {
  window.location.replace('/admin/login.php');
}

// Define your API base URL
const API_BASE = '/api';

// Add this after API_BASE definition
async function authFetch(url, options = {}) {
  const token = localStorage.getItem('jwt');
  return fetch(url, {
    ...options,
    headers: {
      ...options.headers,
      'Authorization': `Bearer ${token}`
    }
  });
}

// Simple logout function
document.getElementById('logoutBtn')?.addEventListener('click', function() {
  localStorage.removeItem('jwt');
  localStorage.removeItem('token');
  window.location.replace('/index.php');
});

// ===== SAFE HELPERS =====
const PAGE_SIZE = window.PAGE_SIZE || 20;
let allPage = 1, paidPage = 1, unpaidPage = 1;
let currentAllData = [], currentPaidData = [], currentUnpaidData = [];

// Helper for JSON requests
const json = (opts = {}) => ({
  ...opts,
  headers: { 'Content-Type': 'application/json', ...(opts.headers || {}) }
});

// Defensive selector
const $ = (sel) => document.querySelector(sel);

// ===== LOADING INDICATORS =====
function showLoading(selector) {
  const element = $(selector);
  if (element) {
    element.innerHTML = '<tr><td colspan="10" class="text-center py-4"><div class="spinner-border spinner-border-sm text-brand" role="status"></div> Loading...</td></tr>';
  }
}

function showButtonLoading(button, text = 'Loading...') {
  if (!button) return;
  button.disabled = true;
  const originalHTML = button.innerHTML;
  button.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ${text}`;
  button.setAttribute('data-original-html', originalHTML);
}

function hideButtonLoading(button) {
  if (!button) return;
  button.disabled = false;
  const originalHTML = button.getAttribute('data-original-html');
  if (originalHTML) {
    button.innerHTML = originalHTML;
  }
}

// ===== CSV EXPORT FUNCTIONALITY =====
function convertToCSV(data, type) {
  if (!data.length) return '';
  
  const headers = [];
  const rows = [];
  
  switch(type) {
    case 'all':
      headers.push(['Name', 'Email', 'Member ID', 'State', 'LGA', 'Phone', 'Registration Date']);
      data.forEach(item => {
        const date = item?.createdAt ? new Date(item.createdAt).toLocaleDateString() : '';
        rows.push([
          `"${item?.name || ''}"`,
          `"${item?.email || ''}"`,
          `"${item?.memberId || item?.memberCode || ''}"`,
          `"${item?.state || ''}"`,
          `"${item?.lga || ''}"`,
          `"${item?.phone || ''}"`,
          `"${date}"`
        ]);
      });
      break;
      
    case 'paid':
      headers.push(['Name', 'Email', 'Member ID', 'State', 'Paid Fees', 'Membership Paid', 'Certificate Paid', 'ID Card Paid']);
      data.forEach(item => {
        const flags = summarizePaidFlags(item);
        const paidList = [flags.membership ? 'Membership' : '', flags.certificate ? 'Certificate' : '', flags.idcard ? 'ID Card' : '']
          .filter(Boolean).join('; ');
        rows.push([
          `"${item?.name || ''}"`,
          `"${item?.email || ''}"`,
          `"${item?.memberId || item?.memberCode || ''}"`,
          `"${item?.state || ''}"`,
          `"${paidList}"`,
          `"${flags.membership ? 'Yes' : 'No'}"`,
          `"${flags.certificate ? 'Yes' : 'No'}"`,
          `"${flags.idcard ? 'Yes' : 'No'}"`
        ]);
      });
      break;
      
    case 'unpaid':
      headers.push(['Name', 'Email', 'Member ID', 'State', 'Unpaid Fees', 'Membership Due', 'Certificate Due', 'ID Card Due']);
      data.forEach(item => {
        const missing = unpaidListFromFlags(summarizePaidFlags(item));
        const flags = summarizePaidFlags(item);
        rows.push([
          `"${item?.name || ''}"`,
          `"${item?.email || ''}"`,
          `"${item?.memberId || item?.memberCode || ''}"`,
          `"${item?.state || ''}"`,
          `"${missing}"`,
          `"${flags.membership ? 'Paid' : 'Due'}"`,
          `"${flags.certificate ? 'Paid' : 'Due'}"`,
          `"${flags.idcard ? 'Paid' : 'Due'}"`
        ]);
      });
      break;
  }
  
  return [...headers, ...rows].map(row => row.join(',')).join('\n');
}

function downloadCSV(csv, filename) {
  const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
  const link = document.createElement('a');
  const url = URL.createObjectURL(blob);
  link.setAttribute('href', url);
  link.setAttribute('download', filename);
  link.style.visibility = 'hidden';
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

// ===== SEARCH AND FILTER FUNCTIONALITY =====
function filterMembers(data, searchTerm, type = 'all') {
  if (!searchTerm) return data;
  
  const term = searchTerm.toLowerCase();
  return data.filter(item => {
    const name = (item?.name || '').toLowerCase();
    const email = (item?.email || '').toLowerCase();
    const memberId = (item?.memberId || item?.memberCode || '').toLowerCase();
    const state = (item?.state || '').toLowerCase();
    const lga = (item?.lga || '').toLowerCase();
    
    return name.includes(term) || 
           email.includes(term) || 
           memberId.includes(term) || 
           state.includes(term) ||
           lga.includes(term);
  });
}

function filterPaidMembers(data, requireAll) {
  const membershipChecked = $('#paidFeeMembership')?.checked ?? true;
  const certificateChecked = $('#paidFeeCertificate')?.checked ?? true;
  const idcardChecked = $('#paidFeeIdcard')?.checked ?? true;
  
  return data.filter(item => {
    const flags = summarizePaidFlags(item);
    const conditions = [];
    
    if (membershipChecked) conditions.push(flags.membership);
    if (certificateChecked) conditions.push(flags.certificate);
    if (idcardChecked) conditions.push(flags.idcard);
    
    if (requireAll) {
      return conditions.every(condition => condition);
    } else {
      return conditions.some(condition => condition);
    }
  });
}

// ===== UPDATED MEMBERS LOADING WITH ALL FEATURES =====
async function loadMembersSimple(type) {
  try {
    let endpoint = '';
    switch(type) {
      case 'all': endpoint = `${API_BASE}/members`; break;
      case 'paid': endpoint = `${API_BASE}/members/paid`; break;
      case 'unpaid': endpoint = `${API_BASE}/members/unpaid`; break;
    }

    console.log(`Loading ${type} members from:`, endpoint);
    
    // Show loading indicator
    showLoading(`#list-members-${type}`);
    
    const res = await authFetch(endpoint);
    
    if (!res.ok) throw new Error(`HTTP ${res.status}: ${res.statusText}`);
    
    const items = await res.json();
    console.log(`Loaded ${items?.length || 0} ${type} members:`, items);
    
    // Store the data for filtering/export
    switch(type) {
      case 'all': currentAllData = items || []; break;
      case 'paid': currentPaidData = items || []; break;
      case 'unpaid': currentUnpaidData = items || []; break;
    }
    
    // Apply filters and render
    renderFilteredMembers(type);
    
  } catch (err) {
    console.error(`loadMembersSimple(${type}) error:`, err);
    const tbody = document.getElementById(`list-members-${type}`);
    if (tbody) {
      tbody.innerHTML = '<tr><td colspan="6" class="text-center text-danger py-4">Failed to load members</td></tr>';
    }
  }
}

function renderFilteredMembers(type) {
  let data = [];
  let searchTerm = '';
  let filteredData = [];
  
  switch(type) {
    case 'all':
      data = currentAllData;
      searchTerm = $('#allSearch')?.value || '';
      filteredData = filterMembers(data, searchTerm, 'all');
      break;
      
    case 'paid':
      data = currentPaidData;
      searchTerm = $('#paidSearch')?.value || '';
      const requireAll = $('#paidLogicAll')?.checked || false;
      let paidFiltered = filterMembers(data, searchTerm, 'paid');
      paidFiltered = filterPaidMembers(paidFiltered, requireAll);
      filteredData = paidFiltered;
      break;
      
    case 'unpaid':
      data = currentUnpaidData;
      searchTerm = $('#unpaidSearch')?.value || '';
      filteredData = filterMembers(data, searchTerm, 'unpaid');
      break;
  }
  
  const tbody = document.getElementById(`list-members-${type}`);
  const countEl = document.getElementById(`${type}Count`);
  
  if (!tbody) return;

  // Clear existing content
  tbody.innerHTML = '';

  if (!filteredData.length) {
    tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-4">No members found</td></tr>';
    if (countEl) countEl.textContent = '0 results';
    return;
  }

  // Render rows
  filteredData.forEach((item, i) => {
    const row = document.createElement('tr');
    
    if (type === 'all') {
      const created = item?.createdAt ? new Date(item.createdAt).toLocaleDateString() : '';
      row.innerHTML = `
        <td>${i + 1}</td>
        <td>${item?.name || ''}</td>
        <td>${item?.email || ''}</td>
        <td>${item?.memberId || item?.memberCode || ''}</td>
        <td>${item?.state || item?.lga || ''}</td>
        <td>${created}</td>
      `;
    } 
    else if (type === 'paid') {
      const flags = summarizePaidFlags(item);
      const paidList = [flags.membership ? 'Membership' : '', flags.certificate ? 'Certificate' : '', flags.idcard ? 'ID Card' : '']
        .filter(Boolean).join(' / ');
      row.innerHTML = `
        <td>${i + 1}</td>
        <td>${item?.name || ''}</td>
        <td>${item?.email || ''}</td>
        <td>${item?.memberId || item?.memberCode || ''}</td>
        <td>${item?.state || item?.lga || ''}</td>
        <td>${paidList || '-'}</td>
      `;
    }
    else if (type === 'unpaid') {
      const missing = unpaidListFromFlags(summarizePaidFlags(item));
      row.innerHTML = `
        <td>${i + 1}</td>
        <td>${item?.name || ''}</td>
        <td>${item?.email || ''}</td>
        <td>${item?.memberId || item?.memberCode || ''}</td>
        <td>${item?.state || item?.lga || ''}</td>
        <td>${missing || 'All paid'}</td>
      `;
    }
    
    tbody.appendChild(row);
  });

  if (countEl) countEl.textContent = `${filteredData.length} result(s)`;
}

// ===== EXPORT HANDLERS =====
async function handleExport(type) {
  try {
    const button = $(`#btnExport${type.charAt(0).toUpperCase() + type.slice(1)}`);
    showButtonLoading(button, 'Exporting...');
    
    // Get current filtered data for export
    let dataToExport = [];
    switch(type) {
      case 'all': dataToExport = filterMembers(currentAllData, $('#allSearch')?.value || '', 'all'); break;
      case 'paid': 
        let paidData = filterMembers(currentPaidData, $('#paidSearch')?.value || '', 'paid');
        const requireAll = $('#paidLogicAll')?.checked || false;
        dataToExport = filterPaidMembers(paidData, requireAll);
        break;
      case 'unpaid': dataToExport = filterMembers(currentUnpaidData, $('#unpaidSearch')?.value || '', 'unpaid'); break;
    }
    
    const csv = convertToCSV(dataToExport, type);
    const filename = `${type}-members-${new Date().toISOString().split('T')[0]}.csv`;
    
    downloadCSV(csv, filename);
    
    setTimeout(() => hideButtonLoading(button), 1000);
    
  } catch (err) {
    console.error(`Export ${type} error:`, err);
    const button = $(`#btnExport${type.charAt(0).toUpperCase() + type.slice(1)}`);
    hideButtonLoading(button);
    alert('Export failed. Please try again.');
  }
}

// ===== MISSING FUNCTIONALITY IMPLEMENTATION =====

// 1. Form reset buttons for all forms
function setupFormResetButtons() {
  document.querySelectorAll('[data-reset]').forEach(btn => {
    btn.addEventListener('click', function() {
      const formSelector = this.getAttribute('data-reset');
      resetForm(formSelector);
      
      // Show feedback
      const form = document.querySelector(formSelector);
      const statusElement = form?.querySelector('.text-muted');
      if (statusElement) {
        statusElement.textContent = 'Form reset.';
        setTimeout(() => statusElement.textContent = '', 2000);
      }
    });
  });
}

// 2. Auto-slug generation for blogs
function setupAutoSlugGeneration() {
  const titleField = document.querySelector('#form-blog [name="title"]');
  const slugField = document.querySelector('#form-blog [name="slug"]');
  
  if (titleField && slugField) {
    titleField.addEventListener('blur', function() {
      // Only auto-generate if slug is empty and title has value
      if (!slugField.value && titleField.value) {
        const slug = titleField.value
          .toLowerCase()
          .replace(/[^a-z0-9 -]/g, '') // Remove invalid chars
          .replace(/\s+/g, '-')        // Replace spaces with -
          .replace(/-+/g, '-')         // Replace multiple - with single -
          .trim();
        slugField.value = slug;
        
        // Show feedback
        const statusElement = document.querySelector('#blogStatus');
        if (statusElement) {
          statusElement.textContent = 'Slug auto-generated.';
          setTimeout(() => statusElement.textContent = '', 2000);
        }
      }
    });
  }
}

// 3. Enhanced form submission feedback
function enhanceFormSubmissions() {
  // Add loading states to all form submit buttons
  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
      const submitBtn = this.querySelector('button[type="submit"]');
      if (submitBtn) {
        showButtonLoading(submitBtn, 'Saving...');
        
        // Re-enable button after 5 seconds (safety net)
        setTimeout(() => hideButtonLoading(submitBtn), 5000);
      }
    });
  });
}

// ===== EVENT LISTENERS FOR ALL FEATURES =====
document.addEventListener('DOMContentLoaded', function() {
  // Search functionality
  $('#allSearch')?.addEventListener('input', () => renderFilteredMembers('all'));
  $('#paidSearch')?.addEventListener('input', () => renderFilteredMembers('paid'));
  $('#unpaidSearch')?.addEventListener('input', () => renderFilteredMembers('unpaid'));
  
  // Paid member filter options
  $('#paidFeeMembership')?.addEventListener('change', () => renderFilteredMembers('paid'));
  $('#paidFeeCertificate')?.addEventListener('change', () => renderFilteredMembers('paid'));
  $('#paidFeeIdcard')?.addEventListener('change', () => renderFilteredMembers('paid'));
  $('#paidLogicAll')?.addEventListener('change', () => renderFilteredMembers('paid'));
  
  // Export functionality
  $('#btnExportAll')?.addEventListener('click', () => handleExport('all'));
  $('#btnExportPaid')?.addEventListener('click', () => handleExport('paid'));
  $('#btnExportUnpaid')?.addEventListener('click', () => handleExport('unpaid'));
  
  // Reload buttons with loading states
  $('#btnReloadAll')?.addEventListener('click', async () => {
    showButtonLoading($('#btnReloadAll'), 'Reloading...');
    await loadMembersSimple('all');
    hideButtonLoading($('#btnReloadAll'));
  });
  
  $('#btnReloadPaid')?.addEventListener('click', async () => {
    showButtonLoading($('#btnReloadPaid'), 'Reloading...');
    await loadMembersSimple('paid');
    hideButtonLoading($('#btnReloadPaid'));
  });
  
  $('#btnReloadUnpaid')?.addEventListener('click', async () => {
    showButtonLoading($('#btnReloadUnpaid'), 'Reloading...');
    await loadMembersSimple('unpaid');
    hideButtonLoading($('#btnReloadUnpaid'));
  });
  
  // Setup missing functionality
  setupFormResetButtons();
  setupAutoSlugGeneration();
  enhanceFormSubmissions();
});

// ===== HOME SETTINGS =====
async function loadHomeSettings() {
  try {
    const res = await authFetch(`${API_BASE}/settings/home`);
    if (!res?.ok) return;

    const data = await res.json();

    const set = (name, val) => {
      const el = document.querySelector(`[name="${name}"]`);
      if (!el) return;
      el.value = (val ?? '') + '';
    };

    set('about.title', data?.about?.title);
    set('about.headline', data?.about?.headline);
    set('about.paragraphs',
      Array.isArray(data?.about?.paragraphs)
        ? data.about.paragraphs.join('\n')
        : (data?.about?.paragraphs || '')
    );
    set('about.image', data?.about?.image);

    const pairs = [
      ['services', 'title'], ['services', 'subtitle'],
      ['projects', 'title'], ['projects', 'subtitle'],
      ['features', 'title'], ['features', 'headline'],
      ['offer', 'title'],
      ['blog', 'title'], ['blog', 'showCount'],
      ['faqs', 'title'], ['faqs', 'image'],
      ['team', 'title']
    ];

    pairs.forEach(([k1, k2]) => {
      const el = document.querySelector(`[name="${k1}.${k2}"]`);
      if (!el) return;
      const v = data?.[k1]?.[k2];
      el.value = (v ?? '') + '';
    });
  } catch (e) {
    console.error('loadHomeSettings error:', e);
  }
}

$('#form-home-about')?.addEventListener('submit', async (e) => {
  e.preventDefault();
  try {
    const fd = new FormData(e.target);
    const payload = {
      about: {
        title: fd.get('about.title') || '',
        headline: fd.get('about.headline') || '',
        paragraphs: (fd.get('about.paragraphs') || '')
          .replace(/\r\n/g, '\n')
          .split('\n')
          .map(s => s.trim())
          .filter(Boolean),
        image: fd.get('about.image') || ''
      }
    };
    const res = await authFetch(`${API_BASE}/settings/home`, json({ method: 'PUT', body: JSON.stringify(payload) }));
    $('#aboutStatus') && ($('#aboutStatus').textContent = res.ok ? 'Saved.' : 'Failed.');
    if (res.ok) loadHomeSettings();
  } catch (err) {
    console.error('About save error:', err);
    $('#aboutStatus') && ($('#aboutStatus').textContent = 'Failed.');
  }
});

$('#form-home-sections')?.addEventListener('submit', async (e) => {
  e.preventDefault();
  try {
    const fd = new FormData(e.target);
    const payload = {
      services: { title: fd.get('services.title') || '', subtitle: fd.get('services.subtitle') || '' },
      projects: { title: fd.get('projects.title') || '', subtitle: fd.get('projects.subtitle') || '' },
      features: { title: fd.get('features.title') || '', headline: fd.get('features.headline') || '' },
      offer: { title: fd.get('offer.title') || '' },
      blog: { title: fd.get('blog.title') || '', showCount: Number(fd.get('blog.showCount') || 3) || 3 },
      faqs: { title: fd.get('faqs.title') || '', image: fd.get('faqs.image') || '' },
      team: { title: fd.get('team.title') || '' }
    };
    const res = await authFetch(`${API_BASE}/settings/home`, json({ method: 'PUT', body: JSON.stringify(payload) }));
    $('#sectionsStatus') && ($('#sectionsStatus').textContent = res.ok ? 'Saved.' : 'Failed.');
    if (res.ok) loadHomeSettings();
  } catch (err) {
    console.error('Sections save error:', err);
    $('#sectionsStatus') && ($('#sectionsStatus').textContent = 'Failed.');
  }
});

// ===== GENERIC CRUD (content sections) =====
const resources = {
  sliders: {
    endpoint: '/sliders', listEl: '#list-sliders', form: '#form-slider', status: '#sliderStatus',
    toPayload: (fd) => {
      const kicker = fd.get('kicker') || '';
      const headline = fd.get('headline') || '';
      const text = fd.get('text') || '';
      const c1Label = fd.get('cta1.label') || '';
      const c1Href = fd.get('cta1.href') || '';
      const c2Label = fd.get('cta2.label') || '';
      const c2Href = fd.get('cta2.href') || '';
      const image = fd.get('image') || '';
      const order = Number(fd.get('order') || 0) || 0;
      return {
        kicker, headline, text,
        cta1: c1Label || c1Href ? { label: c1Label, href: c1Href } : undefined,
        cta2: c2Label || c2Href ? { label: c2Label, href: c2Href } : undefined,
        image,
        order,
        smallTitle: kicker, bigTitle: headline, paragraph: text,
        primaryBtnText: c1Label, primaryBtnLink: c1Href, secondaryBtnText: c2Label, secondaryBtnLink: c2Href,
        imageUrl: image
      };
    },
    renderRow: (item, i) => {
      const img = item.image || item.imageUrl || '';
      const kick = item.kicker || item.smallTitle || '';
      const head = item.headline || item.bigTitle || '';
      const c1 = (item.cta1 && item.cta1.label) || item.primaryBtnText || '';
      const c2 = (item.cta2 && item.cta2.label) || item.secondaryBtnText || '';
      const ord = (item.order ?? '') + '';
      return `<tr>
        <td>${i + 1}</td>
        <td>${img ? `<img class="img-thumb" src="${img}">` : ''}</td>
        <td>${kick}</td>
        <td>${head}</td>
        <td>${[c1, c2].filter(Boolean).join(' / ')}</td>
        <td>${ord}</td>
        <td class="text-end">
          <button class="btn btn-sm btn-outline-primary" data-edit="sliders" data-id="${item._id}">Edit</button>
          <button class="btn btn-sm btn-outline-danger" data-del="sliders" data-id="${item._id}">Delete</button>
        </td>
      </tr>`;
    }
  },
  services: {
    endpoint: '/services', listEl: '#list-services', form: '#form-service', status: '#serviceStatus',
    toPayload: (fd) => ({ title: fd.get('title') || '', description: fd.get('description') || '', image: fd.get('image') || '', link: fd.get('link') || '' }),
    renderRow: (item, i) => `<tr><td>${i + 1}</td><td>${item.image ? '<img class="img-thumb" src="' + item.image + '">' : ''}</td><td>${item.title || ''}</td><td>${item.description || ''}</td><td>${item.link || ''}</td>
    <td class="text-end"><button class="btn btn-sm btn-outline-primary" data-edit="services" data-id="${item._id}">Edit</button>
    <button class="btn btn-sm btn-outline-danger" data-del="services" data-id="${item._id}">Delete</button></td></tr>`
  },
  projects: {
    endpoint: '/projects', listEl: '#list-projects', form: '#form-project', status: '#projectStatus',
    toPayload: (fd) => ({ title: fd.get('title') || '', category: fd.get('category') || '', description: fd.get('description') || '', image: fd.get('image') || '', link: fd.get('link') || '' }),
    renderRow: (item, i) => `<tr><td>${i + 1}</td><td>${item.image ? '<img class="img-thumb" src="' + item.image + '">' : ''}</td><td>${item.title || ''}</td><td>${item.category || ''}</td><td>${item.link || ''}</td>
    <td class="text-end"><button class="btn btn-sm btn-outline-primary" data-edit="projects" data-id="${item._id}">Edit</button>
    <button class="btn btn-sm btn-outline-danger" data-del="projects" data-id="${item._id}">Delete</button></td></tr>`
  },
  features: {
    endpoint: '/features', listEl: '#list-features', form: '#form-feature', status: '#featureStatus',
    toPayload: (fd) => ({ title: fd.get('title') || '', subtitle: fd.get('subtitle') || '', description: fd.get('description') || '', icon: fd.get('icon') || '' }),
    renderRow: (item, i) => `<tr><td>${i + 1}</td><td>${item.icon || ''}</td><td>${item.title || ''}</td><td>${item.subtitle || ''}</td>
    <td class="text-end"><button class="btn btn-sm btn-outline-primary" data-edit="features" data-id="${item._id}">Edit</button>
    <button class="btn btn-sm btn-outline-danger" data-del="features" data-id="${item._id}">Delete</button></td></tr>`
  },
  offers: {
    endpoint: '/offers', listEl: '#list-offers', form: '#form-offer', status: '#offerStatus',
    toPayload: (fd) => ({ title: fd.get('title') || '', description: fd.get('description') || '', image: fd.get('image') || '' }),
    renderRow: (item, i) => `<tr><td>${i + 1}</td><td>${item.image ? '<img class="img-thumb" src="' + item.image + '">' : ''}</td><td>${item.title || ''}</td>
    <td class="text-end"><button class="btn btn-sm btn-outline-primary" data-edit="offers" data-id="${item._id}">Edit</button>
    <button class="btn btn-sm btn-outline-danger" data-del="offers" data-id="${item._id}">Delete</button></td></tr>`
  },
  blogs: {
    endpoint: '/blogs', listEl: '#list-blogs', form: '#form-blog', status: '#blogStatus',
    toPayload: (fd) => ({ title: fd.get('title') || '', slug: fd.get('slug') || '', excerpt: fd.get('excerpt') || '', content: fd.get('content') || '', image: fd.get('image') || '' }),
    renderRow: (item, i) => `<tr><td>${i + 1}</td><td>${item.image ? '<img class="img-thumb" src="' + item.image + '">' : ''}</td><td>${item.title || ''}</td><td>${item.slug || ''}</td>
    <td class="text-end"><button class="btn btn-sm btn-outline-primary" data-edit="blogs" data-id="${item._id}">Edit</button>
    <button class="btn btn-sm btn-outline-danger" data-del="blogs" data-id="${item._id}">Delete</button></td></tr>`
  },
  faqs: {
    endpoint: '/faqs', listEl: '#list-faqs', form: '#form-faq', status: '#faqStatus',
    toPayload: (fd) => ({ question: fd.get('question') || '', answer: fd.get('answer') || '' }),
    renderRow: (item, i) => `<tr><td>${i + 1}</td><td>${item.question || ''}</td><td>${item.answer || ''}</td>
    <td class="text-end"><button class="btn btn-sm btn-outline-primary" data-edit="faqs" data-id="${item._id}">Edit</button>
    <button class="btn btn-sm btn-outline-danger" data-del="faqs" data-id="${item._id}">Delete</button></td></tr>`
  },
  team: {
    endpoint: '/team', listEl: '#list-team', form: '#form-team', status: '#teamStatus',
    toPayload: (fd) => ({ name: fd.get('name') || '', role: fd.get('role') || '', image: fd.get('image') || '', facebook: fd.get('facebook') || '', twitter: fd.get('twitter') || '', linkedin: fd.get('linkedin') || '' }),
    renderRow: (item, i) => `<tr><td>${i + 1}</td><td>${item.image ? '<img class="img-thumb" src="' + item.image + '">' : ''}</td><td>${item.name || ''}</td><td>${item.role || ''}</td>
    <td class="text-end"><button class="btn btn-sm btn-outline-primary" data-edit="team" data-id="${item._id}">Edit</button>
    <button class="btn btn-sm btn-outline-danger" data-del="team" data-id="${item._id}">Delete</button></td></tr>`
  }
};

async function loadList(key) {
  try {
    const cfg = resources[key];
    if (!cfg) return;
    const res = await authFetch(`${API_BASE}${cfg.endpoint}`);
    if (!res?.ok) return;
    const items = await res.json();
    const html = (items || [])
      .slice()
      .sort((a, b) => (Number(a?.order ?? 0)) - (Number(b?.order ?? 0)))
      .map(cfg.renderRow)
      .join('');
    const container = document.querySelector(cfg.listEl);
    if (container) container.innerHTML = html;
  } catch (e) {
    console.error(`loadList(${key}) error:`, e);
  }
}

function resetForm(sel) {
  const f = document.querySelector(sel);
  if (!f) return;
  f.reset();
  const id = f.querySelector('[name="_id"]');
  if (id) id.value = '';
}

function fillFormFromItem(formSel, item) {
  const form = document.querySelector(formSel);
  if (!form || !item) return;

  Object.keys(item).forEach(k => {
    const el = form.querySelector(`[name="${k}"]`);
    if (el) el.value = (item[k] ?? '') + '';
  });

  const idEl = form.querySelector('[name="_id"]');
  if (idEl) idEl.value = item._id || '';

  if (formSel === '#form-slider') {
    const map = {
      'kicker': item.kicker ?? item.smallTitle ?? '',
      'headline': item.headline ?? item.bigTitle ?? '',
      'text': item.text ?? item.paragraph ?? '',
      'cta1.label': item.cta1?.label ?? item.primaryBtnText ?? '',
      'cta1.href': item.cta1?.href ?? item.primaryBtnLink ?? '',
      'cta2.label': item.cta2?.label ?? item.secondaryBtnText ?? '',
      'cta2.href': item.cta2?.href ?? item.secondaryBtnLink ?? '',
      'image': item.image ?? item.imageUrl ?? '',
      'order': item.order ?? 0
    };
    Object.entries(map).forEach(([name, val]) => {
      const el = form.querySelector(`[name="${name}"]`);
      if (el) el.value = (val ?? '') + '';
    });
  }
}

async function createOrUpdate(e, key) {
  e.preventDefault();
  try {
    const cfg = resources[key];
    if (!cfg) return;
    const fd = new FormData(e.target);
    const id = fd.get('_id');
    const method = id ? 'PUT' : 'POST';
    const url = id ? `${API_BASE}${cfg.endpoint}/${id}` : `${API_BASE}${cfg.endpoint}`;
    const payload = cfg.toPayload(fd);
    const res = await authFetch(url, json({ method, body: JSON.stringify(payload) }));
    document.querySelector(cfg.status) && (document.querySelector(cfg.status).textContent = res.ok ? 'Saved.' : 'Failed.');
    if (res.ok) { resetForm(cfg.form); loadList(key); }
  } catch (err) {
    console.error(`createOrUpdate ${key} error:`, err);
    document.querySelector(resources[key]?.status)?.textContent = 'Failed.';
  }
}

async function deleteItem(key, id) {
  try {
    if (!confirm('Delete this item?')) return;
    const cfg = resources[key];
    if (!cfg) return;
    const res = await authFetch(`${API_BASE}${cfg.endpoint}/${id}`, { method: 'DELETE' });
    if (res?.ok) loadList(key);
  } catch (err) {
    console.error(`deleteItem ${key} error:`, err);
  }
}

Object.keys(resources).forEach(key => {
  const formSel = resources[key].form;
  document.querySelector(formSel)?.addEventListener('submit', (e) => createOrUpdate(e, key));
});

document.body.addEventListener('click', async (e) => {
  const editBtn = e.target.closest?.('[data-edit]');
  const delBtn = e.target.closest?.('[data-del]');
  if (editBtn) {
    const key = editBtn.getAttribute('data-edit');
    const id = editBtn.getAttribute('data-id');
    const cfg = resources[key];
    if (!cfg) return;
    const res = await authFetch(`${API_BASE}${cfg.endpoint}/${id}`);
    if (!res?.ok) return;
    const item = await res.json();
    fillFormFromItem(cfg.form, item);
  }
  if (delBtn) {
    const key = delBtn.getAttribute('data-del');
    const id = delBtn.getAttribute('data-id');
    deleteItem(key, id);
  }
});

// ===== INITIAL LOADS =====
loadHomeSettings();
Object.keys(resources).forEach(loadList);
loadMembersSimple('all');
loadMembersSimple('paid');
loadMembersSimple('unpaid');

// ===== HELPER FUNCTIONS =====
function summarizePaidFlags(item) {
  const flags = {
    membership: item?.membershipPaid || false,
    certificate: item?.certificatePaid || false,
    idcard: item?.idCardPaid || false
  };
  
  // Check for alternative field names
  if (typeof item?.paidFlags === 'object') {
    flags.membership = flags.membership || item.paidFlags.membership || false;
    flags.certificate = flags.certificate || item.paidFlags.certificate || false;
    flags.idcard = flags.idcard || item.paidFlags.idcard || false;
  }
  
  return flags;
}

function unpaidListFromFlags(flags) {
  const unpaid = [];
  if (!flags.membership) unpaid.push('Membership');
  if (!flags.certificate) unpaid.push('Certificate');
  if (!flags.idcard) unpaid.push('ID Card');
  return unpaid.length ? unpaid.join(', ') : 'All paid';
}

</script>

</body>
</html>