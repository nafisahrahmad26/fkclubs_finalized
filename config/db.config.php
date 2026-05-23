<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "fkclubs";

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$link) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>