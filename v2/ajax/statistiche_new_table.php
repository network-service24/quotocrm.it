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
$filter = $_POST['filter']; // vuoto per tabella principale ; 'annulled' per la tabella delle Annullate
$startDateStr = $_POST['start'];
$endDateStr = $_POST['end'];
$compareStr = $_POST['compare'];
$compareStartDateStr = $_POST['compare_start'];
$compareEndDateStr = $_POST['compare_end'];

// verifiche di validazione dei dati
if (empty($idSito) || empty($startDateStr) || empty($endDateStr)) {
    AjaxUtils::returnJsonHttpResponse([]);
}

$sql = '';
$data = [];
if (empty($filter)) { // TABELLA PRINCIPALE

    // Versione rapida considerando solo le proposte quoto
    $sql = "SELECT (CASE WHEN (g.FontePrenotazione = '' || g.FontePrenotazione IS NULL || g.FontePrenotazione = 'Altro') THEN 'Altro' ELSE g.FontePrenotazione END) as 'fonte',
                   COUNT(CASE g.TipoRichiesta WHEN 'Preventivo' THEN 1 ELSE null END) as 'richieste',
                   COUNT(g.Inviata) as 'inviati',
                   (    SELECT COUNT(gg.Id)
                          FROM hospitality_guest gg
                         WHERE ((DATE(gg.DataChiuso) >= '$startDateStr' AND DATE(gg.DataChiuso) <= '$endDateStr')
                                 OR (gg.DataRichiesta >= '$startDateStr' AND gg.DataRichiesta <= '$endDateStr' AND gg.TipoRichiesta = 'Conferma'))
                           AND gg.FontePrenotazione = g.FontePrenotazione
                           AND gg.idsito = $idSito
                           AND gg.Hidden = 0
                           AND gg.NoDisponibilita = 0
                            AND gg.Disdetta = 0
                   ) as 'confermati',
                   0 as 'conversione',
                   SUM((SELECT SUM(p.PrezzoP)
                          FROM hospitality_proposte p
                         WHERE p.id_richiesta = g.id
                           AND g.TipoRichiesta = 'Conferma'))  as 'fatturato'
              FROM hospitality_guest g
             WHERE (g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr')
               AND g.idsito = $idSito
               AND g.Hidden = 0
                AND g.NoDisponibilita = 0
                AND g.Disdetta = 0
          GROUP BY fonte";
    $resultDb = $db->query($sql);


    // COMPARE
    if ($compareStr === true || $compareStr === "true" || $compareStr === "1") {
        $sqlCompare = "SELECT (CASE g.FontePrenotazione WHEN '' THEN 'Altro' ELSE g.FontePrenotazione END) as 'fonte',
                               COUNT(CASE g.TipoRichiesta WHEN 'Preventivo' THEN 1 ELSE null END) as 'richieste',
                               COUNT(g.Inviata) as 'inviati',
                               (    SELECT COUNT(gg.Id)
                                      FROM hospitality_guest gg
                                     WHERE ((DATE(gg.DataChiuso) >= '$compareStartDateStr' AND DATE(gg.DataChiuso) <= '$compareEndDateStr')
                                 OR (gg.DataRichiesta >= '$compareStartDateStr' AND gg.DataRichiesta <= '$compareEndDateStr' AND gg.TipoRichiesta = 'Conferma'))
                                       AND gg.FontePrenotazione = g.FontePrenotazione
                                       AND gg.idsito = $idSito
                                       AND gg.Hidden = 0
                                        AND gg.NoDisponibilita = 0
                                        AND gg.Disdetta = 0
                               ) as 'confermati',
                               0 as 'conversione',
                               SUM((SELECT SUM(p.PrezzoP) 
                                             FROM hospitality_proposte p
                                             WHERE p.id_richiesta = g.id
                                             AND g.TipoRichiesta = 'Conferma'))  as 'fatturato'
                        FROM hospitality_guest g
                        WHERE (g.DataRichiesta >= '$compareStartDateStr' AND g.DataRichiesta <= '$compareEndDateStr')
                          AND g.idsito = $idSito
                          AND g.Hidden = 0
                         AND g.NoDisponibilita = 0
                        AND g.Disdetta = 0
                     GROUP BY fonte";
        $resultDbCompare = $db->query($sqlCompare);

        foreach ($resultDb as $row) {
            // cerco tra i compare se ho un record con la stessa fonte
            $newCompareRow = false;
            foreach ($resultDbCompare as $compareRow) {
                if ($row['fonte'] == $compareRow['fonte']) {
                    $newCompareRow = $compareRow;
                    break;
                }
            }

            $compareRichiesteValue = $newCompareRow !== false ? $newCompareRow['richieste'] : 0;
            $compareRichiestePerc = $compareRichiesteValue != 0 ? number_format(($row['richieste'] - $compareRichiesteValue) / $compareRichiesteValue * 100, 2, ',', '.') : 0;
            if ($compareRichiestePerc > 0) $compareRichiestePerc = '+' . $compareRichiestePerc;

            $compareInviatiValue = $newCompareRow !== false ? $newCompareRow['inviati'] : 0;
            $compareInviatiPerc = $compareInviatiValue != 0 ? number_format(($row['inviati'] - $compareInviatiValue) / $compareInviatiValue * 100, 2, ',', '.') : 0;
            if ($compareInviatiPerc > 0) $compareInviatiPerc = '+' . $compareInviatiPerc;

            $compareConfermatiValue = $newCompareRow !== false ? $newCompareRow['confermati'] : 0;
            $compareConfermatiPerc = $compareConfermatiValue != 0 ? number_format(($row['confermati'] - $compareConfermatiValue) / $compareConfermatiValue * 100, 2, ',', '.') : 0;
            if ($compareConfermatiPerc > 0) $compareConfermatiPerc = '+' . $compareConfermatiPerc;

            $compareConversioneValue = $newCompareRow !== false ? (($newCompareRow['confermati']/$newCompareRow['inviati'])*100) : 0;
            $compareConversioneValueFormatted = number_format($compareConversioneValue, 2, ',', "'");
            $compareConversionePerc = $compareConversioneValue != 0 ? number_format(((($row['confermati']/$row['inviati'])*100) - $compareConversioneValue) / $compareConversioneValue * 100, 2, ',', '.') : 0;
            if ($compareConversionePerc > 0) $compareConversionePerc = '+' . $compareConversionePerc;

            $compareFatturatoValue = $newCompareRow !== false ? $newCompareRow['fatturato'] : 0;
            $compareFatturatoValueFormatted = '€ ' . number_format($compareFatturatoValue, 2, ',', "'");
            $compareFatturatoPerc = $compareFatturatoValue != 0 ? number_format(($row['fatturato'] - $compareFatturatoValue) / $compareFatturatoValue * 100, 2, ',', '.') : 0;
            if ($compareFatturatoPerc > 0) $compareFatturatoPerc = '+' . $compareFatturatoPerc;

            $newRow = array(
                $row['fonte'],
                $row['richieste'] . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareRichiesteValue\">($compareRichiestePerc%)</span>",
                $row['inviati'] . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareInviatiValue\">($compareInviatiPerc%)</span>",
                $row['confermati'] . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareConfermatiValue\">($compareConfermatiPerc%)</span>",
                number_format((($row['confermati']/$row['inviati'])*100), 2, ',', '.') . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareConversioneValueFormatted\">($compareConversionePerc%)</span>",
                number_format($row['fatturato'], 2, ',', '.') . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareFatturatoValueFormatted\">($compareFatturatoPerc%)</span>"
            );

            $data['data'][] = $newRow;
        }

        // Aggiungo tutte le fonti di compare row che non sono già presenti in 'data'
        foreach ($resultDbCompare as $row) {

            $isAlreadyPreset = false;
            foreach ($data['data'] as $dataRow) {
                if ($dataRow[0] == $row['fonte']) {
                    $isAlreadyPreset = true;
                    break;
                }
            }

            if (!$isAlreadyPreset) {
                $data['data'][] = array(
                    $row['fonte'],
                    '0' . ' <span class="compare text-compare" data-toggle="tooltip" title="' . $row['richieste'] . '">(' . ($row['richieste'] == 0 ? '0' : '-100,00') . '%)</span>',
                    '0' . ' <span class="compare text-compare" data-toggle="tooltip" title="' . $row['inviati'] . '">(' . ($row['inviati'] == 0 ? '0' : '-100,00') . '%)</span>',
                    '0' . ' <span class="compare text-compare" data-toggle="tooltip" title="' . $row['confermati'] . '">(' . ($row['confermati'] == 0 ? '0' : '-100,00') . '%)</span>',
                    '0,00' . ' <span class="compare text-compare" data-toggle="tooltip" title="' . number_format((($row['confermati']/$row['inviati'])*100), 2, ',', '.') . '">(' . ((($row['confermati']/$row['inviati'])*100) == 0 ? '0' : '-100,00') . '%)</span>',
                    '€ 0,00' . ' <span class="compare text-compare" data-toggle="tooltip" title="€ ' . number_format($row['fatturato'], 2, ',', '.') . '">(' . ($row['fatturato'] == 0 ? '0' : '-100,00') . '%)</span>',
                );
            }
        }
    } else {
        foreach ($resultDb as $row) {
            $conversione = ($row['confermati'] /$row['inviati'])*100;

            $data['data'][] = array(
                $row['fonte'],
                $row['richieste'],
                $row['inviati'],
                $row['confermati'],
                number_format($conversione, 2, ',', '.'),
                number_format($row['fatturato'], 2, ',', '.'),
            );
        }
    }
} else { // TABELLA ANNULLATE
    $sql = "SELECT (CASE g.FontePrenotazione WHEN '' THEN 'Altro' ELSE g.FontePrenotazione END) as 'fonte',
                   COUNT(g.Id) as 'richieste',
                   SUM((SELECT SUM(p.PrezzoP)
                          FROM hospitality_proposte p
                         WHERE p.id_richiesta = g.id
                           AND g.TipoRichiesta = 'Conferma'))  as 'fatturato'
              FROM hospitality_guest g
             WHERE (g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr')
               AND g.idsito = $idSito
               AND g.NoDisponibilita = 1 
               AND g.Disdetta = 0 
               AND g.Hidden = 0
               AND g.TipoRichiesta = 'Conferma'
          GROUP BY g.FontePrenotazione";
    $resultDb = $db->query($sql);

    // COMPARE
    if ($compareStr === true || $compareStr === "true" || $compareStr === "1") {
        $sqlCompare = "SELECT (CASE g.FontePrenotazione WHEN '' THEN 'Altro' ELSE g.FontePrenotazione END) as 'fonte',
                              COUNT(g.Id) as 'richieste',
                              SUM(p.PrezzoP) as 'fatturato'
                         FROM hospitality_guest g
                   INNER JOIN hospitality_proposte p ON p.id_richiesta = g.Id
                        WHERE (g.DataRichiesta >= '$compareStartDateStr' AND g.DataRichiesta <= '$compareEndDateStr')
                          AND g.idsito = $idSito
                          AND g.NoDisponibilita = 1 
                          AND g.Disdetta = 0 
                          AND g.Hidden = 0
                          AND g.TipoRichiesta = 'Conferma'
                     GROUP BY g.FontePrenotazione";

        $resultDbCompare = $db->query($sqlCompare);

        foreach ($resultDb as $row) {
            // cerco tra i compare se ho un record con la stessa fonte
            $newCompareRow = false;
            foreach ($resultDbCompare as $compareRow) {
                if ($row['fonte'] == $compareRow['fonte']) {
                    $newCompareRow = $compareRow;
                    break;
                }
            }

            $compareRichiesteValue = $newCompareRow !== false ? $newCompareRow['richieste'] : 0;
            $compareRichiestePerc = $compareRichiesteValue != 0 ? number_format(($row['richieste'] - $compareRichiesteValue) / $compareRichiesteValue * 100, 2, ',', '.') : 0;
            if ($compareRichiestePerc > 0) $compareRichiestePerc = '+' . $compareRichiestePerc;

            $compareFatturatoValue = $newCompareRow !== false ? $newCompareRow['fatturato'] : 0;
            $compareFatturatoValueFormatted = '€ ' . number_format($compareFatturatoValue, 2, ',', '.');
            $compareFatturatoPerc = $compareFatturatoValue != 0 ? number_format(($row['fatturato'] - $compareFatturatoValue) / $compareFatturatoValue * 100, 2, ',', '.') : 0;
            if ($compareFatturatoPerc > 0) $compareFatturatoPerc = '+' . $compareFatturatoPerc;

            $newRow = array(
                $row['fonte'],
                $row['richieste'] . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareRichiesteValue\">($compareRichiestePerc%)</span>",
                number_format($row['fatturato'], 2, ',', '.') . " <span class=\"compare text-compare\" title=\"$compareFatturatoValueFormatted\">($compareFatturatoPerc%)</span>"
            );

            $data['data'][] = $newRow;
        }

        // Aggiungo tutte le fonti di compare row che non sono già presenti in 'data'
        foreach ($resultDbCompare as $row) {
            $isAlreadyPreset = false;
            foreach ($data['data'] as $dataRow) {
                if ($dataRow[0] == $row['fonte']) {
                    $isAlreadyPreset = true;
                    break;
                }
            }

            if (!$isAlreadyPreset) {
                $data['data'][] = array(
                    $row['fonte'],
                    '0' . ' <span class="compare text-compare" data-toggle="tooltip" title="' . $row['richieste'] . '">(' . ($row['richieste'] == 0 ? '0' : '-100,00') . '%)</span>',
                    '€ 0' . ' <span class="compare text-compare" data-toggle="tooltip" title="€ ' . number_format($row['fatturato'], 2, ',', '.') . '">(' . ($row['fatturato'] == 0 ? '0' : '-100,00') . '%)</span>',
                );
            }
        }
    } else { // Annullate - NO Compare
        foreach ($resultDb as $row) {
            $data['data'][] = array(
                $row['fonte'],
                $row['richieste'],
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
