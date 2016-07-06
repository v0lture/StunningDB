<?php

    // Working directory of first executing file
    $cwd = dirname(__FILE__);
    error_reporting(0);

    require_once $cwd."/assets/page_rsc/load.php";
    $error = "";

    if(isset($_GET["action"])) {
      $goto = $_GET["action"];
    }

    if(configItem('sudo_mode') != "false") {
      if(isset($_POST["state_change"])) {
        if($_POST["state_change"] == "agreed") {
          $state = "agreed";
        } elseif($_POST["state_change"] == "auth") {
          if(isset($_POST["sudo_pass"])) {
            $authres = genToken($_POST["sudo_pass"]);
            if($authres != "success") {
              $error =
              '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Password is incorrect</strong> <br />Check for capitalization/spelling errors.
              </div>';
            } else {
              header("Location: ".$goto."?sudo=allowed&token=".$_SESSION["sudotoken"]);
            }
          } else {
            // Give an incorrect error
            $error =
            '<div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Password is incorrect</strong> <br />Check for capitalization/spelling errors.
            </div>';
          }
        } else {
          $state = "first";
        }
      } else {
        $state = "first";
      }
    } else {
      issueSudoToken();
      $state = "bypass";
    }

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <?php require_once "assets/page_rsc/head.php"; ?>

    </head>

    <body onload="tableInit();">

      <p class="center-align">Feature currently removed!</p>

    </body>
</html>
