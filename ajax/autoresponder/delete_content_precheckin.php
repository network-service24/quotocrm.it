<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'del_t_content'){

    $delete2 = "DELETE FROM hospitality_precheckin_lingua  WHERE id = ".$_REQUEST['id']." AND idsito = ".$_REQUEST['idsito'];
    $dbMysqli->query($delete2);
}


?>