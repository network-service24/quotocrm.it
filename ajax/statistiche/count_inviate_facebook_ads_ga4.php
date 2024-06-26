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



function numero_campagne_da_landing($idsito, $tracking, $campagna)
{
    global $db, $filter_query_custom_client_id;

    if ($tracking == 'google') {
        $AND_CPC = "AND 
                        hospitality_custom_dimension_ga4.source = 'google' 
                    AND 
                        hospitality_custom_dimension_ga4.medium = 'cpc' ";
    }
    if ($tracking == 'facebook') {
        $AND_CPC = "AND 
                        hospitality_custom_dimension_ga4.source = 'facebook' 
                    AND 
                        hospitality_custom_dimension_ga4.medium = 'social' ";
    }
    if ($tracking == 'newsletter') {
        $AND_CPC = "AND 
                        (hospitality_custom_dimension_ga4.source = 'newsletter' OR hospitality_custom_dimension_ga4.source = 'sendinblue')
                    AND 
                        hospitality_custom_dimension_ga4.medium = 'email' ";
    }
    $q = "  SELECT 
                    COUNT(hospitality_custom_dimension_ga4.id) as n_preventivi  
                FROM 
                    hospitality_custom_dimension_ga4
    
                WHERE 
                    hospitality_custom_dimension_ga4.idsito = " . $idsito . " 
    
                " . $filter_query_custom_client_id . "
    
                " . $AND_CPC . "
    
                AND 
                    hospitality_custom_dimension_ga4.campaign = '" . $campagna . "' 

                AND 
                    hospitality_custom_dimension_ga4.urlpath NOT LIKE '%php?res%'
                AND 
                    hospitality_custom_dimension_ga4.urlpath LIKE '%/?res=sent%'";

    $r = $db->query($q);
    $rw = $r[0];

    if (sizeof($r)> 0) {

        $n_preventivi = $rw['n_preventivi'];
    } else {
        $n_preventivi = 0;
    }


    return $n_preventivi;


}

function numero_preventivi_inviati_per_campagna($idsito, $tracking, $campagna)
{
    global $db, $filter_query_custom_client_id;

    if ($tracking == 'google') {
        $AND_CPC = " AND 
                            hospitality_custom_dimension_ga4.source = 'google' 
                         AND 
                            hospitality_custom_dimension_ga4.medium = 'cpc' ";
    }
    if ($tracking == 'facebook') {
        $AND_CPC = " AND 
                            hospitality_custom_dimension_ga4.source = 'facebook' 
                         AND 
                            hospitality_custom_dimension_ga4.medium = 'social' ";
    }
    if ($tracking == 'newsletter') {
        $AND_CPC = " AND 
                            (hospitality_custom_dimension_ga4.source = 'newsletter' OR hospitality_custom_dimension_ga4.source = 'sendinblue')
                         AND 
                            hospitality_custom_dimension_ga4.medium = 'email' ";
    }
    $q = "  SELECT 
                    (hospitality_custom_dimension_ga4.id) as n_preventivi_inviati
                FROM 
                    hospitality_custom_dimension_ga4
                INNER JOIN
                    hospitality_client_id ON 
                    SUBSTRING(hospitality_client_id.CLIENT_ID , -10, 10) = hospitality_custom_dimension_ga4.clientid
                    OR
                    hospitality_client_id.NumeroPrenotazione = hospitality_custom_dimension_ga4.NumeroPrenotazione
                INNER JOIN
                    hospitality_guest ON hospitality_guest.NumeroPrenotazione = hospitality_client_id.NumeroPrenotazione
                WHERE 
                    hospitality_custom_dimension_ga4.idsito = " . $idsito . " 
    
                " . $filter_query_custom_client_id . "
    
                " . $AND_CPC . "
                AND 
                    hospitality_guest.idsito = " . $idsito . " 
                AND 
                    hospitality_client_id.idsito = " . $idsito . " 
                AND 
                    hospitality_guest.Inviata = 1 
                AND 
                    hospitality_guest.FontePrenotazione = 'Sito Web'
                AND 
                    hospitality_guest.TipoRichiesta ='Preventivo'
                AND 
                    hospitality_custom_dimension_ga4.campaign = '" . $campagna . "'
                GROUP BY
                    hospitality_guest.Id ";

    $r = $db->query($q);
    $rw = sizeof($r);


    if ($rw > 0) {
        $n_preventivi_inviati = $rw;
    } else {
        $n_preventivi_inviati = 0;
    }


    return $n_preventivi_inviati;


}

