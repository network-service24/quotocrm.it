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
			$update = "UPDATE hospitality_guest SET Archivia = 1 WHERE Id = ".$value." AND idsito = ".$idsito;
			mysqli_query($conn,$update);
		}
	}

	mysqli_close($conn);
?>