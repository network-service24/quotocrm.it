<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'del_ta'){
    $delete = "DELETE FROM hospitality_target  WHERE id = ".$_REQUEST['id'];
    $dbMysqli->query($delete);

    ##LOGS OPERAZIONI
    $log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', eliminato target ID = '.$_REQUEST['id']);
    $log->lclose();
}


?>