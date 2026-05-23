<?php
require_once('../includes/header.php');
if ($_SESSION['user_type'] !== 'Admin') { echo "Access Denied."; exit; }

// Aggregate queries for visual analytics metric boards
$total_students = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as c FROM user WHERE user_type='Student'"))['c'];
$active_clubs = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as c FROM club WHERE status='Active'"))['c'];
$upcoming_events = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as c FROM event WHERE event_date >= CURDATE()"))['c'];
$total_events = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as c FROM event"))['c'];
?>

<h2>📊 System & Activity Administrator Dashboard</h2>
<p style="color:#7f8c8d; margin-bottom:20px;">Visual metrics report monitoring platform system usage.</p>

<div class="metrics-row">
    <div class="metric-card">
        <h3>Registered Students</h3>
        <div class="value"><?php echo $total_students; ?></div>
    </div>
    <div class="metric-card" style="border-top-color: #2ecc71;">
        <h3>Active Faculty Clubs</h3>
        <div class="value"><?php echo $active_clubs; ?></div>
    </div>
    <div class="metric-card" style="border-top-color: #f1c40f;">
        <h3>Upcoming Events</h3>
        <div class="value"><?php echo $upcoming_events; ?></div>
    </div>
    <div class="metric-card" style="border-top-color: #9b59b6;">
        <h3>Total Conducted Events</h3>
        <div class="value"><?php echo $total_events; ?></div>
    </div>
</div>

<div class="ui-card">
    <h3>📈 Participation Trends & Metrics Analytics Visualizer</h3>
    <div class="chart-container">
        <div class="chart-bar" style="height: <?php echo min(100, $total_students * 10); ?>%;">Students (<?php echo $total_students; ?>)</div>
        <div class="chart-bar" style="height: <?php echo min(100, $active_clubs * 20); ?>%; background-color:#2ecc71;">Clubs (<?php echo $active_clubs; ?>)</div>
        <div class="chart-bar" style="height: <?php echo min(100, $upcoming_events * 15); ?>%; background-color:#f1c40f;">Upcoming (<?php echo $upcoming_events; ?>)</div>
    </div>
</div>

<div class="ui-card">
    <h3>📋 Recent User Registration Log</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email Address</th>
                <th>Account Type</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $res = mysqli_query($link, "SELECT * FROM user ORDER BY user_id DESC LIMIT 3");
            while($row = mysqli_fetch_assoc($res)) {
                echo "<tr>
                        <td>{$row['user_id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['user_type']}</td>
                        <td>{$row['status']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('../includes/footer.php'); ?>