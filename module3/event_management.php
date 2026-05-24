<?php
require_once '../config/db.config.php';
if(!isset($_SESSION['user_id'])) { header("Location: ../module1/login.php"); exit; }

// CRUD Insertion: Manage Events logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user_type'] !== 'Student') {
    $club_id = $_POST['club_id'];
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $venue = $_POST['venue'];
    $max_participants = $_POST['max_participants'];
    $event_description = $_POST['event_description'];

    $stmt = $conn->prepare("INSERT INTO event (club_id, event_name, event_date, event_time, venue, max_participants, event_description) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$club_id, $event_name, $event_date, $event_time, $venue, $max_participants, $event_description]);
    header("Location: event_management.php");
    exit;
}

// Single table query evaluation structure
$events = $conn->query("SELECT * FROM event ORDER BY event_date ASC")->fetchAll();
$clubs = $conn->query("SELECT club_id, club_name FROM club WHERE status='Active'")->fetchAll();

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<h2>Event List & Management</h2>

<?php if($_SESSION['user_type'] !== 'Student'): ?>
<div class="form-container-card">
    <h3>Organize New Activity / Program Event</h3>
    <form action="event_management.php" method="POST">
        <div class="form-row">
            <select name="club_id" required>
                <option value="">Select Host Club</option>
                <?php foreach($clubs as $cl): ?>
                    <option value="<?= $cl['club_id']; ?>"><?= htmlspecialchars($cl['club_name']); ?></option>
                <?php endforeach; ?>
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
        <textarea name="event_description" placeholder="Write comprehensive breakdown notes..."></textarea>
        <button type="submit" class="btn-action">Publish Program Event</button>
    </form>
</div>
<?php endif; ?>

<table class="data-table">
    <thead>
        <tr>
            <th>Event Title</th>
            <th>Date</th>
            <th>Venue</th>
            <th>Capacity Limit Check</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($events as $ev): 
            // Calculate filled counter balance slots
            $regCount = $conn->prepare("SELECT COUNT(*) FROM event_registration WHERE event_id = ? AND status='Registered'");
            $regCount->execute([$ev['event_id']]);
            $currentCount = $regCount->fetchColumn();
        ?>
        <tr>
            <td><strong><?= htmlspecialchars($ev['event_name']); ?></strong></td>
            <td><?= $ev['event_date']; ?></td>
            <td><?= htmlspecialchars($ev['venue']); ?></td>
            <td><?= $currentCount; ?> / <?= $ev['max_participants']; ?> Slots Used</td>
            <td>
                <a href="event_registration.php?id=<?= $ev['event_id']; ?>" class="btn-inline-view">Register / Details</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>