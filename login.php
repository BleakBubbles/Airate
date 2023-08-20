<?php

$invalid_login = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "\\database.php";

    $sql = sprintf("SELECT * FROM user WHERE name = '%s'", $_POST["name"]);

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if($user && $user["password"] === $_POST["password"]) {
        session_start();
        $_SESSION["logged_in"] = $user["name"];
        $_SESSION["location"] = $user["location"];
        header("Location: index.php");
        exit;
    }
    $invalid_login = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airate</title>
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="./html/style/login.css"/></head>
<body>
<div class="v8_253">
        <div class="v8_316"></div>
        <div class="v8_261">
            <a href="index.php"><div class="x-container">
                <div class="x-button"></div>
            </div> </a>
        </div><span class="v8_306">Welcome Back!</span><span
            class="v8_310">Username</span><span class="v9_519">No account?</span><span class="v8_311">Password</span>
    <div class="v8_309"></div>
    <span class="v8_268">Login</span>
    <form method="post">
        <input class="username" type="text" id="name" name="name" value ="<?= $_POST["name"] ?? "" ?>">
        <input class="password" type="password" id="password" name="password">
        <button class="login">Login</button>
    </form>
    <a href="signup.php">
        <button class="register">Register</button>
    </a>
    </div>
    <script src="script.js"></script>
</body>
</html>