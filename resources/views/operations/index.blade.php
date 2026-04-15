<!DOCTYPE html>
<html lang="en" data-theme="light" id="html-root">

<head>
  <script>
    (function () {
      const saved = localStorage.getItem('theme');
      if (saved) document.documentElement.setAttribute('data-theme', saved);
    })();
  </script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Operations Monitoring</title>
  <link rel="icon" type="image/png" href="{{ asset('rweblogo.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('rweblogo.png') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">
  <style>
    /* ══════════════════════════════════════════════
   THEME VARIABLES
══════════════════════════════════════════════ */
    [data-theme="light"] {
      --bg: #fdf6f0;
      --surface: #fff8f5;
      --surface2: #F2E6D5;
      --surface3: #faeade;
      --border: #e8d5c4;
      --accent: #c9637a;
      --accent2: #e8a0b0;
      --accent3: #b07060;
      --done: #5a9a6a;
      --onhold: #b08020;
      --revision: #c96070;
      --text: #3d2b22;
      --muted: #a08070;
      --muted2: #7a5c50;
      --pink: #FFC2CD;
      --cream: #F2E6D5;
      --shadow: rgba(201, 99, 122, .14);
      --glass: rgba(255, 248, 245, .92);
    }

    [data-theme="dark"] {
      --bg: #1a1014;
      --surface: #231519;
      --surface2: #2d1c20;
      --surface3: #38222a;
      --border: #4a2e36;
      --accent: #ff8fa3;
      --accent2: #ffb3c1;
      --accent3: #d4907a;
      --done: #6dbf7e;
      --onhold: #d4a840;
      --revision: #ff7080;
      --text: #f5e8e4;
      --muted: #a07888;
      --muted2: #c8a8b0;
      --pink: #ff8fa3;
      --cream: #d4907a;
      --shadow: rgba(0, 0, 0, .55);
      --glass: rgba(35, 21, 25, .94);
    }

    /* ══════════════════════════════════════════════
   RESET & BASE
══════════════════════════════════════════════ */
    *,
    *::before,
    *::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      overflow-x: hidden;
      transition: background .4s ease, color .4s ease;
      font-size: 13px;
      /* add this */
      zoom: 0.9;
      /* add this */
    }

    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image: radial-gradient(circle, rgba(201, 99, 122, .09) 1px, transparent 1px);
      background-size: 28px 28px;
      pointer-events: none;
      z-index: 0;
      animation: dotDrift 20s ease-in-out infinite alternate;
    }

    [data-theme="dark"] body::before {
      background-image: radial-gradient(circle, rgba(255, 143, 163, .07) 1px, transparent 1px);
    }

    body::after {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: linear-gradient(90deg, #FFC2CD, #e8a0b0, #F2E6D5, #c9637a, #b07060, #FFC2CD);
      background-size: 300% 100%;
      animation: topbar 5s linear infinite;
      z-index: 100;
    }

    /* ══════════════════════════════════════════════
   KEYFRAMES
══════════════════════════════════════════════ */
    @keyframes topbar {
      to {
        background-position: 300% 0;
      }
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-14px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(18px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes popIn {
      from {
        opacity: 0;
        transform: scale(.93);
      }

      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    @keyframes rowIn {
      from {
        opacity: 0;
        transform: translateX(-10px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes rowOut {
      to {
        opacity: 0;
        transform: translateX(18px);
        max-height: 0;
        padding: 0;
      }
    }

    @keyframes rowPulse {
      0% {
        box-shadow: inset 0 0 0 2px rgba(201, 99, 122, .7);
      }

      100% {
        box-shadow: inset 0 0 0 2px transparent;
      }
    }

    @keyframes blink {

      0%,
      100% {
        opacity: 1
      }

      50% {
        opacity: .2
      }
    }

    @keyframes dropIn {
      from {
        opacity: 0;
        transform: translateY(-5px) scale(.97);
      }

      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    @keyframes modalIn {
      from {
        opacity: 0;
        transform: translateY(20px) scale(.97);
      }

      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    @keyframes toastIn {
      from {
        opacity: 0;
        transform: translateY(10px) scale(.96);
      }

      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    @keyframes floatBin {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-10px);
      }
    }

    @keyframes cardIn {
      from {
        opacity: 0;
        transform: translateX(20px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes wobble {

      0%,
      100% {
        transform: rotate(0);
      }

      25% {
        transform: rotate(-12deg);
      }

      75% {
        transform: rotate(12deg);
      }
    }

    @keyframes badgePop {
      from {
        transform: scale(0);
      }

      to {
        transform: scale(1);
      }
    }

    @keyframes logSlide {
      from {
        opacity: 0;
        transform: translateX(30px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }

    @keyframes shimmer {
      0% {
        background-position: -200% 0;
      }

      100% {
        background-position: 200% 0;
      }
    }

    @keyframes dotDrift {
      0% {
        background-position: 0 0;
      }

      100% {
        background-position: 28px 28px;
      }
    }

    @keyframes floatOrb {

      0%,
      100% {
        transform: translate(0, 0) scale(1);
        opacity: .4;
      }

      33% {
        transform: translate(30px, -20px) scale(1.1);
        opacity: .55;
      }

      66% {
        transform: translate(-20px, 15px) scale(.95);
        opacity: .35;
      }
    }

    @keyframes floatOrb2 {

      0%,
      100% {
        transform: translate(0, 0) scale(1);
        opacity: .3;
      }

      33% {
        transform: translate(-40px, 20px) scale(1.08);
        opacity: .45;
      }

      66% {
        transform: translate(25px, -30px) scale(.92);
        opacity: .25;
      }
    }

    @keyframes floatOrb3 {

      0%,
      100% {
        transform: translate(0, 0) scale(1);
        opacity: .25;
      }

      50% {
        transform: translate(20px, 25px) scale(1.05);
        opacity: .4;
      }
    }

    .bg-orb {
      position: fixed;
      border-radius: 50%;
      pointer-events: none;
      z-index: 0;
      filter: blur(80px);
    }

    .bg-orb-1 {
      width: 600px;
      height: 600px;
      background: radial-gradient(circle, rgba(201, 99, 122, .28), transparent 70%);
      top: -150px;
      right: -100px;
      animation: floatOrb 18s ease-in-out infinite;
    }

    .bg-orb-2 {
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, rgba(176, 112, 96, .22), transparent 70%);
      bottom: -100px;
      left: -100px;
      animation: floatOrb2 22s ease-in-out infinite;
    }

    .bg-orb-3 {
      width: 350px;
      height: 350px;
      background: radial-gradient(circle, rgba(255, 194, 205, .25), transparent 70%);
      top: 35%;
      left: 35%;
      animation: floatOrb3 15s ease-in-out infinite;
    }

    [data-theme="dark"] .bg-orb-1 {
      background: radial-gradient(circle, rgba(255, 143, 163, .22), transparent 70%);
    }

    [data-theme="dark"] .bg-orb-2 {
      background: radial-gradient(circle, rgba(212, 144, 122, .18), transparent 70%);
    }

    [data-theme="dark"] .bg-orb-3 {
      background: radial-gradient(circle, rgba(255, 143, 163, .14), transparent 70%);
    }

    /* ══════════════════════════════════════════════
   LAYOUT
══════════════════════════════════════════════ */
    .wrapper {
      position: relative;
      z-index: 1;
      padding: 48px 56px 60px;
      /* reduced from 70px 72px 80px */
      width: 100%;
      max-width: 1700px;
      /* slightly wider to compensate */
      margin: 0 auto;
      box-sizing: border-box;
    }

    /* ══════════════════════════════════════════════
   HEADER
    ══════════════════════════════════════════════ */
    .header {
      display: grid;
      grid-template-columns: auto 1fr auto;
      align-items: center;
      margin-bottom: 28px;
      padding-bottom: 20px;
      border-bottom: 1px solid var(--border);
      animation: slideDown .5s ease both;
      gap: 12px;
      position: relative;
      z-index: 1001;
    }

    .header-center {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .header-left h1 {
      font-size: 2.2rem;
      /* reduced from 2.8rem */
      font-weight: 800;
      letter-spacing: -.5px;
      background: linear-gradient(135deg, var(--accent), var(--accent3));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .header-left p {
      font-size: .72rem;
      color: var(--muted);
      margin-top: 10px;
      letter-spacing: .1em;
      text-transform: uppercase;
    }

    .header-right {
      display: flex;
      gap: 10px;
      align-items: center;
      flex-wrap: wrap;
      justify-content: flex-end;
      /* add this */
    }

    .stat-pill {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 8px 18px;
      border-radius: 999px;
      border: 1px solid var(--border);
      background: var(--surface);
      font-size: .69rem;
      color: var(--muted2);
      transition: background .4s, border-color .4s;
      animation: popIn .5s ease both;
      cursor: default;
    }

    .stat-pill .dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
    }

    .stat-pill strong {
      font-weight: 700;
      color: var(--text);
    }

    /* Recycle Bin btn */
    .recycle-btn {
      position: relative;
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 7px 12px;
      border-radius: 12px;
      border: 1.5px solid var(--border);
      background: var(--surface2);
      cursor: pointer;
      font-family: 'Poppins', sans-serif;
      font-size: .68rem;
      color: var(--muted2);
      transition: all .3s;
      animation: popIn .5s ease .05s both;
    }

    .recycle-btn:hover {
      border-color: var(--done);
      color: var(--done);
      transform: scale(1.05);
      box-shadow: 0 4px 15px var(--shadow);
    }

    .recycle-btn svg {
      width: 15px;
      height: 15px;
    }

    .recycle-badge {
      position: absolute;
      top: -7px;
      right: -7px;
      min-width: 18px;
      height: 18px;
      border-radius: 999px;
      background: var(--revision);
      color: #fff;
      font-size: .6rem;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0 4px;
      box-shadow: 0 2px 6px rgba(201, 96, 112, .4);
      animation: badgePop .3s cubic-bezier(.34, 1.8, .64, 1);
    }

    .recycle-badge.hidden {
      display: none;
    }

    /* Activity Log btn */
    .log-btn {
      position: relative;
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 7px 12px;
      border-radius: 12px;
      border: 1.5px solid var(--border);
      background: var(--surface2);
      cursor: pointer;
      font-family: 'Poppins', sans-serif;
      font-size: .68rem;
      color: var(--muted2);
      transition: all .3s;
      animation: popIn .5s ease .07s both;
    }

    .log-btn:hover {
      border-color: var(--accent2);
      color: var(--accent);
      transform: scale(1.05);
      box-shadow: 0 4px 15px var(--shadow);
    }

    .log-btn svg {
      width: 15px;
      height: 15px;
    }

    .log-badge {
      position: absolute;
      top: -7px;
      right: -7px;
      min-width: 18px;
      height: 18px;
      border-radius: 999px;
      background: var(--accent);
      color: #fff;
      font-size: .6rem;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0 4px;
      box-shadow: 0 2px 6px var(--shadow);
      animation: badgePop .3s cubic-bezier(.34, 1.8, .64, 1);
    }

    .log-badge.hidden {
      display: none;
    }

    /* Export btn */
    .export-btn {
      position: relative;
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 7px 12px;
      border-radius: 12px;
      border: 1.5px solid var(--border);
      background: var(--surface2);
      cursor: pointer;
      font-family: 'Poppins', sans-serif;
      font-size: .68rem;
      color: var(--muted2);
      transition: all .3s;
      animation: popIn .5s ease .08s both;
    }

    .export-btn:hover {
      border-color: var(--done);
      color: var(--done);
      transform: scale(1.05);
      box-shadow: 0 4px 15px var(--shadow);
    }

    .export-btn svg {
      width: 15px;
      height: 15px;
    }

    .export-dropdown {
      display: none;
      position: absolute;
      top: calc(100% + 6px);
      right: 0;
      z-index: 1000;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 10px 30px var(--shadow);
      animation: dropIn .18s ease;
      min-width: 140px;
    }

    .export-dropdown.open {
      display: block;
    }

    .export-opt {
      padding: 10px 16px;
      font-size: .79rem;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: background .15s;
      font-family: 'Poppins', sans-serif;
      color: var(--text);
    }

    .export-opt:hover {
      background: var(--surface2);
    }

    .theme-toggle {
      display: flex;
      align-items: center;
      gap: 7px;
      padding: 6px 13px;
      border-radius: 999px;
      border: 1px solid var(--border);
      background: var(--surface2);
      cursor: pointer;
      font-family: 'Poppins', sans-serif;
      font-size: .69rem;
      color: var(--muted2);
      transition: all .3s;
      animation: popIn .5s ease .1s both;
      user-select: none;
    }

    .theme-toggle:hover {
      border-color: var(--accent);
      color: var(--accent);
    }

    .toggle-icons {
      display: flex;
      align-items: center;
      gap: 3px;
      font-size: .78rem;
    }

    .toggle-track {
      width: 32px;
      height: 17px;
      border-radius: 999px;
      background: var(--border);
      position: relative;
      transition: background .3s;
      flex-shrink: 0;
    }

    .toggle-thumb {
      position: absolute;
      top: 2px;
      left: 2px;
      width: 13px;
      height: 13px;
      border-radius: 50%;
      background: var(--accent);
      transition: transform .35s cubic-bezier(.34, 1.56, .64, 1);
    }

    [data-theme="dark"] .toggle-thumb {
      transform: translateX(15px);
    }

    [data-theme="dark"] .toggle-track {
      background: var(--accent3);
    }

    .toggle-label {
      font-size: .69rem;
      font-weight: 500;
    }

    .add-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 9px 20px;
      background: var(--accent);
      border: none;
      border-radius: 10px;
      color: #fff;
      font-family: 'Poppins', sans-serif;
      font-size: .82rem;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 4px 14px var(--shadow);
      transition: background .2s, transform .15s, box-shadow .2s;
      animation: popIn .5s ease .2s both;
    }

    .add-btn:hover {
      background: var(--accent3);
      transform: translateY(-2px);
      box-shadow: 0 8px 22px var(--shadow);
    }

    .add-btn svg {
      width: 14px;
      height: 14px;
    }

    .logout-btn:hover {
      border-color: var(--revision) !important;
      color: var(--revision) !important;
    }

    .admin-menu-wrap {
      position: relative;
      display: flex;
      align-items: center;
    }

    .admin-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 7px 12px;
      border-radius: 999px;
      border: 1px solid var(--border);
      background: var(--surface2);
      color: var(--text);
      font-family: 'Poppins', sans-serif;
      font-size: .72rem;
      cursor: pointer;
      transition: all .2s;
      animation: popIn .5s ease .08s both;
    }

    .admin-btn:hover {
      border-color: var(--accent);
      color: var(--accent);
    }

    .admin-dropdown {
      display: none;
      position: absolute;
      top: calc(100% + 8px);
      right: 0;
      z-index: 1002;
      min-width: 180px;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 14px;
      box-shadow: 0 16px 36px rgba(0, 0, 0, .14);
      overflow: hidden;
      animation: dropIn .18s ease;
    }

    .admin-dropdown.open {
      display: block;
    }

    .admin-dropdown-item {
      display: block;
      width: 100%;
      padding: 12px 14px;
      font-size: .78rem;
      color: var(--text);
      text-align: left;
      background: transparent;
      border: none;
      cursor: pointer;
      font-family: 'Poppins', sans-serif;
    }

    .admin-dropdown-item.admin-fullname {
      font-weight: 700;
      border-bottom: 1px solid var(--border);
      cursor: default;
    }

    .admin-dropdown-item.admin-logout {
      color: var(--accent3);
    }

    .admin-dropdown-item.admin-logout:hover {
      background: var(--surface2);
    }

    /* ══════════════════════════════════════════════
   SEARCH & FILTER BAR
══════════════════════════════════════════════ */
    .filter-bar {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px;
      flex-wrap: wrap;
      animation: fadeUp .45s ease .05s both;
    }

    .search-wrap {
      position: relative;
      flex: 1;
      min-width: 180px;
      max-width: 320px;
    }

    .search-wrap svg {
      position: absolute;
      left: 11px;
      top: 50%;
      transform: translateY(-50%);
      width: 14px;
      height: 14px;
      color: var(--muted);
      pointer-events: none;
    }

    .search-input {
      width: 100%;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 8px 12px 8px 32px;
      color: var(--text);
      font-family: 'Poppins', sans-serif;
      font-size: .8rem;
      outline: none;
      transition: border-color .2s, box-shadow .2s, background .4s;
    }

    .search-input::placeholder {
      color: var(--muted);
      opacity: .6;
    }

    .search-input:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(201, 99, 122, .1);
    }

    .filter-divider {
      width: 1px;
      height: 22px;
      background: var(--border);
      flex-shrink: 0;
    }

    .filter-label {
      font-family: 'Poppins', sans-serif;
      font-size: .6rem;
      font-weight: 600;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: .1em;
      white-space: nowrap;
    }

    .filter-pills {
      display: flex;
      gap: 6px;
      flex-wrap: wrap;
      align-items: center;
    }

    .fpill {
      padding: 5px 13px;
      border-radius: 999px;
      border: 1px solid var(--border);
      background: var(--surface);
      font-family: 'Poppins', sans-serif;
      font-size: .71rem;
      font-weight: 500;
      color: var(--muted2);
      cursor: pointer;
      transition: all .18s;
      white-space: nowrap;
      user-select: none;
    }

    .fpill:hover {
      border-color: var(--accent);
      color: var(--accent);
    }

    .fpill.active {
      background: var(--accent);
      border-color: var(--accent);
      color: #fff;
      box-shadow: 0 2px 10px var(--shadow);
    }

    .fpill.active.f-hold {
      background: var(--onhold);
      border-color: var(--onhold);
    }

    .fpill.active.f-rev {
      background: var(--revision);
      border-color: var(--revision);
    }

    .fpill.active.f-done {
      background: var(--done);
      border-color: var(--done);
    }

    .filter-clear {
      padding: 5px 11px;
      border-radius: 999px;
      border: 1px dashed var(--border);
      background: transparent;
      font-family: 'Poppins', sans-serif;
      font-size: .69rem;
      color: var(--muted);
      cursor: pointer;
      transition: all .18s;
      display: none;
      align-items: center;
      gap: 5px;
    }

    .filter-clear:hover {
      border-color: var(--revision);
      color: var(--revision);
    }

    .filter-clear.visible {
      display: inline-flex;
    }

    .no-results-cell {
      text-align: center;
      padding: 48px 24px;
      color: var(--muted);
      font-family: 'Poppins', sans-serif;
      font-size: .85rem;
    }

    .no-results-cell span {
      font-size: 1.6rem;
      display: block;
      margin-bottom: 8px;
    }

    /* ══════════════════════════════════════════════
   TABLE
══════════════════════════════════════════════ */
    .table-wrap {
      border-radius: 16px;
      border: 1px solid var(--border);
      overflow-x: auto;
      background: var(--surface);
      box-shadow: 0 8px 40px var(--shadow);
      transition: background .4s, border-color .4s, box-shadow .4s;
      animation: fadeUp .55s ease .1s both;
      cursor: grab;
      user-select: none;
    }

    .table-wrap::-webkit-scrollbar {
      height: 8px;
    }

    .table-wrap::-webkit-scrollbar-thumb {
      background: var(--border);
      border-radius: 4px;
    }

    .table-wrap::-webkit-scrollbar-thumb:hover {
      background: var(--muted);
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead tr:first-child th {
      background: var(--surface2);
      padding: 9px 14px 6px;
      font-family: 'Poppins', sans-serif;
      font-size: .6rem;
      letter-spacing: .16em;
      text-transform: uppercase;
      font-weight: 600;
      text-align: center;
      border-bottom: 1px solid var(--border);
      color: var(--muted2);
      transition: background .4s;
    }

    thead tr:first-child th:first-child {
      background: var(--surface);
      border-bottom: 1px solid var(--border);
    }

    .group-proposal {
      color: var(--accent) !important;
    }

    .group-dev {
      color: var(--accent3) !important;
    }

    .group-final {
      color: var(--onhold) !important;
    }

    /* ── SORTABLE COLUMN HEADERS ── */
    thead tr:last-child th {
      background: var(--surface3);
      padding: 10px 14px;
      font-family: 'Poppins', sans-serif;
      font-size: .63rem;
      font-weight: 600;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--muted);
      text-align: left;
      border-bottom: 2px solid var(--border);
      white-space: nowrap;
      transition: background .4s;
    }

    .sortable {
      cursor: pointer;
      user-select: none;
      transition: color .2s;
    }

    .sortable:hover {
      color: var(--accent);
    }

    .sort-indicator {
      display: inline-flex;
      flex-direction: column;
      margin-left: 4px;
      vertical-align: middle;
      opacity: .4;
      transition: opacity .2s;
    }

    .sort-indicator.asc .si-up,
    .sort-indicator.desc .si-down {
      opacity: 1;
      color: var(--accent);
    }

    .sort-indicator svg {
      width: 8px;
      height: 8px;
      display: block;
    }

    .sortable:hover .sort-indicator {
      opacity: .7;
    }

    /* ── DELETE COLUMN HEADER FIX ── */
    .col-sep {
      border-left: 1px solid var(--border) !important;
    }

    .subhead {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .subhead-dot {
      width: 7px;
      height: 7px;
      border-radius: 2px;
      flex-shrink: 0;
    }

    .sd-proposal {
      background: var(--accent);
    }

    .sd-dev {
      background: var(--accent3);
    }

    .sd-status {
      background: var(--onhold);
    }

    /* FIXED: Delete header cell — shows icon + DELETE label like Image 1 */
    .delete-th {
      text-align: center;
      width: 64px;
      padding: 10px 8px !important;
      border-right: 1px solid var(--border) !important;
    }

    .delete-th-inner {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 4px;
    }

    .delete-th-inner svg {
      width: 13px;
      height: 13px;
      color: var(--muted);
      opacity: .7;
    }

    .delete-th-label {
      font-size: .55rem;
      font-weight: 700;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--muted);
      opacity: .7;
    }

    /* Trash cell */
    .trash-cell {
      text-align: center;
      vertical-align: middle !important;
      width: 64px;
      padding: 14px 8px !important;
      border-right: 1px solid var(--border) !important;
    }

    .trash-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 34px;
      height: 34px;
      border-radius: 10px;
      border: 1.5px solid var(--border);
      background: var(--surface2);
      color: var(--muted);
      cursor: pointer;
      transition: all .25s;
    }

    .trash-btn:hover {
      background: rgba(201, 96, 112, .12);
      border-color: var(--revision);
      color: var(--revision);
      transform: scale(1.12);
      box-shadow: 0 4px 12px rgba(201, 96, 112, .2);
    }

    .trash-btn svg {
      width: 14px;
      height: 14px;
      pointer-events: none;
    }

    tbody tr {
      border-bottom: 1px solid var(--border);
      transition: background .2s;
    }

    tbody tr:last-child {
      border-bottom: none;
    }

    tbody tr:hover {
      background: rgba(255, 194, 205, .08);
    }

    [data-theme="dark"] tbody tr:hover {
      background: rgba(255, 143, 163, .05);
    }

    .row-enter {
      animation: rowIn .35s cubic-bezier(.22, 1, .36, 1) both;
    }

    .row-pulse {
      animation: rowPulse .9s ease;
    }

    td {
      padding: 15px 14px;
      font-size: .82rem;
      color: var(--text);
      vertical-align: top;
      transition: color .4s;
    }

    .client-name {
      font-weight: 700;
      font-size: .92rem;
      color: var(--text);
      line-height: 1.3;
    }

    .client-tag {
      font-size: .62rem;
      color: var(--muted);
      margin-top: 3px;
    }

    .editable {
      cursor: text;
      border-radius: 5px;
      padding: 2px 5px;
      transition: background .2s, outline .2s;
      outline: none;
      min-width: 20px;
      display: inline-block;
      user-select: text;
    }

    .editable:hover {
      background: rgba(201, 99, 122, .08);
    }

    .editable:focus {
      background: rgba(201, 99, 122, .12);
      outline: 1.5px solid var(--accent);
      box-shadow: 0 0 0 3px rgba(201, 99, 122, .1);
    }

    [data-theme="dark"] .editable:hover {
      background: rgba(255, 143, 163, .08);
    }

    [data-theme="dark"] .editable:focus {
      background: rgba(255, 143, 163, .12);
      box-shadow: 0 0 0 3px rgba(255, 143, 163, .1);
    }

    .edit-hint {
      display: none;
    }

    .assignee-name:empty:before {
      content: attr(data-placeholder);
      color: var(--muted);
      opacity: .45;
      font-style: italic;
      pointer-events: none;
    }

    tbody tr:hover .edit-hint {
      opacity: 1;
    }

    .steps {
      display: flex;
      flex-direction: column;
      gap: 5px;
      margin-bottom: 8px;
    }

    .step {
      display: flex;
      align-items: center;
      gap: 7px;
      font-size: .78rem;
    }

    .step-check {
      width: 16px;
      height: 16px;
      border-radius: 4px;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .step.done .step-check {
      background: rgba(90, 154, 106, .15);
      color: var(--done);
    }

    .step.active .step-check {
      background: rgba(201, 99, 122, .18);
      color: var(--accent);
    }

    .step.pending .step-check {
      background: rgba(160, 128, 112, .08);
      color: var(--muted);
      opacity: .6;
    }

    .step.done>span {
      color: var(--done);
    }

    .step.active>span {
      color: var(--text);
      font-weight: 600;
    }

    .step.pending>span {
      color: var(--muted);
      opacity: .55;
    }

    .stage-select {
      width: 100%;
      background: var(--surface2);
      border: 1px solid var(--border);
      border-radius: 6px;
      color: var(--text);
      font-family: 'Poppins', sans-serif;
      font-size: .76rem;
      padding: 5px 8px;
      cursor: pointer;
      outline: none;
      transition: border-color .2s, background .4s;
      margin-top: 4px;
    }

    .stage-select:focus {
      border-color: var(--accent);
    }

    .stage-select option {
      background: var(--surface);
    }

    .assignee {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 6px;
    }

    .avatar {
      width: 30px;
      height: 30px;
      border-radius: 8px;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Poppins', sans-serif;
      font-size: .65rem;
      font-weight: 700;
      transition: transform .2s;
    }

    .avatar:hover {
      transform: scale(1.12);
    }

    .av1 {
      background: rgba(255, 194, 205, .45);
      color: var(--accent);
    }

    .av2 {
      background: rgba(176, 112, 96, .18);
      color: var(--accent3);
    }

    .av3 {
      background: rgba(201, 160, 90, .18);
      color: var(--onhold);
    }

    .av4 {
      background: rgba(160, 120, 136, .18);
      color: var(--muted2);
    }

    [data-theme="dark"] .av1 {
      background: rgba(255, 143, 163, .18);
    }

    [data-theme="dark"] .av2 {
      background: rgba(212, 144, 122, .18);
    }

    [data-theme="dark"] .av3 {
      background: rgba(212, 168, 64, .18);
    }

    [data-theme="dark"] .av4 {
      background: rgba(160, 120, 136, .18);
    }

    .assignee-name {
      font-size: .8rem;
      color: var(--muted2);
      font-weight: 500;
    }

    .dev-select-minimal {
      font-size: .62rem;
      background: var(--surface3);
      border: 1px solid var(--border);
      color: var(--muted);
      border-radius: 6px;
      padding: 2px 6px;
      outline: none;
      cursor: pointer;
      transition: all .2s;
      font-family: 'Poppins', sans-serif;
      flex: 1;
    }

    .dev-select-minimal:hover {
      border-color: var(--accent);
      color: var(--text);
    }

    .dev-due-section {
      display: flex;
      flex-direction: column;
      gap: 4px;
      margin-top: 10px;
      padding-top: 8px;
      border-top: 1px solid var(--border);
    }

    .dev-due-row {
      display: flex;
      align-items: center;
      gap: 6px;
      flex-wrap: nowrap;
      white-space: nowrap;
    }

    .dev-due-label {
      font-size: .6rem;
      font-weight: 600;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: .08em;
      white-space: nowrap;
      min-width: 48px;
    }

    .progress-wrap {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .progress-row {
      display: flex;
      flex-direction: column;
      gap: 3px;
    }

    .progress-label-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: .62rem;
      color: var(--muted);
    }

    .progress-bar {
      height: 5px;
      border-radius: 99px;
      background: var(--border);
      overflow: hidden;
      width: 90px;
    }

    .progress-fill {
      height: 100%;
      border-radius: 99px;
      transition: width .8s cubic-bezier(.34, 1.56, .64, 1);
    }

    .pf-fe {
      background: linear-gradient(90deg, var(--pink), var(--accent));
    }

    .pf-be {
      background: linear-gradient(90deg, var(--cream), var(--accent3));
    }

    [data-theme="dark"] .pf-fe {
      background: linear-gradient(90deg, #ff8fa3, #ff5c7a);
    }

    [data-theme="dark"] .pf-be {
      background: linear-gradient(90deg, #d4907a, #c9637a);
    }

    .pct-label {
      font-weight: 600;
      color: var(--muted2) !important;
    }

    .status-select-wrap {
      position: relative;
    }

    .status-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 6px 14px;
      border-radius: 12px;
      font-size: .78rem;
      font-weight: 700;
      cursor: pointer;
      transition: all .2s;
      user-select: none;
      font-family: 'Poppins', sans-serif;
      white-space: nowrap;
      box-shadow: 0 2px 8px var(--shadow);
    }

    .status-badge:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px var(--shadow);
    }

    .badge-dot {
      width: 9px;
      height: 9px;
      border-radius: 50%;
    }

    .s-done {
      background: rgba(90, 154, 106, .08);
      color: var(--done);
      border: 1.5px solid rgba(90, 154, 106, .22);
    }

    .s-done .badge-dot {
      background: var(--done);
      box-shadow: 0 0 8px var(--done);
    }

    .s-onhold {
      background: rgba(176, 128, 32, .08);
      color: var(--onhold);
      border: 1.5px solid rgba(176, 128, 32, .22);
    }

    .s-onhold .badge-dot {
      background: var(--onhold);
      box-shadow: 0 0 8px var(--onhold);
    }

    .s-revision {
      background: rgba(201, 96, 112, .08);
      color: var(--revision);
      border: 1.5px solid rgba(201, 96, 112, .22);
    }

    .s-revision .badge-dot {
      background: var(--revision);
      box-shadow: 0 0 8px var(--revision);
      animation: blink 1.6s infinite;
    }

    .status-dropdown {
      display: none;
      position: absolute;
      top: calc(100% + 6px);
      left: 0;
      z-index: 50;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 10px 30px var(--shadow);
      animation: dropIn .18s ease;
      min-width: 132px;
    }

    .status-dropdown.open {
      display: block;
    }

    .status-opt {
      padding: 9px 14px;
      font-size: .79rem;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: background .15s;
      font-family: 'Poppins', sans-serif;
    }

    .status-opt:hover {
      background: var(--surface2);
    }

    .sopt-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
    }

    /* ── DUE DATE + NOTIFICATION ── */
    .due-input {
      position: absolute;
      opacity: 0;
      width: 1px;
      height: 1px;
      pointer-events: none;
      border: none;
      padding: 0;
      margin: 0;
    }

    .due-date {
      font-size: .7rem;
      color: var(--muted2);
      display: flex;
      align-items: center;
      gap: 5px;
      margin-bottom: 4px;
      background: rgba(201, 99, 122, .06);
      padding: 4px 8px;
      border-radius: 6px;
      width: fit-content;
      transition: all .3s;
    }

    .due-date:hover {
      background: rgba(201, 99, 122, .12);
      color: var(--text);
    }

    .due-date svg {
      width: 13px;
      height: 13px;
    }

    .due-overdue {
      color: var(--revision) !important;
      background: rgba(201, 96, 112, .1) !important;
    }

    .due-notification {
      font-size: .68rem;
      font-weight: 600;
      padding: 5px 9px;
      border-radius: 7px;
      margin-top: 6px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: linear-gradient(135deg, rgba(201, 96, 112, .15), rgba(201, 96, 112, .08));
      border: 1px solid rgba(201, 96, 112, .3);
      color: var(--revision);
      white-space: nowrap;
      width: fit-content;
    }

    .due-notification svg {
      width: 12px;
      height: 12px;
      flex-shrink: 0;
    }

    .due-notification.warning {
      background: linear-gradient(135deg, rgba(176, 128, 32, .15), rgba(176, 128, 32, .08));
      border-color: rgba(176, 128, 32, .3);
      color: var(--onhold);
    }

    .due-notification.safe {
      background: linear-gradient(135deg, rgba(90, 154, 106, .15), rgba(90, 154, 106, .08));
      border-color: rgba(90, 154, 106, .3);
      color: var(--done);
    }

    .final-header-row {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 6px;
    }

    .final-tag {
      font-family: 'Poppins', sans-serif;
      font-size: .56rem;
      font-weight: 700;
      letter-spacing: .14em;
      text-transform: uppercase;
      color: var(--onhold);
      background: rgba(176, 128, 32, .1);
      border: 1px solid rgba(176, 128, 32, .22);
      border-radius: 5px;
      padding: 2px 7px;
      display: inline-block;
      white-space: nowrap;
    }

    .final-date-str {
      font-family: 'Poppins', sans-serif;
      font-size: .76rem;
      color: var(--muted2);
      font-weight: 500;
    }

    .cal-icon-btn {
      background: none;
      border: none;
      cursor: pointer;
      color: var(--muted);
      padding: 2px 4px;
      border-radius: 5px;
      transition: color .2s, background .2s;
      display: inline-flex;
      align-items: center;
    }

    .cal-icon-btn:hover {
      color: var(--accent);
      background: var(--surface2);
    }

    .final-text {
      font-size: .77rem;
      color: var(--muted);
      margin-top: 6px;
      line-height: 1.55;
      min-height: 22px;
      white-space: pre-wrap;
      word-break: break-word;
      max-height: 200px;
      overflow-y: auto;
      text-align: justify;
    }

    .final-text:empty:before {
      content: attr(data-placeholder);
      color: var(--muted);
      opacity: .45;
      pointer-events: none;
      font-style: italic;
    }

    .remark-text {
      font-size: .77rem;
      color: var(--muted);
      margin-top: 6px;
      line-height: 1.5;
      min-height: 22px;
      white-space: pre-wrap;
      word-break: break-word;
      max-height: 200px;
      overflow-y: auto;
      text-align: justify;
    }

    .remark-text:empty:before {
      content: attr(data-placeholder);
      color: var(--muted);
      opacity: .45;
      pointer-events: none;
      font-style: italic;
    }


    /* ══════════════════════════════════════════════
   FOOTER
══════════════════════════════════════════════ */
    .footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: 24px;
      padding-top: 16px;
      border-top: 1px solid var(--border);
      animation: fadeUp .55s ease .2s both;
      flex-wrap: wrap;
      gap: 12px;
    }

    .footer-left {
      font-size: .68rem;
      color: var(--muted);
      font-family: 'Poppins', sans-serif;
    }

    .footer-right {
      display: flex;
      align-items: center;
      gap: 12px;
      flex-wrap: wrap;
    }

    .legend-item {
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: .66rem;
      color: var(--muted);
      font-family: 'Poppins', sans-serif;
    }

    .ldot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      flex-shrink: 0;
    }

    /* ══════════════════════════════════════════════
   RECYCLE BIN DRAWER
══════════════════════════════════════════════ */
    .bin-drawer-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .35);
      backdrop-filter: blur(5px);
      z-index: 400;
    }

    .bin-drawer-overlay.open {
      display: block;
    }

    .bin-drawer {
      position: fixed;
      right: 0;
      top: 0;
      bottom: 0;
      width: 460px;
      background: linear-gradient(160deg, var(--surface), var(--surface2));
      border-left: 1.5px solid var(--border);
      box-shadow: -16px 0 60px var(--shadow);
      z-index: 401;
      display: flex;
      flex-direction: column;
      transform: translateX(100%);
      transition: transform .4s cubic-bezier(.22, 1, .36, 1);
    }

    .bin-drawer.open {
      transform: translateX(0);
    }

    .bin-drawer-header {
      padding: 28px 28px 20px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-shrink: 0;
    }

    .bin-drawer-title {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .bin-drawer-title h2 {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--text);
      font-family: 'Poppins', sans-serif;
    }

    .bin-drawer-title svg {
      width: 22px;
      height: 22px;
      color: var(--accent);
    }

    .bin-count-pill {
      font-size: .65rem;
      font-weight: 600;
      background: rgba(201, 96, 112, .15);
      color: var(--revision);
      border: 1px solid rgba(201, 96, 112, .3);
      border-radius: 999px;
      padding: 3px 10px;
      font-family: 'Poppins', sans-serif;
    }

    .bin-close-btn {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      border: 1.5px solid var(--border);
      background: transparent;
      color: var(--muted);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all .2s;
    }

    .bin-close-btn:hover {
      background: var(--surface3);
      color: var(--text);
      border-color: var(--accent);
    }

    .bin-close-btn svg {
      width: 14px;
      height: 14px;
    }

    .bin-drawer-body {
      flex: 1;
      overflow-y: auto;
      padding: 20px 28px;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .bin-drawer-body::-webkit-scrollbar {
      width: 6px;
    }

    .bin-drawer-body::-webkit-scrollbar-thumb {
      background: var(--border);
      border-radius: 3px;
    }

    .bin-drawer-body::-webkit-scrollbar-thumb:hover {
      background: var(--accent);
    }

    .bin-empty {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 12px;
      padding: 40px;
      text-align: center;
      color: var(--muted);
    }

    .bin-empty-icon {
      font-size: 3.5rem;
      opacity: .4;
      animation: floatBin 3s ease-in-out infinite;
    }

    .bin-empty p {
      font-size: .82rem;
      line-height: 1.5;
      font-family: 'Poppins', sans-serif;
    }

    .bin-drawer-footer {
      padding: 16px 28px;
      border-top: 1px solid var(--border);
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
    }

    .bin-footer-note {
      font-size: .62rem;
      color: var(--muted);
      line-height: 1.4;
      font-family: 'Poppins', sans-serif;
    }

    .btn-empty-bin {
      padding: 9px 18px;
      border-radius: 10px;
      border: 1.5px solid rgba(201, 96, 112, .4);
      background: rgba(201, 96, 112, .08);
      color: var(--revision);
      font-family: 'Poppins', sans-serif;
      font-size: .78rem;
      font-weight: 600;
      cursor: pointer;
      transition: all .2s;
      white-space: nowrap;
    }

    .btn-empty-bin:hover {
      background: rgba(201, 96, 112, .15);
      transform: translateY(-1px);
    }

    .bin-card {
      background: var(--surface);
      border: 1.5px solid var(--border);
      border-radius: 14px;
      padding: 16px 18px;
      transition: all .3s;
      animation: cardIn .35s cubic-bezier(.22, 1, .36, 1) both;
    }

    .bin-card:hover {
      border-color: var(--accent2);
      box-shadow: 0 6px 20px var(--shadow);
      transform: translateX(-3px);
    }

    .bin-card-top {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 12px;
      margin-bottom: 10px;
    }

    .bin-card-name {
      font-weight: 700;
      font-size: .9rem;
      color: var(--text);
      font-family: 'Poppins', sans-serif;
    }

    .bin-card-tag {
      font-size: .6rem;
      color: var(--muted);
      margin-top: 1px;
    }

    .bin-card-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
      margin-top: 8px;
    }

    .bin-meta-pill {
      font-size: .65rem;
      padding: 3px 9px;
      border-radius: 6px;
      border: 1px solid var(--border);
      background: var(--surface2);
      color: var(--muted2);
      font-family: 'Poppins', sans-serif;
    }

    .bin-deleted-at {
      font-size: .6rem;
      color: var(--muted);
      margin-top: 8px;
      display: flex;
      align-items: center;
      gap: 4px;
      font-family: 'Poppins', sans-serif;
    }

    .bin-deleted-at svg {
      width: 10px;
      height: 10px;
      opacity: .6;
    }

    .bin-card-actions {
      display: flex;
      gap: 8px;
      margin-top: 12px;
      padding-top: 12px;
      border-top: 1px solid var(--border);
      justify-content: flex-end;
    }

    .restore-btn {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 10px;
      border: 1.5px solid rgba(90, 154, 106, .4);
      background: rgba(90, 154, 106, .08);
      color: var(--done);
      font-family: 'Poppins', sans-serif;
      font-size: .75rem;
      font-weight: 600;
      cursor: pointer;
      transition: all .2s;
      white-space: nowrap;
    }

    .restore-btn:hover {
      background: rgba(90, 154, 106, .18);
      transform: scale(1.05);
      box-shadow: 0 4px 12px rgba(90, 154, 106, .2);
    }

    .restore-btn svg {
      width: 14px;
      height: 14px;
    }

    .perm-delete-btn {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 10px;
      border: 1.5px solid rgba(201, 96, 112, .4);
      background: rgba(201, 96, 112, .08);
      color: var(--revision);
      font-family: 'Poppins', sans-serif;
      font-size: .75rem;
      font-weight: 600;
      cursor: pointer;
      transition: all .2s;
      white-space: nowrap;
    }

    .perm-delete-btn:hover {
      background: rgba(201, 96, 112, .18);
      transform: scale(1.05);
      box-shadow: 0 4px 12px rgba(201, 96, 112, .2);
    }

    .perm-delete-btn svg {
      width: 14px;
      height: 14px;
    }

    /* ══════════════════════════════════════════════
   ACTIVITY LOG DRAWER
══════════════════════════════════════════════ */
    .log-drawer-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .35);
      backdrop-filter: blur(5px);
      z-index: 400;
    }

    .log-drawer-overlay.open {
      display: block;
    }

    .log-drawer {
      position: fixed;
      right: 0;
      top: 0;
      bottom: 0;
      width: 420px;
      background: linear-gradient(160deg, var(--surface), var(--surface2));
      border-left: 1.5px solid var(--border);
      box-shadow: -16px 0 60px var(--shadow);
      z-index: 401;
      display: flex;
      flex-direction: column;
      transform: translateX(100%);
      transition: transform .4s cubic-bezier(.22, 1, .36, 1);
    }

    .log-drawer.open {
      transform: translateX(0);
    }

    .log-drawer-header {
      padding: 28px 28px 20px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-shrink: 0;
    }

    .log-drawer-title {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .log-drawer-title h2 {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--text);
      font-family: 'Poppins', sans-serif;
    }

    .log-drawer-title svg {
      width: 22px;
      height: 22px;
      color: var(--accent);
    }

    .log-close-btn {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      border: 1.5px solid var(--border);
      background: transparent;
      color: var(--muted);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all .2s;
    }

    .log-close-btn:hover {
      background: var(--surface3);
      color: var(--text);
      border-color: var(--accent);
    }

    .log-close-btn svg {
      width: 14px;
      height: 14px;
    }

    .log-body {
      flex: 1;
      overflow-y: auto;
      padding: 20px 28px;
      display: flex;
      flex-direction: column;
      gap: 0;
    }

    .log-body::-webkit-scrollbar {
      width: 6px;
    }

    .log-body::-webkit-scrollbar-thumb {
      background: var(--border);
      border-radius: 3px;
    }

    .log-empty {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 12px;
      padding: 60px 40px;
      text-align: center;
      color: var(--muted);
    }

    .log-empty-icon {
      font-size: 3rem;
      opacity: .4;
    }

    .log-empty p {
      font-size: .82rem;
      line-height: 1.5;
      font-family: 'Poppins', sans-serif;
    }

    .log-entry {
      display: flex;
      gap: 14px;
      padding: 14px 0;
      border-bottom: 1px solid var(--border);
      animation: logSlide .3s ease both;
    }

    .log-entry:last-child {
      border-bottom: none;
    }

    .log-dot-col {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0;
      flex-shrink: 0;
      padding-top: 2px;
    }

    .log-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      flex-shrink: 0;
      border: 2px solid var(--surface);
    }

    .log-line {
      flex: 1;
      width: 1px;
      background: var(--border);
      min-height: 20px;
      margin-top: 4px;
    }

    .log-entry:last-child .log-line {
      display: none;
    }

    .log-content {
      flex: 1;
      min-width: 0;
    }

    .log-action {
      font-size: .78rem;
      font-weight: 600;
      color: var(--text);
      font-family: 'Poppins', sans-serif;
    }

    .log-detail {
      font-size: .72rem;
      color: var(--muted);
      margin-top: 2px;
      line-height: 1.45;
    }

    .log-time {
      font-size: .62rem;
      color: var(--muted);
      margin-top: 4px;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .log-time svg {
      width: 9px;
      height: 9px;
      opacity: .6;
    }

    .log-clear-btn {
      padding: 9px 18px;
      border-radius: 10px;
      border: 1.5px solid var(--border);
      background: transparent;
      color: var(--muted);
      font-family: 'Poppins', sans-serif;
      font-size: .76rem;
      font-weight: 500;
      cursor: pointer;
      transition: all .2s;
      white-space: nowrap;
    }

    .log-clear-btn:hover {
      border-color: var(--revision);
      color: var(--revision);
    }

    .log-drawer-footer {
      padding: 16px 28px;
      border-top: 1px solid var(--border);
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
    }

    .log-footer-note {
      font-size: .62rem;
      color: var(--muted);
      line-height: 1.4;
      font-family: 'Poppins', sans-serif;
    }

    /* ══════════════════════════════════════════════
   ADD CLIENT MODAL
══════════════════════════════════════════════ */
    .modal-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .45);
      z-index: 200;
      align-items: center;
      justify-content: center;
      backdrop-filter: blur(3px);
    }

    .modal-overlay.open {
      display: flex;
    }

    .modal {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 18px;
      padding: 32px 36px;
      width: min(780px, 96vw);
      max-height: 92vh;
      overflow-y: auto;
      box-shadow: 0 24px 64px var(--shadow);
      animation: modalIn .28s cubic-bezier(.22, 1, .36, 1);
    }

    .modal h2 {
      font-family: 'Poppins', sans-serif;
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--text);
      margin-bottom: 4px;
    }

    .modal-header-section {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 24px;
      padding: 20px;
      background: linear-gradient(135deg, rgba(201, 99, 122, 0.1) 0%, rgba(232, 160, 176, 0.08) 100%);
      border-radius: 14px;
      border: 1px solid rgba(201, 99, 122, 0.15);
    }

    [data-theme="dark"] .modal-header-section {
      background: linear-gradient(135deg, rgba(255, 143, 163, 0.12) 0%, rgba(255, 179, 193, 0.08) 100%);
      border-color: rgba(255, 143, 163, 0.15);
    }

    .modal-header-content {
      display: flex;
      align-items: center;
      gap: 14px;
      flex: 1;
    }

    .modal-header-icon {
      width: 28px;
      height: 28px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .modal-header-icon svg {
      width: 100%;
      height: 100%;
      stroke: var(--accent);
      fill: none;
      stroke-width: 2.5;
    }

    .modal-header-text h2 {
      font-size: 1.45rem;
      font-weight: 800;
      margin-bottom: 6px;
      letter-spacing: -0.5px;
    }

    .modal-header-text p {
      font-size: 0.72rem;
      color: var(--muted);
      letter-spacing: 0.05em;
      font-weight: 500;
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .form-group.full {
      grid-column: 1/-1;
    }

    .form-group label {
      font-family: 'Poppins', sans-serif;
      font-size: .65rem;
      font-weight: 600;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: .1em;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      background: var(--surface2);
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 9px 12px;
      color: var(--text);
      font-family: 'Poppins', sans-serif;
      font-size: .82rem;
      outline: none;
      transition: border-color .2s, box-shadow .2s;
      resize: vertical;
    }

    .form-group select {
      appearance: none;
      padding-right: 28px;
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%233d2b22' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 10px center;
      background-size: 14px;
      padding-left: 12px;
    }

    [data-theme="dark"] .form-group select {
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23f5e8e4' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(201, 99, 122, .1);
    }

    .form-group select option {
      background: var(--surface);
    }

    .modal-actions {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 22px;
      padding-top: 18px;
      border-top: 1px solid var(--border);
    }

    .btn-cancel {
      padding: 9px 20px;
      border-radius: 9px;
      border: 1px solid var(--border);
      background: transparent;
      color: var(--muted2);
      font-family: 'Poppins', sans-serif;
      font-size: .82rem;
      cursor: pointer;
      transition: background .2s;
    }

    .btn-cancel:hover {
      background: var(--surface2);
    }

    .btn-save {
      padding: 9px 22px;
      border-radius: 9px;
      border: none;
      background: var(--accent);
      color: #fff;
      font-family: 'Poppins', sans-serif;
      font-size: .82rem;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 4px 14px var(--shadow);
      transition: background .2s, transform .15s;
    }

    .btn-save:hover {
      background: var(--accent3);
      transform: translateY(-1px);
    }

    /* ══ MODAL PHASE BLOCKS ══ */
    .modal-phase-block {
      border: 0;
      border-top: 1px solid var(--border);
      border-radius: 0;
      overflow: visible;
      margin-bottom: 0;
      padding-top: 20px;
      margin-top: 20px;
    }

    .modal-phase-header {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 0 0 14px 0;
      background: transparent;
      border-bottom: 0;
    }

    .modal-phase-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      flex-shrink: 0;
    }

    .modal-phase-label {
      font-size: .65rem;
      font-weight: 700;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--muted2);
    }

    .modal-phase-fields {
      display: grid;
      gap: 14px;
      padding: 0;
      background: transparent;
    }

    /* ══════════════════════════════════════════════
   CONFIRM MODAL
══════════════════════════════════════════════ */
    .confirm-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .45);
      backdrop-filter: blur(8px);
      z-index: 500;
      align-items: center;
      justify-content: center;
    }

    .confirm-overlay.open {
      display: flex;
    }

    .confirm-box {
      background: var(--glass);
      backdrop-filter: blur(20px);
      border: 1.5px solid var(--border);
      border-radius: 20px;
      padding: 32px 36px;
      width: 380px;
      text-align: center;
      box-shadow: 0 24px 60px var(--shadow);
      animation: modalIn .3s cubic-bezier(.34, 1.4, .64, 1);
      font-family: 'Poppins', sans-serif;
    }

    .confirm-box .bin-icon {
      font-size: 2.4rem;
      margin-bottom: 12px;
      display: block;
      animation: wobble .6s ease;
    }

    .confirm-box h3 {
      font-size: 1rem;
      font-weight: 700;
      color: var(--text);
      margin-bottom: 6px;
    }

    .confirm-box p {
      font-size: .8rem;
      color: var(--muted);
      margin-bottom: 22px;
      line-height: 1.5;
    }

    .confirm-box strong {
      color: var(--accent);
    }

    .confirm-actions {
      display: flex;
      gap: 10px;
      justify-content: center;
    }

    .btn-confirm-cancel {
      padding: 10px 22px;
      border-radius: 10px;
      border: 1.5px solid var(--border);
      background: transparent;
      color: var(--muted2);
      font-family: 'Poppins', sans-serif;
      font-size: .84rem;
      font-weight: 500;
      cursor: pointer;
      transition: all .2s;
    }

    .btn-confirm-cancel:hover {
      background: var(--surface2);
      color: var(--text);
    }

    .btn-confirm-delete {
      padding: 10px 22px;
      border-radius: 10px;
      border: none;
      background: linear-gradient(135deg, var(--revision), #a03050);
      color: #fff;
      font-family: 'Poppins', sans-serif;
      font-size: .84rem;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 4px 14px rgba(201, 96, 112, .3);
      transition: all .2s;
    }

    .btn-confirm-delete:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 22px rgba(201, 96, 112, .4);
    }

    /* ══════════════════════════════════════════════
   TOAST
══════════════════════════════════════════════ */
    .toast {
      position: fixed;
      bottom: 24px;
      right: 24px;
      z-index: 9999;
      background: var(--text);
      color: var(--bg);
      padding: 10px 20px;
      border-radius: 10px;
      font-family: 'Poppins', sans-serif;
      font-size: .8rem;
      font-weight: 500;
      box-shadow: 0 6px 24px var(--shadow);
      animation: toastIn .25s cubic-bezier(.22, 1, .36, 1);
    }

    /* ══════════════════════════════════════════════
   LOADING OVERLAY (for export)
══════════════════════════════════════════════ */
    .loading-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .3);
      backdrop-filter: blur(4px);
      z-index: 600;
      align-items: center;
      justify-content: center;
    }

    .loading-overlay.open {
      display: flex;
    }

    .loading-box {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 28px 36px;
      text-align: center;
      box-shadow: 0 16px 50px var(--shadow);
      font-family: 'Poppins', sans-serif;
    }

    .loading-spinner {
      width: 32px;
      height: 32px;
      border: 3px solid var(--border);
      border-top-color: var(--accent);
      border-radius: 50%;
      animation: spin .8s linear infinite;
      margin: 0 auto 12px;
    }

    .loading-box p {
      font-size: .82rem;
      color: var(--muted);
    }

    /* ══ OVERDUE NOTIFICATION POPUP ══ */
    .overdue-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .45);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      z-index: 9997;
      display: flex;
      align-items: center;
      justify-content: center;
      animation: fadeIn .35s ease;
    }

    @keyframes fadeIn {
      from {
        opacity: 0
      }

      to {
        opacity: 1
      }
    }

    .overdue-popup {
      position: relative;
      z-index: 9998;
      background: var(--glass);
      backdrop-filter: blur(24px);
      -webkit-backdrop-filter: blur(24px);
      border: 1.5px solid rgba(201, 96, 112, .35);
      border-radius: 24px;
      padding: 40px 44px;
      width: min(480px, 92vw);
      box-shadow: 0 24px 64px rgba(201, 96, 112, .25), 0 0 0 1px rgba(255, 255, 255, .08);
      animation: modalIn .4s cubic-bezier(.22, 1, .36, 1);
      font-family: 'Poppins', sans-serif;
    }

    .overdue-popup-header {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 16px;
    }

    .overdue-popup-icon {
      font-size: 2rem;
      animation: wobble .6s ease;
      flex-shrink: 0;
    }

    .overdue-popup-title {
      font-size: 1.15rem;
      font-weight: 800;
      color: var(--revision);
      letter-spacing: -.3px;
    }

    .overdue-popup-subtitle {
      font-size: .72rem;
      color: var(--muted);
      margin-top: 2px;
    }

    .overdue-divider {
      height: 1px;
      background: var(--border);
      margin: 16px 0;
    }

    .overdue-popup-body {
      font-size: .78rem;
      color: var(--muted);
      line-height: 1.6;
      margin-bottom: 20px;
    }

    .overdue-list {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 8px;
      margin-bottom: 14px;
      max-height: 220px;
      overflow-y: auto;
    }

    .overdue-list::-webkit-scrollbar {
      width: 5px;
    }

    .overdue-list::-webkit-scrollbar-thumb {
      background: var(--border);
      border-radius: 3px;
    }

    .overdue-list li {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      padding: 10px 14px;
      background: rgba(201, 96, 112, .06);
      border: 1px solid rgba(201, 96, 112, .18);
      border-radius: 10px;
      font-size: .78rem;
      color: var(--text);
      font-weight: 500;
    }

    .overdue-list li .ol-name {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .overdue-list li .ol-name::before {
      content: '⚠';
      font-size: .7rem;
      color: var(--revision);
      flex-shrink: 0;
    }

    .overdue-list li .ol-days {
      font-size: .68rem;
      font-weight: 700;
      color: var(--revision);
      background: rgba(201, 96, 112, .12);
      border-radius: 6px;
      padding: 2px 8px;
      white-space: nowrap;
      flex-shrink: 0;
    }

    .overdue-more {
      font-size: .7rem;
      color: var(--muted);
      text-align: center;
      padding: 4px 0 8px;
    }

    .overdue-popup-actions {
      display: flex;
      gap: 10px;
      justify-content: flex-end;
      margin-top: 8px;
    }

    .overdue-popup-dismiss {
      padding: 10px 22px;
      border-radius: 10px;
      border: 1.5px solid var(--border);
      background: transparent;
      color: var(--muted2);
      font-family: 'Poppins', sans-serif;
      font-size: .8rem;
      font-weight: 500;
      cursor: pointer;
      transition: all .2s;
    }

    .overdue-popup-dismiss:hover {
      background: var(--surface2);
      color: var(--text);
    }

    .overdue-popup-view {
      padding: 10px 22px;
      border-radius: 10px;
      border: none;
      background: linear-gradient(135deg, var(--revision), #a03050);
      color: #fff;
      font-family: 'Poppins', sans-serif;
      font-size: .8rem;
      font-weight: 600;
      cursor: pointer;
      transition: all .2s;
      box-shadow: 0 4px 14px rgba(201, 96, 112, .35);
    }

    .overdue-popup-view:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 22px rgba(201, 96, 112, .45);
    }

    .row-overdue-highlight {
      animation: overdueGlow 1.5s ease 3;
    }

    @keyframes overdueGlow {

      0%,
      100% {
        box-shadow: inset 0 0 0 2px transparent;
      }

      50% {
        box-shadow: inset 0 0 0 2px var(--revision);
        background: rgba(201, 96, 112, .08);
      }
    }

    /* ── ARCHIVE ROW BUTTON ── */
    [data-theme="light"] {
      --archive: #7a6abf;
      --archive-bg: rgba(122, 106, 191, .08);
      --archive-border: rgba(122, 106, 191, .3);
    }

    [data-theme="dark"] {
      --archive: #a89de8;
      --archive-bg: rgba(168, 157, 232, .1);
      --archive-border: rgba(168, 157, 232, .3);
    }

    /* Archive nav btn (header) */
    .archive-nav-btn {
      position: relative;
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 7px 12px;
      border-radius: 12px;
      border: 1.5px solid var(--border);
      background: var(--surface2);
      cursor: pointer;
      font-family: 'Poppins', sans-serif;
      font-size: .68rem;
      color: var(--muted2);
      transition: all .3s;
      animation: popIn .5s ease .04s both;
    }

    .archive-nav-btn:hover {
      border-color: var(--archive);
      color: var(--archive);
      transform: scale(1.05);
      box-shadow: 0 4px 15px var(--shadow);
    }

    .archive-nav-btn svg {
      width: 15px;
      height: 15px;
    }

    .archive-badge {
      position: absolute;
      top: -7px;
      right: -7px;
      min-width: 18px;
      height: 18px;
      border-radius: 999px;
      background: var(--archive);
      color: #fff;
      font-size: .6rem;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0 4px;
      box-shadow: 0 2px 6px rgba(122, 106, 191, .4);
      animation: badgePop .3s cubic-bezier(.34, 1.8, .64, 1);
    }

    .archive-badge.hidden {
      display: none;
    }

    /* Archive row button */
    .archive-row-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 34px;
      height: 34px;
      border-radius: 10px;
      border: 1.5px solid var(--border);
      background: var(--surface2);
      color: var(--muted);
      cursor: pointer;
      transition: all .25s;
    }

    .archive-row-btn:hover {
      background: var(--archive-bg);
      border-color: var(--archive);
      color: var(--archive);
      transform: scale(1.12);
      box-shadow: 0 4px 12px rgba(122, 106, 191, .2);
    }

    .archive-row-btn svg {
      width: 14px;
      height: 14px;
      pointer-events: none;
    }

    /* Action cell — stacks archive + trash vertically */
    .action-cell {
      text-align: center;
      vertical-align: middle !important;
      width: 64px;
      padding: 10px 8px !important;
      border-right: 1px solid var(--border) !important;
    }

    .action-cell-inner {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 6px;
    }

    /* Archive drawer */
    .archive-drawer-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .35);
      backdrop-filter: blur(5px);
      z-index: 400;
    }

    .archive-drawer-overlay.open {
      display: block;
    }

    .archive-drawer {
      position: fixed;
      right: 0;
      top: 0;
      bottom: 0;
      width: 480px;
      background: linear-gradient(160deg, var(--surface), var(--surface2));
      border-left: 1.5px solid var(--archive-border);
      box-shadow: -16px 0 60px var(--shadow);
      z-index: 401;
      display: flex;
      flex-direction: column;
      transform: translateX(100%);
      transition: transform .4s cubic-bezier(.22, 1, .36, 1);
    }

    .archive-drawer.open {
      transform: translateX(0);
    }

    .archive-drawer-header {
      padding: 28px 28px 20px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-shrink: 0;
    }

    .archive-drawer-title {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .archive-drawer-title h2 {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--text);
      font-family: 'Poppins', sans-serif;
    }

    .archive-drawer-title svg {
      width: 22px;
      height: 22px;
      color: var(--archive);
    }

    .archive-count-pill {
      font-size: .65rem;
      font-weight: 600;
      background: var(--archive-bg);
      color: var(--archive);
      border: 1px solid var(--archive-border);
      border-radius: 999px;
      padding: 3px 10px;
      font-family: 'Poppins', sans-serif;
    }

    .archive-close-btn {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      border: 1.5px solid var(--border);
      background: transparent;
      color: var(--muted);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all .2s;
    }

    .archive-close-btn:hover {
      background: var(--surface3);
      color: var(--text);
      border-color: var(--archive);
    }

    .archive-close-btn svg {
      width: 14px;
      height: 14px;
    }

    .archive-drawer-body {
      flex: 1;
      overflow-y: auto;
      padding: 20px 28px;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .archive-drawer-body::-webkit-scrollbar {
      width: 6px;
    }

    .archive-drawer-body::-webkit-scrollbar-thumb {
      background: var(--border);
      border-radius: 3px;
    }

    .archive-drawer-body::-webkit-scrollbar-thumb:hover {
      background: var(--archive);
    }

    .archive-empty {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 12px;
      padding: 40px;
      text-align: center;
      color: var(--muted);
    }

    .archive-empty-icon {
      font-size: 3.5rem;
      opacity: .4;
      animation: floatBin 3s ease-in-out infinite;
    }

    .archive-empty p {
      font-size: .82rem;
      line-height: 1.5;
      font-family: 'Poppins', sans-serif;
    }

    .archive-drawer-footer {
      padding: 16px 28px;
      border-top: 1px solid var(--border);
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
    }

    .archive-footer-note {
      font-size: .62rem;
      color: var(--muted);
      line-height: 1.4;
      font-family: 'Poppins', sans-serif;
    }

    .archive-card {
      background: var(--surface);
      border: 1.5px solid var(--archive-border);
      border-radius: 14px;
      padding: 16px 18px;
      transition: all .3s;
      animation: cardIn .35s cubic-bezier(.22, 1, .36, 1) both;
    }

    .archive-card:hover {
      border-color: var(--archive);
      box-shadow: 0 6px 20px var(--shadow);
      transform: translateX(-3px);
    }

    .archive-card-top {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 12px;
      margin-bottom: 10px;
    }

    .archive-card-name {
      font-weight: 700;
      font-size: .9rem;
      color: var(--text);
      font-family: 'Poppins', sans-serif;
    }

    .archive-card-tag {
      font-size: .6rem;
      color: var(--muted);
      margin-top: 1px;
    }

    .archive-card-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
      margin-top: 8px;
    }

    .archive-meta-pill {
      font-size: .65rem;
      padding: 3px 9px;
      border-radius: 6px;
      border: 1px solid var(--border);
      background: var(--surface2);
      color: var(--muted2);
      font-family: 'Poppins', sans-serif;
    }

    .archive-archived-at {
      font-size: .6rem;
      color: var(--muted);
      margin-top: 8px;
      display: flex;
      align-items: center;
      gap: 4px;
      font-family: 'Poppins', sans-serif;
    }

    .archive-archived-at svg {
      width: 10px;
      height: 10px;
      opacity: .6;
    }

    .archive-card-actions {
      display: flex;
      gap: 8px;
      margin-top: 12px;
      padding-top: 12px;
      border-top: 1px solid var(--border);
      justify-content: flex-end;
    }

    .archive-restore-btn {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 10px;
      border: 1.5px solid var(--archive-border);
      background: var(--archive-bg);
      color: var(--archive);
      font-family: 'Poppins', sans-serif;
      font-size: .75rem;
      font-weight: 600;
      cursor: pointer;
      transition: all .2s;
      white-space: nowrap;
    }

    .archive-restore-btn:hover {
      background: rgba(122, 106, 191, .18);
      transform: scale(1.05);
      box-shadow: 0 4px 12px rgba(122, 106, 191, .2);
    }

    .archive-restore-btn svg {
      width: 14px;
      height: 14px;
    }

    /* ══ OVERDUE EXPANDABLE LIST ══ */
    .od-client-item {
      flex-direction: column !important;
      align-items: stretch !important;
      cursor: pointer;
      padding: 0 !important;
      overflow: visible;
      border-radius: 10px !important;
    }

    .od-client-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 14px;
      transition: background .2s;
    }

    .od-client-item:hover .od-client-header {
      background: rgba(201, 96, 112, .1);
    }

    .od-count-pill {
      font-size: .6rem;
      font-weight: 700;
      background: rgba(201, 96, 112, .18);
      color: var(--revision);
      border-radius: 999px;
      padding: 2px 8px;
    }

    .od-chevron {
      font-size: .7rem;
      color: var(--muted);
      transition: transform .25s;
      display: inline-block;
    }

    .od-client-item.od-open .od-chevron {
      transform: rotate(180deg);
    }

    .od-detail-wrap {
      display: none;
      flex-direction: column;
      gap: 4px;
      padding: 0 14px 10px;
      border-top: 1px solid rgba(201, 96, 112, .15);
    }

    .od-client-item.od-open .od-detail-wrap {
      display: flex;
    }

    .od-detail-wrap {
      max-height: 0;
      overflow: hidden;
      transition: max-height .3s ease;
    }

    .od-client-item.od-open .od-detail-wrap {
      max-height: 300px;
    }

    .od-detail-row {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: .74rem;
      color: var(--text);
      padding: 5px 0;
    }

    .od-detail-icon {
      font-size: .8rem;
      flex-shrink: 0;
    }

    .od-detail-label {
      flex: 1;
      color: var(--muted2);
      font-weight: 500;
    }

    /* ── AUTOCOMPLETE DROPDOWN ── */
    .autocomplete-wrap {
      position: relative;
    }

    .ac-dropdown {
      display: none;
      position: absolute;
      top: calc(100% + 6px);
      left: 0;
      right: 0;
      background: var(--surface);
      border: 1.5px solid var(--border);
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 12px 32px var(--shadow);
      z-index: 3500;
      animation: slideDown .15s ease;
    }

    .ac-dropdown.open {
      display: block;
    }

    .ac-option {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 14px;
      cursor: pointer;
      font-size: .8rem;
      font-weight: 600;
      color: var(--text);
      transition: background .12s;
      border-bottom: 1px solid var(--border);
      font-family: 'Poppins', sans-serif;
    }

    .ac-option:last-child {
      border-bottom: none;
    }

    .ac-option:hover,
    .ac-option:active {
      background: var(--surface2);
    }

    .ac-avatar {
      width: 28px;
      height: 28px;
      border-radius: 9px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .7rem;
      font-weight: 800;
      flex-shrink: 0;
      color: #fff;
    }

    .ac-role {
      font-size: .58rem;
      color: var(--muted);
      font-weight: 500;
    }
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
      <div class="header-center">
        <div class="stat-pill"><span class="dot" style="background:var(--done)"></span>Done <strong
            id="cnt-done">0</strong></div>
        <div class="stat-pill"><span class="dot" style="background:var(--onhold)"></span>On Hold <strong
            id="cnt-hold">0</strong></div>
        <div class="stat-pill"><span class="dot" style="background:var(--revision)"></span>Revisions <strong
            id="cnt-rev">0</strong></div>


        <!-- Archive -->
        <button class="archive-nav-btn" onclick="openArchive()" title="Archive">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <polyline points="21 8 21 21 3 21 3 8" />
            <rect x="1" y="3" width="22" height="5" />
            <line x1="10" y1="12" x2="14" y2="12" />
          </svg>
          <span>Archive</span>
          <span class="archive-badge hidden" id="archive-badge">0</span>
        </button>

        <!-- Activity Log -->
        <button class="log-btn" onclick="openLog()" title="Activity Log">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
            <polyline points="14 2 14 8 20 8" />
            <line x1="16" y1="13" x2="8" y2="13" />
            <line x1="16" y1="17" x2="8" y2="17" />
            <polyline points="10 9 9 9 8 9" />
          </svg>
          <span>Activity Log</span>
          <span class="log-badge hidden" id="log-badge">0</span>
        </button>

        <!-- Export -->
        <div style="position:relative;">
          <button class="export-btn" onclick="toggleExportDrop(event)" title="Export">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
              <polyline points="7 10 12 15 17 10" />
              <line x1="12" y1="15" x2="12" y2="3" />
            </svg>
            <span>Export</span>
          </button>
          <div class="export-dropdown" id="export-dropdown">
            <div class="export-opt" onclick="exportXLSX()">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                <polyline points="14 2 14 8 20 8" />
              </svg>
              Export XLSX
            </div>
            <div class="export-opt" onclick="exportPDF()">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                <polyline points="14 2 14 8 20 8" />
                <line x1="9" y1="13" x2="15" y2="13" />
                <line x1="9" y1="17" x2="15" y2="17" />
              </svg>
              Export PDF
            </div>
          </div>
        </div>

        <!-- Recycle Bin -->
        <button class="recycle-btn" onclick="openBin()" title="Recycle Bin">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M3 6h18M8 6V4h8v2M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
            <path d="M10 11v6M14 11v6" />
          </svg>
          <span>Recycle Bin</span>
          <span class="recycle-badge hidden" id="bin-badge">0</span>
        </button>

      </div>

      <div class="header-right">
        <!-- Admin dropdown -->
        <div class="admin-menu-wrap">
          <button class="admin-btn" onclick="toggleAdminDrop(event)" title="Account">
            <span>👤</span>
            <span>{{ explode(' ', Auth::user()->name)[0] }}</span>
          </button>
          <div class="admin-dropdown" id="admin-dropdown">
            <div class="admin-dropdown-item admin-fullname">{{ Auth::user()->name }}</div>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="admin-dropdown-item admin-logout">Log out</button>
            </form>
          </div>
        </div>

        <!-- Theme Toggle -->
        <div class="theme-toggle" onclick="toggleTheme()" title="Toggle theme">
          <div class="toggle-icons">
            <span id="theme-icon-sun">🌙</span>
            <span id="theme-icon-moon" style="display:none">☀️</span>
          </div>
          <div class="toggle-track">
            <div class="toggle-thumb"></div>
          </div>
          <span class="toggle-label" id="theme-label">Dark</span>
        </div>

        <!-- Add Client -->
        <button class="add-btn" onclick="openModal()">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />
          </svg>
          Add Client
        </button>
      </div>
    </div>

    <!-- ══ SEARCH & FILTER BAR ══ -->
    <div class="filter-bar">
      <div class="search-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8" />
          <line x1="21" y1="21" x2="16.65" y2="16.65" />
        </svg>
        <input class="search-input" id="search-input" type="text" placeholder="Search clients…"
          oninput="applyFilters()" />
      </div>
      <div class="filter-divider"></div>
      <span class="filter-label">UI/UX</span>
      <div class="filter-pills">
        <div class="fpill f-done" onclick="toggleFilter('uiux_status','Done')" id="fpill-uiux-done">Done</div>
        <div class="fpill f-hold" onclick="toggleFilter('uiux_status','On Hold')" id="fpill-uiux-hold">On Hold</div>
        <div class="fpill f-rev" onclick="toggleFilter('uiux_status','Revisions')" id="fpill-uiux-rev">Revisions</div>
      </div>
      <div class="filter-divider"></div>
      <span class="filter-label">Dev</span>
      <div class="filter-pills">
        <div class="fpill f-done" onclick="toggleFilter('dev_status','Done')" id="fpill-dev-done">Done</div>
        <div class="fpill f-hold" onclick="toggleFilter('dev_status','On Hold')" id="fpill-dev-hold">On Hold</div>
        <div class="fpill f-rev" onclick="toggleFilter('dev_status','Revisions')" id="fpill-dev-rev">Revisions</div>
      </div>
      <div class="filter-divider"></div>
      <span class="filter-label">Stage</span>
      <div class="filter-pills">
        <div class="fpill" onclick="toggleFilter('stage','Homepage')" id="fpill-hp">Homepage</div>
        <div class="fpill" onclick="toggleFilter('stage','Sitemap')" id="fpill-sm">Sitemap</div>
        <div class="fpill" onclick="toggleFilter('stage','All Pages')" id="fpill-ap">All Pages</div>
        <div class="fpill" onclick="toggleFilter('stage','Final Homepage')" id="fpill-fh">Final</div>
      </div>
      <button class="filter-clear" id="filter-clear" onclick="clearFilters()">
        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="18" y1="6" x2="6" y2="18" />
          <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
        Clear
      </button>
    </div>

    <!-- ══ TABLE ══ -->
    <div class="table-wrap">
      <table>
        <colgroup>
          <col style="width:64px">
          <col style="width:145px">
          <col style="width:220px">
          <col style="width:150px">
          <col style="width:160px">
          <col style="width:175px">
          <col style="width:135px">
          <col style="width:115px">
          <col style="width:120px">
          <col style="width:220px">
        </colgroup>
        <thead>
          <tr>
            <!-- FIX: Delete column header background matched to adjacent boxes -->
            <th
              style="background:var(--surface2);border-bottom:1px solid var(--border);border-right:1px solid var(--border);">
              <div class="delete-th-inner">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                  <polyline points="3 6 5 6 21 6" />
                  <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                  <path d="M10 11v6M14 11v6" />
                  <path d="M9 6V4h6v2" />
                </svg>
                <span class="delete-th-label">Delete</span>
              </div>
            </th>
            <th
              style="background:var(--surface2);padding:9px 14px 6px;font-size:.6rem;letter-spacing:.16em;text-transform:uppercase;font-weight:600;border-bottom:1px solid var(--border);color:var(--muted2);">
            </th>
            <th colspan="2" class="group-proposal col-sep"
              style="background:var(--surface2);padding:9px 14px 6px;font-size:.6rem;letter-spacing:.16em;text-transform:uppercase;font-weight:600;text-align:center;border-bottom:1px solid var(--border);">
              📋 Proposal Phase</th>
            <th colspan="2"
              style="background:var(--surface2);padding:9px 14px 6px;font-size:.6rem;letter-spacing:.16em;text-transform:uppercase;font-weight:600;text-align:center;border-bottom:1px solid var(--border);border-left:1px solid var(--border);color:var(--accent);">
              🎨 UI/UX</th>
            <th colspan="4" class="group-dev col-sep"
              style="background:var(--surface2);padding:9px 14px 6px;font-size:.6rem;letter-spacing:.16em;text-transform:uppercase;font-weight:600;text-align:center;border-bottom:1px solid var(--border);">
              ⚙ Development Phase</th>
            <th colspan="1" class="group-final"
              style="background:var(--surface2);padding:9px 14px 6px;font-size:.6rem;letter-spacing:.16em;text-transform:uppercase;font-weight:600;text-align:center;border-bottom:1px solid var(--border);border-left:1px solid var(--border);color:var(--onhold);">
              ⊞ Final</th>
          </tr>
          <tr>
            <th class="delete-th" style="background:var(--surface3);border-bottom:2px solid var(--border);"></th>

            <!-- Sortable: Client Name -->
            <th class="sortable" onclick="sortTable('client')" title="Sort by Client">
              Client Name
              <span class="sort-indicator" id="sort-client"><svg viewBox="0 0 10 6" class="si-up">
                  <path d="M1 5l4-4 4 4" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" />
                </svg><svg viewBox="0 0 10 6" class="si-down">
                  <path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" />
                </svg></span>
            </th>

            <!-- Proposal Phase columns -->
            <th class="col-sep">
              <div class="subhead"><span class="subhead-dot sd-proposal"></span>Proposal Status</div>
            </th>
            <th class="col-sep">Proposal Remarks</th>

            <!-- UI/UX Assigned & Status — NO divider between them, merged feel -->
            <th class="col-sep" style="border-right:none !important;">
              UI/UX Assigned
            </th>
            <th style="border-left:none !important;">
              <div class="subhead"><span class="subhead-dot sd-proposal"></span>UI/UX Status</div>
            </th>

            <!-- Dev Phase columns — separator here to divide from Proposal -->
            <th class="col-sep" style="border-right:none !important;">Dev Assigned</th>
            <th style="border-left:none !important;">
              <div class="subhead"><span class="subhead-dot sd-dev"></span>Status</div>
            </th>
            <th>Progress</th>

            <!-- Overall Status -->
            <th>
              <div class="subhead"><span class="subhead-dot sd-status"></span>Dev Status</div>
            </th>

            <!-- Final Remarks -->
            <th style="border-left:1px solid var(--border);padding:10px 14px;text-align:left;">Final Remarks</th>
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

  <!-- ══ ARCHIVE DRAWER ══ -->
  <div class="archive-drawer-overlay" id="archive-overlay" onclick="closeArchive()"></div>
  <div class="archive-drawer" id="archive-drawer">
    <div class="archive-drawer-header">
      <div class="archive-drawer-title">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round">
          <polyline points="21 8 21 21 3 21 3 8" />
          <rect x="1" y="3" width="22" height="5" />
          <line x1="10" y1="12" x2="14" y2="12" />
        </svg>
        <h2>Archive</h2>
        <span class="archive-count-pill" id="archive-count-pill">0 items</span>
      </div>
      <button class="archive-close-btn" onclick="closeArchive()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M18 6 6 18M6 6l12 12" />
        </svg>
      </button>
    </div>
    <div class="archive-drawer-body" id="archive-body"></div>
    <div class="archive-drawer-footer">
      <div class="archive-footer-note">Archived records are stored here.<br>Restore anytime to bring them back.</div>
    </div>
  </div>

  <!-- ══ RECYCLE BIN DRAWER ══ -->
  <div class="bin-drawer-overlay" id="bin-overlay" onclick="closeBin()"></div>
  <div class="bin-drawer" id="bin-drawer">
    <div class="bin-drawer-header">
      <div class="bin-drawer-title">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round">
          <path d="M3 6h18M8 6V4h8v2M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
          <path d="M10 11v6M14 11v6" />
        </svg>
        <h2>Recycle Bin</h2>
        <span class="bin-count-pill" id="bin-count-pill">0 items</span>
      </div>
      <button class="bin-close-btn" onclick="closeBin()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M18 6 6 18M6 6l12 12" />
        </svg>
      </button>
    </div>
    <div class="bin-drawer-body" id="bin-body"></div>
    <div class="bin-drawer-footer">
      <div class="bin-footer-note">Deleted records are kept here.<br>Restore anytime or empty to permanently remove.
      </div>
      <button class="btn-empty-bin" onclick="emptyBin()">Empty Bin 🗑</button>
    </div>
  </div>

  <!-- ══ ACTIVITY LOG DRAWER ══ -->
  <div class="log-drawer-overlay" id="log-overlay" onclick="closeLog()"></div>
  <div class="log-drawer" id="log-drawer">
    <div class="log-drawer-header">
      <div class="log-drawer-title">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
          <polyline points="14 2 14 8 20 8" />
          <line x1="16" y1="13" x2="8" y2="13" />
          <line x1="16" y1="17" x2="8" y2="17" />
        </svg>
        <h2>Activity Log</h2>
      </div>
      <button class="log-close-btn" onclick="closeLog()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M18 6 6 18M6 6l12 12" />
        </svg>
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

      <div class="modal-header-section">
        <div class="modal-header-content">
          <div class="modal-header-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path
                d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" />
            </svg>
          </div>
          <div class="modal-header-text">
            <h2>Add New Client</h2>
            <p>Fill in the details across each project phase</p>
          </div>
        </div>
        <button class="bin-close-btn" onclick="closeModal()">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path d="M18 6 6 18M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Client Name -->
      <div class="form-group full" style="margin-bottom:18px;">
        <label>Client Name</label>
        <input type="text" id="f-client" placeholder="e.g. Acme Corp" />
      </div>

      <!-- PROPOSAL PHASE -->
      <div class="modal-phase-block" style="--phase-color:var(--accent);">
        <div class="modal-phase-header">
          <span class="modal-phase-dot" style="background:var(--accent);"></span>
          <span class="modal-phase-label">Proposal Phase</span>
        </div>
        <div class="modal-phase-fields" style="grid-template-columns:1fr 1fr;">
          <div class="form-group">
            <label>Proposal Stage</label>
            <select id="f-stage">
              <option>Sitemap</option>
              <option>Homepage</option>
              <option>All Pages</option>
              <option>Final Homepage</option>
            </select>
          </div>
          <div class="form-group">
            <label>Proposal Remarks</label>
            <input type="text" id="f-prop-remark" placeholder="Notes about this proposal..." />
          </div>
        </div>
      </div>

      <!-- UI/UX PHASE -->
      <div class="modal-phase-block" style="--phase-color:var(--accent2);">
        <div class="modal-phase-header">
          <span class="modal-phase-dot" style="background:var(--accent2);"></span>
          <span class="modal-phase-label">UI/UX</span>
        </div>
        <div class="modal-phase-fields" style="grid-template-columns:1fr 1fr 1fr;">
          <div class="form-group">
            <label>UI/UX Assigned</label>
            <div class="autocomplete-wrap">
              <input type="text" id="f-uiux-assign" class="mobile-input" placeholder="Type a name…" autocomplete="off"
                oninput="acInput('f-uiux-assign','ac-uiux-assign','uiux')"
                onfocus="acInput('f-uiux-assign','ac-uiux-assign','uiux')"
                onblur="setTimeout(()=>acClose('ac-uiux-assign'),150)">
              <div class="ac-dropdown" id="ac-uiux-assign"></div>
            </div>
          </div>
          <div class="form-group">
            <label>UI/UX Status</label>
            <select id="f-uiux-status">
              <option>On Hold</option>
              <option>Done</option>
              <option>Revisions</option>
            </select>
          </div>
          <div class="form-group">
            <label>UI/UX Due Date</label>
            <input type="date" id="f-uiux-due" />
          </div>
        </div>
      </div>

      <!-- DEVELOPMENT PHASE -->
      <div class="modal-phase-block" style="--phase-color:var(--accent3);">
        <div class="modal-phase-header">
          <span class="modal-phase-dot" style="background:var(--accent3);"></span>
          <span class="modal-phase-label">Development Phase</span>
        </div>
        <div class="modal-phase-fields" style="grid-template-columns:1fr 1fr;">
          <div class="form-group">
            <label>Dev Assigned</label>
            <div class="autocomplete-wrap">
              <input type="text" id="f-dev-assign" class="mobile-input" placeholder="Type a name…" autocomplete="off"
                oninput="acInput('f-dev-assign','ac-dev-assign','dev')"
                onfocus="acInput('f-dev-assign','ac-dev-assign','dev')"
                onblur="setTimeout(()=>acClose('ac-dev-assign'),150)">
              <div class="ac-dropdown" id="ac-dev-assign"></div>
            </div>
          </div>
          <div class="form-group">
            <label>Dev Due Date</label>
            <input type="date" id="f-dev-due" />
          </div>
          <div class="form-group">
            <label>Front-end Status</label>
            <select id="f-dev-fe">
              <option value="">—</option>
              <option>Done</option>
              <option>In Progress</option>
              <option>Pending</option>
            </select>
          </div>
          <div class="form-group">
            <label>Back-end Status</label>
            <select id="f-dev-be">
              <option value="">—</option>
              <option>Done</option>
              <option>In Progress</option>
              <option>Pending</option>
            </select>
          </div>
          <div class="form-group">
            <label>Frontend %</label>
            <div style="display:flex;align-items:center;gap:8px;">
              <input type="number" id="f-fe" min="0" max="100" placeholder="0–100" style="flex:0 0 80px;"
                oninput="this.value=Math.min(100,Math.max(0,parseInt(this.value)||0));updateModalBar('f-fe','mbar-fe')" />
              <div style="flex:1;height:5px;border-radius:99px;background:var(--border);overflow:hidden;">
                <div id="mbar-fe"
                  style="height:100%;width:0%;border-radius:99px;background:linear-gradient(90deg,var(--pink),var(--accent));transition:width .3s;">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Backend %</label>
            <div style="display:flex;align-items:center;gap:8px;">
              <input type="number" id="f-be" min="0" max="100" placeholder="0–100" style="flex:0 0 80px;"
                oninput="this.value=Math.min(100,Math.max(0,parseInt(this.value)||0));updateModalBar('f-be','mbar-be')" />
              <div style="flex:1;height:5px;border-radius:99px;background:var(--border);overflow:hidden;">
                <div id="mbar-be"
                  style="height:100%;width:0%;border-radius:99px;background:linear-gradient(90deg,var(--cream),var(--accent3));transition:width .3s;">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Overall Status</label>
            <select id="f-status">
              <option>On Hold</option>
              <option>Done</option>
              <option>Revisions</option>
            </select>
          </div>
        </div>
      </div>

      <!-- FINAL PHASE -->
      <div class="modal-phase-block" style="--phase-color:var(--onhold);">
        <div class="modal-phase-header">
          <span class="modal-phase-dot" style="background:var(--onhold);"></span>
          <span class="modal-phase-label">Final</span>
        </div>
        <div class="modal-phase-fields" style="grid-template-columns:1fr 1fr;">
          <div class="form-group">
            <label>Due Date</label>
            <input type="date" id="f-due" />
          </div>
          <div class="form-group">
            <label>Deployment Status</label>
            <select id="f-deployment-status">
              <option value="">— Not Set —</option>
              <option value="Deployed">Deployed</option>
              <option value="Not Deployed">Not Deployed</option>
            </select>
          </div>
          <div class="form-group" style="grid-column:1/-1;">
            <label>Final Remarks</label>
            <textarea id="f-final-remark" rows="2" placeholder="Closing notes, delivery status..."></textarea>
          </div>
        </div>
      </div>

      <div class="modal-actions">
        <button class="btn-cancel" onclick="closeModal()">Cancel</button>
        <button class="btn-save" onclick="addRow()">Add Client</button>
      </div>

    </div>
  </div>

  <!-- ══ CONFIRM ARCHIVE MODAL ══ -->
  <div class="confirm-overlay" id="confirm-archive-modal">
    <div class="confirm-box">
      <span class="bin-icon">🗂️</span>
      <h3>Move to Archive?</h3>
      <p>This will archive <strong id="confirm-archive-name"></strong>.<br>You can restore it anytime from the Archive.
      </p>
      <div class="confirm-actions">
        <button class="btn-confirm-cancel" onclick="closeArchiveConfirm()">Cancel</button>
        <button class="btn-confirm-delete" style="background:linear-gradient(135deg,var(--archive),#5a4aaf);"
          onclick="confirmArchive()">Move to Archive</button>
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
    const STAGES = ['Sitemap', 'Homepage', 'All Pages', 'Final Homepage'];
    const AV_COLORS = ['av1', 'av2', 'av3', 'av4'];
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;
    const ROUTES = {
      store: "{{ route('operations.store') }}",
      update: (id) => `/operations/${id}`,
      destroy: (id) => `/operations/${id}`,
      restore: (id) => `/operations/${id}/restore`,
      force: (id) => `/operations/${id}/force`,
      archive: (id) => `/operations/${id}/archive`,
      unarchive: (id) => `/operations/${id}/unarchive`,
      clearLogs: "{{ route('logs.clear') }}",
    };

    let rows = JSON.parse('<?= json_encode($rows, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>');
    let trash = JSON.parse('<?= json_encode($trash, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>');
    let archived = JSON.parse('<?= json_encode($archived, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>');
    let activityLog = JSON.parse('<?= json_encode($logs, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>');
    let pendingDeleteIdx = null;

    // Sort state
    let sortKey = null;
    let sortDir = 'asc';

    /* ════════════════════════════════════════════════
       HELPERS
    ════════════════════════════════════════════════ */
    function escHtml(s) {
      return String(s || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    }

    /* ════ ENTER TO SAVE INLINE EDITABLE FIELDS ════ */
    document.addEventListener('keydown', e => {
      if (e.key !== 'Enter') return;
      const el = e.target;
      if (!el.classList.contains('editable')) return;
      // Let remarks/final-text use Enter for new lines
      if (el.classList.contains('remark-text') || el.classList.contains('final-text')) return;
      e.preventDefault();
      el.blur(); // triggers the onblur save
    });

    function ini(n) {
      if (!n || n === '—' || n.trim() === '') return '?';
      return n.trim().split(/\s+/).map(w => w[0]).join('').toUpperCase().slice(0, 2);
    }

    function avc(s) {
      if (!s || s === '—') return 'av1';
      return AV_COLORS[s.charCodeAt(0) % 4];
    }

    function fmtTime(ts) {
      if (!ts) return '—';
      const date = typeof ts === 'number' ? new Date(ts) : new Date(ts);
      const diff = Date.now() - date.getTime(),
        mins = Math.floor(diff / 60000),
        hrs = Math.floor(diff / 3600000),
        days = Math.floor(diff / 84000000);
      if (mins < 1) return 'just now';
      if (mins < 60) return `${mins}m ago`;
      if (hrs < 24) return `${hrs}h ${mins % 60}m ago`;
      if (days < 7) return `${days}d ago`;
      return date.toLocaleDateString('en-US', {
        month: 'short',
        day: 'numeric'
      });
    }

    function fmtDateTime(ts) {
      if (!ts) return '';
      const date = typeof ts === 'number' ? new Date(ts) : new Date(ts);
      return date.toLocaleString('en-US', {
        month: 'short',
        day: 'numeric',
        hour: 'numeric',
        minute: '2-digit'
      });
    }

    /* ── Due date notification ── */
    function getDueDateNotification(dueDate) {
      if (!dueDate) return '';
      const due = new Date(dueDate + 'T00:00:00'),
        today = new Date();
      today.setHours(0, 0, 0, 0);
      const daysLeft = Math.floor((due - today) / (1000 * 60 * 60 * 24));
      const alertIcon = `<svg viewBox="0 0 24 24" fill="currentColor" width="12" height="12"><circle cx="12" cy="12" r="10"/><rect x="11" y="8" width="2" height="5" fill="white"/><rect x="11" y="14" width="2" height="2" fill="white"/></svg>`;
      const warnIcon = `<svg viewBox="0 0 24 24" fill="currentColor" width="12" height="12"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><rect x="11" y="9" width="2" height="5" fill="white"/><rect x="11" y="15" width="2" height="2" fill="white"/></svg>`;
      const checkIcon = `<svg viewBox="0 0 24 24" fill="currentColor" width="12" height="12"><circle cx="12" cy="12" r="10"/><path d="M9 12l2 2 4-4" stroke="white" stroke-width="2" fill="none" stroke-linecap="round"/></svg>`;
      if (daysLeft < 0) return `<div class="due-notification">${alertIcon} Overdue by ${Math.abs(daysLeft)} day${Math.abs(daysLeft) !== 1 ? 's' : ''}</div>`;
      if (daysLeft === 0) return `<div class="due-notification">${alertIcon} Due today!</div>`;
      if (daysLeft === 1) return `<div class="due-notification">${alertIcon} Due tomorrow</div>`;
      if (daysLeft <= 7) return `<div class="due-notification warning">${warnIcon} Due in ${daysLeft} days</div>`;
      return `<div class="due-notification safe">${checkIcon} On schedule</div>`;
    }

    const SVG_CHECK = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" width="10" height="10"><polyline points="20 6 9 17 4 12"/></svg>`;
    const SVG_ARROW = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="10" height="10"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="13 6 19 12 13 18"/></svg>`;
    const SVG_CIRC = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="8" height="8"><circle cx="12" cy="12" r="4"/></svg>`;

    function buildSteps(stage) {
      const ci = STAGES.indexOf(stage);
      return STAGES.map((s, i) => {
        let cls, icon;
        if (i < ci) {
          cls = 'done';
          icon = SVG_CHECK;
        } else if (i === ci) {
          cls = 'active';
          icon = SVG_ARROW;
        } else {
          cls = 'pending';
          icon = SVG_CIRC;
        }
        return `<div class="step ${cls}"><div class="step-check">${icon}</div><span>${escHtml(s)}</span></div>`;
      }).join('');
    }

    function statusCls(s) {
      return {
        Done: 's-done',
        'On Hold': 's-onhold',
        Revisions: 's-revision'
      }[s] || 's-onhold';
    }

    function uiuxBadgeHtml(s, idx) {
      const opts = ['Done', 'On Hold', 'Revisions'].map(o => `<div class="status-opt" onclick="setUiuxStatus(${idx},'${o}',event)"><span class="sopt-dot" style="background:${o === 'Done' ? 'var(--done)' : o === 'On Hold' ? 'var(--onhold)' : 'var(--revision)'}"></span>${o}</div>`).join('');
      return `<div class="status-select-wrap"><div class="status-badge ${statusCls(s)}" onclick="toggleUiuxDrop(${idx},event)"><span class="badge-dot"></span>${escHtml(s)}</div><div class="status-dropdown" id="uiux-sdrop-${idx}">${opts}</div></div>`;
    }

    function toggleUiuxDrop(i, e) {
      e.stopPropagation();
      document.querySelectorAll('.status-dropdown').forEach(d => {
        if (d.id !== `uiux-sdrop-${i}`) d.classList.remove('open');
      });
      document.getElementById(`uiux-sdrop-${i}`).classList.toggle('open');
    }

    function setUiuxStatus(i, val, e) {
      e.stopPropagation();
      const old = rows[i].uiux_status;
      if (old === val) {
        document.getElementById('uiux-sdrop-' + i).classList.remove('open');
        return;
      }
      rows[i].uiux_status = val;
      document.getElementById('uiux-sdrop-' + i).classList.remove('open');
      const badge = document.querySelector(`#row-${i} #uiux-sdrop-${i}`).parentNode;
      if (badge) badge.innerHTML = uiuxBadgeHtml(val, i);
      ajaxPatch(i, 'uiux_status', val);
      logActivity('status', `UI/UX Status changed for ${rows[i].client}`, `${old} → ${val}`);
      toast(`UI/UX Status → ${val} ✓`);
    }

    function badgeHtml(s, idx) {
      const opts = ['Done', 'On Hold', 'Revisions'].map(o => `<div class="status-opt" onclick="setStatus(${idx},'${o}',event)"><span class="sopt-dot" style="background:${o === 'Done' ? 'var(--done)' : o === 'On Hold' ? 'var(--onhold)' : 'var(--revision)'}"></span>${o}</div>`).join('');
      return `<div class="status-select-wrap"><div class="status-badge ${statusCls(s)}" onclick="toggleDrop(${idx},event)"><span class="badge-dot"></span>${escHtml(s)}</div><div class="status-dropdown" id="sdrop-${idx}">${opts}</div></div>`;
    }

    function dueFmt(d) {
      if (!d) return '';
      const dt = new Date(d + 'T00:00:00'),
        over = dt < new Date();
      const str = dt.toLocaleDateString('en-US', {
        month: 'short',
        day: 'numeric',
        year: 'numeric'
      });
      return `<div class="due-date${over ? ' due-overdue' : ''}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>${str}${over ? ' ⚠' : ''}</div>`;
    }

    function finalDateFmt(d) {
      if (!d) return '';
      const dt = new Date(d + 'T00:00:00');
      return `${String(dt.getDate()).padStart(2, '0')}/${String(dt.getMonth() + 1).padStart(2, '0')}/${dt.getFullYear()}`;
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

    function logActivity(type, message, detail = '') {
      activityLog.unshift({
        type,
        message,
        detail,
        ts: Date.now()
      });
      if (activityLog.length > 200) activityLog.pop();
      updateLogBadge();
    }

    let logLastSeenCount = activityLog.length;

    function updateLogBadge() {
      const badge = document.getElementById('log-badge');
      const unseen = activityLog.length - logLastSeenCount;
      if (unseen > 0) {
        badge.textContent = unseen > 99 ? '99+' : unseen;
        badge.classList.remove('hidden');
      } else {
        badge.classList.add('hidden');
      }
    }

    function openLog() {
      document.getElementById('log-overlay').classList.add('open');
      document.getElementById('log-drawer').classList.add('open');
      logLastSeenCount = activityLog.length;
      updateLogBadge();
      renderLog();
    }

    function closeLog() {
      document.getElementById('log-overlay').classList.remove('open');
      document.getElementById('log-drawer').classList.remove('open');
    }

    function renderLog() {
      const body = document.getElementById('log-body');
      if (activityLog.length === 0) {
        body.innerHTML = `<div class="log-empty"><div class="log-empty-icon">📋</div><p>No activity yet.<br>Edits and changes will appear here.</p></div>`;
        return;
      }
      body.innerHTML = activityLog.map((e, i) => {
        const color = LOG_COLORS[e.type] || 'var(--muted)';
        const time = e.created_at || e.ts;
        return `<div class="log-entry" style="animation-delay:${i * .03}s">
      <div class="log-dot-col">
        <div class="log-dot" style="background:${color};border-color:${color}"></div>
        <div class="log-line"></div>
      </div>
      <div class="log-content">
        <div class="log-action">${escHtml(e.message)}</div>
        ${e.detail ? `<div class="log-detail">${escHtml(e.detail)}</div>` : ''}
        <div class="log-time"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>${fmtDateTime(time)}</div>
      </div>
    </div>`;
      }).join('');
    }

    async function clearLog() {
      if (!activityLog.length) return;
      document.getElementById('confirm-clear-logs-modal').classList.add('open');
    }

    function closeClearLogsConfirm() {
      document.getElementById('confirm-clear-logs-modal').classList.remove('open');
    }

    async function confirmClearLogs() {
      closeClearLogsConfirm();

      // Mas safe gamitin ang direct string path '/activity-logs/clear'
      const res = await fetch('/activity-logs/clear', {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json'
        }
      });

      const data = await res.json();

      if (res.ok && data.success) {
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
    function sortTable(key) {
      if (sortKey === key) {
        sortDir = sortDir === 'asc' ? 'desc' : 'asc';
      } else {
        sortKey = key;
        sortDir = 'asc';
      }
      // Update sort indicators
      document.querySelectorAll('.sort-indicator').forEach(el => {
        el.classList.remove('asc', 'desc');
      });
      const ind = document.getElementById('sort-' + key);
      if (ind) ind.classList.add(sortDir);

      rows.sort((a, b) => {
        let av = a[key] || '',
          bv = b[key] || '';
        if (key === 'fe' || key === 'be') {
          av = parseInt(av) || 0;
          bv = parseInt(bv) || 0;
          return sortDir === 'asc' ? av - bv : bv - av;
        }
        if (key === 'due') {
          av = av ? new Date(av).getTime() : 0;
          bv = bv ? new Date(bv).getTime() : 0;
          return sortDir === 'asc' ? av - bv : bv - av;
        }
        const cmp = String(av).localeCompare(String(bv));
        if (key === 'client') {
          return sortDir === 'asc' ? -cmp : cmp;
        }
        return sortDir === 'asc' ? cmp : -cmp;
      });
      renderTable();
      toast(`Sorted by ${key} (${sortDir})`);
    }

    /* ════════════════════════════════════════════════
       EXPORT
    ════════════════════════════════════════════════ */
    function toggleExportDrop(e) {
      e.stopPropagation();
      document.getElementById('export-dropdown').classList.toggle('open');
    }

    function toggleAdminDrop(e) {
      e.stopPropagation();
      document.getElementById('admin-dropdown').classList.toggle('open');
    }

    function exportXLSX() {
      document.getElementById('export-dropdown').classList.remove('open');
      showLoading('Generating XLSX…');
      setTimeout(() => {
        const headers = ['Client', 'Tag', 'Stage', 'Proposal Assigned', 'Proposal Remarks', 'UI/UX Assigned', 'UI/UX Status', 'Dev Assigned', 'FE Status', 'BE Status', 'FE%', 'BE%', 'Status', 'Due Date', 'Final Remarks'];
        const data = [headers];
        const visible = rows.filter((_, i) => {
          const tr = document.getElementById('row-' + i);
          return !tr || tr.style.display !== 'none';
        });
        visible.forEach(r => {
          data.push([
            r.client || '',
            r.tag || '',
            r.stage || '',
            r.prop_assign || '',
            r.prop_remark || '',
            r.uiux_assign || '',
            r.uiux_status || '',
            r.dev_assign || '',
            r.dev_fe || '',
            r.dev_be || '',
            r.fe || 0,
            r.be || 0,
            r.status || '',
            r.due || '',
            r.final_remark || ''
          ]);
        });

        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet(data);
        XLSX.utils.book_append_sheet(wb, ws, "Operations");
        XLSX.writeFile(wb, `operations_${new Date().toISOString().split('T')[0]}.xlsx`);

        hideLoading();
        logActivity('edit', 'Exported XLSX', `${visible.length} records exported`);
        toast('XLSX exported ✓');
      }, 400);
    }

    async function exportPDF() {
      document.getElementById('export-dropdown').classList.remove('open');
      showLoading('Generating PDF…');

      const { jsPDF } = window.jspdf;
      const doc = new jsPDF({ orientation: 'landscape', unit: 'mm', format: 'a4' });

      const visible = rows.filter((_, i) => {
        const tr = document.getElementById('row-' + i);
        return !tr || tr.style.display !== 'none';
      });

      const pageW = doc.internal.pageSize.getWidth();
      const pageH = doc.internal.pageSize.getHeight();

      const statusColor = s => {
        if (s === 'Done') return [90, 154, 106];
        if (s === 'On Hold') return [176, 128, 32];
        if (s === 'Revisions') return [201, 96, 112];
        return [160, 128, 112];
      };

      const deployColor = s => {
        if (s === 'Deployed') return [90, 154, 106];
        if (s === 'Not Deployed') return [176, 128, 32];
        return [160, 128, 112];
      };

      const drawPage = (pageRows, pageNum, totalPages) => {
        // Background
        doc.setFillColor(253, 246, 240);
        doc.rect(0, 0, pageW, pageH, 'F');

        // Top accent bar
        doc.setFillColor(201, 99, 122);
        doc.rect(0, 0, pageW, 1.2, 'F');

        // Header bg
        doc.setFillColor(255, 248, 245);
        doc.roundedRect(10, 5, pageW - 20, 22, 3, 3, 'F');

        // Title
        doc.setFont('helvetica', 'bold');
        doc.setFontSize(14);
        doc.setTextColor(201, 99, 122);
        doc.text('Operations Monitoring', 16, 13);

        // Subtitle
        doc.setFont('helvetica', 'normal');
        doc.setFontSize(7);
        doc.setTextColor(160, 128, 112);
        doc.text('Web Development Pipeline', 16, 19);

        // Right side meta
        const now = new Date();
        const dateStr = now.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
        doc.setFontSize(7);
        doc.text(`Exported: ${dateStr}`, pageW - 14, 11, { align: 'right' });
        doc.text(`${visible.length} record${visible.length !== 1 ? 's' : ''} · Page ${pageNum} of ${totalPages}`, pageW - 14, 17, { align: 'right' });

        // Summary pills (only on page 1)
        if (pageNum === 1) {
          const doneCount = visible.filter(r => r.status === 'Done').length;
          const holdCount = visible.filter(r => r.status === 'On Hold').length;
          const revCount = visible.filter(r => r.status === 'Revisions').length;
          const pills = [
            { label: `Done  ${doneCount}`, color: [90, 154, 106] },
            { label: `On Hold  ${holdCount}`, color: [176, 128, 32] },
            { label: `Revisions  ${revCount}`, color: [201, 96, 112] },
          ];
          let px = 16;
          doc.setFontSize(6.5);
          pills.forEach(p => {
            const tw = doc.getTextWidth(p.label) + 8;
            doc.setFillColor(...p.color);
            doc.roundedRect(px, 23, tw, 4.5, 1.2, 1.2, 'F');
            doc.setFont('helvetica', 'bold');
            doc.setTextColor(255, 255, 255);
            doc.text(p.label, px + 4, 26.2);
            px += tw + 2.5;
          });
        }

        // Divider
        doc.setDrawColor(232, 213, 196);
        doc.setLineWidth(0.3);
        doc.line(10, 30, pageW - 10, 30);
      };

      // Build table data
      const head = [[
        'Client', 'Stage', 'Proposal Remarks',
        'UI/UX', 'UI/UX Due',
        'Dev', 'FE%', 'BE%', 'Dev Status', 'Dev Due',
        'Status', 'Deploy', 'Final Due', 'Final Remarks'
      ]];

      const body = visible.map(r => {
        const fmtDate = d => d ? new Date(d + 'T00:00:00').toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : '—';
        return [
          (r.client || '') + (r.tag ? `\n${r.tag}` : ''),
          r.stage || '',
          r.prop_remark || '',
          (r.uiux_assign && r.uiux_assign !== '—' ? r.uiux_assign : '—') + '\n' + (r.uiux_status || ''),
          fmtDate(r.uiux_due),
          (r.dev_assign && r.dev_assign !== '—' ? r.dev_assign : '—'),
          `${r.fe || 0}%`,
          `${r.be || 0}%`,
          (r.dev_fe || '—') + ' / ' + (r.dev_be || '—'),
          fmtDate(r.dev_due),
          r.status || '',
          r.deployment_status || '—',
          fmtDate(r.due),
          r.final_remark || ''
        ];
      });

      // Detect page count (rough estimate to pre-label pages)
      let pageNum = 1;
      let totalPages = 1; // jsPDF doesn't pre-calculate, so we patch post-render

      drawPage(body, 1, '?');

      doc.autoTable({
        head,
        body,
        startY: 33,
        margin: { left: 8, right: 8 },
        tableWidth: 'auto',
        styles: {
          font: 'helvetica',
          fontSize: 7,
          cellPadding: { top: 3.5, bottom: 3.5, left: 3, right: 3 },
          valign: 'middle',
          overflow: 'linebreak',
          textColor: [61, 43, 34],
          lineColor: [232, 213, 196],
          lineWidth: 0.2,
          minCellHeight: 12,
        },
        headStyles: {
          fillColor: [242, 230, 213],
          textColor: [122, 92, 80],
          fontStyle: 'bold',
          fontSize: 6.5,
          cellPadding: { top: 4, bottom: 4, left: 3, right: 3 },
          halign: 'center',
        },
        columnStyles: {
          0: { cellWidth: 22, halign: 'left' },    // Client
          1: { cellWidth: 18, halign: 'center' },   // Stage
          2: { cellWidth: 24, halign: 'left' },     // Proposal Remarks
          3: { cellWidth: 22, halign: 'center' },   // UI/UX
          4: { cellWidth: 18, halign: 'center' },   // UI/UX Due
          5: { cellWidth: 18, halign: 'center' },   // Dev
          6: { cellWidth: 12, halign: 'center' },   // FE%
          7: { cellWidth: 12, halign: 'center' },   // BE%
          8: { cellWidth: 22, halign: 'center' },   // Dev Status
          9: { cellWidth: 18, halign: 'center' },   // Dev Due
          10: { cellWidth: 18, halign: 'center' },   // Status
          11: { cellWidth: 18, halign: 'center' },   // Deploy
          12: { cellWidth: 18, halign: 'center' },   // Final Due
          13: { cellWidth: 'auto', halign: 'left' }, // Final Remarks
        },
        alternateRowStyles: { fillColor: [255, 252, 250] },
        rowPageBreak: 'avoid',

        // Draw header on every new page
        didDrawPage(data) {
          pageNum = data.pageNumber;
          if (pageNum > 1) {
            drawPage([], pageNum, '?');
          }
          // Footer line
          doc.setDrawColor(232, 213, 196);
          doc.setLineWidth(0.25);
          doc.line(8, pageH - 7, pageW - 8, pageH - 7);
          doc.setFont('helvetica', 'normal');
          doc.setFontSize(6);
          doc.setTextColor(160, 128, 112);
          doc.text('Operations Monitoring · Web Development Pipeline', 8, pageH - 4);
          doc.text(`Page ${pageNum}`, pageW - 8, pageH - 4, { align: 'right' });
        },

        didParseCell(data) {
          // Hide raw text for progress % cols — drawn custom
          if (data.section === 'body' && (data.column.index === 6 || data.column.index === 7)) {
            data.cell.styles.textColor = [253, 246, 240];
            data.cell.styles.minCellHeight = 14;
          }
        },

        didDrawCell(data) {
          if (data.section !== 'body') return;
          const { x, y, width, height } = data.cell;

          // ── Status badge (col 10)
          if (data.column.index === 10) {
            const val = data.cell.raw;
            const [r, g, b] = statusColor(val);
            const bw = Math.min(width - 4, 20), bh = 5.5;
            const bx = x + (width - bw) / 2, by = y + (height - bh) / 2;
            doc.setFillColor(r, g, b);
            doc.roundedRect(bx, by, bw, bh, 1.5, 1.5, 'F');
            doc.setFont('helvetica', 'bold');
            doc.setFontSize(6);
            doc.setTextColor(255, 255, 255);
            doc.text(val, bx + bw / 2, by + bh / 2 + 0.4, { align: 'center', baseline: 'middle' });
          }

          // ── Deployment badge (col 11)
          if (data.column.index === 11) {
            const val = data.cell.raw;
            if (val && val !== '—') {
              const [r, g, b] = deployColor(val);
              const label = val === 'Deployed' ? 'Deployed' : 'Not Yet';
              const bw = Math.min(width - 4, 22), bh = 5.5;
              const bx = x + (width - bw) / 2, by = y + (height - bh) / 2;
              doc.setFillColor(r, g, b, 0.15);
              doc.setDrawColor(r, g, b);
              doc.setLineWidth(0.3);
              doc.roundedRect(bx, by, bw, bh, 1.5, 1.5, 'FD');
              doc.setFont('helvetica', 'bold');
              doc.setFontSize(6);
              doc.setTextColor(r, g, b);
              doc.text(label, bx + bw / 2, by + bh / 2 + 0.4, { align: 'center', baseline: 'middle' });
            }
          }

          // ── FE% progress bar (col 6)
          if (data.column.index === 6) {
            const val = parseInt(data.cell.raw) || 0;
            const barW = width - 6, barH = 2.5;
            const bx = x + 3, labelY = y + (height / 2) - 2, barY = y + (height / 2) + 2;
            doc.setFont('helvetica', 'bold'); doc.setFontSize(7); doc.setTextColor(61, 43, 34);
            doc.text(`${val}%`, x + width / 2, labelY, { align: 'center', baseline: 'middle' });
            doc.setFillColor(232, 213, 196);
            doc.roundedRect(bx, barY, barW, barH, 1, 1, 'F');
            if (val > 0) {
              doc.setFillColor(201, 99, 122);
              doc.roundedRect(bx, barY, (barW * val) / 100, barH, 1, 1, 'F');
            }
          }

          // ── BE% progress bar (col 7)
          if (data.column.index === 7) {
            const val = parseInt(data.cell.raw) || 0;
            const barW = width - 6, barH = 2.5;
            const bx = x + 3, labelY = y + (height / 2) - 2, barY = y + (height / 2) + 2;
            doc.setFont('helvetica', 'bold'); doc.setFontSize(7); doc.setTextColor(61, 43, 34);
            doc.text(`${val}%`, x + width / 2, labelY, { align: 'center', baseline: 'middle' });
            doc.setFillColor(232, 213, 196);
            doc.roundedRect(bx, barY, barW, barH, 1, 1, 'F');
            if (val > 0) {
              doc.setFillColor(176, 112, 96);
              doc.roundedRect(bx, barY, (barW * val) / 100, barH, 1, 1, 'F');
            }
          }

          // ── UI/UX status dot (col 3)
          if (data.column.index === 3) {
            const parts = data.cell.raw.split('\n');
            const statusVal = parts[1] || '';
            if (statusVal) {
              const [r, g, b] = statusColor(statusVal);
              doc.setFillColor(r, g, b);
              doc.circle(x + 4, y + height / 2, 1.2, 'F');
            }
          }
        },
      });

      hideLoading();
      logActivity('edit', 'Exported PDF', `${visible.length} records exported`);
      toast('PDF downloaded ✓');
      doc.save(`operations_${new Date().toISOString().split('T')[0]}.pdf`);
    }

    function showLoading(msg = 'Loading…') {
      document.getElementById('loading-msg').textContent = msg;
      document.getElementById('loading-overlay').classList.add('open');
    }

    function hideLoading() {
      document.getElementById('loading-overlay').classList.remove('open');
    }

    document.addEventListener('click', () => {
      document.getElementById('export-dropdown').classList.remove('open');
      const adminDropdown = document.getElementById('admin-dropdown');
      if (adminDropdown) adminDropdown.classList.remove('open');
    });

    /* ════════════════════════════════════════════════
       RENDER ROW
    ════════════════════════════════════════════════ */
    function renderRow(r, i, anim = false) {
      return `<tr id="row-${i}" data-id="${r.id}"${anim ? ' class="row-enter"' : ''}>
      <td class="action-cell">
    <div class="action-cell-inner">
      <button class="archive-row-btn" onclick="askArchive(${i})" title="Move to Archive">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="21 8 21 21 3 21 3 8"/><rect x="1" y="3" width="22" height="5"/><line x1="10" y1="12" x2="14" y2="12"/>
        </svg>
      </button>
      <button class="trash-btn" onclick="askDelete(${i})" title="Move to Recycle Bin">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
          <path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/>
        </svg>
      </button>
    </div>
  </td>
    <td>
      <div class="client-name editable" contenteditable="true" spellcheck="false" onblur="save(${i},'client',this)">${escHtml(r.client)}</div>
      <div class="client-tag editable" contenteditable="true" spellcheck="false" onblur="save(${i},'tag',this)">${escHtml(r.tag)}</div>
    </td>
    <td class="col-sep">
      <div class="steps">${buildSteps(r.stage)}</div>
      <select class="stage-select" onchange="saveVal(${i},'stage',this.value)">
        ${STAGES.map(s => `<option${r.stage === s ? ' selected' : ''}>${escHtml(s)}</option>`).join('')}
      </select>
    </td>
    
    <td class="col-sep">
     <div class="remark-text editable" contenteditable="true" spellcheck="false" data-placeholder="Add remarks..." onblur="save(${i},'prop_remark',this)">${escHtml(r.prop_remark)}</div>
    </td>
    
    <td class="col-sep" style="border-right:none !important;">
      <div class="assignee"><div class="avatar ${avc(r.uiux_assign)}" id="uav-${i}">${ini(r.uiux_assign)}</div>
        <span class="assignee-name editable" contenteditable="true" spellcheck="false" onblur="save(${i},'uiux_assign',this);rerenderAv('u',${i})" data-placeholder="Name...">${escHtml(r.uiux_assign === '—' ? '' : r.uiux_assign)}</span>
      </div>
    </td>
    <td style="border-left:none !important;">
      ${uiuxBadgeHtml(r.uiux_status, i)}
      <div style="margin-top:16px;padding-top:10px;border-top:1px solid var(--border);">
        <div style="display:flex;align-items:center;gap:6px;margin-bottom:4px;">
          <span class="final-date-str" id="uiux-due-str-${i}" style="font-size:.7rem;color:var(--muted2);">${r.uiux_due ? finalDateFmt(r.uiux_due) : ''}</span>
          <span style="position:relative;display:inline-flex;align-items:center;">
            <button class="cal-icon-btn" onclick="triggerDueById('uiux-due-input-${i}')" title="Pick UI/UX due date">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            </button>
            <input class="due-input" type="date" id="uiux-due-input-${i}" value="${r.uiux_due || ''}"
              onchange="saveVal(${i},'uiux_due',this.value);rerenderUiuxDue(${i},this.value)" />
          </span>
        </div>
        <div id="uiux-due-notif-${i}">
  ${r.deployment_status === 'Deployed'
          ? `<div class="due-notification safe">
        <svg viewBox="0 0 24 24" fill="currentColor" width="12" height="12">
          <circle cx="12" cy="12" r="10"/>
          <path d="M9 12l2 2 4-4" stroke="white" stroke-width="2" fill="none" stroke-linecap="round"/>
        </svg> 
        Deployed — on schedule
      </div>`
          : getDueDateNotification(r.uiux_due)
        }
</div>
      </div>
    </td>
    <td class="col-sep">
      <div class="assignee" style="margin-bottom:0;">
        <div class="avatar ${avc(r.dev_assign)}" id="dav-${i}">${ini(r.dev_assign)}</div>
        <span class="assignee-name editable" contenteditable="true" spellcheck="false" onblur="save(${i},'dev_assign',this);rerenderAv('d',${i})" data-placeholder="Name...">${escHtml(r.dev_assign === '—' ? '' : r.dev_assign)}</span>
      </div>
    </td>
    <td>
      <div class="dev-pill-group"><div class="dev-group-label">Front-end</div>
        <select class="dev-select-minimal" onchange="saveVal(${i},'dev_fe',this.value)">
          <option value=""${!r.dev_fe ? ' selected' : ''}>—</option>
          <option value="Done"${r.dev_fe === 'Done' ? ' selected' : ''}>Done</option>
          <option value="In Progress"${r.dev_fe === 'In Progress' ? ' selected' : ''}>In Progress</option>
          <option value="Pending"${r.dev_fe === 'Pending' ? ' selected' : ''}>Pending</option>
        </select>
      </div>
      <div class="dev-pill-group" style="margin-top:8px;"><div class="dev-group-label">Back-end</div>
        <select class="dev-select-minimal" onchange="saveVal(${i},'dev_be',this.value)">
          <option value=""${!r.dev_be ? ' selected' : ''}>—</option>
          <option value="Done"${r.dev_be === 'Done' ? ' selected' : ''}>Done</option>
          <option value="In Progress"${r.dev_be === 'In Progress' ? ' selected' : ''}>In Progress</option>
          <option value="Pending"${r.dev_be === 'Pending' ? ' selected' : ''}>Pending</option>
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
    <td>
  ${badgeHtml(r.status, i)}
  <div style="margin-top:16px;padding-top:10px;border-top:1px solid var(--border);">
    <div style="display:flex;align-items:center;gap:6px;margin-bottom:4px;">
      <span class="final-date-str" id="dev-due-str-${i}" style="font-size:.7rem;color:var(--muted2);">${r.dev_due ? finalDateFmt(r.dev_due) : ''}</span>
      <span style="position:relative;display:inline-flex;align-items:center;">
        <button class="cal-icon-btn" onclick="triggerDueById('dev-due-input-${i}')" title="Pick Dev due date">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
        </button>
        <input class="due-input" type="date" id="dev-due-input-${i}" value="${r.dev_due || ''}"
          onchange="saveVal(${i},'dev_due',this.value);rerenderDevDue(${i},this.value)" />
      </span>
    </div>
    <div id="dev-due-notif-${i}">
  ${r.deployment_status === 'Deployed'
          ? `<div class="due-notification safe">
        <svg viewBox="0 0 24 24" fill="currentColor" width="12" height="12">
          <circle cx="12" cy="12" r="10"/>
          <path d="M9 12l2 2 4-4" stroke="white" stroke-width="2" fill="none" stroke-linecap="round"/>
        </svg> 
        Deployed — on schedule
      </div>`
          : getDueDateNotification(r.dev_due)
        }
</div>
  </div>
  </td>
    <td class="col-sep">
  <div class="final-text editable" contenteditable="true" spellcheck="false" data-placeholder="Add final remarks..." onblur="save(${i},'final_remark',this)">${escHtml(r.final_remark)}</div>
  
  <div style="margin-top:10px;padding-top:8px;border-top:1px solid var(--border);">
    <div style="font-size:.6rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;margin-bottom:4px;">Deployment</div>
    <div style="position:relative;">
      <select class="stage-select" style="margin-top:0;font-size:.72rem;" onchange="saveVal(${i},'deployment_status',this.value)">
        <option value=""${!r.deployment_status ? ' selected' : ''}>Select status...</option>
        <option value="Deployed"${r.deployment_status === 'Deployed' ? ' selected' : ''}>Deployed</option>
        <option value="Not Deployed"${r.deployment_status === 'Not Deployed' ? ' selected' : ''}>Undeployed</option>
      </select>
    </div>
  </div>

  <div style="margin-top:10px;padding-top:10px;border-top:1px solid var(--border);">
        <div class="final-header-row">
          <span class="final-tag">Final</span>
          <span class="final-date-str" id="fdate-str-${i}">${finalDateFmt(r.due)}</span>
          <span style="position:relative;display:inline-flex;align-items:center;">
            <button class="cal-icon-btn" onclick="triggerDueById(${i})" title="Pick date">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            </button>
            <input class="due-input" type="date" id="due-input-${i}" value="${r.due || ''}" onchange="saveVal(${i},'due',this.value);rerenderDue(${i},this.value)" />
          </span>
        </div>
        <div id="due-notif-${i}">${getDueDateNotification(r.due)}</div>
      </div>
    </td>
  </tr>`;
    }

    /* ════════════════════════════════════════════════
       RENDER TABLE
    ════════════════════════════════════════════════ */
    function renderTable() {
      const tbody = document.getElementById('table-body');
      if (rows.length === 0) {
        tbody.innerHTML = `<tr><td colspan="11" class="no-results-cell"><span>📋</span>No clients yet. Click "Add Client" to get started.</td></tr>`;
      } else {
        tbody.innerHTML = rows.map((r, i) => renderRow(r, i)).join('');
      }
      setTimeout(() => {
        rows.forEach((_, i) => {
          const fe = document.getElementById('pfe-' + i),
            be = document.getElementById('pbe-' + i);
          if (fe) fe.style.transition = 'width .8s cubic-bezier(.34,1.56,.64,1)';
          if (be) be.style.transition = 'width .8s cubic-bezier(.34,1.56,.64,1)';
        });
      }, 20);
      updateCounts();
      applyFilters();
    }

    function updateCounts() {
      document.getElementById('cnt-done').textContent = rows.filter(r => r.status === 'Done').length;
      document.getElementById('cnt-hold').textContent = rows.filter(r => r.status === 'On Hold').length;
      document.getElementById('cnt-rev').textContent = rows.filter(r => r.status === 'Revisions').length;
      updateBinBadge();
    }

    /* ════════════════════════════════════════════════
       SEARCH & FILTER
    ════════════════════════════════════════════════ */
    const activeFilters = {
      uiux_status: null,
      dev_status: null,
      stage: null
    };

    function toggleFilter(type, val) {
      activeFilters[type] = activeFilters[type] === val ? null : val;
      const pillMap = {
        'Homepage': 'fpill-hp',
        'Sitemap': 'fpill-sm',
        'All Pages': 'fpill-ap',
        'Final Homepage': 'fpill-fh'
      };
      const uiuxPillMap = {
        'Done': 'fpill-uiux-done',
        'On Hold': 'fpill-uiux-hold',
        'Revisions': 'fpill-uiux-rev'
      };
      const devPillMap = {
        'Done': 'fpill-dev-done',
        'On Hold': 'fpill-dev-hold',
        'Revisions': 'fpill-dev-rev'
      };

      let idsToClear = [];
      if (type === 'uiux_status') idsToClear = ['fpill-uiux-done', 'fpill-uiux-hold', 'fpill-uiux-rev'];
      else if (type === 'dev_status') idsToClear = ['fpill-dev-done', 'fpill-dev-hold', 'fpill-dev-rev'];
      else idsToClear = ['fpill-hp', 'fpill-sm', 'fpill-ap', 'fpill-fh'];

      idsToClear.forEach(id => document.getElementById(id)?.classList.remove('active'));

      if (activeFilters[type]) {
        let targetId = type === 'uiux_status' ? uiuxPillMap[val] : (type === 'dev_status' ? devPillMap[val] : pillMap[val]);
        document.getElementById(targetId)?.classList.add('active');
      }
      applyFilters();
    }

    function applyFilters() {
      const query = (document.getElementById('search-input')?.value || '').trim().toLowerCase();
      const uiux = activeFilters.uiux_status,
        dev = activeFilters.dev_status,
        stage = activeFilters.stage;
      const hasAny = query || uiux || dev || stage;
      document.getElementById('filter-clear')?.classList.toggle('visible', !!hasAny);
      let visibleCount = 0;
      rows.forEach((r, i) => {
        const tr = document.getElementById('row-' + i);
        if (!tr) return;
        const matchQuery = !query || r.client.toLowerCase().includes(query) || (r.tag || '').toLowerCase().includes(query);
        const matchUiux = !uiux || r.uiux_status === uiux;
        const matchDev = !dev || r.dev_fe === dev || r.dev_be === dev || r.status === dev;
        const matchStage = !stage || r.stage === stage;

        const show = matchQuery && matchUiux && matchDev && matchStage;
        tr.style.display = show ? '' : 'none';
        if (show) visibleCount++;
      });
      const tbody = document.getElementById('table-body');
      let noRow = document.getElementById('no-results-row');
      if (visibleCount === 0 && rows.length > 0) {
        if (!noRow) {
          const tr = document.createElement('tr');
          tr.id = 'no-results-row';
          tr.innerHTML = `<td colspan="11" class="no-results-cell"><span>🔍</span>No clients match your search or filters.</td>`;
          tbody.appendChild(tr);
        }
      } else {
        noRow?.remove();
      }
      const footerEl = document.getElementById('footer-count');
      if (footerEl) footerEl.textContent = hasAny ? `${visibleCount} of ${rows.length} client${rows.length !== 1 ? 's' : ''} shown` : `${rows.length} client${rows.length !== 1 ? 's' : ''} tracked`;
    }

    function clearFilters() {
      document.getElementById('search-input').value = '';
      activeFilters.uiux_status = null;
      activeFilters.dev_status = null;
      activeFilters.stage = null;
      ['fpill-uiux-done', 'fpill-uiux-hold', 'fpill-uiux-rev', 'fpill-dev-done', 'fpill-dev-hold', 'fpill-dev-rev', 'fpill-hp', 'fpill-sm', 'fpill-ap', 'fpill-fh'].forEach(id => document.getElementById(id)?.classList.remove('active'));
      applyFilters();
    }

    /* ════════════════════════════════════════════════
       AJAX PATCH
    ════════════════════════════════════════════════ */
    async function ajaxPatch(idx, field, value) {
      const id = rows[idx].id;
      try {
        const res = await fetch(ROUTES.update(id), {
          method: 'PATCH',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': CSRF,
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            field,
            value,
            edited_by: 'User'
          })
        });
        const data = await res.json();
        if (data.success) {
          rows[idx].last_edited_by = data.last_edited_by;
          rows[idx].last_edited_field = data.last_edited_field;
          rows[idx].updated_at = data.updated_at;
        }
      } catch (e) {
        console.error('Patch failed', e);
      }
    }

    function save(i, key, el) {
      const val = el.innerText.trim();
      const oldVal = rows[i][key] || '';
      // Normalize — and empty string as the same
      const normalizedOld = (oldVal === '—' ? '' : oldVal);
      const normalizedNew = (val === '—' ? '' : val);
      if (normalizedOld === normalizedNew) return; // No real change, skip
      rows[i][key] = val || '—';
      ajaxPatch(i, key, val);
      logActivity('edit', `Edited ${key.replace(/_/g, ' ')} for ${rows[i].client}`, `"${normalizedOld}" → "${normalizedNew}"`);
      toast('Saved ✓');
      updateCounts();
    }

    function saveVal(i, key, val) {
      const oldVal = rows[i][key] || '';
      if (oldVal === val) return; // No change, skip
      rows[i][key] = val;
      ajaxPatch(i, key, val);
      if (key === 'stage') {
        const tr = document.getElementById('row-' + i);
        if (tr) tr.querySelector('.steps').innerHTML = buildSteps(val);
      }
      // ← ADD THIS BLOCK
      if (key === 'deployment_status') {
        const uiuxNotif = document.getElementById('uiux-due-notif-' + i);
        const devNotif = document.getElementById('dev-due-notif-' + i);
        const badge = val === 'Deployed'
          ? `<div class="due-notification safe">
          <svg viewBox="0 0 24 24" fill="currentColor" width="12" height="12">
            <circle cx="12" cy="12" r="10"/>
            <path d="M9 12l2 2 4-4" stroke="white" stroke-width="2" fill="none" stroke-linecap="round"/>
          </svg> Deployed — on schedule
         </div>`
          : '';
        if (uiuxNotif) uiuxNotif.innerHTML = val === 'Deployed' ? badge : getDueDateNotification(rows[i].uiux_due);
        if (devNotif) devNotif.innerHTML = val === 'Deployed' ? badge : getDueDateNotification(rows[i].dev_due);
      }
      logActivity('edit', `Changed ${key.replace(/_/g, ' ')} for ${rows[i].client}`, `→ "${val}"`);
      toast('Saved ✓');
      updateCounts();
    }

    function savePct(i, key, el) {
      const v = Math.min(100, Math.max(0, parseInt(el.innerText.replace('%', '')) || 0));
      if (rows[i][key] === v) return; // No change, skip
      rows[i][key] = v;
      el.innerText = v + '%';
      const bar = document.getElementById('p' + key + '-' + i);
      if (bar) {
        bar.style.transition = 'width .6s cubic-bezier(.34,1.56,.64,1)';
        bar.style.width = v + '%';
      }
      ajaxPatch(i, key, v);
      const label = key === 'fe' ? 'Front-end' : 'Back-end';
      logActivity('edit', `Updated ${label} progress for ${rows[i].client}`, `${v}%`);
      toast('Saved ✓');
    }

    function rerenderAv(which, i) {
      const key = which === 'd' ? 'dev_assign' : (which === 'u' ? 'uiux_assign' : 'prop_assign'),
        id = which === 'd' ? 'dav-' + i : (which === 'u' ? 'uav-' + i : 'pav-' + i);
      const av = document.getElementById(id);
      if (av) {
        av.className = 'avatar ' + avc(rows[i][key]);
        av.textContent = ini(rows[i][key]);
      }
    }

    function rerenderDue(i, val) {
      rows[i].due = val;
      const notif = document.getElementById('due-notif-' + i),
        dstr = document.getElementById('fdate-str-' + i);
      if (notif) notif.innerHTML = getDueDateNotification(val);
      if (dstr) dstr.textContent = finalDateFmt(val);
      logActivity('edit', `Set due date for ${rows[i].client}`, val || '(cleared)');
      toast('Due date updated ✓');
    }

    function rerenderUiuxDue(i, val) {
      rows[i].uiux_due = val;
      const notif = document.getElementById('uiux-due-notif-' + i);
      const dstr = document.getElementById('uiux-due-str-' + i);
      if (notif) notif.innerHTML = getDueDateNotification(val);
      if (dstr) dstr.textContent = finalDateFmt(val);
      logActivity('edit', `Set UI/UX due date for ${rows[i].client}`, val || '(cleared)');
      toast('UI/UX due date updated ✓');
    }

    function rerenderDevDue(i, val) {
      rows[i].dev_due = val;
      const notif = document.getElementById('dev-due-notif-' + i);
      const dstr = document.getElementById('dev-due-str-' + i);
      if (notif) notif.innerHTML = getDueDateNotification(val);
      if (dstr) dstr.textContent = finalDateFmt(val);
      logActivity('edit', `Set Dev due date for ${rows[i].client}`, val || '(cleared)');
      toast('Dev due date updated ✓');
    }

    function triggerDueById(idOrIndex) {
      const id = typeof idOrIndex === 'number' ? `due-input-${idOrIndex}` : idOrIndex;
      const inp = document.getElementById(id);
      if (inp) {
        inp.showPicker?.() || inp.click();
      }
    }

    /* ════════════════════════════════════════════════
       STATUS DROPDOWN
    ════════════════════════════════════════════════ */
    function toggleDrop(i, e) {
      e.stopPropagation();
      document.querySelectorAll('.status-dropdown').forEach(d => {
        if (d.id !== 'sdrop-' + i) d.classList.remove('open');
      });
      document.getElementById('sdrop-' + i).classList.toggle('open');
    }

    function setStatus(i, val, e) {
      e.stopPropagation();
      const old = rows[i].status;
      if (old === val) {
        document.getElementById('sdrop-' + i).classList.remove('open');
        return;
      }
      rows[i].status = val;
      document.getElementById('sdrop-' + i).classList.remove('open');
      const badge = document.querySelector(`#row-${i} #sdrop-${i}`).parentNode;
      if (badge) badge.innerHTML = badgeHtml(val, i);
      ajaxPatch(i, 'status', val);
      logActivity('status', `Status changed for ${rows[i].client}`, `${old} → ${val}`);
      updateCounts();
      toast(`Status → ${val} ✓`);
    }
    document.addEventListener('click', () => document.querySelectorAll('.status-dropdown').forEach(d => d.classList.remove('open')));

    /* ════════════════════════════════════════════════
       DELETE → RECYCLE BIN
    ════════════════════════════════════════════════ */
    function askDelete(i) {
      pendingDeleteIdx = i;
      document.getElementById('confirm-name').textContent = rows[i].client;
      document.getElementById('confirm-modal').classList.add('open');
    }

    function closeConfirm() {
      pendingDeleteIdx = null;
      document.getElementById('confirm-modal').classList.remove('open');
    }

    function confirmDelete() {
      if (pendingDeleteIdx === null) return;
      const i = pendingDeleteIdx;
      closeConfirm();
      const op = rows[i];
      const clientName = op.client;
      const tr = document.getElementById('row-' + i);
      if (tr) tr.style.animation = 'rowOut .3s ease forwards';
      setTimeout(async () => {
        const res = await fetch(ROUTES.destroy(op.id), {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': CSRF,
            'Accept': 'application/json'
          }
        });
        if (res.ok) {
          const deleted = Object.assign({}, op, {
            deleted_at: new Date().toISOString()
          });
          trash.unshift(deleted);
          rows.splice(i, 1);
          renderTable();
          updateBinBadge();
          // Add to log immediately for UI feedback
          activityLog.unshift({
            type: 'delete',
            message: `${clientName} moved to Recycle Bin`,
            ts: Date.now()
          });
          updateLogBadge();
          toast('Moved to Recycle Bin 🗑');
        }
      }, 290);
    }
    document.getElementById('confirm-modal').addEventListener('click', e => {
      if (e.target === e.currentTarget) closeConfirm();
    });
    document.getElementById('confirm-clear-logs-modal').addEventListener('click', e => {
      if (e.target === e.currentTarget) closeClearLogsConfirm();
    });
    document.getElementById('confirm-empty-bin-modal').addEventListener('click', e => {
      if (e.target === e.currentTarget) closeEmptyBinConfirm();
    });

    document.getElementById('confirm-perm-delete-modal').addEventListener('click', e => {
      if (e.target === e.currentTarget) closePermDeleteConfirm();
    });

    /* ════════════════════════════════════════════════
       RECYCLE BIN
    ════════════════════════════════════════════════ */
    let binLastSeenCount = parseInt(localStorage.getItem('binLastSeenCount') || '0');
    let pendingPermDeleteIdx = null;

    function updateBinBadge() {
      const badge = document.getElementById('bin-badge');
      const count = trash.length;
      // If count is less than last seen (items restored/deleted), sync last seen
      if (count < binLastSeenCount) {
        binLastSeenCount = count;
        localStorage.setItem('binLastSeenCount', binLastSeenCount);
      }

      if (count > binLastSeenCount) {
        badge.textContent = count - binLastSeenCount;
        badge.classList.remove('hidden');
      } else {
        badge.classList.add('hidden');
      }
      document.getElementById('bin-count-pill').textContent = `${count} item${count !== 1 ? 's' : ''}`;
    }

    function openBin() {
      document.getElementById('bin-overlay').classList.add('open');
      document.getElementById('bin-drawer').classList.add('open');
      binLastSeenCount = trash.length;
      localStorage.setItem('binLastSeenCount', binLastSeenCount);
      updateBinBadge();
      renderBin();
    }

    function closeBin() {
      document.getElementById('bin-overlay').classList.remove('open');
      document.getElementById('bin-drawer').classList.remove('open');
    }

    function renderBin() {
      const body = document.getElementById('bin-body');
      if (trash.length === 0) {
        body.innerHTML = `<div class="bin-empty"><div class="bin-empty-icon">🪣</div><p>Recycle Bin is empty.<br>Deleted records will appear here.</p></div>`;
        return;
      }
      body.innerHTML = trash.map((r, ti) => {
        const sc = r.status === 'Done' ? 'var(--done)' : r.status === 'On Hold' ? 'var(--onhold)' : 'var(--revision)';
        const dueStr = r.due ? new Date(r.due + 'T00:00:00').toLocaleDateString('en-US', {
          month: 'short',
          day: 'numeric',
          year: 'numeric'
        }) : null;
        return `<div class="bin-card" id="bin-card-${ti}">
      <div class="bin-card-top"><div class="bin-card-info">
        <div class="bin-card-name">${escHtml(r.client)}</div>
        <div class="bin-card-tag">${escHtml(r.tag || '')}</div>
        <div class="bin-card-meta">
          <span class="bin-meta-pill">📋 ${escHtml(r.stage)}</span>
          <span class="bin-meta-pill" style="color:${sc};border-color:${sc}30">● ${r.status}</span>
          ${r.uiux_assign && r.uiux_assign !== '—' ? `<span class="bin-meta-pill">🎨 UI/UX: ${escHtml(r.uiux_assign)} (${r.uiux_status})</span>` : ''}
          ${r.dev_assign && r.dev_assign !== '—' ? `<span class="bin-meta-pill">👤 Dev: ${escHtml(r.dev_assign)}</span>` : ''}
          ${dueStr ? `<span class="bin-meta-pill">📅 ${dueStr}</span>` : ''}
        </div>
        <div class="bin-deleted-at"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>Deleted ${fmtTime(r.deleted_at)}</div>
      </div></div>
      ${r.prop_remark ? `<div style="font-size:.72rem;color:var(--muted);padding:6px 10px;background:rgba(201,99,122,.04);border-left:3px solid var(--border);border-radius:4px;line-height:1.4;margin-bottom:6px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:100%;" title="${escHtml(r.prop_remark)}">${escHtml(r.prop_remark)}</div>` : ''}
      <div class="bin-card-actions">
        <button class="restore-btn" onclick="restoreRow(${ti})"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>Restore</button>
        <button class="perm-delete-btn" onclick="deletePermanently(${ti})"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 6h18M8 6V4h8v2M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>Delete</button>
      </div>
    </div>`;
      }).join('');
    }

    function restoreRow(ti) {
      const card = document.getElementById('bin-card-' + ti);
      if (card) card.style.animation = 'cardIn .3s ease reverse forwards';
      setTimeout(async () => {
        const r = trash[ti];
        const res = await fetch(ROUTES.restore(r.id), {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': CSRF,
            'Accept': 'application/json'
          }
        });
        const data = await res.json();
        if (data.success) {
          trash.splice(ti, 1);
          const rv = data.row;
          rows.push({
            id: rv.id,
            client: rv.client,
            tag: rv.tag,
            stage: rv.stage,
            prop_assign: rv.prop_assign,
            prop_remark: rv.prop_remark || '',
            uiux_assign: rv.uiux_assign || '—',
            uiux_status: rv.uiux_status || 'On Hold',
            dev_assign: rv.dev_assign,
            dev_fe: rv.dev_fe,
            dev_be: rv.dev_be,
            fe: rv.fe,
            be: rv.be,
            status: rv.status,
            due: rv.due ? rv.due.replace(' 00:00:00', '') : '',
            uiux_due: rv.uiux_due ? rv.uiux_due.replace(' 00:00:00', '') : '',
            dev_due: rv.dev_due ? rv.dev_due.replace(' 00:00:00', '') : '',
            final_remark: rv.final_remark || '',
            deployment_status: rv.deployment_status || '',
            last_edited_by: '',
            last_edited_field: '',
            updated_at: 'just now'
          });
          renderTable();
          renderBin();
          updateBinBadge();
          activityLog.unshift({
            type: 'restore',
            message: `${rv.client} restored from Bin`,
            ts: Date.now()
          });
          updateLogBadge();
          setTimeout(() => {
            const last = document.getElementById('row-0');
            if (last) {
              last.classList.add('row-pulse');
              setTimeout(() => last.classList.remove('row-pulse'), 950);
            }
          }, 100);
          toast(`✅ ${rv.client} restored!`);
        }
      }, 250);
    }

    function deletePermanently(ti) {
      pendingPermDeleteIdx = ti;
      document.getElementById('confirm-perm-delete-modal').classList.add('open');
    }

    function closePermDeleteConfirm() {
      pendingPermDeleteIdx = null;
      document.getElementById('confirm-perm-delete-modal').classList.remove('open');
    }

    async function confirmPermDelete() {
      if (pendingPermDeleteIdx === null) return;
      const ti = pendingPermDeleteIdx;
      closePermDeleteConfirm();

      const card = document.getElementById('bin-card-' + ti);
      if (card) {
        card.style.transition = 'opacity .3s ease, transform .3s ease';
        card.style.opacity = '0';
        card.style.transform = 'translateX(20px)';
      }

      setTimeout(async () => {
        const r = trash[ti];
        const res = await fetch(ROUTES.force(r.id), {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': CSRF,
            'Accept': 'application/json'
          }
        });
        if (res.ok) {
          trash.splice(ti, 1);
          renderBin();
          updateBinBadge();
          activityLog.unshift({
            type: 'delete',
            message: `Permanently deleted ${r.client}`,
            ts: Date.now()
          });
          updateLogBadge();
          toast(`${r.client} permanently deleted`);
        }
      }, 280);
    }

    // 1. Bubuksan ang warning modal kapag pinindot ang Empty Bin button
    function emptyBin() {
      if (trash.length === 0) return; // Wag bubukas kung walang laman
      document.getElementById('confirm-empty-bin-modal').classList.add('open');
    }

    // 2. Isasara ang modal kapag kinancel
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
          // Animate all bin cards out first
          const cards = document.querySelectorAll('.bin-card');
          cards.forEach((card, i) => {
            setTimeout(() => {
              card.style.transition = 'opacity .3s ease, transform .3s ease';
              card.style.opacity = '0';
              card.style.transform = 'translateX(20px)';
            }, i * 60);
          });

          // Then clear the data and re-render after animation
          setTimeout(() => {
            trash = [];
            updateBinBadge();
            renderBin();
            activityLog.unshift({
              type: 'delete',
              message: 'Recycle Bin emptied',
              ts: Date.now()
            });
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

    function updateModalBar(inputId, barId) {
      const val = Math.min(100, Math.max(0, parseInt(document.getElementById(inputId).value) || 0));
      document.getElementById(barId).style.width = val + '%';
    }

    // Opens the Add Client Modal
    function openModal() {
      document.getElementById('modal').classList.add('open');
    }

    // Closes the Add Client Modal
    function closeModal() {
      document.getElementById('modal').classList.remove('open');
    }

    // THE MAIN SAVE FUNCTION
    async function addRow() {
      const clientEl = document.getElementById('f-client');
      const client = clientEl.value.trim();

      // Validation: Don't allow empty client names
      if (!client) {
        clientEl.style.borderColor = 'var(--revision)';
        clientEl.focus();
        return;
      }
      clientEl.style.borderColor = '';

      // 1. Prepare the data to match your Laravel Controller
      const payload = {
        client: client,
        stage: document.getElementById('f-stage').value,
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
        uiux_due: document.getElementById('f-uiux-due') ? document.getElementById('f-uiux-due').value || null : null,
        dev_due: document.getElementById('f-dev-due').value || null,
        final_remark: document.getElementById('f-final-remark').value.trim() || '',
        deployment_status: document.getElementById('f-deployment-status') ? document.getElementById('f-deployment-status').value : '',
        edited_by: 'User'
      };

      try {
        // 2. FETCH CALL: Using absolute path '/operations' for Render compatibility
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

          // 3. Update the local "rows" array so the table updates instantly
          rows.unshift({
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
            uiux_due: r.uiux_due || '',
            dev_due: r.dev_due || '',
            final_remark: r.final_remark || '',
            deployment_status: r.deployment_status || '',
            last_edited_by: '',
            last_edited_field: '',
            updated_at: 'just now'
          });

          // 4. UI Cleanup
          closeModal();
          ['f-client', 'f-uiux-assign', 'f-uiux-due',
            'f-dev-assign', 'f-dev-due', 'f-fe', 'f-be', 'f-due',
            'f-prop-remark', 'f-final-remark', 'f-deployment-status'
          ]
            .forEach(id => {
              const el = document.getElementById(id);
              if (el) el.value = '';
            });

          // 5. Re-draw the table and show animations
          renderTable();

          setTimeout(() => {
            const last = document.getElementById('row-0');
            if (last) {
              last.classList.add('row-pulse');
              setTimeout(() => last.classList.remove('row-pulse'), 950);
            }
          }, 120);

          // 6. Update Activity Log and Toast
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
          // Error handling for validation (e.g., missing fields)
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

    // Close modal when clicking outside of it (the gray background)
    document.getElementById('modal').addEventListener('click', e => {
      if (e.target === e.currentTarget) closeModal();
    });

    /* ════════════════════════════════════════════════
       THEME
    ════════════════════════════════════════════════ */
    function toggleTheme() {
      const html = document.documentElement,
        dark = html.getAttribute('data-theme') === 'dark';
      const newTheme = dark ? 'light' : 'dark';
      html.setAttribute('data-theme', newTheme);
      localStorage.setItem('theme', newTheme);
      const sunEl = document.getElementById('theme-icon-sun'),
        moonEl = document.getElementById('theme-icon-moon'),
        labelEl = document.getElementById('theme-label');
      if (dark) {
        sunEl.style.display = '';
        moonEl.style.display = 'none';
        labelEl.textContent = 'Dark';
        toast('☀️ Light mode');
      } else {
        sunEl.style.display = 'none';
        moonEl.style.display = '';
        labelEl.textContent = 'Light';
        toast('🌙 Dark mode');
      }
    }

    /* ════════════════════════════════════════════════
       TOAST
    ════════════════════════════════════════════════ */
    let toastTimer;

    function toast(msg) {
      document.querySelector('.toast')?.remove();
      clearTimeout(toastTimer);
      const el = Object.assign(document.createElement('div'), {
        className: 'toast',
        textContent: msg
      });
      document.body.appendChild(el);
      toastTimer = setTimeout(() => el.remove(), 2400);
    }

    /* ════════════════════════════════════════════════
       OVERDUE POPUP ON LOAD
    ════════════════════════════════════════════════ */
    function checkOverdueOnLoad() {
      const today = new Date();
      today.setHours(0, 0, 0, 0);

      const overdueMap = {};
      rows.forEach(r => {
        const checks = [{
          label: 'Final Due',
          date: r.due
        },
        {
          label: 'UI/UX Due',
          date: r.uiux_due
        },
        {
          label: 'Dev Due',
          date: r.dev_due
        },
        ];
        checks.forEach(c => {
          if (!c.date) return;
          const daysOver = Math.floor((today - new Date(c.date + 'T00:00:00')) / (1000 * 60 * 60 * 24));
          if (daysOver > 0) {
            if (!overdueMap[r.client]) overdueMap[r.client] = [];
            overdueMap[r.client].push({
              ...c,
              daysOver
            });
          }
        });
      });

      const clients = Object.keys(overdueMap);
      if (clients.length === 0) return;

      const totalCount = Object.values(overdueMap).reduce((sum, arr) => sum + arr.length, 0);

      const overlay = document.createElement('div');
      overlay.className = 'overdue-overlay';
      overlay.id = 'overdue-overlay';

      const listItems = clients.slice(0, 6).map(client => {
        const items = overdueMap[client];
        const itemsHtml = items.map(item => `
    <div class="od-detail-row">
      <span class="od-detail-label">${item.label}</span>
      <span class="ol-days">${item.daysOver} day${item.daysOver !== 1 ? 's' : ''} overdue</span>
    </div>
  `).join('');

        return `
      <li class="od-client-item" onclick="toggleOdDetail(this)">
        <div class="od-client-header">
          <span class="ol-name">${escHtml(client)}</span>
          <span style="display:flex;align-items:center;gap:6px;">
            <span class="od-count-pill">${items.length} overdue</span>
            <span class="od-chevron">▾</span>
          </span>
        </div>
        <div class="od-detail-wrap">${itemsHtml}</div>
      </li>`;
      }).join('');

      const moreText = clients.length > 6 ?
        `<div class="overdue-more">+${clients.length - 6} more client${clients.length - 6 !== 1 ? 's' : ''} with overdue dates</div>` :
        '';

      overlay.innerHTML = `
    <div class="overdue-popup">
      <div class="overdue-popup-header">
        <span class="overdue-popup-icon">⚠️</span>
        <div>
          <div class="overdue-popup-title">${clients.length} Client${clients.length > 1 ? 's' : ''} with Overdue Dates</div>
          <div class="overdue-popup-subtitle">${totalCount} overdue deadline${totalCount !== 1 ? 's' : ''} — click a client to see details</div>
        </div>
      </div>
      <div class="overdue-divider"></div>
      <div class="overdue-popup-body">
        <ul class="overdue-list">${listItems}</ul>
        ${moreText}
        Please review and update the project statuses.
      </div>
      <div class="overdue-popup-actions">
        <button class="overdue-popup-dismiss" onclick="dismissOverduePopup()">Dismiss</button>
        <button class="overdue-popup-view" onclick="viewOverdueProjects()">View Projects</button>
      </div>
    </div>
  `;

      document.body.appendChild(overlay);
    }

    function toggleOdDetail(el) {
      el.classList.toggle('od-open');
    }

    function dismissOverduePopup() {
      const overlay = document.getElementById('overdue-overlay');
      if (overlay) {
        overlay.style.transition = 'opacity .3s ease';
        overlay.style.opacity = '0';
        setTimeout(() => overlay.remove(), 300);
      }
    }

    function viewOverdueProjects() {
      dismissOverduePopup();
      const today = new Date();
      today.setHours(0, 0, 0, 0);

      // Collect overdue row indices
      const overdueIndices = [];
      rows.forEach((r, i) => {
        const isOverdue = (
          (r.due && new Date(r.due + 'T00:00:00') < today) ||
          (r.uiux_due && new Date(r.uiux_due + 'T00:00:00') < today) ||
          (r.dev_due && new Date(r.dev_due + 'T00:00:00') < today)
        );
        if (isOverdue) overdueIndices.push(i);
      });

      if (overdueIndices.length === 0) return;

      // Hide non-overdue rows
      rows.forEach((_, i) => {
        const tr = document.getElementById('row-' + i);
        if (!tr) return;
        if (overdueIndices.includes(i)) {
          tr.style.display = '';
          tr.classList.add('row-overdue-highlight');
          setTimeout(() => tr.classList.remove('row-overdue-highlight'), 4500);
        } else {
          tr.style.display = 'none';
        }
      });

      // Update footer
      document.getElementById('footer-count').textContent =
        `Showing ${overdueIndices.length} overdue client${overdueIndices.length !== 1 ? 's' : ''}`;

      // Show the unfilter button
      showOverdueFilterBar(overdueIndices.length);

      document.querySelector('.table-wrap')?.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }

    function showOverdueFilterBar(count) {
      // Remove existing bar if any
      document.getElementById('overdue-filter-bar')?.remove();

      const bar = document.createElement('div');
      bar.id = 'overdue-filter-bar';
      bar.style.cssText = `
    display:flex;align-items:center;gap:10px;
    margin-bottom:14px;padding:10px 16px;
    background:rgba(201,96,112,.08);
    border:1.5px solid rgba(201,96,112,.3);
    border-radius:12px;
    font-family:'Poppins',sans-serif;
    animation:fadeUp .3s ease;
  `;
      bar.innerHTML = `
    <span style="font-size:.8rem;color:var(--revision);font-weight:600;">
      ⚠️ Showing ${count} overdue client${count !== 1 ? 's' : ''}
    </span>
    <button onclick="clearOverdueFilter()" style="
      margin-left:auto;padding:6px 14px;border-radius:8px;
      border:1.5px solid rgba(201,96,112,.4);
      background:transparent;color:var(--revision);
      font-family:'Poppins',sans-serif;font-size:.75rem;font-weight:600;
      cursor:pointer;transition:all .2s;display:flex;align-items:center;gap:6px;
    " onmouseover="this.style.background='rgba(201,96,112,.12)'"
       onmouseout="this.style.background='transparent'">
      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
      </svg>
      Show All
    </button>
  `;

      // Insert the bar before the table
      const tableWrap = document.querySelector('.table-wrap');
      tableWrap.parentNode.insertBefore(bar, tableWrap);
    }

    function clearOverdueFilter() {
      // Show all rows
      rows.forEach((_, i) => {
        const tr = document.getElementById('row-' + i);
        if (tr) tr.style.display = '';
      });

      // Remove the filter bar
      document.getElementById('overdue-filter-bar')?.remove();

      // Restore footer count
      applyFilters();
    }

    /* ════════════════════════════════════════════════
   ARCHIVE
════════════════════════════════════════════════ */
    let pendingArchiveIdx = null;

    function updateArchiveBadge() {
      const badge = document.getElementById('archive-badge');
      const count = archived.length;
      if (count > 0) {
        badge.textContent = count > 99 ? '99+' : count;
        badge.classList.remove('hidden');
      } else {
        badge.classList.add('hidden');
      }
      document.getElementById('archive-count-pill').textContent = `${count} item${count !== 1 ? 's' : ''}`;
    }

    function openArchive() {
      document.getElementById('archive-overlay').classList.add('open');
      document.getElementById('archive-drawer').classList.add('open');
      renderArchive();
    }

    function closeArchive() {
      document.getElementById('archive-overlay').classList.remove('open');
      document.getElementById('archive-drawer').classList.remove('open');
    }

    function renderArchive() {
      const body = document.getElementById('archive-body');
      if (archived.length === 0) {
        body.innerHTML = `<div class="archive-empty"><div class="archive-empty-icon">🗂️</div><p>Archive is empty.<br>Archived records will appear here.</p></div>`;
        return;
      }
      body.innerHTML = archived.map((r, ai) => {
        const sc = r.status === 'Done' ? 'var(--done)' : r.status === 'On Hold' ? 'var(--onhold)' : 'var(--revision)';
        const dueStr = r.due ? new Date(r.due + 'T00:00:00').toLocaleDateString('en-US', {
          month: 'short',
          day: 'numeric',
          year: 'numeric'
        }) : null;
        return `<div class="archive-card" id="archive-card-${ai}">
      <div class="archive-card-top">
        <div>
          <div class="archive-card-name">${escHtml(r.client)}</div>
          <div class="archive-card-tag">${escHtml(r.tag || '')}</div>
          <div class="archive-card-meta">
            <span class="archive-meta-pill">📋 ${escHtml(r.stage)}</span>
            <span class="archive-meta-pill" style="color:${sc};border-color:${sc}30">● ${r.status}</span>
            ${r.uiux_assign && r.uiux_assign !== '—' ? `<span class="archive-meta-pill">🎨 UI/UX: ${escHtml(r.uiux_assign)} (${r.uiux_status})</span>` : ''}
            ${r.dev_assign && r.dev_assign !== '—' ? `<span class="archive-meta-pill">👤 Dev: ${escHtml(r.dev_assign)}</span>` : ''}
            ${dueStr ? `<span class="archive-meta-pill">📅 ${dueStr}</span>` : ''}
          </div>
          <div class="archive-archived-at">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            Archived ${fmtTime(r.archived_at)}
          </div>
        </div>
      </div>
      ${r.prop_remark ? `<div style="font-size:.72rem;color:var(--muted);padding:6px 10px;background:var(--archive-bg);border-left:3px solid var(--archive-border);border-radius:4px;line-height:1.4;margin-bottom:6px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:100%;" title="${escHtml(r.prop_remark)}">${escHtml(r.prop_remark)}</div>` : ''}
      <div class="archive-card-actions">
        <button class="archive-restore-btn" onclick="restoreFromArchive(${ai})">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
          Restore
        </button>
      </div>
    </div>`;
      }).join('');
    }

    function askArchive(i) {
      pendingArchiveIdx = i;
      document.getElementById('confirm-archive-name').textContent = rows[i].client;
      document.getElementById('confirm-archive-modal').classList.add('open');
    }

    function closeArchiveConfirm() {
      pendingArchiveIdx = null;
      document.getElementById('confirm-archive-modal').classList.remove('open');
    }

    function confirmArchive() {
      if (pendingArchiveIdx === null) return;
      const i = pendingArchiveIdx;
      closeArchiveConfirm();
      const op = rows[i];
      const tr = document.getElementById('row-' + i);
      if (tr) tr.style.animation = 'rowOut .3s ease forwards';
      setTimeout(async () => {
        const res = await fetch(ROUTES.archive(op.id), {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': CSRF,
            'Accept': 'application/json'
          }
        });
        const data = await res.json();
        if (data.success) {
          const archivedRecord = Object.assign({}, op, {
            archived_at: new Date().toISOString()
          });
          archived.unshift(archivedRecord);
          rows.splice(i, 1);
          renderTable();
          updateArchiveBadge();
          activityLog.unshift({
            type: 'edit',
            message: `${op.client} moved to Archive`,
            ts: Date.now()
          });
          updateLogBadge();
          toast('📦 Moved to Archive');
        }
      }, 290);
    }

    async function restoreFromArchive(ai) {
      const card = document.getElementById('archive-card-' + ai);
      if (card) {
        card.style.transition = 'opacity .3s ease, transform .3s ease';
        card.style.opacity = '0';
        card.style.transform = 'translateX(20px)';
      }
      setTimeout(async () => {
        const r = archived[ai];
        const res = await fetch(ROUTES.unarchive(r.id), {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': CSRF,
            'Accept': 'application/json'
          }
        });
        const data = await res.json();
        if (data.success) {
          archived.splice(ai, 1);
          const rv = data.row;
          rows.push({
            id: rv.id,
            client: rv.client,
            tag: rv.tag,
            stage: rv.stage,
            prop_assign: rv.prop_assign,
            prop_remark: rv.prop_remark || '',
            uiux_assign: rv.uiux_assign || '—',
            uiux_status: rv.uiux_status || 'On Hold',
            dev_assign: rv.dev_assign,
            dev_fe: rv.dev_fe,
            dev_be: rv.dev_be,
            fe: rv.fe,
            be: rv.be,
            status: rv.status,
            due: rv.due ? rv.due.replace(' 00:00:00', '') : '',
            uiux_due: rv.uiux_due ? rv.uiux_due.replace(' 00:00:00', '') : '',
            dev_due: rv.dev_due ? rv.dev_due.replace(' 00:00:00', '') : '',
            final_remark: rv.final_remark || '',
            deployment_status: rv.deployment_status || '',
            last_edited_by: '',
            last_edited_field: '',
            updated_at: 'just now'
          });
          renderTable();
          renderArchive();
          updateArchiveBadge();
          activityLog.unshift({
            type: 'restore',
            message: `${rv.client} restored from Archive`,
            ts: Date.now()
          });
          updateLogBadge();
          setTimeout(() => {
            const last = document.getElementById('row-' + (rows.length - 1));
            if (last) {
              last.classList.add('row-pulse');
              setTimeout(() => last.classList.remove('row-pulse'), 950);
            }
          }, 100);
          toast(`✅ ${rv.client} restored!`);
        }
      }, 280);
    }

    // Close archive confirm when clicking outside
    document.getElementById('confirm-archive-modal').addEventListener('click', e => {
      if (e.target === e.currentTarget) closeArchiveConfirm();
    });

    /* ════════════════════════════════════════════════
       INIT
    ════════════════════════════════════════════════ */
    renderTable();
    updateArchiveBadge();
    setTimeout(checkOverdueOnLoad, 800); // slight delay so table renders first

    // Sync theme toggle UI on load
    (function () {
      const saved = localStorage.getItem('theme') || 'light';
      const isDark = saved === 'dark';
      const sunEl = document.getElementById('theme-icon-sun');
      const moonEl = document.getElementById('theme-icon-moon');
      const labelEl = document.getElementById('theme-label');
      if (isDark) {
        sunEl.style.display = 'none';
        moonEl.style.display = '';
        labelEl.textContent = 'Light';
      } else {
        sunEl.style.display = '';
        moonEl.style.display = 'none';
        labelEl.textContent = 'Dark';
      }
    })(); // slight delay so table renders first

    /* ════ DRAG TO SCROLL TABLE ════ */
    (function () {
      const wrap = document.querySelector('.table-wrap');
      let isDown = false,
        startX, scrollLeft;
      wrap.addEventListener('mousedown', e => {
        if (e.target.closest('button,select,input,[contenteditable="true"],.status-badge')) return;
        isDown = true;
        wrap.style.cursor = 'grabbing';
        startX = e.pageX - wrap.offsetLeft;
        scrollLeft = wrap.scrollLeft;
      });
      document.addEventListener('mouseup', () => {
        isDown = false;
        wrap.style.cursor = 'grab';
      });
      wrap.addEventListener('mouseleave', () => {
        isDown = false;
        wrap.style.cursor = 'grab';
      });
      wrap.addEventListener('mousemove', e => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - wrap.offsetLeft;
        wrap.scrollLeft = scrollLeft - (x - startX) * 1.5;
      });
    })();

    /* ════════════════════════════════════════════════
   AUTOCOMPLETE
════════════════════════════════════════════════ */
    const AC_NAMES = {
      uiux: [
        { name: 'Nicolle', color: '#c9637a' },
        { name: 'Kent', color: '#b07060' },
      ],
      dev: [
        { name: 'Anthony', color: '#5a9a6a' },
        { name: 'Adrian', color: '#6a7ab0' },
        { name: 'Ahadon', color: '#b08020' },
        { name: 'Kef', color: '#c9637a' },
        { name: 'John', color: '#7a6ab0' },
        { name: 'Carl', color: '#b07060' },
      ],
    };
    AC_NAMES.all = [...AC_NAMES.uiux, ...AC_NAMES.dev];

    function acInput(inputId, dropId, group) {
      const inp = document.getElementById(inputId);
      const drop = document.getElementById(dropId);
      if (!inp || !drop) return;
      const q = inp.value.trim().toLowerCase();
      const list = AC_NAMES[group] || AC_NAMES.all;
      const filtered = q ? list.filter(n => n.name.toLowerCase().includes(q)) : list;
      if (!filtered.length) { drop.classList.remove('open'); return; }
      const roleLabel = group === 'uiux' ? 'UI/UX Designer' : 'Developer';
      drop.innerHTML = filtered.map(n => `
    <div class="ac-option" onmousedown="acPick('${inputId}','${dropId}','${n.name}')">
      <div class="ac-avatar" style="background:${n.color}">${n.name[0]}</div>
      <div>
        <div>${n.name}</div>
        <div class="ac-role">${roleLabel}</div>
      </div>
    </div>
  `).join('');
      drop.classList.add('open');
    }

    function acPick(inputId, dropId, name) {
      const inp = document.getElementById(inputId);
      if (inp) inp.value = name;
      acClose(dropId);
    }

    function acClose(dropId) {
      document.getElementById(dropId)?.classList.remove('open');
    }
    
  </script>
  <script src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
</body>

</html>