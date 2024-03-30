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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APPLICATION_TITLE; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

<main class="container-fluid mt-3">
    <h2 class="text-center p-4 fw-bold rounded bg-sessfa-green">Get ready to move around the world with us!</h2>
    <div class="col text-center text-nowrap">
        <img class="globe-coming-soon" src="../images/globe_north_america_800x800.png" alt="A true color image of the Earth" />
    </div>
    <div class="col text-center px-2 px-md-3 px-lg-5 mt-3">
        <p class="fs-4 fw-bold text-success">This year we are adding a new challenge to the Move-a-thon. We will be counting our
            steps as we move in all sorts of ways. Whether you are walking, running, rolling, or
            doing cartwheels, have the pedometer you are given on your body or wheels to track
            your movement! Challenge your family and your teachers to input their movement too
            and see if kids can move farther than adults.</p>
    </div>
</main>
<footer style="width:100%; height:100px;"></footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="../node_modules/jquery/dist/jquery.js"></script>
<script src="../node_modules/moment/min/moment.min.js"></script>

</body>
</html>
