<!doctype html>
<html lang="en">
<head>
  <link rel="icon" type="image/png" href="/uploads/slider/Narap.png"/>
   <meta charset="utf-8" />
  <title>NARAP Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  
  <!-- ADD THIS CSP META TAG -->
  <meta http-equiv="Content-Security-Policy" content="default-src 'self'; font-src 'self' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net data:; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com; script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; img-src 'self' data: https:; connect-src 'self'">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
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
    .image-upload-container { border: 2px dashed #dee2e6; border-radius: 8px; padding: 20px; text-align: center; background: #f8f9fa; }
    .image-preview { max-width: 200px; max-height: 150px; margin: 10px auto; display: none; }
    .upload-placeholder { color: #6c757d; }
    .notification { position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 300px; }
  
  .image-upload-container {
  cursor: pointer;
  position: relative;
}

.image-upload-container .btn {
  cursor: pointer;
  position: relative;
  z-index: 10;
}

  </style>
  <style>
/* Fix for FontAwesome icons */
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
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

  <!-- Notification Area -->
  <div id="notificationArea" class="notification"></div>

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
              <label class="form-label">About Image</label>
              <div class="image-upload-container" data-target="aboutImage">
                <div class="upload-placeholder">
                  <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                  <p>Click to upload or drag and drop</p>
                  <p class="small">PNG, JPG, GIF up to 5MB</p>
                </div>
                <img class="image-preview img-fluid rounded" id="aboutImagePreview">
                <input type="file" class="d-none" accept="image/*" id="aboutImageUpload">
                <input type="hidden" name="about.image" id="aboutImageUrl">
              </div>
              <div class="d-flex mt-2 gap-2">
                <!-- Choose Image buttons -->
<button type="button" class="btn btn-outline-primary btn-sm" data-action="choose-image" data-target="aboutImage">
  <i class="fas fa-upload me-1"></i> Choose Image
</button>

<button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="aboutImage">
  <i class="fas fa-times me-1"></i> Clear
</button>
              </div>
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
            <div class="col-md-8">
              <label class="form-label">FAQs Side Image</label>
              <div class="image-upload-container" data-target="faqsImage">
                <div class="upload-placeholder">
                  <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                  <p>Click to upload or drag and drop</p>
                  <p class="small">PNG, JPG, GIF up to 5MB</p>
                </div>
                <img class="image-preview img-fluid rounded" id="faqsImagePreview">
                <input type="file" class="d-none" accept="image/*" id="faqsImageUpload">
                <input type="hidden" name="faqs.image" id="faqsImageUrl">
              </div>
              <div class="d-flex mt-2 gap-2">
               <!-- Choose Image buttons -->
<button type="button" class="btn btn-outline-primary btn-sm" data-action="choose-image" data-target="faqsImage">
  <i class="fas fa-upload me-1"></i> Choose Image
</button>

<button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="faqsImage">
  <i class="fas fa-times me-1"></i> Clear
</button>
              </div>
            </div>
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
          <div class="col-md-8">
            <label class="form-label req">Slider Image</label>
            <div class="image-upload-container" data-target="sliderImage">
              <div class="upload-placeholder">
                <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                <p>Click to upload or drag and drop</p>
                <p class="small">PNG, JPG, GIF up to 5MB</p>
              </div>
              <img class="image-preview img-fluid rounded" id="sliderImagePreview">
              <input type="file" class="d-none" accept="image/*" id="sliderImageUpload">
              <input type="hidden" name="image" id="sliderImageUrl">
            </div>
            <div class="d-flex mt-2 gap-2">
             <!-- Choose Image buttons -->
<button type="button" class="btn btn-outline-primary btn-sm" data-action="choose-image" data-target="sliderImage">
  <i class="fas fa-upload me-1"></i> Choose Image
</button>

<button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="sliderImage">
  <i class="fas fa-times me-1"></i> Clear
</button>
            </div>
          </div>
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
          <div class="col-md-6">
            <label class="form-label">Service Image</label>
            <div class="image-upload-container" data-target="serviceImage">
              <div class="upload-placeholder">
                <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                <p>Click to upload or drag and drop</p>
                <p class="small">PNG, JPG, GIF up to 5MB</p>
              </div>
              <img class="image-preview img-fluid rounded" id="serviceImagePreview">
              <input type="file" class="d-none" accept="image/*" id="serviceImageUpload">
              <input type="hidden" name="image" id="serviceImageUrl">
            </div>
            <div class="d-flex mt-2 gap-2">
              <button type="button" class="btn btn-outline-primary btn-sm" data-action="choose-image" data-target="serviceImage">
  <i class="fas fa-upload me-1"></i> Choose Image
</button>

<button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="serviceImage">
  <i class="fas fa-times me-1"></i> Clear
</button>
            </div>
          </div>
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
          <div class="col-md-6">
            <label class="form-label">Project Image</label>
            <div class="image-upload-container" data-target="projectImage">
              <div class="upload-placeholder">
                <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                <p>Click to upload or drag and drop</p>
                <p class="small">PNG, JPG, GIF up to 5MB</p>
              </div>
              <img class="image-preview img-fluid rounded" id="projectImagePreview">
              <input type="file" class="d-none" accept="image/*" id="projectImageUpload">
              <input type="hidden" name="image" id="projectImageUrl">
            </div>
            <div class="d-flex mt-2 gap-2">
             <button type="button" class="btn btn-outline-primary btn-sm" data-action="choose-image" data-target="projectImage">
  <i class="fas fa-upload me-1"></i> Choose Image
</button>

<button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="projectImage">
  <i class="fas fa-times me-1"></i> Clear
</button>
            </div>
          </div>
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
          <div class="col-md-6">
            <label class="form-label">Offer Image</label>
            <div class="image-upload-container" data-target="offerImage">
              <div class="upload-placeholder">
                <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                <p>Click to upload or drag and drop</p>
                <p class="small">PNG, JPG, GIF up to 5MB</p>
              </div>
              <img class="image-preview img-fluid rounded" id="offerImagePreview">
              <input type="file" class="d-none" accept="image/*" id="offerImageUpload">
              <input type="hidden" name="image" id="offerImageUrl">
            </div>
            <div class="d-flex mt-2 gap-2">
              <button type="button" class="btn btn-outline-primary btn-sm" onclick="document.getElementById('offerImageUpload').click()">
                <i class="fas fa-upload me-1"></i> Choose Image
              </button>
              <button type="button" class="btn btn-outline-danger btn-sm" onclick="clearImageUpload('offerImage')">
                <i class="fas fa-times me-1"></i> Clear
              </button>
            </div>
          </div>
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
          <div class="col-md-6">
            <label class="form-label">Blog Image</label>
            <div class="image-upload-container" data-target="blogImage">
              <div class="upload-placeholder">
                <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                <p>Click to upload or drag and drop</p>
                <p class="small">PNG, JPG, GIF up to 5MB</p>
              </div>
              <img class="image-preview img-fluid rounded" id="blogImagePreview">
              <input type="file" class="d-none" accept="image/*" id="blogImageUpload">
              <input type="hidden" name="image" id="blogImageUrl">
            </div>
            <div class="d-flex mt-2 gap-2">
           <button type="button" class="btn btn-outline-primary btn-sm" data-action="choose-image" data-target="blogImage">
  <i class="fas fa-upload me-1"></i> Choose Image
</button>

<button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="blogImage">
  <i class="fas fa-times me-1"></i> Clear
</button>
            </div>
          </div>
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
          <div class="col-md-4">
            <label class="form-label">Team Member Image</label>
            <div class="image-upload-container" data-target="teamImage">
              <div class="upload-placeholder">
                <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                <p>Click to upload or drag and drop</p>
                <p class="small">PNG, JPG, GIF up to 5MB</p>
              </div>
              <img class="image-preview img-fluid rounded" id="teamImagePreview">
              <input type="file" class="d-none" accept="image/*" id="teamImageUpload">
              <input type="hidden" name="image" id="teamImageUrl">
            </div>
            <div class="d-flex mt-2 gap-2">
              <button type="button" class="btn btn-outline-primary btn-sm" data-action="choose-image" data-target="teamImage">
  <i class="fas fa-upload me-1"></i> Choose Image
</button>

<button type="button" class="btn btn-outline-danger btn-sm" data-action="clear-image" data-target="teamImage">
  <i class="fas fa-times me-1"></i> Clear
</button>
            </div>
          </div>
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

<script src="/admin/admin.js"></script>

</body>
</html>