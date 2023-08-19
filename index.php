<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Airate</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css" href="./style/style.css"/>
    <script type="module" src="./index.js"></script>
</head>
<body>
    <h1>Airate Home</h1>
    <nav>
        <a href="php/login.php">Login</a>
    </nav>
    <div id="map"></div>

    <!-- 
      The `defer` attribute causes the callback to execute after the full HTML
      document has been parsed. For non-blocking uses, avoiding race conditions,
      and consistent behavior across browsers, consider loading using Promises.
      See https://developers.google.com/maps/documentation/javascript/load-maps-js-api
      for more information.
      -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJ6e69pR2GArM7RkFerY35gttolQ_XCbo&callback=initMap&v=weekly&size=390x844&scale=5"
      defer
    ></script>
</body>
</html>