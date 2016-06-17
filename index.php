<?php

    // Working directory of any
    $wd = getcwd();
    // Working directory of first executing file
    $lcwd = dirname(__FILE__);

    require_once $lcwd."/assets/php/session.php";
    require_once $lcwd."/assets/page_rsc/load.php";
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <title>v0ltureDB</title>
        <meta charset="UTF-8">

        <!-- Bootstrap Rscs -->
        <link href="assets/bootstrap/bootstrap.min.css" rel="stylesheet">
        <script src="assets/bootstrap/jquery-2.2.4.min.js"></script>
        <script src="assets/bootstrap/bootstrap.min.js"></script>

    </head>

    <body>

        <?php 
            // require navigation bar
            require_once $lcwd."/assets/page_rsc/navbar.php";
        ?>

    </body>
</html>