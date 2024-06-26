<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'switch_op'){
    $update = "UPDATE hospitality_operatori SET Abilitato = ".$_REQUEST['Abilitato']." WHERE id = ".$_REQUEST['id'];
    $dbMysqli->query($update);

    ##LOGS OPERAZIONI
    $log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].',  abilitato = '.$_REQUEST['Abilitato'].', ID_operatore = '.$_REQUEST['id']);
    $log->lclose(); 
}


?>