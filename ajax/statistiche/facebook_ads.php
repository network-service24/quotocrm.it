<?php
include($_SERVER['DOCUMENT_ROOT'] . '/include/settings.inc.php');

$usernameQ = DB_USER;
$passwordQ = DB_PASSWORD;
$hostQ = HOST;
$dbnameQ = DATABASE;

require_once($_SERVER['DOCUMENT_ROOT'] . '/class/MysqliDb.php');

$db = new MysqliDb($hostQ, $usernameQ, $passwordQ, $dbnameQ);

$idsito = $_REQUEST['idsito'];
$filter_query_custom_client_id = $_REQUEST['filter_query_custom_client_id'];
$filter_query = $_REQUEST['filter_query'];

function colorGen()
{
    $caratteri_disponibili = "abcdef1234567890";
    $colore = "";
    for ($i = 0; $i < 6; $i++) {
        $colore .= substr($caratteri_disponibili, rand(0, strlen($caratteri_disponibili) - 1), 1);
    }
    return '#' . $colore;
}

function numero_campagne_da_landing($idsito, $tracking, $campagna, $clientid)
{
    global $db, $filter_query_custom_client_id;

    if ($tracking == 'google') {
        $AND_CPC = " AND hospitality_custom_dimension.source = 'google' 
                     AND hospitality_custom_dimension.medium = 'cpc' ";
    }
    if ($tracking == 'facebook') {
        $AND_CPC = " AND hospitality_custom_dimension.source = 'facebook' 
                     AND hospitality_custom_dimension.medium = 'social' ";
    }
    if ($tracking == 'newsletter') {
        $AND_CPC = " AND (hospitality_custom_dimension.source = 'newsletter' OR hospitality_custom_dimension.source = 'sendinblue')
                     AND hospitality_custom_dimension.medium = 'email' ";
    }
// Query originale Marcello
//    $q = "  SELECT COUNT(hospitality_custom_dimension.id) as n_preventivi
//              FROM hospitality_custom_dimension
//             WHERE hospitality_custom_dimension.idsito = $idsito
//                   $filter_query_custom_client_id
//                   $AND_CPC
//               AND hospitality_custom_dimension.campaign = '$campagna'
//               AND hospitality_custom_dimension.urlpath LIKE '%?res=sent'
//               AND (
//                       hospitality_custom_dimension.urlpath != '/?res=sent' AND
//                       hospitality_custom_dimension.urlpath != '/' AND
//                       hospitality_custom_dimension.urlpath != '/index.php' AND
//                       hospitality_custom_dimension.urlpath NOT LIKE '%.php?res=sent%' AND
//                       hospitality_custom_dimension.urlpath NOT LIKE '%.php%'
//               )
//    ";
    $q = "  SELECT COUNT(hospitality_custom_dimension.id) as n_preventivi  
              FROM hospitality_custom_dimension    
             WHERE hospitality_custom_dimension.idsito = $idsito     
                   $filter_query_custom_client_id     
                   $AND_CPC     
               AND hospitality_custom_dimension.campaign = '$campagna'
               AND hospitality_custom_dimension.urlpath LIKE '%res=sent'
               AND hospitality_custom_dimension.urlpath != '/?res=sent' 
               AND hospitality_custom_dimension.urlpath != '/' 
               AND hospitality_custom_dimension.urlpath != '/index.php' 
               AND hospitality_custom_dimension.urlpath NOT LIKE '%.php?res=sent%' 
               AND hospitality_custom_dimension.urlpath NOT LIKE '%.php%'               
    ";

    $r = $db->query($q);
    $rw = $r[0];
    if (is_array($rw)) {
        if ($rw > count($rw))
            $tot = count($rw);
    } else {
        $tot = 0;
    }

    if ($tot > 0) {
        $n_preventivi = $rw['n_preventivi'];
    } else {
        $n_preventivi = 0;
    }

    return $n_preventivi;
}

