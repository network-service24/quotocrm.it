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
    // $filter_query = " AND hospitality_guest.DataChiuso>= '".$prima_data."' AND hospitality_guest.DataChiuso <= '".$seconda_data."' ";
    $filter_query   = " AND ((hospitality_guest.DataRichiesta >= '$prima_data_r' AND hospitality_guest.DataRichiesta <= '$seconda_data_r') OR (hospitality_guest.DataChiuso IS NOT NULL AND hospitality_guest.DataChiuso >= '$prima_data_r' AND hospitality_guest.DataChiuso <= '$seconda_data_r'))";
    $filter_query_r = " AND ((hospitality_guest.DataRichiesta >= '$prima_data_r' AND hospitality_guest.DataRichiesta <= '$seconda_data_r') OR (hospitality_guest.DataChiuso IS NOT NULL AND hospitality_guest.DataChiuso >= '$prima_data_r' AND hospitality_guest.DataChiuso <= '$seconda_data_r'))";

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
    // $filter_query = " AND hospitality_guest.DataChiuso >= '".$prima_data."' AND hospitality_guest.DataChiuso <= '".$seconda_data."' ";
    $filter_query   = " AND ((hospitality_guest.DataRichiesta >= '$prima_data_r' AND hospitality_guest.DataRichiesta <= '$seconda_data_r') OR (hospitality_guest.DataChiuso IS NOT NULL AND hospitality_guest.DataChiuso >= '$prima_data_r' AND hospitality_guest.DataChiuso <= '$seconda_data_r'))";
    $filter_query_r = " AND ((hospitality_guest.DataRichiesta >= '$prima_data_r' AND hospitality_guest.DataRichiesta <= '$seconda_data_r') OR (hospitality_guest.DataChiuso IS NOT NULL AND hospitality_guest.DataChiuso >= '$prima_data_r' AND hospitality_guest.DataChiuso <= '$seconda_data_r'))";
}

if ($_REQUEST['action'] == 'check_date') {
    $DataArrivo_dal_tmp = explode("/", $_REQUEST['DataArrivo_dal']);
    $DataArrivo_dal = $DataArrivo_dal_tmp[2] . '-' . $DataArrivo_dal_tmp[1] . '-' . $DataArrivo_dal_tmp[0];

    $DataArrivo_al_tmp = explode("/", $_REQUEST['DataArrivo_al']);
    $DataArrivo_al = $DataArrivo_al_tmp[2] . '-' . $DataArrivo_al_tmp[1] . '-' . $DataArrivo_al_tmp[0];

    $DataPartenza_dal_tmp = explode("/", $_REQUEST['DataPartenza_dal']);
    $DataPartenza_dal = $DataPartenza_dal_tmp[2] . '-' . $DataPartenza_dal_tmp[1] . '-' . $DataPartenza_dal_tmp[0];

    $DataPartenza_al_tmp = explode("/", $_REQUEST['DataPartenza_al']);
    $DataPartenza_al = $DataPartenza_al_tmp[2] . '-' . $DataPartenza_al_tmp[1] . '-' . $DataPartenza_al_tmp[0];

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
    $DataRichiesta_dal_tmp = explode("/", $_REQUEST['DataRichiesta_dal']);
    $DataRichiesta_dal = $DataRichiesta_dal_tmp[2] . '-' . $DataRichiesta_dal_tmp[1] . '-' . $DataRichiesta_dal_tmp[0];
    $DataRichiesta_al_tmp = explode("/", $_REQUEST['DataRichiesta_al']);
    $DataRichiesta_al = $DataRichiesta_al_tmp[2] . '-' . $DataRichiesta_al_tmp[1] . '-' . $DataRichiesta_al_tmp[0];

    //$filter_query           = " AND hospitality_guest.DataChiuso >= '".$DataRichiesta_dal." 00:00:00' AND hospitality_guest.DataChiuso <= '".$DataRichiesta_al." 23:59:59'";
    $filter_query   = " AND ((hospitality_guest.DataRichiesta >= '$DataRichiesta_dal' AND hospitality_guest.DataRichiesta <= '$DataRichiesta_al') OR (hospitality_guest.DataChiuso IS NOT NULL AND hospitality_guest.DataChiuso >= '$DataRichiesta_dal' AND hospitality_guest.DataChiuso <= '$DataRichiesta_al'))";
    $filter_query_r = " AND ((hospitality_guest.DataRichiesta >= '$DataRichiesta_dal' AND hospitality_guest.DataRichiesta <= '$DataRichiesta_al') OR (hospitality_guest.DataChiuso IS NOT NULL AND hospitality_guest.DataChiuso >= '$DataRichiesta_dal' AND hospitality_guest.DataChiuso <= '$DataRichiesta_al'))";
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
                    url: "' . BASE_URL_SITO . 'ajax/newsletter_ads.php",								 
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


$js_date .= '
<script>
$(document).ready(function() {


    $("#view_avanzati").on("click",function(){
        $("#avanzati").toggle("slow");
        $(this).find(\'span\').toggle();
    });

    $.fn.datepicker.defaults.format = "dd/mm/yyyy";
    $( "#DataRichiesta_dal" ).datepicker({
        numberOfMonths: 1,
        language:"it",
        showButtonPanel: true,
        todayHighlight: false,
        beforeShowDay: function(date) {
          var hilightedDays = [' . (date("d") - 1) . '];
          if (~hilightedDays.indexOf(date.getDate())) {
             return {classes: \'text-green\', tooltip: \'Data massima impostabile\'};
          }
       }
  });
  $( "#DataRichiesta_al" ).datepicker({
      numberOfMonths: 1,
      language:"it",
      showButtonPanel: true,
      todayHighlight: false,
      beforeShowDay: function(date) {
          var hilightedDays = [' . (date("d") - 1) . '];
          if (~hilightedDays.indexOf(date.getDate())) {
             return {classes: \'text-green\', tooltip: \'Data massima impostabile\'};
          }
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

        var i = 0;
        var speed = 500;
        link = setInterval(function() {
            i++;
            $("#blink_ppc").css(\'color\', i%2 == 1 ? \'#DD4B39\' : \'#2C3B41\');
        },speed);

});
</script>' . "\r\n";

