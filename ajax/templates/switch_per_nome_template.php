<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'switch_t'){
    $update = "UPDATE hospitality_template_background SET Visibile = 0 WHERE idsito = ".$_REQUEST['idsito']." AND TemplateName = '".$_REQUEST['nome']."'";
    $dbMysqli->query($update);
}


?>