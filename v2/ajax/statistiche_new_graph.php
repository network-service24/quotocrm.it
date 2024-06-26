<?php
include($_SERVER['DOCUMENT_ROOT'] . '/v2/include/settings.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/v2/class/MysqliDb.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/v2/ajax/ajax_utils.php');

$usernameQ = DB_USER;
$passwordQ = DB_PASSWORD;
$hostQ = HOST;
$dbnameQ = DATABASE;


$db = new MysqliDb($hostQ, $usernameQ, $passwordQ, $dbnameQ);

$idSito = $_POST['id_sito'];
$methodStr = $_POST['method'];
$startDateStr = $_POST['start'];
$endDateStr = $_POST['end'];
$compareStr = $_POST['compare'];
$compareStartDateStr = $_POST['compare_start'];
$compareEndDateStr = $_POST['compare_end'];

// verifiche di validazione dei dati
if (empty($idSito) || empty($startDateStr) || empty($endDateStr)) {
    AjaxUtils::returnJsonHttpResponse([]);
}

$methodFilter = (empty($methodStr) ? '' : "''AND g.FontePrenotazione = '$methodStr'");

$sql = "SELECT CAST(cal.date_list AS DATE) as 'data',
               COALESCE(r.fatturato, 0) as 'fatturato'
        FROM (
               SELECT SUBDATE('$startDateStr', INTERVAL 1 YEAR) + INTERVAL xc DAY AS date_list
               FROM ( SELECT @xi := @xi + 1 as xc
                      FROM (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc1,
                           (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc2,
                           (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc3,
                           (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc4,
                           (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc5,
                           (SELECT @xi := -1) xc0
                    ) xxc1
             ) cal
        LEFT JOIN (
                    SELECT g.DataRichiesta           as 'data',
                           SUM(distinct (p.PrezzoP)) as 'fatturato'
                    FROM hospitality_guest g
                    INNER JOIN hospitality_proposte p ON p.id_richiesta = g.Id
                    WHERE (g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr')
                      AND g.idsito = $idSito
                      AND g.Disdetta = 0
                      AND g.NoDisponibilita = 0
                      AND g.Hidden = 0
                      AND g.TipoRichiesta = 'Conferma'
                      $methodFilter
                    GROUP BY g.DataRichiesta
                  ) as r on r.data = cal.date_list
        WHERE cal.date_list BETWEEN '$startDateStr' AND '$endDateStr'
        ORDER BY cal.date_list ASC";
if (!($result = $db->query($sql))) {
    $result = $db->getLastError();
}

// COMPARE
$compareResult = [];
if ($compareStr == true || $compareStr == "true" || $compareStr == "1") {
    $sqlCompare = "SELECT CAST(cal.date_list AS DATE) as 'data',
               COALESCE(r.fatturato, 0) as 'fatturato'
        FROM (
               SELECT SUBDATE('$compareStartDateStr', INTERVAL 1 YEAR) + INTERVAL xc DAY AS date_list
               FROM ( SELECT @xi := @xi + 1 as xc
                      FROM (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc1,
                           (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc2,
                           (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc3,
                           (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc4,
                           (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) xc5,
                           (SELECT @xi := -1) xc0
                    ) xxc1
             ) cal
        LEFT JOIN (
                    SELECT g.DataRichiesta           as 'data',
                           SUM(distinct (p.PrezzoP)) as 'fatturato'
                    FROM hospitality_guest g
                    INNER JOIN hospitality_proposte p ON p.id_richiesta = g.Id
                    WHERE (g.DataRichiesta >= '$compareStartDateStr' AND g.DataRichiesta <= '$compareEndDateStr')
                      AND g.idsito = $idSito
                      AND g.Disdetta = 0
                      AND g.NoDisponibilita = 0
                      AND g.Hidden = 0
                      AND g.TipoRichiesta = 'Conferma'
                      $methodFilter
                    GROUP BY g.DataRichiesta
                  ) as r on r.data = cal.date_list
        WHERE cal.date_list BETWEEN '$compareStartDateStr' AND '$compareEndDateStr'
        ORDER BY cal.date_list ASC";

    if (!($compareResult = $db->query($sqlCompare))) {
        $compareResult = $db->getLastError();
    }
}

AjaxUtils::returnJsonHttpResponse([$result, $compareResult]);
