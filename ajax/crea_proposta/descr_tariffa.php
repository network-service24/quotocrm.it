<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$tariffa   = $_REQUEST['tariffa'];
	$idsito    = $_REQUEST['idsito'];
	$lingua    = $_REQUEST['lingua'];

	$sql         = "SELECT * FROM hospitality_condizioni_tariffe_lingua WHERE id = '".$tariffa."' AND idsito = ".$idsito." AND Lingua = '".$lingua."' ";
	$result      = $dbMysqli->query($sql);
	$ret         = $result[0];
	echo $testo = stripslashes($ret['testo']);

?>