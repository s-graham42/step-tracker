<?php
  /**
   * functions related to the application
   */

  /**
   * returns session uuid.
   * @return mixed
   */
  function get_session_uuid() {
    return $_SESSION['session_uuid'];
  }

  /**
   * Sets session uuid if there is not one.
   * @return void
   */
  function set_session_uuid() {
    if (!isset($_SESSION['session_uuid'])) {
      $_SESSION['session_uuid'] = uniqid("session-");
    }
  }

  /**
   * Checks to see if there is a session in database with current uuid.
   * If so, returns it.
   * If not, it creates one, adds it, then returns it.
   * @return array
   */
  function get_or_create_session_from_db($currentSessionUuid) {
    $get_session_query = "SELECT * FROM `sessions` WHERE `uuid` = '{$currentSessionUuid}';";
    $currentSession = fetch_record($get_session_query);

    if (! $currentSession) {
      $uuid = escape_this_string($currentSessionUuid);
      $create_session_query = "INSERT INTO `sessions` (uuid, created_at, updated_at) VALUES ('{$uuid}', NOW(), NOW());";
      run_mysql_query($create_session_query);

      // then grab the session again
      $currentSession = fetch_record($get_session_query);
    }

    return $currentSession;
  }

  /**
   * Custom Dump and Die function.
   * @param $data
   * @return void
   */
  function dd($data) {
    echo '<pre>';
    die(var_dump($data));
    echo '</pre>';
  }

  function showErrors($key) {
    if (!empty($_SESSION['errors'][$key])) {
      $theseErrors = $_SESSION['errors'][$key];
      foreach ($theseErrors as $err) {
        echo "<p class='form-text text-danger'>{$err}</p>";
      }
    }
  }
