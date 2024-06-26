<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_sc'){

				$update ="UPDATE hospitality_codice_sconto SET                                                   
														    cod           = '".$dbMysqli->escape($_REQUEST['cod'])."',
                                                            imp_sconto    = '".$dbMysqli->escape($_REQUEST['imp_sconto'])."',
                                                            data_inizio   = '".$_REQUEST['data_inizio']."',
                                                            data_fine     = '".$_REQUEST['data_fine']."',
                                                            note          = '".$dbMysqli->escape($_REQUEST['note'])."'
														WHERE
                                                            id =  ".$_REQUEST['id']."
                                                        AND
                                                            idsito = ".$_REQUEST['idsito'];

				$dbMysqli->query($update);


            ##LOGS OPERAZIONI
            $log->lwrite('idsito = '.$_REQUEST['idsito'].', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', Modificato Codice Sconto = '.$dbMysqli->escape($_REQUEST['cod']));
            $log->lclose();

	}

?>