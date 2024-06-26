<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'del_ft'){
    $delete = "DELETE FROM hospitality_fonti_prenotazione  WHERE id = ".$_REQUEST['id'];
    $dbMysqli->query($delete);
}


?>