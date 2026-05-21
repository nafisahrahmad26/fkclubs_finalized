<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Browse Clubs — FK Student Portal</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<aside class="sidebar">
  <div class="sidebar-logo">
    <div class="logo-icon">🎓</div>
    <h2>FK Club Management</h2>
    <span>BCS2243 · Module 2</span>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-section-label">Overview</div>
    <a href="dashboard.html" class="nav-item"><span class="icon">📊</span> Dashboard</a>
    <div class="nav-section-label">Clubs</div>
    <a href="club_list.html" class="nav-item"><span class="icon">🏛️</span> Club List</a>
    <a href="club_create.html" class="nav-item"><span class="icon">➕</span> Create Club</a>
    <a href="committee.html" class="nav-item"><span class="icon">👥</span> Committee</a>
    <div class="nav-section-label">View</div>
    <a href="club_detail.html" class="nav-item"><span class="icon">🔍</span> Club Detail</a>
    <a href="club_public.html" class="nav-item active"><span class="icon">🌐</span> Public View</a>
  </nav>
  <div class="sidebar-footer">
    <div class="user-badge">
      <div class="user-avatar">ST</div>
      <div class="user-info">
        <div class="user-name">Ahmad Razif</div>
        <div class="user-role">Student</div>
      </div>
    </div>
  </div>
</aside>

