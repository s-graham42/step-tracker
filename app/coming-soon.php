<?php
  require_once("../connection.php");
  require_once("../constants.php");
  require_once("functions.php");
  session_start();

  set_session_uuid();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-EDLRSZKP5W"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-EDLRSZKP5W');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SESSFA Step Tracker Coming Soon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

<main class="container-fluid mt-3">
    <h2 class="text-center text-white p-4 fw-bold rounded bg-sessfa-green">Get ready to move around the world with us!<br>Move-a-thon Step Tracker Coming Soon.</h2>
    <div class="col text-center text-nowrap">
        <img class="d-sm-none" src="../images/globe_north_america_800x800.png" width="252px" height="252px" alt="A true color image of the Earth" />
        <img class="d-none d-sm-inline-block" src="../images/globe_north_america_800x800.png" width="400px" height="400px" alt="A true color image of the Earth" />
    </div>
    <div class="col text-center px-2 px-md-3 px-lg-5 mt-3">
        <p class="fs-4 fw-bold text-sessfa-new-blue-dark">This year we are adding a new challenge to the Move-a-thon!</p>
        <p class="fs-4 fw-bold text-sessfa-new-blue-dark">We will be distributing pedometers so we can keep track of how far we have all traveled collectively.
            Challenge your family and your teachers to input their movements too,
            and see if kids can beat the adults around the world.</p>
        <p class="fs-4 fw-bold text-sessfa-new-blue-dark">As we keep track of our total progress, the website will tell us where we are in the world.
            Check in to see where we have traveled, and take a moment to learn about a new place in the world.</p>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="../node_modules/jquery/dist/jquery.js"></script>
<script src="../node_modules/moment/min/moment.min.js"></script>

</body>
</html>
