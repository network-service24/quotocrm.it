<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_l'){

            $idsito          = $_REQUEST['idsito'];
            $IdNumeroListino = $_REQUEST['IdNumeroListino'];
            $IdSoggiorno     = $_REQUEST['IdSoggiorno'];
            $IdCamera        = $_REQUEST['IdCamera'];
            $PeriodoDal      = $_REQUEST['PeriodoDal'];
            $PeriodoAl       = $_REQUEST['PeriodoAl'];
            $PrezzoCamera    = str_replace(",",".",$_REQUEST['PrezzoCamera']);


            $insert ="INSERT INTO hospitality_listino_camere(idsito,IdNumeroListino,IdSoggiorno,IdCamera,PeriodoDal,PeriodoAl,PrezzoCamera,Abilitato) VALUES ('".$idsito."','".$IdNumeroListino."','".$IdSoggiorno."','".$IdCamera."','".$PeriodoDal."','".$PeriodoAl."','". $PrezzoCamera."','1')";
            $dbMysqli->query($insert);

	}
?>