<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Club — FK Club Management</title>
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
    <a href="club_public.html" class="nav-item"><span class="icon">🌐</span> Public View</a>
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

<div class="main">
  <div class="topbar">
    <div class="topbar-left">
      <h1>Edit Club</h1>
      <div class="breadcrumb">Module 2 · Clubs · IEEE Student Branch · Edit</div>
    </div>
    <div class="topbar-actions">
      <a href="club_detail.html" class="btn btn-ghost">← Back to Detail</a>
    </div>
  </div>

  <div class="content">
    <div style="max-width:720px;margin:0 auto;">

      <!-- Edit notice -->
      <div style="background:rgba(245,158,11,0.1);border:1px solid rgba(245,158,11,0.3);border-radius:var(--radius-sm);padding:12px 16px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
        <span style="font-size:18px;">⚠️</span>
        <div style="font-size:13px;color:var(--warning);">You are editing <strong>IEEE Student Branch</strong>. Changes will be saved immediately.</div>
      </div>

      <div class="card">
        <div class="card-header">
          <div>
            <div class="card-title">Edit Club Information</div>
            <div class="card-subtitle">Update the details below and save changes</div>
          </div>
        </div>

        <form>
          <div class="form-grid">

            <div class="form-group">
              <label>Club Name *</label>
              <input type="text" value="IEEE Student Branch" required>
            </div>

            <div class="form-group">
              <label>Club Category *</label>
              <select required>
                <option>Technical</option>
                <option>Academic</option>
                <option>Creative</option>
                <option>Sports</option>
                <option>Cultural</option>
                <option>Others</option>
              </select>
            </div>

            <div class="form-group full">
              <label>Club Description *</label>
              <textarea required>The IEEE Student Branch at FK UMPSA promotes technical excellence among students through workshops, competitions and networking events with industry professionals.</textarea>
            </div>

            <div class="form-group">
              <label>Faculty Advisor *</label>
              <select required>
                <option selected>Dr. Amirul Hassan</option>
                <option>Dr. Siti Norhaida</option>
                <option>Pn. Hafizah Zain</option>
                <option>En. Faizal Mokhtar</option>
                <option>Dr. Rohana Yusof</option>
              </select>
            </div>

            <div class="form-group">
              <label>Status *</label>
              <select required>
                <option value="active" selected>Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>

            <div class="form-group">
              <label>Establishment Date</label>
              <input type="date" value="2023-01-12">
            </div>

            <div class="form-group">
              <label>Max Members</label>
              <input type="number" value="100" min="1">
            </div>

          </div>

          <div class="divider"></div>

          <div style="display:flex;gap:10px;justify-content:flex-end;">
            <a href="club_detail.html" class="btn btn-ghost">Cancel</a>
            <button type="button" class="btn btn-primary" onclick="document.getElementById('saveModal').classList.add('open')">💾 Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Save Success Modal -->
<div class="modal-overlay" id="saveModal">
  <div class="modal" style="width:360px;text-align:center">
    <div style="font-size:48px;margin-bottom:12px">✅</div>
    <div class="modal-title" style="margin-bottom:8px">Changes Saved!</div>
    <p style="color:var(--text-muted);font-size:14px;margin-bottom:20px">Club information has been updated successfully.</p>
    <div style="display:flex;gap:10px;justify-content:center;">
      <a href="club_list.html" class="btn btn-ghost">Club List</a>
      <a href="club_detail.html" class="btn btn-primary">View Club →</a>
    </div>
  </div>
</div>

</body>
</html>
