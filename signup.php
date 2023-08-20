<?php

$invalid_signup = false;

$mysqli = require __DIR__ . "\\database.php";

$cities = $mysqli->query("SELECT * FROM location");

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    
    $sql = sprintf("SELECT * FROM user WHERE name = '%s'", $_POST["name"]);
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    if($user || !$_POST["name"] || !$_POST["password"]){
        $invalid_signup = true;
    }
    
    else {
        $sql = "INSERT INTO user (name, email, password, points, location)
        VALUES (?, ?, ?, ?, ?)";
    
        $stmt = $mysqli->stmt_init();
    
        if (!$stmt->prepare($sql)) {
            die("SQL error: " . $mysqli->error);
        }

        $zero = 0;

        $stmt->bind_param("sssis", $_POST["name"], $_POST["email"], $_POST["password"], $zero, $_POST["location"]);
        
        $stmt->execute();
        
        session_start();
        $_SESSION["logged_in"] = $user["name"];
        $_SESSION["location"] = $user["location"];
        header("Location: index.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airate</title>
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="./html/style/signup.css"/></head>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
<div class="v8_263">
        <div class="v9_500"></div><span class="v9_332">Location</span><span class="v8_318">Airate Account Registration</span>
        <div class="v8_317"></div>
        <div class="v8_267">
            <a href="index.php"><div class="x-container">
                <div class="x-button"></div>
            </div> </a>
        </div><span class="v8_268">Register</span><span class="v9_320">Username</span>
        <div class="name"></div><span class="v9_323">Email</span><span class="v9_325">Password</span>
    <form method="post">
    <div class="dropdown-container">
            <div class="dropdown" style="width:357px">
        <select name="location" id="location">
                <?php
                    while ($city = mysqli_fetch_array($cities,MYSQLI_ASSOC)):;
                ?>
                    <option value ="<?php echo $city["name"];
                    ?>">
                        <?php echo $city["name"]; ?>
                    </option>
                <?php endwhile ?>
        </select>
        </div>
       </div>
        <input class="username" type="text" id="name" name="name">
        <input class="email" type="email" id="email" name="email">
        <input class="password" type="password" id="password" name="password">
        <button class="register">Register</button>
    </form>
</div>
</body>
</html>