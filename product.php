<?php
include 'Connect_DB.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid product ID.");
}

$product_id = $_GET['id'];

try {
    $query = "SELECT * FROM Products WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':id' => $product_id]);
    $product = $stmt->fetch();

    if (!$product) {
        die("Product not found.");
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['Name']); ?></title>
    <link rel="stylesheet" href="product.css">
</head>
<body>
<a href="index.php" class="back-link">Back to Product List</a>
<div class="product-container">
    <div class="product-info">
        <h1><?php echo htmlspecialchars($product['Name']); ?></h1>
        <p class="price">$<?php echo number_format($product['Price'], 2); ?></p>
        <p class="description"><?php echo nl2br(htmlspecialchars($product['Description'])); ?></p>
    </div>
    <div class="product-image">
        <?php if ($product['Image']): ?>
            <img src="<?php echo htmlspecialchars($product['Image']); ?>" alt="<?php echo htmlspecialchars($product['Name']); ?>" class="product-img">
        <?php endif; ?>
    </div>
</div>

</body>
</html>