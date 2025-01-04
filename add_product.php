<?php
session_start();
if ($_SESSION["username"] !== 'admin') {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

include 'Connect_DB.php';

$name = $_POST['name'];
$price = $_POST['price'];
$imagePath = null;

if (!empty($_FILES['image']['name'])) {
    $targetDir = "uploads/";
    $imagePath = $targetDir . basename($_FILES['image']['name']);
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        die("Error uploading file.");
    }
}
echo 'HAHA2';
try {
    $query = "INSERT INTO Products (Name, Price, Image) VALUES (:name, :price, :image)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':name' => $name,
        ':price' => $price,
        ':image' => $imagePath
    ]);
    header("Location: index.php?message=Product+added+successfully");
}
catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}