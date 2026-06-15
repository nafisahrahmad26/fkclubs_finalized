<?php
require_once 'config/db.config.php';

// Pastikan session bermula sekiranya fail db.config.php belum memulakannya
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        
        // DI SINI TELAH DIUBAH DARIPADA $link KEPADA $conn
        $stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ? AND status = 'Active'");
        
        if ($stmt) {
            // 's' bermaksud string untuk parameter username
            mysqli_stmt_bind_param($stmt, "s", $username);
            
            // Jalankan query
            mysqli_stmt_execute($stmt);
            
            // Ambil hasil carian database
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);

            // Plain text comparison check sepadan dengan data dalam pangkalan data anda
            if ($user && $password === $user['password']) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_type'] = $user['user_type'];
                
                header("Location: admin_dashboard.php");
                exit;
            } else {
                $error = "Invalid active credentials.";
            }
            
            // Tutup statement MySQLi selepas digunakan
            mysqli_stmt_close($stmt);
        } else {
            $error = "Database query error.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - FKSC&EMS</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-header-logos">
            <img src="images/umpsa_logo.png" alt="UMPSA Logo">
            <img src="images/logo_fk_dummy.png" alt="FKSC&EMS Logo">
        </div>
        <h2>Welcome to FKSC&EMS</h2>
        <p>Please login to continue</p>
        
        <?php if($error): ?>
            <div class="alert-error" style="color: red; background: #f8d7da; padding: 10px; margin-bottom: 15px; border-radius: 4px; text-align: left; font-size: 0.9rem; border: 1px solid #f5c6cb;"><?= $error; ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-submit">Login</button>
        </form>
        <div class="login-links">
            <a href="#">Forgot Password?</a>
            <a href="#">Register (new user)</a>
        </div>
    </div>
</body>
</html>