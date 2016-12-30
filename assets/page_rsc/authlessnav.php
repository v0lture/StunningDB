<?php

    require_once "load.php";
    if(testConn() != "Success") {
      $u = "Hi.";
    } else {
      $u = "Hi, ".$_SESSION["username"];
    }
    global $lang;

?>

<!-- Navigation -->

<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper v0lture-navbar">

      <a href="index.php" class="brand-logo text-light" style="margin-left: 15px;"><?= $lang["navbar_app"]; ?></a>

      <ul class="right hide-on-med-and-down">

        <li><a href="#!"><?= $u; ?></a></li>
        <li><a href="info.php"><?= $lang["navbar_info"]; ?></a></li>
        <li><a href="local.php"><?= $lang["navbar_user_settings"]; ?></a></li>

      </ul>

    </div>
  </nav>
</div>
