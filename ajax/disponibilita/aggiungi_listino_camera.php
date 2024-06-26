<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_l_camera'){

            $idsito          = $_REQUEST['idsito'];
            $IdCamera        = $_REQUEST['IdCamera'];
            $IdSoggiorno     = $_REQUEST['IdSoggiorno'];
            $IdNumeroListino = $_REQUEST['IdNumeroListino'];
            $PeriodoDal      = $_REQUEST['PeriodoDal'];
            $PeriodoAl       = $_REQUEST['PeriodoAl'];
            $PrezzoCamera    = str_replace(",",".",$_REQUEST['PrezzoCamera']);


            $insert ="INSERT INTO hospitality_listino_camere(IdNumeroListino,IdSoggiorno,IdCamera,idsito,PeriodoDal,PeriodoAl,PrezzoCamera,Abilitato) VALUES ('".$IdNumeroListino."','".$IdSoggiorno."','".$IdCamera."','".$idsito."','".$PeriodoDal."','".$PeriodoAl."','". $PrezzoCamera."','1')";
            $dbMysqli->query($insert);

	}
?>