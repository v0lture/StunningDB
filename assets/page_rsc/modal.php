<?php

  require_once "load.php";

  if(isset($_GET["db"]) && isset($_GET["tbl"])) {
    $dbl = $_GET["db"];
    $tbl = $_GET["tbl"];
    $colcount = 0;
    $fields = "";

    $fields .= '<input type="hidden" name="db" value="'.$dbl.'">';
    $fields .= '<input type="hidden" name="tbl" value="'.$tbl.'">';

    $columns = fetchTableColumns($dbl, $tbl);
    while($colarray = $columns->fetch_assoc()) {
      $colcount++;

      if($colarray["Key"] == "PRI") {
        $key = $lang["tbl_key"];
      } else {
        $key = "";
      }

      $fields .=
      '<div class="input-group">

        <input type="text" name="'.$colarray["Field"].'" class="form-control" placeholder="'.$colarray["Type"].'" aria-describedby="'.$colarray["Field"].'">
        <span class="input-group-addon" id="'.$colarray["Field"].'">'.$colarray["Field"].' '.$key.'</span>

      </div><br />';
    }
  }

 ?>

<?php if($_GET["do"] == "insert"): ?>

  <fieldset>

    <?php echo $fields; ?>

  </fieldset>

<?php endif; ?>
