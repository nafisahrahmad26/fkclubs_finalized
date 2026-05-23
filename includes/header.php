<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Global Redirect Safety Rule
if (!isset($_SESSION['user_id'])) {
    header("Location: ../module1/login.php");
    exit;
}

$user_type = $_SESSION['user_type'] ?? 'Student';
$user_display_name = !empty($_SESSION['name']) ? $_SESSION['name'] : $_SESSION['username'];

// Automatically deduce current page active frame label
$active_script_file = basename($_SERVER['PHP_SELF']);
$page_header_title = "FKClubs Portal";

if ($active_script_file == "admin_dashboard.php") $page_header_title = "Admin Dashboard";
if ($active_script_file == "user_management.php") $page_header_title = "User Management";
if ($active_script_file == "club_management.php") $page_header_title = "Club Management";
if ($active_script_file == "club_list.php")       $page_header_title = "Browse Clubs";
if ($active_script_file == "profile.php")         $page_header_title = "Profile Settings";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_header_title; ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="app-container">
        
        <div class="sidebar-panel">
            <div class="sidebar-logo-container">
                <div class="sidebar-logos">
                    <img src="../images/umpsa_logo.png" alt="UMPSA Logo">
                    <img src="../images/logo_fk_dummy.png" alt="FKSC Logo">
                </div>
                <div class="sidebar-title">FKSC & EMS PORTAL</div>
            </div>
            
            <ul class="nav-menu">
                <?php if ($user_type === 'Admin'): ?>
                    <li><a href="../module1/admin_dashboard.php">🧭 Dashboard</a></li>
                    <li><a href="../module1/user_management.php">👥 Users</a></li>
                    <li><a href="../module2/club_management.php">🏛️ Clubs</a></li>
                <?php else: ?>
                    <li><a href="../module2/club_list.php">🏛️ Browse Clubs</a></li>
                <?php endif; ?>
                <li><a href="../module3/event_registration.php">📅 Events</a></li>
                <li><a href="../module1/profile.php">⚙️ Settings</a></li>
                <li style="margin-top: 40px;"><a href="../module1/logout.php" style="color: #e74c3c;">Logout 🚪</a></li>
            </ul>
        </div>
        
        <div class="main-workspace">
            
            <div class="top-navbar">
                <div class="page-title"><?php echo $page_header_title; ?></div>
                <div class="user-profile-badge">
                    <span class="role-tag"><?php echo $user_type; ?></span>
                    <strong style="font-size: 14px;"><?php echo htmlspecialchars($user_display_name); ?></strong>
                </div>
            </div>
            
            <div class="page-inner-content">