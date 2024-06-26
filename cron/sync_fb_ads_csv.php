<?php
/**
 * ! QUESTO VALE ANCHE PER GA4
 * * Script per il caricamento su DB dei dati di Budget delle campagna Facebook Ads
 * * Da lanciare in CRON ogni 7 giorni.
 * * Configurazione: impostare l'url del file sul campo CSV_BudgetFacebook della tabella 'siti'.
 * * Funzionalità: aggiunge i record in coda alla tabella hospitality_adCost_transactionRevenue come (facebook social)
 *
 * * Esempio di CSV:
 *
 * * Campaign name,Date,Cost
 * * conversioni_ads_prenotaprima_inverno_2021,2021-10-04,"6,75"
 * * conversioni_ads_prenotaprima_inverno_2021,2021-10-05,"10,50"
 * * conversioni_ads_prenotaprima_inverno_2021,2021-10-06,"10,65"
 * * conversioni_ads_prenotaprima_inverno_2021,2021-10-07,"10,63"
 * * conversioni_ads_prenotaprima_inverno_2021,2021-10-08,"10,22"
 * * conversioni_ads_prenotaprima_inverno_2021,2021-10-09,"11,09"
 * * conversioni_ads_prenotaprima_inverno_2021,2021-10-10,"10,09"
 * * conversioni_ads_prenotaprima_inverno_2021_DE,2021-10-04,"6,63"
 * * conversioni_ads_prenotaprima_inverno_2021_DE,2021-10-05,"11,21"
 * * conversioni_ads_prenotaprima_inverno_2021_DE,2021-10-06,"10,46"
 * * conversioni_ads_prenotaprima_inverno_2021_DE,2021-10-07,"10,37"
 * * conversioni_ads_prenotaprima_inverno_2021_DE,2021-10-08,"9,92"
 * * conversioni_ads_prenotaprima_inverno_2021_DE,2021-10-09,"11,07"
 * * conversioni_ads_prenotaprima_inverno_2021_DE,2021-10-10,"10,18"
 * * conversioni_ads_prenotaprima_inverno_2021_EN,2021-10-04,"6,36"
 * * conversioni_ads_prenotaprima_inverno_2021_EN,2021-10-05,"10,54"
 * * conversioni_ads_prenotaprima_inverno_2021_EN,2021-10-06,"10,68"
 * * conversioni_ads_prenotaprima_inverno_2021_EN,2021-10-07,"10,37"
 * * conversioni_ads_prenotaprima_inverno_2021_EN,2021-10-08,"10,46"
 * * conversioni_ads_prenotaprima_inverno_2021_EN,2021-10-09,"11,28"
 * * conversioni_ads_prenotaprima_inverno_2021_EN,2021-10-10,"10,13"
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//error_reporting(0);

include(__DIR__ . '/../include/settings.inc.php');

$user     = DB_SUITEWEB_USER;
$pass     = DB_SUITEWEB_PASSWORD;
$h        = DB_SUITEWEB_HOST;
$db_n     = DB_SUITEWEB_NAME;

$username = DB_USER;
$password = DB_PASSWORD;
$host     = HOST;
$dbname   = DATABASE;

include(__DIR__ . '/../class/MysqliDb.php');

$dbSuiteweb = new MysqliDb($host, $username, $password, $dbname);
$dbQuoto = new MysqliDb($host, $username, $password, $dbname);


$query = "SELECT idsito, CSV_BudgetFacebook
            FROM siti
           WHERE CSV_BudgetFacebook IS NOT NULL";
if ($argc == 3) {
    //Parametri per risolvere manualmente caso d'uso di buchi nei periodi (es. idsito, url)
    $idSito = $argv[1];
    $url = $argv[2];

    $query = "SELECT $idSito as 'idsito', '$url' as 'CSV_BudgetFacebook'";
} else if ($argc > 1) {
    echo 'Usage: ' . basename(__FILE__) . ' idSito "url"' . "\n\n";
    echo '    Example: ' . basename(__FILE__) . ' 1234 "https://docs.google.com/spreadsheets/d/e/2PACX-1vRkkQQ4e9hpT0Kl73y-KtqIaQ5luwHsPXDozinJ0ZeLBjzvbzG9D02arxkSS0eccE3IB9N7OgiolfzJ/pub?gid=0&single=true&output=csv"';
    echo "\n\n";
    die();
}
echo "Avvio Cron - Sincronizzazione dati Campagne Facebook Ads (budget giornaliero)\n";
$rows = $dbSuiteweb->query($query);
$rowsCount = count($rows);

echo "Aggiornamento di $rowsCount record.\n";

// Per ogni sito che ha valorizzato il campo budget, aggiorno la tabella con i nuovi dati
foreach ($rows as $key => $row) {
    $idSito = $row['idsito'];
    $csvUrl = $row['CSV_BudgetFacebook'];

    $csv = getCSVFacebookBudget($csvUrl);

    echo "Aggiornamento record " . ($key + 1) . " di $rowsCount | idSito=$idSito | Records=" . count($csv) . "\n";

    if (!empty($csv)) {
        $dates = $campaigns = [];
        foreach ($csv as $csvIndex => $csvRow) {
            if (!in_array($csvRow[0], $campaigns)) $campaigns[] = $csvRow[0];
            if (!in_array($csvRow[1], $dates)) $dates[] = $csvRow[1];
        }
        $datesStr = "'" . implode("','", $dates) . "'";
        $campaignsStr = "'" . implode("','", $campaigns) . "'";

        // cerco tutti i record con dati che confliggono per aggiornarli
        $existSql = "SELECT `id`, `idsito`, `datastart`, `dataend`, `source`, `medium`, `campaign`, `badget`
                       FROM hospitality_adCost_transactionRevenue
                      WHERE `idsito` = $idSito
                        AND `source` = 'facebook'
                        AND `medium` = 'social' 
                        AND `datastart` IN ($datesStr) 
                        AND `campaign` IN ($campaignsStr)";
        $existingRows = $dbQuoto->query($existSql);

        foreach ($csv as $csvIndex => $csvRow) {
            $sqlInsertUpdate = '';

            $campaign = $csvRow[0];
            $date = $csvRow[1];
            $budget = $csvRow[2];

            $budget = str_replace(',', '.', $budget);

            echo "\tAggiornamento riga " . ($csvIndex + 1) . " di ".count($csv)." | idSito=$idSito | data=$date | campaign=$campaign | budget = $budget | ";

            // se esiste già un record per quella data e hanno budget diversi faccio update
            $existRecord = null;
            foreach ($existingRows as $er){
                if (($er['datastart'] == $date) && ($er['campaign'] == $campaign)){
                    $existRecord = $er;
                    break;
                }
            }
            if ($existRecord != null){
                // salvo i campi nella tabella dopo averla aggiornata
                $sqlInsertUpdate = "UPDATE hospitality_adCost_transactionRevenue 
                   SET `badget` = $budget
                   WHERE `id` = ".$existRecord['id'];

                echo "UPDATE\n";
            } else {
                // salvo i campi nella tabella dopo averla aggiornata
                $sqlInsertUpdate = "INSERT INTO hospitality_adCost_transactionRevenue 
                   (`idsito`, `datastart`, `dataend`, `source`    , `medium`, `campaign` , `badget`) VALUES
                   ($idSito , '$date'    , '$date'  , 'facebook'  , 'social'   , '$campaign', $budget)";

                echo "INSERT\n";
            }
            $dbQuoto->query($sqlInsertUpdate);
        }
    }
}

function getCSVFacebookBudget($url)
{
    $data = file_get_contents($url);
    $rows = explode("\n", $data);
    $s = array();
    foreach ($rows as $index => $row) {
        if ($index == 0) continue; // salto l'intestazione

        $s[] = str_getcsv($row);
    }

    return $s;
}
