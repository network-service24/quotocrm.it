<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_checkinonline'){

            $id            = $_REQUEST['id'];
            $idsito        = $_REQUEST['idsito'];
            $abilita       = $_REQUEST['abilita'];
            $numero_giorni = $_REQUEST['numero_giorni'];

            $update ="UPDATE hospitality_giorni_checkinonline SET numero_giorni   = '".$numero_giorni."', abilita = '".$abilita."' WHERE id =  ".$id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

            ##LOGS OPERAZIONI
            $log->lwrite('idsito = '.$idsito.', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', numero_giorni = '.$numero_giorni.', abilita = '.$abilita);
            $log->lclose();

	}

?>