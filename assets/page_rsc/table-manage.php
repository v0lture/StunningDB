<?php 
    require_once "load.php";
    error_reporting(0);

  if(testConn() == "Success") {
    if($_POST["table_name"] == "" || $_POST["selected_db"] == ""){   
        http_response_code(400);   
        echo json_encode(Array("status" => "error", "error" => $lang["new_table"]["errors"]["missingdb"], "query" => "none &mdash; Failed prechecks"));
    } else {
      $tbl = new Tables($db, $_POST["selected_db"]);

        if($_POST["col"] == "") {
                http_response_code(400);
                echo json_encode(Array("status" => "error", "error" => $lang["new_table"]["errors"]["missingcol"], "query" => "none &mdash; Failed prechecks"));
        } else {
            $result = $tbl->newTbl($_POST["table_name"], $_POST["col"]);
            if($result["error"] == "success"){
                http_response_code(200);
                echo json_encode(Array("status" => "success"));
            } else {
                http_response_code(400);
                echo json_encode(Array("status" => "error", "error" => $result["error"], "query" => $result["query"]));
            }
        }
      
    }

  } else {
      http_response_code(401);
      echo json_encode(Array("status" => "error", "error" => "unauthorized", "query" => "none"));
  }
?>