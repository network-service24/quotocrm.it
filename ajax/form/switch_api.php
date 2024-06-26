<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'switch_api'){
    $update = "UPDATE siti SET API_hospitality = ".$_REQUEST['api']." WHERE idsito = ".$_REQUEST['idsito'];
    $dbMysqli->query($update);
}


?>