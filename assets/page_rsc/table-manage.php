<?php 
  require_once "load.php";
  if(testConn() == "Success") {
    if($_POST["table_name"] == "" || $_POST["selected_db"] == ""){
      header("Location: ../../new.php?error=".$lang["new_table"]["errors"]["missingdb"]."&query=N/A");
    } else {
      $tbl = new Tables($db, $_POST["selected_db"]);

      $result = $tbl->newTbl($_POST["table_name"], $_POST["col"]);
      if($result["error"] == "success"){
        header("Location: ../../index.php?db=".$_POST["selected_db"]."&tbl=".$_POST["table_name"]);
      } else {
        header("Location: ../../new.php?error=".$result["error"]."&query=".$result["query"]);
      }
    }

  } else {
    // :( not logged in
    header("Location: ../../auth.php?confirm=reauth");
  }
?>