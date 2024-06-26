<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_camera'){

            $idsito     = $_REQUEST['idsito'];
            $Abilitato  = $_REQUEST['Abilitato'];
            $Ordine     = $_REQUEST['Ordine'];
            $Servizi    = $dbMysqli->escape($_REQUEST['Servizi']);
            $TipoCamere = $dbMysqli->escape($_REQUEST['TipoCamere']);

            $insert ="INSERT INTO hospitality_tipo_camere(idsito,Lingua,Servizi,TipoCamere,Ordine,Abilitato) VALUES ('".$idsito."','it','". $Servizi."','". $TipoCamere."','". $Ordine."','". $Abilitato."')";
            $dbMysqli->query($insert);

	}
?>