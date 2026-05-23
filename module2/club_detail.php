<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Club Detail — FK Club Management</title>
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
    <a href="club_detail.html" class="nav-item active"><span class="icon">🔍</span> Club Detail</a>
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
      <h1>Club Detail</h1>
      <div class="breadcrumb">Module 2 · Clubs · IEEE Student Branch</div>
    </div>
    <div class="topbar-actions">
      <a href="club_list.html" class="btn btn-ghost">← Back</a>
      <a href="club_edit.html" class="btn btn-primary">✏️ Edit Club</a>
      <button class="btn btn-danger" onclick="document.getElementById('deactivateModal').classList.add('open')">🚫 Deactivate</button>
    </div>
  </div>

  <div class="content">

    <!-- Club Header Banner -->
    <div class="card mb-4" style="background:linear-gradient(135deg,var(--navy-light),var(--navy-mid));border-color:rgba(37,99,235,0.3);">
      <div style="display:flex;align-items:center;gap:20px;">
        <div style="width:72px;height:72px;background:rgba(37,99,235,0.2);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:36px;flex-shrink:0;">💻</div>
        <div style="flex:1;">
          <div style="display:flex;align-items:center;gap:12px;margin-bottom:6px;">
            <h2 style="font-size:22px;font-weight:700;">IEEE Student Branch</h2>
            <span class="badge badge-active">● Active</span>
            <span class="badge badge-blue">Technical</span>
          </div>
          <div style="color:var(--text-muted);font-size:13.5px;line-height:1.6;max-width:600px;">
            The IEEE Student Branch at FK UMPSA promotes technical excellence among students through workshops, competitions and networking events with industry professionals.
          </div>
        </div>
        <div style="display:flex;gap:24px;text-align:center;flex-shrink:0;">
          <div>
            <div style="font-size:26px;font-weight:700;color:var(--blue-light);font-family:'JetBrains Mono',monospace;">64</div>
            <div style="font-size:11px;color:var(--text-muted);">Members</div>
          </div>
          <div>
            <div style="font-size:26px;font-weight:700;color:var(--accent);font-family:'JetBrains Mono',monospace;">8</div>
            <div style="font-size:11px;color:var(--text-muted);">Events</div>
          </div>
          <div>
            <div style="font-size:26px;font-weight:700;color:var(--warning);font-family:'JetBrains Mono',monospace;">5</div>
            <div style="font-size:11px;color:var(--text-muted);">Committee</div>
          </div>
        </div>
      </div>
    </div>

    <div class="two-col">
      <!-- Club Info -->
      <div style="display:flex;flex-direction:column;gap:16px;">
        <div class="card">
          <div class="card-header"><div class="card-title">Club Information</div></div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div>
              <div style="font-size:11px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.8px;margin-bottom:4px;">Club ID</div>
              <div class="font-mono" style="font-size:14px;">CLB-001</div>
            </div>
            <div>
              <div style="font-size:11px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.8px;margin-bottom:4px;">Category</div>
              <div style="font-size:14px;">Technical</div>
            </div>
            <div>
              <div style="font-size:11px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.8px;margin-bottom:4px;">Faculty Advisor</div>
              <div style="font-size:14px;">Dr. Amirul Hassan</div>
            </div>
            <div>
              <div style="font-size:11px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.8px;margin-bottom:4px;">Established</div>
              <div style="font-size:14px;">12 Jan 2023</div>
            </div>
            <div>
              <div style="font-size:11px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.8px;margin-bottom:4px;">Max Members</div>
              <div style="font-size:14px;">100 slots</div>
            </div>
            <div>
              <div style="font-size:11px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.8px;margin-bottom:4px;">Status</div>
              <span class="badge badge-active">● Active</span>
            </div>
          </div>
        </div>

        <!-- Committee -->
        <div class="card">
          <div class="card-header">
            <div class="card-title">Committee Members</div>
            <a href="committee.html" class="btn btn-ghost btn-sm">Manage →</a>
          </div>
          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Student ID</th>
                  <th>Role</th>
                  <th>Since</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>Ahmad Faris</strong></td>
                  <td class="font-mono" style="font-size:12px;">CB22056</td>
                  <td><span class="committee-badge role-president">President</span></td>
                  <td style="color:var(--text-muted);font-size:12px;">Jan 2024</td>
                </tr>
                <tr>
                  <td><strong>Nurul Huda</strong></td>
                  <td class="font-mono" style="font-size:12px;">CB22089</td>
                  <td><span class="committee-badge role-vice">Vice President</span></td>
                  <td style="color:var(--text-muted);font-size:12px;">Jan 2024</td>
                </tr>
                <tr>
                  <td><strong>Haziq Zulkifli</strong></td>
                  <td class="font-mono" style="font-size:12px;">CB22103</td>
                  <td><span class="committee-badge role-secretary">Secretary</span></td>
                  <td style="color:var(--text-muted);font-size:12px;">Jan 2024</td>
                </tr>
                <tr>
                  <td><strong>Siti Aisyah</strong></td>
                  <td class="font-mono" style="font-size:12px;">CB22114</td>
                  <td><span class="committee-badge role-treasurer">Treasurer</span></td>
                  <td style="color:var(--text-muted);font-size:12px;">Jan 2024</td>
                </tr>
                <tr>
                  <td><strong>Aiman Ridhwan</strong></td>
                  <td class="font-mono" style="font-size:12px;">CB22078</td>
                  <td><span class="committee-badge role-member">Committee</span></td>
                  <td style="color:var(--text-muted);font-size:12px;">Jan 2024</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Right Column -->
      <div style="display:flex;flex-direction:column;gap:16px;">
        <!-- Recent Events -->
        <div class="card">
          <div class="card-header">
            <div class="card-title">Recent Events</div>
          </div>
          <div style="display:flex;flex-direction:column;gap:10px;">
            <div style="padding:12px;background:var(--card);border-radius:8px;border-left:3px solid var(--blue);">
              <div style="font-size:13.5px;font-weight:600;margin-bottom:3px;">IEEE Tech Talk 2026</div>
              <div style="font-size:11.5px;color:var(--text-muted);">15 May 2026 · Dewan Kuliah A</div>
              <div style="margin-top:6px;"><span class="badge badge-active" style="font-size:10px;">● Completed</span></div>
            </div>
            <div style="padding:12px;background:var(--card);border-radius:8px;border-left:3px solid var(--accent);">
              <div style="font-size:13.5px;font-weight:600;margin-bottom:3px;">Hackathon UMPSA 2026</div>
              <div style="font-size:11.5px;color:var(--text-muted);">22 Jun 2026 · Computer Lab 1</div>
              <div style="margin-top:6px;"><span class="badge badge-blue" style="font-size:10px;">● Upcoming</span></div>
            </div>
            <div style="padding:12px;background:var(--card);border-radius:8px;border-left:3px solid var(--warning);">
              <div style="font-size:13.5px;font-weight:600;margin-bottom:3px;">Arduino Workshop</div>
              <div style="font-size:11.5px;color:var(--text-muted);">8 Apr 2026 · Lab Elektronik</div>
              <div style="margin-top:6px;"><span class="badge badge-active" style="font-size:10px;">● Completed</span></div>
            </div>
          </div>
        </div>

        <!-- Quick Stats -->
        <div class="card">
          <div class="card-title" style="margin-bottom:16px;">Membership Breakdown</div>
          <div style="display:flex;flex-direction:column;gap:10px;">
            <div>
              <div style="display:flex;justify-content:space-between;font-size:12.5px;margin-bottom:4px;">
                <span>Undergraduate</span><span style="color:var(--blue-light);font-weight:600;">52</span>
              </div>
              <div style="height:6px;background:rgba(255,255,255,0.08);border-radius:3px;">
                <div style="height:100%;width:81%;background:var(--blue);border-radius:3px;"></div>
              </div>
            </div>
            <div>
              <div style="display:flex;justify-content:space-between;font-size:12.5px;margin-bottom:4px;">
                <span>Postgraduate</span><span style="color:var(--accent);font-weight:600;">8</span>
              </div>
              <div style="height:6px;background:rgba(255,255,255,0.08);border-radius:3px;">
                <div style="height:100%;width:13%;background:var(--accent);border-radius:3px;"></div>
              </div>
            </div>
            <div>
              <div style="display:flex;justify-content:space-between;font-size:12.5px;margin-bottom:4px;">
                <span>Committee</span><span style="color:var(--warning);font-weight:600;">4</span>
              </div>
              <div style="height:6px;background:rgba(255,255,255,0.08);border-radius:3px;">
                <div style="height:100%;width:6%;background:var(--warning);border-radius:3px;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Deactivate Modal -->
<div class="modal-overlay" id="deactivateModal">
  <div class="modal" style="width:400px">
    <div class="modal-header">
      <div class="modal-title">🚫 Deactivate Club</div>
      <button class="modal-close" onclick="document.getElementById('deactivateModal').classList.remove('open')">✕</button>
    </div>
    <p style="color:var(--text-muted);font-size:14px;line-height:1.6;">
      Deactivating <strong style="color:var(--text)">IEEE Student Branch</strong> will hide it from students.
      All data including members, events and attendance will be preserved.
    </p>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="document.getElementById('deactivateModal').classList.remove('open')">Cancel</button>
      <button class="btn btn-danger">Confirm Deactivate</button>
    </div>
  </div>
</div>

</body>
</html>
