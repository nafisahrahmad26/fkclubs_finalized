<?php
require_once 'config/db.config.php';
if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

// Kira Total Users
$res1 = mysqli_query($conn, "SELECT COUNT(*) as total FROM user");
$row1 = mysqli_fetch_assoc($res1);
$totalUsers = $row1['total'];

// Kira Total Students
$res2 = mysqli_query($conn, "SELECT COUNT(*) as total FROM user WHERE user_type = 'Student'");
$row2 = mysqli_fetch_assoc($res2);
$totalStudents = $row2['total'];

// Kira Total Committees
$res3 = mysqli_query($conn, "SELECT COUNT(*) as total FROM membership WHERE club_role != 'General Member'");
$row3 = mysqli_fetch_assoc($res3);
$totalCommittees = $row3['total'];

// Kira Total Clubs
$res4 = mysqli_query($conn, "SELECT COUNT(*) as total FROM club WHERE status = 'Active'");
$row4 = mysqli_fetch_assoc($res4);
$totalClubs = $row4['total'];

// Report Join Table: Papar user yang baru mendaftar
$recentQuery = "SELECT u.user_id, u.name, u.email, u.user_type, u.status 
                FROM user u 
                ORDER BY u.user_id DESC LIMIT 3";
$recentUsers = mysqli_query($conn, $recentQuery);

include 'header.php';
include 'sidebar.php';
?>

<h2>Admin Dashboard</h2>

<div class="kpi-container">
    <div class="kpi-card"><h5>Total Users</h5><p><?php echo $totalUsers; ?></p></div>
    <div class="kpi-card"><h5>Total Students</h5><p><?php echo $totalStudents; ?></p></div>
    <div class="kpi-card"><h5>Total Committees</h5><p><?php echo $totalCommittees; ?></p></div>
    <div class="kpi-card"><h5>Total Clubs</h5><p><?php echo $totalClubs; ?></p></div>
</div>

<h3>Recent Users (Join/Single Table Audit Log)</h3>
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
        <?php $i=1; while($user = mysqli_fetch_assoc($recentUsers)): ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo htmlspecialchars($user['name']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td><?php echo htmlspecialchars($user['user_type']); ?></td>
            <td><?php echo htmlspecialchars($user['status']); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<div class="announcement-box">
    <h4>System Announcements/Notifications</h4>
    <p>Sistem mata ganjaran kokurikulum (Extracurricular points system) telah dikemaskini mengikut ketetapan Table A.</p>
</div>

<?php include 'footer.php'; ?>