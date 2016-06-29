<?php
  require_once "load.php";

  if(testConn() == "Success") {

    if($_GET["action"] == "rst") {
      $rst = resetConfig();
      if($rst == "Reset") {
        header("Location: ../../settings.php");
      } else {
        header("Location: ../../settings.php?msg=".$rst);
      }
    }

  } else {
    http_response_code(403);
    die("Must be authenticated in order to access configuration.");
  }


 ?>