<div class="main">
  <div class="topbar">
    <div class="topbar-left">
      <h1>Browse Clubs</h1>
      <div class="breadcrumb">Student Portal · Discover Clubs</div>
    </div>
    <div class="topbar-actions">
      <div class="search-bar">
        <span>🔍</span>
        <input type="text" placeholder="Search clubs..." oninput="filterCards(this.value)">
      </div>
    </div>
  </div>

  <div class="content">

    <!-- Category Filter Pills -->
    <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:24px;">
      <button class="filter-pill active" onclick="setFilter(this,'all')">All Clubs</button>
      <button class="filter-pill" onclick="setFilter(this,'Technical')">💻 Technical</button>
      <button class="filter-pill" onclick="setFilter(this,'Academic')">📚 Academic</button>
      <button class="filter-pill" onclick="setFilter(this,'Creative')">🎨 Creative</button>
      <button class="filter-pill" onclick="setFilter(this,'Sports')">⚽ Sports</button>
      <button class="filter-pill" onclick="setFilter(this,'Cultural')">🎭 Cultural</button>
    </div>

    <style>
      .filter-pill {
        padding: 7px 16px;
        border-radius: 20px;
        font-size: 13px; font-weight: 500;
        border: 1px solid var(--border);
        background: var(--card);
        color: var(--text-muted);
        cursor: pointer;
        transition: var(--transition);
        font-family: 'Outfit', sans-serif;
      }
      .filter-pill:hover { color: var(--text); background: var(--card-hover); }
      .filter-pill.active { background: var(--blue); border-color: var(--blue); color: white; }

      .pub-club-card {
        background: var(--navy-mid);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        transition: var(--transition);
        cursor: pointer;
      }
      .pub-club-card:hover { transform: translateY(-4px); box-shadow: 0 8px 30px rgba(0,0,0,0.3); border-color: rgba(255,255,255,0.15); }

      .pub-card-banner {
        height: 80px;
        display: flex; align-items: center; justify-content: center;
        font-size: 38px;
      }

      .pub-card-body { padding: 16px; }
      .pub-card-name { font-size: 15px; font-weight: 700; margin-bottom: 4px; }
      .pub-card-desc { font-size: 12.5px; color: var(--text-muted); line-height: 1.5; margin-bottom: 12px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

      .pub-card-footer {
        display: flex; justify-content: space-between; align-items: center;
        padding-top: 12px; border-top: 1px solid var(--border);
      }
    </style>

    <div id="cardsGrid" class="clubs-grid">

      <div class="pub-club-card" data-cat="Technical">
        <div class="pub-card-banner" style="background:linear-gradient(135deg,rgba(37,99,235,0.3),rgba(37,99,235,0.1))">💻</div>
        <div class="pub-card-body">
          <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:6px;">
            <div class="pub-card-name">IEEE Student Branch</div>
            <span class="badge badge-blue" style="font-size:10px;white-space:nowrap">Technical</span>
          </div>
          <div class="pub-card-desc">The IEEE Student Branch promotes technical excellence through workshops, competitions and industry networking events.</div>
          <div class="pub-card-footer">
            <div style="font-size:12px;color:var(--text-muted);">👤 64 Members</div>
            <button class="btn btn-primary btn-sm" onclick="openJoin('IEEE Student Branch')">Join Club</button>
          </div>
        </div>
      </div>

      <div class="pub-club-card" data-cat="Technical">
        <div class="pub-card-banner" style="background:linear-gradient(135deg,rgba(0,201,167,0.3),rgba(0,201,167,0.1))">🤖</div>
        <div class="pub-card-body">
          <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:6px;">
            <div class="pub-card-name">Robotics Club</div>
            <span class="badge badge-blue" style="font-size:10px;">Technical</span>
          </div>
          <div class="pub-card-desc">Build, program and compete with robots! We explore robotics, AI and automation technologies together.</div>
          <div class="pub-card-footer">
            <div style="font-size:12px;color:var(--text-muted);">👤 48 Members</div>
            <button class="btn btn-primary btn-sm" onclick="openJoin('Robotics Club')">Join Club</button>
          </div>
        </div>
      </div>

      <div class="pub-club-card" data-cat="Creative">
        <div class="pub-card-banner" style="background:linear-gradient(135deg,rgba(245,158,11,0.3),rgba(245,158,11,0.1))">📸</div>
        <div class="pub-card-body">
          <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:6px;">
            <div class="pub-card-name">Photography Club</div>
            <span class="badge badge-warn" style="font-size:10px;">Creative</span>
          </div>
          <div class="pub-card-desc">Capture the world through your lens. Weekly photo walks, editing tutorials and photography exhibitions.</div>
          <div class="pub-card-footer">
            <div style="font-size:12px;color:var(--text-muted);">👤 35 Members</div>
            <button class="btn btn-primary btn-sm" onclick="openJoin('Photography Club')">Join Club</button>
          </div>
        </div>
      </div>

      <div class="pub-club-card" data-cat="Sports">
        <div class="pub-card-banner" style="background:linear-gradient(135deg,rgba(16,185,129,0.3),rgba(16,185,129,0.1))">⚽</div>
        <div class="pub-card-body">
          <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:6px;">
            <div class="pub-card-name">Sports Club</div>
            <span class="badge badge-active" style="font-size:10px;">Sports</span>
          </div>
          <div class="pub-card-desc">Stay active and competitive! We organize inter-faculty sports tournaments and fitness activities.</div>
          <div class="pub-card-footer">
            <div style="font-size:12px;color:var(--text-muted);">👤 72 Members</div>
            <button class="btn btn-primary btn-sm" onclick="openJoin('Sports Club')">Join Club</button>
          </div>
        </div>
      </div>

      <div class="pub-club-card" data-cat="Academic">
        <div class="pub-card-banner" style="background:linear-gradient(135deg,rgba(148,163,184,0.2),rgba(148,163,184,0.05))">🎤</div>
        <div class="pub-card-body">
          <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:6px;">
            <div class="pub-card-name">Debate Club</div>
            <span class="badge badge-inactive" style="font-size:10px;">Academic</span>
          </div>
          <div class="pub-card-desc">Sharpen your critical thinking and public speaking skills. Participate in local and national debate competitions.</div>
          <div class="pub-card-footer">
            <div style="font-size:12px;color:var(--text-muted);">👤 29 Members</div>
            <button class="btn btn-ghost btn-sm" disabled style="opacity:0.5;cursor:not-allowed">Inactive</button>
          </div>
        </div>
      </div>

      <div class="pub-club-card" data-cat="Creative">
        <div class="pub-card-banner" style="background:linear-gradient(135deg,rgba(37,99,235,0.2),rgba(0,201,167,0.15))">🎵</div>
        <div class="pub-card-body">
          <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:6px;">
            <div class="pub-card-name">Music Club</div>
            <span class="badge badge-warn" style="font-size:10px;">Creative</span>
          </div>
          <div class="pub-card-desc">Play, perform and create music. We host jam sessions, open mic nights and music workshops every month.</div>
          <div class="pub-card-footer">
            <div style="font-size:12px;color:var(--text-muted);">👤 41 Members</div>
            <button class="btn btn-primary btn-sm" onclick="openJoin('Music Club')">Join Club</button>
          </div>
        </div>
      </div>

    </div><!-- /cardsGrid -->
  </div>
</div>

<!-- Join Club Modal -->
<div class="modal-overlay" id="joinModal">
  <div class="modal" style="width:380px;text-align:center">
    <div style="font-size:46px;margin-bottom:10px">🏛️</div>
    <div class="modal-title" style="margin-bottom:6px">Join <span id="joinClubName"></span>?</div>
    <p style="color:var(--text-muted);font-size:13.5px;margin-bottom:20px;line-height:1.6">
      Your membership request will be submitted. You'll be notified once approved by the club committee.
    </p>
    <div style="display:flex;gap:10px;justify-content:center;">
      <button class="btn btn-ghost" onclick="document.getElementById('joinModal').classList.remove('open')">Cancel</button>
      <button class="btn btn-accent" onclick="confirmJoin()">✅ Confirm Join</button>
    </div>
  </div>
</div>

<!-- Joined Success -->
<div class="modal-overlay" id="joinedModal">
  <div class="modal" style="width:360px;text-align:center">
    <div style="font-size:52px;margin-bottom:10px">🎉</div>
    <div class="modal-title" style="margin-bottom:8px">Request Sent!</div>
    <p style="color:var(--text-muted);font-size:14px;margin-bottom:20px">Your membership request has been submitted. The club committee will review it shortly.</p>
    <button class="btn btn-primary" onclick="document.getElementById('joinedModal').classList.remove('open')">OK</button>
  </div>
</div>

<script>
function openJoin(name) {
  document.getElementById('joinClubName').textContent = name;
  document.getElementById('joinModal').classList.add('open');
}

function confirmJoin() {
  document.getElementById('joinModal').classList.remove('open');
  document.getElementById('joinedModal').classList.add('open');
}

function setFilter(btn, cat) {
  document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
  btn.classList.add('active');
  const cards = document.querySelectorAll('#cardsGrid .pub-club-card');
  cards.forEach(c => {
    c.style.display = (cat === 'all' || c.dataset.cat === cat) ? 'block' : 'none';
  });
}

function filterCards(val) {
  const q = val.toLowerCase();
  document.querySelectorAll('#cardsGrid .pub-club-card').forEach(c => {
    const name = c.querySelector('.pub-card-name').textContent.toLowerCase();
    c.style.display = name.includes(q) ? 'block' : 'none';
  });
}
</script>
</body>
</html>
