<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_op'){



				$insert ="INSERT INTO hospitality_operatori(idsito,
                                                        img,
														NomeOperatore,
														EmailSegretaria,
														Abilitato) 
														VALUES ('".$_REQUEST['idsito']."',
                                                        '".$_REQUEST['img']."',
														'".$dbMysqli->escape($_REQUEST['NomeOperatore'])."',
														'".$dbMysqli->escape($_REQUEST['EmailOperatore'])."',
														'".$_REQUEST['Abilitato']."')";

				$dbMysqli->query($insert);

            ##LOGS OPERAZIONI
            $log->lwrite('idsito = '.$_REQUEST['idsito'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', nome_operatore = '.$dbMysqli->escape($_REQUEST['NomeOperatore']).', email_operatore = '.$dbMysqli->escape($_REQUEST['EmailOperatore']).', abilitato = '.$_REQUEST['Abilitato']);
            $log->lclose(); 

	}

?>