<?php

  require_once "load.php";
  if(testConn() != "Success") {
    // load authlessnav
    include("authlessnav.php");
    return;
  } else {
      $h = $_SESSION["host"];
      $u = $_SESSION["username"];

      if(isset($_GET["db"])) {
        $currentdb = $_GET["db"];
      } else {
        $currentdb = "...";
      }
  }
  global $lang;

?>

<!-- Navigation -->

<ul id="userdrpdown" class="dropdown-content">
  <li><a href="auth.php?confirm=logout"><?= $lang["navbar_logout"]; ?></a></li>

  <li><a href="javascript:fetchTableData('<?= $lang["config_db_name"]; ?>', '<?= $lang["config_table_name"]; ?>');"><?= $lang["navbar_settings"]; ?></a></li>

  <li><a href="local.php#lang"><?= $lang["navbar_local_lang"]; ?></a></li>
  <li><a href="local.php"><?= $lang["navbar_local"]; ?></a></li>
</ul>

<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper v0lture-navbar">

      <!-- <a href="index.php" class="brand-logo text-light" style="margin-left: 15px;"><?= $lang["navbar_app"]; ?></a> -->
      <a href="index.php" class="brand-logo text-light"><img src="assets/bootstrap/img/logo.png" style="height: 54px; width: auto; padding-left: 15px; padding-top: 6px;"></img></a>

      <ul class="right hide-on-med-and-down">

        <li><a class="dropdown-button" href="#!" data-activates="userdrpdown"><?= $u; ?>@<?= $h; ?><i class="material-icons right">arrow_drop_down</i></a></li>

      </ul>

    </div>
  </nav>
</div>
