<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Operations Monitoring</title>
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

/* ══════════════════════════════════════════════
   RESET & BASE
══════════════════════════════════════════════ */
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{font-family:'Poppins',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;overflow-x:hidden;transition:background .4s ease,color .4s ease;}
body::before{content:'';position:fixed;inset:0;background-image:radial-gradient(circle,rgba(201,99,122,.09) 1px,transparent 1px);background-size:28px 28px;pointer-events:none;z-index:0;animation:dotDrift 20s ease-in-out infinite alternate;}
[data-theme="dark"] body::before{background-image:radial-gradient(circle,rgba(255,143,163,.07) 1px,transparent 1px);}
body::after{content:'';position:fixed;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,#FFC2CD,#e8a0b0,#F2E6D5,#c9637a,#b07060,#FFC2CD);background-size:300% 100%;animation:topbar 5s linear infinite;z-index:100;}

/* ══════════════════════════════════════════════
   KEYFRAMES
══════════════════════════════════════════════ */
@keyframes topbar{to{background-position:300% 0;}}
@keyframes slideDown{from{opacity:0;transform:translateY(-14px);}to{opacity:1;transform:translateY(0);}}
@keyframes fadeUp{from{opacity:0;transform:translateY(18px);}to{opacity:1;transform:translateY(0);}}
@keyframes popIn{from{opacity:0;transform:scale(.93);}to{opacity:1;transform:scale(1);}}
@keyframes rowIn{from{opacity:0;transform:translateX(-10px);}to{opacity:1;transform:translateX(0);}}
@keyframes rowOut{to{opacity:0;transform:translateX(18px);max-height:0;padding:0;}}
@keyframes rowPulse{0%{box-shadow:inset 0 0 0 2px rgba(201,99,122,.7);}100%{box-shadow:inset 0 0 0 2px transparent;}}
@keyframes blink{0%,100%{opacity:1}50%{opacity:.2}}
@keyframes dropIn{from{opacity:0;transform:translateY(-5px) scale(.97);}to{opacity:1;transform:translateY(0) scale(1);}}
@keyframes modalIn{from{opacity:0;transform:translateY(20px) scale(.97);}to{opacity:1;transform:translateY(0) scale(1);}}
@keyframes toastIn{from{opacity:0;transform:translateY(10px) scale(.96);}to{opacity:1;transform:translateY(0) scale(1);}}
@keyframes floatBin{0%,100%{transform:translateY(0);}50%{transform:translateY(-10px);}}
@keyframes cardIn{from{opacity:0;transform:translateX(20px);}to{opacity:1;transform:translateX(0);}}
@keyframes wobble{0%,100%{transform:rotate(0);}25%{transform:rotate(-12deg);}75%{transform:rotate(12deg);}}
@keyframes badgePop{from{transform:scale(0);}to{transform:scale(1);}}
@keyframes logSlide{from{opacity:0;transform:translateX(30px);}to{opacity:1;transform:translateX(0);}}
@keyframes spin{to{transform:rotate(360deg);}}
@keyframes shimmer{0%{background-position:-200% 0;}100%{background-position:200% 0;}}
@keyframes dotDrift{0%{background-position:0 0;}100%{background-position:28px 28px;}}
@keyframes floatOrb{0%,100%{transform:translate(0,0) scale(1);opacity:.4;}33%{transform:translate(30px,-20px) scale(1.1);opacity:.55;}66%{transform:translate(-20px,15px) scale(.95);opacity:.35;}}
@keyframes floatOrb2{0%,100%{transform:translate(0,0) scale(1);opacity:.3;}33%{transform:translate(-40px,20px) scale(1.08);opacity:.45;}66%{transform:translate(25px,-30px) scale(.92);opacity:.25;}}
@keyframes floatOrb3{0%,100%{transform:translate(0,0) scale(1);opacity:.25;}50%{transform:translate(20px,25px) scale(1.05);opacity:.4;}}

.bg-orb{position:fixed;border-radius:50%;pointer-events:none;z-index:0;filter:blur(80px);}
.bg-orb-1{width:600px;height:600px;background:radial-gradient(circle,rgba(201,99,122,.28),transparent 70%);top:-150px;right:-100px;animation:floatOrb 18s ease-in-out infinite;}
.bg-orb-2{width:500px;height:500px;background:radial-gradient(circle,rgba(176,112,96,.22),transparent 70%);bottom:-100px;left:-100px;animation:floatOrb2 22s ease-in-out infinite;}
.bg-orb-3{width:350px;height:350px;background:radial-gradient(circle,rgba(255,194,205,.25),transparent 70%);top:35%;left:35%;animation:floatOrb3 15s ease-in-out infinite;}

[data-theme="dark"] .bg-orb-1{background:radial-gradient(circle,rgba(255,143,163,.22),transparent 70%);}
[data-theme="dark"] .bg-orb-2{background:radial-gradient(circle,rgba(212,144,122,.18),transparent 70%);}
[data-theme="dark"] .bg-orb-3{background:radial-gradient(circle,rgba(255,143,163,.14),transparent 70%);}

/* ══════════════════════════════════════════════
   LAYOUT
══════════════════════════════════════════════ */
.wrapper{position:relative;z-index:1;padding:50px 32px 64px;width:100%;box-sizing:border-box;}

/* ══════════════════════════════════════════════
   HEADER
══════════════════════════════════════════════ */
.header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:32px;padding-bottom:22px;border-bottom:1px solid var(--border);animation:slideDown .5s ease both;flex-wrap:wrap;gap:16px;position:relative;z-index:1001;}
.header-left h1{font-size:2.1rem;font-weight:800;letter-spacing:-.5px;background:linear-gradient(135deg,var(--accent),var(--accent3));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.header-left p{font-size:.68rem;color:var(--muted);margin-top:5px;letter-spacing:.1em;text-transform:uppercase;}
.header-right{display:flex;gap:9px;align-items:center;flex-wrap:wrap;}

.stat-pill{display:flex;align-items:center;gap:6px;padding:6px 14px;border-radius:999px;border:1px solid var(--border);background:var(--surface);font-size:.69rem;color:var(--muted2);transition:background .4s,border-color .4s;animation:popIn .5s ease both;cursor:default;}
.stat-pill .dot{width:7px;height:7px;border-radius:50%;}
.stat-pill strong{font-weight:700;color:var(--text);}

/* Recycle Bin btn */
.recycle-btn{position:relative;display:flex;align-items:center;gap:8px;padding:8px 16px;border-radius:12px;border:1.5px solid var(--border);background:var(--surface2);cursor:pointer;font-family:'Poppins',sans-serif;font-size:.72rem;color:var(--muted2);transition:all .3s;animation:popIn .5s ease .05s both;}
.recycle-btn:hover{border-color:var(--done);color:var(--done);transform:scale(1.05);box-shadow:0 4px 15px var(--shadow);}
.recycle-btn svg{width:15px;height:15px;}
.recycle-badge{position:absolute;top:-7px;right:-7px;min-width:18px;height:18px;border-radius:999px;background:var(--revision);color:#fff;font-size:.6rem;font-weight:700;display:flex;align-items:center;justify-content:center;padding:0 4px;box-shadow:0 2px 6px rgba(201,96,112,.4);animation:badgePop .3s cubic-bezier(.34,1.8,.64,1);}
.recycle-badge.hidden{display:none;}

/* Activity Log btn */
.log-btn{position:relative;display:flex;align-items:center;gap:8px;padding:8px 16px;border-radius:12px;border:1.5px solid var(--border);background:var(--surface2);cursor:pointer;font-family:'Poppins',sans-serif;font-size:.72rem;color:var(--muted2);transition:all .3s;animation:popIn .5s ease .07s both;}
.log-btn:hover{border-color:var(--accent2);color:var(--accent);transform:scale(1.05);box-shadow:0 4px 15px var(--shadow);}
.log-btn svg{width:15px;height:15px;}
.log-badge{position:absolute;top:-7px;right:-7px;min-width:18px;height:18px;border-radius:999px;background:var(--accent);color:#fff;font-size:.6rem;font-weight:700;display:flex;align-items:center;justify-content:center;padding:0 4px;box-shadow:0 2px 6px var(--shadow);animation:badgePop .3s cubic-bezier(.34,1.8,.64,1);}
.log-badge.hidden{display:none;}

/* Export btn */
.export-btn{position:relative;display:flex;align-items:center;gap:8px;padding:8px 16px;border-radius:12px;border:1.5px solid var(--border);background:var(--surface2);cursor:pointer;font-family:'Poppins',sans-serif;font-size:.72rem;color:var(--muted2);transition:all .3s;animation:popIn .5s ease .08s both;}
.export-btn:hover{border-color:var(--done);color:var(--done);transform:scale(1.05);box-shadow:0 4px 15px var(--shadow);}
.export-btn svg{width:15px;height:15px;}
.export-dropdown{display:none;position:absolute;top:calc(100% + 6px);right:0;z-index:1000;background:var(--surface);border:1px solid var(--border);border-radius:10px;overflow:hidden;box-shadow:0 10px 30px var(--shadow);animation:dropIn .18s ease;min-width:140px;}
.export-dropdown.open{display:block;}
.export-opt{padding:10px 16px;font-size:.79rem;cursor:pointer;display:flex;align-items:center;gap:8px;transition:background .15s;font-family:'Poppins',sans-serif;color:var(--text);}
.export-opt:hover{background:var(--surface2);}

.theme-toggle{display:flex;align-items:center;gap:7px;padding:6px 13px;border-radius:999px;border:1px solid var(--border);background:var(--surface2);cursor:pointer;font-family:'Poppins',sans-serif;font-size:.69rem;color:var(--muted2);transition:all .3s;animation:popIn .5s ease .1s both;user-select:none;}
.theme-toggle:hover{border-color:var(--accent);color:var(--accent);}
.toggle-icons{display:flex;align-items:center;gap:3px;font-size:.78rem;}
.toggle-track{width:32px;height:17px;border-radius:999px;background:var(--border);position:relative;transition:background .3s;flex-shrink:0;}
.toggle-thumb{position:absolute;top:2px;left:2px;width:13px;height:13px;border-radius:50%;background:var(--accent);transition:transform .35s cubic-bezier(.34,1.56,.64,1);}
[data-theme="dark"] .toggle-thumb{transform:translateX(15px);}
[data-theme="dark"] .toggle-track{background:var(--accent3);}
.toggle-label{font-size:.69rem;font-weight:500;}

.add-btn{display:flex;align-items:center;gap:8px;padding:9px 20px;background:var(--accent);border:none;border-radius:10px;color:#fff;font-family:'Poppins',sans-serif;font-size:.82rem;font-weight:600;cursor:pointer;box-shadow:0 4px 14px var(--shadow);transition:background .2s,transform .15s,box-shadow .2s;animation:popIn .5s ease .2s both;}
.add-btn:hover{background:var(--accent3);transform:translateY(-2px);box-shadow:0 8px 22px var(--shadow);}
.add-btn svg{width:14px;height:14px;}

/* ══════════════════════════════════════════════
   SEARCH & FILTER BAR
══════════════════════════════════════════════ */
.filter-bar{display:flex;align-items:center;gap:10px;margin-bottom:20px;flex-wrap:wrap;animation:fadeUp .45s ease .05s both;}
.search-wrap{position:relative;flex:1;min-width:180px;max-width:320px;}
.search-wrap svg{position:absolute;left:11px;top:50%;transform:translateY(-50%);width:14px;height:14px;color:var(--muted);pointer-events:none;}
.search-input{width:100%;background:var(--surface);border:1px solid var(--border);border-radius:10px;padding:8px 12px 8px 32px;color:var(--text);font-family:'Poppins',sans-serif;font-size:.8rem;outline:none;transition:border-color .2s,box-shadow .2s,background .4s;}
.search-input::placeholder{color:var(--muted);opacity:.6;}
.search-input:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(201,99,122,.1);}
.filter-divider{width:1px;height:22px;background:var(--border);flex-shrink:0;}
.filter-label{font-family:'Poppins',sans-serif;font-size:.6rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.1em;white-space:nowrap;}
.filter-pills{display:flex;gap:6px;flex-wrap:wrap;align-items:center;}
.fpill{padding:5px 13px;border-radius:999px;border:1px solid var(--border);background:var(--surface);font-family:'Poppins',sans-serif;font-size:.71rem;font-weight:500;color:var(--muted2);cursor:pointer;transition:all .18s;white-space:nowrap;user-select:none;}
.fpill:hover{border-color:var(--accent);color:var(--accent);}
.fpill.active{background:var(--accent);border-color:var(--accent);color:#fff;box-shadow:0 2px 10px var(--shadow);}
.fpill.active.f-hold{background:var(--onhold);border-color:var(--onhold);}
.fpill.active.f-rev{background:var(--revision);border-color:var(--revision);}
.fpill.active.f-done{background:var(--done);border-color:var(--done);}
.filter-clear{padding:5px 11px;border-radius:999px;border:1px dashed var(--border);background:transparent;font-family:'Poppins',sans-serif;font-size:.69rem;color:var(--muted);cursor:pointer;transition:all .18s;display:none;align-items:center;gap:5px;}
.filter-clear:hover{border-color:var(--revision);color:var(--revision);}
.filter-clear.visible{display:inline-flex;}
.no-results-cell{text-align:center;padding:48px 24px;color:var(--muted);font-family:'Poppins',sans-serif;font-size:.85rem;}
.no-results-cell span{font-size:1.6rem;display:block;margin-bottom:8px;}

/* ══════════════════════════════════════════════
   TABLE
══════════════════════════════════════════════ */
.table-wrap{border-radius:16px;border:1px solid var(--border);overflow-x:auto;background:var(--surface);box-shadow:0 8px 40px var(--shadow);transition:background .4s,border-color .4s,box-shadow .4s;animation:fadeUp .55s ease .1s both;}
.table-wrap::-webkit-scrollbar{height:8px;}
.table-wrap::-webkit-scrollbar-thumb{background:var(--border);border-radius:4px;}
.table-wrap::-webkit-scrollbar-thumb:hover{background:var(--muted);}
table{width:100%;border-collapse:collapse;}

thead tr:first-child th{background:var(--surface2);padding:9px 14px 6px;font-family:'Poppins',sans-serif;font-size:.6rem;letter-spacing:.16em;text-transform:uppercase;font-weight:600;text-align:center;border-bottom:1px solid var(--border);color:var(--muted2);transition:background .4s;}
thead tr:first-child th:first-child{background:var(--surface);border-bottom:1px solid var(--border);}
.group-proposal{color:var(--accent) !important;}
.group-dev{color:var(--accent3) !important;}
.group-final{color:var(--onhold) !important;}

/* ── SORTABLE COLUMN HEADERS ── */
thead tr:last-child th{background:var(--surface3);padding:10px 14px;font-family:'Poppins',sans-serif;font-size:.63rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);text-align:left;border-bottom:2px solid var(--border);white-space:nowrap;transition:background .4s;}
.sortable{cursor:pointer;user-select:none;transition:color .2s;}
.sortable:hover{color:var(--accent);}
.sort-indicator{display:inline-flex;flex-direction:column;margin-left:4px;vertical-align:middle;opacity:.4;transition:opacity .2s;}
.sort-indicator.asc .si-up,.sort-indicator.desc .si-down{opacity:1;color:var(--accent);}
.sort-indicator svg{width:8px;height:8px;display:block;}
.sortable:hover .sort-indicator{opacity:.7;}

/* ── DELETE COLUMN HEADER FIX ── */
.col-sep{border-left:1px solid var(--border) !important;}
.subhead{display:flex;align-items:center;gap:6px;}
.subhead-dot{width:7px;height:7px;border-radius:2px;flex-shrink:0;}
.sd-proposal{background:var(--accent);}
.sd-dev{background:var(--accent3);}
.sd-status{background:var(--onhold);}

.delete-th{text-align:center;width:64px;padding:10px 8px !important;border-right:1px solid var(--border) !important;}
.delete-th-inner{display:flex;flex-direction:column;align-items:center;gap:4px;}
.delete-th-inner svg{width:13px;height:13px;color:var(--muted);opacity:.7;}
.delete-th-label{font-size:.55rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--muted);opacity:.7;}

/* Trash cell */
.trash-cell{text-align:center;vertical-align:middle !important;width:64px;padding:14px 8px !important;border-right:1px solid var(--border) !important;}
.trash-btn{display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:10px;border:1.5px solid var(--border);background:var(--surface2);color:var(--muted);cursor:pointer;transition:all .25s;}
.trash-btn:hover{background:rgba(201,96,112,.12);border-color:var(--revision);color:var(--revision);transform:scale(1.12);box-shadow:0 4px 12px rgba(201,96,112,.2);}
.trash-btn svg{width:14px;height:14px;pointer-events:none;}

tbody tr{border-bottom:1px solid var(--border);transition:background .2s;}
tbody tr:last-child{border-bottom:none;}
tbody tr:hover{background:rgba(255,194,205,.08);}
[data-theme="dark"] tbody tr:hover{background:rgba(255,143,163,.05);}
.row-enter{animation:rowIn .35s cubic-bezier(.22,1,.36,1) both;}
.row-pulse{animation:rowPulse .9s ease;}
td{padding:15px 14px;font-size:.82rem;color:var(--text);vertical-align:top;transition:color .4s;}

.client-name{font-weight:700;font-size:.92rem;color:var(--text);line-height:1.3;}
.client-tag{font-size:.62rem;color:var(--muted);margin-top:3px;}

.editable{cursor:text;border-radius:5px;padding:2px 5px;transition:background .2s,outline .2s;outline:none;min-width:20px;display:inline-block;}
.editable:hover{background:rgba(201,99,122,.08);}
.editable:focus{background:rgba(201,99,122,.12);outline:1.5px solid var(--accent);box-shadow:0 0 0 3px rgba(201,99,122,.1);}
[data-theme="dark"] .editable:hover{background:rgba(255,143,163,.08);}
[data-theme="dark"] .editable:focus{background:rgba(255,143,163,.12);box-shadow:0 0 0 3px rgba(255,143,163,.1);}
.edit-hint{display:none;}
.assignee-name:empty:before{content:attr(data-placeholder);color:var(--muted);opacity:.45;font-style:italic;pointer-events:none;}
tbody tr:hover .edit-hint{opacity:1;}

.steps{display:flex;flex-direction:column;gap:5px;margin-bottom:8px;}
.step{display:flex;align-items:center;gap:7px;font-size:.78rem;}
.step-check{width:16px;height:16px;border-radius:4px;flex-shrink:0;display:flex;align-items:center;justify-content:center;}
.step.done .step-check{background:rgba(90,154,106,.15);color:var(--done);}
.step.active .step-check{background:rgba(201,99,122,.18);color:var(--accent);}
.step.pending .step-check{background:rgba(160,128,112,.08);color:var(--muted);opacity:.6;}
.step.done>span{color:var(--done);}
.step.active>span{color:var(--text);font-weight:600;}
.step.pending>span{color:var(--muted);opacity:.55;}

.stage-select{width:100%;background:var(--surface2);border:1px solid var(--border);border-radius:6px;color:var(--text);font-family:'Poppins',sans-serif;font-size:.76rem;padding:5px 8px;cursor:pointer;outline:none;transition:border-color .2s,background .4s;margin-top:4px;}
.stage-select:focus{border-color:var(--accent);}
.stage-select option{background:var(--surface);}

.assignee{display:flex;align-items:center;gap:8px;margin-bottom:6px;}
.avatar{width:30px;height:30px;border-radius:8px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-family:'Poppins',sans-serif;font-size:.65rem;font-weight:700;transition:transform .2s;}
.avatar:hover{transform:scale(1.12);}
.av1{background:rgba(255,194,205,.45);color:var(--accent);}
.av2{background:rgba(176,112,96,.18);color:var(--accent3);}
.av3{background:rgba(201,160,90,.18);color:var(--onhold);}
.av4{background:rgba(160,120,136,.18);color:var(--muted2);}
[data-theme="dark"] .av1{background:rgba(255,143,163,.18);}
[data-theme="dark"] .av2{background:rgba(212,144,122,.18);}
[data-theme="dark"] .av3{background:rgba(212,168,64,.18);}
[data-theme="dark"] .av4{background:rgba(160,120,136,.18);}
.assignee-name{font-size:.8rem;color:var(--muted2);font-weight:500;}

.dev-select-minimal{font-size:.62rem;background:var(--surface3);border:1px solid var(--border);color:var(--muted);border-radius:6px;padding:2px 6px;outline:none;cursor:pointer;transition:all .2s;font-family:'Poppins',sans-serif;flex:1;}
.dev-select-minimal:hover{border-color:var(--accent);color:var(--text);}

.progress-wrap{display:flex;flex-direction:column;gap:8px;}
.progress-row{display:flex;flex-direction:column;gap:3px;}
.progress-label-row{display:flex;justify-content:space-between;align-items:center;font-size:.62rem;color:var(--muted);}
.progress-bar{height:5px;border-radius:99px;background:var(--border);overflow:hidden;width:90px;}
.progress-fill{height:100%;border-radius:99px;transition:width .8s cubic-bezier(.34,1.56,.64,1);}
.pf-fe{background:linear-gradient(90deg,var(--pink),var(--accent));}
.pf-be{background:linear-gradient(90deg,var(--cream),var(--accent3));}
[data-theme="dark"] .pf-fe{background:linear-gradient(90deg,#ff8fa3,#ff5c7a);}
[data-theme="dark"] .pf-be{background:linear-gradient(90deg,#d4907a,#c9637a);}
.pct-label{font-weight:600;color:var(--muted2) !important;}

.status-select-wrap{position:relative;}
.status-badge{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:12px;font-size:.78rem;font-weight:700;cursor:pointer;transition:all .2s;user-select:none;font-family:'Poppins',sans-serif;white-space:nowrap;box-shadow:0 2px 8px var(--shadow);}
.status-badge:hover{transform:translateY(-1px);box-shadow:0 4px 12px var(--shadow);}
.badge-dot{width:9px;height:9px;border-radius:50%;}
.s-done{background:rgba(90,154,106,.08);color:var(--done);border:1.5px solid rgba(90,154,106,.22);}
.s-done .badge-dot{background:var(--done);box-shadow:0 0 8px var(--done);}
.s-onhold{background:rgba(176,128,32,.08);color:var(--onhold);border:1.5px solid rgba(176,128,32,.22);}
.s-onhold .badge-dot{background:var(--onhold);box-shadow:0 0 8px var(--onhold);}
.s-revision{background:rgba(201,96,112,.08);color:var(--revision);border:1.5px solid rgba(201,96,112,.22);}
.s-revision .badge-dot{background:var(--revision);box-shadow:0 0 8px var(--revision);animation:blink 1.6s infinite;}
.status-dropdown{display:none;position:absolute;top:calc(100% + 6px);left:0;z-index:50;background:var(--surface);border:1px solid var(--border);border-radius:10px;overflow:hidden;box-shadow:0 10px 30px var(--shadow);animation:dropIn .18s ease;min-width:132px;}
.status-dropdown.open{display:block;}
.status-opt{padding:9px 14px;font-size:.79rem;cursor:pointer;display:flex;align-items:center;gap:8px;transition:background .15s;font-family:'Poppins',sans-serif;}
.status-opt:hover{background:var(--surface2);}
.sopt-dot{width:8px;height:8px;border-radius:50%;}

/* ── DUE DATE + NOTIFICATION ── */
.due-input{position:absolute;opacity:0;width:1px;height:1px;pointer-events:none;border:none;padding:0;margin:0;}
.due-date{font-size:.7rem;color:var(--muted2);display:flex;align-items:center;gap:5px;margin-bottom:4px;background:rgba(201,99,122,.06);padding:4px 8px;border-radius:6px;width:fit-content;transition:all .3s;}
.due-date:hover{background:rgba(201,99,122,.12);color:var(--text);}
.due-date svg{width:13px;height:13px;}
.due-overdue{color:var(--revision) !important;background:rgba(201,96,112,.1) !important;}

.due-notification{font-size:.68rem;font-weight:600;padding:5px 9px;border-radius:7px;margin-top:6px;display:flex;align-items:center;gap:6px;background:linear-gradient(135deg,rgba(201,96,112,.15),rgba(201,96,112,.08));border:1px solid rgba(201,96,112,.3);color:var(--revision);}
.due-notification svg{width:12px;height:12px;flex-shrink:0;}
.due-notification.warning{background:linear-gradient(135deg,rgba(176,128,32,.15),rgba(176,128,32,.08));border-color:rgba(176,128,32,.3);color:var(--onhold);}
.due-notification.safe{background:linear-gradient(135deg,rgba(90,154,106,.15),rgba(90,154,106,.08));border-color:rgba(90,154,106,.3);color:var(--done);}

.final-header-row{display:flex;align-items:center;gap:8px;margin-bottom:6px;}
.final-tag{font-family:'Poppins',sans-serif;font-size:.56rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--onhold);background:rgba(176,128,32,.1);border:1px solid rgba(176,128,32,.22);border-radius:5px;padding:2px 7px;display:inline-block;white-space:nowrap;}
.final-date-str{font-family:'Poppins',sans-serif;font-size:.76rem;color:var(--muted2);font-weight:500;}
.cal-icon-btn{background:none;border:none;cursor:pointer;color:var(--muted);padding:2px 4px;border-radius:5px;transition:color .2s,background .2s;display:inline-flex;align-items:center;}
.cal-icon-btn:hover{color:var(--accent);background:var(--surface2);}
.final-text{font-size:.77rem;color:var(--muted);margin-top:6px;line-height:1.55;min-height:22px;white-space:pre-wrap;word-break:break-word;max-height:200px;overflow-y:auto;text-align:justify;}
.final-text:empty:before{content:attr(data-placeholder);color:var(--muted);opacity:.45;pointer-events:none;font-style:italic;}
.remark-text{font-size:.77rem;color:var(--muted);margin-top:6px;line-height:1.5;min-height:22px;white-space:pre-wrap;word-break:break-word;max-height:200px;overflow-y:auto;text-align:justify;}
.remark-text:empty:before{content:attr(data-placeholder);color:var(--muted);opacity:.45;pointer-events:none;font-style:italic;}

/* ══════════════════════════════════════════════
   FOOTER
══════════════════════════════════════════════ */
.footer{display:flex;align-items:center;justify-content:space-between;margin-top:24px;padding-top:16px;border-top:1px solid var(--border);animation:fadeUp .55s ease .2s both;flex-wrap:wrap;gap:12px;}
.footer-left{font-size:.68rem;color:var(--muted);font-family:'Poppins',sans-serif;}
.footer-right{display:flex;align-items:center;gap:12px;flex-wrap:wrap;}
.legend-item{display:flex;align-items:center;gap:5px;font-size:.66rem;color:var(--muted);font-family:'Poppins',sans-serif;}
.ldot{width:7px;height:7px;border-radius:50%;flex-shrink:0;}

/* ══════════════════════════════════════════════
   RECYCLE BIN DRAWER
══════════════════════════════════════════════ */
.bin-drawer-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.35);backdrop-filter:blur(5px);z-index:400;}
.bin-drawer-overlay.open{display:block;}
.bin-drawer{position:fixed;right:0;top:0;bottom:0;width:460px;background:linear-gradient(160deg,var(--surface),var(--surface2));border-left:1.5px solid var(--border);box-shadow:-16px 0 60px var(--shadow);z-index:401;display:flex;flex-direction:column;transform:translateX(100%);transition:transform .4s cubic-bezier(.22,1,.36,1);}
.bin-drawer.open{transform:translateX(0);}
.bin-drawer-header{padding:28px 28px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-shrink:0;}
.bin-drawer-title{display:flex;align-items:center;gap:12px;}
.bin-drawer-title h2{font-size:1.1rem;font-weight:700;color:var(--text);font-family:'Poppins',sans-serif;}
.bin-drawer-title svg{width:22px;height:22px;color:var(--accent);}
.bin-count-pill{font-size:.65rem;font-weight:600;background:rgba(201,96,112,.15);color:var(--revision);border:1px solid rgba(201,96,112,.3);border-radius:999px;padding:3px 10px;font-family:'Poppins',sans-serif;}
.bin-close-btn{width:32px;height:32px;border-radius:8px;border:1.5px solid var(--border);background:transparent;color:var(--muted);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;}
.bin-close-btn:hover{background:var(--surface3);color:var(--text);border-color:var(--accent);}
.bin-close-btn svg{width:14px;height:14px;}
.bin-drawer-body{flex:1;overflow-y:auto;padding:20px 28px;display:flex;flex-direction:column;gap:12px;}
.bin-drawer-body::-webkit-scrollbar{width:6px;}
.bin-drawer-body::-webkit-scrollbar-thumb{background:var(--border);border-radius:3px;}
.bin-drawer-body::-webkit-scrollbar-thumb:hover{background:var(--accent);}
.bin-empty{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:12px;padding:40px;text-align:center;color:var(--muted);}
.bin-empty-icon{font-size:3.5rem;opacity:.4;animation:floatBin 3s ease-in-out infinite;}
.bin-empty p{font-size:.82rem;line-height:1.5;font-family:'Poppins',sans-serif;}
.bin-drawer-footer{padding:16px 28px;border-top:1px solid var(--border);flex-shrink:0;display:flex;align-items:center;justify-content:space-between;gap:10px;}
.bin-footer-note{font-size:.62rem;color:var(--muted);line-height:1.4;font-family:'Poppins',sans-serif;}
.btn-empty-bin{padding:9px 18px;border-radius:10px;border:1.5px solid rgba(201,96,112,.4);background:rgba(201,96,112,.08);color:var(--revision);font-family:'Poppins',sans-serif;font-size:.78rem;font-weight:600;cursor:pointer;transition:all .2s;white-space:nowrap;}
.btn-empty-bin:hover{background:rgba(201,96,112,.15);transform:translateY(-1px);}
.bin-card{background:var(--surface);border:1.5px solid var(--border);border-radius:14px;padding:16px 18px;transition:all .3s;animation:cardIn .35s cubic-bezier(.22,1,.36,1) both;}
.bin-card:hover{border-color:var(--accent2);box-shadow:0 6px 20px var(--shadow);transform:translateX(-3px);}
.bin-card-top{display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:10px;}
.bin-card-name{font-weight:700;font-size:.9rem;color:var(--text);font-family:'Poppins',sans-serif;}
.bin-card-tag{font-size:.6rem;color:var(--muted);margin-top:1px;}
.bin-card-meta{display:flex;flex-wrap:wrap;gap:6px;margin-top:8px;}
.bin-meta-pill{font-size:.65rem;padding:3px 9px;border-radius:6px;border:1px solid var(--border);background:var(--surface2);color:var(--muted2);font-family:'Poppins',sans-serif;}
.bin-deleted-at{font-size:.6rem;color:var(--muted);margin-top:8px;display:flex;align-items:center;gap:4px;font-family:'Poppins',sans-serif;}
.bin-deleted-at svg{width:10px;height:10px;opacity:.6;}
.bin-card-actions{display:flex;gap:8px;margin-top:12px;padding-top:12px;border-top:1px solid var(--border);justify-content:flex-end;}
.restore-btn{display:flex;align-items:center;gap:6px;padding:8px 14px;border-radius:10px;border:1.5px solid rgba(90,154,106,.4);background:rgba(90,154,106,.08);color:var(--done);font-family:'Poppins',sans-serif;font-size:.75rem;font-weight:600;cursor:pointer;transition:all .2s;white-space:nowrap;}
.restore-btn:hover{background:rgba(90,154,106,.18);transform:scale(1.05);box-shadow:0 4px 12px rgba(90,154,106,.2);}
.restore-btn svg{width:14px;height:14px;}
.perm-delete-btn{display:flex;align-items:center;gap:6px;padding:8px 14px;border-radius:10px;border:1.5px solid rgba(201,96,112,.4);background:rgba(201,96,112,.08);color:var(--revision);font-family:'Poppins',sans-serif;font-size:.75rem;font-weight:600;cursor:pointer;transition:all .2s;white-space:nowrap;}
.perm-delete-btn:hover{background:rgba(201,96,112,.18);transform:scale(1.05);box-shadow:0 4px 12px rgba(201,96,112,.2);}
.perm-delete-btn svg{width:14px;height:14px;}

/* ══════════════════════════════════════════════
   ACTIVITY LOG DRAWER
══════════════════════════════════════════════ */
.log-drawer-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.35);backdrop-filter:blur(5px);z-index:400;}
.log-drawer-overlay.open{display:block;}
.log-drawer{position:fixed;right:0;top:0;bottom:0;width:420px;background:linear-gradient(160deg,var(--surface),var(--surface2));border-left:1.5px solid var(--border);box-shadow:-16px 0 60px var(--shadow);z-index:401;display:flex;flex-direction:column;transform:translateX(100%);transition:transform .4s cubic-bezier(.22,1,.36,1);}
.log-drawer.open{transform:translateX(0);}
.log-drawer-header{padding:28px 28px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-shrink:0;}
.log-drawer-title{display:flex;align-items:center;gap:12px;}
.log-drawer-title h2{font-size:1.1rem;font-weight:700;color:var(--text);font-family:'Poppins',sans-serif;}
.log-drawer-title svg{width:22px;height:22px;color:var(--accent);}
.log-close-btn{width:32px;height:32px;border-radius:8px;border:1.5px solid var(--border);background:transparent;color:var(--muted);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;}
.log-close-btn:hover{background:var(--surface3);color:var(--text);border-color:var(--accent);}
.log-close-btn svg{width:14px;height:14px;}
.log-body{flex:1;overflow-y:auto;padding:20px 28px;display:flex;flex-direction:column;gap:0;}
.log-body::-webkit-scrollbar{width:6px;}
.log-body::-webkit-scrollbar-thumb{background:var(--border);border-radius:3px;}
.log-empty{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:12px;padding:60px 40px;text-align:center;color:var(--muted);}
.log-empty-icon{font-size:3rem;opacity:.4;}
.log-empty p{font-size:.82rem;line-height:1.5;font-family:'Poppins',sans-serif;}
.log-entry{display:flex;gap:14px;padding:14px 0;border-bottom:1px solid var(--border);animation:logSlide .3s ease both;}
.log-entry:last-child{border-bottom:none;}
.log-dot-col{display:flex;flex-direction:column;align-items:center;gap:0;flex-shrink:0;padding-top:2px;}
.log-dot{width:10px;height:10px;border-radius:50%;flex-shrink:0;border:2px solid var(--surface);}
.log-line{flex:1;width:1px;background:var(--border);min-height:20px;margin-top:4px;}
.log-entry:last-child .log-line{display:none;}
.log-content{flex:1;min-width:0;}
.log-action{font-size:.78rem;font-weight:600;color:var(--text);font-family:'Poppins',sans-serif;}
.log-detail{font-size:.72rem;color:var(--muted);margin-top:2px;line-height:1.45;}
.log-time{font-size:.62rem;color:var(--muted);margin-top:4px;display:flex;align-items:center;gap:4px;}
.log-time svg{width:9px;height:9px;opacity:.6;}
.log-clear-btn{padding:9px 18px;border-radius:10px;border:1.5px solid var(--border);background:transparent;color:var(--muted);font-family:'Poppins',sans-serif;font-size:.76rem;font-weight:500;cursor:pointer;transition:all .2s;white-space:nowrap;}
.log-clear-btn:hover{border-color:var(--revision);color:var(--revision);}
.log-drawer-footer{padding:16px 28px;border-top:1px solid var(--border);flex-shrink:0;display:flex;align-items:center;justify-content:space-between;gap:10px;}
.log-footer-note{font-size:.62rem;color:var(--muted);line-height:1.4;font-family:'Poppins',sans-serif;}

/* ══════════════════════════════════════════════
   ADD CLIENT MODAL
══════════════════════════════════════════════ */
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:200;align-items:center;justify-content:center;backdrop-filter:blur(3px);}
.modal-overlay.open{display:flex;}
.modal{background:var(--surface);border:1px solid var(--border);border-radius:18px;padding:32px;width:min(640px,94vw);max-height:90vh;overflow-y:auto;box-shadow:0 24px 64px var(--shadow);animation:modalIn .28s cubic-bezier(.22,1,.36,1);}
.modal h2{font-family:'Poppins',sans-serif;font-size:1.25rem;font-weight:700;color:var(--text);margin-bottom:22px;}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
.form-group{display:flex;flex-direction:column;gap:5px;}
.form-group.full{grid-column:1/-1;}
.form-group label{font-family:'Poppins',sans-serif;font-size:.65rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.1em;}
.form-group input,.form-group select,.form-group textarea{background:var(--surface2);border:1px solid var(--border);border-radius:8px;padding:9px 12px;color:var(--text);font-family:'Poppins',sans-serif;font-size:.82rem;outline:none;transition:border-color .2s,box-shadow .2s;resize:vertical;}
.form-group input:focus,.form-group select:focus,.form-group textarea:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(201,99,122,.1);}
.form-group select option{background:var(--surface);}
.modal-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:22px;}
.btn-cancel{padding:9px 20px;border-radius:9px;border:1px solid var(--border);background:transparent;color:var(--muted2);font-family:'Poppins',sans-serif;font-size:.82rem;cursor:pointer;transition:background .2s;}
.btn-cancel:hover{background:var(--surface2);}
.btn-save{padding:9px 22px;border-radius:9px;border:none;background:var(--accent);color:#fff;font-family:'Poppins',sans-serif;font-size:.82rem;font-weight:600;cursor:pointer;box-shadow:0 4px 14px var(--shadow);transition:background .2s,transform .15s;}
.btn-save:hover{background:var(--accent3);transform:translateY(-1px);}

/* ══════════════════════════════════════════════
   CONFIRM MODAL
══════════════════════════════════════════════ */
.confirm-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);backdrop-filter:blur(8px);z-index:500;align-items:center;justify-content:center;}
.confirm-overlay.open{display:flex;}
.confirm-box{background:var(--glass);backdrop-filter:blur(20px);border:1.5px solid var(--border);border-radius:20px;padding:32px 36px;width:380px;text-align:center;box-shadow:0 24px 60px var(--shadow);animation:modalIn .3s cubic-bezier(.34,1.4,.64,1);font-family:'Poppins',sans-serif;}
.confirm-box .bin-icon{font-size:2.4rem;margin-bottom:12px;display:block;animation:wobble .6s ease;}
.confirm-box h3{font-size:1rem;font-weight:700;color:var(--text);margin-bottom:6px;}
.confirm-box p{font-size:.8rem;color:var(--muted);margin-bottom:22px;line-height:1.5;}
.confirm-box strong{color:var(--accent);}
.confirm-actions{display:flex;gap:10px;justify-content:center;}
.btn-confirm-cancel{padding:10px 22px;border-radius:10px;border:1.5px solid var(--border);background:transparent;color:var(--muted2);font-family:'Poppins',sans-serif;font-size:.84rem;font-weight:500;cursor:pointer;transition:all .2s;}
.btn-confirm-cancel:hover{background:var(--surface2);color:var(--text);}
.btn-confirm-delete{padding:10px 22px;border-radius:10px;border:none;background:linear-gradient(135deg,var(--revision),#a03050);color:#fff;font-family:'Poppins',sans-serif;font-size:.84rem;font-weight:600;cursor:pointer;box-shadow:0 4px 14px rgba(201,96,112,.3);transition:all .2s;}
.btn-confirm-delete:hover{transform:translateY(-2px);box-shadow:0 8px 22px rgba(201,96,112,.4);}

/* ══════════════════════════════════════════════
   TOAST
══════════════════════════════════════════════ */
.toast{position:fixed;bottom:24px;right:24px;z-index:9999;background:var(--text);color:var(--bg);padding:10px 20px;border-radius:10px;font-family:'Poppins',sans-serif;font-size:.8rem;font-weight:500;box-shadow:0 6px 24px var(--shadow);animation:toastIn .25s cubic-bezier(.22,1,.36,1);}

/* ══════════════════════════════════════════════
   LOADING OVERLAY (for export)
══════════════════════════════════════════════ */
.loading-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.3);backdrop-filter:blur(4px);z-index:600;align-items:center;justify-content:center;}
.loading-overlay.open{display:flex;}
.loading-box{background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:28px 36px;text-align:center;box-shadow:0 16px 50px var(--shadow);font-family:'Poppins',sans-serif;}
.loading-spinner{width:32px;height:32px;border:3px solid var(--border);border-top-color:var(--accent);border-radius:50%;animation:spin .8s linear infinite;margin:0 auto 12px;}
.loading-box p{font-size:.82rem;color:var(--muted);}

