<?php
require_once __DIR__ . '/../config.db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

require_once __DIR__ . '/header.php';
require_once __DIR__ . '/sidebar.php';

// Single Table Aggregations
$total_students = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as count FROM user WHERE user_type = 'Student'"))['count'];
$total_clubs    = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as count FROM club WHERE status = 'Active'"))['count'];
$upcoming_events= mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as count FROM event WHERE event_date >= CURDATE()"))['count'];
$total_members  = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as count FROM membership"))['count'];

// Join Table Report: Extracts recent application transactions alongside structural items
$recent_registrations_query = "
    SELECT r.registration_id, u.name as student_name, e.event_name, r.registration_date, r.status
    FROM event_registration r
    JOIN user u ON r.user_id = u.user_id
    JOIN event e ON r.event_id = e.event_id
    ORDER BY r.registration_id DESC LIMIT 5";
$recent_res = mysqli_query($link, $recent_registrations_query);
?>

<h2>Executive Overview Dashboard Analytics</h2>
<p style="color:#64748b; margin-bottom: 25px;">Real-time system matrix distributions and user statistics.</p>

<div class="metrics-grid">
    <div class="metric-card"><h3>Registered Student Base</h3><p><?php echo $total_students; ?></p></div>
    <div class="metric-card" style="border-top-color:#10b981;"><h3>Active Faculty Clubs</h3><p><?php echo $total_clubs; ?></p></div>
    <div class="metric-card" style="border-top-color:#f59e0b;"><h3>Scheduled Operational Events</h3><p><?php echo $upcoming_events; ?></p></div>
    <div class="metric-card" style="border-top-color:#8b5cf6;"><h3>Enrolled Memberships</h3><p><?php echo $total_members; ?></p></div>
</div>

<div style="display:grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom:30px;">
    <div class="form-container">
        <h3>System Distribution Framework</h3>
        <div style="position:relative; height:220px;"><canvas id="adminBarChart"></canvas></div>
    </div>
    <div class="form-container">
        <h3>Club Ingress Density</h3>
        <div style="position:relative; height:220px;"><canvas id="adminPieChart"></canvas></div>
    </div>
</div>

<h3>Recent Activity Logs (Join-Table Output)</h3>
<table class="data-table">
    <thead>
        <tr>
            <th>Reg ID</th>
            <th>Student Full Name</th>
            <th>Target Slate Event</th>
            <th>Transaction Date</th>
            <th>Ingress Status</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($recent_res)): ?>
        <tr>
            <td>#<?php echo $row['registration_id']; ?></td>
            <td><strong><?php echo htmlspecialchars($row['student_name']); ?></strong></td>
            <td><?php echo htmlspecialchars($row['event_name']); ?></td>
            <td><?php echo $row['registration_date']; ?></td>
            <td><span style="padding:2px 6px; border-radius:12px; font-size:12px; font-weight:bold; background:<?php echo $row['status']=='Registered'?'#dcfce7;color:#15803d;':'#fef3c7;color:#d97706;';?>"><?php echo $row['status']; ?></span></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<script>
// Chart 1: Bar layout configuration
new Chart(document.getElementById('adminBarChart'), {
    type: 'bar',
    data: {
        labels: ['Students', 'Clubs', 'Events'],
        datasets: [{
            label: 'System Matrix Aggregations',
            data: [<?php echo $total_students; ?>, <?php echo $total_clubs; ?>, <?php echo $upcoming_events; ?>],
            backgroundColor: ['#2563eb', '#10b981', '#f59e0b']
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

// Chart 2: Pie layout configuration
new Chart(document.getElementById('adminPieChart'), {
    type: 'pie',
    data: {
        labels: ['Active Clubs', 'Total Member Enrollments'],
        datasets: [{
            data: [<?php echo $total_clubs; ?>, <?php echo $total_members; ?>],
            backgroundColor: ['#10b981', '#8b5cf6']
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});
</script>

<?php require_once __DIR__ . '/footer.php'; ?>