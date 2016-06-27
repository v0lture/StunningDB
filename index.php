<?php

    // Working directory of any
    $wd = getcwd();
    // Working directory of first executing file
    $lcwd = dirname(__FILE__);

    require_once $lcwd."/assets/page_rsc/load.php";

    if(testConn() != "Success") {
        header("Location: auth.php?confirm=reauth");

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

            <div class="col-md-3" id="sidebar">


                <div class="panel panel-default">
                    <div class="panel-heading">

                      <div class="btn-group pull-right">
                          <a id="db-loading-btn" href="javascript:fetchDatabases();" class="btn v-bg-blue v-text-grey btn-xs" style="margin-top: -3px;" data-loading-text="<?php echo $lang["btn_loading"]; ?>"><?php echo $lang["btn_refresh"]; ?></a>
                          <a id="db-creating-btn" href="#!" class="btn v-bg-light-purple v-text-grey btn-xs" style="margin-top: -3px;" data-loading-text="<?php echo $lang["btn_loading"]; ?>" data-container="body" data-placement="bottom" data-toggle="popover" data-html="true" title="" data-content="
                                   <form action='javascript:newDB();'>
                                    <div class='input-group'>
                                      <input id='createdbinline' placeholder='<?php echo $lang["db_create_popover_ph"]; ?>' type='text' class='form-control'>
                                      <span class='input-group-btn'>
                                        <button class='btn v-bg-light-purple' type='submit' id='newDBInline' data-loading-text='<?php echo $lang["db_creating_popover"]; ?>'><?php echo $lang["db_create_popover"]; ?></button>
                                      </span>
                                    </div>
                                  </form>"
                                  data-original-title="<?php echo $lang["db_create"]; ?>"><?php echo $lang["db_create"]; ?></a>
                        </div>

                        <h3 class="panel-title">Databases</h3>

                    </div>

                    <div class="panel-body">

                        <div class="progress" id="db-loading" style="display: none;">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>

                        <div id="db-xhr">

                            <div class="list-group">
                                <?php
                                    $dat = fetchDatabases();
                                    while($res = $dat->fetch_assoc()) {
                                        echo '<a href="#!" onclick="loadDb(\''.$res["Database"].'\')" class="list-group-item v-text-blue">
                                                '.$res["Database"].'
                                            </a>';
                                    }

                                ?>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-9" id="maincontent">

                <div class="panel panel-primary">
                    <div class="panel-heading">

                        <a id="tables-loading-btn" href="javascript:fetchDatabases();" class="btn v-bg-light-purple btn-xs pull-right" style="margin-top: -3px; color: white;" data-loading-text="<?php echo $lang["btn_loading"]; ?>"><?php echo $lang["btn_refresh"]; ?></a>
                        <h3 class="panel-title">Tables</h3>

                    </div>

                    <div class="panel-body">

                        <div class="progress" id="tables-loading" style="display: none;">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                        </div>

                        <div id="tables-xhr">
                            <h4>No database selected.</h4>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </body>
</html>
