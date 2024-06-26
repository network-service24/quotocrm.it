<?php
include($_SERVER['DOCUMENT_ROOT'] . '/include/settings.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/class/MysqliDb.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ajax/statistiche/ajax_utils.php');

$db = new MysqliDb(HOST, DB_USER, DB_PASSWORD, DATABASE);
$dbSuiteweb = new MysqliDb(HOST, DB_USER, DB_PASSWORD, DATABASE);

// parametri
$idSito = $_GET['idSito'];
$idUtente = $_GET['idUtente'];
$method = urldecode($_GET['method']);
$type = urldecode($_GET['type']);
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

// todo controllo e validazione dei parametri passati
$methodFilter = " AND (g.FontePrenotazione = '$method') ";
if (strtolower($method) == 'altro' || empty($method)) {
    $methodFilter = "AND (g.FontePrenotazione IS NULL OR g.FontePrenotazione = '' OR g.FontePrenotazione = 'Altro') ";
}

// ricavo i dati utente
$userData = $dbSuiteweb->query("SELECT utenti.*, siti.https,siti.email, siti.web,siti.nome, siti.data_start_hospitality,siti.website,siti.checkin_online_hospitality,siti.API_hospitality,siti.IdAccountAnalytics,siti.IdPropertyAnalytics,siti.ViewIdAnalytics 
                                  FROM utenti  
                            INNER JOIN siti ON siti.idsito = utenti.idsito  
                                 WHERE utenti.idutente = $idUtente");
if (count($userData) > 0){
    $userData = $userData[0];
}

$sql = '';
switch ($type) {
    case 'richieste':
        $sql = "SELECT g.Id, 
                       g.NumeroPrenotazione, 
                       DATE_FORMAT(g.DataRichiesta, '%d/%m/%Y') as 'DataRichiesta', 
                       GROUP_CONCAT(p.PrezzoP) as 'PrezzoP', 
                       g.FontePrenotazione, 
                       '' as Campagna,
                       '' as ClientId       
                  FROM hospitality_guest g 
            LEFT JOIN hospitality_proposte p ON g.ID = p.id_richiesta
                 WHERE (g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate')
                   AND g.idsito = $idSito
                       $methodFilter
                   AND g.TipoRichiesta = 'Preventivo'
                   AND g.Hidden = 0 
              GROUP BY g.Id";
        break;
    case 'inviati':
        $sql = "SELECT g.Id, 
                       g.NumeroPrenotazione, 
                       DATE_FORMAT(g.DataRichiesta, '%d/%m/%Y') as 'DataRichiesta', 
                       GROUP_CONCAT(p.PrezzoP) as 'PrezzoP', 
                       g.FontePrenotazione, 
                       '' as Campagna,
                       '' as ClientId
                  FROM hospitality_guest g 
             LEFT JOIN hospitality_proposte p ON g.ID = p.id_richiesta
                 WHERE (g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate')
                   AND g.idsito = $idSito
                       $methodFilter
                   AND g.Hidden = 0 
                   AND g.Inviata = 1 
              GROUP BY g.Id";
        break;
    case 'confermati':
        $sql = "SELECT g.Id, 
                       g.NumeroPrenotazione, 
                       DATE_FORMAT(g.DataRichiesta, '%d/%m/%Y') as 'DataRichiesta', 
                       GROUP_CONCAT(p.PrezzoP) as 'PrezzoP', 
                       g.FontePrenotazione, 
                       '' as Campagna,
                       '' as ClientId
                  FROM hospitality_guest g 
            INNER JOIN hospitality_proposte p ON g.ID = p.id_richiesta
                 WHERE ((DATE(g.DataChiuso) >= '$startDate' AND DATE(g.DataChiuso) <= '$endDate')
                           OR (g.DataRichiesta >= '$startDate' AND g.DataRichiesta <= '$endDate'))
                   AND g.idsito = $idSito
                       $methodFilter
                   AND g.Hidden = 0 
                   AND g.TipoRichiesta = 'Conferma' 
              GROUP BY g.Id";
        break;
}
$resultDb = $db->query($sql);

// per ogni riga trovata valorizzo le colonne mancanti
foreach ($resultDb as $index => $row) {
    // Valorizzo il campo campagna
    $sqlCampaign = "SELECT GROUP_CONCAT(sub.c) as campagna
                      FROM (SELECT DISTINCT cd.campaign as 'c'
                              FROM hospitality_custom_dimension cd, hospitality_client_id cid
                             WHERE cd.idsito = $idSito
                               AND cd.urlpath LIKE '%res=sent%'
                               AND cid.idsito = $idSito
                               AND cid.CLIENT_ID = cd.clientid
                               AND cid.NumeroPrenotazione = " . $row['NumeroPrenotazione'] . "
                           ) as sub
                  GROUP BY sub.c";
    $resultCampaign = $db->query($sqlCampaign);
    $fieldCampaign = $resultCampaign[0]['campagna'];

    $resultDb[$index]['Campagna'] = $fieldCampaign;

    // Valorizzo il campo ClientId
    $sqlClientId = "SELECT GROUP_CONCAT(sub.id) as clientId
                      FROM (SELECT DISTINCT cid.CLIENT_ID as 'id'
                              FROM hospitality_client_id cid
                             WHERE cid.idsito = $idSito
                               AND cid.NumeroPrenotazione = " . $row['NumeroPrenotazione'] . "
                           ) as sub
                  GROUP BY sub.id";
    $resultClientId = $db->query($sqlClientId);
    $fieldCliendId = $resultClientId[0]['clientId'];

    $resultDb[$index]['ClientId'] = $fieldCliendId;
}

$ID_ACCOUNT_ANALYTICS_ = explode("-", $userData['IdAccountAnalytics']);
$ID_ACCOUNT_ANALYTICS = $ID_ACCOUNT_ANALYTICS_[0];

// Mappatura
$data = [];
foreach ($resultDb as $row) {
    // Preparo il link per analytics
    $analyticsLink = '';
    if (!empty($row['ClientId']) && $row['ClientId'] != '.') {
        $analyticsUrl = 'https://analytics.google.com/analytics/web/#/report/visitors-user-activity/' .
            'a' . $ID_ACCOUNT_ANALYTICS .
            'w' . $userData['IdPropertyAnalytics'] .
            'p' . $userData['ViewIdAnalytics'] .
            '/_r.userId=' . $row['ClientId'] . '/';
        $analyticsLink = '<a title="Guarda la Timeline su Google Analytic" data-toggle="tooltip" target="_blank" href="' . $analyticsUrl . '"><i class="fa fa-external-link" aria-hidden="true"></i></a>';
    }

    $data['data'][] = array(
        $row['Id'],
        $row['NumeroPrenotazione'],
        $row['DataRichiesta'],
        implode(', ', array_map(function ($item) {
            return '€ ' . number_format($item, 2, ',', '.');
        }, explode(',', $row['PrezzoP']))),
        $row['FontePrenotazione'],
        $row['Campagna'],
        $analyticsLink,
    );
}


//$result = array(
//    'data' => [
//        [1, '20/05/2021', '€ 12.345,67', 'Sito Web', 'ads_google_estate_2021'],
//        [2, '20/05/2021', '€ 2.345,67', 'Sito Web', 'ads_google_estate_2021'],
//        [3, '21/05/2021', '€ 1.345,67', 'Sito Web', 'ads_google_estate_2021'],
//        [4, '21/05/2021', '€ 345,67', 'Sito Web', 'ads_google_estate_2021'],
//        [5, '25/05/2021', '€ 45,67', 'Telefono', ''],
//    ]
//);

AjaxUtils::returnJsonHttpResponse($data);
