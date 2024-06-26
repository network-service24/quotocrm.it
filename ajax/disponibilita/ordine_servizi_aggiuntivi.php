<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='order_servizi_aggiuntivi'){

            $idsito              = $_REQUEST['idsito'];
            $Id                  = $_REQUEST['Id'];
            $Ordine              = $_REQUEST['OrdineRow'];

            $update ="UPDATE hospitality_tipo_servizi SET Ordine = '". $Ordine."' WHERE Id = ".$Id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}
?>