function numero_campagne_da_sito($idsito, $tracking, $campagna)
{
    global $db, $filter_query_custom_client_id;

    if ($tracking == 'google') {
        $AND_CPC = " AND 
                            hospitality_custom_dimension_ga4.source = 'google' 
                         AND 
                            hospitality_custom_dimension_ga4.medium = 'cpc' ";
    }
    if ($tracking == 'facebook') {
        $AND_CPC = " AND 
                            hospitality_custom_dimension_ga4.source = 'facebook' 
                         AND 
                            hospitality_custom_dimension_ga4.medium = 'social' ";
    }
    if ($tracking == 'newsletter') {
        $AND_CPC = " AND 
                            (hospitality_custom_dimension_ga4.source = 'newsletter' OR hospitality_custom_dimension_ga4.source = 'sendinblue')
                         AND 
                            hospitality_custom_dimension_ga4.medium = 'email' ";
    }
    $q = "  SELECT 
                    COUNT(hospitality_custom_dimension_ga4.id) as n_preventivi
                FROM 
                    hospitality_custom_dimension_ga4
                WHERE 
                    hospitality_custom_dimension_ga4.idsito = " . $idsito . " 
    
                " . $filter_query_custom_client_id . "
    
                " . $AND_CPC . "
    
                AND 
                    hospitality_custom_dimension_ga4.campaign = '" . $campagna . "' 
                AND 
                    hospitality_custom_dimension_ga4.urlpath LIKE '%?res=sent%'
                AND 
                    hospitality_custom_dimension_ga4.urlpath NOT LIKE '%/?res%'";

    $r = $db->query($q);
    $rw = $r[0];


    if (sizeof($r) > 0) {
        $n_preventivi = $rw['n_preventivi'];
    } else {
        $n_preventivi = 0;
    }


    return $n_preventivi;


}

function n_campagne_chiuse_new($idsito, $tracking, $campagna)
{
    global $db, $filter_query;

    $q = "  SELECT
                         DISTINCT(hospitality_client_id.NumeroPrenotazione)
                    FROM 
                        hospitality_client_id 
                    INNER JOIN 
                        hospitality_custom_dimension_ga4 ON 
                        hospitality_custom_dimension_ga4.clientid = SUBSTRING(hospitality_client_id.CLIENT_ID , -10, 10)
                        OR
                        hospitality_custom_dimension_ga4.NumeroPrenotazione = hospitality_client_id.NumeroPrenotazione
                    WHERE  
                        hospitality_client_id.idsito = " . $idsito . " 
                    AND
                        hospitality_custom_dimension_ga4.idsito = " . $idsito . " 
                    AND
                        hospitality_custom_dimension_ga4.campaign = '" . $campagna . "'
                    GROUP BY 
                        hospitality_custom_dimension_ga4.clientid";

    $rw = $db->query($q);

    foreach ($rw as $key => $value) {
        $array_chiuse[] = $value['NumeroPrenotazione'];
    }
    if (sizeof($rw) > 0) {
        $num_chiuse = implode(',', $array_chiuse);

        $q = "  SELECT
                        COUNT(hospitality_guest.id) as n_chiuse
                    FROM 
                        hospitality_guest 
                    WHERE 
                        hospitality_guest.idsito = " . $idsito . " 
    
                        " . $filter_query . "
                    AND
                        hospitality_guest.NumeroPrenotazione IN (" . $num_chiuse . ")
                    AND
                        hospitality_guest.FontePrenotazione = 'Sito Web'
    
                    AND 
                        hospitality_guest.Disdetta = 0
                    AND 
                        hospitality_guest.Hidden = 0
                    AND 
                        hospitality_guest.NoDisponibilita = 0
                    AND 
                        hospitality_guest.TipoRichiesta = 'Conferma'";
        $r = $db->query($q);
        $rw = $r[0];


        $chiuse = $rw['n_chiuse'];
    } else {
        $chiuse = 0;
    }

    return $chiuse;


}

