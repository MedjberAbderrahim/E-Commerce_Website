<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="FormContainer">
        <h1 id='MiddleTitle'>Welcome</h1>
        <br><br>

        <?php
            if ($_GET["error"] == true) {
                echo '<p class="error">Invalid username or password</p>';
            }
        ?>
        <form action="validate.php" method="POST">
            <label for="username" class="inputLabel">Username </label>
            <input type="text" name="username" class="inputTag">
            <br><br>
            
            <label for="password" class="inputLabel">Password </label>
            <input type="password" name="password" class="inputTag">
            <br><br>
            <input type="submit" id="SubmitButton" value="Submit">
        </form>
    </div>

</body>
</html>