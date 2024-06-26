<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");

 error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");

	$idsito = $_REQUEST['idsito'];

	$syncro = "INSERT INTO hospitality_data_esport(idsito,data) VALUES('".$idsito."','".date('Y-m-d H:i:s')."')";
	mysqli_query($conn,$syncro);
	
	$s = "SELECT data FROM hospitality_data_esport WHERE idsito = ".$idsito." ORDER BY id DESC";
	$r = mysqli_query($conn,$s);
	$tot = mysqli_num_rows($r);
	$w = mysqli_fetch_assoc($r);
	if($tot > 0){
	    
	    $datS    =  explode(" ",$w['data']); 
	    $dataS   =  explode("-",$datS[0]);  
	    $dataH   =  explode(":",$datS[1]);               
	    echo '<h4>Ultimo export del '.$dataS[2].'-'.$dataS[1].'-'.$dataS[0].' alle '.$dataH[0].':'.$dataH[1].':'.$dataH[2].'</h4>';
	}


	mysqli_close($conn);
?>