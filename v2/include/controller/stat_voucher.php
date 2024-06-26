<?php

if($_REQUEST['querydate']=='' && $_REQUEST['action']==''){
    $prima_data   = date('Y').'-01-01 00:00:00';
    $seconda_data = date('Y').'-12-31 23:59:59';
    $filter_query = " AND hospitality_guest.DataChiuso>= '".$prima_data."' AND hospitality_guest.DataChiuso <= '".$seconda_data."' ";

}elseif($_REQUEST['querydate']!='' && $_REQUEST['action']!='check_date' && $_REQUEST['action']!='request_date'){

    if($_REQUEST['querydate']=='1'){
        $prima_data   = date('Y').'-01-01 00:00:00';
        $seconda_data = date('Y').'-12-31 23:59:59';

    }else{
        $prima_data   = $_REQUEST['querydate'].'-01-01 00:00:00';
        $seconda_data = $_REQUEST['querydate'].'-12-31 23:59:59';
    }
    $filter_query = " AND hospitality_guest.DataChiuso >= '".$prima_data."' AND hospitality_guest.DataChiuso <= '".$seconda_data."' ";
}


if($_REQUEST['action']=='request_date'){
    if($_REQUEST['DataVoucherRecSend_dal']!= '' && $_REQUEST['DataVoucherRecSend_al']!=''){
        $DataVoucherRecSend_dal_tmp = explode("/",$_REQUEST['DataVoucherRecSend_dal']);
        $DataVoucherRecSend_dal = $DataVoucherRecSend_dal_tmp[2].'-'.$DataVoucherRecSend_dal_tmp[1].'-'.$DataVoucherRecSend_dal_tmp[0];
        $DataVoucherRecSend_al_tmp = explode("/",$_REQUEST['DataVoucherRecSend_al']);
        $DataVoucherRecSend_al = $DataVoucherRecSend_al_tmp[2].'-'.$DataVoucherRecSend_al_tmp[1].'-'.$DataVoucherRecSend_al_tmp[0];

        $filter_query = " AND hospitality_guest.DataChiuso >= '".$DataVoucherRecSend_dal." 00:00:00' AND hospitality_guest.DataChiuso <= '".$DataVoucherRecSend_al." 23:59:59'";
    }
}

$diff_anni = (date('Y')-ANNO_ATTIVAZIONE);
$anniprima = (date('Y')-$diff_anni);
    for($i=$anniprima; $i<=date('Y'); $i++){
        $lista_anni .='<option value="'.$i.'" '.(($_REQUEST['querydate']==''?date('Y'):$_REQUEST['querydate'])==$i?'selected="selected"':'').'>'.$i.'</option>';
    }

    $q  = " SELECT 
                hospitality_tipo_voucher_cancellazione.*
            FROM 
                hospitality_tipo_voucher_cancellazione 
            WHERE 
                hospitality_tipo_voucher_cancellazione.idsito = ".IDSITO." 
            AND 
                hospitality_tipo_voucher_cancellazione.Abilitato = 1 ";

    $ris       = $db->query($q);
    $arr_motiv = $db->result($ris);
    $motiv .= '<option value="" data-id="0">--</option>';
        foreach($arr_motiv as $ky => $val){	
            $motiv .= '<option value="'.$val['Id'].'" data-id="'.$val['Id'].'">'.$val['Motivazione'].'</option>';
        }

    $qr  = "SELECT 
                hospitality_guest.DataValiditaVoucher,
                hospitality_guest.DataVoucherRecSend, 
                hospitality_guest.DataChiuso,
                hospitality_guest.NumeroPrenotazione,
                hospitality_guest.Nome,
                hospitality_guest.Cognome,
                hospitality_tipo_voucher_cancellazione.Motivazione
            FROM 
                hospitality_guest 
            LEFT JOIN
                hospitality_tipo_voucher_cancellazione
            ON
                hospitality_tipo_voucher_cancellazione.Id = hospitality_guest.IdMotivazione
            WHERE 1 = 1

              ".$filter_query."

            AND 
                hospitality_guest.Chiuso = 1
            AND 
                hospitality_guest.FontePrenotazione = 'Sito Web'
            AND 
                hospitality_guest.Disdetta = 1
            AND 
                hospitality_guest.Hidden = 0
            AND 
                hospitality_guest.TipoRichiesta = 'Conferma' 
            AND
                hospitality_guest.idsito  = ".IDSITO." ";
