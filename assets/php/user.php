<?php

    class User {

        private $dbc;

        public function __construct($db) {
            $this->dbc = $db;
        }

        // get all users
        public function fetchAll(){
            if($data = $this->dbc->query('SELECT User FROM mysql.user')){

                $i = 0;
                while($raw = $data->fetch_assoc()){
                    $return[$i] = $raw;
                    $i++;                    
                }

                return Array("state" => "success", "data" => $return);

            } else {
                return Array("state" => "error", "error" => "query", "data" => $this->dbc->error);
            }
        }

    }

?>