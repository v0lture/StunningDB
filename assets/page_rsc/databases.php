<?php
    require_once "load.php";
?>

<div class="list-group">
    <?php
        $dat = fetchDatabases();
        while($res = $dat->fetch_assoc()) {
            echo '<a href="#!" onclick="loadDb(\''.$res["Database"].'\')" class="list-group-item v-text-blue">
                    '.$res["Database"].'
                </a>';
        } 
    
    ?>
</div>