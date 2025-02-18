<?php
include($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/include/declaration.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/class/statistiche.class.php');
$stat = new statistiche();

$idsito            = $_REQUEST['idsito'];
$filter_query      = urldecode($_REQUEST['filter_query']);
$filter_query_p      = urldecode($_REQUEST['filter_query_p']);
$DataRichiesta_dal = $_REQUEST['DataRichiesta_dal'];
$DataRichiesta_al  = $_REQUEST['DataRichiesta_al'];


/**
 * * DETTAGLIO PER SORGENTE SITO WEB
 */
$array_fatturatoS = $stat->fatt_sorgente_web($idsito,$filter_query); 

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
                $linkFB = '<a href="' . BASE_URL_SITO . 'grafici-facebook_ads_utm/" style="margin-left:20px" data-toggle="tooltip" title="Dettaglio Campagne FaceBook"><i class="fa fa-external-link fa-flip-horizontal"></i></a>';
            } else {
                $linkFB = '';
            }
            if ($val['source'] == 'google' && $val['medium'] == 'cpc') {
                $linkCPC = '<a href="' . BASE_URL_SITO . 'grafici-ppc_ads_utm/" style="margin-left:20px" data-toggle="tooltip" title="Dettaglio Campagne Google"><i class="fa fa-external-link fa-flip-horizontal"></i></a>';
            } else {
                $linkCPC = '';
            }
            if ($val['source'] == 'newsletter' && $val['medium'] == 'email') {
                $linkNE = '<a href="' . BASE_URL_SITO . 'grafici-newsletter_ads_utm/" style="margin-left:20px" data-toggle="tooltip" title="Dettaglio Campagne Newsletter"><i class="fa fa-external-link fa-flip-horizontal"></i></a>';
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

            $ricevuteAds = $stat->CountRicevuteAds($idsito,$source, $val['medium']);

            $tot_ricevuteAds += $ricevuteAds;
            $inviateAds = $stat->CountInviateAds($idsito,$source, $val['medium']);

            $tot_inviateAds += $inviateAds;
            $confermateAds = $stat->CountConfermateAds($idsito,$source, $val['medium']);

            $tot_confermateAds += $confermateAds;

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
                                <td class="text-left nowrap" style="width:25%">
                                    <label  style="'.($linkADS == true?'cursor:pointer;text-decoration:underline!important':'').'" id="DettPrenoS' . $clean_souce . '' . $clean_med . '" data-id="' . urlencode($val['source'] . "-" . $val['medium']) . '">
                                    ' . ($val['source'] == 'sorgente' ? 'sorgente' : $source) . "-" . $val['medium'] . ' 
                                    </label>
                                    '.$linkFB.'
                                    '.$linkCPC.'
                                    '.$linkNE.'                              
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
                                        $("#contentS' . $clean_souce . '' . $clean_med . '").load("' . BASE_URL_SITO . 'ajax/statistiche/' . ($clean_med == '' ? 'dett_preno_referral_sitoweb_utm.php' : 'dett_preno_sitoweb_utm.php') . '?idsito=' . $idsito . '&sorgente="+referral+"&filtroQuery=' . urlencode($filter_query) . '", function() {
                                            $("#content_loaderS' . $clean_souce . '' . $clean_med . '").hide();
                                        });
                                    });
                                });
                            </script>' . "\r\n";

     

        }

    }


/**
 * * DETTAGLIO PER SORGENTE SITO WEB REFERRER NO ADS
 */

$rws = $stat->fatt_sorgente_web_referrer($idsito,$filter_query);


