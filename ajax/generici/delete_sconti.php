<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'del_sc'){
    $delete = "DELETE FROM hospitality_codice_sconto  WHERE id = ".$_REQUEST['id'];
    $dbMysqli->query($delete);

    ##LOGS OPERAZIONI
    $log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', Eliminato Codice Sconto ID = '.$_REQUEST['id']);
    $log->lclose();
}


?>