<?php

    // Working directory of first executing file
    $lcwd = dirname(__FILE__);


?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <?php require_once "assets/page_rsc/head.php"; ?>

    </head>

    <body>

      <?php
          // require navigation bar
          require_once $lcwd."/assets/page_rsc/authlessnav.php";
      ?>

      <div class="container">

        <div class="row">

          <div class="col s8 offset-s2 white-text" style="margin-top: 40px;">

            <h4>v0ltureDB Installation Manager</h4>

            <div class="card v-bg-blue">

              <div class="card-content">

                <span class="card-title">Installation Manager not downloaded/readable</span>
                <p>Could not find or access the Installation Manager resources.<br />Check you can access the <code>/installmgr/</code> directory. Or download the resources below.</p>

              </div>

              <div class="card-action">
                <a href="#!" class="v-text-grey">Download Resources</a>
              </div>

            </div>

            <div class="row">
              <div class="col s12">
                <ul class="tabs">
                  <li class="tab col s3"><a href="#install">Install</a></li>
                  <li class="tab col s3"><a href="#update">Updates</a></li>
                </ul>
              </div>
              <div id="install" class="col s12" style="padding-top: 25px;">

                <div class="card v-bg-grey">

                  <div class="card-content">

                    <span class="card-title">Install</span>
                    <p>Install process will download the app from v0lture and unpack it in the relative directory of this file.<br />
                    Install will occur at <code><?= $lcwd; ?></code></p>

                  </div>

                  <div class="card-action">
                    <a href="#!" class="btn waves-effect waves-light v-bg-dark-purple">Install</a>
                  </div>

                </div>

                <div class="card v-bg-grey">

                  <div class="card-content">

                    <span class="card-title">Uninstall</span>
                    <p>Uninstall will remove <b>all</b> updates and remove <b>everything</b> in the directory this file is relative too. <b>This will not be able to be undone.</b><br />
                    Uninstall will occur at <code><?= $lcwd; ?></code></p>

                  </div>

                  <div class="card-action">
                    <a href="#!" class="btn waves-effect waves-light v-bg-light-purple">Uninstall</a>
                  </div>

                </div>

              </div>
              <div id="update" class="col s12">Test 2</div>
            </div>

          </div>

        </div>

      </div>

    </body>
</html>
