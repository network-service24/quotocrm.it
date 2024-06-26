<?php
error_reporting(0);

if ($_REQUEST['querydate'] == '' && $_REQUEST['action'] == '') {
    $prima_data = date('Y') . '-01-01 00:00:00';
    $seconda_data = date('Y') . '-12-31 23:59:59';
    $prima_data_r = date('Y') . '-01-01';
    $seconda_data_r = date('Y') . '-12-31';
    /*     $meno_1mese = mktime (0,0,0,(date('m')-1),date('d'),date('Y'));
        $prima_data_ = date('Y-m-d',$meno_1mese);
        $prima_data   = $prima_data_.' 00:00:00';
        $seconda_data = date('Y').'-'.date('m').'-31 23:59:59'; */
    // $filter_query = " AND date(hospitality_guest.DataChiuso)>= '".$prima_data."' AND date(hospitality_guest.DataChiuso) <= '".$seconda_data."' ";
    $filter_query   = " AND ((hospitality_guest.DataRichiesta >= '$prima_data_r' AND hospitality_guest.DataRichiesta <= '$seconda_data_r') OR (date(hospitality_guest.DataChiuso) IS NOT NULL AND date(hospitality_guest.DataChiuso) >= '$prima_data_r' AND date(hospitality_guest.DataChiuso) <= '$seconda_data_r'))";
    $filter_query_r = " AND ((hospitality_guest.DataRichiesta >= '$prima_data_r' AND hospitality_guest.DataRichiesta <= '$seconda_data_r') OR (date(hospitality_guest.DataChiuso) IS NOT NULL AND date(hospitality_guest.DataChiuso) >= '$prima_data_r' AND date(hospitality_guest.DataChiuso) <= '$seconda_data_r'))";

} elseif ($_REQUEST['querydate'] != '' && $_REQUEST['action'] != 'check_date' && $_REQUEST['action'] != 'request_date') {
    if ($_REQUEST['querydate'] == '1') {
        $prima_data = date('Y') . '-01-01 00:00:00';
        $seconda_data = date('Y') . '-12-31 23:59:59';
        $prima_data_r = date('Y') . '-01-01';
        $seconda_data_r = date('Y') . '-12-31';
        /*         $meno_1mese = mktime (0,0,0,(date('m')-1),date('d'),date('Y'));
                $prima_data_ = date('Y-m-d',$meno_1mese);
                $prima_data   = $prima_data_.' 00:00:00';
                $seconda_data = date('Y').'-'.date('m').'-31 23:59:59'; */
    } else {
        $prima_data = $_REQUEST['querydate'] . '-01-01 00:00:00';
        $seconda_data = $_REQUEST['querydate'] . '-12-31 23:59:59';
        $prima_data_r = $_REQUEST['querydate'] . '-01-01';
        $seconda_data_r = $_REQUEST['querydate'] . '-12-31';
    }
    // $filter_query = " AND date(hospitality_guest.DataChiuso) >= '".$prima_data."' AND date(hospitality_guest.DataChiuso) <= '".$seconda_data."' ";
    $filter_query   = " AND ((hospitality_guest.DataRichiesta >= '$prima_data_r' AND hospitality_guest.DataRichiesta <= '$seconda_data_r') OR (date(hospitality_guest.DataChiuso) IS NOT NULL AND date(hospitality_guest.DataChiuso) >= '$prima_data_r' AND date(hospitality_guest.DataChiuso) <= '$seconda_data_r'))";
    $filter_query_r = " AND ((hospitality_guest.DataRichiesta >= '$prima_data_r' AND hospitality_guest.DataRichiesta <= '$seconda_data_r') OR (date(hospitality_guest.DataChiuso) IS NOT NULL AND date(hospitality_guest.DataChiuso) >= '$prima_data_r' AND date(hospitality_guest.DataChiuso) <= '$seconda_data_r'))";
}

