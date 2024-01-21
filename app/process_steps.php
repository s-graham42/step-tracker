<?php
  require_once('../connection.php');
  require_once('functions.php');
  session_start();

?>

<h1>process_steps.php</h1>
<?php var_dump($_POST); ?>
<?php var_dump($_SESSION); ?>

<?php
  // Session
  // if somehow the session uuid is not present, make one, and set it.
  set_session_uuid();
  $currentSessionUuid = get_session_uuid();
  // check to see if there is a session with the uuid.
  $get_session_query = "SELECT * FROM `sessions` WHERE `uuid` = '{$currentSessionUuid}';";
  $currentSession = fetch_record($get_session_query);

  // if there is no current session, create one.
  if (! $currentSession) {
    $uuid = escape_this_string($currentSessionUuid);
    $create_session_query = "INSERT INTO `sessions` (uuid, created_at, updated_at) VALUES ('{$uuid}', NOW(), NOW());";
    run_mysql_query($create_session_query);

    // then grab the user again
    $currentSession = fetch_record($get_session_query);
  }

//  dd($currentSession['id']);


// KID STEPS
  $steps = intval($_POST['kid-steps']);
  $stepsDate = $_POST['kid-entry-date'];
  $sessionId = intval($currentSession['id']);
  $query = "INSERT INTO `kid_steps` (steps, steps_date, created_at, updated_at, session) VALUES ({$steps}, '{$stepsDate}', NOW(), NOW(), {$sessionId});";
  run_mysql_query($query);