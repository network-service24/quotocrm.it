<?php

if($_REQUEST['querydate']=='' && $_REQUEST['action']==''){
    $prima_data   = date('Y').'-01-01 00:00:00';
    $seconda_data = date('Y').'-12-31 23:59:59';
    $prima_data_r   = date('Y').'-01-01';
    $seconda_data_r = date('Y').'-12-31';
/*     $meno_1mese = mktime (0,0,0,(date('m')-1),date('d'),date('Y'));
    $prima_data_ = date('Y-m-d',$meno_1mese);
    $prima_data   = $prima_data_.' 00:00:00';
    $seconda_data = date('Y').'-'.date('m').'-31 23:59:59'; */
    $filter_query = " AND hospitality_guest.DataChiuso >= '".$prima_data."' AND hospitality_guest.DataChiuso <= '".$seconda_data."' ";

    $filter_query_r = " AND hospitality_guest.DataRichiesta >= '".$prima_data_r."' AND hospitality_guest.DataRichiesta <= '".$seconda_data_r."'";

}elseif($_REQUEST['querydate']!='' && $_REQUEST['action']!='check_date' && $_REQUEST['action']!='request_date'){

    if($_REQUEST['querydate']=='1'){
        $prima_data   = date('Y').'-01-01 00:00:00';
        $seconda_data = date('Y').'-12-31 23:59:59';
        $prima_data_r   = date('Y').'-01-01';
        $seconda_data_r = date('Y').'-12-31';
/*         $meno_1mese = mktime (0,0,0,(date('m')-1),date('d'),date('Y'));
        $prima_data_ = date('Y-m-d',$meno_1mese);
        $prima_data   = $prima_data_.' 00:00:00';
        $seconda_data = date('Y').'-'.date('m').'-31 23:59:59'; */
    }else{
        $prima_data   = $_REQUEST['querydate'].'-01-01 00:00:00';
        $seconda_data = $_REQUEST['querydate'].'-12-31 23:59:59';
        $prima_data_r   = $_REQUEST['querydate'].'-01-01';
        $seconda_data_r = $_REQUEST['querydate'].'-12-31';
    }
    $filter_query = " AND hospitality_guest.DataChiuso >= '".$prima_data."' AND hospitality_guest.DataChiuso <= '".$seconda_data."' ";
    $filter_query_r = " AND hospitality_guest.DataRichiesta >= '".$prima_data_r."' AND hospitality_guest.DataRichiesta <= '".$seconda_data_r."'";
}

if($_REQUEST['action']=='check_date'){

    $DataArrivo_dal_tmp = explode("/",$_REQUEST['DataArrivo_dal']);
    $DataArrivo_dal = $DataArrivo_dal_tmp[2].'-'.$DataArrivo_dal_tmp[1].'-'.$DataArrivo_dal_tmp[0];

    $DataArrivo_al_tmp = explode("/",$_REQUEST['DataArrivo_al']);
    $DataArrivo_al = $DataArrivo_al_tmp[2].'-'.$DataArrivo_al_tmp[1].'-'.$DataArrivo_al_tmp[0];

    $DataPartenza_dal_tmp = explode("/",$_REQUEST['DataPartenza_dal']);
    $DataPartenza_dal = $DataPartenza_dal_tmp[2].'-'.$DataPartenza_dal_tmp[1].'-'.$DataPartenza_dal_tmp[0];

    $DataPartenza_al_tmp = explode("/",$_REQUEST['DataPartenza_al']);
    $DataPartenza_al = $DataPartenza_al_tmp[2].'-'.$DataPartenza_al_tmp[1].'-'.$DataPartenza_al_tmp[0];

    if($_REQUEST['DataArrivo_dal']){
        $filter_query .= " AND hospitality_guest.DataArrivo >= '".$DataArrivo_dal."' ";
    }
    if($_REQUEST['DataPartenza_dal']){
        $filter_query .= " AND hospitality_guest.DataPartenza <= '".$DataPartenza_dal."'  ";
    }
    if($_REQUEST['DataArrivo_al']){
        $filter_query2 .= " AND hospitality_guest.DataArrivo >= '".$DataArrivo_al."' ";
    }
    if($_REQUEST['DataPartenza_al']){
        $filter_query2 .= " AND hospitality_guest.DataPartenza <= '".$DataPartenza_al."' ";
    }

}
if($_REQUEST['action']=='request_date'){

    $DataRichiesta_dal_tmp = explode("/",$_REQUEST['DataRichiesta_dal']);
    $DataRichiesta_dal = $DataRichiesta_dal_tmp[2].'-'.$DataRichiesta_dal_tmp[1].'-'.$DataRichiesta_dal_tmp[0];
    $DataRichiesta_al_tmp = explode("/",$_REQUEST['DataRichiesta_al']);
    $DataRichiesta_al = $DataRichiesta_al_tmp[2].'-'.$DataRichiesta_al_tmp[1].'-'.$DataRichiesta_al_tmp[0];

    $filter_query = " AND hospitality_guest.DataChiuso >= '".$DataRichiesta_dal." 00:00:00' AND hospitality_guest.DataChiuso <= '".$DataRichiesta_al." 23:59:59'";
    $filter_query_r = " AND hospitality_guest.DataRichiesta >= '".$DataRichiesta_dal."' AND hospitality_guest.DataRichiesta <= '".$DataRichiesta_al."'";
}

