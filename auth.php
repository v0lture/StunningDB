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


      if($u == "" || $p == "" || $h == "") {
        $error = "blank";
      } else {
        $db = connectDB($u, $p, $h);

        if($db != "true") {
          $error = "invalid";
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

    <?php if($error != ""): ?>
      <?php
        if($error == "invalid") {
          $t = $lang["auth_invalid"];
          $m = $lang["auth_invalid_ctx"];
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

    <div class="container">

      <div class="card white-text grey darken-2">

        <div class="card-content">

          <span class="card-title">Log in to server</span>
          <p>Enter the credentials to access the MySQL server</p>

          <br />

          <form method="POST" action="auth.php" class="row">
            <div class="input-field col s6">
              <input type="text" id="auth_username" name="auth_username"></input>
              <label for="auth_username"><?= $lang["auth_username"]; ?></label>
            </div>

            <div class="input-field col s6">
              <input type="password" id="auth_password" name="auth_password"></input>
              <label for="auth_password"><?= $lang["auth_password"]; ?></label>
            </div>

            <div class="input-field col s12">
              <input type="text" id="auth_host" name="auth_host"></input>
              <label for="auth_host"><?= $lang["auth_host"]; ?></label>
            </div>

            <br />
            <button type="submit" class="btn waves-effect waves-light white-text purple">Login</button>
          </form>
        </div>

      </div>

    </div>


  </body>
</html>
