<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_content_precheckin'){

            $idsito        = $_REQUEST['idsito'];
            $id_precheckin = $_REQUEST['id_precheckin'];
            $lingua        = $_REQUEST['Lingua'];
            $oggetto       = $dbMysqli->escape($_REQUEST['oggetto']);
            $testo       = $dbMysqli->escape($_REQUEST['testo']);


            $insert ="INSERT INTO hospitality_precheckin_lingua(id_precheckin,idsito,Lingua,oggetto,testo) VALUES ('".$id_precheckin."','".$idsito."','".$lingua."','". $oggetto."','". $testo."')";
            $dbMysqli->query($insert);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'autoresponder-configura_contenuti_info_utili/'. $id_precheckin .'/');

#######################################################################################################################
?>