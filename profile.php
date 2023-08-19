<?php

    session_start();

    $mysqli = require __DIR__ . "\\database.php";

    $sql = $mysqli->query(sprintf("SELECT * FROM user WHERE name = '%s'",$_SESSION["logged_in"]));
    $points = mysqli_fetch_array($sql)

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airate</title>
</head>
<body>
    <h1>Airate Profile</h1>
    
    <?php if (isset($_SESSION["logged_in"])): ?>
        <p><?php echo $_SESSION["logged_in"];?></p>
        <p><?php echo $points["points"];?></p>
    <?php else: ?>
        <p>Unable to load profile</p>
    <?php endif; ?>
</body>
</html>