<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_po'){

			$idsito = $_REQUEST['idsito'];
            $id     = $_REQUEST['id'];
            $tipo   = $_REQUEST['tipo'];
			$etichetta  = $dbMysqli->escape($_REQUEST['etichetta']);

            $update ="UPDATE hospitality_politiche SET etichetta   = '".$etichetta."', tipo = '".$tipo."' WHERE id =  ".$id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}

?>