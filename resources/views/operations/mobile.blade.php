<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Operations Monitoring</title>
<link rel="icon" type="image/png" href="{{ asset('rweblogo.png') }}">
<link rel="apple-touch-icon" href="{{ asset('rweblogo.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
/* ══════════════════════════════════════════════
   THEME VARIABLES
══════════════════════════════════════════════ */
[data-theme="light"] {
  --bg:#fdf6f0;--surface:#fff8f5;--surface2:#F2E6D5;--surface3:#faeade;
  --border:#e8d5c4;--accent:#c9637a;--accent2:#e8a0b0;--accent3:#b07060;
  --done:#5a9a6a;--onhold:#b08020;--revision:#c96070;
  --text:#3d2b22;--muted:#a08070;--muted2:#7a5c50;
  --pink:#FFC2CD;--cream:#F2E6D5;--shadow:rgba(201,99,122,.14);--glass:rgba(255,248,245,.92);
}
[data-theme="dark"] {
  --bg:#1a1014;--surface:#231519;--surface2:#2d1c20;--surface3:#38222a;
  --border:#4a2e36;--accent:#ff8fa3;--accent2:#ffb3c1;--accent3:#d4907a;
  --done:#6dbf7e;--onhold:#d4a840;--revision:#ff7080;
  --text:#f5e8e4;--muted:#a07888;--muted2:#c8a8b0;
  --pink:#ff8fa3;--cream:#d4907a;--shadow:rgba(0,0,0,.55);--glass:rgba(35,21,25,.94);
}

*,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{font-family:'Poppins',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;overflow-x:hidden;transition:background .4s ease,color .4s ease;padding-bottom:100px;}
body::after{content:'';position:fixed;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,#FFC2CD,#e8a0b0,#F2E6D5,#c9637a,#b07060,#FFC2CD);background-size:300% 100%;animation:topbar 5s linear infinite;z-index:1000;}
@keyframes topbar{to{background-position:300% 0;}}

/* ── BG ORBS ── */
.bg-orb{position:fixed;border-radius:50%;pointer-events:none;z-index:0;filter:blur(80px);}
.bg-orb-1{width:340px;height:340px;background:radial-gradient(circle,rgba(201,99,122,.22),transparent 70%);top:-60px;right:-60px;animation:floatOrb 18s ease-in-out infinite;}
.bg-orb-2{width:260px;height:260px;background:radial-gradient(circle,rgba(176,112,96,.16),transparent 70%);bottom:120px;left:-60px;animation:floatOrb2 22s ease-in-out infinite;}
.bg-orb-3{width:200px;height:200px;background:radial-gradient(circle,rgba(255,194,205,.18),transparent 70%);top:45%;left:40%;animation:floatOrb3 15s ease-in-out infinite;}
[data-theme="dark"] .bg-orb-1{background:radial-gradient(circle,rgba(255,143,163,.18),transparent 70%);}
[data-theme="dark"] .bg-orb-2{background:radial-gradient(circle,rgba(212,144,122,.14),transparent 70%);}
[data-theme="dark"] .bg-orb-3{background:radial-gradient(circle,rgba(255,143,163,.12),transparent 70%);}

/* ── KEYFRAMES ── */
@keyframes floatOrb{0%,100%{transform:translate(0,0) scale(1);opacity:.4;}33%{transform:translate(20px,-12px) scale(1.08);opacity:.55;}66%{transform:translate(-12px,10px) scale(.94);opacity:.35;}}
@keyframes floatOrb2{0%,100%{transform:translate(0,0) scale(1);opacity:.3;}33%{transform:translate(-24px,16px) scale(1.06);opacity:.42;}66%{transform:translate(16px,-22px) scale(.93);opacity:.22;}}
@keyframes floatOrb3{0%,100%{transform:translate(0,0) scale(1);opacity:.25;}50%{transform:translate(16px,20px) scale(1.04);opacity:.38;}}
@keyframes fadeUp{from{opacity:0;transform:translateY(15px);}to{opacity:1;transform:translateY(0);}}
@keyframes modalIn{from{opacity:0;transform:translateY(30px) scale(.97);}to{opacity:1;transform:translateY(0) scale(1);}}
@keyframes toastIn{from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);}}
@keyframes spin{to{transform:rotate(360deg);}}
@keyframes blink{0%,100%{opacity:1}50%{opacity:.2}}
@keyframes wobble{0%,100%{transform:rotate(0);}25%{transform:rotate(-12deg);}75%{transform:rotate(12deg);}}
@keyframes overdueGlow{0%,100%{box-shadow:inset 0 0 0 2px transparent;}50%{box-shadow:inset 0 0 0 2px var(--revision);background:rgba(201,96,112,.08);}}
@keyframes cardIn{from{opacity:0;transform:translateX(20px);}to{opacity:1;transform:translateX(0);}}
@keyframes fadeIn{from{opacity:0}to{opacity:1}}

.container{position:relative;z-index:1;padding:20px 16px;}

/* ══════════════════════════════════════════════
   HEADER
══════════════════════════════════════════════ */
.header{margin-bottom:20px;animation:fadeUp .45s ease both;}
.header h1{font-size:1.65rem;font-weight:800;background:linear-gradient(135deg,var(--accent),var(--accent3));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;letter-spacing:-.4px;}
.header p{font-size:.6rem;color:var(--muted);text-transform:uppercase;letter-spacing:.12em;margin-top:3px;}
.header-row{display:flex;justify-content:space-between;align-items:flex-start;}

.theme-icon-btn{background:var(--surface2);border:1.5px solid var(--border);font-size:1.1rem;cursor:pointer;padding:7px 10px;border-radius:10px;transition:all .2s;line-height:1;color:var(--muted2);}
.theme-icon-btn:active{transform:scale(.88);}

/* ══════════════════════════════════════════════
   TOP ACTIONS
══════════════════════════════════════════════ */
.top-actions{display:flex;gap:8px;margin-bottom:16px;overflow-x:auto;padding-bottom:5px;align-items:center;position:relative;overflow-y:visible;z-index:2000;-webkit-overflow-scrolling:touch;}
.top-actions::-webkit-scrollbar{display:none;}
.action-pill{display:flex;align-items:center;gap:6px;padding:8px 14px;border-radius:12px;border:1.5px solid var(--border);background:var(--surface2);font-size:.7rem;color:var(--muted2);white-space:nowrap;cursor:pointer;font-family:'Poppins',sans-serif;font-weight:500;transition:all .2s;flex-shrink:0;}
.action-pill:active{transform:scale(.94);}
.action-pill svg{width:14px;height:14px;}
.badge-count{background:var(--accent);color:#fff;font-size:.6rem;padding:1px 6px;border-radius:10px;font-weight:700;display:none;margin-left:2px;}
.badge-count.rev{background:var(--revision);}
.badge-count.visible{display:inline-block;}

/* Export dropdown */
.export-pill-wrap{position:relative;}
.export-drop{display:none;position:absolute;top:calc(100% + 8px);right:0;z-index:3000;background:var(--surface);border:1px solid var(--border);border-radius:12px;overflow:hidden;box-shadow:0 10px 30px var(--shadow);min-width:160px;animation:modalIn .18s ease;}
.export-drop.open{display:block;}
.export-opt{padding:11px 16px;font-size:.76rem;cursor:pointer;display:flex;align-items:center;gap:9px;font-family:'Poppins',sans-serif;color:var(--text);transition:background .15s;}
.export-opt:hover,.export-opt:active{background:var(--surface2);}
.export-opt svg{width:14px;height:14px;flex-shrink:0;}

/* ══════════════════════════════════════════════
   STATS
══════════════════════════════════════════════ */
.stats-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:16px;}
.stat-card{background:var(--surface);border:1px solid var(--border);padding:10px 8px;border-radius:12px;text-align:center;box-shadow:0 4px 12px var(--shadow);animation:fadeUp .45s ease both;}
.stat-val{font-size:1.2rem;font-weight:700;display:block;}
.stat-label{font-size:.55rem;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin-top:1px;}

/* ══════════════════════════════════════════════
   SEARCH & FILTER
══════════════════════════════════════════════ */
.filter-section{margin-bottom:16px;animation:fadeUp .5s ease both;}
.search-wrap{position:relative;margin-bottom:10px;}
.search-wrap svg{position:absolute;left:11px;top:50%;transform:translateY(-50%);width:14px;height:14px;color:var(--muted);pointer-events:none;}
.search-input{width:100%;padding:10px 12px 10px 34px;border-radius:10px;border:1px solid var(--border);background:var(--surface);color:var(--text);font-family:'Poppins',sans-serif;font-size:.82rem;outline:none;transition:border-color .2s,box-shadow .2s,background .4s;}
.search-input:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(201,99,122,.1);}
.search-input::placeholder{color:var(--muted);opacity:.6;}

.filter-group{margin-bottom:9px;}
.filter-group-label{font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);margin-bottom:5px;}
.filter-pills-row{display:flex;gap:6px;overflow-x:auto;padding-bottom:3px;-webkit-overflow-scrolling:touch;}
.filter-pills-row::-webkit-scrollbar{display:none;}
.fpill{padding:5px 13px;border-radius:999px;border:1px solid var(--border);background:var(--surface);font-family:'Poppins',sans-serif;font-size:.68rem;font-weight:500;color:var(--muted2);cursor:pointer;transition:all .18s;white-space:nowrap;flex-shrink:0;user-select:none;}
.fpill:hover{border-color:var(--accent);color:var(--accent);}
.fpill.active{background:var(--accent);border-color:var(--accent);color:#fff;box-shadow:0 2px 8px var(--shadow);}
.fpill.active.f-hold{background:var(--onhold);border-color:var(--onhold);}
.fpill.active.f-rev{background:var(--revision);border-color:var(--revision);}
.fpill.active.f-done{background:var(--done);border-color:var(--done);}
.filter-clear{display:none;align-items:center;gap:5px;padding:5px 11px;border-radius:999px;border:1px dashed var(--border);background:transparent;font-family:'Poppins',sans-serif;font-size:.68rem;color:var(--muted);cursor:pointer;transition:all .18s;white-space:nowrap;flex-shrink:0;}
.filter-clear:hover{border-color:var(--revision);color:var(--revision);}
.filter-clear.visible{display:inline-flex;}

/* Sort row */
.sort-row{display:flex;gap:6px;align-items:center;margin-bottom:4px;flex-wrap:wrap;}
.sort-label{font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);flex-shrink:0;}
.sort-pill{padding:5px 11px;border-radius:999px;border:1px solid var(--border);background:var(--surface);font-family:'Poppins',sans-serif;font-size:.65rem;color:var(--muted2);cursor:pointer;transition:all .18s;white-space:nowrap;display:flex;align-items:center;gap:4px;}
.sort-pill:hover{border-color:var(--accent);color:var(--accent);}
.sort-pill.active{background:var(--surface2);border-color:var(--accent);color:var(--accent);font-weight:600;}
.sort-pill svg{width:10px;height:10px;}

