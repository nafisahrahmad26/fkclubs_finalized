<?php
require_once 'config/db.config.php';
if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

// SQL JOIN Multi-table query: Agregasi mata dan jumlah event yang disertai pelajar
$reportsQuery = "SELECT u.user_id, u.name as student_name, u.email,
                 COUNT(a.attendance_id) as events_attended,
                 IFNULL(SUM(a.points_earned), 0) as total_points
                 FROM user u
                 LEFT JOIN attendance a ON u.user_id = a.user_id
                 WHERE u.user_type = 'Student'
                 GROUP BY u.user_id, u.name, u.email
                 ORDER BY total_points DESC";
$reportRows = mysqli_query($conn, $reportsQuery);

include 'header.php';
include 'sidebar.php';
?>

<h2>Reports Page (Admin / Faculty View)</h2>
<h3>Extracurricular Point-Based Recognition Level Audit System</h3>

<table class="data-table">
    <thead>
        <tr>
            <th>Student ID Reference</th>
            <th>Name</th>
            <th>Email</th>
            <th>Events Tracked</th>
            <th>Accumulated Points</th>
            <th>Table B Recognition Tier Output</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($reportRows)): 
            $pts = $row['total_points'];
            
            // Engine Penilaian Automatik berdasarkan Table B Requirement
            if ($pts < 20) {
                $tier = "<span class='badge-role' style='background:#dc3545;'>Warning / Low Participation</span>";
            } elseif ($pts >= 20 && $pts <= 49) {
                $tier = "<span class='badge-role' style='background:#ffc107; color:#000;'>Participation Certificate Eligible</span>";
            } elseif ($pts >= 50 && $pts <= 79) {
                $tier = "<span class='badge-role' style='background:#17a2b8;'>Active Student Award / Bonus Priority</span>";
            } else {
                $tier = "<span class='badge-role' style='background:#28a745;'>Outstanding Leadership Award Tier</span>";
            }
        ?>
        <tr>
            <td>FK-STU-0<?php echo $row['user_id']; ?></td>
            <td><strong><?php echo htmlspecialchars($row['student_name']); ?></strong></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo $row['events_attended']; ?></td>
            <td><span style="font-weight:bold; color:#0056b3;"><?php echo $pts; ?> pts</span></td>
            <td><?php echo $tier; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<div class="filter-bar" style="margin-top:20px;">
     <button onclick="window.print()" class="btn-action">Print Official Audit Report</button>
</div>

<?php include 'footer.php'; ?>