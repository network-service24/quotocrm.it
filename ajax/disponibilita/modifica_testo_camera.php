<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_camera'){

            $idsito       = $_REQUEST['idsito'];
            $Id           = $_REQUEST['Id'];
            $camere_id   = $_REQUEST['camere_id'];
            $lingue      = $_REQUEST['lingue'];
            $Camera      = $dbMysqli->escape($_REQUEST['Camera']);
            $Descrizione = $dbMysqli->escape($_REQUEST['Descrizione']);


            $update ="UPDATE hospitality_camere_testo SET lingue = '".$lingue."', Camera = '".$Camera."', Descrizione = '".$Descrizione."' WHERE Id = ".$Id." AND idsito = ".$idsito."";
            $dbMysqli->query($update);

	}

#######################################################################################################################

header('Location:'.BASE_URL_SITO.'disponibilita-camere_testi/'. $camere_id .'/');

#######################################################################################################################
?>