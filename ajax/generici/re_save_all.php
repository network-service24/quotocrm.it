<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$checkbox_value = explode(',',$_REQUEST['checkbox_value']);
	$idsito         = $_REQUEST['idsito'];

		if(is_array($checkbox_value) && !empty($checkbox_value)){ 
			foreach ($checkbox_value as $key => $value) {
	
				$sel = "SELECT NumeroPrenotazione FROM hospitality_guest WHERE Id = '".$value."' AND idsito = ".$idsito;
				$res = $dbMysqli->query($sel);
				$row = $res[0];
				
				$dbMysqli->query("UPDATE  hospitality_guest SET Hidden = 0 WHERE Id = '".$value."' AND idsito = ".$idsito);
				
				$dbMysqli->query("UPDATE hospitality_guest SET AzioneParity = '4' WHERE NumeroPrenotazione = ".$row['NumeroPrenotazione']." AND idsito = ".$idsito); 

			}
		}
	

?>