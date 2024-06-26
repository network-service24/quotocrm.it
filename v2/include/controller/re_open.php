<?php
	if($_REQUEST['azione'] != '' && $_REQUEST['param'] != '' ){

        $query = 'UPDATE hospitality_guest SET Chiuso = 0, DataChiuso = NULL WHERE Id = '.$_REQUEST['param'];
        $db->query($query);



		header('Location:'.BASE_URL_SITO.'conferme/');		
	}


