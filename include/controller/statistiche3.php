<?php

function calcolaPercentuale($tot, $num)
{
    $perc = (($num * 100) / $tot);
    return number_format($perc, 2);
}

$split_graph = '';

if ($_REQUEST['check_date'] != '' || $_REQUEST['DataArrivo_al'] != '' || $_REQUEST['DataPartenza_al'] != '') {
    $split_graph = true;
} else {
    $split_graph = false;
}

if ($_REQUEST['querydate'] == '' && $_REQUEST['action'] == '') {
    $prima_data = date('Y') . '-01-01';
    $seconda_data = date('Y') . '-12-31';

    $filter_query = " AND ((hospitality_guest.DataRichiesta >= '$prima_data' AND hospitality_guest.DataRichiesta <= '$seconda_data' ) OR (hospitality_guest.DataChiuso is not null AND DATE(hospitality_guest.DataChiuso) >= '$prima_data' AND DATE(hospitality_guest.DataChiuso) <= '$seconda_data' ))";

} elseif ($_REQUEST['querydate'] != '' && $_REQUEST['action'] != 'check_date' && $_REQUEST['action'] != 'request_date') {

    if ($_REQUEST['querydate'] == '1') {
        $prima_data = date('Y') . '-01-01';
        $seconda_data = date('Y') . '-12-31';

    } else {
        $prima_data = $_REQUEST['querydate'] . '-01-01';
        $seconda_data = $_REQUEST['querydate'] . '-12-31';
    }
  $filter_query = " AND ((hospitality_guest.DataRichiesta >= '$prima_data' AND hospitality_guest.DataRichiesta <= '$seconda_data' ) OR (hospitality_guest.DataChiuso is not null AND DATE(hospitality_guest.DataChiuso) >= '$prima_data' AND DATE(hospitality_guest.DataChiuso) <= '$seconda_data' ))";
}


if ($_REQUEST['action'] == 'request_date') {

    $DataRichiesta_dal = $_REQUEST['DataRichiesta_dal'];

    $DataRichiesta_al = $_REQUEST['DataRichiesta_al'];

    $filter_query = " AND ((hospitality_guest.DataRichiesta >= '$DataRichiesta_dal' AND hospitality_guest.DataRichiesta <= '$DataRichiesta_al') OR (hospitality_guest.DataChiuso IS NOT NULL AND DATE(hospitality_guest.DataChiuso) >= '$DataRichiesta_dal' AND DATE(hospitality_guest.DataChiuso) <= '$DataRichiesta_al'))";
}

$diff_anni = (date('Y') - ANNO_ATTIVAZIONE);
$anniprima = (date('Y') - $diff_anni);
for ($i = $anniprima; $i <= date('Y'); $i++) {
    $lista_anni .= '<option value="' . $i . '" ' . (($_REQUEST['querydate'] == '' ? date('Y') : $_REQUEST['querydate']) == $i ? 'selected="selected"' : '') . '>' . $i . '</option>';
}



$select = "SELECT FontePrenotazione, Abilitato FROM hospitality_fonti_prenotazione WHERE idsito = " . IDSITO . "";
$rws = $dbMysqli->query($select);
$tot = sizeof($rws);
if ($tot > 0) {
    foreach ($rws as $key => $value) {
        $select2 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                FROM hospitality_guest
                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                WHERE hospitality_guest.FontePrenotazione = '" . addslashes($value['FontePrenotazione']) . "'
                                " . $filter_query . "
                                AND hospitality_guest.idsito = " . IDSITO . "
                                AND hospitality_guest.NoDisponibilita = 0
                                AND hospitality_guest.Disdetta = 0
                                AND hospitality_guest.Hidden = 0
                                AND hospitality_guest.TipoRichiesta = 'Conferma' ";

        $res2 = $dbMysqli->query($select2);
        $rws2 = $res2[0];
        $fatturato = $rws2['fatturato'];
        if ($fatturato == '') $fatturato = 0;
        $array_fatturato[$value['FontePrenotazione'] . '_' . $value['Abilitato']] = $fatturato;



        $select3 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato, COUNT(hospitality_guest.Id) as n
                                FROM hospitality_guest
                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                WHERE hospitality_guest.FontePrenotazione = '" . addslashes($value['FontePrenotazione']) . "'
                                " . $filter_query . "
                                AND hospitality_guest.idsito = " . IDSITO . "
                                AND hospitality_guest.NoDisponibilita = 1
                                AND hospitality_guest.Disdetta = 0
                                AND hospitality_guest.Hidden = 0
                                AND hospitality_guest.TipoRichiesta = 'Conferma' ";
        $res3 = $dbMysqli->query($select3);
        $rws3 = $res3[0];
        if (is_array($rws3)) {
            if ($rws3 > count($rws3))
                $totD = count($rws3);
        } else {
            $totD = 0;
        }
        if ($totD > 0) {
            $fatturatoD = $rws3['fatturato'];
            if ($fatturatoD == '') $fatturatoD = 0;
            $array_fatturatoD[$value['FontePrenotazione'] . '_' . $value['Abilitato'] . '_' . $rws3['n']] = $fatturatoD;

        }

    }


    $k = '';

    foreach ($array_fatturato as $k => $v) {

        $k_tmp = explode("_", $k);
        $k = $k_tmp[0];
        $abilitato = $k_tmp[1];

        if (strtolower($k) == 'sito web') {
            $selectFattLanding = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                FROM hospitality_guest
                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                INNER JOIN hospitality_tracking_ads ON hospitality_tracking_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                                WHERE 1=1
                                " . $filter_query . "
                                AND hospitality_tracking_ads.Url NOT LIKE '%.php%' 
                                AND hospitality_tracking_ads.Url != '' 
                                AND hospitality_tracking_ads.Url != '/' 
                                AND hospitality_tracking_ads.idsito = " . IDSITO . "
                                AND hospitality_guest.FontePrenotazione = 'Sito Web'
                                AND hospitality_guest.idsito = " . IDSITO . "
                                AND hospitality_guest.NoDisponibilita = 0
                                AND hospitality_guest.Disdetta = 0
                                AND hospitality_guest.Hidden = 0
                                AND hospitality_guest.TipoRichiesta = 'Conferma' ";
            $resultFattLand = $dbMysqli->query($selectFattLanding);
            $recordLand = $resultFattLand[0];

            $FattLanding = $recordLand['fatturato'];


        }

        switch (strtolower($k)) {
            case 'sito web':
                $color = '#f39c12';
                $highlight = '#f39c12';
                $label = 'Sito Web ' . ($FattLanding >= 0 ? '' : ' / Landing');
                break;
            case 'posta elettronica':
                $color = '#f56954';
                $highlight = '#f56954';
                $label = 'Posta Elettronica';
                break;
            case 'info alberghi':
                $color = '#605ca8';
                $highlight = '#605ca8';
                $label = 'Info Alberghi';
                break;
            case 'gabiccemare.com':
                $color = '#dd4b39';
                $highlight = '#dd4b39';
                $label = 'gabiccemare.com';
                break;
            case 'reception':
                $color = '#39cccc';
                $highlight = '#39cccc';
                $label = 'Reception';
                break;
            case 'telefono':
                $color = '#f012be';
                $highlight = '#f012be';
                $label = 'Telefono';
                break;
            case 'telefonata':
                $color = '#f012be';
                $highlight = '#f012be';
                $label = 'Telefonata';
                break;
            case 'whatsapp':
                $color = '#00a65a';
                $highlight = '#00a65a';
                $label = 'Whatsapp';
                break;
            case 'facebook':
                $color = '#3c8dbc';
                $highlight = '#3c8dbc';
                $label = 'Facebook';
                break;
            default:
                $color = colorGen();
                $highlight = colorGen();
                $label = $k;
                break;

        }

        $totale += $v;

        if ($v != "" || $v != 0) {
            $etichette_f[] = "'" . $k . "'";
            if (strtolower($k) == 'sito web') {
                $_SESSION['totaleSitoWeb'] = $v;
                if ($FattLanding != '' || $FattLanding != 0) {

                    $p_landing = calcolaPercentuale($totale, $FattLanding);
                    $legenda .= '<div class="row">';
                    $legenda .= '<div class="col-md-6"><label>Landing page</label></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($FattLanding, 2, ',', '.') . '</div>';
                    $legenda .= '</div><div class="borderB"></div>';
                }
            }

            $torta[] = "{value: " . $v . ", name: '" . $label . "'}";

        }
        $p_sito = ($v != 0 ? calcolaPercentuale($totale, ($v - $FattLanding)) : '');
        $p = ($v != 0 ? calcolaPercentuale($totale, $v) : '');
        $legenda .= '<div class="row">';
        $legenda .= '<div class="col-md-6"><label style=" ' . (strtolower($k) == 'sito web' ? 'font-weight:bold;cursor:pointer;' : '') . '" ' . (strtolower($k) == 'sito web' ? 'id="DettPreno"' : '') . '>' . $label . '</label>' . ($abilitato == 0 ? ' <small>(non attivo)</small>' : '') . '</div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format((strtolower($k) == 'sito web' ? ($v - $FattLanding) : $v), 2, ',', '.') . ' </div>';
        $legenda .= '</div><div class="borderB"></div>';

    }
    
	$qF = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                FROM hospitality_guest
                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                WHERE 1=1
                AND hospitality_guest.idsito = ".IDSITO."
                AND hospitality_guest.NoDisponibilita = 0
                AND hospitality_guest.Hidden = 0
                AND hospitality_guest.Disdetta = 0
                AND hospitality_guest.TipoRichiesta = 'Conferma'
                " . $filter_query . " ";
    $rF = $dbMysqli->query($qF);
    $rwc = $rF[0];

   
    $fatturatoTotaleQuoto = $rwc['fatturato'];

    if($totale < $fatturatoTotaleQuoto){

        $legenda .= '<div class="row">';
        $legenda .= '<div class="col-md-6"><label><i class="fa fa-info-circle"  data-toogle="tooltip" title="Tutto ciò che non ha una fonte di provenienza precisata!"></i> Fonte eliminata, sostituite, ecc</label></div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format(($fatturatoTotaleQuoto-$totale),2,',','.').'</div>';
        $legenda .= '</div><div class="borderB"></div>';   
        $totale  = $fatturatoTotaleQuoto;
   }
    $legenda .= '<div class="row">';
    $legenda .= '<div class="col-md-6"><b>TOTALE</b></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($totale, 2, ',', '.') . '</div>';
    $legenda .= '</div>';
    $legenda .= '<script>
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
                            $("#content").load("' . BASE_URL_SITO . 'ajax/statistiche/preno_sitoweb.php?idsito=' . IDSITO . '&filtroQuery=' . urlencode($filter_query) . '", function() {
                                $("#content_loader").hide();
                            });
                        });
                    });
                </script>' . "\r\n";

    if (array_values($array_fatturatoD) > 0) {
        if (!empty($array_fatturatoD) || !is_null($array_fatturatoD)) {
            $legendaD .= '<div class="row">';
            $legendaD .= '<div class="col-md-12"><b>Preventivi e Conferme annullate</b><br><small>Clicca sulle etichette per vedere il dettaglio e le motivazioni</small></div>';
            $legendaD .= '</div><div class="clearfix" style="padding-top:10px">&nbsp;</div>';

            foreach ($array_fatturatoD as $kD => $vD) {
                $kD_tmp = explode("_", $kD);
                $kD = $kD_tmp[0];
                $abilitatoD = $kD_tmp[1];
                $numeroD = $kD_tmp[2];
                $labelD = $kD;
                $colorD = colorGen();
                $clean_souceD = str_replace("(", "", $labelD);
                $clean_souceD = str_replace(")", "", $clean_souceD);
                $clean_souceD = str_replace(".", "", $clean_souceD);
                $clean_souceD = str_replace("-", "", $clean_souceD);
                $clean_souceD = str_replace(" ", "", $clean_souceD);
                $clean_souceD = str_replace("/", "", $clean_souceD);
                $clean_souceD = str_replace("&", "", $clean_souceD);

                if ($vD != "" || $vD != 0) {

                    $totaleD += $vD;

                    $legendaD .= '<div class="row">';
                    $legendaD .= '<div class="col-md-5"><label style="font-weight:bold;cursor:pointer;" id="DettPrenoD' . $clean_souceD . '" data-id="' . urlencode($labelD) . '">' . $labelD . '</label>' . ($abilitatoD == 0 ? ' <small>(non attivo)</small>' : '') . '</div><div class="col-md-1 nowrap"><small>(' . $numeroD . ' c.)</small></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($vD, 2, ',', '.') . ' </div>';
                    $legendaD .= '</div><div class="borderB"></div>';
                    $legendaD .= '<script>
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
                                                    $("#contentD' . $clean_souceD . '").load("' . BASE_URL_SITO . 'ajax/statistiche/dett_preno_annullate.php?idsito=' . IDSITO . '&sorgente="+referral+"&filtroQuery=' . urlencode($filter_query) . '", function() {
                                                        $("#content_loaderD' . $clean_souceD . '").hide();
                                                    });
                                                });
                                            });
                                        </script>' . "\r\n";
                }

            }
            $legendaD .= '<div class="row">';
            $legendaD .= '<div class="col-md-6"><b>TOTALE</b> <small> annullate</small></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($totaleD, 2, ',', '.') . '</div>';
            $legendaD .= '</div>';
        }
    }
}

