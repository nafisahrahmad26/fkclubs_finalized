<?php
// Simulated event lookup (replace with DB query)
$event_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$events_db = [
    1 => ["title" => "Tech Innovation Summit 2026",       "date" => "2026-06-10", "venue" => "Main Hall, UMP",          "desc" => "An annual summit showcasing the latest technology innovations from students and industry leaders.", "seats" => 120],
    2 => ["title" => "Environmental Awareness Talk",       "date" => "2026-06-18", "venue" => "Auditorium A",            "desc" => "A talk focused on sustainability, green practices, and environmental responsibility.",             "seats" => 80],
    3 => ["title" => "Leadership & Management Workshop",   "date" => "2026-07-02", "venue" => "Room 204, Faculty Block", "desc" => "An interactive workshop to develop leadership and team management skills.",                     "seats" => 40],
    4 => ["title" => "Annual Sports Carnival",             "date" => "2026-07-15", "venue" => "UMP Sports Complex",      "desc" => "A fun-filled sports carnival open to all UMP students and staff.",                           "seats" => 300],
];
$event = $event_id && isset($events_db[$event_id]) ? $events_db[$event_id] : null;

// Handle form submission
$success = false;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['event_title'] ?? '');
    $date  = trim($_POST['event_date']  ?? '');
    $venue = trim($_POST['event_venue'] ?? '');
    $desc  = trim($_POST['description'] ?? '');
    $seats = trim($_POST['seats']       ?? '');
    $role  = trim($_POST['role']        ?? '');

    if (!$title) $errors[] = 'Event title is required.';
    if (!$date)  $errors[] = 'Date is required.';
    if (!$venue) $errors[] = 'Venue is required.';
    if (!$seats || !is_numeric($seats)) $errors[] = 'Valid seat number is required.';

    if (empty($errors)) {
        // In production: save to database
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration – UMP Event System</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy: #0b1c3a;
            --blue: #1a56db;
            --blue-light: #e8f0fe;
            --gold: #f5a623;
            --white: #ffffff;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-500: #64748b;
            --gray-700: #334155;
            --text: #0f172a;
            --red: #ef4444;
            --green: #16a34a;
            --sidebar-w: 210px;
            --header-h: 64px;
        }

        body {
            font-family: 'Sora', sans-serif;
            background: var(--gray-50);
            color: var(--text);
            min-height: 100vh;
        }

        /* ── HEADER ── */
        header {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            height: var(--header-h);
            background: var(--navy);
            display: flex; align-items: center;
            padding: 0 24px; gap: 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,.25);
        }
        .logo-block { display: flex; align-items: center; gap: 10px; }
        .logo-img {
            width: 36px; height: 36px; border-radius: 8px;
            background: var(--gold);
            display: flex; align-items: center; justify-content: center;
            font-family: 'IBM Plex Mono', monospace;
            font-weight: 500; font-size: 11px; color: var(--navy); flex-shrink: 0;
        }
        .logo-name { font-weight: 700; font-size: 15px; color: var(--white); }
        .logo-divider { width: 1px; height: 32px; background: rgba(255,255,255,.15); margin: 0 6px; }
        .page-title { flex: 1; text-align: center; font-size: 16px; font-weight: 600; color: var(--white); }
        .header-profile a {
            display: flex; align-items: center; gap: 8px;
            text-decoration: none; color: rgba(255,255,255,.85);
            font-size: 13px; font-weight: 500;
            padding: 6px 12px; border-radius: 8px;
            border: 1px solid rgba(255,255,255,.15); transition: background .2s;
        }
        .header-profile a:hover { background: rgba(255,255,255,.08); }
        .profile-avatar {
            width: 28px; height: 28px; border-radius: 50%;
            background: var(--gold); display: flex; align-items: center;
            justify-content: center; font-size: 12px; font-weight: 700; color: var(--navy);
        }

        /* ── SIDEBAR ── */
        aside {
            position: fixed; top: var(--header-h); left: 0; bottom: 0;
            width: var(--sidebar-w);
            background: var(--white);
            border-right: 1px solid var(--gray-200);
            padding: 20px 0; overflow-y: auto;
        }
        .nav-label {
            font-size: 10px; font-weight: 600; color: var(--gray-500);
            letter-spacing: 1px; text-transform: uppercase;
            padding: 10px 20px 6px;
        }
        aside a {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 20px; font-size: 13.5px; font-weight: 500;
            color: var(--gray-700); text-decoration: none;
            border-left: 3px solid transparent; transition: all .15s;
        }
        aside a:hover { background: var(--gray-100); color: var(--blue); }
        aside a.active { background: var(--blue-light); color: var(--blue); border-left-color: var(--blue); font-weight: 600; }
        .nav-icon { font-size: 16px; width: 20px; text-align: center; }

        /* ── MAIN ── */
        main {
            margin-left: var(--sidebar-w);
            margin-top: var(--header-h);
            padding: 28px 32px;
        }

        .breadcrumb {
            font-size: 12px; color: var(--gray-500); margin-bottom: 20px;
        }
        .breadcrumb a { color: var(--blue); text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }

        /* ── CARD ── */
        .form-card {
            background: var(--white);
            border-radius: 14px;
            border: 1px solid var(--gray-200);
            box-shadow: 0 2px 10px rgba(0,0,0,.06);
            max-width: 680px;
            overflow: hidden;
        }
        .form-card-header {
            padding: 20px 28px 16px;
            border-bottom: 1px solid var(--gray-100);
        }
        .form-card-header h2 {
            font-size: 19px; font-weight: 700; color: var(--navy); margin-bottom: 4px;
        }
        .form-card-header p { font-size: 13px; color: var(--gray-500); }

        .form-body { padding: 24px 28px; }

        /* ── ALERTS ── */
        .alert {
            padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;
            font-size: 13px; font-weight: 500;
        }
        .alert-success { background: #dcfce7; color: var(--green); border: 1px solid #bbf7d0; }
        .alert-error   { background: #fee2e2; color: var(--red);   border: 1px solid #fecaca; }
        .alert ul { margin: 4px 0 0 16px; }
        .alert li { margin-bottom: 2px; }

        /* ── SECTION DIVIDER ── */
        .section-label {
            font-size: 11px; font-weight: 600; color: var(--gray-500);
            text-transform: uppercase; letter-spacing: .9px;
            margin: 20px 0 12px;
            padding-bottom: 6px;
            border-bottom: 1px solid var(--gray-100);
        }

        /* ── FORM FIELDS ── */
        .field-group { margin-bottom: 16px; }
        .field-group label {
            display: block; font-size: 12.5px; font-weight: 600;
            color: var(--gray-700); margin-bottom: 6px;
        }
        .field-group label .required { color: var(--red); margin-left: 2px; }
        .field-group input[type="text"],
        .field-group input[type="date"],
        .field-group input[type="number"],
        .field-group textarea,
        .field-group select {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--gray-200);
            border-radius: 8px;
            font-family: 'Sora', sans-serif;
            font-size: 13.5px; color: var(--text);
            background: var(--white); outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .field-group input:focus,
        .field-group textarea:focus,
        .field-group select:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(26,86,219,.1);
        }
        .field-group textarea { resize: vertical; min-height: 80px; }
        .field-group input[type="number"] { font-family: 'IBM Plex Mono', monospace; }
        .field-hint { font-size: 11.5px; color: var(--gray-500); margin-top: 4px; }

        .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

        /* ── ACTIONS ── */
        .form-footer {
            padding: 18px 28px;
            border-top: 1px solid var(--gray-100);
            display: flex; align-items: center; gap: 12px;
            background: var(--gray-50);
        }
        .btn {
            display: inline-flex; align-items: center; gap: 6px;
            height: 42px; padding: 0 22px;
            border: none; border-radius: 8px;
            font-family: 'Sora', sans-serif;
            font-size: 13.5px; font-weight: 600;
            cursor: pointer; text-decoration: none;
            transition: all .2s;
        }
        .btn-primary { background: var(--blue); color: var(--white); }
        .btn-primary:hover { background: #1447c0; transform: translateY(-1px); }
        .btn-cancel {
            background: transparent; color: var(--gray-500);
            border: 1.5px solid var(--gray-200);
        }
        .btn-cancel:hover { background: var(--gray-100); color: var(--gray-700); }

        /* ── SUCCESS STATE ── */
        .success-card {
            text-align: center; padding: 56px 32px;
        }
        .success-icon {
            width: 72px; height: 72px; border-radius: 50%;
            background: #dcfce7; margin: 0 auto 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 32px;
        }
        .success-card h3 { font-size: 20px; font-weight: 700; color: var(--navy); margin-bottom: 8px; }
        .success-card p  { font-size: 14px; color: var(--gray-500); margin-bottom: 24px; }
    </style>
</head>
<body>

<!-- HEADER -->
<header>
    <div class="logo-block">
        <div class="logo-img">UMP</div>
        <span class="logo-name">UMP</span>
    </div>
    <div class="logo-divider"></div>
    <div class="logo-block">
        <div class="logo-img" style="background:#1a56db;color:#fff;font-size:10px;">SYS</div>
        <span class="logo-name" style="font-weight:400;font-size:13px;color:rgba(255,255,255,.7);">Event System</span>
    </div>
    <div class="page-title">Event Registration</div>
    <div class="header-profile">
        <a href="#">
            <div class="profile-avatar">A</div>
            Profile
        </a>
    </div>
</header>

<!-- SIDEBAR -->
<aside>
    <div class="nav-label">Menu</div>
    <a href="#"><span class="nav-icon">🏠</span> Dashboard</a>
    <a href="event_list.php" class="active"><span class="nav-icon">📅</span> Events</a>
    <a href="#"><span class="nav-icon">📋</span> My Registration</a>
    <a href="#"><span class="nav-icon">🔔</span> Notifications</a>
    <a href="#" style="color:#ef4444;margin-top:12px;"><span class="nav-icon">🚪</span> Logout</a>
</aside>

<!-- MAIN -->
<main>
    <div class="breadcrumb">
        <a href="event_list.php">Events</a> / Event Registration
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <h2>Event Details</h2>
            <p>Fill in the information below to register a new event.</p>
        </div>

        <?php if ($success): ?>
        <div class="success-card">
            <div class="success-icon">✅</div>
            <h3>Registration Submitted!</h3>
            <p>The event has been successfully registered in the system.</p>
            <a href="event_list.php" class="btn btn-primary">← Back to Event List</a>
        </div>

        <?php else: ?>

        <form method="POST" action="event_registration.php<?= $event_id ? "?id=$event_id" : '' ?>">
            <div class="form-body">

                <?php if (!empty($errors)): ?>
                <div class="alert alert-error">
                    <strong>Please fix the following:</strong>
                    <ul>
                        <?php foreach ($errors as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <div class="section-label">Basic Information</div>

                <div class="field-group">
                    <label for="event_title">Event Title <span class="required">*</span></label>
                    <input type="text" id="event_title" name="event_title" placeholder="Enter event title"
                        value="<?= htmlspecialchars($_POST['event_title'] ?? $event['title'] ?? '') ?>">
                </div>

                <div class="field-row">
                    <div class="field-group">
                        <label for="event_date">Date <span class="required">*</span></label>
                        <input type="date" id="event_date" name="event_date"
                            value="<?= htmlspecialchars($_POST['event_date'] ?? $event['date'] ?? '') ?>">
                    </div>
                    <div class="field-group">
                        <label for="event_venue">Venue <span class="required">*</span></label>
                        <input type="text" id="event_venue" name="event_venue" placeholder="e.g. Main Hall"
                            value="<?= htmlspecialchars($_POST['event_venue'] ?? $event['venue'] ?? '') ?>">
                    </div>
                </div>

                <div class="field-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Brief description of the event..."><?= htmlspecialchars($_POST['description'] ?? $event['desc'] ?? '') ?></textarea>
                </div>

                <div class="section-label">Registration Settings</div>

                <div class="field-group">
                    <label for="seats">Seats Available <span class="required">*</span></label>
                    <input type="number" id="seats" name="seats" placeholder="e.g. 100" min="1"
                        value="<?= htmlspecialchars($_POST['seats'] ?? $event['seats'] ?? '') ?>">
                    <div class="field-hint">Maximum number of participants that can register.</div>
                </div>

                <div class="field-group">
                    <label for="role">Choose Role (if any)</label>
                    <select id="role" name="role">
                        <option value="" <?= empty($_POST['role']) ? 'selected' : '' ?>>— Select a role —</option>
                        <option value="participant"  <?= ($_POST['role'] ?? '') === 'participant'  ? 'selected' : '' ?>>Participant</option>
                        <option value="volunteer"    <?= ($_POST['role'] ?? '') === 'volunteer'    ? 'selected' : '' ?>>Volunteer</option>
                        <option value="committee"    <?= ($_POST['role'] ?? '') === 'committee'    ? 'selected' : '' ?>>Committee Member</option>
                        <option value="speaker"      <?= ($_POST['role'] ?? '') === 'speaker'      ? 'selected' : '' ?>>Speaker / Presenter</option>
                        <option value="organizer"    <?= ($_POST['role'] ?? '') === 'organizer'    ? 'selected' : '' ?>>Organizer</option>
                    </select>
                </div>

            </div><!-- /form-body -->

            <div class="form-footer">
                <button type="submit" class="btn btn-primary">✓ Register</button>
                <a href="event_list.php" class="btn btn-cancel">Cancel</a>
            </div>
        </form>

        <?php endif; ?>
    </div><!-- /form-card -->
</main>

</body>
</html>