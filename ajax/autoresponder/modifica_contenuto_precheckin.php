<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_content'){

            $id            = $_REQUEST['id'];
            $idsito        = $_REQUEST['idsito'];
            $id_precheckin = $_REQUEST['id_precheckin'];
            $lingua        = $_REQUEST['Lingua'];
            $oggetto       = $dbMysqli->escape($_REQUEST['oggetto']);
            $testo       = $dbMysqli->escape($_REQUEST['testo']);

            $update ="  UPDATE hospitality_precheckin_lingua  SET Lingua = '".$lingua."', oggetto = '".$oggetto."', testo = '".$testo."' WHERE id = ".$id." AND idsito =  ".$idsito;
                           
            $dbMysqli->query($update);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'autoresponder-configura_contenuti_info_utili/'. $id_precheckin .'/');

#######################################################################################################################
?>