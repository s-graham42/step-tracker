<?php
  require_once("connection.php");
  require_once("app/functions.php");
  session_start();

  set_session_uuid();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SESSFA Movements Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="./css/style.css">

</head>
<?php
  isset($_SESSION['kid-entry-date_entry']) ? "" : $_SESSION['kid-entry-date_entry'] = date("Y-m-d");
  isset($_SESSION['kid-steps_entry']) ? "" : $_SESSION['kid-steps_entry'] = "";
  isset($_SESSION['adult-entry-date_entry']) ? "" : $_SESSION['adult-entry-date_entry'] = date("Y-m-d");
  isset($_SESSION['adult-steps_entry']) ? "" : $_SESSION['adult-steps_entry'] = "";

    var_dump($_POST);
    var_dump($_SESSION);
?>
<body>
<style>


</style>

<header id="headerwrapper" class="bg-sessfa-green py-3">
    <div id="header" class="container w-100">
        <div class="row">
            <div class="col-12 col-md-3 col-lg-2 text-center text-md-start">
                <a href="https://www.sessfa.org/" class="text-dark text-decoration-none">
                    <img src="images/SESSFA-move-a-thon-2023.png" style="width: 175px">
                </a>
            </div>
            <div class="col-12 col-md-8 py-4 py-md-2 align-self-center text-center">
                <h1><a href="https://www.sessfa.org/" class="text-dark text-decoration-none">Southeast Seattle Schools
                        Fundraising Alliance</a></h1>
            </div>
            <div class="col-12 col-lg-2 align-self-center text-center text-md-end">
                <a class="btn btn-sessfa-primary"
                   href="https://secure.givelively.org/donate/alliance-for-education/se-seattle-schools-fundraising-alliance-3rd-annual-move-a-thon">Click
                    to Donate!</a>
            </div>
        </div>
    </div>
</header>
<main class="container">
    <h1 class="text-center my-5">SESSFA Movements Tracker</h1>
    <div class="row">
        <div class="col-12 col-md-6 form-wrapper">
            <form action="app/process_steps.php" method="post">
                <h2>Kids enter steps here!</h2>
                <input type="hidden" name="action" value="kid-steps">
                <div class="col-12 col-md-6 mb-3">
                    <label for="kid-entry-date" class="form-label">Date</label>
                    <input type="date" class="form-control form-control-lg" id="kid-entry-date" name="kid-entry-date"
                           value="<?= $_SESSION['kid-entry-date_entry']; ?>" aria-describedby="kid-entry-date-help" required>
                    <div id="kid-entry-date-help" class="form-text">Enter the date of your step count.</div>
                    <?php showErrors('kid-entry-date-errors'); ?>
                    <?php showErrors('kid-entry-exists-errors'); ?>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="kid-steps" class="form-label">Number of Steps</label>
                    <input type="number" class="form-control form-control-lg" id="kid-steps" name="kid-steps"
                           value="<?= $_SESSION['kid-steps_entry']; ?>" aria-describedby="kid-steps-help" min="0" max="30,000" required>
                    <div id="kid-steps-help" class="form-text">Enter your number of steps for this day.</div>
                  <?php showErrors('kid-steps-errors'); ?>
                </div>

                <button type="submit" class="btn btn-primary">Submit Kid Steps</button>
            </form>
        </div>
        <div class="col-12 col-md-6 mt-5 mt-md-0 form-wrapper">
            <form action="app/process_steps.php" method="post">
                <h2>Adults enter steps here!</h2>
                <input type="hidden" name="action" value="adult-steps">
                <div class="col-12 col-md-6 mb-3">
                    <label for="adult-entry-date" class="form-label">Date</label>
                    <input type="date" class="form-control form-control-lg" id="adult-entry-date"
                           name="adult-entry-date" value="<?= $_SESSION['adult-entry-date_entry']; ?>" aria-describedby="adult-entry-date-help" required>
                    <div id="adult-entry-date-help" class="form-text">Enter the date of your step count.</div>
                    <?php showErrors('adult-entry-date-errors'); ?>
                    <?php showErrors('adult-entry-exists-errors'); ?>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="adult-steps" class="form-label">Number of Steps</label>
                    <input type="number" class="form-control form-control-lg" id="adult-steps" name="adult-steps"
                           value="<?= $_SESSION['adult-steps_entry']; ?>" aria-describedby="adult-steps-help" min="0" max="20,000" required>
                    <div id="adult-steps-help" class="form-text">Enter your number of steps for this day.</div>
                    <?php showErrors('adult-steps-errors'); ?>
                </div>

                <button type="submit" class="btn btn-primary">Submit Adult Steps</button>
            </form>
        </div>
    </div>
</main>
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
