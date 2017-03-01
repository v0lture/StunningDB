<?php

  // second revision of the Tables class
  class Tables {

    private $dbc;
    private $selected_db;

    // types
    public $types = Array(
      // Generally most used
      'INT',
      'VARCHAR',
      'TEXT',
      'DATE',
      // Numerics
      'TINYINT',
      'SMALLINT',
      'MEDIUMINT',
      'LARGEINT',
      'DECIMAL',
      'FLOAT',
      'REAL',
      'BIT',
      'BOOLEAN',
      'SERIAL',
      // Time and date
      'DATETIME',
      'TIMESTAMP',
      'TIME',
      'YEAR',
      // String
      'CHAR',
      'TINYTEXT',
      'MEDIUMTEXT',
      'LONGTEXT',
      'BINARY',
      'VARBINARY',
      'TINYBLOB',
      'MEDIUMBLOB',
      'BLOB',
      'ENUM',
      'SET'
    );

    public function __construct($db, $sel_db){
      // Get DB connection and then use it in our class
      $this->dbc = $db;
      $this->selected_db = $sel_db;
    }

    public function newTbl($name, $data) {
      // Create a new table
      $suffix = "";
      $query = "CREATE TABLE `".$this->selected_db."`.`".$name."` (";

      // $data is an Array containing col name, type, length, and other properties
      foreach($data as &$col) {
        if(isset($col["name"]) && isset($col["type"]) && isset($col["length"]) && $col["name"] != "" && $col["type"] != "" && $col["length"] != "") {
          
          // validate type data
          if(in_array(strtoupper($col["type"]), $this->types)) {

            // validate length is numeric
            if(is_numeric($col["length"])) {

              $query .= "`".$col["name"]."` ".strtoupper($col["type"])."(".$col["length"].") ".$col["params"].", ";
              if(isset($col["suffix"])) {
                $suffix .= $col["suffix"].", ";
              } 

            } else {
              return Array("error" => $lang["new_table"]["errors"]["mustbenumeric"], "query" => "Data: ".$col["name"]." - ".$col["type"]."(".$col["length"]."), ".$col["params"]);
            }

          } else {
            return Array("error" => $lang["new_table"]["errors"]["invalidtype"], "query" => "Data: ".$col["name"]." - ".$col["type"]."(".$col["length"]."), ".$col["params"]);
          }
        } else {
          return Array("error" => $lang["new_table"]["errors"]["missing"], "query" => "Data: ".$col["name"]." - ".$col["type"]."(".$col["length"]."), ".$col["params"]);
        }
      }

      // Finalize string
      $query = substr($query, 0, -2);
      if($suffix != "") {
        $suffix = ", ".$suffix;
      }
      $suffix = substr($suffix, 0, -2);
      $query .= "".$suffix.") Engine = InnoDB;";

      // query
      if($this->dbc->query($query)) {
        return Array("error" => "success");
      } else {
        return Array("error" => $this->dbc->error, "query" => $query);
      }

    } 

  }

?>