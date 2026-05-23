<?php
require_once __DIR__ . '/../config.db.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Admin') { header("Location: login.php"); exit; }

$msg = '';

// CRUD Operation: Create
if (isset($_POST['create_user'])) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $user_type = $_POST['user_type'];

    $query = "INSERT INTO user (name, email, username, password, user_type, status) VALUES ('$name', '$email', '$username', '$password', '$user_type', 'Active')";
    if (mysqli_query($link, $query)) {
        $msg = "<div class='alert alert-success'>User registered successfully!</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Error execution: " . mysqli_error($link) . "</div>";
    }
}

// CRUD Operation: Delete
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    mysqli_query($link, "DELETE FROM user WHERE user_id = $delete_id");
    header("Location: user_management.php");
    exit;
}

// CRUD Operation: Update status parameter
if (isset($_GET['toggle_status'])) {
    $toggle_id = intval($_GET['toggle_status']);
    mysqli_query($link, "UPDATE user SET status = IF(status='Active', 'Inactive', 'Active') WHERE user_id = $toggle_id");
    header("Location: user_management.php");
    exit;
}

// CRUD Operation: Read
$users_res = mysqli_query($link, "SELECT * FROM user ORDER BY user_id DESC");
?>
<?php require_once __DIR__ . '/header.php'; require_once __DIR__ . '/sidebar.php'; ?>

<h2>System Identity & Membership Base Management</h2>
<hr style="margin:15px 0; border:0; border-top:1px solid #e2e8f0;">
<?php echo $msg; ?>

<div style="display:flex; gap:30px; align-items:flex-start;">
    <div class="form-container" style="flex:1; max-width:360px;">
        <h3>Register / Insert New Identity</h3>
        <form action="user_management.php" method="POST" style="margin-top:15px;">
            <div class="form-group"><label>Full Name</label><input type="text" name="name" class="form-control" required></div>
            <div class="form-group"><label>University Email</label><input type="email" name="email" class="form-control" required></div>
            <div class="form-group"><label>Username</label><input type="text" name="username" class="form-control" required></div>
            <div class="form-group"><label>Password</label><input type="password" name="password" class="form-control" required></div>
            <div class="form-group">
                <label>System Role Assignment</label>
                <select name="user_type" class="form-control">
                    <option value="Student">Registered Student</option>
                    <option value="Staff">Club Committee Member / Staff</option>
                    <option value="Admin">System Administrator</option>
                </select>
            </div>
            <button type="submit" name="create_user" class="btn btn-success" style="width:100%;">Execute Provisioning</button>
        </form>
    </div>

    <div style="flex:2;">
        <h3>Active System Identity Base</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Identity Profile</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Operations Matrix</th>
                </tr>
            </thead>
            <tbody>
                <?php while($u = mysqli_fetch_assoc($users_res)): ?>
                <tr>
                    <td>#<?php echo $u['user_id']; ?></td>
                    <td><strong><?php echo htmlspecialchars($u['name']); ?></strong><br><span style="font-size:12px;color:#64748b;"><?php echo htmlspecialchars($u['email']); ?></span></td>
                    <td><?php echo $u['user_type']; ?></td>
                    <td><span style="padding:2px 6px; border-radius:12px; font-size:11px; font-weight:bold; background:<?php echo $u['status']=='Active'?'#dcfce7;color:#15803d;':'#fee2e2;color:#b91c1c;';?>"><?php echo $u['status']; ?></span></td>
                    <td>
                        <a href="user_management.php?toggle_status=<?php echo $u['user_id']; ?>" class="btn btn-primary btn-sm" style="background:#475569;">Toggle Status</a>
                        <a href="user_management.php?delete_id=<?php echo $u['user_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Purge account registry entity permanent?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?> </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>