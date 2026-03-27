<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Operations Mobile</title>
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
body{font-family:'Poppins',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;overflow-x:hidden;transition:background .4s ease,color .4s ease;padding-bottom:100px;}
body::after{content:'';position:fixed;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,#FFC2CD,#e8a0b0,#F2E6D5,#c9637a,#b07060,#FFC2CD);background-size:300% 100%;animation:topbar 5s linear infinite;z-index:1000;}
@keyframes topbar{to{background-position:300% 0;}}

.bg-orb{position:fixed;border-radius:50%;pointer-events:none;z-index:0;filter:blur(80px);}
.bg-orb-1{width:300px;height:300px;background:radial-gradient(circle,rgba(201,99,122,.2),transparent 70%);top:-50px;right:-50px;animation:floatOrb 18s ease-in-out infinite;}
.bg-orb-2{width:250px;height:250px;background:radial-gradient(circle,rgba(176,112,96,.15),transparent 70%);bottom:100px;left:-50px;animation:floatOrb2 22s ease-in-out infinite;}
@keyframes floatOrb{0%,100%{transform:translate(0,0) scale(1);}33%{transform:translate(20px,-10px) scale(1.1);}66%{transform:translate(-10px,10px) scale(.95);}}
@keyframes floatOrb2{0%,100%{transform:translate(0,0) scale(1);}33%{transform:translate(-20px,15px) scale(1.08);}66%{transform:translate(15px,-20px) scale(.92);}}
@keyframes fadeUp{from{opacity:0;transform:translateY(15px);}to{opacity:1;transform:translateY(0);}}
@keyframes modalIn{from{opacity:0;transform:translateY(30px) scale(.97);}to{opacity:1;transform:translateY(0) scale(1);}}
@keyframes toastIn{from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);}}
@keyframes spin{to{transform:rotate(360deg);}}
@keyframes blink{0%,100%{opacity:1}50%{opacity:.2}}

.container{position:relative;z-index:1;padding:20px 16px;}

/* ══════════════════════════════════════════════
   HEADER
══════════════════════════════════════════════ */
.header{margin-bottom:20px;}
.header h1{font-size:1.6rem;font-weight:800;background:linear-gradient(135deg,var(--accent),var(--accent3));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.header p{font-size:.6rem;color:var(--muted);text-transform:uppercase;letter-spacing:.1em;margin-top:2px;}

/* ══════════════════════════════════════════════
   THEME ICON TOGGLE
══════════════════════════════════════════════ */
.theme-icon-btn{background:none;border:none;font-size:1.3rem;cursor:pointer;padding:4px;border-radius:8px;transition:transform .2s;line-height:1;}
.theme-icon-btn:active{transform:scale(.85);}

.top-actions{display:flex;gap:8px;margin-bottom:16px;overflow-x:auto;padding-bottom:5px;align-items:center;position:relative;overflow-y:visible;z-index:2000;}
.action-pill{display:flex;align-items:center;gap:6px;padding:8px 14px;border-radius:12px;border:1.5px solid var(--border);background:var(--surface2);font-size:.7rem;color:var(--muted2);white-space:nowrap;cursor:pointer;font-family:'Poppins',sans-serif;font-weight:500;transition:all .2s;}
.action-pill:active{transform:scale(.95);}
.badge-count{background:var(--accent);color:#fff;font-size:10px;padding:1px 6px;border-radius:10px;margin-left:4px;display:none;}
.badge-count.rev{background:var(--revision);}
.export-pill-wrap{position:relative;}
.export-drop{display:none;position:absolute;top:calc(100% + 10px);right:0;z-index:3000;background:var(--surface);border:1px solid var(--border);border-radius:12px;overflow:hidden;box-shadow:0 10px 30px var(--shadow);min-width:160px;}
.export-drop.open{display:block;}
.export-opt{padding:10px 16px;font-size:.75rem;cursor:pointer;display:flex;align-items:center;gap:8px;font-family:'Poppins',sans-serif;color:var(--text);transition:background .15s;}
.export-opt:hover{background:var(--surface2);}
.export-opt svg{width:13px;height:13px;}

/* ══════════════════════════════════════════════
   STATS
══════════════════════════════════════════════ */
.stats-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:16px;}
.stat-card{background:var(--surface);border:1px solid var(--border);padding:10px;border-radius:12px;text-align:center;box-shadow:0 4px 12px var(--shadow);}
.stat-val{font-size:1.1rem;font-weight:700;display:block;}
.stat-label{font-size:.55rem;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;}

/* ══════════════════════════════════════════════
   SEARCH & FILTER BAR
══════════════════════════════════════════════ */
.filter-section{margin-bottom:16px;}
.search-wrap{position:relative;margin-bottom:10px;}
.search-wrap svg{position:absolute;left:11px;top:50%;transform:translateY(-50%);width:14px;height:14px;color:var(--muted);pointer-events:none;}
.search-input{width:100%;padding:9px 12px 9px 32px;border-radius:10px;border:1px solid var(--border);background:var(--surface);color:var(--text);font-family:'Poppins',sans-serif;font-size:.8rem;outline:none;transition:border-color .2s,box-shadow .2s;}
.search-input:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(201,99,122,.1);}
.search-input::placeholder{color:var(--muted);opacity:.6;}

.filter-group{margin-bottom:8px;}
.filter-group-label{font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);margin-bottom:5px;}
.filter-pills-row{display:flex;gap:6px;overflow-x:auto;padding-bottom:3px;}
.fpill{padding:5px 12px;border-radius:999px;border:1px solid var(--border);background:var(--surface);font-family:'Poppins',sans-serif;font-size:.68rem;font-weight:500;color:var(--muted2);cursor:pointer;transition:all .18s;white-space:nowrap;flex-shrink:0;}
.fpill:hover{border-color:var(--accent);color:var(--accent);}
.fpill.active{background:var(--accent);border-color:var(--accent);color:#fff;box-shadow:0 2px 8px var(--shadow);}
.fpill.active.f-hold{background:var(--onhold);border-color:var(--onhold);}
.fpill.active.f-rev{background:var(--revision);border-color:var(--revision);}
.fpill.active.f-done{background:var(--done);border-color:var(--done);}
.filter-clear{display:none;align-items:center;gap:5px;padding:5px 10px;border-radius:999px;border:1px dashed var(--border);background:transparent;font-family:'Poppins',sans-serif;font-size:.68rem;color:var(--muted);cursor:pointer;transition:all .18s;white-space:nowrap;flex-shrink:0;}
.filter-clear:hover{border-color:var(--revision);color:var(--revision);}
.filter-clear.visible{display:inline-flex;}

/* Sort row */
.sort-row{display:flex;gap:6px;align-items:center;margin-bottom:4px;}
.sort-label{font-size:.58rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);flex-shrink:0;}
.sort-pill{padding:4px 10px;border-radius:999px;border:1px solid var(--border);background:var(--surface);font-family:'Poppins',sans-serif;font-size:.65rem;color:var(--muted2);cursor:pointer;transition:all .18s;white-space:nowrap;display:flex;align-items:center;gap:4px;}
.sort-pill:hover{border-color:var(--accent);color:var(--accent);}
.sort-pill.active{background:var(--surface2);border-color:var(--accent);color:var(--accent);font-weight:600;}
.sort-pill svg{width:10px;height:10px;}

/* ══════════════════════════════════════════════
   CARDS
══════════════════════════════════════════════ */
.card{background:var(--glass);backdrop-filter:blur(10px);border:1px solid var(--border);border-radius:18px;padding:16px;margin-bottom:14px;box-shadow:0 8px 24px var(--shadow);animation:fadeUp .4s ease both;}

