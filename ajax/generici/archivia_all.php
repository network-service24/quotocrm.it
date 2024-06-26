<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$checkbox_value = explode(',',$_REQUEST['checkbox_value']);
	$idsito         = $_REQUEST['idsito'];

	if(is_array($checkbox_value) && !empty($checkbox_value)){

		foreach ($checkbox_value as $key => $value) {
			if($value){
				$update = "UPDATE hospitality_guest SET Archivia = 1 WHERE Id = ".$value." AND idsito = ".$idsito;
				$dbMysqli->query($update);
				echo 'ok';
			}

		}

	}


?>
