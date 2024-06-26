<?php

include($_SERVER['DOCUMENT_ROOT'] . '/include/settings.inc.php');

$usernameQ = DB_USER;
$passwordQ = DB_PASSWORD;
$hostQ     = HOST;
$dbnameQ   = DATABASE;

require_once($_SERVER['DOCUMENT_ROOT'] . '/class/MysqliDb.php');

$db = new MysqliDb($hostQ, $usernameQ, $passwordQ, $dbnameQ);

$idsito                        = $_REQUEST['idsito'];
$filter_query_custom_client_id = $_REQUEST['filter_query_custom_client_id'];
$filter_query                  = $_REQUEST['filter_query'];
$filter_ads                    = $_REQUEST['filter_ads'];
$filter                        = $_REQUEST['filter'];

function fatturato_per_campagna($idsito, $campagna)
{
    global $db, $filter_query;

    $sl = "SELECT 
    
                ( SELECT hospitality_proposte.PrezzoP FROM hospitality_proposte  WHERE hospitality_proposte.id_richiesta = hospitality_guest.Id LIMIT 1) as 'fatturato'
                    FROM 
                        hospitality_guest

                    INNER JOIN 
                        hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                    INNER JOIN 
                        hospitality_custom_dimension_ga4 ON (
                                hospitality_custom_dimension_ga4.clientid = hospitality_client_id.CLIENT_ID 
                            AND 
                                hospitality_client_id.CLIENT_ID != '' 
                            OR 
                                hospitality_custom_dimension_ga4.NumeroPrenotazione = hospitality_client_id.NumeroPrenotazione 
                            AND 
                                hospitality_custom_dimension_ga4.NumeroPrenotazione != ''
                            )  
                    WHERE 
                        1=1
                        " . $filter_query . "
                    AND 
                        hospitality_guest.idsito = " . $idsito . "
    
                    AND 
                        hospitality_guest.FontePrenotazione = 'Sito Web'
                    AND 
                        hospitality_guest.Disdetta = 0
                    AND 
                        hospitality_guest.Hidden = 0
                    AND 
                        hospitality_guest.NoDisponibilita = 0
                    AND 
                        hospitality_guest.TipoRichiesta = 'Conferma' 
                    AND 
                        hospitality_client_id.idsito = " . $idsito . "
                    AND 
                        hospitality_custom_dimension_ga4.idsito = " . $idsito . "
                    AND 
                        hospitality_custom_dimension_ga4.source = 'google'
                    AND 
                        hospitality_custom_dimension_ga4.medium = 'cpc'
                    AND 
                        hospitality_custom_dimension_ga4.campaign = '" . addslashes($campagna) . "' 
                    AND 
                        hospitality_custom_dimension_ga4.campaign != '(organic)' 
                    GROUP BY 
                        hospitality_guest.Id";

    $rec = $db->query($sl);

    if (sizeof($rec) > 0) {
        foreach ($rec as $key => $value) {
            $arraytotalePerCampagna[] = $value['fatturato'];
        }
        $output = array_sum($arraytotalePerCampagna);
    } else {
        $output = 0;
    }

    return $output;

}
function CountConfermateAds($idsito,$campagna){
    global $db,$filter_query;

     $sql      = "   SELECT 
                        hospitality_guest.* 
                    FROM 
                        hospitality_guest 
                    INNER JOIN 
                        hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                    INNER JOIN 
                            hospitality_custom_dimension_ga4 ON (
                                    hospitality_custom_dimension_ga4.clientid = hospitality_client_id.CLIENT_ID 
                                AND 
                                    hospitality_client_id.CLIENT_ID != '' 
                                OR 
                                    hospitality_custom_dimension_ga4.NumeroPrenotazione = hospitality_client_id.NumeroPrenotazione 
                                AND 
                                    hospitality_custom_dimension_ga4.NumeroPrenotazione != ''
                                ) 
                    WHERE 
                        1 = 1
                        ".$filter_query."
                    AND 
                        hospitality_guest.idsito = ".$idsito." 
                    AND 
                        hospitality_guest.TipoRichiesta = 'Conferma' 
                    AND 
                        hospitality_guest.FontePrenotazione = 'Sito Web' 
                    AND 
                        hospitality_guest.NoDisponibilita = 0
                    AND 
                        hospitality_guest.Disdetta = 0
                    AND 
                        hospitality_guest.Hidden = 0
                    AND
                        hospitality_custom_dimension_ga4.source = 'google'
                    AND
                        hospitality_custom_dimension_ga4.medium = 'cpc' 
                    AND 
                        hospitality_custom_dimension_ga4.campaign = '" . addslashes($campagna) . "'
                    AND 
                        hospitality_client_id.idsito = ".$idsito." 
                    AND 
                        hospitality_custom_dimension_ga4.idsito = ".$idsito." 
                    GROUP BY
                    hospitality_custom_dimension_ga4.clientid,
                    hospitality_guest.NumeroPrenotazione";

    $rw = $db->query($sql);
    $rwc = sizeof($rw);

        return $rwc;

}
function CountInviateAds($idsito,$campagna){
    global $db,$filter_query;

    $sql      = "   SELECT 
                        hospitality_guest.* 
                    FROM 
                        hospitality_guest 
                    INNER JOIN 
                        hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                    INNER JOIN 
                            hospitality_custom_dimension_ga4 ON (
                                    hospitality_custom_dimension_ga4.clientid = hospitality_client_id.CLIENT_ID 
                                AND 
                                    hospitality_client_id.CLIENT_ID != '' 
                                OR 
                                    hospitality_custom_dimension_ga4.NumeroPrenotazione = hospitality_client_id.NumeroPrenotazione 
                                AND 
                                    hospitality_custom_dimension_ga4.NumeroPrenotazione != ''
                                ) 
                    WHERE 
                        1 = 1
                        ".$filter_query."
                    AND 
                        hospitality_guest.idsito = ".$idsito." 
                    AND 
                        hospitality_guest.TipoRichiesta = 'Preventivo' 
                    AND 
                        hospitality_guest.FontePrenotazione = 'Sito Web' 
                    AND 
                        hospitality_guest.NoDisponibilita = 0
                    AND 
                        hospitality_guest.Disdetta = 0
                    AND 
                        hospitality_guest.Hidden = 0
                    AND 
                        hospitality_guest.Inviata = 1
                    AND
                        hospitality_custom_dimension_ga4.source = 'google'
                    AND
                        hospitality_custom_dimension_ga4.medium = 'cpc' 
                    AND 
                        hospitality_custom_dimension_ga4.campaign = '" . addslashes($campagna) . "'
                    AND 
                        hospitality_client_id.idsito = ".$idsito." 
                    AND 
                        hospitality_custom_dimension_ga4.idsito = ".$idsito." 
                    GROUP BY
                    hospitality_custom_dimension_ga4.clientid,
                        hospitality_guest.NumeroPrenotazione";

    $rw = $db->query($sql);
    $rwc = sizeof($rw);

        return $rwc;

}
function CountRicevuteAds($idsito,$campagna){
    global $db,$filter_query;

    $sql      = "   SELECT 
                        hospitality_guest.* 
                    FROM 
                        hospitality_guest 
                    INNER JOIN 
                        hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                    INNER JOIN 
                            hospitality_custom_dimension_ga4 ON (
                                    hospitality_custom_dimension_ga4.clientid = hospitality_client_id.CLIENT_ID 
                                AND 
                                    hospitality_client_id.CLIENT_ID != '' 
                                OR 
                                    hospitality_custom_dimension_ga4.NumeroPrenotazione = hospitality_client_id.NumeroPrenotazione 
                                AND 
                                    hospitality_custom_dimension_ga4.NumeroPrenotazione != ''
                                ) 
                    WHERE 
                        1 = 1
                        ".$filter_query."
                    AND 
                        hospitality_guest.idsito = ".$idsito." 
                    AND 
                        hospitality_guest.TipoRichiesta = 'Preventivo' 
                    AND 
                        hospitality_guest.FontePrenotazione = 'Sito Web' 
                    AND 
                        hospitality_guest.NoDisponibilita = 0
                    AND 
                        hospitality_guest.Disdetta = 0
                    AND 
                        hospitality_guest.Hidden = 0
                    AND
                        hospitality_custom_dimension_ga4.source = 'google'
                    AND
                        hospitality_custom_dimension_ga4.medium = 'cpc'
                    AND 
                        hospitality_custom_dimension_ga4.campaign = '" . addslashes($campagna) . "' 
                    AND 
                        hospitality_client_id.idsito = ".$idsito." 
                    AND 
                        hospitality_custom_dimension_ga4.idsito = ".$idsito." 
                    GROUP BY
                    hospitality_custom_dimension_ga4.clientid,
                        hospitality_guest.NumeroPrenotazione";

    $rw = $db->query($sql);
    $rwc = sizeof($rw);

        return $rwc;

}
 

