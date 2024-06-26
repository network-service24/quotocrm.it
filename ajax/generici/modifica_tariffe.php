<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_ta'){

            $id           = $_REQUEST['id'];
            $idsito       = $_REQUEST['idsito'];
            $etichetta    = $dbMysqli->escape($_REQUEST['etichetta']);

            $update ="UPDATE hospitality_condizioni_tariffe SET etichetta   = '".$etichetta."' WHERE Id =  ".$id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}

?>