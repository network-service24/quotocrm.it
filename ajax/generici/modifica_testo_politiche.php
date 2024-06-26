<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_policy'){

            $testo            = $dbMysqli->escape($_REQUEST['testo']);
            $id               = $_REQUEST['id'];
            $lingua           = $_REQUEST['Lingua'];
            $idsito           = $_REQUEST['idsito'];
            $id_politiche     = $_REQUEST['id_politiche'];

            $update ="  UPDATE hospitality_politiche_lingua  SET Lingua = '".$lingua."', testo =  '".$testo."' WHERE id = ".$id." AND idsito =  ".$idsito;
                           
            $dbMysqli->query($update);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'impostazioni-add_policy/'.$id_politiche.'/');

#######################################################################################################################
?>