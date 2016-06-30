<?php
    require_once "load.php";
    global $lang;
    if(testConn() != "Success"){
      http_response_code(403);
      die();
    }
    if(isset($_GET["newdb"])) {
      $response = createDatabase($_GET["newdb"]);
      die($response);
    }

?>

<div class="list-group">
    <?php
        $dat = fetchDatabases();
        while($res = $dat->fetch_assoc()) {
            if(configItem('show_system_tables') == "true" && $res["Database"] != $lang["config_db_name"]) {
              echo
              '<a href="#!" onclick="loadDb(\''.$res["Database"].'\')" class="list-group-item v-text-blue">
                '.$res["Database"].'
              </a>';
            } elseif(configItem('show_system_tables') == "false" && in_array($res["Database"], $systemdbs)) {
              echo "";
            } elseif($res["Database"] == $lang["config_db_name"]) {
              echo
              '<a href="#!" onclick="loadDb(\''.$res["Database"].'\')" class="list-group-item v-text-blue">
                '.$res["Database"].' '.$lang["db_view_config_db"].'
              </a>';
            } elseif(configItem('show_system_tables') == "false" && $res["Database"] != $lang["config_db_name"]) {
              echo
              '<a href="#!" onclick="loadDb(\''.$res["Database"].'\')" class="list-group-item v-text-blue">
                '.$res["Database"].'
              </a>';
            }
        }
    ?>
</div>
