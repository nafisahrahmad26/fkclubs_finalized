<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Club — FK Club Management</title>
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
    <a href="club_create.html" class="nav-item active"><span class="icon">➕</span> Create Club</a>
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
      <h1>Create New Club</h1>
      <div class="breadcrumb">Module 2 · Clubs · Create</div>
    </div>
    <div class="topbar-actions">
      <a href="club_list.html" class="btn btn-ghost">← Back to List</a>
    </div>
  </div>

  <div class="content">
    <div style="max-width:720px;margin:0 auto;">
      <div class="card">
        <div class="card-header">
          <div>
            <div class="card-title">Club Information</div>
            <div class="card-subtitle">Fill in all required fields to register a new student club</div>
          </div>
        </div>

        <form id="clubForm">
          <div class="form-grid">

            <div class="form-group">
              <label>Club Name *</label>
              <input type="text" placeholder="e.g. IEEE Student Branch" required>
            </div>

            <div class="form-group">
              <label>Club Category *</label>
              <select required>
                <option value="" disabled selected>Select category</option>
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
              <textarea placeholder="Describe the club's purpose, goals and activities..." required></textarea>
            </div>

            <div class="form-group">
              <label>Faculty Advisor *</label>
              <select required>
                <option value="" disabled selected>Select advisor</option>
                <option>Dr. Amirul Hassan</option>
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
              <input type="date">
            </div>

            <div class="form-group">
              <label>Max Members</label>
              <input type="number" placeholder="e.g. 100" min="1">
            </div>

            <div class="form-group full">
              <label>Club Logo / Image (optional)</label>
              <div id="dropzone" style="
                border: 2px dashed var(--border);
                border-radius: var(--radius-sm);
                padding: 30px;
                text-align: center;
                color: var(--text-muted);
                cursor: pointer;
                transition: var(--transition);
              " onclick="document.getElementById('fileInput').click()"
                 ondragover="event.preventDefault();this.style.borderColor='var(--blue)'"
                 ondragleave="this.style.borderColor='var(--border)'">
                <div style="font-size:32px;margin-bottom:8px">🖼️</div>
                <div style="font-size:13px">Drag & drop or <span style="color:var(--blue-light)">browse</span></div>
                <div style="font-size:11px;margin-top:4px">PNG, JPG up to 2MB</div>
                <input type="file" id="fileInput" accept="image/*" style="display:none"
                       onchange="showPreview(event)">
              </div>
              <img id="preview" src="" alt="" style="display:none;max-height:120px;border-radius:8px;margin-top:10px">
            </div>

          </div><!-- /form-grid -->

          <div class="divider"></div>

          <div style="display:flex;gap:10px;justify-content:flex-end;">
            <a href="club_list.html" class="btn btn-ghost">Cancel</a>
            <button type="button" class="btn btn-ghost" onclick="resetForm()">🔄 Reset</button>
            <button type="submit" class="btn btn-primary" onclick="submitForm(event)">✅ Create Club</button>
          </div>
        </form>
      </div><!-- /card -->
    </div>
  </div>
</div>

<!-- Success Modal -->
<div class="modal-overlay" id="successModal">
  <div class="modal" style="width:380px;text-align:center">
    <div style="font-size:52px;margin-bottom:12px">🎉</div>
    <div class="modal-title" style="font-size:18px;margin-bottom:8px">Club Created!</div>
    <p style="color:var(--text-muted);font-size:14px;margin-bottom:20px">
      The new club has been successfully registered in the system.
    </p>
    <div style="display:flex;gap:10px;justify-content:center;">
      <a href="club_list.html" class="btn btn-ghost">View All Clubs</a>
      <a href="committee.html" class="btn btn-primary">Assign Committee →</a>
    </div>
  </div>
</div>

<script>
function showPreview(event) {
  const file = event.target.files[0];
  if (!file) return;
  const preview = document.getElementById('preview');
  preview.src = URL.createObjectURL(file);
  preview.style.display = 'block';
}

function resetForm() {
  document.getElementById('clubForm').reset();
  document.getElementById('preview').style.display = 'none';
}

function submitForm(e) {
  e.preventDefault();
  document.getElementById('successModal').classList.add('open');
}
</script>
</body>
</html>
