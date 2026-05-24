<?php
require_once '../config/db.config.php';
if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Admin') { 
    header("Location: login.php"); exit; 
}

// Handle Delete CRUD Operation
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM user WHERE user_id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: user_management.php");
    exit;
}

// Handle Create/Update CRUD Operation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];
    $status = $_POST['status'];

    if (!empty($_POST['user_id'])) {
        // Update Action
        $stmt = $conn->prepare("UPDATE user SET name=?, email=?, username=?, password=?, user_type=?, status=? WHERE user_id=?");
        $stmt->execute([$name, $email, $username, $password, $user_type, $status, $_POST['user_id']]);
    } else {
        // Create Action
        $stmt = $conn->prepare("INSERT INTO user (name, email, username, password, user_type, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $username, $password, $user_type, $status]);
    }
    header("Location: user_management.php");
    exit;
}

// Handle Filter and Search
$search = $_GET['search'] ?? '';
$roleFilter = $_GET['role_filter'] ?? '';

$query = "SELECT * FROM user WHERE (name LIKE ? OR email LIKE ?)";
$params = ["%$search%", "%$search%"];

if (!empty($roleFilter)) {
    $query .= " AND user_type = ?";
    $params[] = $roleFilter;
}
$stmt = $conn->prepare($query);
$stmt->execute($params);
$users = $stmt->fetchAll();

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<h2>User Management</h2>

<div class="form-container-card">
    <h3>Add / Edit User Account</h3>
    <form action="user_management.php" method="POST">
        <input type="hidden" name="user_id" id="form-user-id">
        <div class="form-row">
            <input type="text" name="name" id="form-name" placeholder="Full Name" required>
            <input type="email" name="email" id="form-email" placeholder="Email" required>
        </div>
        <div class="form-row">
            <input type="text" name="username" id="form-username" placeholder="Username" required>
            <input type="password" name="password" id="form-password" placeholder="Password" required>
        </div>
        <div class="form-row">
            <select name="user_type" id="form-role">
                <option value="Student">Student</option>
                <option value="Staff">Staff (Committee/Advisor)</option>
                <option value="Admin">Admin</option>
            </select>
            <select name="status" id="form-status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn-action btn-save">Save User</button>
    </form>
</div>

<form method="GET" action="user_management.php" class="filter-bar">
    <input type="text" name="search" value="<?= htmlspecialchars($search); ?>" placeholder="Search User">
    <select name="role_filter">
        <option value="">Filter by Role</option>
        <option value="Admin" <?= $roleFilter=='Admin'?'selected':''; ?>>Admin</option>
        <option value="Student" <?= $roleFilter=='Student'?'selected':''; ?>>Student</option>
        <option value="Staff" <?= $roleFilter=='Staff'?'selected':''; ?>>Staff</option>
    </select>
    <button type="submit">Search</button>
</form>

<table class="data-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $u): ?>
        <tr>
            <td><?= $u['user_id']; ?></td>
            <td><?= htmlspecialchars($u['name']); ?></td>
            <td><?= htmlspecialchars($u['email']); ?></td>
            <td><?= htmlspecialchars($u['user_type']); ?></td>
            <td><?= htmlspecialchars($u['status']); ?></td>
            <td>
                <button class="btn-inline-edit" onclick="editUser(<?= htmlspecialchars(json_encode($u)); ?>)">Edit</button>
                <a href="user_management.php?delete=<?= $u['user_id']; ?>" class="btn-inline-delete" onclick="return confirm('Delete user record?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
function editUser(user) {
    document.getElementById('form-user-id').value = user.user_id;
    document.getElementById('form-name').value = user.name;
    document.getElementById('form-email').value = user.email;
    document.getElementById('form-username').value = user.username;
    document.getElementById('form-password').value = user.password;
    document.getElementById('form-role').value = user.user_type;
    document.getElementById('form-status').value = user.status;
}
</script>

<?php include '../includes/footer.php'; ?>