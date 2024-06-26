<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");

	$nuovaDimensione = $_REQUEST['nuovaDimensione'];
	$idsito          = $_REQUEST['idsito'];
		if($nuovaDimensione){
				$select = "SELECT * FROM hospitality_minus_plus WHERE idsito = ".$idsito;
				$res    = mysqli_query($conn,$select);
				$tot    = mysqli_num_rows($res);
				$w      = mysqli_fetch_assoc($res);

				if($tot>0){
					$update = "UPDATE hospitality_minus_plus SET NewDImension = '".$nuovaDimensione."' WHERE Id = ".$w['Id']." AND idsito = ".$idsito;
					mysqli_query($conn,$update);
				}else{
					$insert = "INSERT INTO hospitality_minus_plus (idsito,NewDimension) VALUES('".$idsito."','".$nuovaDimensione."')";
					mysqli_query($conn,$insert);
				}
                                   
			
		}

	mysqli_close($conn);
?>