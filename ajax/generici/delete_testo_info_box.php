<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'del_t_ib'){

    $delete = "DELETE FROM hospitality_info_box_lang  WHERE Id = ".$_REQUEST['id']." AND idsito = ".$_REQUEST['idsito'];
    $dbMysqli->query($delete);
}


?>