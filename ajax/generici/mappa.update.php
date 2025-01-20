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

    $idsito        = $_REQUEST['idsito'];
    $abilita_mappa = $_REQUEST['abilita_mappa'];
    $CIR           = $_REQUEST['CIR'];
    $CIN           = $_REQUEST['CIN'];
    if($CIR !=''){
        $andCir = ',CIR = "'.$CIR.'"';
    }else{
        $andCir = ',CIR = NULL';
    }
    if($CIN !=''){
        $andCin = ',CIN = "'.$CIN.'"';
    }else{
        $andCin = ',CIN = NULL';
    }
    $coordinate        = str_replace("(","",$_REQUEST['coordinate']);
    $coordinate        = str_replace(")","",$coordinate);
    $coordinate        = str_replace(",","",$coordinate);

	$update = "UPDATE siti SET coordinate = pointfromtext('POINT(".$coordinate.")') WHERE idsito = ".$idsito;
	$dbMysqli->query($update);

	$update2 = "UPDATE siti SET abilita_mappa = ".$abilita_mappa." $andCir $andCin WHERE idsito = ".$idsito;
	$dbMysqli->query($update2);

    ##LOGS OPERAZIONI
    $log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', abilita_mappa = '.$abilita_mappa);
    $log->lclose(); 

?>