<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_servizio'){

            $idsito    = $_REQUEST['idsito'];
            $Abilitato = $_REQUEST['Abilitato'];
            $Servizio  = $dbMysqli->escape($_REQUEST['Servizio']);


            $insert ="INSERT INTO hospitality_servizi_camera(idsito,Lingua,Servizio,Abilitato) VALUES ('".$idsito."','it','". $Servizio."','". $Abilitato."')";
            $dbMysqli->query($insert);

	}
?>