/* ── Card top strip ── */
.card-header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px;gap:10px;}
.client-info{flex:1;min-width:0;}
.client-info h3{font-size:1rem;font-weight:700;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.client-tag{font-size:.6rem;color:var(--muted);margin-top:1px;}

/* ── Status badge & dropdown ── */
.status-badge{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:999px;font-size:.66rem;font-weight:700;font-family:'Poppins',sans-serif;box-shadow:0 2px 6px var(--shadow);cursor:pointer;white-space:nowrap;flex-shrink:0;}
.badge-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0;}
.s-done{background:rgba(90,154,106,.08);color:var(--done);border:1px solid rgba(90,154,106,.2);}
.s-done .badge-dot{background:var(--done);}
.s-onhold{background:rgba(176,128,32,.08);color:var(--onhold);border:1px solid rgba(176,128,32,.2);}
.s-onhold .badge-dot{background:var(--onhold);}
.s-revision{background:rgba(201,96,112,.08);color:var(--revision);border:1px solid rgba(201,96,112,.2);}
.s-revision .badge-dot{background:var(--revision);animation:blink 1.6s infinite;}
.status-drop-wrap{position:relative;flex-shrink:0;}
.status-dropdown{display:none;position:absolute;top:calc(100% + 6px);right:0;z-index:100;background:var(--surface);border:1px solid var(--border);border-radius:12px;overflow:hidden;box-shadow:0 10px 30px var(--shadow);min-width:130px;}
.status-dropdown.open{display:block;}
.status-opt{padding:9px 14px;font-size:.75rem;cursor:pointer;display:flex;align-items:center;gap:8px;font-family:'Poppins',sans-serif;color:var(--text);transition:background .15s;}
.status-opt:hover{background:var(--surface2);}
.sopt-dot{width:8px;height:8px;border-radius:50%;}

/* ── Stage stepper (horizontal compact) ── */
.stage-track{display:flex;align-items:center;background:var(--surface2);border-radius:10px;padding:8px 10px;margin-bottom:12px;cursor:pointer;gap:0;overflow:hidden;}
.stage-step{display:flex;align-items:center;gap:4px;flex:1;min-width:0;}
.stage-step-icon{width:18px;height:18px;border-radius:5px;display:flex;align-items:center;justify-content:center;font-size:9px;flex-shrink:0;}
.stage-step.done .stage-step-icon{background:rgba(90,154,106,.18);color:var(--done);}
.stage-step.active .stage-step-icon{background:rgba(201,99,122,.2);color:var(--accent);}
.stage-step.pending .stage-step-icon{background:var(--border);color:var(--muted);}
.stage-step-label{font-size:.58rem;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.stage-step.done .stage-step-label{color:var(--done);}
.stage-step.active .stage-step-label{color:var(--text);}
.stage-step.pending .stage-step-label{color:var(--muted);opacity:.6;}
.stage-divider{width:12px;height:1px;background:var(--border);flex-shrink:0;margin:0 3px;}

/* ── Info grid rows ── */
.info-grid{display:grid;grid-template-columns:1fr 1fr;gap:6px;margin-bottom:12px;}
.info-cell{background:var(--surface2);border-radius:9px;padding:7px 9px;}
.info-cell-label{font-size:.55rem;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:2px;}
.info-cell-value{font-size:.72rem;font-weight:600;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.info-cell-value.muted{color:var(--muted);font-weight:400;}
.mini-badge{display:inline-flex;align-items:center;gap:4px;font-size:.62rem;font-weight:700;padding:2px 7px;border-radius:6px;}
.mini-badge.done{background:rgba(90,154,106,.12);color:var(--done);}
.mini-badge.onhold{background:rgba(176,128,32,.12);color:var(--onhold);}
.mini-badge.revision{background:rgba(201,96,112,.12);color:var(--revision);}

/* ── Progress bars ── */
.progress-section{margin-bottom:10px;}
.progress-row{margin-bottom:8px;}
.progress-label{display:flex;justify-content:space-between;font-size:.62rem;color:var(--muted2);margin-bottom:3px;font-weight:600;}
.progress-label span:last-child{cursor:pointer;}
.progress-bar{height:5px;background:var(--border);border-radius:99px;overflow:hidden;cursor:pointer;}
.progress-fill{height:100%;border-radius:99px;transition:width .8s ease;}
.pf-fe{background:linear-gradient(90deg,var(--pink),var(--accent));}
.pf-be{background:linear-gradient(90deg,var(--cream),var(--accent3));}

/* ── Due notif ── */
.due-notif{font-size:.63rem;font-weight:600;padding:5px 10px;border-radius:8px;margin-bottom:10px;display:flex;align-items:center;gap:6px;}
.due-notif.urgent{background:rgba(201,96,112,.1);color:var(--revision);border:1px solid rgba(201,96,112,.2);}
.due-notif.warning{background:rgba(176,128,32,.1);color:var(--onhold);border:1px solid rgba(176,128,32,.2);}
.due-notif.safe{background:rgba(90,154,106,.1);color:var(--done);border:1px solid rgba(90,154,106,.2);}

/* ── Remark strip ── */
.remark-strip{background:var(--surface2);border-left:3px solid var(--border);border-radius:0 8px 8px 0;padding:6px 10px;margin-bottom:10px;font-size:.68rem;color:var(--muted);line-height:1.45;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.remark-strip-label{font-size:.55rem;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:2px;}

/* ── Card actions ── */
.card-actions{display:flex;gap:8px;margin-top:10px;}
.btn{padding:9px;border:none;border-radius:10px;font-weight:600;font-family:'Poppins',sans-serif;font-size:.73rem;cursor:pointer;flex:1;transition:transform .15s;}
.btn-primary{background:var(--accent);color:#fff;}
.btn-outline{background:var(--surface2);border:1px solid var(--border);color:var(--muted2);}
.btn-danger{background:rgba(201,96,112,.1);color:var(--revision);border:1px solid rgba(201,96,112,.2);}

/* ══════════════════════════════════════════════
   DRAWERS
══════════════════════════════════════════════ */
.drawer-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.35);backdrop-filter:blur(5px);z-index:2000;}
.drawer-overlay.open{display:block;}
.drawer{position:fixed;bottom:0;left:0;right:0;background:var(--surface);border-top:2px solid var(--border);border-radius:24px 24px 0 0;padding:24px 20px 32px;z-index:2001;transform:translateY(100%);transition:transform .3s ease;max-height:88vh;overflow-y:auto;}
.drawer.open{transform:translateY(0);}
.drawer-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;}
.drawer-title{font-size:1.1rem;font-weight:700;font-family:'Poppins',sans-serif;color:var(--text);}
.drawer-close{padding:6px 14px;border-radius:10px;border:1.5px solid var(--border);background:var(--surface2);color:var(--muted2);font-family:'Poppins',sans-serif;font-size:.75rem;font-weight:600;cursor:pointer;transition:all .2s;}
.drawer-close:hover{border-color:var(--accent);color:var(--accent);}

/* ══════════════════════════════════════════════
   DETAILS DRAWER FORM
══════════════════════════════════════════════ */
.form-group{display:flex;flex-direction:column;gap:5px;margin-bottom:14px;}
.form-group label{font-size:.62rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);}
.mobile-input{width:100%;padding:10px 12px;border-radius:10px;border:1px solid var(--border);background:var(--surface2);color:var(--text);font-family:'Poppins',sans-serif;font-size:.82rem;outline:none;transition:border-color .2s;}
.mobile-input:focus{border-color:var(--accent);}
textarea.mobile-input{resize:vertical;}