$sl = "SELECT SUM(fatturato) as fatt,
              sorgente,
              media
         FROM (
             SELECT hospitality_proposte.PrezzoP as fatturato,
                    hospitality_custom_dimension.source as sorgente,
                    hospitality_custom_dimension.medium as media
             FROM hospitality_guest
                      INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                      INNER JOIN hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                      INNER JOIN hospitality_custom_dimension ON hospitality_custom_dimension.clientid = hospitality_client_id.CLIENT_ID
             WHERE 1 = 1
               $filter_query
               AND hospitality_guest.idsito = " . IDSITO . "
               AND hospitality_guest.FontePrenotazione = 'Sito Web'
               AND hospitality_guest.Disdetta = 0
               AND hospitality_guest.NoDisponibilita = 0
               AND hospitality_guest.Hidden = 0
               AND hospitality_guest.TipoRichiesta = 'Conferma'
               AND hospitality_client_id.idsito = " . IDSITO . "
               AND hospitality_custom_dimension.idsito = " . IDSITO . "
               AND hospitality_custom_dimension.medium != 'referral'
               AND hospitality_custom_dimension.urlpath LIKE '%?res=sent%'
             GROUP BY hospitality_custom_dimension.source, hospitality_custom_dimension.medium = 'social', hospitality_guest.NumeroPrenotazione
         ) as sub
GROUP BY sorgente, media";
$rws_ = $dbMysqli->query($sl);
foreach ($rws_ as $y => $va) {
    $array_fatturatoS[] = array('fatturato' => $va['fatt'], 'source' => $va['sorgente'], 'medium' => $va['media']);
}

// Aggiunge ad $array_fatturatoS la voce "nessuna sorgente"
$sl = "SELECT SUM(distinct(hospitality_proposte.PrezzoP)) as fatturato,
              hospitality_custom_dimension.source,
              hospitality_custom_dimension.medium
         FROM hospitality_guest
            INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
            INNER JOIN hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
            INNER JOIN hospitality_custom_dimension ON hospitality_custom_dimension.clientid = hospitality_client_id.CLIENT_ID
         WHERE 1=1
               $filter_query
           AND hospitality_guest.idsito = " . IDSITO . "
           AND hospitality_guest.FontePrenotazione = 'Sito Web'
           AND hospitality_guest.Disdetta = 0
           AND hospitality_guest.NoDisponibilita = 0
           AND hospitality_guest.Hidden = 0
           AND hospitality_guest.TipoRichiesta = 'Conferma'
           AND hospitality_client_id.idsito = " . IDSITO . "
           AND hospitality_custom_dimension.idsito = " . IDSITO . "
           AND hospitality_custom_dimension.urlpath LIKE '%?res=sent%'
           AND hospitality_custom_dimension.medium = 'referral'
      GROUP BY hospitality_custom_dimension.medium
      ORDER BY hospitality_custom_dimension.datesession ASC ";

$rws_ = $dbMysqli->query($sl);
foreach ($rws_ as $y => $va) {
    $array_fatturatoS[] = array('fatturato' => $va['fatturato'], 'source' => 'sorgente', 'medium' => $va['medium']);
}


