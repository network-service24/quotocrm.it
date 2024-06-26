<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'switch_t'){
    $update = "UPDATE hospitality_template_background SET Visibile = ".$_REQUEST['Visibile']." WHERE Id = ".$_REQUEST['id'];
    $dbMysqli->query($update);
}


?>