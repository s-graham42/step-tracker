<?php
  require_once('../connection.php');
  require_once('functions.php');
  session_start();

?>

<h1>process_steps.php</h1>
<?php var_dump($_POST); ?>
<?php var_dump($_SESSION); ?>

<?php
  if ( ! (isset($_POST['action']) && ($_POST['action'] == "kid-steps") || ($_POST['action'] == "adult-steps")) ) {
      dd($_POST);
    session_destroy();
    header("Location: ../index.php");
    exit;
  }


  // SessionUUID - it's ok if this is not exact, we just need to make sure there is one.
  // if somehow the session uuid is not present, make one, and set it.
  set_session_uuid();
  $currentSessionUuid = get_session_uuid();
  // get session if it exists.  if not, add one to the database and get that one.
  $currentSession = get_or_create_session_from_db($currentSessionUuid);

//  dd($currentSession['id']);
  //  For Date Validations
  $beginningDate = "2024-01-01";
  $endDate = "2024-04-01";

// KID STEPS
  if ($_POST['action'] == 'kid-steps') {
    //reset errors
    $_SESSION['errors'] = array();

    // Step Validations
    if (empty($_POST['kid-steps'])) {
      $_SESSION['errors']['kid-steps-errors'][] = "Steps cannot be empty.";
    }
    if (!is_numeric($_POST['kid-steps'])) {
      $_SESSION['errors']['kid-steps-errors'][] = "Steps must be a number.";
    }
    if (intval($_POST['kid-steps']) < 1) {
      $_SESSION['errors']['kid-steps-errors'][] = "Steps must be a positive integer.";
    }
    if (intval($_POST['kid-steps']) > 20000) {
      $_SESSION['errors']['kid-steps-errors'][] = "Steps must be less than 20,000.";
    }

//    Date Validations
    if (empty($_POST['kid-entry-date'])) {
      $_SESSION['errors']['kid-entry-date-errors'][] = "Date cannot be empty.";
    }
    if ($_POST['kid-entry-date'] < $beginningDate) {
      $_SESSION['errors']['kid-entry-date-errors'][] = "The date you entered is before the beginning of the Move-A-Thon.";
    }
    if ($_POST['kid-entry-date'] > $endDate) {
      $_SESSION['errors']['kid-entry-date-errors'][] = "The date you entered is after the end of the Move-A-Thon.";
    }

    $sessionId = intval($currentSession['id']);
    $existing_kid_entry_query = "SELECT * FROM `kid_steps` WHERE `session` = {$sessionId} AND `steps_date` = '{$_POST['kid-entry-date']}';";
    $kidEntryExists = fetch_all($existing_kid_entry_query);
    if (!empty($kidEntryExists)) {
      $_SESSION['errors']['kid-entry-exists-errors'][] = "You have already entered kid steps for this date.";
    }

    // if there are errors, supply current entries and redirect.
    if (!empty($_SESSION['errors'])) {
      $_SESSION['kid-steps_entry'] = $_POST['kid-steps'];
      $_SESSION['kid-entry-date_entry'] = $_POST['kid-entry-date'];

      header("Location: ../index.php");
      exit;
    } else {
      // add the steps item.
      $steps = intval($_POST['kid-steps']);
      $stepsDate = $_POST['kid-entry-date'];
      $sessionId = intval($currentSession['id']);
      $query = "INSERT INTO `kid_steps` (steps, steps_date, created_at, updated_at, session) VALUES ({$steps}, '{$stepsDate}', NOW(), NOW(), {$sessionId});";
      run_mysql_query($query);

      //clean up session:
      unset($_SESSION['kid-steps_entry']);
      unset($_SESSION['kid-entry-date_entry']);

      header("Location: ./success.php");
      exit;
    }

  }

  if ($_POST['action'] == 'adult-steps') {
    //reset errors
    $_SESSION['errors'] = array();

    // Step Validations
    if (empty($_POST['adult-steps'])) {
      $_SESSION['errors']['adult-steps-errors'][] = "Steps cannot be empty.";
    }
    if (!is_numeric($_POST['adult-steps'])) {
      $_SESSION['errors']['adult-steps-errors'][] = "Steps must be a number.";
    }
    if (intval($_POST['adult-steps']) < 1) {
      $_SESSION['errors']['adult-steps-errors'][] = "Steps must be a positive integer.";
    }
    if (intval($_POST['adult-steps']) > 20000) {
      $_SESSION['errors']['adult-steps-errors'][] = "Steps must be less than 20,000.";
    }

//    Date Validations
    if (empty($_POST['adult-entry-date'])) {
      $_SESSION['errors']['adult-entry-date-errors'][] = "Date cannot be empty.";
    }
    if ($_POST['adult-entry-date'] < $beginningDate) {
      $_SESSION['errors']['adult-entry-date-errors'][] = "The date you entered is before the beginning of the Move-A-Thon.";
    }
    if ($_POST['adult-entry-date'] > $endDate) {
      $_SESSION['errors']['adult-entry-date-errors'][] = "The date you entered is after the end of the Move-A-Thon.";
    }

    $sessionId = intval($currentSession['id']);
    $existing_adult_entry_query = "SELECT * FROM `adult_steps` WHERE `session` = {$sessionId} AND `steps_date` = '{$_POST['adult-entry-date']}';";
    $adultEntryExists = fetch_all($existing_adult_entry_query);
    if (!empty($adultEntryExists)) {
      $_SESSION['errors']['adult-entry-exists-errors'][] = "You have already entered adult steps for this date.";
    }

    // if there are errors, supply current entries and redirect.
    if (!empty($_SESSION['errors'])) {
      $_SESSION['adult-steps_entry'] = $_POST['adult-steps'];
      $_SESSION['adult-entry-date_entry'] = $_POST['adult-entry-date'];

      header("Location: ../index.php");
      exit;
    } else {
      // add the steps item.
      $steps = intval($_POST['adult-steps']);
      $stepsDate = $_POST['adult-entry-date'];
      $sessionId = intval($currentSession['id']);
      $query = "INSERT INTO `adult_steps` (steps, steps_date, created_at, updated_at, session) VALUES ({$steps}, '{$stepsDate}', NOW(), NOW(), {$sessionId});";
      run_mysql_query($query);

      //clean up session:
      unset($_SESSION['adult-steps_entry']);
      unset($_SESSION['adult-entry-date_entry']);

      header("Location: ./success.php");
      exit;
    }

  }




