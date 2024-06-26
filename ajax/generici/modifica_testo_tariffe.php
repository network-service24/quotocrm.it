<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_tariffe'){

            $idsito               = $_REQUEST['idsito'];
            $id                   = $_REQUEST['id'];
            $lingua               = $_REQUEST['lingua'];
            $tariffa              = $dbMysqli->escape($_REQUEST['tariffa']);
            $testo                = $dbMysqli->escape($_REQUEST['testo']);

           $update ="UPDATE hospitality_condizioni_tariffe_lingua  SET Lingua = '".$lingua."', tariffa = '".$tariffa."', testo = '".$testo."' WHERE id = ".$id." AND idsito =  ".$idsito;
                           
            $dbMysqli->query($update);

	}

?>