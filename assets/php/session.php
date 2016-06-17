<?php

    session_start();

    function connectDB($username, $password, $host) {
        $db = new mysqli($host, $username, $password); 

        session_regenerate_id();

        if($db->connect_error) {
            return $db->connect_error;
        } else {
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            $_SESSION["host"] = $host;
            return "true";
        }

    }

    function resumeConnection() {
        $u = $_SESSION["username"];
        $p = $_SESSION["password"];
        $h = $_SESSION["host"];

        $db = new mysqli($h, $u, $p);
        if($db ->connect_errno) {
            return $mysqli->connect_error;
        } else {
            return $db;
        }
    }

?>