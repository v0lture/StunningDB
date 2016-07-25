<?php

  require_once 'assets/page_rsc/load.php';
  require_once 'assets/lang/config_desc.php';

  // Create DB if doesn't exist
  if(testConn() == "Success") {
    global $db;
    $error = "";
    $cards = "";

    if(prepConfig() != "Ready") {
      die("<script>ohno(\"".prepConfig()."\",'PHP \'php/config.php\' ')</script>");
    } else {
      $data = fetchTableData($lang["config_db_name"], $lang["config_table_name"]);

      if($data->num_rows == 0) {
        echo resetConfig();
      }
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
                  FALSE
                  <input id='".$resp["key"]."' type='checkbox' ".$lever." onchange='updateConfig(\"".$lang["config_db_name"]."\", \"".$lang["config_table_name"]."\", \"".$resp["id"]."\", \"".$resp["key"]."\")'>
                  <span class='lever'></span>
                  TRUE
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

<div style="padding: 40px;">

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
