<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

##LOGS OPERAZIONI
$log->lwrite('idsito = '.$_REQUEST['idsito'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].',  passaggio alla interfaccia = '.$_REQUEST['ui']);
$log->lclose();    

?>