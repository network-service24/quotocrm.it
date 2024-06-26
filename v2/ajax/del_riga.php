<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");

 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");

	$idrichiesta = $_REQUEST['idrichiesta'];

	$s= "DELETE FROM hospitality_richiesta WHERE Id = ".$idrichiesta;
	mysqli_query($conn,$s);
	

	mysqli_close($conn);
?>