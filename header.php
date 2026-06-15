<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FK Student Club & Event Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="app-container">
    <header class="main-header">
        <div class="logo-section">
            <img src="images/umpsa_logo.png" alt="UMPSA Logo" class="logo">
            <img src="images/logo_fk_dummy.png" alt="FKSC&EMS Logo" class="logo">
        </div>
        <div class="session-info">
            <?php if(isset($_SESSION['user_name'])): ?>
                <span>Welcome, <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong> (<?php echo htmlspecialchars($_SESSION['user_type']); ?>)</span>
            <?php endif; ?>
        </div>
    </header>
    <div class="main-layout">