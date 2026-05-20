<?php
include('../config/db.config.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'Admin') {
    header("Location: login.php");
    exit();
}

$res_students = mysqli_query($link, "SELECT COUNT(*) as count FROM USER WHERE user_type='Student'");
$total_students = mysqli_fetch_assoc($res_students)['count'];

$res_clubs = mysqli_query($link, "SELECT COUNT(*) as count FROM CLUB WHERE status='Active'");
$active_clubs = mysqli_fetch_assoc($res_clubs)['count'];

$res_events = mysqli_query($link, "SELECT COUNT(*) as count FROM EVENT");
$upcoming_events = mysqli_fetch_assoc($res_events)['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="navbar">
        <div class="logo">Welcome, Admin</div>
        <div class="menu">
            <a href="register_user.php">Register Users</a>
            <a href="../module2/manage_clubs.php">Clubs</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container" style="margin-top: 50px;">
        <h3>System Overview Metrics</h3>
        <div class="dashboard-grid" style="display: flex; gap: 20px; margin-top: 20px;">
            
            <div class="card" style="flex: 1; padding: 20px; border: 1px solid #ccc; border-radius: 5px; text-align: center;">
                <h1><?php echo $total_students; ?></h1>
                <p>Registered Students</p>
            </div>

            <div class="card" style="flex: 1; padding: 20px; border: 1px solid #ccc; border-radius: 5px; text-align: center;">
                <h1><?php echo $active_clubs; ?></h1>
                <p>Active Faculty Clubs</p>
            </div>

            <div class="card" style="flex: 1; padding: 20px; border: 1px solid #ccc; border-radius: 5px; text-align: center;">
                <h1><?php echo $upcoming_events; ?></h1>
                <p>Upcoming Events</p>
            </div>

        </div>
    </div>
</body>
</html>