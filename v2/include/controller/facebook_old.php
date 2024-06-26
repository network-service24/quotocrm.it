<?php
$split_graph = '';

if($_REQUEST['check_date']!='' || $_REQUEST['DataArrivo_al']!='' || $_REQUEST['DataPartenza_al']!=''){
    $split_graph = true;
}else{
    $split_graph = false;
}

if($_REQUEST['querydate']=='' && $_REQUEST['action']==''){

    $prima_data   = date('Y').'-01-01';
    $seconda_data = date('Y').'-12-31';

/*     $meno_1mese = mktime (0,0,0,(date('m')-1),date('d'),date('Y'));
    $prima_data_ = date('Y-m-d',$meno_1mese);
    $prima_data   = $prima_data_.' 00:00:00';
    $seconda_data = date('Y').'-'.date('m').'-31 23:59:59'; */
    $filter_query = " AND hospitality_guest.DataChiuso>= '".$prima_data."' AND hospitality_guest.DataChiuso <= '".$seconda_data."' ";

}elseif($_REQUEST['querydate']!='' && $_REQUEST['action']!='check_date' && $_REQUEST['action']!='request_date'){

    if($_REQUEST['querydate']=='1'){

        $prima_data   = date('Y').'-01-01';
        $seconda_data = date('Y').'-12-31';

/*         $meno_1mese = mktime (0,0,0,(date('m')-1),date('d'),date('Y'));
        $prima_data_ = date('Y-m-d',$meno_1mese);
        $prima_data   = $prima_data_.' 00:00:00';
        $seconda_data = date('Y').'-'.date('m').'-31 23:59:59'; */
    }else{
        $prima_data   = $_REQUEST['querydate'].'-01-01';
        $seconda_data = $_REQUEST['querydate'].'-12-31';
    }
    $filter_query = " AND hospitality_guest.DataChiuso >= '".$prima_data."' AND hospitality_guest.DataChiuso <= '".$seconda_data."' ";
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

    $filter_query = " AND hospitality_guest.DataChiuso >= '".$DataRichiesta_dal."' AND hospitality_guest.DataChiuso <= '".$DataRichiesta_al."'";
}

