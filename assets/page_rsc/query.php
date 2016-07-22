<?php

  require_once "load.php";

  if(isset($_POST["query"])) {

    require_once "load.php";
    if($res = $db->query($_POST["query"])) {
      http_response_code(200);
      echo "Query OK. Rows affected <code>".$db->affected_rows."</code>.";
    } else {
      http_response_code(400);
      echo "Query failed. ".$db->error;
    }

  } else {
    http_response_code(400);
  }

?>
