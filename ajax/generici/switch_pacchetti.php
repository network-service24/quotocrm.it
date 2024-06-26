<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'switch_pa'){
    $update = "UPDATE hospitality_tipo_pacchetto SET Abilitato = ".$_REQUEST['Abilitato']." WHERE Id = ".$_REQUEST['id'];
    $dbMysqli->query($update);
}


?>