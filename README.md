
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: var(--font-sans); }

  .readme {
    max-width: 720px;
    margin: 0 auto;
    padding: 2rem 1.5rem 3rem;
    color: var(--color-text-primary);
  }

  /* HEADER */
  .header {
    text-align: center;
    padding: 2.5rem 1.5rem 2rem;
    border: 0.5px solid var(--color-border-tertiary);
    border-radius: var(--border-radius-lg);
    background: var(--color-background-primary);
    margin-bottom: 2rem;
  }
  .logo-wrap { margin-bottom: 1.25rem; }
  .logo-wrap img { height: 44px; width: auto; object-fit: contain; }
  .header h1 {
    font-size: 22px;
    font-weight: 500;
    letter-spacing: -0.3px;
    color: var(--color-text-primary);
    margin-bottom: 0.4rem;
  }
  .header .subtitle {
    font-size: 14px;
    color: var(--color-text-secondary);
    margin-bottom: 1.25rem;
    line-height: 1.5;
  }
  .badges {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 8px;
  }
  .badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: var(--border-radius-md);
    font-size: 11px;
    font-weight: 500;
    border: 0.5px solid;
    letter-spacing: 0.2px;
  }
  .badge-laravel { background: #FFF0EE; color: #B52A1A; border-color: #F5C0BA; }
  .badge-php     { background: #F0EFFE; color: #4A40A8; border-color: #C8C3F0; }
  .badge-mysql   { background: #EBF3FC; color: #1055A0; border-color: #A8CCF0; }
  .badge-mit     { background: #FBE8EF; color: #8A2048; border-color: #EDB5CE; }

  /* SECTION */
  .section {
    margin-bottom: 1.5rem;
    border: 0.5px solid var(--color-border-tertiary);
    border-radius: var(--border-radius-lg);
    background: var(--color-background-primary);
    overflow: hidden;
  }
  .section-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 1rem 1.25rem;
    border-bottom: 0.5px solid var(--color-border-tertiary);
    cursor: pointer;
    user-select: none;
    transition: background 0.15s;
  }
  .section-header:hover { background: var(--color-background-secondary); }
  .section-icon {
    width: 28px; height: 28px;
    border-radius: 6px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px;
    flex-shrink: 0;
  }
  .icon-rose   { background: #FBE8EF; color: #8A2048; }
  .icon-blue   { background: #EBF3FC; color: #1055A0; }
  .icon-purple { background: #F0EFFE; color: #4A40A8; }
  .icon-green  { background: #EAF3DE; color: #2E5C10; }
  .icon-amber  { background: #FAEEDA; color: #7A4A0A; }

  .section-title {
    font-size: 15px;
    font-weight: 500;
    color: var(--color-text-primary);
    flex: 1;
  }
  .chevron {
    width: 16px; height: 16px;
    color: var(--color-text-tertiary);
    transition: transform 0.2s;
    flex-shrink: 0;
  }
  .chevron.open { transform: rotate(180deg); }
  .section-body {
    padding: 1.25rem;
    font-size: 14px;
    line-height: 1.7;
    color: var(--color-text-secondary);
    display: none;
  }
  .section-body.open { display: block; }

  /* About prose */
  .about-text p { margin-bottom: 0.75rem; }
  .about-text strong { font-weight: 500; color: var(--color-text-primary); }

  /* TRACK grid */
  .tracks {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 10px;
  }
  .track-card {
    padding: 0.9rem 1rem;
    border: 0.5px solid var(--color-border-tertiary);
    border-radius: var(--border-radius-md);
    background: var(--color-background-secondary);
  }
  .track-label {
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    color: var(--color-text-tertiary);
    margin-bottom: 4px;
  }
  .track-title {
    font-size: 14px;
    font-weight: 500;
    color: var(--color-text-primary);
    margin-bottom: 3px;
  }
  .track-desc {
    font-size: 12px;
    color: var(--color-text-secondary);
    line-height: 1.5;
  }

  /* Features list */
  .features { display: flex; flex-direction: column; gap: 6px; }
  .feature-row {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 10px;
    border-radius: var(--border-radius-md);
    font-size: 13px;
    color: var(--color-text-secondary);
    border: 0.5px solid transparent;
    cursor: pointer;
    transition: background 0.15s, border-color 0.15s;
  }
  .feature-row:hover {
    background: var(--color-background-secondary);
    border-color: var(--color-border-tertiary);
    color: var(--color-text-primary);
  }
  .feature-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    flex-shrink: 0;
  }
  .dot-green  { background: #63991E; }
  .dot-blue   { background: #3B8BD4; }
  .dot-purple { background: #7F77DD; }
  .dot-amber  { background: #BA7517; }
  .dot-rose   { background: #D4537E; }
  .feature-name { font-weight: 500; color: var(--color-text-primary); min-width: 140px; }

  /* License */
  .license-box {
    background: var(--color-background-secondary);
    border-radius: var(--border-radius-md);
    border: 0.5px solid var(--color-border-tertiary);
    padding: 1rem 1.25rem;
    font-size: 13px;
    color: var(--color-text-secondary);
    line-height: 1.6;
  }
  .license-box a { color: var(--color-text-info); text-decoration: none; }
  .license-box a:hover { text-decoration: underline; }
  .license-tag {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 4px;
    background: #FBE8EF;
    color: #8A2048;
    font-size: 11px;
    font-weight: 500;
    margin-bottom: 8px;
    border: 0.5px solid #EDB5CE;
  }

  /* Credits */
  .credits-card {
    border: 0.5px solid var(--color-border-tertiary);
    border-radius: var(--border-radius-lg);
    background: var(--color-background-primary);
    overflow: hidden;
  }
  .credits-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.25rem;
    border-bottom: 0.5px solid var(--color-border-tertiary);
  }
  .credits-logo img { height: 36px; width: auto; }
  .credits-label {
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.7px;
    color: var(--color-text-tertiary);
  }
  .credits-team {
    display: grid;
    grid-template-columns: 1fr 1fr;
  }
  .credit-person {
    padding: 1.1rem 1.25rem;
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .credit-person:first-child {
    border-right: 0.5px solid var(--color-border-tertiary);
  }
  .avatar {
    width: 38px; height: 38px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-weight: 500;
    font-size: 13px;
    flex-shrink: 0;
  }
  .avatar-rose   { background: #FBE8EF; color: #8A2048; }
  .avatar-purple { background: #F0EFFE; color: #4A40A8; }
  .credit-name {
    font-size: 14px;
    font-weight: 500;
    color: var(--color-text-primary);
    margin-bottom: 2px;
  }
  .credit-role {
    font-size: 12px;
    color: var(--color-text-tertiary);
  }
  .credits-footer {
    padding: 0.75rem 1.25rem;
    border-top: 0.5px solid var(--color-border-tertiary);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    font-size: 12px;
    color: var(--color-text-tertiary);
  }
  .heart { color: #D4537E; font-size: 13px; }
  .divider {
    height: 1px;
    background: var(--color-border-tertiary);
    margin: 2rem 0;
  }
</style>

<div class="readme">
  <h2 class="sr-only">RWeb Solutions Operations Monitoring Dashboard — project README</h2>

  <!-- HEADER -->
  <div class="header">
    <div class="logo-wrap">
      <img src="https://rwebsolutions.com.ph/assets/navbar/logo.png" alt="RWeb Solutions" onerror="this.style.display='none'">
    </div>
    <h1>Operations Monitoring Dashboard</h1>
    <p class="subtitle">A real-time web development pipeline tracker built with Laravel</p>
    <div class="badges">
      <span class="badge badge-laravel">Laravel 11.x</span>
      <span class="badge badge-php">PHP 8.2</span>
      <span class="badge badge-mysql">MySQL</span>
      <span class="badge badge-mit">MIT License</span>
    </div>
  </div>

  <!-- ABOUT -->
  <div class="section">
    <div class="section-header" onclick="toggle(this)">
      <div class="section-icon icon-rose">◎</div>
      <span class="section-title">About this project</span>
      <svg class="chevron open" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 6l4 4 4-4"/></svg>
    </div>
    <div class="section-body open about-text">
      <p>The <strong>RWeb Solutions Operations Monitoring Dashboard</strong> is an internal tool designed to give the team a clear, real-time view of every client project — from initial proposal all the way through to final delivery.</p>
      <p>Built on Laravel with a warm rose/cream UI, it replaces messy spreadsheets with a structured, interactive pipeline tracker that keeps every stakeholder aligned.</p>
    </div>
  </div>

  <!-- WHAT IT TRACKS -->
  <div class="section">
    <div class="section-header" onclick="toggle(this)">
      <div class="section-icon icon-blue">⊞</div>
      <span class="section-title">What it tracks</span>
      <svg class="chevron" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 6l4 4 4-4"/></svg>
    </div>
    <div class="section-body">
      <div class="tracks">
        <div class="track-card">
          <div class="track-label">Phase 1</div>
          <div class="track-title">Proposal</div>
          <div class="track-desc">Sitemap → Homepage → All Pages → Final Homepage</div>
        </div>
        <div class="track-card">
          <div class="track-label">Phase 2</div>
          <div class="track-title">UI / UX</div>
          <div class="track-desc">Designer assignments, status, and due dates</div>
        </div>
        <div class="track-card">
          <div class="track-label">Phase 3</div>
          <div class="track-title">Development</div>
          <div class="track-desc">Front-end and back-end assignments, progress %, statuses</div>
        </div>
        <div class="track-card">
          <div class="track-label">Alerts</div>
          <div class="track-title">Due dates</div>
          <div class="track-desc">Color-coded overdue notifications across all phases</div>
        </div>
        <div class="track-card">
          <div class="track-label">Delivery</div>
          <div class="track-title">Final remarks</div>
          <div class="track-desc">Closing notes and delivery status per client</div>
        </div>
      </div>
    </div>
  </div>

  <!-- FEATURES -->
  <div class="section">
    <div class="section-header" onclick="toggle(this)">
      <div class="section-icon icon-purple">✦</div>
      <span class="section-title">Features</span>
      <svg class="chevron" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 6l4 4 4-4"/></svg>
    </div>
    <div class="section-body">
      <div class="features">
        <div class="feature-row"><span class="feature-dot dot-green"></span><span class="feature-name">Inline editing</span><span>Click any cell to edit directly</span></div>
        <div class="feature-row"><span class="feature-dot dot-blue"></span><span class="feature-name">Search and filter</span><span>Filter by status, stage, or keyword</span></div>
        <div class="feature-row"><span class="feature-dot dot-purple"></span><span class="feature-name">Recycle bin</span><span>Soft-delete with restore support</span></div>
        <div class="feature-row"><span class="feature-dot dot-amber"></span><span class="feature-name">Activity log</span><span>Tracks every change made to the board</span></div>
        <div class="feature-row"><span class="feature-dot dot-rose"></span><span class="feature-name">Export</span><span>Download to XLSX or PDF</span></div>
        <div class="feature-row"><span class="feature-dot dot-green"></span><span class="feature-name">Dark / light theme</span><span>Toggle between display modes</span></div>
        <div class="feature-row"><span class="feature-dot dot-blue"></span><span class="feature-name">Overdue alerts</span><span>Popup notification on load for overdue items</span></div>
      </div>
    </div>
  </div>

  <!-- LICENSE -->
  <div class="section">
    <div class="section-header" onclick="toggle(this)">
      <div class="section-icon icon-amber">⊖</div>
      <span class="section-title">License</span>
      <svg class="chevron" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 6l4 4 4-4"/></svg>
    </div>
    <div class="section-body">
      <div class="license-box">
        <div class="license-tag">Proprietary</div>
        <div>This project is proprietary software owned by <a href="https://rwebsolutions.com.ph" target="_blank">RWeb Solutions</a>. For internal use only. Redistribution or modification without express written consent is strictly prohibited.</div>
      </div>
    </div>
  </div>

  <div class="divider"></div>

  <!-- CREDITS -->
  <div class="credits-card">
    <div class="credits-header">
      <div>
        <div class="credits-label">Credits</div>
      </div>
      <div class="credits-logo">
        <img src="https://rwebsolutions.com.ph/assets/navbar/logo.png" alt="RWeb Solutions" onerror="this.style.display='none'">
      </div>
    </div>
    <div class="credits-team">
      <div class="credit-person">
        <div class="avatar avatar-rose">KM</div>
        <div>
          <div class="credit-name">Khyrene Mae Utanes</div>
          <div class="credit-role">HCDC Intern</div>
        </div>
      </div>
      <div class="credit-person">
        <div class="avatar avatar-purple">AD</div>
        <div>
          <div class="credit-name">Angeline Delos Reyes</div>
          <div class="credit-role">HCDC Intern</div>
        </div>
      </div>
    </div>
    <div class="credits-footer">
      <span>Made with</span>
      <span class="heart">♥</span>
      <span>at Holy Cross of Davao College · RWeb Solutions</span>
    </div>
  </div>

</div>

<script>
function toggle(header) {
  const body = header.nextElementSibling;
  const chevron = header.querySelector('.chevron');
  const isOpen = body.classList.contains('open');
  body.classList.toggle('open', !isOpen);
  chevron.classList.toggle('open', !isOpen);
}
</script>
