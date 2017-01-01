<?php

    // Working directory of first executing file
    $cwd = dirname(__FILE__);

    require_once $cwd."/assets/php/session.php";
    require_once $cwd."/assets/lang/en.php";
    $error = "";

    // select mode based off page variable
    if(isset($_GET["confirm"])) {
      $confirm = $_GET["confirm"];
    } else {
      // otherwise, just login
      $confirm = "login";
    }

    // Handle logging in
    if(isset($_POST["auth_username"]) && isset($_POST["auth_password"]) && isset($_POST["auth_host"])) {
      $u = $_POST["auth_username"];
      $p = $_POST["auth_password"];
      $h = $_POST["auth_host"];


      if($u == "" || $h == "") {
        $error = "blank";
      } else {
        $db = connectDB($u, $p, $h);

        if($db != "true") {
          $error = "invalid";
          // forward error
          $m = $db;
        } else {
          if($p == "") {
            header("Location: index.php?msg=".$lang["auth_nopass"]);
          } else {
            header("Location: index.php");
          }

        }
      }
    }

    // Handle log out
    if(isset($_POST["confirm_logout"])) {
      logout();
      header("Location: auth.php");
    }

    // hints
    if(isset($_GET["hint_username"])) {
      $hu = $_GET["hint_username"];
    } else {
      $hu = "";
    }

    if(isset($_GET["hint_host"])) {
      $hh = $_GET["hint_host"];
    } else {
      $hh = "";
    }


    //Check to see if user is logged and redirect if they are
    if(empty($_GET)) {
      if(testConn() == "Success") {
        header("Location: index.php");
      }
      // see if we linked a DB and TBL here
      if(isset($_GET["db"]) && isset($_GET["tbl"])) {
        $dbl = $_GET["db"];
        $tbl = $_GET["tbl"];
        $new = "'".$dbl."', '".$tbl."'";
        $cls = "";
      } else {
        $dbl = "";
        $tbl = "";
        $new = "";
        $cls = "style='display:none;'";
      }

      // See if there is an error that redirected to here
      if(isset($_GET["msg"])) {
        $script = 'oh("'.$_GET["msg"].'", "PHP");';
      }
    }
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <?php require_once "assets/page_rsc/head.php"; ?>

  </head>

  <body>

    <?php require_once "assets/page_rsc/navbar.php"; ?>

    <?php if($error != ""): ?>
      <?php
        if($error == "invalid") {
          $t = $lang["auth_invalid"];
        } elseif($error == "blank") {
          $t = $lang["auth_blank"];
          $m = $lang["auth_blank_ctx"];
        }
      ?>

      <div class="errorbar">
        <p>
          <span><i class="material-icons left">warning</i> <b><?= $t; ?></b></span><br />
          <?= $m; ?>
        </p>
      </div>
      <div style="height: 64px;"></div>
    <?php endif; ?>

    <?php if($confirm == "reauth" && $error == ""): ?>
      <div class="errorbar">
        <p>
          <span><i class="material-icons left">warning</i> <b><?= $lang["auth_reauth"]; ?></b></span><br />
          <?= $lang["auth_reauth_ctx"]; ?>
        </p>
      </div>
      <div style="height: 64px;"></div>
    <?php endif; ?>


    <?php if($confirm == "reauth" || $confirm == "login"): ?>
      <div class="container">

        <div class="card white-text v0lture-norm-card">

          <div class="card-content">

            <span class="card-title"><?= $lang["auth_title"]; ?></span>
            <p><?= $lang["auth_sub"]; ?></p>

            <br />

            <form method="POST" action="auth.php" class="row">
              <div class="input-field col s6">
                <input type="text" id="auth_username" name="auth_username" value="<?= $hu; ?>" required></input>
                <label for="auth_username"><?= $lang["auth_username"]; ?></label>
              </div>

              <div class="input-field col s6">
                <input type="password" id="auth_password" name="auth_password"></input>
                <label for="auth_password"><?= $lang["auth_password"]; ?></label>
              </div>

              <div class="input-field col s12">
                <input type="text" id="auth_host" name="auth_host" value="<?= $hh; ?>" required></input>
                <label for="auth_host"><?= $lang["auth_host"]; ?></label>
              </div>

              <br />
              <button type="submit" class="btn waves-effect waves-light white-text v0lture-btn-accent"><?= $lang["auth_login"]; ?></button>
            </form>
          </div>

        </div>

      </div>
    <?php elseif($confirm == "logout"): ?>
      <div class="container">
        <div class="card white-text v0lture-norm-card">

          <div class="card-content">

            <span class="card-title"><?= $lang["auth_confirm_logout"]; ?></span>
            <p><?= $lang["auth_confirm_logout_ctx"]; ?></p>

            <br />

            <form method="POST" action="auth.php" class="row">
              <input type="checkbox" hidden checked name="confirm_logout"></input>

              <br />
              <div class="center-align">
                <a href="index.php">
                  <button type="button" class="btn waves-effect waves-light white-text v0lture-btn-accent"><?= $lang["btn_cancel"]; ?></button>
                </a>
                <button type="submit" class="btn waves-effect waves-light white-text v0lture-btn-accent"><?= $lang["btn_continue"]; ?></button>
              </div>
            </form>
          </div>

        </div>
      </div>
    <?php endif; ?>


  </body>
</html>
