<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "\\database.php";

    $addTotal = sprintf("UPDATE location SET total = total + %s WHERE name = '%s'", $_POST["submit"], $_SESSION["location"]);

    $result1 = $mysqli->query($addTotal);

    $addCount = sprintf("UPDATE location SET count = count + 1 WHERE name = '%s'", $_SESSION["location"]);

    $result2 = $mysqli->query($addCount);

    $addPoint = sprintf("UPDATE user SET points = points + 10 WHERE name = '%s'", $_SESSION["logged_in"]);

    $result3 = $mysqli->query($addPoint);
    header("Location: profile.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airate</title>
    <link rel="stylesheet" type="text/css" href="./html/style/report.css"/>
</head>
<body>
    <h1>Airate Report</h1>
    <p>How bad was the air today?</p>
    <form action='' method='post'>
        <button name='submit' value='1'>1</button>
        <button name='submit' value='2'>2</button>
        <button name='submit' value='3'>3</button>
        <button name='submit' value='4'>4</button>
        <button name='submit' value='5'>5</button>
        <button name='submit' value='6'>6</button>
        <button name='submit' value='7'>7</button>
        <button name='submit' value='8'>8</button>
        <button name='submit' value='9'>9</button>
        <button name='submit' value='10'>10</button>
        <button name='submit' value='11'>11</button>
    </form>
</body>
</html>