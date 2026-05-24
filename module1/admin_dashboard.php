<?php
require_once '../config/db.config.php';
if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

// Fetch KPIs
$totalUsers = $conn->query("SELECT COUNT(*) FROM user")->fetchColumn();
$totalStudents = $conn->query("SELECT COUNT(*) FROM user WHERE user_type = 'Student'")->fetchColumn();
$totalCommittees = $conn->query("SELECT COUNT(*) FROM membership WHERE club_role != 'General Member'")->fetchColumn();
$totalClubs = $conn->query("SELECT COUNT(*) FROM club WHERE status = 'Active'")->fetchColumn();

// Join Table Report Requirement (Distinct to Module 1): Get Recent Users with Roles
$recentUsersQuery = "SELECT u.user_id, u.name, u.email, u.user_type, u.status 
                     FROM user u 
                     ORDER BY u.user_id DESC LIMIT 3";
$recentUsers = $conn->query($recentUsersQuery)->fetchAll();

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<h2>Admin Dashboard</h2>

<div class="kpi-container">
    <div class="kpi-card"><h5>Total Users</h5><p><?= $totalUsers; ?></p></div>
    <div class="kpi-card"><h5>Total Students</h5><p><?= $totalStudents; ?></p></div>
    <div class="kpi-card"><h5>Total Committees</h5><p><?= $totalCommittees; ?></p></div>
    <div class="kpi-card"><h5>Total Clubs</h5><p><?= $totalClubs; ?></p></div>
</div>

<h3>Recent Users</h3>
<table class="data-table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($recentUsers as $user): ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= htmlspecialchars($user['name']); ?></td>
            <td><?= htmlspecialchars($user['email']); ?></td>
            <td><?= htmlspecialchars($user['user_type']); ?></td>
            <td><?= htmlspecialchars($user['status']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="announcement-box">
    <h4>System Announcements/Notifications</h4>
    <p>System updates: Extracurricular points system updated according to Table A enforcement schedules.</p>
</div>

<?php include '../includes/footer.php'; ?>