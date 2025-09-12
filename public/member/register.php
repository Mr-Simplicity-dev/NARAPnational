<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Register — Member</title>
  <link rel="icon" type="image/png" href="/uploads/slider/Narap.png"/>
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <style>.form-hint{font-size:.9rem;color:#6b7280}</style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 shadow-sm">
  <a href="/index.php" class="navbar-brand px-4">NARAP</a>
  <button class="navbar-toggler me-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav ms-auto p-4 p-lg-0">
      <a href="/register.php" class="nav-item nav-link">Back</a>
      <a href="/member/login.php" class="nav-item nav-link">Member Login</a>
    </div>
  </div>
</nav>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-9">
      <h1 class="mb-4">Member Registration</h1>
      <form id="memberForm" class="row g-3" enctype="multipart/form-data">
        <div class="col-md-6">
          <label class="form-label">First Name:</label>
          <input name="firstName" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Last Name:</label>
          <input name="lastName" class="form-control" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Sex:</label>
          <select name="state" class="form-control" required>
          <option value="" selected disabled>Gender</option>
            <option>Male</option>
            <option>Female</option>
          </select>
        </div>


        <div class="col-md-6">
          <label class="form-label">Marital Status:</label>
          <select name="state" class="form-control" required>
          <option value="" selected disabled>Select Status</option>
            <option>Single</option>
            <option>Married</option>
          </select>
        </div>
        
        <div class="col-md-6">
          <label class="form-label">Mobile Number:</label>
          <input type="email" name="Mobile Number" class="form-control" required placeholder="Phone Number">
        </div>

        <div class="col-md-6">
          <label class="form-label">Email:</label>
          <input type="email" name="email" class="form-control" required placeholder="@gmail.com">
        </div>

        <div class="col-md-6">
          <label class="form-label">Residential Address:</label>
          <input type="email" name="Residential Address" class="form-control" required placeholder="Residential Address">
        </div>

        <div class="col-md-6">
          <label class="form-label">State:</label>
          <select name="state" class="form-control" required>
            <option value="" selected disabled>Select State</option>
            <option>Abia</option>
            <option>Adamawa</option>
            <option>Akwa Ibom</option>
            <option>Anambra</option>
            <option>Bauchi</option>
            <option>Bayelsa</option>
            <option>Benue</option>
            <option>Borno</option>
            <option>Cross River</option>
            <option>Delta</option>
            <option>Ebonyi</option>
            <option>Edo</option>
            <option>Ekiti</option>
            <option>Enugu</option>
            <option>Gombe</option>
            <option>Imo</option>
            <option>Jigawa</option>
            <option>Kaduna</option>
            <option>Kano</option>
            <option>Katsina</option>
            <option>Kebbi</option>
            <option>Kogi</option>
            <option>Kwara</option>
            <option>Lagos</option>
            <option>Nasarawa</option>
            <option>Niger</option>
            <option>Ogun</option>
            <option>Ondo</option>
            <option>Osun</option>
            <option>Oyo</option>
            <option>Plateau</option>
            <option>Rivers</option>
            <option>Sokoto</option>
            <option>Taraba</option>
            <option>Yobe</option>
            <option>Zamfara</option>
            <option>FCT (Abuja)</option>
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Zone:</label>
          <input name="Zone" class="form-control" placeholder="Zone">
        </div>
        <div class="col-md-6">
          <label class="form-label">Ward:</label>
          <input name="Ward" class="form-control" placeholder="Ward">
        </div>

        <div class="col-md-6">
          <label class="form-label">Business Registered Name:</label>
          <input type="email" name="Business Registered Name" class="form-control" required placeholder="Business Registered Name">
        </div>

         <div class="col-md-6">
          <label class="form-label">Business Address:</label>
          <input type="email" name="Businessl Address" class="form-control" required placeholder="Business Address">
        </div>

        <div class="col-md-6">
          <label class="form-label">Area of Specialization</label>
          <select name="state" class="form-control" required>
            <option value="" selected disabled>Select Area of Specialization</option>
            <option>Air Conditioning</option>
            <option>Refrigeration</option>
            <option>Air Conditioning & Refrigeration</option>
            </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">All Positions:</label>
          <select name="state" class="form-control" required>
            <option value="" selected disabled>Select Position</option>
            <option>President</option>
            <option>Deputy President</option>
            <option>Vice President (North Central)</option>
            <option>Vice President (North East)</option>
            <option>Vice President (North West)</option>
            <option>Vice President (South East)</option>
            <option>Vice President (South South)</option>
            <option>Vice President (South West)</option>
            <option>Secretary</option>
            <option>Assistant Secretary</option>
            <option>Financial Secretary</option>
            <option>Assistant Financial Secretary</option>
            <option>Treasurer</option>
            <option>Public Relation Officer (PRO)</option>
            <option>Assistant Public Relation Officer (APRO)</option>
            <option>Provost Marshal 1</option>
            <option>Provost Marshal 2</option>
            <option>State Welfare Coordinator</option>
            <option>Coordinator</option>
            <option>Assistant Coordinator</option>
            <option>Chairman</option>
            <option>Vice Chairman</option>
            <option>State Secretary </option>
            <option>State Assistant Secretary</option>
            <option>State Financial Secretary</option>
            <option>State Treasurer</option>
            <option>Task Force</option>
            <option>Old Member</option>
            <option>New Member</option>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Password:</label>
          <input type="password" name="password" class="form-control" minlength="6" required placeholder="*******">
        </div>
        
        <div class="col-md-6">
          <label class="form-label">Passport Photo:</label>
          <input type="file" name="passport" class="form-control" accept="image/*" required>
          <div class="form-hint">Upload a clear face photo (JPG/PNG).</div>
        </div>

          <div class="col-md-6">
          <label class="form-label">Signature:</label>
          <input type="file" name="passport" class="form-control" accept="image/*" required>
          <div class="form-hint">Upload a Signature.</div>
        </div>

        <div class="col-12">
          <button class="btn btn-success" type="submit">Create Member Account</button>
        </div>
      </form>
      <div id="memberMsg" class="mt-3"></div>
    </div>
  </div>
</div>

<script>
function setMsg(el, text, ok=false) {
  el.innerHTML = '<div class="alert '+(ok?'alert-success':'alert-danger')+'">'+text+'</div>';
  el.scrollIntoView({behavior:'smooth', block:'nearest'});
}

document.getElementById('memberForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  const msg = document.getElementById('memberMsg');
  const fd = new FormData(e.target);

  try {
    const res = await fetch('/api/auth/register-member', {
      method: 'POST',
      body: fd
    });
    const data = await res.json().catch(() => ({}));
    if (!res.ok) throw new Error(data.message || 'Registration failed');

    setMsg(msg, 'Member account created. Redirecting to login…', true);
    setTimeout(()=> { window.location.href = '/member/login.php'; }, 1000);
  } catch (err) {
    setMsg(msg, err.message || 'Something went wrong.');
  }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
