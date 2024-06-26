<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'del_pa'){

    $delete = "DELETE FROM hospitality_tipo_pacchetto  WHERE Id = ".$_REQUEST['id']." AND idsito = ".$_REQUEST['idsito'];
    $dbMysqli->query($delete);

    $delete2 = "DELETE FROM hospitality_tipo_pacchetto_lingua  WHERE pacchetto_id = ".$_REQUEST['id']." AND idsito = ".$_REQUEST['idsito'];
    $dbMysqli->query($delete2);
}


?>