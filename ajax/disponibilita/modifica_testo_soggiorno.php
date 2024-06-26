<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_soggiorno'){

            $idsito       = $_REQUEST['idsito'];
            $Id           = $_REQUEST['Id'];
            $soggiorni_id = $_REQUEST['soggiorni_id'];
            $lingue       = $_REQUEST['lingue'];
            $Soggiorno    = $dbMysqli->escape($_REQUEST['Soggiorno']);
            $Descrizione  = $dbMysqli->escape($_REQUEST['Descrizione']);


            $update ="UPDATE hospitality_tipo_soggiorno_lingua SET lingue = '".$lingue."', Soggiorno = '".$Soggiorno."', Descrizione = '".$Descrizione."' WHERE Id = ".$Id." AND idsito = ".$idsito."";
            $dbMysqli->query($update);

	}

#######################################################################################################################

header('Location:'.BASE_URL_SITO.'disponibilita-soggiorno_testi/'. $soggiorni_id .'/');

#######################################################################################################################
?>