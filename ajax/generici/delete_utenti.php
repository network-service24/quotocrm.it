<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'del_utenti'){
    $delete = "DELETE FROM utenti_quoto  WHERE id = ".$_REQUEST['id'];
    $dbMysqli->query($delete);

    ##LOGS OPERAZIONI
    $log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', eliminati permessi ID utente = '.$_REQUEST['id']);
    $log->lclose(); 
}


?>