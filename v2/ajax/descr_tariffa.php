<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");
mysqli_set_charset($conn,'utf8');

	$tariffa   = $_REQUEST['tariffa'];
	$idsito    = $_REQUEST['idsito'];
	$lingua    = $_REQUEST['lingua'];

	$sql         = "SELECT * FROM hospitality_condizioni_tariffe_lingua WHERE id = '".$tariffa."' AND idsito = ".$idsito." AND Lingua = '".$lingua."' ";
	$result      = mysqli_query($conn,$sql) or die('Error, connesione'.$sql);
	$ret         = mysqli_fetch_assoc($result);
	echo $testo = stripslashes($ret['testo']);


	mysqli_close($conn);
?>