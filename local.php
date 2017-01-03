<?php

  // Working directory of first executing file
  $lcwd = dirname(__FILE__);
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

    <!-- options -->
    <div class="row">
      <!-- tabs -->
      <div class="col s12">
        <ul class="tabs">
          <li class="tab"><a href="#lang"><?= $lang["local_language"]; ?></a></li>
          <li class="tab"><a href="#themes"><?= $lang["local_themes"]; ?></a></li>
          <li class="tab"><a href="#install"><?= $lang["local_cfg"]; ?></a></li>
        </ul>
      </div>

      <!-- sets -->

      <!-- language -->
      <div id="lang" class="col s12">
        <!-- current language -->
        <div class="card v0lture-norm-card white-text">
          <div class="card-content">
            <span class="card-title"><?= $lang["local_current"]."<b>".$lang_properties["friendly"]."</b>"; ?></span>
            <p><?= $lang["local_language_reload"]; ?></p>
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
                  <div class="card v0lture-norm-card white-text">
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

      <!-- themes -->
      <div id="themes" class="col s12">
        <!-- current theme -->
        <div class="card v0lture-norm-card white-text">
          <div class="card-content">
            <span class="card-title"><?= $lang["local_current"]."<b>".$lang["themes"][$_COOKIE["theme"]]."</b>"; ?></span>
            <p><?= $lang["local_themes_info"]; ?></p>
          </div>
          <div class="card-action">
            <a href="local.php?set_theme=db" class="v0lture-action"><?= $lang["local_themes_reset"]; ?></a>
          </div>
        </div>

        <div class="row">
          <!-- available themes -->
          <?php

            $langs = $lcwd."/assets/themes/";
            $r = array_diff(scandir($langs), array('..', '.'));

            foreach($r as &$val) {
              echo
              '<div class="col s3">
                <div class="card v0lture-norm-card white-text">
                  <div class="card-content">
                    <span class="card-title">'.$lang["themes"][str_replace(".css", "", $val)].'</span>
                  </div>
                  <div class="card-action">
                    <a class="v0lture-action" href="local.php?set_theme='.str_replace(".css", "", $val).'">'.$lang["local_themes_pick"].'</a>
                  </div>
                </div>
              </div>';
            }

          ?>
        </div>
      </div>

      <!-- install -->
      <div id="install" class="col s12">

        <div class="row">

          <div class="col s4">
            <!-- php check -->
            <div class="card v0lture-norm-card white-text">
              <div class="card-content">
                <span class="card-title"><?= $lang["installation_info"]["compatibility"]; ?></span>
                <?php if(version_compare(phpversion(), "5.5", "<")): ?>
                  <p><?= $lang["installation_info"]["compatibility_failure"]; ?></p>
                <?php else: ?>
                  <p><?= $lang["installation_info"]["compatibility_success"]; ?></p>
                <?php endif; ?>
              </div>
              <div class="card-action">
                <a href="local.php?reload#install" class="v0lture-action"><?= $lang["installation_info"]["compatibility_recheck"]; ?></a>
              </div>
            </div>
          </div>

          <div class="col s4">
            <!-- version -->
            <div class="card v0lture-norm-card white-text">
              <div class="card-content">
                <span class="card-title"><?= $lang["installation_info"]["version"]; ?></span>
                <p><?= $lang["installation_info"]["version_prefix"].$version.$lang["installation_info"]["version_suffix"]; ?></p>
              </div>
              <div class="card-action">
                <a href="index.php?db=<?= $lang["config_db_name"]; ?>&tbl=<?= $lang["config_table_name"]; ?>" class="v0lture-action"><?= $lang["installation_info"]["version_check"]; ?></a>
              </div>
            </div>
          </div>

          <div class="col s4">
            <!-- server version -->
            <div class="card v0lture-norm-card white-text">
              <div class="card-content">
                <span class="card-title"><?= $lang["installation_info"]["server_version"]; ?></span>
                <?php if(testConn() != "Success"): ?>
                  <p><?= $lang["installation_info"]["server_version_noconn"]; ?></p>
                <?php else: ?>
                  <?php $db = resumeConnection(); ?>
                  <p><?= $lang["installation_info"]["server_version_prefix"].$db->server_info; ?></p>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="col s4">
            <!-- auth as -->
            <div class="card v0lture-norm-card white-text">
              <!-- not logged in -->
              <?php if(testConn() != "Success"): ?>
                <div class="card-content">
                  <span class="card-title"><?= $lang["installation_info"]["auth"]; ?></span>
                  <p><?= $lang["installation_info"]["auth_none"]; ?></p>
                </div>
                <div class="card-action">
                  <a href="local.php?set_theme=db" class="v0lture-action"><?= $lang["installation_info"]["auth_login"]; ?></a>
                </div>
              <!-- logged in -->
              <?php else: ?>
                <div class="card-content">
                  <span class="card-title"><?= $lang["installation_info"]["auth"]; ?></span>

                  <p><?= $lang["installation_info"]["auth_user_prefix"].$_SESSION["username"].$lang["installation_info"]["auth_user_suffix"]; ?><br /><?= $lang["installation_info"]["auth_host_prefix"].$_SESSION["host"].$lang["installation_info"]["auth_host_suffix"]; ?></p>
                </div>
                <div class="card-action">
                  <a href="local.php?set_theme=db" class="v0lture-action"><?= $lang["installation_info"]["auth_logout"]; ?></a>
                </div>
              <?php endif; ?>
            </div>
          </div>

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
