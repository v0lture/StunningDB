<?php
    require_once "load.php";
    error_reporting(E_ALL);
    if(testConn() != "Success"){
        http_response_code(403);
        die("Not authenticated.");
    }
    if(!isset($_GET["db"]) && !isset($_GET["tbl"])) {
        http_response_code(400);
        die("Database and table required.");
    } else {

      $dbl = $_GET["db"];
      $tbl = $_GET["tbl"];
      $headers_defined = false;
      $headers_count = 0;
      $table_head = "";
      $error = "";

      $data = fetchTableData($dbl, $tbl);

      if($data == "MySQL error") {
        die("Unable to fetch data from the table.");
      } elseif($data->num_rows == 0) {
        $error = '<div class="alert alert-danger" role="alert" style="margin-left: 25px; margin-right: 25px;">

                    <h4>MySQL returned empty result.</h4>
                    <p>There were no rows with the query.

                  </div>';

      } else {
        while($res = $data->fetch_assoc()) {

          if($headers_defined == false) {

            $keys = array_keys($res);
            foreach($keys as &$header) {
              $headers_count++;

              if($headers_count <= 10) {
                $table_head .= "<th>".$header."</th>";
              } else {
                $error = '<div class="alert alert-danger" role="alert" style="margin-left: 25px; margin-right: 25px;">
                            <h4>Too many columns</h4>
                            <p>There are too many columns in the current table to show without possible text overflow from the view.
                            <br /><small>
                              You can disable this safety feature in the v0ltureDB config if this is occurring often.
                            </small></p>
                            <br />
                            <div class="btn-group">
                                <a href="javascript:loadTableData(\''.$dbl.'\', \''.$tbl.'\', \'true\');" class="btn btn-primary">Temporarily show all</a>
                                <a href="settings.php#safety" class="btn btn-default">Edit config</a>
                            </div>
                          </div>
                        ';

              }

            }

            $headers_defined = true;

          }
        }
      }


    }

?>

<table class="table table-striped table-hover sortable-theme-bootstrap" data-sortable style="overflow-y: auto; width: 100%;">

    <?php echo $error; ?>

    <thead>
        <tr>
            <?php echo $table_head; ?>
        </tr>
    </thead>
    <tbody>
        <?php



        ?>
    </tbody>
</table>
