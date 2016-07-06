<?php

    require_once "load.php";
    if(testConn() != "Success") {
        header("Location: auth.php?confirm=reauth");
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
  <li style="padding: 15px;">
    <b>User: </b><?= $u; ?><br />
    <b>Host: </b><?= $h; ?><br />
  </li>

  <li><a href="auth.php?confirm=switch_user"><?= $lang["navbar_switch_user"]; ?></a></li>

  <li><a href="auth.php?confirm=logout"><?= $lang["navbar_logout"]; ?></a></li>

  <li><a href="javascript:fetchTableData('<?= $lang["config_db_name"]; ?>', '<?= $lang["config_table_name"]; ?>');"><?= $lang["navbar_settings"]; ?></a></li>
</ul>

<div class="navbar-fixed v-bg-light-purple">
  <nav>
    <div class="nav-wrapper v-bg-light-purple">

      <a href="index.php" class="brand-logo text-light" style="margin-left: 15px;"><?= $lang["navbar_app"]; ?></a>

      <ul class="right hide-on-med-and-down">

        <li><a href="#!" id="nav_db"><?= $currentdb; ?> </a></li>
        <li><a class="dropdown-button" href="#!" data-activates="userdrpdown"><?= $lang["navbar_title_user"]; ?> <i class="material-icons right">arrow_drop_down</i></a></li>

      </ul>

    </div>
  </nav>
</div>
