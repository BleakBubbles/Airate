<?php

$invalid_login = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "\\database.php";

    $sql = sprintf("SELECT * FROM user WHERE name = '%s'", $_POST["name"]);

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if($user && $user["password"] === $_POST["password"]) {
        session_start();
        $_SESSION["user_id"] = $user["id"];
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

    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <h1>Airate Login</h1>
    <p>Don't have an account? <a href="signup.php">Signup here.</a></p>
    <form method="post">
        <div>
            <input type="text" placeholder = "username" id="name" name="name" value ="<?= $_POST["name"] ?? "" ?>">
        </div>
        <div>
            <input type="password" placeholder = "password" id="password" name="password">
        </div>

        <button>log in</button>
    </form>
    <script src="script.js"></script>
    <?php if ($invalid_login): ?>
        <p style="color:red">invalid login</p>
    <?php endif; ?>
</body>
</html>