<?php

    // Working directory of first executing file
    $lcwd = dirname(__FILE__);

    require_once $lcwd."/assets/page_rsc/load.php";

    if(testConn() != "Success") {
      header("Location: auth.php?confirm=reauth");
    } else {
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

      if(isset($_GET["msg"])) {
        $script = 'ohno("'.$_GET["msg"].'", "PHP");';
      }
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <?php require_once "assets/page_rsc/head.php"; ?>

    </head>

    <body onload="tableInit();">

        <?php
            // require navigation bar
            require_once $lcwd."/assets/page_rsc/navbar.php";
        ?>

        <div id="txtprompt" class="modal v0lture-modal">
          <div class="modal-content">
            <h4 id="txttitle"><?= $lang["impromptu_title"]; ?></h4>

            <div class="input-field">

              <input type="text" id="txtfield">
              <label for="txtfield"><?= $lang["impromptu_field"]; ?></label>

            </div>

          </div>
          <div class="modal-footer v0lture-modal">
            <a href="#!" class="modal-action modal-close waves-effect waves-light btn-flat v0lture-action"><?= $lang["btn_close"]; ?></a>
            <a href="#!" id="txtbtn" onclick="impromptuCallback()" class="modal-action modal-close waves-effect waves-light btn-flat v0lture-action"><?= $lang["btn_submit"]; ?></a>

          </div>
        </div>


        <!-- Run query prompt -->
        <div id="queryprompt" class="modal v0lture-modal">

          <div class="modal-content">
            <h4><?= $lang["modal_query_title"]; ?></h4>
            <p><?= $lang["modal_query_info"]; ?></p>

            <div class="center-align" id="queryrunning">
              <div class="progress v0lture-progress-bg">
                <div class="indeterminate v0lture-progress"></div>
              </div>
              <h5 class="v0lture-action"><?= $lang["modal_query_running"]; ?></h5>
            </div>

            <div class="center-align" id="queryresponse">
              <h5 class="v0lture-action" id="queryresponsefailed"><?= $lang["modal_query_failed"]; ?></h5>

              <h5 class="v0lture-action" id="queryresponsesuccess"><?= $lang["modal_query_success"]; ?></h5>

              <p id="queryresponsetext">waiting</p>
            </div>

            <div class="input-field" id="queryfieldbox">

              <input type="text" id="queryfield">
              <label for="queryfield"><?= $lang["modal_query_field"]; ?></label>

            </div>

          </div>

          <div class="modal-footer v0lture-modal" id="queryaction">
            <a href="javascript:runQuery(true)" class="waves-effect waves-light btn-flat v0lture-action"><?= $lang["modal_query_btn"]; ?></a>
          </div>

        </div>

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

        <!-- Warning  modal -->
        <div id="warnmodal" class="modal v0lture-modal">
          <div class="modal-content">
            <h4><?= $lang["modal_warn_title"]; ?></h4>

            <p><?= $lang["modal_warn_action"]; ?></p>

            <p>
              <?= $lang["modal_warn_response"]; ?> <code id="warnresponse"></code><br />
              <?= $lang["modal_warn_src"]; ?> <code id="warnsrc"></code>
            </p>

          </div>
          <div class="modal-footer v0lture-modal">
            <a href="#!" class="modal-action modal-close waves-effect waves-light btn-flat v0lture-action"><?= $lang["modal_error_dismiss"]; ?></a>
          </div>
        </div>

        <!-- new database prompt -->
        <div id="newdb" class="modal bottom-sheet v0lture-modal">
          <div class="modal-content">
            <h4><?= $lang["db_create"]; ?></h4>

            <div class="input-field">

              <input id="createdbinline" type="text">

              <label for="createdbinline"><?= $lang["db_create_popover_ph"]; ?></label>

            </div>

          </div>
          <div class="modal-footer v-bg-grey">
            <a href="javascript:newDB()" class="waves-effect waves-light btn-flat v0lture-action"><?= $lang["db_create_popover"]; ?></a>
          </div>
        </div>

        <div id="editorModal" class="modal modal-fixed-footer v0lture-modal">
          <form method="POST" action="assets/page_rsc/editor.php?do=edit">
            <div class="modal-content">
              <h4><?= $lang["editor_title"]; ?></h4>

              <div id="editor-xhr">
                <!-- To be filled based off an Ajax request -->
              </div>

            </div>
            <div class="modal-footer v-bg-grey">
              <button type="submit" class="waves-effect waves-light btn-flat v0lture-action"><?= $lang["editor_save_changes"]; ?></button>
              <a href="#!" class="modal-action modal-close waves-effect waves-light btn-flat v0lture-cancel"><?= $lang["btn_close"]; ?></a>
            </div>
          </form>
        </div>

        <div id="newModal" class="modal modal-fixed-footer v0lture-modal">
          <form method="POST" action="assets/page_rsc/editor.php?do=insert">
            <div class="modal-content">
              <h4><?= $lang["editor_new_title"]; ?></h4>

              <div id="new-xhr">
                <!-- To be filled based off an Ajax request -->
              </div>

            </div>
            <div class="modal-footer v-bg-grey">
              <button type="submit" class="waves-effect waves-light btn-flat v0lture-action"><?= $lang["editor_new"]; ?></button>
              <a href="#!" class="modal-action modal-close waves-effect waves-light btn-flat v0lture-cancel"><?= $lang["btn_close"]; ?></a>
            </div>
          </form>
        </div>

        <!-- New.. fab -->
        <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
          <a class="btn-floating btn-large v0lture-btn-light tooltipped" data-position="left" data-delay="50" data-tooltip="New..." onclick="$('.fixed-action-btn').openFAB();">
            <i class="large material-icons">add</i>
          </a>
          <ul>

            <li>
              <a href="javascript:runQuery(false)" class="btn-floating black tooltipped" data-position="left" data-delay="50" data-tooltip="Run Query...">
                <i class="material-icons">code</i>
              </a>
            </li>

            <li>
              <a href="javascript:$('#newdb').openModal();" class="btn-floating v0lture-btn-dark tooltipped" data-position="left" data-delay="50" data-tooltip="New Database">
                <i class="material-icons">dns</i>
              </a>
            </li>

            <li>
              <a class="btn-floating v0lture-btn-dark tooltipped" onclick="newTable(<?= $new; ?>)" id="newtable" data-position="left" data-delay="50" data-tooltip="New Table">
                <i class="material-icons">border_all</i>
              </a>
            </li>

            <li>
              <a class="btn-floating v0lture-btn-dark tooltipped" data-position="left" data-delay="50" id="newrow" data-tooltip="New Row" onclick="loadInsert(<?= $new; ?>)">
                <i class="large material-icons">drag_handle</i>
              </a>
            </li>
          </ul>
        </div>

        <div class="row" id="fullview" style="height: calc(100vh - 64px);">

          <div class="col s3 grey darken-3 scrollbar" style="height: calc(100vh - 64px); padding-top: 25px; overflow: auto;" id="dbview">

            <div class="progress v0lture-progress-bg" id="db-loading" style="margin-top: -25px; margin-bottom: 25px; display:none;">
              <div class="indeterminate v0lture-progress"></div>
            </div>

            <div style="color: white; padding-left: 25px; padding-right: 25px;">

              <?php if(configItem('view_switcher') == "true"): ?>
                <div class="input-field" style="width: 50%;">
                  <select onchange="view(this)">
                    <option value="databases">Databases</option>
                    <option value="users">Users</option>
                  </select>
                </div>
                <div class="right" style="margin-top: -55px;">
                  <a href="javascript:fetchDatabases()" class="btn waves-effect waves-light v-bg-blue" id="db-refresh"><i class="material-icons">refresh</i></a>
                  <a href="javascript:createUser()" class="btn waves-effect waves-light v-bg-blue" id="users-new" style="display:none;"><i class="material-icons">person_add</i></a>
                </div>
              <?php else: ?>
                <h5>Databases</h5>
                <div class="right" style="margin-top: -40px;">
                  <a href="javascript:fetchDatabases()" class="btn waves-effect waves-light v-bg-blue" ><i class="material-icons">refresh</i></a>
                </div>
              <?php endif; ?>

            </div>

            <div id="db-xhr">
              <?php include "assets/page_rsc/databases.php"; ?>
            </div>

          </div>

          <div class="col s9" style="padding: 0px;" id="dataview">

            <div class="progress v0lture-progress-bg" id="main-loading" style="margin-top: -0.5px; margin-bottom: 0px; display: none;">
              <div class="indeterminate v0lture-progress"></div>
            </div>

            <!-- error bar -->
            <div class="errorbar" onclick="$('.errorbar').slideUp()">
              <p><span><b>General message</b></span><br />Context provided</p>
            </div>

            <!-- control nav -->
            <nav style="margin-bottom: -5px;">
              <div class="nav-wrapper v0lture-btn-light">
                <div class="col s12">
                  <a href="#!" class="breadcrumb"><?= $h; ?></a>
                  <a href="#!" class="breadcrumb" <?= $cls; ?> id="bc-db"><?= $dbl; ?></a>
                  <a href="#!" class="breadcrumb" id="bc-tbl" <?= $cls; ?>><?= $tbl; ?></a>
                </div>
              </div>
            </nav>

            <div id="main-xhr" class="scrollbar" style="height: calc(100vh - 139px); overflow: auto; width: 100%;">

              <?php
                if($dbl != "" || $tbl != "") {
                  include "assets/page_rsc/table_data.php";
                }
              ?>

            </div>

          </div>

        </div>

        <?php if(configItem('enable_idle_timeout') == "true"): ?>
          <script src="assets/bootstrap/idletimeout.js"></script>
        <?php endif; ?>

        <script>
          <?php

            if(isset($script)) {
              echo $script;
            }

           ?>
        </script>

    </body>
</html>
