<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_evento'){

            $idsito      = $_REQUEST['idsito'];
            $evento      = $_REQUEST['evento'];
            $Id_eventi   = $_REQUEST['Id_eventi'];
            $Lingua      = $_REQUEST['Lingua'];
            $Titolo      = $dbMysqli->escape($_REQUEST['Titolo']);
            $Descrizione = $dbMysqli->escape($_REQUEST['Descrizione']);


            $insert ="INSERT INTO hospitality_eventi_lang(Id_eventi,idsito,Lingua,Titolo,Descrizione) VALUES ('".$Id_eventi."','".$idsito."','".$Lingua."','". $Titolo."','". $Descrizione."')";
            $dbMysqli->query($insert);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'generiche-eventi_testi/'.$Id_eventi.'/'. $evento .'/');

#######################################################################################################################
?>