/* ══════════════════════════════════════════════
   CARDS
══════════════════════════════════════════════ */
.card{background:var(--glass);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);border:1px solid var(--border);border-radius:18px;padding:16px;margin-bottom:14px;box-shadow:0 8px 24px var(--shadow);animation:fadeUp .4s ease both;transition:border-color .3s;}

.card-header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px;gap:10px;}
.client-info{flex:1;min-width:0;}
.client-info h3{font-size:1rem;font-weight:700;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.client-tag{font-size:.6rem;color:var(--muted);margin-top:1px;}

/* Status badge */
.status-badge{display:inline-flex;align-items:center;gap:5px;padding:5px 11px;border-radius:999px;font-size:.66rem;font-weight:700;font-family:'Poppins',sans-serif;box-shadow:0 2px 6px var(--shadow);cursor:pointer;white-space:nowrap;flex-shrink:0;transition:transform .15s;}
.status-badge:active{transform:scale(.93);}
.badge-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0;}
.s-done{background:rgba(90,154,106,.08);color:var(--done);border:1px solid rgba(90,154,106,.2);}
.s-done .badge-dot{background:var(--done);}
.s-onhold{background:rgba(176,128,32,.08);color:var(--onhold);border:1px solid rgba(176,128,32,.2);}
.s-onhold .badge-dot{background:var(--onhold);}
.s-revision{background:rgba(201,96,112,.08);color:var(--revision);border:1px solid rgba(201,96,112,.2);}
.s-revision .badge-dot{background:var(--revision);animation:blink 1.6s infinite;}
.status-drop-wrap{position:relative;flex-shrink:0;}
.status-dropdown{display:none;position:absolute;top:calc(100% + 6px);right:0;z-index:200;background:var(--surface);border:1px solid var(--border);border-radius:12px;overflow:hidden;box-shadow:0 10px 30px var(--shadow);min-width:140px;animation:modalIn .18s ease;}
.status-dropdown.open{display:block;}
.status-opt{padding:10px 14px;font-size:.76rem;cursor:pointer;display:flex;align-items:center;gap:8px;font-family:'Poppins',sans-serif;color:var(--text);transition:background .15s;}
.status-opt:hover,.status-opt:active{background:var(--surface2);}
.sopt-dot{width:8px;height:8px;border-radius:50%;}

