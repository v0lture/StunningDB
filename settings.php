<?php

  require_once 'assets/page_rsc/load.php';
  require_once 'assets/lang/config_desc.php';

  // Create DB if doesn't exist
  if(testConn() == "Success") {
    global $db;
    $error = "";
    $cards = "";

    // we should initialize the database and table if we haven't already
    if(prepConfig() != "Ready") {
      die("<script>ohno(\"".prepConfig()."\",'PHP \'php/config.php\' ')</script>");
    } else {
      // get config and server version
      $data = fetchTableData($lang["config_db_name"], $lang["config_table_name"]);
      $serverversion = file_get_contents("http://testing.v0lture.com/v0ltureDB/version.json");
      // process server version
      $serverversion = json_decode($serverversion, true);
      $serverversion = $serverversion["version"];
      $version = trim($version);

      // if we are empty, reset the config
      if($data->num_rows == 0) {
        resetConfig();
      }

      // process keys

      while($resp = $data->fetch_assoc()) {

        if($resp["val"] == "true") {
          $lever = "checked";
        } else {
          $lever = "";
        }

        $cards .=
        "
          <div class='card v0lture-norm-card'>
            <div class='card-content white-text'>
              <span class='card-title'>".$resp["key"]."</span>

              <div class='switch right'>
                <label>
                  ".$lang["config_toggle_false"]."
                  <input id='".$resp["key"]."' type='checkbox' ".$lever." onchange='updateConfig(\"".$lang["config_db_name"]."\", \"".$lang["config_table_name"]."\", \"".$resp["id"]."\", \"".$resp["key"]."\")'>
                  <span class='lever'></span>
                  ".$lang["config_toggle_true"]."
                </label>
              </div>

              <p>".$descriptions[$resp["key"]]."</p>

            </div>
          </div>
        ";
      }

    }

  } else {
    header("Location: auth.php?confirm=reauth");
  }

?>

<div class="row">
  <div class="col s12" style="padding: 0px;">
    <ul class="tabs">
      <li class="tab"><a href="#updates">Updates</a>
      <li class="tab"><a href="#config" class="active">Config</a>
    </ul>
  </div>

  <div id="updates" class="col s12">

    <!-- do we allow updates? -->
    <?php if(configItem('updates_allowed') == "true"): ?>
      <!-- we are up to date -->
      <?php if(trim($version) == $serverversion): ?>
        <div class="center-align" style="opacity: 0.75; padding-top: 50px;">
          <h3><i class="material-icons v0lture-cancel" style="font-size: 80px;">cloud_done</i></h3>
          <h5 class="v0lture-cancel" style="margin-top: -20px;"><?= $lang["updates_none"]; ?></h5>
          <p class="v0lture-action" style="margin-top: -10px;"><?= $lang["updates_none_sub"]; ?> (v<?= $version; ?>)</p>
        </div>
      <?php elseif($serverversion == ""): ?>
        <!-- incase version check if down -->
        <div class="center-align" style="opacity: 0.75; padding-top: 50px;">
          <h3><i class="material-icons v0lture-cancel" style="font-size: 80px;">close</i></h3>
          <h5 class="v0lture-cancel" style="margin-top: -20px;"><?= $lang["updates_unavailable"]; ?></h5>
          <p class="v0lture-action" style="margin-top: -10px;"><?= $lang["updates_unavailable_sub"]; ?></p>
        </div>
      <?php else: ?>
        <!-- update available -->
        <div class="center-align" style="opacity: 0.75; padding-top: 50px;">
          <h3><i class="material-icons v0lture-cancel" style="font-size: 80px;">cloud_download</i></h3>
          <h5 class="v0lture-cancel" style="margin-top: -20px;"><?= $lang["updates_available"]; ?></h5>
          <p class="v0lture-action" style="margin-top: -10px;"><?= $lang["updates_available_sub"]; ?> (v<?= $version; ?> => v<?= $serverversion; ?>)</p>
        </div>
      <?php endif; ?>
    <?php elseif(configItem('updates_allowed') == "false"): ?>
      <div class="center-align" style="opacity: 0.75; padding-top: 50px;">
        <h3><i class="material-icons v0lture-cancel" style="font-size: 80px;">cloud_off</i></h3>
        <h5 class="v0lture-cancel" style="margin-top: -20px;"><?= $lang["updates_disabled"]; ?></h5>
        <p class="v0lture-action" style="margin-top: -10px;"><?= $lang["updates_disabled_sub"]; ?></p>
      </div>
    <?php elseif(configItem('updates_allowed') == "Not enabled" || configItem('updates_allowed') == "Unknown key" || configItem('updates_config') == "Not enabled" || configItem('updates_config') == "Unknown key"): ?>
      <div class="center-align" style="opacity: 0.75; padding-top: 50px;">
        <h3><i class="material-icons v0lture-cancel" style="font-size: 80px;">warning</i></h3>
        <h5 class="v0lture-cancel" style="margin-top: -20px;"><?= $lang["updates_invalid"]; ?></h5>
        <p class="v0lture-action" style="margin-top: -10px;"><?= $lang["updates_invalid_sub"]; ?></p>
      </div>
    <?php endif; ?>

  </div>
  <div id="config" class="col s12">
    <div class='card v0lture-norm-card'>
      <div class='card-content white-text'>
        <span class='card-title'><?= $lang["config_gui_title"]; ?></span>
        <p><?= $lang["config_gui_msg"]; ?></p>

      </div>

      <div class="card-action">
        <a href="assets/page_rsc/config.php?action=rst" class="v0lture-action"><?= $lang["btn_rst"]; ?></a>
        <a href="assets/page_rsc/config.php?action=update" class="v0lture-action"><?= $lang["config_gui_update"]; ?></a>
      </div>
    </div>

    <?= $cards; ?>
  </div>
</div>
