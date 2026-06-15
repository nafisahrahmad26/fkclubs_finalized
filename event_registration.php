<?php
<<<<<<< HEAD
require_once 'config/db.config.php';
=======
require_once '../config/db.config.php';
>>>>>>> e455f8d (try)
if(!isset($_SESSION['user_id'])) { header("Location: ../module1/login.php"); exit; }

$event_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_id = intval($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user_type'] === 'Student') {
<<<<<<< HEAD
=======

    // Cancel Registration
    if (isset($_POST['action']) && $_POST['action'] === 'cancel') {
        $cancelStmt = mysqli_prepare($conn, "DELETE FROM event_registration WHERE event_id = ? AND user_id = ?");
        mysqli_stmt_bind_param($cancelStmt, "ii", $event_id, $user_id);
        mysqli_stmt_execute($cancelStmt);
        mysqli_stmt_close($cancelStmt);
        header("Location: event_registration.php?id=".$event_id."&msg=cancelled");
        exit;
    }

>>>>>>> e455f8d (try)
    // Semak jika sudah mendaftar
    $chkStmt = mysqli_prepare($conn, "SELECT COUNT(*) as count FROM event_registration WHERE event_id = ? AND user_id = ? AND status='Registered'");
    mysqli_stmt_bind_param($chkStmt, "ii", $event_id, $user_id);
    mysqli_stmt_execute($chkStmt);
    $resCheck = mysqli_fetch_assoc(mysqli_stmt_get_result($chkStmt));
    mysqli_stmt_close($chkStmt);
<<<<<<< HEAD
    
=======

>>>>>>> e455f8d (try)
    if ($resCheck['count'] == 0) {
        // Ambil max_participants
        $evDetails = mysqli_prepare($conn, "SELECT max_participants FROM event WHERE event_id = ?");
        mysqli_stmt_bind_param($evDetails, "i", $event_id);
        mysqli_stmt_execute($evDetails);
        $evRow = mysqli_fetch_assoc(mysqli_stmt_get_result($evDetails));
        $maxVal = $evRow['max_participants'];
        mysqli_stmt_close($evDetails);

        // Ambil bilangan yang sudah berdaftar
        $curDetails = mysqli_prepare($conn, "SELECT COUNT(*) as total_filled FROM event_registration WHERE event_id = ? AND status='Registered'");
        mysqli_stmt_bind_param($curDetails, "i", $event_id);
        mysqli_stmt_execute($curDetails);
        $curRow = mysqli_fetch_assoc(mysqli_stmt_get_result($curDetails));
        $currentFilled = $curRow['total_filled'];
        mysqli_stmt_close($curDetails);

        if ($currentFilled >= $maxVal) {
            // Jika Penuh -> Letak dalam Waiting List
            $stmt = mysqli_prepare($conn, "INSERT INTO event_registration (event_id, user_id, status) VALUES (?, ?, 'Waiting List')");
            mysqli_stmt_bind_param($stmt, "ii", $event_id, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            header("Location: event_registration.php?id=".$event_id."&msg=waiting");
            exit;
        } else {
            // Jika Masih Kosong -> Sah Pendaftaran
            $stmt = mysqli_prepare($conn, "INSERT INTO event_registration (event_id, user_id, status) VALUES (?, ?, 'Registered')");
            mysqli_stmt_bind_param($stmt, "ii", $event_id, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            header("Location: event_registration.php?id=".$event_id."&msg=success");
            exit;
        }
    }
}

$stmt = mysqli_prepare($conn, "SELECT * FROM event WHERE event_id = ?");
mysqli_stmt_bind_param($stmt, "i", $event_id);
mysqli_stmt_execute($stmt);
$event = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<h2>Event Registration Details</h2>

<?php if(isset($_GET['msg']) && $_GET['msg']=='success'): ?>
    <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:4px; border:1px solid #c3e6cb;">Registration processed successfully! Slot secured.</div>
<?php elseif(isset($_GET['msg']) && $_GET['msg']=='waiting'): ?>
    <div style="background:#fff3cd; color:#856404; padding:10px; margin-bottom:15px; border-radius:4px; border:1px solid #ffeeba;">Event full! You have been queued to the Waiting List.</div>
<<<<<<< HEAD
=======
<?php elseif(isset($_GET['msg']) && $_GET['msg']=='cancelled'): ?>
    <div style="background:#f8d7da; color:#721c24; padding:10px; margin-bottom:15px; border-radius:4px; border:1px solid #f5c6cb;">Your registration has been cancelled.</div>
>>>>>>> e455f8d (try)
<?php endif; ?>

<div class="form-container-card">
    <h3>Event Title: <?php echo htmlspecialchars($event['event_name']); ?></h3>
    <p><strong>Date:</strong> <?php echo $event['event_date']; ?> | <strong>Time:</strong> <?php echo $event['event_time']; ?></p>
    <p><strong>Venue:</strong> <?php echo htmlspecialchars($event['venue']); ?></p>
    <p><strong>Description:</strong> <?php echo htmlspecialchars($event['event_description']); ?></p>

<<<<<<< HEAD
    <form action="event_registration.php?id=<?php echo $event['event_id']; ?>" method="POST" onsubmit="return confirm('Confirm registration submission?')">
        <?php if($_SESSION['user_type'] === 'Student'): ?>
            <button type="submit" class="btn-submit">Confirm Registration</button>
        <?php else: ?>
            <p><em>Only active student accounts are permitted to perform registration bookings.</em></p>
        <?php endif; ?>
    </form>
=======
    <?php
    // Check if student is already registered or on waiting list
    $regCheck = mysqli_prepare($conn, "SELECT status FROM event_registration WHERE event_id = ? AND user_id = ? LIMIT 1");
    mysqli_stmt_bind_param($regCheck, "ii", $event['event_id'], $user_id);
    mysqli_stmt_execute($regCheck);
    $regRow = mysqli_fetch_assoc(mysqli_stmt_get_result($regCheck));
    mysqli_stmt_close($regCheck);
    ?>

    <?php if($_SESSION['user_type'] === 'Student'): ?>
        <?php if($regRow): ?>
            <p><em>You are registered for this event. Status: <strong><?php echo htmlspecialchars($regRow['status']); ?></strong></em></p>
            <form action="event_registration.php?id=<?php echo $event['event_id']; ?>" method="POST" onsubmit="return confirm('Are you sure you want to cancel your registration?')">
                <input type="hidden" name="action" value="cancel">
                <button type="submit" class="btn-action" style="background:#dc3545;">Cancel Registration</button>
            </form>
        <?php else: ?>
            <form action="event_registration.php?id=<?php echo $event['event_id']; ?>" method="POST" onsubmit="return confirm('Confirm registration submission?')">
                <button type="submit" class="btn-submit">Confirm Registration</button>
            </form>
        <?php endif; ?>
    <?php else: ?>
        <p><em>Only active student accounts are permitted to perform registration bookings.</em></p>
    <?php endif; ?>
>>>>>>> e455f8d (try)
</div>

<?php include '../includes/footer.php'; ?>