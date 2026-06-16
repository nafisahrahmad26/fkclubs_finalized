<?php
require_once 'config/db.config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];

include 'header.php';
include 'sidebar.php';
?>

<h2>Student Dashboard</h2>

<div class="kpi-container">

    <div class="kpi-card">
        <h4>Welcome</h4>
        <p style="font-size:1rem;">
            <?php echo htmlspecialchars($userName); ?>
        </p>
    </div>

    <div class="kpi-card">
        <h4>User ID</h4>
        <p><?php echo $userId; ?></p>
    </div>

    <div class="kpi-card">
        <h4>Role</h4>
        <p style="font-size:1rem;">Student</p>
    </div>

</div>

<div class="form-container-card">
    <h3>Student Information</h3>

    <table class="data-table">
        <tr>
            <th>Name</th>
            <td><?php echo htmlspecialchars($userName); ?></td>
        </tr>

        <tr>
            <th>User Type</th>
            <td>Student</td>
        </tr>

        <tr>
            <th>Status</th>
            <td>Active</td>
        </tr>
    </table>
</div>

<div class="announcement-box">
    <h4>Student Announcements</h4>
    <p>Welcome to FKSC&EMS Student Portal.</p>
</div>

<?php include 'footer.php'; ?>