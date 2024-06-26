<?php

include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");


$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");
mysqli_set_charset($conn,'utf8');

		if($_REQUEST['id_testo']==''){

				$insert ="INSERT INTO hospitality_contenuti_web_lingua(
																		idsito,
																		IdRichiesta,
																		Lingua,
																		Testo) 
																	VALUES (
																		'".$_REQUEST['idsito']."',
																		'".$_REQUEST['idrichiesta']."',
																		'".$_REQUEST['lingua']."',
																		'".mysql_real_escape_string($_REQUEST['testo'])."')";

				mysqli_query($conn,$insert);
		}else{

				$update ="UPDATE hospitality_contenuti_web_lingua SET Testo = '".mysql_real_escape_string($_REQUEST['testo'])."' WHERE Id =  ".$_REQUEST['id_testo'];

				mysqli_query($conn,$update);		
		}


				$select = "SELECT Testo FROM hospitality_contenuti_web_lingua WHERE IdRichiesta = ".$_REQUEST['idrichiesta']." AND idsito = ".$_REQUEST['idsito']." AND Lingua = '".$Lingua."' ORDER BY Id DESC";
				$res = mysqli_query($conn,$select);	
				$value = mysqli_fetch_assoc($res);

				echo $value['Testo'];


mysqli_close($conn);
?>