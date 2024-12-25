<?php
    session_start();
    if (!isset($_SESSION["isLoggedIn"]) || !$_SESSION["isLoggedIn"]) {
        header("Location: login.php");
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
