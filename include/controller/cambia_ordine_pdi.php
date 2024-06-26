<?php
	if($_REQUEST['azione'] != '' && $_REQUEST['param'] != '' && $_REQUEST['valore'] != ''){

		$update = "UPDATE hospitality_pdi SET Ordine = ".$_REQUEST['valore']." WHERE Id = ".$_REQUEST['azione']." AND idsito = ".$_REQUEST['param'];
		$dbMysqli->query($update);



		header('Location:'.BASE_URL_SITO.'generiche-punti_interesse/');		
	}


