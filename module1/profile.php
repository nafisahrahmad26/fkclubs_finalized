<?php
require_once __DIR__ . '/../config.db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$user_id = $_SESSION['user_id'];
$feedback = '';

// CRUD Operation: Update personal identity details
if (isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    
    // File upload management loop for profile images matching table specifications
    $photo_filename = null;
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION);
        $photo_filename = "uploads/avatar_" . $user_id . "_" . time() . "." . $ext;
        move_uploaded_file($_FILES['profile_photo']['tmp_name'], __DIR__ . '/' . $photo_filename);
    }

    if ($photo_filename) {
        $update_q = "UPDATE user SET name = '$name', email = '$email', profile_photo = '$photo_filename' WHERE user_id = $user_id";
    } else {
        $update_q = "UPDATE user SET name = '$name', email = '$email' WHERE user_id = $user_id";
    }
    
    if (mysqli_query($link, $update_q)) {
        $_SESSION['name'] = $name;
        $feedback = "<div class='alert alert-success'>Profile metadata synchronized successfully.</div>";
    }
}

$my_meta = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM user WHERE user_id = $user_id"));
?>
<?php require_once __DIR__ . '/header.php'; require_once __DIR__ . '/sidebar.php'; ?>

<h2>Manage Personal Information Profile</h2>
<hr style="margin:15px 0; border:0; border-top:1px solid #e2e8f0;">
<?php echo $feedback; ?>

<div class="form-container" style="max-width:550px;">
    <form action="profile.php" method="POST" enctype="multipart/form-data">
        <div style="text-align:center; margin-bottom:20px;">
            <?php if(!empty($my_meta['profile_photo'])): ?>
                <img src="<?php echo htmlspecialchars($my_meta['profile_photo']); ?>" style="width:100px; height:100px; border-radius:50%; object-fit:cover; border:2px solid #cbd5e1;">
            <?php else: ?>
                <div style="width:100px; height:100px; border-radius:50%; background:#e2e8f0; margin:0 auto; display:flex; align-items:center; justify-content:center; color:#64748b; font-weight:bold;">No Avatar</div>
            <?php endif; ?>
        </div>
        <div class="form-group"><label>Full Name Reference</label><input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($my_meta['name']); ?>" required></div>
        <div class="form-group"><label>Network Communication Email</label><input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($my_meta['email']); ?>" required></div>
        <div class="form-group"><label>Modify Profile Picture Resource</label><input type="file" name="profile_photo" class="form-control"></div>
        <button type="submit" name="update_profile" class="btn btn-primary" style="margin-top:10px;">Commit Profile Mutations</button>
    </form>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
