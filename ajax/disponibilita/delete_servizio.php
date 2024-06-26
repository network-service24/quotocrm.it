<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'del_servizio'){

    $delete = "DELETE FROM hospitality_servizi_camera  WHERE Id = ".$_REQUEST['Id']." AND idsito = ".$_REQUEST['idsito'];
    $dbMysqli->query($delete);

    $delete2 = "DELETE FROM hospitality_servizi_camere_lingua  WHERE servizi_id = ".$_REQUEST['Id']." AND idsito = ".$_REQUEST['idsito'];
    $dbMysqli->query($delete2);
}


?>