<?php

  session_start();

?>

<!DOCTYPE html>
<html lang="en">
<div class = "screen">
  <head>
      <title>Airate</title>
      <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta charset="UTF-8">

      <link rel="stylesheet" type="text/css" href="./style/style.css"/>
      <script type="module" src="./index.js"></script>
  </head>
  <body>
      <?php if (isset($_SESSION["logged_in"])): ?>
          <a class="report" href="report.php">
            <img src="html/images/newAirateLogo.png" width="50px" border-radius=50% background-color=#7C9D96>
          </a>
          <a class="profile" href="profile.php">
            <img src="html/images/image 4.png" width="50px" border-radius=50% background-color=#7C9D96>
          </a>
      <?php else: ?> 
            <a class="login" href="login.php">
              <img src="html/images/image 6.png" width="50px" border-radius=50% background-color=#7C9D96>
            </a>
      <?php endif; ?>
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
  </div screen>
</html>