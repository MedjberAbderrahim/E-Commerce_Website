<?php
session_start();
if ($_SESSION["username"] !== 'admin')
    die( "You don't have permission to add products.");

if ($_SERVER["REQUEST_METHOD"] !== "POST")
    die("Invalid request method.");

include 'Connect_DB.php';

$name = $_POST['name'];
$price = $_POST['price'];
$description = !empty($_POST['description']) ? $_POST['description'] : null;
$imagePath = null;

if (!empty($_FILES['image']['name'])) {
    $targetDir = "../uploads/";
    $imagePath = $targetDir . basename($_FILES['image']['name']);
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        die("Error uploading file.");
    }
}

// Re-updating file path, for database insertion
$targetDir = "uploads/";
$imagePath = $targetDir . basename($_FILES['image']['name']);

try {
    $query = "INSERT INTO Products (Name, Price, Description, Image, Creation_Date) VALUES (:name, :price, :description, :image, :date)";

    $stmt = $pdo->prepare($query);

    $stmt->execute([
        ':name' => $name,
        ':price' => $price,
        ':description' => $description,
        ':image' => $imagePath,
        ':date' => date('Y-m-d')
    ]);

    header("Location: ../index.php");
    exit();
}
catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}