<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_policy'){

            $testo  = $dbMysqli->escape($_REQUEST['testo']);
            $id     = $_REQUEST['id'];
            $idsito = $_REQUEST['idsito'];

            $update ="  UPDATE 
                            hospitality_dizionario_lingua 
                        SET 
                            hospitality_dizionario_lingua.testo = '".$testo."',
                            hospitality_dizionario_lingua.data_modifica = '".date('Y-m-d')."'  
                        WHERE 
                            hospitality_dizionario_lingua.id =  ".$id." 
                        AND 
                            hospitality_dizionario_lingua.idsito = ".$idsito;
            $dbMysqli->query($update);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'impostazioni-privacy_policy/');

#######################################################################################################################
?>