<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

		if($_REQUEST['id_testo']==''){

				$insert ="INSERT INTO hospitality_contenuti_web_lingua(
																		idsito,
																		IdRichiesta,
																		Lingua,
																		Testo) 
																	VALUES (
																		'".$_REQUEST['idsito']."',
																		'".$_REQUEST['idrichiesta']."',
																		'".$_REQUEST['lingua']."',
																		'".$dbMysqli->escape($_REQUEST['testo'])."')";

				$dbMysqli->query($insert);
		}else{

				$update ="UPDATE hospitality_contenuti_web_lingua SET Testo = '".$dbMysqli->escape($_REQUEST['testo'])."' WHERE Id =  ".$_REQUEST['id_testo'];

				$dbMysqli->query($update);		
		}


				$select = "SELECT Testo FROM hospitality_contenuti_web_lingua WHERE IdRichiesta = ".$_REQUEST['idrichiesta']." AND idsito = ".$_REQUEST['idsito']." AND Lingua = '".$Lingua."' ORDER BY Id DESC";
				$res = $dbMysqli->query($select);	
				$value = $res[0];

				echo $value['Testo'];

?>