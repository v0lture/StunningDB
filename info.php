<?php

    // Working directory of first executing file
    $cwd = dirname(__FILE__);

    require_once $cwd."/assets/page_rsc/load.php";

    if(isset($_GET["confirm"])) {
        $confirm = $_GET["confirm"];
    } else {
        $confirm = "login";
    }

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <?php require_once "assets/page_rsc/head.php"; ?>

    </head>

    <body onload="tableInit()">

      <?php require_once "assets/page_rsc/authlessnav.php"; ?>

    <div class="container">

      <div class="row">

        <div class="col-md-6 col-md-offset-3" style="padding-top: 40px;">

          <div class="card v0lture-norm-card">
            <div class="card-content">
              <span class="card-title">PHP compatibility</span>

              <p>v0ltureDB needs at least PHP version 5.5 to ensure support.</p>

              <?php
                  if(version_compare(phpversion(), "5.5", "<")) {
                      echo "<p>Your PHP version is under the required <b>PHP 5.5</b></p>";
                  } else {
                      echo "<p>Your installation (<b>".phpversion()."</b>) looks good!</p>";
                  }
              ?>

            </div>
          </div>

          <div class="card v0lture-norm-card">
            <div class="card-content">
              <span class="card-title">v0ltureDB installation</span>

              <p>Version installed <b><?= $version; ?></b>.</p>

            </div>

            <div class="card-action">
              <a href="index.php?db=<?= $lang["config_db_name"]; ?>&tbl=<?= $lang["config_tbl_name"]; ?>" class="v0lture-action">Check for updates</a>
            </div>
          </div>

        </div>

      </div>

    </div>

  </body>
</html>