foreach ($rws as $x => $v) {

    $riAdsNot  = $stat->CountRichiesteRicevuteNotAds($idsito,$v['referrer'], $DataRichiesta_dal, $DataRichiesta_al);
    $tot_ricevuteAdsNot += $riAdsNot;

    $inAdsNot  = $stat->CountRichiesteInviateNotAds($idsito,$v['referrer'], $DataRichiesta_dal, $DataRichiesta_al); 
    $tot_inviateAdsNot += $inAdsNot;

    $coAdsNot  = $stat->CountRichiesteConfermateNotAds($idsito,$v['referrer'],$DataRichiesta_dal, $DataRichiesta_al);
    $tot_confermateAdsNot += $coAdsNot;

    $fatAdsNot = $stat->fatturatoReferrer(1,$v['referrer']);
    $tot_fatturatoAdsNot += $fatAdsNot;

    $tCoAdsNot = $inAdsNot > 0 ? number_format($coAdsNot * 100 / $inAdsNot, 2, ',', '.') . '%' : '-';

    $ref = str_replace("https://","",$v['referrer']);
    $ref = str_replace("http://","",$ref);
    $ref = str_replace("www.","",$ref);

    $sitoC     = explode("//",$ref);
    $sitoC     = explode("/",$sitoC[0]);
    $sito      = $sitoC[0];
    $sitoClean = str_replace("www.","",$sito);

    $outputDett .= '<tr>
                        <td class="text-left nowrap"><label>'.(strstr($ref,$sitoClean)?$sitoClean:(strlen($ref)<=80?$ref:substr($ref,0,80).'...')).' '.$v['new_referrer'].'</label> </td>
                        <td class="text-center">'.$riAdsNot.'</td>
                        <td class="text-center">'.$inAdsNot.'</td>
                        <td class="text-center">'.$coAdsNot.'</td>
                        <td class="text-center">'.$tCoAdsNot.'</td>
                        <td class="text-right nowrap"><i class="fa fa-euro"></i> '.number_format($fatAdsNot, 2, ',', '.').'</td>
                    </tr>';
                    
    $fattSitoweb = $stat->fatturatoTotaleSitoWeb(1);
        
    $totaleDiff = ($fattSitoweb - ($totaleS + $tot_fatturatoAdsNot)); 

}

/**
 * * DETTAGLIO ASSEGNANDO PER DIFFERENZA NESSUNA SORGENTE
 */

   
    if ($totaleS < $fattSitoweb) {

        $ricevuteSito = $stat->CountRichiesteRicevute($idsito, 'Sito Web', $DataRichiesta_dal, $DataRichiesta_al);

        $inviateSito = $stat->CountRichiesteInviate($idsito, 'Sito Web', $DataRichiesta_dal, $DataRichiesta_al);

        $confermateSito = $stat->CountRichiesteConfermate($idsito, 'Sito Web', $DataRichiesta_dal, $DataRichiesta_al);  
        
        $ricevuteAdsNot = ($ricevuteSito - $tot_ricevuteAds - $tot_ricevuteAdsNot);

        $inviateAdsNot = ($inviateSito - $tot_inviateAds - $tot_inviateAdsNot);

        $confermateAdsNot = ($confermateSito - $tot_confermateAds - $tot_confermateAdsNot);

        $tassoConvAdsNot = $inviateAdsNot > 0 ? number_format($confermateAdsNot * 100 / $inviateAdsNot, 2, ',', '.') . '%' : '-';


        $outputDett .= '<tr>
                            <td class="text-left nowrap"><label> nessuna sorgente</label> <i class="fa fa-question-circle text-red" data-placement="right" data-toggle="tooltip" data-html="true" title="<div class=\'text-left\'><div class=\'text-left\'>Transazioni dove non è stato possibile raccogliere informazioni sulla sorgente (es.: mancata accettazione all\'utilizzo dei cookie, oppure modulo del tracciamento obsoleto).</div>"></i></td>
                            <td class="text-center">'.$ricevuteAdsNot.'</td>
                            <td class="text-center">'.$inviateAdsNot.'</td>
                            <td class="text-center">'.$confermateAdsNot.'</td>
                            <td class="text-center">'.$tassoConvAdsNot.'</td>
                            <td class="text-right nowrap"><i class="fa fa-euro"></i> ' . number_format($totaleDiff, 2, ',', '.') . '</td>
                        </tr>'; 

    } 

    $confermateSitoWeb = $stat->CountRichiesteConfermate($idsito, 'Sito Web', $DataRichiesta_dal, $DataRichiesta_al);

    $outputDett .= '<tr>
                    <td class="text-left nowrap"><b>TOTALE</b></td>
                    <td class="text-center"><b>' . ($ricevuteAdsNot > 0 ? ($tot_ricevuteAds + $ricevuteAdsNot + $tot_ricevuteAdsNot) : $tot_ricevuteAds) . '</b></td>
                    <td class="text-center"><b>' . ($inviateAdsNot > 0 ? ($tot_inviateAds + $inviateAdsNot + $tot_inviateAdsNot) : $tot_inviateAds) . '</b></td>
                    <td class="text-center"><b>' . ($confermateAdsNot > 0 ? ($tot_confermateAds + $confermateAdsNot + $tot_confermateAdsNot) : $confermateSitoWeb) . '</b></td>
                    <td class="text-center"><b></b></td>
                    <td class="text-right nowrap"><b><i class="fa fa-euro"></i> ' . number_format($fattSitoweb, 2, ',', '.') . '</b></td>
                </tr>';
    $outputDett .= '</table>';
}

