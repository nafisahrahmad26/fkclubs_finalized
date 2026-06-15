<?php
require_once 'config/db.config.php';
if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$user_id = intval($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    $stmt = mysqli_prepare($conn, "UPDATE user SET name = ?, email = ? WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "ssi", $name, $email, $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    $_SESSION['user_name'] = $name;
    header("Location: profile.php?success=1");
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

include 'header.php';
include 'sidebar.php';
?>
<h2>User Profile Management</h2>
<div class="form-container-card">
    <form action="profile.php" method="POST">
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <button type="submit" class="btn-submit">Update Profile</button>
    </form>
</div>
<?php include 'footer.php'; ?>