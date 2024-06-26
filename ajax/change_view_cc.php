<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

$idCarta     = $_REQUEST['idCarta'];

$update = 'UPDATE hospitality_carte_credito SET numero_carta  = "", visibile = 0  WHERE Id = ' .$idCarta;
$dbMysqli->query($update);


##LOGS OPERAZIONI
$log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', eliminata carta di credito ID Carta = '.$idCarta);
$log->lclose(); 

?>
