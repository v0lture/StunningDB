<?php

  // move version here
  $version = "0.0.3.1";

  $systemdbs = Array(
    "1" => "mysql",
    "2" => "performance_schema",
    "3" => "information_schema",
    "4" => "sys",
  );

  // check if lang is set
  if(!isset($_COOKIE["lang"])) {
    // set to expire in a year
    setcookie("lang", "en", time()+31540000);
    $l = "en";
  } else {
    $l = $_COOKIE["lang"];
  }

  // update language
  if(isset($_GET["set_lang"])) {
    // expire in a year
    $l = $_GET["set_lang"];
    setcookie("lang", $t, time()+31540000);
  }

  $cwd = dirname(__FILE__);

  // make sure the language exists and there wasnt any unexpected file changes
  if(file_exists($cwd."/../lang/".$l.".php")) {
    require_once $cwd."/../lang/".$l.".php";
  } else {
    setcookie("lang", "en", time()+31540000);
    require_once $cwd."/../lang/en.php";
  }
  require_once $cwd."/../lang/config_desc.php";

  require_once $cwd."/../php/session.php";
  require_once $cwd."/../php/databases.php";
  require_once $cwd."/../php/tables.php";
  require_once $cwd."/../php/config.php";
  require_once $cwd."/../php/tables-v2.php";
?>
