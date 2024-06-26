<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_info_box'){

            $idsito               = $_REQUEST['idsito'];
            $Id_info_box          = $_REQUEST['Id_info_box'];
            $lingua               = $_REQUEST['Lingua'];
            $titolo               = $dbMysqli->escape($_REQUEST['Titolo']);
            $descrizione          = $dbMysqli->escape($_REQUEST['Descrizione']);

            $insert ="INSERT INTO hospitality_info_box_lang(Id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES ('".$Id_info_box."','".$idsito."','".$lingua."','". $titolo."','". $descrizione."')";
            $dbMysqli->query($insert);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'generiche-add_info_box/'. $Id_info_box .'/');

#######################################################################################################################
?>