/**
 * * FONTE DI PRENOTAZIONE
 */
$array_fatturato  = $stat->fatt_fonti_prenotazione($idsito,$filter_query);

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

        $ricevute = $stat->CountRichiesteRicevute($idsito, $label, $DataRichiesta_dal, $DataRichiesta_al);
        $tot_ricevute += $ricevute;
        $inviate = $stat->CountRichiesteInviate($idsito, $label, $DataRichiesta_dal, $DataRichiesta_al);
        $tot_inviate += $inviate;
        $confermate = $stat->CountRichiesteConfermate($idsito, $label, $DataRichiesta_dal, $DataRichiesta_al);
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
                        <td class="text-left wrap"><label style="' . $stileLabel . '" ' . $idLabel . '>' . $label . '</label> ' . $arrowDown . ' ' . ($abilitato == 0 ? '<span class="text-gray f-11">(Fonte non più attiva)</span>' : '') . '</td>
                        <td class="text-center">' . $ricevute . '</td>
                        <td class="text-center">' . $inviate . '</td>
                        <td class="text-center">' . $confermate . '</td>
                        <td class="text-center">' . $tassoConv . '</td>
                        <td class="text-right wrap"><i class="fa fa-euro"></i> ' . number_format((strtolower($k) == 'sito web' ? ($v - $FattLanding) : $v), 2, ',', '.') . '</td>
                    </tr>
                    ' . $dettaglio;
   }


    $output .= '<tr>
                    <td class="text-left wrap"><b>TOTALE</b></td>
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
    $array_fatturatoD = $stat->fatt_fonti_prenotazione_annullate($idsito,$filter_query); 

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

                    $annullate = $stat->CountRichiesteAnnullate($idsito, $labelD, $DataRichiesta_dal, $DataRichiesta_al);
                    $tot_annullate += $annullate;

                    $outputA .= ' <tr>
                                            <td class="wrap"><label style="font-weight:normal;cursor:pointer;" id="DettPrenoD' . $clean_souceD . '" data-id="' . urlencode($labelD) . '">' . $labelD . '</label> ' . ($abilitatoD == 0 ? '<span class="text-gray f-11">(Fonte non più attiva)</span>' : '') . '</td>
                                            <td class="wrap text-center">' . $annullate . '</td>
                                            <td class="wrap text-right"><i class="fa fa-euro"></i> ' . number_format($vD, 2, ',', '.') . '</td>
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
                                                    $("#contentD' . $clean_souceD . '").load("' . BASE_URL_SITO . 'ajax/statistiche/dett_preno_annullate.php?idsito=' . $idsito . '&sorgente="+referral+"&filtroQuery=' . urlencode($filter_query) . '", function() {
                                                        $("#content_loaderD' . $clean_souceD . '").hide();
                                                    });
                                                });
                                            });
                                        </script>' . "\r\n";
                }

            }
            $outputA .= '<tr>
                                    <td class="text-left wrap"><b>TOTALE</b></td>
                                    <td class="text-center"><b>' . $tot_annullate . '</b></td>
                                    <td class="text-right wrap"><b><i class="fa fa-euro"></i> ' . number_format($totaleD, 2, ',', '.') . '</b></td>
                                </tr>';
            $outputA .= '</table>';

        }
    }


