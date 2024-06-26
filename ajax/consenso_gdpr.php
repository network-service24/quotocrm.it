<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
		
$idutente            = $_REQUEST['idutente'];
$idsito              = $_REQUEST['idsito'];
$software            = 'Quoto';
$consenso_gdpr       = $_REQUEST['checkbox_value'];
$ip                  = base64_decode($_REQUEST['ip']);
$agent               = base64_decode($_REQUEST['agent']);
$data                = date('Y-m-d H:i:s');


$query = "INSERT INTO consensi_gdpr_utenti (idutente,idsito,software,consenso_gdpr,ip,agent,data_consenso) VALUES('".$idutente."','".$idsito."','".$software."','".$consenso_gdpr."','".$ip."','".$agent."','".$data."')";
$dbMysqli->query($query) or die('Error, insert query failed');

?>