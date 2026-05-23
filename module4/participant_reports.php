<?php
require_once __DIR__ . '/../config.db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

// Dynamic Multi-Table Relational SQL JOIN Query grouping points across transaction entries
$report_query = "
    SELECT 
        u.user_id,
        u.name as student_fullname,
        u.email as tracking_email,
        IFNULL(SUM(a.points_earned), 0) as aggregated_score
    FROM user u
    LEFT JOIN attendance a ON u.user_id = a.user_id
    WHERE u.user_type = 'Student'
    GROUP BY u.user_id, u.name, u.email
    ORDER BY aggregated_score DESC";

$report_res = mysqli_query($link, $report_query);
?>
<?php require_once __DIR__ . '/header.php'; require_once __DIR__ . '/sidebar.php'; ?>

<h2>Dynamic Engagement Performance Tiers Report</h2>
<p style="color:#64748b; margin-bottom:20px;">Real-time execution of individual metrics evaluating compliance with Table B evaluation tiers.</p>

<table class="data-table">
    <thead>
        <tr>
            <th>UID</th>
            <th>Evaluated Student Name</th>
            <th>Email Pathway</th>
            <th>Accumulated Point Metrics</th>
            <th>Calculated Recognition Enforcement Status (Table B Matrix)</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($report_res)): 
            $score = $row['aggregated_score'];
            
            // Core Table B Point-Based Evaluation Translation Layer mapping criteria logic
            if ($score < 20) {
                $tier_rating = "Warning / Reminder to participate more";
                $bg = "#fef2f2"; $fg = "#991b1b";
            } elseif ($score >= 20 && $score <= 49) {
                $tier_rating = "Eligible for participation certificate";
                $bg = "#fffbeb"; $fg = "#92400e";
            } elseif ($score >= 50 && $score <= 79) {
                $tier_rating = "Eligible for active student award / bonus points";
                $bg = "#eff6ff"; $fg = "#1e40af";
            } else {
                $tier_rating = "Outstanding participant; eligible for leadership award / priority registration";
                $bg = "#f0fdf4"; $fg = "#166534";
            }
        ?>
        <tr style="background: <?php echo $bg; ?>; color: <?php echo $fg; ?>;">
            <td>#<?php echo $row['user_id']; ?></td>
            <td><strong><?php echo htmlspecialchars($row['student_fullname']); ?></strong></td>
            <td><?php echo htmlspecialchars($row['tracking_email']); ?></td>
            <td>
                <span style="display:inline-block; padding:4px 12px; border-radius:6px; background:#ffffff; font-weight:700; border:1px solid #cbd5e1; color:#0f172a;">
                    <?php echo $score; ?> Points
                </span>
            </td>
            <td style="font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:0.02em;"><?php echo $tier_rating; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/footer.php'; ?>