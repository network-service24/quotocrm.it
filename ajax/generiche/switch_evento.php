<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'switch_evento'){
    $update = "UPDATE hospitality_eventi SET Abilitato = ".$_REQUEST['Abilitato']." WHERE Id = ".$_REQUEST['Id'];
    $dbMysqli->query($update);

    ##LOGS OPERAZIONI
    $log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', abilitato evento = '.$_REQUEST['Abilitato'].', ID = '.$_REQUEST['Id']);
    $log->lclose();
}


?>