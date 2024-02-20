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
<?php

  $kidSteps = get_sum('steps', 'kid_steps');
  $adultSteps = get_sum('steps', 'adult_steps');
  $kidGoalPercent = (intval($kidSteps) / MOVEMENT_GOAL) * 100;
  $adultGoalPercent = (intval($adultSteps) / MOVEMENT_GOAL) * 100;
//  var_dump($kidSteps);
//  var_dump($adultSteps);
//  var_dump($kidGoalPercent);
//  var_dump($adultGoalPercent);
  $wholeKidRings = floor($kidGoalPercent / 100);
  $lastKidRing = ($kidGoalPercent / 100) - $wholeKidRings;
  $wholeAdultRings = floor($adultGoalPercent / 100);
  $lastAdultRing = ($adultGoalPercent / 100) - $wholeAdultRings;
//  var_dump($wholeKidRings . " and " . $lastKidRing);
//  var_dump($wholeAdultRings . " and " . $lastAdultRing);

?>

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
    <div class="row mt-5">
      <div id="kid-globe-wrapper" class="col-12 col-md-6">
        <div class="text-center">
          <h2 class="fw-bolder">Kid Moves</h2>
          <div>
            <h3 id="kid-steps-total">Total:  <strong><?= number_format(intval($kidSteps)); ?></strong> meters</h3>
          </div>
          <div>
            <h3><strong><?= number_format($kidGoalPercent); ?>%</strong> of the Goal!</h3>
          </div>
          <div id="tracker">
            <img class="globe" src="../images/globe_north_america_800x800.png">
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
          <h2 class="fw-bolder">Adult Moves</h2>
            <div>
                <h3>Total:  <strong><?= number_format(intval($adultSteps)); ?></strong> meters</h3>
            </div>
            <div>
                <h3><strong><?= number_format($adultGoalPercent); ?>%</strong> of the Goal!</h3>
            </div>
          <div id="tracker">
            <img class="globe" src="../images/globe_north_america_800x800.png">
            <div id="adult-circle1" class="circles circle1"></div>
            <div id="adult-circle2" class="circles circle2"></div>
            <div id="adult-circle3" class="circles circle3"></div>
            <div id="adult-circle4" class="circles circle4"></div>
            <div id="adult-circle5" class="circles circle5"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row flex-wrap mt-5">
      <div class="col text-center text-nowrap">
        <a href="../index.php" class="col btn btn-primary btn-lg">Enter More Movements</a>
      </div>
    </div>
  </main>
  <footer style="width:100%; height:100px;"></footer>
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

        // Circle Stuff
        const kidGoalPercent = <?= ($kidGoalPercent / 100) ?>;
        const adultGoalPercent = <?= ($adultGoalPercent / 100) ?>;

        let ringColors = ["#005E73", "#007480", "#008A79", "#009D5E", "#10AE2F", "#10AE2F"];

        let maxRings = Math.max(Math.ceil(kidGoalPercent), Math.ceil(adultGoalPercent));

        function runCircles(idx) {
            let timeoutTime = (2000 * idx);
            let kidElementName = "#kid-circle" + (idx + 1);
            let adultElementName = "#adult-circle" + (idx + 1);

            setTimeout( function() {
                if (kidGoalPercent > idx) {
                    $(kidElementName).circleProgress({
                        value: (kidGoalPercent > (idx + 1)) ? 1 : kidGoalPercent - idx,
                        size: 240 + (idx * 20),
                        thickness: 10,
                        startAngle: -Math.PI / 2,
                        lineCap: 'round',
                        fill: ringColors[idx],
                        emptyFill: '#ffffff',
                        animation: {
                            duration: 2000,
                        },
                    });
                }
                if (adultGoalPercent > idx) {
                    $(adultElementName).circleProgress({
                        value: (adultGoalPercent > (idx + 1) ? 1 : adultGoalPercent - idx),
                        size: 240 + (idx * 20),
                        thickness: 10,
                        startAngle: -Math.PI / 2,
                        lineCap: 'round',
                        fill: ringColors[idx],
                        emptyFill: '#ffffff',
                        animation: {
                            duration: 2000,
                        }
                    });
                }

            }, timeoutTime);
        }

        // Run the actual circle function.
        for (let i = 0; i < maxRings; i++) {
            runCircles(i);
        }

    });


  </script>
</body>
</html>
