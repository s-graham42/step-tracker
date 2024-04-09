<?php
  require_once("connection.php");
  require_once("constants.php");
  require_once("app/functions.php");
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
    <link rel="stylesheet" href="./css/style.css">

</head>
<?php
  isset($_SESSION['kid-entry-date_entry']) ? "" : $_SESSION['kid-entry-date_entry'] = date("Y-m-d");
  isset($_SESSION['kid-steps_entry']) ? "" : $_SESSION['kid-steps_entry'] = "";
  isset($_SESSION['adult-entry-date_entry']) ? "" : $_SESSION['adult-entry-date_entry'] = date("Y-m-d");
  isset($_SESSION['adult-steps_entry']) ? "" : $_SESSION['adult-steps_entry'] = "";
//  isset($_SESSION['input-password_entry']) ? "" : $_SESSION['input-password_entry'] = "";

//    var_dump($_POST);
//    var_dump($_SESSION);
?>
<body>

<main class="container">
    <h3 class="fw-bold text-center mb-5"><?= APPLICATION_TITLE; ?></h3>
    <div class="row mb-5">
        <a class="goto-results btn btn-success mb-3 mx-auto" href="app/results.php">Go to Results</a>
    </div>

    <form action="app/process_steps.php" method="post">
        <input type="hidden" name="action" value="submit-steps">

        <div class="row form-wrapper justify-content-around">
            <!--                Kid section-->
            <div class="col-12 col-md-5 p-4 bg-kid-form">
                <h2 class="text-center">Kids enter steps here!</h2>
                <div class="date-input-wrapper mt-4">
                    <label for="kid-entry-date" class="form-label">Date</label>
                    <input type="date" class="form-control form-control-lg" id="kid-entry-date" name="kid-entry-date"
                           value="<?= $_SESSION['kid-entry-date_entry']; ?>" aria-describedby="kid-entry-date-help" required>
                    <div id="kid-entry-date-help" class="form-text">Enter the date of your step count.</div>
                    <?php showErrors('kid-entry-date-errors'); ?>
                    <?php showErrors('kid-entry-exists-errors'); ?>
                </div>
                <div class="moves-input-wrapper mt-4">
                    <label for="kid-steps" class="form-label">Number of Steps</label>
                    <input type="number" class="form-control form-control-lg" id="kid-steps" name="kid-steps"
                           value="<?= $_SESSION['kid-steps_entry']; ?>" aria-describedby="kid-steps-help" min="0" max="50000">
                    <div id="kid-steps-help" class="form-text">Enter your number of steps for this day.</div>
                    <?php showErrors('kid-steps-errors'); ?>
                </div>
            </div>

<!--                Adult Section                -->
            <div class="col-12 col-md-5 p-4 mt-5 mt-md-0 bg-adult-form">
                <h2 class="text-center">Adults enter steps here!</h2>
                <div class="date-input-wrapper mt-4">
                    <label for="adult-entry-date" class="form-label">Date</label>
                    <input type="date" class="form-control form-control-lg" id="adult-entry-date"
                           name="adult-entry-date" value="<?= $_SESSION['adult-entry-date_entry']; ?>" aria-describedby="adult-entry-date-help" required>
                    <div id="adult-entry-date-help" class="form-text">Enter the date of your step count.</div>
                    <?php showErrors('adult-entry-date-errors'); ?>
                    <?php showErrors('adult-entry-exists-errors'); ?>
                </div>
                <div class="moves-input-wrapper mt-4">
                    <label for="adult-steps" class="form-label">Number of Steps</label>
                    <input type="number" class="form-control form-control-lg" id="adult-steps" name="adult-steps"
                           value="<?= $_SESSION['adult-steps_entry']; ?>" aria-describedby="adult-steps-help" min="0" max="50000">
                    <div id="adult-steps-help" class="form-text">Enter your number of steps for this day.</div>
                    <?php showErrors('adult-steps-errors'); ?>
                </div>
            </div>

            <div class="submit-wrapper col-12 col-md-6 mx-auto mt-5 text-center">
<!--                <label for="input-password" class="form-label">Password</label>-->
<!--                <input type="password" id="input-password" name="input-password" class="form-control"-->
<!--                       value="--><?php //= $_SESSION['input-password_entry']; ?><!--" aria-describedby="passwordHelpBlock">-->
<!--                <div id="passwordHelpBlock" class="form-text">Enter the Move-a-thon password.</div>-->
<!--                --><?php //showErrors('password-errors'); ?>

                <button type="submit" class="btn btn-lg btn-primary mt-4">Submit</button>
            </div>

        </div>
    </form>

<!--        <div class="col-12 col-md-6 mt-5 mt-md-0 form-wrapper">-->
<!--            <form action="app/process_steps.php" method="post">-->
<!--                -->
<!---->
<!--                <button type="submit" class="btn btn-primary">Submit for Adult</button>-->
<!--            </form>-->
<!--        </div>-->

</main>
<footer style="width:100%; height:100px;"></footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="node_modules/jquery/dist/jquery.js"></script>
<script src="node_modules/moment/min/moment.min.js"></script>
<script>
    $(function () {
        // console.log(moment().format('yyyy-MM-dd'));
        // default the displayed date in the picker to today's date.
        // $("#kid-entry-date").val(moment().format('yyyy-MM-DD'));
        // $("#adult-entry-date").val(moment().format('yyyy-MM-DD'));

    });

</script>
</body>
</html>
