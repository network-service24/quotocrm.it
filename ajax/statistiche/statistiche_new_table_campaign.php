<?php
include($_SERVER['DOCUMENT_ROOT'] . '/include/settings.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/class/MysqliDb.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ajax/statistiche/ajax_utils.php');

$usernameQ = DB_USER;
$passwordQ = DB_PASSWORD;
$hostQ = HOST;
$dbnameQ = DATABASE;

$db = new MysqliDb($hostQ, $usernameQ, $passwordQ, $dbnameQ);

$idSito = $_POST['id_sito'];
$filter = $_POST['filter']; // vuoto per tabella principale ; 'annulled' per la tabella delle Annullate
$methodStr = $_POST['method'];
$channelStr = $_POST['channel'];
$startDateStr = $_POST['start'];
$endDateStr = $_POST['end'];
$compareStr = $_POST['compare'];
$compareStartDateStr = $_POST['compare_start'];
$compareEndDateStr = $_POST['compare_end'];

// verifiche di validazione dei dati
if (empty($idSito) || empty($startDateStr) || empty($endDateStr)) {
    AjaxUtils::returnJsonHttpResponse([]);
}
$source = '';
$medium = '';
if (!empty($channelStr)) {
    $source = explode(' ', $channelStr)[0];
    $medium = explode(' ', $channelStr)[1];
}

