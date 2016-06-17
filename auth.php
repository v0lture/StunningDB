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

    <body class="container">

        <div class="row">

            <div class="col-md-6 col-md-offset-3" style="padding-top: 40px;">

                <?php if($confirm == "login"): ?>
                    <div class="panel panel-primary">

                        <div class="panel-heading">
                            <h3 class="panel-title">Login to a database</h3>
                        </div>

                        <div class="panel-body">

                            <form class="form-horizontal" method="POST" action="auth.php">

                                <fieldset>

                                    <div class="form-group">

                                        <label for="auth_username" class="col-lg-2 control-label">Username</label>
                                        
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="auth_username" id="auth_username" placeholder="" required>
                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="auth_password" class="col-lg-2 control-label">Password</label>
                                        
                                        <div class="col-lg-10">
                                            <input type="password" class="form-control" name="auth_password" id="auth_password" placeholder="" required>
                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="auth_host" class="col-lg-2 control-label">Host</label>
                                        
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="auth_host" id="auth_host" placeholder="localhost" required>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        
                                        <div class="col-lg-10 col-lg-offset-2">
                                        
                                            <button type="submit" class="btn btn-primary">Log In</button>
                                        
                                        </div>
                                    
                                    </div>

                                </fieldset>

                            </form>

                        </div>

                    </div>

                <?php elseif($confirm == "switch_user"): ?>
                    <div class="panel panel-success">

                        <div class="panel-heading">
                            <h3 class="panel-title">Switching users</h3>
                        </div>

                        <div class="panel-body">

                            <form class="form-horizontal" method="POST" action="auth.php">

                                <fieldset>
                                    <legend>Relogin as:</legend>
                                    <div class="form-group">

                                        <label for="switch_username" class="col-lg-2 control-label">Username</label>
                                        
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="switch_username" id="switch_username" placeholder="" required>
                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label for="switch_password" class="col-lg-2 control-label">Password</label>
                                        
                                        <div class="col-lg-10">
                                            <input type="password" class="form-control" name="switch_password" id="switch_password" placeholder="" required>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        
                                        <div class="col-lg-10 col-lg-offset-2">

                                            <a href="auth.php?confirm=logout"><button class="btn btn-default">Log Out</button></a>
                                            <button type="submit" class="btn btn-success">Switch</button>
                                        
                                        </div>
                                    
                                    </div>

                                </fieldset>

                            </form>

                        </div>

                    </div>

                <?php elseif($confirm == "switch_host"): ?>
                    <div class="panel panel-success">

                        <div class="panel-heading">
                            <h3 class="panel-title">Switching hosts</h3>
                        </div>

                        <div class="panel-body">

                            <form class="form-horizontal" method="POST" action="auth.php">

                                <fieldset>
                                    <legend>Relogin at:</legend>
                                    <div class="form-group">

                                        <label for="switch_host" class="col-lg-2 control-label">Host</label>
                                        
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="switch_host" id="switch_host" placeholder="" required>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        
                                        <div class="col-lg-10 col-lg-offset-2">

                                            <a href="auth.php?confirm=logout"><button class="btn btn-default">Log Out</button></a>
                                            <button type="submit" class="btn btn-success">Switch</button>
                                        
                                        </div>
                                    
                                    </div>

                                </fieldset>

                            </form>

                        </div>

                    </div>
                <?php elseif($confirm == "logout"): ?>
                    <div class="panel panel-danger">

                        <div class="panel-heading">
                            <h3 class="panel-title">Confirm log out</h3>
                        </div>

                        <div class="panel-body">

                            <form class="form-horizontal" method="POST" action="auth.php">

                                <fieldset>
                                    <legend>Are you sure you want to log out?<br /><small>You will not be able to modify the database until you log back in.</small></legend>

                                    <div class="form-group">
                                        
                                        <div class="col-lg-10 col-lg-offset-2">

                                            <a href="index.php"><button class="btn btn-default">Cancel</button></a>
                                            <button name="confirm_logout" value="true" type="submit" class="btn btn-danger">Log Out</button>
                                        
                                        </div>
                                    
                                    </div>

                                </fieldset>

                            </form>

                        </div>

                    </div>
                    <?php endif; ?>

            </div>

        </div>

    </body>
</html>