<?php

/**
 * CRM and CMS
 * @author Marcello Visigalli <a marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CRUD for insert, update, delete query in ajax
 */
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

    $idsito            = $_REQUEST['idsito'];
    $CheckNumberRows   = $_REQUEST['CheckNumberRows'];

    $update = "UPDATE siti SET CheckNumberRows = ".$CheckNumberRows." WHERE idsito = ".$idsito;
	$dbMysqli->query($update);

    ##LOGS OPERAZIONI
    $log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].',  limita visualizzazione record = '.$CheckNumberRows);
    $log->lclose();    
?>