$sql = '';
$data = [];
if (empty($filter)) { // TABELLA PRINCIPALE

    // ricavo tutte le campagne
/*     $sql = "SELECT cd.campaign as campagna,
                   cd.clientid
              FROM hospitality_custom_dimension cd
             WHERE cd.idsito = $idSito
               AND cd.source = '$source'
               AND cd.medium = '$medium'
               AND cd.campaign != '(not set)'
          GROUP BY cd.campaign
             UNION
            SELECT ads.Campagna as campagna,
                   cid.CLIENT_ID as clientid
              FROM hospitality_tracking_ads ads
        INNER JOIN hospitality_guest g ON ads.NumeroPrenotazione = g.NumeroPrenotazione
                                      AND g.FontePrenotazione = '$methodStr'
                                      AND g.idsito = $idSito
                                      AND ((g.DataRichiesta BETWEEN '$startDateStr' AND '$endDateStr' AND g.TipoRichiesta = 'Conferma')
                                        OR (DATE(g.DataChiuso) BETWEEN '$startDateStr' AND '$endDateStr'))
                                      AND g.Hidden = 0                                                                            
        INNER JOIN hospitality_client_id cid ON cid.NumeroPrenotazione = ads.NumeroPrenotazione
                                    AND cid.idsito = $idSito                                    
     WHERE ads.idsito = $idSito
       AND ads.Tracking = '$source'
       AND ads.Campagna != ''
  GROUP BY ads.Campagna"; */

      $sql = "SELECT cd.campaign as campagna,
                   cd.clientid
              FROM hospitality_custom_dimension cd
             WHERE cd.idsito = $idSito
               AND cd.source = '$source'
               AND cd.medium = '$medium'
               AND cd.campaign != '(not set)'
          GROUP BY cd.campaign";
    $resultCampaigns = $db->query($sql);
    $resultDb = [];

    // Dati per calcolare il fatturato telefonico come ripartizione
    $fatturatoTelefonicoTotale = getFatturatoTotale($db, $startDateStr, $endDateStr, $idSito, 'telefon%');
    $fatturatoSitoWeb = getFatturatoTotale($db, $startDateStr, $endDateStr, $idSito, '%sito web%');
    $fatturatoTotale = getFatturatoTotale($db, $startDateStr, $endDateStr, $idSito, '%');
    $fatturattoSenzaTelefono = $fatturatoTotale - $fatturatoTelefonicoTotale;
    $fatturatoSitoPerc = $fatturatoSitoWeb * 100 / $fatturattoSenzaTelefono;
    $fatturatoDaRipartire = $fatturatoTelefonicoTotale * $fatturatoSitoPerc / 100;

    $fatturatoFormChannel = getFatturatoChannel($db, $startDateStr, $endDateStr, $idSito, 'sito%', $channelStr);

    // per ogni campagna ricavo i dati per le varie colonne
    foreach ($resultCampaigns as $campaign) {
        $budget = getCampaignBudget($db, $campaign['campagna'], $startDateStr, $endDateStr);
        $richieste = getCampaignRequests($db, $campaign['campagna'], $startDateStr, $endDateStr);
        $inviati = getCampaignSent($db, $campaign['campagna'], $startDateStr, $endDateStr);
        $confermati = getCampaignConfirmed($db, $campaign['campagna'], $startDateStr, $endDateStr);
        $fatturato = getCampaignPrice($db, $campaign['campagna'], $startDateStr, $endDateStr);
        $fatturatobe = getCampaignFatturatoBE($db, $campaign['campagna'], $startDateStr, $endDateStr);

        $fatturatoPerc = $fatturato * 100 / $fatturatoFormChannel;
        $fatturatotel = $fatturatoDaRipartire * $fatturatoPerc / 100;
        $fatturatotel = is_nan($fatturatotel) ? '0,00' : $fatturatotel;

        $conversione = $confermati / $inviati * 100;

        $resultDb[$campaign['campagna']] = [
            'campagna' => $campaign['campagna'],
            'budget' => $budget,
            'richieste' => $richieste,
            'inviati' => $inviati,
            'confermati' => $confermati,
            'conversione' => is_nan($conversione) ? 0 : $conversione,
            'fatturato' => $fatturato,
            'fatturatobe' => $fatturatobe,
            'fatturatotel' => $fatturatotel,
        ];
    }

    // Senza compare - Formatto i dati
    foreach ($resultDb as $row) {
        // Issue #14 - Inserisco solo le righe che non hanno tutto a ZERO
        if ($row['budget'] != 0 || $row['richieste'] != 0 || $row['fatturato'] != 0 || $row['fatturatobe'] != 0 || $row['fatturatotel'] != 0) {
            $data['data'][] = array(
                $row['campagna'],
                number_format($row['budget'], 2, ',', '.'),
                $row['richieste'],
                $row['inviati'],
                $row['confermati'],
                number_format($row['conversione'], 2, ',', '.'),
                number_format($row['fatturato'], 2, ',', '.'),
                number_format($row['fatturatobe'], 2, ',', '.'),
                number_format($row['fatturatotel'], 2, ',', '.'),
            );
        }
    }
} else { // TABELLA ANNULLATE
    $annullateSql = "SELECT cd.campaign as 'campagna',
                   cd.clientid
              FROM hospitality_custom_dimension cd
             WHERE cd.idsito = $idSito
               AND cd.source = '$source'
               AND cd.medium = '$medium'               
          GROUP BY cd.campaign";
    $annullateResultCampaigns = $db->query($annullateSql);
    $annullateResultDb = [];

    foreach ($annullateResultCampaigns as $campaign) {
        $annullateRowRichieste = getCampaignConfirmed($db, $campaign['campagna'], $startDateStr, $endDateStr, 1);
        $annullateRowFatturato = getCampaignPrice($db, $campaign['campagna'], $startDateStr, $endDateStr, 1);

        $annullateResultDb[$campaign['campagna']] = [
            'campagna' => $campaign['campagna'],
            'richieste' => $annullateRowRichieste,
            'fatturato' => $annullateRowFatturato,
        ];
    }

    // Annullate - No compare - formattazione dati
    foreach ($annullateResultDb as $row) {
        if (!empty($row['richieste']) || $row['fatturato'] != 0) {
            $data['data'][] = array(
                $row['campagna'],
                empty($row['richieste']) ? 0 : $row['richieste'],
                number_format($row['fatturato'], 2, ',', '.'),
            );
        }
    }
}
// Dati statici per test
//$data = ['data' => [
//    ["Telefono", rand(1, 100), rand(1, 50), rand(1, 25), rand(1, 100), rand(200, 10000)],
//    ["Email", rand(1, 100), rand(1, 50), rand(1, 25), rand(1, 100), rand(200, 10000)],
//    ["Chat", rand(1, 100), rand(1, 50), rand(1, 25), rand(1, 100), rand(200, 10000)],
//    ["Walk In", rand(1, 100), rand(1, 50), rand(1, 25), rand(1, 100), rand(200, 10000)],
//    ["Portali", rand(1, 100), rand(1, 50), rand(1, 25), rand(1, 100), rand(200, 10000)],
//    ["Altro", rand(1, 100), rand(1, 50), rand(1, 25), rand(1, 100), rand(200, 10000)],
//    ["Booking Engine", rand(1, 100), rand(1, 50), rand(1, 25), rand(1, 100), rand(200, 10000)],
//    ["Sito Web", rand(1, 100), rand(1, 50), rand(1, 25), rand(1, 100), rand(200, 10000)],
//]];

AjaxUtils::returnJsonHttpResponse($data);