</style>
</head>
<body>
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>
<div class="bg-orb bg-orb-3"></div>
<div class="wrapper">

  <!-- ══ HEADER ══ -->
  <div class="header">
    <div class="header-left">
      <h1>Operations Monitoring</h1>
      <p>Web Development Pipeline &nbsp;·&mdash;&nbsp; Click any cell to edit</p>
    </div>
    <div class="header-right">
      <div class="stat-pill"><span class="dot" style="background:var(--done)"></span>Done <strong id="cnt-done">0</strong></div>
      <div class="stat-pill"><span class="dot" style="background:var(--onhold)"></span>On Hold <strong id="cnt-hold">0</strong></div>
      <div class="stat-pill"><span class="dot" style="background:var(--revision)"></span>Revisions <strong id="cnt-rev">0</strong></div>

      <!-- Activity Log -->
      <button class="log-btn" onclick="openLog()" title="Activity Log">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
        </svg>
        <span>Activity Log</span>
        <span class="log-badge hidden" id="log-badge">0</span>
      </button>

      <!-- Export -->
      <div style="position:relative;">
        <button class="export-btn" onclick="toggleExportDrop(event)" title="Export">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
          </svg>
          <span>Export</span>
        </button>
        <div class="export-dropdown" id="export-dropdown">
          <div class="export-opt" onclick="exportXLSX()">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            Export XLSX
          </div>
          <div class="export-opt" onclick="exportPDF()">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="13" x2="15" y2="13"/><line x1="9" y1="17" x2="15" y2="17"/></svg>
            Export PDF
          </div>
        </div>
      </div>

      <!-- Recycle Bin -->
      <button class="recycle-btn" onclick="openBin()" title="Recycle Bin">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M3 6h18M8 6V4h8v2M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
          <path d="M10 11v6M14 11v6"/>
        </svg>
        <span>Recycle Bin</span>
        <span class="recycle-badge hidden" id="bin-badge">0</span>
      </button>

      <!-- Theme Toggle -->
      <div class="theme-toggle" onclick="toggleTheme()" title="Toggle theme">
        <div class="toggle-icons">
          <span id="theme-icon-sun">🌙</span>
          <span id="theme-icon-moon" style="display:none">☀️</span>
        </div>
        <div class="toggle-track"><div class="toggle-thumb"></div></div>
        <span class="toggle-label" id="theme-label">Dark</span>
      </div>

      <!-- Add Client -->
      <button class="add-btn" onclick="openModal()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Client
      </button>
    </div>
  </div>

  <!-- ══ SEARCH & FILTER BAR ══ -->
  <div class="filter-bar">
    <div class="search-wrap">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input class="search-input" id="search-input" type="text" placeholder="Search clients…" oninput="applyFilters()" />
    </div>
    <div class="filter-divider"></div>
    <span class="filter-label">UI/UX</span>
    <div class="filter-pills">
      <div class="fpill f-done"  onclick="toggleFilter('uiux_status','Done')"      id="fpill-uiux-done">Done</div>
      <div class="fpill f-hold"  onclick="toggleFilter('uiux_status','On Hold')"   id="fpill-uiux-hold">On Hold</div>
      <div class="fpill f-rev"   onclick="toggleFilter('uiux_status','Revisions')" id="fpill-uiux-rev">Revisions</div>
    </div>
    <div class="filter-divider"></div>
    <span class="filter-label">Dev</span>
    <div class="filter-pills">
      <div class="fpill f-done"  onclick="toggleFilter('dev_status','Done')"      id="fpill-dev-done">Done</div>
      <div class="fpill f-hold"  onclick="toggleFilter('dev_status','On Hold')"   id="fpill-dev-hold">On Hold</div>
      <div class="fpill f-rev"   onclick="toggleFilter('dev_status','Revisions')" id="fpill-dev-rev">Revisions</div>
    </div>
    <div class="filter-divider"></div>
    <span class="filter-label">Stage</span>
    <div class="filter-pills">
      <div class="fpill" onclick="toggleFilter('stage','Homepage')"       id="fpill-hp">Homepage</div>
      <div class="fpill" onclick="toggleFilter('stage','Sitemap')"        id="fpill-sm">Sitemap</div>
      <div class="fpill" onclick="toggleFilter('stage','All Pages')"      id="fpill-ap">All Pages</div>
      <div class="fpill" onclick="toggleFilter('stage','Final Homepage')" id="fpill-fh">Final</div>
    </div>
    <button class="filter-clear" id="filter-clear" onclick="clearFilters()">
      <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      Clear
    </button>
  </div>

  <!-- ══ TABLE ══ -->
  <div class="table-wrap">
    <table>
      <colgroup>
        <col style="width:64px">
        <col style="width:145px">
        <col style="width:155px">
        <col style="width:265px">
        <col style="width:155px">
        <col style="width:155px">
        <col style="width:155px">
        <col style="width:135px">
        <col style="width:130px">
        <col style="width:125px">
        <col style="width:225px">
      </colgroup>
      <thead>
        <tr>
          <th style="background:var(--surface2);border-bottom:1px solid var(--border);border-right:1px solid var(--border);">
            <div class="delete-th-inner">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                <path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/>
              </svg>
              <span class="delete-th-label">Delete</span>
            </div>
          </th>
          <th style="background:var(--surface2);padding:9px 14px 6px;font-size:.6rem;letter-spacing:.16em;text-transform:uppercase;font-weight:600;border-bottom:1px solid var(--border);color:var(--muted2);"></th>
          <th colspan="4" class="group-proposal col-sep" style="background:var(--surface2);padding:9px 14px 6px;font-size:.6rem;letter-spacing:.16em;text-transform:uppercase;font-weight:600;text-align:center;border-bottom:1px solid var(--border);">📋 Proposal Phase</th>
          <th colspan="4" class="group-dev col-sep" style="background:var(--surface2);padding:9px 14px 6px;font-size:.6rem;letter-spacing:.16em;text-transform:uppercase;font-weight:600;text-align:center;border-bottom:1px solid var(--border);">⚙ Development Phase</th>
          <th colspan="1" class="group-final col-sep" style="background:var(--surface2);padding:9px 14px 6px;font-size:.6rem;letter-spacing:.16em;text-transform:uppercase;font-weight:600;text-align:center;border-bottom:1px solid var(--border);">⊞ Final</th>
        </tr>
        <tr>
          <th class="delete-th" style="background:var(--surface3);border-bottom:2px solid var(--border);"></th>

          <!-- Sortable: Client Name -->
          <th class="sortable" onclick="sortTable('client')" title="Sort by Client">
            Client Name
            <span class="sort-indicator" id="sort-client"><svg viewBox="0 0 10 6" class="si-up"><path d="M1 5l4-4 4 4" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round"/></svg><svg viewBox="0 0 10 6" class="si-down"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round"/></svg></span>
          </th>
          <th class="col-sep">
            <div class="subhead"><span class="subhead-dot sd-proposal"></span>Proposal Status</div>
          </th>
          <th>Proposal Remarks</th>
          <th class="col-sep">UI/UX Assigned</th>
          <th>
            <div class="subhead"><span class="subhead-dot sd-proposal"></span>Status</div>
          </th>
          <th class="col-sep">Dev Assigned</th>
          <th>
            <div class="subhead"><span class="subhead-dot sd-dev"></span>Dev Status</div>
          </th>
          <th>Progress</th>

          <th>
            <div class="subhead"><span class="subhead-dot sd-status"></span>Status</div>
          </th>

          <!-- Sortable: Due Date -->
          <th class="col-sep sortable" onclick="sortTable('due')" title="Sort by Due Date">
            Final Remarks
            <span class="sort-indicator" id="sort-due"><svg viewBox="0 0 10 6" class="si-up"><path d="M1 5l4-4 4 4" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round"/></svg><svg viewBox="0 0 10 6" class="si-down"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round"/></svg></span>
          </th>
        </tr>
      </thead>
      <tbody id="table-body"></tbody>
    </table>
  </div>

  <!-- ══ FOOTER ══ -->
  <div class="footer">
    <div class="footer-left" id="footer-count">0 clients tracked</div>
    <div class="footer-right">
      <div class="legend-item"><span class="ldot" style="background:var(--done)"></span>Done</div>
      <div class="legend-item"><span class="ldot" style="background:var(--onhold)"></span>On Hold</div>
      <div class="legend-item"><span class="ldot" style="background:var(--revision)"></span>Revisions</div>
    </div>
  </div>
