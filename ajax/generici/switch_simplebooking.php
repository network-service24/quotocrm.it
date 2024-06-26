<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

if($_REQUEST['action'] == 'switch_sb'){
    $update = "UPDATE hospitality_simplebooking SET Abilitato = ".$_REQUEST['Abilitato']." WHERE Id = ".$_REQUEST['id'];
    $dbMysqli->query($update);

    ##LOGS OPERAZIONI
    $log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].',  abilita SimpleBooking = '.$_REQUEST['Abilitato']);
    $log->lclose(); 
}


?>