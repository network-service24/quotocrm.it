<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_soggiorno'){

            $idsito       = $_REQUEST['idsito'];
            $soggiorni_id = $_REQUEST['soggiorni_id'];
            $lingue       = $_REQUEST['lingue'];
            $Soggiorno    = $dbMysqli->escape($_REQUEST['Soggiorno']);
            $Descrizione  = $dbMysqli->escape($_REQUEST['Descrizione']);


            $insert ="INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES ('".$soggiorni_id."','".$idsito."','".$lingue."','". $Soggiorno."','". $Descrizione."')";
            $dbMysqli->query($insert);

	}
#######################################################################################################################

header('Location:'.BASE_URL_SITO.'disponibilita-soggiorno_testi/'. $soggiorni_id .'/');

#######################################################################################################################
?>