if($_REQUEST['motivazione']!=''){            
    $qr  .= "AND 
                hospitality_guest.IdMotivazione = ".$_REQUEST['motivazione']." ";
}

    $res        = $db->query($qr);
    $arr_result = $db->result($res);


    $totale = sizeof($arr_result);


    if($totale>0){

        $legenda .= '<table class="table table-responsive table-bordered">
                            <tr>
                                <th class="wrap">Nr.Prenotazione</th>
                                <th class="wrap">Cliente</th>
                                <th class="wrap">Data prenotazione</th>
                                <th class="wrap">Motivazione</th>
                                <th class="wrap">Data invio email</th>
                                <th class="wrap">Data validità voucher</th>
                            </tr>';



        foreach($arr_result as $key => $record){
            $legenda .= '<tr>
                            <td class="text-center wrap">'.$record['NumeroPrenotazione'].'</td>   
                            <td class="text-left wrap">'.$record['Nome'].' '.$record['Cognome'].'</td>   
                            <td class="text-center wrap">'.gira_data($record['DataChiuso']).'</td>  
                            <td class="text-center wrap"><b>'.$record['Motivazione'].'</b></td>   
                            <td class="text-center wrap">'.gira_data($record['DataVoucherRecSend']).'</td>  
                            <td class="text-center wrap">'.gira_data($record['DataValiditaVoucher']).'</td>
                        </tr>';
        }
        $legenda .= '</table>';
    }

    $qrN  .= "SELECT 
                COUNT(hospitality_guest.Id) as NumeroDisdette,
                hospitality_tipo_voucher_cancellazione.Motivazione
            FROM 
                hospitality_guest 
            LEFT JOIN
                hospitality_tipo_voucher_cancellazione
            ON
                hospitality_tipo_voucher_cancellazione.Id = hospitality_guest.IdMotivazione
            WHERE 1 = 1

              ".$filter_query."

            AND 
                hospitality_guest.Chiuso = 1
            AND 
                hospitality_guest.FontePrenotazione = 'Sito Web'
            AND 
                hospitality_guest.Disdetta = 1
            AND 
                hospitality_guest.Hidden = 0
            AND 
                hospitality_guest.TipoRichiesta = 'Conferma' 
            AND
                hospitality_guest.idsito  = ".IDSITO." ";
