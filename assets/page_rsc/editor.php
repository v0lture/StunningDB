<?php

  require_once "load.php";
  echo "<pre>";
  if(testConn() == "Success") {
    if(isset($_GET["do"])) {

      if(isset($_POST) && isset($_POST["modal-db"]) && isset($_POST["modal-tbl"])) {

        if($_GET["do"] == "insert") {
          
          $dbl = $_POST["modal-db"];
          $tbl = $_POST["modal-tbl"];

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
              header("Location: ../../index.php?db=".$dbl."&tbl=".$tbl);
            } else {
              header("Location: ../../index.php?db=".$dbl."&tbl=".$tbl."&msg=".$db->error);
            }

          }

        } elseif($_GET["do"] == "edit") {
          print_r($_POST);
          $dbl = $_POST["modal-db"];
          $tbl = $_POST["modal-tbl"];

          if($dbl == "" || $tbl == "") {
            http_response_code(400);
            die("Database and table must be defined in order to insert a new row.");
          } else {
            $data = $_POST;

            $datakeys = array_keys($_POST);

            $update = "";
            $updatevalues = NULL;
            $position = 0;

            // Insert keys into an array
            foreach($datakeys as &$val) {
              if($position > 3) {
                $updatevalues[$position."-K"] = $val;
              }
              $position++;
            }

            $position = 0;
            // Insert values into an array
            foreach($_POST as &$val) {
              if($position > 3) {
                $updatevalues[$position."-V"] = $val;
              }
              $position++;
            }


            $pposition = 4;
            $position = $position -1;
            while($pposition <= $position) {

              $update .= "`".$updatevalues[$pposition."-K"]."` = '".$updatevalues[$pposition."-V"]."', ";
              $pposition++;

            }

            $update = substr($update, 0, -2);
            print_r($update);

            if($res = $db->query("UPDATE `".$dbl."`.`".$tbl."` SET ".$update." WHERE `".$_POST["modal-key"]."` = '".$_POST["modal-keyvalue"]."'")) {
              header("Location: ../../index.php?db=".$dbl."&tbl=".$tbl);
            } else {
              header("Location: ../../index.php?db=".$dbl."&tbl=".$tbl."&msg=".$db->error);
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
