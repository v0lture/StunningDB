<?php

    // Working directory of first executing file
    $lcwd = dirname(__FILE__);

    require_once $lcwd."/assets/page_rsc/load.php";

    if(testConn() != "Success") {
      header("Location: auth.php?confirm=reauth");
    } 
  ?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <?php require_once "assets/page_rsc/head.php"; ?>
    <script src="assets/bootstrap/table-editing.js" type="text/javascript"></script>

  </head>

  <body onload="initWrap();">

    <?php
        // require navigation bar
        require_once $lcwd."/assets/page_rsc/navbar.php";
    ?>

    <!-- modals -->

    <!-- new col -->
    <div id="newcol" class="modal v0lture-modal">

      <div class="modal-content">
        <h4><?= $lang["new_table"]["modals"]["titles"]["new_col"]; ?></h4>

        <p class="blank_error error" style="display: none;"><i class="material-icons left">warning</i> Name and type fields cannot be left blank.</p>

        <div class="row" id="new_col_fields">
          <div class="input-field col s12">

            <input id="new_col_name" type="text">
            <label for="new_col_name"><?= $lang["new_table"]["modals"]["fields"]["name"]; ?></label>  

          </div>
          <div class="input-field col s8">

            <input id="new_col_type" type="text">
            <label for="new_col_type"><?= $lang["new_table"]["modals"]["fields"]["type"]; ?></label>  

          </div>
          <div class="input-field col s4">

            <input id="new_col_length" type="number">
            <label for="new_col_length"><?= $lang["new_table"]["modals"]["fields"]["length"]; ?></label>  

          </div>
          <p class="center-align"><b><?= $lang["new_table"]["new_col"]["add_params"]; ?></b></p>
          <div class="col s12">
            
            <div class="switch right">
              <label>
                <input type="checkbox" id="new_col_ai">
                <span class="lever"></span>
              </label>
            </div>
            <p><b>AUTO_INCREMENT</b><br /><?= $lang["new_table"]["new_col"]["param_help"]["auto_increment"]; ?></p>
            
          </div>
          <div class="col s12">
            
            <div class="switch right">
              <label>
                <input type="checkbox" id="new_col_primary">
                <span class="lever"></span>
              </label>
            </div>
            <p><b>PRIMARY</b><br /><?= $lang["new_table"]["new_col"]["param_help"]["primary"]; ?></p>
            
          </div>
          <div class="col s12">
            
            <div class="switch right">
              <label>
                <input type="checkbox" id="new_col_unique">
                <span class="lever"></span>
              </label>
            </div>
            <p><b>UNIQUE</b><br /><?= $lang["new_table"]["new_col"]["param_help"]["unique"]; ?></p>
            
          </div>
          <div class="col s12">
            
            <div class="switch right">
              <label>
                <input type="checkbox" id="new_col_null">
                <span class="lever"></span>
              </label>
            </div>
            <p><b>NULL</b><br /><?= $lang["new_table"]["new_col"]["param_help"]["null"]; ?></p>
            
          </div>
        </div>

      </div>

      <div class="modal-footer v0lture-modal">
        <a href="#!" onclick="newCol()" class="waves-effect waves-light btn-flat v0lture-action"><?= $lang["new_table"]["modals"]["btn"]["save"]; ?></a>
        <a href="#!" class="waves-effect waves-light btn-flat v0lture-cancel modal-action modal-close"><?= $lang["btn_cancel"]; ?></a>
      </div>

    </div>

    <!-- single line data -->
    <div id="impromptu" class="modal v0lture-modal">
      <div class="modal-content">
        <h4></h4>

        <p id="blank-error"><?= $lang["new_table"]["modals"]["fields"]["blank"]; ?></p>

        <div class="input-field">

          <input id="impromptuData" type="text">

          <label for="impromptuData"><?= $lang["new_table"]["modals"]["fields"]["value"]; ?></label>

        </div>

      </div>
      <div class="modal-footer v0lture-modal">
        <a href="#!" id="impromptuCallback" onclick="" class="waves-effect waves-light btn-flat v0lture-action"><?= $lang["new_table"]["modals"]["btn"]["save"]; ?></a>
        <a href="#!" class="waves-effect waves-light btn-flat v0lture-cancel modal-action modal-close"><?= $lang["btn_cancel"]; ?></a>
      </div>
    </div>

    <?php
      // handle error
      if(isset($_GET["error"]) && isset($_GET["query"])) {
        $e = $_GET["error"];
        $q = $_GET["query"];
        echo "<p class='error'><i class='material-icons left'>code</i> ".$q."</p><p class='error'><i class='material-icons left'>warning</i> ".$e."</p>";
      }

    ?>

    <!-- handle error: js -->
    <div id='error-wrapper'>

    </div>

    <!-- top bar controls -->
    <div class="row newtbl-controls">

      <div class="col s3" id="controls-database">
        <p class="newtbl-header"><?= $lang["new_table"]["selected_db"]; ?></p>
        <h4 class="newtbl-h-content" id="txt-selected_db">...</h4>

        <div class="controls">
          <a href="#!" onclick="impromptuPrompt('<?= $lang["new_table"]["modals"]["titles"]["selected_db"]; ?>', 'selected_db', true)" class="btn-floating waves-effect waves-light tooltipped" data-delay="50" data-position="bottom" data-tooltip="<?= $lang["new_table"]["tooltips"]["change"]; ?>"><i class="material-icons">edit</i></a>
        </div>
      </div>

      <div class="col s3" id="controls-table">
        <p class="newtbl-header"><?= $lang["new_table"]["new_name"]; ?></p>
        <h4 class="newtbl-h-content" id="txt-table_name">...</h4>

        <div class="controls">
          <a href="#!" onclick="impromptuPrompt('<?= $lang["new_table"]["modals"]["titles"]["new_name"]; ?>', 'table_name', true)" class="btn-floating waves-effect waves-light tooltipped" data-delay="50" data-position="bottom" data-tooltip="<?= $lang["new_table"]["tooltips"]["change"]; ?>"><i class="material-icons">edit</i></a>
        </div>
      </div>

      <div class="col s2" id="controls-table">
        <p class="newtbl-header"><?= $lang["new_table"]["new_col_t"]; ?></p>
        <h4 class="newtbl-h-content"><span style="opacity:0;">.</span></h4>

        <div class="controls">
          <a href="#!" onclick="$('#newcol').modal('open');" class="btn-floating waves-effect waves-light tooltipped" data-delay="50" data-position="bottom" data-tooltip="<?= $lang["new_table"]["tooltips"]["new"]; ?>"><i class="material-icons">add</i></a>
        </div>
      </div>

      <div class="col s2" id="controls-table">
        <p class="newtbl-header"><?= $lang["new_table"]["clear"]; ?></p>
        <h4 class="newtbl-h-content"><span style="opacity:0;">.</span></h4>

        <div class="controls">
          <a href="#!" onclick="" class="btn-floating waves-effect waves-light tooltipped" data-delay="50" data-position="bottom" data-tooltip="<?= $lang["new_table"]["tooltips"]["clear"]; ?>"><i class="material-icons">clear</i></a>
        </div>
      </div>

      <div class="col s2" id="controls-table">
        <p class="newtbl-header"><?= $lang["new_table"]["submit"]; ?></p>
        <h4 class="newtbl-h-content"><span style="opacity:0;">.</span></h4>

        <div class="controls">
          <a href="#!" onclick="submitCols()" class="btn-floating waves-effect waves-light tooltipped" data-delay="50" data-position="bottom" data-tooltip="<?= $lang["new_table"]["tooltips"]["submit"]; ?>"><i class="material-icons">send</i></a>
        </div>
      </div>

    </div>

    <!-- column view -->
    <div class="row-data">
      <table>
        <thead>
          <tr>
            <th data-field="name"><?= $lang["new_table"]["table"]["name"]; ?></th>
            <th data-field="typelength"><?= $lang["new_table"]["table"]["type"]; ?></th>
            <th data-field="length"><?= $lang["new_table"]["table"]["length"]; ?></th>
            <th data-field="params"><?= $lang["new_table"]["table"]["params"]; ?></th>
            <th data-field="suffix"><?= $lang["new_table"]["table"]["suffix"]; ?></th>
            <th data-field="options"><?= $lang["new_table"]["table"]["actions"]; ?></th>
          </tr>
        </thead>

        <tbody>
          
        </tbody>
      </table>
    </div>

    <form id="tabledata" action="assets/page_rsc/table-manage.php" method="POST">
      <!-- Data will be stored here -->
      <input type="hidden" name="table_name" id="table_name"></input>
      <input type="hidden" name="selected_db" id="selected_db"></input>
    </form>

  </body>
</html>
