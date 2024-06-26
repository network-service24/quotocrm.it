<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_pdi'){

            $idsito      = $_REQUEST['idsito'];
            $Id          = $_REQUEST['Id'];
            $pdi         = $_REQUEST['pdi'];
            $Id_pdi      = $_REQUEST['Id_pdi'];
            $Lingua      = $_REQUEST['Lingua'];
            $Titolo      = $dbMysqli->escape($_REQUEST['Titolo']);
            $Descrizione = $dbMysqli->escape($_REQUEST['Descrizione']);


            $update ="UPDATE hospitality_pdi_lang SET Lingua = '".$Lingua."', Titolo = '".$Titolo."', Descrizione = '".$Descrizione."' WHERE Id = ".$Id." AND idsito = ".$idsito."";
            $dbMysqli->query($update);

	}

#######################################################################################################################

header('Location:'.BASE_URL_SITO.'generiche-punti_interesse_testi/'. $Id_pdi .'/'. $pdi .'/');

#######################################################################################################################
?>