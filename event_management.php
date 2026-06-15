<?php
require_once 'config/db.config.php';
if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
if($_SESSION['user_type'] === 'Admin') { header("Location: admin_dashboard.php"); exit; }

// Tambah Event Baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user_type'] !== 'Student') {
    $club_id = intval($_POST['club_id']);
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $venue = $_POST['venue'];
    $max_participants = intval($_POST['max_participants']);
    $event_description = $_POST['event_description'];

    $stmt = mysqli_prepare($conn, "INSERT INTO event (club_id, event_name, event_date, event_time, venue, max_participants, event_description) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "issssis", $club_id, $event_name, $event_date, $event_time, $venue, $max_participants, $event_description);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: event_management.php");
    exit;
}

$eventsResult = mysqli_query($conn, "SELECT * FROM event ORDER BY event_date ASC");
$clubsResult = mysqli_query($conn, "SELECT club_id, club_name FROM club WHERE status='Active'");

include 'header.php';
include 'sidebar.php';
?>

<h2>Event List & Management</h2>

<?php if($_SESSION['user_type'] !== 'Student'): ?>
<div class="form-container-card">
    <h3>Organize New Program Event</h3>
    <form action="event_management.php" method="POST">
        <div class="form-row">
            <select name="club_id" required>
                <option value="">Select Host Club</option>
                <?php while($cl = mysqli_fetch_assoc($clubsResult)): ?>
                    <option value="<?php echo $cl['club_id']; ?>"><?php echo htmlspecialchars($cl['club_name']); ?></option>
                <?php endwhile; ?>
            </select>
            <input type="text" name="event_name" placeholder="Event Title" required>
        </div>
        <div class="form-row">
            <input type="date" name="event_date" required>
            <input type="time" name="event_time" required>
        </div>
        <div class="form-row">
            <input type="text" name="venue" placeholder="Venue Location" required>
            <input type="number" name="max_participants" placeholder="Max Slots Capacity" required>
        </div>
        <textarea name="event_description" placeholder="Event details description..."></textarea>
        <button type="submit" class="btn-action">Publish Event</button>
    </form>
</div>
<?php endif; ?>

<table class="data-table">
    <thead>
        <tr>
            <th>Event Title</th>
            <th>Date</th>
            <th>Venue</th>
            <th>Capacity Limit</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while($ev = mysqli_fetch_assoc($eventsResult)): 
            $ev_id = $ev['event_id'];
            $countRes = mysqli_query($conn, "SELECT COUNT(*) as registered_total FROM event_registration WHERE event_id = $ev_id AND status='Registered'");
            $countRow = mysqli_fetch_assoc($countRes);
            $currentCount = $countRow['registered_total'];
        ?>
        <tr>
            <td><strong><?php echo htmlspecialchars($ev['event_name']); ?></strong></td>
            <td><?php echo $ev['event_date']; ?></td>
            <td><?php echo htmlspecialchars($ev['venue']); ?></td>
            <td><?php echo $currentCount; ?> / <?php echo $ev['max_participants']; ?> Slots Used</td>
            <td>
                <a href="event_registration.php?id=<?php echo $ev['event_id']; ?>" class="btn-inline-view">Register / Details</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>