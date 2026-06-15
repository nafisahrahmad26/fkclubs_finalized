<?php
require_once 'config/db.config.php';
if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

// CRUD Create & Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user_type'] === 'Admin') {
    $club_name = $_POST['club_name'];
    $club_category = $_POST['club_category'];
    $club_description = $_POST['club_description'];
    $advisor_id = intval($_POST['advisor_id']);
    $status = $_POST['status'];

    if (!empty($_POST['club_id'])) {
        $club_id = intval($_POST['club_id']);
        $stmt = mysqli_prepare($conn, "UPDATE club SET club_name=?, club_category=?, club_description=?, advisor_id=?, status=? WHERE club_id=?");
        mysqli_stmt_bind_param($stmt, "sssiis", $club_name, $club_category, $club_description, $advisor_id, $status, $club_id);
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO club (club_name, club_category, club_description, advisor_id, status) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssis", $club_name, $club_category, $club_description, $advisor_id, $status);
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: club_list.php");
    exit;
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$search_param = "%$search%";
$stmt = mysqli_prepare($conn, "SELECT * FROM club WHERE club_name LIKE ?");
mysqli_stmt_bind_param($stmt, "s", $search_param);
mysqli_stmt_execute($stmt);
$clubsResult = mysqli_stmt_get_result($stmt);

$advisors = mysqli_query($conn, "SELECT user_id, name FROM user WHERE user_type = 'Staff'");

include 'header.php';
include 'sidebar.php';
?>

<h2>Club List</h2>

<?php if($_SESSION['user_type'] === 'Admin'): ?>
<div class="form-container-card">
    <h3>Create / Manage Club Profile</h3>
    <form action="club_list.php" method="POST">
        <input type="hidden" name="club_id" id="club-form-id">
        <div class="form-row">
            <input type="text" name="club_name" id="club-form-name" placeholder="Club Name" required>
            <select name="club_category" id="club-form-category" required>
                <option value="">-- Select Category --</option>
                <option value="Kesenian">Kesenian</option>
                <option value="BBU">BBU</option>
                <option value="Sukan">Sukan</option>
                <option value="Kesukarelawanan">Kesukarelawanan</option>
                <option value="Keusahawanan">Keusahawanan</option>
            </select>
        </div>
        <div class="form-row">
            <select name="advisor_id" id="club-form-advisor">
                <?php while($adv = mysqli_fetch_assoc($advisors)): ?>
                    <option value="<?php echo $adv['user_id']; ?>"><?php echo htmlspecialchars($adv['name']); ?></option>
                <?php endwhile; ?>
            </select>
            <select name="status" id="club-form-status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>
        <textarea name="club_description" id="club-form-desc" placeholder="Club Description"></textarea>
        <button type="submit" class="btn-action">Save Club</button>
    </form>
</div>
<?php endif; ?>

<form method="GET" action="club_list.php" class="filter-bar">
    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search Club">
    <button type="submit">Search</button>
</form>

<table class="data-table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Club Name</th>
            <th>Category</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $idx=1; while($c = mysqli_fetch_assoc($clubsResult)): ?>
        <tr>
            <td><?php echo $idx++; ?></td>
            <td><strong><?php echo htmlspecialchars($c['club_name']); ?></strong></td>
            <td><?php echo htmlspecialchars($c['club_category']); ?></td>
            <td><?php echo htmlspecialchars($c['status']); ?></td>
            <td>
                <?php if($_SESSION['user_type'] === 'Admin'): ?>
                    <button class="btn-inline-edit" onclick='editClub(<?php echo json_encode($c); ?>)'>Edit</button>
                <?php endif; ?>
                <a href="club_management.php?id=<?php echo $c['club_id']; ?>" class="btn-inline-view">Details</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<script>
function editClub(club) {
    document.getElementById('club-form-id').value = club.club_id;
    document.getElementById('club-form-name').value = club.club_name;
    document.getElementById('club-form-category').value = club.club_category;
    document.getElementById('club-form-advisor').value = club.advisor_id;
    document.getElementById('club-form-status').value = club.status;
    document.getElementById('club-form-desc').value = club.club_description;
}
</script>

<?php 
mysqli_stmt_close($stmt);
include 'footer.php'; 
?>