<?php
require_once '../config/db.config.php';
if(!isset($_SESSION['user_id'])) { header("Location: ../module1/login.php"); exit; }

// Simpan atau kemaskini kehadiran (Table A Automation Engine)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user_type'] !== 'Student') {
    $reg_id = intval($_POST['registration_id']);
    $status_val = $_POST['attendance_status'];
    
    // Logik pemarkahan automatik berpandukan Table A
    $points = 0;
    if ($status_val === 'Present')   { $points = 10; }
    if ($status_val === 'Late')      { $points = 5; }
    if ($status_val === 'Absent')    { $points = -10; }
    if ($status_val === 'Volunteer') { $points = 5; }

    // Cari user_id pemilik pendaftaran tersebut
    $lookupStmt = mysqli_prepare($conn, "SELECT user_id FROM event_registration WHERE registration_id = ?");
    mysqli_stmt_bind_param($lookupStmt, "i", $reg_id);
    mysqli_stmt_execute($lookupStmt);
    $resLookup = mysqli_stmt_get_result($lookupStmt);
    $rowLookup = mysqli_fetch_assoc($resLookup);
    $u_id = $rowLookup['user_id'];
    mysqli_stmt_close($lookupStmt);

    // Semak rekod sedia ada (Upsert)
    $chkLog = mysqli_prepare($conn, "SELECT COUNT(*) as count FROM attendance WHERE registration_id = ?");
    mysqli_stmt_bind_param($chkLog, "i", $reg_id);
    mysqli_stmt_execute($chkLog);
    $resChkLog = mysqli_fetch_assoc(mysqli_stmt_get_result($chkLog));
    mysqli_stmt_close($chkLog);
    
    if($resChkLog['count'] > 0) {
        $stmt = mysqli_prepare($conn, "UPDATE attendance SET attendance_status=?, check_in_time=NOW(), points_earned=? WHERE registration_id=?");
        mysqli_stmt_bind_param($stmt, "sii", $status_val, $points, $reg_id);
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO attendance (registration_id, user_id, attendance_status, check_in_time, points_earned) VALUES (?, ?, ?, NOW(), ?)");
        mysqli_stmt_bind_param($stmt, "iisi", $reg_id, $u_id, $status_val, $points);
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: attendance.php?success=1");
    exit;
}

// Join Table Report: Cantumkan data pendaftaran, nama event, dan nama student
$registryQuery = "SELECT r.registration_id, r.status, e.event_name, u.name as student_name, u.user_id 
                  FROM event_registration r
                  JOIN event e ON r.event_id = e.event_id
                  JOIN user u ON r.user_id = u.user_id
                  WHERE r.status = 'Registered'";
$registrationsResult = mysqli_query($conn, $registryQuery);

include '../includes/header.php';
include '../includes/sidebar.php';
?>


<?php if($_SESSION['user_type'] == 'Student'): ?>

    <h2>My Participation Dashboard</h2>

<?php else: ?>

    <h2>Record Attendance Page (Committee View)</h2>

<?php endif; ?>

<table class="data-table">
    <thead>
        <tr>
            <th>Event Name</th>
            <th>Student Name</th>
            <th>Mark Attendance Status (Table A Rules Matrix)</th>
        </tr>
    </thead>
    <tbody>
        <?php while($reg = mysqli_fetch_assoc($registrationsResult)): 
            $r_id = $reg['registration_id'];
            $curLog = mysqli_query($conn, "SELECT attendance_status FROM attendance WHERE registration_id = $r_id");
            $loggedRow = mysqli_fetch_assoc($curLog);
            $loggedStatus = $loggedRow ? $loggedRow['attendance_status'] : '';
        ?>
        <tr>
            <td><?php echo htmlspecialchars($reg['event_name']); ?></td>
            <td><?php echo htmlspecialchars($reg['student_name']); ?></td>
            <td>
                <form action="attendance.php" method="POST" style="display:inline-flex; gap:10px;">
                    <input type="hidden" name="registration_id" value="<?php echo $reg['registration_id']; ?>">
                    <select name="attendance_status" required style="padding: 4px;">
                        <option value="Present" <?php echo $loggedStatus=='Present'?'selected':''; ?>>Present on time (+10)</option>
                        <option value="Late" <?php echo $loggedStatus=='Late'?'selected':''; ?>>Late arrival (+5)</option>
                        <option value="Absent" <?php echo $loggedStatus=='Absent'?'selected':''; ?>>Absent without notice (-10)</option>
                        <option value="Volunteer" <?php echo $loggedStatus=='Volunteer'?'selected':''; ?>>Volunteer Helper (+5)</option>
                    </select>
                    <button type="submit" class="btn-inline-edit" style="background:#28a745; color: white;">Save</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>