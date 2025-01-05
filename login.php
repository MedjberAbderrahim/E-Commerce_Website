<?php
    function display_status(){
        if (!isset($_GET["status"]))
            return;
        switch ($_GET["status"]) {
            case "empty_fields":
                echo '<p class="error">Username or Password Cannot be empty.</p>';
                break;
            case "invalid_credentials":
                echo '<p class="status error">Wrong Username or Password.</p>';
                break;
            case "username_taken":
                echo '<p class="status error">The username is already taken.</p>';
                break;
            case "successfully_registered":
                echo '<p class="status success">User Successfully created.</p>';
                break;
            case "short_password":
                echo '<p class="status error">Password must be at least 8 characters long.</p>';
                break;
            case "invalid_username_size":
                echo '<p class="status error">Username must be between 5 and 25 characters long.</p>';
                break;
            default:
                echo '<p class="status error">An unknown error occurred.</p>';
                break;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/styles/login.css">
</head>
<body>
    <div class="FormContainer">
        <h1 id='MiddleTitle'>Welcome</h1>
        <br><br>
        <?php display_status();?>
        <form action="validate.php" method="POST">
            <label for="username" class="inputLabel">Username </label>
            <input type="text" name="username" class="inputTag">
            <br><br>

            <label for="password" class="inputLabel">Password </label>
            <input type="password" name="password" class="inputTag">
            <br><br>
            <div id="buttonContainer">
                <input type="submit" name="action" value="Log In" id="SubmitButton">
                <input type="submit" name="action" value="Register" id="RegisterButton">
            </div>
        </form>
    </div>

</body>
</html>