<?php
require_once 'config/db.config.php';
if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Admin') { 
    header("Location: login.php"); exit; 
}

// DELETE CRUD Operation
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $stmt = mysqli_prepare($conn, "DELETE FROM user WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $delete_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: user_management.php");
    exit;
}

// CREATE / UPDATE CRUD Operation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];
    $status = $_POST['status'];

    if (!empty($_POST['user_id'])) {
        // UPDATE ACTION
        $user_id = intval($_POST['user_id']);
        $stmt = mysqli_prepare($conn, "UPDATE user SET name=?, email=?, username=?, password=?, user_type=?, status=? WHERE user_id=?");
        mysqli_stmt_bind_param($stmt, "ssssssi", $name, $email, $username, $password, $user_type, $status, $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        // CREATE ACTION
        $stmt = mysqli_prepare($conn, "INSERT INTO user (name, email, username, password, user_type, status) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $username, $password, $user_type, $status);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header("Location: user_management.php");
    exit;
}

// SEARCH & FILTER
$search = isset($_GET['search']) ? $_GET['search'] : '';
$roleFilter = isset($_GET['role_filter']) ? $_GET['role_filter'] : '';

$query = "SELECT * FROM user WHERE (name LIKE ? OR email LIKE ?)";
$search_param = "%$search%";

if (!empty($roleFilter)) {
    $query .= " AND user_type = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $search_param, $search_param, $roleFilter);
} else {
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $search_param, $search_param);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<?php
include 'header.php';
include 'sidebar.php';
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
                <option value="Staff">Staff</option>
                <option value="Admin">Admin</option>
            </select>
            <select name="status" id="form-status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn-action">Save User</button>
    </form>
</div>

<form method="GET" action="user_management.php" class="filter-bar">
    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search User">
    <select name="role_filter">
        <option value="">Filter by Role</option>
        <option value="Admin" <?php echo $roleFilter=='Admin'?'selected':''; ?>>Admin</option>
        <option value="Student" <?php echo $roleFilter=='Student'?'selected':''; ?>>Student</option>
        <option value="Staff" <?php echo $roleFilter=='Staff'?'selected':''; ?>>Staff</option>
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
        <?php while($u = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $u['user_id']; ?></td>
            <td><?php echo htmlspecialchars($u['name']); ?></td>
            <td><?php echo htmlspecialchars($u['email']); ?></td>
            <td><?php echo htmlspecialchars($u['user_type']); ?></td>
            <td><?php echo htmlspecialchars($u['status']); ?></td>
            <td>
                <button class="btn-inline-edit" onclick='editUser(<?php echo json_encode($u); ?>)'>Edit</button>
                <a href="user_management.php?delete=<?php echo $u['user_id']; ?>" class="btn-inline-delete" onclick="return confirm('Delete user record?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
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

<?php 
mysqli_stmt_close($stmt);
include 'footer.php'; 
?>