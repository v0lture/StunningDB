<?php

    // Working directory of first executing file
    $lcwd = dirname(__FILE__);

    require_once $lcwd."/assets/page_rsc/load.php";

    if(testConn() != "Success") {
      header("Location: auth.php?confirm=reauth");
    } else {

      if(!isset($_GET["db"])) {
        header("Location: index.php");
      } else {
        $db = $_GET["db"];
      }

    }
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <?php require_once "assets/page_rsc/head.php"; ?>

  </head>

  <body onload="tableInit();">

    <?php
        // require navigation bar
        require_once $lcwd."/assets/page_rsc/navbar.php";
    ?>

    <div class="container">
      <div class="alert alert-danger" role="alert" id="error" style="display:none; ">
        <h4>Error</h4>
        <p>Failed to do something.</p>
      </div>
    </div>

    <div class="row">

      <div class="col-md-4">

        <div class="panel panel-default">

          <div class="panel-heading">

            <h3 class="panel-title"><?= $lang["createtbl_db_info"] ?> <?= $db; ?></h3>

          </div>

          <div class="panel-body">
            <p><?= $lang["createtbl_db_name"] ?> <?= $db; ?></p>
          </div>

        </div>

      </div>

      <div class="col-md-8">



      </div>

    </div>

  </body>
</html>
