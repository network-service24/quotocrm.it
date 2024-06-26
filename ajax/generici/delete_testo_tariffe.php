<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'del_t_t'){

    $delete = "DELETE FROM hospitality_condizioni_tariffe_lingua  WHERE id = ".$_REQUEST['id']." AND idsito = ".$_REQUEST['idsito'];
    $dbMysqli->query($delete);
}


?>