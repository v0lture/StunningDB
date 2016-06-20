<?php

    if(testConn() == "Success") {
        $db = resumeConnection();
    }

    function fetchDatabases() {
        global $db;
        if($res = $db->query("SHOW DATABASES")) {
            return $res;
        } else {
            return "MySQL error";
        }
    }

    function fetchTables($database) {
        global $db;
        if($res = $db->query("SHOW TABLES IN ".$database."")) {
            return $res;
        } else {
            return "MySQL error";
        }
    }

    function tableCount($dbs, $table) {
      global $db;
      if($res = $db->query("SELECT * FROM `".$dbs."`.`".$table."`")) {
          return $res->num_rows;
      } else {
          return "MySQL error";
      }
    }

    function fetchTableData($database, $table, $page = 1) {
      global $db;

      if($page == 1) {
        $limiter = "LIMIT 50";
      } else {
        $offset = $page * 50;
        $limiter = "LIMIT 50 OFFSET ".$offset;
      }
      if($res = $db->query("SELECT * FROM `".$database."`.`".$table."` ".$limiter)) {
        return $res;
      } else {
        return "MySQL error";
      }
    }

    function fetchTableType($table, $col) {
      global $db;

      if($res = $db->query("SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$table."' AND COLUMN_NAME = '".$col."'")) {
        while($dat = $res->fetch_assoc()) {
          return $dat;
        }
      } else {
        return "MySQL error";
      }
    }

    function fetchTablePrimaryKey($dbl, $tbl) {
      global $db;

      if($res = $db->query("SELECT `COLUMN_NAME` FROM `information_schema`.`COLUMNS` WHERE (`TABLE_SCHEMA` = '".$dbl."') AND (`TABLE_NAME` = '".$tbl."') AND (`COLUMN_KEY` = 'PRI');")) {
        return $res;
      } else {
        return "MySQL error";
      }
    }

?>
