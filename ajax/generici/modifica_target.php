<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_ta'){

			$target_ = $fun->clean($_REQUEST['Target']);
			$target  = $dbMysqli->escape($target_ );

			$update ="UPDATE hospitality_target SET                                                   
														Target   = '".$target."'
													WHERE
														Id =  ".$_REQUEST['id']."
													AND
														idsito = ".$_REQUEST['idsito'];

			$dbMysqli->query($update);

            ##LOGS OPERAZIONI
            $log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', modifica target = '.$target.', ID = '.$_REQUEST['id']);
            $log->lclose();


	}

?>