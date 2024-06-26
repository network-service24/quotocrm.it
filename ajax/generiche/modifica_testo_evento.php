<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_evento'){

            $idsito      = $_REQUEST['idsito'];
            $Id          = $_REQUEST['Id'];
            $evento      = $_REQUEST['evento'];
            $Id_eventi   = $_REQUEST['Id_eventi'];
            $Lingua      = $_REQUEST['Lingua'];
            $Titolo      = $dbMysqli->escape($_REQUEST['Titolo']);
            $Descrizione = $dbMysqli->escape($_REQUEST['Descrizione']);


            $update ="UPDATE hospitality_eventi_lang SET Lingua = '".$Lingua."', Titolo = '".$Titolo."', Descrizione = '".$Descrizione."' WHERE Id = ".$Id." AND idsito = ".$idsito."";
            $dbMysqli->query($update);

	}

#######################################################################################################################

header('Location:'.BASE_URL_SITO.'generiche-eventi_testi/'. $Id_eventi .'/'. $evento .'/');

#######################################################################################################################
?>