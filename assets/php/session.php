<?php

  session_start();

  function connectDB($username, $password, $host) {
    $db = new mysqli($host, $username, $password);

    session_regenerate_id();

    // check if conn'd successfully
    if($db->connect_error) {
      return $db->connect_error;
    } else {
      $_SESSION["username"] = $username;
      $_SESSION["password"] = $password;
      $_SESSION["host"] = $host;
      return "true";
    }
  }

  function resumeConnection() {
    // check if variables are actually set or not before using them
    if(isset($_SESSION["username"]) && isset($_SESSION["password"]) && isset($_SESSION["host"])) {
      $u = $_SESSION["username"];
      $p = $_SESSION["password"];
      $h = $_SESSION["host"];
    } else {
      $u = "";
      $p = "";
      $h = "";
    }

    if($u == "" || $h == "") {
      return "Not stored";
    } else {
      // conn and post back
      $db = new mysqli($h, $u, $p);
      if($db ->connect_error) {
        return $db->connect_error;
      } else {
        return $db;
      }
    }
  }


  // test connection and respond back with true/false based on status
  function testConn() {
    // check variables
    if(isset($_SESSION["username"]) && isset($_SESSION["password"]) && isset($_SESSION["host"])) {
      $u = $_SESSION["username"];
      $p = $_SESSION["password"];
      $h = $_SESSION["host"];
    } else {
      $u = "";
      $p = "";
      $h = "";
    }

    if($u == "" || $h == "") {
      return "Not stored";
    } else {
      // conn and post back
      $conn = new mysqli($h, $u, $p);
      if($conn->connect_error) {
        return "Error: [".$conn->connect_errno."] ".$conn->connect_error;
      } else {
        return "Success";
      }
    }
  }

  function logout() {
    session_unset();
    session_regenerate_id();
  }

?>
