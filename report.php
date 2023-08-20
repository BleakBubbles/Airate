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
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="./html/style/report.css"/>
</head>
<body>
    <div class="v5_14">
        <div class="v5_17"></div>
        <div class="v5_18"><a href="index.php"><div class="x-container">
                <div class="x-button"></div>
            </div> </a></div><div class="v5_19"></div><span class="v5_20">Air Quality Report</span><span class="v5_21">August 20, 2023</span>
        <form action='' method='post'>
        <span class="v9_968">Air Quality Health Index (AQHI):</span><span class="v9_995">Notes:</span>
        <button class='button-one button1' name='submit' value='1'>1</button>
        <button class='button-one button2' name='submit' value='2'>2</button>
        <button class='button-one button3' name='submit' value='3'>3</button>
        <button class='button-two button4' name='submit' value='4'>4</button>
        <button class='button-two button5' name='submit' value='5'>5</button>
        <button class='button-two button6' name='submit' value='6'>6</button>
        <button class='button-three button7' name='submit' value='7'>7</button>
        <button class='button-three button8' name='submit' value='8'>8</button>
        <button class='button-three button9' name='submit' value='9'>9</button>
        <button class='button-three button10' name='submit' value='10'>10</button>
        <button class='button-four button11' name='submit' value='11'>11</button>
    </form>
    <input type="text" class="notes"/>
    </div>
</body>
</html>