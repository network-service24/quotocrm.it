<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

	$checkbox_op     = explode(',',$_REQUEST['checkbox_op']);
    $idsito          = $_REQUEST['idsito'];
    $id_operatore    = $_REQUEST['operatore'];

	if(is_array($checkbox_op) && !empty($checkbox_op)){ 
		foreach ($checkbox_op as $key => $value) {

	        $sel = "SELECT NomeOperatore,EmailSegretaria FROM hospitality_operatori WHERE Id = '".$id_operatore."' AND idsito = ".$idsito;
	        $res = $dbMysqli->query($sel);
	        $row = $res[0];
			
        	$dbMysqli->query("UPDATE hospitality_guest SET ChiPrenota = '".$row['NomeOperatore']."', EmailSegretaria = '".$row['EmailSegretaria']."' WHERE Id = '".$value."' AND idsito = ".$idsito);

		}
	}
?>