/* Stage track */
.stage-track{display:flex;align-items:center;background:var(--surface2);border-radius:10px;padding:8px 10px;margin-bottom:12px;cursor:pointer;overflow:hidden;gap:0;transition:background .2s;}
.stage-track:active{background:var(--surface3);}
.stage-step{display:flex;align-items:center;gap:4px;flex:1;min-width:0;}
.stage-step-icon{width:18px;height:18px;border-radius:5px;display:flex;align-items:center;justify-content:center;font-size:9px;flex-shrink:0;}
.stage-step.done .stage-step-icon{background:rgba(90,154,106,.18);color:var(--done);}
.stage-step.active .stage-step-icon{background:rgba(201,99,122,.2);color:var(--accent);}
.stage-step.pending .stage-step-icon{background:var(--border);color:var(--muted);}
.stage-step-label{font-size:.58rem;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.stage-step.done .stage-step-label{color:var(--done);}
.stage-step.active .stage-step-label{color:var(--text);}
.stage-step.pending .stage-step-label{color:var(--muted);opacity:.6;}
.stage-divider{width:12px;height:1px;background:var(--border);flex-shrink:0;margin:0 2px;}
.stage-hint{font-size:.55rem;color:var(--muted);opacity:.6;margin-top:2px;text-align:right;font-style:italic;}

/* Info grid */
.info-grid{display:grid;grid-template-columns:1fr 1fr;gap:6px;margin-bottom:12px;}
.info-cell{background:var(--surface2);border-radius:9px;padding:7px 9px;}
.info-cell-label{font-size:.55rem;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:2px;}
.info-cell-value{font-size:.72rem;font-weight:600;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.info-cell-value.muted{color:var(--muted);font-weight:400;}
.mini-badge{display:inline-flex;align-items:center;gap:4px;font-size:.62rem;font-weight:700;padding:2px 7px;border-radius:6px;}
.mini-badge.done{background:rgba(90,154,106,.12);color:var(--done);}
.mini-badge.onhold{background:rgba(176,128,32,.12);color:var(--onhold);}
.mini-badge.revision{background:rgba(201,96,112,.12);color:var(--revision);}

/* Progress */
.progress-section{margin-bottom:10px;}
.progress-row{margin-bottom:8px;}
.progress-label{display:flex;justify-content:space-between;font-size:.63rem;color:var(--muted2);margin-bottom:3px;font-weight:600;}
.progress-label span:last-child{cursor:pointer;color:var(--accent);}
.progress-bar{height:5px;background:var(--border);border-radius:99px;overflow:hidden;cursor:pointer;}
.progress-fill{height:100%;border-radius:99px;transition:width .8s cubic-bezier(.34,1.56,.64,1);}
.pf-fe{background:linear-gradient(90deg,var(--pink),var(--accent));}
.pf-be{background:linear-gradient(90deg,var(--cream),var(--accent3));}
[data-theme="dark"] .pf-fe{background:linear-gradient(90deg,#ff8fa3,#ff5c7a);}
[data-theme="dark"] .pf-be{background:linear-gradient(90deg,#d4907a,#c9637a);}

/* Due notification */
.due-notif{font-size:.63rem;font-weight:600;padding:5px 10px;border-radius:8px;margin-bottom:10px;display:flex;align-items:center;gap:6px;}
.due-notif.urgent{background:rgba(201,96,112,.1);color:var(--revision);border:1px solid rgba(201,96,112,.2);}
.due-notif.warning{background:rgba(176,128,32,.1);color:var(--onhold);border:1px solid rgba(176,128,32,.2);}
.due-notif.safe{background:rgba(90,154,106,.1);color:var(--done);border:1px solid rgba(90,154,106,.2);}

/* Remark strip */
.remark-strip{background:var(--surface2);border-left:3px solid var(--border);border-radius:0 8px 8px 0;padding:7px 10px;margin-bottom:10px;font-size:.68rem;color:var(--muted);line-height:1.45;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.remark-strip-label{font-size:.55rem;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:3px;}

/* Card actions */
.card-actions{display:flex;gap:8px;margin-top:10px;}
.btn{padding:9px;border:none;border-radius:10px;font-weight:600;font-family:'Poppins',sans-serif;font-size:.73rem;cursor:pointer;flex:1;transition:transform .15s,background .2s;display:flex;align-items:center;justify-content:center;gap:5px;}
.btn:active{transform:scale(.93);}
.btn-outline{background:var(--surface2);border:1px solid var(--border);color:var(--muted2);}
.btn-danger{background:rgba(201,96,112,.08);color:var(--revision);border:1px solid rgba(201,96,112,.2);}

.card-overdue{border-color:var(--revision)!important;box-shadow:0 0 0 2px rgba(201,96,112,.18),0 8px 24px var(--shadow)!important;}

/* ══════════════════════════════════════════════
   DRAWERS
══════════════════════════════════════════════ */
.drawer-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.38);backdrop-filter:blur(5px);-webkit-backdrop-filter:blur(5px);z-index:2000;}
.drawer-overlay.open{display:block;}
.drawer{position:fixed;bottom:0;left:0;right:0;background:var(--surface);border-top:2px solid var(--border);border-radius:24px 24px 0 0;padding:24px 20px 36px;z-index:2001;transform:translateY(100%);transition:transform .35s cubic-bezier(.22,1,.36,1);max-height:88vh;overflow-y:auto;}
.drawer.open{transform:translateY(0);}
.drawer::-webkit-scrollbar{width:5px;}
.drawer::-webkit-scrollbar-thumb{background:var(--border);border-radius:3px;}
.drawer-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;}
.drawer-title{font-size:1.05rem;font-weight:700;font-family:'Poppins',sans-serif;color:var(--text);display:flex;align-items:center;gap:8px;}
.drawer-title svg{width:18px;height:18px;color:var(--accent);}
.drawer-close{padding:7px 15px;border-radius:10px;border:1.5px solid var(--border);background:var(--surface2);color:var(--muted2);font-family:'Poppins',sans-serif;font-size:.75rem;font-weight:600;cursor:pointer;transition:all .2s;}
.drawer-close:hover{border-color:var(--accent);color:var(--accent);}

/* ══════════════════════════════════════════════
   DETAILS DRAWER FORM
══════════════════════════════════════════════ */
.form-group{display:flex;flex-direction:column;gap:5px;margin-bottom:14px;}
.form-group label{font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);}
.mobile-input{width:100%;padding:10px 12px;border-radius:10px;border:1px solid var(--border);background:var(--surface2);color:var(--text);font-family:'Poppins',sans-serif;font-size:.82rem;outline:none;transition:border-color .2s,box-shadow .2s,background .4s;}
.mobile-input:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(201,99,122,.1);}
textarea.mobile-input{resize:vertical;}
.mobile-input option{background:var(--surface);}

/* ══════════════════════════════════════════════
   ADD CLIENT MODAL (bottom sheet)
══════════════════════════════════════════════ */
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.48);z-index:3000;align-items:flex-end;justify-content:center;backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px);}
.modal-overlay.open{display:flex;}
.modal-box{background:var(--surface);border-radius:24px 24px 0 0;border-top:2px solid var(--border);padding:24px 20px 48px;width:100%;max-height:90vh;overflow-y:auto;animation:modalIn .32s cubic-bezier(.22,1,.36,1);}
.modal-box::-webkit-scrollbar{width:5px;}
.modal-box::-webkit-scrollbar-thumb{background:var(--border);border-radius:3px;}
.modal-box h2{font-size:1.18rem;font-weight:800;color:var(--text);margin-bottom:20px;font-family:'Poppins',sans-serif;letter-spacing:-.3px;}
.modal-actions{display:flex;gap:10px;margin-top:20px;}
.btn-cancel{flex:1;padding:13px;border-radius:12px;border:1.5px solid var(--border);background:transparent;color:var(--muted2);font-family:'Poppins',sans-serif;font-size:.82rem;font-weight:600;cursor:pointer;transition:background .2s;}
.btn-cancel:hover{background:var(--surface2);}
.btn-save{flex:2;padding:13px;border-radius:12px;border:none;background:var(--accent);color:#fff;font-family:'Poppins',sans-serif;font-size:.84rem;font-weight:700;cursor:pointer;box-shadow:0 4px 14px var(--shadow);transition:background .2s,transform .15s;}
.btn-save:active{transform:scale(.96);}

/* ══════════════════════════════════════════════
   CONFIRM MODALS
══════════════════════════════════════════════ */
.confirm-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);z-index:4000;align-items:center;justify-content:center;padding:20px;}
.confirm-overlay.open{display:flex;}
.confirm-box{background:var(--glass);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border:1.5px solid var(--border);border-radius:20px;padding:30px 26px;width:100%;max-width:360px;text-align:center;box-shadow:0 24px 60px var(--shadow);font-family:'Poppins',sans-serif;animation:modalIn .3s cubic-bezier(.34,1.4,.64,1);}
.confirm-box .bin-icon{font-size:2.2rem;display:block;margin-bottom:10px;animation:wobble .6s ease;}
.confirm-box h3{font-size:1rem;font-weight:700;margin-bottom:6px;color:var(--text);}
.confirm-box p{font-size:.8rem;color:var(--muted);margin-bottom:22px;line-height:1.5;}
.confirm-box strong{color:var(--accent);}
.confirm-actions{display:flex;gap:10px;justify-content:center;}
.btn-confirm-cancel{padding:10px 20px;border-radius:10px;border:1.5px solid var(--border);background:transparent;color:var(--muted2);font-family:'Poppins',sans-serif;font-size:.82rem;font-weight:600;cursor:pointer;transition:background .2s;}
.btn-confirm-cancel:hover{background:var(--surface2);color:var(--text);}
.btn-confirm-delete{padding:10px 20px;border-radius:10px;border:none;background:linear-gradient(135deg,var(--revision),#a03050);color:#fff;font-family:'Poppins',sans-serif;font-size:.82rem;font-weight:700;cursor:pointer;box-shadow:0 4px 14px rgba(201,96,112,.3);transition:all .2s;}
.btn-confirm-delete:hover{transform:translateY(-1px);box-shadow:0 8px 22px rgba(201,96,112,.4);}

/* ══════════════════════════════════════════════
   ACTIVITY LOG DRAWER
══════════════════════════════════════════════ */
.log-entry{display:flex;gap:13px;padding:12px 0;border-bottom:1px solid var(--border);}
.log-entry:last-child{border-bottom:none;}
.log-dot-col{display:flex;flex-direction:column;align-items:center;flex-shrink:0;padding-top:2px;}
.log-dot{width:9px;height:9px;border-radius:50%;flex-shrink:0;border:2px solid var(--surface);}
.log-line{flex:1;width:1px;background:var(--border);min-height:18px;margin-top:4px;}
.log-entry:last-child .log-line{display:none;}
.log-content{flex:1;min-width:0;}
.log-action{font-size:.78rem;font-weight:600;color:var(--text);font-family:'Poppins',sans-serif;}
.log-detail{font-size:.7rem;color:var(--muted);margin-top:2px;line-height:1.4;}
.log-time{font-size:.62rem;color:var(--muted);margin-top:3px;}
.log-empty{text-align:center;padding:50px 20px;color:var(--muted);}
.log-empty-icon{font-size:2.8rem;opacity:.4;margin-bottom:10px;}
.log-empty p{font-size:.82rem;line-height:1.5;}

/* Log footer actions */
.log-footer{display:flex;justify-content:space-between;align-items:center;padding-top:14px;border-top:1px solid var(--border);margin-top:4px;flex-wrap:wrap;gap:8px;}
.log-footer-note{font-size:.62rem;color:var(--muted);line-height:1.4;}
.log-clear-btn{padding:8px 16px;border-radius:10px;border:1.5px solid var(--border);background:transparent;color:var(--muted);font-family:'Poppins',sans-serif;font-size:.75rem;font-weight:500;cursor:pointer;transition:all .2s;}
.log-clear-btn:hover{border-color:var(--revision);color:var(--revision);}

/* ══════════════════════════════════════════════
   RECYCLE BIN DRAWER
══════════════════════════════════════════════ */
.bin-card{background:var(--surface2);border:1.5px solid var(--border);border-radius:14px;padding:14px 16px;margin-bottom:10px;animation:cardIn .32s cubic-bezier(.22,1,.36,1) both;transition:border-color .2s;}
.bin-card:hover{border-color:var(--accent2);}
.bin-card-name{font-weight:700;font-size:.9rem;color:var(--text);}
.bin-card-tag{font-size:.62rem;color:var(--muted);margin-bottom:8px;margin-top:1px;}
.bin-card-meta{display:flex;flex-wrap:wrap;gap:5px;margin-top:6px;}
.bin-meta-pill{font-size:.62rem;padding:2px 8px;border-radius:6px;border:1px solid var(--border);background:var(--surface);color:var(--muted2);}
.bin-deleted-at{font-size:.6rem;color:var(--muted);margin-top:6px;display:flex;align-items:center;gap:3px;}
.bin-deleted-at svg{width:10px;height:10px;opacity:.6;}
.bin-card-actions{display:flex;gap:8px;margin-top:10px;}
.restore-btn{flex:1;display:flex;align-items:center;justify-content:center;gap:6px;padding:9px;border-radius:10px;border:1.5px solid rgba(90,154,106,.4);background:rgba(90,154,106,.08);color:var(--done);font-family:'Poppins',sans-serif;font-size:.75rem;font-weight:600;cursor:pointer;transition:all .2s;}
.restore-btn:active{transform:scale(.94);}
.perm-delete-btn{flex:1;display:flex;align-items:center;justify-content:center;gap:6px;padding:9px;border-radius:10px;border:1.5px solid rgba(201,96,112,.4);background:rgba(201,96,112,.08);color:var(--revision);font-family:'Poppins',sans-serif;font-size:.75rem;font-weight:600;cursor:pointer;transition:all .2s;}
.perm-delete-btn:active{transform:scale(.94);}

.bin-footer{display:flex;justify-content:space-between;align-items:center;padding-top:14px;border-top:1px solid var(--border);margin-top:4px;flex-wrap:wrap;gap:8px;}
.bin-footer-note{font-size:.62rem;color:var(--muted);line-height:1.4;}
.btn-empty-bin{padding:9px 18px;border-radius:10px;border:1.5px solid rgba(201,96,112,.4);background:rgba(201,96,112,.08);color:var(--revision);font-family:'Poppins',sans-serif;font-size:.76rem;font-weight:600;cursor:pointer;transition:all .2s;white-space:nowrap;}
.btn-empty-bin:hover{background:rgba(201,96,112,.15);}
.bin-empty{text-align:center;padding:50px 20px;color:var(--muted);}
.bin-empty-icon{font-size:2.8rem;opacity:.4;margin-bottom:10px;}
.bin-empty p{font-size:.82rem;line-height:1.5;}

/* ══════════════════════════════════════════════
   OVERDUE POPUP
══════════════════════════════════════════════ */
.overdue-overlay{position:fixed;inset:0;background:rgba(0,0,0,.48);backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);z-index:9997;display:flex;align-items:flex-end;justify-content:center;animation:fadeIn .35s ease;padding:0;}
.overdue-popup{position:relative;z-index:9998;background:var(--glass);backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);border:1.5px solid rgba(201,96,112,.35);border-radius:24px 24px 0 0;padding:28px 22px 40px;width:100%;max-height:80vh;overflow-y:auto;box-shadow:0 -16px 48px rgba(201,96,112,.2);animation:modalIn .4s cubic-bezier(.22,1,.36,1);font-family:'Poppins',sans-serif;}
.overdue-popup::-webkit-scrollbar{display:none;}
.overdue-popup-header{display:flex;align-items:center;gap:12px;margin-bottom:14px;}
.overdue-popup-icon{font-size:1.8rem;animation:wobble .6s ease;flex-shrink:0;}
.overdue-popup-title{font-size:1.05rem;font-weight:800;color:var(--revision);letter-spacing:-.2px;}
.overdue-popup-subtitle{font-size:.68rem;color:var(--muted);margin-top:2px;}
.overdue-divider{height:1px;background:var(--border);margin:14px 0;}
.overdue-list{list-style:none;display:flex;flex-direction:column;gap:8px;margin-bottom:14px;max-height:200px;overflow-y:auto;}
.overdue-list li{display:flex;align-items:center;justify-content:space-between;gap:8px;padding:9px 12px;background:rgba(201,96,112,.06);border:1px solid rgba(201,96,112,.18);border-radius:10px;font-size:.76rem;color:var(--text);font-weight:500;}
.overdue-list li .ol-name{display:flex;align-items:center;gap:6px;}
.overdue-list li .ol-name::before{content:'⚠';font-size:.68rem;color:var(--revision);flex-shrink:0;}
.overdue-list li .ol-days{font-size:.65rem;font-weight:700;color:var(--revision);background:rgba(201,96,112,.12);border-radius:6px;padding:2px 7px;white-space:nowrap;flex-shrink:0;}
.overdue-more{font-size:.68rem;color:var(--muted);text-align:center;padding:3px 0 6px;}
.overdue-popup-actions{display:flex;gap:10px;}
.overdue-popup-dismiss{flex:1;padding:11px;border-radius:11px;border:1.5px solid var(--border);background:transparent;color:var(--muted2);font-family:'Poppins',sans-serif;font-size:.8rem;font-weight:600;cursor:pointer;transition:all .2s;}
.overdue-popup-view{flex:2;padding:11px;border-radius:11px;border:none;background:linear-gradient(135deg,var(--revision),#a03050);color:#fff;font-family:'Poppins',sans-serif;font-size:.8rem;font-weight:700;cursor:pointer;box-shadow:0 4px 14px rgba(201,96,112,.35);transition:all .2s;}

/* ══════════════════════════════════════════════
   TOAST & LOADING
══════════════════════════════════════════════ */
.toast{position:fixed;bottom:28px;left:16px;right:16px;background:var(--text);color:var(--bg);padding:13px 20px;border-radius:13px;font-size:.8rem;font-weight:600;font-family:'Poppins',sans-serif;z-index:9999;box-shadow:0 8px 24px var(--shadow);animation:toastIn .3s ease;}
.loading-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.32);backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px);z-index:5000;align-items:center;justify-content:center;}
.loading-overlay.open{display:flex;}
.loading-box{background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:24px 32px;text-align:center;box-shadow:0 16px 50px var(--shadow);}
.loading-spinner{width:28px;height:28px;border:3px solid var(--border);border-top-color:var(--accent);border-radius:50%;animation:spin .8s linear infinite;margin:0 auto 10px;}
.loading-box p{font-size:.8rem;color:var(--muted);font-family:'Poppins',sans-serif;}

