<?php

  function configEnabled() {
    // Is the config enabled and prepared?
    global $db;
    global $lang;

    $dbtst = $db->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '".$lang["config_db_name"]."'");
    if($dbtst->num_rows == 0) {
      return false;
    } else {
      return true;
    }
  }

  function configItem($key) {
    // Fetch an config item from the section and key.
    global $db;
    global $lang;

    if(configEnabled() == true) {
      $resp = $db->query("SELECT `val` FROM `".$lang["config_db_name"]."`.`".$lang["config_table_name"]."` WHERE `key` = '".$key."' LIMIT 1");
      if($resp->num_rows == 0) {
        return "Unknown key";
      } else {
        while($data = $resp->fetch_assoc()) {
          return $data["val"];
        }
      }
    } else {
      return "Not enabled";
    }
  }

  function resetConfig() {
    global $db;
    global $lang;

    if(configEnabled() == true) {

      if($res = $db->query('TRUNCATE `'.$lang["config_db_name"].'`.`'.$lang["config_table_name"].'`')) {

        if($res = $db->query("INSERT IGNORE INTO `".$lang["config_db_name"]."`.`".$lang["config_table_name"]."` (`id`, `key`, `val`) VALUES (NULL, 'sudo_mode', 'true'), (NULL, 'limit_col_count', 'true'), (NULL, 'settings_gui', 'false'), (NULL, 'show_system_tables', 'true')")) {
          return "Reset";
        } else {
          return "Cannot insert rows. Error: ".$db->error;
        }

      } else {
        return "Cannot truncate. Error: ".$db->error;
      }

    } else {
      return "Config never been initialized.";
    }
  }
 ?>
