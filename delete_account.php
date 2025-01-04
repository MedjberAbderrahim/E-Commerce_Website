<?php
session_start();

if (!isset($_SESSION['userID'])) {
    echo "You must be logged in to delete your account.";
    exit();
}

include 'Connect_DB.php';

$userID = $_SESSION['userID'];

$sql = "DELETE FROM Users WHERE id = :userID";
$stmt = $pdo->prepare($sql);
$stmt->execute(['userID' => $userID]);

session_destroy();

header("Location: login.php");
exit();
