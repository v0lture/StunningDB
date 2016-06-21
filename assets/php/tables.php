<?php

  if(testConn() == "Success") {
    $db = resumeConnection();
  }

  function updateRow($dbl, $tbl, $col, $val, $key, $keyvalue) {
    global $db;
    if($res = $db->query("UPDATE `".$dbl."`.`".$tbl."` SET `".$col."` = '".$val."' WHERE `".$key."` = '".$keyvalue."'")) {
      return "updated";
    } else {
      return $res;
    }
  }

?>