function badget_per_campagna($idsito,$tracking, $campagna)
{
    global $db, $filter_ads;

    if ($tracking == 'google') {
        $AND_CPC = " AND 
                            hospitality_adCost_transactionRevenue_ga4.source = 'google' 
                         AND 
                            hospitality_adCost_transactionRevenue_ga4.medium = 'cpc' ";
    }
    if ($tracking == 'facebook') {
        $AND_CPC = " AND 
                            hospitality_adCost_transactionRevenue_ga4.source = 'facebook' 
                         AND 
                            hospitality_adCost_transactionRevenue_ga4.medium = 'social' ";
    }
    if ($tracking == 'newsletter') {
        $AND_CPC = " AND 
                            (hospitality_adCost_transactionRevenue_ga4.source = 'newsletter' OR hospitality_adCost_transactionRevenue_ga4.source = 'sendinblue')
                         AND 
                            hospitality_adCost_transactionRevenue_ga4.medium = 'email' ";
    }

    $sl = "         SELECT 
                        hospitality_adCost_transactionRevenue_ga4.badget as badget
                    FROM 
                        hospitality_adCost_transactionRevenue_ga4
                    WHERE 
                        hospitality_adCost_transactionRevenue_ga4.idsito = " . $idsito . "

                        " . $AND_CPC . "

                        ".$filter_ads."                    
                    AND 
                        hospitality_adCost_transactionRevenue_ga4.campaign = '" . addslashes($campagna) . "' ";

    $rec = $db->query($sl);

    if (sizeof($rec) > 0) {
        foreach ($rec as $key => $value) {
            $arraytotalePerCampagna[] = $value['badget'];
        }
        $output = array_sum($arraytotalePerCampagna);
    } else {
        $output = 0;
    }

    return $output;

}
 function fatturatoBe_per_campagna($idsito,$tracking, $campagna)
{
    global $db, $filter_ads;

    if ($tracking == 'google') {
        $AND_CPC = " AND 
                            hospitality_adCost_transactionRevenue_ga4.source = 'google' 
                         AND 
                            hospitality_adCost_transactionRevenue_ga4.medium = 'cpc' ";
    }
    if ($tracking == 'facebook') {
        $AND_CPC = " AND 
                            hospitality_adCost_transactionRevenue_ga4.source = 'facebook' 
                         AND 
                            hospitality_adCost_transactionRevenue_ga4.medium = 'social' ";
    }
    if ($tracking == 'newsletter') {
        $AND_CPC = " AND 
                            (hospitality_adCost_transactionRevenue_ga4.source = 'newsletter' OR hospitality_adCost_transactionRevenue_ga4.source = 'sendinblue')
                         AND 
                            hospitality_adCost_transactionRevenue_ga4.medium = 'email' ";
    }

    $sl = "         SELECT 

                        SUM(CONVERT(hospitality_adCost_transactionRevenue_ga4.fatturato, FLOAT)) as fatturato
                    FROM 
                        hospitality_adCost_transactionRevenue_ga4
                     WHERE 
                        hospitality_adCost_transactionRevenue_ga4.idsito = " . $idsito . "

                        " . $AND_CPC . "

                        ".$filter_ads." 
                    AND 
                        hospitality_adCost_transactionRevenue_ga4.campaign = '" . addslashes($campagna) . "' ";

    $rec = $db->query($sl);
    $output = $rec[0]['fatturato'];
    return $output;

}


