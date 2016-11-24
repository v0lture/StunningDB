<title>v0ltureDB</title>
<meta charset="UTF-8">

<!-- Bootstrap Rscs -->
<link href="assets/bootstrap/materialize.min.css" rel="stylesheet">
<script src="assets/bootstrap/jquery-2.2.4.min.js"></script>
<script src="assets/bootstrap/materialize.min.js"></script>
<script src="assets/bootstrap/fetch.js"></script>
<script src="assets/bootstrap/edit.js"></script>
<script src="assets/bootstrap/ui.js"></script>

<!-- sortable -->
<script src="assets/bootstrap/sortable/sortable.min.js"></script>
<link rel="stylesheet" href="assets/bootstrap/sortable/sortable-theme-bootstrap.css" />

<link href="assets/bootstrap/v0ltureDesign.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<?php
  // check if theme is set
  if(!isset($_COOKIE["theme"])) {
    // expires in a year
    setcookie("theme", "db", time()+3154000);
    $t = "db";
  } else {
    $t = $_COOKIE["theme"];
  }

  if(isset($_GET["set_theme"])) {
    $t = $_GET["set_theme"];
    setcookie("theme", $t, time()+3154000);
  }

  if(file_exists(dirname(__FILE__)."/../../assets/themes/".$t.".css")) {
  } else {
    // override to default
    setcookie("theme", "db", time()+3154000);
    $t = "db";
  }
?>

<link href="assets/themes/<?= $t; ?>.css" rel="stylesheet">