function getCampaignRequests($db, $campaign, $startDate, $endDate)
{
    $idSito = $_POST['id_sito'];
    $method = $_POST['method'];
    $channelStr = $_POST['channel'];

    $source = '';
    $medium = '';
    if (!empty($channelStr)) {
        $source = explode(' ', $channelStr)[0];
        $medium = explode(' ', $channelStr)[1];
    }

    $sql1 = "   SELECT g.Id
                  FROM hospitality_guest g 
             LEFT JOIN hospitality_proposte p ON g.ID = p.id_richiesta
            INNER JOIN hospitality_client_id cid ON cid.NumeroPrenotazione = g.NumeroPrenotazione 
                                                        AND cid.idsito = $idSito                                                         
            INNER JOIN hospitality_custom_dimension cd ON cd.clientid = cid.CLIENT_ID 
                                                              AND cd.idsito = $idSito  
                                                              AND cd.source = '$source' 
                                                              AND cd.medium = '$medium' 
                                                              AND cd.campaign = '$campaign'                                                              
                 WHERE (g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate')
                   AND g.idsito = $idSito
                   AND g.FontePrenotazione LIKE '%sito web%'
                   AND g.TipoRichiesta = 'Preventivo'
                   AND g.Hidden = 0 
              GROUP BY g.Id";

    $sql2 = "   SELECT g.Id
                  FROM hospitality_guest g 
             LEFT JOIN hospitality_proposte p ON g.ID = p.id_richiesta
            INNER JOIN hospitality_client_id cid ON cid.NumeroPrenotazione = g.NumeroPrenotazione 
                                                        AND cid.idsito = $idSito                                                         
            INNER JOIN hospitality_custom_dimension cd ON cd.clientid = cid.CLIENT_ID 
                                                              AND cd.idsito = $idSito  
                                                              AND cd.source = '$source' 
                                                              AND cd.medium = '$medium' 
                                                              AND cd.campaign <> '$campaign'                                                              
                 WHERE (g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate')
                   AND g.idsito = $idSito
                   AND g.FontePrenotazione LIKE '%sito web%'
                   AND g.TipoRichiesta = 'Preventivo'
                   AND g.Hidden = 0 
              GROUP BY g.Id";

    $sql = "SELECT COUNT(DISTINCT(sub.Id)) as num
              FROM (
                  $sql1 
                  UNION
                 SELECT g.Id
                   FROM hospitality_tracking_ads ads
             INNER JOIN hospitality_guest g ON ads.NumeroPrenotazione = g.NumeroPrenotazione
                                           AND g.FontePrenotazione = '$method'                                               
                                           AND g.idsito = $idSito
                                           AND g.DataRichiesta >= '$startDate'
                                           AND g.DataRichiesta <= '$endDate'
                                           AND g.Hidden = 0
                                           AND g.TipoRichiesta = 'Preventivo'                      
             INNER JOIN hospitality_proposte p ON g.Id = p.id_richiesta                                                                                   
                  WHERE ads.idsito = $idSito
                    AND ads.Tracking = '$source'
                    AND ads.Campagna = '$campaign'
                    AND g.Id NOT IN ($sql1)
                    AND g.Id NOT IN ($sql2)
               GROUP BY g.Id
          ) as sub";

    $result = $db->query($sql);
    return count($result) > 0 ? $result[0]['num'] : 0;
}

function getCampaignSent($db, $campaign, $startDate, $endDate)
{
    $idSito = $_POST['id_sito'];
    $method = $_POST['method'];
    $channelStr = $_POST['channel'];

    $source = '';
    $medium = '';
    if (!empty($channelStr)) {
        $source = explode(' ', $channelStr)[0];
        $medium = explode(' ', $channelStr)[1];
    }

    $sql1 = "SELECT g.Id
                  FROM hospitality_guest g 
            INNER JOIN hospitality_proposte p ON g.ID = p.id_richiesta
            INNER JOIN hospitality_client_id cid ON cid.NumeroPrenotazione = g.NumeroPrenotazione 
                                                        AND cid.idsito = $idSito                                                         
            INNER JOIN hospitality_custom_dimension cd ON cd.clientid = cid.CLIENT_ID 
                                                              AND cd.idsito = $idSito  
                                                              AND cd.source = '$source' 
                                                              AND cd.medium = '$medium' 
                                                              AND cd.campaign = '$campaign'                                                                
                 WHERE (g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate')
                   AND g.idsito = $idSito
                   AND g.FontePrenotazione LIKE '%sito web%'
                   AND g.Hidden = 0 
                   AND g.Inviata = 1 
              GROUP BY g.Id";

    $sql2 = "SELECT g.Id
                  FROM hospitality_guest g 
            INNER JOIN hospitality_proposte p ON g.ID = p.id_richiesta
            INNER JOIN hospitality_client_id cid ON cid.NumeroPrenotazione = g.NumeroPrenotazione 
                                                        AND cid.idsito = $idSito                                                         
            INNER JOIN hospitality_custom_dimension cd ON cd.clientid = cid.CLIENT_ID 
                                                              AND cd.idsito = $idSito  
                                                              AND cd.source = '$source' 
                                                              AND cd.medium = '$medium' 
                                                              AND cd.campaign <> '$campaign'                                                                
                 WHERE (g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate')
                   AND g.idsito = $idSito
                   AND g.FontePrenotazione LIKE '%sito web%'
                   AND g.Hidden = 0 
                   AND g.Inviata = 1 
              GROUP BY g.Id";

    $sql = "SELECT COUNT(DISTINCT(sub.Id)) as num
              FROM (
                 $sql1
                 UNION
                SELECT g.Id
                  FROM hospitality_tracking_ads ads
            INNER JOIN hospitality_guest g ON ads.NumeroPrenotazione = g.NumeroPrenotazione
                                       AND g.FontePrenotazione = '$method'                                               
                                       AND g.idsito = $idSito
                                       AND g.DataRichiesta >= '$startDate'
                                       AND g.DataRichiesta <= '$endDate'
                                       AND g.Hidden = 0
                                       AND g.Inviata = 1
            INNER JOIN hospitality_proposte p ON g.Id = p.id_richiesta                                                                                   
                 WHERE ads.idsito = $idSito
                   AND ads.Tracking = '$source'
                   AND ads.Campagna = '$campaign'
                   AND g.Id NOT IN ($sql1)
                   AND g.Id NOT IN ($sql2)
              GROUP BY g.Id
          ) as sub";

    $result = $db->query($sql);
    return count($result) > 0 ? $result[0]['num'] : 0;
}

function getCampaignConfirmed($db, $campaign, $startDate, $endDate, $noDisponibilita = 0)
{
    $idSito = $_POST['id_sito'];
    $method = $_POST['method'];
    $channelStr = $_POST['channel'];

    $source = '';
    $medium = '';
    if (!empty($channelStr)) {
        $source = explode(' ', $channelStr)[0];
        $medium = explode(' ', $channelStr)[1];
    }

    $sql1 = "SELECT g.Id
                  FROM hospitality_guest g 
            INNER JOIN hospitality_proposte p ON g.ID = p.id_richiesta
            INNER JOIN hospitality_client_id cid ON cid.NumeroPrenotazione = g.NumeroPrenotazione AND cid.idsito = $idSito                                                         
            INNER JOIN hospitality_custom_dimension cd ON cd.clientid = cid.CLIENT_ID 
                                                      AND cd.idsito = $idSito  
                                                      AND cd.source = '$source' 
                                                      AND cd.medium = '$medium' 
                                                      AND cd.campaign = '$campaign'         
                 WHERE g.idsito = $idSito
                   AND g.FontePrenotazione LIKE '%sito web%'                   
                   AND g.Hidden = 0                                                  
                   AND g.NoDisponibilita=$noDisponibilita 
                   AND g.Disdetta=0
                   AND g.TipoRichiesta = 'Conferma'                    
                   AND ( (g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate') OR (DATE(g.DataChiuso) >= '$startDate' AND DATE(g.DataChiuso) <= '$endDate') )
                                                   
              GROUP BY g.Id";

    // esclude su hospitality_tracking_ads tutte le prenotazioni delle altre campagne di hospitality_custom_dimension
    $sql2 = "SELECT g.Id
                  FROM hospitality_guest g 
            INNER JOIN hospitality_proposte p ON g.ID = p.id_richiesta
            INNER JOIN hospitality_client_id cid ON cid.NumeroPrenotazione = g.NumeroPrenotazione AND cid.idsito = $idSito                                                         
            INNER JOIN hospitality_custom_dimension cd ON cd.clientid = cid.CLIENT_ID 
                                                      AND cd.idsito = $idSito  
                                                      AND cd.source = '$source' 
                                                      AND cd.medium = '$medium' 
                                                      AND cd.campaign <> '$campaign'
                 WHERE g.idsito = $idSito
                   AND g.FontePrenotazione LIKE '%sito web%'
                   AND g.Hidden = 0
                   AND g.NoDisponibilita=$noDisponibilita 
                   AND g.Disdetta=0
                   AND g.TipoRichiesta = 'Conferma'                    
                   AND ( (g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate') OR (DATE(g.DataChiuso) >= '$startDate' AND DATE(g.DataChiuso) <= '$endDate') )                   
              GROUP BY g.Id";

//    $sql = "SELECT COUNT(DISTINCT(sub.Id)) as num
//              FROM (
//                 $sql1
//                 UNION
//                SELECT g.Id
//                  FROM hospitality_tracking_ads ads
//            INNER JOIN hospitality_guest g ON ads.NumeroPrenotazione = g.NumeroPrenotazione
//                                       AND g.FontePrenotazione = '$method'
//                                       AND g.idsito = $idSito
//                                       AND ((g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate') OR (DATE(g.DataChiuso) >= '$startDate' AND DATE(g.DataChiuso) <= '$endDate'))
//                                       AND g.Hidden = 0
//            INNER JOIN hospitality_proposte p ON g.Id = p.id_richiesta
//                 WHERE ads.idsito = $idSito
//                   AND ads.Tracking = '$source'
//                   AND ads.Campagna = '$campaign'
//                   AND g.Id NOT IN ($sql1)
//                   AND g.Id NOT IN ($sql2)
//              GROUP BY g.Id
//          ) as sub";

    $sql = "SELECT COUNT(id) as num
              FROM (
           SELECT g.Id as id
                  FROM hospitality_guest g 
            INNER JOIN hospitality_proposte p ON g.ID = p.id_richiesta
            INNER JOIN hospitality_client_id cid ON cid.NumeroPrenotazione = g.NumeroPrenotazione AND cid.idsito = $idSito                                                         
            INNER JOIN hospitality_custom_dimension cd ON cd.clientid = cid.CLIENT_ID 
                                                      AND cd.idsito = $idSito  
                                                      AND cd.source = '$source' 
                                                      AND cd.medium = '$medium' 
                                                      AND cd.campaign = '$campaign'         
                                                      AND cd.urlpath LIKE '%res=sent%'
                                                      AND cd.urlpath NOT LIKE '%newsletter%'                                                      
                 WHERE g.idsito = $idSito
                   AND g.FontePrenotazione LIKE '%sito web%'                   
                   AND g.NoDisponibilita=$noDisponibilita 
                   AND g.Disdetta=0
                   AND g.TipoRichiesta = 'Conferma'                    
                   AND ( (g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate') OR (DATE(g.DataChiuso) >= '$startDate' AND DATE(g.DataChiuso) <= '$endDate') )                 
              GROUP BY g.Id
              ) as sub";

    //echo $sql."\n\n\n\n";
    $result = $db->query($sql);
    return count($result) > 0 ? $result[0]['num'] : 0;
}

/* function getCampaignPrice($db, $campaign, $startDate, $endDate, $noDisponibilita = 0)
{
    $idSito = $_POST['id_sito'];
    $method = $_POST['method'];
    $channelStr = $_POST['channel'];

    $source = '';
    $medium = '';
    if (!empty($channelStr)) {
        $source = explode(' ', $channelStr)[0];
        $medium = explode(' ', $channelStr)[1];
    }

    $sql = "SELECT SUM(prezzo) as num
              FROM (
             SELECT DISTINCT p.PrezzoP as prezzo
              FROM hospitality_guest g
        INNER JOIN hospitality_proposte p ON p.id_richiesta = g.Id
        INNER JOIN hospitality_client_id c ON c.NumeroPrenotazione = g.NumeroPrenotazione AND c.idsito = $idSito                  
        INNER JOIN hospitality_custom_dimension cd ON cd.clientid = c.CLIENT_ID 
                                                  AND cd.idsito = $idSito
                                                  AND cd.source = '$source'
                                                  AND cd.medium = '$medium'                                         
                                                  AND cd.campaign = '$campaign'
                                                  AND cd.urlpath LIKE '%res=sent%'
                                                  AND cd.urlpath NOT LIKE '%newsletter%'
                                                  AND (DATE(cd.datesession) = g.DataRichiesta OR DATE(cd.datesession) = DATE(g.DataChiuso))                                                
             WHERE ( (g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate') OR (DATE(g.DataChiuso) >= '$startDate' AND DATE(g.DataChiuso) <= '$endDate') )
               AND g.FontePrenotazione = '$method'
               AND g.NoDisponibilita = $noDisponibilita                               
               AND g.Disdetta = 0               
               AND g.idsito = $idSito
               AND g.TipoRichiesta = 'Preventivo'
               AND g.NumeroPrenotazione IN (
                               SELECT ggg.NumeroPrenotazione 
                                 FROM hospitality_guest ggg 
                                WHERE ggg.NumeroPrenotazione = g.NumeroPrenotazione 
                                  AND ggg.idsito = $idSito
                                  AND ggg.TipoRichiesta = 'Conferma'
                   )                  
               ) as sub";

    $result = $db->query($sql);
    $cdPrice = count($result) > 0 ? $result[0]['num'] : 0;

    $sql = " SELECT SUM(DISTINCT(p.PrezzoP)) as num  
               FROM hospitality_tracking_ads ads
         INNER JOIN hospitality_guest g ON ads.NumeroPrenotazione = g.NumeroPrenotazione                                       
                                       AND g.FontePrenotazione = '$method'                                               
                                       AND g.idsito = $idSito
                                       AND ((g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate' AND g.TipoRichiesta = 'Conferma') OR 
                                            (DATE(g.DataChiuso) >= '$startDate' AND DATE(g.DataChiuso) <= '$endDate'))
                                       AND g.NoDisponibilita = $noDisponibilita
                                       AND g.Disdetta = 0                   
         INNER JOIN hospitality_proposte p ON p.id_richiesta = g.Id
              WHERE ads.idsito = $idSito
                AND ads.Tracking = '$source'
                AND ads.Campagna = '$campaign'
                AND ads.NumeroPrenotazione NOT IN (
                        SELECT gg.NumeroPrenotazione
                          FROM hospitality_guest gg
                    INNER JOIN hospitality_proposte p ON p.id_richiesta = gg.Id
                    INNER JOIN hospitality_client_id c ON c.NumeroPrenotazione = gg.NumeroPrenotazione AND c.idsito = $idSito                  
                    INNER JOIN hospitality_custom_dimension cd ON cd.clientid = c.CLIENT_ID 
                                                               AND cd.idsito = $idSito
                                                               AND cd.source = '$source'
                                                               AND cd.medium = '$medium'                                         
                                                               AND cd.campaign = '$campaign'
                                                               AND cd.urlpath LIKE '%res=sent%'
                                                               AND cd.urlpath NOT LIKE '%newsletter%'
                                                               AND (DATE(cd.datesession) = gg.DataRichiesta OR DATE(cd.datesession) = DATE(gg.DataChiuso))                                                                        
                         WHERE ( (gg.DataRichiesta >= '$startDate' AND gg.DataRichiesta <= '$endDate') OR (DATE(gg.DataChiuso) >= '$startDate' AND DATE(gg.DataChiuso) <= '$endDate') )
                           AND gg.FontePrenotazione = '$method'
                           AND gg.NoDisponibilita = $noDisponibilita                               
                           AND gg.Disdetta = 0               
                           AND gg.idsito = $idSito
                           AND gg.TipoRichiesta = 'Preventivo'
                           AND gg.NumeroPrenotazione IN (
                               SELECT ggg.NumeroPrenotazione 
                                 FROM hospitality_guest ggg 
                                WHERE ggg.NumeroPrenotazione = gg.NumeroPrenotazione 
                                  AND ggg.idsito = $idSito
                                  AND ggg.TipoRichiesta = 'Conferma'
                   )                                      
                )";

    $result = $db->query($sql);
    $adsPrice = count($result) > 0 ? $result[0]['num'] : 0;

    return $cdPrice + $adsPrice; // cdPrice è giusto
} */

function getCampaignPrice($db, $campaign, $startDate, $endDate, $noDisponibilita = 0)
{
    $idSito = $_POST['id_sito'];
    $method = $_POST['method'];
    $channelStr = $_POST['channel'];

    $source = '';
    $medium = '';
    if (!empty($channelStr)) {
        $source = explode(' ', $channelStr)[0];
        $medium = explode(' ', $channelStr)[1];
    }

    $sql = "SELECT SUM(prezzo) as num
              FROM (
             SELECT DISTINCT p.PrezzoP as prezzo
              FROM hospitality_guest g
        INNER JOIN hospitality_proposte p ON p.id_richiesta = g.Id
        INNER JOIN hospitality_client_id c ON c.NumeroPrenotazione = g.NumeroPrenotazione AND c.idsito = $idSito                  
        INNER JOIN hospitality_custom_dimension cd ON cd.clientid = c.CLIENT_ID 
                                                  AND cd.idsito = $idSito
                                                  AND cd.source = '$source'
                                                  AND cd.medium = '$medium'                                         
                                                  AND cd.campaign = '$campaign'
                                                  AND cd.urlpath LIKE '%res=sent%'
                                                  AND cd.urlpath NOT LIKE '%newsletter%'
                                                                                                
             WHERE ( (g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate') OR (DATE(g.DataChiuso) >= '$startDate' AND DATE(g.DataChiuso) <= '$endDate') )
               AND g.FontePrenotazione = '$method'
               AND g.NoDisponibilita = $noDisponibilita                               
               AND g.Disdetta = 0               
               AND g.idsito = $idSito
               AND g.TipoRichiesta = 'Conferma'
             
               ) as sub";

    $result = $db->query($sql);
    $cdPrice = count($result) > 0 ? $result[0]['num'] : 0;

    $sql = " SELECT SUM(DISTINCT(p.PrezzoP)) as num  
               FROM hospitality_tracking_ads ads
         INNER JOIN hospitality_guest g ON ads.NumeroPrenotazione = g.NumeroPrenotazione                                       
                                       AND g.FontePrenotazione = '$method'                                               
                                       AND g.idsito = $idSito
                                       AND ((g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate' AND g.TipoRichiesta = 'Conferma') OR 
                                            (DATE(g.DataChiuso) >= '$startDate' AND DATE(g.DataChiuso) <= '$endDate'))
                                       AND g.NoDisponibilita = $noDisponibilita
                                       AND g.Disdetta = 0                   
         INNER JOIN hospitality_proposte p ON p.id_richiesta = g.Id
              WHERE ads.idsito = $idSito
                AND ads.Tracking = '$source'
                AND ads.Campagna = '$campaign'
                AND ads.NumeroPrenotazione NOT IN (
                        SELECT gg.NumeroPrenotazione
                          FROM hospitality_guest gg
                    INNER JOIN hospitality_proposte p ON p.id_richiesta = gg.Id
                    INNER JOIN hospitality_client_id c ON c.NumeroPrenotazione = gg.NumeroPrenotazione AND c.idsito = $idSito                  
                    INNER JOIN hospitality_custom_dimension cd ON cd.clientid = c.CLIENT_ID 
                                                               AND cd.idsito = $idSito
                                                               AND cd.source = '$source'
                                                               AND cd.medium = '$medium'                                         
                                                               AND cd.campaign = '$campaign'
                                                               AND cd.urlpath LIKE '%res=sent%'
                                                               AND cd.urlpath NOT LIKE '%newsletter%'
                                                                                                                                     
                         WHERE ( (gg.DataRichiesta >= '$startDate' AND gg.DataRichiesta <= '$endDate') OR (DATE(gg.DataChiuso) >= '$startDate' AND DATE(gg.DataChiuso) <= '$endDate') )
                           AND gg.FontePrenotazione = '$method'
                           AND gg.NoDisponibilita = $noDisponibilita                               
                           AND gg.Disdetta = 0               
                           AND gg.idsito = $idSito
                           AND gg.TipoRichiesta = 'Conferma'
                                     
                )";

    $result = $db->query($sql);
    $adsPrice = count($result) > 0 ? $result[0]['num'] : 0;

    return $cdPrice + $adsPrice; // cdPrice è giusto
}

function getCampaignBudget($db, $campaign, $startDate, $endDate)
{
    $idSito = $_POST['id_sito'];
    $method = $_POST['method'];
    $channelStr = $_POST['channel'];

    $source = '';
    $medium = '';
    if (!empty($channelStr)) {
        $source = explode(' ', $channelStr)[0];
        $medium = explode(' ', $channelStr)[1];
    }

    $sql = "SELECT SUM(DISTINCT ad.badget) as num
              FROM hospitality_guest g
        INNER JOIN hospitality_adCost_transactionRevenue ad ON ad.idsito = $idSito AND ad.source = '$source' AND ad.medium = '$medium' AND ad.campaign = '$campaign'  
             WHERE (g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate')
               AND (ad.datastart >= '$startDate' AND ad.dataend <= '$endDate')
               AND g.FontePrenotazione = '$method'
               AND g.Hidden = 0
               AND g.TipoRichiesta = 'Conferma' 
               AND g.idsito = $idSito
               AND ad.badget IS NOT NULL 
               ";

    $result = $db->query($sql);
    return count($result) > 0 && $result[0]['num'] !== null ? $result[0]['num'] : 0;
}

function getCampaignFatturatoBE($db, $campaign, $startDate, $endDate)
{
    $idSito = $_POST['id_sito'];
    $method = $_POST['method'];
    $channelStr = $_POST['channel'];

    $source = '';
    $medium = '';
    if (!empty($channelStr)) {
        $source = explode(' ', $channelStr)[0];
        $medium = explode(' ', $channelStr)[1];
    }

    $sql = "SELECT SUM(fatturato) as num
              FROM hospitality_adCost_transactionRevenue ad   
             WHERE (ad.datastart >= '$startDate' AND ad.datastart <= '$endDate')
               AND ad.idsito = $idSito 
               AND ad.source = '$source' 
               AND ad.medium = '$medium' 
               AND ad.campaign = '$campaign'
               AND ad.fatturato IS NOT NULL 
               ";

    $result = $db->query($sql);
    return count($result) > 0 && $result[0]['num'] != null ? $result[0]['num'] : 0;
}

function getFatturatoTotale($db, $startDateStr, $endDateStr, $idSito, $fonteFilter)
{
    $sql = "SELECT SUM(DISTINCT p.PrezzoP) as 'fatturato'
             FROM hospitality_guest gg
       INNER JOIN hospitality_proposte p ON  p.id_richiesta = gg.id
       INNER JOIN hospitality_client_id cid ON cid.NumeroPrenotazione = gg.NumeroPrenotazione AND cid.idsito = $idSito
       INNER JOIN hospitality_custom_dimension cd ON cd.clientid = cid.CLIENT_ID 
                                                 AND cd.idsito = $idSito 
                                                 AND cd.urlpath LIKE '%res=sent%' 
                                                 AND cd.urlpath NOT LIKE '%newsletter%'
           WHERE gg.FontePrenotazione LIKE '$fonteFilter'
             AND gg.idsito = $idSito
             AND gg.NoDisponibilita=0 
             AND gg.Disdetta=0
             AND gg.TipoRichiesta = 'Preventivo'
             AND gg.NumeroPrenotazione IN (
                               SELECT ggg.NumeroPrenotazione 
                                 FROM hospitality_guest ggg 
                                WHERE ggg.NumeroPrenotazione = gg.NumeroPrenotazione 
                                  AND ggg.idsito = $idSito
                                  AND ggg.TipoRichiesta = 'Conferma'
                                  AND ggg.NoDisponibilita=0 
                                  AND ggg.Disdetta=0
                                  AND ( (DATE(ggg.DataChiuso) >= '$startDateStr' AND DATE(ggg.DataChiuso) <= '$endDateStr') OR (ggg.DataRichiesta >= '$startDateStr' AND ggg.DataRichiesta <= '$endDateStr') )
                               )             ";
    $result = $db->query($sql);
    return $result[0]['fatturato'];
}

function getFatturatoFormTotale($db, $startDateStr, $endDateStr, $idSito)
{
    $sql = "SELECT SUM(fatturato) as fatturato 
              FROM (
                     SELECT sorgente,
                           media,
                           SUM(richieste)    as richieste,
                           SUM(inviati)      as inviati,
                           SUM(confermati)   as confermati,
                           SUM(conversione)  as conversione,
                           SUM(fatturato)    as fatturato,
                           SUM(fatturatobe)  as fatturatobe,
                           SUM(fatturatotel) as fatturatotel
                      FROM ( SELECT cd.source               as sorgente,
                                    cd.medium               as media,
                                    COUNT(g.Id)             as richieste,
                                    COUNT(g.Inviata)        as inviati,
                                    COUNT(g.Id)             as confermati,
                                    COUNT(g.Id)             as conversione,
                                    SUM(DISTINCT p.PrezzoP) as fatturato,
                                    (SELECT SUM(DISTINCT ad.fatturato)
                                       FROM hospitality_adCost_transactionRevenue ad   
                                      WHERE (g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr')
                                        AND g.FontePrenotazione LIKE 'sito%'
                                        AND g.Hidden = 0
                                        AND g.TipoRichiesta = 'Conferma' 
                                        AND g.idsito = $idSito
                                        AND ad.fatturato IS NOT NULL
                                        AND ad.idsito = $idSito 
                                        AND ad.source = cd.source 
                                        AND ad.medium = cd.medium
                                    ) as fatturatobe,
                                    0 as fatturatotel
                               FROM hospitality_guest g
                         INNER JOIN hospitality_proposte p ON p.id_richiesta = g.Id
                         INNER JOIN hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = g.NumeroPrenotazione
                         INNER JOIN hospitality_custom_dimension cd ON cd.clientid = hospitality_client_id.CLIENT_ID
                              WHERE (g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr')
                                AND g.FontePrenotazione like 'sito%'
                                AND g.Hidden = 0               
                                AND g.TipoRichiesta = 'Conferma'
                                AND cd.urlpath LIKE '%res=sent%'
                                AND g.idsito = $idSito
                                AND hospitality_client_id.idsito = $idSito
                                AND cd.idsito = $idSito
                           GROUP BY cd.source, cd.medium
                           ) as sub
                  GROUP BY sorgente, media
                ) as parent";

    $result = $db->query($sql);
    return $result[0]['fatturato'];
}

function getFatturatoChannel($db, $startDateStr, $endDateStr, $idSito, $methodFilter, $channel)
{
    $source = '';
    $medium = '';
    if (!empty($channel)) {
        $source = explode(' ', $channel)[0];
        $medium = explode(' ', $channel)[1];
    }

    $sql = "SELECT SUM(DISTINCT(p.PrezzoP)) as num
              FROM hospitality_guest g
        INNER JOIN hospitality_proposte p ON p.id_richiesta = g.Id
        INNER JOIN hospitality_client_id c ON c.NumeroPrenotazione = g.NumeroPrenotazione AND c.idsito = $idSito
        INNER JOIN hospitality_custom_dimension cd ON cd.clientid = c.CLIENT_ID
                                                  AND cd.idsito = $idSito
                                                  AND cd.source = '$source'
                                                  AND cd.medium = '$medium'                                         
                                                  AND cd.urlpath LIKE '%res=sent%'
                                                  AND cd.urlpath NOT LIKE '%newsletter%'                                                                                      
             WHERE g.FontePrenotazione LIKE '$methodFilter'
               AND g.NoDisponibilita = 0                         
               AND g.Disdetta = 0
               AND g.idsito = $idSito
               AND g.TipoRichiesta = 'Preventivo'
               AND g.NumeroPrenotazione IN (
                               SELECT ggg.NumeroPrenotazione 
                                 FROM hospitality_guest ggg 
                                WHERE ggg.NumeroPrenotazione = g.NumeroPrenotazione 
                                  AND ggg.idsito = $idSito
                                  AND ggg.TipoRichiesta = 'Conferma'
                                  AND ggg.NoDisponibilita = 0                         
                                  AND ggg.Disdetta = 0
                                  AND ( (ggg.DataRichiesta >= '$startDateStr' AND ggg.DataRichiesta <= '$endDateStr') OR (DATE(ggg.DataChiuso) >= '$startDateStr' AND DATE(ggg.DataChiuso) <= '$endDateStr') )
                               )             ";

    $result = $db->query($sql);
    return count($result) > 0 && $result[0]['num'] != null ? $result[0]['num'] : 0;
}

