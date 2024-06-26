<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'switch_pl'){
    $update = "UPDATE hospitality_configurazioni SET valore = ".$_REQUEST['valore']." WHERE Id = ".$_REQUEST['id'];
    $dbMysqli->query($update);
}


?>