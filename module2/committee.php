<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Committee Management — FK Club Management</title>
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
    <a href="committee.html" class="nav-item active"><span class="icon">👥</span> Committee</a>
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
      <h1>Committee Management</h1>
      <div class="breadcrumb">Module 2 · Manage Committee Roles</div>
    </div>
    <div class="topbar-actions">
      <select id="clubFilter" style="padding:9px 14px;border-radius:8px;font-size:13px;" onchange="filterClub()">
        <option>IEEE Student Branch</option>
        <option>Robotics Club</option>
        <option>Photography Club</option>
        <option>Sports Club</option>
      </select>
      <button class="btn btn-primary" onclick="document.getElementById('addModal').classList.add('open')">
        ➕ Assign Member
      </button>
    </div>
  </div>

  <div class="content">

    <!-- Club header strip -->
    <div class="card mb-4" style="padding:16px 20px;display:flex;align-items:center;gap:16px;margin-bottom:20px;">
      <div style="width:46px;height:46px;background:rgba(37,99,235,0.15);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:24px;flex-shrink:0;">💻</div>
      <div>
        <div style="font-size:16px;font-weight:700;">IEEE Student Branch</div>
        <div style="font-size:12px;color:var(--text-muted);">Technical · Advisor: Dr. Amirul Hassan · 64 Members</div>
      </div>
      <span class="badge badge-active" style="margin-left:auto;">● Active</span>
    </div>

    <!-- Committee Table -->
    <div class="card">
      <div class="card-header">
        <div>
          <div class="card-title">Committee Members</div>
          <div class="card-subtitle">5 members assigned · Session 2025/2026</div>
        </div>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Student ID</th>
              <th>Email</th>
              <th>Role</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="color:var(--text-muted);font-size:12px;">01</td>
              <td><strong>Ahmad Faris bin Zakaria</strong></td>
              <td class="font-mono" style="font-size:12px;">CB22056</td>
              <td style="color:var(--text-muted);font-size:12px;">faris@ump.edu.my</td>
              <td><span class="committee-badge role-president">President</span></td>
              <td style="font-size:12px;color:var(--text-muted);">01 Jan 2024</td>
              <td style="font-size:12px;color:var(--text-muted);">31 Dec 2024</td>
              <td><span class="badge badge-active">● Active</span></td>
              <td>
                <div style="display:flex;gap:6px;">
                  <button class="btn btn-ghost btn-sm" onclick="openEditRole('Ahmad Faris','President')">✏️</button>
                  <button class="btn btn-danger btn-sm" onclick="openRemove('Ahmad Faris')">✕</button>
                </div>
              </td>
            </tr>
            <tr>
              <td style="color:var(--text-muted);font-size:12px;">02</td>
              <td><strong>Nurul Huda binti Khalid</strong></td>
              <td class="font-mono" style="font-size:12px;">CB22089</td>
              <td style="color:var(--text-muted);font-size:12px;">huda@ump.edu.my</td>
              <td><span class="committee-badge role-vice">Vice President</span></td>
              <td style="font-size:12px;color:var(--text-muted);">01 Jan 2024</td>
              <td style="font-size:12px;color:var(--text-muted);">31 Dec 2024</td>
              <td><span class="badge badge-active">● Active</span></td>
              <td>
                <div style="display:flex;gap:6px;">
                  <button class="btn btn-ghost btn-sm" onclick="openEditRole('Nurul Huda','Vice President')">✏️</button>
                  <button class="btn btn-danger btn-sm" onclick="openRemove('Nurul Huda')">✕</button>
                </div>
              </td>
            </tr>
            <tr>
              <td style="color:var(--text-muted);font-size:12px;">03</td>
              <td><strong>Haziq bin Zulkifli</strong></td>
              <td class="font-mono" style="font-size:12px;">CB22103</td>
              <td style="color:var(--text-muted);font-size:12px;">haziq@ump.edu.my</td>
              <td><span class="committee-badge role-secretary">Secretary</span></td>
              <td style="font-size:12px;color:var(--text-muted);">01 Jan 2024</td>
              <td style="font-size:12px;color:var(--text-muted);">31 Dec 2024</td>
              <td><span class="badge badge-active">● Active</span></td>
              <td>
                <div style="display:flex;gap:6px;">
                  <button class="btn btn-ghost btn-sm" onclick="openEditRole('Haziq','Secretary')">✏️</button>
                  <button class="btn btn-danger btn-sm" onclick="openRemove('Haziq')">✕</button>
                </div>
              </td>
            </tr>
            <tr>
              <td style="color:var(--text-muted);font-size:12px;">04</td>
              <td><strong>Siti Aisyah binti Rahman</strong></td>
              <td class="font-mono" style="font-size:12px;">CB22114</td>
              <td style="color:var(--text-muted);font-size:12px;">aisyah@ump.edu.my</td>
              <td><span class="committee-badge role-treasurer">Treasurer</span></td>
              <td style="font-size:12px;color:var(--text-muted);">01 Jan 2024</td>
              <td style="font-size:12px;color:var(--text-muted);">31 Dec 2024</td>
              <td><span class="badge badge-active">● Active</span></td>
              <td>
                <div style="display:flex;gap:6px;">
                  <button class="btn btn-ghost btn-sm" onclick="openEditRole('Siti Aisyah','Treasurer')">✏️</button>
                  <button class="btn btn-danger btn-sm" onclick="openRemove('Siti Aisyah')">✕</button>
                </div>
              </td>
            </tr>
            <tr>
              <td style="color:var(--text-muted);font-size:12px;">05</td>
              <td><strong>Aiman bin Ridhwan</strong></td>
              <td class="font-mono" style="font-size:12px;">CB22078</td>
              <td style="color:var(--text-muted);font-size:12px;">aiman@ump.edu.my</td>
              <td><span class="committee-badge role-member">Committee</span></td>
              <td style="font-size:12px;color:var(--text-muted);">01 Jan 2024</td>
              <td style="font-size:12px;color:var(--text-muted);">31 Dec 2024</td>
              <td><span class="badge badge-active">● Active</span></td>
              <td>
                <div style="display:flex;gap:6px;">
                  <button class="btn btn-ghost btn-sm" onclick="openEditRole('Aiman','Committee')">✏️</button>
                  <button class="btn btn-danger btn-sm" onclick="openRemove('Aiman')">✕</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Assign Member Modal -->
