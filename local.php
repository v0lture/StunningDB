<?php

  // Working directory of first executing file
  $lcwd = dirname(__FILE__);

  // handle changing language before we load all the scripts so it updates
  if(isset($_GET["set_lang"])) {
    // expire in a year
    setcookie("lang", $_GET["set_lang"], time()+31540000);
  }

  require_once $lcwd."/assets/page_rsc/load.php";

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

    <!-- Error modal -->
    <div id="errormodal" class="modal v0lture-modal">
      <div class="modal-content">
        <h4><?= $lang["modal_error_title"]; ?></h4>

        <p><?= $lang["modal_error_action"]; ?></p>

        <p>
          <?= $lang["modal_error_response"]; ?> <code id="errorresponse"></code><br />
          <?= $lang["modal_error_src"]; ?> <code id="errorsrc"></code>
        </p>

      </div>
      <div class="modal-footer v0lture-modal">
        <a href="#!" class="modal-action modal-close waves-effect waves-light btn-flat v0lture-action"><?= $lang["modal_error_dismiss"]; ?></a>
      </div>
    </div>

    <!-- error bar -->
    <div class="errorbar" onclick="$('.errorbar').slideUp()" style="display: none;">
      <p><span><b>-</b></span><br />-</p>
    </div>

    <!-- idle time out -->
    <?php if(configItem('enable_idle_timeout') == "true"): ?>
      <script src="assets/bootstrap/idletimeout.js"></script>
    <?php endif; ?>

    <!-- options -->
    <div class="row">
      <!-- tabs -->
      <div class="col s12">
        <ul class="tabs">
          <li class="tab"><a href="#lang"><?= $lang["local_language"]; ?></a></li>
        </ul>
      </div>

      <!-- sets -->
      <div id="lang" class="col s12">
        <!-- current language -->
        <div class="card grey darken-1 white-text">
          <div class="card-content">
            <span class="card-title"><?= $lang["local_language_current"]."<b>".$lang_properties["friendly"]."</b>"; ?></span>
            <p><?= $lang["local_language_reload"]; ?>
          </div>
          <div class="card-action">
            <a href="local.php?set_lang=en" class="v0lture-action"><?= $lang["local_language_reset"]; ?></a>
          </div>
        </div>

        <div class="row">
          <!-- available languages -->
          <?php

            $langs = $lcwd."/assets/lang/";
            $r = array_diff(scandir($langs), array('..', '.'));

            foreach($r as &$val) {
              // skip config file
              if($val != "config_desc.php") {
                echo
                '<div class="col s3">
                  <div class="card grey darken-1 white-text">
                    <div class="card-content">
                      <span class="card-title" style="text-transform: uppercase;">'.str_replace(".php", "", $val).'</span>
                    </div>
                    <div class="card-action">
                      <a class="v0lture-action" href="local.php?set_lang='.str_replace(".php", "", $val).'">'.$lang["local_language_select"].'</a>
                    </div>
                  </div>
                </div>';
              }
            }

          ?>
        </div>
      </div>
    </div>

    <!-- handle ?msg= errors -->
    <script>
      <?php

        if(isset($script)) {
          echo $script;
        }

       ?>
    </script>

  </body>
</html>
