<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'switch_inc_servizi_aggiuntivi'){
    $update = "UPDATE hospitality_tipo_servizi SET Obbligatorio = ".$_REQUEST['Obbligatorio']." WHERE Id = ".$_REQUEST['Id'];
    $dbMysqli->query($update);

    ##LOGS OPERAZIONI
    $log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].',  includi servizi aggiuntivo = '.$_REQUEST['Obbligatorio'].', ID_servizio = '.$_REQUEST['Id']);
    $log->lclose();    
}


?>