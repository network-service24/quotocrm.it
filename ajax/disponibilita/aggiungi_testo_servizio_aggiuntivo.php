<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_t_servizio'){

            $idsito      = $_REQUEST['idsito'];
            $servizio_id = $_REQUEST['servizio_id'];
            $lingua      = $_REQUEST['lingua'];
            $Servizio    = $dbMysqli->escape($_REQUEST['Servizio']);
            $Descrizione = $dbMysqli->escape($_REQUEST['Descrizione']);

            $insert ="INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES ('".$servizio_id."','".$idsito."','".$lingua."','". $Servizio."','". $Descrizione."')";
            $dbMysqli->query($insert);

	}
?>