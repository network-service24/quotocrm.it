<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");

	$checkbox_op     = explode(',',$_REQUEST['checkbox_op']);
    $idsito          = $_REQUEST['idsito'];
    $id_operatore    = $_REQUEST['operatore'];

	if(is_array($checkbox_op) && !empty($checkbox_op)){ 
		foreach ($checkbox_op as $key => $value) {

	        $sel = "SELECT NomeOperatore,EmailSegretaria FROM hospitality_operatori WHERE Id = '".$id_operatore."' AND idsito = ".$idsito;
	        $res = mysqli_query($conn,$sel);
	        $row = mysqli_fetch_assoc($res);
			
        	mysqli_query($conn,"UPDATE hospitality_guest SET ChiPrenota = '".$row['NomeOperatore']."', EmailSegretaria = '".$row['EmailSegretaria']."' WHERE Id = '".$value."' AND idsito = ".$idsito);

		}
	}

	mysqli_close($conn);
?>