if (!empty($array_fatturatoS) || !is_null($array_fatturatoS)) {
    $totaleS = 0;
    $x = '1';
    foreach ($array_fatturatoS as $y => $val) {
        switch (($x)) {
            case '1':
                $colorS = '#f39c12';
                $highlightS = '#f39c12';

                break;
            case '2':
                $colorS = '#f56954';
                $highlightS = '#f56954';

                break;
            case '3':
                $colorS = '#605ca8';
                $highlightS = '#605ca8';

                break;
            case '4':
                $colorS = '#39cccc';
                $highlightS = '#39cccc';

                break;
            case '5':
                $colorS = '#f012be';
                $highlightS = '#f012be';

                break;
            case '6':
                $colorS = '#00a65a';
                $highlightS = '#00a65a';

                break;
            case '7':
                $colorS = '#3c8dbc';
                $highlightS = '#3c8dbc';

                break;
            default:
                $colorS = colorGen();
                $highlightS = colorGen();

                break;

        }
        if ($val['fatturato'] != "" || $val['fatturato'] != 0) {

            $totaleS += $val['fatturato'];

            /** modifica etichetta codice promo in newsletter */
            if ($val['source'] == 'codice-promo') {
                $source = 'newsletter';
            } else {
                $source = $val['source'];
            }
            if ($val['source'] == 'facebook' && $val['medium'] == 'social') {
                $linkFB = '<a href="' . BASE_URL_SITO . 'grafici-facebook_ads_new/" class="m-l-20" data-toggle="tooltip" title="Dettaglio Campagne FaceBook"><i class="fa fa-external-link fa-flip-horizontal"></i></a>';
            } else {
                $linkFB = '';
            }
            if ($val['source'] == 'google' && $val['medium'] == 'cpc') {
                $linkCPC = '<a href="' . BASE_URL_SITO . 'grafici-ppc_ads_new/" class="m-l-20" data-toggle="tooltip" title="Dettaglio Campagne Google"><i class="fa fa-external-link fa-flip-horizontal"></i></a>';
            } else {
                $linkCPC = '';
            }
            if ($val['source'] == 'newsletter' && $val['medium'] == 'email') {
                $linkNE = '<a href="' . BASE_URL_SITO . 'grafici-newsletter_ads_new/" class="m-l-20" data-toggle="tooltip" title="Dettaglio Campagne Newsletter"><i class="fa fa-external-link fa-flip-horizontal"></i></a>';
            } else {
                $linkNE = '';
            }
            $etichette_S[] = "'" . $source . "-" . $val['medium'] . "'";
            $tortaS[] = "{value: " . $val['fatturato'] . ", name: '" . $source . "-" . $val['medium'] . "'}";

            $clean_souce = str_replace("(", "", $val['source']);
            $clean_souce = str_replace(")", "", $clean_souce);
            $clean_souce = str_replace(".", "", $clean_souce);
            $clean_souce = str_replace("-", "", $clean_souce);
            $clean_souce = str_replace("/", "", $clean_souce);

            $clean_med = str_replace("(", "", $val['medium']);
            $clean_med = str_replace(")", "", $clean_med);
            $clean_med = str_replace("", "", $clean_med);

            $legendaS .= '<div class="row">';
            $legendaS .= '<div class="col-md-6"><label  style="cursor:pointer;" id="DettPrenoS' . $clean_souce . '' . $clean_med . '" data-id="' . $val['source'] . "-" . $val['medium'] . '">' . $source . "-" . $val['medium'] . '</label>'.$linkFB.''.$linkCPC.''.$linkNE.'</div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($val['fatturato'], 2, ',', '.') . '</div>';
            $legendaS .= '</div><div class="borderB"></div>';
            $legendaS .= '<script>
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
                                        $("#contentS' . $clean_souce . '' . $clean_med . '").load("' . BASE_URL_SITO . 'ajax/statistiche/' . ($clean_med == 'referral' ? 'dett_preno_referral_sitoweb.php' : 'dett_preno_sitoweb.php') . '?idsito=' . IDSITO . '&sorgente="+referral+"&filtroQuery=' . urlencode($filter_query) . '", function() {
                                            $("#content_loaderS' . $clean_souce . '' . $clean_med . '").hide();
                                        });
                                    });
                                });
                            </script>' . "\r\n";

        }
        $x++;
    }
    if ($totaleS < $_SESSION['totaleSitoWeb']) {

        $totaleDiff = ($_SESSION['totaleSitoWeb'] - $totaleS);

        $legendaS .= '<div class="row">';
        $legendaS .= '<div class="col-md-6"><label> nessuna sorgente</label> <i class="fa fa-life-ring text-red" data-placement="right" data-toggle="tooltip" data-html="true" title="<div class=\'text-left\'>Transazioni dove non è stato possibile raccogliere informazioni sulla sorgente (es.: mancata accettazione all\'utilizzo dei cookie, oppure modulo del tracciamento non abilitato)</div>"></i></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($totaleDiff, 2, ',', '.') . '</div>';
        $legendaS .= '</div><div class="borderB"></div>';


        $totaleS += $totaleDiff;
    }
    $legendaS .= '<div class="row">';
    $legendaS .= '<div class="col-md-6"><b>TOTALE</b></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($totaleS, 2, ',', '.') . '</div>';
    $legendaS .= '</div>';


}

