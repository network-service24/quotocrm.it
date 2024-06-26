<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'switch_listino'){
    $update = "UPDATE hospitality_numero_listini SET Abilitato = ".$_REQUEST['Abilitato']." WHERE Id = ".$_REQUEST['Id'];
    $dbMysqli->query($update);

    if($_REQUEST['Abilitato']==1){
        $update2 = "UPDATE hospitality_numero_listini SET Abilitato = 0 WHERE Id != ".$_REQUEST['Id'];
        $dbMysqli->query($update2);
    }

}


?>