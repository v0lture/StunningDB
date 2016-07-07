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

<ul class="collapsible popout" data-collapsible="accordian">
  <?php
    $dat = fetchDatabases();
    while($res = $dat->fetch_assoc()) {
      if(configItem('show_system_tables') == "true" || configItem('show_system_tables') == "Unknown key" || configItem('show_system_tables') == "Not enabled" && $res["Database"] != $lang["config_db_name"]) {
        echo "<li>";
        echo '<div class="collapsible-header grey white-text"><i class="material-icons">dns</i>'.$res["Database"].'</div>';

        if(configItem('db_load_wo_tbl_load') == "true") {
          echo
          '<div class="collapsible-body">
            <p>No tables have been loaded due to the configuration disallowing this.<br />You can manually load tables by pressing the button below.</p>
            <a class="waves-effect waves-light btn v-bg-blue white-text">Load Database</a>
          </div>';
        } else {
          echo '<div class="collapsible-body"><div class="collection">';
          $tables = fetchTables($res["Database"]);

          while($data = $tables->fetch_assoc()) {
            echo "<a href='javascript:fetchTableData(\"".$res["Database"]."\", \"".$data["Tables_in_".$res["Database"]]."\");' class='collection-item grey darken-1 v-text-blue waves-effect waves-light'>".$data["Tables_in_".$res["Database"]]."</a>";
          }
          echo '</div></div>';
        }

        echo "</li>";
      } elseif(configItem('show_system_tables') == "false" && in_array($res["Database"], $systemdbs)) {
        echo "";
      } elseif($res["Database"] == $lang["config_db_name"]) {

        echo "<li>";
        echo '<div class="collapsible-header grey white-text"><i class="material-icons">build</i>'.$res["Database"].'</div>';

        if(configItem('db_load_wo_tbl_load') == "true") {
          echo
          '<div class="collapsible-body">
            <p>No tables have been loaded due to the configuration disallowing this.<br />You can manually load tables by pressing the button below.</p>
            <a class="waves-effect waves-light btn v-bg-blue white-text">Load Database</a>
          </div>';
        } else {
          echo '<div class="collapsible-body"><div class="collection">';
          $tables = fetchTables($res["Database"]);

          while($data = $tables->fetch_assoc()) {
            echo "<a href='javascript:fetchTableData(\"".$res["Database"]."\", \"".$data["Tables_in_".$res["Database"]]."\");' class='collection-item grey darken-1 v-text-blue waves-effect waves-light'>".$data["Tables_in_".$res["Database"]]."</a>";
          }
          echo '</div></div>';
        }

      } elseif(configItem('show_system_tables') == "false" && $res["Database"] != $lang["config_db_name"]) {
        echo "<li>";
        echo '<div class="collapsible-header grey white-text"><i class="material-icons">dns</i>'.$res["Database"].'</div>';

        if(configItem('db_load_wo_tbl_load') == "true") {
          echo
          '<div class="collapsible-body">
            <p>No tables have been loaded due to the configuration disallowing this.<br />You can manually load tables by pressing the button below.</p>
            <a class="waves-effect waves-light btn v-bg-blue white-text">Load Database</a>
          </div>';
        } else {
          echo '<div class="collapsible-body"><div class="collection">';
          $tables = fetchTables($res["Database"]);

          while($data = $tables->fetch_assoc()) {
            echo "<a href='javascript:fetchTableData(\"".$res["Database"]."\", \"".$data["Tables_in_".$res["Database"]]."\");' class='collection-item grey darken-1 v-text-blue waves-effect waves-light'>".$data["Tables_in_".$res["Database"]]."</a>";
          }
          echo '</div></div>';
        }

        echo "</li>";
      }
    }
  ?>
</ul>
