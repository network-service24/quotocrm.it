<?php


if($_REQUEST['action']=='request_date'){
    if($_REQUEST['DataVoucherRecSend_dal']!= '' && $_REQUEST['DataVoucherRecSend_al']!=''){

        $filter_query = " AND hospitality_guest.DataChiuso >= '".$_REQUEST['DataVoucherRecSend_dal']." 00:00:00' AND hospitality_guest.DataChiuso <= '".$_REQUEST['DataVoucherRecSend_al']." 23:59:59'";
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

    $arr_motiv = $dbMysqli->query($q);
    $motiv .= '<option value="" data-id="0">--</option>';
        foreach($arr_motiv as $ky => $val){	
            $motiv .= '<option value="'.$val['Id'].'" data-id="'.$val['Id'].'" '.($_REQUEST['motivazione']==$val['Id']?'selected':'').'>'.$val['Motivazione'].'</option>';
        }

    $qr  = "SELECT 
                hospitality_guest.DataValiditaVoucher,
                hospitality_guest.DataVoucherRecSend, 
                hospitality_guest.DataRiconferma,
                hospitality_guest.DataChiuso,
                hospitality_guest.Chiuso,
                hospitality_guest.NumeroPrenotazione,
                hospitality_guest.Nome,
                hospitality_guest.Cognome,
                hospitality_guest.Email,
                hospitality_guest.Id,
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
                hospitality_guest.Disdetta = 0
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
if($_REQUEST['DataRiconferma']!=''){   

    if($_REQUEST['DataRiconferma']=='pending'){

        $qr  .= "AND 
                    hospitality_guest.DataChiuso IS NULL";

    }else{

        $qr  .= "AND 
                    hospitality_guest.DataRiconferma ".($_REQUEST['DataRiconferma']=='sale'?'IS NOT NULL AND 
                    hospitality_guest.DataChiuso IS NOT NULL':'').
                    ($_REQUEST['DataRiconferma']=='wait'?'IS NULL':'')." ";
    }

}
    $qr  .= " ORDER BY hospitality_guest.DataChiuso DESC,hospitality_guest.NumeroPrenotazione DESC ";

    $arr_result = $dbMysqli->query($qr);

    $totale = sizeof($arr_result);
    $TotaleC            = floatval($TotaleC);
    $TotaleP            = floatval($TotaleP);
    $TotaleS            = floatval($TotaleS);

    if($totale>0){   
        $legenda .= '<div style="float:right"><a href="javascript:;" id="attiva_legenda" data-toogle="tooltip" title="" class="" data-original-title="Clicca per leggere!">Legenda <i class="fa fa-life-ring text-info" aria-hidden="true"></i></a></div>
                    <div class="clearfix p-b-10"></div>
                    <div class="alert alert-info  alert-default-profila alert-dismissable text-black" id="legenda" style="display:none">
                        <p><b>Legenda:</b> <span class="text-red">In attesa di variazione</span> (voce di menù: Buoni Voucher) <span class="text-orange">per fase di modifica</span> (voce di menù: Conferme in trattativa) <span class="text-green">Ri-Confermata</span> (voce di menù: Prenotazioni confermate)</p>
                    </div>
                    <script>
                    $(document).ready(function(){
                      $("#attiva_legenda").on("click",function(){
                        $("#legenda").slideToggle("slow");
                      })
                    })
                  </script>
                  <div class="clearfix  p-b-10"></div>'."\r\n";  
        $legenda .= '<table class="display compact dataTable table table-striped table-hover table-bordered table-sm f-12" style="width:100%">
                            <tr>
                                <th class="wrap text-center"></th>
                                <th class="wrap text-center">Nr.Preno</th>
                                <th class="wrap text-center">Data prenotazione</th>   
                                <th class="wrap text-center"></th>                            
                                <th class="wrap">Nome Cognome</th>
                                <th class="wrap">Email</th>
                                <th class="wrap text-center">Motivazione</th>
                                <th class="wrap text-center">Data invio email</th>
                                <th class="wrap text-center">Scadenza buono voucher</th>
                                <th class="wrap text-center">Caparra</th>
                                <th class="wrap text-center">Cifra a Saldo</th>
                                <th class="wrap text-center">Prezzo Soggiorno</th>
                            </tr>';


        $action = '';
        $num = 1;
        foreach($arr_result as $key => $record){



            $query = "SELECT 
                        hospitality_proposte.Id                 as IdProposta,
                        hospitality_proposte.Arrivo             as Arrivo,
                        hospitality_proposte.Partenza           as Partenza,
                        hospitality_proposte.NomeProposta       as NomeProposta,
                        hospitality_proposte.TestoProposta      as TestoProposta,
                        hospitality_proposte.CheckProposta      as CheckProposta,
                        hospitality_proposte.PrezzoL            as PrezzoL,
                        hospitality_proposte.PrezzoP            as PrezzoP,
                        hospitality_proposte.AccontoPercentuale as AccontoPercentuale,
                        hospitality_proposte.AccontoImporto     as AccontoImporto,
                        hospitality_proposte.AccontoTariffa     as AccontoTariffa,
                        hospitality_proposte.AccontoTesto       as AccontoTesto
                    FROM 
                        hospitality_proposte
                    WHERE 
                        hospitality_proposte.id_richiesta = ".$record['Id']."
                    GROUP BY 
                        hospitality_proposte.Id";

            $array_record = $dbMysqli->query($query);

            $PrezzoL            = '';
            $PrezzoP            = ''; 
            $PrezzoPC           = ''; 
            $AccontoPercentuale = ''; 
            $AccontoImporto     = ''; 
            $AccontoTariffa     = '';  
            $AccontoTesto       = '';  
            $percentuale_sconto = '';
            $saldo              = '';
            $acconto            = '';
            $saldo              = floatval($saldo);

            foreach($array_record as $key => $rec){

        
                $PrezzoL            = number_format($rec['PrezzoL'],2,',','.');
                $PrezzoP            = number_format($rec['PrezzoP'],2,',','.'); 
                $PrezzoPC           = $rec['PrezzoP']; 
                $AccontoPercentuale = $rec['AccontoPercentuale'];
                $AccontoImporto     = $rec['AccontoImporto'];
                $AccontoTariffa     = stripslashes($rec['AccontoTariffa']); 
                $AccontoTesto       = stripslashes($rec['AccontoTesto']); 


                if($PrezzoL!='0,00'){
                    $percentuale_sconto =  str_replace(",00", "",number_format((100-(100*$rec['PrezzoP'])/$rec['PrezzoL']),2,',','.'));             
                }  

                if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                    $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoRichiesta/100));
                    $acconto = number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.');
                }
                if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                    $saldo   = ($PrezzoPC-$AccontoLibero);
                    $acconto = number_format($AccontoLibero,2,',','.');
                }

                if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                    $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoPercentuale/100));
                    $acconto = number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.');
                }
                if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                    $saldo   = ($PrezzoPC-$AccontoImporto);
                    $acconto = number_format($AccontoImporto,2,',','.');
                }
                


            
            }

                if($record['DataVoucherRecSend']!='' && $record['DataVoucherRecSend']!='0000-00-00'){

                #totale caparre
                    $TotaleC  = (intval($acconto)+$TotaleC);
                    #totale prenotazione confermata
                    $TotaleP =  ($TotaleP+$PrezzoPC);
                    #totale saldo
                    $TotaleS =  ($TotaleS+$saldo);


                    if($record['DataRiconferma']!='' && $record['Chiuso'] == 0 && $record['DataChiuso'] == ''){

                        $action = '<span class="text-orange">per fase di modifica</span>';

                    }elseif($record['DataRiconferma']!='' && $record['Chiuso'] == 1 && $record['DataChiuso'] != ''){

                        $action = '<span class="text-green">Ri-Confermata</span>';
                        
                    }elseif($record['DataRiconferma']=='' && $record['Chiuso'] == 1 && $record['DataChiuso'] != ''){

                        $action = '<span class="text-red">In attesa di variazione</span>';
                    }

                    $legenda .= '<tr>
                                    <td class="text-left wrap">'.$num.'</td>  
                                    <td class="text-center wrap"><a href="'.BASE_URL_SITO.'timeline/'.$record['NumeroPrenotazione'].'" title="" data-toogle="tooltip" data-original-title="Timeline">'.$record['NumeroPrenotazione'].'</a></td>   
                                    <td class="text-center wrap">'.($record['DataChiuso']==''?'<span class="text-orange">in conferme in trattativa</span>':gira_data($record['DataChiuso'])).'</td>  
                                    <td class="text-left wrap"><i class="fa fa-long-arrow-right"></i>&nbsp;&nbsp;&nbsp; '.$action.'</td>
                                    <td class="text-left wrap">'.$record['Nome'].' '.$record['Cognome'].'</td>  
                                    <td class="text-left wrap">'.$record['Email'].'</td>  
                                    <td class="text-center wrap"><b>'.$record['Motivazione'].'</b></td>   
                                    <td class="text-center wrap">'.gira_data($record['DataVoucherRecSend']).'</td>  
                                    <td class="text-center wrap">'.($record['DataValiditaVoucher'] < date('Y-m-d')?'<span class="text-red">'.gira_data($record['DataValiditaVoucher']).'</span>': '<span class="text-green">'.gira_data($record['DataValiditaVoucher']).'</span>').'</td>            
                                    <td class="text-right wrap">'.($acconto!=''?$acconto:'00,0').'</td>
                                    <td class="text-right wrap">'.number_format(floatval($saldo),2,',','.').'</td>
                                    <td class="text-right wrap">'.$PrezzoP.'</td>
                                </tr>';
                    $num++;           
                } 
              
            }
            $legenda .= '<tr>
                            <td class="text-right wrap" ></td>
                            <td class="text-right wrap" ></td>
                            <td class="text-right wrap" ></td>
                            <td class="text-right wrap" ></td>
                            <td class="text-right wrap" ></td>
                            <td class="text-right wrap" ></td>
                            <td class="text-right wrap" ></td>
                            <td class="text-right wrap" ></td>
                            
                            <td class="text-center wrap" ><b>TOTALI</b> <i class="fa fa-euro pull-right" style="margin-top:7px"></i></td>
                            <td class="text-right wrap">'.number_format($TotaleC,2,',','.').'</td>
                            <td class="text-right wrap">'.number_format(floatval($TotaleS),2,',','.').'</td>
                            <td class="text-right wrap">'.number_format(floatval($TotaleP),2,',','.').'</td>
                        </tr>';
            $legenda .= '</table>';

    }


    $qrN  .= "SELECT 
                COUNT(hospitality_guest.Id) as NumeroDisdette,
                hospitality_guest.DataVoucherRecSend,
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
                hospitality_guest.Disdetta = 0
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
if($_REQUEST['DataRiconferma']!=''){   

    if($_REQUEST['DataRiconferma']=='pending'){

        $qrN  .= "AND 
                    hospitality_guest.DataChiuso IS NULL";

    }else{

        $qrN  .= "AND 
                    hospitality_guest.DataRiconferma ".($_REQUEST['DataRiconferma']=='sale'?'IS NOT NULL AND 
                    hospitality_guest.DataChiuso IS NOT NULL':'').
                    ($_REQUEST['DataRiconferma']=='wait'?'IS NULL':'')." ";
    }

}
    $qrN  .= " GROUP BY
                hospitality_tipo_voucher_cancellazione.Motivazione";


    $arr_resultN  = $dbMysqli->query($qrN);

    $totaleN = sizeof($arr_resultN);


    if($totaleN>0){

        $legendaN .= '<table class="display compact dataTable table table-striped table-hover table-bordered table-sm f-12">
                            <tr>
                                <th class="wrap text-center">Nr.Variazioni</th>
                                <th class="wrap text-center ">Motivazione</th>
                            </tr>';


        $array_voucher = array();

        foreach($arr_resultN as $key => $recordN){
            if($recordN['DataVoucherRecSend']!=''){
            $legendaN .= '<tr>
                            <td class="text-center wrap">'.$recordN['NumeroDisdette'].'</td>   
                            <td class="wrap text-center"><b>'.$recordN['Motivazione'].'</b></td>   

                        </tr>';
          

            $array_voucher[$recordN['Motivazione']]= $recordN['NumeroDisdette'];     
        }       
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



    $js_script_grafici ='<script src="'.BASE_URL_SITO.'files/assets/pages/chart/echarts/js/echarts-all.js" type="text/javascript"></script>'."\r\n";
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


$js_load ='
<script>
    $(document).ready(function() {
        $("#relation_requestdate").on("submit",function(){
            $("#view_loading_statistiche").html(\'<div class="row"><div class="col-md-12 text-center"><img src="'.BASE_URL_SITO.'img/Ellipsis-1s-200px.svg" alt="Filtro per query sul Fatturato QUOTO v2"></div></div><div class="row"><div class="col-md-12 text-center">Attendere il termine del filtro!</div></div>\');
        });
        $("#filter_year").on("change",function(){
            $("#view_loading_statistiche").html(\'<div class="row"><div class="col-md-12 text-center"><img src="'.BASE_URL_SITO.'img/Ellipsis-1s-200px.svg" alt="Filtro per query sul Fatturato QUOTO v2"></div></div><div class="row"><div class="col-md-12 text-center">Attendere il termine del filtro!</div></div>\');
        });
        $("#relation_checkdate").on("submit",function(){
            $("#view_loading_statistiche").html(\'<div class="row"><div class="col-md-12 text-center"><img src="'.BASE_URL_SITO.'img/Ellipsis-1s-200px.svg" alt="Filtro per query sul Fatturato QUOTO v2"></div></div><div class="row"><div class="col-md-12 text-center">Attendere il termine del filtro!</div></div>\');
        });


});
</script>'."\r\n";
