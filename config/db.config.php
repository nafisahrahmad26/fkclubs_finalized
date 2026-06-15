<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$localhost = "localhost";
$username   = "root";
$password   = "";
$database   = "fkclubs";

$conn = mysqli_connect($localhost, $username, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>