<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_servizi'){

            $idsito   = $_REQUEST['idsito'];
            $Id       = $_REQUEST['Id'];
            $lingua   = $_REQUEST['lingua'];
            $Servizio = $dbMysqli->escape($_REQUEST['Servizio']);


            $update ="UPDATE hospitality_servizi_camere_lingua SET lingue = '".$lingua."', Servizio = '".$Servizio."' WHERE Id = ".$Id." AND idsito = ".$idsito."";
            $dbMysqli->query($update);

	}
?>