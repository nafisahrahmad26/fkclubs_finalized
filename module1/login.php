<?php
require_once __DIR__ . '/../config.db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($link, trim($_POST['username']));
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Direct plain-text comparison matching table user parameters
        $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password' LIMIT 1";
        $result = mysqli_query($link, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            if ($user['status'] === 'Inactive') {
                $error = "Access denied: Account is currently suspended.";
            } else {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['user_type'] = $user['user_type']; // Admin, Student, Staff
                
                header("Location: admin_dashboard.php");
                exit;
            }
        } else {
            $error = "Invalid username or password configuration.";
        }
    } else {
        $error = "Please fill in all layout fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - FKSC & EMS Portal</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .login-wrapper { display: flex; justify-content: center; align-items: center; height: 100vh; background: #e2e8f0; }
        .login-card { background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 400px; }
    </style>
</head>
<body>
<div class="login-wrapper">
    <div class="login-card">
        <div style="text-align: center; margin-bottom: 25px;">
            <h2>FKSC & EMS PORTAL</h2>
            <p style="font-size:12px; color:#64748b;">Faculty of Computing Management Ingress</p>
        </div>
        
        <?php if(!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label>System Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter username" required>
            </div>
            <div class="form-group">
                <label>System Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Authenticate Session</button>
        </form>
    </div>
</div>
</body>
</html>