$sqln = "SELECT distinct(hospitality_client_id.NumeroPrenotazione)
            FROM hospitality_client_id
            INNER JOIN hospitality_custom_dimension_ga4 ON hospitality_custom_dimension_ga4.clientid= hospitality_client_id.CLIENT_ID
            OR
            hospitality_custom_dimension_ga4.NumeroPrenotazione = hospitality_client_id.NumeroPrenotazione
            WHERE hospitality_client_id.idsito = " . $idsito . "
            AND hospitality_custom_dimension_ga4.idsito = " . $idsito . "
            AND hospitality_custom_dimension_ga4.source = 'google'
            AND hospitality_custom_dimension_ga4.medium = 'cpc'";
$rwsn = $db->query($sqln);
$check_socialn = sizeof($rwsn);
if ($check_socialn > 0) {
    foreach ($rwsn as $keyn => $valuen) {
        $NumeriPrenoSn[] = $valuen['NumeroPrenotazione'];
    }
    $NumeriSn = implode(',', $NumeriPrenoSn);

    $selectn = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                    FROM hospitality_guest
                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                    WHERE hospitality_guest.NumeroPrenotazione IN (" . $NumeriSn . ")
                    " . $filter_query . "
                    AND hospitality_guest.idsito = " . $idsito . "
                    AND hospitality_guest.FontePrenotazione = 'Sito Web'
                    AND hospitality_guest.Disdetta = 0
                    AND hospitality_guest.Hidden = 0
                    AND hospitality_guest.NoDisponibilita = 0
                    AND hospitality_guest.TipoRichiesta = 'Conferma' ";
    $resn = $db->query($selectn);
    $rwn = $resn[0];
    $totalePPCn = $rwn['fatturato'];
}

