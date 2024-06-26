<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");

 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");

	$idproposta = $_REQUEST['idproposta'];
	$p = "DELETE FROM hospitality_proposte WHERE Id = ".$idproposta;
	mysqli_query($conn,$p);
	$r = "DELETE FROM hospitality_relazione_servizi_proposte WHERE id_proposta = ".$idproposta;
	mysqli_query($conn,$r);
	$s = "DELETE FROM hospitality_richiesta WHERE id_proposta = ".$idproposta;
	mysqli_query($conn,$s);
	

	mysqli_close($conn);
?>