<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_pdi'){

            $idsito      = $_REQUEST['idsito'];
            $pdi         = $_REQUEST['pdi'];
            $Id_pdi      = $_REQUEST['Id_pdi'];
            $Lingua      = $_REQUEST['Lingua'];
            $Titolo      = $dbMysqli->escape($_REQUEST['Titolo']);
            $Descrizione = $dbMysqli->escape($_REQUEST['Descrizione']);


            $insert ="INSERT INTO hospitality_pdi_lang(Id_pdi,idsito,Lingua,Titolo,Descrizione) VALUES ('".$Id_pdi."','".$idsito."','".$Lingua."','". $Titolo."','". $Descrizione."')";
            $dbMysqli->query($insert);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'generiche-punti_interesse_testi/'.$Id_pdi.'/'. $pdi .'/');

#######################################################################################################################
?>