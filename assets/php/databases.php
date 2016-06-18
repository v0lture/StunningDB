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

?>