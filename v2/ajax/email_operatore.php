<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");
mysqli_set_charset($conn, 'utf8');

	$NomeOperatore = $_REQUEST['ChiPrenota'];
	$idsito        = $_REQUEST['idsito'];

    $sql = "SELECT * FROM hospitality_operatori WHERE NomeOperatore = '".addslashes($NomeOperatore)."' AND idsito = ".$idsito;
	$result = mysqli_query($conn,$sql) or die('Error, connesione'.$sql);
	$ret = mysqli_fetch_assoc($result);	
	echo '<option value="'.$ret['EmailSegretaria'].'" >'.$ret['EmailSegretaria'].'</option>';




	mysqli_close($conn);
?>