<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_rp'){

            $id           = $_REQUEST['id'];
            $idsito       = $_REQUEST['idsito'];
            $abilita      = $_REQUEST['abilita'];
            $punteggio_da = $_REQUEST['punteggio_da'];
            $punteggio_a  = $_REQUEST['punteggio_a'];


            $update ="UPDATE hospitality_recensioni_range SET punteggio_da   = '".$punteggio_da."', punteggio_a   = '".$punteggio_a."', abilita = '".$abilita."' WHERE id =  ".$id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

            ##LOGS OPERAZIONI
            $log->lwrite('idsito = '.$idsito.', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', punteggio_da = '.$punteggio_da.', punteggio_a  = '.$punteggio_a.', abilita = '.$abilita);
            $log->lclose();
	}


?>