function fatturato_per_campagna($idsito, $campagna)
{
    global $db, $filter_query;

    $sl = "SELECT 
    
                        hospitality_proposte.PrezzoP as fatturato
                    FROM 
                        hospitality_guest
                    INNER JOIN 
                        hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                    INNER JOIN 
                        hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                    INNER JOIN 
                        hospitality_custom_dimension_ga4 ON 
                        hospitality_custom_dimension_ga4.clientid = SUBSTRING(hospitality_client_id.CLIENT_ID , -10, 10)
                        OR
                        hospitality_custom_dimension_ga4.NumeroPrenotazione = hospitality_client_id.NumeroPrenotazione
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
                        hospitality_custom_dimension_ga4.campaign = '" . $campagna . "' 
                    GROUP BY 
                        hospitality_guest.NumeroPrenotazione";

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


$sqln = "SELECT distinct(hospitality_client_id.NumeroPrenotazione)
            FROM hospitality_client_id
            INNER JOIN hospitality_custom_dimension_ga4 ON 
            hospitality_custom_dimension_ga4.clientid = SUBSTRING(hospitality_client_id.CLIENT_ID , -10, 10)
            OR
            hospitality_custom_dimension_ga4.NumeroPrenotazione = hospitality_client_id.NumeroPrenotazione
            WHERE hospitality_client_id.idsito = " . $idsito . "
            AND hospitality_custom_dimension_ga4.idsito = " . $idsito . "
            AND hospitality_custom_dimension_ga4.source = 'facebook'
            AND hospitality_custom_dimension_ga4.medium = 'social'";
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
                            AND hospitality_custom_dimension_ga4.source = 'facebook'
                            AND hospitality_custom_dimension_ga4.medium = 'social'
                            AND hospitality_custom_dimension_ga4.campaign != '(not set)'
                            GROUP BY hospitality_custom_dimension_ga4.campaign";
$rws9n = $db->query($select9n);

$totCampn = sizeof($rws9n);

$output = '';


if ($totCampn > 0) {


    $output = '<table class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                            <tr>
                                <th class="nowrap thStatistiche">Campagne</th>
                                <th class="nowrap text-center thStatistiche">Ricevute.da Landing</th>
                                <th class="nowrap text-center thStatistiche">Ricevute.da Sito Web</th>
                                <th class="nowrap text-center thStatistiche">Inviate</th>
                                <th class="nowrap text-center thStatistiche">Confermate</th>
                                <th class="nowrap text-center thStatistiche text-center">Conversione %</th>                                  
                                <th class="nowrap text-center thStatistiche">Fatturato</th>
                            </tr>';

    $numero_landing   = '';
    $numero_sito      = '';
    $n_landing        = '';
    $n_sito           = '';
    $preno_chiuse     = '';
    $numero_prev_send = '';



    foreach ($rws9n as $key9n => $value9n) {


        $numero_landing    = numero_campagne_da_landing($idsito, 'facebook', $value9n['Campagna']);
        $numero_prev_send  = numero_preventivi_inviati_per_campagna($idsito, 'facebook', $value9n['Campagna']);
        $numero_sito       = numero_campagne_da_sito($idsito, 'facebook', $value9n['Campagna']);
        $preno_chiuse      = n_campagne_chiuse_new($idsito, 'facebook', $value9n['Campagna']);
        $totalePerCampagna = fatturato_per_campagna($idsito, $value9n['Campagna']);

        if ($numero_landing > 0 || $numero_sito == 0) {
            $n_landing = $numero_landing;
            $totLanding += $numero_landing;
            $totRichieste += $numero_landing;
            $n_sito = 0;  
        }
        if ($numero_sito > 0 || $numero_landing == 0) {

            $n_sito = $numero_sito;
            $totRichieste += $numero_sito;
            $n_landing = 0;
        }
        
        $fatturatoCampn = $totalePPCn;
        if ($fatturatoCampn == '') $fatturatoCampn = 0;
        $array_fatturatoSn[] = $fatturatoCampn;


        $totRichieste = $n_landing + $n_sito;
       // $tassoConvPreventivi = $totRichieste > 0 ? number_format($numero_prev_send * 100 / $totRichieste, 2, ',', '.') . '%' : '-';
        //$tassoConvConferme = $totRichieste > 0 ? number_format($preno_chiuse * 100 / $totRichieste, 2, ',', '.').'%' : '-';
        $tassoConvConferme = $numero_prev_send > 0 ? number_format($preno_chiuse * 100 / $numero_prev_send, 2, ',', '.') . '%' : '-';

        $output .= '<tr>
                        <td class="text-left nowrap">' . $value9n['Campagna'] . '</td>
                        <td class="text-center">' . $n_landing . '</td>   
                        <td class="text-center">' . $n_sito . '</td>  
                        <td class="text-center">' . $numero_prev_send . '</td> 
                        <td class="text-center">' . $preno_chiuse . '</td>
                        <td class="text-center">' . ($numero_prev_send>$totRichieste?'':$tassoConvConferme ). '</td>                        
                        <td class="text-right nowrap"><i class="fa fa-euro"></i> ' . number_format($totalePerCampagna, 2, ',', '.') . '</td>
                    </tr>';


        $n_landing        = '';
        $n_sito           = '';
        $preno_chiuse     = '';
        $numero_prev_send = '';

    }


    $output .= '<tr>
                    <td><b>TOTALE</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right nowrap"><b><i class="fa fa-euro"></i><b> ' . number_format($totalePPCn, 2, ',', '.') . '</b></td>
                </tr>';
    $output .= '</table>';

}


echo $output;
