<?php
session_start();

if (!isset($_SESSION['userID']))
    die("You are not logged in.");

if (!isset($_GET['productID']) || !is_numeric($_GET['productID']))
    die("Invalid product ID.");

$productId = intval($_GET['productID']);
$userId = intval($_SESSION['userID']);

include 'Connect_DB.php';

try {
    $stmt = $pdo->prepare("INSERT INTO Cart (Product_ID, User_ID) VALUES (:productID, :userID)");
    $stmt->execute([':productID' => $productId, ':userID' => $userId]);
}
catch (PDOException $e) {
    die("Error adding product to cart: " . $e->getMessage());
}

header("Location: ../index.php?message=Product+added+to+cart+successfully.");
exit();