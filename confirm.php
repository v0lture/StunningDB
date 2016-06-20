<?php

    // Working directory of first executing file
    $cwd = dirname(__FILE__);
    error_reporting(0);

    require_once $cwd."/assets/page_rsc/load.php";
    $error = "";

    if(isset($_GET["action"])) {
      $goto = $_GET["action"];
    }

    if(isset($_POST["state_change"])) {
      if($_POST["state_change"] == "agreed") {
        $state = "agreed";
      } elseif($_POST["state_change"] == "auth") {
        if(isset($_POST["sudo_pass"])) {
          $authres = genToken($_POST["sudo_pass"]);
          if($authres != "success") {
            $error =
            '<div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Password is incorrect</strong> <br />Check for capitalization/spelling errors.
            </div>';
          } else {
            header("Location: ".$goto."?sudo=allowed&token=".$_SESSION["sudotoken"]);
          }
        } else {
          // Give an incorrect error
          $error =
          '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Password is incorrect</strong> <br />Check for capitalization/spelling errors.
          </div>';
        }
      } else {
        $state = "first";
      }
    } else {
      $state = "first";
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
                    <a class="navbar-brand" href="auth.php">v0ltureDB</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="https://github.com/v0lture/v0ltureDB">GitHub</a></li>
                        <li><a href="info.php"><span class="label label-danger" data-container="body" data-toggle="tooltip" data-placement="left" title="You are attempting to perform a critical action.">Sudo Mode</span></a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">

                <div class="col-md-6 col-md-offset-3" style="padding-top: 40px;">

                    <?php echo $error; ?>

                    <?php if($state == "first"): ?>
                        <div class="panel panel-danger">

                            <div class="panel-heading">
                                <h3 class="panel-title">Entering Sudo Mode <span class="label label-primary" data-container="body" data-toggle="tooltip" data-placement="bottom" title="A password is required to enter sudo mode.">Active Mode</span></h3>
                            </div>

                            <div class="panel-body">

                              <p>You are required to enter your password again as you are trying to do a destructive action.<br />As a level of defense, you are required to enter your password to prevent from any unattended damages.<br /><small>This feature can be disabled in the v0ltureDB config.</small></p>

                              <br />

                              <form class="form-horizontal" method="POST" action="confirm.php?action=<?php echo $goto; ?>">
                                  <fieldset>
                                      <div class="form-group" style="padding-left: 15px;">
                                        <a href="<?php echo $goto; ?>?sudo=denied" class="btn btn-default">Cancel</a>
                                        <button name="state_change" value="agreed" type="submit" class="btn btn-primary">I understand</button>
                                      </div>
                                  </fieldset>
                              </form>

                            </div>

                        </div>

                    <?php elseif($state == "agreed"): ?>
                        <div class="panel panel-danger">

                            <div class="panel-heading">
                                <h3 class="panel-title">Enter Sudo Mode</h3>
                            </div>

                            <div class="panel-body">

                                <form class="form-horizontal" method="POST" action="confirm.php?action=<?php echo $goto; ?>">

                                    <fieldset>

                                        <div class="form-group">

                                            <label for="sudo_pass" class="col-lg-2 control-label">Password</label>

                                            <div class="col-lg-10">
                                                <input type="password" class="form-control" name="sudo_pass" id="sudo_pass" placeholder="" required>
                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <div class="col-lg-10 col-lg-offset-2">

                                                <a href="<?php echo $goto; ?>?sudo=denied" class="btn btn-default">Cancel</a>
                                                <!-- <button name="state_change" value="token" type="submit" class="btn btn-default">Use App</button> -->
                                                <button name="state_change" value="auth" type="submit" class="btn btn-primary">Authenticate</button>

                                            </div>

                                        </div>

                                    </fieldset>

                                </form>

                            </div>

                        </div>
                    <?php endif; ?>

                </div>

            </div>
        </div>

    </body>
</html>
