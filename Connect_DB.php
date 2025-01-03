<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "MainDB";
$port = 3306;

$dsn = "mysql:host=" . $host . ";dbname=" . $dbname . ";port=" . $port;
try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database Connection Failed: " . $e->getMessage();
    exit();
}