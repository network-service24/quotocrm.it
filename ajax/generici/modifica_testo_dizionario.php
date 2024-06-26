<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_dizionario'){

            $testo            = $dbMysqli->escape($_REQUEST['testo']);
            $id               = $_REQUEST['id'];
            $lingua           = $_REQUEST['Lingua'];
            $idsito           = $_REQUEST['idsito'];
            $id_dizionario    = $_REQUEST['id_dizionario'];
            $etichetta        = $_REQUEST['etichetta'];

            $update ="  UPDATE hospitality_dizionario_lingua  SET Lingua = '".$lingua."', testo =  '".$testo."' WHERE id = ".$id." AND idsito =  ".$idsito;
                           
            $dbMysqli->query($update);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'setting-add_mod_dizionario/'.$id_dizionario.'/'.$etichetta.'/');

#######################################################################################################################
?>