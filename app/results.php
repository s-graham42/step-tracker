<?php
  require_once("../connection.php");
  require_once("../constants.php");
  require_once("functions.php");
  session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= APPLICATION_TITLE; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <style>

  </style>

  <header id="headerwrapper" class="bg-sessfa-green py-3">
    <div id="header" class="container w-100">
      <div class="row">
        <div class="col-12 col-md-3 col-lg-2 text-center text-md-start">
          <a href="https://www.sessfa.org/" class="text-dark text-decoration-none">
            <img src="../images/SESSFA-move-a-thon-2023.png" style="width: 175px">
          </a>
        </div>
        <div class="col-12 col-md-8 py-4 py-md-2 align-self-center text-center">
          <h1><a href="https://www.sessfa.org/" class="text-dark text-decoration-none">Southeast Seattle Schools Fundraising Alliance</a></h1>
        </div>
        <div class="col-12 col-lg-2 align-self-center text-center text-md-end">
          <a class="btn btn-sessfa-primary"
            href="https://secure.givelively.org/donate/alliance-for-education/se-seattle-schools-fundraising-alliance-3rd-annual-move-a-thon">Click to Donate!</a>
        </div>
      </div>
    </div>
  </header>
  <main class="container">
    <h1 class="text-center my-5"><?= APPLICATION_TITLE; ?></h1>
    <div class="row">
      <div id="kid-globe-wrapper" class="col-12 col-md-6">
        <div class="text-center">
          <h1>Kid Moves</h1>
          <div id="tracker">
<!--          <img class="globe" src="../images/blue-marble.png" width="630px" style="position: absolute; left: calc(50% - 315px); padding-top: 85px;">-->
            <img class="globe" src="../images/blue-marble.png">
            <div id="kid-circle1" class="circles circle1"></div>
            <div id="kid-circle2" class="circles circle2"></div>
            <div id="kid-circle3" class="circles circle3"></div>
            <div id="kid-circle4" class="circles circle4"></div>
            <div id="kid-circle5" class="circles circle5"></div>
          </div>
        </div>
      </div>
      <div id="adult-globe-wrapper"  class="col-12 col-md-6 mt-5 mt-md-0">
        <div class="text-center mt-5 mt-md-0">
          <h1>Adult Moves</h1>
          <div id="tracker">
            <!--          <img class="globe" src="../images/blue-marble.png" width="630px" style="position: absolute; left: calc(50% - 315px); padding-top: 85px;">-->
            <img class="globe" src="../images/blue-marble.png">
            <div id="adult-circle1" class="circles circle1"></div>
            <div id="adult-circle2" class="circles circle2"></div>
            <div id="adult-circle3" class="circles circle3"></div>
            <div id="adult-circle4" class="circles circle4"></div>
            <div id="adult-circle5" class="circles circle5"></div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <aside class="container mt-5 d-none">
      <p>Todo:</p>
      <ul>
          <li>Bigger Globe images (and circles) at Desktop.</li>
          <li>Better globe image with no clouds.</li>
          <li>Better js code for circles to handle timeout (and padding?)</li>
          <li>Continue working on responsiveness from 320px</li>
          <li>Incorporate DB value sums as circle progress.</li>
          <li>Total Steps</li>
          <li>Percentage of Goal.</li>
          <li>Confetti</li>
      </ul>
  </aside>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="../node_modules/jquery/dist/jquery.js"></script>
  <script src="../node_modules/moment/min/moment.min.js"></script>
  <script src="../node_modules/jquery-circle-progress/dist/circle-progress.js"></script>
  <script>
    $(function(){
        // 1st Circles
      $('#kid-circle1').circleProgress({
        value: 1,
        size: 240,
        thickness: 10,
        startAngle: -Math.PI / 2,
        lineCap: 'round',
        fill: "#005E73",
        emptyFill: '#ffffff',
        animation: {
          duration: 2000,
        }
      });

      $('#adult-circle1').circleProgress({
        value: 1,
        size: 240,
        thickness: 10,
        startAngle: -Math.PI / 2,
        lineCap: 'round',
        fill: "#005E73",
        emptyFill: '#ffffff',
        animation: {
          duration: 2000,
        }
      });

        // 2nd Circles
      setTimeout( function() {
        $('#kid-circle2').circleProgress({
          value: 1,
          size: 260,
          thickness: 10,
          startAngle: -Math.PI / 2,
          lineCap: 'round',
          fill: "#007480",
          emptyFill: '#ffffff',
          animation: {
            duration: 2000,
          }
        });

        $('#adult-circle2').circleProgress({
          value: 1,
          size: 260,
          thickness: 10,
          startAngle: -Math.PI / 2,
          lineCap: 'round',
          fill: "#007480",
          emptyFill: '#ffffff',
          animation: {
            duration: 2000,
          }
        });
      }, 2000);

        // 3rd Circles
      setTimeout( function() {
        $('#kid-circle3').circleProgress({
          value: 1,
          size: 280,
          thickness: 10,
          startAngle: -Math.PI / 2,
          lineCap: 'round',
          fill: "#008A79",
          emptyFill: '#ffffff',
          animation: {
            duration: 2000,
          }
        });
        $('#adult-circle3').circleProgress({
          value: 0.55,
          size: 280,
          thickness: 10,
          startAngle: -Math.PI / 2,
          lineCap: 'round',
          fill: "#008A79",
          emptyFill: '#ffffff',
          animation: {
            duration: 2000,
          }
        });
      }, 4000);

      // 4th circles
      setTimeout( function() {
        $('#kid-circle4').circleProgress({
          value: 1,
          size: 300,
          thickness: 10,
          startAngle: -Math.PI / 2,
          lineCap: 'round',
          fill: "#009D5E",
          emptyFill: '#ffffff',
          animation: {
            duration: 2000,
          }
        });
        $('#adult-circle4').circleProgress({
          value: 0,
          size: 300,
          thickness: 10,
          startAngle: -Math.PI / 2,
          lineCap: 'round',
          fill: "#009D5E",
          emptyFill: '#ffffff',
          animation: {
            duration: 2000,
          }
        });
      }, 6000);

      // 5th circles
      setTimeout( function() {
        $('#kid-circle5').circleProgress({
          value: 0.72,
          size: 320,
          thickness: 10,
          startAngle: -Math.PI / 2,
          lineCap: 'round',
          fill: "#10AE2F",
          emptyFill: '#ffffff',
          animation: {
            duration: 2000,
          }
        });
        $('#adult-circle5').circleProgress({
          value: 0,
          size: 320,
          thickness: 10,
          startAngle: -Math.PI / 2,
          lineCap: 'round',
          fill: "#10AE2F",
          emptyFill: '#ffffff',
          animation: {
            duration: 2000,
          }
        });

      }, 8000);

    });




  </script>
</body>
</html>
