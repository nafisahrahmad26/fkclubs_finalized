<aside class="sidebar">
    <nav class="nav-menu">
        <ul>
            <?php if(isset($_SESSION['user_type'])): ?>
                <li><a href="admin_dashboard.php">Dashboard </a></li>
                <?php if($_SESSION['user_type'] == 'Admin'): ?>
                    <li><a href="user_management.php">Users</a></li>
                <?php endif; ?>
                <li><a href="club_list.php">Clubs</a></li>
                <?php if($_SESSION['user_type'] !== 'Admin'): ?>
                <li><a href="event_management.php">Events</a></li>
                <?php endif; ?>
                <li><a href="attendance.php">Attendance</a></li>
                <li><a href="participan_reports.php">Reports</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</aside>
<main class="content-body">