$diff_anni = (date('Y')-ANNO_ATTIVAZIONE);
$anniprima = (date('Y')-$diff_anni);
    for($i=$anniprima; $i<=date('Y'); $i++){
        $lista_anni .='<option value="'.$i.'" '.(($_REQUEST['querydate']==''?date('Y'):$_REQUEST['querydate'])==$i?'selected="selected"':'').'>'.$i.'</option>';
    }


 $sqln = "SELECT hospitality_tracking_ads.NumeroPrenotazione
                FROM hospitality_tracking_ads
                WHERE hospitality_tracking_ads.idsito = ".IDSITO."
                AND hospitality_tracking_ads.Tracking = 'google'
                AND Campagna != ''";
    $risn = $db->query($sqln);
    $rwsn = $db->result($risn);
    $check_socialn  = sizeof($rwsn);
    if($check_socialn > 0){
      foreach ($rwsn as $keyn => $valuen) {
        $NumeriPrenoSn[] = $valuen['NumeroPrenotazione'];
      }
      $NumeriSn = implode(',',$NumeriPrenoSn);

      $selectn = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                    FROM hospitality_guest
                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                    WHERE hospitality_guest.NumeroPrenotazione IN (". $NumeriSn.")
                    ".$filter_query ."
                    AND hospitality_guest.idsito = ".IDSITO."
                    AND hospitality_guest.Chiuso = 1
                    AND hospitality_guest.FontePrenotazione = 'Sito Web'
                    AND hospitality_guest.Disdetta = 0
                    AND hospitality_guest.Hidden = 0
                    AND hospitality_guest.TipoRichiesta = 'Conferma' ";
        $resn = $db->query($selectn);
        $rwn = $db->row($resn);
        $totalePPCn = $rwn['fatturato'];

    }

 

    $select9n = "SELECT distinct(hospitality_tracking_ads.Campagna) as Campagna
                    FROM hospitality_tracking_ads
                    INNER JOIN hospitality_guest ON hospitality_guest.NumeroPrenotazione = hospitality_tracking_ads.NumeroPrenotazione
                    WHERE hospitality_tracking_ads.idsito = ".IDSITO."
                    AND hospitality_guest.idsito = ".IDSITO." 
                      ".$filter_query_r."
                    AND hospitality_tracking_ads.Tracking = 'google'
                    AND Campagna != ''
                    GROUP BY hospitality_tracking_ads.Campagna";
    $res9n = $db->query($select9n);
    $rws9n = $db->result($res9n);

    $totCampn = sizeof($rws9n);

    $nome_campagnan = '';

    if($totCampn>0){

        foreach ($rws9n as $key9n => $value9n) {
            $array_campagnen[] = $value9n['Campagna'];
        }

        $clean_campagna = '';
        $n_landing = '';
        $n_sito    = '';
        $legendaSn_BOX2 = '';
        foreach($array_campagnen as $k => $vl){

            $clean_campagna = str_replace('_',' ',$vl);
            $clean_campagna = str_replace('-',' ',$clean_campagna);

            $n_landing    = numero_campagne_da_landing_old(IDSITO,'google',$vl,'landing');
            $n_sito       = numero_campagne_da_sito_old(IDSITO,'google',$vl,'sito');


            $legendaSn_BOX2 .= '<tr>
                                    <td class="text-left wrap">'.$vl.'</td>
                                    <td class="text-center">'.$n_landing.'</td>   
                                    <td class="text-center">'.$n_sito.'</td>  
                                    <td class="text-center">0</td>
                                    <td class="text-right wrap"><i class="fa fa-euro"></i> 0,00</td>
                                </tr>';

            $select10n = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                        FROM hospitality_guest
                        INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                        INNER JOIN hospitality_tracking_ads ON hospitality_tracking_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                        WHERE 1=1
                        ".$filter_query ."
                        AND hospitality_tracking_ads.Campagna = '".$vl."' 
                        AND hospitality_tracking_ads.idsito = ".IDSITO."
                        AND hospitality_guest.FontePrenotazione = 'Sito Web'
                        AND hospitality_guest.idsito = ".IDSITO."
                        AND hospitality_guest.Chiuso = 1
                        AND hospitality_guest.Disdetta = 0
                        AND hospitality_guest.Hidden = 0
                        AND hospitality_guest.TipoRichiesta = 'Conferma'";
               $res10n = $db->query($select10n);
               $rws10n = $db->row($res10n);
               if(is_array($rws10n)) {
                   if($rws10n > count($rws10n))
                       $Check_campn = count($rws10n);
               }else{
                   $Check_campn = 0;
               }
               if($Check_campn > 0){
                 $fatturatoCampn = $rws10n['fatturato'];
                  if($fatturatoCampn == '')$fatturatoCampn = 0;
                    $array_fatturatoSn[$vl]  = $fatturatoCampn;

               }

            }
            $vl        = '';
            $n_landing = '';
            $n_sito    = '';
  }
        if(empty($array_fatturatoSn) || is_null($array_fatturatoSn)){
            $array_fatturatoSn['nessuna'] = 0; 
        }

        $xn = '1';
        $clean_campagnan = '';


        $legendaSn_BOX .= '<table class="table table-responsive table-bordered">
                            <tr>
                                <th class="wrap">Campagna</th>
                                <th class="wrap">Richieste da Landing</th>
                                <th class="wrap">Richieste da Sito Web</th>
                                <th class="wrap">Prenotazioni Confermate</th>
                                <th class="wrap">Fatturato</th>
                            </tr>';

        $n_landingS  = '';
        $n_sitoS     = '';
        $numero_chiuse    = '';

        foreach ($array_fatturatoSn as $yn => $valn) {

            switch(($xn)){
                case '1':
                    $colorS     = '#00acc1';
                    $highlightS = '#00acc1';
                  break;
                  case '2':
                      $colorS     = '#d81b60';
                      $highlightS = '#d81b60';
                  break;
                default:
                    $colorSn     = colorGen();
                    $highlightSn = colorGen();
                break;
            }

            if($valn!="" || $valn != 0){

                $valore_fatturato = true;

                $totaleSn += $valn;

                $clean_campagnan = str_replace('_',' ',$yn);
                $clean_campagnan = str_replace('-',' ',$clean_campagnan);


                $n_landingS    = numero_campagne_da_landing_old(IDSITO,'google',$yn,'landing');
                $n_sitoS       = numero_campagne_da_sito_old(IDSITO,'google',$yn,'sito');
                $numero_chiuse      = n_campagne_chiuse(IDSITO,'google',$yn);


                $etichette_Sn[] = "'".$clean_campagnan."'";
                $tortaSn[] = "{value: ".$valn.", name: '".$clean_campagnan."'}";



                
                $legendaSn_BOX .= '<tr>
                                        <td class="text-left wrap">'.$yn.'</td>
                                        <td class="text-center">'.$n_landingS.'</td>   
                                        <td class="text-center">'.$n_sitoS.'</td>    
                                        <td class="text-center">'.$numero_chiuse.'</td>
                                        <td class="text-right wrap"><i class="fa fa-euro"></i> '.(($valn!="" || $valn != 0)?number_format($valn,2,',','.'):'0,00').'</td>
                                    </tr>';
                
                
           
            }else{
                $valore_fatturato = false;
            }


        $xn++;
      }
      $yn = '';
      if( $valore_fatturato == false){
        $legendaSn_BOX .= $legendaSn_BOX2;
      }

    
      $legendaSn_BOX .= '<tr>
                            <td></td>
                            <td></td>   
                            <td></td>  
                            <td></td>
                            <td class="text-right wrap"><i class="fa fa-euro"></i>  '.number_format($totaleSn,2,',','.').'</b></td>
                        </tr>';      
    $legendaSn_BOX .= '</table>';


  

    if(is_array($tortaSn)){
    	$data_tortaSn = implode(',',$tortaSn);
    }
    if(is_array($etichette_Sn)){
    	$data_etichette_Sn = implode(',',$etichette_Sn);
    }




    $js_script_grafici .='
    <script>
        $(document).ready(function(){'."\r\n";
            if(($totalePPCn)>0){
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
                                data: [".$data_etichette_Sn."],
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
                            name: 'Fatturato',
                            type: 'pie',
                            radius : '55%',
                            center: ['50%', '60%'],
                            data:[".$data_tortaSn."],
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
        $( "#DataRichiesta_dal" ).datepicker({
              numberOfMonths: 1,
              language:"it",
              showButtonPanel: true
        });
        $( "#DataRichiesta_al" ).datepicker({
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

        var i = 0;
        var speed = 500;
        link = setInterval(function() {
            i++;
            $("#blink_ppc").css(\'color\', i%2 == 1 ? \'#DD4B39\' : \'#2C3B41\');
        },speed);

});
</script>'."\r\n";
