<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'del_servizi_aggiuntivi'){

    $delete = "DELETE FROM hospitality_tipo_servizi  WHERE Id = ".$_REQUEST['Id']." AND idsito = ".$_REQUEST['idsito'];
    $dbMysqli->query($delete);

    $delete2 = "DELETE FROM hospitality_tipo_servizi_lingua  WHERE servizio_id = ".$_REQUEST['Id']." AND idsito = ".$_REQUEST['idsito'];
    $dbMysqli->query($delete2);
}


?>