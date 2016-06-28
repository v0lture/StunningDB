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

      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">v0ltureDB <small>INFO</small></a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="https://github.com/v0lture/v0ltureDB">GitHub</a></li>
              <li><a href="v0lture.com/docs/v0ltureDB/">Docs</a></li>
            </ul>
          </div>
      </div>
    </nav>

    <div class="container">

      <div class="row">

        <div class="col-md-6 col-md-offset-3" style="padding-top: 40px;">

          <center><h4>v0ltureDB Information</h4></center>

            <ul class="list-group">

                <li class="list-group-item">
                    <b>PHP Version</b> <span class="label v-bg-blue"><?php echo phpversion(); ?></span>
                    <?php
                        if(version_compare(phpversion(), "5.0", "<")) {
                            echo "<br />Your current PHP version is too old to use v0ltureDB. You must use at least <span class='label label-info'>PHP 5.0</span> in order to use v0ltureDB.";
                        } else {
                            echo "<br />Your PHP version is supported with v0ltureDB.";
                        }
                    ?>
                </li>

                <li class="list-group-item">
                    <b>v0ltureDB Version</b> <span class="label v-bg-blue">v1</span>
                </li>

                <li class="list-group-item">
                  <b>Configuration Status</b><br />
                  <?php
                    if(configEnabled() == true) {
                      echo "Configuration is <b>enabled</b>.";
                    } else {
                      echo "Configuration is currently <b>disabled</b> as it is not setup.<br /><br />";
                      echo "<a href='settings.php' class='btn btn-primary' data-container='body' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='Requires sudo mode.'>Setup configuration</a>";
                    }
                  ?>
                </li>

                <li class="list-group-item">
                  <b>Auth Status</b> <small>Status of the stored credentials against the MySQL server</small><br />

                  <?php
                    echo testConn();
                  ?>
                </li>

                <li class="list-group-item">
                  <b>Sudo Mode</b> <small>An high-level reauth service to prevent unwanted destructive actions</small><br />

                  <?php

                    $sudostate = configItem($lang["config_table_safety_name"], 'sudo_mode');
                    if($sudostate == "true") {
                      echo "Sudo mode is <b>active</b>";
                    } elseif($sudostate == "Not enabled") {
                      echo "Sudo mode is by default <b>active</b> currently as no configuration is available";
                    } else {
                      echo "Sudo mode is <b>inactive</b>, this is not recommended.";
                    }

                  ?>
                </li>

            </ul>

        </div>

      </div>

    </div>

  </body>
</html>
