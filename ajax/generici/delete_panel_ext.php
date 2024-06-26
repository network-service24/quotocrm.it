<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'del_panel_ext'){
    $delete = "DELETE FROM hospitality_pannelli_esterni  WHERE idpannello = ".$_REQUEST['id'];
    $dbMysqli->query($delete);
}


?>