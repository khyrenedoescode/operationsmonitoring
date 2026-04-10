<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Forgot Password</title>
<link rel="icon" type="image/png" href="{{ asset('rweblogo.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
[data-theme="light"]{--bg:#fdf6f0;--surface:#fff8f5;--surface2:#F2E6D5;--border:#e8d5c4;--accent:#c9637a;--accent3:#b07060;--done:#5a9a6a;--text:#3d2b22;--muted:#a08070;--muted2:#7a5c50;--shadow:rgba(201,99,122,.14);--glass:rgba(255,248,245,.92);--input-bg:#fff8f5;}
[data-theme="dark"]{--bg:#1a1014;--surface:#231519;--surface2:#2d1c20;--border:#4a2e36;--accent:#ff8fa3;--accent3:#d4907a;--done:#6dbf7e;--text:#f5e8e4;--muted:#a07888;--muted2:#c8a8b0;--shadow:rgba(0,0,0,.55);--glass:rgba(35,21,25,.94);--input-bg:#2d1c20;}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
html,body{height:100%;}
body{font-family:'Poppins',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;display:flex;align-items:center;justify-content:center;transition:background .4s,color .4s;}
body::after{content:'';position:fixed;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,#FFC2CD,#e8a0b0,#F2E6D5,#c9637a,#b07060,#FFC2CD);background-size:300% 100%;animation:topbar 5s linear infinite;z-index:100;}
body::before{content:'';position:fixed;inset:0;background-image:radial-gradient(circle,rgba(201,99,122,.09) 1px,transparent 1px);background-size:28px 28px;pointer-events:none;z-index:0;animation:dotDrift 20s ease-in-out infinite alternate;}
@keyframes topbar{to{background-position:300% 0;}}
@keyframes dotDrift{0%{background-position:0 0;}100%{background-position:28px 28px;}}
@keyframes slideUp{from{opacity:0;transform:translateY(24px);}to{opacity:1;transform:translateY(0);}}
@keyframes spin{to{transform:rotate(360deg);}}
.bg-orb{position:fixed;border-radius:50%;pointer-events:none;z-index:0;filter:blur(80px);}
.bg-orb-1{width:600px;height:600px;background:radial-gradient(circle,rgba(201,99,122,.28),transparent 70%);top:-150px;right:-100px;}
.bg-orb-2{width:500px;height:500px;background:radial-gradient(circle,rgba(176,112,96,.22),transparent 70%);bottom:-100px;left:-100px;}
.auth-wrap{position:relative;z-index:1;width:min(440px,94vw);animation:slideUp .5s cubic-bezier(.22,1,.36,1) both;}
.auth-card{background:var(--glass);backdrop-filter:blur(20px);border:1.5px solid var(--border);border-radius:24px;padding:40px 40px 36px;box-shadow:0 24px 64px var(--shadow);}
.brand{text-align:center;margin-bottom:28px;}
.brand-logo{display:inline-flex;align-items:center;justify-content:center;width:56px;height:56px;border-radius:16px;background:linear-gradient(135deg,var(--accent),var(--accent3));margin-bottom:14px;box-shadow:0 8px 24px var(--shadow);}
.brand-logo svg{width:28px;height:28px;color:#fff;}
.brand h1{font-size:1.4rem;font-weight:800;background:linear-gradient(135deg,var(--accent),var(--accent3));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.brand p{font-size:.68rem;color:var(--muted);margin-top:4px;letter-spacing:.1em;text-transform:uppercase;}
.field{margin-bottom:16px;}
.field label{display:block;font-size:.62rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.1em;margin-bottom:6px;}
.input-wrap{position:relative;}
.input-wrap svg.input-icon{position:absolute;left:12px;top:50%;transform:translateY(-50%);width:15px;height:15px;color:var(--muted);pointer-events:none;}
.input-wrap input{width:100%;background:var(--input-bg);border:1.5px solid var(--border);border-radius:10px;padding:10px 12px 10px 38px;color:var(--text);font-family:'Poppins',sans-serif;font-size:.84rem;outline:none;transition:border-color .2s,box-shadow .2s;}
.input-wrap input:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(201,99,122,.12);}
.btn-submit{width:100%;padding:12px;background:linear-gradient(135deg,var(--accent),var(--accent3));border:none;border-radius:11px;color:#fff;font-family:'Poppins',sans-serif;font-size:.88rem;font-weight:700;cursor:pointer;box-shadow:0 6px 20px var(--shadow);transition:all .2s;margin-top:6px;display:flex;align-items:center;justify-content:center;gap:8px;}
.btn-submit:hover{transform:translateY(-2px);filter:brightness(1.05);}
.btn-submit .spinner{width:16px;height:16px;border:2px solid rgba(255,255,255,.4);border-top-color:#fff;border-radius:50%;animation:spin .7s linear infinite;display:none;}
.btn-submit.loading .spinner{display:block;}
.btn-submit.loading .btn-text{display:none;}
.success-banner{display:none;background:rgba(90,154,106,.1);border:1.5px solid rgba(90,154,106,.3);border-radius:10px;padding:12px 16px;font-size:.78rem;color:var(--done);margin-bottom:16px;align-items:center;gap:10px;}
.success-banner.show{display:flex;}
.error-banner{display:none;background:rgba(201,99,122,.08);border:1.5px solid rgba(201,99,122,.25);border-radius:10px;padding:12px 16px;font-size:.78rem;color:var(--accent);margin-bottom:16px;align-items:center;gap:10px;}
.error-banner.show{display:flex;}
.back-link{text-align:center;margin-top:16px;font-size:.7rem;color:var(--muted);}
.back-link a{color:var(--accent);text-decoration:none;}
.back-link a:hover{text-decoration:underline;}
.auth-footer{text-align:center;margin-top:20px;font-size:.63rem;color:var(--muted);}
</style>
</head>
<body>
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>

<div class="auth-wrap">
  <div class="auth-card">
    <div class="brand">
      <div class="brand-logo">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
        </svg>
      </div>
      <h1>Forgot Password</h1>
      <p>Enter your email to receive a reset link</p>
    </div>

    <div class="success-banner" id="success-banner">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="16" height="16"><polyline points="20 6 9 17 4 12"/></svg>
      <span id="success-msg">Reset link sent! Check your email.</span>
    </div>
    <div class="error-banner" id="error-banner">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <span id="error-msg">Email not found.</span>
    </div>

    <div class="field">
      <label>Email Address</label>
      <div class="input-wrap">
        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        <input type="email" id="fp-email" placeholder="you@example.com" autocomplete="email" />
      </div>
    </div>

    <button class="btn-submit" id="btn-send" onclick="sendResetLink()">
      <span class="btn-text">Send Reset Link</span>
      <div class="spinner"></div>
    </button>

    <div class="back-link">
      <a href="{{ route('login') }}">← Back to Sign In</a>
    </div>
  </div>
  <div class="auth-footer">© 2025 R Web Solutions · All rights reserved</div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

async function sendResetLink() {
  const email = document.getElementById('fp-email').value.trim();
  if (!email) return;

  const btn = document.getElementById('btn-send');
  btn.classList.add('loading');
  document.getElementById('success-banner').classList.remove('show');
  document.getElementById('error-banner').classList.remove('show');

  try {
    const res = await fetch('{{ route("password.email") }}', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
      body: JSON.stringify({ email })
    });
    const data = await res.json();
    if (res.ok && data.success) {
      document.getElementById('success-banner').classList.add('show');
    } else {
      document.getElementById('error-msg').textContent = data.message || 'Email not found.';
      document.getElementById('error-banner').classList.add('show');
    }
  } catch(e) {
    document.getElementById('error-msg').textContent = 'Connection error. Please try again.';
    document.getElementById('error-banner').classList.add('show');
  } finally {
    btn.classList.remove('loading');
  }
}

document.addEventListener('keydown', e => {
  if (e.key === 'Enter') sendResetLink();
});
</script>
</body>
</html>