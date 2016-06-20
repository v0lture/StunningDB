<?php
    require_once "load.php";
    global $lang;

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
      $page = $_GET["page"];
      $headers_defined = false;
      $headers_count = 0;
      $table_head = "";
      $error = "";
      $tbldat = "";

      $data = fetchTableData($dbl, $tbl, $page);

      if($data == "MySQL error") {
        die("Unable to fetch data from the table.");
      } elseif($data->num_rows == 0) {
        $error =
        '<div class="alert alert-danger" role="alert" style="margin-left: 25px; margin-right: 25px;">
            <h4>'.$lang["mysql_empty_result"].'</h4>
            <p>'.$lang["mysql_empty_result_ctx"].'
          </div>';
      } else {

        while($res = $data->fetch_assoc()) {

          // Table headers
          if($headers_defined == false) {

            $keys = array_keys($res);
            foreach($keys as &$header) {
              $headers_count++;

              if($headers_count <= 10) {
                $table_head .= "<th style=\"text-overflow: ellipsis;\" data-container=\"body\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"".$header."\">".$header."</th>";
                $headertypearray[$headers_count] = fetchTableType($tbl, $header);
              } else {
                $error =
                '<div class="alert alert-danger" role="alert" style="margin-left: 25px; margin-right: 25px;">
                    <h4>'.$lang["mysql_too_many_columns"].'</h4>
                    <p>'.$lang["mysql_too_many_columns_ctx"].'</p>
                    <br />
                    <div class="btn-group">
                        <a href="javascript:loadTableData(\''.$dbl.'\', \''.$tbl.'\', \'true\');" class="btn btn-primary">'.$lang["btn_temp_show_all"].'</a>
                        <a href="settings.php?jump=safety" class="btn btn-default">'.$lang["btn_disable"].'</a>
                    </div>
                  </div>
                ';
              }
            }
            $headers_defined = true;
          }

          // Pagination for 50+ items per page
          $paginationmodule = "";
          if($data->num_rows < 50) {
            $paginationmodule = "";
          } else {
            $pages = round(tableCount($dbl, $tbl) / 50, 0, PHP_ROUND_HALF_UP);
            $pgct = 0;
            while($pgct < $pages) {
              $pgct++;
              if($pgct == $page) {
                $paginationmodule .= "<li class='active'><a href='table.php?db=".$dbl."&tbl=".$tbl."&page=".$pgct."'>".$pgct."</a></li>";
              } else {
                $paginationmodule .= "<li><a href='table.php?db=".$dbl."&tbl=".$tbl."&page=".$pgct."'>".$pgct."</a></li>";
              }

            }
          }


          // Table data
          $tbldat .= '<tr>';
          $tblcount = 0;
            foreach($res as &$tabledat) {
              $tblcount++;
              if($tblcount <= 10) {

                $tbldat .= '<td data-container="body" data-toggle="popover" data-html="true" title="Entire value <span class=\'label label-primary\'>'.$headertypearray[$tblcount]["DATA_TYPE"].'</span>" data-content="'.$tabledat.'">'.$tabledat.'</td>';
              }

            }
          $tbldat .= '</tr>';

        }
      }


    }

?>

<table class="table table-striped table-hover table-responsive sortable-theme-bootstrap" data-sortable>

    <?php echo $error; ?>

    <thead>
        <tr>
            <?php echo $table_head; ?>
        </tr>
    </thead>
    <tbody>
        <?php echo $tbldat; ?>
    </tbody>

</table>

<nav style="margin-left: 25px; margin-right: 25px;">
  <ul class="pagination">
    <?php echo $paginationmodule; ?>
  </ul>
</nav>
