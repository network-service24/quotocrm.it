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

    $idsito                   = $_REQUEST['idsito'];
    $AbilitatoLatoLandingPage = $_REQUEST['AbilitatoLatoLandingPage'];

    $update = "UPDATE hospitality_tipo_servizi_config SET AbilitatoLatoLandingPage = ".$AbilitatoLatoLandingPage." WHERE idsito = ".$idsito;
	$dbMysqli->query($update);

    ##LOGS OPERAZIONI
    $log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].',  abilita lato client i servizi aggiuntivi = '.$AbilitatoLatoLandingPage);
    $log->lclose();    
?>