/* ══════════════════════════════════════════════
   FLOATING ADD
══════════════════════════════════════════════ */
.floating-add{position:fixed;bottom:28px;right:22px;padding:14px 22px;border-radius:16px;background:var(--accent);color:#fff;display:flex;align-items:center;gap:8px;box-shadow:0 8px 24px var(--shadow);border:none;z-index:1500;font-size:.84rem;font-weight:700;font-family:'Poppins',sans-serif;cursor:pointer;transition:transform .15s,background .2s;}
.floating-add:active{transform:scale(.9);}
.floating-add svg{width:16px;height:16px;}

.no-results{text-align:center;padding:60px 20px;color:var(--muted);}
.no-results div{font-size:3rem;margin-bottom:10px;}
.no-results p{font-size:.85rem;}
</style>
</head>
<body>
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>
<div class="bg-orb bg-orb-3"></div>

<div class="container">

  <!-- ══ HEADER ══ -->
  <div class="header">
    <div class="header-row">
      <div>
        <h1>Operations Monitoring</h1>
        <p>Web Development Pipeline &nbsp;·&nbsp; Tap any card to edit</p>
      </div>
      <button class="theme-icon-btn" onclick="toggleTheme()" id="theme-icon-btn" title="Toggle theme">🌙</button>
    </div>
  </div>

  <!-- ══ TOP ACTIONS ══ -->
  <div class="top-actions">
    <!-- Activity Log -->
    <div class="action-pill" onclick="openLog()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      Activity Log
      <span class="badge-count" id="log-badge-count">0</span>
    </div>

    <!-- Recycle Bin -->
    <div class="action-pill" onclick="openBin()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
      Recycle Bin
      <span class="badge-count rev" id="bin-badge-count">0</span>
    </div>

    <!-- Export -->
    <div class="export-pill-wrap">
      <div class="action-pill" onclick="toggleExportDrop(event)">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
        Export
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:10px;height:10px;opacity:.5"><polyline points="6 9 12 15 18 9"/></svg>
      </div>
      <div class="export-drop" id="export-drop">
        <div class="export-opt" onclick="exportXLSX()">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          Export XLSX
        </div>
        <div class="export-opt" onclick="exportPDF()">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="13" x2="15" y2="13"/><line x1="9" y1="17" x2="15" y2="17"/></svg>
          Export PDF
        </div>
      </div>
    </div>
  </div>

  <!-- ══ STATS ══ -->
  <div class="stats-grid">
    <div class="stat-card"><span class="stat-val" style="color:var(--done)" id="cnt-done">0</span><span class="stat-label">Done</span></div>
    <div class="stat-card"><span class="stat-val" style="color:var(--onhold)" id="cnt-hold">0</span><span class="stat-label">On Hold</span></div>
    <div class="stat-card"><span class="stat-val" style="color:var(--revision)" id="cnt-rev">0</span><span class="stat-label">Revisions</span></div>
  </div>

  <!-- ══ SEARCH & FILTER ══ -->
  <div class="filter-section">
    <div class="search-wrap">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" id="search-input" placeholder="Search clients…" class="search-input" oninput="applyFilters()">
    </div>

    <div class="filter-group">
      <div class="filter-group-label">Overall Status</div>
      <div class="filter-pills-row">
        <div class="fpill f-done" onclick="toggleFilter('status','Done')"      id="f-done">Done</div>
        <div class="fpill f-hold" onclick="toggleFilter('status','On Hold')"   id="f-hold">On Hold</div>
        <div class="fpill f-rev"  onclick="toggleFilter('status','Revisions')" id="f-rev">Revisions</div>
      </div>
    </div>

    <div class="filter-group">
      <div class="filter-group-label">UI/UX Status</div>
      <div class="filter-pills-row">
        <div class="fpill f-done" onclick="toggleFilter('uiux_status','Done')"      id="f-uiux-done">Done</div>
        <div class="fpill f-hold" onclick="toggleFilter('uiux_status','On Hold')"   id="f-uiux-hold">On Hold</div>
        <div class="fpill f-rev"  onclick="toggleFilter('uiux_status','Revisions')" id="f-uiux-rev">Revisions</div>
      </div>
    </div>

    <div class="filter-group">
      <div class="filter-group-label">Stage</div>
      <div class="filter-pills-row">
        <div class="fpill" onclick="toggleFilter('stage','Homepage')"       id="f-hp">Homepage</div>
        <div class="fpill" onclick="toggleFilter('stage','Sitemap')"        id="f-sm">Sitemap</div>
        <div class="fpill" onclick="toggleFilter('stage','All Pages')"      id="f-ap">All Pages</div>
        <div class="fpill" onclick="toggleFilter('stage','Final Homepage')" id="f-fh">Final</div>
        <button class="filter-clear" id="filter-clear" onclick="clearFilters()">
          <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
          Clear
        </button>
      </div>
    </div>

    <!-- Sort -->
    <div class="sort-row">
      <span class="sort-label">Sort</span>
      <div class="sort-pill" id="sort-client" onclick="sortBy('client')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l4-4 4 4M7 5v14M21 15l-4 4-4-4M17 19V5"/></svg>
        Name
      </div>
      <div class="sort-pill" id="sort-due" onclick="sortBy('due')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
        Due Date
      </div>
      <div class="sort-pill" id="sort-fe" onclick="sortBy('fe')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
        Progress
      </div>
    </div>
  </div>

  <!-- ══ CARD LIST ══ -->
  <div id="mobile-list"></div>
</div>

<!-- Floating Add Button -->
<button class="floating-add" onclick="openAddModal()">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
  Add Client
</button>

<!-- ══ ACTIVITY LOG DRAWER ══ -->
<div class="drawer-overlay" id="log-overlay" onclick="closeLog()"></div>
<div class="drawer" id="log-drawer">
  <div class="drawer-header">
    <span class="drawer-title">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      Activity Log
    </span>
    <button class="drawer-close" onclick="closeLog()">Close</button>
  </div>
  <div id="log-body"></div>
  <div class="log-footer" style="margin-top:16px;">
    <div class="log-footer-note">All field edits and changes recorded here.</div>
    <button class="log-clear-btn" onclick="askClearLog()">Clear Log</button>
  </div>
</div>

<!-- ══ DETAILS DRAWER ══ -->
<div class="drawer-overlay" id="details-overlay" onclick="closeDetails()"></div>
<div class="drawer" id="details-drawer">
  <div class="drawer-header">
    <span class="drawer-title" id="det-client-name">Edit Details</span>
    <button class="drawer-close" onclick="saveAndCloseDetails()">Done</button>
  </div>
  <div id="details-body"></div>
</div>

<!-- ══ RECYCLE BIN DRAWER ══ -->
<div class="drawer-overlay" id="bin-overlay" onclick="closeBin()"></div>
<div class="drawer" id="bin-drawer">
  <div class="drawer-header">
    <span class="drawer-title">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
      Recycle Bin
    </span>
    <button class="drawer-close" onclick="closeBin()">Close</button>
  </div>
  <div id="bin-body"></div>
  <div class="bin-footer" style="margin-top:16px;">
    <div class="bin-footer-note">Deleted records are kept here.<br>Restore anytime or empty to permanently remove.</div>
    <button class="btn-empty-bin" onclick="askEmptyBin()">Empty Bin 🗑</button>
  </div>
</div>

<!-- ══ ADD CLIENT MODAL ══ -->
<div class="modal-overlay" id="add-modal" onclick="handleAddModalBg(event)">
  <div class="modal-box">
    <h2>✦ Add New Client</h2>
    <div class="form-group">
      <label>Client Name *</label>
      <input type="text" id="f-client" class="mobile-input" placeholder="e.g. Acme Corp">
    </div>
    <div class="form-group">
      <label>Proposal Stage</label>
      <select id="f-stage" class="mobile-input">
        <option>Sitemap</option><option>Homepage</option><option>All Pages</option><option>Final Homepage</option>
      </select>
    </div>
    <div class="form-group">
      <label>Proposal Assigned</label>
      <input type="text" id="f-prop-assign" class="mobile-input" placeholder="Name...">
    </div>
    <div class="form-group">
      <label>UI/UX Status</label>
      <select id="f-uiux-status" class="mobile-input">
        <option>On Hold</option><option>Done</option><option>Revisions</option>
      </select>
    </div>
    <div class="form-group">
      <label>UI/UX Assigned</label>
      <input type="text" id="f-uiux-assign" class="mobile-input" placeholder="Name...">
    </div>
    <div class="form-group">
      <label>Dev Assigned</label>
      <input type="text" id="f-dev-assign" class="mobile-input" placeholder="Name...">
    </div>
    <div class="form-group">
      <label>Front-end Status</label>
      <select id="f-dev-fe" class="mobile-input">
        <option value="">—</option><option>Done</option><option>In Progress</option><option>Pending</option>
      </select>
    </div>
    <div class="form-group">
      <label>Back-end Status</label>
      <select id="f-dev-be" class="mobile-input">
        <option value="">—</option><option>Done</option><option>In Progress</option><option>Pending</option>
      </select>
    </div>
    <div class="form-group">
      <label>Overall Status</label>
      <select id="f-status" class="mobile-input">
        <option>On Hold</option><option>Done</option><option>Revisions</option>
      </select>
    </div>
    <div class="form-group">
      <label>Due Date</label>
      <input type="date" id="f-due" class="mobile-input">
    </div>
    <div class="form-group">
      <label>Frontend %</label>
      <input type="number" id="f-fe" class="mobile-input" min="0" max="100" placeholder="0–100">
    </div>
    <div class="form-group">
      <label>Backend %</label>
      <input type="number" id="f-be" class="mobile-input" min="0" max="100" placeholder="0–100">
    </div>
    <div class="form-group">
      <label>Proposal Remarks</label>
      <textarea id="f-prop-remark" class="mobile-input" rows="2" placeholder="Notes about this proposal..."></textarea>
    </div>
    <div class="form-group">
      <label>Final Remarks</label>
      <textarea id="f-final-remark" class="mobile-input" rows="2" placeholder="Closing notes, delivery status..."></textarea>
    </div>
    <div class="modal-actions">
      <button class="btn-cancel" onclick="closeAddModal()">Cancel</button>
      <button class="btn-save" onclick="addRow()">Add Client</button>
    </div>
  </div>
</div>

<!-- ══ CONFIRM: Move to Bin ══ -->
<div class="confirm-overlay" id="confirm-modal">
  <div class="confirm-box">
    <span class="bin-icon">🗑️</span>
    <h3>Move to Recycle Bin?</h3>
    <p>This will move <strong id="confirm-name"></strong> to the Recycle Bin.<br>You can restore it anytime.</p>
    <div class="confirm-actions">
      <button class="btn-confirm-cancel" onclick="closeConfirm()">Cancel</button>
      <button class="btn-confirm-delete" onclick="confirmDelete()">Move to Bin</button>
    </div>
  </div>
</div>

<!-- ══ CONFIRM: Permanent Delete ══ -->
<div class="confirm-overlay" id="confirm-perm-modal">
  <div class="confirm-box">
    <span class="bin-icon">⚠️</span>
    <h3>Permanently Delete?</h3>
    <p>This record will be gone forever.<br>This action cannot be undone.</p>
    <div class="confirm-actions">
      <button class="btn-confirm-cancel" onclick="closePermConfirm()">Cancel</button>
      <button class="btn-confirm-delete" onclick="confirmPermDelete()">Delete Forever</button>
    </div>
  </div>
</div>

<!-- ══ CONFIRM: Clear Log ══ -->
<div class="confirm-overlay" id="confirm-clear-log-modal">
  <div class="confirm-box">
    <span class="bin-icon">📋</span>
    <h3>Clear Activity Log?</h3>
    <p>All activity history will be permanently deleted.<br>This cannot be undone.</p>
    <div class="confirm-actions">
      <button class="btn-confirm-cancel" onclick="closeClearLogConfirm()">Cancel</button>
      <button class="btn-confirm-delete" onclick="confirmClearLog()">Clear All</button>
    </div>
  </div>
</div>

<!-- ══ CONFIRM: Empty Bin ══ -->
<div class="confirm-overlay" id="confirm-empty-bin-modal">
  <div class="confirm-box">
    <span class="bin-icon">🪣</span>
    <h3>Empty Recycle Bin?</h3>
    <p>This will permanently delete all items.<br>This action cannot be undone.</p>
    <div class="confirm-actions">
      <button class="btn-confirm-cancel" onclick="closeEmptyBinConfirm()">Cancel</button>
      <button class="btn-confirm-delete" onclick="confirmEmptyBin()">Empty Bin</button>
    </div>
  </div>
</div>

<!-- ══ LOADING OVERLAY ══ -->
<div class="loading-overlay" id="loading-overlay">
  <div class="loading-box">
    <div class="loading-spinner"></div>
    <p id="loading-msg">Preparing export…</p>
  </div>
</div>

<!-- External libs -->
<script src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>

<script>
/* ════════════════════════════════════════════════
   CONFIG
════════════════════════════════════════════════ */
const STAGES   = ['Sitemap','Homepage','All Pages','Final Homepage'];
const STATUSES = ['Done','On Hold','Revisions'];
const CSRF     = document.querySelector('meta[name="csrf-token"]').content;
const ROUTES   = {
  store   : '/operations',
  update  : id => `/operations/${id}`,
  destroy : id => `/operations/${id}`,
  restore : id => `/operations/${id}/restore`,
  force   : id => `/operations/${id}/force`,
  clearLogs: '/activity-logs/clear',
  emptyBin : '/operations/trash/empty',
};

let rows        = @json($rows);
let trash       = @json($trash);
let activityLog = @json($logs);

let sortKey = null, sortDir = 'asc';
let pendingDeleteIdx   = null;
let pendingPermDeleteId = null; // store the DB id for perm delete
let activeFilters = { status:null, uiux_status:null, stage:null };
let currentDetailIdx = null;

/* ════════════════════════════════════════════════
   HELPERS
════════════════════════════════════════════════ */
function escHtml(s){ return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }
function statusCls(s){ return {Done:'s-done','On Hold':'s-onhold',Revisions:'s-revision'}[s]||'s-onhold'; }

const STAGE_SHORT = { 'Sitemap':'Sitemap','Homepage':'Home','All Pages':'Pages','Final Homepage':'Final' };

const SVG_CHECK = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" width="9" height="9"><polyline points="20 6 9 17 4 12"/></svg>`;
const SVG_ARROW = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" width="9" height="9"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="13 6 19 12 13 18"/></svg>`;
const SVG_DOT   = `<svg viewBox="0 0 10 10" width="6" height="6"><circle cx="5" cy="5" r="3" fill="currentColor" opacity=".4"/></svg>`;

function buildStageTrack(stage){
  const ci = STAGES.indexOf(stage);
  return STAGES.map((s,i)=>{
    const cls  = i < ci ? 'done' : (i===ci ? 'active' : 'pending');
    const icon = i < ci ? SVG_CHECK : (i===ci ? SVG_ARROW : SVG_DOT);
    const div  = i < STAGES.length-1 ? `<div class="stage-divider"></div>` : '';
    return `<div class="stage-step ${cls}"><div class="stage-step-icon">${icon}</div><span class="stage-step-label">${STAGE_SHORT[s]||s}</span></div>${div}`;
  }).join('');
}

function getDueNotif(d){
  if(!d) return '';
  const due=new Date(d+'T00:00:00'),today=new Date();
  today.setHours(0,0,0,0);
  const diff=Math.floor((due-today)/(1000*60*60*24));
  if(diff<0)  return `<div class="due-notif urgent">⚠️ Overdue by ${Math.abs(diff)} day${Math.abs(diff)!==1?'s':''}</div>`;
  if(diff===0) return `<div class="due-notif urgent">⚠️ Due today!</div>`;
  if(diff===1) return `<div class="due-notif urgent">⚠️ Due tomorrow</div>`;
  if(diff<=7)  return `<div class="due-notif warning">⏳ Due in ${diff} days</div>`;
  return `<div class="due-notif safe">✅ On schedule</div>`;
}

function fmtDateTime(ts){
  if(!ts) return '';
  const d=new Date(ts);
  return d.toLocaleString('en-US',{month:'short',day:'numeric',hour:'numeric',minute:'2-digit'});
}
function fmtTime(ts){
  if(!ts) return '—';
  const d=new Date(ts),diff=Date.now()-d.getTime(),mins=Math.floor(diff/60000),hrs=Math.floor(diff/3600000),days=Math.floor(diff/86400000);
  if(mins<1) return 'just now'; if(mins<60) return `${mins}m ago`; if(hrs<24) return `${hrs}h ago`;
  if(days<7) return `${days}d ago`;
  return d.toLocaleDateString('en-US',{month:'short',day:'numeric'});
}

/* ════════════════════════════════════════════════
   THEME
════════════════════════════════════════════════ */
function applyTheme(theme){
  document.documentElement.setAttribute('data-theme', theme);
  document.getElementById('theme-icon-btn').textContent = theme==='dark' ? '☀️' : '🌙';
  localStorage.setItem('theme', theme);
}
function toggleTheme(){
  const isDark = document.documentElement.getAttribute('data-theme')==='dark';
  applyTheme(isDark ? 'light' : 'dark');
  toast(isDark ? '☀️ Light mode' : '🌙 Dark mode');
}
applyTheme(localStorage.getItem('theme')||'light');

/* ════════════════════════════════════════════════
   TOAST & LOADING
════════════════════════════════════════════════ */
let toastTimer;
function toast(msg){
  document.querySelector('.toast')?.remove();
  clearTimeout(toastTimer);
  const el=document.createElement('div');
  el.className='toast';el.textContent=msg;
  document.body.appendChild(el);
  toastTimer=setTimeout(()=>el.remove(),2400);
}
function showLoading(msg='Loading…'){ document.getElementById('loading-msg').textContent=msg; document.getElementById('loading-overlay').classList.add('open'); }
function hideLoading(){ document.getElementById('loading-overlay').classList.remove('open'); }

/* ════════════════════════════════════════════════
   AJAX PATCH
════════════════════════════════════════════════ */
async function ajaxPatch(idx, field, value){
  try{
    await fetch(ROUTES.update(rows[idx].id),{
      method:'PATCH',
      headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
      body:JSON.stringify({field,value,edited_by:'Mobile User'})
    });
  }catch(e){console.error('Patch failed',e);}
}

/* ════════════════════════════════════════════════
   ACTIVITY LOG
════════════════════════════════════════════════ */
let logLastSeenCount = activityLog.length;
const LOG_COLORS = {add:'var(--done)',edit:'var(--accent)',status:'var(--onhold)',delete:'var(--revision)',restore:'var(--done)'};

function logActivity(type,message,detail=''){
  activityLog.unshift({type,message,detail,ts:Date.now()});
  if(activityLog.length>200) activityLog.pop();
  updateBadges();
}

function updateBadges(){
  // Log badge
  const lb=document.getElementById('log-badge-count');
  const unseen=activityLog.length-logLastSeenCount;
  lb.textContent=unseen>99?'99+':unseen;
  lb.classList.toggle('visible', unseen>0);

  // Bin badge
  const bb=document.getElementById('bin-badge-count');
  bb.textContent=trash.length;
  bb.classList.toggle('visible', trash.length>0);
}

function openLog(){
  document.getElementById('log-overlay').classList.add('open');
  document.getElementById('log-drawer').classList.add('open');
  logLastSeenCount=activityLog.length;
  updateBadges();
  renderLog();
}
function closeLog(){
  document.getElementById('log-overlay').classList.remove('open');
  document.getElementById('log-drawer').classList.remove('open');
}
function renderLog(){
  const body=document.getElementById('log-body');
  if(!activityLog.length){
    body.innerHTML=`<div class="log-empty"><div class="log-empty-icon">📋</div><p>No activity yet.<br>Edits and changes will appear here.</p></div>`;
    return;
  }
  body.innerHTML=activityLog.map((e,i)=>{
    const color=LOG_COLORS[e.type]||'var(--muted)';
    const time=e.created_at||e.ts;
    return `<div class="log-entry" style="animation-delay:${i*.025}s">
      <div class="log-dot-col"><div class="log-dot" style="background:${color};border-color:${color}"></div><div class="log-line"></div></div>
      <div class="log-content">
        <div class="log-action">${escHtml(e.message)}</div>
        ${e.detail?`<div class="log-detail">${escHtml(e.detail)}</div>`:''}
        <div class="log-time">${fmtDateTime(time)}</div>
      </div>
    </div>`;
  }).join('');
}

function askClearLog(){
  if(!activityLog.length){toast('Log is already empty');return;}
  document.getElementById('confirm-clear-log-modal').classList.add('open');
}
function closeClearLogConfirm(){ document.getElementById('confirm-clear-log-modal').classList.remove('open'); }
async function confirmClearLog(){
  closeClearLogConfirm();
  try{
    await fetch(ROUTES.clearLogs,{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}});
  }catch(e){console.error('Clear log backend failed',e);}
  activityLog=[];logLastSeenCount=0;
  updateBadges();renderLog();
  toast('Activity log cleared ✓');
}
document.getElementById('confirm-clear-log-modal').addEventListener('click',e=>{if(e.target===e.currentTarget) closeClearLogConfirm();});

