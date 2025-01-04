<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] != 'admin') {
    echo "You don't have permission to delete products.";
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid product ID.";
    exit();
}

$productId = $_GET['id'];

include 'Connect_DB.php';

$sql = "SELECT * FROM Products WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $productId]);
$product = $stmt->fetch();

if (!$product) {
    echo "Product not found.";
    exit();
}

if (!empty($product['Image']) && file_exists($product['Image'])) {
    unlink($product['Image']);
}

$sql = "DELETE FROM Products WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $productId]);

header("Location: index.php");
exit();