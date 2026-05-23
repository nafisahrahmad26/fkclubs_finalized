<?php
require_once __DIR__ . '/../config.db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$user_id = $_SESSION['user_id'];
$status_feedback = '';

if (isset($_GET['request_ingress_id'])) {
    $event_id = intval($_GET['request_ingress_id']);

    // Registration validation and capacity control bounds checking
    $count_q = mysqli_query($link, "SELECT COUNT(*) as registered_count FROM event_registration WHERE event_id = $event_id AND status='Registered'");
    $current_registrations = mysqli_fetch_assoc($count_q)['registered_count'];

    $cap_q = mysqli_query($link, "SELECT max_participants FROM event WHERE event_id = $event_id");
    $max_capacity = mysqli_fetch_assoc($cap_q)['max_participants'];

    // Prevent duplicate entries for the same active user session
    $dup_check = mysqli_query($link, "SELECT * FROM event_registration WHERE event_id = $event_id AND user_id = $user_id");
    
    if (mysqli_num_rows($dup_check) > 0) {
        $status_feedback = "<div class='alert alert-danger'>Transaction Rejected: You are already logged in this active pipeline.</div>";
    } else {
        if ($current_registrations < $max_capacity) {
            $insert_query = "INSERT INTO event_registration (event_id, user_id, registration_date, status) VALUES ($event_id, $user_id, NOW(), 'Registered')";
            mysqli_query($link, $insert_query);
            $status_feedback = "<div class='alert alert-success'>Seat allocation secured! Registration verified.</div>";
        } else {
            // Automatic fallback to system routing parameter logic (Waiting List)
            $insert_query = "INSERT INTO event_registration (event_id, user_id, registration_date, status) VALUES ($event_id, $user_id, NOW(), 'Waiting List')";
            mysqli_query($link, $insert_query);
            $status_feedback = "<div class='alert alert-danger'>Event fully booked. You have been placed on the system waiting list.</div>";
        }
    }
}

$all_events = mysqli_query($link, "SELECT e.*, c.club_name FROM event e JOIN club c ON e.club_id = c.club_id");
?>
<?php require_once __DIR__ . '/header.php'; require_once __DIR__ . '/sidebar.php'; ?>

<h2>Campus Student Intake Portal</h2>
<hr style="margin:15px 0; border:0; border-top:1px solid #e2e8f0;">
<?php echo $status_feedback; ?>

<h3>Open Engagement Pipelines</h3>
<table class="data-table">
    <thead>
        <tr>
            <th>Event Name Title</th>
            <th>Affiliated Organizing Body</th>
            <th>Execution Timeline</th>
            <th>Target Location Parameter</th>
            <th>System Command Ingress</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($all_events)): ?>
        <tr>
            <td><strong><?php echo htmlspecialchars($row['event_name']); ?></strong><br><span style="font-size:12px;color:#64748b;"><?php echo htmlspecialchars($row['event_description']); ?></span></td>
            <td><?php echo htmlspecialchars($row['club_name']); ?></td>
            <td><?php echo $row['event_date']; ?></td>
            <td><?php echo htmlspecialchars($row['venue']); ?></td>
            <td><a href="event_registration.php?request_ingress_id=<?php echo $row['event_id']; ?>" class="btn btn-success btn-sm">Request Seat Ingress</a></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/footer.php'; ?>