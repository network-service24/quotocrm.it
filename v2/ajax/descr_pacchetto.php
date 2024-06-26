<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");
mysqli_set_charset($conn,'utf8');

	$pacchetto = $_REQUEST['pacchetto'];
	$idsito    = $_REQUEST['idsito'];

	$sql         = "SELECT * FROM hospitality_tipo_pacchetto_lingua WHERE Id = '".$pacchetto."' AND idsito = ".$idsito;
	$result      = mysqli_query($conn,$sql) or die('Error, connesione'.$sql);
	$ret         = mysqli_fetch_assoc($result);
	echo $descrizione = strip_tags(stripslashes($ret['Descrizione']));


	mysqli_close($conn);
?>