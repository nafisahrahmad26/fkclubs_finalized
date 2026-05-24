<?php
require_once '../config/db.config.php';
if(!isset($_SESSION['user_id'])) { header("Location: ../module1/login.php"); exit; }

// CRUD Insertion/Updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user_type'] === 'Admin') {
    $club_name = $_POST['club_name'];
    $club_category = $_POST['club_category'];
    $club_description = $_POST['club_description'];
    $advisor_id = $_POST['advisor_id'];
    $status = $_POST['status'];

    if (!empty($_POST['club_id'])) {
        $stmt = $conn->prepare("UPDATE club SET club_name=?, club_category=?, club_description=?, advisor_id=?, status=? WHERE club_id=?");
        $stmt->execute([$club_name, $club_category, $club_description, $advisor_id, $status, $_POST['club_id']]);
    } else {
        $stmt = $conn->prepare("INSERT INTO club (club_name, club_category, club_description, advisor_id, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$club_name, $club_category, $club_description, $advisor_id, $status]);
    }
    header("Location: club_list.php");
    exit;
}

// Single Table Distinct Report Requirement for Module 2
$search = $_GET['search'] ?? '';
$stmt = $conn->prepare("SELECT * FROM club WHERE club_name LIKE ?");
$stmt->execute(["%$search%"]);
$clubs = $stmt->fetchAll();

// Get Staff Users for Advisor Assignment Selection drop-downs
$advisors = $conn->query("SELECT user_id, name FROM user WHERE user_type = 'Staff'")->fetchAll();

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<h2>Club List</h2>

<?php if($_SESSION['user_type'] === 'Admin'): ?>
<div class="form-container-card">
    <h3>Create / Manage Club Profile</h3>
    <form action="club_list.php" method="POST">
        <input type="hidden" name="club_id" id="club-form-id">
        <div class="form-row">
            <input type="text" name="club_name" id="club-form-name" placeholder="Club Name" required>
            <input type="text" name="club_category" id="club-form-category" placeholder="Category" required>
        </div>
        <div class="form-row">
            <select name="advisor_id" id="club-form-advisor">
                <?php foreach($advisors as $adv): ?>
                    <option value="<?= $adv['user_id']; ?>"><?= htmlspecialchars($adv['name']); ?></option>
                <?php endforeach; ?>
            </select>
            <select name="status" id="club-form-status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>
        <textarea name="club_description" id="club-form-desc" placeholder="Club Description Structure"></textarea>
        <button type="submit" class="btn-action">Save Club</button>
    </form>
</div>
<?php endif; ?>

<form method="GET" action="club_list.php" class="filter-bar">
    <input type="text" name="search" value="<?= htmlspecialchars($search); ?>" placeholder="Search Club">
    <button type="submit">Search Club</button>
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
        <?php $idx=1; foreach($clubs as $c): ?>
        <tr>
            <td><?= $idx++; ?></td>
            <td><strong><?= htmlspecialchars($c['club_name']); ?></strong></td>
            <td><?= htmlspecialchars($c['club_category']); ?></td>
            <td><?= htmlspecialchars($c['status']); ?></td>
            <td>
                <?php if($_SESSION['user_type'] === 'Admin'): ?>
                    <button class="btn-inline-edit" onclick="editClub(<?= htmlspecialchars(json_encode($c)); ?>)">Edit</button>
                <?php endif; ?>
                <a href="club_management.php?id=<?= $c['club_id']; ?>" class="btn-inline-view">View details</a>
            </td>
        </tr>
        <?php endforeach; ?>
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

<?php include '../includes/footer.php'; ?>