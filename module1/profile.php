<?php
require_once('../includes/header.php');
$my_id = $_SESSION['user_id'];

if (isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    
    mysqli_query($link, "UPDATE user SET name='$name', email='$email', password='$password' WHERE user_id=$my_id");
    $_SESSION['name'] = $name;
}

$me = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM user WHERE user_id=$my_id"));
?>

<h2>👤 Account Settings & Personal Profile Management</h2>
<div class="ui-card" style="max-width: 600px;">
    <form action="profile.php" method="POST">
        <div class="form-group">
            <label>Username (Read Only)</label>
            <input type="text" class="form-control" value="<?php echo $me['username']; ?>" disabled>
        </div>
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $me['name']; ?>" required>
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" value="<?php echo $me['email']; ?>" required>
        </div>
        <div class="form-group">
            <label>Security Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $me['password']; ?>" required>
        </div>
        <button type="submit" name="update_profile" class="btn btn-primary">Update Profile Content</button>
    </form>
</div>

<?php include('../includes/footer.php'); ?>