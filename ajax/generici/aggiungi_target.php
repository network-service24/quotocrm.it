<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_ta'){

			$target_ = $fun->clean($_REQUEST['Target']);
			$target  = $dbMysqli->escape($target_ );

			$select ="SELECT * FROM hospitality_target WHERE idsito = ".$_REQUEST['idsito']." AND Target = '".$target."'";
			$result = $dbMysqli->query($select);

			if(sizeof($result) > 0){
			

				$insert ="INSERT INTO hospitality_target(idsito,
														Target,
														Abilitato) 
														VALUES ('".$_REQUEST['idsito']."',
														'Il Target cliente inserito era già presente, elimina questo record!',
														0)";

				$dbMysqli->query($insert);
		
			}else{

				$insert ="INSERT INTO hospitality_target(idsito,
														Target,
														Abilitato) 
														VALUES ('".$_REQUEST['idsito']."',
														'".$target."',
														'".$_REQUEST['Abilitato']."')";

				$dbMysqli->query($insert);

			}

            ##LOGS OPERAZIONI
            $log->lwrite('idsito = '.$_SESSION['IDSITO'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', aggiunto target = '.$target);
            $log->lclose();
	}

?>