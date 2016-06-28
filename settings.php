<?php

  require_once 'assets/page_rsc/load.php';

  // Create DB if doesn't exist
  if(testConn() == "Success") {
    global $db;
    $dbtst = $db->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '".$lang["config_db_name"]."'");
    if($dbtst->num_rows == 0 && !isset($_GET["sudo"])) {
      header("Location: confirm.php?action=settings.php");
    } elseif(!isset($_GET["sudo"])) {
      header("Location: confirm.php?action=settings.php");
    } elseif(isset($_GET["sudo"])) {
      $sudotoken = $_GET["sudo"];
      if($sudotoken == "denied") {
        $error = "denied";
      } elseif($sudotoken == "allowed" && isset($_GET["token"])) {
        if(verifySudoToken($_GET["token"])) {

          // Generate DB and tables
          if($report = $db->query("CREATE DATABASE IF NOT EXISTS ".$lang["config_db_name"]."")) {

            // Generate safety table
            if($report = $db->query("CREATE TABLE IF NOT EXISTS `".$lang["config_db_name"]."`.`".$lang["config_table_name"]."` ( `id` INT(6) NOT NULL AUTO_INCREMENT, `key` VARCHAR(100) NOT NULL, UNIQUE (`key`), `val` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;")) {

              if($report = $db->query("INSERT IGNORE INTO `".$lang["config_db_name"]."`.`".$lang["config_table_name"]."` (`id`, `key`, `val`) VALUES (NULL, 'sudo_mode', 'true'), (NULL, 'limit_col_count', 'true'), (NULL, '', 'true')")) {
                $error = "none";
              } else {
                $error = "mysql";
                $dberror = "Failed on creating table entries because ".$db->error;
              }

            } else {
              $error = "mysql";
              $dberror = "Failed on creating table '".$lang["config_table_name"]."'... because ".$db->error;
            }
          } else {
            $error = "mysql";
            $dberror = "Failed on creating database '".$lang["config_db_name"]."' because ".$db->error;
          }

        } else {
          $error = "denied";
        }
      } else {
        $error = "denied";
      }
    }
  } else {
    header("Location: auth.php?confirm=reauth");
  }

 ?>

 <!DOCTYPE html>
 <html lang="en">

     <head>

         <?php require_once "assets/page_rsc/head.php"; ?>

     </head>

     <body onload="tableInit();">

         <nav class="navbar navbar-default">
             <div class="container-fluid">
                 <div class="navbar-header">
                     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                         <span class="sr-only">Toggle navigation</span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                     </button>
                     <a class="navbar-brand" href="index.php">v0ltureDB</a>
                 </div>
                 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                     <ul class="nav navbar-nav navbar-right">
                         <li><a href="https://github.com/v0lture/v0ltureDB">GitHub</a></li>
                         <li><a href="info.php"><span class="label label-default" data-container="body" data-toggle="tooltip" data-placement="left" title="v0ltureDB needs sudo to create databases and tables.">Sudo Mode</span></a></li>
                     </ul>
                 </div>
             </div>
         </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3" style="padding-top: 40px;">

                  <?php if($error == "denied"): ?>
                    <div class="panel panel-danger">

                      <div class="panel-heading">
                        <h3 class="panel-title">Unable to setup v0ltureDB config.</h3>
                      </div>

                      <div class="panel-body">

                        <p>Sudo mode is required to initalize the database for v0ltureDB configuration.<br />You have aborted the sudo mode prompt so v0ltureDB is unable to continue with setting up the configuration.</p>

                        <p><b>Why v0ltureDB needs sudo mode</b>: In order to prevent from security exploits of safety features and security features of v0ltureDB that are stored in a database, when creating this database sudo mode is required. This is merely a hardcoded security measure and does not effect creating other databases (unless enabled).</p>

                        <div class="btn-group">
                          <a href="index.php" class="btn btn-default">Return to Index</a>
                          <a href="confirm.php?action=settings.php" class="btn btn-primary">Retry Sudo Mode</a>
                        </div>

                      </div>

                    </div>

                    <?php elseif($error == "mysql"): ?>
                      <div class="panel panel-danger">

                        <div class="panel-heading">
                          <h3 class="panel-title">Unable to setup v0ltureDB config.</h3>
                        </div>

                        <div class="panel-body">

                          <p>The currently authenticated user account does not permit creating databases or the MySQL database is unavailable currently.<br />You can try updating permissions and retrying or switching users.<br /></p>

                          <small><?php print_r($dberror); ?></small><br />

                          <div class="btn-group">
                            <a href="auth.php?confirm=switch_user" class="btn btn-danger">Switch User</a>
                            <a href="confirm.php?action=settings.php" class="btn btn-primary">Retry</a>
                          </div>

                        </div>

                      </div>

                    <?php elseif($error == "none"): ?>
                      <div class="panel panel-info">

                        <div class="panel-heading">
                          <h3 class="panel-title">v0ltureDB configuration</h3>
                        </div>

                        <div class="panel-body">

                          <p>The configuration is ready to be edited and used.</p>

                          <div class="btn-group">
                            <a href="table.php?db=<?php echo $lang["config_db_name"]; ?>&tbl=<?php echo $lang["config_table_safety_name"]; ?>" class="btn btn-primary">Edit <?php echo $lang["config_table_safety_name"]; ?> config</a>
                          </div>

                        </div>

                      </div>
                  <?php endif; ?>

              </div>

            </div>
        </div>

     </body>
 </html>
