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

        if($u == "" || $p == "" || $h == "") {
            return "Not stored";
        } else {
            $db = new mysqli($h, $u, $p);
            if($db ->connect_error) {
                return $db->connect_error;
            } else {
                return $db;
            }
        }
        
    }

    function testConn() {
        $u = $_SESSION["username"];
        $p = $_SESSION["password"];
        $h = $_SESSION["host"];
        if($u == "" || $p == "" || $h == "") {
            return "Not stored";
        } else {
            $conn = new mysqli($h, $u, $p);
            if($conn->connect_error) {
                return "Error: [".$conn->connect_errno."]".$conn->connect_error;
            } else {
                return "Success";
            }
        }
    }

    function switchUser($u, $p) {
        if(isset($_SESSION["host"])) {
            
            $h = $_SESSION["host"];
            $con = connectDB($u, $p, $h);
            if($con != "true") {
                return $con;
            } else {
                return "success";
            }


        } else {
            return "Must have preexisting host";
        }
    }

?>