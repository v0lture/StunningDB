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
?>

<table class="table table-striped table-hover">
            
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Rows</th>
            <th>Options</th>
        </tr>
    </thead>            
    <tbody>
        <?php
            $dat = fetchTables($_GET["db"]);
            $count = 0;
            while($res = $dat->fetch_assoc()) {
                $count++;
                echo 
                '<tr>
                    <td>'.$count.'</td>
                    <td>'.$res["Tables_in_".$_GET["db"].""].'</td>
                    <td></td>
                    <td>
                        <div class="btn-group">
                            <a href="#" class="btn btn-xs btn-primary">View</a>
                            <a href="#" class="btn btn-xs btn-danger">Drop</a>
                            <a href="#" class="btn btn-xs btn-default">Right</a>
                        </div>
                    </td>
                </tr>';
            } 
        ?>
    </tbody>
</table>