<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_box_info'){

            $idsito               = $_REQUEST['idsito'];
            $Id_infohotel         = $_REQUEST['Id_infohotel'];
            $lingua               = $_REQUEST['Lingua'];
            $titolo               = $dbMysqli->escape($_REQUEST['Titolo']);
            $descrizione          = $dbMysqli->escape($_REQUEST['Descrizione']);

            $insert ="INSERT INTO hospitality_boxinfo_checkin_lang(Id_infohotel,idsito,Lingua,Titolo,Descrizione) VALUES ('".$Id_infohotel."','".$idsito."','".$lingua."','". $titolo."','". $descrizione."')";
            $dbMysqli->query($insert);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'checkinonline-add_box_infox/'. $Id_infohotel .'/');

#######################################################################################################################
?>