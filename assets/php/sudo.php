<?php
  error_reporting(E_ALL);

  $cwd = dirname(__FILE__);
  require_once $cwd.'/../page_rsc/load.php';
  // Sudo mode for v0ltureDB
  function verifySudoToken($token) {
    if(isset($_SESSION["sudotoken"])) {
      if($_SESSION["sudotoken"] == $token) {
        $_SESSION["sudotoken"] = "expired";
        return true;
      } else {
        $_SESSION["sudotoken"] = "expired";
        return false;
      }
    } else {
      return false;
    }
  }

  function issueSudoToken() {
    $_SESSION["sudotoken"] = md5(time());
  }

  function genToken($p) {
    $u = $_SESSION["username"];
    $h = $_SESSION["host"];

    $response = connectDB($u, $p, $h);
    if($response != "true") {
      return $response;
    } else {
      issueSudoToken();
      return "success";
    }

  }

?>
