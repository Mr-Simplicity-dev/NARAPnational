<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard · Payments</title>
    <style>
        :root {
            --brand: #0ea5e9; --ink: #0f172a; --muted: #64748b;
            --bg: #f8fafc; --card: #fff; --ok: #16a34a; --warn: #f59e0b; --err: #ef4444;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            background: var(--bg); color: var(--ink); line-height: 1.6;
        }
        header {
            display: flex; align-items: center; justify-content: space-between;
            background: var(--brand); color: #fff; padding: 14px 18px;
            position: sticky; top: 0; z-index: 100;
        }
        header .title { font-weight: 800; }
        header a.btn, header button {
            background: #fff; color: var(--brand); border: 0; border-radius: 10px;
            padding: 8px 12px; font-weight: 700; text-decoration: none; cursor: pointer;
        }
        .container { max-width: 1140px; margin: 18px auto; padding: 0 16px; }
        .grid { display: grid; grid-template-columns: 1fr; gap: 16px; }
        @media (min-width: 900px) { .grid { grid-template-columns: 2fr 1fr; } }
        .panel {
            background: var(--card); border-radius: 14px;
            box-shadow: 0 8px 26px rgba(0,0,0,.06); padding: 16px;
        }
        .profile {
            display: flex; gap: 14px; align-items: center;
            padding-bottom: 16px; border-bottom: 1px solid #eef2f7;
        }
        .profile img {
            width: 72px; height: 72px; border-radius: 50%;
            object-fit: cover; border: 2px solid #e2e8f0; background: #fff;
        }
        .muted { color: var(--muted); font-size: 13px; }
        .list { display: flex; flex-direction: column; gap: 10px; margin-top: 16px; }
        .item {
            display: flex; justify-content: space-between; gap: 10px;
            padding: 10px 0; border-bottom: 1px solid #eef2f7;
        }
        .pill {
            display: inline-block; background: #e2f2fd; color: var(--brand);
            padding: 4px 8px; border-radius: 999px; font-size: 12px;
        }
        .pay-card {
            display: flex; flex-direction: column; gap: 6px;
            border: 1px dashed #e5e7eb; border-radius: 12px; padding: 12px;
            margin-bottom: 16px;
        }
        .pay-card .h { font-weight: 800; }
        .pay-card .a { font-size: 14px; color: var(--muted); }
        .pay-card .price { font-size: 22px; font-weight: 900; }
        .btn {
            padding: 10px 12px; border: 0; border-radius: 10px;
            background: var(--brand); color: #fff; font-weight: 700;
            cursor: pointer; transition: background 0.3s; margin-top: 10px;
        }
        .btn:hover { background: #0d95d8; }
        .btn:disabled { background: #94a3b8; cursor: not-allowed; }
        .ok { color: var(--ok); } .warn { color: var(--warn); } .err { color: var(--err); }
        
        /* Status panel */
        .status-panel {
            display: flex; justify-content: space-between; flex-wrap: wrap;
            background: #f8f9fa; padding: 10px 15px; border-radius: 8px;
            margin-bottom: 20px;
        }
        .status {
            display: flex; align-items: center; gap: 8px;
            margin: 5px 0;
        }
        .status-dot {
            width: 10px; height: 10px; border-radius: 50%;
        }
        .connected { background: var(--ok); }
        .disconnected { background: var(--err); }
        .warning { background: var(--warn); }
        
        /* Notification system */
        .notification {
            position: fixed; top: 20px; right: 20px; padding: 15px 20px;
            border-radius: 6px; color: white; background: var(--err);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15); z-index: 1000;
            transform: translateX(100%); transition: transform 0.3s ease;
            max-width: 350px;
        }
        .notification.show { transform: translateX(0); }
        .notification.success { background: var(--ok); }
        
        /* Payment methods */
        .payment-methods {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 10px; margin: 15px 0;
        }
        .payment-method {
            border: 2px solid #e9ecef; border-radius: 8px;
            padding: 10px; text-align: center; cursor: pointer;
            transition: all 0.3s;
        }
        .payment-method:hover {
            border-color: var(--brand); transform: translateY(-3px);
        }
        .payment-method.active {
            border-color: var(--brand); background: rgba(14, 165, 233, 0.05);
        }
        .payment-method h4 {
            margin: 5px 0; font-size: 14px;
        }
        .payment-method p {
            margin: 0; font-size: 12px; color: var(--muted);
        }
        
        /* Debug panel */
        .debug-panel {
            background: #f8f9fa; border: 1px solid #e9ecef;
            border-radius: 8px; padding: 15px; margin-top: 20px;
            font-family: monospace; font-size: 13px;
            max-height: 200px; overflow-y: auto;
        }
        .debug-title {
            font-weight: 700; margin-bottom: 10px; color: var(--brand);
        }
        .debug-log { margin: 5px 0; padding: 5px; border-bottom: 1px solid #eee; }
        .debug-error { color: var(--err); }
        .debug-success { color: var(--ok); }
        
        /* Loading indicator */
        .loading {
            display: inline-block; width: 20px; height: 20px;
            border: 3px solid rgba(255,255,255,.3); border-radius: 50%;
            border-top-color: #fff; animation: spin 1s ease-in-out infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        
        /* Token expiration modal */
        .modal {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.5); display: flex;
            align-items: center; justify-content: center; z-index: 2000;
            opacity: 0; visibility: hidden; transition: all 0.3s;
        }
        .modal.show { opacity: 1; visibility: visible; }
        .modal-content {
            background: white; border-radius: 12px; padding: 24px;
            width: 90%; max-width: 400px; box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .modal-title {
            font-size: 20px; font-weight: 700; margin-bottom: 16px;
            color: var(--err);
        }
        .modal-message { margin-bottom: 24px; }
        .modal-actions {
            display: flex; gap: 12px; justify-content: flex-end;
        }
    </style>
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

    <!-- Token Expiration Modal -->
    <div class="modal" id="tokenExpiredModal">
        <div class="modal-content">
            <div class="modal-title">Session Expired</div>
            <div class="modal-message">
                Your session has expired. Please log in again to continue.
            </div>
            <div class="modal-actions">
                <button class="btn secondary" id="modalCancel">Cancel</button>
                <button class="btn" id="modalLogin">Log In</button>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Status Panel -->
        <div class="status-panel">
            <div class="status">
                <div class="status-dot connected"></div>
                <span>Server: Connected</span>
            </div>
            <div class="status">
                <div class="status-dot connected" id="jwt-status"></div>
                <span id="jwt-text">JWT: Valid</span>
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
                
                <!-- Payment Method Selection -->
                <div style="margin-bottom: 20px;">
                    <div style="font-weight: 600; margin-bottom: 8px;">Select Payment Method:</div>
                    <div class="payment-methods">
                        <div class="payment-method active" data-method="card">
                            <h4>Card</h4>
                            <p>Debit/Credit Card</p>
                        </div>
                        <div class="payment-method" data-method="bank">
                            <h4>Bank Transfer</h4>
                            <p>Direct Bank Transfer</p>
                        </div>
                        <div class="payment-method" data-method="ussd">
                            <h4>USSD</h4>
                            <p>USSD Code</p>
                        </div>
                    </div>
                </div>
                
                <div class="pay-card">
                    <div class="h">Membership Fee</div>
                    <div class="a">Access member benefits and dashboard tools.</div>
                    <div class="price">₦5,000</div>
                    <button class="btn" data-amount-kobo="500000" data-purpose="membership" id="payMembership">
                        <span id="payMembershipText">Pay Membership</span>
                        <span id="payMembershipLoader" class="loading" style="display: none;"></span>
                    </button>
                </div>
                <div class="pay-card">
                    <div class="h">ID Card Fee</div>
                    <div class="a">Get your official member ID card.</div>
                    <div class="price">₦3,000</div>
                    <button class="btn" data-amount-kobo="300000" data-purpose="idcard" id="payIdCard">
                        <span id="payIdCardText">Pay ID Card</span>
                        <span id="payIdCardLoader" class="loading" style="display: none;"></span>
                    </button>
                </div>
                <div class="pay-card">
                    <div class="h">Certificate Fee</div>
                    <div class="a">Generate and download membership certificate.</div>
                    <div class="price">₦10,000</div>
                    <button class="btn" data-amount-kobo="1000000" data-purpose="certificate" id="payCertificate">
                        <span id="payCertificateText">Pay Certificate</span>
                        <span id="payCertificateLoader" class="loading" style="display: none;"></span>
                    </button>
                </div>
                
                <!-- Debug Panel -->
                <div class="debug-panel">
                    <div class="debug-title">API Debug Log</div>
                    <div id="debugLogs">
                        <div class="debug-log">Dashboard initialized. Checking token status...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    (function(){
        // Debug logging
        function addDebugLog(message, isError = false) {
            const debugLogs = document.getElementById('debugLogs');
            const logEntry = document.createElement('div');
            logEntry.className = isError ? 'debug-log debug-error' : 'debug-log';
            logEntry.textContent = new Date().toLocaleTimeString() + ' - ' + message;
            debugLogs.appendChild(logEntry);
            debugLogs.scrollTop = debugLogs.scrollHeight;
        }

        // Notification system
        function showNotification(message, isSuccess = false) {
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notification-text');
            
            notificationText.textContent = message;
            notification.className = isSuccess ? 'notification success show' : 'notification show';
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 5000);
            
            addDebugLog(message, !isSuccess);
        }

        // Token expiration modal
        function showTokenExpiredModal() {
            const modal = document.getElementById('tokenExpiredModal');
            modal.classList.add('show');
        }

        // Close modal
        document.getElementById('modalCancel').addEventListener('click', function() {
            document.getElementById('tokenExpiredModal').classList.remove('show');
        });

        // Redirect to login
        document.getElementById('modalLogin').addEventListener('click', function() {
            window.location.href = '/member/login.php';
        });

        // Logout button
        document.getElementById('logoutBtn').addEventListener('click', function() {
            // Clear all auth storage
            localStorage.removeItem('jwt');
            localStorage.removeItem('token');
            localStorage.removeItem('authToken');
            sessionStorage.removeItem('jwt');
            sessionStorage.removeItem('token');
            sessionStorage.removeItem('authToken');
            
            // Clear cookies
            document.cookie = 'jwt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'authToken=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            
            // Redirect to login
            window.location.href = '/member/login.php';
        });

        // Payment method selection
        let selectedPaymentMethod = 'card';
        document.querySelectorAll('.payment-method').forEach(method => {
            method.addEventListener('click', function() {
                document.querySelectorAll('.payment-method').forEach(m => {
                    m.classList.remove('active');
                });
                this.classList.add('active');
                selectedPaymentMethod = this.getAttribute('data-method');
                addDebugLog(`Payment method selected: ${selectedPaymentMethod}`);
            });
        });

        function getToken(){
            const ls = localStorage.getItem('jwt') || localStorage.getItem('token') || localStorage.getItem('authToken');
            const ss = sessionStorage.getItem('jwt') || sessionStorage.getItem('token') || sessionStorage.getItem('authToken');
            const ck = (document.cookie.match(/(?:^|;\s*)(?:jwt|token|authToken)=([^;]+)/)||[])[1];
            return ls || ss || ck || '';
        }

        function validateToken() {
            const token = getToken();
            if (!token) {
                addDebugLog('No token found', true);
                showTokenExpiredModal();
                return false;
            }
            
            // Simple token validation (check if it's a JWT format)
            const tokenParts = token.split('.');
            if (tokenParts.length !== 3) {
                addDebugLog('Invalid token format', true);
                showTokenExpiredModal();
                return false;
            }
            
            try {
                // Try to decode the payload
                const payload = JSON.parse(atob(tokenParts[1]));
                const expirationTime = payload.exp * 1000; // Convert to milliseconds
                const currentTime = Date.now();
                
                if (expirationTime < currentTime) {
                    addDebugLog('Token has expired', true);
                    showTokenExpiredModal();
                    return false;
                }
                
                addDebugLog('Token is valid');
                return true;
            } catch (e) {
                addDebugLog('Error decoding token: ' + e.message, true);
                showTokenExpiredModal();
                return false;
            }
        }

        function paymentsInit(amount, purpose='membership'){
            if (!validateToken()) {
                return Promise.reject(new Error('Invalid token'));
            }
            
            addDebugLog(`Initializing payment: ${purpose}, Amount: ${amount}, Method: ${selectedPaymentMethod}`);
            
            return fetch('/api/payments/init', {
                method:'POST',
                headers:{
                    'Content-Type':'application/json',
                    'Authorization':'Bearer ' + getToken()
                },
                body: JSON.stringify({ amount, purpose, method: selectedPaymentMethod })
            })
            .then(response => {
                addDebugLog(`Payment init response: ${response.status} ${response.statusText}`);
                
                if (response.status === 401) {
                    // Token is invalid or expired
                    showTokenExpiredModal();
                    return Promise.reject(new Error('Authentication failed'));
                }
                
                if (!response.ok) {
                    return response.json().then(errorData => {
                        return Promise.reject(new Error(errorData.message || 'Payment initialization failed'));
                    });
                }
                
                return response.json();
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
            
            paymentsInit(amount, purpose)
                .then(({ reference }) => {
                    addDebugLog(`Payment initialized successfully. Reference: ${reference}`);
                    showNotification('Payment initialized successfully! Redirecting to payment gateway...', true);
                    
                    // In a real implementation, you would redirect to Paystack here
                    // For now, we'll just reset the button and show a success message
                    setTimeout(() => {
                        resetButton(buttonId);
                        showNotification('Payment simulation complete. In production, you would be redirected to Paystack.', true);
                    }, 2000);
                })
                .catch(e => {
                    addDebugLog(`Payment initialization error: ${e.message}`, true);
                    
                    if (e.message.includes('Authentication failed')) {
                        showNotification('Your session has expired. Please log in again.');
                    } else {
                        showNotification('Payment failed: ' + e.message);
                    }
                    
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
        
        // Initialize
        addDebugLog('Dashboard loaded successfully');
        
        // Check token validity on page load
        if (!validateToken()) {
            addDebugLog('Token validation failed on page load', true);
        } else {
            addDebugLog('Token is valid on page load');
        }
    })();
    </script>
</body>
</html>