</div>

<!-- ══ RECYCLE BIN DRAWER ══ -->
<div class="bin-drawer-overlay" id="bin-overlay" onclick="closeBin()"></div>
<div class="bin-drawer" id="bin-drawer">
  <div class="bin-drawer-header">
    <div class="bin-drawer-title">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 6h18M8 6V4h8v2M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/>
      </svg>
      <h2>Recycle Bin</h2>
      <span class="bin-count-pill" id="bin-count-pill">0 items</span>
    </div>
    <button class="bin-close-btn" onclick="closeBin()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6 6 18M6 6l12 12"/></svg>
    </button>
  </div>
  <div class="bin-drawer-body" id="bin-body"></div>
  <div class="bin-drawer-footer">
    <div class="bin-footer-note">Deleted records are kept here.<br>Restore anytime or empty to permanently remove.</div>
    <button class="btn-empty-bin" onclick="emptyBin()">Empty Bin 🗑</button>
  </div>
</div>

<!-- ══ ACTIVITY LOG DRAWER ══ -->
<div class="log-drawer-overlay" id="log-overlay" onclick="closeLog()"></div>
<div class="log-drawer" id="log-drawer">
  <div class="log-drawer-header">
    <div class="log-drawer-title">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
      </svg>
      <h2>Activity Log</h2>
    </div>
    <button class="log-close-btn" onclick="closeLog()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6 6 18M6 6l12 12"/></svg>
    </button>
  </div>
  <div class="log-body" id="log-body"></div>
  <div class="log-drawer-footer">
    <div class="log-footer-note">All field edits and changes recorded here.</div>
    <button class="log-clear-btn" onclick="clearLog()">Clear Log</button>
  </div>
