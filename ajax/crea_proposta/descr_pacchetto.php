<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$pacchetto = $_REQUEST['pacchetto'];
	$idsito    = $_REQUEST['idsito'];

	$sql         = "SELECT * FROM hospitality_tipo_pacchetto_lingua WHERE Id = '".$pacchetto."' AND idsito = ".$idsito;
	$result      = $dbMysqli->query($sql);
	$ret         = $result[0];

	echo $descrizione = strip_tags(stripslashes($ret['Descrizione']));

?>