function numero_preventivi_inviati_per_campagna($idsito, $tracking, $campagna, $clientid)
{
    global $db, $filter_query_custom_client_id;

    if ($tracking == 'google') {
        $AND_CPC = " AND hospitality_custom_dimension.source = 'google' 
                     AND hospitality_custom_dimension.medium = 'cpc' ";
    }
    if ($tracking == 'facebook') {
        $AND_CPC = " AND hospitality_custom_dimension.source = 'facebook' 
                     AND hospitality_custom_dimension.medium = 'social' ";
    }
    if ($tracking == 'newsletter') {
        $AND_CPC = " AND (hospitality_custom_dimension.source = 'newsletter' OR hospitality_custom_dimension.source = 'sendinblue')
                     AND hospitality_custom_dimension.medium = 'email' ";
    }
    $q = "  SELECT (hospitality_custom_dimension.id) as n_preventivi_inviati
              FROM hospitality_custom_dimension
                  INNER JOIN hospitality_client_id ON hospitality_client_id.CLIENT_ID = hospitality_custom_dimension.clientid
                  INNER JOIN hospitality_guest ON hospitality_guest.NumeroPrenotazione = hospitality_client_id.NumeroPrenotazione
             WHERE hospitality_custom_dimension.idsito = $idsito     
                   $filter_query_custom_client_id    
                   $AND_CPC
               AND hospitality_guest.idsito = $idsito 
               AND hospitality_client_id.idsito = $idsito 
               AND hospitality_guest.Inviata = 1 
               AND hospitality_guest.FontePrenotazione = 'Sito Web'
               AND hospitality_guest.TipoRichiesta ='Preventivo'
               AND hospitality_custom_dimension.campaign = '$campagna'
               AND hospitality_custom_dimension.urlpath LIKE '%res=sent%'
          GROUP BY hospitality_guest.Id";

    $r = $db->query($q);
    $rw = sizeof($r);

    if ($rw > 0) {
        $n_preventivi_inviati = $rw;
    } else {
        $n_preventivi_inviati = 0;
    }

    return $n_preventivi_inviati;
}

function numero_campagne_da_sito($idsito, $tracking, $campagna, $clientid)
{
    global $db, $filter_query_custom_client_id;

    if ($tracking == 'google') {
        $AND_CPC = " AND hospitality_custom_dimension.source = 'google' 
                     AND hospitality_custom_dimension.medium = 'cpc' ";
    }
    if ($tracking == 'facebook') {
        $AND_CPC = " AND hospitality_custom_dimension.source = 'facebook' 
                     AND hospitality_custom_dimension.medium = 'social' ";
    }
    if ($tracking == 'newsletter') {
        $AND_CPC = " AND (hospitality_custom_dimension.source = 'newsletter' OR hospitality_custom_dimension.source = 'sendinblue')
                     AND hospitality_custom_dimension.medium = 'email' ";
    }
    $q = "  SELECT COUNT(hospitality_custom_dimension.id) as n_preventivi
              FROM hospitality_custom_dimension
             WHERE hospitality_custom_dimension.idsito = $idsito      
                   $filter_query_custom_client_id     
                   $AND_CPC     
               AND hospitality_custom_dimension.campaign = '$campagna'
               AND hospitality_custom_dimension.urlpath LIKE '%res=sent%'
               AND (hospitality_custom_dimension.urlpath  = '/?res=sent' OR hospitality_custom_dimension.urlpath  = '/' OR hospitality_custom_dimension.urlpath  = '/index.php' OR hospitality_custom_dimension.urlpath LIKE '%.php%')";

    $r = $db->query($q);
    $rw = $r[0];

    if (is_array($rw)) {
        if ($rw > count($rw))
            $tot = count($rw);
    } else {
        $tot = 0;
    }

    if ($tot > 0) {
        $n_preventivi = $rw['n_preventivi'];
    } else {
        $n_preventivi = 0;
    }

    return $n_preventivi;
}

