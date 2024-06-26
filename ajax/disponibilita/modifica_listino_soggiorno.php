<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_l_soggiorno'){

            $Id          = $_REQUEST['Id'];
            $idsito      = $_REQUEST['idsito'];
            $IdSoggiorno = $_REQUEST['IdSoggiorno'];
            $PeriodoDal  = $_REQUEST['PeriodoDal'];
            $PeriodoAl   = $_REQUEST['PeriodoAl'];
            $Prezzo      = str_replace(",",".",$_REQUEST['Prezzo']);

            $update ="UPDATE hospitality_listino_soggiorni SET PeriodoDal ='".$PeriodoDal."', PeriodoAl = '". $PeriodoAl."', Prezzo = '". $Prezzo."' WHERE Id = ".$Id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}
?>