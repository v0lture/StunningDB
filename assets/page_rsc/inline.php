<?php

  // k = key
  // kv = key value
  // t = table
  // d = database
  // v = value
  // c = column
  error_reporting(E_ALL);
  if(isset($_GET["k"]) && isset($_GET["kv"]) && isset($_GET["t"]) && isset($_GET["d"]) && isset($_GET["v"]) && isset($_GET["c"])) {
    require_once "load.php";
    $result = updateRow($_GET["d"], $_GET["t"], $_GET["c"], $_GET["v"], $_GET["k"], $_GET["kv"]);
    echo $result;
    if($result == "updated") {
      http_response_code(200);
    } else {
      print_r($result);
      http_response_code(404);
    }
  } else {
    http_response_code(400);
  }

?>
