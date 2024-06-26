<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");

 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");


	$idsito = $_REQUEST['idsito'];

	$syncro = "INSERT INTO hospitality_data_import(idsito,data) VALUES('".$idsito."','".date('Y-m-d H:i:s')."')";
	mysqli_query($conn,$syncro);
	$syncro2 = "INSERT INTO hospitality_data_import_secondo_portale(idsito,data) VALUES('".$idsito."','".date('Y-m-d H:i:s')."')";
	mysqli_query($conn,$syncro2);	
	$syncro3 = "INSERT INTO hospitality_data_import_terzo_portale(idsito,data) VALUES('".$idsito."','".date('Y-m-d H:i:s')."')";
	mysqli_query($conn,$syncro3);	

	mysqli_close($conn);
?>