function n_campagne_chiuse_new($idsito, $tracking, $campagna)
{
    global $db, $filter_query;

    $q = "  SELECT DISTINCT(hospitality_client_id.NumeroPrenotazione)
              FROM hospitality_client_id 
                  INNER JOIN hospitality_custom_dimension ON hospitality_custom_dimension.clientid = hospitality_client_id.CLIENT_ID
             WHERE hospitality_client_id.idsito = $idsito 
               AND hospitality_custom_dimension.idsito = $idsito 
               AND hospitality_custom_dimension.campaign = '$campagna'
               AND hospitality_custom_dimension.urlpath LIKE '%res=sent%'
          GROUP BY hospitality_custom_dimension.clientid";

    $rw = $db->query($q);

    foreach ($rw as $key => $value) {
        $array_chiuse[] = $value['NumeroPrenotazione'];
    }
    if (sizeof($rw) > 0) {
        $num_chiuse = implode(',', $array_chiuse);

        $q = "  SELECT COUNT(hospitality_guest.id) as n_chiuse
                  FROM hospitality_guest 
                 WHERE hospitality_guest.idsito = $idsito     
                       $filter_query 
                   AND hospitality_guest.NumeroPrenotazione IN ($num_chiuse)
                   AND hospitality_guest.FontePrenotazione = 'Sito Web'
                   AND hospitality_guest.Disdetta = 0
                   AND hospitality_guest.Hidden = 0
                   AND hospitality_guest.NoDisponibilita = 0
                   AND hospitality_guest.TipoRichiesta = 'Conferma'";
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

    $sl = "SELECT hospitality_proposte.PrezzoP as fatturato
             FROM hospitality_guest
                 INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                 INNER JOIN hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                 INNER JOIN hospitality_custom_dimension ON hospitality_custom_dimension.clientid = hospitality_client_id.CLIENT_ID
             WHERE 1=1
                   $filter_query 
               AND hospitality_guest.idsito = $idsito
               AND hospitality_guest.FontePrenotazione = 'Sito Web'
               AND hospitality_guest.Disdetta = 0
               AND hospitality_guest.Hidden = 0
               AND hospitality_guest.NoDisponibilita = 0
               AND hospitality_guest.TipoRichiesta = 'Conferma' 
               AND hospitality_client_id.idsito = $idsito
               AND hospitality_custom_dimension.idsito = $idsito
               AND hospitality_custom_dimension.campaign = '$campagna' 
               AND hospitality_custom_dimension.urlpath LIKE '%res=sent%'
          GROUP BY hospitality_guest.NumeroPrenotazione";

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
               INNER JOIN hospitality_custom_dimension ON hospitality_custom_dimension.clientid = hospitality_client_id.CLIENT_ID
          WHERE hospitality_client_id.idsito = $idsito
            AND hospitality_custom_dimension.idsito = $idsito
            AND hospitality_custom_dimension.source = 'facebook'
            AND hospitality_custom_dimension.urlpath LIKE '%res=sent%'";
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
                 WHERE hospitality_guest.NumeroPrenotazione IN ($NumeriSn)
                       $filter_query
                   AND hospitality_guest.idsito = $idsito 
                   AND hospitality_guest.FontePrenotazione = 'Sito Web'
                   AND hospitality_guest.Disdetta = 0
                   AND hospitality_guest.Hidden = 0
                   AND hospitality_guest.NoDisponibilita = 0
                   AND hospitality_guest.TipoRichiesta = 'Conferma' ";
    $resn = $db->query($selectn);
    $rwn = $resn[0];
    $totaleFBn = $rwn['fatturato'];
}
$select9n = "SELECT distinct(hospitality_custom_dimension.campaign) as Campagna, hospitality_custom_dimension.clientid
               FROM hospitality_custom_dimension
              WHERE hospitality_custom_dimension.idsito = $idsito
                AND hospitality_custom_dimension.source = 'facebook'
                AND hospitality_custom_dimension.campaign != '(not set)'
           GROUP BY hospitality_custom_dimension.campaign";
$listCampagneClientId = $db->query($select9n);
$totCampn = sizeof($listCampagneClientId);

if ($totCampn > 0) {
    $output .= '<table class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <tr>
                        <th class="wrap">Campagna</th>
                        <th class="wrap text-center">Rich.da Landing</th>
                        <th class="wrap text-center">Rich.da Sito Web</th>
                        <th class="wrap text-center">Prev.Inviati</th>
                        <th class="wrap text-center">Preno.Confermate</th>
                        <th class="wrap text-center">Tasso Conversione<br/>prev | conferme</th>
                        <th class="wrap text-center">Fatturato</th>
                    </tr>';

    $numero_landing = '';
    $numero_sito = '';
    $n_landing = '';
    $n_sito = '';
    $preno_chiuse = '';
    $numero_prev_send = '';

    $totLanding = 0;
    $totDaSito = 0;
    $totPreventivi = 0;
    $totConferme = 0;

    foreach ($listCampagneClientId as $key9n => $value9n) {
        //$NumeroPrenotazione = $value9n['NumeroPrenotazione'];

        $ClientId = $value9n['clientid'];
        $numero_landing = numero_campagne_da_landing($idsito, 'facebook', $value9n['Campagna'], $ClientId);
        $numero_prev_send = numero_preventivi_inviati_per_campagna($idsito, 'facebook', $value9n['Campagna'], $ClientId);
        $numero_sito = numero_campagne_da_sito($idsito, 'facebook', $value9n['Campagna'], $ClientId);
        $preno_chiuse = n_campagne_chiuse_new($idsito, 'facebook', $value9n['Campagna']);
        $totalePerCampagna = fatturato_per_campagna($idsito, $value9n['Campagna']);

        $totRichieste = 0;

        if ($numero_landing > 0 || $numero_sito == 0) {
            $n_landing = $numero_landing;
            $totLanding += $numero_landing;
            $totRichieste += $numero_landing;
            //$n_sito    = 0;
        }
        if ($numero_sito > 0 || $numero_landing == 0) {
            //$n_landing = 0;
            $n_sito = $numero_sito;
            $totRichieste += $numero_sito;
        }
        $fatturatoCampn = $totalePPCn;
        if ($fatturatoCampn == '') $fatturatoCampn = 0;
        $array_fatturatoSn[] = $fatturatoCampn;

        switch (($xn)) {
            case '1':
                $colorS = '#00acc1';
                $highlightS = '#00acc1';
                break;
            case '2':
                $colorS = '#d81b60';
                $highlightS = '#d81b60';
                break;
            default:
                $colorSn = colorGen();
                $highlightSn = colorGen();
                break;
        }

        $clean_campagnan = str_replace('_', ' ', $yn);
        $clean_campagnan = str_replace('-', ' ', $value9n['Campagna']);
        $clean_campagnan = str_replace(' | ', ' ', $value9n['Campagna']);

        $etichette_Sn[] = "'" . $clean_campagnan . "'";
        $tortaSn[] = "{value: " . $totalePerCampagna . ", name: '" . $clean_campagnan . "'}";

        $tassoConvPreventivi = $totRichieste > 0 ? number_format($numero_prev_send * 100 / $totRichieste, 2, ',', '.').'%' : '-';
        //$tassoConvConferme = $totRichieste > 0 ? number_format($preno_chiuse * 100 / $totRichieste, 2, ',', '.').'%' : '-';
        $tassoConvConferme = $numero_prev_send > 0 ? number_format($preno_chiuse * 100 / $numero_prev_send, 2, ',', '.').'%' : '-';

        $output .= '<tr>
                        <td class="text-left wrap">' . $value9n['Campagna'] . '</td>
                        <td class="text-center">' . $n_landing . '</td>   
                        <td class="text-center">' . $n_sito . '</td>  
                        <td class="text-center">' . $numero_prev_send . '</td> 
                        <td class="text-center">' . $preno_chiuse . '</td>
                        <td class="text-center">' .($numero_prev_send>$totRichieste?'':$tassoConvPreventivi. ' | ' . $tassoConvConferme ). '</td>
                        <td class="text-right wrap"><i class="fa fa-euro"></i> ' . number_format($totalePerCampagna, 2, ',', '.') . '</td>
                   </tr>';
    }
    $numero_landing = '';
    $numero_sito = '';
    $n_landing = '';
    $n_sito = '';
    $preno_chiuse = '';
    $numero_prev_send = '';

    $output .= '<tr>
                    <td class="text-right" colspan="6"><b>TOTALE</b></td>
                    <td class="text-right wrap"><i class="fa fa-euro"></i><b> ' . number_format($totaleFBn, 2, ',', '.') . '</b></td>
                </tr>';
    $output .= '</table>';
}
$numero_landing = '';
$numero_sito = '';
$n_landing = '';
$n_sito = '';
$preno_chiuse = '';

echo $output;
