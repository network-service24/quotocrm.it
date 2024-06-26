<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_l_camera'){

            $Id              = $_REQUEST['Id'];
            $idsito          = $_REQUEST['idsito'];
            $IdCamera        = $_REQUEST['IdCamera'];
            $IdSoggiorno     = $_REQUEST['IdSoggiorno'];
            $IdNumeroListino = $_REQUEST['IdNumeroListino'];
            $PeriodoDal      = $_REQUEST['PeriodoDal'];
            $PeriodoAl       = $_REQUEST['PeriodoAl'];
            $PrezzoCamera    = str_replace(",",".",$_REQUEST['PrezzoCamera']);

            $update ="UPDATE hospitality_listino_camere SET PeriodoDal ='".$PeriodoDal."', PeriodoAl = '". $PeriodoAl."', PrezzoCamera = '". $PrezzoCamera."', IdSoggiorno = '". $IdSoggiorno."', IdNumeroListino = '". $IdNumeroListino."' WHERE Id = ".$Id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}
?>