if ($_REQUEST['action'] == 'check_date') {
    $DataArrivo_dal = $_REQUEST['DataArrivo_dal'];

    $DataArrivo_al = $_REQUEST['DataArrivo_al'];

    $DataPartenza_dal = $_REQUEST['DataPartenza_dal'];

    $DataPartenza_al = $_REQUEST['DataPartenza_al'];

    if ($_REQUEST['DataArrivo_dal']) {
        $filter_query .= " AND hospitality_guest.DataArrivo >= '" . $DataArrivo_dal . "' ";
    }
    if ($_REQUEST['DataPartenza_dal']) {
        $filter_query .= " AND hospitality_guest.DataPartenza <= '" . $DataPartenza_dal . "'  ";
    }
    if ($_REQUEST['DataArrivo_al']) {
        $filter_query2 .= " AND hospitality_guest.DataArrivo >= '" . $DataArrivo_al . "' ";
    }
    if ($_REQUEST['DataPartenza_al']) {
        $filter_query2 .= " AND hospitality_guest.DataPartenza <= '" . $DataPartenza_al . "' ";
    }

}
if ($_REQUEST['action'] == 'request_date') {
    $DataRichiesta_dal = $_REQUEST['DataRichiesta_dal'];

    $DataRichiesta_al = $_REQUEST['DataRichiesta_al'];

    //$filter_query           = " AND date(hospitality_guest.DataChiuso) >= '".$DataRichiesta_dal." 00:00:00' AND date(hospitality_guest.DataChiuso) <= '".$DataRichiesta_al." 23:59:59'";
    $filter_query   = " AND ((hospitality_guest.DataRichiesta >= '$DataRichiesta_dal' AND hospitality_guest.DataRichiesta <= '$DataRichiesta_al') OR (date(hospitality_guest.DataChiuso) IS NOT NULL AND date(hospitality_guest.DataChiuso) >= '$DataRichiesta_dal' AND date(hospitality_guest.DataChiuso) <= '$DataRichiesta_al'))";
    $filter_query_r = " AND ((hospitality_guest.DataRichiesta >= '$DataRichiesta_dal' AND hospitality_guest.DataRichiesta <= '$DataRichiesta_al') OR (date(hospitality_guest.DataChiuso) IS NOT NULL AND date(hospitality_guest.DataChiuso) >= '$DataRichiesta_dal' AND date(hospitality_guest.DataChiuso) <= '$DataRichiesta_al'))";
    $filter_query_client_id = " AND hospitality_client_id.DataOperazione >= '" . $DataRichiesta_dal . " 00:00:00' AND hospitality_client_id.DataOperazione <= '" . $DataRichiesta_al . " 23:59:59'";
    $filter_query_custom_client_id = " AND SUBSTRING(hospitality_custom_dimension.datesession,-29,10) >= '" . $DataRichiesta_dal . "' AND SUBSTRING(hospitality_custom_dimension.datesession,-29,10) <= '" . $DataRichiesta_al . "'";
}

$diff_anni = (date('Y') - ANNO_ATTIVAZIONE);
$anniprima = (date('Y') - $diff_anni);
for ($i = $anniprima; $i <= date('Y'); $i++) {
    $lista_anni .= '<option value="' . $i . '" ' . (($_REQUEST['querydate'] == '' ? date('Y') : $_REQUEST['querydate']) == $i ? 'selected="selected"' : '') . '>' . $i . '</option>';
}


$legendaSn_BOX .= ' <div id="loading_nw"></div>
                    <div id="nw_ads"></div>' . "\r\n";

$legendaSn_BOX .= ' <script>
            $(document).ready(function() {
                $("#loading_nw").html(\'<div class="col-md-12 text-center"><img src="' . BASE_URL_SITO . 'img/Ellipsis-1s-200px.svg"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine del caricamento dati!</small></div>\');
                $.ajax({								 
                    type: "POST",								 
                    url: "' . BASE_URL_SITO . 'ajax/statistiche/newsletter_ads.php",								 
                    data: "idsito=' . IDSITO . '&filter_query_custom_client_id=' . $filter_query_custom_client_id . '&filter_query=' . $filter_query . '&action=' . $_REQUEST['action'] . '&querydate=' . $_REQUEST['querydate'] . '",
                    dataType: "html",
                        success: function(msg){
                            $("#nw_ads").html(msg);
                            $("#loading_nw").hide();
                        },
                        error: function(){
                            alert("Chiamata fallita, si prega di riprovare..."); 
                        }
                });                        
            });
        </script>' . "\r\n";

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


});
</script>' . "\r\n";