$select9n = "SELECT distinct(hospitality_custom_dimension_ga4.campaign) as Campagna, hospitality_custom_dimension_ga4.clientid
                            FROM hospitality_custom_dimension_ga4
                            WHERE hospitality_custom_dimension_ga4.idsito = " . $idsito . "
                            AND hospitality_custom_dimension_ga4.source = 'google'
                            AND hospitality_custom_dimension_ga4.medium = 'cpc'
                            AND hospitality_custom_dimension_ga4.campaign != '(not set)'
                            AND hospitality_custom_dimension_ga4.campaign != '(organic)'
                            GROUP BY hospitality_custom_dimension_ga4.campaign";
$rws9n = $db->query($select9n);

$totCampn = sizeof($rws9n);

$output = '';


if ($totCampn > 0) {


    $output = '<table class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                            <tr>
                                <th class="nowrap thStatistiche">Campagne</th>
                                <th class="nowrap text-center thStatistiche">Budget investito</th>
                                <th class="nowrap text-center thStatistiche">Ricevute</th>
                                <th class="nowrap text-center thStatistiche">Inviate</th>
                                <th class="nowrap text-center thStatistiche">Confermate</th>
                                <th class="nowrap text-center thStatistiche">Conversione %</th> 
                                <th class="nowrap text-center thStatistiche">Fatturato BE</th>                              
                                <th class="nowrap text-center thStatistiche">Fatturato QT</th>
                            </tr>';

    $numero_landing       = '';
    $numero_sito          = '';
    $n_landing            = '';
    $n_sito               = '';
    $preno_chiuse         = '';
    $numero_prev_send     = '';
    $totaleBadgetCampagna = '';
    $totaleFatturatoBeCampagna = '';


    foreach ($rws9n as $key9n => $value9n) {


        $numero_campagne    = CountRicevuteAds($idsito,$value9n['Campagna']);
        $numero_prev_send  = CountInviateAds($idsito,$value9n['Campagna']);
        $preno_chiuse      = CountConfermateAds($idsito,$value9n['Campagna']);
        $totaleBadgetCampagna = badget_per_campagna($idsito, 'google', $value9n['Campagna']);
        $totaleFatturatoBeCampagna = fatturatoBe_per_campagna($idsito, 'google', $value9n['Campagna']);
        $totalePerCampagna = fatturato_per_campagna($idsito, $value9n['Campagna']);

        $totRichieste += $numero_campagne;
        
        $fatturatoCampn = $totalePPCn;
        if ($fatturatoCampn == '') $fatturatoCampn = 0;
        $array_fatturatoSn[] = $fatturatoCampn;


        //$tassoConvPreventivi = $totRichieste > 0 ? number_format($numero_prev_send * 100 / $totRichieste, 2, ',', '.') . '%' : '-';
        //$tassoConvConferme = $totRichieste > 0 ? number_format($preno_chiuse * 100 / $totRichieste, 2, ',', '.').'%' : '-';
        $tassoConvConferme = $numero_prev_send > 0 ? number_format($preno_chiuse * 100 / $numero_prev_send, 2, ',', '.') . '%' : '-';

        $output .= '<tr>
                        <td class="text-left nowrap">' . $value9n['Campagna'] . '</td>
                        <td class="text-right nowrap"><i class="fa fa-euro"></i> ' . number_format($totaleBadgetCampagna, 2, ',', '.') . '</td>
                        <td class="text-center">' . $numero_campagne . '</td>   
                        <td class="text-center">' . $numero_prev_send . '</td> 
                        <td class="text-center">' . $preno_chiuse . '</td>
                        <td class="text-center">' . $tassoConvConferme . '</td>   
                        <td class="text-right nowrap"><i class="fa fa-euro"></i> ' . number_format($totaleFatturatoBeCampagna, 2, ',', '.') . '</td>              
                        <td class="text-right nowrap"><i class="fa fa-euro"></i> ' . number_format($totalePerCampagna, 2, ',', '.') . '</td>
                    </tr>';


        $numero_landing       = '';
        $numero_sito          = '';
        $n_landing            = '';
        $n_sito               = '';
        $preno_chiuse         = '';
        $numero_prev_send     = '';
        $totaleBadgetCampagna = '';
        $totaleFatturatoBeCampagna = '';

    }


    $numero_landing       = '';
    $numero_sito          = '';
    $n_landing            = '';
    $n_sito               = '';
    $preno_chiuse         = '';
    $numero_prev_send     = '';
    $totaleBadgetCampagna = '';
    $totaleFatturatoBeCampagna = '';

    $output .= '<tr>
                    <td><b>TOTALE</b></td>
                    <td></td>
                    <td class="text-center"></td>   
                    <td class="text-center"></td> 
                    <td class="text-center"></td>
                    <td></td>
                    <td></td>
                    <td class="text-right nonowrap"><b><i class="fa fa-euro"></i><b> ' . number_format($totalePPCn, 2, ',', '.') . '</b></td>
                </tr>';
    $output .= '</table>';

}


echo $output;
