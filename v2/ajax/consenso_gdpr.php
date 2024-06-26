<?php


require($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
error_reporting(0); 
        
$user = DB_SUITEWEB_USER;
$pass = DB_SUITEWEB_PASSWORD;
$h    = DB_SUITEWEB_HOST;
$db   = DB_SUITEWEB_NAME;

$conn_sui = mysqli_connect($h, $user, $pass,$db) or die ("Error connecting to database");
		
$idutente            = $_REQUEST['idutente'];
$idsito              = $_REQUEST['idsito'];
$software            = 'Quoto';
$consenso_gdpr       = $_REQUEST['checkbox_value'];
$ip                  = base64_decode($_REQUEST['ip']);
$agent               = base64_decode($_REQUEST['agent']);
$data                = date('Y-m-d H:i:s');


$query = "INSERT INTO consensi_gdpr_utenti (idutente,idsito,software,consenso_gdpr,ip,agent,data_consenso) VALUES('".$idutente."','".$idsito."','".$software."','".$consenso_gdpr."','".$ip."','".$agent."','".$data."')";
mysqli_query($conn_sui,$query) or die('Error, update query failed');

?>