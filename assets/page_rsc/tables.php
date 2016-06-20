<?php
    require_once "load.php";
    if(testConn() != "Success"){
        http_response_code(403);
        die("Not authenticated.");
    }
    if(!isset($_GET["db"])) {
        http_response_code(400);
        die("Database required.");
    }

    if(isset($_GET["view"])) {
      $v = $_GET["view"];
      $compactview = false;
      if($v == "compact") {
        $compactview = true;
      }
    }
?>

<table class="table table-striped table-hover sortable-theme-bootstrap" data-sortable>

    <thead>
        <tr>
            <?php if(!$compactview): ?><th><?php echo $lang["tblh_count"]; ?></th><?php endif; ?>
            <th><?php echo $lang["tblh_name"]; ?></th>
            <?php if(!$compactview): ?><th><?php echo $lang["tblh_rows"]; ?></th><?php endif; ?>
            <th><?php echo $lang["tblh_opt"]; ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $dat = fetchTables($_GET["db"]);
            $count = 0;
            while($res = $dat->fetch_assoc()) {
                $count++;

                $dbl = $_GET["db"];
                $tbl = $res["Tables_in_".$dbl.""];
                $rowc = "";

                if(!$compactview) {
                  $rowc = tableCount($dbl, $tbl);
                  $countline = "<td>".$count."</td>";
                  $rowline = "<td>".$rowc."</td>";
                } else {
                  $countline = "";
                  $rowline = "";
                }

                if(!$compactview) {
                  $btn = '<div class="btn-group">

                              <a href="table.php?db='.$dbl.'&tbl='.$tbl.'" class="btn btn-xs btn-primary">'.$lang["tbl_view"].'</a>
                              <a href="confirm.php?db='.$dbl.'&tbl='.$tbl.'" class="btn btn-xs btn-danger">'.$lang["tbl_drop"].'</a>

                          </div>';
                } else {
                  $btn = '<a href="javascript:fetchTableData(\''.$dbl.'\', \''.$tbl.'\')" class="btn btn-xs btn-primary">'.$lang["tbl_view"].'</a>';
                }

                if($rowc == "MySQL error" && !is_numeric($rowc)) {
                    $rowc = "<span class='label label-primary'>".$rowc."</span>";
                    $btn = "<span class='label label-danger'>".$lang["tbl_na"]."</span>";
                }

                echo
                '<tr>
                    '.$countline.'
                    <td>'.$tbl.'</td>
                    '.$rowline.'
                    <td>'.$btn.'</td>
                </tr>';
            }
        ?>
    </tbody>
</table>