/* ══════════════════════════════════════════════
   ADD CLIENT MODAL
══════════════════════════════════════════════ */
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:3000;align-items:flex-end;justify-content:center;backdrop-filter:blur(4px);}
.modal-overlay.open{display:flex;}
.modal-box{background:var(--surface);border-radius:24px 24px 0 0;padding:24px 20px 40px;width:100%;max-height:90vh;overflow-y:auto;animation:modalIn .3s cubic-bezier(.22,1,.36,1);}
.modal-box h2{font-size:1.15rem;font-weight:800;color:var(--text);margin-bottom:20px;font-family:'Poppins',sans-serif;}
.modal-actions{display:flex;gap:10px;margin-top:20px;}
.btn-cancel{flex:1;padding:12px;border-radius:12px;border:1.5px solid var(--border);background:transparent;color:var(--muted2);font-family:'Poppins',sans-serif;font-size:.82rem;font-weight:600;cursor:pointer;}
.btn-save{flex:2;padding:12px;border-radius:12px;border:none;background:var(--accent);color:#fff;font-family:'Poppins',sans-serif;font-size:.82rem;font-weight:700;cursor:pointer;box-shadow:0 4px 14px var(--shadow);}

/* ══════════════════════════════════════════════
   CONFIRM MODAL
══════════════════════════════════════════════ */
.confirm-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);backdrop-filter:blur(6px);z-index:4000;align-items:center;justify-content:center;padding:20px;}
.confirm-overlay.open{display:flex;}
.confirm-box{background:var(--surface);border:1.5px solid var(--border);border-radius:20px;padding:28px 24px;width:100%;max-width:340px;text-align:center;box-shadow:0 24px 60px var(--shadow);font-family:'Poppins',sans-serif;animation:modalIn .3s ease;}
.confirm-box .bin-icon{font-size:2.2rem;display:block;margin-bottom:10px;}
.confirm-box h3{font-size:1rem;font-weight:700;margin-bottom:6px;}
.confirm-box p{font-size:.8rem;color:var(--muted);margin-bottom:20px;line-height:1.5;}
.confirm-box strong{color:var(--accent);}
.confirm-actions{display:flex;gap:10px;justify-content:center;}
.btn-confirm-cancel{padding:10px 20px;border-radius:10px;border:1.5px solid var(--border);background:transparent;color:var(--muted2);font-family:'Poppins',sans-serif;font-size:.82rem;font-weight:600;cursor:pointer;}
.btn-confirm-delete{padding:10px 20px;border-radius:10px;border:none;background:var(--revision);color:#fff;font-family:'Poppins',sans-serif;font-size:.82rem;font-weight:700;cursor:pointer;}

/* ══════════════════════════════════════════════
   BIN CARD
══════════════════════════════════════════════ */
.bin-card{background:var(--surface2);border:1.5px solid var(--border);border-radius:14px;padding:14px 16px;margin-bottom:10px;}
.bin-card-name{font-weight:700;font-size:.9rem;margin-bottom:2px;}
.bin-card-tag{font-size:.62rem;color:var(--muted);margin-bottom:8px;}
.bin-card-actions{display:flex;gap:8px;margin-top:10px;}
.restore-btn{flex:1;display:flex;align-items:center;justify-content:center;gap:6px;padding:8px;border-radius:10px;border:1.5px solid rgba(90,154,106,.4);background:rgba(90,154,106,.08);color:var(--done);font-family:'Poppins',sans-serif;font-size:.75rem;font-weight:600;cursor:pointer;}
.perm-delete-btn{flex:1;display:flex;align-items:center;justify-content:center;gap:6px;padding:8px;border-radius:10px;border:1.5px solid rgba(201,96,112,.4);background:rgba(201,96,112,.08);color:var(--revision);font-family:'Poppins',sans-serif;font-size:.75rem;font-weight:600;cursor:pointer;}

/* ══════════════════════════════════════════════
   ACTIVITY LOG
══════════════════════════════════════════════ */
.log-entry{display:flex;gap:12px;padding:12px 0;border-bottom:1px solid var(--border);}
.log-entry:last-child{border-bottom:none;}
.log-dot{width:9px;height:9px;border-radius:50%;flex-shrink:0;margin-top:4px;}
.log-content{flex:1;}
.log-action{font-size:.78rem;font-weight:600;color:var(--text);font-family:'Poppins',sans-serif;}
.log-detail{font-size:.7rem;color:var(--muted);margin-top:2px;}
.log-time{font-size:.62rem;color:var(--muted);margin-top:3px;}
.log-empty{text-align:center;padding:40px 20px;color:var(--muted);font-size:.82rem;}

/* ══════════════════════════════════════════════
   TOAST & LOADING
══════════════════════════════════════════════ */
.toast{position:fixed;bottom:20px;left:16px;right:16px;background:var(--text);color:var(--bg);padding:12px 20px;border-radius:12px;font-size:.8rem;font-weight:600;font-family:'Poppins',sans-serif;z-index:9999;box-shadow:0 8px 24px var(--shadow);animation:toastIn .3s ease;}
.loading-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.3);backdrop-filter:blur(4px);z-index:5000;align-items:center;justify-content:center;}
.loading-overlay.open{display:flex;}
.loading-box{background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:24px 32px;text-align:center;box-shadow:0 16px 50px var(--shadow);}
.loading-spinner{width:28px;height:28px;border:3px solid var(--border);border-top-color:var(--accent);border-radius:50%;animation:spin .8s linear infinite;margin:0 auto 10px;}
.loading-box p{font-size:.8rem;color:var(--muted);font-family:'Poppins',sans-serif;}

