<aside class="sidebar">
    <nav class="nav-menu">
        <ul>
            <?php if(isset($_SESSION['user_type'])): ?>
                <li><a href="../module1/admin_dashboard.php">Dashboard</a></li>
                <?php if($_SESSION['user_type'] == 'Admin'): ?>
                    <li><a href="../module1/user_management.php">Users</a></li>
                <?php endif; ?>
                <li><a href="../module2/club_list.php">Clubs</a></li>
                <li><a href="../module3/event_management.php">Events</a></li>
                <li><a href="../module4/attendance.php">Attendance</a></li>
                <li><a href="../module4/participant_reports.php">Reports</a></li>
                <li><a href="../module1/profile.php">Profile</a></li>
                <li><a href="../module1/logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="../module1/login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</aside>
<main class="content-body">