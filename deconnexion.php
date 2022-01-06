<?php

session_start();
$_SESSION["session"] = "";
$_SESSION["id"] = "" ;
$_SESSION["type"] = "" ;
$_SESSION["login"] = "" ;
session_destroy();
header("Location:index.php");

?>