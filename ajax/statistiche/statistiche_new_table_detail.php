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
//region TABELLA PRINCIPALE
if (empty($filter)) {
    $sql = "SELECT source           as sorgente,
                   medium           as media                   
              FROM (
                     SELECT cd.source                   as source,
                            cd.medium                   as medium                            
                       FROM hospitality_guest g
                 INNER JOIN hospitality_proposte p ON p.id_richiesta = g.Id
                 INNER JOIN hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = g.NumeroPrenotazione
                 INNER JOIN hospitality_custom_dimension cd ON cd.clientid = hospitality_client_id.CLIENT_ID
                      WHERE (g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr')
                        AND g.FontePrenotazione like '%Sito Web%'
                        AND g.Hidden = 0
                        AND g.idsito = $idSito
                        AND hospitality_client_id.idsito = $idSito
                        AND cd.idsito = $idSito
                   GROUP BY source, medium, id_richiesta
             ) as sub
    GROUP BY source, medium";
    $resultDb = $db->query($sql);

    // Sistemo fatturato telefonico
    $fatturatoTelefonicoTotale = getFatturatoTotale($db, $startDateStr, $endDateStr, $idSito, 'telefon%');
    $fatturatoSitoWeb = getFatturatoTotale($db, $startDateStr, $endDateStr, $idSito, '%sito web%');
    $fatturatoTotale = getFatturatoTotale($db, $startDateStr, $endDateStr, $idSito, '%');
    $fatturattoSenzaTelefono = $fatturatoTotale - $fatturatoTelefonicoTotale;
    $fatturatoSitoPerc = $fatturatoSitoWeb * 100 / $fatturattoSenzaTelefono;
    $fatturatoDaRipartire = $fatturatoTelefonicoTotale * $fatturatoSitoPerc / 100;
    $fatturatoSitoWebNew = getFatturatoSito($db, $startDateStr, $endDateStr, $idSito);
    $ConfermatiSitoTotale = getConfermatiSito($db, $startDateStr, $endDateStr, $idSito);
//    $fatturatoTotaleDetail = 0;
//    foreach ($resultDb as $row) {
//        $fatturatoTotaleDetail += $row['fatturato'];
//    }

    // salvo i totali
    $sumRichieste = $sumInviati = $sumConfermati = $sumFatturato = $sumFatturatoBE = 0;

    foreach ($resultDb as $key => $row) {
        $rowRichieste = getRichieste($db, $startDateStr, $endDateStr, $idSito, $row['sorgente'], $row['media']);
        $rowInviati = getInviati($db, $startDateStr, $endDateStr, $idSito, $row['sorgente'], $row['media']);
        $rowConfermati = getConfermati($db, $startDateStr, $endDateStr, $idSito, $row['sorgente'], $row['media']);
        $rowConversione = ($rowConfermati / $rowInviati)*100;
        $rowFatturato = getFatturato($db, $startDateStr, $endDateStr, $idSito, $row['sorgente'], $row['media']);
        $rowFatturatoBE = getFatturatoBE($db, $startDateStr, $endDateStr, $idSito, $row['sorgente'], $row['media']);

        // sistemo il fatturato telefonico come ripartizione proporzionale
        $rowFormPerc = $rowFatturato * 100 / $fatturatoSitoWeb; //$fatturatoTotaleDetail;
        $rowFatturatoTel = $fatturatoDaRipartire * $rowFormPerc / 100;

        // Somme
        $sumRichieste += $rowRichieste;
        $sumInviati += $rowInviati;
        $sumConfermati += $rowConfermati;
        $sumFatturato += $rowFatturato;
        $sumFatturatoBE += $rowFatturatoBE;

        // Aggiunta dati calcolati al resultDb per fare il compare dopo
        $resultDb[$key]['richieste'] = $rowRichieste;
        $resultDb[$key]['inviati'] = $rowInviati;
        $resultDb[$key]['confermati'] = $rowConfermati;
        $resultDb[$key]['conversione'] = $rowConversione;
        $resultDb[$key]['fatturato'] = $rowFatturato;
        $resultDb[$key]['fatturatobe'] = $rowFatturatoBE;
        $resultDb[$key]['fatturatotel'] = $rowFatturatoTel;

        // mappatura dei dati
        $data['data'][] = array(
            $row['sorgente'] . ' ' . $row['media'],
            $rowRichieste,
            $rowInviati,
            $rowConfermati,
            number_format($rowConversione, 2, ',', '.'),
            number_format($rowFatturato, 2, ',', '.'),
            number_format($rowFatturatoBE, 2, ',', '.'),
            number_format($rowFatturatoTel, 2, ',', '.'),
            getCustomSortOrder($row['sorgente'] . ' ' . $row['media'])
        );
    }

    // Aggiungo una riga come differenza tra le somme per fare tornare i dai con il parent
    $richiesteTotali = getRichiesteTotali($db, $startDateStr, $endDateStr, $idSito);
    $inviatiTotali = getInviatiTotali($db, $startDateStr, $endDateStr, $idSito);
    $confermatiTotali = getConfermatiTotali($db, $startDateStr, $endDateStr, $idSito);
    $fatturatoBETotale = getFatturatoBETotale($db, $startDateStr, $endDateStr, $idSito);


    // Aggiunta dati calcolati al resultDb per fare il compare dopo
    $nessunaSorgenteRow = [
        'sorgente' => 'nessuna',
        'media' => 'sorgente',
        'richieste' => $richiesteTotali - $sumRichieste,
        'inviati' => $inviatiTotali - $sumInviati,
        'confermati' => $sumConfermati-$ConfermatiSitoTotale,
        'conversione' => ((($ConfermatiSitoTotale>$sumConfermati?$ConfermatiSitoTotale - $sumConfermati:0)) / ($inviatiTotali - $sumInviati))*100,
        'fatturato' => ($fatturatoSitoWebNew>$sumFatturato?$fatturatoSitoWebNew - $sumFatturato:0),
        'fatturatobe' => $fatturatoBETotale - $sumFatturatoBE,
        'fatturatotel' => 0
    ];
    $resultDb[] = $nessunaSorgenteRow;

    $data['data'][] = array(
        'nessuna sorgente',
        str_replace("-","",$richiesteTotali - $sumRichieste),
        str_replace("-","",$inviatiTotali - $sumInviati),
        ($ConfermatiSitoTotale>$sumConfermati?$ConfermatiSitoTotale - $sumConfermati:0),
        str_replace("-","",number_format((($ConfermatiSitoTotale>$sumConfermati?$ConfermatiSitoTotale - $sumConfermati:0)) / ($inviatiTotali - $sumInviati) * 100, 2, ',', '.')),
        number_format(($fatturatoSitoWebNew>$sumFatturato?$fatturatoSitoWebNew - $sumFatturato:0), 2, ',', '.'),
        number_format($fatturatoBETotale - $sumFatturatoBE, 2, ',', '.'),
        number_format(0, 2, ',', '.'),
        1000
    );

    //region COMPARE
    if ($compareStr === true || $compareStr === "true" || $compareStr === "1") {
        $data['data'] = array();

        $sqlCompare = "SELECT source           as sorgente,
                              medium           as media
                              FROM (
                                     SELECT cd.source                   as source,
                                            cd.medium                   as medium
                                       FROM hospitality_guest g
                                 INNER JOIN hospitality_proposte p ON p.id_richiesta = g.Id
                                 INNER JOIN hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = g.NumeroPrenotazione
                                 INNER JOIN hospitality_custom_dimension cd ON cd.clientid = hospitality_client_id.CLIENT_ID
                                      WHERE (g.DataRichiesta >= '$compareStartDateStr' AND g.DataRichiesta <= '$compareEndDateStr')
                                        AND g.FontePrenotazione like '%Sito Web%'
                                        AND g.Hidden = 0
                                        AND g.idsito = $idSito
                                        AND hospitality_client_id.idsito = $idSito
                                        AND cd.idsito = $idSito
                                   GROUP BY source, medium, id_richiesta
                              ) as sub
                     GROUP BY source, medium";
        $resultDbCompare = $db->query($sqlCompare);

        // Sistemo fatturato telefonico
        $fatturatoTelefonicoTotale = getFatturatoTotale($db, $compareStartDateStr, $compareEndDateStr, $idSito, 'telefon%');
        $fatturatoSitoWeb = getFatturatoTotale($db, $compareStartDateStr, $compareEndDateStr, $idSito, '%sito web%');
        $fatturatoTotale = getFatturatoTotale($db, $compareStartDateStr, $compareEndDateStr, $idSito, '%');
        $fatturattoSenzaTelefono = $fatturatoTotale - $fatturatoTelefonicoTotale;
        $fatturatoSitoPerc = $fatturatoSitoWeb * 100 / $fatturattoSenzaTelefono;
        $fatturatoDaRipartire = $fatturatoTelefonicoTotale * $fatturatoSitoPerc / 100;
        $fatturatoSitoWebNew = getFatturatoSito($db, $compareStartDateStr, $compareEndDateStr, $idSito);
        $ConfermatiSitoTotale = getConfermatiSito($db, $compareStartDateStr, $compareEndDateStr, $idSito);
        // salvo i totali
        $compareSumRichieste = $compareSumInviati = $compareSumConfermati = $compareSumFatturato = $compareSumFatturatoBE = 0;

        foreach ($resultDb as $row) {
            // cerco tra i compare se ho un record con la stessa fonte
            $newCompareRow = false;
            foreach ($resultDbCompare as $compareRow) {
                if ($row['sorgente'] == $compareRow['sorgente'] && $row['media'] == $compareRow['media']) {
                    $newCompareRow = $compareRow;
                    break;
                }
            }

            //
            $compareRowRichieste = getRichieste($db, $compareStartDateStr, $compareEndDateStr, $idSito, $row['sorgente'], $row['media']);
            $compareRowInviati = getInviati($db, $compareStartDateStr, $compareEndDateStr, $idSito, $row['sorgente'], $row['media']);
            $compareRowConfermati = getConfermati($db, $compareStartDateStr, $compareEndDateStr, $idSito, $row['sorgente'], $row['media']);
            $compareRowConversione =( $compareRowConfermati / $compareRowInviati)*100;
            $compareRowFatturato = getFatturato($db, $compareStartDateStr, $compareEndDateStr, $idSito, $row['sorgente'], $row['media']);
            $compareRowFatturatoBE = getFatturatoBE($db, $compareStartDateStr, $compareEndDateStr, $idSito, $row['sorgente'], $row['media']);

            $compareRichiesteValue = $newCompareRow !== false ? $compareRowRichieste : 0;
            $compareRichiestePerc = $compareRichiesteValue != 0 ? number_format(($row['richieste'] - $compareRichiesteValue) / $compareRichiesteValue * 100, 2, ',', '.') : 0;
            if ($compareRichiestePerc > 0) $compareRichiestePerc = '+' . $compareRichiestePerc;

            $compareInviatiValue = $newCompareRow !== false ? $compareRowInviati : 0;
            $compareInviatiPerc = $compareInviatiValue != 0 ? number_format(($row['inviati'] - $compareInviatiValue) / $compareInviatiValue * 100, 2, ',', '.') : 0;
            if ($compareInviatiPerc > 0) $compareInviatiPerc = '+' . $compareInviatiPerc;

            $compareConfermatiValue = $newCompareRow !== false ? $compareRowConfermati : 0;
            $compareConfermatiPerc = $compareConfermatiValue != 0 ? number_format(($compareRowConfermati - $compareConfermatiValue) / $compareConfermatiValue * 100, 2, ',', '.') : 0;
            if ($compareConfermatiPerc > 0) $compareConfermatiPerc = '+' . $compareConfermatiPerc;

            $compareConversioneValue = $newCompareRow !== false ? $compareRowConversione : 0;
            $compareConversioneValueFormatted = number_format($compareConversioneValue, 2, ',', ".");
            $compareConversionePerc = $compareConversioneValue != 0 ? number_format(($row['conversione'] - $compareConversioneValue) / $compareConversioneValue * 100, 2, ',', '.') : 0;
            if ($compareConversionePerc > 0) $compareConversionePerc = '+' . $compareConversionePerc;

            $compareFatturatoValue = $newCompareRow !== false ? $compareRowFatturato : 0;
            $compareFatturatoValueFormatted = '€ ' . number_format($compareFatturatoValue, 2, ',', ".");
            $compareFatturatoPerc = $compareFatturatoValue != 0 ? number_format(($row['fatturato'] - $compareFatturatoValue) / $compareFatturatoValue * 100, 2, ',', '.') : 0;
            if ($compareFatturatoPerc > 0) $compareFatturatoPerc = '+' . $compareFatturatoPerc;

            $compareFatturatoBEValue = $newCompareRow !== false ? $compareRowFatturato : 0;
            $compareFatturatoBEValueFormatted = '€ ' . number_format($compareFatturatoBEValue, 2, ',', ".");
            $compareFatturatoBEPerc = $compareFatturatoBEValue != 0 ? number_format(($row['fatturatobe'] - $compareFatturatoBEValue) / $compareFatturatoBEValue * 100, 2, ',', '.') : 0;
            if ($compareFatturatoBEPerc > 0) $compareFatturatoBEPerc = '+' . $compareFatturatoBEPerc;

            // sistemo il fatturato telefonico come ripartizione proporzionale
            $compareFatturatoTelPerc = $newCompareRow !== false ? $compareRowFatturato * 100 / $fatturatoSitoWeb : 0;
            $compareFatturatoTelValue = $fatturatoDaRipartire * $compareFatturatoTelPerc / 100;
            $compareFatturatoTelValueFormatted = '€ ' . number_format($compareFatturatoTelValue, 2, ',', ".");
            $compareFatturatoTelPerc = number_format($compareFatturatoTelPerc, 2, ',', ".");
            if ($compareFatturatoTelPerc > 0) $compareFatturatoTelPerc = '+' . $compareFatturatoTelPerc;

            // Somme
            $compareSumRichieste += $compareRowRichieste;
            $compareSumInviati += $compareRowInviati;
            $compareSumConfermati += $compareRowConfermati;
            $compareSumFatturato += $compareRowFatturato;
            $compareSumFatturatoBE += $compareRowFatturatoBE;

            $newRow = array(
                $row['sorgente'] . ' ' . $row['media'],
                $row['richieste'] . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareRichiesteValue\">($compareRichiestePerc%)</span>",
                $row['inviati'] . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareInviatiValue\">($compareInviatiPerc%)</span>",
                $row['confermati'] . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareConfermatiValue\">($compareConfermatiPerc%)</span>",
                number_format($row['conversione'], 2, ',', '.') . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareConversioneValueFormatted\">($compareConversionePerc%)</span>",
                number_format($row['fatturato'], 2, ',', '.') . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareFatturatoValueFormatted\">($compareFatturatoPerc%)</span>",
                number_format($row['fatturatobe'], 2, ',', '.') . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareFatturatoBEValueFormatted\">($compareFatturatoBEPerc%)</span>",
                number_format($row['fatturatotel'], 2, ',', '.') . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareFatturatoTelValueFormatted\">($compareFatturatoTelPerc%)</span>",
                getCustomSortOrder($row['sorgente'] . ' ' . $row['media']),
            );

            $data['data'][] = $newRow;
        }

        // Aggiungo tutte le fonti di compare row che non sono già presenti in 'data'
        foreach ($resultDbCompare as $row) {

            $isAlreadyPreset = false;
            foreach ($data['data'] as $dataRow) {
                if ($dataRow[0] == $row['sorgente'] . ' ' . $row['media']) {
                    $isAlreadyPreset = true;
                    break;
                }
            }

            //
            $compareRowRichieste = getRichieste($db, $compareStartDateStr, $compareEndDateStr, $idSito, $row['sorgente'], $row['media']);
            $compareRowInviati = getInviati($db, $compareStartDateStr, $compareEndDateStr, $idSito, $row['sorgente'], $row['media']);
            $compareRowConfermati = getConfermati($db, $compareStartDateStr, $compareEndDateStr, $idSito, $row['sorgente'], $row['media']);
            $compareRowConversione = ($compareRowConfermati / $compareRowInviati)*100;
            $compareRowFatturato = getFatturato($db, $compareStartDateStr, $compareEndDateStr, $idSito, $row['sorgente'], $row['media']);
            $compareRowFatturatoBE = getFatturatoBE($db, $compareStartDateStr, $compareEndDateStr, $idSito, $row['sorgente'], $row['media']);

            if (!$isAlreadyPreset) {
                $data['data'][] = array(
                    $row['sorgente'] . ' ' . $row['media'],
                    '0' . ' <span class="compare text-compare" data-toggle="tooltip" title="' . $compareRowRichieste . '">(' . ($compareRowRichieste == 0 ? '0,00' : '-100,00') . '%)</span>',
                    '0' . ' <span class="compare text-compare" data-toggle="tooltip" title="' . $compareRowInviati . '">(' . ($compareRowInviati == 0 ? '0,00' : '-100,00') . '%)</span>',
                    '0' . ' <span class="compare text-compare" data-toggle="tooltip" title="' . $compareRowConfermati . '">(' . ($compareRowConfermati == 0 ? '0,00' : '-100,00') . '%)</span>',
                    '0,00' . ' <span class="compare text-compare" data-toggle="tooltip" title="' . number_format($compareRowConversione, 2, ',', '.') . '">(' . ($compareRowConversione == 0 ? '0,00' : '-100,00') . '%)</span>',
                    '0,00' . ' <span class="compare text-compare" data-toggle="tooltip" title="€ ' . number_format($compareRowFatturato, 2, ',', '.') . '">(' . ($compareRowFatturato == 0 ? '0,00' : '-100,00') . '%)</span>',
                    '0,00' . ' <span class="compare text-compare" data-toggle="tooltip" title="€' . number_format($compareRowFatturatoBE, 2, ',', '.') . '">(' . ($compareRowFatturatoBE == 0 ? '0,00' : '-100,00') . '%)</span>',
                    '0,00' . ' <span class="compare text-compare" data-toggle="tooltip" title="€ ' . number_format($row['fatturatotel'], 2, ',', '.') . '">(' . ($row['fatturatotel'] == 0 ? '0,00' : '-100,00') . '%)</span>',
                    getCustomSortOrder($row['sorgente'] . ' ' . $row['media'])
                );
            }
        }

        // Aggiungo una riga come differenza tra le somme per fare tornare i dai con il parent
        $compareRichiesteTotali = getRichiesteTotali($db, $compareStartDateStr, $compareEndDateStr, $idSito);
        $compareInviatiTotali = getInviatiTotali($db, $compareStartDateStr, $compareEndDateStr, $idSito);
        $compareConfermatiTotali = getConfermatiTotali($db, $compareStartDateStr, $compareEndDateStr, $idSito);
        $compareFatturatoBETotale = getFatturatoBETotale($db, $compareStartDateStr, $compareEndDateStr, $idSito);

        $compareNessunaSorgenteRichiesteValue = $compareRichiesteTotali - $compareSumRichieste;
        $compareNessunaSorgenteRichiestePerc = $compareNessunaSorgenteRichiesteValue != 0 ? number_format(($nessunaSorgenteRow['richieste'] - $compareNessunaSorgenteRichiesteValue) / $compareNessunaSorgenteRichiesteValue * 100, 2, ',', '.') : 0;
        if ($compareNessunaSorgenteRichiestePerc > 0) $compareNessunaSorgenteRichiestePerc = '+' . $compareNessunaSorgenteRichiestePerc;

        $compareNessunaSorgenteInviatiValue = $compareInviatiTotali - $compareSumInviati;
        $compareNessunaSorgenteInviatiPerc = $compareNessunaSorgenteInviatiValue != 0 ? number_format(($nessunaSorgenteRow['inviati'] - $compareNessunaSorgenteInviatiValue) / $compareNessunaSorgenteInviatiValue * 100, 2, ',', '.') : 0;
        if ($compareNessunaSorgenteInviatiPerc > 0) $compareNessunaSorgenteInviatiPerc = '+' . $compareNessunaSorgenteInviatiPerc;

        $compareNessunaSorgenteConfermatiValue = $compareConfermatiTotali - $compareSumConfermati;
        $compareNessunaSorgenteConfermatiPerc = $compareNessunaSorgenteConfermatiValue != 0 ? number_format(($nessunaSorgenteRow['confermati'] - $compareNessunaSorgenteConfermatiValue) / $compareNessunaSorgenteConfermatiValue * 100, 2, ',', '.') : 0;
        if ($compareNessunaSorgenteConfermatiPerc > 0) $compareNessunaSorgenteConfermatiPerc = '+' . $compareNessunaSorgenteConfermatiPerc;

        $compareNessunaSorgenteConversioneValue = ($compareNessunaSorgenteConfermatiValue / $compareNessunaSorgenteInviatiValue) * 100;
        $compareNessunaSorgenteConversioneValueFormatted = number_format($compareNessunaSorgenteConversioneValue, 2, ',', ".");
        $compareNessunaSorgenteConversionePerc = $compareNessunaSorgenteConversioneValue != 0 ? number_format(($nessunaSorgenteRow['conversione'] - $compareNessunaSorgenteConversioneValue) / $compareNessunaSorgenteConversioneValue * 100, 2, ',', '.') : 0;
        if ($compareNessunaSorgenteConversionePerc > 0) $compareNessunaSorgenteConversionePerc = '+' . $compareNessunaSorgenteConversionePerc;

        $compareNessunaSorgenteFatturatoValue = $fatturatoSitoWeb - $compareSumFatturato;
        $compareNessunaSorgenteFatturatoValueFormatted = '€ ' . number_format($compareNessunaSorgenteFatturatoValue, 2, ',', ".");
        $compareNessunaSorgenteFatturatoPerc = $compareNessunaSorgenteFatturatoValue != 0 ? number_format(($nessunaSorgenteRow['fatturato'] - $compareNessunaSorgenteFatturatoValue) / $compareNessunaSorgenteFatturatoValue * 100, 2, ',', '.') : 0;
        if ($compareNessunaSorgenteFatturatoPerc > 0) $compareNessunaSorgenteFatturatoPerc = '+' . $compareNessunaSorgenteFatturatoPerc;

        $compareNessunaSorgenteFatturatoBEValue = $compareFatturatoBETotale - $compareSumFatturatoBE;
        $compareNessunaSorgenteFatturatoBEValueFormatted = '€ ' . number_format($compareNessunaSorgenteFatturatoBEValue, 2, ',', ".");
        $compareNessunaSorgenteFatturatoBEPerc = $compareNessunaSorgenteFatturatoBEValue != 0 ? number_format(($nessunaSorgenteRow['fatturatobe'] - $compareNessunaSorgenteFatturatoBEValue) / $compareNessunaSorgenteFatturatoBEValue * 100, 2, ',', '.') : 0;
        if ($compareNessunaSorgenteFatturatoBEPerc > 0) $compareNessunaSorgenteFatturatoBEPerc = '+' . $compareNessunaSorgenteFatturatoBEPerc;

        $nessunaSorgenteDataKey = -1;
        foreach ($data['data'] as $key => $dataRow) {
            if ($dataRow[0] == 'nessuna sorgente') {
                $nessunaSorgenteDataKey = $key;
                break;
            }
        }

        $data['data'][$nessunaSorgenteDataKey] = array(
            'nessuna sorgente',
            $nessunaSorgenteRow['richieste'] . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareNessunaSorgenteRichiesteValue\">($compareNessunaSorgenteRichiestePerc%)</span>",
            $nessunaSorgenteRow['inviati'] . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareNessunaSorgenteInviatiValue\">($compareNessunaSorgenteInviatiPerc%)</span>",
            $nessunaSorgenteRow['confermati'] . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareNessunaSorgenteConfermatiValue\">($compareNessunaSorgenteConfermatiPerc%)</span>",
            number_format($nessunaSorgenteRow['conversione'], 2, ',', '.') . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareNessunaSorgenteConversioneValueFormatted\">($compareNessunaSorgenteConversionePerc%)</span>",
            number_format($nessunaSorgenteRow['fatturato'], 2, ',', '.') . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"€ $compareNessunaSorgenteFatturatoValueFormatted\">($compareNessunaSorgenteFatturatoPerc%)</span>",
            number_format($nessunaSorgenteRow['fatturatobe'], 2, ',', '.') . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"€ $compareNessunaSorgenteFatturatoBEValueFormatted\">($compareNessunaSorgenteFatturatoBEPerc%)</span>",
            number_format($nessunaSorgenteRow['fatturatotel'], 2, ',', '.') . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"€ 0,00\">(0,00%)</span>",
            1000
        );

    } //endregion COMPARE

    // Ordinamento
    usort($data['data'], function ($a, $b) {
        return ($a[8] < $b[8]) ? -1 : 1;
    });
}
//endregion TABELLA PRINCIPALE
//region TABELLA ANNULLATE
else {
    $sql = "SELECT source as sorgente,
                   medium as media                   
              FROM (
                     SELECT cd.source as source,
                            cd.medium as medium                            
                       FROM hospitality_guest g
                 INNER JOIN hospitality_proposte p ON p.id_richiesta = g.Id
                 RIGHT JOIN hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = g.NumeroPrenotazione
                 INNER JOIN hospitality_custom_dimension cd ON cd.clientid = hospitality_client_id.CLIENT_ID
                      WHERE (g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr')
                        AND g.idsito = $idSito
                        AND g.FontePrenotazione like '%Sito Web%'
                        AND g.Disdetta = 0
                        AND g.NoDisponibilita = 1
                        AND g.Hidden = 0
                        AND g.TipoRichiesta = 'Conferma'
                        AND hospitality_client_id.idsito = $idSito
                        AND cd.idsito = $idSito
                   GROUP BY source, medium, id_richiesta
             ) as sub
    GROUP BY source, medium";
    $resultDb = $db->query($sql);

    $annullateSumRichieste = 0;
    $annullateSumFatturato = 0;
    foreach ($resultDb as $key => $row) {
        $rowRichieste = getConfermati($db, $startDateStr, $endDateStr, $idSito, $row['sorgente'], $row['media'], 1);
        $rowFatturato = getFatturato($db, $startDateStr, $endDateStr, $idSito, $row['sorgente'], $row['media'], 1);

        $resultDb[$key]['richieste'] = $rowRichieste;
        $resultDb[$key]['fatturato'] = $rowFatturato;

        $annullateSumRichieste += $rowRichieste;
        $annullateSumFatturato += $rowFatturato;
    }

    // Aggiungo una riga come differenza tra le somme per fare tornare i dai con il parent
    $confermatiTotali = getConfermatiTotali($db, $startDateStr, $endDateStr, $idSito, 1);
    $fatturatoTotale = getFatturatoTotale($db, $startDateStr, $endDateStr, $idSito, '%sito web%', 1);

    // Aggiunta dati calcolati al resultDb per fare il compare dopo
    $nessunaSorgenteRow = [
        'sorgente' => 'nessuna',
        'media' => 'sorgente',
        'richieste' => $confermatiTotali - $annullateSumRichieste,
        'fatturato' => $fatturatoTotale - $annullateSumFatturato,
    ];
    $resultDb[] = $nessunaSorgenteRow;

    // Mappatura
    foreach ($resultDb as $row) {
        $data['data'][] = array(
            $row['sorgente'] . ' ' . $row['media'],
            $row['richieste'],
            number_format($row['fatturato'], 2, ',', '.'),
        );
    }

    // COMPARE ANNULLATE
    if ($compareStr === true || $compareStr === "true" || $compareStr === "1") {
        $data['data'] = array();

        $sqlCompare = "SELECT sorgente,
                              media
                         FROM ( SELECT cd.source as sorgente,
                                       cd.medium as media                                   
                                  FROM hospitality_guest g
                            INNER JOIN hospitality_proposte p ON p.id_richiesta = g.Id
                            INNER JOIN hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = g.NumeroPrenotazione
                            INNER JOIN hospitality_custom_dimension cd ON cd.clientid = hospitality_client_id.CLIENT_ID
                                 WHERE (g.DataRichiesta >= '$compareStartDateStr' AND g.DataRichiesta <= '$compareEndDateStr')
                                   AND g.idsito = $idSito
                                   AND g.FontePrenotazione like '%Sito Web%'
                                   AND g.Disdetta = 0
                                   AND g.NoDisponibilita = 1
                                   AND g.Hidden = 0               
                                   AND g.TipoRichiesta = 'Conferma'
                                   AND hospitality_client_id.idsito = $idSito
                                   AND cd.idsito = $idSito
                              GROUP BY cd.source, cd.medium, id_richiesta
                              ) as sub
                     GROUP BY sorgente, media";
        $resultDbCompare = $db->query($sqlCompare);

        $annullateCompareSumRichieste = 0;
        $annullateCompareSumFatturato = 0;
        foreach ($resultDbCompare as $key => $row) {
            $rowCompareRichieste = getConfermati($db, $compareStartDateStr, $compareEndDateStr, $idSito, $row['sorgente'], $row['media'], 1);
            $rowCompareFatturato = getFatturato($db, $compareStartDateStr, $compareEndDateStr, $idSito, $row['sorgente'], $row['media'], 1);

            $resultDbCompare[$key]['richieste'] = $rowCompareRichieste;
            $resultDbCompare[$key]['fatturato'] = $rowCompareFatturato;

            $annullateCompareSumRichieste += $rowCompareRichieste;
            $annullateCompareSumFatturato += $rowCompareFatturato;
        }

        foreach ($resultDb as $row) {
            // cerco tra i compare se ho un record con la stessa fonte
            $newCompareRow = false;
            foreach ($resultDbCompare as $compareRow) {
                if ($row['sorgente'] . ' ' . $row['media'] == $compareRow['sorgente'] . ' ' . $compareRow['media']) {
                    $newCompareRow = $compareRow;
                    break;
                }
            }

            $compareRichiesteValue = $newCompareRow !== false ? $newCompareRow['richieste'] : 0;
            $compareRichiestePerc = $compareRichiesteValue != 0 ? number_format(($row['richieste'] - $compareRichiesteValue) / $compareRichiesteValue * 100, 2, ',', '.') : 0;
            if ($compareRichiestePerc > 0) $compareRichiestePerc = '+' . $compareRichiestePerc;

            $compareFatturatoValue = $newCompareRow !== false ? $newCompareRow['fatturato'] : 0;
            $compareFatturatoValueFormatted = '€ ' . number_format($compareFatturatoValue, 2, ',', ".");
            $compareFatturatoPerc = $compareFatturatoValue != 0 ? number_format(($row['fatturato'] - $compareFatturatoValue) / $compareFatturatoValue * 100, 2, ',', '.') : 0;
            if ($compareFatturatoPerc > 0) $compareFatturatoPerc = '+' . $compareFatturatoPerc;

            $newRow = array(
                $row['sorgente'] . ' ' . $row['media'],
                $row['richieste'] . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareRichiesteValue\">($compareRichiestePerc%)</span>",
                number_format($row['fatturato'], 2, ',', '.') . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$compareFatturatoValueFormatted\">($compareFatturatoPerc%)</span>"
            );

            $data['data'][] = $newRow;
        }

        // Aggiungo tutte le fonti di compare row che non sono già presenti in 'data'
        foreach ($resultDbCompare as $row) {
            $isAlreadyPreset = false;
            foreach ($data['data'] as $dataRow) {
                if ($dataRow[0] == $row['sorgente'] . ' ' . $row['media']) {
                    $isAlreadyPreset = true;
                    break;
                }
            }

            if (!$isAlreadyPreset) {
                $data['data'][] = array(
                    $row['sorgente'] . ' ' . $row['media'],
                    '0' . ' <span class="compare text-compare" data-toggle="tooltip" title="' . $row['richieste'] . '">(' . ($row['richieste'] == 0 ? '0' : '-100,00') . '%)</span>',
                    '€ 0,00' . ' <span class="compare text-compare" data-toggle="tooltip" title="€ ' . number_format($row['fatturato'], 2, ',', '.') . '">(' . ($row['fatturato'] == 0 ? '0,00' : '-100,00') . '%)</span>',
                );
            }
        }

        // Aggiungo una riga come differenza tra le somme per fare tornare i dai con il parent
        $confermatiCompareTotali = getConfermatiTotali($db, $compareStartDateStr, $compareEndDateStr, $idSito, 1);
        $fatturatoCompareTotale = getFatturatoTotale($db, $compareStartDateStr, $compareEndDateStr, $idSito, '%sito web%', 1);
        $fatturatoCompareSitoWebNew = getFatturatoSito($db, $compareStartDateStr, $compareEndDateStr, $idSito);
        $ConfermatiCompareSitoTotale = getConfermatiSito($db, $compareStartDateStr, $compareEndDateStr, $idSito);

        $nessunaSorgenteCompareRichiesteValue = $confermatiCompareTotali - $annullateCompareSumRichieste;
        $nessunaSorgenteCompareRichiestePerc = $nessunaSorgenteCompareRichiesteValue != 0 ? number_format(($nessunaSorgenteRow['richieste'] - $nessunaSorgenteCompareRichiesteValue) / $nessunaSorgenteCompareRichiesteValue * 100, 2, ',', '.') : 0;
        if ($nessunaSorgenteCompareRichiestePerc > 0) $nessunaSorgenteCompareRichiestePerc = '+' . $nessunaSorgenteCompareRichiestePerc;

        $nessunaSorgenteCompareFatturatoValue = $fatturatoCompareTotale - $annullateCompareSumFatturato;
        $nessunaSorgenteCompareFatturatoValueFormatted = number_format($nessunaSorgenteCompareFatturatoValue, 2, ',', ".");
        $nessunaSorgenteCompareFatturatoPerc = $nessunaSorgenteCompareFatturatoValue != 0 ? number_format(($nessunaSorgenteRow['fatturato'] - $nessunaSorgenteCompareFatturatoValue) / $nessunaSorgenteCompareFatturatoValue * 100, 2, ',', '.') : 0;
        if ($nessunaSorgenteCompareFatturatoPerc > 0) $nessunaSorgenteCompareFatturatoPerc = '+' . $nessunaSorgenteCompareFatturatoPerc;


        // Aggiunta dati calcolati al resultDb per fare il compare dopo
        $nessunaSorgenteDataKey = -1;
        foreach ($data['data'] as $key => $dataRow) {
            if ($dataRow[0] == 'nessuna sorgente') {
                $nessunaSorgenteDataKey = $key;
                break;
            }
        }

        $data['data'][$nessunaSorgenteDataKey] = array(
            'nessuna sorgente',
            $nessunaSorgenteRow['richieste'] . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"$nessunaSorgenteCompareRichiesteValue\">($nessunaSorgenteCompareRichiestePerc%)</span>",
            '€ ' . number_format($nessunaSorgenteRow['fatturato'], 2, ',', '.') . " <span class=\"compare text-compare\" data-toggle=\"tooltip\" title=\"€ $nessunaSorgenteCompareFatturatoValueFormatted\">($nessunaSorgenteCompareFatturatoPerc%)</span>"
        );
    }
}
//endregion TABELLA ANNULLATE

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

function getFatturatoSito($db, $startDateStr, $endDateStr, $idSito){
        $sql = "SELECT SUM(p.PrezzoP) as 'fatturato'
                    FROM hospitality_guest g
                    INNER JOIN hospitality_proposte p ON g.Id = p.id_richiesta      
                    WHERE (g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr')
                    AND g.TipoRichiesta = 'Conferma' 
                    AND g.idsito = $idSito
                    AND g.NoDisponibilita = 0
                    AND g.Disdetta = 0
                    AND g.Hidden = 0
                    AND g.FontePrenotazione LIKE '%sito web%'";
          
    $result = $db->query($sql);
    return $result[0]['fatturato'];
}

function getConfermatiSito(MysqliDb $db, $startDateStr, $endDateStr, $idSito)
{


     $sql = "SELECT COUNT(g.Id) as 'num'
                    FROM hospitality_guest g
                    INNER JOIN hospitality_proposte p ON g.Id = p.id_richiesta      
                    WHERE (g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr')
                    AND g.TipoRichiesta = 'Conferma' 
                    AND g.idsito = $idSito
                    AND g.NoDisponibilita = 0
                    AND g.Disdetta = 0
                    AND g.Hidden = 0
                    AND g.FontePrenotazione LIKE '%sito web%'";

     $result = $db->query($sql);
    return $result[0]['num']; 
}

function getFatturatoTotale($db, $startDateStr, $endDateStr, $idSito, $fonteFilter, $noDisponibilita = 0)
{
    $sql = "SELECT SUM(p.PrezzoP) as 'fatturato'
              FROM hospitality_guest g
        INNER JOIN hospitality_proposte p ON p.id_richiesta = g.Id
             WHERE (g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr')
               AND g.idsito = $idSito
               " . ($noDisponibilita == 1 ? " AND g.NoDisponibilita = $noDisponibilita" : '') . " 
               AND g.Hidden = 0
               AND g.TipoRichiesta = 'Conferma'
               AND g.Chiuso = 1
               AND g.FontePrenotazione LIKE '$fonteFilter'";

    $result = $db->query($sql);
    return $result[0]['fatturato'];
}

function getRichieste(MysqliDb $db, $startDateStr, $endDateStr, $idSito, $sorgente, $media, $noDisponibilita = 0)
{
    $sql = "SELECT COUNT(col) as num
              FROM (
                     SELECT cd.clientid as col
                       FROM hospitality_guest g
                 INNER JOIN hospitality_client_id cid ON cid.NumeroPrenotazione = g.NumeroPrenotazione AND cid.idsito = $idSito
                 INNER JOIN hospitality_custom_dimension cd ON cd.clientid = cid.CLIENT_ID AND cd.idsito = $idSito  AND cd.source = '$sorgente' AND cd.medium = '$media'
                      WHERE (g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr')
                        AND g.idsito = $idSito
                        " . ($noDisponibilita == 1 ? " AND g.NoDisponibilita = $noDisponibilita" : '') . " 
                        AND g.Hidden = 0
                        AND g.FontePrenotazione LIKE '%sito web%'
                        AND g.TipoRichiesta = 'Preventivo'
                   GROUP BY cd.source, cd.medium, cd.clientid, g.NumeroPrenotazione
              ) as sub";

    $result = $db->query($sql);
    return $result[0]['num'];
}

function getInviati(MysqliDb $db, $startDateStr, $endDateStr, $idSito, $sorgente, $media)
{
    $sql = "SELECT COUNT(col) as num
              FROM (
                     SELECT g.NumeroPrenotazione as col
                       FROM hospitality_guest g
                 INNER JOIN hospitality_client_id cid ON cid.NumeroPrenotazione = g.NumeroPrenotazione AND cid.idsito = $idSito
                 INNER JOIN hospitality_custom_dimension cd ON cd.clientid = cid.CLIENT_ID AND cd.idsito = $idSito  AND cd.source = '$sorgente' AND cd.medium = '$media'
                      WHERE (g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr')
                        AND g.idsito = $idSito
                        AND g.Inviata = 1
                        AND g.Hidden = 0
                        AND g.FontePrenotazione LIKE '%sito web%'
                   GROUP BY cd.source, cd.medium, cd.clientid, g.NumeroPrenotazione
              ) as sub";

    $result = $db->query($sql);
    return $result[0]['num'];
}

function getConfermati(MysqliDb $db, $startDateStr, $endDateStr, $idSito, $sorgente, $media, $noDisponibilita = 0)
{

    $sql = "SELECT COUNT(col) as num
              FROM (
                     SELECT DISTINCT g.NumeroPrenotazione as col
                       FROM hospitality_guest g
                 INNER JOIN hospitality_client_id cid ON cid.NumeroPrenotazione = g.NumeroPrenotazione AND cid.idsito = $idSito
                 INNER JOIN hospitality_custom_dimension cd ON cd.clientid = cid.CLIENT_ID 
                                                           AND cd.idsito = $idSito 
                                                           AND cd.source = '$sorgente' 
                                                           AND cd.medium = '$media' 
                                                           AND cd.urlpath LIKE '%res=sent%'
                                                           AND cd.urlpath NOT LIKE '%newsletter%'
                                                           
                      WHERE ((g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr') OR (DATE(g.DataChiuso) >= '$startDateStr' AND DATE(g.DataChiuso) <= '$endDateStr'))
                        AND g.idsito = $idSito
                        AND g.NoDisponibilita = $noDisponibilita
                        AND g.Disdetta = 0                        
                        AND g.FontePrenotazione LIKE '%sito web%'
                        AND g.TipoRichiesta = 'Conferma'
                                                 
                   GROUP BY cd.source, cd.medium, cd.clientid ,g.NumeroPrenotazione
              ) as sub";
     $result = $db->query($sql);
    return $result[0]['num']; 
}

function getFatturato(MysqliDb $db, $startDateStr, $endDateStr, $idSito, $sorgente, $media, $noDisponibilita = 0)
{
/*     $sql = "SELECT SUM(fatturato) as fatturato
              FROM (
                     SELECT SUM(DISTINCT p.PrezzoP) as fatturato
                       FROM hospitality_guest g
                 INNER JOIN hospitality_proposte p ON g.id = p.id_richiesta AND p.CheckProposta = 1
                 INNER JOIN hospitality_client_id cid ON cid.NumeroPrenotazione = g.NumeroPrenotazione AND cid.idsito = $idSito
                 INNER JOIN hospitality_custom_dimension cd ON cd.clientid = cid.CLIENT_ID AND cd.idsito = $idSito AND cd.urlpath LIKE '%res=sent%' AND cd.urlpath NOT LIKE '%newsletter%' AND cd.source = '$sorgente' AND cd.medium = '$media'
                 
                      WHERE (g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr')
                        AND g.idsito = $idSito
                        " . ($noDisponibilita == 1 ? " AND g.NoDisponibilita = $noDisponibilita" : '') . " 
                        AND g.TipoRichiesta = 'Conferma'
             
                        AND g.Hidden = 0
                        AND g.FontePrenotazione LIKE '%sito web%'

                   GROUP BY cd.source, cd.medium, cd.clientid, g.NumeroPrenotazione
              ) as sub"; */
    $sql = "SELECT SUM(fatturato) as fatturato
              FROM (
                     SELECT SUM(DISTINCT p.PrezzoP) as fatturato
                       FROM hospitality_guest g
                 INNER JOIN hospitality_proposte p ON g.id = p.id_richiesta
                 INNER JOIN hospitality_client_id cid ON cid.NumeroPrenotazione = g.NumeroPrenotazione AND cid.idsito = $idSito                           
                 INNER JOIN hospitality_custom_dimension cd ON cd.clientid = cid.CLIENT_ID 
                                                           AND cd.idsito = $idSito 
                                                           AND cd.urlpath LIKE '%res=sent%'
                                                           AND cd.urlpath NOT LIKE '%newsletter%'        
                                                           AND cd.source = '$sorgente' 
                                                           AND cd.medium = '$media'

                      WHERE ( (g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr') OR (DATE(g.DataChiuso) >= '$startDateStr' AND DATE(g.DataChiuso) <= '$endDateStr') )
                        AND g.idsito = $idSito
                        AND g.NoDisponibilita = $noDisponibilita                         
                        AND g.Disdetta = 0
                        AND g.FontePrenotazione LIKE '%sito web%'
                        AND g.TipoRichiesta = 'Conferma'
                                       
                   GROUP BY cd.source, cd.medium, cd.clientid, g.NumeroPrenotazione
              ) as sub";
    $result = $db->query($sql);
    return $result[0]['fatturato'];
}

function getFatturatoBE(MysqliDb $db, $startDateStr, $endDateStr, $idSito, $sorgente, $media)
{
    $sql = "SELECT SUM(fatturato) as fatturato
              FROM hospitality_adCost_transactionRevenue t
              WHERE t.idsito = $idSito
                AND (t.datastart >= '$startDateStr' AND t.datastart <= '$endDateStr')
                AND t.source = '$sorgente'  
                AND t.medium = '$media'";
    $result = $db->query($sql);
    return $result[0]['fatturato'];
}

function getFatturatoBETotale(MysqliDb $db, $startDateStr, $endDateStr, $idSito)
{
    $sql = "SELECT SUM(fatturato) as fatturato
              FROM hospitality_adCost_transactionRevenue t
              WHERE t.idsito = $idSito
                AND (t.datastart >= '$startDateStr' AND t.datastart <= '$endDateStr')";
    $result = $db->query($sql);
    return $result[0]['fatturato'];
}

function getRichiesteTotali($db, $startDateStr, $endDateStr, $idSito, $noDisponibilita = 0)
{
    $sql = "         SELECT count(DISTINCT(g.Id)) as num
                       FROM hospitality_guest g
                      WHERE (g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr')
                        AND g.idsito = $idSito
                        " . ($noDisponibilita == 1 ? " AND g.NoDisponibilita = $noDisponibilita" : '') . " 
                        AND g.Hidden = 0
                        AND g.FontePrenotazione LIKE '%sito web%'      
                        AND g.TipoRichiesta = 'Preventivo'             
            ";

    $result = $db->query($sql);
    return $result[0]['num'];
}

function getInviatiTotali($db, $startDateStr, $endDateStr, $idSito)
{
    $sql = "         SELECT count(DISTINCT(g.Id)) as num
                       FROM hospitality_guest g
                      WHERE (g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr')
                        AND g.idsito = $idSito
                        AND g.Hidden = 0
                        AND g.Inviata = 1
                        AND g.FontePrenotazione LIKE '%sito web%'               
            ";

    $result = $db->query($sql);
    return $result[0]['num'];
}

function getConfermatiTotali($db, $startDateStr, $endDateStr, $idSito, $noDisponibilita = 0)
{
    $sql = "         SELECT count(g.id) as num
                       FROM hospitality_guest g
                      WHERE ((g.DataRichiesta >= '$startDateStr' AND g.DataRichiesta <= '$endDateStr' AND g.TipoRichiesta = 'Conferma')
                                 OR (DATE(g.DataChiuso) >= '$startDateStr' AND DATE(g.DataChiuso) <= '$endDateStr' AND g.TipoRichiesta = 'Conferma'))
                        AND g.idsito = $idSito
                        " . ($noDisponibilita == 1 ? " AND g.NoDisponibilita = $noDisponibilita" : '') . " 
                        AND g.Hidden = 0                                                
                        AND g.FontePrenotazione LIKE '%sito web%'                   
            ";

    $result = $db->query($sql);
    return $result[0]['num'];
}

function getCustomSortOrder($channel)
{
    $sortOrder = 0;
    if ($channel == '(direct) (none)') {
        $sortOrder = 10;
    } else if ($channel == 'facebook social') {
        $sortOrder = 20;
    } else if ($channel == 'google cpc') {
        $sortOrder = 30;
    } else if ($channel == 'google organic') {
        $sortOrder = 40;
    } else if ($channel == 'newsletter email') {
        $sortOrder = 50;
    } else {
        $sortOrder = 100;
    }

    return $sortOrder;
}