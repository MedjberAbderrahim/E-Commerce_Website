<?php
session_start();

if (!isset($_SESSION['userID'])) {
    die( "You are not logged in.");
}

include 'Connect_DB.php';

$userID = $_SESSION['userID'];

$sql = "DELETE FROM Users WHERE id = :userID";
$stmt = $pdo->prepare($sql);
$stmt->execute(['userID' => $userID]);

header("Location: logout.php");
exit();
