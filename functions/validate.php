<?php
include 'Connect_DB.php';

function query_user(PDO $pdo, $username){
    $sql = "SELECT * FROM Users WHERE Username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "username" => $username
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function add_user(PDO $pdo, $username, $password){
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $sql_command = "INSERT INTO Users (username, password, Creation_Date) VALUES (:username, :password, :date)";
    $stmt = $pdo->prepare($sql_command);
    $result = $stmt->execute([
        "username" => $username,
        "password" =>$hashed_password,
        "date" => date("Y-m-d H:i:s")
    ]);

    if (!$result) {
        echo "Error: " . implode(" - ", $stmt->errorInfo());
        exit();
    }
}

function login(PDO $pdo, $username, $password) {
    $result = query_user($pdo, $username);
    if (!$result || !password_verify($password, $result['Password'])) {
        header("Location: ../login.php?status=invalid_credentials");
        exit();
    }

    session_start();
    $_SESSION["isLoggedIn"] = true;
    $_SESSION["username"] = $result['Username'];
    $_SESSION["userID"] = $result['id'];
    header("Location: ../index.php");
    exit();
}

function register(PDO $pdo, $username, $password){
    if (strlen($password) < 8) {
        header("Location: ../login.php?status=short_password");
        exit();
    }
    if (strlen($username) < 5 || strlen($username) > 25) {
        header("Location: ../login.php?status=invalid_username_size");
        exit();
    }

    $result = query_user($pdo, $username);
    if ($result) {
        header("Location: ../login.php?status=username_taken");
    }
    else {
        add_user($pdo, $username, $password);
        header("Location: ../login.php?status=successfully_registered");
    }
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request method.");
}

$username = $_POST["username"];
$password = $_POST["password"];
$action = $_POST["action"];

if (empty($username) || empty($password)) {
    header("Location: ../login.php?status=empty_fields");
    exit();
}
if ($action == "Log In") {
    login($pdo, $username, $password);
}
else if ($action == "Register") {
    register($pdo, $username, $password);
}
else {
    die("Invalid action.");
}

exit();