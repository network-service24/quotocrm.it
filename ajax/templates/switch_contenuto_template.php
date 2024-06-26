<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'switch_contenuto_template'){
    $update = "UPDATE hospitality_contenuti_web SET Abilitato = ".$_REQUEST['Abilitato']." WHERE Id = ".$_REQUEST['Id'];
    $dbMysqli->query($update);
}


?>