if($_REQUEST['motivazione']!=''){            
    $qrN  .= "AND 
                hospitality_guest.IdMotivazione = ".$_REQUEST['motivazione']." ";
}
    $qrN  .= "GROUP BY
                hospitality_tipo_voucher_cancellazione.Motivazione ";


    $resN        = $db->query($qrN);
    $arr_resultN = $db->result($resN);


    $totaleN = sizeof($arr_resultN);


    if($totaleN>0){

        $legendaN .= '<table class="table table-responsive table-bordered">
                            <tr>
                                <th class="wrap text-center">Nr.Disdette</th>
                                <th class="wrap text-center ">Motivazione</th>
                            </tr>';


        $array_voucher = array();

        foreach($arr_resultN as $key => $recordN){
            $legendaN .= '<tr>
                            <td class="text-center wrap">'.$recordN['NumeroDisdette'].'</td>   
                            <td class="wrap text-center"><b>'.$recordN['Motivazione'].'</b></td>   

                        </tr>';

            $array_voucher[$recordN['Motivazione']]= $recordN['NumeroDisdette'];            
        }
        $legendaN .= '</table>';
    }

    if(empty($array_voucher) || is_null($array_voucher)){
        $array_voucher['nessuna'] = 0; 
    }

    foreach($array_voucher as $etichetta => $valore) {
        if($valore!="" || $valore != 0){
            $etichette[] = "'".$etichetta."'";
            $torta[] = "{value: ".$valore.", name: '".$etichetta."'}";
        }
    }

    if(is_array($torta)){
    	$data_torta = implode(',',$torta);
    }
    if(is_array($etichette)){
    	$data_etichette = implode(',',$etichette);
    }




    $js_script_grafici .='
    <script>
        $(document).ready(function(){'."\r\n";
            if(($totaleN)>0){
                $js_script_grafici .="
                var pieChartNew = echarts.init(document.getElementById('pieChartNew'));
    
                // specify chart configuration item and data
                option = {
    
                        tooltip: {
                                trigger: 'item',
                                formatter: \"{a} <br/>{b} : {c} ({d}%)\"
                        },
                        legend: {
                                x: 'center',
                                y: 'top',
                                data: [".$data_etichette."],
                        },
                        toolbox: {
                                show: true,
                                feature: {
    
                                        dataView: { show: true, readOnly: false },
                                        magicType: {
                                                show: true,
                                                type: ['pie']
                                        },
                                        restore: { show: true },
                                        saveAsImage: { show: true }
                                }
                        },
                    calculable: true,
                    series : [
                        {
                            name: 'Numero disdette',
                            type: 'pie',
                            radius : '55%',
                            center: ['50%', '60%'],
                            data:[".$data_torta."],
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
                pieChartNew.setOption(option, true), $(function() {
                        function resize() {
                                setTimeout(function() {
                                        pieChartNew.resize()
                                }, 100)
                        }
                        $(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
                });"."\r\n";
              }



    $js_script_grafici .='    });
    </script>'."\r\n";





$js_date .='
<script>
$(document).ready(function() {


    $("#view_avanzati").on("click",function(){
        $("#avanzati").toggle("slow");
        $(this).find(\'span\').toggle();
    });
    $.fn.datepicker.defaults.format = "dd/mm/yyyy";
        $( "#DataVoucherRecSend_dal" ).datepicker({
              numberOfMonths: 1,
              language:"it",
              showButtonPanel: true
        });
        $( "#DataVoucherRecSend_al" ).datepicker({
            numberOfMonths: 1,
            language:"it",
            showButtonPanel: true
      });
        $( "#DataArrivo_dal" ).datepicker({
            numberOfMonths: 2,
            language:"it",
            showButtonPanel: true
        });
      $( "#DataPartenza_dal" ).datepicker({
        numberOfMonths: 2,
        language:"it",
        showButtonPanel: true
        });
        $( "#DataArrivo_al" ).datepicker({
            numberOfMonths: 2,
            language:"it",
            showButtonPanel: true
        });
      $( "#DataPartenza_al" ).datepicker({
        numberOfMonths: 2,
        language:"it",
        showButtonPanel: true
        });
});
</script>'."\r\n";
$js_load ='
<script>
    $(document).ready(function() {
        $("#relation_requestdate").on("submit",function(){
            $("#view_loading_statistiche").html(\'<div class="row"><div class="col-md-12 text-center"><img src="'.BASE_URL_SITO.'img/Ellipsis-1s-200px.svg" alt="Filtro per query sul Fatturato QUOTO v2"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine del filtro!</small></div></div>\');
        });
        $("#filter_year").on("change",function(){
            $("#view_loading_statistiche").html(\'<div class="row"><div class="col-md-12 text-center"><img src="'.BASE_URL_SITO.'img/Ellipsis-1s-200px.svg" alt="Filtro per query sul Fatturato QUOTO v2"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine del filtro!</small></div></div>\');
        });
        $("#relation_checkdate").on("submit",function(){
            $("#view_loading_statistiche").html(\'<div class="row"><div class="col-md-12 text-center"><img src="'.BASE_URL_SITO.'img/Ellipsis-1s-200px.svg" alt="Filtro per query sul Fatturato QUOTO v2"></div></div><div class="row"><div class="col-md-12 text-center"><small>Attendere il termine del filtro!</small></div></div>\');
        });


});
</script>'."\r\n";
