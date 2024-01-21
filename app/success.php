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
    <title>SESSFA STEP TRACKER</title>
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
    <h1 class="text-center my-5">SESSFA Student Step Tracker</h1>
    <h2 class="text-center my-4">Success!!</h2>
    <h3 class="text-center my-4">Thanks for entering your steps!</h3>
    <a href=""class="btn btn-primary btn-lg"></a>
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