</div>

<!-- ══ ADD CLIENT MODAL ══ -->
<div class="modal-overlay" id="modal">
  <div class="modal">
    <h2>✦ Add New Client</h2>
    <div class="form-grid">
      <div class="form-group full"><label>Client Name</label><input type="text" id="f-client" placeholder="e.g. Acme Corp" /></div>
      <div class="form-group"><label>Proposal Stage</label>
        <select id="f-stage"><option>Sitemap</option><option>Homepage</option><option>All Pages</option><option>Final Homepage</option></select>
      </div>
      <div class="form-group"><label>Proposal Assigned</label><input type="text" id="f-prop-assign" placeholder="Name..." /></div>
      <div class="form-group"><label>UI/UX Status</label>
        <select id="f-uiux-status"><option>On Hold</option><option>Done</option><option>Revisions</option></select>
      </div>
      <div class="form-group"><label>UI/UX Assigned</label><input type="text" id="f-uiux-assign" placeholder="Name..." /></div>
      <div class="form-group"><label>Dev Assigned</label><input type="text" id="f-dev-assign" placeholder="Name..." /></div>
      <div class="form-group"><label>Front-end Status</label>
        <select id="f-dev-fe"><option value="">—</option><option>Done</option><option>In Progress</option><option>Pending</option></select>
      </div>
      <div class="form-group"><label>Back-end Status</label>
        <select id="f-dev-be"><option value="">—</option><option>Done</option><option>In Progress</option><option>Pending</option></select>
      </div>
      <div class="form-group"><label>Status</label>
        <select id="f-status"><option>Done</option><option>On Hold</option><option>Revisions</option></select>
      </div>
      <div class="form-group"><label>Due Date</label><input type="date" id="f-due" /></div>
      <div class="form-group"><label>Frontend %</label><input type="number" id="f-fe" min="0" max="100" placeholder="0–100" /></div>
      <div class="form-group"><label>Backend %</label><input type="number" id="f-be" min="0" max="100" placeholder="0–100" /></div>
      <div class="form-group full"><label>Proposal Remarks</label><textarea id="f-prop-remark" rows="2" placeholder="Notes about this proposal..."></textarea></div>
      <div class="form-group full"><label>Final Remarks</label><textarea id="f-final-remark" rows="2" placeholder="Closing notes, delivery status..."></textarea></div>
    </div>
    <div class="modal-actions">
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
      <button class="btn-save" onclick="addRow()">Add Client</button>
    </div>
  </div>
