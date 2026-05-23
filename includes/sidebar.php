<?php
$user_type = $_SESSION['user_type'] ?? 'Student';
?>
<div class="sidebar">
    <div class="sidebar-header">
        <div style="display: flex; justify-content: center; gap: 10px; margin-bottom: 15px;">
            <img src="../images/umpsa_logo.png" style="max-height: 40px; width: auto;" alt="UMPSA">
            <img src="../images/logo_fk_dummy.png" style="max-height: 40px; width: auto;" alt="FKClubs">
        </div>
        
        <div style="font-size:11px; color:#95a5a6; letter-spacing:1px; margin-bottom:5px;">UMPSA FKSC&EMS</div>
        <div style="font-weight:bold; font-size:16px;">NAVIGATION</div>
    </div>
    <ul class="sidebar-menu">
        <?php if ($user_type === 'Admin'): ?>
            <li><a href="../module1/admin_dashboard.php">📊 Admin Dashboard</a></li>
            <li><a href="../module1/user_management.php">👥 User Management</a></li>
        <?php endif; ?>
        <li><a href="../module1/profile.php">👤 My Profile</a></li>
        
        <?php if ($user_type === 'Admin'): ?>
            <li><a href="../module2/club_management.php">🏛️ Manage Clubs</a></li>
        <?php endif; ?>
        <li><a href="../module2/club_list.php">🔍 Browse Clubs</a></li>

        <li><a href="../module3/event_registration.php">📅 Event Registration</a></li>
        <?php if ($user_type === 'Admin' || $user_type === 'Staff'): ?>
            <li><a href="../module3/event_management.php">⚙️ Club Events Admin</a></li>
        <?php endif; ?>

        <?php if ($user_type === 'Admin' || $user_type === 'Staff'): ?>
            <li><a href="../module4/attendance.php">📝 Record Attendance</a></li>
        <?php endif; ?>
        <li><a href="../module4/participant_reports.php">📈 Engagement Reports</a></li>
        
        <li style="margin-top:30px;"><a href="../module1/logout.php" style="color:#e74c3c;">🚪 Logout</a></li>
    </ul>
</div>