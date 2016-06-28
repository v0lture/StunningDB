<?php

  require_once 'assets/page_rsc/load.php';

  // Create DB if doesn't exist
  if(testConn() == "Success") {
    global $db;
    $error = "";

    if(configEnabled() == true) {

      if(configItem('settings_gui') == "true") {
        $error = "gui";
      } else {
        $error = "none";
      }

    } elseif(configEnabled() == false && !isset($_GET["sudo"])) {

      header("Location: confirm.php?action=settings.php");

    } elseif(configEnabled() == false && isset($_GET["sudo"])) {

      $sudotoken = $_GET["sudo"];

      if($sudotoken == "denied") {

        $error = "denied";

      } elseif($sudotoken == "allowed" && isset($_GET["token"])) {

        if(verifySudoToken($_GET["token"])) {

          if(configEnabled() != true) {
            // Generate DB and tables
            if($report = $db->query("CREATE DATABASE IF NOT EXISTS ".$lang["config_db_name"]."")) {

              // Generate safety table
              if($report = $db->query("CREATE TABLE IF NOT EXISTS `".$lang["config_db_name"]."`.`".$lang["config_table_name"]."` ( `id` INT(6) NOT NULL AUTO_INCREMENT, `key` VARCHAR(100) NOT NULL, UNIQUE (`key`), `val` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;")) {

                if($report = $db->query("INSERT IGNORE INTO `".$lang["config_db_name"]."`.`".$lang["config_table_name"]."` (`id`, `key`, `val`) VALUES (NULL, 'sudo_mode', 'true'), (NULL, 'limit_col_count', 'true'), (NULL, 'settings_gui', 'false')")) {
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
            if(configItem('settings_gui') == "true") {
              $error = "gui";
            } else {
              $error = "none";
            }
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

        <?php print_r($error); ?>

        <div class="container">
          <div class="row">
            <div class="col-md-8 col-md-offset-2" style="padding-top: 40px;">

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

                      <div class="alert alert-danger" role="alert" id="error" style="display:none;width: 100%;">
                        <h4>Error</h4>
                        <p>Failed to do something.</p>
                      </div>

                      <p>The configuration is ready to be edited and used.</p>

                      <div class="btn-group">
                        <a href="table.php?db=<?php echo $lang["config_db_name"]; ?>&tbl=<?php echo $lang["config_table_name"]; ?>" class="btn btn-primary">Edit config</a>
                        <a href="javascript:inlineChange('<?php echo $lang["config_db_name"]; ?>', '<?php echo $lang["config_table_name"]; ?>', 'id', 'val', '?', '3', 'true');" class="btn btn-default">Enable Settings GUI</a>
                      </div>

                    </div>

                  </div>

                <?php elseif($error == "gui"): ?>
                  <div class="panel panel-info">

                    <div class="panel-heading">

                      <a id="tables-loading-btn" href="javascript:inlineChange('<?php echo $lang["config_db_name"]; ?>', '<?php echo $lang["config_table_name"]; ?>', 'id', 'val', '?', '3', 'false');" class="btn v-bg-light-purple btn-xs pull-right" style="margin-top: -3px; color: white;"><?php echo $lang["config_disable_gui"]; ?></a>
                      <h3 class="panel-title"><?php echo $lang["config_gui_title"]; ?></h3>

                    </div>

                    <div class="panel-body">

                      <div class="alert alert-danger" role="alert" id="error" style="display:none;width: 100%;">
                        <h4>Error</h4>
                        <p>Failed to do something.</p>
                      </div>

                      <p>Click an item to view a description of the item.</p>

                      <table class="table table-striped table-hover table-responsive sortable-theme-bootstrap" data-sortable>

                        <thead>
                          <tr>
                            <th>Option</th>
                            <th>State</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- sudo_mode -->
                          <tr>
                            <td data-container="body"
                            data-placement="bottom"
                            data-toggle="popover"
                            data-html="true"
                            title="Default <span class='label label-primary'>true</span>" data-content="Prevents destructive actions from occurring without reentering the password.">sudo_mode<br /><i>Currently <?php echo configItem('sudo_mode'); ?></i></td>
                            <td>

                              <div class="btn-group">
                                <a href="javascript:inlineChange('<?php echo $lang["config_db_name"]; ?>', '<?php echo $lang["config_table_name"]; ?>', 'id', 'val', '?', '1', 'false');" class="btn btn-default"><?php echo $lang["btn_disable"]; ?></a>
                                <a href="javascript:inlineChange('<?php echo $lang["config_db_name"]; ?>', '<?php echo $lang["config_table_name"]; ?>', 'id', 'val', '?', '1', 'true');" class="btn btn-primary"><?php echo $lang["btn_enable"]; ?></a>
                              </div>

                            </td>
                          </tr>

                          <!-- limit_col_count -->
                          <tr>
                            <td data-container="body"
                            data-placement="bottom"
                            data-toggle="popover"
                            data-html="true"
                            title="Default <span class='label label-primary'>true</span>" data-content="Prevents large column count from overflowing in the table view.">limit_col_count<br /><i>Currently <?php echo configItem('limit_col_count'); ?></i></td>
                            <td>

                              <div class="btn-group">
                                <a href="javascript:inlineChange('<?php echo $lang["config_db_name"]; ?>', '<?php echo $lang["config_table_name"]; ?>', 'id', 'val', '?', '2', 'false');" class="btn btn-default"><?php echo $lang["btn_disable"]; ?></a>
                                <a href="javascript:inlineChange('<?php echo $lang["config_db_name"]; ?>', '<?php echo $lang["config_table_name"]; ?>', 'id', 'val', '?', '2', 'true');" class="btn btn-primary"><?php echo $lang["btn_enable"]; ?></a>
                              </div>

                            </td>
                          </tr>

                          <!-- settings_gui -->
                          <tr>
                            <td data-container="body"
                            data-placement="bottom"
                            data-toggle="popover"
                            data-html="true"
                            title="Default <span class='label label-primary'>false</span>" data-content="Enables the Settings GUI instead of relying on the table editor for updating config values.">settings_gui<br /><i>Currently <?php echo configItem('settings_gui'); ?></i></td>
                            <td>

                              <div class="btn-group">

                                <a
                                  data-container="body"
                                  data-placement="bottom"
                                  data-toggle="popover"
                                  data-html="true"
                                  title="Are you sure you want to disable this?" data-content="Doing so will disable this menu until it is enabled again in the table editor.<br /><br /><a href=&#34;javascript:inlineChange(&#39;<?php echo $lang["config_db_name"]; ?>&#39;, &#39;<?php echo $lang["config_table_name"]; ?>&#39;, &#39;id&#39;, &#39;val&#39;, &#39;?&#39;, &#39;3&#39;, &#39;false&#39;);&#34; class='btn btn-danger' style='width: 100%;'>Confirm</a>"

                                 class="btn btn-default"><?php echo $lang["btn_disable"]; ?></a>

                              </div>

                            </td>
                          </tr>
                        </tbody>

                      </table>


                    </div>

                  </div>

                <?php endif; ?>

              </div>
            </div>
        </div>
     </body>
 </html>
