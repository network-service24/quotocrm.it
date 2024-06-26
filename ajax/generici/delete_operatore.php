<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'del_op'){
    $delete = "DELETE FROM hospitality_operatori  WHERE id = ".$_REQUEST['id'];
    $dbMysqli->query($delete);

    ##LOGS OPERAZIONI
    $log->lwrite('idsito = '.$_REQUEST['idsito'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', ID_operatore_eliminato = '.$_REQUEST['id']);
    $log->lclose(); 
}


?>