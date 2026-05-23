<?php
require_once __DIR__ . '/../config.db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$msg = '';

// CRUD Operation: Create
if (isset($_POST['publish_event'])) {
    $club_id = intval($_POST['club_id']);
    $event_name = mysqli_real_escape_string($link, $_POST['event_name']);
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $event_description = mysqli_real_escape_string($link, $_POST['event_description']);
    $venue = mysqli_real_escape_string($link, $_POST['venue']);
    $max_participants = intval($_POST['max_participants']);

    $q = "INSERT INTO event (club_id, event_name, event_date, event_time, event_description, venue, max_participants) 
          VALUES ($club_id, '$event_name', '$event_date', '$event_time', '$event_description', '$venue', $max_participants)";
    if (mysqli_query($link, $q)) {
        $msg = "<div class='alert alert-success'>Activity published to live scheduled slates framework!</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Error: " . mysqli_error($link) . "</div>";
    }
}

$clubs_list = mysqli_query($link, "SELECT club_id, club_name FROM club WHERE status='Active'");
// Explicit Multi-Table relational Join verification matching Module 3 layout requirements
$events_res = mysqli_query($link, "SELECT e.*, c.club_name FROM event e JOIN club c ON e.club_id = c.club_id ORDER BY e.event_date ASC");
?>
<?php require_once __DIR__ . '/header.php'; require_once __DIR__ . '/sidebar.php'; ?>

<h2>Event Scheduling Control Framework</h2>
<hr style="margin:15px 0; border:0; border-top:1px solid #e2e8f0;">
<?php echo $msg; ?>

<div style="display:flex; gap:30px; align-items:flex-start;">
    <div class="form-container" style="flex:1; max-width:380px;">
        <h3>Authorize Activity Slate</h3>
        <form action="event_management.php" method="POST" style="margin-top:15px;">
            <div class="form-group">
                <label>Organizing Club Body</label>
                <select name="club_id" class="form-control">
                    <?php while($row = mysqli_fetch_assoc($clubs_list)): ?>
                        <option value="<?php echo $row['club_id']; ?>"><?php echo htmlspecialchars($row['club_name']); ?></option>
                    <?php endwhile; ?> </select>
            </div>
            <div class="form-group"><label>Event Structural Title</label><input type="text" name="event_name" class="form-control" required></div>
            <div class="form-group"><label>Execution Date Timeline</label><input type="date" name="event_date" class="form-control" required></div>
            <div class="form-group"><label>Execution Time</label><input type="time" name="event_time" class="form-control" required></div>
            <div class="form-group"><label>Designated Campus Venue</label><input type="text" name="venue" class="form-control" required></div>
            <div class="form-group"><label>Target Scope / Description</label><textarea name="event_description" class="form-control" rows="2" required></textarea></div>
            <div class="form-group"><label>Max Participation Volume</label><input type="number" name="max_participants" class="form-control" required></div>
            <button type="submit" name="publish_event" class="btn btn-primary" style="width:100%;">Commit to Live Framework</button>
        </form>
    </div>

    <div style="flex:2;">
        <h3>Active Scheduled Slates</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Event Details</th>
                    <th>Timeline Parameter</th>
                    <th>Venue Space</th>
                    <th>Max Cap</th>
                </tr>
            </thead>
            <tbody>
                <?php while($ev = mysqli_fetch_assoc($events_res)): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($ev['event_name']); ?></strong><br><span style="font-size:12px;color:#64748b;">Host: <?php echo htmlspecialchars($ev['club_name']); ?></span></td>
                    <td><?php echo $ev['event_date'] . ' @ ' . $ev['event_time']; ?></td>
                    <td><?php echo htmlspecialchars($ev['venue']); ?></td>
                    <td><strong><?php echo $ev['max_participants']; ?></strong> seats</td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>