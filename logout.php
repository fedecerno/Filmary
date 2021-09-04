<?php

include "../inc/dbinfo.inc";

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
$id_user = $_SESSION['id_user'];

session_destroy();
header("Location: index.php");
exit;

 ?>
