<?php
require_once __DIR__ . '/../config.db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$action_msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['log_metrics'])) {
    $registration_id = intval($_POST['registration_id']);
    $user_id = intval($_POST['user_id']);
    $status = $_POST['attendance_status'];

    // Table A: Enforcement and Scoring Specification Logic Matrix
    $points_earned = 0;
    if ($status === 'Present')   $points_earned = 10;
    if ($status === 'Late')      $points_earned = 5;
    if ($status === 'Volunteer') $points_earned = 5;
    if ($status === 'Absent')    $points_earned = -10;

    // Mutate performance metric parameters in the dynamic database environment
    $dup_q = mysqli_query($link, "SELECT * FROM attendance WHERE registration_id = $registration_id");
    
    if (mysqli_num_rows($dup_q) > 0) {
        $update_q = "UPDATE attendance SET attendance_status = '$status', points_earned = $points_earned, check_in_time = NOW() WHERE registration_id = $registration_id";
        mysqli_query($link, $update_q);
    } else {
        $insert_q = "INSERT INTO attendance (registration_id, user_id, attendance_status, check_in_time, points_earned) 
                     VALUES ($registration_id, $user_id, '$status', NOW(), $points_earned)";
                     mysqli_query($link, $insert_q);
    }
    $action_msg = "<div class='alert alert-success'>Attendance parameters logged. Enforcement score successfully distributed.</div>";
}

// Join Table implementation extracting unlogged registration transactions
$roster_query = "
    SELECT r.registration_id, r.user_id, u.name as student_name, e.event_name 
    FROM event_registration r
    JOIN user u ON r.user_id = u.user_id
    JOIN event e ON r.event_id = e.event_id
    LEFT JOIN attendance a ON r.registration_id = a.registration_id
    WHERE r.status = 'Registered' AND a.attendance_id IS NULL";
$roster_res = mysqli_query($link, $roster_query);
?>
<?php require_once __DIR__ . '/header.php'; require_once __DIR__ . '/sidebar.php'; ?>

<h2>Attendance Matrix Verification Engine (Table A Mapping)</h2>
<hr style="margin:15px 0; border:0; border-top:1px solid #e2e8f0;">
<?php echo $action_msg; ?>

<table class="data-table">
    <thead>
        <tr>
            <th>Student Identity Reference</th>
            <th>Designated Target Slate</th>
            <th>Evaluation Status Code Matrix</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($roster_res)): ?>
        <tr>
            <td><strong><?php echo htmlspecialchars($row['student_name']); ?></strong></td>
            <td><?php echo htmlspecialchars($row['event_name']); ?></td>
            <td>
                <form action="attendance.php" method="POST" style="display:flex; gap:10px; align-items:center;">
                    <input type="hidden" name="registration_id" value="<?php echo $row['registration_id']; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                    <select name="attendance_status" class="form-control" style="width:180px; padding:4px;">
                        <option value="Present">Present (+10 Points)</option>
                        <option value="Late">Late Arrival (+5 Points)</option>
                        <option value="Volunteer">Volunteer Helper (+5 Points)</option>
                        <option value="Absent">Absent (-10 Points)</option>
                    </select>
                    <button type="submit" name="log_metrics" class="btn btn-primary btn-sm">Commit Scoring</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
        <?php if(mysqli_num_rows($roster_res) == 0): ?>
            <tr><td colspan="3" style="text-align:center; color:#64748b;">No outstanding tracking data pipelines pending valuation logic.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/footer.php'; ?>