/**
 * * FATTURATO PER TARGET
 */

$array_fatturatoTARGET = $stat->fatt_target($idsito,$filter_query);

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
                                <td class="wrap"><label style="font-weight: normal;">' . ucfirst($T) . '</label></td>
                                <td class="wrap text-right"><i class="fa fa-euro"></i> ' . number_format($vT, 2, ',', '.') . ' </td>
                            </tr>';
        }
        $p_T = '';
    }
    $fatturatoTotaleQuotoT = $stat->fatturatoTotale(1);

    if ($totaleT < $fatturatoTotaleQuotoT) {

        $outputTA .= '<tr>
                            <td class="wrap"><label>Target eliminati, sostituiti, ecc</label></td>
                            <td class="wrap text-right"><i class="fa fa-euro"></i> ' . number_format(($fatturatoTotaleQuotoT - $totaleT), 2, ',', '.') . ' </td>
                        </tr>';
        $totaleT = $fatturatoTotaleQuotoT;
    }

    $outputTA .= '<tr>
                        <td class="wrap"><b>TOTALE</b></td>
                        <td class="wrap text-right"><b><i class="fa fa-euro"></i> ' . number_format($totaleT, 2, ',', '.') . '</b> </td>
                    </tr>';
    $outputTA .= '</table>';


/**
 * * FATTURATO PER OPERATORI
 *
 * */
$array_fatturatoOperatore = $stat->fatt_operatore($idsito,$filter_query);

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
                        <td class="wrap"><label style="font-weight: normal;">' . $ky . '</label>' . ($abilitatoOP == 0 ? ' <small>(non attivo)</small>' : '') . '</td>
                        <td class="wrap text-right"><i class="fa fa-euro"></i> ' . number_format($val, 2, ',', '.') . ' </td>
                    </tr>';

    }

    $fatturatoTotaleQuotoOP = $stat->fatturatoTotale(1);

    if ($totaleOP < $fatturatoTotaleQuotoOP) {
        $outputOP .= '<tr>
                        <td class="wrap"><label>Operatori eliminati, sostituiti, ecc</label></td>
                        <td class="wrap text-right"><i class="fa fa-euro"></i> ' . number_format(($fatturatoTotaleQuotoOP - $totaleOP), 2, ',', '.') . ' </td>
                    </tr>';

        $totaleOP = $fatturatoTotaleQuotoOP;
    }
    $outputOP .= '<tr>
                    <td class="wrap"><b>TOTALE</b></td>
                    <td class="wrap text-right"><b><i class="fa fa-euro"></i> ' . number_format($totaleOP, 2, ',', '.') . '</b> </td>
                </tr>';
    $outputOP .= '</table>';


/**
 * * FATTURATO PER TEMPLATE
 */
$array_fatturatoTemplate = $stat->fatt_template($idsito,$filter_query);

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
                        <td class="wrap"><label style="font-weight: normal;">' . $ky . '</label></td>
                        <td class="wrap text-right"><i class="fa fa-euro"></i> ' . number_format($val, 2, ',', '.') . ' </td>
                    </tr>';

    }
    $fatturatoTotaleQuotoTP = $stat->fatturatoTotale(1);
    if ($totaleTP < $fatturatoTotaleQuotoTP) {

        $outputTP .= '<tr>
                            <td class="wrap"><label>Nessun specifico template</label></td>
                            <td class="wrap text-right"><i class="fa fa-euro"></i> ' . number_format(($fatturatoTotaleQuotoTP - $totaleTP), 2, ',', '.') . ' </td>
                        </tr>';
        $totaleTP = $fatturatoTotaleQuotoTP;
    }

    $outputTP .= '<tr>
                        <td class="wrap"><b>TOTALE</b></td>
                        <td class="wrap text-right"><b><i class="fa fa-euro"></i> ' . number_format($totaleTP, 2, ',', '.') . ' </b></td>
                    </tr>';
    $outputTP .= '</table>';



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