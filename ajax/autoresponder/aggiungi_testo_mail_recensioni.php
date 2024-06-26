<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_mail_recensioni'){

            $idsito        = $_REQUEST['idsito'];
            $id_dizionario = $_REQUEST['id_dizionario'];
            $lingua        = $_REQUEST['Lingua'];
            $oggetto       = $dbMysqli->escape($_REQUEST['testo']);


            $insert ="INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES ('".$id_dizionario."','".$idsito."','".$lingua."','". $oggetto."','1')";
            $dbMysqli->query($insert);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'autoresponder-configura_mail_recensioni/'. $id_dizionario .'/');

#######################################################################################################################
?>