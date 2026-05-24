<?php
require_once '../config/db.config.php';
if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    $stmt = $conn->prepare("UPDATE user SET name = ?, email = ? WHERE user_id = ?");
    $stmt->execute([$name, $email, $_SESSION['user_id']]);
    $_SESSION['user_name'] = $name;
    header("Location: profile.php?success=1");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM user WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

include '../includes/header.php';
include '../includes/sidebar.php';
?>
<h2>User Profile Management</h2>
<div class="form-container-card">
    <form action="profile.php" method="POST">
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($user['name']); ?>" required>
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
        </div>
        <button type="submit" class="btn-submit">Update Profile</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>