/* ════════════════════════════════════════════════
   SORT
════════════════════════════════════════════════ */
function sortBy(key){
  if(sortKey===key) sortDir=sortDir==='asc'?'desc':'asc';
  else{sortKey=key;sortDir='asc';}
  document.querySelectorAll('.sort-pill').forEach(p=>p.classList.remove('active'));
  const pill=document.getElementById('sort-'+key);
  if(pill) pill.classList.add('active');
  rows.sort((a,b)=>{
    let av=a[key]||'',bv=b[key]||'';
    if(key==='due'){av=av?new Date(av).getTime():0;bv=bv?new Date(bv).getTime():0;return sortDir==='asc'?av-bv:bv-av;}
    if(key==='fe'||key==='be'){av=parseInt(av)||0;bv=parseInt(bv)||0;return sortDir==='asc'?av-bv:bv-av;}
    const cmp=String(av).localeCompare(String(bv));
    return sortDir==='asc'?cmp:-cmp;
  });
  renderMobile();
  toast(`Sorted by ${key} (${sortDir})`);
}

/* ════════════════════════════════════════════════
   FILTERS
════════════════════════════════════════════════ */
const FILTER_PILL_MAP={
  status:      {Done:'f-done','On Hold':'f-hold',Revisions:'f-rev'},
  uiux_status: {Done:'f-uiux-done','On Hold':'f-uiux-hold',Revisions:'f-uiux-rev'},
  stage:       {Homepage:'f-hp',Sitemap:'f-sm','All Pages':'f-ap','Final Homepage':'f-fh'},
};

