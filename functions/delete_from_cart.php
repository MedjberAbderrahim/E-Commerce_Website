<?php
session_start();

if (!isset($_SESSION['userID'])) {
    die("You are not logged in.");
}

if (!isset($_GET['productID']) || !is_numeric($_GET['productID'])) {
    die("Invalid product ID.");
}

$productId = intval($_GET['productID']);
$userId = intval($_SESSION['userID']);

include 'Connect_DB.php';

try {
    // THIS SO I ONLY DELETE THE FIRST OCCURRENCE OF THE PRODUCT-USER COMBINATION,
    // IN THE CASE OF A USER HAVING MULTIPLE COPIES OF THE SAME PRODUCT IN HIS CART.
    $stmt = $pdo->prepare("
    DELETE FROM Cart 
    WHERE ID = (
        SELECT MIN(ID) 
        FROM Cart 
        WHERE Product_ID = :productID AND User_ID = :userID
    )
    AND User_ID = :userID
    ");

    $stmt->execute([':productID' => $productId, ':userID' => $userId]);
}
catch (PDOException $e) {
    die("Error removing product from cart: " . $e->getMessage());
}

header("Location: ../index.php?message=Product+removed+from+cart+successfully.");
exit();