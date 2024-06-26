<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_op'){



				$update ="UPDATE hospitality_operatori SET                                                   
                                                            img             =  '".$_REQUEST['img']."',
														    NomeOperatore   = '".$dbMysqli->escape($_REQUEST['NomeOperatore'])."',
														    EmailSegretaria = '".$dbMysqli->escape($_REQUEST['EmailOperatore'])."'
														WHERE
                                                            Id =  ".$_REQUEST['id']."
                                                        AND
                                                            idsito = ".$_REQUEST['idsito'];

				$dbMysqli->query($update);

            ##LOGS OPERAZIONI
            $log->lwrite('idsito = '.$_REQUEST['idsito'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', nome_operatore = '.$dbMysqli->escape($_REQUEST['NomeOperatore']).', email_operatore = '.$dbMysqli->escape($_REQUEST['EmailOperatore']));
            $log->lclose(); 

	}

?>