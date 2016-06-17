<?php

    // Working directory of first executing file
    $cwd = dirname(__FILE__);

    // to be needed later | require_once $cwd."/assets/php/session.php";

    if(isset($_GET["confirm"])) {
        $confirm = $_GET["confirm"];
    } else {
        $confirm = "login";
    }

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <title>v0ltureDB</title>
        <meta charset="UTF-8">

        <!-- Bootstrap Rscs -->
        <link href="assets/bootstrap/bootstrap.min.css" rel="stylesheet">
        <script src="assets/bootstrap/jquery-2.2.4.min.js"></script>
        <script src="assets/bootstrap/bootstrap.min.js"></script>

    </head>

    <body>

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
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">

                <div class="col-md-6 col-md-offset-3" style="padding-top: 40px;">

                    <ul class="list-group">
                        <li class="list-group-item">
                            <b>PHP Version</b> <span class="label label-success"><?php echo phpversion(); ?></span>
                            <?php
                                if(version_compare(phpversion(), "5.0", "<")) {
                                    echo "Your current PHP version is too old to use v0ltureDB. You must use at least <span class='label label-info'>PHP 5.0</span> in order to use v0ltureDB.";
                                } else {
                                    echo "<br /><br />Your PHP version is supported with v0ltureDB.";
                                }
                            ?>
                        </li>
                        <li class="list-group-item">
                            <b>v0ltureDB Version</b> <span class="label label-success">v1</span>
                        </li>

                    </ul>
                    
                </div>

            </div>
        </div>

    </body>
</html>