//region FATTURATO PER OPERATORI
//
// Query per filtrare ele operazioni effettuate dagli operatori di QUOTO
$select15 = "SELECT * FROM hospitality_operatori WHERE idsito = " . IDSITO . "";
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
                                        AND hospitality_guest.idsito = " . IDSITO . "  
                                        AND hospitality_guest.NoDisponibilita = 0
                                        AND hospitality_guest.Disdetta = 0
                                        AND hospitality_guest.Hidden = 0
                                        AND hospitality_guest.TipoRichiesta = 'Conferma' ";
        $res16 = $dbMysqli->query($select16);
        $rws16 = $res16[0];
        $fatturatoOperatore = $rws16['fatturato'];
        if ($fatturatoOperatore == '') $fatturatoOperatore = 0;
        $array_fatturatoOperatore[$operatore . '_' . $abilitatoOP] = $fatturatoOperatore;
    }
    $z = '1';
    $p_OP = '';
    foreach ($array_fatturatoOperatore as $ky => $val) {

        $ky_tmp = explode("_", $ky);
        $ky = $ky_tmp[0];
        $abilitatoOP = $ky_tmp[1];

        switch (($z)) {
            case '1':
                $colorOP = '#f39c12';
                $highlightOP = '#f39c12';

                break;
            case '2':
                $colorOP = '#f56954';
                $highlightOP = '#f56954';

                break;
            case '3':
                $colorOP = '#605ca8';
                $highlightOP = '#605ca8';

                break;
            case '4':
                $colorOP = '#39cccc';
                $highlightOP = '#39cccc';

                break;
            case '5':
                $colorOP = '#f012be';
                $highlightOP = '#f012be';

                break;
            case '6':
                $colorOP = '#00a65a';
                $highlightOP = '#00a65a';

                break;
            case '7':
                $colorOP = '#3c8dbc';
                $highlightOP = '#3c8dbc';

                break;
            default:
                $colorOP = colorGen();
                $highlightOP = colorGen();

                break;

        }

        if ($val != "" || $val != 0) {
            $etichette_OP[] = "'" . $ky . "'";
            $tortaOP[] = "{value: " . $val . ", name: '" . $ky . "'}";
        }

        $totaleOP += $val;

        $p_OP = ($val != 0 ? calcolaPercentuale($totaleOP, $val) : '');

        $legendaOP .= '<div class="row">';
        $legendaOP .= '<div class="col-md-6"><label>' . $ky . '</label>' . ($abilitatoOP == 0 ? ' <small>(non attivo)</small>' : '') . '</div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($val, 2, ',', '.') . ' </div>';
        $legendaOP .= '</div><div class="borderB"></div>';

        $z++;
    }
    $fatturatoTotaleQuotoOP = $fun->tot_fatturato(1);
    if($totaleOP < $fatturatoTotaleQuotoOP){

        $legendaOP .= '<div class="row">';
        $legendaOP .= '<div class="col-md-6"><label>Operatori eliminati, sostituiti, ecc</label></div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format(($fatturatoTotaleQuotoOP-$totaleOP),2,',','.').'</div>';
        $legendaOP .= '</div><div class="borderB"></div>';   
        $totaleOP  = $fatturatoTotaleQuotoOP;
    }
    $legendaOP .= '<div class="row">';
    $legendaOP .= '<div class="col-md-6"><b>TOTALE</b></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($totaleOP, 2, ',', '.') . '</div>';
    $legendaOP .= '</div>';

}
//PER TARGET CLIENTE
$select18 = "SELECT Target FROM hospitality_target WHERE idsito = " . IDSITO . " ORDER BY Id ASC";
$rws18 = $dbMysqli->query($select18);
$totTARGET = sizeof($rws18);
if ($totTARGET > 0) {
    foreach ($rws18 as $key18 => $value18) {

        $select19 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                FROM hospitality_guest
                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                WHERE hospitality_guest.TipoVacanza = '" . $value18['Target'] . "'
                                " . $filter_query . "
                                AND hospitality_guest.idsito = " . IDSITO . "
                                AND hospitality_guest.NoDisponibilita = 0
                                AND hospitality_guest.Disdetta = 0
                                AND hospitality_guest.Hidden = 0
                                AND hospitality_guest.TipoRichiesta = 'Conferma' ";
        $res19 = $dbMysqli->query($select19);
        $rws19 = $res19[0];
        $fatturatoTARGET = $rws19['fatturato'];
        if ($fatturatoTARGET == '') $fatturatoTARGET = 0;
        if ($fatturatoTARGET != '' || $fatturatoTARGET != 0) {

            $array_fatturatoTARGET[$value18['Target']] = $fatturatoTARGET;
        }

    }

    if (isset($array_fatturatoTARGET)) {
        $p_T = '';
        foreach ($array_fatturatoTARGET as $T => $vT) {

            switch (strtolower($T)) {
                case 'family':
                    $colorT = '#f39c12';
                    $highlightT = '#f39c12';
                    $labelT = 'Family';
                    break;
                case 'business':
                    $colorT = '#f56954';
                    $highlightT = '#f56954';
                    $labelT = 'Business';
                    break;
                case 'benessere':
                    $colorT = '#d81b60';
                    $highlightT = '#d81b60';
                    $labelT = 'Benessere';
                    break;
                case 'fiera':
                    $colorT = '#605ca8';
                    $highlightT = '#605ca8';
                    $labelT = 'Fiera';
                    break;
                case 'bike':
                    $colorT = '#39cccc';
                    $highlightT = '#39cccc';
                    $labelT = 'Bike';
                    break;
                case 'sport':
                    $colorT = '#f012be';
                    $highlightT = '#f012be';
                    $labelT = 'Sport';
                    break;
                case 'divertimento':
                    $colorT = '#00a65a';
                    $highlightT = '#00a65a';
                    $labelT = 'Divertimento';
                    break;
                case 'romantico':
                    $colorT = '#f012be';
                    $highlightT = '#f012be';
                    $labelT = 'Romantico';
                    break;
                case 'culturale':
                    $colorT = '#3c8dbc';
                    $highlightT = '#3c8dbc';
                    $labelT = 'Culturale';
                    break;
                case 'enogastronomico':
                    $colorT = '#39cccc';
                    $highlightT = '#39cccc';
                    $labelT = 'Enogastronomico';
                    break;
                default:
                    $colorT = colorGen();
                    $highlightT = colorGen();
                    $labelT = $T;
                    break;

            }

            if ($vT != "" || $vT != 0) {
                $etichette_T[] = "'" . $labelT . "'";
                $tortaT[] = "{value: " . $vT . ", name: '" . $labelT . "'}";
            }
            $totaleT += $vT;

            $p_T = ($vT != 0 ? calcolaPercentuale($totaleT, $vT) : '');

            $legendaT .= '<div class="row">';
            $legendaT .= '<div class="col-md-6"><label>' . $labelT . '</label></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($vT, 2, ',', '.') . '  </div>';
            $legendaT .= '</div><div class="borderB"></div>';
        }
        $p_T = '';
    }
    $fatturatoTotaleQuotoT = $fun->tot_fatturato(1);
    if($totaleT < $fatturatoTotaleQuotoT){

        $legendaT .= '<div class="row">';
        $legendaT .= '<div class="col-md-6"><label>Target eliminati, sostituiti, ecc</label></div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format(($fatturatoTotaleQuotoT-$totaleT),2,',','.').'</div>';
        $legendaT .= '</div><div class="borderB"></div>';   
        $totaleT  = $fatturatoTotaleQuotoT;
    }
    $legendaT .= '<div class="row">';
    $legendaT .= '<div class="col-md-6"><b>TOTALE</b></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($totaleT, 2, ',', '.') . '</div>';
    $legendaT .= '</div>';
}
//endregion FATTURATO PER OPERATORI

//region FATTURATO PER TEMPLATE
//
// Query per filtrare ele operazioni effettuate dagli operatori di QUOTO
$select20 = "SELECT * FROM hospitality_template_background WHERE idsito = " . IDSITO . "";
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
                                        AND hospitality_guest.idsito = " . IDSITO . "
                                        AND hospitality_guest.NoDisponibilita = 0
                                        AND hospitality_guest.Disdetta = 0
                                        AND hospitality_guest.Hidden = 0
                                        AND hospitality_guest.TipoRichiesta = 'Conferma' ";
        $res21 = $dbMysqli->query($select21);
        $rws21 = $res21[0];
        $fatturatoTemplate = $rws21['fatturato'];
        if ($fatturatoTemplate == '') $fatturatoTemplate = 0;
        $array_fatturatoTemplate[$NomeTemplate] = $fatturatoTemplate;
    }

    foreach ($array_fatturatoTemplate as $ky => $val) {


        switch (($ky)) {
            case 'default':
                $colorTP = '#f39c12';
                $highlightTP = '#f39c12';

                break;
            case 'smart':
                $colorTP = '#f56954';
                $highlightTP = '#f56954';

                break;
            case 'family':
                $colorTP = '#00acc1';
                $highlightTP = '#00acc1';

                break;
            case 'bike':
                $colorTP = '#31708f';
                $highlightTP = '#31708f';

                break;
            case 'romantico':
                $colorTP = '#dd4b39';
                $highlightTP = '#dd4b39';

                break;
        }

        if ($val != "" || $val != 0) {
            $etichette_TP[] = "'" . $ky . "'";
            $tortaTP[] = "{value: " . $val . ", name: '" . $ky . "'}";
        }

        $totaleTP += $val;

        if ($val != "" || $val != 0) {
            $perc = (($val * 100) / $totaleTP);
            $p_TP = (($val != "" || $val != 0) ? number_format($perc, 2) : '');
        }

        $legendaTP .= '<div class="row">';
        $legendaTP .= '<div class="col-md-6"><label>' . $ky . '</label></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($val, 2, ',', '.') . '  </div>';
        $legendaTP .= '</div><div class="borderB"></div>';


    }
    $fatturatoTotaleQuotoTP = $fun->tot_fatturato(1);
    if($totaleTP < $fatturatoTotaleQuotoTP){

        $legendaTP .= '<div class="row">';
        $legendaTP .= '<div class="col-md-6"><label>Nessun specifico template</label></div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format(($fatturatoTotaleQuotoTP-$totaleTP),2,',','.').'</div>';
        $legendaTP .= '</div><div class="borderB"></div>';   
        $totaleTP  = $fatturatoTotaleQuotoTP;
    }
    $legendaTP .= '<div class="row">';
    $legendaTP .= '<div class="col-md-6"><b>TOTALE</b></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($totaleTP, 2, ',', '.') . '</div>';
    $legendaTP .= '</div>';

}

if (is_array($torta)) {
    $data_torta = implode(',', $torta);
}
if (is_array($etichette_f)) {
    $data_etichette_f = implode(',', $etichette_f);
}

if (is_array($tortaS)) {
    $data_tortaS = implode(',', $tortaS);
}
if (is_array($etichette_S)) {
    $data_etichette_S = implode(',', $etichette_S);
}

if (is_array($tortaOP)) {
    $data_tortaOP = implode(',', $tortaOP);
}
if (is_array($etichette_OP)) {
    $data_etichette_OP = implode(',', $etichette_OP);
}

if (is_array($tortaT)) {
    $data_tortaT = implode(',', $tortaT);
}
if (is_array($etichette_T)) {
    $data_etichette_T = implode(',', $etichette_T);
}

