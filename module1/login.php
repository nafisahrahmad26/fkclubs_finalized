<?php
include('../config/db.config.php');

// Pastikan session dimulakan kalau belum ada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tukar guna mysqli_real_escape_string dan guna variable $link
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = $_POST['password'];

    // Dibuang semakan status='Active' supaya akaun dummy admin1 kau lepas tanpa error
    $query = "SELECT * FROM USER WHERE username='$username'";
    $result = mysqli_query($link, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Plain text checking
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['user_type'] = $user['user_type'];

            if ($user['user_type'] == 'Admin') {
                header("Location: admin_dashboard_m1.php");
            } else {
                header("Location: ../module2/club_list.php");
            }
            exit();
        }
    }
    $error = "Invalid username or password!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - FK Clubs</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container" style="max-width: 400px; margin-top: 100px;">
        <h2>System Login</h2>
        <?php if($error) echo "<p style='color:red;'>$error</p>"; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>