<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_ft'){

			$fonte_ = $fun->clean($_REQUEST['Fonte']);
			$fonte  = $dbMysqli->escape($fonte_ );

			$select ="SELECT * FROM hospitality_fonti_prenotazione WHERE idsito = ".$_REQUEST['idsito']." AND FontePrenotazione = '".$fonte."'";
			$result = $dbMysqli->query($select);

			if(sizeof($result) > 0){
			
					$insert ="INSERT INTO hospitality_fonti_prenotazione(idsito,
															FontePrenotazione,
															Abilitato) 
															VALUES ('".$_REQUEST['idsito']."',
															'La fonte che avete inserito era già presente, elimina questo record!',
															0)";

					$dbMysqli->query($insert);			
			}else{
					$insert ="INSERT INTO hospitality_fonti_prenotazione(idsito,
															FontePrenotazione,
															Abilitato) 
															VALUES ('".$_REQUEST['idsito']."',
															'".$fonte."',
															'".$_REQUEST['Abilitato']."')";

					$dbMysqli->query($insert);	

			}	




	}

?>