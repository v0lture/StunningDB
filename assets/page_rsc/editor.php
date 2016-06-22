<?php

  require_once "load.php";
  echo "<pre>";
  if(testConn() == "Success") {
    if(isset($_GET["do"])) {

      if(isset($_POST) && isset($_POST["db"]) && isset($_POST["tbl"])) {

        if($_GET["do"] == "insert") {
          print_r($_POST);
          $dbl = $_POST["db"];
          $tbl = $_POST["tbl"];

          if($dbl == "" || $tbl == "") {
            http_response_code(400);
            die("Database and table must be defined in order to insert a new row.");
          } else {
            $data = $_POST;

            $datakeys = array_keys($_POST);
            $datavalues = "(";
            $position = 0;
            // Prepare syntax for insert query
            foreach($_POST as &$val) {
              if($position > 1) {
                if(is_numeric($val)) {
                  $datavalues .= $val.", ";
                } else {
                  $datavalues .= "'".$val."', ";
                }
              } // Skipping first 2 items as they are the database and table
              $position++;
            }
            $datavalues = substr($datavalues, 0, -2);
            $datavalues .= ")";

            // Prepare syntax for insert query
            $keysetup = "(";
            $position = 0;
            foreach($datakeys as &$val) {
              if($position > 1) {
                $keysetup .= "`".$val."`, ";
              }
              $position++;
            }
            $keysetup = substr($keysetup, 0, -2);
            $keysetup .= ")";

            if($res = $db->query("INSERT INTO `".$dbl."`.`".$tbl."` ".$keysetup." VALUES ".$datavalues)) {
              header("Location: ../../table.php?db=".$dbl."&tbl=".$tbl);
            } else {
              header("Location: ../../table.php?db=".$dbl."&tbl=".$tbl."&msg=".$db->error);
            }

          }

        }

      }

    } else {
      echo ":( What are you trying to do?";
      http_response_code(400);
    }
  } else {
    http_response_code(403);
    echo "Must be authenticated!";
  }
  echo "</pre>";
?>
