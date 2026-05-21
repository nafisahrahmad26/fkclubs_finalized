<?php
require_once 'config.php';
$pdo = getDB();

$search = $_GET['search'] ?? '';
$filter_date = $_GET['filter_date'] ?? '';

$sql = "SELECT e.*, c.club_name
        FROM event e
        LEFT JOIN club c ON e.club_id = c.club_id
        WHERE 1=1";

$params = [];

if (!empty($search)) {
    $sql .= " AND e.event_name LIKE :search";
    $params[':search'] = "%$search%";
}

if (!empty($filter_date)) {
    $sql .= " AND e.event_date = :date";
    $params[':date'] = $filter_date;
}

$sql .= " ORDER BY e.event_date ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$events = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Event List</title>

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

/* CARD */
.card {
    background:white;
    border:1px solid var(--gray-200);
    border-radius:14px;
    padding:20px;
    box-shadow:0 2px 10px rgba(0,0,0,.06);
}

/* TOOLBAR */
.toolbar {
    display:flex;
    gap:10px;
    margin-bottom:20px;
    flex-wrap:wrap;
}

.toolbar input {
    padding:10px;
    border:1px solid var(--gray-200);
    border-radius:8px;
}

.btn {
    padding:10px 14px;
    background:var(--blue);
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

.btn-add {
    margin-left:auto;
    background:var(--navy);
    color:white;
    padding:10px 14px;
    text-decoration:none;
    border-radius:8px;
}

/* TABLE */
table {
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

th {
    background:var(--blue);
    color:white;
    padding:12px;
}

td {
    padding:12px;
    border-bottom:1px solid var(--gray-200);
}

tr:hover {
    background:var(--gray-100);
}

.badge {
    background:var(--green);
    color:white;
    padding:4px 10px;
    border-radius:12px;
    font-size:12px;
}

.btn-view {
    background:var(--green);
    color:white;
    padding:6px 10px;
    border-radius:6px;
    text-decoration:none;
}
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
    

<div class="card">

<h2>
    Event List
    <span class="badge"><?= count($events) ?> events</span>
</h2>

<form method="GET">
<div class="toolbar">
    <input type="text" name="search" placeholder="Search event..." value="<?= htmlspecialchars($search) ?>">
    <input type="date" name="filter_date" value="<?= htmlspecialchars($filter_date) ?>">

    <button class="btn" type="submit">Search</button>

    <?php if ($search || $filter_date): ?>
        <a href="event_list.php">Clear</a>
    <?php endif; ?>

    <a href="event_registration.php" class="btn-add">+ New Event</a>
</div>
</form>

<table>

<thead>
<tr>
    <th>No</th>
    <th>Event Name</th>
    <th>Club</th>
    <th>Date</th>
    <th>Time</th>
    <th>Venue</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

<?php if (empty($events)): ?>
<tr>
    <td colspan="7" style="text-align:center;color:gray;padding:20px;">
        No events found
    </td>
</tr>
<?php else: ?>

<?php foreach ($events as $i => $e): ?>
<tr>
    <td><?= $i + 1 ?></td>
    <td><b><?= htmlspecialchars($e['event_name']) ?></b></td>
    <td><?= htmlspecialchars($e['club_name'] ?? '-') ?></td>
    <td><?= $e['event_date'] ?></td>
    <td><?= $e['event_time'] ?></td>
    <td><?= htmlspecialchars($e['venue']) ?></td>
    <td>
        <a class="btn-view" href="event_registration.php?id=<?= $e['event_id'] ?>">
            View
        </a>
    </td>
</tr>
<?php endforeach; ?>

<?php endif; ?>

</tbody>

</table>

</div>

</main>

</body>
</html>