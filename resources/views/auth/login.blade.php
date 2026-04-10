<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Operations Monitoring</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
[data-theme="light"] {
  --bg:#fdf6f0;--surface:#fff8f5;--surface2:#F2E6D5;--surface3:#faeade;
  --border:#e8d5c4;--accent:#c9637a;--accent2:#e8a0b0;--accent3:#b07060;
  --done:#5a9a6a;--text:#3d2b22;--muted:#a08070;--muted2:#7a5c50;
  --pink:#FFC2CD;--cream:#F2E6D5;--shadow:rgba(201,99,122,.14);--glass:rgba(255,248,245,.92);
  --input-bg:#fff8f5;
}
[data-theme="dark"] {
  --bg:#1a1014;--surface:#231519;--surface2:#2d1c20;--surface3:#38222a;
  --border:#4a2e36;--accent:#ff8fa3;--accent2:#ffb3c1;--accent3:#d4907a;
  --done:#6dbf7e;--text:#f5e8e4;--muted:#a07888;--muted2:#c8a8b0;
  --pink:#ff8fa3;--cream:#d4907a;--shadow:rgba(0,0,0,.55);--glass:rgba(35,21,25,.94);
  --input-bg:#2d1c20;
}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
html,body{height:100%;}
body{
  font-family:'Poppins',sans-serif;background:var(--bg);color:var(--text);
  min-height:100vh;display:flex;align-items:center;justify-content:center;
  overflow:hidden;transition:background .4s ease,color .4s ease;
}
body::after{
  content:'';position:fixed;top:0;left:0;right:0;height:3px;
  background:linear-gradient(90deg,#FFC2CD,#e8a0b0,#F2E6D5,#c9637a,#b07060,#FFC2CD);
  background-size:300% 100%;animation:topbar 5s linear infinite;z-index:100;
}
body::before{
  content:'';position:fixed;inset:0;
  background-image:radial-gradient(circle,rgba(201,99,122,.09) 1px,transparent 1px);
  background-size:28px 28px;pointer-events:none;z-index:0;
  animation:dotDrift 20s ease-in-out infinite alternate;
}
[data-theme="dark"] body::before{
  background-image:radial-gradient(circle,rgba(255,143,163,.07) 1px,transparent 1px);
}
@keyframes topbar{to{background-position:300% 0;}}
@keyframes dotDrift{0%{background-position:0 0;}100%{background-position:28px 28px;}}
@keyframes floatOrb{0%,100%{transform:translate(0,0) scale(1);opacity:.4;}33%{transform:translate(30px,-20px) scale(1.1);opacity:.55;}66%{transform:translate(-20px,15px) scale(.95);opacity:.35;}}
@keyframes floatOrb2{0%,100%{transform:translate(0,0) scale(1);opacity:.3;}33%{transform:translate(-40px,20px) scale(1.08);opacity:.45;}66%{transform:translate(25px,-30px) scale(.92);opacity:.25;}}
@keyframes floatOrb3{0%,100%{transform:translate(0,0) scale(1);opacity:.25;}50%{transform:translate(20px,25px) scale(1.05);opacity:.4;}}
@keyframes slideUp{from{opacity:0;transform:translateY(24px);}to{opacity:1;transform:translateY(0);}}
@keyframes popIn{from{opacity:0;transform:scale(.95);}to{opacity:1;transform:scale(1);}}
@keyframes shake{0%,100%{transform:translateX(0);}20%{transform:translateX(-8px);}40%{transform:translateX(8px);}60%{transform:translateX(-5px);}80%{transform:translateX(5px);}}
@keyframes spin{to{transform:rotate(360deg);}}
@keyframes fadeSwitch{from{opacity:0;transform:translateY(8px);}to{opacity:1;transform:translateY(0);}}
.bg-orb{position:fixed;border-radius:50%;pointer-events:none;z-index:0;filter:blur(80px);}
.bg-orb-1{width:600px;height:600px;background:radial-gradient(circle,rgba(201,99,122,.28),transparent 70%);top:-150px;right:-100px;animation:floatOrb 18s ease-in-out infinite;}
.bg-orb-2{width:500px;height:500px;background:radial-gradient(circle,rgba(176,112,96,.22),transparent 70%);bottom:-100px;left:-100px;animation:floatOrb2 22s ease-in-out infinite;}
.bg-orb-3{width:350px;height:350px;background:radial-gradient(circle,rgba(255,194,205,.25),transparent 70%);top:35%;left:35%;animation:floatOrb3 15s ease-in-out infinite;}
[data-theme="dark"] .bg-orb-1{background:radial-gradient(circle,rgba(255,143,163,.22),transparent 70%);}
[data-theme="dark"] .bg-orb-2{background:radial-gradient(circle,rgba(212,144,122,.18),transparent 70%);}
[data-theme="dark"] .bg-orb-3{background:radial-gradient(circle,rgba(255,143,163,.14),transparent 70%);}
.auth-wrap{position:relative;z-index:1;width:min(440px,94vw);animation:slideUp .5s cubic-bezier(.22,1,.36,1) both;}
.auth-card{background:var(--glass);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border:1.5px solid var(--border);border-radius:24px;padding:40px 40px 36px;box-shadow:0 24px 64px var(--shadow);}
.brand{text-align:center;margin-bottom:32px;}
.brand-logo{display:inline-flex;align-items:center;justify-content:center;width:56px;height:56px;border-radius:16px;background:linear-gradient(135deg,var(--accent),var(--accent3));margin-bottom:14px;box-shadow:0 8px 24px var(--shadow);}
.brand-logo svg{width:28px;height:28px;color:#fff;}
.brand h1{font-size:1.55rem;font-weight:800;letter-spacing:-.4px;background:linear-gradient(135deg,var(--accent),var(--accent3));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.brand p{font-size:.68rem;color:var(--muted);margin-top:4px;letter-spacing:.1em;text-transform:uppercase;}
.tab-row{display:flex;gap:6px;background:var(--surface2);border-radius:12px;padding:4px;margin-bottom:28px;}
.tab{flex:1;padding:9px;border:none;border-radius:9px;font-family:'Poppins',sans-serif;font-size:.8rem;font-weight:600;cursor:pointer;transition:all .25s cubic-bezier(.22,1,.36,1);color:var(--muted);background:transparent;}
.tab.active{background:var(--accent);color:#fff;box-shadow:0 4px 14px var(--shadow);}
.tab:not(.active):hover{color:var(--text);background:var(--surface3);}
.panel{display:none;}
.panel.active{display:block;animation:fadeSwitch .25s ease both;}
.field{margin-bottom:16px;}
.field label{display:block;font-size:.62rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.1em;margin-bottom:6px;}
.input-wrap{position:relative;}
.input-wrap svg.input-icon{position:absolute;left:12px;top:50%;transform:translateY(-50%);width:15px;height:15px;color:var(--muted);pointer-events:none;transition:color .2s;}
.input-wrap input{width:100%;background:var(--input-bg);border:1.5px solid var(--border);border-radius:10px;padding:10px 12px 10px 38px;color:var(--text);font-family:'Poppins',sans-serif;font-size:.84rem;outline:none;transition:border-color .2s,box-shadow .2s,background .4s;}
.input-wrap input::placeholder{color:var(--muted);opacity:.5;}
.input-wrap input:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(201,99,122,.12);}
.input-wrap:focus-within svg.input-icon{color:var(--accent);}
.input-wrap .eye-btn{position:absolute;right:11px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--muted);padding:2px;display:flex;align-items:center;transition:color .2s;}
.input-wrap .eye-btn:hover{color:var(--accent);}
.input-wrap .eye-btn svg{width:15px;height:15px;}
.input-wrap input.has-eye{padding-right:38px;}
.field-row{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
.field.error .input-wrap input{border-color:var(--accent);}
.field-error{font-size:.65rem;color:var(--accent);margin-top:4px;display:none;}
.field.error .field-error{display:block;}
.shake{animation:shake .4s ease;}
.btn-submit{width:100%;padding:12px;background:linear-gradient(135deg,var(--accent),var(--accent3));border:none;border-radius:11px;color:#fff;font-family:'Poppins',sans-serif;font-size:.88rem;font-weight:700;cursor:pointer;box-shadow:0 6px 20px var(--shadow);transition:all .2s;margin-top:6px;display:flex;align-items:center;justify-content:center;gap:8px;letter-spacing:.02em;}
.btn-submit:hover{transform:translateY(-2px);box-shadow:0 10px 28px var(--shadow);filter:brightness(1.05);}
.btn-submit:active{transform:translateY(0);}
.btn-submit .spinner{width:16px;height:16px;border:2px solid rgba(255,255,255,.4);border-top-color:#fff;border-radius:50%;animation:spin .7s linear infinite;display:none;}
.btn-submit.loading .spinner{display:block;}
.btn-submit.loading .btn-text{display:none;}
.divider{display:flex;align-items:center;gap:12px;margin:20px 0;font-size:.65rem;color:var(--muted);text-transform:uppercase;letter-spacing:.1em;}
.divider::before,.divider::after{content:'';flex:1;height:1px;background:var(--border);}
.forgot{text-align:right;margin-top:-8px;margin-bottom:16px;}
.forgot a{font-size:.7rem;color:var(--muted);text-decoration:none;transition:color .2s;}
.forgot a:hover{color:var(--accent);}
.terms-note{font-size:.65rem;color:var(--muted);text-align:center;margin-top:14px;line-height:1.6;}
.terms-note a{color:var(--accent);text-decoration:none;}
.terms-note a:hover{text-decoration:underline;}
.success-banner{display:none;background:rgba(90,154,106,.1);border:1.5px solid rgba(90,154,106,.3);border-radius:10px;padding:12px 16px;font-size:.78rem;color:var(--done);margin-bottom:16px;align-items:center;gap:10px;}
.success-banner.show{display:flex;}
.success-banner svg{width:16px;height:16px;flex-shrink:0;}
.error-banner{display:none;background:rgba(201,99,122,.08);border:1.5px solid rgba(201,99,122,.25);border-radius:10px;padding:12px 16px;font-size:.78rem;color:var(--accent);margin-bottom:16px;align-items:center;gap:10px;}
.error-banner.show{display:flex;}
.error-banner svg{width:16px;height:16px;flex-shrink:0;}
.pw-strength{margin-top:6px;}
.pw-strength-bars{display:flex;gap:4px;margin-bottom:4px;}
.pw-bar{flex:1;height:3px;border-radius:99px;background:var(--border);transition:background .3s;}
.pw-bar.weak{background:#e05555;}.pw-bar.fair{background:var(--accent3);}.pw-bar.good{background:#b0a020;}.pw-bar.strong{background:var(--done);}
.pw-label{font-size:.62rem;color:var(--muted);}
.pw-reqs{margin-top:8px;display:none;flex-direction:column;gap:3px;}
.pw-reqs.show{display:flex;}
.pw-req{display:flex;align-items:center;gap:6px;font-size:.67rem;color:var(--muted);}
.pw-req svg{width:12px;height:12px;flex-shrink:0;opacity:.4;}
.pw-req.met{color:var(--done);}.pw-req.met svg{opacity:1;color:var(--done);}
.theme-toggle{position:fixed;top:20px;right:20px;z-index:200;display:flex;align-items:center;gap:7px;padding:6px 13px;border-radius:999px;border:1px solid var(--border);background:var(--surface);cursor:pointer;font-family:'Poppins',sans-serif;font-size:.69rem;color:var(--muted2);transition:all .3s;user-select:none;box-shadow:0 2px 12px var(--shadow);}
.theme-toggle:hover{border-color:var(--accent);color:var(--accent);}
.toggle-track{width:28px;height:15px;border-radius:999px;background:var(--border);position:relative;transition:background .3s;flex-shrink:0;}
.toggle-thumb{position:absolute;top:2px;left:2px;width:11px;height:11px;border-radius:50%;background:var(--accent);transition:transform .35s cubic-bezier(.34,1.56,.64,1);}
[data-theme="dark"] .toggle-thumb{transform:translateX(13px);}
[data-theme="dark"] .toggle-track{background:var(--accent3);}
.auth-footer{text-align:center;margin-top:20px;font-size:.63rem;color:var(--muted);letter-spacing:.05em;}
</style>
</head>
<body>

<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>
<div class="bg-orb bg-orb-3"></div>

<div class="theme-toggle" onclick="toggleTheme()">
  <span id="theme-icon">🌙</span>
  <div class="toggle-track"><div class="toggle-thumb"></div></div>
  <span id="theme-label">Dark</span>
</div>

<div class="auth-wrap">
  <div class="auth-card">

    <div class="brand">
      <div class="brand-logo">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
        </svg>
      </div>
      <h1>R Web Solutions</h1>
      <p>Operations Portal</p>
    </div>

    <div class="tab-row">
      <button class="tab active" id="tab-login" onclick="switchTab('login')">Sign In</button>
      <button class="tab" id="tab-register" onclick="switchTab('register')">Register</button>
    </div>

    {{-- ══ LOGIN PANEL ══ --}}
    <div class="panel active" id="panel-login">

      @if(session('login_error'))
        <div class="error-banner show">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          {{ session('login_error') }}
        </div>
      @endif

      <div class="success-banner" id="login-success">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        Logged in successfully! Redirecting…
      </div>
      <div class="error-banner" id="login-error">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span id="login-error-msg">Invalid email or password.</span>
      </div>

      <div class="field" id="lf-email">
        <label>Email Address</label>
        <div class="input-wrap">
          <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          <input type="email" id="l-email" placeholder="you@example.com" autocomplete="email" />
        </div>
        <div class="field-error">Please enter a valid email.</div>
      </div>

      <div class="field" id="lf-password">
        <label>Password</label>
        <div class="input-wrap">
          <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <input type="password" id="l-password" class="has-eye" placeholder="••••••••" autocomplete="current-password" />
          <button class="eye-btn" type="button" onclick="togglePw('l-password',this)" tabindex="-1">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
        <div class="field-error">Password is required.</div>
      </div>

      <div class="forgot"><a href="#">Forgot password?</a></div>

      <button class="btn-submit" id="btn-login" onclick="doLogin()">
        <span class="btn-text">Sign In</span>
        <div class="spinner"></div>
      </button>

      <div class="divider">or</div>
      <div class="terms-note">
        Don't have an account? <a href="#" onclick="switchTab('register');return false;">Register here</a>
      </div>
    </div>

    {{-- ══ REGISTER PANEL ══ --}}
    <div class="panel" id="panel-register">

      <div class="success-banner" id="reg-success">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        Account created! You can now sign in.
      </div>
      <div class="error-banner" id="reg-error">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span id="reg-error-msg">Something went wrong. Please try again.</span>
      </div>

      <div class="field-row">
        <div class="field" id="rf-fname">
          <label>First Name</label>
          <div class="input-wrap">
            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            <input type="text" id="r-fname" placeholder="Juan" autocomplete="given-name" />
          </div>
          <div class="field-error">Required.</div>
        </div>
        <div class="field" id="rf-lname">
          <label>Last Name</label>
          <div class="input-wrap">
            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            <input type="text" id="r-lname" placeholder="dela Cruz" autocomplete="family-name" />
          </div>
          <div class="field-error">Required.</div>
        </div>
      </div>

      <div class="field" id="rf-email">
        <label>Email Address</label>
        <div class="input-wrap">
          <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          <input type="email" id="r-email" placeholder="you@example.com" autocomplete="email" />
        </div>
        <div class="field-error">Please enter a valid email.</div>
      </div>

      <div class="field" id="rf-password">
        <label>Password</label>
        <div class="input-wrap">
          <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <input type="password" id="r-password" class="has-eye" placeholder="••••••••" autocomplete="new-password" oninput="checkStrength(this.value)" />
          <button class="eye-btn" type="button" onclick="togglePw('r-password',this)" tabindex="-1">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
        <div class="field-error">Password must be at least 8 characters.</div>
        <div class="pw-strength" id="pw-strength" style="display:none;">
          <div class="pw-strength-bars">
            <div class="pw-bar" id="bar1"></div><div class="pw-bar" id="bar2"></div>
            <div class="pw-bar" id="bar3"></div><div class="pw-bar" id="bar4"></div>
          </div>
          <span class="pw-label" id="pw-label">Too short</span>
        </div>
        <div class="pw-reqs" id="pw-reqs">
          <div class="pw-req" id="req-len">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            At least 8 characters
          </div>
          <div class="pw-req" id="req-upper">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            One uppercase letter
          </div>
          <div class="pw-req" id="req-num">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            One number
          </div>
        </div>
      </div>

      <div class="field" id="rf-confirm">
        <label>Confirm Password</label>
        <div class="input-wrap">
          <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <input type="password" id="r-confirm" class="has-eye" placeholder="••••••••" autocomplete="new-password" />
          <button class="eye-btn" type="button" onclick="togglePw('r-confirm',this)" tabindex="-1">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
        <div class="field-error">Passwords do not match.</div>
      </div>

      <button class="btn-submit" id="btn-register" onclick="doRegister()">
        <span class="btn-text">Create Account</span>
        <div class="spinner"></div>
      </button>

      <div class="terms-note" style="margin-top:14px;">
        By registering, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.<br>
        Already have an account? <a href="#" onclick="switchTab('login');return false;">Sign in</a>
      </div>
    </div>

  </div>
  <div class="auth-footer">© 2025 R Web Solutions · All rights reserved</div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

function switchTab(tab){
  document.querySelectorAll('.tab').forEach(t=>t.classList.remove('active'));
  document.querySelectorAll('.panel').forEach(p=>p.classList.remove('active'));
  document.getElementById('tab-'+tab).classList.add('active');
  document.getElementById('panel-'+tab).classList.add('active');
  ['login-success','login-error','reg-success','reg-error'].forEach(id=>{
    document.getElementById(id).classList.remove('show');
  });
}

function togglePw(id,btn){
  const inp=document.getElementById(id);
  const isText=inp.type==='text';
  inp.type=isText?'password':'text';
  btn.innerHTML=isText
    ?`<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`
    :`<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>`;
}

function checkStrength(val){
  const meter=document.getElementById('pw-strength');
  const reqs=document.getElementById('pw-reqs');
  if(!val){meter.style.display='none';reqs.classList.remove('show');return;}
  meter.style.display='block';reqs.classList.add('show');
  const hasLen=val.length>=8,hasUpper=/[A-Z]/.test(val),hasNum=/[0-9]/.test(val),hasSpec=/[^A-Za-z0-9]/.test(val);
  document.getElementById('req-len').classList.toggle('met',hasLen);
  document.getElementById('req-upper').classList.toggle('met',hasUpper);
  document.getElementById('req-num').classList.toggle('met',hasNum);
  const score=[hasLen,hasUpper,hasNum,hasSpec].filter(Boolean).length;
  ['bar1','bar2','bar3','bar4'].forEach((b,i)=>{
    const el=document.getElementById(b);
    el.className='pw-bar';
    if(i<score)el.classList.add(['weak','fair','good','strong'][score-1]);
  });
  document.getElementById('pw-label').textContent=['Too short','Too weak','Fair','Good','Strong 💪'][score]||'Too short';
}

function setError(id,show){document.getElementById(id).classList.toggle('error',show);}
function shakeField(id){
  const f=document.getElementById(id);
  f.classList.remove('shake');void f.offsetWidth;f.classList.add('shake');
  setTimeout(()=>f.classList.remove('shake'),500);
}

/* ── LOGIN — real fetch to Laravel ── */
async function doLogin(){
  const email=document.getElementById('l-email').value.trim();
  const pw=document.getElementById('l-password').value;
  let valid=true;
  const emailOk=/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  setError('lf-email',!emailOk); if(!emailOk){shakeField('lf-email');valid=false;}
  setError('lf-password',!pw);   if(!pw){shakeField('lf-password');valid=false;}
  if(!valid) return;

  const btn=document.getElementById('btn-login');
  btn.classList.add('loading');
  document.getElementById('login-error').classList.remove('show');

  try {
    const res = await fetch('{{ route("login.post") }}', {
      method: 'POST',
      headers: {'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
      body: JSON.stringify({ email, password: pw })
    });
    const data = await res.json();
    if (res.ok && data.success) {
      document.getElementById('login-success').classList.add('show');
      setTimeout(() => window.location.href = data.redirect, 1000);
    } else {
      document.getElementById('login-error-msg').textContent = data.message || 'Invalid email or password.';
      document.getElementById('login-error').classList.add('show');
    }
  } catch(e) {
    document.getElementById('login-error-msg').textContent = 'Connection error. Please try again.';
    document.getElementById('login-error').classList.add('show');
  } finally {
    btn.classList.remove('loading');
  }
}

/* ── REGISTER — real fetch to Laravel ── */
async function doRegister(){
  const fname=document.getElementById('r-fname').value.trim();
  const lname=document.getElementById('r-lname').value.trim();
  const email=document.getElementById('r-email').value.trim();
  const pw=document.getElementById('r-password').value;
  const confirm=document.getElementById('r-confirm').value;
  let valid=true;

  setError('rf-fname',!fname);  if(!fname){shakeField('rf-fname');valid=false;}
  setError('rf-lname',!lname);  if(!lname){shakeField('rf-lname');valid=false;}
  const emailOk=/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  setError('rf-email',!emailOk); if(!emailOk){shakeField('rf-email');valid=false;}
  const pwOk=pw.length>=8;
  setError('rf-password',!pwOk); if(!pwOk){shakeField('rf-password');valid=false;}
  const matchOk=pw===confirm&&confirm!=='';
  setError('rf-confirm',!matchOk); if(!matchOk){shakeField('rf-confirm');valid=false;}
  if(!valid) return;

  const btn=document.getElementById('btn-register');
  btn.classList.add('loading');
  document.getElementById('reg-error').classList.remove('show');

  try {
    const res = await fetch('{{ route("register") }}', {
      method: 'POST',
      headers: {'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
      body: JSON.stringify({ first_name:fname, last_name:lname, email, password:pw, password_confirmation:confirm })
    });
    const data = await res.json();
    if (res.ok && data.success) {
      document.getElementById('reg-success').classList.add('show');
      setTimeout(() => switchTab('login'), 1800);
    } else {
      const msg = data.errors
        ? Object.values(data.errors).flat()[0]
        : (data.message || 'Something went wrong.');
      document.getElementById('reg-error-msg').textContent = msg;
      document.getElementById('reg-error').classList.add('show');
    }
  } catch(e) {
    document.getElementById('reg-error-msg').textContent = 'Connection error. Please try again.';
    document.getElementById('reg-error').classList.add('show');
  } finally {
    btn.classList.remove('loading');
  }
}

document.addEventListener('keydown', e => {
  if(e.key!=='Enter') return;
  if(document.getElementById('panel-login').classList.contains('active')) doLogin();
  else doRegister();
});

function toggleTheme(){
  const html=document.documentElement;
  const dark=html.getAttribute('data-theme')==='dark';
  html.setAttribute('data-theme',dark?'light':'dark');
  document.getElementById('theme-icon').textContent=dark?'🌙':'☀️';
  document.getElementById('theme-label').textContent=dark?'Dark':'Light';
}
</script>
</body>
</html>