function toggleFilter(key,val){
  activeFilters[key]=activeFilters[key]===val?null:val;
  if(FILTER_PILL_MAP[key]){
    Object.values(FILTER_PILL_MAP[key]).forEach(id=>document.getElementById(id)?.classList.remove('active'));
  }
  if(activeFilters[key]&&FILTER_PILL_MAP[key]?.[activeFilters[key]]){
    document.getElementById(FILTER_PILL_MAP[key][activeFilters[key]])?.classList.add('active');
  }
  applyFilters();
}

function applyFilters(){
  const query=(document.getElementById('search-input')?.value||'').trim().toLowerCase();
  const hasAny=query||activeFilters.status||activeFilters.uiux_status||activeFilters.stage;
  document.getElementById('filter-clear')?.classList.toggle('visible',!!hasAny);
  renderMobile();
}

function clearFilters(){
  activeFilters={status:null,uiux_status:null,stage:null};
  document.getElementById('search-input').value='';
  Object.values(FILTER_PILL_MAP).forEach(group=>Object.values(group).forEach(id=>document.getElementById(id)?.classList.remove('active')));
  document.getElementById('filter-clear')?.classList.remove('visible');
  renderMobile();
}

function getFilteredRows(){
  const query=(document.getElementById('search-input')?.value||'').trim().toLowerCase();
  return rows.filter(r=>{
    const matchSearch=!query||r.client.toLowerCase().includes(query)||(r.tag||'').toLowerCase().includes(query);
    const matchStatus=!activeFilters.status||r.status===activeFilters.status;
    const matchUiux=!activeFilters.uiux_status||r.uiux_status===activeFilters.uiux_status;
    const matchStage=!activeFilters.stage||r.stage===activeFilters.stage;
    return matchSearch&&matchStatus&&matchUiux&&matchStage;
  });
}

/* ════════════════════════════════════════════════
   STATUS DROPDOWN
════════════════════════════════════════════════ */
function toggleStatusDrop(idx,e){
  e.stopPropagation();
  document.querySelectorAll('.status-dropdown').forEach(d=>{if(d.id!==`sdrop-${idx}`) d.classList.remove('open');});
  document.getElementById(`sdrop-${idx}`)?.classList.toggle('open');
}
function setStatus(idx,val,e){
  e.stopPropagation();
  const old=rows[idx].status;
  if(old===val){document.getElementById(`sdrop-${idx}`)?.classList.remove('open');return;}
  rows[idx].status=val;
  document.getElementById(`sdrop-${idx}`)?.classList.remove('open');
  ajaxPatch(idx,'status',val);
  logActivity('status',`Status changed for ${rows[idx].client}`,`${old} → ${val}`);
  updateStats();
  renderMobile();
  toast(`Status → ${val} ✓`);
}
document.addEventListener('click',()=>document.querySelectorAll('.status-dropdown').forEach(d=>d.classList.remove('open')));

function badgeHtml(s,idx){
  const opts=STATUSES.map(o=>`<div class="status-opt" onclick="setStatus(${idx},'${o}',event)"><span class="sopt-dot" style="background:${o==='Done'?'var(--done)':o==='On Hold'?'var(--onhold)':'var(--revision)'}"></span>${o}</div>`).join('');
  return `<div class="status-drop-wrap"><div class="status-badge ${statusCls(s)}" onclick="toggleStatusDrop(${idx},event)"><span class="badge-dot"></span>${escHtml(s)}</div><div class="status-dropdown" id="sdrop-${idx}">${opts}</div></div>`;
}

/* ════════════════════════════════════════════════
   RENDER CARDS
════════════════════════════════════════════════ */
function renderMobile(){
  const el=document.getElementById('mobile-list');
  updateStats();
  updateBadges();

  const filtered=getFilteredRows();

  if(!filtered.length){
    el.innerHTML=`<div class="no-results"><div>${rows.length===0?'📋':'🔍'}</div><p>${rows.length===0?'No clients yet. Tap "+ Add Client" to get started.':'No matching clients found.'}</p></div>`;
    return;
  }

  const today=new Date();today.setHours(0,0,0,0);

  el.innerHTML=filtered.map(r=>{
    const i=rows.indexOf(r);
    const isOverdue=r.due&&new Date(r.due+'T00:00:00')<today;

    const mb=s=>{
      const cls=s==='Done'?'done':s==='On Hold'?'onhold':'revision';
      const dot=s==='Done'?'var(--done)':s==='On Hold'?'var(--onhold)':'var(--revision)';
      return `<span class="mini-badge ${cls}" style="border:1px solid ${dot}30"><span style="width:5px;height:5px;border-radius:50%;background:${dot};display:inline-block;flex-shrink:0;"></span>${escHtml(s)}</span>`;
    };

    const dueStr=r.due?new Date(r.due+'T00:00:00').toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'}):'—';
    const propA=(r.prop_assign&&r.prop_assign!=='—')?escHtml(r.prop_assign):'<span style="opacity:.4">—</span>';
    const uiuxA=(r.uiux_assign&&r.uiux_assign!=='—')?escHtml(r.uiux_assign):'<span style="opacity:.4">—</span>';
    const devA=(r.dev_assign&&r.dev_assign!=='—')?escHtml(r.dev_assign):'<span style="opacity:.4">—</span>';
    const remark=r.final_remark||r.prop_remark||'';

    return `
    <div class="card${isOverdue?' card-overdue':''}" id="card-${i}" style="animation-delay:${filtered.indexOf(r)*.04}s">
      <div class="card-header">
        <div class="client-info">
          <h3>${escHtml(r.client)}</h3>
          <div class="client-tag">${escHtml(r.tag||'—')}</div>
        </div>
        ${badgeHtml(r.status,i)}
      </div>

      <!-- Stage track — tap to advance -->
      <div class="stage-track" onclick="cycleStage(${i})" title="Tap to advance stage">
        ${buildStageTrack(r.stage)}
      </div>
      <div class="stage-hint">Tap stage to advance →</div>

      <!-- Info grid -->
      <div class="info-grid">
        <div class="info-cell"><div class="info-cell-label">Proposal By</div><div class="info-cell-value">${propA}</div></div>
        <div class="info-cell"><div class="info-cell-label">UI/UX Status</div><div class="info-cell-value">${mb(r.uiux_status||'On Hold')}</div></div>
        <div class="info-cell"><div class="info-cell-label">UI/UX By</div><div class="info-cell-value">${uiuxA}</div></div>
        <div class="info-cell"><div class="info-cell-label">Dev By</div><div class="info-cell-value">${devA}</div></div>
        <div class="info-cell"><div class="info-cell-label">Front-end Dev</div><div class="info-cell-value ${!r.dev_fe?'muted':''}">${escHtml(r.dev_fe||'—')}</div></div>
        <div class="info-cell"><div class="info-cell-label">Back-end Dev</div><div class="info-cell-value ${!r.dev_be?'muted':''}">${escHtml(r.dev_be||'—')}</div></div>
        <div class="info-cell" style="grid-column:1/-1"><div class="info-cell-label">Due Date</div><div class="info-cell-value ${!r.due?'muted':''}" style="font-size:.7rem;${isOverdue?'color:var(--revision);':''}">${dueStr}${isOverdue?' ⚠️':''}</div></div>
      </div>

      <!-- Progress bars -->
      <div class="progress-section">
        <div class="progress-row">
          <div class="progress-label"><span>Front-end</span><span onclick="promptPct(${i},'fe')">${r.fe||0}% ✏</span></div>
          <div class="progress-bar" onclick="promptPct(${i},'fe')"><div class="progress-fill pf-fe" style="width:${r.fe||0}%"></div></div>
        </div>
        <div class="progress-row">
          <div class="progress-label"><span>Back-end</span><span onclick="promptPct(${i},'be')">${r.be||0}% ✏</span></div>
          <div class="progress-bar" onclick="promptPct(${i},'be')"><div class="progress-fill pf-be" style="width:${r.be||0}%"></div></div>
        </div>
      </div>

      <!-- Due notification -->
      ${getDueNotif(r.due)}

      <!-- Remark strip -->
      ${remark?`<div class="remark-strip"><div class="remark-strip-label">Remarks</div>${escHtml(remark)}</div>`:''}

      <!-- Actions -->
      <div class="card-actions">
        <button class="btn btn-outline" onclick="openDetails(${i})">✏️ Edit Details</button>
        <button class="btn btn-danger" onclick="askDelete(${i})">🗑 Move to Bin</button>
      </div>
    </div>`;
  }).join('');
}

function updateStats(){
  document.getElementById('cnt-done').textContent=rows.filter(r=>r.status==='Done').length;
  document.getElementById('cnt-hold').textContent=rows.filter(r=>r.status==='On Hold').length;
  document.getElementById('cnt-rev').textContent=rows.filter(r=>r.status==='Revisions').length;
}

/* ════════════════════════════════════════════════
   STAGE CYCLE (mobile tap-to-advance)
════════════════════════════════════════════════ */
function cycleStage(i){
  const cur=rows[i].stage;
  const next=STAGES[(STAGES.indexOf(cur)+1)%STAGES.length];
  const old=cur;
  rows[i].stage=next;
  ajaxPatch(i,'stage',next);
  logActivity('edit',`Stage advanced for ${rows[i].client}`,`${old} → ${next}`);
  renderMobile();
  toast(`Stage → ${next} ✓`);
}

/* ════════════════════════════════════════════════
   PROGRESS (tap to edit inline)
════════════════════════════════════════════════ */
function promptPct(i,key){
  const val=prompt(`Enter ${key==='fe'?'Front-end':'Back-end'} % (0–100):`,rows[i][key]||0);
  if(val===null) return;
  const n=Math.max(0,Math.min(100,parseInt(val)||0));
  rows[i][key]=n;
  ajaxPatch(i,key,n);
  logActivity('edit',`Updated ${key==='fe'?'Front-end':'Back-end'} progress for ${rows[i].client}`,`${n}%`);
  renderMobile();
  toast('Saved ✓');
}

