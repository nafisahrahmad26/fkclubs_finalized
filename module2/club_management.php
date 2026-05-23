<?php
require_once __DIR__ . '/../config.db.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Admin') { header("Location: login.php"); exit; }

$msg = '';

// CRUD Operation: Create
if (isset($_POST['create_club'])) {
    $club_name = mysqli_real_escape_string($link, $_POST['club_name']);
    $club_category = mysqli_real_escape_string($link, $_POST['club_category']);
    $club_description = mysqli_real_escape_string($link, $_POST['club_description']);
    $advisor_id = intval($_POST['advisor_id']);

    $q = "INSERT INTO club (club_name, club_category, club_description, advisor_id, status) VALUES ('$club_name', '$club_category', '$club_description', $advisor_id, 'Active')";
    if (mysqli_query($link, $q)) {
        $msg = "<div class='alert alert-success'>Structural Club Entity Established!</div>";
    }
}

// CRUD Operation: Delete 
if (isset($_GET['delete_club_id'])) {
    $club_id = intval($_GET['delete_club_id']);
    mysqli_query($link, "DELETE FROM club WHERE club_id = $club_id");
    header("Location: club_management.php");
    exit;
}

$staff_res = mysqli_query($link, "SELECT user_id, name FROM user WHERE user_type = 'Staff'");
// Multi-Table Relational JOIN for Club configurations
$clubs_res = mysqli_query($link, "SELECT c.*, u.name as advisor_name FROM club c JOIN user u ON c.advisor_id = u.user_id ORDER BY c.club_id DESC");
?>
<?php require_once __DIR__ . '/header.php'; require_once __DIR__ . '/sidebar.php'; ?>

<h2>Club Entity Structural Management Console</h2>
<hr style="margin:15px 0; border:0; border-top:1px solid #e2e8f0;">
<?php echo $msg; ?>

<div style="display:flex; gap:30px; align-items:flex-start;">
    <div class="form-container" style="flex:1; max-width:380px;">
        <h3>Establish New Club Profile</h3>
        <form action="club_management.php" method="POST" style="margin-top:15px;">
            <div class="form-group"><label>Club System Name</label><input type="text" name="club_name" class="form-control" required></div>
            <div class="form-group"><label>Category Division</label><input type="text" name="club_category" class="form-control" placeholder="Academic / Sports" required></div>
            <div class="form-group"><label>Context Description</label><textarea name="club_description" class="form-control" rows="3" required></textarea></div>
            <div class="form-group">
                <label>Faculty Lead Advisor Assignment</label>
                <select name="advisor_id" class="form-control">
                    <?php while($s = mysqli_fetch_assoc($staff_res)): ?>
                        <option value="<?php echo $s['user_id']; ?>"><?php echo htmlspecialchars($s['name']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" name="create_club" class="btn btn-success" style="width:100%;">Authorize Organization</button>
        </form>
    </div>

    <div style="flex:2;">
        <h3>Current Operational Student Clubs</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Club Name</th>
                    <th>Division Category</th>
                    <th>Faculty Advisor</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($c = mysqli_fetch_assoc($clubs_res)): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($c['club_name']); ?></strong></td>
                    <td><?php echo htmlspecialchars($c['club_category']); ?></td>
                    <td><?php echo htmlspecialchars($c['advisor_name']); ?></td>
                    <td><a href="club_management.php?delete_club_id=<?php echo $c['club_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Purge club parameter?')">Deauthorize</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>