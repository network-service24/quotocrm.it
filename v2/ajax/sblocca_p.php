<?php

include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
 error_reporting(0); 

$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");
mysqli_set_charset($conn,'utf8');

$delete = "DELETE FROM hospitality_check_modifica WHERE id = ".$_REQUEST['id'];
mysqli_query($conn,$delete);


mysqli_close($conn);
?>