<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'switch_ta'){
    $update = "UPDATE hospitality_target SET Abilitato = ".$_REQUEST['Abilitato']." WHERE id = ".$_REQUEST['id'];
    $dbMysqli->query($update);
    
    ##LOGS OPERAZIONI
    $log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', abilitato target = '.$_REQUEST['Abilitato'].', ID = '.$_REQUEST['id']);
    $log->lclose();
}


?>