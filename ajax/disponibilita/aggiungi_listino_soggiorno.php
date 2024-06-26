<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_l_soggiorno'){

            $idsito      = $_REQUEST['idsito'];
            $IdSoggiorno = $_REQUEST['IdSoggiorno'];
            $PeriodoDal  = $_REQUEST['PeriodoDal'];
            $PeriodoAl   = $_REQUEST['PeriodoAl'];
            $Prezzo      = str_replace(",",".",$_REQUEST['Prezzo']);


            $insert ="INSERT INTO hospitality_listino_soggiorni(IdSoggiorno,idsito,PeriodoDal,PeriodoAl,Prezzo,Abilitato) VALUES ('".$IdSoggiorno."','".$idsito."','".$PeriodoDal."','".$PeriodoAl."','". $Prezzo."','1')";
            $dbMysqli->query($insert);

	}
?>