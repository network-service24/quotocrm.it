<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$idrichiesta = $_REQUEST['idrichiesta'];

	$s = "DELETE FROM hospitality_richiesta WHERE Id = ".$idrichiesta;
	$dbMysqli->query($s);

?>