if (is_array($tortaTP)) {
    $data_tortaTP = implode(',', $tortaTP);
}
if (is_array($etichette_TP)) {
    $data_etichette_TP = implode(',', $etichette_TP);
}

$js_script_grafici ='<script src="'.BASE_URL_SITO.'files/assets/pages/chart/echarts/js/echarts-all.js"></script>'."\r\n";
$js_script_grafici .= '
<script>
    $(document).ready(function(){' . "\r\n";

if ($tot > 0) {
    if ($array_fatturato > 0) {

       $js_script_grafici .= "
        
            var pieChart = echarts.init(document.getElementById('pieChart'));

            // specify chart configuration item and data
            option = {

                    tooltip: {
                            trigger: 'item',
                            formatter: \"{a} <br/>{b} : {c} ({d}%)\"
                    },
                    legend: {
                            x: 'center',
                            y: 'top',
                            data: [" . $data_etichette_f . "],
                    },
                    toolbox: {
                            show: true,
                            feature: {

                                    dataView: { show: true, readOnly: false },
                                    magicType: {
                                            show: false,
                                            type: ['pie']
                                    },
                                    restore: { show: false },
                                    saveAsImage: { show: true }
                            }
                    },
                calculable: true,
                series : [
                    {
                        name: 'Fatturato',
                        type: 'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        data:[" . $data_torta . "],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };
            // use configuration item and data specified to show chart
            pieChart.setOption(option, true), $(function() {
                    function resize() {
                            setTimeout(function() {
                                    pieChart.resize()
                            }, 100)
                    }
                    $(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
            });" . "\r\n";
    }
}
if (!empty($array_fatturatoS) || !is_null($array_fatturatoS)) {
    $js_script_grafici .= "
        var pieChart = echarts.init(document.getElementById('pieChart2'));

        // specify chart configuration item and data
        option = {

                tooltip: {
                        trigger: 'item',
                        formatter: \"{a} <br/>{b} : {c} ({d}%)\"
                },
                legend: {
                        x: 'center',
                        y: 'top',
                        data: [" . $data_etichette_S . "],
                },
                toolbox: {
                        show: true,
                        feature: {

                                dataView: { show: true, readOnly: false },
                                magicType: {
                                        show: false,
                                        type: ['pie']
                                },
                                restore: { show: false },
                                saveAsImage: { show: true }
                        }
                },
            calculable: true,
            series : [
                {
                    name: 'Fatturato',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[" . $data_tortaS . "],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };
        // use configuration item and data specified to show chart
        pieChart.setOption(option, true), $(function() {
                function resize() {
                        setTimeout(function() {
                                pieChart.resize()
                        }, 100)
                }
                $(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
        });" . "\r\n";
}
if ($totOperatore > 0) {
    if ($array_fatturatoOperatore > 0) {
        $js_script_grafici .= "
            var pieChart = echarts.init(document.getElementById('pieChart3'));

            // specify chart configuration item and data
            option = {

                    tooltip: {
                            trigger: 'item',
                            formatter: \"{a} <br/>{b} : {c} ({d}%)\"
                    },
                    legend: {
                            x: 'center',
                            y: 'top',
                            data: [" . $data_etichette_OP . "],
                    },
                    toolbox: {
                            show: true,
                            feature: {

                                    dataView: { show: true, readOnly: false },
                                    magicType: {
                                            show: false,
                                            type: ['pie']
                                    },
                                    restore: { show: false },
                                    saveAsImage: { show: true }
                            }
                    },
                calculable: true,
                series : [
                    {
                        name: 'Fatturato',
                        type: 'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        data:[" . $data_tortaOP . "],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };
            // use configuration item and data specified to show chart
            pieChart.setOption(option, true), $(function() {
                    function resize() {
                            setTimeout(function() {
                                    pieChart.resize()
                            }, 100)
                    }
                    $(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
            });" . "\r\n";
    }
}
if ($totTARGET > 0) {
    if ($array_fatturatoTARGET > 0) {
        $js_script_grafici .= "
            var pieChart = echarts.init(document.getElementById('pieChart4'));

            // specify chart configuration item and data
            option = {

                    tooltip: {
                            trigger: 'item',
                            formatter: \"{a} <br/>{b} : {c} ({d}%)\"
                    },
                    legend: {
                            x: 'center',
                            y: 'top',
                            data: [" . $data_etichette_T . "],
                    },
                    toolbox: {
                            show: true,
                            feature: {

                                    dataView: { show: true, readOnly: false },
                                    magicType: {
                                            show: false,
                                            type: ['pie']
                                    },
                                    restore: { show: false },
                                    saveAsImage: { show: true }
                            }
                    },
                calculable: true,
                series : [
                    {
                        name: 'Fatturato',
                        type: 'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        data:[" . $data_tortaT . "],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };
            // use configuration item and data specified to show chart
            pieChart.setOption(option, true), $(function() {
                    function resize() {
                            setTimeout(function() {
                                    pieChart.resize()
                            }, 100)
                    }
                    $(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
            });" . "\r\n";
    }
}
if ($totTemplate > 0) {
    if ($array_fatturatoTemplate > 0) {
        $js_script_grafici .= "
            var pieChart = echarts.init(document.getElementById('pieChart5'));

            // specify chart configuration item and data
            option = {

                    tooltip: {
                            trigger: 'item',
                            formatter: \"{a} <br/>{b} : {c} ({d}%)\"
                    },
                    legend: {
                            x: 'center',
                            y: 'top',
                            data: [" . $data_etichette_TP . "],
                    },
                    toolbox: {
                            show: true,
                            feature: {

                                    dataView: { show: true, readOnly: false },
                                    magicType: {
                                            show: false,
                                            type: ['pie']
                                    },
                                    restore: { show: false },
                                    saveAsImage: { show: true }
                            }
                    },
                calculable: true,
                series : [
                    {
                        name: 'Fatturato',
                        type: 'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        data:[" . $data_tortaTP . "],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };
            // use configuration item and data specified to show chart
            pieChart.setOption(option, true), $(function() {
                    function resize() {
                            setTimeout(function() {
                                    pieChart.resize()
                            }, 100)
                    }
                    $(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
            });" . "\r\n";
    }
}
$js_script_grafici .= '    });
</script>' . "\r\n";
//endregion FATTURATO PER TEMPLATE

if ($_REQUEST['action'] == 'check_date') {

    $select = "SELECT FontePrenotazione, Abilitato FROM hospitality_fonti_prenotazione WHERE idsito = " . IDSITO . "";
    $rws = $dbMysqli->query($select);
    $tot2 = sizeof($rws);
    if ($tot2 > 0) {
        foreach ($rws as $key => $value) {

            $select2 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                    FROM hospitality_guest
                                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                    WHERE hospitality_guest.FontePrenotazione = '" . $value['FontePrenotazione'] . "'
                                    " . $filter_query2 . "
                                    AND hospitality_guest.idsito = " . IDSITO . "
                                    AND hospitality_guest.NoDisponibilita = 0
                                    AND hospitality_guest.Disdetta = 0
                                    AND hospitality_guest.TipoRichiesta = 'Conferma' ";
            $res2 = $dbMysqli->query($select2);
            $rws2 = $res2[0];
            $fatturato2 = $rws2['fatturato'];
            if ($fatturato2 == '') $fatturato2 = 0;
            $array_fatturato2[$value['FontePrenotazione'] . '_' . $value['Abilitato']] = $fatturato2;

        }

        $k = '';
        foreach ($array_fatturato2 as $k2 => $v2) {

            $k_tmp = explode("_", $k2);
            $k2 = $k_tmp[0];
            $abilitato = $k_tmp[1];

            switch (strtolower($k2)) {
                case 'sito web':
                    $color2 = '#f39c12';
                    $highlight2 = '#f39c12';
                    $label2 = 'Sito Web';
                    break;
                case 'posta elettronica':
                    $color2 = '#f56954';
                    $highlight2 = '#f56954';
                    $label2 = 'Posta Elettronica';
                    break;
                case 'info alberghi':
                    $color2 = '#605ca8';
                    $highlight2 = '#605ca8';
                    $label2 = 'Info Alberghi';
                    break;
                case 'gabiccemare.com':
                    $color2 = '#dd4b39';
                    $highlight2 = '#dd4b39';
                    $label2 = 'gabiccemare.com';
                    break;
                case 'reception':
                    $color2 = '#39cccc';
                    $highlight2 = '#39cccc';
                    $label2 = 'Reception';
                    break;
                case 'telefono':
                    $color2 = '#f012be';
                    $highlight2 = '#f012be';
                    $label2 = 'Telefono';
                    break;
                case 'telefonata':
                    $color2 = '#f012be';
                    $highlight2 = '#f012be';
                    $label2 = 'Telefonata';
                    break;
                case 'whatsapp':
                    $color2 = '#00a65a';
                    $highlight2 = '#00a65a';
                    $label2 = 'Whatsapp';
                    break;
                case 'facebook':
                    $color2 = '#3c8dbc';
                    $highlight2 = '#3c8dbc';
                    $label2 = 'Facebook';
                    break;
                default:
                    $color2 = colorGen();
                    $highlight2 = colorGen();
                    $label2 = $k;
                    break;

            }

            if ($v2 != "" || $v2 != 0) {
                $etichette_f2[] = "'" . $k2 . "'";
                $torta2[] = "{value: " . $v2 . ", name: '" . $label2 . "'}";
            }

            $legenda2 .= '<div class="row">';
            $legenda2 .= '<div class="col-md-6"><label class="badge" style="background-color:' . $color2 . '">' . $label2 . '</label>' . ($abilitato == 0 ? ' <small>(non attivo)</small>' : '') . '</div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($v2, 2, ',', '.') . '</div>';
            $legenda2 .= '</div>';

            $totale2 += $v2;

        }
        $legenda2 .= '<div class="row">';
        $legenda2 .= '<div class="col-md-6"><b>TOTALE</b></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($totale2, 2, ',', '.') . '</div>';
        $legenda2 .= '</div>';
    }

    $sl = "SELECT 
                    SUM(hospitality_proposte.PrezzoP) as fatturato,
                    hospitality_custom_dimension.source,
                    hospitality_custom_dimension.medium
                FROM 
                    hospitality_guest
                INNER JOIN 
                    hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                INNER JOIN 
                    hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                INNER JOIN 
                    hospitality_custom_dimension ON hospitality_custom_dimension.clientid = hospitality_client_id.CLIENT_ID
                WHERE 
                    1=1
                    " . $filter_query . "
                AND 
                    hospitality_guest.idsito = " . IDSITO . "

                AND 
                    hospitality_guest.FontePrenotazione = 'Sito Web'
                AND 
                    hospitality_guest.Disdetta = 0
                AND 
                    hospitality_guest.NoDisponibilita = 0
                AND 
                    hospitality_guest.Hidden = 0
                AND 
                    hospitality_guest.TipoRichiesta = 'Conferma' 
                AND 
                    hospitality_custom_dimension.idsito = " . IDSITO . "
                AND 
                    hospitality_custom_dimension.urlpath LIKE '%?res=sent%'
                GROUP BY 
                    hospitality_guest.NumeroPrenotazione
                ORDER BY
                    hospitality_custom_dimension.datesession ASC ";
    $rws_ = $dbMysqli->query($sl);
    foreach ($rws_ as $y => $va) {
        $array_fatturatoS2[] = array('fatturato' => $va['fatturato'], 'source' => $va['source'], 'medium' => $va['medium']);
    }

    if (!empty($array_fatturatoS2) || !is_null($array_fatturatoS2)) {
        $x = '1';
        foreach ($array_fatturatoS2 as $y => $val) {

            switch (($x)) {
                case '1':
                    $colorS = '#f39c12';
                    $highlightS = '#f39c12';

                    break;
                case '2':
                    $colorS = '#f56954';
                    $highlightS = '#f56954';

                    break;
                case '3':
                    $colorS = '#605ca8';
                    $highlightS = '#605ca8';

                    break;
                case '4':
                    $colorS = '#39cccc';
                    $highlightS = '#39cccc';

                    break;
                case '5':
                    $colorS = '#f012be';
                    $highlightS = '#f012be';

                    break;
                case '6':
                    $colorS = '#00a65a';
                    $highlightS = '#00a65a';

                    break;
                case '7':
                    $colorS = '#3c8dbc';
                    $highlightS = '#3c8dbc';

                    break;
                default:
                    $colorS = colorGen();
                    $highlightS = colorGen();

                    break;

            }
            if ($val['fatturato'] != "" || $val['fatturato'] != 0) {

                $totaleS2 += $val['fatturato'];


                $etichette_S2[] = "'" . $val['source'] . "-" . $val['medium'] . "'";
                $tortaS2[] = "{value: " . $val['fatturato'] . ", name: '" . $val['source'] . "-" . $val['medium'] . "'}";

                $legendaS2 .= '<div class="row">';
                $legendaS2 .= '<div class="col-md-6"><label class="badge" style="background-color:' . $colorS . '">' . $val['source'] . "-" . $val['medium'] . '</label></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($val['fatturato'], 2, ',', '.') . '</div>';
                $legendaS2 .= '</div>';
            }
            $x++;
        }
        $legendaS2 .= '<div class="row">';
        $legendaS2 .= '<div class="col-md-6"><b>TOTALE</b></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($totaleS, 2, ',', '.') . '</div>';
        $legendaS2 .= '</div>';

    }

    // FATTURATO PER OPERATORI
    //
    // Query per filtrare ele operazioni effettuate dagli operatori di QUOTO
    $select15 = "SELECT * FROM hospitality_operatori WHERE idsito = " . IDSITO . "";
    $rws15 = $dbMysqli->query($select15);
    $totOperatore2 = sizeof($rws15);
    if ($totOperatore2 > 0) {

        $operatore2 = '';
        $abilitatoOP2 = '';

        foreach ($rws15 as $key15 => $value15) {

            $operatore2 = trim(addslashes($value15['NomeOperatore']));
            $abilitatoOP2 = $value15['Abilitato'];


            $select16 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                            FROM hospitality_guest
                                            INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                            WHERE hospitality_guest.ChiPrenota = '" . $operatore2 . "'
                                            " . $filter_query2 . "
                                            AND hospitality_guest.idsito = " . IDSITO . "
                                            AND hospitality_guest.NoDisponibilita = 0
                                            AND hospitality_guest.Disdetta = 0
                                            AND hospitality_guest.TipoRichiesta = 'Conferma' ";
            $res16 = $dbMysqli->query($select16);
            $rws16 = $res16[0];
            $fatturatoOperatore2 = $rws16['fatturato'];
            if ($fatturatoOperatore2 == '') $fatturatoOperatore2 = 0;
            $array_fatturatoOperatore2[$operatore2 . '_' . $abilitatoOP2] = $fatturatoOperatore2;
        }
        $z = '1';
        foreach ($array_fatturatoOperatore2 as $ky2 => $val2) {

            $ky_tmp = explode("_", $ky2);
            $ky2 = $ky_tmp[0];
            $abilitatoOP2 = $ky_tmp[1];

            switch (($z)) {
                case '1':
                    $colorOP2 = '#f39c12';
                    $highlightOP2 = '#f39c12';

                    break;
                case '2':
                    $colorOP2 = '#f56954';
                    $highlightOP2 = '#f56954';

                    break;
                case '3':
                    $colorOP2 = '#605ca8';
                    $highlightOP2 = '#605ca8';

                    break;
                case '4':
                    $colorOP2 = '#39cccc';
                    $highlightOP2 = '#39cccc';

                    break;
                case '5':
                    $colorOP2 = '#f012be';
                    $highlightOP2 = '#f012be';

                    break;
                case '6':
                    $colorOP2 = '#00a65a';
                    $highlightOP2 = '#00a65a';

                    break;
                case '7':
                    $colorOP2 = '#3c8dbc';
                    $highlightOP2 = '#3c8dbc';

                    break;
                default:
                    $colorOP2 = colorGen();
                    $highlightOP2 = colorGen();

                    break;

            }

            if ($val2 != "" || $val2 != 0) {
                $etichette_OP2[] = "'" . $ky2 . "'";
                $tortaOP2[] = "{value: " . $val2 . ", name: '" . $ky2 . "'}";
            }

            $totaleOP2 += $val2;

            $legendaOP2 .= '<div class="row">';
            $legendaOP2 .= '<div class="col-md-6"><label class="badge" style="background-color:' . $colorOP2 . '">' . $ky2 . '</label>' . ($abilitatoOP2 == 0 ? ' <small>(non attivo)</small>' : '') . '</div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($val2, 2, ',', '.') . '</div>';
            $legendaOP2 .= '</div>';

            $z++;
        }
        $legendaOP2 .= '<div class="row">';
        $legendaOP2 .= '<div class="col-md-6"><b>TOTALE</b></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($totaleOP2, 2, ',', '.') . '</div>';
        $legendaOP2 .= '</div>';

    }
    //PER TARGET CLIENTE
    $select18 = "SELECT Target FROM hospitality_target WHERE idsito = " . IDSITO . " ORDER BY Id ASC";
    $rws18 = $dbMysqli->query($select18);
    $totTARGET2 = sizeof($rws18);
    if ($totTARGET2 > 0) {
        foreach ($rws18 as $key18 => $value18) {

            $select19 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                    FROM hospitality_guest
                                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                    WHERE hospitality_guest.TipoVacanza = '" . $value18['Target'] . "'
                                    " . $filter_query2 . "
                                    AND hospitality_guest.idsito = " . IDSITO . "
                                    AND hospitality_guest.NoDisponibilita = 0
                                    AND hospitality_guest.Disdetta = 0
                                    AND hospitality_guest.TipoRichiesta = 'Conferma' ";
            $res19 = $dbMysqli->query($select19);
            $rws19 = $res19[0];
            $fatturatoTARGET2 = $rws19['fatturato'];
            if ($fatturatoTARGET2 == '') $fatturatoTARGET2 = 0;
            if ($fatturatoTARGET2 != '' || $fatturatoTARGET2 != 0) {

                $array_fatturatoTARGET2[$value18['Target']] = $fatturatoTARGET2;
            }

        }

        if (isset($array_fatturatoTARGET2)) {
            foreach ($array_fatturatoTARGET2 as $T2 => $vT2) {

                switch (strtolower($T2)) {
                    case 'family':
                        $colorT2 = '#f39c12';
                        $highlightT2 = '#f39c12';
                        $labelT2 = 'Family';
                        break;
                    case 'business':
                        $colorT2 = '#f56954';
                        $highlightT2 = '#f56954';
                        $labelT2 = 'Business';
                        break;
                    case 'benessere':
                        $colorT2 = '#d81b60';
                        $highlightT2 = '#d81b60';
                        $labelT2 = 'Benessere';
                        break;
                    case 'fiera':
                        $colorT2 = '#605ca8';
                        $highlightT2 = '#605ca8';
                        $labelT2 = 'Fiera';
                        break;
                    case 'bike':
                        $colorT2 = '#39cccc';
                        $highlightT2 = '#39cccc';
                        $labelT2 = 'Bike';
                        break;
                    case 'sport':
                        $colorT2 = '#f012be';
                        $highlightT2 = '#f012be';
                        $labelT2 = 'Sport';
                        break;
                    case 'divertimento':
                        $colorT2 = '#00a65a';
                        $highlightT2 = '#00a65a';
                        $labelT2 = 'Divertimento';
                        break;
                    case 'romantico':
                        $colorT2 = '#f012be';
                        $highlightT2 = '#f012be';
                        $labelT2 = 'Romantico';
                        break;
                    case 'culturale':
                        $colorT2 = '#3c8dbc';
                        $highlightT2 = '#3c8dbc';
                        $labelT2 = 'Culturale';
                        break;
                    case 'enogastronomico':
                        $colorT2 = '#39cccc';
                        $highlightT2 = '#39cccc';
                        $labelT2 = 'Enogastronomico';
                        break;
                    default:
                        $colorT2 = colorGen();
                        $highlightT2 = colorGen();
                        $labelT2 = $T;
                        break;

                }

                if ($vT2 != "" || $vT2 != 0) {
                    $etichette_T2[] = "'" . $labelT2 . "'";
                    $tortaT2[] = "{value: " . $vT2 . ", name: '" . $labelT2 . "'}";
                }
                $totaleT2 += $vT2;

                $legendaT2 .= '<div class="row">';
                $legendaT2 .= '<div class="col-md-6"><label class="badge" style="background-color:' . $colorT2 . '">' . $labelT2 . '</label></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($vT2, 2, ',', '.') . '</div>';
                $legendaT2 .= '</div>';
            }
        }
        $legendaT2 .= '<div class="row">';
        $legendaT2 .= '<div class="col-md-6"><b>TOTALE</b></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($totaleT2, 2, ',', '.') . '</div>';
        $legendaT2 .= '</div>';
    }

    // FATTURATO PER TEMPLATE
    //
    // Query per filtrare ele operazioni effettuate dagli operatori di QUOTO
    $selectTemp = "SELECT * FROM hospitality_template_background WHERE idsito = " . IDSITO . "";
    $rwsTemp = $dbMysqli->query($selectTemp);
    $totTemplateTemp2 = sizeof($rwsTemp);

    if ($totTemplate2 > 0) {

        $template2 = '';
        $NomeTemplate2 = '';

        foreach ($rwsTemp as $keyTemp => $valueTemp) {


            $template2 = $valueTemp['Id'];
            $NomeTemplate2 = $valueTemp['TemplateName'];

            $select21Temp = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                            FROM hospitality_guest
                                            INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                            WHERE 1=1
                                            AND hospitality_guest.id_template = '" . $template2 . "'
                                            " . $filter_query2 . "
                                            AND hospitality_guest.idsito = " . IDSITO . "
                                            AND hospitality_guest.NoDisponibilita = 0
                                            AND hospitality_guest.Disdetta = 0
                                            AND hospitality_guest.TipoRichiesta = 'Conferma' ";
            $res21Temp = $dbMysqli->query($select21Temp);
            $rws21Temp = $res21Temp[0];
            $fatturatoTemplate2 = $rws21Temp['fatturato'];
            if ($fatturatoTemplate2 == '') $fatturatoTemplate2 = 0;
            $array_fatturatoTemplate2[$NomeTemplate] = $fatturatoTemplate2;
        }


        foreach ($array_fatturatoTemplate2 as $ky2 => $val2) {

            switch (($ky2)) {
                case 'default':
                    $colorTP2 = '#f39c12';
                    $highlightTP2 = '#f39c12';

                    break;
                case 'smart':
                    $colorTP2 = '#f56954';
                    $highlightTP2 = '#f56954';

                    break;

            }

            if ($val2 != "" || $val2 != 0) {
                $etichette_TP2[] = "'" . $ky2 . "'";
                $tortaTP2[] = "{value: " . $val2 . ", name: '" . $ky2 . "'}";
            }

            $totaleTP2 += $val2;

            $legendaTP2 .= '<div class="row">';
            $legendaTP2 .= '<div class="col-md-6"><label class="badge" style="background-color:' . $colorTP2 . '">' . $ky2 . '</label></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($val2, 2, ',', '.') . '</div>';
            $legendaTP2 .= '</div>';


        }
        $legendaTP2 .= '<div class="row">';
        $legendaTP2 .= '<div class="col-md-6"><b>TOTALE</b></div><div class="col-md-6"><i class="fa fa-euro"></i> ' . number_format($totaleTP2, 2, ',', '.') . '</div>';
        $legendaTP2 .= '</div>';

    }


    if (is_array($torta2)) {
        $data_torta2 = implode(',', $torta2);
    }
    if (is_array($etichette_f2)) {
        $data_etichette_f2 = implode(',', $etichette_f2);
    }

    if (is_array($tortaS2)) {
        $data_tortaS2 = implode(',', $tortaS2);
    }
    if (is_array($etichette_S2)) {
        $data_etichette_S2 = implode(',', $etichette_S2);
    }

    if (is_array($tortaOP2)) {
        $data_tortaOP2 = implode(',', $tortaOP2);
    }
    if (is_array($etichette_OP2)) {
        $data_etichette_OP2 = implode(',', $etichette_OP2);
    }

    if (is_array($tortaT2)) {
        $data_tortaT2 = implode(',', $tortaT2);
    }
    if (is_array($etichette_T2)) {
        $data_etichette_T2 = implode(',', $etichette_T2);
    }

    if (is_array($tortaTP2)) {
        $data_tortaTP2 = implode(',', $tortaTP2);
    }
    if (is_array($etichette_TP2)) {
        $data_etichette_TP2 = implode(',', $etichette_TP2);
    }

    $js_script_grafici .= '
    <script>
        $(document).ready(function(){' . "\r\n";

    if ($tot2 > 0) {
        if ($array_fatturato2 > 0) {

            $js_script_grafici .= "
                var pieChart2 = echarts.init(document.getElementById('pieChart_bis'));

                // specify chart configuration item and data
                option = {

                        tooltip: {
                                trigger: 'item',
                                formatter: \"{a} <br/>{b} : {c} ({d}%)\"
                        },
                        legend: {
                                x: 'center',
                                y: 'top',
                                data: [" . $data_etichette_f2 . "],
                        },
                        toolbox: {
                                show: true,
                                feature: {

                                        dataView: { show: true, readOnly: false },
                                        magicType: {
                                                show: false,
                                                type: ['pie']
                                        },
                                        restore: { show: false },
                                        saveAsImage: { show: true }
                                }
                        },
                    calculable: true,
                    series : [
                        {
                            name: 'Fatturato',
                            type: 'pie',
                            radius : '55%',
                            center: ['50%', '60%'],
                            data:[" . $data_torta2 . "],
                            itemStyle: {
                                emphasis: {
                                    shadowBlur: 10,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                }
                            }
                        }
                    ]
                };
                // use configuration item and data specified to show chart
                pieChart2.setOption(option, true), $(function() {
                        function resize() {
                                setTimeout(function() {
                                        pieChart2.resize()
                                }, 100)
                        }
                        $(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
                });" . "\r\n";
        }
    }
    if (!empty($array_fatturatoS2) || !is_null($array_fatturatoS2)) {
        $js_script_grafici .= "
            var pieChart2 = echarts.init(document.getElementById('pieChart2_bis'));

            // specify chart configuration item and data
            option = {

                    tooltip: {
                            trigger: 'item',
                            formatter: \"{a} <br/>{b} : {c} ({d}%)\"
                    },
                    legend: {
                            x: 'center',
                            y: 'top',
                            data: [" . $data_etichette_S2 . "],
                    },
                    toolbox: {
                            show: true,
                            feature: {

                                    dataView: { show: true, readOnly: false },
                                    magicType: {
                                            show: false,
                                            type: ['pie']
                                    },
                                    restore: { show: false },
                                    saveAsImage: { show: true }
                            }
                    },
                calculable: true,
                series : [
                    {
                        name: 'Fatturato',
                        type: 'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        data:[" . $data_tortaS2 . "],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };
            // use configuration item and data specified to show chart
            pieChart2.setOption(option, true), $(function() {
                    function resize() {
                            setTimeout(function() {
                                    pieChart2.resize()
                            }, 100)
                    }
                    $(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
            });" . "\r\n";
    }
    if ($totOperatore2 > 0) {
        if ($array_fatturatoOperatore2 > 0) {
            $js_script_grafici .= "
                var pieChart2 = echarts.init(document.getElementById('pieChart3_bis'));

                // specify chart configuration item and data
                option = {

                        tooltip: {
                                trigger: 'item',
                                formatter: \"{a} <br/>{b} : {c} ({d}%)\"
                        },
                        legend: {
                                x: 'center',
                                y: 'top',
                                data: [" . $data_etichette_OP2 . "],
                        },
                        toolbox: {
                                show: true,
                                feature: {

                                        dataView: { show: true, readOnly: false },
                                        magicType: {
                                                show: false,
                                                type: ['pie']
                                        },
                                        restore: { show: false },
                                        saveAsImage: { show: true }
                                }
                        },
                    calculable: true,
                    series : [
                        {
                            name: 'Fatturato',
                            type: 'pie',
                            radius : '55%',
                            center: ['50%', '60%'],
                            data:[" . $data_tortaOP2 . "],
                            itemStyle: {
                                emphasis: {
                                    shadowBlur: 10,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                }
                            }
                        }
                    ]
                };
                // use configuration item and data specified to show chart
                pieChart2.setOption(option, true), $(function() {
                        function resize() {
                                setTimeout(function() {
                                        pieChart2.resize()
                                }, 100)
                        }
                        $(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
                });" . "\r\n";
        }
    }
    if ($totTARGET2 > 0) {
        if ($array_fatturatoTARGET2 > 0) {
            $js_script_grafici .= "
                var pieChart2 = echarts.init(document.getElementById('pieChart4_bis'));

                // specify chart configuration item and data
                option = {

                        tooltip: {
                                trigger: 'item',
                                formatter: \"{a} <br/>{b} : {c} ({d}%)\"
                        },
                        legend: {
                                x: 'center',
                                y: 'top',
                                data: [" . $data_etichette_T2 . "],
                        },
                        toolbox: {
                                show: true,
                                feature: {

                                        dataView: { show: true, readOnly: false },
                                        magicType: {
                                                show: false,
                                                type: ['pie']
                                        },
                                        restore: { show: false },
                                        saveAsImage: { show: true }
                                }
                        },
                    calculable: true,
                    series : [
                        {
                            name: 'Fatturato',
                            type: 'pie',
                            radius : '55%',
                            center: ['50%', '60%'],
                            data:[" . $data_tortaT2 . "],
                            itemStyle: {
                                emphasis: {
                                    shadowBlur: 10,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                }
                            }
                        }
                    ]
                };
                // use configuration item and data specified to show chart
                pieChart2.setOption(option, true), $(function() {
                        function resize() {
                                setTimeout(function() {
                                        pieChart2.resize()
                                }, 100)
                        }
                        $(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
                });" . "\r\n";
        }
    }
    if ($totTemplate2 > 0) {
        if ($array_fatturatoTemplate2 > 0) {
            $js_script_grafici .= "
                var pieChart2 = echarts.init(document.getElementById('pieChart5_bis'));

                // specify chart configuration item and data
                option = {

                        tooltip: {
                                trigger: 'item',
                                formatter: \"{a} <br/>{b} : {c} ({d}%)\"
                        },
                        legend: {
                                x: 'center',
                                y: 'top',
                                data: [" . $data_etichette_TP2 . "],
                        },
                        toolbox: {
                                show: true,
                                feature: {

                                        dataView: { show: true, readOnly: false },
                                        magicType: {
                                                show: false,
                                                type: ['pie']
                                        },
                                        restore: { show: false },
                                        saveAsImage: { show: true }
                                }
                        },
                    calculable: true,
                    series : [
                        {
                            name: 'Fatturato',
                            type: 'pie',
                            radius : '55%',
                            center: ['50%', '60%'],
                            data:[" . $data_tortaTP2 . "],
                            itemStyle: {
                                emphasis: {
                                    shadowBlur: 10,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                }
                            }
                        }
                    ]
                };
                // use configuration item and data specified to show chart
                pieChart2.setOption(option, true), $(function() {
                        function resize() {
                                setTimeout(function() {
                                        pieChart2.resize()
                                }, 100)
                        }
                        $(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
                });" . "\r\n";
        }
    }
    $js_script_grafici .= '   

        });
</script>' . "\r\n";


}


$js_load = '
<script>
    $(document).ready(function() {
        $("#relation_requestdate").on("submit",function(){
            $("#view_loading_statistiche").html(\'<div class="row"><div class="col-md-12 text-center"><img src="' . BASE_URL_SITO . 'img/Ellipsis-1s-200px.svg" alt="Filtro per query sul Fatturato QUOTO v2"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine del filtro!</small></div></div>\');
        });
        $("#filter_year").on("change",function(){
            $("#view_loading_statistiche").html(\'<div class="row"><div class="col-md-12 text-center"><img src="' . BASE_URL_SITO . 'img/Ellipsis-1s-200px.svg" alt="Filtro per query sul Fatturato QUOTO v2"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine del filtro!</small></div></div>\');
        });
        $("#relation_checkdate").on("submit",function(){
            $("#view_loading_statistiche").html(\'<div class="row"><div class="col-md-12 text-center"><img src="' . BASE_URL_SITO . 'img/Ellipsis-1s-200px.svg" alt="Filtro per query sul Fatturato QUOTO v2"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine del filtro!</small></div></div>\');
        });
        var i = 0;
        var speed = 500;
        link = setInterval(function() {
            i++;
            $("#blink_fatturatoS").css(\'color\', i%2 == 1 ? \'#DD4B39\' : \'#2C3B41\');
            $("#blink_fatturatoS2").css(\'color\', i%2 == 1 ? \'#DD4B39\' : \'#2C3B41\');
        },speed);
});
</script>' . "\r\n";
