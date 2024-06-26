<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_politiche'){

            $idsito         = $_REQUEST['idsito'];
            $id_politiche   = $_REQUEST['id_politiche'];
            $lingua         = $_REQUEST['Lingua'];
            $testo          = $dbMysqli->escape($_REQUEST['testo']);

            $insert ="INSERT INTO hospitality_politiche_lingua(id_politiche,idsito,Lingua,testo) VALUES ('".$id_politiche."','".$idsito."','".$lingua."', '". $testo."')";
            $dbMysqli->query($insert);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'impostazioni-add_policy/'.$id_politiche.'/');

#######################################################################################################################
?>