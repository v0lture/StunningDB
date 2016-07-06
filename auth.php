<?php

    // Working directory of first executing file
    $cwd = dirname(__FILE__);

    require_once $cwd."/assets/php/session.php";
    require_once $cwd."/assets/lang/en.php";
    $error = "";

    if(isset($_GET["confirm"])) {
        $confirm = $_GET["confirm"];
    } else {
        $confirm = "login";
    }

    // Handle logging in
    if(isset($_POST["auth_username"]) && isset($_POST["auth_password"]) && isset($_POST["auth_host"])) {
        $u = $_POST["auth_username"];
        $p = $_POST["auth_password"];
        $h = $_POST["auth_host"];
        if($u == "" || $p == "" || $h == "") {
            $error = '<div class="card v-bg-blue white-text">
                        <div class="card-content">
                          <span class="card-title">'.$lang["auth_blank"].'</span>
                          <p>'.$lang["auth_blank_ctx"].'</p>
                        </div>
                      </div>';
        } else {
            $db = connectDB($u, $p, $h);

            if($db != "true") {
              $error = '<div class="card v-bg-blue white-text">
                          <div class="card-content">
                            <span class="card-title">'.$lang["auth_invalid"].'</span>
                            <p>'.$lang["auth_invalid_ctx"].'<br /><small>'.$db.'</small></p>
                          </div>
                        </div>';
            } else {
              header("Location: index.php");
            }

        }
    }

    // Handle switching users
    if(isset($_POST["switch_username"]) && isset($_POST["switch_password"])) {

        $u = $_POST["switch_username"];
        $p = $_POST["switch_password"];

        if(testConn() != "Success") {
            header("Location: auth.php?confirm=reauth");
        } else if($u == "" || $p == "") {
          $error = '<div class="card v-bg-blue white-text">
                      <div class="card-content">
                        <span class="card-title">'.$lang["auth_blank"].'</span>
                        <p>'.$lang["auth_blank_ctx"].'</p>
                      </div>
                    </div>';
        } else {
            $switch = switchUser($u, $p);
            if($switch != "success") {
              $error = '<div class="card v-bg-blue white-text">
                          <div class="card-content">
                            <span class="card-title">'.$lang["auth_invalid"].'</span>
                            <p>'.$lang["auth_invalid_ctx"].'</p>
                          </div>
                        </div>';
            } else {
                header("Location: index.php");
            }
        }

    }
    // Handle log out
    if(isset($_POST["confirm_logout"])) {
        logout();
        header("Location: auth.php");
    }


?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <?php require_once "assets/page_rsc/head.php"; ?>

    </head>

    <body>

        <?php require_once "assets/page_rsc/authlessnav.php"; ?>

        <div class="container">
            <div class="row">

                <div class="col-md-6 col-md-offset-3" style="padding-top: 40px;">

                    <?php echo $error; ?>

                    <?php if($confirm == "login" || $confirm == "reauth"): ?>
                    <div class="card v-bg-grey white-text">

                      <div class="card-content">

                        <span class="card-title">Authenticate</span>

                        <form class="form-horizontal" method="POST" action="auth.php">

                          <div class="input-field">

                            <input id="auth_username" type="text" name="auth_username">

                            <label for="auth_username"><?= $lang["auth_username"]; ?></label>

                          </div>

                          <div class="input-field">

                            <input id="auth_password" type="password" name="auth_password">

                            <label for="auth_password"><?= $lang["auth_password"]; ?></label>

                          </div>

                          <div class="input-field">

                            <input id="auth_host" type="text" name="auth_host">

                            <label for="auth_host"><?= $lang["auth_host"]; ?></label>

                          </div>

                          <button type="submit" class="btn v-bg-blue waves-effect waves-light">Log In</button>

                        </form>

                      </div>

                    </div>

                    <?php elseif($confirm == "switch_user"): ?>
                      <div class="card v-bg-grey white-text">

                        <div class="card-content">

                          <span class="card-title">Switch User</span>

                          <form class="form-horizontal" method="POST" action="auth.php?confirm=switch_user">

                            <div class="input-field">

                              <input id="switch_username" type="text" name="switch_username">

                              <label for="switch_username"><?= $lang["auth_username"]; ?></label>

                            </div>

                            <div class="input-field">

                              <input id="switch_password" type="password" name="switch_password">

                              <label for="switch_password"><?= $lang["auth_password"]; ?></label>

                            </div>

                            <a href="index.php" class="btn btn-flat waves-effect waves-light white-text">Cancel</a>
                            <button type="submit" class="btn v-bg-blue waves-effect waves-light">Switch</button>

                          </form>

                        </div>

                      </div>
                    <?php elseif($confirm == "logout"): ?>
                      <div class="card v-bg-grey white-text">

                        <div class="card-content">

                          <span class="card-title">Confirm Log Out</span>

                          <form class="form-horizontal" method="POST" action="auth.php">

                            <div class="input-field">

                                <a href="index.php" class="btn waves-effect waves-light v-bg-blue">Cancel</a>
                                <button name="confirm_logout" value="true" type="submit" class="btn waves-effect waves-light v-bg-blue">Log Out</button>

                            </div>

                          </form>

                        </div>

                      </div>
                    <?php endif; ?>

                </div>

            </div>
        </div>

    </body>
</html>
