<?php
require_once '../config/db.config.php';
if(!isset($_SESSION['user_id'])) { header("Location: ../module1/login.php"); exit; }

$event_id = $_GET['id'] ?? 0;

// Process the registration request logic safely
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user_type'] === 'Student') {
    // 1. Double registration structural protection step
    $chk = $conn->prepare("SELECT COUNT(*) FROM event_registration WHERE event_id = ? AND user_id = ? AND status='Registered'");
    $chk->execute([$event_id, $_SESSION['user_id']]);
    
    if ($chk->fetchColumn() == 0) {
        // 2. Validate current booking metric ceilings values limits constraints 
        $evDetails = $conn->prepare("SELECT max_participants FROM event WHERE event_id = ?");
        $evDetails->execute([$event_id]);
        $maxVal = $evDetails->fetchColumn();

        $curDetails = $conn->prepare("SELECT COUNT(*) FROM event_registration WHERE event_id = ? AND status='Registered'");
        $curDetails->execute([$event_id]);
        $currentFilled = $curDetails->fetchColumn();

        if ($currentFilled >= $maxVal) {
            // Apply waiting list automation fallback condition requirement
            $stmt = $conn->prepare("INSERT INTO event_registration (event_id, user_id, status) VALUES (?, ?, 'Waiting List')");
            $stmt->execute([$event_id, $_SESSION['user_id']]);
            header("Location: event_registration.php?id=".$event_id."&msg=waiting");
            exit;
        } else {
            $stmt = $conn->prepare("INSERT INTO event_registration (event_id, user_id, status) VALUES (?, ?, 'Registered')");
            $stmt->execute([$event_id, $_SESSION['user_id']]);
            header("Location: event_registration.php?id=".$event_id."&msg=success");
            exit;
        }
    }
}

$stmt = $conn->prepare("SELECT * FROM event WHERE event_id = ?");
$stmt->execute([$event_id]);
$event = $stmt->fetch();

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<h2>Event Registration Details</h2>

<?php if(isset($_GET['msg']) && $_GET['msg']=='success'): ?>
    <div style="background:#d4edda; padding:10px; margin-bottom:15px; border-radius:4px;">Registration processed successfully! Your slot is secure.</div>
<?php elseif(isset($_GET['msg']) && $_GET['msg']=='waiting'): ?>
    <div style="background:#fff3cd; padding:10px; margin-bottom:15px; border-radius:4px;">Event full! You have been queued to the system Waiting List safely.</div>
<?php endif; ?>

<div class="form-container-card">
    <h3>Event Title: <?= htmlspecialchars($event['event_name']); ?></h3>
    <p><strong>Date:</strong> <?= $event['event_date']; ?> | <strong>Time:</strong> <?= $event['event_time']; ?></p>
    <p><strong>Venue:</strong> <?= htmlspecialchars($event['venue']); ?></p>
    <p><strong>Details Description:</strong> <?= htmlspecialchars($event['event_description']); ?></p>

    <form action="event_registration.php?id=<?= $event['event_id']; ?>" method="POST" onsubmit="return confirm('Confirm registration submission detail values?')">
        <?php if($_SESSION['user_type'] === 'Student'): ?>
            <button type="submit" class="btn-submit">Confirm Registration</button>
        <?php else: ?>
            <p><em>Only active student standard accounts are permitted to perform submission bookings.</em></p>
        <?php endif; ?>
    </form>
</div>

<?php include '../includes/footer.php'; ?>