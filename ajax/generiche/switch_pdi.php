<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'switch_pdi'){
    $update = "UPDATE hospitality_pdi SET Abilitato = ".$_REQUEST['Abilitato']." WHERE Id = ".$_REQUEST['Id'];
    $dbMysqli->query($update);

    ##LOGS OPERAZIONI
    $log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', abilitato punto interesse = '.$_REQUEST['Abilitato'].', ID = '.$_REQUEST['Id']);
    $log->lclose();
}


?>