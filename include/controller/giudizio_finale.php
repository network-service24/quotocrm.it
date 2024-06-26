<?php

if($_REQUEST['azione']!='' && $_REQUEST['param']=='delete'){

        $dbMysqli->query("DELETE FROM hospitality_customer_satisfaction WHERE id_richiesta = ".$_REQUEST['azione']);
        $dbMysqli->query("UPDATE hospitality_guest SET CS_inviato = 0 WHERE Id = ".$_REQUEST['azione']);  
        $dbMysqli->query("DELETE FROM hospitality_recensioni_send WHERE id_richiesta = " . $_REQUEST['azione']);   

        header('location:'.BASE_URL_SITO.'giudizio_finale/');
}
$diff_anni = (date('Y')-ANNO_ATTIVAZIONE);
$anniprima = (date('Y')-$diff_anni);

    // if($_REQUEST['action']!='' && $_REQUEST['querydate']==''){
    //     $lista_anni .='<option value="" selected="selected">--</option>';
    // }
    $lista_anni .='<option value="4" '.(($_REQUEST['querydate']=='4' || ($_REQUEST['action']!=''  && $_REQUEST['querydate']==''))?'selected="selected"':'').'>ultimi 4 mesi</option>';
    for($i=$anniprima; $i<=date('Y'); $i++){
        $lista_anni .='<option value="'.$i.'" '.(($i==$_REQUEST['querydate'])?'selected="selected"':'').'>'.$i.'</option>';
    }


 
    if($_REQUEST['querydate']=='' && $_REQUEST['action']==''){
        $meno_4mese = mktime (0,0,0,(date('m')-4),date('d'),date('Y'));
        $prima_data_ = date('Y-m-d',$meno_4mese);
        $prima_data   = $prima_data_.'';
        $seconda_data = date('Y').'-'.date('m').'-31';
        $filter_query = " AND hospitality_customer_satisfaction.data_compilazione >= '".$prima_data."' AND hospitality_customer_satisfaction.data_compilazione <= '".$seconda_data."' ";
    
    }elseif($_REQUEST['querydate']!='' && $_REQUEST['action']!='request_date'){
    
        if($_REQUEST['querydate']=='4'){
            $meno_4mese = mktime (0,0,0,(date('m')-4),date('d'),date('Y'));
            $prima_data_ = date('Y-m-d',$meno_4mese);
            $prima_data   = $prima_data_.'';
            $seconda_data = date('Y').'-'.date('m').'-31';
        }else{
            $prima_data   = $_REQUEST['querydate'].'-01-01';
            $seconda_data = $_REQUEST['querydate'].'-12-31';
        }
    
        $filter_query = " AND hospitality_customer_satisfaction.data_compilazione >= '".$prima_data."' AND hospitality_customer_satisfaction.data_compilazione <= '".$seconda_data."' ";
    }
    if($_REQUEST['action']=='request_date'){

        $DataRichiesta_dal_tmp = explode("/",$_REQUEST['DataRichiesta_dal']);
        $DataRichiesta_dal = $DataRichiesta_dal_tmp[2].'-'.$DataRichiesta_dal_tmp[1].'-'.$DataRichiesta_dal_tmp[0]; 
        $DataRichiesta_al_tmp = explode("/",$_REQUEST['DataRichiesta_al']);
        $DataRichiesta_al = $DataRichiesta_al_tmp[2].'-'.$DataRichiesta_al_tmp[1].'-'.$DataRichiesta_al_tmp[0]; 
    
        $filter_query = " AND hospitality_customer_satisfaction.data_compilazione >= '".$DataRichiesta_dal."' AND hospitality_customer_satisfaction.data_compilazione <= '".$DataRichiesta_al."'";
    }




    $select2  = "SELECT SUM(recensione) as totale_recensione, 
                        COUNT(id) as numero_domande, id_richiesta, data_compilazione 
                    FROM hospitality_customer_satisfaction  
                    WHERE  idsito = ".IDSITO." ".$filter_query." 
                    GROUP BY id_richiesta ORDER BY data_compilazione DESC";
    $record = $dbMysqli->query($select2);
    if(sizeof($record)>0){
    $tabella .= '
                    <style>
                        .span{
                            z-index: 99999999;
                            display: block;
                            float: left;
                            margin-top: -40px;
                        }
                        .arrow_down{
                            z-index: 99999999;
                            display: block;
                            float: right;
                            margin-top: -40px;
                            margin-right: 10px;
                        }
                        .border{
                            font-size: 20px!important;
                            position: relative!important;
                            height: 44px!important;
                            padding-left: 16px!important;
                            border: 1px solid #e1e1e1!important;
                            border-radius: 5px!important;
                        }
                        .span_2{
                            margin-top: 10px !important;
                        }
                        .arrow_down_2{
                            margin-top: 10px !important;
                            margin-right: 22px !important;
                        }

                    </style>';
    $tabella .= '<style>.ordinamento{display:none}</style><table id="TabellaLayout" class="xcrud-list table table-striped table-hover table-bordered table-sm f-12">
                    <thead>
                        <tr>
                            <th class="text-center">Rif.Preno</th>
                            <th >Ospite</th>
                            <th >Lingua</th>
                            <th >Valutazione Media</th>
                            <th >Recensione</th>
                            <th >Data Compilazione</th>
                            <th >Chiama Ospite</th>
                            <th class="text-center">Invita ospite alla recensione su TripAdvisor</th>
                            <th class="text-center">Elimina</th>
                        </tr>
                    </thead>'."\r\n";
    $risposte  = '';
    foreach($record as $key => $rw){
    
        $d_tmp             = explode("-",$rw['data_compilazione']);
        $data_compilazione = $d_tmp[2].'-'.$d_tmp[1].'-'.$d_tmp[0];
        $media             = number_format(($rw['totale_recensione']/$rw['numero_domande']),2,',','.');
        $valuemax          = (5*$rw['numero_domande']);
        $qy                = "SELECT Nome,Cognome,Cellulare,NumeroPrenotazione,Lingua FROM hospitality_guest WHERE Id = ".$rw['id_richiesta'];
        $ry                = $dbMysqli->query($qy);
        $rec               = $ry[0];
        $utente            = $rec['Nome'].' '.$rec['Cognome'];
    
    
        $q          = "SELECT COUNT(id) as invii, data_invio FROM hospitality_recensioni_send WHERE id_richiesta = " . $rw['id_richiesta']." AND idsito = ".IDSITO."";
        $r          = $dbMysqli->query($q);
        $row        = $r[0];
        $invii      = $row['invii'];
        $Data_invio = date('d-m-Y',strtotime($row['data_invio']));
  
       $sel        = "SELECT hospitality_customer_satisfaction.*,hospitality_domande.Domanda
                            FROM hospitality_customer_satisfaction  
                            INNER JOIN hospitality_domande ON hospitality_domande.Id = hospitality_customer_satisfaction.id_domanda
                            WHERE  hospitality_customer_satisfaction.idsito = ".IDSITO." 
                            AND hospitality_customer_satisfaction.id_richiesta = ".$rw['id_richiesta']."";
        $re        = $dbMysqli->query($sel);
        if(sizeof($re)>0){
            $link = '<a href="javascript:;" data-toggle="modal" data-target="#risposta'.$rw['id_richiesta'].'">
                        <div data-toggle="tooltip" title="Leggi i commenti e le valutazioni">
                            <img src="'.BASE_URL_SITO.'img/emoji/bad.png" style="width:16px;height:16px">
                            <img src="'.BASE_URL_SITO.'img/emoji/medium.png" style="width:16px;height:16px">
                            <img src="'.BASE_URL_SITO.'img/emoji/good.png" style="width:16px;height:16px"> 
                        </div>                                     
                    </a>';
            $modale .= ' <div class="modal fade" id="risposta'.$rw['id_richiesta'].'"  role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel">Recensione '.$utente.' prenotazione N° '.$rec['NumeroPrenotazione'].'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                <div class="modal-body">                                                                       
                                    LEGENDA:    <img src="'.BASE_URL_SITO.'img/emoji/bad.png" style="width:14px;height:14px" data-toogle="tooltip" title="Bad [valore = 1]"> 
                                                <img src="'.BASE_URL_SITO.'img/emoji/semi_bad.png" style="width:14px;height:14px"data-toogle="tooltip" title="Semi Bad [valore = 2]">
                                                <img src="'.BASE_URL_SITO.'img/emoji/medium.png" style="width:14px;height:14px" data-toogle="tooltip" title="Medium [valore = 3]">
                                                <img src="'.BASE_URL_SITO.'img/emoji/semi_good.png" style="width:14px;height:14px" data-toogle="tooltip" title="Semi Good [valore = 4]">
                                                <img src="'.BASE_URL_SITO.'img/emoji/good.png" style="width:14px;height:14px" data-toogle="tooltip" title="Good [valore = 5]">
                                    <div class="clearfix p-b-20"></div>
                                    <table class="table table-striped table-hover table-bordered table-sm">
                                        <tr>
                                            <td class="text-center"><b>Domanda</b></td>
                                            <td class="text-center"><b>Recensione</b></td>
                                            <td class="text-center"><b>Commento</b></td>
                                        </tr>';
                                    foreach ($re as $ki => $valore) {
                                        $modale .= '<tr>';                                      
                                            $modale .= '<td>'.$valore['Domanda'].'</td>';
                                            $modale .= '<td class="text-center">'.$fun->func_stars($valore['recensione']).'</td>';
                                            $modale .= '<td>'.$valore['risposta'].'</td>';
                                        $modale .= '</tr>';
                                    }
                                   
            $modale .= '           </table>
                                </div>
                            </div>
                        </div>
                    </div>';
        }

        $tabella .= '  <tr>
                            <td class="text-center">N° '.$rec['NumeroPrenotazione'].'</td>
                            <td class="nowrap">'.stripslashes($utente).'</td>
                            <td><img src="'.BASE_URL_SITO.'img/flags/'.$rec['Lingua'].'.png" class="image_flag"></td>
                            <td class="nowrap">
                                Ricevuti &nbsp;&nbsp;<b class="text-blue">'.$rw['totale_recensione'].'</b> <small>punti</small>&nbsp;&nbsp; su un totale di &nbsp;&nbsp;
                                <b class="text-orange">'.$valuemax.'</b> <small>punti</small>&nbsp;&nbsp;  <b class="f-16">media del</b>&nbsp;&nbsp;
                                <b class="text-green f-16">'.$media.'</b>&nbsp;&nbsp;su <b class="text-blue">5</b>
                            </td>
                            <td class="text-center">'. $link .'</td>
                            <td><span class="ordinamento">'.$rw['data_compilazione'].'</span>'.$data_compilazione.'</td>
                            <td class="nowrap">
                                '.($rec['Cellulare']!=''?'<a href="tel:'.$rec['Cellulare'].'"><i class="fa fa-phone"></i></a>&nbsp;&nbsp;&nbsp;'.$rec['Cellulare'].'':'').'
                            </div>                            
                            <td class="text-center">
                                <a href="'.BASE_URL_SITO.'scrivi_a/'.$rw['id_richiesta'].'/"><i class="fa fa-envelope '.(($invii!='' && $invii!=0)?'text-red':'').'" data-toogle="tooltip" title="'.(($invii!='' && $invii!=0)?'Richiesta recensione inviata '.$invii.' '.($invii==1?'volta':'volte').' in data '. $Data_invio.'':'Invia richiesta recensione su tripadvisor').'"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="javascript:validator(\''.BASE_URL_SITO.'giudizio_finale/'.$rw['id_richiesta'].'/delete/\')"><i class="fa fa-remove text-red"></i></a>
                            </td>                            
                        </tr>'; 
    
    }
    $tabella .='<tfoot>
                    <tr>
                        <td colspan="9"></td>                          
                    </tr>
                    </tfoot>';
    $tabella .= '</table> 
                    <script>
                        $(document).ready(function () {
                            $(\'#TabellaLayout\').DataTable({
                                "paging": true,
                                "pagingType": "simple_numbers",
       
                                "language": {
                                     "search": "Filtra i risultati:",
                                     "info": "Visualizza pagina _PAGE_ di _PAGES_ per _TOTAL_ righe",
                                     "paginate": {
                                         "previous": "Precedente",
                                         "next":"Successivo",
                                     },
                                     "lengthMenu": \'Mostra <select class="form-control form-control-sm">\'+
                                         \'<option value="10">10</option>\'+
                                         \'<option value="20">20</option>\'+
                                         \'<option value="30">30</option>\'+
                                         \'<option value="40">40</option>\'+
                                         \'<option value="50">50</option>\'+
                                         \'<option value="-1">All</option>\'+
                                         \'</select> risultati\'
                                },
                            });
                            $(\'#TabellaLayout\').DataTable().order([5,\'desc\']).draw();
                            $(\'.dataTables_length\').addClass(\'bs-select\');
                        });
                    </script>
                </div>';
        $tabella .= $modale;
    }else{
        $tabella = '<div class="text-center text-gray">Nessun risultato per il periodo scelto!</div>';
    }

    # CODICE PER LE RECENSIONI RAGGRUPPATE PER OSPITE, CON LA VALUTAZIONE DELLE MEDIE, RISIEDE NEL FILE AJAX/MEDIA.PHP

    $select4 = "SELECT Id,Domanda FROM hospitality_domande WHERE idsito = ".IDSITO." AND Abilitato = 1 ORDER BY Ordine";
    $rws4 = $dbMysqli->query($select4);
    foreach ($rws4 as $key => $value) {

        $select5 = "SELECT SUM(recensione) as sum_recensione FROM hospitality_customer_satisfaction 
        WHERE idsito = ".IDSITO."
        ".$filter_query." 
        AND id_domanda = ".$value['Id'];
        $res5 = $dbMysqli->query($select5);
        $rws5 = $res5[0];
        if(is_array($rws5)) {
            if($rws5 > count($rws5)) // se la pagina richiesta non esiste
                $TotRecensioni = count($rws5); // restituire la pagina con il numero più alto che esista
        }else{ 	
            $TotRecensioni = 0;
        }

        $sum_recensione = $rws5['sum_recensione'];

        $array_recensioni[] = $sum_recensione;

        if($sum_recensione!="" || $sum_recensione!=0){

            $array_domande[]	= '"'.$value['Domanda'].'"';
        
        }

    }

foreach ($array_recensioni as $id => $value) {
    $value = is_array($value) ? '' : trim($value);
    if ($value == '') {

        $array_recensioni[$id] = '0';
        continue;
    }
}


if(is_array($array_recensioni)){
    $data_recensioni = implode(',',$array_recensioni);
}
if(is_array($array_domande)){
    $data_domande = implode(',',$array_domande);
}
if($data_domande==''){
    for($i==1; $i<=(count($array_recensioni)-1); $i++){
        $array_domande[] = '"vuoto"';
    }
  
}else{
    $data_domande = implode(',',$array_domande);
}

if(sizeof($record)>0){
  
$js_grafico .= '<script src="'.BASE_URL_SITO.'files/assets/pages/chart/echarts/js/echarts-all.js"></script>'."\r\n";
$js_grafico .="
    <script>
        $(function () {
            // ============================================================== 
            // Line chart
            // ============================================================== 
            var dom = document.getElementById(\"graph\");
            var mytempChart = echarts.init(dom);
            var app = {};
            option = null;
            option = {

                    tooltip: {
                            trigger: 'axis'
                    },
                    legend: {
                            data: ['Customer Satisfaction']
                    },
                    toolbox: {
                            show: true,
                            feature: {
                                    magicType: { show: true, type: ['line', 'bar'] },
                                    restore: { show: false },
                                    saveAsImage: { show: true }
                            }
                    },
                    color: [\"#39cccc\",\"#00acc1\"],
                    calculable: true,
                    xAxis: [{
                            type: 'category',
                            boundaryGap: false,
                            data: [".$data_domande."]
                    }],
                    yAxis: [{
                            type: 'value',
                            axisLabel: {
                                    formatter: '{value}'
                            }
                    }],

                    series: [{
                                    name: 'Punti',
                                    type: 'line',
                                    color: ['#000'],
                                    data: [".$data_recensioni."],
                                    markPoint: {
                                            data: [
                                                    { type: 'max', name: 'Max' },
                                                    { type: 'min', name: 'Min' }
                                            ]
                                    },
                                    itemStyle: {
                                            normal: {
                                                    lineStyle: {
                                                            shadowColor: 'rgba(0,0,0,0.3)',
                                                            shadowBlur: 10,
                                                            shadowOffsetX: 8,
                                                            shadowOffsetY: 8
                                                    }
                                            }
                                    },
                                    markLine: {
                                            data: [
                                                    { type: 'average', name: 'Media' }
                                            ]
                                    }
                            },

                    ]
            };

            if (option && typeof option === \"object\") {
                    mytempChart.setOption(option, true), $(function() {
                            function resize() {
                                    setTimeout(function() {
                                            mytempChart.resize()
                                    }, 100)
                            }
                            $(window).on(\"resize\", resize), $(\".sidebartoggler\").on(\"click\", resize)
                    });
            }

        });
    </script>"."\r\n";
}
$js_date .=' 
            <script>
            $(document).ready(function() { 
                $.fn.datepicker.defaults.format = \'dd/mm/yyyy\';
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
            });  
            </script>'."\r\n";
            
if(check_configurazioni(IDSITO,'check_notifiche_push')==1){
    if(n_notifiche_cs(1)>0){ 
        $notifiche_js = '<script>$( document ).ready(function() {open_notifica("Ciao " + NomeHotel + " oggi sono arrivati <b class=\"text16\">" + ContatoreCS + "</b> giudizi finali"," ","plain","bottom-right","light-blue",5000"#ff6849");});</script>'."\r\n";
    }
}