<?php
    session_start();
    if (!isset($_SESSION["isLoggedIn"]) || !$_SESSION["isLoggedIn"]) {
        header("Location: login.php");
    }
    include 'functions/Connect_DB.php';

    function load_products(PDO $pdo, $searchQuery = null) {
        if ($searchQuery) {
            $query = "SELECT * FROM Products WHERE Name LIKE :searchQuery";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%', PDO::PARAM_STR);
        } else {
            $query = "SELECT * FROM Products";
            $stmt = $pdo->prepare($query);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function displayProducts($pdo, $searchQuery = null) {
        $products = load_products($pdo, $searchQuery);
        foreach ($products as $product) {
            $product_name = htmlspecialchars($product["Name"]);
            if (strlen($product_name) > 50) {
                $product_name = substr($product_name, 0, 50) . '...';
            }
            echo '<div class="product">';
            echo '<div class="product-info">';
            echo '<a href="product.php?id=' . $product["id"] . '" class="product-link">';
            echo '<img src="' . htmlspecialchars($product["Image"]) . '" alt="">';
            echo '<h3 class="productName">' . $product_name . '</h3>';
            echo '<p class="productPrice">$' . htmlspecialchars($product["Price"]) . '</p>';
            echo '</a>';
            echo '</div>';

            echo '<div class="product-buttons">';
            echo '<button class="addToCart" onclick="addToCart(' . $product["id"] . ', event)">Add to Cart</button>';
            if ($_SESSION["username"] == 'admin') {
                echo '<button class="delete" onclick="deleteProduct(' . $product["id"] . ', event)">Delete</button>';
            }
            echo '</div>';
            echo '</div>';
        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El-Wawi Store</title>
    <link rel="stylesheet" href="assets/styles/index.css">
</head>
<body>

<header>
    <h1 id="TitleHeader">El-Wawi Store</h1>
    <h1 id="WelcomeHeader">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <div id="headerButtonsContainer">
        <?php if ($_SESSION["username"] == 'admin') : ?>
            <button id="add-product" onclick="showAddProductModal()">Add Product</button>
        <?php endif; ?>
        <button id="cart-btn">View Cart</button>
        <div id="username-dropdown">
            <button id="username-btn" onclick="toggleDropdown()">Account</button>
            <div id="dropdown-menu" class="dropdown-content">
                <a href="functions/logout.php" id="disconnect-btn">Disconnect</a>
                <a onclick="deleteAccount()" id="delete-account-btn">Delete Account</a>
            </div>
        </div>
    </div>
</header>

<main>
    <form id="search-form" method="GET" action="index.php">
        <label for="search-bar"></label>
        <input type="search" id="search-bar" name="query" placeholder="Enter product name..." />
        <button type="submit" id="search-button">Search</button>
    </form>

    <div class="products" id="product-list">
        <?php displayProducts($pdo, isset($_GET['query']) ? trim($_GET['query']) : null); ?>
    </div>
</main>
<div id="cart-backdrop"></div>
<div id="cart-modal">
    <h2>Your Cart</h2>
    <ul id="cart-items">
    </ul>
    <button onclick="closeCart()">Close</button>
</div>

<div id="add-product-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAddProductModal()">&times;</span>
        <h2>Add New Product</h2>
        <form id="add-product-form" action="functions/add_product.php" method="POST" enctype="multipart/form-data">
            <label for="product-name">Product Name:</label>
            <input type="text" id="product-name" name="name" required>

            <label for="product-price">Product Price:</label>
            <input type="number" step="0.01" id="product-price" name="price" required>

            <label for="product-description">Product Description:</label>
            <textarea id="product-description" name="description" rows="5"></textarea>

            <label for="product-image">Product Image:</label>
            <input type="file" id="product-image" name="image" accept="image/*">

            <button type="submit">Submit</button>
        </form>
    </div>
</div>

<script src="assets/scripts/index.js"></script>
</body>
</html>
