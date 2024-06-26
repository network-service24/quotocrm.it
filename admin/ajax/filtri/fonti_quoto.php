<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");

	$idsito = $_REQUEST['idsito'];

    $sql = "SELECT * FROM hospitality_fonti_prenotazione WHERE idsito = ".$idsito." AND Abilitato = 1";
	$result = $dbMysqli->query($sql);
	echo '<option value="">...</option>';
	foreach($result as $key => $ret){
			echo '<option value="'.$ret['FontePrenotazione'].'">'.$ret['FontePrenotazione'].'</option>';
	}	
?>