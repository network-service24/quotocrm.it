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
    $campaign  = $_REQUEST["campaign"];

    if($usr == "TOKEN2024nws#" && $pws == "apiServiceNWS"){ 


        $sql1 = "SELECT g.Id
                        FROM hospitality_guest g 
                INNER JOIN hospitality_proposte p ON g.ID = p.id_richiesta
                INNER JOIN hospitality_utm_ads ad ON ad.NumeroPrenotazione = g.NumeroPrenotazione 
                                                                    AND ad.idsito = $idSito  
                                                                    AND ad.utm_source = '$source' 
                                                                    AND ad.utm_medium = '$medium' 
                                                                    AND ad.utm_campaign = '$campaign' 
                                                                    AND DATE(ad.data_operazione) BETWEEN '$startDate' AND '$endDate' 
                    WHERE ((g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate') OR (DATE(g.DataChiuso)>= '$startDate' AND DATE(g.DataChiuso) <= '$endDate'))
                        AND g.idsito = $idSito
                        AND g.Disdetta = 0
                        AND g.NoDisponibilita = 0 
                        AND g.FontePrenotazione LIKE '%Sito Web%'
                        AND g.Hidden = 0 
                        AND g.TipoRichiesta = 'Conferma'      
                    GROUP BY g.Id";

        $sql = "SELECT COUNT(DISTINCT(sub.Id)) as num
                    FROM (
                    $sql1
                    UNION
                    SELECT g.Id
                        FROM hospitality_tracking_ads ads
                INNER JOIN hospitality_guest g ON ads.NumeroPrenotazione = g.NumeroPrenotazione
                                            AND g.FontePrenotazione = 'Sito Web'                                               
                                            AND g.idsito = $idSito
                                            AND ((g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate') OR (DATE(g.DataChiuso)>= '$startDate' AND DATE(g.DataChiuso) <= '$endDate'))
                                            AND g.Hidden = 0
                                            AND g.NoDisponibilita = 0
                                            AND g.Disdetta = 0
                                            AND g.TipoRichiesta = 'Conferma'
                INNER JOIN hospitality_proposte p ON g.Id = p.id_richiesta                                                                                   
                    WHERE ads.idsito = $idSito
                        AND ads.Tracking = '$source'
                        AND ads.Campagna = '$campaign'
                        AND g.Id NOT IN ($sql1)  
                    GROUP BY g.Id
                ) as sub";


        $result = $dbMysqli->query($sql);
        echo count($result) > 0 ? $result[0]['num'] : 0;					



                
    }else{ 

        echo 'Accesso non autorizzato | API QUOTO! | by Network Service srl';
        exit;
    }

}else{ 

	echo 'Accesso non autorizzato | API QUOTO! | by Network Service srl';
	exit;
}