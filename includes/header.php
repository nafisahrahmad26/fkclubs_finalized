<?php
require_once __DIR__ . '/../config.db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FKSC & EMS - Faculty of Computing</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="app-container">
    <header class="main-header">
        <div class="logo-area">
            <div class="logo-box">UMPSA Logo</div>
            <div class="logo-box">FKSC & EMS</div>
        </div>
        <div class="system-title">
            <h2>FK Club Activity Management & Attendance System</h2>
        </div>
        <div class="user-meta">
            <?php if(isset($_SESSION['user_id'])): ?>
                <span>Active Session: <strong><?php echo htmlspecialchars($_SESSION['name']); ?></strong> (<?php echo htmlspecialchars($_SESSION['user_type']); ?>)</span>
            <?php endif; ?>
        </div>
    </header>
    <div class="main-layout">