</div>

<!-- ══ CONFIRM DELETE MODAL ══ -->
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

<!-- ══ CONFIRM CLEAR LOGS MODAL ══ -->
<div class="confirm-overlay" id="confirm-clear-logs-modal">
  <div class="confirm-box">
    <span class="bin-icon">📋</span>
    <h3>Clear Activity Log?</h3>
    <p>This will permanently delete all activity history.<br>This action cannot be undone.</p>
    <div class="confirm-actions">
      <button class="btn-confirm-cancel" onclick="closeClearLogsConfirm()">Cancel</button>
      <button class="btn-confirm-delete" onclick="confirmClearLogs()">Clear All</button>
    </div>
  </div>
</div>

<!-- ══ CONFIRM EMPTY BIN MODAL ══ -->
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

<!-- ══ CONFIRM PERM DELETE MODAL ══ -->
<div class="confirm-overlay" id="confirm-perm-delete-modal">
  <div class="confirm-box">
    <span class="bin-icon">⚠️</span>
    <h3>Permanently Delete?</h3>
    <p>This record will be gone forever.<br>This action cannot be undone.</p>
    <div class="confirm-actions">
      <button class="btn-confirm-cancel" onclick="closePermDeleteConfirm()">Cancel</button>
      <button class="btn-confirm-delete" onclick="confirmPermDelete()">Delete Forever</button>
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

<script>
/* ════════════════════════════════════════════════
   CONFIG
════════════════════════════════════════════════ */
const STAGES    = ['Sitemap','Homepage','All Pages','Final Homepage'];
const AV_COLORS = ['av1','av2','av3','av4'];
const CSRF      = document.querySelector('meta[name="csrf-token"]').content;
const ROUTES    = {
  store  : "{{ route('operations.store') }}",
  update : (id) => `/operations/${id}`,
  destroy: (id) => `/operations/${id}`,
  restore: (id) => `/operations/${id}/restore`,
  force  : (id) => `/operations/${id}/force`,
  clearLogs: "{{ route('logs.clear') }}",
};

let rows = @json($rows);
let trash = @json($trash);
let activityLog = @json($logs);
let pendingDeleteIdx = null;

// Sort state
let sortKey = null;
let sortDir = 'asc';

/* ════════════════════════════════════════════════
   HELPERS
════════════════════════════════════════════════ */
function escHtml(s){ return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }
function ini(n){ if(!n||n==='—'||n.trim()==='') return '?'; return n.trim().split(/\s+/).map(w=>w[0]).join('').toUpperCase().slice(0,2); }
function avc(s){ if(!s||s==='—') return 'av1'; return AV_COLORS[s.charCodeAt(0)%4]; }
function fmtTime(ts){
  if(!ts) return '—';
  const date = typeof ts === 'number' ? new Date(ts) : new Date(ts);
  const diff=Date.now()-date.getTime(),mins=Math.floor(diff/60000),hrs=Math.floor(diff/3600000),days=Math.floor(diff/84000000);
  if(mins<1) return 'just now'; if(mins<60) return `${mins}m ago`; if(hrs<24) return `${hrs}h ${mins%60}m ago`;
  if(days<7) return `${days}d ago`;
  return date.toLocaleDateString('en-US',{month:'short',day:'numeric'});
}
function fmtDateTime(ts){
  if(!ts) return '';
  const date = typeof ts === 'number' ? new Date(ts) : new Date(ts);
  return date.toLocaleString('en-US',{month:'short',day:'numeric',hour:'numeric',minute:'2-digit'});
}

/* ── Due date notification ── */
function getDueDateNotification(dueDate){
  if(!dueDate) return '';
  const due=new Date(dueDate+'T00:00:00'),today=new Date();
  today.setHours(0,0,0,0);
  const daysLeft=Math.floor((due-today)/(1000*60*60*24));
  const alertIcon=`<svg viewBox="0 0 24 24" fill="currentColor" width="12" height="12"><circle cx="12" cy="12" r="10"/><rect x="11" y="8" width="2" height="5" fill="white"/><rect x="11" y="14" width="2" height="2" fill="white"/></svg>`;
  const warnIcon=`<svg viewBox="0 0 24 24" fill="currentColor" width="12" height="12"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><rect x="11" y="9" width="2" height="5" fill="white"/><rect x="11" y="15" width="2" height="2" fill="white"/></svg>`;
  const checkIcon=`<svg viewBox="0 0 24 24" fill="currentColor" width="12" height="12"><circle cx="12" cy="12" r="10"/><path d="M9 12l2 2 4-4" stroke="white" stroke-width="2" fill="none" stroke-linecap="round"/></svg>`;
  if(daysLeft<0)  return `<div class="due-notification">${alertIcon} Overdue by ${Math.abs(daysLeft)} day${Math.abs(daysLeft)!==1?'s':''}</div>`;
  if(daysLeft===0) return `<div class="due-notification">${alertIcon} Due today!</div>`;
  if(daysLeft===1) return `<div class="due-notification">${alertIcon} Due tomorrow</div>`;
  if(daysLeft<=7)  return `<div class="due-notification warning">${warnIcon} Due in ${daysLeft} days</div>`;
  return `<div class="due-notification safe">${checkIcon} On schedule</div>`;
}

const SVG_CHECK=`<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" width="10" height="10"><polyline points="20 6 9 17 4 12"/></svg>`;
const SVG_ARROW=`<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="10" height="10"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="13 6 19 12 13 18"/></svg>`;
const SVG_CIRC=`<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="8" height="8"><circle cx="12" cy="12" r="4"/></svg>`;

function buildSteps(stage){
  const ci=STAGES.indexOf(stage);
  return STAGES.map((s,i)=>{
    let cls,icon;
    if(i<ci){cls='done';icon=SVG_CHECK;}else if(i===ci){cls='active';icon=SVG_ARROW;}else{cls='pending';icon=SVG_CIRC;}
    return `<div class="step ${cls}"><div class="step-check">${icon}</div><span>${escHtml(s)}</span></div>`;
  }).join('');
}
function statusCls(s){ return {Done:'s-done','On Hold':'s-onhold',Revisions:'s-revision'}[s]||'s-onhold'; }
function uiuxBadgeHtml(s,idx){
  const opts=['Done','On Hold','Revisions'].map(o=>`<div class="status-opt" onclick="setUiuxStatus(${idx},'${o}',event)"><span class="sopt-dot" style="background:${o==='Done'?'var(--done)':o==='On Hold'?'var(--onhold)':'var(--revision)'}"></span>${o}</div>`).join('');
  return `<div class="status-select-wrap"><div class="status-badge ${statusCls(s)}" onclick="toggleUiuxDrop(${idx},event)"><span class="badge-dot"></span>${escHtml(s)}</div><div class="status-dropdown" id="uiux-sdrop-${idx}">${opts}</div></div>`;
}
function toggleUiuxDrop(i,e){e.stopPropagation();document.querySelectorAll('.status-dropdown').forEach(d=>{if(d.id!==`uiux-sdrop-${i}`) d.classList.remove('open');});document.getElementById(`uiux-sdrop-${i}`).classList.toggle('open');}
function setUiuxStatus(i,val,e){
  e.stopPropagation();
  const old = rows[i].uiux_status;
  if (old === val) { document.getElementById('uiux-sdrop-'+i).classList.remove('open'); return; }
  rows[i].uiux_status=val;
  document.getElementById('uiux-sdrop-'+i).classList.remove('open');
  const badge=document.querySelector(`#row-${i} #uiux-sdrop-${i}`).parentNode;
  if(badge) badge.innerHTML=uiuxBadgeHtml(val,i);
  ajaxPatch(i,'uiux_status',val);
  logActivity('status', `UI/UX Status changed for ${rows[i].client}`, `${old} → ${val}`);
  toast(`UI/UX Status → ${val} ✓`);
}

function badgeHtml(s,idx){
  const opts=['Done','On Hold','Revisions'].map(o=>`<div class="status-opt" onclick="setStatus(${idx},'${o}',event)"><span class="sopt-dot" style="background:${o==='Done'?'var(--done)':o==='On Hold'?'var(--onhold)':'var(--revision)'}"></span>${o}</div>`).join('');
  return `<div class="status-select-wrap"><div class="status-badge ${statusCls(s)}" onclick="toggleDrop(${idx},event)"><span class="badge-dot"></span>${escHtml(s)}</div><div class="status-dropdown" id="sdrop-${idx}">${opts}</div></div>`;
}
function dueFmt(d){
  if(!d) return '';
  const dt=new Date(d+'T00:00:00'),over=dt<new Date();
  const str=dt.toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'});
  return `<div class="due-date${over?' due-overdue':''}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>${str}${over?' ⚠':''}</div>`;
}
function finalDateFmt(d){
  if(!d) return '';
  const dt=new Date(d+'T00:00:00');
  return `${String(dt.getDate()).padStart(2,'0')}/${String(dt.getMonth()+1).padStart(2,'0')}/${dt.getFullYear()}`;
}

/* ════════════════════════════════════════════════
   ACTIVITY LOG
════════════════════════════════════════════════ */
const LOG_COLORS = {
  add: 'var(--done)',
  edit: 'var(--accent)',
  status: 'var(--onhold)',
  delete: 'var(--revision)',
  restore: 'var(--done)',
};

function logActivity(type, message, detail=''){
  activityLog.unshift({type, message, detail, ts: Date.now()});
  if(activityLog.length > 200) activityLog.pop();
  updateLogBadge();
}