/* ════════════════════════════════════════════════
   DETAILS DRAWER
════════════════════════════════════════════════ */
function openDetails(i){
  currentDetailIdx=i;
  const r=rows[i];
  document.getElementById('det-client-name').textContent=r.client;
  const body=document.getElementById('details-body');
  body.innerHTML=`
    <div class="form-group"><label>Client Name</label><input type="text" value="${escHtml(r.client)}" class="mobile-input" id="det-client" onblur="saveField(${i},'client',this.value)"></div>
    <div class="form-group"><label>Tag / Sub-label</label><input type="text" value="${escHtml(r.tag||'')}" class="mobile-input" onblur="saveField(${i},'tag',this.value)"></div>
    <div class="form-group"><label>Proposal Stage</label>
      <select class="mobile-input" onchange="saveField(${i},'stage',this.value)">
        ${STAGES.map(s=>`<option${r.stage===s?' selected':''}>${s}</option>`).join('')}
      </select>
    </div>
    <div class="form-group"><label>Due Date</label><input type="date" value="${r.due||''}" class="mobile-input" onchange="saveField(${i},'due',this.value)"></div>
    <div class="form-group"><label>Overall Status</label>
      <select class="mobile-input" onchange="saveField(${i},'status',this.value)">
        ${STATUSES.map(s=>`<option${r.status===s?' selected':''}>${s}</option>`).join('')}
      </select>
    </div>
    <div class="form-group"><label>UI/UX Status</label>
      <select class="mobile-input" onchange="saveField(${i},'uiux_status',this.value)">
        ${STATUSES.map(s=>`<option${r.uiux_status===s?' selected':''}>${s}</option>`).join('')}
      </select>
    </div>
    <div class="form-group"><label>Proposal Assigned</label><input type="text" value="${escHtml(r.prop_assign||'')}" class="mobile-input" onblur="saveField(${i},'prop_assign',this.value)"></div>
    <div class="form-group"><label>UI/UX Assigned</label><input type="text" value="${escHtml(r.uiux_assign||'')}" class="mobile-input" onblur="saveField(${i},'uiux_assign',this.value)"></div>
    <div class="form-group"><label>Dev Assigned</label><input type="text" value="${escHtml(r.dev_assign||'')}" class="mobile-input" onblur="saveField(${i},'dev_assign',this.value)"></div>
    <div class="form-group"><label>Front-end Dev Status</label>
      <select class="mobile-input" onchange="saveField(${i},'dev_fe',this.value)">
        <option value="">—</option>
        ${['Done','In Progress','Pending'].map(s=>`<option${r.dev_fe===s?' selected':''}>${s}</option>`).join('')}
      </select>
    </div>
    <div class="form-group"><label>Back-end Dev Status</label>
      <select class="mobile-input" onchange="saveField(${i},'dev_be',this.value)">
        <option value="">—</option>
        ${['Done','In Progress','Pending'].map(s=>`<option${r.dev_be===s?' selected':''}>${s}</option>`).join('')}
      </select>
    </div>
    <div class="form-group"><label>Frontend %</label><input type="number" min="0" max="100" value="${r.fe||0}" class="mobile-input" onblur="saveField(${i},'fe',Math.min(100,Math.max(0,parseInt(this.value)||0)))"></div>
    <div class="form-group"><label>Backend %</label><input type="number" min="0" max="100" value="${r.be||0}" class="mobile-input" onblur="saveField(${i},'be',Math.min(100,Math.max(0,parseInt(this.value)||0)))"></div>
    <div class="form-group"><label>Proposal Remarks</label><textarea class="mobile-input" rows="3" onblur="saveField(${i},'prop_remark',this.value)">${escHtml(r.prop_remark||'')}</textarea></div>
    <div class="form-group"><label>Final Remarks</label><textarea class="mobile-input" rows="3" onblur="saveField(${i},'final_remark',this.value)">${escHtml(r.final_remark||'')}</textarea></div>
  `;
  document.getElementById('details-overlay').classList.add('open');
  document.getElementById('details-drawer').classList.add('open');
}
function closeDetails(){
  document.getElementById('details-overlay').classList.remove('open');
  document.getElementById('details-drawer').classList.remove('open');
  currentDetailIdx=null;
}
function saveAndCloseDetails(){
  closeDetails();
  renderMobile();
  toast('Details saved ✓');
}
function saveField(i,key,val){
  // normalize val
  if(key==='fe'||key==='be') val=Math.min(100,Math.max(0,parseInt(val)||0));
  if(rows[i][key]==val) return;
  const old=rows[i][key];
  rows[i][key]=val;
  ajaxPatch(i,key,val);
  logActivity('edit',`Edited ${key.replace(/_/g,' ')} for ${rows[i].client}`,`"${old}" → "${val}"`);
  toast('Saved ✓');
  updateStats();
  // Update drawer title if client name changed
  if(key==='client') document.getElementById('det-client-name').textContent=val;
}

/* ════════════════════════════════════════════════
   DELETE → BIN
════════════════════════════════════════════════ */
function askDelete(i){
  pendingDeleteIdx=i;
  document.getElementById('confirm-name').textContent=rows[i].client;
  document.getElementById('confirm-modal').classList.add('open');
}
function closeConfirm(){
  pendingDeleteIdx=null;
  document.getElementById('confirm-modal').classList.remove('open');
}
async function confirmDelete(){
  if(pendingDeleteIdx===null) return;
  const i=pendingDeleteIdx;closeConfirm();
  const op=rows[i];
  const res=await fetch(ROUTES.destroy(op.id),{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}});
  if(res.ok){
    trash.unshift(Object.assign({},op,{deleted_at:new Date().toISOString()}));
    rows.splice(i,1);
    renderMobile();updateBadges();
    logActivity('delete',`${op.client} moved to Recycle Bin`);
    toast('Moved to Recycle Bin 🗑');
  }
}
document.getElementById('confirm-modal').addEventListener('click',e=>{if(e.target===e.currentTarget) closeConfirm();});

/* ════════════════════════════════════════════════
   RECYCLE BIN
════════════════════════════════════════════════ */
function openBin(){
  document.getElementById('bin-overlay').classList.add('open');
  document.getElementById('bin-drawer').classList.add('open');
  renderBin();
}
function closeBin(){
  document.getElementById('bin-overlay').classList.remove('open');
  document.getElementById('bin-drawer').classList.remove('open');
}

function renderBin(){
  const body=document.getElementById('bin-body');
  if(!trash.length){
    body.innerHTML=`<div class="bin-empty"><div class="bin-empty-icon">🪣</div><p>Recycle Bin is empty.<br>Deleted records will appear here.</p></div>`;
    return;
  }
  body.innerHTML=trash.map((r,ti)=>{
    const sc=r.status==='Done'?'var(--done)':r.status==='On Hold'?'var(--onhold)':'var(--revision)';
    const dueStr=r.due?new Date(r.due+'T00:00:00').toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'}):null;
    return `<div class="bin-card" id="bin-card-${ti}" style="animation-delay:${ti*.05}s">
      <div class="bin-card-name">${escHtml(r.client)}</div>
      <div class="bin-card-tag">${escHtml(r.tag||'')}</div>
      <div class="bin-card-meta">
        <span class="bin-meta-pill">📋 ${escHtml(r.stage)}</span>
        <span class="bin-meta-pill" style="color:${sc};border-color:${sc}30">● ${r.status}</span>
        ${r.uiux_assign&&r.uiux_assign!=='—'?`<span class="bin-meta-pill">🎨 ${escHtml(r.uiux_assign)} (${r.uiux_status})</span>`:''}
        ${r.dev_assign&&r.dev_assign!=='—'?`<span class="bin-meta-pill">👤 ${escHtml(r.dev_assign)}</span>`:''}
        ${dueStr?`<span class="bin-meta-pill">📅 ${dueStr}</span>`:''}
      </div>
      <div class="bin-deleted-at"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>Deleted ${fmtTime(r.deleted_at)}</div>
      <div class="bin-card-actions">
        <button class="restore-btn" onclick="restoreRow(${ti})">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
          Restore
        </button>
        <button class="perm-delete-btn" onclick="askPermDelete(${r.id},${ti})">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
          Delete
        </button>
      </div>
    </div>`;
  }).join('');
}

async function restoreRow(ti){
  const card=document.getElementById('bin-card-'+ti);
  if(card){card.style.transition='opacity .25s,transform .25s';card.style.opacity='0';card.style.transform='translateX(-20px)';}
  setTimeout(async()=>{
    const r=trash[ti];
    const res=await fetch(ROUTES.restore(r.id),{method:'POST',headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}});
    const data=await res.json();
    if(data.success){
      trash.splice(ti,1);
      const rv=data.row;
      rows.push({
        id:rv.id,client:rv.client,tag:rv.tag||'',stage:rv.stage,
        prop_assign:rv.prop_assign||'—',prop_remark:rv.prop_remark||'',
        uiux_assign:rv.uiux_assign||'—',uiux_status:rv.uiux_status||'On Hold',
        dev_assign:rv.dev_assign||'—',dev_fe:rv.dev_fe||'',dev_be:rv.dev_be||'',
        fe:rv.fe||0,be:rv.be||0,status:rv.status,
        due:rv.due?rv.due.replace(' 00:00:00',''):'',
        final_remark:rv.final_remark||''
      });
      renderBin();renderMobile();updateBadges();
      logActivity('restore',`${rv.client} restored from Bin`);
      toast(`✅ ${rv.client} restored!`);
    }
  },240);
}

// Permanent delete — uses confirmation modal (not browser confirm())
let pendingPermTi=null;
function askPermDelete(id,ti){
  pendingPermDeleteId=id;pendingPermTi=ti;
  document.getElementById('confirm-perm-modal').classList.add('open');
}
function closePermConfirm(){
  pendingPermDeleteId=null;pendingPermTi=null;
  document.getElementById('confirm-perm-modal').classList.remove('open');
}
async function confirmPermDelete(){
  if(pendingPermDeleteId===null) return;
  const id=pendingPermDeleteId,ti=pendingPermTi;closePermConfirm();
  const card=document.getElementById('bin-card-'+ti);
  if(card){card.style.transition='opacity .25s,transform .25s';card.style.opacity='0';card.style.transform='translateX(20px)';}
  setTimeout(async()=>{
    const res=await fetch(ROUTES.force(id),{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}});
    if(res.ok){
      const name=trash[ti]?.client||'Record';
      trash.splice(ti,1);
      renderBin();updateBadges();
      logActivity('delete',`Permanently deleted ${name}`);
      toast('Permanently deleted');
    }
  },240);
}
document.getElementById('confirm-perm-modal').addEventListener('click',e=>{if(e.target===e.currentTarget) closePermConfirm();});

// Empty Bin
function askEmptyBin(){
  if(!trash.length) return;
  document.getElementById('confirm-empty-bin-modal').classList.add('open');
}
function closeEmptyBinConfirm(){ document.getElementById('confirm-empty-bin-modal').classList.remove('open'); }
async function confirmEmptyBin(){
  closeEmptyBinConfirm();
  const cards=document.querySelectorAll('.bin-card');
  cards.forEach((c,idx)=>{
    setTimeout(()=>{c.style.transition='opacity .25s,transform .25s';c.style.opacity='0';c.style.transform='translateX(20px)';},idx*55);
  });
  setTimeout(async()=>{
    const res=await fetch(ROUTES.emptyBin,{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}});
    if(res.ok){
      trash=[];updateBadges();renderBin();
      logActivity('delete','Recycle Bin emptied');
      toast('Recycle Bin cleared');
    } else { toast('Failed to empty bin'); }
  },cards.length*55+280);
}
document.getElementById('confirm-empty-bin-modal').addEventListener('click',e=>{if(e.target===e.currentTarget) closeEmptyBinConfirm();});

