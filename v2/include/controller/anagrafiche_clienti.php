<?php
$diff_anni = (date('Y')-ANNO_ATTIVAZIONE);
$anniprima = (date('Y')-$diff_anni);
    for($i=$anniprima; $i<=date('Y'); $i++){
        $lista_anni .='<option value="'.$i.'" '.(($_REQUEST['querydate']==''?date('Y'):$_REQUEST['querydate'])==$i?'selected="selected"':'').'>'.$i.'</option>';
    }
    //$lista_anni .='<option value="1" '.(($_REQUEST['querydate']=='' || $_REQUEST['querydate']=='1')?'selected="selected"':'').'>ultimo mese</option>';

if($_REQUEST['querydate']=='' && $_REQUEST['action']==''){
    $prima_data   = date('Y').'-01-01  00:00:00';
    $seconda_data = date('Y').'-12-31  23:59:59';
/*     $meno_1mese = mktime (0,0,0,(date('m')-1),date('d'),date('Y'));
    $prima_data_ = date('Y-m-d',$meno_1mese);
    $prima_data   = $prima_data_.' 00:00:00';
    $seconda_data = date('Y').'-'.date('m').'-31 23:59:59'; */
    $filter_query = " AND DataChiuso>= '".$prima_data."' AND DataChiuso <= '".$seconda_data."' ";

}elseif($_REQUEST['querydate']!='' && $_REQUEST['action']!='request_date'){

    if($_REQUEST['querydate']=='1'){
        $prima_data   = date('Y').'-01-01  00:00:00';
        $seconda_data = date('Y').'-12-31  23:59:59';
      /*  $meno_1mese = mktime (0,0,0,(date('m')-1),date('d'),date('Y'));
        $prima_data_ = date('Y-m-d',$meno_1mese);
        $prima_data   = $prima_data_.' 00:00:00';
        $seconda_data = date('Y').'-'.date('m').'-31 23:59:59';*/
    }else{
        $prima_data   = $_REQUEST['querydate'].'-01-01  00:00:00';
        $seconda_data = $_REQUEST['querydate'].'-12-31  23:59:59';
    }

    $filter_query = " AND DataChiuso >= '".$prima_data."' AND DataChiuso <= '".$seconda_data."' ";
}
if($_REQUEST['action']=='request_date'){

    $DataRichiesta_dal_tmp = explode("/",$_REQUEST['DataRichiesta_dal']);
    $DataRichiesta_dal = $DataRichiesta_dal_tmp[2].'-'.$DataRichiesta_dal_tmp[1].'-'.$DataRichiesta_dal_tmp[0]; 
    $DataRichiesta_al_tmp = explode("/",$_REQUEST['DataRichiesta_al']);
    $DataRichiesta_al = $DataRichiesta_al_tmp[2].'-'.$DataRichiesta_al_tmp[1].'-'.$DataRichiesta_al_tmp[0]; 

    $filter_query = " AND DataChiuso >= '".$DataRichiesta_dal."' AND DataChiuso <= '".$DataRichiesta_al."'";
}
/*  */
    $select = 'SELECT Id,Nome,Cognome,Cellulare,Email,Lingua FROM hospitality_guest WHERE idsito = '.IDSITO.' '.$filter_query.' '.($_REQUEST['azione']=='op'?'AND FontePrenotazione = "Sito Web"':'').' GROUP BY Nome,Cognome,Email ORDER BY Id DESC';
    $result = $db->query($select);
    $record = $db->result($result);
    if(sizeof($record)>0){
        $tabella .= (IS_NETWORK_SERVICE_USER == 1?'<div class="text-center"><small><i class="fa fa-exclamation-triangle text-info"></i> Solo per operatore Network Service '.($_REQUEST['azione']=='op'?'questa lista è filtrata per Fonte Prenotazione <b>"Sito Web"</b>, <a href="'.BASE_URL_SITO.'grafici-anagrafiche_clienti/"><b>CLICCA QUI</b></a> per rimuovere il filtro':', <a href="'.BASE_URL_SITO.'grafici-anagrafiche_clienti/op/"><b>CLICCA QUI</b></a> per applicare il filtro per Fonte Prenotazione <b>"Sito Web"</b>').'</small></div><div class="clearfix"></div>':'').'<table id="TabellaLayout" class="xcrud-list table table-striped table-hover table-bordered table-sm">
                        <thead>
                            <tr class="xcrud-th">
                                <th class="th-sm text-center">Lingua</th>
                                <th class="th-sm">Nome</th>
                                <th class="th-sm">Cognome</th>
                                <th class="th-sm">Cellulare</th>
                                <th class="th-sm">Email</th>
                                <th class="th-sm width5">Nr.</th>
                                <th class="th-sm">Timeline</th>
                                <th class="th-sm text-center">Preventivi</th>
                                <th class="th-sm text-center nowrap">Conferme in ...</th>
                                <th class="th-sm text-center">Prenotazioni</th>
                                <th class="th-sm text-center">Fatturato</th>
                            </tr>
                        </thead>'."\r\n";
        $fatturato = '';
        foreach($record as $key => $value){

            $select2 = 'SELECT NumeroPrenotazione
                            FROM hospitality_guest
                            WHERE idsito      = ' . IDSITO . '
                            AND Nome          = "' . $value['Nome'] . '"
                            AND Cognome       = "' . $value['Cognome']  . '"
                            AND Email         = "' . $value['Email']  . '"
                            GROUP BY NumeroPrenotazione
                            ORDER BY DataRichiesta DESC,NumeroPrenotazione DESC';
            $result2      = $db->query($select2);
            $array_ = $db->result($result2);

            $ArrayNumeroPrenotazione = array();

            foreach ($array_ as $k => $v) {
                $ArrayNumeroPrenotazione[] = $v['NumeroPrenotazione'];

            }
            $n_preno = (strlen(implode(",",$ArrayNumeroPrenotazione))<=25?implode(",",$ArrayNumeroPrenotazione):substr(implode(",",$ArrayNumeroPrenotazione),0,25).'...');

            $tabella .= '    <tr>
                                <td class="text-center"><img src="https://'.$_SERVER["HTTP_HOST"].'/img/flags/mini/'.$value['Lingua'].'.png" class="flag_ico"></td>
                                <td class="nowrap"><b>'.$value['Nome'].'</b></td>
                                <td class="nowrap"><b>'.$value['Cognome'].'</b></td>
                                <td>'.$value['Cellulare'].'</td>
                                <td class="nowrap"><a target="_blank" href="mailto:'.$value['Email'].'">'.$value['Email'].'</a></td> 
                                <td>Nr.'.$n_preno.'</td> 
                                <td  class="text-center">
                                    <form name="form_timeline'.$value['Id'].'" action="'.BASE_URL_SITO.'grafici-all_timeline/" method="POST">
                                    <button type="submit" id="#timeline'.$value['Id'].'" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-fullscreen"></i></button>
                                        <input type="hidden" name="idsito" value="'.IDSITO.'">
                                        <input type="hidden" name="nome" value="'.$value['Nome'].'">
                                        <input type="hidden" name="cognome" value="'.$value['Cognome'].'">
                                        <input type="hidden" name="email" value="'.$value['Email'].'">
                                        <input type="hidden" name="lingua" value="'.$value['Lingua'].'">
                                        <input type="hidden" name="id_richiesta" value="'.$value['Id'].'">
                                    </form>
                                </td>   
                                <td class="text-center">
                                    <label class="badge bg-yellow">'.count_richieste($value['Nome'],$value['Cognome'],$value['Email'],"Preventivo").'</label> 
                                </td>
                                <td class="text-center">
                                    <label class="badge bg-teal">'.count_richieste($value['Nome'],$value['Cognome'],$value['Email'],"Conferma").'</label>
                                </td>
                                <td class="text-center">
                                    <label class="badge bg-red">'.count_richieste($value['Nome'],$value['Cognome'],$value['Email'],"Conferma",1).'</label>
                                </td>
                                <td class="text-center">
                                    '.fatturato($value['Nome'],$value['Cognome'],$value['Email']) .'
                                </td>                             
                            </tr>'."\r\n";

            $totale_cd  = fatturato($value['Nome'],$value['Cognome'],$value['Email'],1) ;
            $totale = $totale_cd+$totale;
        }
        $tabella .='<tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>  
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center"><b>Totale</b></td>
                            <td class="text-center">
                                <label class="badge bg-red"><i class="fa fa-euro"></i> '.number_format($totale,2,',','.').'</label>
                            </td>                             
                        </tr>
                    </tfoot>';
        $tabella .= '</table> 
                        <script>
                            $(document).ready(function () {
                                $(\'#TabellaLayout\').DataTable({

                                    "paging": true, // false to disable pagination (or any other option)
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
                                               }

                                });
                                $(\'#TabellaLayout\').DataTable().order([1,\'asc\']).draw();
                                $(\'.dataTables_length\').addClass(\'bs-select\');
                                
                            });
                        </script>';

    }else{
        $tabella = 'Nessun risultato!';
    }
    $js_date .=' 
                <script>
                $(document).ready(function() { 
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
                });  
                </script>'."\r\n";
#
#################################################################
