<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'del_pdi'){

    $delete = "DELETE FROM hospitality_pdi  WHERE Id = ".$_REQUEST['Id']." AND idsito = ".$_REQUEST['idsito'];
    $dbMysqli->query($delete);

    $delete2 = "DELETE FROM hospitality_pdi_lang  WHERE Id_pdi = ".$_REQUEST['Id']." AND idsito = ".$_REQUEST['idsito'];
    $dbMysqli->query($delete2);

}


?>