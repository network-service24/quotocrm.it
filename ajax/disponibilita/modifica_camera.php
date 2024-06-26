<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_camera'){

            $idsito     = $_REQUEST['idsito'];
            $Id         = $_REQUEST['Id'];
            $Abilitato  = $_REQUEST['Abilitato'];
            $Ordine     = $_REQUEST['Ordine'];
            $Servizi    = $dbMysqli->escape($_REQUEST['Servizi']);
            $TipoCamere = $dbMysqli->escape($_REQUEST['TipoCamere']);


            $update ="UPDATE hospitality_tipo_camere SET Servizi = '".$Servizi."',TipoCamere = '".$TipoCamere."',Ordine = '".$Ordine."', Abilitato = '". $Abilitato."' WHERE Id = ".$Id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}
?>