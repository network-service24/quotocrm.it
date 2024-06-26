<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/class/MysqliDb.php");

$dbMysqli  = new MysqliDb (HOST, DB_USER, DB_PASSWORD, DATABASE);

if($_REQUEST['action']=='auth'){

    $usr 	   = $_REQUEST["usr"];
    $pws 	   = $_REQUEST["pws"];
	$idSito    = $_REQUEST["idsito"];
	$startDate = $_REQUEST["dal"];
	$endDate   = $_REQUEST["al"];
    $source    = $_REQUEST["source"];
    $medium    = $_REQUEST["medium"];
    $v         = $_REQUEST["lingua"];

    if($usr == "TOKEN2024nws#" && $pws == "apiServiceNWS"){ 


        $sql = "SELECT SUM((p.PrezzoP)) as num
                    FROM hospitality_guest g
            INNER JOIN hospitality_proposte p ON p.id_richiesta = g.Id
            INNER JOIN hospitality_utm_ads ad ON (ad.NumeroPrenotazione = g.NumeroPrenotazione AND ad.idsito = g.idsito)
                WHERE ((g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate') OR (DATE(g.DataChiuso)>= '$startDate' AND DATE(g.DataChiuso) <= '$endDate'))
                    AND g.FontePrenotazione = 'Sito Web'
                    AND g.Disdetta = 0
                    AND g.NoDisponibilita = 0
                    AND g.Hidden = 0
                    AND g.TipoRichiesta = 'Conferma' 
                    AND g.Lingua  = '$v'
                    AND g.idsito = $idSito
                    AND ad.idsito = $idSito
                    AND ad.utm_source = '$source'
                    AND ad.utm_medium = '$medium'                                        
                    AND ad.utm_campaign NOT LIKE '%brand%'";

        $rw = $dbMysqli->query($sql);

		if(sizeof($rw) > 0 ){

			echo $rw[0]['num'];

		}else{

			echo 0;

		}						



                
    }else{ 

        echo 'Accesso non autorizzato | API QUOTO! | by Network Service srl';
        exit;
    }

}else{ 

	echo 'Accesso non autorizzato | API QUOTO! | by Network Service srl';
	exit;
}