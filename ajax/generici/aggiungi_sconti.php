<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_sc'){



				$insert ="INSERT INTO hospitality_codice_sconto(idsito,
                                                                cod,
                                                                imp_sconto,
                                                                data_inizio,
                                                                data_fine,
                                                                note,
                                                                usato) 
														VALUES ('".$_REQUEST['idsito']."',
                                                                '".$dbMysqli->escape($_REQUEST['cod'])."',
                                                                '".$dbMysqli->escape($_REQUEST['imp_sconto'])."',
                                                                '".$_REQUEST['data_inizio']."',
                                                                '".$_REQUEST['data_fine']."',
                                                                '".$dbMysqli->escape($_REQUEST['note'])."',
                                                                '0')";

				$dbMysqli->query($insert);

        ##LOGS OPERAZIONI
        $log->lwrite('idsito = '.$_REQUEST['idsito'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', Creato Codice Sconto = '.$dbMysqli->escape($_REQUEST['cod']));
        $log->lclose();

	}

?>