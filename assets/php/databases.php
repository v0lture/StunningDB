<?php

    if(testConn() == "Success") {
        $db = resumeConnection();
    }

    function fetchDatabases() {
        global $db;
        if($res = $db->query("SHOW DATABASES")) {
            return $res;
        }
    }

    function fetchTables($database) {
        global $db;
        if($res = $db->query("SHOW TABLES IN ".$database."")) {
            return $res;
        }
    }

?>