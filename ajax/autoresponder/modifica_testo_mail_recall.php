<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_mail'){

            $id            = $_REQUEST['id'];
            $idsito        = $_REQUEST['idsito'];
            $id_dizionario = $_REQUEST['id_dizionario'];
            $lingua        = $_REQUEST['Lingua'];
            $testo         = $dbMysqli->escape($_REQUEST['testo']);

            $update ="  UPDATE hospitality_dizionario_lingua  SET Lingua = '".$lingua."', testo = '".$testo."' WHERE id = ".$id." AND idsito =  ".$idsito;
                           
            $dbMysqli->query($update);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'autoresponder-configura_mail_recall/'. $id_dizionario .'/');

#######################################################################################################################
?>