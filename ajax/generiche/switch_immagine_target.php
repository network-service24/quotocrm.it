<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'switch_immagine_target'){
    $update = "UPDATE hospitality_tipo_gallery_target SET Abilitato = ".$_REQUEST['Abilitato']." WHERE Id = ".$_REQUEST['Id'];
    $dbMysqli->query($update);
}


?>