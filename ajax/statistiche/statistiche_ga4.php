<?php
include($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/include/declaration.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/include/function.inc.php');

function fatturatoTotale($n_format=null){
	global $dbMysqli,$filter_query,$idsito;


	$sel = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                FROM hospitality_guest
                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                WHERE 1=1
                AND hospitality_guest.idsito = ".$idsito."
                AND hospitality_guest.NoDisponibilita = 0
                AND hospitality_guest.Hidden = 0
                AND hospitality_guest.Disdetta = 0
                AND hospitality_guest.TipoRichiesta = 'Conferma'
                ".$filter_query." ";
    $rw = $dbMysqli->query($sel);
    $rwc = $rw[0];
    if($n_format){
        return $rwc['fatturato'];
    }else{
        return number_format($rwc['fatturato'],2,',','.');
    }

}
function fatturatoTotaleSitoWeb($n_format=null){
	global $dbMysqli,$filter_query,$idsito;


	$sel = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                FROM hospitality_guest
                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                WHERE hospitality_guest.FontePrenotazione = 'Sito Web'
                AND hospitality_guest.idsito = ".$idsito."
                AND hospitality_guest.NoDisponibilita = 0
                AND hospitality_guest.Hidden = 0
                AND hospitality_guest.Disdetta = 0
                AND hospitality_guest.TipoRichiesta = 'Conferma'
                ".$filter_query." ";
    $rw = $dbMysqli->query($sel);
    $rwc = $rw[0];
    if($n_format){
        return $rwc['fatturato'];
    }else{
        return number_format($rwc['fatturato'],2,',','.');
    }

}
function CountConfermateAds($idsito,$source,$medium){
    global $dbMysqli,$filter_query,$idsito;

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
                        hospitality_custom_dimension_ga4.source = '".$source."'
                    AND
                        hospitality_custom_dimension_ga4.medium = '".$medium."' 
                    AND 
                        hospitality_client_id.idsito = ".$idsito." 
                    AND 
                        hospitality_custom_dimension_ga4.idsito = ".$idsito." 
                    GROUP BY
                    hospitality_custom_dimension_ga4.clientid,
                        hospitality_guest.NumeroPrenotazione";

    $rw = $dbMysqli->query($sql);
    $rwc = sizeof($rw);

        return $rwc;

}
function CountInviateAds($idsito,$source,$medium){
    global $dbMysqli,$filter_query,$idsito;

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
                        hospitality_custom_dimension_ga4.source = '".$source."'
                    AND
                        hospitality_custom_dimension_ga4.medium = '".$medium."' 
                    AND 
                        hospitality_client_id.idsito = ".$idsito." 
                    AND 
                        hospitality_custom_dimension_ga4.idsito = ".$idsito." 
                    GROUP BY
                    hospitality_custom_dimension_ga4.clientid,
                        hospitality_guest.NumeroPrenotazione";

    $rw = $dbMysqli->query($sql);
    $rwc = sizeof($rw);

        return $rwc;

}
function CountRicevuteAds($idsito,$source,$medium){
    global $dbMysqli,$filter_query,$idsito;

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
                        hospitality_custom_dimension_ga4.source = '".$source."'
                    AND
                        hospitality_custom_dimension_ga4.medium = '".$medium."' 
                    AND 
                        hospitality_client_id.idsito = ".$idsito." 
                    AND 
                        hospitality_custom_dimension_ga4.idsito = ".$idsito." 
                    GROUP BY
                    hospitality_custom_dimension_ga4.clientid,
                        hospitality_guest.NumeroPrenotazione";

    $rw = $dbMysqli->query($sql);
    $rwc = sizeof($rw);

        return $rwc;

}
$idsito       = $_REQUEST['idsito'];
$filter_query = urldecode($_REQUEST['filter_query']);
$DataRichiesta_dal = $_REQUEST['DataRichiesta_dal'];
$DataRichiesta_al  = $_REQUEST['DataRichiesta_al'];

/**
 * * DETTAGLIO PER SORGENTE SITO WEB
 */

 $sl = "SELECT SUM(fatturato) as fatt,
              sorgente,
              media
         FROM (
             SELECT 
                CASE 
                    WHEN TipoRichiesta = 'Conferma' THEN
                        hospitality_proposte.PrezzoP
                    ELSE
                        0
                END as fatturato,
                    hospitality_custom_dimension_ga4.source as sorgente,
                    hospitality_custom_dimension_ga4.medium as media
             FROM hospitality_guest
                      INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                      INNER JOIN hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
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
             WHERE 1 = 1
               $filter_query
               AND hospitality_guest.idsito = " . $idsito . "
               AND hospitality_guest.FontePrenotazione = 'Sito Web'
               AND hospitality_guest.Disdetta = 0
               AND hospitality_guest.NoDisponibilita = 0
               AND hospitality_guest.Hidden = 0
               AND hospitality_client_id.idsito = " . $idsito . "
               AND hospitality_custom_dimension_ga4.idsito = " . $idsito . "
             GROUP BY hospitality_custom_dimension_ga4.source, hospitality_guest.NumeroPrenotazione
         ) as sub
GROUP BY sorgente, media";

$rws_ = $dbMysqli->query($sl);
foreach ($rws_ as $y => $va) {

        $array_fatturatoS[] = array('fatturato' => $va['fatt'], 'source' => $va['sorgente'], 'medium' => $va['media']);


} 

if (!empty($array_fatturatoS) || !is_null($array_fatturatoS)) {

    $outputDett = '<table class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%;box-sizing: border-box;box-shadow: 0 0 10px #666;">';


    $totaleS = 0;
    $ricevuteAds = '';
    $inviateAds = '';
    $confermateAds = '';
    $ricevuteAdsNot = '';
    $inviateAdsNot = '';
    $confermateAdsNot = '';
    foreach ($array_fatturatoS as $key => $val) {



            $totaleS += $val['fatturato'];


            if ($val['source'] == 'codice-promo') {
                $source = 'newsletter';
            } else {
                $source = $val['source'];
            }
            if ($val['source'] == 'sorgente') {
                $source = '';
            } else {
                $source = $val['source'];
            }
            if ($val['source'] == 'facebook' && $val['medium'] == 'social') {
                $linkFB = '<a href="' . BASE_URL_SITO . 'grafici-facebook_ads_GA4/" style="margin-left:20px" data-toggle="tooltip" title="Dettaglio Campagne FaceBook"><i class="fa fa-external-link fa-flip-horizontal"></i></a>';
            } else {
                $linkFB = '';
            }
            if ($val['source'] == 'google' && $val['medium'] == 'cpc') {
                $linkCPC = '<a href="' . BASE_URL_SITO . 'grafici-ppc_ads_GA4/" style="margin-left:20px" data-toggle="tooltip" title="Dettaglio Campagne Google"><i class="fa fa-external-link fa-flip-horizontal"></i></a>';
            } else {
                $linkCPC = '';
            }
            if ($val['source'] == 'newsletter' && $val['medium'] == 'email') {
                $linkNE = '<a href="' . BASE_URL_SITO . 'grafici-newsletter_ads_GA4/" style="margin-left:20px" data-toggle="tooltip" title="Dettaglio Campagne Newsletter"><i class="fa fa-external-link fa-flip-horizontal"></i></a>';
            } else {
                $linkNE = '';
            }

            $clean_souce = str_replace("(", "", $val['source']);
            $clean_souce = str_replace(")", "", $clean_souce);
            $clean_souce = str_replace(".", "", $clean_souce);
            $clean_souce = str_replace("-", "", $clean_souce);
            $clean_souce = str_replace("/", "", $clean_souce);
            $clean_souce = str_replace("&", "", $clean_souce);
            $clean_souce = str_replace(" ", "", $clean_souce);

            $clean_med = str_replace("(", "", $val['medium']);
            $clean_med = str_replace(")", "", $clean_med);
            $clean_med = str_replace(" ", "", $clean_med);

            $ricevuteAds = CountRicevuteAds($idsito,$source, $val['medium']);
            //CountRichiesteRicevuteAds($idsito, $source, $val['medium'], $DataRichiesta_dal, $DataRichiesta_al);
            $tot_ricevuteAds += $ricevuteAds;
            $inviateAds = CountInviateAds($idsito,$source, $val['medium']);
            //CountRichiesteInviateAds($idsito, $source, $val['medium'], $DataRichiesta_dal, $DataRichiesta_al);
            $tot_inviateAds += $inviateAds;
            $confermateAds = CountConfermateAds($idsito,$source, $val['medium']);
            //CountRichiesteConfermateAds($idsito, $source, $val['medium'], $DataRichiesta_dal, $DataRichiesta_al);
            $tot_confermateAds += $confermateAds;
            $tot_fatturatoBE = $fun->fatturatoBePerFonte($idsito,$source, $val['medium'],$DataRichiesta_dal, $DataRichiesta_al);
            $tassoConvAds = $inviateAds > 0 ? number_format($confermateAds * 100 / $inviateAds, 2, ',', '.') . '%' : '-';

            switch($val['source'] . "-" . $val['medium']){
                case"google-cpc":
                case"facebook-social":
                case"newsletter-email":
                    $linkADS = true;
                    break;
                default:
                    $linkADS = false;
                    break;
            }

            $outputDett .= '<tr>
                                <td class="text-left nowrap" style="width:23%">
                                    <label  style="'.($linkADS == true?'cursor:pointer;text-decoration:underline!important':'').'" id="DettPrenoS' . $clean_souce . '' . $clean_med . '" data-id="' . urlencode($val['source'] . "-" . $val['medium']) . '">
                                    ' . ($val['source'] == 'sorgente' ? 'sorgente' : $source) . "-" . $val['medium'] . ' 
                                    </label>
                                    '.$linkFB.'
                                    '.$linkCPC.'
                                    '.$linkNE.'
                                    '.($tot_fatturatoBE != '' ? '<span style="padding-left:20px;font-size:10px!important">Fatturato BE: <i class="fa fa-euro"></i> ' . number_format($tot_fatturatoBE, 2, ',', '.'). '</span>' : '').'
                                </td>
                                <td class="text-center" style="width:16%">' . $ricevuteAds . '</td>
                                <td class="text-center" style="width:15%">' . $inviateAds . '</td>
                                <td class="text-center" style="width:20%">' . $confermateAds . '</td>
                                <td class="text-center" style="width:14%">' . $tassoConvAds . '</td>
                                <td class="text-right nowrap" style="width:12%">
                                    <i class="fa fa-euro"></i> ' . number_format($val['fatturato'], 2, ',', '.') . '
                                </td>
                            </tr>';
        if ($linkADS == true) {
            $outputDett .= '<script>
                                    $(document).ready(function () {
                                        $(\'#DettPrenoS' . $clean_souce . '' . $clean_med . '\').on("click",function(){

                                            $("#PrenotazioniSitoWebS' . $clean_souce . '' . $clean_med . '").modal("show");
                                        });
                                    });
                                </script>
                                <div class="modal fade" id="PrenotazioniSitoWebS' . $clean_souce . '' . $clean_med . '" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content modal-lg">
                                            <div class="modal-header" style="border-bottom:0px!important;">
                                                <p class="modal-title text-left f-12" id="exampleModalLabel">Prenotazioni con sorgente di provenienza Sito Web/Landing Page</p>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <input type="hidden" id="sorgente' . $clean_souce . '' . $clean_med . '" name="sorgente">
                                                <div id="content_loaderS' . $clean_souce . '' . $clean_med . '"></div>
                                                <div id="contentS' . $clean_souce . '' . $clean_med . '"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                $(document).ready(function () {
                                    $(\'#PrenotazioniSitoWebS' . $clean_souce . '' . $clean_med . '\').on("shown.bs.modal",function(){
                                        var sorgente = $(\'#DettPrenoS' . $clean_souce . '' . $clean_med . '\').data(\'id\');
                                        var modal = $(this)
                                        modal.find(\'.modal-body input#sorgente' . $clean_souce . '' . $clean_med . '\').val(sorgente);
                                        var referral = $(\'#sorgente' . $clean_souce . '' . $clean_med . '\').val();
                                        $("#content_loaderS' . $clean_souce . '' . $clean_med . '").html(\'<img src="' . BASE_URL_SITO . 'img/loader_performance.gif" style="width:auto;height:auto" /><br /><small>I dati si stanno caricando attendere...!</small>\');
                                        $("#contentS' . $clean_souce . '' . $clean_med . '").load("' . BASE_URL_SITO . 'ajax/' . ($clean_med == 'referral' ? 'dett_preno_referral_sitoweb_ga4.php' : 'dett_preno_sitoweb_ga4.php') . '?idsito=' . $idsito . '&sorgente="+referral+"&filtroQuery=' . urlencode($filter_query) . '", function() {
                                            $("#content_loaderS' . $clean_souce . '' . $clean_med . '").hide();
                                        });
                                    });
                                });
                            </script>' . "\r\n";

        }

    }

    $fattSitoweb = $fun->fatturatoTotaleSitoWeb(1);

    if ($totaleS < $fattSitoweb) {

        $ricevuteSito = $fun->CountRichiesteRicevute($idsito, 'Sito Web', $DataRichiesta_dal, $DataRichiesta_al);

        $inviateSito = $fun->CountRichiesteInviate($idsito, 'Sito Web', $DataRichiesta_dal, $DataRichiesta_al);

        $confermateSito = $fun->CountRichiesteConfermate($idsito, 'Sito Web', $DataRichiesta_dal, $DataRichiesta_al);

        $totaleDiff = ($fattSitoweb - $totaleS);

        $ricevuteAdsNot = $fun->CountRichiesteRicevuteAds($idsito, '', 'referral', $DataRichiesta_dal, $DataRichiesta_al);

        $ricevuteAdsNot = ($ricevuteSito - $tot_ricevuteAds);

        $inviateAdsNot = $fun->CountRichiesteInviateAds($idsito, '', 'referral', $DataRichiesta_dal, $DataRichiesta_al);

        $inviateAdsNot = ($inviateSito - $tot_inviateAds);

        $confermateAdsNot = $fun->CountRichiesteConfermateAds($idsito, '', 'referral', $DataRichiesta_dal, $DataRichiesta_al);

        $confermateAdsNot = ($confermateSito - $tot_confermateAds);

        $tassoConvAdsNot = $inviateAdsNot > 0 ? number_format($confermateAdsNot * 100 / $inviateAdsNot, 2, ',', '.') . '%' : '-';

        $outputDett .= '<tr>
                            <td class="text-left nowrap"><label> nessuna sorgente</label> <i class="fa fa-question-circle text-red" data-placement="right" data-toggle="tooltip" data-html="true" title="<div class=\'text-left\'><div class=\'text-left\'>Transazioni dove non è stato possibile raccogliere informazioni sulla sorgente (es.: mancata accettazione all\'utilizzo dei cookie, oppure modulo del tracciamento non abilitato), oppure mancata registrazione del dato a causa del cambio tra universal e GA4 di Google Analytics!</div>"></i></td>
                            <td class="text-center">'.$ricevuteAdsNot.'</td>
                            <td class="text-center">'.$inviateAdsNot.'</td>
                            <td class="text-center">'.$confermateAdsNot.'</td>
                            <td class="text-center">'.$tassoConvAdsNot.'</td>
                            <td class="text-right nowrap"><i class="fa fa-euro"></i> ' . number_format($totaleDiff, 2, ',', '.') . '</td>
                        </tr>';

        $totaleS += $totaleDiff;
    }

    $outputDett .= '<tr>
                        <td class="text-left nowrap"><b>TOTALE</b></td>
                        <td class="text-center"><b>' . ($ricevuteAdsNot > 0 ? ($tot_ricevuteAds + $ricevuteAdsNot) : $tot_ricevuteAds) . '</b></td>
                        <td class="text-center"><b>' . ($inviateAdsNot > 0 ? ($tot_inviateAds + $inviateAdsNot) : $tot_inviateAds) . '</b></td>
                        <td class="text-center"><b>' . ($confermateAdsNot > 0 ? ($tot_confermateAds + $confermateAdsNot) : $tot_confermateAds) . '</b></td>
                        <td class="text-center"><b></b></td>
                        <td class="text-right nowrap"><b><i class="fa fa-euro"></i> ' . number_format($totaleS, 2, ',', '.') . '</b></td>
                    </tr>';
    $outputDett .= '</table>';
}

/**
 * * FONTE DI PRENOTAZIONE
 */

$select = "SELECT FontePrenotazione, Abilitato FROM hospitality_fonti_prenotazione WHERE idsito = " . $idsito . "";
$rws = $dbMysqli->query($select);
$tot = sizeof($rws);
if ($tot > 0) {
    foreach ($rws as $key => $value) {
        $select2 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                FROM hospitality_guest
                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                WHERE hospitality_guest.FontePrenotazione = '" . addslashes($value['FontePrenotazione']) . "'
                                " . $filter_query . "
                                AND hospitality_guest.idsito = " . $idsito . "
                                AND hospitality_guest.NoDisponibilita = 0
                                AND hospitality_guest.Disdetta = 0
                                AND hospitality_guest.Hidden = 0
                                AND hospitality_guest.TipoRichiesta = 'Conferma' ";

        $res2 = $dbMysqli->query($select2);
        $rws2 = $res2[0];
        $fatturato = $rws2['fatturato'];
        if ($fatturato == '') {
            $fatturato = 0;
        }

        $array_fatturato[$value['FontePrenotazione'] . '_' . $value['Abilitato']] = $fatturato;

        $select3 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato, COUNT(hospitality_guest.Id) as n
                                FROM hospitality_guest
                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                WHERE hospitality_guest.FontePrenotazione = '" . addslashes($value['FontePrenotazione']) . "'
                                " . $filter_query . "
                                AND hospitality_guest.idsito = " . $idsito . "
                                AND hospitality_guest.NoDisponibilita = 1
                                AND hospitality_guest.Disdetta = 0
                                AND hospitality_guest.Hidden = 0
                                AND hospitality_guest.TipoRichiesta = 'Conferma' ";
        $res3 = $dbMysqli->query($select3);
        $rws3 = $res3[0];

        if (sizeof($res3) > 0) {
            $fatturatoD = $rws3['fatturato'];
            if ($fatturatoD == '') {
                $fatturatoD = 0;
            }

            $array_fatturatoD[$value['FontePrenotazione'] . '_' . $value['Abilitato'] . '_' . $rws3['n']] = $fatturatoD;

        }

    }

    $k = '';

    $output = '<table class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <tr>
                        <th class="nowrap thStatistiche">Metodo di Contatto</th>
                        <th class="nowrap  thStatistiche text-center">Richieste ricevute</th>
                        <th class="nowrap  thStatistiche text-center">Preventivi inviati</th>
                        <th class="nowrap  thStatistiche text-center">Prenotazioni confermate</th>
                        <th class="nowrap  thStatistiche text-center">Conversione %</th>
                        <th class="nowrap  thStatistiche text-center">Fatturato</th>
                    </tr>';
    $ricevute = '';
    $inviate = '';
    $confermate = '';
    foreach ($array_fatturato as $k => $v) {

        $k_tmp = explode("_", $k);
        $k = $k_tmp[0];
        $abilitato = $k_tmp[1];

        $label = $k;

        $totale += $v;

        $_SESSION['totaleSitoWeb'] = $v;

         $ricevute = $fun->CountRichiesteRicevute($idsito, $label, $DataRichiesta_dal, $DataRichiesta_al);
        $tot_ricevute += $ricevute;
        $inviate = $fun->CountRichiesteInviate($idsito, $label, $DataRichiesta_dal, $DataRichiesta_al);
        $tot_inviate += $inviate;
        $confermate = $fun->CountRichiesteConfermate($idsito, $label, $DataRichiesta_dal, $DataRichiesta_al);
        $tot_confermate += $confermate;
        $tassoConv = $inviate > 0 ? number_format($confermate * 100 / $inviate, 2, ',', '.') . '%' : '-'; 

        switch ($k) {
            case 'Sito Web':
                $stileLabel = 'font-weight: bold;cursor: pointer;';
                $idLabel = 'id="DettPreno"';
                $arrowDown = (!empty($array_fatturatoS) || !is_null($array_fatturatoS) ? '<i style="padding-left:20px;padding-right:20px;cursor:pointer;" class="fa fa-minus" id="switch_dettaglio" data-toggle="tootltip" title="Chiudi e apri dettaglio"></i>' : '');
                $dettaglio = (!empty($array_fatturatoS) || !is_null($array_fatturatoS) ?
                    '<tr id="primaRigaDett">
                                        <td colspan="6">' . $outputDett . '</td>
                                    </tr>
                                    <tr id="secondaRigaDett">
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    <tr>
                                    <script>
                                        $(document).ready(function () {
                                            $("#switch_dettaglio").on("click",function(){

                                                if($("#primaRigaDett").is(":hidden")){
                                                    $("#switch_dettaglio").removeClass("fa-plus");
                                                    $("#switch_dettaglio").addClass("fa-minus");
                                                    $("#primaRigaDett").show("slow");
                                                    $("#secondaRigaDett").show("slow");
                                                }else{
                                                    $("#switch_dettaglio").removeClass("fa-minus");
                                                    $("#switch_dettaglio").addClass("fa-plus");
                                                    $("#primaRigaDett").hide("slow");
                                                    $("#secondaRigaDett").hide("slow");
                                                }

                                            });
                                        });
                                    </script>'
                    :
                    '');
                break;
            default :
                $stileLabel = '';
                $idLabel = '';
                $arrowDown = '';
                $dettaglio = '';
                break;
        }

        $output .= '<tr>
                        <td class="text-left nowrap"><label style="' . $stileLabel . '" ' . $idLabel . '>' . $label . '</label> ' . $arrowDown . ' ' . ($abilitato == 0 ? '<span class="text-gray f-11">(Fonte non più attiva)</span>' : '') . '</td>
                        <td class="text-center">' . $ricevute . '</td>
                        <td class="text-center">' . $inviate . '</td>
                        <td class="text-center">' . $confermate . '</td>
                        <td class="text-center">' . $tassoConv . '</td>
                        <td class="text-right nowrap"><i class="fa fa-euro"></i> ' . number_format((strtolower($k) == 'sito web' ? ($v - $FattLanding) : $v), 2, ',', '.') . '</td>
                    </tr>
                    ' . $dettaglio;
   }

    $qF = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                FROM hospitality_guest
                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                WHERE 1=1
                AND hospitality_guest.idsito = " . $idsito . "
                AND hospitality_guest.NoDisponibilita = 0
                AND hospitality_guest.Hidden = 0
                AND hospitality_guest.Disdetta = 0
                AND hospitality_guest.TipoRichiesta = 'Conferma'
                " . $filter_query . " ";
    $rF = $dbMysqli->query($qF);
    $rwc = $rF[0];

    $fatturatoTotaleQuoto = $rwc['fatturato'];
    $fatturatoTotaleQuotoTDashboard = fatturatoTotale(1);
    if ($fatturatoTotaleQuoto < $fatturatoTotaleQuotoTDashboard) {

        $output .= '<tr>
                        <td class="text-left nowrap"><label style="font-weight: bold;"><i class="fa fa-info-circle"  data-toogle="tooltip" title="Tutto ciò che non ha una fonte di provenienza precisata, oppure una fonte eliminata, sostituita, ecc.!"></i> <b>Nessuna Sorgente Specifica</b></label></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-right nowrap"><i class="fa fa-euro"></i> ' . number_format(($fatturatoTotaleQuotoTDashboard-$fatturatoTotaleQuoto), 2, ',', '.') . '</td>
                    </tr>';
        $totale = $fatturatoTotaleQuotoTDashboard;
    }

    $output .= '<tr>
                    <td class="text-left nowrap"><b>TOTALE</b></td>
                    <td class="text-center"><b>' . $tot_ricevute . '</b></td>
                    <td class="text-center"><b>' . $tot_inviate . '</b></td>
                    <td class="text-center"><b>' . $tot_confermate . '</b></td>
                    <td class="text-center"></td>
                    <td class="text-right wrap"><b><i class="fa fa-euro"></i> ' . number_format($totale, 2, ',', '.') . '</b></td>
                </tr>';
    $output .= '<script>
                        $(document).ready(function () {
                            $(\'#DettPreno\').on("click",function(){
                                $("#PrenotazioniSitoWeb").modal("show");
                            });
                        });
                    </script>
                    <div class="modal fade" id="PrenotazioniSitoWeb" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content modal-lg">
                                <div class="modal-header" style="border-bottom:0px!important;">
                                    <p class="modal-title text-left f-12" id="exampleModalLabel">Prenotazioni con sorgente di provenienza <b>Sito Web</b> + <b>Landing Page</b></p>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-left">
                                    <div id="content_loader"></div>
                                    <div id="content"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                    $(document).ready(function () {
                        $(\'#PrenotazioniSitoWeb\').on("shown.bs.modal",function(){
                            $("#content_loader").html(\'<img src="' . BASE_URL_SITO . 'img/loader_performance.gif" style="width:auto;height:auto" /><br /><small>I dati si stanno caricando attendere...!</small>\');
                            $("#content").load("' . BASE_URL_SITO . 'ajax/statistiche/preno_sitoweb.php?idsito=' . $idsito . '&filtroQuery=' . urlencode($filter_query) . '", function() {
                                $("#content_loader").hide();
                            });
                        });
                    });
                </script>' . "\r\n";
    $output .= '</table>';
    /**
     * * ANNULLATE
     */
    
    $outputA = '<table class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                        <tr>
                            <th class="nowrap thStatistiche">Metodo di Contatto</th>
                            <th class="nowrap  thStatistiche text-center">Prenotazioni annullate</th>
                            <th class="nowrap  thStatistiche text-center">Importo</th>
                        </tr>';

    if (array_values($array_fatturatoD) > 0) {
        if (!empty($array_fatturatoD) || !is_null($array_fatturatoD)) {

            $annullate = '';
            foreach ($array_fatturatoD as $kD => $vD) {
                $kD_tmp = explode("_", $kD);
                $kD = $kD_tmp[0];
                $abilitatoD = $kD_tmp[1];
                $numeroD = $kD_tmp[2];
                $labelD = $kD;

                $clean_souceD = str_replace("(", "", $labelD);
                $clean_souceD = str_replace(")", "", $clean_souceD);
                $clean_souceD = str_replace(".", "", $clean_souceD);
                $clean_souceD = str_replace("-", "", $clean_souceD);
                $clean_souceD = str_replace(" ", "", $clean_souceD);
                $clean_souceD = str_replace("/", "", $clean_souceD);
                $clean_souceD = str_replace("&", "", $clean_souceD);

                if ($vD != "" || $vD != 0) {

                    $totaleD += $vD;

                    $annullate = $fun->CountRichiesteAnnullate($idsito, $labelD, $DataRichiesta_dal, $DataRichiesta_al);
                    $tot_annullate += $annullate;

                    $outputA .= ' <tr>
                                            <td class="nowrap"><label style="font-weight:normal;cursor:pointer;" id="DettPrenoD' . $clean_souceD . '" data-id="' . urlencode($labelD) . '">' . $labelD . '</label> ' . ($abilitatoD == 0 ? '<span class="text-gray f-11">(Fonte non più attiva)</span>' : '') . '</td>
                                            <td class="nowrap  text-center">' . $annullate . '</td>
                                            <td class="nowrap  text-right"><i class="fa fa-euro"></i> ' . number_format($vD, 2, ',', '.') . '</td>
                                        </tr>';
                    $outputA .= '<script>
                                                $(document).ready(function () {
                                                    $(\'#DettPrenoD' . $clean_souceD . '\').on("click",function(){

                                                        $("#AnnulloD' . $clean_souceD . '").modal("show");
                                                    });
                                                });
                                            </script>
                                            <div class="modal fade" id="AnnulloD' . $clean_souceD . '" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content modal-lg">
                                                        <div class="modal-header" style="border-bottom:0px!important;">
                                                            <p class="modal-title text-left f-12" id="exampleModalLabel">Prenotazioni Annullate per Fonte di Provenienza <br><small>(sono inclusi anche i preventivi annullati, se corrispondenti alla stessa fonte di provenienza)</small> </p>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            <input type="hidden" id="sorgente' . $clean_souceD . '" name="sorgente">
                                                            <div id="content_loaderD' . $clean_souceD . '"></div>
                                                            <div id="contentD' . $clean_souceD . '"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                            $(document).ready(function () {
                                                $(\'#AnnulloD' . $clean_souceD . '\').on("shown.bs.modal",function(){
                                                    var sorgente = $(\'#DettPrenoD' . $clean_souceD . '\').data(\'id\');
                                                    var modal = $(this)
                                                    modal.find(\'.modal-body input#sorgente' . $clean_souceD . '\').val(sorgente);
                                                    var referral = $(\'#sorgente' . $clean_souceD . '\').val();
                                                    $("#content_loaderD' . $clean_souceD . '").html(\'<img src="' . BASE_URL_SITO . 'img/loader_performance.gif" style="width:auto;height:auto" /><br /><small>I dati si stanno caricando attendere...!</small>\');
                                                    $("#contentD' . $clean_souceD . '").load("' . BASE_URL_SITO . 'ajax/dett_preno_annullate.php?idsito=' . $idsito . '&sorgente="+referral+"&filtroQuery=' . urlencode($filter_query) . '", function() {
                                                        $("#content_loaderD' . $clean_souceD . '").hide();
                                                    });
                                                });
                                            });
                                        </script>' . "\r\n";
                }

            }
            $outputA .= '<tr>
                                    <td class="text-left nowrap"><b>TOTALE</b></td>
                                    <td class="text-center"><b>' . $tot_annullate . '</b></td>
                                    <td class="text-right nowrap"><b><i class="fa fa-euro"></i> ' . number_format($totaleD, 2, ',', '.') . '</b></td>
                                </tr>';
            $outputA .= '</table>';

        }
    }
}

/**
 * * FATTURATO PER TARGET
 */
//PER TARGET CLIENTE

$select18 = "SELECT Target FROM hospitality_target WHERE idsito = " . $idsito . " ORDER BY Id ASC";
$rws18 = $dbMysqli->query($select18);
$totTARGET = sizeof($rws18);
if ($totTARGET > 0) {
    foreach ($rws18 as $key18 => $value18) {

        $select19 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                FROM hospitality_guest
                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                WHERE hospitality_guest.TipoVacanza = '" . $value18['Target'] . "'
                                " . $filter_query . "
                                AND hospitality_guest.idsito = " . $idsito . "
                                AND hospitality_guest.NoDisponibilita = 0
                                AND hospitality_guest.Disdetta = 0
                                AND hospitality_guest.Hidden = 0
                                AND hospitality_guest.TipoRichiesta = 'Conferma' ";
        $res19 = $dbMysqli->query($select19);
        $rws19 = $res19[0];
        $fatturatoTARGET = $rws19['fatturato'];
        if ($fatturatoTARGET == '') {
            $fatturatoTARGET = 0;
        }

        if ($fatturatoTARGET != '' || $fatturatoTARGET != 0) {

            $array_fatturatoTARGET[$value18['Target']] = $fatturatoTARGET;
        }

    }

    if (isset($array_fatturatoTARGET)) {

        $outputTA = '<table class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                        <tr>
                            <th class="nowrap thStatistiche" style="width:80%">Target Clienti</th>
                            <th class="nowrap thStatistiche text-center" style="width:20%">Fatturato</th>
                        </tr>';

        $p_T = '';
        foreach ($array_fatturatoTARGET as $T => $vT) {

            $totaleT += $vT;
            $outputTA .= '<tr>
                                <td class="nowrap"><label style="font-weight: normal;">' . ucfirst($T) . '</label></td>
                                <td class="nowrap  text-right"><i class="fa fa-euro"></i> ' . number_format($vT, 2, ',', '.') . ' </td>
                            </tr>';
        }
        $p_T = '';
    }
    $fatturatoTotaleQuotoT = fatturatoTotale(1);

    if ($totaleT < $fatturatoTotaleQuotoT) {

        $outputTA .= '<tr>
                            <td class="nowrap"><label>Target eliminati, sostituiti, ecc</label></td>
                            <td class="nowrap  text-right"><i class="fa fa-euro"></i> ' . number_format(($fatturatoTotaleQuotoT - $totaleT), 2, ',', '.') . ' </td>
                        </tr>';
        $totaleT = $fatturatoTotaleQuotoT;
    }

    $outputTA .= '<tr>
                        <td class="nowrap"><b>TOTALE</b></td>
                        <td class="nowrap  text-right"><b><i class="fa fa-euro"></i> ' . number_format($totaleT, 2, ',', '.') . '</b> </td>
                    </tr>';
    $outputTA .= '</table>';
}

/**
 * * FATTURATO PER OPERATORI
 *
 * */

$select15 = "SELECT * FROM hospitality_operatori WHERE idsito = " . $idsito . "";
$rws15 = $dbMysqli->query($select15);
$totOperatore = sizeof($rws15);
if ($totOperatore > 0) {

    $operatore = '';
    $abilitatoOP = '';

    foreach ($rws15 as $key15 => $value15) {

        $operatore = trim(addslashes($value15['NomeOperatore']));
        $abilitatoOP = $value15['Abilitato'];

        $select16 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                        FROM hospitality_guest
                                        INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                        WHERE hospitality_guest.ChiPrenota = '" . $operatore . "'
                                        " . $filter_query . "
                                        AND hospitality_guest.idsito = " . $idsito . "
                                        AND hospitality_guest.NoDisponibilita = 0
                                        AND hospitality_guest.Disdetta = 0
                                        AND hospitality_guest.Hidden = 0
                                        AND hospitality_guest.TipoRichiesta = 'Conferma' ";
        $res16 = $dbMysqli->query($select16);
        $rws16 = $res16[0];
        $fatturatoOperatore = $rws16['fatturato'];
        if ($fatturatoOperatore == '') {
            $fatturatoOperatore = 0;
        }

        $array_fatturatoOperatore[$operatore . '_' . $abilitatoOP] = $fatturatoOperatore;
    }
    $outputOP = '<table class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                        <tr>
                            <th class="nowrap thStatistiche" style="width:80%">Operatore</th>
                            <th class="nowrap  thStatistiche text-center" style="width:20%">Fatturato</th>
                        </tr>';
    $p_OP = '';
    foreach ($array_fatturatoOperatore as $ky => $val) {

        $ky_tmp = explode("_", $ky);
        $ky = $ky_tmp[0];
        $abilitatoOP = $ky_tmp[1];

        $totaleOP += $val;

        $outputOP .= '<tr>
                        <td class="nowrap"><label style="font-weight: normal;">' . $ky . '</label>' . ($abilitatoOP == 0 ? ' <small>(non attivo)</small>' : '') . '</td>
                        <td class="nowrap  text-right"><i class="fa fa-euro"></i> ' . number_format($val, 2, ',', '.') . ' </td>
                    </tr>';

    }

    $fatturatoTotaleQuotoOP = fatturatoTotale(1);

    if ($totaleOP < $fatturatoTotaleQuotoOP) {
        $outputOP .= '<tr>
                        <td class="nowrap"><label>Operatori eliminati, sostituiti, ecc</label></td>
                        <td class="nowrap  text-right"><i class="fa fa-euro"></i> ' . number_format(($fatturatoTotaleQuotoOP - $totaleOP), 2, ',', '.') . ' </td>
                    </tr>';

        $totaleOP = $fatturatoTotaleQuotoOP;
    }
    $outputOP .= '<tr>
                    <td class="nowrap"><b>TOTALE</b></td>
                    <td class="nowrap  text-right"><b><i class="fa fa-euro"></i> ' . number_format($totaleOP, 2, ',', '.') . '</b> </td>
                </tr>';
    $outputOP .= '</table>';

}

/**
 * * FATTURATO PER TEMPLATE
 */

$select20 = "SELECT * FROM hospitality_template_background WHERE idsito = " . $idsito . "";
$rws20 = $dbMysqli->query($select20);
$totTemplate = sizeof($rws20);

if ($totTemplate > 0) {

    $template = '';
    $NomeTemplate = '';

    foreach ($rws20 as $key20 => $value20) {

        $template = $value20['Id'];
        $NomeTemplate = $value20['TemplateName'];

        $select21 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                        FROM hospitality_guest
                                        INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                        WHERE 1=1
                                        AND hospitality_guest.id_template = '" . $template . "'
                                        " . $filter_query . "
                                        AND hospitality_guest.idsito = " . $idsito . "
                                        AND hospitality_guest.NoDisponibilita = 0
                                        AND hospitality_guest.Disdetta = 0
                                        AND hospitality_guest.Hidden = 0
                                        AND hospitality_guest.TipoRichiesta = 'Conferma' ";
        $res21 = $dbMysqli->query($select21);
        $rws21 = $res21[0];
        $fatturatoTemplate = $rws21['fatturato'];
        if ($fatturatoTemplate == '') {
            $fatturatoTemplate = 0;
        }

        $array_fatturatoTemplate[$NomeTemplate] = $fatturatoTemplate;
    }

    $outputTP = '<table class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <tr>
                        <th class="nowrap thStatistiche" style="width:80%">Template Landing Page</th>
                        <th class="nowrap  thStatistiche text-center" style="width:20%">Fatturato</th>
                    </tr>';

    foreach ($array_fatturatoTemplate as $ky => $val) {

        $totaleTP += $val;

        if ($val != "" || $val != 0) {
            $perc = (($val * 100) / $totaleTP);
            $p_TP = (($val != "" || $val != 0) ? number_format($perc, 2) : '');
        }

        $outputTP .= '<tr>
                        <td class="nowrap"><label style="font-weight: normal;">' . $ky . '</label></td>
                        <td class="nowrap  text-right"><i class="fa fa-euro"></i> ' . number_format($val, 2, ',', '.') . ' </td>
                    </tr>';

    }
    $fatturatoTotaleQuotoTP = fatturatoTotale(1);
    if ($totaleTP < $fatturatoTotaleQuotoTP) {

        $outputTP .= '<tr>
                            <td class="nowrap"><label>Nessun specifico template</label></td>
                            <td class="nowrap  text-right"><i class="fa fa-euro"></i> ' . number_format(($fatturatoTotaleQuotoTP - $totaleTP), 2, ',', '.') . ' </td>
                        </tr>';
        $totaleTP = $fatturatoTotaleQuotoTP;
    }

    $outputTP .= '<tr>
                        <td class="nowrap"><b>TOTALE</b></td>
                        <td class="nowrap  text-right"><b><i class="fa fa-euro"></i> ' . number_format($totaleTP, 2, ',', '.') . ' </b></td>
                    </tr>';
    $outputTP .= '</table>';

}

echo $output.'<div class="clearfix"></div>';
if (array_values($array_fatturatoD) > 0) {
   echo' <div class="card">
        <div class="card-block"> 
            <div class="row">
                <div class="col-md-8"> Conferme Annullate dall\'operatore</div>
                <div class="col-md-4 text-right"><a href="javascript:;" id="attiva_annullate" data-toogle="tooltip" title="Clicca per visualizzare le Annullate"><i class="fa fa-plus" aria-hidden="true"></i></a></div>  
            </div>
            <div class="clearfix p-b-10"></div>
                <div id="annullate" style="display:none">
                    '.$outputA.'
                </div> 
                <script>
                    $(document).ready(function(){
                        $("#attiva_annullate").on("click",function(){
                        $("#annullate").slideToggle("slow");
                        })
                    })
                </script>
        </div>
    </div>'."\r\n";
}
if (isset($array_fatturatoTARGET)) {
    echo'<div class="card">
        <div class="card-block"> 
            <div class="row">
                <div class="col-md-8"> Fatturato per Target Cliente</div>
                <div class="col-md-4 text-right"><a href="javascript:;" id="attiva_target" data-toogle="tooltip" title="Clicca per visualizzare le Annullate"><i class="fa fa-plus" aria-hidden="true"></i></a></div>  
            </div>
            <div class="clearfix p-b-10"></div>
                <div id="target" style="display:none">
                    '.$outputTA.'
                </div> 
                <script>
                    $(document).ready(function(){
                        $("#attiva_target").on("click",function(){
                        $("#target").slideToggle("slow");
                        })
                    })
                </script>
        </div>
    </div>   '."\r\n";                                                                  
}
if (array_values($array_fatturatoOperatore) > 0){
    echo'<div class="card">
        <div class="card-block"> 
            <div class="row">
                <div class="col-md-8"> Fatturato per Operatore</div>
                <div class="col-md-4 text-right"><a href="javascript:;" id="attiva_operatori" data-toogle="tooltip" title="Clicca per visualizzare le Annullate"><i class="fa fa-plus" aria-hidden="true"></i></a></div>  
            </div>
            <div class="clearfix p-b-10"></div>
                <div id="operatori" style="display:none">
                    '.$outputOP.'
                </div> 
                    <script>
                        $(document).ready(function(){
                            $("#attiva_operatori").on("click",function(){
                            $("#operatori").slideToggle("slow");
                                if($("#operatori").prop(\'display\',\'none\')){
                                    $("#minus_operatori").hide();
                                    $("#plus_operatori").show();
                                }else{
                                    $("#plus_operatori").hide();
                                    $("#minus_operatori").show();
                                }
                            })
                        })
                    </script>
        </div>
    </div> '."\r\n";
}
if(array_values($array_fatturatoTemplate) > 0){
   echo' <div class="card">
        <div class="card-block"> 
            <div class="row">
                <div class="col-md-8"> Fatturato per Template Landing Page</div>
                <div class="col-md-4 text-right"><a href="javascript:;" id="attiva_template" data-toogle="tooltip" title="Clicca per visualizzare le Annullate"><i class="fa fa-plus" aria-hidden="true"></i></a></div>  
            </div>
            <div class="clearfix p-b-10"></div>
            <div id="template" style="display:none">
                '.$outputTP.'
            </div> 
            <script>
                $(document).ready(function(){
                    $("#attiva_template").on("click",function(){
                    $("#template").slideToggle("slow");
                    })
                })
            </script>
        </div>
    </div>  '."\r\n";
}