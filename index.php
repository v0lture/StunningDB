<?php

    // Working directory of any
    $wd = getcwd();
    // Working directory of first executing file
    $lcwd = dirname(__FILE__);

    require_once $lcwd."/assets/php/session.php";
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

    <body>

        <?php 
            // require navigation bar
            require_once $lcwd."/assets/page_rsc/navbar.php";
        ?>

        <div class="row">
            
            <div class="col-md-3" id="sidebar">


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#" class="btn btn-primary btn-xs pull-right" style="margin-top: -3px;">Refresh</a>
                        <h3 class="panel-title">Databases</h3>
                        
                    </div>

                    <div class="panel-body">

                        <div class="list-group">
                            <?php
                                $dat = fetchDatabases();
                                while($res = $dat->fetch_assoc()) {
                                    echo '<a href="#!" onclick="loadDb(\''.$res["Database"].'\')" class="list-group-item">
                                            '.$res["Database"].'
                                        </a>';
                                } 
                            
                            ?>
                        </div>
                    
                    </div>

                </div>

            </div>
            
            <div class="col-md-9" id="maincontent">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tables</h3>
                    </div>

                    <div class="panel-body">

                        <h4>Click on a database on the left side to load the relating tables.</h4>
                    
                    </div>

                </div>

            </div>
        
        </div>

    </body>
</html>