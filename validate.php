<?php
    session_start();
    if ($_POST["username"] == "admin" && $_POST["password"] == "admin") {
        session_start();
        $_SESSION["isLoggedIn"] = true;
        header("Location: index.php");
        exit;
    }
    else {  
        $_GET["error"] = true;
        header("Location: login.php?error=true");
        exit(403);
    }
?>