/* ══════════════════════════════════════════════
   FLOATING ADD
══════════════════════════════════════════════ */
.floating-add{position:fixed;bottom:24px;right:24px;width:56px;height:56px;border-radius:28px;background:var(--accent);color:#fff;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 24px var(--shadow);border:none;z-index:1500;font-size:24px;font-family:'Poppins',sans-serif;cursor:pointer;transition:transform .15s,background .2s;}
.floating-add:active{transform:scale(.9);}

.no-results{text-align:center;padding:60px 20px;color:var(--muted);}
.no-results div{font-size:3rem;margin-bottom:10px;}
.no-results p{font-size:.85rem;}
</style>
</head>
<body>
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>

<div class="container">

  <!-- ══ HEADER ══ -->
  <div class="header">
    <div style="display:flex;justify-content:space-between;align-items:flex-start;">
      <div>
        <h1>Monitoring</h1>
        <p>Operations Pipeline</p>
      </div>
      <button class="theme-icon-btn" onclick="toggleTheme()" id="theme-icon-btn" title="Toggle theme">🌙</button>
    </div>
  </div>

  <!-- ══ TOP ACTIONS ══ -->
  <div class="top-actions" style="overflow:visible;">
    <div class="action-pill" onclick="openLog()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      Activity Log
      <span class="badge-count" id="log-badge-count">0</span>
    </div>
    <div class="action-pill" onclick="openBin()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
      Recycle Bin
      <span class="badge-count rev" id="bin-badge-count">0</span>
    </div>
    <div class="export-pill-wrap">
      <div class="action-pill" onclick="toggleExportDrop(event)">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
        Export
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
    <div class="stat-card"><span class="stat-val" style="color:var(--revision)" id="cnt-rev">0</span><span class="stat-label">Revs</span></div>
  </div>

  <!-- ══ SEARCH & FILTER ══ -->
  <div class="filter-section">
    <div class="search-wrap">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" id="search-input" placeholder="Search clients…" class="search-input" oninput="applyFilters()">
    </div>

    <div class="filter-group">
      <div class="filter-group-label">Status</div>
      <div class="filter-pills-row">
        <div class="fpill f-done" onclick="toggleFilter('status','Done')" id="f-done">Done</div>
        <div class="fpill f-hold" onclick="toggleFilter('status','On Hold')" id="f-hold">On Hold</div>
        <div class="fpill f-rev" onclick="toggleFilter('status','Revisions')" id="f-rev">Revisions</div>
      </div>
    </div>

    <div class="filter-group">
      <div class="filter-group-label">UI/UX</div>
      <div class="filter-pills-row">
        <div class="fpill f-done" onclick="toggleFilter('uiux_status','Done')" id="f-uiux-done">Done</div>
        <div class="fpill f-hold" onclick="toggleFilter('uiux_status','On Hold')" id="f-uiux-hold">On Hold</div>
        <div class="fpill f-rev" onclick="toggleFilter('uiux_status','Revisions')" id="f-uiux-rev">Revisions</div>
      </div>
    </div>

    <div class="filter-group">
      <div class="filter-group-label">Stage</div>
      <div class="filter-pills-row">
        <div class="fpill" onclick="toggleFilter('stage','Homepage')" id="f-hp">Homepage</div>
        <div class="fpill" onclick="toggleFilter('stage','Sitemap')" id="f-sm">Sitemap</div>
        <div class="fpill" onclick="toggleFilter('stage','All Pages')" id="f-ap">All Pages</div>
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
    </div>
  </div>

  <!-- ══ CARD LIST ══ -->
  <div id="mobile-list"></div>
</div>

<!-- Floating Add -->
<button class="floating-add" onclick="openAddModal()">+</button>

<!-- ══ ACTIVITY LOG DRAWER ══ -->
<div class="drawer-overlay" id="log-overlay" onclick="closeLog()"></div>
<div class="drawer" id="log-drawer">
  <div class="drawer-header">
    <span class="drawer-title">📋 Activity Log</span>
    <div style="display:flex;gap:8px;">
      <button class="drawer-close" style="background:rgba(201,96,112,.08);border-color:rgba(201,96,112,.3);color:var(--revision);" onclick="askClearLog()">Clear Log</button>
      <button class="drawer-close" onclick="closeLog()">Close</button>
    </div>
  </div>
  <div id="log-body"></div>
</div>

<!-- ══ CONFIRM CLEAR LOG MODAL ══ -->
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

<!-- ══ DETAILS DRAWER ══ -->
<div class="drawer-overlay" id="details-overlay" onclick="closeDetails()"></div>
<div class="drawer" id="details-drawer">
  <div class="drawer-header">
    <span class="drawer-title" id="det-client-name">Edit Details</span>
    <button class="drawer-close" onclick="closeDetails()">Close</button>
  </div>
  <div id="details-body"></div>
</div>

<!-- ══ RECYCLE BIN DRAWER ══ -->
<div class="drawer-overlay" id="bin-overlay" onclick="closeBin()"></div>
<div class="drawer" id="bin-drawer">
  <div class="drawer-header">
    <span class="drawer-title">🗑 Recycle Bin</span>
    <button class="drawer-close" onclick="closeBin()">Close</button>
  </div>
  <div id="bin-body"></div>
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
        <option>Homepage</option><option>Sitemap</option><option>All Pages</option><option>Final Homepage</option>
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
      <label>Status</label>
      <select id="f-status" class="mobile-input">
        <option>Done</option><option>On Hold</option><option>Revisions</option>
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

<!-- ══ CONFIRM DELETE MODAL ══ -->
<div class="confirm-overlay" id="confirm-modal">
  <div class="confirm-box">
    <span class="bin-icon">🗑️</span>
    <h3>Move to Recycle Bin?</h3>
    <p>This will move <strong id="confirm-name"></strong> to the Recycle Bin. You can restore it anytime.</p>
    <div class="confirm-actions">
      <button class="btn-confirm-cancel" onclick="closeConfirm()">Cancel</button>
      <button class="btn-confirm-delete" onclick="confirmDelete()">Move to Bin</button>
    </div>
  </div>
</div>

<!-- ══ LOADING ══ -->
<div class="loading-overlay" id="loading-overlay">
  <div class="loading-box">
    <div class="loading-spinner"></div>
    <p id="loading-msg">Preparing export…</p>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
/* ══════════════════════════════════════════════
   CONFIG
══════════════════════════════════════════════ */
const STAGES   = ['Homepage','Sitemap','All Pages','Final Homepage'];
const STATUSES = ['Done','On Hold','Revisions'];
const CSRF     = document.querySelector('meta[name="csrf-token"]').content;
const ROUTES   = {
  store   : '/operations',
  update  : id => `/operations/${id}`,
  destroy : id => `/operations/${id}`,
  restore : id => `/operations/${id}/restore`,
  force   : id => `/operations/${id}/force`,
  clearLogs: '/activity-logs/clear',
};

let rows        = @json($rows);
let trash       = @json($trash);
let activityLog = @json($logs);

let sortKey = null, sortDir = 'asc';
let pendingDeleteIdx = null;
let activeFilters = { status:null, uiux_status:null, stage:null, search:'' };

/* ══════════════════════════════════════════════
   HELPERS
══════════════════════════════════════════════ */
function escHtml(s){ return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }
function statusCls(s){ return {Done:'s-done','On Hold':'s-onhold',Revisions:'s-revision'}[s]||'s-onhold'; }

const SVG_CHECK = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" width="9" height="9"><polyline points="20 6 9 17 4 12"/></svg>`;
const SVG_ARROW = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" width="9" height="9"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="13 6 19 12 13 18"/></svg>`;
const SVG_DOT   = `<svg viewBox="0 0 10 10" width="6" height="6"><circle cx="5" cy="5" r="3" fill="currentColor" opacity=".4"/></svg>`;

// Short label for tight horizontal display
const STAGE_SHORT = { 'Homepage':'Home', 'Sitemap':'Sitemap', 'All Pages':'Pages', 'Final Homepage':'Final' };

function buildStageTrack(stage){
  const ci = STAGES.indexOf(stage);
  return STAGES.map((s,i)=>{
    const cls  = i < ci ? 'done' : (i === ci ? 'active' : 'pending');
    const icon = i < ci ? SVG_CHECK : (i === ci ? SVG_ARROW : SVG_DOT);
    const div  = i < STAGES.length-1 ? `<div class="stage-divider"></div>` : '';
    return `<div class="stage-step ${cls}">
      <div class="stage-step-icon">${icon}</div>
      <span class="stage-step-label">${STAGE_SHORT[s]||s}</span>
    </div>${div}`;
  }).join('');
}

// Keep old buildSteps as alias (used nowhere else now)
function buildSteps(stage){ return buildStageTrack(stage); }

function getDueNotif(d){
  if(!d) return '';
  const due = new Date(d+'T00:00:00'), today = new Date();
  today.setHours(0,0,0,0);
  const diff = Math.floor((due-today)/(1000*60*60*24));
  if(diff < 0)  return `<div class="due-notif urgent">⚠️ Overdue by ${Math.abs(diff)} day${Math.abs(diff)!==1?'s':''}</div>`;
  if(diff === 0) return `<div class="due-notif urgent">⚠️ Due today!</div>`;
  if(diff <= 3) return `<div class="due-notif warning">⏳ Due in ${diff} day${diff!==1?'s':''}</div>`;
  return `<div class="due-notif safe">✅ On schedule</div>`;
}

function fmtDateTime(ts){
  if(!ts) return '';
  const d = new Date(ts);
  return d.toLocaleString('en-US',{month:'short',day:'numeric',hour:'numeric',minute:'2-digit'});
}

/* ══════════════════════════════════════════════
   THEME  — icon only toggle
══════════════════════════════════════════════ */
function applyTheme(theme){
  document.documentElement.setAttribute('data-theme', theme);
  document.getElementById('theme-icon-btn').textContent = theme === 'dark' ? '☀️' : '🌙';
  localStorage.setItem('theme', theme);
}
function toggleTheme(){
  const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
  applyTheme(isDark ? 'light' : 'dark');
}
// Init
applyTheme(localStorage.getItem('theme') || 'light');

/* ══════════════════════════════════════════════
   TOAST
══════════════════════════════════════════════ */
let toastTimer;
function toast(msg){
  document.querySelector('.toast')?.remove();
  clearTimeout(toastTimer);
  const el = document.createElement('div');
  el.className = 'toast';
  el.textContent = msg;
  document.body.appendChild(el);
  toastTimer = setTimeout(()=>el.remove(), 2500);
}

/* ══════════════════════════════════════════════
   LOADING
══════════════════════════════════════════════ */
function showLoading(msg='Loading…'){
  document.getElementById('loading-msg').textContent = msg;
  document.getElementById('loading-overlay').classList.add('open');
}
function hideLoading(){ document.getElementById('loading-overlay').classList.remove('open'); }

/* ══════════════════════════════════════════════
   ACTIVITY LOG
══════════════════════════════════════════════ */
let logLastSeenCount = activityLog.length;

const LOG_COLORS = { add:'var(--done)', edit:'var(--accent)', status:'var(--onhold)', delete:'var(--revision)', restore:'var(--done)' };

function logActivity(type, message, detail=''){
  activityLog.unshift({ type, message, detail, ts: Date.now() });
  if(activityLog.length > 200) activityLog.pop();
  updateBadges();
}

function updateBadges(){
  const lb = document.getElementById('log-badge-count');
  const unseen = activityLog.length - logLastSeenCount;
  lb.textContent = unseen > 99 ? '99+' : unseen;
  lb.style.display = unseen > 0 ? 'inline-block' : 'none';

  const bb = document.getElementById('bin-badge-count');
  bb.textContent = trash.length;
  bb.style.display = trash.length > 0 ? 'inline-block' : 'none';
}

function openLog(){
  document.getElementById('log-overlay').classList.add('open');
  document.getElementById('log-drawer').classList.add('open');
  logLastSeenCount = activityLog.length;
  updateBadges();
  renderLog();
}
function closeLog(){
  document.getElementById('log-overlay').classList.remove('open');
  document.getElementById('log-drawer').classList.remove('open');
}
function renderLog(){
  const body = document.getElementById('log-body');
  if(!activityLog.length){
    body.innerHTML = `<div class="log-empty">📋<br><br>No activity yet.<br>Edits and changes will appear here.</div>`;
    return;
  }
  body.innerHTML = activityLog.map(e=>{
    const color = LOG_COLORS[e.type] || 'var(--muted)';
    const time = e.created_at || e.ts;
    return `<div class="log-entry">
      <div class="log-dot" style="background:${color}"></div>
      <div class="log-content">
        <div class="log-action">${escHtml(e.message)}</div>
        ${e.detail ? `<div class="log-detail">${escHtml(e.detail)}</div>` : ''}
        <div class="log-time">${fmtDateTime(time)}</div>
      </div>
    </div>`;
  }).join('');
}

/* ══════════════════════════════════════════════
   SORT
══════════════════════════════════════════════ */
function sortBy(key){
  if(sortKey === key) sortDir = sortDir === 'asc' ? 'desc' : 'asc';
  else { sortKey = key; sortDir = 'asc'; }

  document.querySelectorAll('.sort-pill').forEach(p=>p.classList.remove('active'));
  const pill = document.getElementById('sort-'+key);
  if(pill) pill.classList.add('active');

  rows.sort((a,b)=>{
    let av = a[key]||'', bv = b[key]||'';
    if(key === 'due'){
      av = av ? new Date(av).getTime() : 0;
      bv = bv ? new Date(bv).getTime() : 0;
      return sortDir === 'asc' ? av-bv : bv-av;
    }
    const cmp = String(av).localeCompare(String(bv));
    return sortDir === 'asc' ? cmp : -cmp;
  });
  renderMobile();
  toast(`Sorted by ${key} (${sortDir})`);
}

/* ══════════════════════════════════════════════
   FILTERS
══════════════════════════════════════════════ */
const FILTER_PILL_MAP = {
  status:      { Done:'f-done', 'On Hold':'f-hold', Revisions:'f-rev' },
  uiux_status: { Done:'f-uiux-done', 'On Hold':'f-uiux-hold', Revisions:'f-uiux-rev' },
  stage:       { Homepage:'f-hp', Sitemap:'f-sm', 'All Pages':'f-ap', 'Final Homepage':'f-fh' },
};

function toggleFilter(key, val){
  activeFilters[key] = activeFilters[key] === val ? null : val;
  // Deactivate all pills for this group
  if(FILTER_PILL_MAP[key]){
    Object.values(FILTER_PILL_MAP[key]).forEach(id=>{
      document.getElementById(id)?.classList.remove('active');
    });
  }
  if(activeFilters[key] && FILTER_PILL_MAP[key]?.[activeFilters[key]]){
    document.getElementById(FILTER_PILL_MAP[key][activeFilters[key]])?.classList.add('active');
  }
  applyFilters();
}

function applyFilters(){
  activeFilters.search = (document.getElementById('search-input')?.value||'').trim().toLowerCase();
  const hasAny = activeFilters.search || activeFilters.status || activeFilters.uiux_status || activeFilters.stage;
  const clearBtn = document.getElementById('filter-clear');
  if(clearBtn) clearBtn.classList.toggle('visible', !!hasAny);
  renderMobile();
}

function clearFilters(){
  activeFilters = { status:null, uiux_status:null, stage:null, search:'' };
  document.getElementById('search-input').value = '';
  Object.values(FILTER_PILL_MAP).forEach(group=>{
    Object.values(group).forEach(id=>document.getElementById(id)?.classList.remove('active'));
  });
  document.getElementById('filter-clear')?.classList.remove('visible');
  renderMobile();
}

/* ══════════════════════════════════════════════
   STATUS DROPDOWN IN CARD
══════════════════════════════════════════════ */
function toggleStatusDrop(idx, e){
  e.stopPropagation();
  document.querySelectorAll('.status-dropdown').forEach(d=>{
    if(d.id !== `sdrop-${idx}`) d.classList.remove('open');
  });
  document.getElementById(`sdrop-${idx}`)?.classList.toggle('open');
}
function setStatus(idx, val, e){
  e.stopPropagation();
  const old = rows[idx].status;
  if(old === val){ document.getElementById(`sdrop-${idx}`)?.classList.remove('open'); return; }
  rows[idx].status = val;
  document.getElementById(`sdrop-${idx}`)?.classList.remove('open');
  ajaxPatch(idx, 'status', val);
  logActivity('status', `Status changed for ${rows[idx].client}`, `${old} → ${val}`);
  renderMobile();
  toast(`Status → ${val} ✓`);
}
document.addEventListener('click', ()=>document.querySelectorAll('.status-dropdown').forEach(d=>d.classList.remove('open')));

function badgeHtml(s, idx){
  const opts = STATUSES.map(o=>`<div class="status-opt" onclick="setStatus(${idx},'${o}',event)"><span class="sopt-dot" style="background:${o==='Done'?'var(--done)':o==='On Hold'?'var(--onhold)':'var(--revision)'}"></span>${o}</div>`).join('');
  return `<div class="status-drop-wrap"><div class="status-badge ${statusCls(s)}" onclick="toggleStatusDrop(${idx},event)"><span class="badge-dot"></span>${escHtml(s)}</div><div class="status-dropdown" id="sdrop-${idx}">${opts}</div></div>`;
}

/* ══════════════════════════════════════════════
   RENDER CARDS
══════════════════════════════════════════════ */
function renderMobile(){
  const el = document.getElementById('mobile-list');
  updateStats();
  updateBadges();

  let filtered = rows.filter(r=>{
    const q = activeFilters.search;
    const matchSearch = !q || r.client.toLowerCase().includes(q) || (r.tag||'').toLowerCase().includes(q);
    const matchStatus = !activeFilters.status || r.status === activeFilters.status;
    const matchUiux   = !activeFilters.uiux_status || r.uiux_status === activeFilters.uiux_status;
    const matchStage  = !activeFilters.stage || r.stage === activeFilters.stage;
    return matchSearch && matchStatus && matchUiux && matchStage;
  });

  if(!filtered.length){
    el.innerHTML = `<div class="no-results"><div>🔍</div><p>No matching results</p></div>`;
    return;
  }

  el.innerHTML = filtered.map(r=>{
    const i = rows.indexOf(r);

    // Mini badge helper
    const mb = s => {
      const cls = s==='Done'?'done':s==='On Hold'?'onhold':'revision';
      const dot = s==='Done'?'var(--done)':s==='On Hold'?'var(--onhold)':'var(--revision)';
      return `<span class="mini-badge ${cls}" style="border:1px solid ${dot}30"><span style="width:5px;height:5px;border-radius:50%;background:${dot};display:inline-block;flex-shrink:0;"></span>${escHtml(s)}</span>`;
    };

    // Due date formatted
    const dueStr = r.due ? new Date(r.due+'T00:00:00').toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'}) : '—';

    // Assignees — show dash if empty or —
    const propA  = (r.prop_assign  && r.prop_assign !=='—') ? escHtml(r.prop_assign)  : '<span style="opacity:.4">—</span>';
    const uiuxA  = (r.uiux_assign  && r.uiux_assign !=='—') ? escHtml(r.uiux_assign)  : '<span style="opacity:.4">—</span>';
    const devA   = (r.dev_assign   && r.dev_assign  !=='—') ? escHtml(r.dev_assign)   : '<span style="opacity:.4">—</span>';

    // Dev status pills
    const devFeStr = r.dev_fe || '—';
    const devBeStr = r.dev_be || '—';

    // Remark to show (prefer final_remark, fall back to prop_remark)
    const remark = r.final_remark || r.prop_remark || '';

    return `
    <div class="card" id="card-${i}">

      <!-- ── Header: name + overall status ── -->
      <div class="card-header">
        <div class="client-info">
          <h3>${escHtml(r.client)}</h3>
          <div class="client-tag">${escHtml(r.tag||'—')}</div>
        </div>
        ${badgeHtml(r.status, i)}
      </div>

      <!-- ── Stage track (horizontal, tap to advance) ── -->
      <div class="stage-track" onclick="cycleStage(${i})" title="Tap to advance stage">
        ${buildStageTrack(r.stage)}
      </div>

      <!-- ── Info grid: assignees + statuses ── -->
      <div class="info-grid">
        <div class="info-cell">
          <div class="info-cell-label">Proposal By</div>
          <div class="info-cell-value">${propA}</div>
        </div>
        <div class="info-cell">
          <div class="info-cell-label">UI/UX Status</div>
          <div class="info-cell-value">${mb(r.uiux_status||'On Hold')}</div>
        </div>
        <div class="info-cell">
          <div class="info-cell-label">UI/UX By</div>
          <div class="info-cell-value">${uiuxA}</div>
        </div>
        <div class="info-cell">
          <div class="info-cell-label">Dev By</div>
          <div class="info-cell-value">${devA}</div>
        </div>
        <div class="info-cell">
          <div class="info-cell-label">Front-end Dev</div>
          <div class="info-cell-value ${devFeStr==='—'?'muted':''}">${escHtml(devFeStr)}</div>
        </div>
        <div class="info-cell">
          <div class="info-cell-label">Back-end Dev</div>
          <div class="info-cell-value ${devBeStr==='—'?'muted':''}">${escHtml(devBeStr)}</div>
        </div>
        <div class="info-cell">
          <div class="info-cell-label">Due Date</div>
          <div class="info-cell-value ${!r.due?'muted':''}" style="font-size:.68rem;">${dueStr}</div>
        </div>
        <div class="info-cell" style="grid-column:1/-1;display:none;" id="remark-cell-${i}">
          <!-- shown below separately -->
        </div>
      </div>

      <!-- ── Progress ── -->
      <div class="progress-section">
        <div class="progress-row">
          <div class="progress-label">
            <span>Front-end</span>
            <span onclick="promptPct(${i},'fe')">${r.fe||0}%</span>
          </div>
          <div class="progress-bar" onclick="promptPct(${i},'fe')"><div class="progress-fill pf-fe" style="width:${r.fe||0}%"></div></div>
        </div>
        <div class="progress-row">
          <div class="progress-label">
            <span>Back-end</span>
            <span onclick="promptPct(${i},'be')">${r.be||0}%</span>
          </div>
          <div class="progress-bar" onclick="promptPct(${i},'be')"><div class="progress-fill pf-be" style="width:${r.be||0}%"></div></div>
        </div>
      </div>

      <!-- ── Due notification ── -->
      ${getDueNotif(r.due)}

      <!-- ── Remark strip ── -->
      ${remark ? `<div class="remark-strip"><div class="remark-strip-label">Remarks</div>${escHtml(remark)}</div>` : ''}

      <!-- ── Actions ── -->
      <div class="card-actions">
        <button class="btn btn-outline" onclick="openDetails(${i})">✏️ Edit Details</button>
        <button class="btn btn-danger" onclick="askDelete(${i})">🗑 Move to Bin</button>
      </div>
    </div>`;
  }).join('');
}

function updateStats(){
  document.getElementById('cnt-done').textContent = rows.filter(r=>r.status==='Done').length;
  document.getElementById('cnt-hold').textContent = rows.filter(r=>r.status==='On Hold').length;
  document.getElementById('cnt-rev').textContent  = rows.filter(r=>r.status==='Revisions').length;
}

function cycleStage(i){
  const cur = rows[i].stage;
  const next = STAGES[(STAGES.indexOf(cur)+1) % STAGES.length];
  rows[i].stage = next;
  ajaxPatch(i, 'stage', next);
  logActivity('edit', `Stage updated for ${rows[i].client}`, `→ ${next}`);
  renderMobile();
  toast(`Stage → ${next} ✓`);
}

function promptPct(i, key){
  const val = prompt(`Enter ${key.toUpperCase()}% (0-100):`, rows[i][key]||0);
  if(val === null) return;
  const n = Math.max(0, Math.min(100, parseInt(val)||0));
  rows[i][key] = n;
  ajaxPatch(i, key, n);
  logActivity('edit', `Updated ${key==='fe'?'Front-end':'Back-end'} progress for ${rows[i].client}`, `${n}%`);
  renderMobile();
  toast('Saved ✓');
}

/* ══════════════════════════════════════════════
   DETAILS DRAWER
══════════════════════════════════════════════ */
function openDetails(i){
  const r = rows[i];
  document.getElementById('det-client-name').textContent = r.client;
  const body = document.getElementById('details-body');
  body.innerHTML = `
    <div class="form-group">
      <label>Client Name</label>
      <input type="text" value="${escHtml(r.client)}" class="mobile-input" onblur="saveField(${i},'client',this.value)">
    </div>
    <div class="form-group">
      <label>Tag / Sub-label</label>
      <input type="text" value="${escHtml(r.tag||'')}" class="mobile-input" onblur="saveField(${i},'tag',this.value)">
    </div>
    <div class="form-group">
      <label>Due Date</label>
      <input type="date" value="${r.due||''}" class="mobile-input" onchange="saveField(${i},'due',this.value)">
    </div>
    <div class="form-group">
      <label>UI/UX Status</label>
      <select class="mobile-input" onchange="saveField(${i},'uiux_status',this.value)">
        ${STATUSES.map(s=>`<option${r.uiux_status===s?' selected':''}>${s}</option>`).join('')}
      </select>
    </div>
    <div class="form-group">
      <label>Proposal Assigned</label>
      <input type="text" value="${escHtml(r.prop_assign||'')}" class="mobile-input" onblur="saveField(${i},'prop_assign',this.value)">
    </div>
    <div class="form-group">
      <label>UI/UX Assigned</label>
      <input type="text" value="${escHtml(r.uiux_assign||'')}" class="mobile-input" onblur="saveField(${i},'uiux_assign',this.value)">
    </div>
    <div class="form-group">
      <label>Dev Assigned</label>
      <input type="text" value="${escHtml(r.dev_assign||'')}" class="mobile-input" onblur="saveField(${i},'dev_assign',this.value)">
    </div>
    <div class="form-group">
      <label>Front-end Dev Status</label>
      <select class="mobile-input" onchange="saveField(${i},'dev_fe',this.value)">
        <option value="">—</option>
        ${['Done','In Progress','Pending'].map(s=>`<option${r.dev_fe===s?' selected':''}>${s}</option>`).join('')}
      </select>
    </div>
    <div class="form-group">
      <label>Back-end Dev Status</label>
      <select class="mobile-input" onchange="saveField(${i},'dev_be',this.value)">
        <option value="">—</option>
        ${['Done','In Progress','Pending'].map(s=>`<option${r.dev_be===s?' selected':''}>${s}</option>`).join('')}
      </select>
    </div>
    <div class="form-group">
      <label>Proposal Remarks</label>
      <textarea class="mobile-input" rows="3" onblur="saveField(${i},'prop_remark',this.value)">${escHtml(r.prop_remark||'')}</textarea>
    </div>
    <div class="form-group">
      <label>Final Remarks</label>
      <textarea class="mobile-input" rows="3" onblur="saveField(${i},'final_remark',this.value)">${escHtml(r.final_remark||'')}</textarea>
    </div>
  `;
  document.getElementById('details-overlay').classList.add('open');
  document.getElementById('details-drawer').classList.add('open');
}
function closeDetails(){
  document.getElementById('details-overlay').classList.remove('open');
  document.getElementById('details-drawer').classList.remove('open');
  renderMobile();
}
function saveField(i, key, val){
  if(rows[i][key] == val) return;
  const old = rows[i][key];
  rows[i][key] = val;
  ajaxPatch(i, key, val);
  logActivity('edit', `Edited ${key.replace(/_/g,' ')} for ${rows[i].client}`, `"${old}" → "${val}"`);
  toast('Saved ✓');
  updateStats();
}

/* ══════════════════════════════════════════════
   RECYCLE BIN
══════════════════════════════════════════════ */
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
  const body = document.getElementById('bin-body');
  if(!trash.length){
    body.innerHTML = `<div class="log-empty">🪣<br><br>Recycle Bin is empty.<br>Deleted records will appear here.</div>`;
    return;
  }
  body.innerHTML = trash.map((r,ti)=>`
    <div class="bin-card" id="bin-card-${ti}">
      <div class="bin-card-name">${escHtml(r.client)}</div>
      <div class="bin-card-tag">${escHtml(r.tag||'')} · ${r.status} · ${r.stage}</div>
      <div style="font-size:.65rem;color:var(--muted);margin-top:4px;">Deleted: ${r.deleted_at ? new Date(r.deleted_at).toLocaleDateString() : '—'}</div>
      <div class="bin-card-actions">
        <button class="restore-btn" onclick="restoreRow(${ti})">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
          Restore
        </button>
        <button class="perm-delete-btn" onclick="forceDelete(${r.id},${ti})">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
          Delete
        </button>
      </div>
    </div>
  `).join('');
}

