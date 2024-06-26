<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database quoto");
mysqli_set_charset($conn, 'utf8');

 $action = $_REQUEST['action'];
 $idsito = $_REQUEST['idSito']; 
 $idform = $_REQUEST['idForm'];
 $idcampo = $_REQUEST['idCampo']; 

	if($action=='delField'){

				$delete1 = "DELETE FROM hospitality_form_contenuti WHERE id='".$idcampo."'";
				mysqli_query($conn,$delete1);
				$delete2 = "DELETE FROM hospitality_form_contenuti_lang WHERE id_campo'".$idcampo."'";
				mysqli_query($conn,$delete2);				

	}

	mysqli_close($conn);
?>