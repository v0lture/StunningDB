<?php

    require_once "load.php";
    if(testConn() != "Success") {
        header("Location: auth.php?confirm=reauth");
    } else {
        $h = $_SESSION["host"];
        $u = $_SESSION["username"];
    }

?>

<!-- Navigation -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">v0ltureDB</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#">Users</a></li>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span id="nav_db">Test</span> <span class="label label-info">Current</span> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">

                        <li><a id="nav_db_drop" href="confirm.php?db=">Drop</a></li>
                        <li><a id="nav_db_edit" href="confirm.php?db=">Manage Tables</a></li>
            
                    </ul>
                </li>
            </ul>
        
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $u; ?> <span class="label label-info"><?php echo $h; ?></span> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">

                        <li><a href="auth.php?confirm=switch_user">Switch User</a></li>
                        <li><a href="auth.php?confirm=switch_host">Switch Host</a></li>
                        <li><a href="auth.php?confirm=logout">Log Out</a></li>
            
                    </ul>
                </li>

            </ul>
    
        </div>
  
    </div>

</nav>

<div id="navigation_loading" style="display: none;">
    <div class="progress progress-striped active" style="margin-top: -21px;">
        <div class="progress-bar" style="width: 100%"></div>
    </div>
</div>