<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'del_scheda'){
    $delete = "DELETE FROM hospitality_checkin  WHERE Id = ".$_REQUEST['Id'];
    $dbMysqli->query($delete);
}


?>