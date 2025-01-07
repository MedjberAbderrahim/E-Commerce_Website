<?php
    session_start();
    if (!isset($_SESSION["isLoggedIn"]) ||
        !$_SESSION["isLoggedIn"] ||
        !isset($_SESSION["username"]) ||
        !isset($_SESSION["userID"])
    )
    {
        header("Location: login.php");
    }
    include 'functions/Connect_DB.php';
    function load_products(PDO $pdo, $searchQuery = null) {
        if ($searchQuery) {
            $query = "SELECT * FROM Products WHERE Name LIKE :searchQuery";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%', PDO::PARAM_STR);
        }
        else {
            $query = "SELECT * FROM Products";
            $stmt = $pdo->prepare($query);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function load_cart(PDO $pdo) {
        $query = "
            SELECT p.id, p.Name, p.Price, p.Description, p.Image
            FROM Cart c
            INNER JOIN Products p ON c.Product_ID = p.id
            WHERE c.User_ID = :userID
        ";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':userID', $_SESSION['userID'], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function display_cart(PDO $pdo) {
        $cartItems = load_cart($pdo);
        $totalAmount = 0;

        if (empty($cartItems)) {
            echo '<li>Your cart is empty.</li>';
            return;
        }

        foreach ($cartItems as $item) {
            $totalAmount += $item['Price'];
            echo '<li class="cart-item">';
            echo '<img src="' . htmlspecialchars($item['Image']) . '" alt="' . htmlspecialchars($item['Name']) . '" class="cart-item-image">';
            echo '<div class="cart-item-details">';
            echo '<h3>' . htmlspecialchars($item['Name']) . '</h3>';
            echo '<p>$' . htmlspecialchars($item['Price']) . '</p>';
            echo '</div>';
            echo '<button class="remove-from-cart" onclick="removeFromCart(' . $item['id'] . ')">Remove</button>';
            echo '</li>';
        }
        echo '<div id="cart-total">Total: $' . htmlspecialchars(number_format($totalAmount, 2)) . '</div>';
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
            echo '<button class="addToCart" onclick="addToCart(' . $product["id"] . ')">Add to Cart</button>';
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
<?php
    if (isset($_GET['message']))
        echo '<div id="messageBar">' .htmlspecialchars($_GET['message']). '</div>';
?>

<header>
    <h1 id="TitleHeader">El-Wawi Store</h1>
    <h1 id="WelcomeHeader">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <div id="headerButtonsContainer">
        <?php if ($_SESSION["username"] == 'admin')
            echo '<button id="add-product" onclick="showAddProductModal()">Add Product</button>';
        ?>
        <button id="cart-btn" onclick="displayCart()">View Cart</button>
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
    <div id="cart-items-container">
        <ul id="cart-items">
            <?php display_cart($pdo); ?>
        </ul>
    </div>
    <div id="cart-footer">
        <button id="cart-close-button" onclick="closeCart()">Close</button>
    </div>
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
