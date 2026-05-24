<?php
require_once '../config/db.config.php';
if(!isset($_SESSION['user_id'])) { header("Location: ../module1/login.php"); exit; }

// Process attendance logging matching the system specs matrix rules
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user_type'] !== 'Student') {
    $reg_id = $_POST['registration_id'];
    $status_val = $_POST['attendance_status'];
    
    // Evaluate matrix scores criteria automatically based on Table A requirements
    $points = 0;
    if ($status_val === 'Present')   { $points = 10; }
    if ($status_val === 'Late')      { $points = 5; }
    if ($status_val === 'Absent')    { $points = -10; }
    if ($status_val === 'Volunteer') { $points = 5; }

    // Identify user context mapping link
    $lookup = $conn->prepare("SELECT user_id FROM event_registration WHERE registration_id = ?");
    $lookup->execute([$reg_id]);
    $u_id = $lookup->fetchColumn();

    // Upsert mechanism to prevent double logs
    $checkLog = $conn->prepare("SELECT count(*) FROM attendance WHERE registration_id = ?");
    $checkLog->execute([$reg_id]);
    
    if($checkLog->fetchColumn() > 0) {
        $stmt = $conn->prepare("UPDATE attendance SET attendance_status=?, check_in_time=NOW(), points_earned=? WHERE registration_id=?");
        $stmt->execute([$status_val, $points, $reg_id]);
    } else {
        $stmt = $conn->prepare("INSERT INTO attendance (registration_id, user_id, attendance_status, check_in_time, points_earned) VALUES (?, ?, ?, NOW(), ?)");
        $stmt->execute([$reg_id, $u_id, $status_val, $points]);
    }
    header("Location: attendance.php?success=1");
    exit;
}

// Complex Join query mapping across event registries structures
$registryQuery = "SELECT r.registration_id, r.status, e.event_name, u.name as student_name, u.user_id 
                  FROM event_registration r
                  JOIN event e ON r.event_id = e.event_id
                  JOIN user u ON r.user_id = u.user_id
                  WHERE r.status = 'Registered'";
$registrations = $conn->query($registryQuery)->fetchAll();

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<h2>Figure 4.1 Record Attendance Page (Committee View)</h2>

<table class="data-table">
    <thead>
        <tr>
            <th>Event Name</th>
            <th>Student Name</th>
            <th>Mark Attendance Status (Table A Rules Matrix)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($registrations as $reg): 
            // Look up existing session values logged
            $curLog = $conn->prepare("SELECT attendance_status FROM attendance WHERE registration_id = ?");
            $curLog->execute([$reg['registration_id']]);
            $loggedStatus = $curLog->fetchColumn();
        ?>
        <tr>
            <td><?= htmlspecialchars($reg['event_name']); ?></td>
            <td><?= htmlspecialchars($reg['student_name']); ?></td>
            <td>
                <form action="attendance.php" method="POST" style="display:inline-flex; gap:10px;">
                    <input type="hidden" name="registration_id" value="<?= $reg['registration_id']; ?>">
                    <select name="attendance_status" required style="padding: 4px;">
                        <option value="Present" <?= $loggedStatus=='Present'?'selected':''; ?>>Present on time (+10)</option>
                        <option value="Late" <?= $loggedStatus=='Late'?'selected':''; ?>>Late arrival (+5)</option>
                        <option value="Absent" <?= $loggedStatus=='Absent'?'selected':''; ?>>Absent without notice (-10)</option>
                        <option value="Volunteer" <?= $loggedStatus=='Volunteer'?'selected':''; ?>>Volunteer Helper (+5)</option>
                    </select>
                    <button type="submit" class="btn-inline-edit" style="background:#28a745;">Save</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>