<?php
+

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

        <div id="newdb" class="modal bottom-sheet v-bg-grey white-text">
          <div class="modal-content">
            <h4><?= $lang["db_create"]; ?></h4>

            <div class="input-field">

              <input id="createdbinline" type="text">

              <label for="createdbinline"><?= $lang["db_create_popover_ph"]; ?></label>

            </div>

          </div>
          <div class="modal-footer v-bg-grey">
            <a href="javascript:newDB()" class="waves-effect waves-light btn-flat v-text-light-purple"><?= $lang["db_create_popover"]; ?></a>
          </div>
        </div>

        <div id="editorModal" class="modal modal-fixed-footer v-bg-grey white-text">
          <form method="POST" action="assets/page_rsc/editor.php?do=edit">
            <div class="modal-content">
              <h4><?= $lang["editor_title"]; ?></h4>

              <div id="editor-xhr">



              </div>

            </div>
            <div class="modal-footer v-bg-grey">
              <button type="submit" class="waves-effect waves-light btn-flat v-text-blue"><?= $lang["editor_save_changes"]; ?></button>
              <a href="#!" class="modal-action modal-close waves-effect waves-light btn-flat v-text-light-purple"><?= $lang["btn_close"]; ?></a>
            </div>
          </form>
        </div>

        <div id="newModal" class="modal modal-fixed-footer v-bg-grey white-text">
          <form method="POST" action="assets/page_rsc/editor.php?do=insert">
            <div class="modal-content">
              <h4><?= $lang["editor_new_title"]; ?></h4>

              <div id="new-xhr">



              </div>

            </div>
            <div class="modal-footer v-bg-grey">
              <button type="submit" class="waves-effect waves-light btn-flat v-text-blue"><?= $lang["editor_new"]; ?></button>
              <a href="#!" class="modal-action modal-close waves-effect waves-light btn-flat v-text-light-purple"><?= $lang["btn_close"]; ?></a>
            </div>
          </form>
        </div>

        <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
          <a class="btn-floating btn-large v-bg-light-purple tooltipped" data-position="left" data-delay="50" id="newrow" data-tooltip="New..." onclick="$('.fixed-action-btn').openFAB();">
            <i class="large material-icons">add</i>
          </a>
          <ul>

            <li>
              <a href="javascript:$('#newdb').openModal();" class="btn-floating v-bg-dark-purple tooltipped" data-position="left" data-delay="50" data-tooltip="New Database">
                <i class="material-icons">dns</i>
              </a>
            </li>

            <li>
              <a class="btn-floating v-bg-dark-purple tooltipped" data-position="left" data-delay="50" data-tooltip="New Table">
                <i class="material-icons">border_all</i>
              </a>
            </li>

            <li>
              <a class="btn-floating v-bg-dark-purple tooltipped" data-position="left" data-delay="50" id="newrow" data-tooltip="New Row" onclick="loadInsert(<?= $new; ?>)">
                <i class="large material-icons">drag_handle</i>
              </a>
            </li>
          </ul>
        </div>

        <div class="row" id="fullview" style="height: calc(100vh - 64px);">

          <div class="col s3 grey darken-3 scrollbar" style="height: calc(100vh - 64px); padding-top: 25px; overflow: auto;" id="dbview">

            <div class="progress v-bg-grey" id="db-loading" style="margin-top: -25px; margin-bottom: 25px; display:none;">
              <div class="indeterminate v-bg-blue"></div>
            </div>

            <div style="color: white; padding-left: 25px; padding-right: 25px;">

              <h5>Databases</h5>
              <div class="right" style="margin-top: -40px;">
                <a href="javascript:fetchDatabases()" class="btn waves-effect waves-light v-bg-blue" ><i class="material-icons">refresh</i></a>
              </div>

            </div>

            <div id="db-xhr">
              <?php include "assets/page_rsc/databases.php"; ?>
            </div>

          </div>

          <div class="col s9" style="padding: 0px;" id="dataview">

            <div class="progress v-bg-grey" id="main-loading" style="margin-top: -0.5px; margin-bottom: 0px; display: none;">
              <div class="indeterminate v-bg-blue"></div>
            </div>

            <!-- control nav -->
            <nav style="margin-bottom: -5px;">
              <div class="nav-wrapper v-bg-dark-purple">
                <div class="col s12">
                  <a href="#!" class="breadcrumb"><?= $h; ?></a> 
                  <a href="javascript:dbOnly('show')" class="breadcrumb" <?= $cls; ?> id="bc-db"><?= $dbl; ?></a>
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

    </body>
</html>