let logLastSeenCount = activityLog.length;

function updateLogBadge(){
  const badge = document.getElementById('log-badge');
  const unseen = activityLog.length - logLastSeenCount;
  if(unseen > 0){
    badge.textContent = unseen > 99 ? '99+' : unseen;
    badge.classList.remove('hidden');
  } else {
    badge.classList.add('hidden');
  }
}

function openLog(){
  document.getElementById('log-overlay').classList.add('open');
  document.getElementById('log-drawer').classList.add('open');
  logLastSeenCount = activityLog.length;
  updateLogBadge();
  renderLog();
}
function closeLog(){
  document.getElementById('log-overlay').classList.remove('open');
  document.getElementById('log-drawer').classList.remove('open');
}

function renderLog(){
  const body = document.getElementById('log-body');
  if(activityLog.length === 0){
    body.innerHTML = `<div class="log-empty"><div class="log-empty-icon">📋</div><p>No activity yet.<br>Edits and changes will appear here.</p></div>`;
    return;
  }
  body.innerHTML = activityLog.map((e,i) => {
    const color = LOG_COLORS[e.type] || 'var(--muted)';
    const time = e.created_at || e.ts;
    return `<div class="log-entry" style="animation-delay:${i*.03}s">
      <div class="log-dot-col">
        <div class="log-dot" style="background:${color};border-color:${color}"></div>
        <div class="log-line"></div>
      </div>
      <div class="log-content">
        <div class="log-action">${escHtml(e.message)}</div>
        ${e.detail?`<div class="log-detail">${escHtml(e.detail)}</div>`:''}
        <div class="log-time"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>${fmtDateTime(time)}</div>
      </div>
    </div>`;
  }).join('');
}

async function clearLog(){
  if(!activityLog.length) return;
  document.getElementById('confirm-clear-logs-modal').classList.add('open');
}

function closeClearLogsConfirm(){ 
  document.getElementById('confirm-clear-logs-modal').classList.remove('open'); 
}

async function confirmClearLogs(){
  closeClearLogsConfirm();
  const res = await fetch('/activity-logs/clear', {
    method: 'DELETE',
    headers: { 
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
      'Accept': 'application/json' 
    }
  });
  const data = await res.json();
  if(res.ok && data.success){
    activityLog = [];
    updateLogBadge();
    renderLog();
    toast('Activity log cleared');
  } else {
    toast('Failed to clear logs');
    console.error(data);
  }
}

/* ════════════════════════════════════════════════
   SORT
════════════════════════════════════════════════ */
function sortTable(key){
  if(sortKey === key){
    sortDir = sortDir === 'asc' ? 'desc' : 'asc';
  } else {
    sortKey = key;
    sortDir = 'asc';
  }
  document.querySelectorAll('.sort-indicator').forEach(el => {
    el.classList.remove('asc','desc');
  });
  const ind = document.getElementById('sort-'+key);
  if(ind) ind.classList.add(sortDir);

  rows.sort((a,b) => {
    let av = a[key]||'', bv = b[key]||'';
    if(key === 'fe' || key === 'be'){
      av = parseInt(av)||0; bv = parseInt(bv)||0;
      return sortDir==='asc' ? av-bv : bv-av;
    }
    if(key === 'due'){
      av = av ? new Date(av).getTime() : 0;
      bv = bv ? new Date(bv).getTime() : 0;
      return sortDir==='asc' ? av-bv : bv-av;
    }
    const cmp = String(av).localeCompare(String(bv));
    return sortDir==='asc' ? cmp : -cmp;
  });
  renderTable();
  toast(`Sorted by ${key} (${sortDir})`);
}

/* ════════════════════════════════════════════════
   EXPORT
════════════════════════════════════════════════ */
function toggleExportDrop(e){
  e.stopPropagation();
  document.getElementById('export-dropdown').classList.toggle('open');
}

function exportXLSX(){
  document.getElementById('export-dropdown').classList.remove('open');
  showLoading('Generating XLSX…');
  setTimeout(() => {
    const headers = ['Client','Tag','Stage','Proposal Assigned','Proposal Remarks','UI/UX Assigned','UI/UX Status','Dev Assigned','FE Status','BE Status','FE%','BE%','Status','Due Date','Final Remarks'];
    const data = [headers];
    const visible = rows.filter((_,i) => {
      const tr = document.getElementById('row-'+i);
      return !tr || tr.style.display !== 'none';
    });
    visible.forEach(r => {
      data.push([
        r.client||'',
        r.tag||'',
        r.stage||'',
        r.prop_assign||'',
        r.prop_remark||'',
        r.uiux_assign||'',
        r.uiux_status||'',
        r.dev_assign||'',
        r.dev_fe||'',
        r.dev_be||'',
        r.fe||0,
        r.be||0,
        r.status||'',
        r.due||'',
        r.final_remark||''
      ]);
    });

    const wb = XLSX.utils.book_new();
    const ws = XLSX.utils.aoa_to_sheet(data);
    XLSX.utils.book_append_sheet(wb, ws, "Operations");
    XLSX.writeFile(wb, `operations_${new Date().toISOString().split('T')[0]}.xlsx`);

    hideLoading();
    logActivity('edit','Exported XLSX',`${visible.length} records exported`);
    toast('XLSX exported ✓');
  }, 400);
}

async function exportPDF(){
  document.getElementById('export-dropdown').classList.remove('open');
  showLoading('Generating PDF…');

  const { jsPDF } = window.jspdf;
  const doc = new jsPDF({ orientation: 'landscape', unit: 'mm', format: 'a4' });

  const visible = rows.filter((_,i) => {
    const tr = document.getElementById('row-'+i);
    return !tr || tr.style.display !== 'none';
  });

  doc.setFont('helvetica','bold');
  doc.setFontSize(16);
  doc.setTextColor(201, 99, 122);
  doc.text('Operations Monitoring', 14, 16);

  doc.setFont('helvetica','normal');
  doc.setFontSize(8);
  doc.setTextColor(160, 128, 112);
  doc.text(`Exported ${new Date().toLocaleDateString('en-US',{month:'long',day:'numeric',year:'numeric'})} · ${visible.length} record${visible.length!==1?'s':''}`, 14, 22);

  const head = [['Client','Stage','Proposal','UI/UX Assigned','UI/UX Status','Dev Assigned','FE%','BE%','Status','Due Date']];
  const body = visible.map(r => [
    r.client + (r.tag ? `\n${r.tag}` : ''),
    r.stage || '',
    r.prop_assign || '—',
    r.uiux_assign || '—',
    r.uiux_status || '',
    r.dev_assign || '—',
    (r.fe || 0) + '%',
    (r.be || 0) + '%',
    r.status || '',
    r.due || '—'
  ]);

  const statusColor = s => {
    if(s === 'Done')       return [90, 154, 106];
    if(s === 'On Hold')    return [176, 128, 32];
    if(s === 'Revisions')  return [201, 96, 112];
    return [160, 128, 112];
  };

  doc.autoTable({
    head,
    body,
    startY: 27,
    styles: {
      font: 'helvetica',
      fontSize: 7.5,
      cellPadding: 3,
      valign: 'middle',
      overflow: 'linebreak',
    },
    headStyles: {
      fillColor: [242, 230, 213],
      textColor: [122, 92, 80],
      fontStyle: 'bold',
      fontSize: 7,
    },
    columnStyles: {
      0: { cellWidth: 32 },
      1: { cellWidth: 28 },
      2: { cellWidth: 22 },
      3: { cellWidth: 28 },
      4: { cellWidth: 22 },
      5: { cellWidth: 28 },
      6: { cellWidth: 12 },
      7: { cellWidth: 12 },
      8: { cellWidth: 22 },
      9: { cellWidth: 22 },
    },
    alternateRowStyles: { fillColor: [253, 246, 240] },
    didDrawCell(data) {
      if(data.section === 'body' && data.column.index === 8) {
        const val = data.cell.raw;
        const [r,g,b] = statusColor(val);
        const { x, y, width, height } = data.cell;
        doc.setFillColor(r, g, b, 0.12);
        doc.setDrawColor(r, g, b);
        doc.setLineWidth(0.3);
        doc.roundedRect(x+1, y+1.5, width-2, height-3, 2, 2, 'FD');
        doc.setTextColor(r, g, b);
        doc.setFontSize(7);
        doc.setFont('helvetica','bold');
        doc.text(val, x + width/2, y + height/2, { align:'center', baseline:'middle' });
      }
    },
    didParseCell(data) {
      if(data.section === 'body' && data.column.index === 8) {
        data.cell.styles.textColor = [255,255,255];
        data.cell.styles.fillColor = [255,255,255];
      }
    }
  });

  hideLoading();
  logActivity('edit', 'Exported PDF', `${visible.length} records exported`);
  toast('PDF downloaded ✓');
  doc.save(`operations_${new Date().toISOString().split('T')[0]}.pdf`);
}

function showLoading(msg='Loading…'){
  document.getElementById('loading-msg').textContent = msg;
  document.getElementById('loading-overlay').classList.add('open');
}
function hideLoading(){
  document.getElementById('loading-overlay').classList.remove('open');
}

document.addEventListener('click', () => {
  document.getElementById('export-dropdown').classList.remove('open');
});

/* ════════════════════════════════════════════════
   RENDER ROW
════════════════════════════════════════════════ */
function renderRow(r,i,anim=false){
  return `<tr id="row-${i}" data-id="${r.id}"${anim?' class="row-enter"':''}>
    <td class="trash-cell">
      <button class="trash-btn" onclick="askDelete(${i})" title="Move to Recycle Bin">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
          <path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/>
        </svg>
      </button>
    </td>
    <td>
      <div class="client-name editable" contenteditable="true" spellcheck="false" onblur="save(${i},'client',this)">${escHtml(r.client)}</div>
      <div class="client-tag editable" contenteditable="true" spellcheck="false" onblur="save(${i},'tag',this)">${escHtml(r.tag)}</div>
    </td>
    <td class="col-sep">
      <div class="steps">${buildSteps(r.stage)}</div>
      <select class="stage-select" onchange="saveVal(${i},'stage',this.value)">
        ${STAGES.map(s=>`<option${r.stage===s?' selected':''}>${escHtml(s)}</option>`).join('')}
      </select>
    </td>
    <td>
      <div class="assignee"><div class="avatar ${avc(r.prop_assign)}" id="pav-${i}">${ini(r.prop_assign)}</div>
        <span class="assignee-name editable" contenteditable="true" spellcheck="false" onblur="save(${i},'prop_assign',this);rerenderAv('p',${i})" data-placeholder="Name...">${escHtml(r.prop_assign==='—'?'':r.prop_assign)}</span>
      </div>
      <div class="remark-text editable" contenteditable="true" spellcheck="false" data-placeholder="Add remarks..." onblur="save(${i},'prop_remark',this)">${escHtml(r.prop_remark)}</div>
    </td>
    <td class="col-sep">
      <div class="assignee"><div class="avatar ${avc(r.uiux_assign)}" id="uav-${i}">${ini(r.uiux_assign)}</div>
        <span class="assignee-name editable" contenteditable="true" spellcheck="false" onblur="save(${i},'uiux_assign',this);rerenderAv('u',${i})" data-placeholder="Name...">${escHtml(r.uiux_assign==='—'?'':r.uiux_assign)}</span>
      </div>
    </td>
    <td>${uiuxBadgeHtml(r.uiux_status, i)}</td>
    <td class="col-sep">
      <div class="assignee"><div class="avatar ${avc(r.dev_assign)}" id="dav-${i}">${ini(r.dev_assign)}</div>
        <span class="assignee-name editable" contenteditable="true" spellcheck="false" onblur="save(${i},'dev_assign',this);rerenderAv('d',${i})" data-placeholder="Name...">${escHtml(r.dev_assign==='—'?'':r.dev_assign)}</span>
      </div>
    </td>
    <td>
      <div class="dev-pill-group"><div class="dev-group-label">Front-end</div>
        <select class="dev-select-minimal" onchange="saveVal(${i},'dev_fe',this.value)">
          <option value=""${!r.dev_fe?' selected':''}>—</option>
          <option value="Done"${r.dev_fe==='Done'?' selected':''}>Done</option>
          <option value="In Progress"${r.dev_fe==='In Progress'?' selected':''}>In Progress</option>
          <option value="Pending"${r.dev_fe==='Pending'?' selected':''}>Pending</option>
        </select>
      </div>
      <div class="dev-pill-group" style="margin-top:8px;"><div class="dev-group-label">Back-end</div>
        <select class="dev-select-minimal" onchange="saveVal(${i},'dev_be',this.value)">
          <option value=""${!r.dev_be?' selected':''}>—</option>
          <option value="Done"${r.dev_be==='Done'?' selected':''}>Done</option>
          <option value="In Progress"${r.dev_be==='In Progress'?' selected':''}>In Progress</option>
          <option value="Pending"${r.dev_be==='Pending'?' selected':''}>Pending</option>
        </select>
      </div>
    </td>
    <td>
      <div class="progress-wrap">
        <div class="progress-row">
          <div class="progress-label-row"><span>FE</span><span class="editable pct-label" contenteditable="true" spellcheck="false" id="fe-lbl-${i}" onblur="savePct(${i},'fe',this)" oninput="if(parseInt(this.innerText)>100)this.innerText='100%'">${r.fe}%</span></div>
          <div class="progress-bar"><div class="progress-fill pf-fe" id="pfe-${i}" style="width:${r.fe}%;transition:none;"></div></div>
        </div>
        <div class="progress-row">
          <div class="progress-label-row"><span>BE</span><span class="editable pct-label" contenteditable="true" spellcheck="false" id="be-lbl-${i}" onblur="savePct(${i},'be',this)" oninput="if(parseInt(this.innerText)>100)this.innerText='100%'">${r.be}%</span></div>
          <div class="progress-bar"><div class="progress-fill pf-be" id="pbe-${i}" style="width:${r.be}%;transition:none;"></div></div>
        </div>
      </div>
    </td>
    <td>${badgeHtml(r.status,i)}</td>
    <td class="col-sep">
  <div class="final-header-row">
    <span class="final-tag">Final</span>
    <span class="final-date-str" id="fdate-str-${i}">${finalDateFmt(r.due)}</span>
    <span style="position:relative;display:inline-flex;align-items:center;">
      <button class="cal-icon-btn" onclick="triggerDueById(${i})" title="Pick date">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
      </button>
      <input class="due-input" type="date" id="due-input-${i}" value="${r.due||''}" onchange="saveVal(${i},'due',this.value);rerenderDue(${i},this.value)" />
    </span>
  </div>
  <div id="due-notif-${i}">${getDueDateNotification(r.due)}</div>
  <div class="final-text editable" contenteditable="true" spellcheck="false" data-placeholder="Add final remarks..." onblur="save(${i},'final_remark',this)">${escHtml(r.final_remark)}</div>
</td>
</tr>`;
}

