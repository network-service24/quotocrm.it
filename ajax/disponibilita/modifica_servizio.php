<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_servizio'){

            $idsito    = $_REQUEST['idsito'];
            $Id        = $_REQUEST['Id'];
            $Abilitato = $_REQUEST['Abilitato'];
            $Servizio  = $dbMysqli->escape($_REQUEST['Servizio']);


            $update ="UPDATE hospitality_servizi_camera SET Servizio ='".$Servizio."', Abilitato = '". $Abilitato."' WHERE Id = ".$Id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}
?>