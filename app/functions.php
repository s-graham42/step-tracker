<?php
  /**
   * functions related to the application
   */

  function get_session_uuid() {
    return $_SESSION['session_uuid'];
  }
  function set_session_uuid() {
    if ( !isset($_SESSION['session_uuid']) ) {
      $_SESSION['session_uuid'] = uniqid("session-");
    }
  }
  function dd($data) {
    echo '<pre>';
    die(var_dump($data));
    echo '</pre>';
  }
