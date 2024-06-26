<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


    $idsito      = $_REQUEST['idsito'];
    $TipoListino = $_REQUEST['TipoListino'];

    $update ="UPDATE hospitality_tipo_listino SET TipoListino = '".$TipoListino."' WHERE idsito = '".$idsito."'";
    $dbMysqli->query($update);

    if($TipoListino==1){
        $listino = 'a persona';
    }else{
        $listino = 'a camera'; 
    }

    ##LOGS OPERAZIONI
    $log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].',  tipo listino = '.$listino);
    $log->lclose();   
	
?>