/* ════════════════════════════════════════════════
   RENDER TABLE
════════════════════════════════════════════════ */
function renderTable(){
  const tbody=document.getElementById('table-body');
  if(rows.length===0){
    tbody.innerHTML=`<tr><td colspan="11" class="no-results-cell"><span>📋</span>No clients yet. Click "Add Client" to get started.</td></tr>`;
  } else {
    tbody.innerHTML=rows.map((r,i)=>renderRow(r,i)).join('');
  }
  setTimeout(()=>{rows.forEach((_,i)=>{const fe=document.getElementById('pfe-'+i),be=document.getElementById('pbe-'+i);if(fe) fe.style.transition='width .8s cubic-bezier(.34,1.56,.64,1)';if(be) be.style.transition='width .8s cubic-bezier(.34,1.56,.64,1)';});},20);
  updateCounts();
  applyFilters();
}

function updateCounts(){
  document.getElementById('cnt-done').textContent=rows.filter(r=>r.status==='Done').length;
  document.getElementById('cnt-hold').textContent=rows.filter(r=>r.status==='On Hold').length;
  document.getElementById('cnt-rev').textContent=rows.filter(r=>r.status==='Revisions').length;
  updateBinBadge();
}

/* ════════════════════════════════════════════════
   SEARCH & FILTER
════════════════════════════════════════════════ */
const activeFilters={uiux_status:null,dev_status:null,stage:null};
function toggleFilter(type,val){
  activeFilters[type]=activeFilters[type]===val?null:val;
  const pillMap={'Homepage':'fpill-hp','Sitemap':'fpill-sm','All Pages':'fpill-ap','Final Homepage':'fpill-fh'};
  const uiuxPillMap={'Done':'fpill-uiux-done','On Hold':'fpill-uiux-hold','Revisions':'fpill-uiux-rev'};
  const devPillMap={'Done':'fpill-dev-done','On Hold':'fpill-dev-hold','Revisions':'fpill-dev-rev'};
  
  let idsToClear = [];
  if(type==='uiux_status') idsToClear = ['fpill-uiux-done','fpill-uiux-hold','fpill-uiux-rev'];
  else if(type==='dev_status') idsToClear = ['fpill-dev-done','fpill-dev-hold','fpill-dev-rev'];
  else idsToClear = ['fpill-hp','fpill-sm','fpill-ap','fpill-fh'];
  
  idsToClear.forEach(id=>document.getElementById(id)?.classList.remove('active'));
  
  if(activeFilters[type]) {
    let targetId = type==='uiux_status' ? uiuxPillMap[val] : (type==='dev_status' ? devPillMap[val] : pillMap[val]);
    document.getElementById(targetId)?.classList.add('active');
  }
  applyFilters();
}
function applyFilters(){
  const query=(document.getElementById('search-input')?.value||'').trim().toLowerCase();
  const uiux=activeFilters.uiux_status,dev=activeFilters.dev_status,stage=activeFilters.stage;
  const hasAny=query||uiux||dev||stage;
  document.getElementById('filter-clear')?.classList.toggle('visible',!!hasAny);
  let visibleCount=0;
  rows.forEach((r,i)=>{
    const tr=document.getElementById('row-'+i);if(!tr) return;
    const matchQuery = !query||r.client.toLowerCase().includes(query)||(r.tag||'').toLowerCase().includes(query);
    const matchUiux = !uiux||r.uiux_status===uiux;
    const matchDev = !dev||r.dev_fe===dev||r.dev_be===dev||r.status===dev;
    const matchStage = !stage||r.stage===stage;
    
    const show = matchQuery && matchUiux && matchDev && matchStage;
    tr.style.display=show?'':'none';if(show) visibleCount++;
  });
  const tbody=document.getElementById('table-body');
  let noRow=document.getElementById('no-results-row');
  if(visibleCount===0&&rows.length>0){
    if(!noRow){const tr=document.createElement('tr');tr.id='no-results-row';tr.innerHTML=`<td colspan="11" class="no-results-cell"><span>🔍</span>No clients match your search or filters.</td>`;tbody.appendChild(tr);}
  } else { noRow?.remove(); }
  const footerEl=document.getElementById('footer-count');
  if(footerEl) footerEl.textContent=hasAny?`${visibleCount} of ${rows.length} client${rows.length!==1?'s':''} shown`:`${rows.length} client${rows.length!==1?'s':''} tracked`;
}
function clearFilters(){
  document.getElementById('search-input').value='';
  activeFilters.uiux_status=null;activeFilters.dev_status=null;activeFilters.stage=null;
  ['fpill-uiux-done','fpill-uiux-hold','fpill-uiux-rev','fpill-dev-done','fpill-dev-hold','fpill-dev-rev','fpill-hp','fpill-sm','fpill-ap','fpill-fh'].forEach(id=>document.getElementById(id)?.classList.remove('active'));
  applyFilters();
}

