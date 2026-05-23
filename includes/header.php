<?php
require_once(__DIR__ . '/../config/db.config.php');
if (!isset($_SESSION['user_id'])) {
    header("Location: ../module1/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FKClubs Portal</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include('sidebar.php'); ?>
    <div class="main-content">
        <div class="top-navbar">
            <div class="brand-title"><strong>FKClubs Management System</strong></div>
            <div class="user-badge">
                Welcome, <?php echo htmlspecialchars($_SESSION['name'] ? $_SESSION['name'] : $_SESSION['username']); ?>
                <span class="user-role"><?php echo $_SESSION['user_type']; ?></span>
            </div>
        </div>
        <div class="container"></div>