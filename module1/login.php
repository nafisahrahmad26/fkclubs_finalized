<?php
require_once('../config/db.config.php');
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = $_POST['password']; // In production use password_hash validation

    $query = "SELECT * FROM user WHERE username='$username' AND password='$password' AND status='Active'";
    $result = mysqli_query($link, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['user_type'] = $user['user_type'];

        if ($user['user_type'] === 'Admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: profile.php");
        }
        exit;
    } else {
        $error = "Invalid Active Username or Password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - FKClubs</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; text-align: center; }
        .logo-row { display: flex; justify-content: space-around; margin-bottom: 20px; font-size: 11px; color: #7f8c8d; font-weight: bold; }
        .logo-box { border: 1px dashed #bdc3c7; padding: 10px; width: 45%; }
        .form-group { text-align: left; margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { width: 100%; padding: 12px; background: #2c3e50; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; }
        .error-msg { color: #e74c3c; margin-bottom: 15px; font-size: 14px; }
    </style>
</head>
<body>
<div class="login-box">
    <div class="logo-row">
        <div class="logo-box">
            <img src="../images/umpsa_logo.png" alt="UMPSA Logo" style="max-width: 100%; max-height: 60px;">
        </div>
        
        <div class="logo-box">
            <img src="../images/logo_fk_dummy.png" alt="FKSC&EMS Logo" style="max-width: 100%; max-height: 60px;">
        </div>
    </div>
    <h2>Welcome to FKSC&EMS</h2>
    <p style="color: #7f8c8d; font-size:14px; margin-bottom: 20px;">Please login to continue</p>
    
    <?php if(!empty($error)): ?>
        <div class="error-msg"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required placeholder="Enter username">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required placeholder="Enter password">
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
</div>
</body>
</html>