$diff_anni = (date('Y')-ANNO_ATTIVAZIONE);
$anniprima = (date('Y')-$diff_anni);
    for($i=$anniprima; $i<=date('Y'); $i++){
        $lista_anni .='<option value="'.$i.'" '.(($_REQUEST['querydate']==''?date('Y'):$_REQUEST['querydate'])==$i?'selected="selected"':'').'>'.$i.'</option>';
    }
    //$lista_anni .='<option value="1" '.(($_REQUEST['querydate']=='' || $_REQUEST['querydate']=='1')?'selected="selected"':'').'>ultimo mese</option>';

    $sql = $db->query("SELECT hospitality_fonti_provenienza.NumeroPrenotazione
                         FROM hospitality_fonti_provenienza
                         WHERE hospitality_fonti_provenienza.idsito = ".IDSITO."
                         AND (hospitality_fonti_provenienza.Provenienza LIKE '%facebook%'  OR hospitality_fonti_provenienza.Timeline LIKE '%facebook%')");
    $rws = $db->result($sql);
    $check_social  = sizeof($rws);
    if($check_social > 0){
      foreach ($rws as $key => $value) {
        $NumeriPrenoS[] = $value['NumeroPrenotazione'];
      }
 $NumeriS = implode(',',$NumeriPrenoS);

      $select = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                FROM hospitality_guest
                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                WHERE hospitality_guest.NumeroPrenotazione IN (".$NumeriS.")
                               ".$filter_query ."
                                AND hospitality_guest.idsito = ".IDSITO."
                                AND hospitality_guest.Chiuso = 1
                                AND hospitality_guest.FontePrenotazione = 'Sito Web'
                                AND hospitality_guest.Disdetta = 0
                                AND hospitality_guest.Hidden = 0
                                AND hospitality_guest.TipoRichiesta = 'Conferma' ";
        $res = $db->query($select);
        $rw = $db->row($res);
        $totaleSocial = $rw['fatturato'];

    }
if($totaleSocial>0){

       $select9 = "SELECT distinct(Provenienza) FROM hospitality_fonti_provenienza
                       WHERE hospitality_fonti_provenienza.NumeroPrenotazione IN (".$NumeriS.")
                       AND idsito = ".IDSITO."
                       AND (Provenienza LIKE '%utm_campaign%'
                       AND Provenienza LIKE '%utm_source=facebook%')
                       AND Provenienza NOT LIKE '%utm_source=newsletter%'
                    UNION
                   SELECT distinct(Timeline) FROM hospitality_fonti_provenienza
                       WHERE hospitality_fonti_provenienza.NumeroPrenotazione IN (".$NumeriS.")
                       AND idsito = ".IDSITO."
                       AND (Timeline LIKE '%utm_campaign%'
                       OR Provenienza LIKE '%utm_source=facebook%')
                       AND Timeline NOT LIKE '%utm_source=newsletter%'";
      $res9 = $db->query($select9);
      $rws9 = $db->result($res9);
      $totCamp = sizeof($rws9);
      if($totCamp>0){
          foreach ($rws9 as $key9 => $value9) {


            if(strstr($value9['Timeline'],'utm_campaign')){
              $nome_campagna_ = explode("utm_campaign=",$value9['Timeline']);
            }else{
              $nome_campagna_ = explode("utm_campaign=",$value9['Provenienza']);
            }

            if($nome_campagna_[1]){
              $nome_campagna_tmp = explode("&",$nome_campagna_[1]);
              $nome_campagna     = $nome_campagna_tmp[0];
            }

            $array_campagne[] = $nome_campagna;
          }


      foreach ($array_campagne as $key => $value) {

            $select10 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                       FROM hospitality_guest
                                       INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                       INNER JOIN hospitality_fonti_provenienza ON hospitality_fonti_provenienza.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                                       WHERE 1=1
                                       ".$filter_query ."
                                       AND (hospitality_fonti_provenienza.Provenienza LIKE '%utm_campaign%' OR hospitality_fonti_provenienza.Timeline LIKE '%utm_campaign%')
                                       AND (hospitality_fonti_provenienza.Provenienza LIKE '%".$value."%' OR hospitality_fonti_provenienza.Timeline LIKE '%".$value."%')
                                       AND hospitality_fonti_provenienza.idsito = ".IDSITO."
                                       AND hospitality_guest.FontePrenotazione = 'Sito Web'
                                       AND hospitality_guest.Chiuso = 1
                                       AND hospitality_guest.Disdetta = 0
                                       AND hospitality_guest.Hidden = 0
                                       AND hospitality_guest.TipoRichiesta = 'Conferma'";
               $res10 = $db->query($select10);
               $rws10 = $db->row($res10);
               if(is_array($rws10)) {
                   if($rws10 > count($rws10))
                       $Check_camp = count($rws10);
               }else{
                   $Check_camp = 0;
               }
               if($Check_camp > 0){
                 $fatturatoCamp = $rws10['fatturato'];
                  if($fatturatoCamp == '')$fatturatoCamp = 0;
                    $array_fatturatoS[$value]  = $fatturatoCamp;

               }

             }

    }
    if(empty($array_fatturatoS) || is_null($array_fatturatoS)){
      if($array_fatturatoS >= 0 || $totaleS == 0){
        //###MODIFICA PER SINCRONIZZARE FATTURATO
        if($totaleSocial > $totaleS){

            $colorS      = '#3B5897';
            $highlightS  = '#3B5897';

            $vl          = (($totaleSocial - $totaleS));
            $yl          = 'Altre campagne';
            $totaleS     = ($totaleS + ($totaleSocial - $totaleS));

            $legendaS   .= '<div class="row">';
            $legendaS   .= '<div class="col-md-6"><label class="badge" style="background-color:'.$colorS.'">'.$yl.'</label></div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format($vl,2,',','.').'</div>';
            $legendaS   .= '</div>';

            $etichette_S[] = "'".$yl."'";
            $tortaS[] = "{value: ".$vl.", name: '".$yl."'}";
        }
      }
    }
//#############################
    if(!empty($array_fatturatoS) || !is_null($array_fatturatoS)){

        $x = '1';

        foreach ($array_fatturatoS as $y => $val) {

            switch(($x)){
                case '1':
                  $colorS     = '#3B5897';
                  $highlightS = '#3B5897';
                break;
                default:
                    $colorS     = colorGen();
                    $highlightS = colorGen();
                break;
            }

            if($val!="" || $val != 0){

                $totaleS += $val;

                $etichette_S[] = "'".$y."'";
                $tortaS[] = "{value: ".$val.", name: '".$y."'}";

                $legendaS .= '<div class="row">';
                $legendaS .= '<div class="col-md-6"><label class="badge" style="background-color:'.$colorS.'">'.str_replace("http://","",$y).'</label></div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format($val,2,',','.').'</div>';
                $legendaS .= '</div>';
            }




        $x++;
      }
          ###MODIFICA PER SINCRONIZZARE FATTURATO
          if($totaleSocial > $totaleS){

              $vl      = (($totaleSocial - $totaleS));
              $yl       = 'Altre campagne';

              $legendaS .= '<div class="row">';
              $legendaS .= '<div class="col-md-6"><label class="badge" style="background-color:'.$colorS.'">'.$yl.'</label></div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format($vl,2,',','.').'</div>';
              $legendaS .= '</div>';

              $totaleS     = ($totaleS + ($totaleSocial - $totaleS));

              $etichette_S[] = "'".$yl."'";
              $tortaS[] = "{value: ".$vl.", name: '".$yl."'}";

          }

            $legendaS .= '<div class="row">';
            $legendaS .= '<div class="col-md-6"><b>TOTALE</b></div><div class="col-md-6"><i class="fa fa-euro"></i> '.number_format($totaleS,2,',','.').'</div>';
            $legendaS .= '</div>';
    }
  }else{
    $message = 'Nessun risultato!';
  }

    if(is_array($tortaS)){
    	$data_tortaS = implode(',',$tortaS);
    }
    if(is_array($etichette_S)){
    	$data_etichette_S = implode(',',$etichette_S);
    }


    $js_script_grafici .='
    <script>
        $(document).ready(function(){'."\r\n";


          if(($totaleSocial)>0){
            $js_script_grafici .="
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
                            data: [".$data_etichette_S."],
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
                        data:[".$data_tortaS."],
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
});
</script>'."\r\n";
