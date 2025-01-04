<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] != 'admin') {
    echo "You don't have permission to delete products.";
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $productId = $_GET['id'];

    include 'Connect_DB.php';

    $sql = "DELETE FROM Products WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->execute(['id' => $productId]);

    header("Location: index.php");  // Or wherever you want to redirect
    exit();
} else {
    echo "Invalid product ID.";
}