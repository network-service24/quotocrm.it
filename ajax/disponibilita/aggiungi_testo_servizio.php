<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_t_servizio'){

            $idsito     = $_REQUEST['idsito'];
            $servizi_id = $_REQUEST['servizi_id'];
            $lingua     = $_REQUEST['lingua'];
            $Servizio   = $dbMysqli->escape($_REQUEST['Servizio']);


            $insert ="INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES ('".$servizi_id."','".$idsito."','".$lingua."','". $Servizio."')";
            $dbMysqli->query($insert);

	}
?>