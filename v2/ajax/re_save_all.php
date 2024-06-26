<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");

	$checkbox_value = explode(',',$_REQUEST['checkbox_value']);
	$idsito         = $_REQUEST['idsito'];

		if(is_array($checkbox_value) && !empty($checkbox_value)){ 
			foreach ($checkbox_value as $key => $value) {
	
				$sel = "SELECT NumeroPrenotazione FROM hospitality_guest WHERE Id = '".$value."' AND idsito = ".$idsito;
				$res = mysqli_query($conn,$sel);
				$row = mysqli_fetch_assoc($res);
				
				mysqli_query($conn,"UPDATE  hospitality_guest SET Hidden = 0 WHERE Id = '".$value."' AND idsito = ".$idsito);
				
				mysqli_query($conn,"UPDATE hospitality_guest SET AzioneParity = '4' WHERE NumeroPrenotazione = ".$row['NumeroPrenotazione']." AND idsito = ".$idsito); 

			}
		}
	


	mysqli_close($conn);
?>