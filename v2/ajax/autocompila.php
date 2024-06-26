<?php

include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
 error_reporting(0); 

$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");
mysqli_set_charset($conn,'utf8');



  // query per i dati della richiesta
    $d = mysqli_query($conn,"SELECT Nome,Cognome,Email,Cellulare FROM hospitality_guest  WHERE idsito = ".$_REQUEST['idsito']." AND Email = '".$_REQUEST['Email']."'");
    $dati = mysqli_fetch_assoc($d);        

    $Nome           = $dati['Nome'];
    $Cognome        = $dati['Cognome'];
	$Cellulare      = $dati['Cellulare'];
    $Email          = $dati['Email'];
	
	echo'<script type="text/javascript">
					$(document).ready(function() {
								$("#Nome").val(\''.$Nome.'\');
								$("#Cellulare").val(\''.$Cellulare.'\');
								$("#Cognome").val(\''.$Cognome.'\');
					});
			</script>';	




mysqli_close($conn);
?>