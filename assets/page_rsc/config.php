<?php
  require_once "load.php";

  if(testConn() == "Success") {

    if($_GET["action"] == "rst") {
      $rst = resetConfig();
      if($rst == "Reset") {
        header("Location: ../../index.php?db=".$lang["config_db_name"]."&tbl=".$lang["config_table_name"]."");
      } else {
        header("Location: ../../index.php?db=".$lang["config_db_name"]."&tbl=".$lang["config_table_name"]."&msg=".$rst);
      }
    }

  } else {
    http_response_code(403);
    die("Must be authenticated in order to access configuration.");
  }


 ?>