/* ════════════════════════════════════════════════
   AJAX PATCH
════════════════════════════════════════════════ */
async function ajaxPatch(idx,field,value){
  const id=rows[idx].id;
  try{
    const res=await fetch(ROUTES.update(id),{method:'PATCH',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'},body:JSON.stringify({field,value,edited_by:'User'})});
    const data=await res.json();
    if(data.success){
      rows[idx].last_edited_by=data.last_edited_by;rows[idx].last_edited_field=data.last_edited_field;rows[idx].updated_at=data.updated_at;
    }
  }catch(e){console.error('Patch failed',e);}
}

function save(i,key,el){
  const val=el.innerText.trim();
  if(rows[i][key]===val) return;
  const oldVal = rows[i][key];
  rows[i][key]=val;
  ajaxPatch(i,key,val);
  logActivity('edit', `Edited ${key.replace(/_/g,' ')} for ${rows[i].client}`, `"${oldVal}" → "${val}"`);
  toast('Saved ✓');
  updateCounts();
}
function saveVal(i,key,val){
  const oldVal = rows[i][key];
  rows[i][key]=val;
  ajaxPatch(i,key,val);
  if(key==='stage'){const tr=document.getElementById('row-'+i);if(tr) tr.querySelector('.steps').innerHTML=buildSteps(val);}
  logActivity('edit', `Changed ${key.replace(/_/g,' ')} for ${rows[i].client}`, `→ "${val}"`);
  toast('Saved ✓');
  updateCounts();
}
function savePct(i,key,el){
  const v=Math.min(100,Math.max(0,parseInt(el.innerText.replace('%',''))||0));
  if(rows[i][key]===v) return;
  rows[i][key]=v;el.innerText=v+'%';
  const bar=document.getElementById('p'+key+'-'+i);
  if(bar){bar.style.transition='width .6s cubic-bezier(.34,1.56,.64,1)';bar.style.width=v+'%';}
  ajaxPatch(i,key,v);
  const label = key === 'fe' ? 'Front-end' : 'Back-end';
  logActivity('edit', `Updated ${label} progress for ${rows[i].client}`, `${v}%`);
  toast('Saved ✓');
}
function rerenderAv(which,i){
  const key=which==='d'?'dev_assign':(which==='u'?'uiux_assign':'prop_assign'),id=which==='d'?'dav-'+i:(which==='u'?'uav-'+i:'pav-'+i);
  const av=document.getElementById(id);if(av){av.className='avatar '+avc(rows[i][key]);av.textContent=ini(rows[i][key]);}
}
function rerenderDue(i,val){
  rows[i].due=val;
  const notif=document.getElementById('due-notif-'+i),dstr=document.getElementById('fdate-str-'+i);
  if(notif) notif.innerHTML=getDueDateNotification(val);
  if(dstr) dstr.textContent=finalDateFmt(val);
  logActivity('edit', `Set due date for ${rows[i].client}`, val||'(cleared)');
  toast('Due date updated ✓');
}
function triggerDueById(i){const inp=document.getElementById('due-input-'+i);if(inp){inp.showPicker?.()||inp.click();}}

/* ════════════════════════════════════════════════
   STATUS DROPDOWN
════════════════════════════════════════════════ */
function toggleDrop(i,e){e.stopPropagation();document.querySelectorAll('.status-dropdown').forEach(d=>{if(d.id!=='sdrop-'+i) d.classList.remove('open');});document.getElementById('sdrop-'+i).classList.toggle('open');}
function setStatus(i,val,e){
  e.stopPropagation();
  const old = rows[i].status;
  if (old === val) { document.getElementById('sdrop-'+i).classList.remove('open'); return; }
  rows[i].status=val;
  document.getElementById('sdrop-'+i).classList.remove('open');
  const badge=document.querySelector(`#row-${i} #sdrop-${i}`).parentNode;
  if(badge) badge.innerHTML=badgeHtml(val,i);
  ajaxPatch(i,'status',val);
  logActivity('status', `Status changed for ${rows[i].client}`, `${old} → ${val}`);
  updateCounts();
  toast(`Status → ${val} ✓`);
}
document.addEventListener('click',()=>document.querySelectorAll('.status-dropdown').forEach(d=>d.classList.remove('open')));

/* ════════════════════════════════════════════════
   DELETE → RECYCLE BIN
════════════════════════════════════════════════ */
function askDelete(i){pendingDeleteIdx=i;document.getElementById('confirm-name').textContent=rows[i].client;document.getElementById('confirm-modal').classList.add('open');}
function closeConfirm(){pendingDeleteIdx=null;document.getElementById('confirm-modal').classList.remove('open');}
function confirmDelete(){
  if(pendingDeleteIdx===null) return;
  const i=pendingDeleteIdx;closeConfirm();
  const op = rows[i];
  const clientName = op.client;
  const tr=document.getElementById('row-'+i);
  if(tr) tr.style.animation='rowOut .3s ease forwards';
  setTimeout(async()=>{
    const res = await fetch(ROUTES.destroy(op.id),{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}});
    if(res.ok){
      const deleted=Object.assign({},op,{deleted_at:new Date().toISOString()});
      trash.unshift(deleted);
      rows.splice(i,1);
      renderTable();
      updateBinBadge();
      activityLog.unshift({type:'delete', message: `${clientName} moved to Recycle Bin`, ts: Date.now()});
      updateLogBadge();
      toast('Moved to Recycle Bin 🗑');
    }
  },290);
}
document.getElementById('confirm-modal').addEventListener('click',e=>{if(e.target===e.currentTarget) closeConfirm();});
document.getElementById('confirm-clear-logs-modal').addEventListener('click',e=>{if(e.target===e.currentTarget) closeClearLogsConfirm();});
document.getElementById('confirm-empty-bin-modal').addEventListener('click', e => {
    if (e.target === e.currentTarget) closeEmptyBinConfirm();
});
document.getElementById('confirm-perm-delete-modal').addEventListener('click', e => {
  if(e.target === e.currentTarget) closePermDeleteConfirm();
});

/* ════════════════════════════════════════════════
   RECYCLE BIN
════════════════════════════════════════════════ */
let binLastSeenCount = parseInt(localStorage.getItem('binLastSeenCount') || '0');
let pendingPermDeleteIdx = null;

function updateBinBadge(){
  const badge=document.getElementById('bin-badge');
  const count = trash.length;
  if(count < binLastSeenCount){
    binLastSeenCount = count;
    localStorage.setItem('binLastSeenCount', binLastSeenCount);
  }
  if(count > binLastSeenCount){
    badge.textContent = count - binLastSeenCount;
    badge.classList.remove('hidden');
  } else {
    badge.classList.add('hidden');
  }
  document.getElementById('bin-count-pill').textContent=`${count} item${count!==1?'s':''}`;
}
function openBin(){
  document.getElementById('bin-overlay').classList.add('open');
  document.getElementById('bin-drawer').classList.add('open');
  binLastSeenCount = trash.length;
  localStorage.setItem('binLastSeenCount', binLastSeenCount);
  updateBinBadge();
  renderBin();
}
function closeBin(){document.getElementById('bin-overlay').classList.remove('open');document.getElementById('bin-drawer').classList.remove('open');}

function renderBin(){
  const body=document.getElementById('bin-body');
  if(trash.length===0){body.innerHTML=`<div class="bin-empty"><div class="bin-empty-icon">🪣</div><p>Recycle Bin is empty.<br>Deleted records will appear here.</p></div>`;return;}
  body.innerHTML=trash.map((r,ti)=>{
    const sc=r.status==='Done'?'var(--done)':r.status==='On Hold'?'var(--onhold)':'var(--revision)';
    const dueStr=r.due?new Date(r.due+'T00:00:00').toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'}):null;
    return `<div class="bin-card" id="bin-card-${ti}">
      <div class="bin-card-top"><div class="bin-card-info">
        <div class="bin-card-name">${escHtml(r.client)}</div>
        <div class="bin-card-tag">${escHtml(r.tag||'')}</div>
        <div class="bin-card-meta">
          <span class="bin-meta-pill">📋 ${escHtml(r.stage)}</span>
          <span class="bin-meta-pill" style="color:${sc};border-color:${sc}30">● ${r.status}</span>
          ${r.uiux_assign&&r.uiux_assign!=='—'?`<span class="bin-meta-pill">🎨 UI/UX: ${escHtml(r.uiux_assign)} (${r.uiux_status})</span>`:''}
          ${r.dev_assign&&r.dev_assign!=='—'?`<span class="bin-meta-pill">👤 Dev: ${escHtml(r.dev_assign)}</span>`:''}
          ${dueStr?`<span class="bin-meta-pill">📅 ${dueStr}</span>`:''}
        </div>
        <div class="bin-deleted-at"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>Deleted ${fmtTime(r.deleted_at)}</div>
      </div></div>
      ${r.prop_remark?`<div style="font-size:.72rem;color:var(--muted);padding:6px 10px;background:rgba(201,99,122,.04);border-left:3px solid var(--border);border-radius:4px;line-height:1.4;margin-bottom:6px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:100%;" title="${escHtml(r.prop_remark)}">${escHtml(r.prop_remark)}</div>`:''}
      <div class="bin-card-actions">
        <button class="restore-btn" onclick="restoreRow(${ti})"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>Restore</button>
        <button class="perm-delete-btn" onclick="deletePermanently(${ti})"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 6h18M8 6V4h8v2M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>Delete</button>
      </div>
    </div>`;
  }).join('');
}

function restoreRow(ti){
  const card=document.getElementById('bin-card-'+ti);
  if(card) card.style.animation='cardIn .3s ease reverse forwards';
  setTimeout(async()=>{
    const r=trash[ti];
    const res=await fetch(ROUTES.restore(r.id),{method:'POST',headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}});
    const data=await res.json();
    if(data.success){
      trash.splice(ti,1);
      const rv=data.row;
      rows.push({id:rv.id,client:rv.client,tag:rv.tag,stage:rv.stage,prop_assign:rv.prop_assign,prop_remark:rv.prop_remark||'',uiux_assign:rv.uiux_assign||'—',uiux_status:rv.uiux_status||'On Hold',dev_assign:rv.dev_assign,dev_fe:rv.dev_fe,dev_be:rv.dev_be,fe:rv.fe,be:rv.be,status:rv.status,due:rv.due?rv.due.replace(' 00:00:00',''):'',final_remark:rv.final_remark||'',last_edited_by:'',last_edited_field:'',updated_at:'just now'});
      renderTable();renderBin();updateBinBadge();
      activityLog.unshift({type:'restore', message: `${rv.client} restored from Bin`, ts: Date.now()});
      updateLogBadge();
      setTimeout(()=>{const last=document.getElementById('row-'+(rows.length-1));if(last){last.classList.add('row-pulse');setTimeout(()=>last.classList.remove('row-pulse'),950);}},100);
      toast(`✅ ${rv.client} restored!`);
    }
  },250);
}

function deletePermanently(ti){
  pendingPermDeleteIdx = ti;
  document.getElementById('confirm-perm-delete-modal').classList.add('open');
}

function closePermDeleteConfirm(){
  pendingPermDeleteIdx = null;
  document.getElementById('confirm-perm-delete-modal').classList.remove('open');
}

async function confirmPermDelete(){
  if(pendingPermDeleteIdx === null) return;
  const ti = pendingPermDeleteIdx;
  closePermDeleteConfirm();

  const card = document.getElementById('bin-card-'+ti);
  if(card){
    card.style.transition = 'opacity .3s ease, transform .3s ease';
    card.style.opacity = '0';
    card.style.transform = 'translateX(20px)';
  }

  setTimeout(async() => {
    const r = trash[ti];
    const res = await fetch(ROUTES.force(r.id), {method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}});
    if(res.ok){
      trash.splice(ti,1);
      renderBin();
      updateBinBadge();
      activityLog.unshift({type:'delete', message:`Permanently deleted ${r.client}`, ts: Date.now()});
      updateLogBadge();
      toast(`${r.client} permanently deleted`);
    }
  }, 280);
}

function emptyBin() {
    if (trash.length === 0) return;
    document.getElementById('confirm-empty-bin-modal').classList.add('open');
}

function closeEmptyBinConfirm() {
    document.getElementById('confirm-empty-bin-modal').classList.remove('open');
}

async function confirmEmptyBin() {
    closeEmptyBinConfirm();
    try {
        const res = await fetch('/operations/trash/empty', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        });
        if (res.ok) {
            const cards = document.querySelectorAll('.bin-card');
            cards.forEach((card, i) => {
                setTimeout(() => {
                    card.style.transition = 'opacity .3s ease, transform .3s ease';
                    card.style.opacity = '0';
                    card.style.transform = 'translateX(20px)';
                }, i * 60);
            });
            setTimeout(() => {
                trash = [];
                updateBinBadge();
                renderBin();
                activityLog.unshift({type:'delete', message:'Recycle Bin emptied', ts: Date.now()});
                updateLogBadge();
                toast('Recycle Bin cleared');
            }, cards.length * 60 + 320);
        } else {
            toast('Failed to empty Recycle Bin.');
        }
    } catch (err) {
        console.error('Error:', err);
        toast('Connection error.');
    }
}

/* ════════════════════════════════════════════════
   ADD MODAL & ADD ROW LOGIC
════════════════════════════════════════════════ */
function openModal() {
    document.getElementById('modal').classList.add('open');
}

function closeModal() {
    document.getElementById('modal').classList.remove('open');
}

async function addRow() {
    const clientEl = document.getElementById('f-client');
    const client = clientEl.value.trim();

    if (!client) {
        clientEl.style.borderColor = 'var(--revision)';
        clientEl.focus();
        return;
    }
    clientEl.style.borderColor = '';

    const payload = {
        client: client,
        stage: document.getElementById('f-stage').value,
        prop_assign: document.getElementById('f-prop-assign').value.trim() || '—',
        prop_remark: document.getElementById('f-prop-remark').value.trim() || '',
        uiux_status: document.getElementById('f-uiux-status').value,
        uiux_assign: document.getElementById('f-uiux-assign').value.trim() || '—',
        fe: parseInt(document.getElementById('f-fe').value) || 0,
        be: parseInt(document.getElementById('f-be').value) || 0,
        dev_assign: document.getElementById('f-dev-assign').value.trim() || '—',
        dev_fe: document.getElementById('f-dev-fe').value || '',
        dev_be: document.getElementById('f-dev-be').value || '',
        status: document.getElementById('f-status').value,
        due: document.getElementById('f-due').value || null,
        final_remark: document.getElementById('f-final-remark').value.trim() || '',
        edited_by: 'User'
    };

    try {
        const res = await fetch('/operations', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        const data = await res.json();

        if (res.ok && data.success) {
            const r = data.row;

            rows.push({
                id: r.id,
                client: r.client,
                tag: r.tag,
                stage: r.stage,
                prop_assign: r.prop_assign,
                prop_remark: r.prop_remark || '',
                uiux_status: r.uiux_status,
                uiux_assign: r.uiux_assign,
                dev_assign: r.dev_assign,
                dev_fe: r.dev_fe,
                dev_be: r.dev_be,
                fe: r.fe,
                be: r.be,
                status: r.status,
                due: r.due ? r.due.replace(' 00:00:00', '') : '',
                final_remark: r.final_remark || '',
                last_edited_by: '',
                last_edited_field: '',
                updated_at: 'just now'
            });

            closeModal();
            ['f-client', 'f-prop-assign', 'f-uiux-assign', 'f-dev-assign', 'f-fe', 'f-be', 'f-due', 'f-prop-remark', 'f-final-remark'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.value = '';
            });

            renderTable();
            
            setTimeout(() => {
                const last = document.getElementById('row-' + (rows.length - 1));
                if (last) {
                    last.classList.add('row-pulse');
                    setTimeout(() => last.classList.remove('row-pulse'), 950);
                }
            }, 120);

            if (typeof activityLog !== 'undefined') {
                activityLog.unshift({
                    type: 'add',
                    message: `Added new client: ${r.client}`,
                    detail: `Stage: ${r.stage} · Status: ${r.status}`,
                    ts: Date.now()
                });
                updateLogBadge();
            }
            
            toast('Client added ✓');

        } else {
            toast('Error saving — check console');
            console.error('Server returned error:', data);
            if (data.errors) {
                alert("Validation Error: " + Object.values(data.errors).flat().join('\n'));
            }
        }
    } catch (err) {
        console.error('Fetch error:', err);
        toast('Connection failed');
        alert('Network Error: Could not reach the server. Check your Render logs.');
    }
}

document.getElementById('modal').addEventListener('click', e => {
    if (e.target === e.currentTarget) closeModal();
});

/* ════════════════════════════════════════════════
   THEME
════════════════════════════════════════════════ */
function toggleTheme(){
  const html=document.documentElement,dark=html.getAttribute('data-theme')==='dark';
  html.setAttribute('data-theme',dark?'light':'dark');
  const sunEl=document.getElementById('theme-icon-sun'),moonEl=document.getElementById('theme-icon-moon'),labelEl=document.getElementById('theme-label');
  if(dark){sunEl.style.display='';moonEl.style.display='none';labelEl.textContent='Dark';toast('☀️ Light mode');}
  else{sunEl.style.display='none';moonEl.style.display='';labelEl.textContent='Light';toast('🌙 Dark mode');}
}

/* ════════════════════════════════════════════════
   TOAST
════════════════════════════════════════════════ */
let toastTimer;
function toast(msg){document.querySelector('.toast')?.remove();clearTimeout(toastTimer);const el=Object.assign(document.createElement('div'),{className:'toast',textContent:msg});document.body.appendChild(el);toastTimer=setTimeout(()=>el.remove(),2400);}

/* ════════════════════════════════════════════════
   INIT
════════════════════════════════════════════════ */
renderTable();
</script>
<script src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
</body>
</html>