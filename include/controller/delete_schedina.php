<?php
	
if($_REQUEST['azione'] != '' && $_REQUEST['param'] != '' && $_REQUEST['valore'] != ''){
	
		$idsito         = $_REQUEST['azione'];
		$idschedina     = $_REQUEST['param'];
		$idprenotazione = $_REQUEST['valore'];

		

		$select = "SELECT id FROM hospitality_checkin WHERE Prenotazione = ".$idprenotazione." AND idsito = ".$idsito;
		$risultato = $dbMysqli->query($select);
		if(sizeof($risultato)>0){
			foreach ($risultato as $k => $val) {
				$dbMysqli->query("DELETE from hospitality_checkin WHERE Id = ".$val['id']);
			}			
		}

		//header('Location:'.BASE_URL_SITO.'checkinonline-schedine_alloggiati/');
		$prt->_goto(BASE_URL_SITO.'checkinonline-schedine_alloggiati/'); 
}