<div class="modal-overlay" id="addModal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">➕ Assign Committee Member</div>
      <button class="modal-close" onclick="document.getElementById('addModal').classList.remove('open')">✕</button>
    </div>
    <div class="form-grid single">
      <div class="form-group">
        <label>Select Student *</label>
        <select>
          <option value="" disabled selected>Search student...</option>
          <option>CB23001 - Razif bin Ismail</option>
          <option>CB23012 - Liyana binti Ahmad</option>
          <option>CB23034 - Danial Hakim</option>
        </select>
      </div>
      <div class="form-group">
        <label>Assign Role *</label>
        <select>
          <option value="" disabled selected>Select role</option>
          <option>President</option>
          <option>Vice President</option>
          <option>Secretary</option>
          <option>Treasurer</option>
          <option>Committee Member</option>
        </select>
      </div>
      <div class="form-group">
        <label>Start Date *</label>
        <input type="date">
      </div>
      <div class="form-group">
        <label>End Date *</label>
        <input type="date">
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="document.getElementById('addModal').classList.remove('open')">Cancel</button>
      <button class="btn btn-primary" onclick="document.getElementById('addModal').classList.remove('open')">✅ Assign</button>
    </div>
  </div>
</div>

<!-- Edit Role Modal -->
<div class="modal-overlay" id="editRoleModal">
  <div class="modal" style="width:380px">
    <div class="modal-header">
      <div class="modal-title">✏️ Update Role</div>
      <button class="modal-close" onclick="document.getElementById('editRoleModal').classList.remove('open')">✕</button>
    </div>
    <p style="color:var(--text-muted);font-size:13px;margin-bottom:16px;">Updating role for <strong id="editName" style="color:var(--text)"></strong></p>
    <div class="form-group">
      <label>New Role *</label>
      <select id="editRoleSelect">
        <option>President</option>
        <option>Vice President</option>
        <option>Secretary</option>
        <option>Treasurer</option>
        <option>Committee Member</option>
      </select>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="document.getElementById('editRoleModal').classList.remove('open')">Cancel</button>
      <button class="btn btn-primary" onclick="document.getElementById('editRoleModal').classList.remove('open')">Save</button>
    </div>
  </div>
</div>

<!-- Remove Modal -->
<div class="modal-overlay" id="removeModal">
  <div class="modal" style="width:380px">
    <div class="modal-header">
      <div class="modal-title">⚠️ Remove Member</div>
      <button class="modal-close" onclick="document.getElementById('removeModal').classList.remove('open')">✕</button>
    </div>
    <p style="color:var(--text-muted);font-size:14px;">Remove <strong id="removeName" style="color:var(--text)"></strong> from the committee? Their membership record will remain.</p>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="document.getElementById('removeModal').classList.remove('open')">Cancel</button>
      <button class="btn btn-danger" onclick="document.getElementById('removeModal').classList.remove('open')">Remove</button>
    </div>
  </div>
</div>

<script>
function openEditRole(name, role) {
  document.getElementById('editName').textContent = name;
  document.getElementById('editRoleSelect').value = role;
  document.getElementById('editRoleModal').classList.add('open');
}
function openRemove(name) {
  document.getElementById('removeName').textContent = name;
  document.getElementById('removeModal').classList.add('open');
}
</script>
</body>
</html>
