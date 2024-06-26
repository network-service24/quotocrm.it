<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_tabella_listino'){

            $idsito       = $_REQUEST['idsito'];
            $Id           = $_REQUEST['Id'];
            $IdSoggiorno  = $_REQUEST['IdSoggiorno'];
            $IdCamera     = $_REQUEST['IdCamera'];
            $PeriodoDal   = $_REQUEST['PeriodoDal'];
            $PeriodoAl    = $_REQUEST['PeriodoAl'];
            $PrezzoCamera = str_replace(",",".",$_REQUEST['PrezzoCamera']);


            $update ="UPDATE hospitality_listino_camere SET IdSoggiorno = ".$IdSoggiorno.", IdCamera = ".$IdCamera.", PeriodoDal = '".$PeriodoDal."', PeriodoAl = '".$PeriodoAl."', PrezzoCamera = '". $PrezzoCamera."' WHERE Id = ".$Id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}
?>