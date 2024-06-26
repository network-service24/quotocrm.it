<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_servizi'){

            $idsito      = $_REQUEST['idsito'];
            $Id          = $_REQUEST['Id'];
            $lingua      = $_REQUEST['lingua'];
            $Servizio    = $dbMysqli->escape($_REQUEST['Servizio']);
            $Descrizione = $dbMysqli->escape($_REQUEST['Descrizione']);

            $update ="UPDATE hospitality_tipo_servizi_lingua SET lingue = '".$lingua."', Servizio = '".$Servizio."', Descrizione = '".$Descrizione."' WHERE Id = ".$Id." AND idsito = ".$idsito."";
            $dbMysqli->query($update);

	}
?>