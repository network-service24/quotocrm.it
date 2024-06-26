<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_precheckin'){

            $id        = $_REQUEST['id'];
            $idsito    = $_REQUEST['idsito'];
            $abilitato = $_REQUEST['abilitato'];
            $etichetta = $_REQUEST['etichetta'];

            $update ="UPDATE hospitality_precheckin SET etichetta   = '".$etichetta."', abilitato = '".$abilitato."' WHERE id =  ".$id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

            ##LOGS OPERAZIONI
            $log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', etichetta = '.$etichetta.', abilitato = '.$abilitato);
            $log->lclose();

	}

?>