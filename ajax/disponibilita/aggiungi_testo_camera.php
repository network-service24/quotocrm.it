<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_camera'){

            $idsito      = $_REQUEST['idsito'];
            $camere_id   = $_REQUEST['camere_id'];
            $lingue      = $_REQUEST['lingue'];
            $Camera      = $dbMysqli->escape($_REQUEST['Camera']);
            $Descrizione = $dbMysqli->escape($_REQUEST['Descrizione']);


            $insert ="INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES ('".$camere_id."','".$idsito."','".$lingue."','". $Camera."','". $Descrizione."')";
            $dbMysqli->query($insert);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'disponibilita-camere_testi/'. $camere_id .'/');

#######################################################################################################################
?>