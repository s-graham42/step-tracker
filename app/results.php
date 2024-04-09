<?php
  require_once("../connection.php");
  require_once("../constants.php");
  require_once("functions.php");
  require_once("AroundTheWorld.php");
  session_start();

  $aroundTheWorld = new AroundTheWorld();

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
<?php

  $kidSteps = get_sum('steps', 'kid_steps');
  $adultSteps = get_sum('steps', 'adult_steps');
  $kidGoalPercent = (intval($kidSteps) / MOVEMENT_GOAL) * 100;
  $adultGoalPercent = (intval($adultSteps) / MOVEMENT_GOAL) * 100;

  $wholeKidRings = floor($kidGoalPercent / 100);
  $lastKidRing = ($kidGoalPercent / 100) - $wholeKidRings;
  $wholeAdultRings = floor($adultGoalPercent / 100);
  $lastAdultRing = ($adultGoalPercent / 100) - $wholeAdultRings;

?>

<body>
<?php
  include_once('header.php');
?>
  <main class="container">
    <h3 class="fw-bold text-center my-3"><?= APPLICATION_TITLE; ?></h3>
      <p class="h5 text-center my-1">Goal: All the way around the world!</p>
      <p class="h5 text-center my-1">Seattle to Seattle: <strong><?= number_format(intval($aroundTheWorld->circumnavigateMiles)) ?> miles (<?= number_format(intval($aroundTheWorld->circumnavigateSteps)) ?> steps).</strong></p>
    <div class="row mt-3">
      <div id="kid-globe-wrapper" class="col-12 col-md-6">
        <div class="text-center">
          <h3 class="fw-bolder">Kid Steps</h3>
          <div>
            <h4 id="kid-steps-total">Total:  <strong><?= number_format(intval($kidSteps)); ?></strong> steps</h4>
          </div>
          <div>
            <h4><strong><?= number_format($kidGoalPercent); ?>%</strong> of the Goal!</h4>
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
        <div class="text-center mt-3 mt-md-0">
          <h3 class="fw-bolder">Adult Steps</h3>
            <div>
                <h4>Total:  <span class="fw-bolder"><?= number_format(intval($adultSteps)); ?></span> steps</h4>
            </div>
            <div>
                <h4><span class="fw-bolder"><?= number_format($adultGoalPercent); ?>%</span> of the Goal!</h4>
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
    <div class="row flex-wrap mt-3">
      <div class="col text-center text-nowrap">
        <a href="../index.php" class="col btn btn-primary btn-lg">Enter More Steps</a>
      </div>
    </div>

    <?php
      $kidLap = intdiv($kidSteps, MOVEMENT_GOAL);
      if ($kidLap > 0) {
          $kidLapSteps = $kidSteps - ($kidLap * MOVEMENT_GOAL);
      }
      else {
          $kidLapSteps = $kidSteps;
      }
      $kidStepsInMiles = $aroundTheWorld->stepsToMiles(intval($kidLapSteps));
      $closestKidCity = $aroundTheWorld->getClosestCity($kidStepsInMiles);
      $kidLapMessage = $aroundTheWorld->getLapMessage($kidLap, "kids");

      $adultLap = intdiv($adultSteps, MOVEMENT_GOAL);
      if ($adultLap > 0) {
        $adultLapSteps = $adultSteps - ($adultLap * MOVEMENT_GOAL);
      }
      else {
        $adultLapSteps = $adultSteps;
      }
      $adultStepsInMiles = $aroundTheWorld->stepsToMiles(intval($adultLapSteps));
      $closestAdultCity = $aroundTheWorld->getClosestCity($adultStepsInMiles);
      $adultLapMessage = $aroundTheWorld->getLapMessage($adultLap, "adults");

      $minimumDistance = 1;
      if ($kidStepsInMiles > $minimumDistance || $adultStepsInMiles > $minimumDistance) {
    ?>

    <div id="around-the-world-wrapper" class="row mt-4">
        <div class="col-12 col-md-6">
            <?php if ($kidStepsInMiles > $minimumDistance) { ?>
                <h4 class="h5 text-center">
                    Together, the <span class="fw-bolder">kids</span> have traveled<br>
                    <?= $kidLapMessage ?>
                    <?= $kidStepsInMiles ?> miles<br>
                    and <?= $closestKidCity['message'] ?>:
                    <a class="fw-bolder" href="<?= $closestKidCity['closest_city']['maps_link'] ?>"><?= $closestKidCity['closest_city']['name'] ?>!</a>
                </h4>
            <?php } ?>
        </div>
        <div class="col-12 col-md-6 order-4 order-md-2">
            <?php if ($adultStepsInMiles > $minimumDistance) { ?>
                <h4 class="h5 text-center">
                    Together, the <span class="fw-bolder">adults</span> have traveled<br>
                    <?= $adultLapMessage ?>
                    <?= $adultStepsInMiles ?> miles<br>
                    and <?= $closestAdultCity['message'] ?>:
                    <a class="fw-bolder" href="<?= $closestAdultCity['closest_city']['maps_link'] ?>"><?= $closestAdultCity['closest_city']['name'] ?>!</a>
                </h4>
            <?php } ?>
        </div>
        <div class="col-12 col-md-6 order-3">
          <?php if ($kidStepsInMiles > $minimumDistance) { ?>
              <div class="px-0 py-3 px-lg-5">
                  <iframe src="<?= $closestKidCity['closest_city']['embed_link'] ?>" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
          <?php } ?>
        </div>
        <div class="col-12 col-md-6 order-5">
          <?php if ($adultStepsInMiles > $minimumDistance) { ?>
              <div class="px-0 py-3 px-lg-5">
                  <iframe src="<?= $closestAdultCity['closest_city']['embed_link'] ?>" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
          <?php } ?>
        </div>

<!--      --><?php //echo '<pre>'; var_dump($closestKidCity); echo '</pre>' ?>
<!--      --><?php //echo '<pre>'; var_dump($closestAdultCity); echo '</pre>' ?>

    </div>

    <?php } ?>



  </main>
  <footer style="width:100%; height:100px;"></footer>
  <aside class="container mt-5 d-none">
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

        // let ringColors = ["#005E73", "#007480", "#008A79", "#009D5E", "#10AE2F", "#10AE2F"];
        let ringColors = ["#10AE2F", "#009D5E", "#008A79", "#007480", "#005E73", "#005E73", "#10AE2F", "#009D5E", "#008A79", "#007480", "#005E73", "#005E73"];

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
