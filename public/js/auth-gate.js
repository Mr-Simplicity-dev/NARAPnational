// /public/js/auth-gate.js - Simplified version
(function(){
  function onReady(fn){ 
    if(document.readyState !== 'loading') fn(); 
    else document.addEventListener('DOMContentLoaded', fn); 
  }

  onReady(() => {
    const statusEl = document.getElementById('authStatus');
    const token = localStorage.getItem('jwt');
    
    if (!token) {
      if (statusEl) statusEl.textContent = 'Not authenticated. Redirecting…';
      setTimeout(() => { 
        window.location.replace('/member/login.php'); 
      }, 500);
      return;
    }
    
    if (statusEl) statusEl.textContent = 'Authenticated ✓';
    
    // Optional: Add a server check here if needed
  });
})();