<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Club Dashboard — FK Club Management</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
  <div class="sidebar-logo">
    <div class="logo-icon">🎓</div>
    <h2>FK Club Management</h2>
    <span>BCS2243 · Module 2</span>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-section-label">Overview</div>
    <a href="dashboard.html" class="nav-item active">
      <span class="icon">📊</span> Dashboard
    </a>
    <div class="nav-section-label">Clubs</div>
    <a href="club_list.html" class="nav-item">
      <span class="icon">🏛️</span> Club List
    </a>
    <a href="club_create.html" class="nav-item">
      <span class="icon">➕</span> Create Club
    </a>
    <a href="committee.html" class="nav-item">
      <span class="icon">👥</span> Committee
    </a>
    <div class="nav-section-label">View</div>
    <a href="club_detail.html" class="nav-item">
      <span class="icon">🔍</span> Club Detail
    </a>
    <a href="club_public.html" class="nav-item">
      <span class="icon">🌐</span> Public View
    </a>
  </nav>
  <div class="sidebar-footer">
    <div class="user-badge">
      <div class="user-avatar">AD</div>
      <div class="user-info">
        <div class="user-name">Admin</div>
        <div class="user-role">Administrator</div>
      </div>
    </div>
  </div>
</aside>

<!-- Main -->
<div class="main">
  <!-- Topbar -->
  <div class="topbar">
    <div class="topbar-left">
      <h1>Club Management Dashboard</h1>
      <div class="breadcrumb">Module 2 · Overview</div>
    </div>
    <div class="topbar-actions">
      <a href="club_create.html" class="btn btn-primary">
        <span>➕</span> New Club
      </a>
    </div>
  </div>

  <!-- Content -->
  <div class="content">

    <!-- Stat Cards -->
    <div class="stats-grid">
      <div class="stat-card blue">
        <div class="stat-icon">🏛️</div>
        <div class="stat-value">12</div>
        <div class="stat-label">Total Clubs</div>
        <div class="stat-badge up">↑ 2 this semester</div>
      </div>
      <div class="stat-card accent">
        <div class="stat-icon">✅</div>
        <div class="stat-value">9</div>
        <div class="stat-label">Active Clubs</div>
        <div class="stat-badge up">75% active rate</div>
      </div>
      <div class="stat-card warn">
        <div class="stat-icon">👤</div>
        <div class="stat-value">347</div>
        <div class="stat-label">Students in Clubs</div>
        <div class="stat-badge up">↑ 28 new</div>
      </div>
      <div class="stat-card danger">
        <div class="stat-icon">🚫</div>
        <div class="stat-value">3</div>
        <div class="stat-label">Inactive Clubs</div>
        <div class="stat-badge down">Needs review</div>
      </div>
    </div>

    <!-- Charts Row -->
    <div class="chart-container">
      <!-- Bar chart: students per club -->
      <div class="chart-box">
        <div class="card-header">
          <div>
            <div class="card-title">Students per Club</div>
            <div class="card-subtitle">Top 6 clubs by membership</div>
          </div>
        </div>
        <canvas id="barChart" height="180"></canvas>
      </div>

      <!-- Doughnut chart: category distribution -->
      <div class="chart-box">
        <div class="card-header">
          <div>
            <div class="card-title">Club Categories</div>
            <div class="card-subtitle">Distribution by type</div>
          </div>
        </div>
        <canvas id="donutChart" height="180"></canvas>
      </div>
    </div>

    <!-- Recent Clubs Table -->
    <div class="card">
      <div class="card-header">
        <div>
          <div class="card-title">Recently Added Clubs</div>
          <div class="card-subtitle">Last 5 registered clubs</div>
        </div>
        <a href="club_list.html" class="btn btn-ghost btn-sm">View All →</a>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Club Name</th>
              <th>Category</th>
              <th>Members</th>
              <th>Advisor</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>IEEE Student Branch</strong></td>
              <td><span class="badge badge-blue">Technical</span></td>
              <td class="font-mono">64</td>
              <td>Dr. Amirul Hassan</td>
              <td><span class="badge badge-active">● Active</span></td>
              <td><a href="club_detail.html" class="btn btn-ghost btn-sm">View</a></td>
            </tr>
            <tr>
              <td><strong>Robotics Club</strong></td>
              <td><span class="badge badge-blue">Technical</span></td>
              <td class="font-mono">48</td>
              <td>Dr. Siti Norhaida</td>
              <td><span class="badge badge-active">● Active</span></td>
              <td><a href="club_detail.html" class="btn btn-ghost btn-sm">View</a></td>
            </tr>
            <tr>
              <td><strong>Photography Club</strong></td>
              <td><span class="badge badge-warn">Creative</span></td>
              <td class="font-mono">35</td>
              <td>Pn. Hafizah Zain</td>
              <td><span class="badge badge-active">● Active</span></td>
              <td><a href="club_detail.html" class="btn btn-ghost btn-sm">View</a></td>
            </tr>
            <tr>
              <td><strong>Sports Club</strong></td>
              <td><span class="badge badge-warn">Sports</span></td>
              <td class="font-mono">72</td>
              <td>En. Faizal Mokhtar</td>
              <td><span class="badge badge-active">● Active</span></td>
              <td><a href="club_detail.html" class="btn btn-ghost btn-sm">View</a></td>
            </tr>
            <tr>
              <td><strong>Debate Club</strong></td>
              <td><span class="badge badge-blue">Academic</span></td>
              <td class="font-mono">29</td>
              <td>Dr. Rohana Yusof</td>
              <td><span class="badge badge-inactive">○ Inactive</span></td>
              <td><a href="club_detail.html" class="btn btn-ghost btn-sm">View</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div><!-- /content -->
</div><!-- /main -->

<script>
// Bar Chart
const barCtx = document.getElementById('barChart').getContext('2d');
new Chart(barCtx, {
  type: 'bar',
  data: {
    labels: ['IEEE','Robotics','Sports','Photography','Debate','Music'],
    datasets: [{
      label: 'Members',
      data: [64, 48, 72, 35, 29, 41],
      backgroundColor: [
        'rgba(37,99,235,0.7)','rgba(37,99,235,0.7)','rgba(0,201,167,0.7)',
        'rgba(245,158,11,0.7)','rgba(148,163,184,0.4)','rgba(0,201,167,0.7)'
      ],
      borderRadius: 6,
      borderSkipped: false,
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { display: false } },
    scales: {
      x: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8', font: { size: 11 } } },
      y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8', font: { size: 11 } } }
    }
  }
});

// Donut Chart
const donutCtx = document.getElementById('donutChart').getContext('2d');
new Chart(donutCtx, {
  type: 'doughnut',
  data: {
    labels: ['Technical','Academic','Creative','Sports','Others'],
    datasets: [{
      data: [4, 3, 2, 2, 1],
      backgroundColor: ['#2563eb','#00c9a7','#f59e0b','#10b981','#94a3b8'],
      borderWidth: 0,
      hoverOffset: 6
    }]
  },
  options: {
    responsive: true,
    cutout: '65%',
    plugins: {
      legend: {
        position: 'right',
        labels: { color: '#94a3b8', font: { size: 12 }, padding: 12, boxWidth: 12 }
      }
    }
  }
});
</script>
</body>
</html>
