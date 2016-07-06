<?php

  require_once "load.php";

  if(isset($_GET["db"]) && isset($_GET["tbl"]) && $_GET["do"] == "insert") {
    $dbl = $_GET["db"];
    $tbl = $_GET["tbl"];
    $colcount = 0;
    $fields = "";

    $fields .= '<input type="hidden" name="modal-db" value="'.$dbl.'">';
    $fields .= '<input type="hidden" name="modal-tbl" value="'.$tbl.'">';

    $columns = fetchTableColumns($dbl, $tbl);
    while($colarray = $columns->fetch_assoc()) {
      $colcount++;

      if($colarray["Key"] == "PRI") {
        $key = $lang["tbl_key"];
      } else {
        $key = "";
      }

      $fields .=
      '<div class="input-field">

        <input type="text" id="'.$colarray["Field"].'" name="'.$colarray["Field"].'" placeholder="'.$colarray["Type"].'">
        <label for="'.$colarray["Field"].'">'.$colarray["Field"].'</label>

      </div><br />';
    }
  } elseif(isset($_GET["db"]) && isset($_GET["tbl"]) && isset($_GET["key"]) && isset($_GET["keyvalue"]) && $_GET["do"] == "edit") {

    $dbl = $_GET["db"];
    $tbl = $_GET["tbl"];
    $key = $_GET["key"];
    $keyv = $_GET["keyvalue"];
    $fields = "";
    $keycount = 0;
    $keyvalue = 0;
    $position = 0;

    if($key != "ERROR_KEY_IS_NOT_SET") {

      $fields .= '<input type="hidden" name="modal-db" value="'.$dbl.'">';
      $fields .= '<input type="hidden" name="modal-tbl" value="'.$tbl.'">';
      $fields .= '<input type="hidden" name="modal-key" value="'.$key.'">';
      $fields .= '<input type="hidden" name="modal-keyvalue" value="'.$keyv.'">';

      if($old = $db->query("SELECT * FROM `".$dbl."`.`".$tbl."` WHERE `".$key."` = '".$keyv."' LIMIT 1")) {

        if($old->num_rows > 0) {
          while($oldd = $old->fetch_assoc()) {
            $keys = array_keys($oldd);

            foreach($keys as &$keyv) {
              $fieldarray[$keycount."-KEY"] = $keyv;
              $keycount++;
            }

            foreach($oldd as &$cval) {
              $fieldarray[$keyvalue."-VAL"] = $cval;
              $keyvalue++;
            }

            foreach($fieldarray as &$arrv) {
              if($position < $keycount) {
                $fields .=
                '<div class="input-field">

                  <input type="text" id="'.$fieldarray[$position."-KEY"].'" name="'.$fieldarray[$position."-KEY"].'" value="'.$fieldarray[$position."-VAL"].'">
                  <label for="'.$fieldarray[$position."-KEY"].'">'.$fieldarray[$position."-KEY"].'</label>

                </div><br />';

                $position++;
              }
            }
          }
        } else {
          $fields .=
          '<div class="alert v-bg-blue" style="color:white;" role="alert">
            <h4>'.$lang["editor_norow_title"].'</h4>
            <p>'.$lang["editor_norow_msg"].'</p>
          </div>';
        }

      } else {
        echo $db->error;
      }

    } else {
      $fields =
      '<div class="alert v-bg-blue" style="color:white;" role="alert">
        <h4>'.$lang["editor_nokey_title"].'</h4>
        <p>'.$lang["editor_nokey_msg"].'</p>
      </div>';
    }
  }

 ?>
<p>Press 'Update' to submit all of the changes made.</p>
<?php echo $fields; ?>