async function restoreRow(ti){
  const r = trash[ti];
  const res = await fetch(ROUTES.restore(r.id), { method:'POST', headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'} });
  const data = await res.json();
  if(data.success){
    trash.splice(ti, 1);
    const rv = data.row;
    rows.push({
      id:rv.id, client:rv.client, tag:rv.tag||'', stage:rv.stage,
      prop_assign:rv.prop_assign||'—', prop_remark:rv.prop_remark||'',
      uiux_assign:rv.uiux_assign||'—', uiux_status:rv.uiux_status||'On Hold',
      dev_assign:rv.dev_assign||'—', dev_fe:rv.dev_fe||'', dev_be:rv.dev_be||'',
      fe:rv.fe||0, be:rv.be||0, status:rv.status,
      due:rv.due?rv.due.replace(' 00:00:00',''):'',
      final_remark:rv.final_remark||''
    });
    renderBin(); renderMobile(); updateBadges();
    logActivity('restore', `${rv.client} restored from Bin`);
    toast(`✅ ${rv.client} restored!`);
  }
}

async function forceDelete(id, ti){
  if(!confirm('Permanently delete this record? This cannot be undone.')) return;
  const res = await fetch(ROUTES.force(id), { method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'} });
  if(res.ok){
    const name = trash[ti].client;
    trash.splice(ti, 1);
    renderBin(); updateBadges();
    logActivity('delete', `Permanently deleted ${name}`);
    toast('Permanently deleted');
  }
}

/* ══════════════════════════════════════════════
   DELETE → BIN
══════════════════════════════════════════════ */
function askDelete(i){
  pendingDeleteIdx = i;
  document.getElementById('confirm-name').textContent = rows[i].client;
  document.getElementById('confirm-modal').classList.add('open');
}
function closeConfirm(){
  pendingDeleteIdx = null;
  document.getElementById('confirm-modal').classList.remove('open');
}
async function confirmDelete(){
  if(pendingDeleteIdx === null) return;
  const i = pendingDeleteIdx;
  closeConfirm();
  const op = rows[i];
  const res = await fetch(ROUTES.destroy(op.id), { method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'} });
  if(res.ok){
    trash.unshift(Object.assign({}, op, { deleted_at: new Date().toISOString() }));
    rows.splice(i, 1);
    renderMobile(); updateBadges();
    logActivity('delete', `${op.client} moved to Recycle Bin`);
    toast('Moved to Recycle Bin 🗑');
  }
}
document.getElementById('confirm-modal').addEventListener('click', e=>{ if(e.target===e.currentTarget) closeConfirm(); });

/* ══════════════════════════════════════════════
   ADD CLIENT
══════════════════════════════════════════════ */
function openAddModal(){ document.getElementById('add-modal').classList.add('open'); }
function closeAddModal(){ document.getElementById('add-modal').classList.remove('open'); }
function handleAddModalBg(e){ if(e.target===e.currentTarget) closeAddModal(); }

async function addRow(){
  const clientEl = document.getElementById('f-client');
  const client = clientEl.value.trim();
  if(!client){ clientEl.style.borderColor='var(--revision)'; clientEl.focus(); return; }
  clientEl.style.borderColor = '';

  const payload = {
    client,
    stage       : document.getElementById('f-stage').value,
    prop_assign : document.getElementById('f-prop-assign').value.trim() || '—',
    prop_remark : document.getElementById('f-prop-remark').value.trim(),
    uiux_status : document.getElementById('f-uiux-status').value,
    uiux_assign : document.getElementById('f-uiux-assign').value.trim() || '—',
    dev_assign  : document.getElementById('f-dev-assign').value.trim() || '—',
    dev_fe      : document.getElementById('f-dev-fe').value,
    dev_be      : document.getElementById('f-dev-be').value,
    status      : document.getElementById('f-status').value,
    due         : document.getElementById('f-due').value,
    fe          : parseInt(document.getElementById('f-fe').value)||0,
    be          : parseInt(document.getElementById('f-be').value)||0,
    final_remark: document.getElementById('f-final-remark').value.trim(),
    edited_by   : 'Mobile User',
  };

  const res = await fetch(ROUTES.store, {
    method:'POST',
    headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
    body: JSON.stringify(payload)
  });
  const data = await res.json();
  if(data.success){
    const r = data.row;
    rows.push({
      id:r.id, client:r.client, tag:r.tag||'', stage:r.stage,
      prop_assign:r.prop_assign||'—', prop_remark:r.prop_remark||'',
      uiux_status:r.uiux_status, uiux_assign:r.uiux_assign||'—',
      dev_assign:r.dev_assign||'—', dev_fe:r.dev_fe||'', dev_be:r.dev_be||'',
      fe:r.fe||0, be:r.be||0, status:r.status,
      due:r.due?r.due.replace(' 00:00:00',''):'', final_remark:r.final_remark||''
    });
    closeAddModal();
    ['f-client','f-prop-assign','f-uiux-assign','f-dev-assign','f-fe','f-be','f-due','f-prop-remark','f-final-remark'].forEach(id=>{ document.getElementById(id).value=''; });
    renderMobile();
    logActivity('add', `Added new client: ${r.client}`, `Stage: ${r.stage} · Status: ${r.status}`);
    toast('Client added ✓');
  } else {
    toast('Error saving — please try again');
    console.error(data);
  }
}

/* ══════════════════════════════════════════════
   AJAX PATCH
══════════════════════════════════════════════ */
async function ajaxPatch(idx, field, value){
  try{
    const res = await fetch(ROUTES.update(rows[idx].id), {
      method:'PATCH',
      headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},
      body: JSON.stringify({ field, value, edited_by:'Mobile User' })
    });
    await res.json();
  } catch(e){ console.error('Patch failed', e); }
}

/* ══════════════════════════════════════════════
   CLEAR LOG
══════════════════════════════════════════════ */
function askClearLog(){
  if(!activityLog.length){ toast('Log is already empty'); return; }
  document.getElementById('confirm-clear-log-modal').classList.add('open');
}
function closeClearLogConfirm(){
  document.getElementById('confirm-clear-log-modal').classList.remove('open');
}
async function confirmClearLog(){
  closeClearLogConfirm();
  try {
    await fetch(ROUTES.clearLogs, {
      method:'DELETE',
      headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}
    });
  } catch(e){ console.error('Clear log backend failed', e); }
  activityLog = [];
  logLastSeenCount = 0;
  updateBadges();
  renderLog();
  toast('Activity log cleared ✓');
}
document.getElementById('confirm-clear-log-modal').addEventListener('click', e=>{ if(e.target===e.currentTarget) closeClearLogConfirm(); });

/* ══════════════════════════════════════════════
   EXPORT
══════════════════════════════════════════════ */
function toggleExportDrop(e){
  e.stopPropagation();
  document.getElementById('export-drop').classList.toggle('open');
}
document.addEventListener('click', ()=> document.getElementById('export-drop')?.classList.remove('open'));

function exportXLSX(){
  document.getElementById('export-drop').classList.remove('open');
  showLoading('Generating XLSX…');
  try {
    const headers = ['Client','Tag','Stage','Prop. Assigned','Prop. Remarks','UI/UX Assigned','UI/UX Status','Dev Assigned','FE Status','BE Status','FE%','BE%','Status','Due Date','Final Remarks'];
    const data = [headers, ...rows.map(r=>[
      r.client||'', r.tag||'', r.stage||'', r.prop_assign||'', r.prop_remark||'',
      r.uiux_assign||'', r.uiux_status||'', r.dev_assign||'',
      r.dev_fe||'', r.dev_be||'', r.fe||0, r.be||0,
      r.status||'', r.due||'', r.final_remark||''
    ])];
    const wb = XLSX.utils.book_new();
    const ws = XLSX.utils.aoa_to_sheet(data);
    XLSX.utils.book_append_sheet(wb, ws, 'Operations');
    XLSX.writeFile(wb, `operations_${new Date().toISOString().split('T')[0]}.xlsx`);
    logActivity('edit','Exported XLSX',`${rows.length} records`);
    toast('XLSX exported ✓');
  } catch (e) {
    console.error(e);
    toast('Export failed');
  } finally {
    hideLoading();
  }
}

function exportPDF(){
  document.getElementById('export-drop').classList.remove('open');
  showLoading('Generating PDF…');
  try {
    const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
    const bg = isDark ? '#1a1014' : '#fdf6f0';
    const text = isDark ? '#f5e8e4' : '#3d2b22';
    const border = isDark ? '#4a2e36' : '#e8d5c4';
    const surface = isDark ? '#231519' : '#fff8f5';
    const statusColor = s => s==='Done'?'#5a9a6a':s==='On Hold'?'#b08020':'#c96070';

    const tableRows = rows.map(r => `
      <tr>
        <td>${escHtml(r.client)}<br><small style="color:#a08070">${escHtml(r.tag||'')}</small></td>
        <td>${escHtml(r.stage)}</td>
        <td>${escHtml(r.prop_assign||'—')}</td>
        <td>${escHtml(r.uiux_assign||'—')} (${r.uiux_status})</td>
        <td>${escHtml(r.dev_assign||'—')}</td>
        <td>FE: ${r.fe||0}% / BE: ${r.be||0}%</td>
        <td><span style="background:${statusColor(r.status)}22;color:${statusColor(r.status)};padding:2px 8px;border-radius:5px;font-size:.75rem;font-weight:600;">${escHtml(r.status)}</span></td>
        <td>${r.due||'—'}</td>
      </tr>
    `).join('');

    const html = `<!DOCTYPE html><html><head><meta charset="UTF-8">
      <style>
        body{font-family:sans-serif;background:${bg};color:${text};padding:32px;margin:0;}
        h1{font-size:1.5rem;font-weight:800;margin-bottom:4px;color:#c9637a;}
        .meta{font-size:.72rem;color:#a08070;margin-bottom:24px;}
        table{width:100%;border-collapse:collapse;background:${surface};border-radius:10px;overflow:hidden;}
        th{background:#F2E6D5;padding:10px 12px;font-size:.65rem;text-transform:uppercase;color:#7a5c50;text-align:left;border-bottom:2px solid ${border};}
        td{padding:12px;font-size:.8rem;border-bottom:1px solid ${border};vertical-align:top;}
        tr:last-child td{border-bottom:none;}
        @media print{body{padding:16px;}}
      </style></head><body>
      <h1>Operations Monitoring</h1>
      <div class="meta">Exported on ${new Date().toLocaleDateString('en-US',{month:'long',day:'numeric',year:'numeric'})} · ${rows.length} records</div>
      <table>
        <thead><tr><th>Client</th><th>Stage</th><th>Proposal</th><th>UI/UX</th><th>Dev</th><th>Progress</th><th>Status</th><th>Due Date</th></tr></thead>
        <tbody>${tableRows}</tbody>
      </table>
      <script>window.onload=function(){window.print();window.onafterprint=function(){window.close();}}<\/script>
      </body></html>`;

    const win = window.open('','_blank');
    if (!win) {
      toast('Popup blocked! Please allow popups.');
      return;
    }
    win.document.write(html);
    win.document.close();
    logActivity('edit','Exported PDF',`${rows.length} records`);
    toast('PDF ready ✓');
  } catch (e) {
    console.error(e);
    toast('PDF failed');
  } finally {
    hideLoading();
  }
}

/* ══════════════════════════════════════════════
   INIT
══════════════════════════════════════════════ */
renderMobile();
</script>
</body>
</html>