/* ════════════════════════════════════════════════
   ADD CLIENT
════════════════════════════════════════════════ */
function openAddModal(){ document.getElementById('add-modal').classList.add('open'); }
function closeAddModal(){ document.getElementById('add-modal').classList.remove('open'); }
function handleAddModalBg(e){ if(e.target===e.currentTarget) closeAddModal(); }

async function addRow(){
  const clientEl=document.getElementById('f-client');
  const client=clientEl.value.trim();
  if(!client){clientEl.style.borderColor='var(--revision)';clientEl.focus();return;}
  clientEl.style.borderColor='';

  const payload={
    client,
    stage       :document.getElementById('f-stage').value,
    prop_assign :document.getElementById('f-prop-assign').value.trim()||'—',
    prop_remark :document.getElementById('f-prop-remark').value.trim(),
    uiux_status :document.getElementById('f-uiux-status').value,
    uiux_assign :document.getElementById('f-uiux-assign').value.trim()||'—',
    dev_assign  :document.getElementById('f-dev-assign').value.trim()||'—',
    dev_fe      :document.getElementById('f-dev-fe').value,
    dev_be      :document.getElementById('f-dev-be').value,
    status      :document.getElementById('f-status').value,
    due         :document.getElementById('f-due').value||null,
    fe          :parseInt(document.getElementById('f-fe').value)||0,
    be          :parseInt(document.getElementById('f-be').value)||0,
    final_remark:document.getElementById('f-final-remark').value.trim(),
    edited_by   :'Mobile User',
  };

  try{
    const res=await fetch(ROUTES.store,{
      method:'POST',
      headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
      body:JSON.stringify(payload)
    });
    const data=await res.json();
    if(res.ok&&data.success){
      const r=data.row;
      rows.push({
        id:r.id,client:r.client,tag:r.tag||'',stage:r.stage,
        prop_assign:r.prop_assign||'—',prop_remark:r.prop_remark||'',
        uiux_status:r.uiux_status,uiux_assign:r.uiux_assign||'—',
        dev_assign:r.dev_assign||'—',dev_fe:r.dev_fe||'',dev_be:r.dev_be||'',
        fe:r.fe||0,be:r.be||0,status:r.status,
        due:r.due?r.due.replace(' 00:00:00',''):'',
        final_remark:r.final_remark||''
      });
      closeAddModal();
      ['f-client','f-prop-assign','f-uiux-assign','f-dev-assign','f-fe','f-be','f-due','f-prop-remark','f-final-remark'].forEach(id=>{
        const el=document.getElementById(id);if(el) el.value='';
      });
      renderMobile();
      logActivity('add',`Added new client: ${r.client}`,`Stage: ${r.stage} · Status: ${r.status}`);
      toast('Client added ✓');
    } else {
      toast('Error saving — check required fields');
      console.error(data);
      if(data.errors) alert('Validation Error:\n'+Object.values(data.errors).flat().join('\n'));
    }
  }catch(err){
    console.error('Fetch error:',err);
    toast('Connection failed');
  }
}

/* ════════════════════════════════════════════════
   EXPORT
════════════════════════════════════════════════ */
function toggleExportDrop(e){
  e.stopPropagation();
  document.getElementById('export-drop').classList.toggle('open');
}
document.addEventListener('click',()=>document.getElementById('export-drop')?.classList.remove('open'));

function exportXLSX(){
  document.getElementById('export-drop').classList.remove('open');
  showLoading('Generating XLSX…');
  setTimeout(()=>{
    try{
      const headers=['Client','Tag','Stage','Proposal Assigned','Proposal Remarks','UI/UX Assigned','UI/UX Status','Dev Assigned','FE Status','BE Status','FE%','BE%','Status','Due Date','Final Remarks'];
      const data=[headers,...rows.map(r=>[
        r.client||'',r.tag||'',r.stage||'',r.prop_assign||'',r.prop_remark||'',
        r.uiux_assign||'',r.uiux_status||'',r.dev_assign||'',
        r.dev_fe||'',r.dev_be||'',r.fe||0,r.be||0,
        r.status||'',r.due||'',r.final_remark||''
      ])];
      const wb=XLSX.utils.book_new();
      const ws=XLSX.utils.aoa_to_sheet(data);
      XLSX.utils.book_append_sheet(wb,ws,'Operations');
      XLSX.writeFile(wb,`operations_${new Date().toISOString().split('T')[0]}.xlsx`);
      logActivity('edit','Exported XLSX',`${rows.length} records`);
      toast('XLSX exported ✓');
    }catch(e){console.error(e);toast('Export failed');}
    finally{hideLoading();}
  },400);
}

async function exportPDF(){
  document.getElementById('export-drop').classList.remove('open');
  showLoading('Generating PDF…');
  try{
    const {jsPDF}=window.jspdf;
    const doc=new jsPDF({orientation:'portrait',unit:'mm',format:'a4'});

    doc.setFont('helvetica','bold');
    doc.setFontSize(16);
    doc.setTextColor(201,99,122);
    doc.text('Operations Monitoring',14,16);

    doc.setFont('helvetica','normal');
    doc.setFontSize(8);
    doc.setTextColor(160,128,112);
    doc.text(`Exported ${new Date().toLocaleDateString('en-US',{month:'long',day:'numeric',year:'numeric'})} · ${rows.length} records`,14,22);

    const head=[['Client','Stage','UI/UX','Dev','Progress','Status','Due']];
    const body=rows.map(r=>[
      r.client+(r.tag?`\n${r.tag}`:''),
      r.stage||'',
      `${r.uiux_assign||'—'}\n${r.uiux_status||''}`,
      r.dev_assign||'—',
      `FE: ${r.fe||0}%\nBE: ${r.be||0}%`,
      r.status||'',
      r.due||'—'
    ]);

    const statusColor=s=>{
      if(s==='Done') return [90,154,106];
      if(s==='On Hold') return [176,128,32];
      return [201,96,112];
    };

    doc.autoTable({
      head,body,startY:27,
      styles:{font:'helvetica',fontSize:7.5,cellPadding:3,valign:'middle',overflow:'linebreak'},
      headStyles:{fillColor:[242,230,213],textColor:[122,92,80],fontStyle:'bold',fontSize:7},
      columnStyles:{
        0:{cellWidth:38},1:{cellWidth:28},2:{cellWidth:30},
        3:{cellWidth:25},4:{cellWidth:20},5:{cellWidth:22},6:{cellWidth:22},
      },
      alternateRowStyles:{fillColor:[253,246,240]},
      didDrawCell(data){
        if(data.section==='body'&&data.column.index===5){
          const val=data.cell.raw;
          const [r,g,b]=statusColor(val);
          const{x,y,width,height}=data.cell;
          doc.setFillColor(r,g,b,0.12);
          doc.setDrawColor(r,g,b);
          doc.setLineWidth(0.3);
          doc.roundedRect(x+1,y+1.5,width-2,height-3,2,2,'FD');
          doc.setTextColor(r,g,b);
          doc.setFontSize(7);
          doc.setFont('helvetica','bold');
          doc.text(val,x+width/2,y+height/2,{align:'center',baseline:'middle'});
        }
      },
      didParseCell(data){
        if(data.section==='body'&&data.column.index===5){
          data.cell.styles.textColor=[255,255,255];
          data.cell.styles.fillColor=[255,255,255];
        }
      }
    });

    doc.save(`operations_${new Date().toISOString().split('T')[0]}.pdf`);
    logActivity('edit','Exported PDF',`${rows.length} records`);
    toast('PDF downloaded ✓');
  }catch(e){
    console.error(e);
    toast('PDF export failed');
  }finally{
    hideLoading();
  }
}

/* ════════════════════════════════════════════════
   OVERDUE POPUP (matches desktop behavior)
════════════════════════════════════════════════ */
function checkOverdueOnLoad(){
  const today=new Date();today.setHours(0,0,0,0);
  const overdue=rows.filter(r=>r.due&&new Date(r.due+'T00:00:00')<today);
  if(!overdue.length) return;

  const overlay=document.createElement('div');
  overlay.className='overdue-overlay';overlay.id='overdue-overlay';

  const listItems=overdue.slice(0,6).map(r=>{
    const due=new Date(r.due+'T00:00:00');
    const daysOver=Math.floor((today-due)/(1000*60*60*24));
    return `<li><span class="ol-name">${escHtml(r.client)}</span><span class="ol-days">${daysOver} day${daysOver!==1?'s':''} overdue</span></li>`;
  }).join('');

  const moreText=overdue.length>6?`<div class="overdue-more">+${overdue.length-6} more overdue project${overdue.length-6!==1?'s':''}</div>`:'';

  overlay.innerHTML=`
    <div class="overdue-popup">
      <div class="overdue-popup-header">
        <span class="overdue-popup-icon">⚠️</span>
        <div>
          <div class="overdue-popup-title">${overdue.length} Overdue Project${overdue.length>1?'s':''}</div>
          <div class="overdue-popup-subtitle">These projects have passed their due date</div>
        </div>
      </div>
      <div class="overdue-divider"></div>
      <ul class="overdue-list">${listItems}</ul>
      ${moreText}
      <div style="font-size:.72rem;color:var(--muted);margin-bottom:16px;">Please review and update the project statuses.</div>
      <div class="overdue-popup-actions">
        <button class="overdue-popup-dismiss" onclick="dismissOverduePopup()">Dismiss</button>
        <button class="overdue-popup-view" onclick="viewOverdueProjects()">View Projects</button>
      </div>
    </div>`;
  document.body.appendChild(overlay);
}

function dismissOverduePopup(){
  const overlay=document.getElementById('overdue-overlay');
  if(overlay){overlay.style.transition='opacity .3s';overlay.style.opacity='0';setTimeout(()=>overlay.remove(),300);}
}

function viewOverdueProjects(){
  dismissOverduePopup();
  const today=new Date();today.setHours(0,0,0,0);
  // Filter to show overdue only
  activeFilters={status:null,uiux_status:null,stage:null};
  document.getElementById('search-input').value='';
  renderMobile();
  // Highlight overdue cards
  setTimeout(()=>{
    rows.forEach((r,i)=>{
      if(!r.due) return;
      if(new Date(r.due+'T00:00:00')<today){
        const card=document.getElementById('card-'+i);
        if(card){
          card.style.animation='overdueGlow 1.5s ease 3';
          card.scrollIntoView({behavior:'smooth',block:'center'});
        }
      }
    });
  },300);
}

/* ════════════════════════════════════════════════
   INIT
════════════════════════════════════════════════ */
renderMobile();
setTimeout(checkOverdueOnLoad, 800);
</script>
</body>
</html>