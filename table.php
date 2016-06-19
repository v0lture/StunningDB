<?php

    // Working directory of any
    $wd = getcwd();
    // Working directory of first executing file
    $lcwd = dirname(__FILE__);

    require_once $lcwd."/assets/php/session.php";
    require_once $lcwd."/assets/page_rsc/load.php";

    if(testConn() != "Success") {
        header("Location: auth.php?confirm=reauth");

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

            <div class="col-md-3" id="tables">


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a id="tables-loading-btn" href="javascript:loadDb('<?php echo $_GET["db"]; ?>', 'compact');" class="btn v-bg-blue v-text-grey btn-xs pull-right" style="margin-top: -3px;" data-loading-text="...">Refresh</a>
                        <h3 class="panel-title">Tables in <?php echo $_GET["db"]; ?></h3>

                    </div>

                    <div class="panel-body">

                        <div class="progress" id="tables-loading" style="display: none;">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>

                    </div>

                    <div id="tables-xhr">

                      <table class="table table-striped table-hover sortable-theme-bootstrap" data-sortable>

                          <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Options</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                                  $dbl = $_GET["db"];
                                  $dat = fetchTables($dbl);
                                  $count = 0;
                                  while($res = $dat->fetch_assoc()) {
                                      $count++;
                                      $tbl = $res["Tables_in_".$dbl.""];
                                      $rowc = tableCount($dbl, $tbl);
                                      $btn = '<a href="javascript:fetchTableData(\''.$dbl.'\', \''.$tbl.'\', \'false\');" class="btn btn-xs btn-primary">View</a>';

                                      if($rowc == "MySQL error" && !is_numeric($rowc)) {
                                          $btn = "<span class='label label-danger'>N/A</span>";
                                      }
                                      echo
                                      '<tr>
                                          <td style="text-overflow: ellipsis">'.$tbl.'</td>
                                          <td>'.$btn.'</td>
                                      </tr>';
                                  }
                              ?>
                          </tbody>
                      </table>

                    </div>

                </div>

            </div>

            <div class="col-md-9" id="maincontent">

                <div class="panel panel-primary">
                    <div class="panel-heading">

                        <a id="main-loading-btn" href="javascript:loadDb('<?php echo $_GET["db"]; ?>', 'compact');" class="btn v-bg-light-purple btn-xs pull-right" style="margin-top: -3px; color: white;" data-loading-text="...">Refresh</a>
                        <h3 class="panel-title">Table Data</h3>

                    </div>

                    <div class="panel-body">

                        <div class="progress" id="main-loading" style="display: none;">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>

                    </div>

                    <div id="main-xhr" style="max-width: 100%; width: 100%;">
                        <?php include "assets/page_rsc/table_data.php"; ?>
                    </div>

                </div>

            </div>

        </div>

    </body>
</html>
