<?php
    session_start();
    if (!isset($_SESSION["isLoggedIn"]) || !$_SESSION["isLoggedIn"]) {
        header("Location: login.php");
    }
    include 'Connect_DB.php';

    function load_products(PDO $pdo) {
        $query = "SELECT * FROM Products";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function displayProducts($pdo){
        $products = load_products($pdo);
        foreach ($products as $product) {
            echo '<div class="product">
                <img src="' . htmlspecialchars($product["Image"]) . '" alt="' . htmlspecialchars($product["Name"]) . '">
                <h3>' . htmlspecialchars($product["Name"]) . '</h3>
                <p>$' . htmlspecialchars($product["Price"]) . '</p>
                <button onclick="addToCart(' . $product["id"] . ')">Add to Cart</button>
              </div>';
        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El-Wawi Store</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

<header>
    <h1 id="TitleHeader">El-Wawi Store</h1>
    <div id="btns">
        <button id="cart-btn">View Cart</button>
        <a href="logout.php" id="disconnect-btn">Disconnect</a>
    </div>
</header>

<main>
    <div class="products" id="product-list">
        <?php displayProducts($pdo); ?>
    </div>
</main>

<div id="cart-backdrop"></div>
<div id="cart-modal">
    <h2>Your Cart</h2>
    <ul id="cart-items">
    </ul>
    <button onclick="closeCart()">Close</button>
</div>

<script src="index.js"></script>

</body>
</html>
