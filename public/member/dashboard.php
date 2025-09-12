<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Member Dashboard · Payments</title>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<style>
    :root{
      --brand:#0ea5e9; --ink:#0f172a; --muted:#64748b;
      --bg:#f8fafc; --card:#fff; --ok:#16a34a; --warn:#f59e0b; --err:#ef4444;
    }
    *{box-sizing:border-box}
    body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:var(--bg);color:var(--ink)}
    header{display:flex;align-items:center;justify-content:space-between;background:var(--brand);color:#fff;padding:14px 18px;position:sticky;top:0}
    header .title{font-weight:800}
    header a.btn, header button{background:#fff;color:var(--brand);border:0;border-radius:10px;padding:8px 12px;font-weight:700;text-decoration:none;cursor:pointer}
    .container{max-width:1140px;margin:18px auto;padding:0 16px}
    .grid{display:grid;grid-template-columns:1fr;gap:16px}
    @media (min-width: 900px){ .grid{grid-template-columns:2fr 1fr} }
    .panel{background:var(--card);border-radius:14px;box-shadow:0 8px 26px rgba(0,0,0,.06);padding:16px}
    .profile{display:flex;gap:14px;align-items:center}
    .profile img{width:72px;height:72px;border-radius:50%;object-fit:cover;border:2px solid #e2e8f0;background:#fff}
    .muted{color:var(--muted);font-size:13px}
    .list{display:flex;flex-direction:column;gap:10px}
    .item{display:flex;justify-content:space-between;gap:10px;padding:10px 0;border-bottom:1px solid #eef2f7}
    .pill{display:inline-block;background:#e2f2fd;color:var(--brand);padding:4px 8px;border-radius:999px;font-size:12px}
    .pay-card{display:flex;flex-direction:column;gap:6px;border:1px dashed #e5e7eb;border-radius:12px;padding:12px}
    .pay-card .h{font-weight:800}
    .pay-card .a{font-size:14px;color:var(--muted)}
    .pay-card .price{font-size:22px;font-weight:900}
    .btn{padding:10px 12px;border:0;border-radius:10px;background:var(--brand);color:#fff;font-weight:700;cursor:pointer}
    .btn.secondary{background:#fff;color:var(--brand);border:1px solid #bae6fd}
    .ok{color:var(--ok)} .warn{color:var(--warn)} .err{color:var(--err)}
    
    /* Status indicators */
    .status-panel {
        display: flex;
        justify-content: space-between;
        background: #f8f9fa;
        padding: 10px 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }
    .status {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 5px 0;
    }
    .status-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }
    .connected { background: var(--ok); }
    .disconnected { background: var(--err); }
    .warning { background: var(--warn); }
    
    /* Notification system */
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 6px;
        color: white;
        background: var(--err);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        transform: translateX(100%);
        transition: transform 0.3s ease;
        z-index: 1000;
        max-width: 350px;
    }
    .notification.show { transform: translateX(0); }
    .notification.success { background: var(--ok); }
    
    /* Payment methods */
    .payment-methods {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 10px;
        margin: 15px 0;
    }
    .payment-method {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 10px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
    }
    .payment-method:hover {
        border-color: var(--brand);
        transform: translateY(-3px);
    }
    .payment-method.active {
        border-color: var(--brand);
        background: rgba(14, 165, 233, 0.05);
    }
    .payment-method h4 {
        margin: 5px 0;
        font-size: 14px;
    }
    .payment-method p {
        margin: 0;
        font-size: 12px;
        color: var(--muted);
    }
    
    /* Loading indicator */
    .loading {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255,255,255,.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
  </style>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script>window.PAYSTACK_PUBLIC = window.PAYSTACK_PUBLIC || 'pk_test_23be16118e64d29a2ec97f46934141aa652b38ff';</script>
</head>

<body>
<header>
<div class="title">Member Dashboard</div>
<div class="actions">
<a class="btn" href="/">Back to Site</a>
<button class="btn" id="logoutBtn">Logout</button>
</div>
</header>

<div class="notification" id="notification">
    <span id="notification-text"></span>
</div>

<div class="container">
    <!-- Status Panel -->
    <div class="status-panel">
        <div class="status">
            <div class="status-dot connected"></div>
            <span>Server: Connected</span>
        </div>
        <div class="status">
            <div class="status-dot warning" id="jwt-status"></div>
            <span id="jwt-text">JWT: Checking...</span>
        </div>
        <div class="status">
            <div class="status-dot connected"></div>
            <span>Paystack: Ready</span>
        </div>
    </div>

    <div class="grid">
        <div class="panel">
            <div class="profile">
                <img alt="passport" id="avatar" src="/uploads/slider/Narap.png"/>
                <div>
                    <div id="hello" style="font-weight:800">Welcome</div>
                    <div class="muted"><span id="email"></span> · <span class="pill" id="rolePill">MEMBER</span></div>
                </div>
            </div>
            <div style="margin-top:16px">
                <div style="font-weight:800;margin-bottom:8px">Recent Activity</div>
                <div class="list" id="recentList">
                    <div class="muted">No recent activity yet.</div>
                </div>
            </div>
        </div>
        <div class="panel">
            <div style="font-weight:800;margin-bottom:8px">Payments</div>
            <div class="pay-card">
                <div class="h">Membership Fee</div>
                <div class="a">Access member benefits and dashboard tools.</div>
                <div class="price">₦5,000</div>
                
                <!-- Payment Method Selection -->
                <div style="margin: 10px 0;">
                    <div style="font-weight: 600; margin-bottom: 8px;">Select Payment Method:</div>
                    <div class="payment-methods">
                        <div class="payment-method active" data-method="card">
                            <h4>Card</h4>
                            <p>Debit/Credit</p>
                        </div>
                        <div class="payment-method" data-method="bank">
                            <h4>Bank</h4>
                            <p>Transfer</p>
                        </div>
                        <div class="payment-method" data-method="ussd">
                            <h4>USSD</h4>
                            <p>Code</p>
                        </div>
                    </div>
                </div>
                
                <button class="btn" data-amount-kobo="500000" data-purpose="membership" id="payMembership">
                    <span id="payMembershipText">Pay Membership</span>
                    <span id="payMembershipLoader" class="loading" style="display: none;"></span>
                </button>
            </div>
            <div class="pay-card" style="margin-top:10px">
                <div class="h">ID Card Fee</div>
                <div class="a">Get your official member ID card.</div>
                <div class="price">₦3,000</div>
                <button class="btn" data-amount-kobo="300000" data-purpose="idcard" id="payIdCard">
                    <span id="payIdCardText">Pay ID Card</span>
                    <span id="payIdCardLoader" class="loading" style="display: none;"></span>
                </button>
            </div>
            <div class="pay-card" style="margin-top:10px">
                <div class="h">Certificate Fee</div>
                <div class="a">Generate and download membership certificate.</div>
                <div class="price">₦10,000</div>
                <button class="btn" data-amount-kobo="1000000" data-purpose="certificate" id="payCertificate">
                    <span id="payCertificateText">Pay Certificate</span>
                    <span id="payCertificateLoader" class="loading" style="display: none;"></span>
                </button>
            </div>
            <div class="muted" style="margin-top:10px">
                After successful payment, you'll be redirected here and your status will update automatically.
            </div>
            
            <!-- Troubleshooting section -->
            <div style="margin-top: 20px; padding: 15px; background: #fff4e6; border-radius: 8px; border-left: 4px solid #ff922b;">
                <div style="font-weight: 700; color: #ff922b; margin-bottom: 8px;">Troubleshooting</div>
                <div style="font-size: 13px; color: #8a6d3b;">
                    If payments aren't working, ensure your server has JWT_SECRET set in the .env file and has been restarted.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function(){
    // Notification system
    function showNotification(message, isSuccess = false) {
        const notification = document.getElementById('notification');
        const notificationText = document.getElementById('notification-text');
        
        notificationText.textContent = message;
        notification.className = isSuccess ? 'notification success show' : 'notification show';
        
        setTimeout(() => {
            notification.classList.remove('show');
        }, 5000);
    }

    // Check JWT status
    function checkJWTStatus() {
        // Simulate checking JWT configuration
        setTimeout(() => {
            const jwtStatus = document.getElementById('jwt-status');
            const jwtText = document.getElementById('jwt-text');
            
            // In a real implementation, you would make an API call to check JWT status
            const isConfigured = Math.random() > 0.5; // Random for demo
            
            if (isConfigured) {
                jwtStatus.className = 'status-dot connected';
                jwtText.textContent = 'JWT: Configured';
            } else {
                jwtStatus.className = 'status-dot disconnected';
                jwtText.textContent = 'JWT: Missing';
                showNotification('JWT_SECRET is missing on the server. Please check your .env file.');
            }
        }, 1000);
    }

    function getToken(){
        const ls = localStorage.getItem('jwt') || localStorage.getItem('token') || localStorage.getItem('authToken');
        const ss = sessionStorage.getItem('jwt') || sessionStorage.getItem('token') || sessionStorage.getItem('authToken');
        const ck = (document.cookie.match(/(?:^|;\s*)(?:jwt|token|authToken)=([^;]+)/)||[])[1];
        return ls || ss || ck || '';
    }
    const TOKEN = getToken();
    if(!TOKEN){ try{ window.location.href = '/member/login.php'; }catch(_){} return; }

    // Track selected payment method
    let selectedPaymentMethod = 'card';
    
    // Payment method selection
    document.querySelectorAll('.payment-method').forEach(method => {
        method.addEventListener('click', function() {
            document.querySelectorAll('.payment-method').forEach(m => {
                m.classList.remove('active');
            });
            this.classList.add('active');
            selectedPaymentMethod = this.getAttribute('data-method');
        });
    });

    function paymentsInit(amount, purpose='membership', method='card'){
        return fetch('/api/payments/init', {
            method:'POST',
            headers:{
                'Content-Type':'application/json',
                'Authorization':'Bearer ' + TOKEN
            },
            body: JSON.stringify({ amount, purpose, method })
        });
    }
    function paymentsVerify(reference){
        return fetch('/api/payments/verify', {
            method:'POST',
            headers:{
                'Content-Type':'application/json',
                'Authorization':'Bearer ' + TOKEN
            },
            body: JSON.stringify({ reference })
        });
    }

    function startPayment(amount, purpose, buttonId){
        // Show loading state
        const button = document.getElementById(buttonId);
        const buttonText = document.getElementById(buttonId + 'Text');
        const buttonLoader = document.getElementById(buttonId + 'Loader');
        
        button.disabled = true;
        buttonText.style.display = 'none';
        buttonLoader.style.display = 'inline-block';
        
        paymentsInit(amount, purpose, selectedPaymentMethod)
            .then(r => {
                if (r.ok) return r.json();
                return r.json().then(x => {
                    // Check if it's a JWT error
                    if (x.message && x.message.includes('JWT_SECRET')) {
                        showNotification('Server configuration error: JWT_SECRET is missing');
                    }
                    return Promise.reject(x);
                });
            })
            .then(({ reference }) => {
                const email = (JSON.parse(localStorage.getItem('user')||'{}').email) || 'test@example.com';
                if(!window.PaystackPop){ 
                    showNotification('Paystack script blocked. Contact admin.'); 
                    resetButton(buttonId);
                    return; 
                }
                
                const handler = PaystackPop.setup({
                    key: (window.PAYSTACK_PUBLIC || ''),
                    email, 
                    amount, 
                    currency:'NGN', 
                    ref: reference,
                    metadata: { 
                        custom_fields: [
                            { display_name:'Purpose', variable_name:'purpose', value: purpose },
                            { display_name:'Method', variable_name:'method', value: selectedPaymentMethod }
                        ] 
                    },
                    callback: function(resp){
                        paymentsVerify(resp.reference)
                            .then(vr => vr.ok ? vr.json() : vr.json().then(x => Promise.reject(x)))
                            .then(v => {
                                if(v.ok){ 
                                    showNotification('Payment successful!', true); 
                                    setTimeout(() => { location.reload(); }, 2000);
                                } else { 
                                    showNotification('Payment not verified: ' + (v.status||'failed')); 
                                    resetButton(buttonId);
                                }
                            })
                            .catch(e => {
                                showNotification(e?.message || 'Verification failed');
                                resetButton(buttonId);
                            });
                    },
                    onClose: function(){ 
                        resetButton(buttonId);
                    }
                });
                handler.openIframe();
            })
            .catch(e => {
                showNotification(e.message || 'Unable to initialize payment');
                resetButton(buttonId);
            });
    }

    function resetButton(buttonId) {
        const button = document.getElementById(buttonId);
        const buttonText = document.getElementById(buttonId + 'Text');
        const buttonLoader = document.getElementById(buttonId + 'Loader');
        
        button.disabled = false;
        buttonText.style.display = 'inline-block';
        buttonLoader.style.display = 'none';
    }

    // Set up payment button event listeners
    document.getElementById('payMembership').addEventListener('click', () => {
        const amount = Number(document.getElementById('payMembership').getAttribute('data-amount-kobo') || 0);
        const purpose = document.getElementById('payMembership').getAttribute('data-purpose') || 'membership';
        if(!amount) return showNotification('Amount missing');
        startPayment(amount, purpose, 'payMembership');
    });
    
    document.getElementById('payIdCard').addEventListener('click', () => {
        const amount = Number(document.getElementById('payIdCard').getAttribute('data-amount-kobo') || 0);
        const purpose = document.getElementById('payIdCard').getAttribute('data-purpose') || 'idcard';
        if(!amount) return showNotification('Amount missing');
        startPayment(amount, purpose, 'payIdCard');
    });
    
    document.getElementById('payCertificate').addEventListener('click', () => {
        const amount = Number(document.getElementById('payCertificate').getAttribute('data-amount-kobo') || 0);
        const purpose = document.getElementById('payCertificate').getAttribute('data-purpose') || 'certificate';
        if(!amount) return showNotification('Amount missing');
        startPayment(amount, purpose, 'payCertificate');
    });
    
    // Initialize JWT status check
    checkJWTStatus();
})();
</script>
</body>
</html>