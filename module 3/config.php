<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// connection to database
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

// select database
mysqli_select_db($link, "fkclubs") or die(mysqli_error($link));

function getDB() {
    static $pdo = null;

    if ($pdo === null) {
        $pdo = new PDO(
            "mysql:host=localhost;dbname=fkclubs;charset=utf8",
            "root",
            "",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }

    return $pdo;
}
?>