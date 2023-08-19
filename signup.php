<?php

$invalid_signup = false;

$mysqli = require __DIR__ . "/database.php";

$cities = $mysqli->query("SELECT * FROM location");

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    
    $sql = sprintf("SELECT * FROM login WHERE name = '%s'", $_POST["name"]);
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    if($user || !$_POST["name"] || !$_POST["password"]){
        $invalid_signup = true;
    }
    
    else {
        $sql = "INSERT INTO login (name, password)
        VALUES (?, ?)";
    
        $stmt = $mysqli->stmt_init();
    
        if (!$stmt->prepare($sql)) {
            die("SQL error: " . $mysqli->error);
        }

        $stmt->bind_param("ss", $_POST["name"], $_POST["password"]);
        
        $stmt->execute();
        
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

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Airate Signup</h1>
    <p>Already have an account? <a href="login.php">Login here.</a></p>
    <form method="post">
        <div>
            <input type="text" placeholder = "username" id="name" name="name">
        </div>
        <div>
            <input type="password" placeholder = "password" id="password" name="password">
        </div>
        <select name="location" id="location">
                <?php
                    while ($city = mysqli_fetch_array($cities,MYSQLI_ASSOC)):;
                ?>
                    <option value ="<?php echo $city["locationId"];
                    ?>">
                        <?php echo $city["name"]; ?>
                    </option>
                <?php endwhile ?>
        </select>
        <button>sign up</button>
    </form>
    <?php if ($invalid_signup): ?>
        <p style="color:red">invalid signup</p>
    <?php endif; ?>
</body>
</html>