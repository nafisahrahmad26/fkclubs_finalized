<?php
require_once '../config/db.config.php';
if(!isset($_SESSION['user_id'])) { header("Location: ../module1/login.php"); exit; }

// Module 4 Join Query Reporting Requirement: Multi-table aggregation mapping framework calculations
$reportsQuery = "SELECT u.user_id, u.name as student_name, u.email,
                 COUNT(a.attendance_id) as events_attended,
                 IFNULL(SUM(a.points_earned), 0) as total_points
                 FROM user u
                 LEFT JOIN attendance a ON u.user_id = a.user_id
                 WHERE u.user_type = 'Student'
                 GROUP BY u.user_id, u.name, u.email
                 ORDER BY total_points DESC";
$reportRows = $conn->query($reportsQuery)->fetchAll();

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<h2>Figure 4.3 Reports Page (Admin / Faculty View)</h2>
<h3>Extracurricular Point-Based Recognition Level Audit System</h3>

<table class="data-table">
    <thead>
        <tr>
            <th>Student ID Reference</th>
            <th>Name</th>
            <th>Email</th>
            <th>Events Tracked</th>
            <th>Accumulated Points</th>
            <th>Table B Recognition Tier Enforcement Output</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($reportRows as $row): 
            $pts = $row['total_points'];
            // Table B Point Evaluation Condition Engine
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
            <td>FK-STU-0<?= $row['user_id']; ?></td>
            <td><strong><?= htmlspecialchars($row['student_name']); ?></strong></td>
            <td><?= htmlspecialchars($row['email']); ?></td>
            <td><?= $row['events_attended']; ?></td>
            <td><span style="font-weight:bold; color:#0056b3;"><?= $pts; ?> pts</span></td>
            <td><?= $tier; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="filter-bar" style="margin-top:20px;">
     <button onclick="window.print()" class="btn-action">Print Official Audit Report</button>
</div>

<?php include '../includes/footer.php'; ?>