<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'switch_soggiornoF'){
    $update = "UPDATE hospitality_tipo_soggiorno SET Abilitato_form = ".$_REQUEST['Abilitato_form']." WHERE Id = ".$_REQUEST['Id'];
    $dbMysqli->query($update);

    ##LOGS OPERAZIONI
    $log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].',  abilita vista soggiorno nel form = '.$_REQUEST['Abilitato_form'].', ID_soggiorno = '.$_REQUEST['Id']);
    $log->lclose();    
}


?>