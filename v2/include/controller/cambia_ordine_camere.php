<?php
	if($_REQUEST['azione'] != '' && $_REQUEST['param'] != '' && $_REQUEST['valore'] != ''){

		$update = "UPDATE hospitality_tipo_camere SET Ordine = ".$_REQUEST['valore']." WHERE Id = ".$_REQUEST['azione']." AND idsito = ".$_REQUEST['param'];
		$db->query($update);



		header('Location:'.BASE_URL_SITO.'disponibilita-camere/');		
	}


