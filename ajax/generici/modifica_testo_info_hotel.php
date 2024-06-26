<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_info_hotel'){

            $id                   = $_REQUEST['id'];
            $idsito               = $_REQUEST['idsito'];
            $Id_infohotel         = $_REQUEST['Id_infohotel'];
            $lingua               = $_REQUEST['Lingua'];
            $titolo               = $dbMysqli->escape($_REQUEST['Titolo']);
            $descrizione          = $dbMysqli->escape($_REQUEST['Descrizione']);

            $update ="  UPDATE hospitality_infohotel_lang  SET Lingua = '".$lingua."', Titolo = '".$titolo."', Descrizione = '".$descrizione."' WHERE Id = ".$id." AND idsito =  ".$idsito;
                           
            $dbMysqli->query($update);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'generiche-add_infohotel/'. $Id_infohotel .'/');

#######################################################################################################################
?>