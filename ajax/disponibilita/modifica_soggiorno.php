<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_soggiorno'){

            $idsito        = $_REQUEST['idsito'];
            $Id            = $_REQUEST['Id'];
            $Abilitato     = $_REQUEST['Abilitato'];
            $TipoSoggiorno = $dbMysqli->escape($_REQUEST['TipoSoggiorno']);


            $update ="UPDATE hospitality_tipo_soggiorno SET TipoSoggiorno ='".$TipoSoggiorno."', Abilitato = '". $Abilitato."' WHERE Id = ".$Id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}
?>