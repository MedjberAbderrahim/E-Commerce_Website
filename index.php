<?php
    session_start();
    if (!isset($_SESSION["isLoggedIn"]) || !$_SESSION["isLoggedIn"]) {
        header("Location: login.php");
    }

    $items = [
        [
            "id" => 1,
            "name" => "F-16 Fighting Falcon",
            "price" => 19.99,
            "image" => "Assets/F-16_Fighting_Falcon.jpg"
        ],
        [
            "id" => 2,
            "name" => "F-22 Raptor",
            "price" => 29.99,
            "image" => "Assets/F-22_Raptor.jpg"
        ],
        [
            "id" => 3,
            "name" => "Mirage 2000",
            "price" => 39.99,
            "image" => "Assets/Mirage_2000C.jpg"
        ],
    ];

    function displayProducts(){
        global $items;
        for ($i = 0; $i < count($items); $i++) {
            echo '<div class="product">
                    <img src="'.$items[$i]["image"].'" alt="'.$items[$i]["name"].'">
                    <h3>'.$items[$i]["name"].'</h3>
                    <p>$'.$items[$i]["price"].'</p>
                    <button onclick="addToCart('.$items[$i]["id"].')">Add to Cart</button>
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
        <?php displayProducts(); ?>
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
