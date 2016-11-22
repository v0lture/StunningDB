<?php
    require_once "load.php";
    global $lang;

    $columnlimit = 10;

    if(testConn() != "Success"){
        http_response_code(403);
        die("Not authenticated.");
    }
    if(!isset($_GET["db"]) && !isset($_GET["tbl"])) {
        http_response_code(400);
        die("Database and table required.");
    } else {

      // Variable declaration
      $dbl = $_GET["db"];
      $tbl = $_GET["tbl"];

      if(isset($_GET["page"])) {
        $page = $_GET["page"];
      } else {
        $page = 1;
      }
      $headers_defined = false;
      $headers_count = 0;
      $table_head = "";
      $error = "";
      $tbldat = "";
      $keyvalues = NULL;
      $toomanycolumns = false;
      $paginationmodule = "";
      $data = fetchTableData($dbl, $tbl, $page);
      $tdct = 0;
      $rownum = 0;

      if($dbl == $lang["config_db_name"]) {
        if(configItem('settings_gui') == "true") {
          set_error_handler(function() {});
          include "settings.php";
          restore_error_handler();
          include "../../settings.php";
          die();
        } elseif(configItem('settings_gui') == "Unknown key") {
          resetConfig();
          die("<script>oh('Configuration is being created, refresh to show changes.', 'Configuration creation needs a refresh')</script>");
        }
      }

      if($data == "MySQL error") {
        die("<script>ohno('Cannot load table in this database', 'Failed to load table')</script>");
      } elseif($data->num_rows == 0) {
        $error .= '<script>oh("'.$lang["mysql_empty_result"].'", "'.$lang["mysql_empty_result_ctx"].'")</script>';
      } else {

        // Fetch table primary key (if applicable)
        $key = fetchTablePrimaryKey($dbl, $tbl);
        $keycount = 0;

        if($key->num_rows > 0) {
          // Define all keys into an array
          while($keys = $key->fetch_assoc()) {
            $keycount++;
            if($keycount <= $columnlimit) {
              $keyarray[$keycount] = $keys["COLUMN_NAME"];
              $inlinekey = $keys["COLUMN_NAME"];
            }
          }
          $inlinebtn = "class='btn v-bg-light-purple'";
        } else {
          // No primary keys
          $error .=  '<script>oh("'.$lang["mysql_no_primary_key"].'", "Table notice")</script>';

          $keyarray[1] = "";
          $inlinekey = "ERROR_KEY_IS_NOT_SET";
        }

        while($res = $data->fetch_assoc()) {

          // Table headers
          if($headers_defined == false) {

            $keys = array_keys($res);
            foreach($keys as &$header) {
              $headers_count++;

              if($headers_count <= 10 || configItem('limit_col_count') == "false") {
                $is_primary_key = "";
                if(in_array($header, $keyarray)) {
                  $is_primary_key = $lang["tbl_key"];
                }

                $table_head .= "<th class=\"tooltipped\" style=\"text-overflow: ellipsis;\"  data-position=\"bottom\" data-delay=\"50\" data-tooltip=\"".$header."\">".$header." ".$is_primary_key."</th>";

                // Dump header names and types for popovers and inline editing
                $headertypearray[$headers_count] = fetchTableType($tbl, $header);
                $headernamearray[$headers_count] = $header;

              } else {
                // Appends error only once into the error variable
                if($toomanycolumns == false) {
                  $error .=
                  '<script>oh("'.$lang["mysql_too_many_columns"].'", "PHP \'table_data.php\'")</script>';
                  $toomanycolumns = true;
                }
              }
            }
            $headers_defined = true;
          }

          // Pagination for 50+ items per page
          $paginationmodule = "";
          if($data->num_rows < 50) {
            $paginationmodule = "";
          } else {
            $pages = round(tableCount($dbl, $tbl) / 50, 0, PHP_ROUND_HALF_UP) - 1;
            $pgct = 0;
            while($pgct < $pages) {
              $pgct++;
              if($pgct == $page) {
                $paginationmodule .= "<li class='active'><a href='index.php?db=".$dbl."&tbl=".$tbl."&page=".$pgct."'>".$pgct."</a></li>";
              } else {
                $paginationmodule .= "<li class='waves-effect waves-light'><a href='index.php?db=".$dbl."&tbl=".$tbl."&page=".$pgct."' class=' white-text'>".$pgct."</a></li>";
              }

            }
          }


          // Table data
          $tbldat .= '<tr>';
          $tblcount = 0;
          $rownum++;

          foreach($res as &$tabledat) {
            $tblcount++;
            $tdct++;
            if($tblcount <= 10 || configItem('limit_col_count') == "false") {

              $valid = $headernamearray[$tblcount].$tdct;

              if($lang["tbl_popover_entire_value"] == "") {
                $popovervalue = $headernamearray[$tblcount];
              } else {
                $popovervalue = $lang["tbl_popover_entire_value"];
              }

              $cur_header = $headernamearray[$tblcount];
              if(in_array($cur_header, $keyarray)){
                $keyvalues[$rownum] = $tabledat;
              }

              $tbldat .= '<td ondblclick="loadEditor(\''.$dbl.'\', \''.$tbl.'\', \''.$inlinekey.'\', \''.$keyvalues[$rownum].'\');">'.$tabledat.'</td>';
            }

          }

          $tbldat .= '</tr>';

        }
      }
    }
?>

<table class="table table-striped table-hover table-responsive sortable-theme-bootstrap" data-sortable>

    <thead>
        <tr>
            <?php echo $table_head; ?>
        </tr>
    </thead>
    <tbody>
        <?php echo $tbldat; ?>
    </tbody>

</table>

<ul class="pagination center-align white-text">
  <?php echo $paginationmodule; ?>
</ul>

<?php echo $error; ?>
