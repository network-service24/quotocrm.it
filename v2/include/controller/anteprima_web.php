<?php
function get_modifica_servizi_aggiuntivi($n,$id_richiesta,$id_proposta,$Lingua){
        global $db,$Notti,$ANotti,$DataArrivo,$Arrivo,$DataPartenza,$Partenza,$PrezzoPC,$DataRichiestaCheck;
            $NewDb = $db;

            $q = "SELECT * FROM hospitality_relazione_servizi_proposte WHERE id_richiesta = ".$id_richiesta." AND id_proposta = ".$id_proposta;
            $r = $NewDb->query($q);
            $r = $NewDb->result($r);
            $IdServizio = array();
            foreach($r as $k => $v){
                $IdServizio[$v['servizio_id']]=1;
            }
                    // Query per servizi aggiuntivi
            $query  = "SELECT hospitality_tipo_servizi.* FROM hospitality_tipo_servizi
                            WHERE hospitality_tipo_servizi.idsito = ".IDSITO."
                            AND hospitality_tipo_servizi.Abilitato = 1
                            ORDER BY hospitality_tipo_servizi.TipoServizio ASC";
            $risultato_query = $NewDb->query($query);
            $record          = $NewDb->result($risultato_query);
            if(sizeof($record)>0){

                switch($Lingua){
                    case "it":
                      $ABILITA      = 'Aggiungi Servizio';
                      $OBBLIGATORIO = 'Incluso';
                      $IMPOSTO      = 'Incluso in questa proposta';
                    break;
                    case "en":
                      $ABILITA      = 'Add Service';
                      $OBBLIGATORIO = 'Included';
                      $IMPOSTO      = 'Included in this proposal ';
                    break;
                    case "fr":
                      $ABILITA      = 'Ajouter un service';
                      $OBBLIGATORIO = 'Inclus';
                      $IMPOSTO      = 'Inclus dans cette proposition ';
                    break;
                    case "de":
                      $ABILITA      = 'Service hinzufügen';
                      $OBBLIGATORIO = 'Inbegriffen ';
                      $IMPOSTO      = 'In diesem Vorschlag enthalten';
                    break;
                  }

                $lista_servizi_aggiuntivi .='<table class="table table-bordered no_border_td">
                                                <tr>
                                                    <td class="no_border_td" colspan="6" style="width:100%" ><b>'.SERVIZI_AGGIUNTIVI.'</b></td>
                                                </tr>';

                foreach($record as $chiave => $campo){

                    $q   = "SELECT hospitality_tipo_servizi_lingua.Descrizione,hospitality_tipo_servizi_lingua.Servizio FROM hospitality_tipo_servizi_lingua  WHERE hospitality_tipo_servizi_lingua.servizio_id = ".$campo['Id']." AND hospitality_tipo_servizi_lingua.idsito = ".IDSITO." AND hospitality_tipo_servizi_lingua.lingue = '".$Lingua."'";
                    $r   = $NewDb->query($q);
                    $rec = $NewDb->row($r);

                    $qrel   = "SELECT hospitality_relazione_servizi_proposte.id as id_relazionale,hospitality_relazione_servizi_proposte.num_persone,hospitality_relazione_servizi_proposte.num_notti FROM hospitality_relazione_servizi_proposte WHERE hospitality_relazione_servizi_proposte.id_richiesta = ".$id_richiesta." AND hospitality_relazione_servizi_proposte.id_proposta = ".$id_proposta." AND hospitality_relazione_servizi_proposte.servizio_id = ".$campo['Id'];
                    $rel    = $NewDb->query($qrel);
                    $recrel = $NewDb->row($rel);

                    $s  = "SELECT hospitality_relazione_visibili_servizi_proposte.visibile FROM hospitality_relazione_visibili_servizi_proposte  WHERE hospitality_relazione_visibili_servizi_proposte.id_richiesta = ".$id_richiesta." AND hospitality_relazione_visibili_servizi_proposte.id_proposta = ".$id_proposta." AND hospitality_relazione_visibili_servizi_proposte.servizio_id = ".$campo['Id']." AND hospitality_relazione_visibili_servizi_proposte.idsito = ".IDSITO."";
                    $ss = $db->query($s);
                    $rs  = $db->row($ss);

                    if($TipoRichiesta=='Preventivo'){
                      if($DataArrivo != $Arrivo || $DataPartenza != $Partenza){
                        $n_notti = $ANotti;
                      }else{
                        $n_notti = $Notti;
                      }
                    }elseif($TipoRichiesta=='Conferma'){
                      if($DataArrivo != $Arrivo ){
                          $n_notti = $ANotti;
                      }
                      if($DataPartenza != $Partenza){
                          $n_notti = $ANotti;
                      }
                    }
                    switch($Lingua){
                        case "it":
                            $A_PERCENTUALE = 'A percentuale';
                            $TEXT_EXPLANE  = '<small><small>Il calcolo "A percentuale" <a href="javascript:;"  data-toggle="tooltip" data-html="true" title="Il calcolo A percentuale viene effettuato sull\'importo originale della proposta ('.number_format($PrezzoPC,2,',','.').')<br/>Ossia sul totale soggiorno prima di qualsiasi intervento sui servizi aggiuntivi!">...<i class="fa fa-info-circle"></i></a></small></small>';
                          break;
                          case "en":
                            $A_PERCENTUALE = 'By percentage';
                            $TEXT_EXPLANE  = '<small><small>The "A percentage" <a href="javascript:;" data-toggle="tooltip" data-html="true" title="The A percentage calculation is made on the original amount of the proposal ('.number_format($PrezzoPC,2,',','.').')<br/>That is on the total stay before any intervention on additional services!">...<i class="fa fa-info-circle"></i></a></small></small>';
                          break;
                          case "fr":
                            $A_PERCENTUALE = 'Par pourcentage';
                            $TEXT_EXPLANE  = '<small><small>Le calcul du "pourcentage A" <a href="javascript:;" data-toggle="tooltip" data-html="true" title="Le calcul du pourcentage A est effectué sur le montant initial de la proposition  ('.number_format($PrezzoPC,2,',','.').')<br/>Soit sur le séjour total avant toute intervention sur des prestations complémentaires!">...<i class="fa fa-info-circle"></i></a></small></small>';
                          break;
                          case "de":
                            $A_PERCENTUALE = 'In Prozent';
                            $TEXT_EXPLANE  = '<small><small>Die Berechnung "Ein Prozentsatz" <a href="javascript:;" data-toggle="tooltip" data-html="true" title="Die Berechnung Ein Prozentsatz erfolgt anhand des ursprünglichen Betrags des Vorschlags ('.number_format($PrezzoPC,2,',','.').')<br/>Das ist der Gesamtaufenthalt vor jeder Intervention bei zusätzlichen Dienstleistungen!">...<i class="fa fa-info-circle"></i></a></small></small>';
                          break;
                    }
                    switch($campo['CalcoloPrezzo']){
                      case "Al giorno":
                          $calcoloprezzo = AL_GIORNO;
                          $obbligatory   = ($campo['Obbligatorio']==1?' <small>('.$OBBLIGATORIO.')</small>':'');
                          $num_persone   = '';
                          $CalcoloPrezzoServizio = ($campo['PrezzoServizio']!=0?'<small>('.number_format($campo['PrezzoServizio'],2,',','.').' x '.($ANotti!=''?$ANotti:$Notti).')</small>':'');
                          $PrezzoServizio = ($campo['PrezzoServizio']!=0?'<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format(($campo['PrezzoServizio']*($ANotti!=''?$ANotti:$Notti)),2,',','.'):'<small class="text-green">Gratis</small>');
                      break;
                      case "A percentuale":
                        $calcoloprezzo = $A_PERCENTUALE;
                        $obbligatory   = ($campo['Obbligatorio']==1?' <small>('.$OBBLIGATORIO.')</small>':'');
                        $num_persone   = '';
                        $CalcoloPrezzoServizio = '';
                        $PrezzoServizio = ($campo['PercentualeServizio']!=''?'<i class="fa fa-percent"></i>&nbsp;&nbsp;'.number_format(($campo['PercentualeServizio']),2):'');
                      break;
                      case "Una tantum":
                          $calcoloprezzo = UNA_TANTUM;
                          $obbligatory   = ($campo['Obbligatorio']==1?' <small>('.$OBBLIGATORIO.')</small>':'');
                          $num_persone   = '';
                          $CalcoloPrezzoServizio = '';
                          $PrezzoServizio = ($campo['PrezzoServizio']!=0?'<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format($campo['PrezzoServizio'],2,',','.'):'<small class="text-green">Gratis</small>');
                      break;
                      case "A persona":
                        $calcoloprezzo = A_PERSONA;
                        $obbligatory   = ($campo['Obbligatorio']==1?' <small>('.$OBBLIGATORIO.')</small>':'');
                        $num_persone   = $recrel['num_persone'];
                        $num_notti     = $recrel['num_notti'];
                        $CalcoloPrezzoServizio = ($campo['PrezzoServizio']!=0?'<small>('.number_format($campo['PrezzoServizio'],2,',','.').' x '.$num_notti.' <span style="font-size:80%">gg</span> x '.$num_persone.' <small>pax</small>)</small>':'('.$num_notti.'  <small>gg</small> x '.$num_persone.' <small>pax</small>)');
                        $PrezzoServizio = ($campo['PrezzoServizio']!=0?'<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format(($campo['PrezzoServizio']*$num_notti*$num_persone),2,',','.'):'<small class="text-green">Gratis</small>');
                      break;
                    }
            if($DataRichiestaCheck >= DATA_SERVIZI_VISIBILI){
                if($rs['visibile']==1){      
                      $lista_servizi_aggiuntivi .='<tr>
                                                    <td style="width:10%" class="panel-body-warning border_td_white text-center">'.($campo['Icona']!=''?'<img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$campo['Icona'].'" class="iconaDimension" style="width:auto!important;height:32px!important;position:relative!important;">':'').'</td>
                                                    <td style="width:25%"  class="panel-body-warning border_td_white">'.($rec['Descrizione']!=''?'<a href="javascript:;" data-toggle="tooltip" title="'.(strlen($rec['Descrizione'])<=300?stripslashes(strip_tags($rec['Descrizione'])):substr(stripslashes(strip_tags($rec['Descrizione'])),0,300).'...').'"><i class="fa fa-info-circle text-green" aria-hidden="true"></i></a>':'').'  <span class="nowrap">&nbsp;&nbsp;'.$rec['Servizio'].'</span> </td>';                                                               
                      $lista_servizi_aggiuntivi .=' <td style="width:20%"  class="panel-body-warning border_td_white text-center nowrap">'.$calcoloprezzo.' '.$CalcoloPrezzoServizio.'</td> ';
                     
                      $lista_servizi_aggiuntivi .=' <td style="width:25%"  class="panel-body-warning border_td_white text-center">';
                    if($campo['CalcoloPrezzo'] == 'A percentuale' && $campo['PercentualeServizio'] != ''){ 
                        $lista_servizi_aggiuntivi .='   <div id="contenitore_switchery'.$campo['Id'].'" class="nowrap">
                                                          '.($campo['Obbligatorio']==1?$obbligatory.'<div class="text_explan_percent">'.$TEXT_EXPLANE.'</div>':($IdServizio[$campo['Id']]==1?'<small>('.$IMPOSTO.')</small>'.'<div class="text_explan_percent">'.$TEXT_EXPLANE.'</div>':'<input disabled="disabled" type="checkbox" class="PrezzoServizio'.$n.'"  id="PrezzoServizio'.$n.'_'.$campo['Id'].'" name="PrezzoServizio'.$n.'['.$campo['Id'].']" value="'.$campo['PercentualeServizio'].'#'.$campo['CalcoloPrezzo'].'#'.$campo['Id'].'"  '.($IdServizio[$campo['Id']]==1?'checked="checked"':'').'>'));
                    }else{
                        $lista_servizi_aggiuntivi .='   <div id="contenitore_switchery'.$campo['Id'].'" class="nowrap">
                                                          '.($campo['Obbligatorio']==1?$obbligatory:($IdServizio[$campo['Id']]==1?'<small>('.$IMPOSTO.')</small>':'<input disabled="disabled" type="checkbox" class="PrezzoServizio'.$n.'" id="PrezzoServizio'.$n.'_'.$campo['Id'].'" name="PrezzoServizio'.$n.'['.$campo['Id'].']" value="'.$campo['PrezzoServizio'].'#'.$campo['CalcoloPrezzo'].'#'.$campo['Id'].'" '.($campo['Obbligatorio']==1?'disabled="disabled"':'').' '.($IdServizio[$campo['Id']]==1?'checked="checked"':'').'>'));
                    }  
                      $lista_servizi_aggiuntivi .=' <td style="width:10%"  class="panel-body-warning border_td_white">'.($recrel['num_notti']!= 0 || !is_null($recrel['num_notti']) || !empty($recrel['num_notti']) ? '<input type="hidden" name="notti'.$n.'_'.$campo['Id'].'" id="notti'.$n.'_'.$campo['Id'].'" data-tipo="notti'.$n.'_'.$campo['Id'].'" value="'.$recrel['num_notti'].'">':'').($recrel['num_persone']!= 0 || !is_null($recrel['num_persone']) || !empty($recrel['num_persone']) ? '<input type="hidden" name="num_persone_'.$n.'_'.$campo['Id'].'" id="num_persone'.$n.'_'.$campo['Id'].'" data-tipo="persone'.$n.'_'.$campo['Id'].'" value="'.$recrel['num_persone'].'" />':'').'<div id="valori_serv_'.$n.'_'.$campo['Id'].'" class="nowrap" style="font-size:75%"></div><div id="pulsante_calcola_'.$n.'_'.$campo['Id'].'" class="nowrap" style="font-size:75%"></div><div id="spiegazione_prezzo_servizio_'.$n.'_'.$campo['Id'].'" class="nowrap" style="font-size:75%"></div></div></td>';         
                      $lista_servizi_aggiuntivi .=' <td style="width:10%"  class="panel-body-warning border_td_white text-right nowrap"><div id="Prezzo_Servizio_'.$n.'_'.$campo['Id'].'">'.$PrezzoServizio.'</div><input type="hidden" id="RecPrezzo_Servizio_'.$n.'_'.$campo['Id'].'" name="RecPrezzo_Servizio_'.$n.'_'.$campo['Id'].'"></td>
            
                                                  </tr>';
           
                      $modali_servizi_aggiuntivi .=' <script>
                                                            $(document).ready(function(){

                                                                $("#PrezzoServizio'.$n.'_'.$campo['Id'].'").change(function(){

                                                                            if(this.checked == true){
                                                                              var check = 1;
                                                                            }else{
                                                                              var check = 0;
                                                                            }
                                                                                                                                          
                                                                            var s_tmp     = "'.$DataArrivo.'";
                                                                            var e_tmp     = "'.$DataPartenza.'";
                                                                            var start_tmp = s_tmp.split("/");
                                                                            var end_tmp   = e_tmp.split("/");
                                                                            var dal       = s_tmp;
                                                                            var al        = e_tmp;
                                                                            var start     = new Date(start_tmp[2],(start_tmp[1]-1),start_tmp[0],24,0,0).getTime()/1000;
                                                                            var end       = new Date(end_tmp[2],(end_tmp[1]-1),end_tmp[0],1,0,0).getTime()/1000;
                                                                            var notti     = Math.ceil(Math.abs(end - start) / 86400);
                                                                            var ReCalPrezzo  = $("#ReCalPrezzo'.$n.'_'.$id_proposta.'").val();
                                                                            var idsito       = '.IDSITO.';
                                                                            var n_proposta   = '.$n.';
                                                                            var id_proposta  = '.$id_proposta.';
                                                                            var id_servizio  = '.$campo['Id'].';
                                                                            var RecPrezzo_Ser= $("#RecPrezzo_Servizio_'.$n.'_'.$campo['Id'].'").val();
                                                                            var ReCalCap     = $("#ReCalCaparra'.$n.'_'.$id_proposta.'").val();
                                                                            var PercCaparra  = $("#PercentualeCaparra'.$n.'_'.$id_proposta.'").val();
                                                                           
                                                                            $.ajax({
                                                                                type: "POST",
                                                                                url: "'.BASE_URL_SITO.'ajax/calc_prezzo_serv_landing.php",
                                                                                data: "notti=" + notti + "&dal=" + dal + "&al=" + al + "&n_proposta=" + n_proposta + "&id_servizio=" + id_servizio + "&idsito=" + idsito + "&ReCalPrezzo=" + ReCalPrezzo + "&check=" + check + "&RecPrezzo_Ser=" + RecPrezzo_Ser+ "&id_proposta=" + id_proposta+ "&ReCalCaparra=" + ReCalCap+ "&PercCaparra=" + PercCaparra,
                                                                                dataType: "html",
                                                                                success: function(data){
                                                                                    $("#valori_serv_'.$n.'_'.$campo['Id'].'").html(data);
                                                                                    $("#pulsante_calcola_'.$n.'_'.$campo['Id'].'").show();
                                                                                },
                                                                                error: function(){
                                                                                    alert("Chiamata fallita, si prega di riprovare...");
                                                                                }
                                                                            });
                                                                      
                                                                     
                                                                });
                                                            });
                                                    </script>
                                                    <div class="modal fade" id="modal_persone_'.$n.'_'.$campo['Id'].'"  role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content" style="overflow:hidden;position:relative;">
                                                                  <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="overflow:hidden;position:relative;"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Inserisci i dati utili per il calcolo del prezzo servizio</h4>
                                                                  </div>
                                                                <div class="modal-body">
                                                                    <div class="row small">
                                                                        <div class="col-md-4 small nowrap">
                                                                            <div class="form-group">
                                                                                <label for="prezzo'.$n.'_'.$campo['Id'].'">Prezzo Servizio</label>
                                                                                <input type="text" id="prezzo'.$n.'_'.$campo['Id'].'" name="prezzo'.$n.'_'.$campo['Id'].'" class="form-control" value="'.$campo['PrezzoServizio'].'" readonly />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 small nowrap">
                                                                            <div class="form-group">
                                                                                    <label for="Nnotti'.$n.'_'.$campo['Id'].'">Numero Giorni</label>
                                                                                    <select id="Nnotti'.$n.'_'.$campo['Id'].'" name="Nnotti'.$n.'_'.$campo['Id'].'"  class="form-control" >
                                                                                        <option value="1">1</option>
                                                                                        <option value="2">2</option>
                                                                                        <option value="3">3</option>
                                                                                        <option value="4">4</option>
                                                                                        <option value="5">5</option>
                                                                                        <option value="6">6</option>
                                                                                        <option value="7">7</option>
                                                                                        <option value="8">8</option>
                                                                                        <option value="9">9</option>
                                                                                        <option value="10">10</option>
                                                                                        <option value="11">11</option>
                                                                                        <option value="12">12</option>
                                                                                        <option value="13">13</option>
                                                                                        <option value="14">14</option>
                                                                                        <option value="15">15</option>
                                                                                        <option value="16">16</option>
                                                                                        <option value="17">17</option>
                                                                                        <option value="18">18</option>
                                                                                        <option value="19">19</option>
                                                                                        <option value="20">20</option>
                                                                                        <option value="21">21</option>
                                                                                        <option value="22">22</option>
                                                                                        <option value="23">23</option>
                                                                                        <option value="24">24</option>
                                                                                        <option value="25">25</option>
                                                                                        <option value="26">26</option>
                                                                                        <option value="27">27</option>
                                                                                        <option value="28">28</option>
                                                                                        <option value="29">29</option>
                                                                                        <option value="30">30</option>
                                                                                    </select>
                                                                                </div>
                                                                        </div>
                                                                        <div class="col-md-4 small nowrap">
                                                                            <div class="form-group">
                                                                                    <label for="NPersone'.$n.'_'.$campo['Id'].'">Numero Persone</label>
                                                                                    <select id="NPersone'.$n.'_'.$campo['Id'].'" name="NPersone'.$n.'_'.$campo['Id'].'" class="form-control" >
                                                                                        <option value="" selected="selected">--</option>
                                                                                        <option value="1">1</option>
                                                                                        <option value="2">2</option>
                                                                                        <option value="3">3</option>
                                                                                        <option value="4">4</option>
                                                                                        <option value="5">5</option>
                                                                                        <option value="6">6</option>
                                                                                        <option value="7">7</option>
                                                                                        <option value="8">8</option>
                                                                                        <option value="9">9</option>
                                                                                        <option value="10">10</option>
                                                                                    </select>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12 text-center">
                                                                            <input type="hidden" id="check'.$n.'_'.$campo['Id'].'" name="check'.$n.'_'.$campo['Id'].'">
                                                                            <input type="hidden" id="id_servizio'.$n.'_'.$campo['Id'].'" name="id_servizio'.$n.'_'.$campo['Id'].'" value="'.$campo['Id'].'">
                                                                            <button type="button" class="btn btn-success" id="send_re_calc'.$n.'_'.$campo['Id'].'" data-dismiss="modal" aria-label="Close">Calcola prezzo servizio</button>
                                                                        </div>
                                                                    </div>
                                                                    <script>
                                                                        $(document).ready(function() {
                                                                                $("#num_persone_'.$n.'_'.$campo['Id'].'").on("show.bs.modal", function (event) {
                                                                                    var button = $(event.relatedTarget);
                                                                                    var xnotti = button.data("notti");
                                                                                    var prezzo = button.data("prezzo");
                                                                                    var id_servizio = button.data("id_servizio");
                                                                                    var modal = $(this);
                                                                                    modal.find(".modal-body select#Nnotti'.$n.'_'.$campo['Id'].'").val(xnotti);
                                                                                    modal.find(".modal-body input#prezzo'.$n.'_'.$campo['Id'].'").val(prezzo);
                                                                                    modal.find(".modal-body input#id_servizio'.$n.'_'.$campo['Id'].'").val(id_servizio);
                                                                                });
                                                                                $("#send_re_calc'.$n.'_'.$campo['Id'].'").on("click",function(){
                                                                                    var check         = 1;
                                                                                    var idsito        = '.IDSITO.';
                                                                                    var n_proposta    = '.$n.';
                                                                                    var id_servizio   = $("#id_servizio'.$n.'_'.$campo['Id'].'").val();
                                                                                    var notti         = $("#Nnotti'.$n.'_'.$campo['Id'].'").val();
                                                                                    var prezzo        = $("#prezzo'.$n.'_'.$campo['Id'].'").val();
                                                                                    var NPersone      = $("#NPersone'.$n.'_'.$campo['Id'].'").val();
                                                                                    var ReCalPrezzo   = $("#ReCalPrezzo'.$n.'_'.$id_proposta.'").val();
                                                                                    var ReCalCap      = $("#ReCalCaparra'.$n.'_'.$id_proposta.'").val();
                                                                                    var PercCaparra   = $("#PercentualeCaparra'.$n.'_'.$id_proposta.'").val();
                                                                                    var id_proposta   = '.$id_proposta.';
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "'.BASE_URL_SITO.'ajax/calc_prezzo_serv_a_persona_landing.php",
                                                                                        data: "action=re_calc&notti=" + notti + "&prezzo=" + prezzo + "&NPersone=" + NPersone + "&n_proposta=" + n_proposta + "&id_servizio=" + id_servizio + "&idsito=" + idsito + "&ReCalPrezzo=" + ReCalPrezzo + "&check=" + check+ "&id_proposta=" + id_proposta+ "&ReCalCaparra=" + ReCalCap+ "&PercCaparra=" + PercCaparra,
                                                                                        dataType: "html",
                                                                                        success: function(data){
                                                                                            $("#valori_serv_'.$n.'_'.$campo['Id'].'").html(data);
                                                                                            $("#pulsante_calcola_'.$n.'_'.$campo['Id'].'").hide();
                                                                                            $("input[data-tipo=persone'.$n.'_'.$campo['Id'].']").remove();
                                                                                            $("input[data-tipo=notti'.$n.'_'.$campo['Id'].']").remove();
                                                                                        },
                                                                                        error: function(){
                                                                                            alert("Chiamata fallita, si prega di riprovare...");
                                                                                        }
                                                                                    });

                                                                            });

                                                                        });
                                                                    </script>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                        </div>';
                        }
                    }else{
                        $lista_servizi_aggiuntivi .='<tr>
                                                <td style="width:10%" class="panel-body-warning border_td_white text-center">'.($campo['Icona']!=''?'<img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$campo['Icona'].'" class="iconaDimension" style="width:auto!important;height:32px!important;position:relative!important;">':'').'</td>
                                                <td style="width:25%"  class="panel-body-warning border_td_white">'.($rec['Descrizione']!=''?'<a href="javascript:;" data-toggle="tooltip" title="'.(strlen($rec['Descrizione'])<=300?stripslashes(strip_tags($rec['Descrizione'])):substr(stripslashes(strip_tags($rec['Descrizione'])),0,300).'...').'"><i class="fa fa-info-circle text-green" aria-hidden="true"></i></a>':'').'  <span class="nowrap">&nbsp;&nbsp;'.$rec['Servizio'].'</span> </td>';                                                               
                        $lista_servizi_aggiuntivi .=' <td style="width:20%"  class="panel-body-warning border_td_white text-center nowrap">'.$calcoloprezzo.' '.$CalcoloPrezzoServizio.'</td> ';

                        $lista_servizi_aggiuntivi .=' <td style="width:25%"  class="panel-body-warning border_td_white text-center">';
                        if($campo['CalcoloPrezzo'] == 'A percentuale' && $campo['PercentualeServizio'] != ''){ 
                        $lista_servizi_aggiuntivi .='   <div id="contenitore_switchery'.$campo['Id'].'" class="nowrap">
                                                    '.($campo['Obbligatorio']==1?$obbligatory.'<div class="text_explan_percent">'.$TEXT_EXPLANE.'</div>':($IdServizio[$campo['Id']]==1?'<small>('.$IMPOSTO.')</small>'.'<div class="text_explan_percent">'.$TEXT_EXPLANE.'</div>':'<input disabled="disabled" type="checkbox" class="PrezzoServizio'.$n.'"  id="PrezzoServizio'.$n.'_'.$campo['Id'].'" name="PrezzoServizio'.$n.'['.$campo['Id'].']" value="'.$campo['PercentualeServizio'].'#'.$campo['CalcoloPrezzo'].'#'.$campo['Id'].'"  '.($IdServizio[$campo['Id']]==1?'checked="checked"':'').'>'));
                        }else{
                        $lista_servizi_aggiuntivi .='   <div id="contenitore_switchery'.$campo['Id'].'" class="nowrap">
                                                    '.($campo['Obbligatorio']==1?$obbligatory:($IdServizio[$campo['Id']]==1?'<small>('.$IMPOSTO.')</small>':'<input disabled="disabled" type="checkbox" class="PrezzoServizio'.$n.'" id="PrezzoServizio'.$n.'_'.$campo['Id'].'" name="PrezzoServizio'.$n.'['.$campo['Id'].']" value="'.$campo['PrezzoServizio'].'#'.$campo['CalcoloPrezzo'].'#'.$campo['Id'].'" '.($campo['Obbligatorio']==1?'disabled="disabled"':'').' '.($IdServizio[$campo['Id']]==1?'checked="checked"':'').'>'));
                        }  
                        $lista_servizi_aggiuntivi .=' <td style="width:10%"  class="panel-body-warning border_td_white">'.($recrel['num_notti']!= 0 || !is_null($recrel['num_notti']) || !empty($recrel['num_notti']) ? '<input type="hidden" name="notti'.$n.'_'.$campo['Id'].'" id="notti'.$n.'_'.$campo['Id'].'" data-tipo="notti'.$n.'_'.$campo['Id'].'" value="'.$recrel['num_notti'].'">':'').($recrel['num_persone']!= 0 || !is_null($recrel['num_persone']) || !empty($recrel['num_persone']) ? '<input type="hidden" name="num_persone_'.$n.'_'.$campo['Id'].'" id="num_persone'.$n.'_'.$campo['Id'].'" data-tipo="persone'.$n.'_'.$campo['Id'].'" value="'.$recrel['num_persone'].'" />':'').'<div id="valori_serv_'.$n.'_'.$campo['Id'].'" class="nowrap" style="font-size:75%"></div><div id="pulsante_calcola_'.$n.'_'.$campo['Id'].'" class="nowrap" style="font-size:75%"></div><div id="spiegazione_prezzo_servizio_'.$n.'_'.$campo['Id'].'" class="nowrap" style="font-size:75%"></div></div></td>';         
                        $lista_servizi_aggiuntivi .=' <td style="width:10%"  class="panel-body-warning border_td_white text-right nowrap"><div id="Prezzo_Servizio_'.$n.'_'.$campo['Id'].'">'.$PrezzoServizio.'</div><input type="hidden" id="RecPrezzo_Servizio_'.$n.'_'.$campo['Id'].'" name="RecPrezzo_Servizio_'.$n.'_'.$campo['Id'].'"></td>

                                            </tr>';

                        $modali_servizi_aggiuntivi .=' <script>
                                                        $(document).ready(function(){

                                                            $("#PrezzoServizio'.$n.'_'.$campo['Id'].'").change(function(){

                                                                        if(this.checked == true){
                                                                        var check = 1;
                                                                        }else{
                                                                        var check = 0;
                                                                        }
                                                                                                                                    
                                                                        var s_tmp     = "'.$DataArrivo.'";
                                                                        var e_tmp     = "'.$DataPartenza.'";
                                                                        var start_tmp = s_tmp.split("/");
                                                                        var end_tmp   = e_tmp.split("/");
                                                                        var dal       = s_tmp;
                                                                        var al        = e_tmp;
                                                                        var start     = new Date(start_tmp[2],(start_tmp[1]-1),start_tmp[0],24,0,0).getTime()/1000;
                                                                        var end       = new Date(end_tmp[2],(end_tmp[1]-1),end_tmp[0],1,0,0).getTime()/1000;
                                                                        var notti     = Math.ceil(Math.abs(end - start) / 86400);
                                                                        var ReCalPrezzo  = $("#ReCalPrezzo'.$n.'_'.$id_proposta.'").val();
                                                                        var idsito       = '.IDSITO.';
                                                                        var n_proposta   = '.$n.';
                                                                        var id_proposta  = '.$id_proposta.';
                                                                        var id_servizio  = '.$campo['Id'].';
                                                                        var RecPrezzo_Ser= $("#RecPrezzo_Servizio_'.$n.'_'.$campo['Id'].'").val();
                                                                        var ReCalCap     = $("#ReCalCaparra'.$n.'_'.$id_proposta.'").val();
                                                                        var PercCaparra  = $("#PercentualeCaparra'.$n.'_'.$id_proposta.'").val();
                                                                    
                                                                        $.ajax({
                                                                            type: "POST",
                                                                            url: "'.BASE_URL_SITO.'ajax/calc_prezzo_serv_landing.php",
                                                                            data: "notti=" + notti + "&dal=" + dal + "&al=" + al + "&n_proposta=" + n_proposta + "&id_servizio=" + id_servizio + "&idsito=" + idsito + "&ReCalPrezzo=" + ReCalPrezzo + "&check=" + check + "&RecPrezzo_Ser=" + RecPrezzo_Ser+ "&id_proposta=" + id_proposta+ "&ReCalCaparra=" + ReCalCap+ "&PercCaparra=" + PercCaparra,
                                                                            dataType: "html",
                                                                            success: function(data){
                                                                                $("#valori_serv_'.$n.'_'.$campo['Id'].'").html(data);
                                                                                $("#pulsante_calcola_'.$n.'_'.$campo['Id'].'").show();
                                                                            },
                                                                            error: function(){
                                                                                alert("Chiamata fallita, si prega di riprovare...");
                                                                            }
                                                                        });
                                                                
                                                                
                                                            });
                                                        });
                                                </script>
                                                <div class="modal fade" id="modal_persone_'.$n.'_'.$campo['Id'].'"  role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content" style="overflow:hidden;position:relative;">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="overflow:hidden;position:relative;"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">Inserisci i dati utili per il calcolo del prezzo servizio</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row small">
                                                                    <div class="col-md-4 small nowrap">
                                                                        <div class="form-group">
                                                                            <label for="prezzo'.$n.'_'.$campo['Id'].'">Prezzo Servizio</label>
                                                                            <input type="text" id="prezzo'.$n.'_'.$campo['Id'].'" name="prezzo'.$n.'_'.$campo['Id'].'" class="form-control" value="'.$campo['PrezzoServizio'].'" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 small nowrap">
                                                                        <div class="form-group">
                                                                                <label for="Nnotti'.$n.'_'.$campo['Id'].'">Numero Giorni</label>
                                                                                <select id="Nnotti'.$n.'_'.$campo['Id'].'" name="Nnotti'.$n.'_'.$campo['Id'].'"  class="form-control" >
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="7">7</option>
                                                                                    <option value="8">8</option>
                                                                                    <option value="9">9</option>
                                                                                    <option value="10">10</option>
                                                                                    <option value="11">11</option>
                                                                                    <option value="12">12</option>
                                                                                    <option value="13">13</option>
                                                                                    <option value="14">14</option>
                                                                                    <option value="15">15</option>
                                                                                    <option value="16">16</option>
                                                                                    <option value="17">17</option>
                                                                                    <option value="18">18</option>
                                                                                    <option value="19">19</option>
                                                                                    <option value="20">20</option>
                                                                                    <option value="21">21</option>
                                                                                    <option value="22">22</option>
                                                                                    <option value="23">23</option>
                                                                                    <option value="24">24</option>
                                                                                    <option value="25">25</option>
                                                                                    <option value="26">26</option>
                                                                                    <option value="27">27</option>
                                                                                    <option value="28">28</option>
                                                                                    <option value="29">29</option>
                                                                                    <option value="30">30</option>
                                                                                </select>
                                                                            </div>
                                                                    </div>
                                                                    <div class="col-md-4 small nowrap">
                                                                        <div class="form-group">
                                                                                <label for="NPersone'.$n.'_'.$campo['Id'].'">Numero Persone</label>
                                                                                <select id="NPersone'.$n.'_'.$campo['Id'].'" name="NPersone'.$n.'_'.$campo['Id'].'" class="form-control" >
                                                                                    <option value="" selected="selected">--</option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="5">5</option>
                                                                                    <option value="6">6</option>
                                                                                    <option value="7">7</option>
                                                                                    <option value="8">8</option>
                                                                                    <option value="9">9</option>
                                                                                    <option value="10">10</option>
                                                                                </select>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12 text-center">
                                                                        <input type="hidden" id="check'.$n.'_'.$campo['Id'].'" name="check'.$n.'_'.$campo['Id'].'">
                                                                        <input type="hidden" id="id_servizio'.$n.'_'.$campo['Id'].'" name="id_servizio'.$n.'_'.$campo['Id'].'" value="'.$campo['Id'].'">
                                                                        <button type="button" class="btn btn-success" id="send_re_calc'.$n.'_'.$campo['Id'].'" data-dismiss="modal" aria-label="Close">Calcola prezzo servizio</button>
                                                                    </div>
                                                                </div>
                                                                <script>
                                                                    $(document).ready(function() {
                                                                            $("#num_persone_'.$n.'_'.$campo['Id'].'").on("show.bs.modal", function (event) {
                                                                                var button = $(event.relatedTarget);
                                                                                var xnotti = button.data("notti");
                                                                                var prezzo = button.data("prezzo");
                                                                                var id_servizio = button.data("id_servizio");
                                                                                var modal = $(this);
                                                                                modal.find(".modal-body select#Nnotti'.$n.'_'.$campo['Id'].'").val(xnotti);
                                                                                modal.find(".modal-body input#prezzo'.$n.'_'.$campo['Id'].'").val(prezzo);
                                                                                modal.find(".modal-body input#id_servizio'.$n.'_'.$campo['Id'].'").val(id_servizio);
                                                                            });
                                                                            $("#send_re_calc'.$n.'_'.$campo['Id'].'").on("click",function(){
                                                                                var check         = 1;
                                                                                var idsito        = '.IDSITO.';
                                                                                var n_proposta    = '.$n.';
                                                                                var id_servizio   = $("#id_servizio'.$n.'_'.$campo['Id'].'").val();
                                                                                var notti         = $("#Nnotti'.$n.'_'.$campo['Id'].'").val();
                                                                                var prezzo        = $("#prezzo'.$n.'_'.$campo['Id'].'").val();
                                                                                var NPersone      = $("#NPersone'.$n.'_'.$campo['Id'].'").val();
                                                                                var ReCalPrezzo   = $("#ReCalPrezzo'.$n.'_'.$id_proposta.'").val();
                                                                                var ReCalCap      = $("#ReCalCaparra'.$n.'_'.$id_proposta.'").val();
                                                                                var PercCaparra   = $("#PercentualeCaparra'.$n.'_'.$id_proposta.'").val();
                                                                                var id_proposta   = '.$id_proposta.';
                                                                                $.ajax({
                                                                                    type: "POST",
                                                                                    url: "'.BASE_URL_SITO.'ajax/calc_prezzo_serv_a_persona_landing.php",
                                                                                    data: "action=re_calc&notti=" + notti + "&prezzo=" + prezzo + "&NPersone=" + NPersone + "&n_proposta=" + n_proposta + "&id_servizio=" + id_servizio + "&idsito=" + idsito + "&ReCalPrezzo=" + ReCalPrezzo + "&check=" + check+ "&id_proposta=" + id_proposta+ "&ReCalCaparra=" + ReCalCap+ "&PercCaparra=" + PercCaparra,
                                                                                    dataType: "html",
                                                                                    success: function(data){
                                                                                        $("#valori_serv_'.$n.'_'.$campo['Id'].'").html(data);
                                                                                        $("#pulsante_calcola_'.$n.'_'.$campo['Id'].'").hide();
                                                                                        $("input[data-tipo=persone'.$n.'_'.$campo['Id'].']").remove();
                                                                                        $("input[data-tipo=notti'.$n.'_'.$campo['Id'].']").remove();
                                                                                    },
                                                                                    error: function(){
                                                                                        alert("Chiamata fallita, si prega di riprovare...");
                                                                                    }
                                                                                });

                                                                        });

                                                                    });
                                                                </script>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>';                        
                    }
                  }
                }
                $lista_servizi_aggiuntivi .='</table>'.$modali_servizi_aggiuntivi;
            

            return $lista_servizi_aggiuntivi;
}
$js_script = "<script type=\"text/javascript\">
                $(document).ready(function(){
                    // delegate calls to data-toggle=\"lightbox\"
                    $(document).delegate('*[data-gallery=\"multiimages\"]', 'click', function(event) {
                        event.preventDefault();
                        return $(this).ekkoLightbox({
                            always_show_close: true
                        });
                    });
                });
            </script>"."\r\n";
/*
# Codice per il controllo del tipo di template scelto
# in base al template si verrà rediretti all'anteprima dedicata
 */
//if($_REQUEST['temp']=='default'){
    //$chek_l_t = 'default';
//}else{
    $chek_l_t = check_landing_template(IDSITO,$_REQUEST['azione']);
    if($chek_l_t != 'smart' && $chek_l_t != 'default'){
        $chek_l_t = check_landing_type_template(IDSITO,$_REQUEST['azione']);
    }
//}
if($chek_l_t!=''){
    if($chek_l_t!='default'){
        if($_REQUEST['azione']==''){
            header('Location:'.BASE_URL_SITO.'anteprima_web_'.$chek_l_t.'/');
            exit;
        }else{
            header('Location:'.BASE_URL_SITO.'anteprima_web_'.$chek_l_t.'/'.$_REQUEST['azione']);
            exit;
        }
    }
    
}else{

    if(check_template(IDSITO)!='default'){
        if($_REQUEST['azione']==''){
            header('Location:'.BASE_URL_SITO.'anteprima_web_'.check_template(IDSITO).'/');
            exit;
        }else{
            header('Location:'.BASE_URL_SITO.'anteprima_web_'.check_template(IDSITO).'/'.$_REQUEST['azione']);
            exit;
        }
    }
}

#################################################
## codice per la modifica dei colori sul template di default
if($_REQUEST['action'] == 'modif_stile'){
    switch($_REQUEST['fogliostile']){
        case"hospitality-item.min.css":
            $BackgroundEmail = '#EBEBEB';
            $BackgroundCellData = '#dbd7d8';
        break;
        case"hospitality-item-mare.min.css":
            $BackgroundEmail = '#E4ECEF';
            $BackgroundCellData = '#FFFFFF';
        break;
        case"hospitality-item-montagna.min.css":
            $BackgroundEmail = '#E3DED9';
            $BackgroundCellData = '#ededed';
        break;
    }
    $db->query("UPDATE hospitality_stile_landing SET FoglioStile = '".$_REQUEST['fogliostile']."',BackgroundEmail = '".$BackgroundEmail."', BackgroundCellData = '".$BackgroundCellData."' WHERE Id = ".$_REQUEST['id_stile']);
}
$query_stile = "SELECT * FROM hospitality_stile_landing WHERE idsito = ".IDSITO;
$res_stile   = $db->query($query_stile);
$rec_stile   = $db->row($res_stile);
if(is_array($rec_stile)) {
    if($rec_stile > count($rec_stile)) // se la pagina richiesta non esiste
        $tot_stile = count($rec_stile); // restituire la pagina con il numero più alto che esista
}else{
    $tot_stile = 0;
}
if($tot_stile>0){
  $FoglioStile = $rec_stile['FoglioStile'];
  $IdStile     = $rec_stile['Id'];
}else{
    $FoglioStile ='hospitality-item.min.css';
}
#################################################

 $sql = 'SELECT astext(coordinate),
                    siti.abilita_mappa,
                    siti.nome,
                    siti.https,
                    siti.web,
                    siti.indirizzo,
                    siti.cap,
                    comuni.nome_comune,
                    province.nome_provincia,
                    province.sigla_provincia,
                    regioni.nome_regione,
                    utenti.logo
            FROM siti
            INNER JOIN comuni ON comuni.codice_comune = siti.codice_comune
            INNER JOIN province ON province.codice_provincia = siti.codice_provincia
            INNER JOIN regioni ON regioni.codice_regione = siti.codice_regione
            INNER JOIN utenti ON utenti.idsito = siti.idsito
            WHERE siti.idsito = '.IDSITO;
$rr = $db_suiteweb->query($sql);
$row    =  $db_suiteweb->row($rr);

$NomeCliente    = $row['nome'];
$Indirizzo      = $row['indirizzo'];
$Localita       = $row['nome_comune'];
$Cap            = $row['cap'];
$Provincia      = $row['sigla_provincia'];
$abilita_mappa  = $row['abilita_mappa'];
$coor_tmp = str_replace("POINT(","",$row['astext(coordinate)']);
$coor_tmp = str_replace(")","",$coor_tmp);
$coor_tmp = explode(" ",$coor_tmp);
$latitudine = $coor_tmp[0];
$LatCliente = $coor_tmp[0];
$LonCliente = $coor_tmp[1];
$longitudine = $coor_tmp[1];
$sito_tmp    = str_replace("http://","",$row['web']);
$sito_tmp    = str_replace("www.","",$sito_tmp);
if($row['https']==1){
    $http = 'https://';
}else{
    $http = 'http://';
}
$SitoWeb   = $http.'www.'.$sito_tmp;
$Logo        = $row['logo'];
if($abilita_mappa == 1){
    if($latitudine !='' && $longitudine != ''){
        $init_map = '<script>
                    function init_map() {
                            var isDraggable = $(document).width() > 1024 ? true : false;
                            var var_location = new google.maps.LatLng('.$latitudine.','.$longitudine.');

                                    var var_mapoptions = {
                                    center: var_location,
                                    zoom: 16
                                    };

                            var var_marker = new google.maps.Marker({
                            position: var_location,
                            map: var_map,
                            scrollwheel: false,
                            draggable: isDraggable,
                            title:"'.$NomeCliente.'"});

                            var var_map = new google.maps.Map(document.getElementById("map-container"),
                            var_mapoptions);

                            var_marker.setMap(var_map);

                    }

                    google.maps.event.addDomListener(window, \'load\', init_map);

                </script>'."\r\n";
    }
}
// query per estrarre dati social del cliente
$db->query("SELECT * FROM hospitality_social WHERE idsito = '".IDSITO."'");
$rw =  $db->row();

if($rw['Facebook']!=''){
   $Facebook   = '<a target="_blank" class="btn btn-social-icon btn-facebook btn-sm" href="'.$rw['Facebook'].'"><i class="fa fa-facebook"></i></a>';
}
if($rw['Twitter']!=''){
  $Twitter    = '<a target="_blank" class="btn btn-social-icon btn-twitter btn-sm" href="'.$rw['Twitter'].'"><i class="fa fa-twitter"></i></a>';
}
if($rw['GooglePlus']!=''){
  $GooglePlus    = '<a target="_blank" class="btn btn-social-icon btn-google-plus btn-sm" href="'.$rw['GooglePlus'].'"><i class="fa fa-google-plus"></i></a>';
}
if($rw['Instagram']!=''){
  $Instagram    = '<a target="_blank" class="btn btn-social-icon btn-instagram btn-sm" href="'.$rw['Instagram'].'"><i class="fa fa-instagram"></i></a>';
}
if($rw['Linkedin']!=''){
  $Linkedin    = '<a target="_blank" class="btn btn-social-icon btn-linkedin btn-sm" href="'.$rw['Linkedin'].'"><i class="fa fa-linkedin"></i></a>' ;
}
if($rw['Pinterest']!=''){
  $Pinterest    = '<a target="_blank" class="btn btn-social-icon btn-pinterest btn-sm" href="'.$rw['Pinterest'].'"><i class="fa fa-pinterest"></i></a>' ;
}
if($rw['Tripadvisor']!=''){
    if(strstr($rw['Tripadvisor'], 'Hotel_Review')){
        $Tripadvisor = '<a target="_blank" href="'.$rw['Tripadvisor'].'" class="btn btn-social-icon btn-tripadvisor btn-sm"><i class="fa fa-tripadvisor"></i></a>';
    }else{
        $Tripadvisor = '';
    }
}


// query per estrarre dati della richiesta prenotazione
$select .= "SELECT hospitality_guest.* FROM hospitality_guest ";

if($_REQUEST['azione']==''){
    $select .= " INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id";
}

$select .= " WHERE hospitality_guest.idsito = ".IDSITO." ";

if($_REQUEST['azione']!=''){
    $select .= " AND hospitality_guest.Id = ".$_REQUEST['azione'];
}else{
    $select .= " AND hospitality_guest.TipoRichiesta = 'Preventivo' AND hospitality_guest.Accettato = 0";
}

$select .= " ORDER BY hospitality_guest.DataRichiesta DESC,hospitality_guest.Id DESC";
$res =  $db->query($select);
$rows = $db->row($res);
if(is_array($rows)) {
    if($rows > count($rows))
        $tot = count($rows);
}else{
    $tot = 0;
}
if($tot > 0){
    $Id                 = $rows['Id'];
     if($_REQUEST['azione'] ==''){
        $TipoRichiesta = 'Preventivo';
    }else{
        $TipoRichiesta  = $rows['TipoRichiesta'];
    }
    $Chiuso             = $rows['Chiuso'];
    $Archivia           = $rows['Archivia'];
    $id_politiche       = $rows['id_politiche'];
    $AccontoRichiesta   = $rows['AccontoRichiesta'];
    $AccontoLibero      = $rows['AccontoLibero'];
    $Operatore          = $rows['ChiPrenota'];
    $Nome               = stripslashes($rows['Nome']);
    $Cognome            = stripslashes($rows['Cognome']);
    $Email              = $rows['Email'];
    $Cellulare          = $rows['Cellulare'];
    $Lingua             = $rows['Lingua'];
    if($Lingua =='')$Lingua = 'it';
    $DataR_tmp          = explode("-",$rows['DataRichiesta']);
    $DataRichiestaCheck = $rows['DataRichiesta'];
    $DataRichiesta      = $DataR_tmp[2].'/'.$DataR_tmp[1].'/'.$DataR_tmp[0];
    $DataA_tmp          = explode("-",$rows['DataArrivo']);
    $DataArrivo         = $DataA_tmp[2].'/'.$DataA_tmp[1].'/'.$DataA_tmp[0];
    $DataP_tmp          = explode("-",$rows['DataPartenza']);
    $DataPartenza       = $DataP_tmp[2].'/'.$DataP_tmp[1].'/'.$DataP_tmp[0];

    $DataValiditaVoucher_tmp  = explode("-",$rows['DataValiditaVoucher']);
    $DataValiditaVoucher      = $DataValiditaVoucher_tmp[2].'/'.$DataValiditaVoucher_tmp[1].'/'.$DataValiditaVoucher_tmp[0];
    $DataRiconferma     = $rows['DataRiconferma'];
    $_DataValiditaVoucher     = $rows['DataValiditaVoucher'];

    $NumeroPrenotazione = $rows['NumeroPrenotazione'];
    $NumeroAdulti       = $rows['NumeroAdulti'];
    $NumeroBambini      = $rows['NumeroBambini'];
    $DataS_tmp          = explode("-",$rows['DataScadenza']);
    $DataScadenza       = $DataS_tmp[2].'/'.$DataS_tmp[1].'/'.$DataS_tmp[0];
    $EtaBambini1        = $rows['EtaBambini1'];
    $EtaBambini2        = $rows['EtaBambini2'];
    $EtaBambini3        = $rows['EtaBambini3'];
    $EtaBambini4        = $rows['EtaBambini4'];
    $EtaBambini5        = $rows['EtaBambini5'];
    $EtaBambini6        = $rows['EtaBambini6'];
    $start              = mktime(24,0,0,$DataA_tmp[1],$DataA_tmp[2],$DataA_tmp[0]);
    $end                = mktime(01,0,0,$DataP_tmp[1],$DataP_tmp[2],$DataP_tmp[0]);
    $formato="%a";
    $Notti = dateDiff($rows['DataArrivo'],$rows['DataPartenza'],$formato);

    $q_img = $db->query("SELECT img,NomeOperatore FROM hospitality_operatori WHERE  idsito = ".IDSITO." AND NomeOperatore = '".addslashes($Operatore)."' AND Abilitato = 1");
    $img = $db->row($q_img);
    $ImgOp = $img['img'];
    if($img['NomeOperatore']==''){
        $disable = true;
      }else{
        $disable = false;
      }

    if($Nome == '' && $Cognome == '') {
        $Cliente = $NomeCliente;
    }else{
        $Cliente = $Nome.' '.$Cognome;
    }

    $q_t = $db->query("SELECT * FROM hospitality_contenuti_web WHERE TipoRichiesta = 'Conferma' AND idsito = ".IDSITO." AND Lingua = '".$Lingua."' AND Abilitato = 1");
    $s = $db->row($q_t);

    $q_text = $db->query("SELECT * FROM hospitality_contenuti_web WHERE TipoRichiesta = 'Preventivo' AND idsito = ".IDSITO." AND Lingua = '".$Lingua."' AND Abilitato = 1");
    $rs = $db->row($q_text);

    $q_text_alt = $db->query("SELECT * FROM hospitality_contenuti_web_lingua WHERE IdRichiesta = '".$Id."' AND Lingua = '".$Lingua."' AND idsito = ".IDSITO."");
    $rs_alt     = $db->row($q_text_lat);
    if(is_array($rs_alt)) {
        if($rs_alt > count($rs_alt)) // se la pagina richiesta non esiste
            $tot_alt = count($rs_alt); // restituire la pagina con il numero più alto che esista
    }else{
        $tot_alt = 0;
    }
    if($tot_alt>0 && $rs_alt['Testo']!=''){
        $Testo         = str_replace("[cliente]",$Cliente,$rs_alt['Testo']);
        $TestoConferma = str_replace("[cliente]",$Cliente,$rs_alt['Testo']);
    }else{
        $Testo         = str_replace("[cliente]",$Cliente,$rs['Testo']);
        $TestoConferma = str_replace("[cliente]",$Cliente,$s['Testo']);
    }

    if(strstr($rs['Moduli'], 'Eventi')){
        $ModuliEventi  = true;
    }else{
       $ModuliEventi  = false;
    }
    if(strstr($rs['Moduli'], 'Punti di Interesse')){
        $ModuliPDI  = true;
    }else{
       $ModuliPDI  = false;
    }

    include(BASE_PATH_SITO.'/lingue/lang.php');

    switch($Lingua){
        case "it":
            $sconto = 'Sconto';
            $condizioni_tariffa  = 'Condizioni tariffa';
        break;
        case "en":
            $sconto = 'Discount';
            $condizioni_tariffa  = 'Tariff conditions';
        break;
        case "fr":
            $sconto = 'Réduction';
            $condizioni_tariffa  = 'Conditions tarifaires';
        break;
        case "de":
            $sconto = 'Rabatt';
            $condizioni_tariffa  = 'Tarifbedingungen';
        break;
        default:
            $sconto = 'Discount';
            $condizioni_tariffa  = 'Condizioni tariffa';
        break;
    }

    $db->query("SELECT
            hospitality_proposte.Id as IdProposta,
            hospitality_proposte.Arrivo as Arrivo,
            hospitality_proposte.Partenza as Partenza,
            hospitality_proposte.NomeProposta as NomeProposta,
            hospitality_proposte.TestoProposta as TestoProposta,
            hospitality_proposte.CheckProposta as CheckProposta,
            hospitality_proposte.PrezzoL as PrezzoL,
            hospitality_proposte.PrezzoP as PrezzoP,
            hospitality_proposte.AccontoPercentuale as AccontoPercentuale,
            hospitality_proposte.AccontoImporto as AccontoImporto,
            hospitality_proposte.AccontoTariffa as AccontoTariffa,
            hospitality_proposte.AccontoTesto as AccontoTesto
            FROM hospitality_proposte
                WHERE hospitality_proposte.id_richiesta = ".$Id."
                GROUP BY hospitality_proposte.Id");
    $rec = $db->result();
    //print_r($rec);
     $gallery_camera      = '';
     $CheckProposta       = '';
     $TipoCamere          = '';
     $TipoSoggiorno       = '';
     $PrezzoL             = '';
     $PrezzoP             = '';
     $NomeProposta        = '';
     $TestoProposta       = '';
     $percentuale_sconto  = '';
     $AccontoPercentuale  = '';
     $AccontoImporto      = '';
     $AccontoTariffa      = '';
     $AccontoTesto        = '';
     $Arrivo              = '';
     $Partenza            = '';
     $A                   = '';
     $P                   = '';

    $proposta .='<h3 class="proposta_title">'.($TipoRichiesta=='Preventivo'?PROPOSTE_PER_NR_ADULTI:SOGGIORNO_PER_NR_ADULTI).' <b>'.$NumeroAdulti .'</b>  '.($NumeroBambini!='0'?NR_BAMBINI.'  <b>'.$NumeroBambini .'</b>  '.($EtaBambini1!='' && $EtaBambini1!='0'?' - '.$EtaBambini1.' '.ANNI. ' ':'').($EtaBambini2!='' && $EtaBambini2!='0'?$EtaBambini2.' '.ANNI.' ':'').($EtaBambini3!='' && $EtaBambini3!='0'?$EtaBambini3.' '.ANNI.' ':'').($EtaBambini4!='' && $EtaBambini4!='0'?$EtaBambini4.' '.ANNI.' ':'').($EtaBambini5!='' && $EtaBambini5!='0'?$EtaBambini5.' '.ANNI.' ':'').($EtaBambini6!='' && $EtaBambini6!='0'?$EtaBambini6.' '.ANNI.' ':'').' ':'').' - '.NOTTI.' <b>'.$Notti.'</b></h3>';
    $proposta .='<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
    $n = 1;

    foreach ($rec as $key => $value) {

        $CheckProposta      = $value['CheckProposta'];
        $PrezzoL            = number_format($value['PrezzoL'],2,',','.');
        $PrezzoP            = number_format($value['PrezzoP'],2,',','.');
        $PrezzoPC           = $value['PrezzoP'];
        $IdProposta         = $value['IdProposta'];
        $NomeProposta       = stripslashes($value['NomeProposta']);
        $TestoProposta      = stripslashes($value['TestoProposta']);
        $AccontoPercentuale = $value['AccontoPercentuale'];
        $AccontoImporto     = $value['AccontoImporto'];
        $AccontoTariffa     = stripslashes($value['AccontoTariffa']);
        $AccontoTesto       = stripslashes($value['AccontoTesto']);
        $A_tmp              = explode("-",$value['Arrivo']);
        $A                  = $value['Arrivo'];
        $Arrivo             = $A_tmp[2].'/'.$A_tmp[1].'/'.$A_tmp[0];
        $P_tmp              = explode("-",$value['Partenza']);
        $P                  = $value['Partenza'];
        $Partenza           = $P_tmp[2].'/'.$P_tmp[1].'/'.$P_tmp[0];
        $Astart             = mktime(24,0,0,$A_tmp[1],$A_tmp[2],$A_tmp[0]);
        $Aend               = mktime(01,0,0,$P_tmp[1],$P_tmp[2],$P_tmp[0]);
        $formato="%a";
        $ANotti = dateDiff($value['Arrivo'],$value['Partenza'],$formato);

        $select_sconti = "  SELECT 
                                hospitality_relazione_sconto_proposte.* 
                            FROM 
                                hospitality_relazione_sconto_proposte
                            WHERE 
                                hospitality_relazione_sconto_proposte.idsito = ".IDSITO."
                            AND 
                                hospitality_relazione_sconto_proposte.id_richiesta = ".$Id."
                            AND 
                                hospitality_relazione_sconto_proposte.id_proposta = ".$IdProposta."";
        $result_sconti = $db->query($select_sconti);
        $rec_sconti    = $db->row($result_sconti);
        $imp_sconto    = $rec_sconti['sconto'];

        if($imp_sconto != 0 && $imp_sconto != ''){
          $percentuale_sconto =  $imp_sconto;
        } else{
          if(($PrezzoL!='0,00')){
            $percentuale_sconto_calcolo = (100-(100*$value['PrezzoP'])/$value['PrezzoL']);
            $percentuale_sconto =  str_replace(",00", "",number_format((100-(100*$value['PrezzoP'])/$value['PrezzoL']),2,',','.'));
            $ImportoSconto = number_format(($value['PrezzoL']-$value['PrezzoP']),2,',','.');
          }
     
        }
        if($imp_sconto != 0 && $imp_sconto != ''){
            /*calcolo l'importo dello sconto*/
            $selSconto     = "SELECT SUM(hospitality_richiesta.Prezzo) as prezzo_camere FROM hospitality_richiesta WHERE hospitality_richiesta.id_richiesta = ".$Id." AND hospitality_richiesta.id_proposta = ".$IdProposta."";
            $resSconto     = $db->query($selSconto);
            $recSconto     = $db->row($resSconto);
            $ImpSconto    = (($recSconto['prezzo_camere']*$percentuale_sconto)/100);
            $ImportoSconto = number_format($ImpSconto,2,',','.');
        } 
        switch($Lingua){
            case"it":
              $etichetta_sconto = '<small class="t12 nowrap">Sconto escluso dal calcolo e scelta dei servizi aggiuntivi</small>';
            break;
            case"en":
              $etichetta_sconto = '<small>The discount is excluded on the calculation and choice of additional services</small>';
            break;
            case"fr":
              $etichetta_sconto = '<small>La remise est exclue sur le calcul et le choix des services supplémentaires</small>';
            break;
            case"de":
              $etichetta_sconto = '<small>Der Rabatt ist bei der Berechnung und Auswahl der Zusatzleistungen ausgeschlossen</small>';
            break;
          }

        if($n == 1){
            $style = 'style="height: auto;"';
            $class = 'class="panel-collapse in"';
        }else{
            $style = 'style="height: 0;"';
            $class = 'class="panel-collapse collapse"';
        }



    $proposta .= '<div class="panel panel-success" id="Proposte">
                      <div class="panel-heading" role="tab" id="headingOne">
                        <h3 class="panel-title" style="width:100%!important">
                          <a class="maiuscolo"  aria-expanded="true" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$n.'">
                            '.$n.'° '.($TipoRichiesta == 'Preventivo'?PROPOSTA:SOLUZIONECONFERMATA).'  <div class="box-tools pull-right"><i class="fa fa-caret-down text-white"></i>
                          </a>

                        </h3>
                      </div>
                      <div '.$style.' id="collapse'.$n.'" '.$class.'>
                        <div class="panel-body">';
              if($NomeProposta!='' || $TestoProposta!=''){
                   $proposta .='<div class="row">
                                    <div class="col-md-12 text16">
                                        <b>'.$NomeProposta.'</b>
                                        <p>'.nl2br($TestoProposta).'</p>
                                    </div>
                                </div>';
              }
               $select2 = "SELECT hospitality_richiesta.NumeroCamere,
                            hospitality_richiesta.Prezzo,
                            hospitality_richiesta.NumAdulti,
                            hospitality_richiesta.NumBambini,
                            hospitality_richiesta.EtaB,
                            hospitality_richiesta.Id as id_etaB,
                            hospitality_tipo_camere.Id as IdCamera,
                            hospitality_tipo_camere.TipoCamere as TipoCamere,
                            hospitality_tipo_camere.Servizi as Servizi,
                            hospitality_camere_testo.Camera as TitoloCamera,
                            hospitality_camere_testo.Descrizione as TestoCamera,
                            hospitality_tipo_soggiorno.TipoSoggiorno as TipoSoggiorno,
                            hospitality_tipo_soggiorno_lingua.Soggiorno as TitoloSoggiorno,
                            hospitality_tipo_soggiorno_lingua.Descrizione as TestoSoggiorno
                            FROM hospitality_richiesta
                            INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                            INNER JOIN hospitality_camere_testo ON hospitality_camere_testo.camere_id = hospitality_tipo_camere.Id
                            INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                            INNER JOIN hospitality_tipo_soggiorno_lingua ON hospitality_tipo_soggiorno_lingua.soggiorni_id = hospitality_tipo_soggiorno.Id
                            WHERE hospitality_tipo_camere.idsito = ".IDSITO."
                            AND hospitality_camere_testo.idsito = ".IDSITO."
                            AND hospitality_tipo_soggiorno.idsito = ".IDSITO."
                            AND hospitality_tipo_soggiorno_lingua.idsito = ".IDSITO."
                            AND hospitality_richiesta.id_proposta = ".$IdProposta." AND hospitality_camere_testo.lingue = '".$Lingua."' AND hospitality_tipo_camere.Abilitato = 1
                            AND hospitality_tipo_soggiorno_lingua.lingue = '".$Lingua."'
                            AND hospitality_tipo_soggiorno.Abilitato = 1 ORDER BY hospitality_richiesta.Id ASC " ;
                $result2 = $db->query($select2);
                $res2    = $db->result($result2);

                $x       = 1;
                $Servizi = '';
                $serv    = '';
                $servizi = '';
                $services = '';
                $EtaB_ = '';
                foreach ($res2 as $ky => $val) {
                    $Servizi         = $val['Servizi'];
                    $NumeroCamere    = $val['NumeroCamere'];

                    /* 
                    $NumAdulti       = $val['NumAdulti'];
                    $NumBambini      = $val['NumBambini']; 
                    $EtaB_           .= $val['EtaB'].',';
                    $EtaB            = substr($EtaB_,0,-1);
                    $EtaB            = (($EtaB!=' ,' && $EtaB!=',' && $EtaB!='' && $EtaB!=0 && !empty($EtaB))?$EtaB:''); 
                    
                    */

                    $sel_bamb = "SELECT hospitality_richiesta.NumAdulti,hospitality_richiesta.NumBambini,hospitality_richiesta.EtaB FROM hospitality_richiesta WHERE  hospitality_richiesta.Id = ".$val['id_etaB']."";
                    $res_bamb = $db->query($sel_bamb);
                    $rec_B    = $db->row($res_bamb);

                    $EtaB           = $rec_B['EtaB'];
                    $NumAdulti      = $rec_B['NumAdulti'];
                    $NumBambini     = $rec_B['NumBambini'];

                    switch($NumAdulti){
                        case 1:
                            $ico_adulti = '<i class="fa fa-male"></i>';
                        break;
                        case 2:
                            $ico_adulti = '<i class="fa fa-male"></i><i class="fa fa-male"></i>';
                        break;
                        case 3:
                            $ico_adulti = '<i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i>';
                        break;
                        case 4:
                            $ico_adulti = '<i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i>';
                        break;
                        case 5:
                            $ico_adulti = '<i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i>';
                        break;
                        case 6:
                            $ico_adulti = '<i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i>';
                        break;
                        default:
                            $ico_adulti = $NumAdulti;
                        break;
                    }
                    switch($NumBambini){
                        case 1:
                            $ico_bimbi = '<i class="fa fa-child"></i>';
                        break;
                        case 2:
                            $ico_bimbi = '<i class="fa fa-child"></i><i class="fa fa-child"></i>';
                        break;
                        case 3:
                            $ico_bimbi = '<i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i>';
                        break;
                        case 4:
                            $ico_bimbi = '<i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i>';
                        break;
                        case 5:
                            $ico_bimbi = '<i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i>';
                        break;
                        case 6:
                            $ico_bimbi = '<i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i><i class="fa fa-child"></i>';
                        break;
                        default:
                            $ico_bimbi = $NumBambini;
                        break;
                    }

                    $IdCamera        = $val['IdCamera'];
                    $TipoCamere      = $val['TipoCamere'];
                    $TitoloCamera    = $val['TitoloCamera'];
                    $TestoCamera     = $val['TestoCamera'];
                    $TipoSoggiorno   = $val['TipoSoggiorno'];
                    $TitoloSoggiorno = $val['TitoloSoggiorno'];
                    $TestoSoggiorno  = $val['TestoSoggiorno'];
                    $Prezzo          = number_format($val['Prezzo'],2,',','.');

                if($Servizi != ''){

                  $serv = explode(",",$Servizi);
                  $services = array();
                  foreach ($serv as $key => $value) {
                          $q = "SELECT * FROM hospitality_servizi_camere_lingua WHERE Servizio LIKE '%".addslashes($serv[$key])."%' AND idsito = ".IDSITO."";
                          $r = $db->query($q);
                          $record = $db->row($r);
                          $id_servizio = $record['servizi_id'];

                            if($id_servizio){
                              $qy = "SELECT * FROM hospitality_servizi_camere_lingua WHERE servizi_id = ".$id_servizio." AND lingue = '".$Lingua."' AND idsito = ".IDSITO." ";
                              $rs = $db->query($qy);
                              $val = $db->row($rs);
                              $services[$record['servizi_id']] = $val['Servizio'];
                            }

                  }
                  //print_r($services);
                  $servizi = implode(", ",$services);

                }


                if($x == 1){
                    $stile = 'style="height: auto;"';
                    $classe = 'class="panel-collapse in"';
                }else{
                    $stile = 'style="height: 0;"';
                    $classe = 'class="panel-collapse collapse"';
                }
              $proposta .='<div class="panel-group"  role="camere" aria-multiselectable="true">
                        <div class="panel panel-warning">
                          <div class="panel-heading" role="camere" >
                            <h3 class="panel-title" style="width:100%!important">
                              <a aria-expanded="true" data-toggle="collapse" data-parent="#camere" href="#collapse'.$x.'_'.$IdCamera.'">
                               '.$TitoloCamera.' <div class="box-tools pull-right"><i class="fa fa-caret-down"></i></div>
                              </a>
                            </h3>
                          </div>
                          <div id="collapse'.$x.'_'.$IdCamera.'" '.$stile.' '.$classe.'>
                        <div class="panel-body panel-body-warning">';


                if($A != '' && $P != ''){

                    if($TipoRichiesta=='Preventivo'){
                        if($DataArrivo != $Arrivo || $DataPartenza != $Partenza){
                            $proposta .='   <div class="row">
                                                <div class="col-md-12">
                                                <b>'.DATEALTERNATIVE.':</b><br><i class="fa fa-calendar"></i> '.DATA_ARRIVO.' '.$Arrivo.' <i class="fa fa-calendar"></i> '.DATA_PARTENZA.' '.$Partenza.' <i class="fa fa-long-arrow-right"></i> '.NOTTI.' '.$ANotti.'
                                                </div>
                                            </div>
                                            <hr class="line_white">';
                        }
                      }elseif($TipoRichiesta=='Conferma'){
                          if($DataArrivo != $Arrivo ){
                              $DataArrivo = $Arrivo;
                              $Notti      = $ANotti;
                          }
                          if($DataPartenza != $Partenza){
                              $DataPartenza = $Partenza;
                              $Notti    = $ANotti;
                          }
                      }

                }

                $proposta .='   <div class="row">
                                    <div class="col-md-12">';
                                       $proposta .= $TestoCamera;
                $proposta .='       </div>
                                </div>
                                <hr class="line_white">
                                <div class="row">
                                    <div class="col-md-12">
                                        <b>'.SERVIZI_CAMERA.'</b>
                                        <p><em>'.$servizi.'</em></p>
                                    </div>
                                </div>
                                <hr class="line_white">
                                <div class="row">
                                    <div class="col-md-12">
                                        <b>'.$TitoloSoggiorno.'</b><br>';
                                        $proposta .= $TestoSoggiorno;
                $proposta .='
                                </div>
                            </div>';


                $proposta .= '  <div class="row">
                                        <div class="col-md-12">
                                        <script>
                                        $(document).ready(function(){
                                                $("#slider'.$IdCamera.'_'.$IdProposta.'").responsiveSlides({
                                                        auto: true,
                                                        pager: false,
                                                        nav: true,
                                                        namespace: "centered-btns"
                                                    });
                                        });
                                        </script>';

                     $proposta .= ' <div class="callbacks_container"> <ul class="rslides" id="slider'.$IdCamera.'_'.$IdProposta.'">';



                    $sel    = "SELECT Foto FROM hospitality_gallery_camera WHERE IdCamera = ".$IdCamera." AND idsito = ".IDSITO;
                    $res    = $db->query($sel);
                    $ris = $db->result($res);
                    $image_room  = '';

                    foreach ($ris as $y => $v) {

                        $image_room .='<li><img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$v['Foto'].'" /></li>';

                    }

                    $proposta .= $image_room;


                    $proposta .= '  </ul>
                    </div>
                                </div>
                                </div>';



                    $proposta .= '
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div>
                        </div>';

                    $proposta .='<table class="table table-bordered no_border_td">
                                    <tr>
                                        <td class="no_border_td"><b>'.SOGGIORNO.'<b></td>
                                        '.($DataRichiestaCheck > DATA_QUOTO_V2 && $NumAdulti!=0?'<td class="no_border_td" align="center"><b>'.ucfirst(strtolower(PERSONE)).'</b></td>':'').'
                                        <td class="no_border_td" align="center"><b>'.($DataRichiestaCheck > DATA_QUOTO_V2?NOTTI:'Nr. '.CAMERA).'</b></td>
                                        <td class="no_border_td" align="center"><b>'.PREZZO_CAMERA.'</b></td>
                                    </tr>
                                    <tr>
                                        <td class="panel-body-warning border_td_white"><p>
                                            <a href="javascript:;" data-toggle="tooltip" title="'.(strlen($TestoSoggiorno)>=300?strip_tags(substr($TestoSoggiorno,0,300).' ...'):strip_tags($TestoSoggiorno)).'"><i class="fa fa-info-circle text-green" aria-hidden="true"></i></a>
                                            '.$TitoloSoggiorno.' - '.($DataRichiestaCheck > DATA_QUOTO_V2?'nr.'.$NumeroCamere:'').' '.$TitoloCamera.'</p>
                                        </td>
                                        '.($DataRichiestaCheck > DATA_QUOTO_V2  && $NumAdulti!=0?'<td align="center" class="panel-body-warning border_td_white"><span data-toogle="tooltip" data-html="true" title="'.($NumAdulti!=0?ADULTI.' <b>'.$NumAdulti.'</b>':'').' <br>'.($NumBambini!=0?BAMBINI.' <b>' .$NumBambini.'</b>':'').'">'.($NumAdulti!=0?$ico_adulti:'').' '.($NumBambini!=0?$ico_bimbi:'').' '.($EtaB!=''?'<small>'.ETA.' '.$EtaB.'</small>':'').'</span></td>':'').'
                                        <td align="center" class="panel-body-warning border_td_white"><p>'.($DataRichiestaCheck > DATA_QUOTO_V2?($ANotti!=''?$ANotti:$Notti):$NumeroCamere).'</p></td>
                                        <td align="center" class="panel-body-warning border_td_white"><p>€. '.$Prezzo .'</p></td>
                                    </tr>
                                </table>';

    $x++;

    }

    if($TipoRichiesta == 'Conferma'){

        // Query per servizi aggiuntivi
        $query  = "SELECT hospitality_tipo_servizi.*,hospitality_relazione_servizi_proposte.num_persone,hospitality_relazione_servizi_proposte.num_notti FROM hospitality_relazione_servizi_proposte
                    INNER JOIN hospitality_tipo_servizi ON hospitality_relazione_servizi_proposte.servizio_id = hospitality_tipo_servizi.Id
                    WHERE hospitality_tipo_servizi.idsito = ".IDSITO."
                    AND hospitality_relazione_servizi_proposte.id_proposta = '".$IdProposta."'
                    AND hospitality_tipo_servizi.Abilitato = 1
                    ORDER BY hospitality_tipo_servizi.TipoServizio ASC";
        $risultato_query = $db->query($query);
        $record          = $db->result($risultato_query);
        if(sizeof($record)>0){
            $proposta .='<table class="table table-bordered no_border_td">
                                <tr>
                                    <td class="no_border_td" colspan="4" style="width:100%" ><b>'.SERVIZI_AGGIUNTIVI.'</b></td>
                                </tr>';
            $n_notti = '';
            foreach($record as $chiave => $campo){

                $q   = "SELECT hospitality_tipo_servizi_lingua.* FROM hospitality_tipo_servizi_lingua  WHERE hospitality_tipo_servizi_lingua.servizio_id = ".$campo['Id']." AND hospitality_tipo_servizi_lingua.idsito = ".IDSITO." AND hospitality_tipo_servizi_lingua.lingue = '".$Lingua."'";
                $r   = $db->query($q);
                $rec = $db->row($r);
            if($A != '' && $P != '' && $A != '0000-00-00' && $P != '0000-00-00'){
                if($TipoRichiesta=='Preventivo'){
                    if($DataArrivo != $Arrivo || $DataPartenza != $Partenza){
                      $n_notti = $ANotti;
                    }else{
                      $n_notti = $Notti;
                    }
                  }elseif($TipoRichiesta=='Conferma'){
                    if($DataArrivo != $Arrivo ){
                        $n_notti = $ANotti;
                    }
                    if($DataPartenza != $Partenza){
                        $n_notti = $ANotti;
                    }
                }
            }

            switch($Lingua){
                case "it":
                  $A_PERCENTUALE = 'A percentuale';
                break;
                case "en":
                  $A_PERCENTUALE = 'By percentage';
                break;
                case "fr":
                  $A_PERCENTUALE = 'Par pourcentage';
                break;
                case "de":
                  $A_PERCENTUALE = 'In Prozent';
                break;
              }

                switch($campo['CalcoloPrezzo']){
                    case "Al giorno":
                        $calcoloprezzo = AL_GIORNO;
                        $num_persone = '';
                        $CalcoloPrezzoServizio = ($campo['PrezzoServizio']!=0?'<small>('.number_format($campo['PrezzoServizio'],2,',','.').' x '.($ANotti!=''?$ANotti:$Notti).')</small>':'');
                        $PrezzoServizio = ($campo['PrezzoServizio']!=0?'<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format(($campo['PrezzoServizio']*($ANotti!=''?$ANotti:$Notti)),2,',','.'):'<small class="text-green">Gratis</small>');
                    break;
                    case "A percentuale":
                        $calcoloprezzo = $A_PERCENTUALE;
                        $num_persone = '';
                        $CalcoloPrezzoServizio = '';
                        $PrezzoServizio = ($campo['PercentualeServizio']!=''?'<i class="fa fa-percent"></i>&nbsp;&nbsp;'.number_format(($campo['PercentualeServizio']),2):'');
                    break;
                    case "Una tantum":
                        $calcoloprezzo = UNA_TANTUM;
                        $num_persone = '';
                        $CalcoloPrezzoServizio = '';
                        $PrezzoServizio = ($campo['PrezzoServizio']!=0?'<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format($campo['PrezzoServizio'],2,',','.'):'<small class="text-green">Gratis</small>');
                    break;
                    case "A persona":
                      $calcoloprezzo = A_PERSONA;
                      $num_persone = $campo['num_persone'];
                      $num_notti = $campo['num_notti'];
                      $CalcoloPrezzoServizio = ($campo['PrezzoServizio']!=0?'<small>('.number_format($campo['PrezzoServizio'],2,',','.').' x '.$num_notti.'  <span style="font-size:80%">gg</span> x '.$campo['num_persone'].' <small>pax</small>)</small>':'('.$num_notti.'  <small>gg</small> x '.$campo['num_persone'].' <small>pax</small>)');
                      $PrezzoServizio = ($campo['PrezzoServizio']!=0?'<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format(($campo['PrezzoServizio']*$num_notti*$campo['num_persone']),2,',','.'):'<small class="text-green">Gratis</small>');
                    break;
                  }
                    $proposta .='<tr>
                                    <td style="width:10%" class="panel-body-warning border_td_white text-center"><img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$campo['Icona'].'" class="iconaDimension"></td>
                                    <td style="width:35%"  class="panel-body-warning border_td_white"><p>
                                    '.($rec['Descrizione']!=''?'<a href="javascript:;" data-toggle="tooltip" title="'.(strlen($rec['Descrizione'])<=300?stripslashes(strip_tags($rec['Descrizione'])):substr(stripslashes(strip_tags($rec['Descrizione'])),0,300).'...').'"><i class="fa fa-info-circle text-green" aria-hidden="true"></i></a>':'').' '.$rec['Servizio'].'</p></td>
                                    <td style="width:30%"  class="panel-body-warning border_td_white text-center"><p><small>'.$calcoloprezzo.' '.$CalcoloPrezzoServizio.'</small></p></td>
                                    <td style="width:25%"  class="panel-body-warning border_td_white text-center"><p>'.$PrezzoServizio.'</p></td>

                                </tr>';

            }
            $proposta .='</table>';
        }
    }else{

        $ck_serv = check_controllo_servizi(IDSITO);
  
        if($ck_serv == 1){
            $proposta  .= get_modifica_servizi_aggiuntivi($n,$Id,$IdProposta ,$Lingua);
        }else{

            // Query per servizi aggiuntivi
            $query  = "SELECT hospitality_tipo_servizi.*,hospitality_relazione_servizi_proposte.num_persone,hospitality_relazione_servizi_proposte.num_notti FROM hospitality_relazione_servizi_proposte
                        INNER JOIN hospitality_tipo_servizi ON hospitality_relazione_servizi_proposte.servizio_id = hospitality_tipo_servizi.Id
                        WHERE hospitality_tipo_servizi.idsito = ".IDSITO."
                        AND hospitality_relazione_servizi_proposte.id_proposta = '".$IdProposta."'
                        AND hospitality_tipo_servizi.Abilitato = 1
                        ORDER BY hospitality_tipo_servizi.TipoServizio ASC";
            $risultato_query = $db->query($query);
            $record          = $db->result($risultato_query);
            if(sizeof($record)>0){
                $proposta .='<table class="table table-bordered no_border_td">
                                    <tr>
                                        <td class="no_border_td" colspan="4" style="width:100%" ><b>'.SERVIZI_AGGIUNTIVI.'</b></td>
                                    </tr>';
                $n_notti = '';
                foreach($record as $chiave => $campo){

                    $q   = "SELECT hospitality_tipo_servizi_lingua.* FROM hospitality_tipo_servizi_lingua  WHERE hospitality_tipo_servizi_lingua.servizio_id = ".$campo['Id']." AND hospitality_tipo_servizi_lingua.idsito = ".IDSITO." AND hospitality_tipo_servizi_lingua.lingue = '".$Lingua."'";
                    $r   = $db->query($q);
                    $rec = $db->row($r);
                if($A != '' && $P != '' && $A != '0000-00-00' && $P != '0000-00-00'){
                    if($TipoRichiesta=='Preventivo'){
                        if($DataArrivo != $Arrivo || $DataPartenza != $Partenza){
                        $n_notti = $ANotti;
                        }else{
                        $n_notti = $Notti;
                        }
                    }elseif($TipoRichiesta=='Conferma'){
                        if($DataArrivo != $Arrivo ){
                            $n_notti = $ANotti;
                        }
                        if($DataPartenza != $Partenza){
                            $n_notti = $ANotti;
                        }
                    }
                }

                switch($Lingua){
                    case "it":
                    $A_PERCENTUALE = 'A percentuale';
                    break;
                    case "en":
                    $A_PERCENTUALE = 'By percentage';
                    break;
                    case "fr":
                    $A_PERCENTUALE = 'Par pourcentage';
                    break;
                    case "de":
                    $A_PERCENTUALE = 'In Prozent';
                    break;
                }

                    switch($campo['CalcoloPrezzo']){
                        case "Al giorno":
                            $calcoloprezzo = AL_GIORNO;
                            $num_persone = '';
                            $CalcoloPrezzoServizio = ($campo['PrezzoServizio']!=0?'<small>('.number_format($campo['PrezzoServizio'],2,',','.').' x '.($ANotti!=''?$ANotti:$Notti).')</small>':'');
                            $PrezzoServizio = ($campo['PrezzoServizio']!=0?'<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format(($campo['PrezzoServizio']*($ANotti!=''?$ANotti:$Notti)),2,',','.'):'<small class="text-green">Gratis</small>');
                        break;
                        case "A percentuale":
                            $calcoloprezzo = $A_PERCENTUALE;
                            $num_persone = '';
                            $CalcoloPrezzoServizio = '';
                            $PrezzoServizio = ($campo['PercentualeServizio']!=''?'<i class="fa fa-percent"></i>&nbsp;&nbsp;'.number_format(($campo['PercentualeServizio']),2):'');
                        break;
                        case "Una tantum":
                            $calcoloprezzo = UNA_TANTUM;
                            $num_persone = '';
                            $CalcoloPrezzoServizio = '';
                            $PrezzoServizio = ($campo['PrezzoServizio']!=0?'<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format($campo['PrezzoServizio'],2,',','.'):'<small class="text-green">Gratis</small>');
                        break;
                        case "A persona":
                        $calcoloprezzo = A_PERSONA;
                        $num_persone = $campo['num_persone'];
                        $num_notti = $campo['num_notti'];
                        $CalcoloPrezzoServizio = ($campo['PrezzoServizio']!=0?'<small>('.number_format($campo['PrezzoServizio'],2,',','.').' x '.$num_notti.'  <span style="font-size:80%">gg</span> x '.$campo['num_persone'].' <small>pax</small>)</small>':'('.$num_notti.'  <small>gg</small> x '.$campo['num_persone'].' <small>pax</small>)');
                        $PrezzoServizio = ($campo['PrezzoServizio']!=0?'<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format(($campo['PrezzoServizio']*$num_notti*$campo['num_persone']),2,',','.'):'<small class="text-green">Gratis</small>');
                        break;
                    }
                        $proposta .='<tr>
                                        <td style="width:10%" class="panel-body-warning border_td_white text-center"><img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$campo['Icona'].'" class="iconaDimension"></td>
                                        <td style="width:35%"  class="panel-body-warning border_td_white"><p>
                                        '.($rec['Descrizione']!=''?'<a href="javascript:;" data-toggle="tooltip" title="'.(strlen($rec['Descrizione'])<=300?stripslashes(strip_tags($rec['Descrizione'])):substr(stripslashes(strip_tags($rec['Descrizione'])),0,300).'...').'"><i class="fa fa-info-circle text-green" aria-hidden="true"></i></a>':'').' '.$rec['Servizio'].'</p></td>
                                        <td style="width:30%"  class="panel-body-warning border_td_white text-center"><p><small>'.$calcoloprezzo.' '.$CalcoloPrezzoServizio.'</small></p></td>
                                        <td style="width:25%"  class="panel-body-warning border_td_white text-center"><p>'.$PrezzoServizio.'</p></td>

                                    </tr>';

                }
                $proposta .='</table>';
            }

        }

    }
                $proposta .= ' <div class="row">
                                            <div class="col-md-8">
                                                '.(($PrezzoL!='0,00' || $PrezzoL > $PrezzoP)?'<h5 class="text20"> '.PREZZO.' '.DA_LISTINO.'   <b class="text30">€. <strike>'.$PrezzoL.'</strike></b></h5>':'').'
                                                '.(($PrezzoL!='0,00')?'<h5 class="text20"> '.$sconto.' <b class="text20 text-green">'.$percentuale_sconto.' %</b> - €. '.$ImportoSconto.' <small>('. $etichetta_sconto.')</small></h5>':'').'
                                                <h5 class="text22">'.PREZZO.' '.E_PROPOSTO.' <b class="text38red">€. '.$PrezzoP.'</b></h5>';
                            if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                                 $proposta .= '<br><h5 class="text20">'.CAPARRA.': '.$AccontoPercentuale.' %  - <b class="text20">€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b></h5>';
                            }
                            if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                                if($AccontoImporto >= 1){
                                    $proposta .= '<br><h5 class="text20">'.CAPARRA.':  <b class="text20">€. '.number_format($AccontoImporto,2,',','.').'</b></h5>';
                                }else{
                                    $proposta .= '<br><h5 class="text20">'.CARTACREDITOGARANZIA.'</h5>';
                                }
                            }
                            if($AccontoTariffa!='' || $AccontoTesto!=''){

                                $proposta .= '<br><h5 class="text20"><span id="tarif'.$n.'" style="cursor:pointer"><i class="fa fa-question-circle" aria-hidden="true"></i> '.($AccontoTariffa!=''?$AccontoTariffa:$condizioni_tariffa).'</span></h5>
                                                <script>
                                                    $( "#tarif'.$n.'" ).click(function() {
                                                      $( "#cond_tarif'.$n.'" ).toggle( "slow", function() {
                                                        // Animation complete.
                                                      });
                                                    });
                                                </script>';
                            }

                $proposta .= '              </div>
                                            <div class="col-md-4 text-right">';

                                            if($TipoRichiesta == 'Preventivo'){

                                                    if(!$_REQUEST['result']){
                                                        $proposta .= '<button href="#" class="btn btn-danger btn-lg '.($Lingua =='it'?'text24':'text18').'" id="button_conf'.$n.'">'.CONFERMA.' '.PROPOSTA.' <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                                                                      <br><br>
                                                                      <button href="#" id="button_footer" class="btn btn-warning '.($Lingua =='it'?'':'text12').'"><i class="fa fa-comments-o fa-2x"></i> '.SCRIVICI_SE_HAI_BISOGNO.'</button>';

                                                    }
                                            }

                $proposta .='               </div>
                                        </div>';
                if($AccontoTariffa!='' || $AccontoTesto!=''){
                    $proposta .= '<div id="cond_tarif'.$n.'" style="display:none">
                                    <div class="row">
                                            <div class="col-md-12">
                                                <p><small>'.nl2br($AccontoTesto).'</small></p>
                                            </div>
                                    </div>
                                </div>';
                }

            $proposta .='      </div>';
            $proposta .= '</div>
            </div>';
    $n++;
}
$AccontoTariffa     = '';



$proposta .= '</div>';
    if($TipoRichiesta=='Preventivo'){
        $qry = "SELECT Immagine FROM hospitality_contenuti_web WHERE TipoRichiesta = 'Preventivo' AND Lingua = '".$Lingua."' AND idsito = ".IDSITO;
        $ryq = $db->query($qry);
        $rws = $db->row($ryq);
        if($rws['Immagine']!=''){
         $TopImage   = '<img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$rws['Immagine'].'" class="img-responsive" id="top_image">';
        }
    }
    if($TipoRichiesta=='Conferma'){
        $qry = "SELECT Immagine FROM hospitality_contenuti_web WHERE TipoRichiesta = 'Conferma' AND Lingua = '".$Lingua."' AND idsito = ".IDSITO;
        $ryq = $db->query($qry);
        $rws = $db->row($ryq);
        if($rws['Immagine']!=''){
         $TopImage   = '<img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$rws['Immagine'].'" class="img-responsive" id="top_image">';
        }
    }

    $q_car  = "SELECT * FROM hospitality_gallery WHERE idsito = ".IDSITO." AND Abilitato = 1 ORDER BY rand() LIMIT 12";
    $qy_carosello = $db->query($q_car);
    $r = $db->result($qy_carosello);
    $carosello .='<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-info">
                          <div class="panel-heading" role="tab" id="headingOne">
                            <h3 class="panel-title" style="width:100%!important">
                              <a role="button"  aria-expanded="true" data-toggle="collapse" data-parent="#accordion" href="#collapsePHG">
                               <i class="fa fa-camera" aria-hidden="true"></i> Photogallery  <div class="box-tools pull-right"><i class="fa fa-caret-down"></i></div>
                              </a>

                            </h3>
                          </div>
                          <div id="collapsePHG" class="panel-collapse collapse in" >
                        <div class="panel-body">
                        <div class="row">
                        <div class="col-md-12">';

    foreach($r as $pg =>$rs){
            $carosello .=' <a href="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$rs['Immagine'].'" data-toggle="lightbox" data-gallery="multiimages" >
                               <img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$rs['Immagine'].'" class="img-responsive img_gallery" />
                          </a>';
    }

   $carosello .= '</div>
                </div>
            </div>
           </div>
        </div>
    </div>';

    if(sizeof($r)==0){
        $carosello = '';
    }

    #EVENTI
    $sel_eventi = "SELECT astext(Coordinate),hospitality_eventi.DataInizio,hospitality_eventi.DataFine,hospitality_eventi.OraInizio,hospitality_eventi.OraFine,hospitality_eventi.Id,
                    hospitality_eventi.Indirizzo,hospitality_eventi.Immagine,hospitality_eventi_lang.Titolo,hospitality_eventi_lang.Descrizione
                    FROM hospitality_eventi
                    INNER JOIN hospitality_eventi_lang ON hospitality_eventi_lang.Id_eventi = hospitality_eventi.Id
                    WHERE hospitality_eventi.Abilitato = 1
                    AND hospitality_eventi.DataInizio >= '".$rows['DataArrivo']."'
                    AND hospitality_eventi.idsito = ".IDSITO."
                    AND hospitality_eventi_lang.Lingua = '".$Lingua."'
                    ORDER BY hospitality_eventi.DataInizio ASC";
    $res = $db->query($sel_eventi);
    $DatiEventi = $db->result($res);

$Eventi .='<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-info" id="Eventi">
                      <div class="panel-heading" role="tab" id="headingOne">
                        <h3 class="panel-title" style="width:100%!important">
                          <a role="button"  aria-expanded="true" data-toggle="collapse" data-parent="#accordion" href="#collapseEv">
                            '.EVENTI.'  <div class="box-tools pull-right"><i class="fa fa-caret-down"></i></div>
                          </a>

                        </h3>
                      </div>
                      <div id="collapseEv" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                    <div class="row">';
    // azzero variabili
    $distanceE = '';
    $distanzaE  = '';
    foreach($DatiEventi as $rec){

        // estrapolo latitutine e longitudi del punto interesse
        $coor_t = str_replace("POINT(","",$rec['astext(Coordinate)']);
        $coor_t = str_replace(")","",$coor_t);
        $coor_t = explode(" ",$coor_t);
        $lat    = $coor_t[0];
        $lon    = $coor_t[1];

        // calcolo la distanza
        $distanzaE = calcola_distanza($LatCliente, $LonCliente, $lat, $lon);
        $distanceE = '';
        foreach ($distanzaE as $unita => $valore) {
           $distanceE = $unita . ': ' . (number_format($valore,2,',','.')) . '<br/>';
        }
         // giro le date in formato italiano
        $array = explode("-", $rec['DataInizio']);
        $DataInizio = $array[2]."/".$array[1]."/".$array[0];
        $array2 = explode("-", $rec['DataFine']);
        $DataFine = $array2[2]."/".$array2[1]."/".$array2[0];


    $Eventi .= '<div class="col-md-6">
                    <div class="caption-full">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$rec['Immagine'].'" width="120px" class="img">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissable blu-text-head scroll" style="height:240px!important;overflow:auto!important">
                                    <h4>'.$rec['Titolo'].'</h4>
                                    <p>'.$rec['Descrizione'].'</p>
                                    <p>
                                    <i class="fa fa-fw fa-calendar"></i> Dal '.$DataInizio.' <i class="fa fa-fw fa-calendar"></i> al '.$DataFine.'<br>
                                    '.($rec['Indirizzo']!=''?'<i class="fa fa-fw fa-thumb-tack"></i>'.$rec['Indirizzo'].', '.$NomeCliente:'').'  '.($lat!='0'?' a '.$distanceE:'').'
                                    '.($lat!='0'?'<i class="fa fa-fw fa-map-marker"></i><span id="open_map'.$rec['Id'].'" onclick="document.getElementById(\'frame_lp\').src = \''.BASE_URL_SITO.'include/controller/gmap.php?from_lati='.$lat.'&from_long='.$lon.'&travelmode=DRIVING&idsito='.IDSITO.'\'; document.location.href=\'#start_map\'; return false" style="cursor:pointer">'.VISUALIZZA_MAPPA.'</span>':'').'
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        <script>
                            $("#open_map'.$rec['Id'].'").click(function(){
                                $("#b_map").removeAttr("style");
                            });
                        </script>  ';

    }
$distanceE = '';
$distanzaE  = '';
$Eventi .= ' </div>
            </div>
                </div><!-- /.row -->
        </div><!-- /.box-body -->
    </div><!-- /.box -->';


    if(sizeof($DatiEventi)==0){
        $Eventi = '';
    }

    if($ModuliEventi == false){
        $Eventi = '';
    }
    #PUNTI INTERESSE
    $sel_pdi = "SELECT astext(Coordinate),hospitality_pdi.Id,
                    hospitality_pdi.Indirizzo,hospitality_pdi.Immagine,hospitality_pdi_lang.Titolo,hospitality_pdi_lang.Descrizione
                    FROM hospitality_pdi
                    INNER JOIN hospitality_pdi_lang ON hospitality_pdi_lang.Id_pdi = hospitality_pdi.Id
                    WHERE hospitality_pdi.Abilitato = 1
                    AND hospitality_pdi.idsito = ".IDSITO."
                    AND hospitality_pdi_lang.Lingua = '".$Lingua."'
                    ORDER BY hospitality_pdi.Ordine ASC";
    $re = $db->query($sel_pdi);
    $DatiPdi = $db->result($re);

$PuntidiInteresse .='<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-info" id="Pdi">
                          <div class="panel-heading" role="tab" id="headingOne">
                            <h3 class="panel-title" style="width:100%!important">
                              <a role="button"  aria-expanded="true" data-toggle="collapse" data-parent="#accordion" href="#collapsePI">
                                '.PDI.'  <div class="box-tools pull-right"><i class="fa fa-caret-down"></i></div>
                              </a>

                            </h3>
                          </div>
                          <div id="collapsePI" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                        <div class="row">';
    // azzero variabili
    $coor_ = '';
    $distance = '';
    $distanza = '';
    foreach($DatiPdi as $k => $rws){

        // estrapolo latitutine e longitudi del punto interesse
        $coor_ = str_replace("POINT(","",$rws['astext(Coordinate)']);
        $coor_ = str_replace(")","",$coor_);
        $coor_ = explode(" ",$coor_);
        $lati = $coor_[0];
        $longi = $coor_[1];
        // calcolo la distanza
        $distanza = calcola_distanza($LatCliente, $LonCliente, $lati, $longi);
        $distance = '';
        foreach ($distanza as $unita => $valore) {
           $distance = $unita . ': ' . number_format($valore,2,',','.') . '<br/>';
        }

    $PuntidiInteresse .= '<div class="col-md-6">
                            <div class="caption-full">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$rws['Immagine'].'" width="120px" class="img">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-success alert-dismissable blu-text-head scroll" style="height:240px!important;overflow:auto!important">
                                            <h4>'.$rws['Titolo'].'</h4>
                                            <p>'.$rws['Descrizione'].'</p>
                                            <p>
                                                '.($rws['Indirizzo']!=''?'<i class="fa fa-fw fa-thumb-tack"></i>'.$rws['Indirizzo'].', '.$NomeCliente:'').'  '.($lati!='0'?' a '.$distance:'').'
                                                '.($lati!='0'?'<i class="fa fa-fw fa-map-marker"></i><span id="open_map_pdi'.$rws['Id'].'" onclick="document.getElementById(\'frame_lp_pdi\').src = \''.BASE_URL_SITO.'include/controller/gmap.php?from_lati='.$lati.'&from_long='.$longi.'&travelmode=DRIVING&idsito='.IDSITO.'\'; document.location.href=\'#start_map_pdi\'; return false" style="cursor:pointer">'.VISUALIZZA_MAPPA.'</span>':'').'
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $("#open_map_pdi'.$rws['Id'].'").click(function(){
                                $("#b_map_pdi").removeAttr("style");
                            });
                        </script>  ';



    }
    $distance = '';
    $distanza = '';
$PuntidiInteresse .= ' </div></div></div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->';




    if(sizeof($DatiPdi)==0){
        $PuntidiInteresse = '';
    }

    if($ModuliPDI == false){
        $PuntidiInteresse = '';
    }

#INFOHOTEL
$info_qy  = "SELECT hospitality_infohotel_lang.* FROM hospitality_infohotel_lang INNER JOIN hospitality_infohotel ON hospitality_infohotel.Id = hospitality_infohotel_lang.Id_infohotel WHERE hospitality_infohotel_lang.idsito = ".IDSITO."  AND hospitality_infohotel_lang.Lingua = '".$Lingua."' AND hospitality_infohotel.Abilitato = 1";
$res_info = $db->query($info_qy);
$info     = $db->row($res_info);
if(is_array($info)) {
    if($info > count($info)) // se la pagina richiesta non esiste
        $tot_info = count($info); // restituire la pagina con il numero più alto che esista
}else{
    $tot_info = 0;
}
if($tot_info>0){
   $infohotel .=' <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-success" id="Info">
                          <div class="panel-heading" role="tab" id="headingOne">
                            <h3 class="panel-title" style="width:100%!important">
                              <a role="button"  aria-expanded="true" data-toggle="collapse" data-parent="#accordion" href="#collapseINFO">
                               <i class="fa fa-info-circle" aria-hidden="true"></i> '.$info['Titolo'].'  <div class="box-tools pull-right"><i class="fa fa-caret-down"></i></div>
                              </a>

                            </h3>
                          </div>
                          <div id="collapseINFO" class="panel-collapse collapse '.($TipoRichiesta=='Preventivo'?'in':'').'" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                        <div class="row">';
    $infohotel .= '<div class="col-md-12">'.$info['Descrizione'].'</div>';
    $infohotel .= ' </div></div></div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->';
}

#PCONDIZIONI GENERALI E POLITICHE DI CANCELLAZIONE
$sel_cg = "SELECT * FROM hospitality_politiche_lingua WHERE idsito = ".IDSITO." AND id_politiche = ".$id_politiche." AND Lingua = '".$Lingua."' ORDER BY id DESC";
$re_cg  = $db->query($sel_cg);
$rw     = $db->row($re_cg);
   $condizioni_generali .=' <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-success" id="Pdi">
                          <div class="panel-heading" role="tab" id="headingOne">
                            <h3 class="panel-title" style="width:100%!important">
                              <a role="button"  aria-expanded="true" data-toggle="collapse" data-parent="#accordion" href="#collapseCG">
                                '.CONDIZIONI_GENERALI.'  <div class="box-tools pull-right"><i class="fa fa-caret-down"></i></div>
                              </a>

                            </h3>
                          </div>
                          <div id="collapseCG" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                        <div class="row">';
    $condizioni_generali .= '<div class="col-md-12">'.$rw['testo'].'</div>';
    $condizioni_generali .= ' </div></div></div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->';


if($abilita_mappa == 1){
    if($latitudine !='' && $longitudine != ''){
        $Mappa .='<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-info" id="Pdi">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h3 class="panel-title" style="width:100%!important">
                                    <a role="button"  aria-expanded="true" data-toggle="collapse" data-parent="#accordion" href="#collapseMP">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i> '.DOVE_SIAMO.'  <div class="box-tools pull-right"><i class="fa fa-caret-down"></i></div>
                                    </a>

                                    </h3>
                                </div>
                                <div id="collapseMP" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                <div class="row">

                        <div class="col-md-12" style="padding:0px 20px 0px 20px!important">
                            <div class="GM2">
                            <div id="map-container" class="google"></div>
                            </div>
                        </div>

                        </div>
                    </div>
                        </div><!-- /.row -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->';
    }
}

}

#
switch($Lingua){
  case"it":
  $accetto_le_politche = 'Accetto le politiche di cancellazione';
  $leggi_politiche     = 'Leggi le politiche';
  break;
  case"en":
  $accetto_le_politche = 'I accept the cancellation policy';
  $leggi_politiche     = 'Read the policies';
  break;
  case"fr":
  $accetto_le_politche = 'J\'accepte les conditions d\'annulation';
  $leggi_politiche     = 'Lire les politiques';
  break;
  case"de":
  $accetto_le_politche = 'Ich akzeptiere die Stornobedingungen';
  $leggi_politiche     = 'Lesen Politik';
  break;
}

#### VAGLIA ####
$vp = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito= ".IDSITO." AND Abilitato = 1  AND TipoPagamento = 'Vaglia Postale'";
$res_vp = $db->query($vp);
$row_vp = $db->row($res_vp);
if(is_array($row_vp)) {
    if($row_vp > count($row_vp)) // se la pagina richiesta non esiste
        $tot_vp = count($row_vp); // restituire la pagina con il numero più alto che esista
}else{
    $tot_vp = 0;
}
if($tot_vp > 0){
  $OrdineVP = $row_vp['Ordine'];

  $v = "SELECT * FROM hospitality_tipo_pagamenti_lingua WHERE idsito= ".IDSITO." AND pagamenti_id = ".$row_vp['Id']." AND lingue = '".$Lingua."'";
  $res_v = $db->query($v);
  $row_v = $db->row($res_v);
  $Pagamento_vp = $row_v['Pagamento'];
  $Descrizione_vp = $row_v['Descrizione'];

    $vaglia_posta .= '<hr>
                    <h4><b>'.$Pagamento_vp.'</b></h4>
                      <span class="text16">'.$Descrizione_vp.'</span><br><br>';

                        if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                            $vaglia_posta .= ' <b>'.ACCONTO.'</b>: '.$AccontoRichiesta.' %  - <b class="text30 text-red">€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b><br><br>';
                        }
                        if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                             $vaglia_posta .= ' <b>'.ACCONTO.'</b>: '.$AccontoPercentuale.' %  - <b class="text30 text-red">€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b><br><br>';
                        }
                        if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                             $vaglia_posta .= ' <b>'.ACCONTO.'</b>:  <b class="text30 text-red">€. '.number_format($AccontoLibero,2,',','.').'</b><br><br>';
                        }
                        if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                             $vaglia_posta .= ' <b>'.ACCONTO.'</b>:  <b class="text30 text-red">€. '.number_format($AccontoImporto,2,',','.').'</b><br><br>';
                        }

    $vaglia_posta .= '<input name="vg_policy" id="vg_policy" type="radio" value="1" required>
                      <label for="vg_policy" class="control-label text14">'.$accetto_le_politche.' <small>(<a href="#" id="vg_politiche">'.$leggi_politiche.'</a>)</small></label>
                      <div class="clear"></div>
                      <button  class="btn btn-lg btn-primary">'.SCELGO_VAGLIA.'</button> ';

}
#### BONIFICO ####
$bn = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito= ".IDSITO." AND Abilitato = 1  AND TipoPagamento = 'Bonifico Bancario'";
$res_bn = $db->query($bn);
$row_bn = $db->row($res_bn);
if(is_array($row_bn)) {
    if($row_bn > count($row_bn)) // se la pagina richiesta non esiste
        $tot_bn = count($row_bn); // restituire la pagina con il numero più alto che esista
}else{
    $tot_bn = 0;
}
if($tot_bn > 0){

  $OrdineBN = $row_bn['Ordine'];

  $b = "SELECT * FROM hospitality_tipo_pagamenti_lingua WHERE idsito= ".IDSITO." AND pagamenti_id = ".$row_bn['Id']." AND lingue = '".$Lingua."'";
  $res_b = $db->query($b);
  $row_b = $db->row($res_b);
  $Pagamento_bn = $row_b['Pagamento'];
  $Descrizione_bn = $row_b['Descrizione'];

    $bonifico_bancario .= ' <hr>
                            <h4><b>'.$Pagamento_bn.'</b></h4>
                              <span class="text16">'.$Descrizione_bn.'</span><br><br>';

                                if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                                      $bonifico_bancario .= '<b>'.ACCONTO.'</b>: '.$AccontoRichiesta.' %  - <b class="text30 text-red">€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b><br><br>';
                                }
                                if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                                      $bonifico_bancario .= '<b>'.ACCONTO.'</b>: '.$AccontoPercentuale.' %  - <b class="text30 text-red">€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b><br><br>';
                                }
                                if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                                      $bonifico_bancario .= '<b>'.ACCONTO.'</b>:  <b class="text30 text-red">€. '.number_format($AccontoLibero,2,',','.').'</b><br><br>';
                                }
                                if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                                      $bonifico_bancario .= '<b>'.ACCONTO.'</b>:  <b class="text30 text-red">€. '.number_format($AccontoImporto,2,',','.').'</b><br><br>';
                                }

     $bonifico_bancario .= '  <input name="bf_policy" id="bf_policy" type="radio" value="1" required>
                              <label for="bf_policy" class="control-label text14">'.$accetto_le_politche.' <small>(<a href="#" id="bf_politiche">'.$leggi_politiche.'</a>)</small></label>
                              <div class="clear"></div>
                              <button  class="btn btn-lg btn-primary">'.SCELGO_BONIFICO.'</button>';

}
#### CARTA DI CREDITO####
$cc = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito= ".IDSITO." AND Abilitato = 1  AND TipoPagamento = 'Carta di Credito'";
$res_cc = $db->query($cc);
$row_cc = $db->row($res_cc);
if(is_array($row_cc)) {
    if($row_cc > count($row_cc)) // se la pagina richiesta non esiste
        $tot_cc = count($row_cc); // restituire la pagina con il numero più alto che esista
}else{
    $tot_cc = 0;
}
if($tot_cc > 0){

  $OrdineCC   = $row_cc['Ordine'];
  $mastercard = $row_cc['mastercard'];
  $visa       = $row_cc['visa'];
  $amex       = $row_cc['amex'];
  $diners     = $row_cc['diners'];

  $c = "SELECT * FROM hospitality_tipo_pagamenti_lingua WHERE idsito= ".IDSITO." AND pagamenti_id = ".$row_cc['Id']." AND lingue = '".$Lingua."'";
  $res_c = $db->query($c);
  $row_c = $db->row($res_c);
  $Pagamento_cc = $row_c['Pagamento'];
  $Descrizione_cc = $row_c['Descrizione'];

  $carte_credito .= '<hr>
                    <h4><b>'.$Pagamento_cc.'</b></h4>
                     <span class="text16">'.$Descrizione_cc.'</span><br><br>';

                        if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                             $carte_credito .= '<b>'.ACCONTO.'</b>: '.$AccontoRichiesta.' %  - <b class="text30 text-red">€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b><br><br>';
                        }
                        if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                             $carte_credito .= '<b>'.ACCONTO.'</b>: '.$AccontoPercentuale.' %  - <b class="text30 text-red">€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b><br><br>';
                        }
                        if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                             $carte_credito .= '<b>'.ACCONTO.'</b>:  <b class="text30 text-red">€. '.number_format($AccontoLibero,2,',','.').'</b><br><br>';
                        }
                        if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                            if($AccontoImporto >= 1) {
                                $carte_credito .= '<b>'.ACCONTO.'</b>:  <b class="text30 text-red">€. '.number_format($AccontoImporto,2,',','.').'</b><br><br>';
                            }else{
                                $carte_credito .= '<b>'.CARTACREDITOGARANZIA.'</b><br><br>';
                            }
                        }

  $carte_credito .= ($amex==1?'<i class="fa fa-cc-amex fa-4x fa-fw text-aqua"></i>&nbsp;':'');
  $carte_credito .= ($diners==1?'<i class="fa fa-cc-diners-club fa-4x fa-fw text-light-blue"></i>&nbsp;':'');
  $carte_credito .= ($mastercard==1?'<i class="fa fa-cc-mastercard fa-4x fa-fw text-orange"></i>&nbsp;':'');
  $carte_credito .= ($visa==1?'<i class="fa fa-cc-visa fa-4x fa-fw text-blue"></i>':'');

  $carte_credito .= '   <br><br>
                          <div class="form-g">
                            <label for="cc-number" class="control-label">'.N_CARTA.'<small class="text-muted text-light-blue">[<span class="cc-brand"></span>]</small></label>
                           <input name="nomecartacc" type="hidden" id="nomecartacc">
                            <input name="cc_number" id="cc-number" type="tel" class="input-lg form-control cc-number err_cc" autocomplete="cc-number" placeholder="•••• •••• •••• ••••" required>
                          </div>
                          <div class="form-g">
                            <label for="cc-exp" class="control-label">'.SCADENZA.'</label>
                            <input name="cc_expiration" id="cc-exp" type="tel" class="input-lg form-control cc-exp err_cc" autocomplete="cc-exp" placeholder="•• / ••" required>
                          </div>
                          <div class="form-g">
                            <label for="cc-cvc" class="control-label">'.CODICE.'</label>
                            <input name="cc_codice" id="cc-cvc" type="tel" class="input-lg form-control cc-cvc err_cc" autocomplete="off" placeholder="•••" required>
                          </div>
                          <div class="form-g">
                            <label for="numeric" class="control-label">'.INTESTATARIO.'</label>
                            <input name="cc_intestatario" id="numeric" type="text" class="input-lg form-control" required>
                          </div>
                          <div class="form-g text14">
                            <input name="cc_policy" id="cc_policy" type="radio" value="1" required>
                             <label for="cc_policy" class="control-label">'.ACCONSENTI_PRIVACY_POLICY.'</label>
                             <div id="politiche" style="display:none">
                                <div class="row"><div class="col-md-12"><small>'.$rw['testo'].'</small></div></div>
                             </div>
                          </div>
                          <br><br>
                            <input type="hidden" name="id_richiesta" value="'.$Id.'">
                            <input type="hidden" name="idsito" value="'.$IdSito.'">
                            <input type="hidden" name="action" value="add_carta">
                            <button  class="btn btn-lg btn-primary">'.SALVA_CARTA_CREDITO.'</button>';

}

### PAYPAL####
$pp = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito= ".IDSITO." AND Abilitato = 1  AND TipoPagamento = 'PayPal'";
$res_pp = $db->query($pp);
$row_pp = $db->row($res_pp);
if(is_array($row_pp)) {
    if($row_pp > count($row_pp)) // se la pagina richiesta non esiste
        $tot_pp = count($row_pp); // restituire la pagina con il numero più alto che esista
}else{
    $tot_pp = 0;
}
if($tot_pp > 0){

  $OrdinePP    = $row_pp['Ordine'];
  $EmailPayPal = $row_pp['EmailPayPal'];

  $p = "SELECT * FROM hospitality_tipo_pagamenti_lingua WHERE idsito= ".IDSITO." AND pagamenti_id = ".$row_pp['Id']." AND lingue = '".$Lingua."'";
  $res_p = $db->query($p);
  $row_p = $db->row($res_p);
  $Pagamento_pp = $row_p['Pagamento'];
  $Descrizione_pp = $row_p['Descrizione'];

  $paypal .= '<hr>
                    <h4><b>'.$Pagamento_pp.'</b></h4>
                     <span class="text16">'.$Descrizione_pp.'</span><br><br>
                     <form method="post" name="paypal_form" id="paypal_form" action="#" disabled="disabled">
                        <input type="hidden" name="business" value="'.$EmailPayPal.'" />
                            <input type="hidden" name="cmd" value="_xclick" />
                            <input type="hidden" name="return" value="'.$_SERVER['REQUEST_URI'].'" />
                            <input type="hidden" name="cancel_return" value="" />
                            <input type="hidden" name="notify_url" value="" />
                            <input type="hidden" name="rm" value="2" />
                            <input type="hidden" name="currency_code" value="EUR" />
                            <input type="hidden" name="lc" value="'.strtoupper($Lingua).'" />
                            <input type="hidden" name="cs" value="0" />
                            <input type="hidden" name="item_name" value="'.OFFERTA.' nr. '.$NumeroPrenotazione.' | '.$NomeCliente.'" />
                            <input type="hidden" name="image_url" value="'.BASE_URL_ROOT.'uploads/loghi_siti/'.$Logo.'">

                            <input type="hidden" name="item_number" value="'.$NumeroPrenotazione.'" />

                            <input type="hidden" name="first_name" value="'.$Nome.'" />
                            <input type="hidden" name="last_name" value="'.$Cognome.'" />
                            <input type="hidden" name="country" value="'.strtoupper($Lingua).'" />
                            <input type="hidden" name="email" value="'.$Email.'" />';

                        if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                             $paypal .= '<b>'.ACCONTO.'</b>: '.$AccontoRichiesta.' %  - <b class="text30 text-red">€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b><br><br>';
                             $paypal .= '<input type="hidden" name="amount" value="'.number_format(($PrezzoPC*$AccontoRichiesta/100) ,2,'.','').'" />';
                        }
                        if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                             $paypal .= '<b>'.ACCONTO.'</b>: '.$AccontoPercentuale.' %  - <b class="text30 text-red">€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b><br><br>';
                             $paypal .= '<input type="hidden" name="amount" value="'.number_format(($PrezzoPC*$AccontoPercentuale/100) ,2,'.','').'" />';
                        }
                        if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                             $paypal .= '<b>'.ACCONTO.'</b>:  <b class="text30 text-red">€. '.number_format($AccontoLibero,2,',','.').'</b><br><br>';
                             $paypal .= '<input type="hidden" name="amount" value="'.number_format($AccontoLibero ,2,'.','').'" />';
                        }
                        if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                            if($AccontoImporto >= 1) {
                                $paypal .= '<b>'.ACCONTO.'</b>:  <b class="text30 text-red">€. '.number_format($AccontoImporto,2,',','.').'</b><br><br>';
                                $paypal .= '<input type="hidden" name="amount" value="'.number_format($AccontoImporto ,2,'.','').'" />';
                            }else{
                                $paypal .= '<b>'.CARTACREDITOGARANZIA.'</b><br><br>';
                            }
                        }

    $paypal .= '<label class="control-label text14">
                    <input name="pp_policy" id="pp_policy" type="radio" value="1" required />
                    '.$accetto_le_politche.' <small>(<a href="#" id="bf_politiche">'.$leggi_politiche.'</a>)</small>
                </label>
                <div class="clear"></div>';

    if($EmailPayPal !=''){
        $paypal .= ' <img src="'.BASE_URL_ROOT.'img/paypal.png" class="img-responsive" style="width:25%"/>
                        <div class="clear"></div>
                        <button type="button" class="btn btn-lg bg-yellow" ><i class="fa fa-paypal fa-lg"></i> '.PAGA_PAYPAL.'</button>';
    }else{
        $paypal .= '<small class="text-red">Email di riferimento PayPal, non è stata inserita!</small>';
    }

    $paypal .= '</form>';

}

### GATEWAY BANCARIO ####
$gb = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito= ".IDSITO." AND Abilitato = 1  AND TipoPagamento = 'Gateway Bancario'";
$res_gb = $db->query($gb);
$row_gb = $db->row($res_gb);
if(is_array($row_gb)) {
    if($row_gb > count($row_gb)) // se la pagina richiesta non esiste
        $tot_gb = count($row_gb); // restituire la pagina con il numero più alto che esista
}else{
    $tot_gb = 0;
}
if($tot_gb > 0){

  $OrdineGB   = $row_gb['Ordine'];
  $serverURL  = $row_gb['serverURL'];
  $tid        = $row_gb['tid'];
  $kSig       = $row_gb['kSig'];
  $ShopUserRef = $row_gb['ShopUserRef'];

  $cgb = "SELECT * FROM hospitality_tipo_pagamenti_lingua WHERE idsito= ".IDSITO." AND pagamenti_id = ".$row_gb['Id']." AND lingue = '".$Lingua."'";
  $res_gb = $db->query($cgb);
  $row_gb = $db->row($res_gb);
  $Pagamento_gb = $row_gb['Pagamento'];
  $Descrizione_gb = $row_gb['Descrizione'];

  $gateway_bancario .= '<hr>
                    <h4><b>'.$Pagamento_gb.'</b></h4>
                     <span class="text16">'.$Descrizione_gb.'</span><br><br>
                     <form method="post" name="payway_form" id="payway_form" action="">
                     <input type="hidden" name="serverURL" value="'.$serverURL.'">
                     <input type="hidden" name="tid" value="'.$tid.'">
                     <input type="hidden" name="kSig" value="'.$kSig.'">
                     <input type="hidden" name="ShopUserRef" value="'.$ShopUserRef.'">
                     <input type="hidden" name="landID" value="'.strtoupper($Lingua).'" />
                     <input type="hidden" name="shopID" value="'.$NumeroPrenotazione.'" />
                     <input type="hidden" name="v" value="'.$_REQUEST['v'].'" />
                     <input type="hidden" name="url_back" value="#">';

                        if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                             $gateway_bancario .= '<b>'.ACCONTO.'</b>: '.$AccontoRichiesta.' %  - <b class="text30 text-red">€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b><br><br>';
                        }
                        if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                             $gateway_bancario .= '<b>'.ACCONTO.'</b>: '.$AccontoPercentuale.' %  - <b class="text30 text-red">€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b><br><br>';
                        }
                        if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                             $gateway_bancario .= '<b>'.ACCONTO.'</b>:  <b class="text30 text-red">€. '.number_format($AccontoLibero,2,',','.').'</b><br><br>';
                        }
                        if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                            if($AccontoImporto >= 1) {
                                $gateway_bancario .= '<b>'.ACCONTO.'</b>:  <b class="text30 text-red">€. '.number_format($AccontoImporto,2,',','.').'</b><br><br>';
                            }else{
                                $gateway_bancario .= '<b>'.CARTACREDITOGARANZIA.'</b><br><br>';
                            }
                        }

    $gateway_bancario .= '<img src="'.BASE_URL_ROOT.'img/payway_pwsmage.jpg" class="img-responsive" style="width:25%"/>
                            <div class="clear"></div> ';

    $gateway_bancario .= '<label class="control-label text14">
                            <input name="gb_policy" id="gb_policy" type="radio" value="1" required />
                            '.$accetto_le_politche.' <small>(<a href="#" id="gb_politiche">'.$leggi_politiche.'</a>)</small>
                        </label>
                        <div class="clearfix"></div>
                        <button type="button" class="btn btn-lg btn-primary">'.PAGA_CARTA_CREDITO.' PayWay</button>
                        </form>';

}

### GATEWAY BANCARIO VIRTUAL PAY####
$gbvp = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito= ".IDSITO." AND Abilitato = 1  AND TipoPagamento = 'Gateway Bancario Virtual Pay'";
$res_gbvp = $db->query($gbvp);
$row_gbvp = $db->row($res_gbvp);
if(is_array($row_gbvp)) {
    if($row_gbvp > count($row_gbvp)) // se la pagina richiesta non esiste
        $tot_gbvp = count($row_gbvp); // restituire la pagina con il numero più alto che esista
}else{
    $tot_gbvp = 0;
}
if($tot_gbvp > 0){


  $OrdineGBVP  = $row_gbvp['Ordine'];
  $URL         = $row_gbvp['serverURL'];
  $ABI         = $row_gbvp['tid'];
  $MERCHANT_ID = $row_gbvp['kSig'];
  $EMAIL       = $row_gbvp['ShopUserRef'];

  $cgbvp            = "SELECT * FROM hospitality_tipo_pagamenti_lingua WHERE idsito= ".IDSITO." AND pagamenti_id = ".$row_gbvp['Id']." AND lingue = '".$Lingua."'";
  $res_cgbvp        = $db->query($cgbvp);
  $row_cgbvp        = $db->row($res_cgbvp);
  $Pagamento_gbvp   = $row_cgbvp['Pagamento'];
  $Descrizione_gbvp = $row_cgbvp['Descrizione'];

  $gateway_bancario_virtualpay .= '<hr>
                    <h4><b>'.$Pagamento_gbvp.'</b></h4>
                     <span class="text16">'.$Descrizione_gbvp.'</span><br><br>
                        <form method="post" name="virtualpay_form" id="virtualpay_form" action="#">
                        <input type="hidden" name="DIVISA" value="EUR">
                        <input type="hidden" name="ABI" value="'.$ABI.'">
                        <input type="hidden" name="MERCHANT_ID" value="'.$MERCHANT_ID.'">
                        <input type="hidden" name="MAC" value="">
                        <input type="hidden" name="EMAIL" value="'.$EMAIL.'">
                        <input type="hidden" name="LINGUA" value="'.strtoupper($Lingua).'" />
                        <input type="hidden" name="ORDER_ID" value="'.$NumeroPrenotazione.'" />
                        <input type="hidden" name="ITEMS" value="Prenotazione soggiorno presso '.NOMEHOTEL.'">
                        <input type="hidden" name="URLACK" value="#">
                        <input type="hidden" name="URLNACK" value="#">';
                        if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                             $gateway_bancario_virtualpay .= '<b>'.ACCONTO.'</b>: '.$AccontoRichiesta.' %  - <b class="text30 text-red">€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b><br><br>';
                             $gateway_bancario_virtualpay .= '<input type="hidden" name="IMPORTO" value="'.number_format(($PrezzoPC*$AccontoRichiesta/100) ,2,'.','').'" />';
                        }
                        if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                             $gateway_bancario_virtualpay .= '<b>'.ACCONTO.'</b>: '.$AccontoPercentuale.' %  - <b class="text30 text-red">€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b><br><br>';
                             $gateway_bancario_virtualpay .= '<input type="hidden" name="IMPORTO" value="'.number_format(($PrezzoPC*$AccontoPercentuale/100) ,2,'.','').'" />';
                        }
                        if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                             $gateway_bancario_virtualpay .= '<b>'.ACCONTO.'</b>:  <b class="text30 text-red">€. '.number_format($AccontoLibero,2,',','.').'</b><br><br>';
                             $gateway_bancario_virtualpay .= '<input type="hidden" name="IMPORTO" value="'.number_format($AccontoLibero ,2,'.','').'" />';
                        }
                        if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                            if($AccontoImporto >= 1) {
                                $gateway_bancario_virtualpay .= '<b>'.ACCONTO.'</b>:  <b class="text30 text-red">€. '.number_format($AccontoImporto,2,',','.').'</b><br><br>';
                                $gateway_bancario_virtualpay .= '<input type="hidden" name="IMPORTO" value="'.number_format($AccontoImporto ,2,'.','').'" />';
                            }else{
                                $gateway_bancario_virtualpay .= '<b>'.CARTACREDITOGARANZIA.'</b><br><br>';
                            }
                        }

  $gateway_bancario_virtualpay .= '<img src="'.BASE_URL_ROOT.'img/virtualpay_form.jpg" class="img-responsive" style="width:25%"/>
                                  <div class="clear"></div> ';

  $gateway_bancario_virtualpay .= '<label class="control-label text14">
                                      <input name="gbvp_policy" id="gbvp_policy" type="radio" value="1" required />
                                      '.$accetto_le_politche.' <small>(<a href="#" id="gbvp_politiche">'.$leggi_politiche.'</a>)</small>
                                  </label>
                                  <div class="clearfix"></div>
                                  <button type="button" class="btn btn-lg btn-primary">'.PAGA_CARTA_CREDITO.' Virtual Pay</button>
                                  </form>';

}

### STRIPE ####
$ss = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito= ".IDSITO." AND Abilitato = 1  AND TipoPagamento = 'Stripe'";
$res_ss = $db->query($ss);
$row_ss = $db->row($res_ss);
if(is_array($row_ss)) {
    if($row_ss > count($row_ss)) // se la pagina richiesta non esiste
        $tot_ss = count($row_ss); // restituire la pagina con il numero più alto che esista
}else{
    $tot_ss = 0;
}
if($tot_ss > 0){

  $OrdineSS     = $row_ss['Ordine'];
  $ApiKeyStripe = $row_ss['ApiKeyStripe'];

  $s = "SELECT * FROM hospitality_tipo_pagamenti_lingua WHERE idsito= ".IDSITO." AND pagamenti_id = ".$row_ss['Id']." AND lingue = '".$Lingua."'";
  $res_s = $db->query($s);
  $row_s = $db->row($res_s);
  $Pagamento_ss = $row_s['Pagamento'];
  $Descrizione_ss = $row_s['Descrizione'];

  if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
    $stripe_txt = '<b>'.ACCONTO.'</b>: '.$AccontoRichiesta.' %  - <b class="text30 text-red">€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b><br><br>';
    $stripe_value = number_format(($PrezzoPC*$AccontoRichiesta/100) ,2,'','');
    }
    if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
        $stripe_txt = '<b>'.ACCONTO.'</b>: '.$AccontoPercentuale.' %  - <b class="text30 text-red">€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b><br><br>';
        $stripe_value = number_format(($PrezzoPC*$AccontoPercentuale/100) ,2,'','');
    }
    if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
        $stripe_txt = '<b>'.ACCONTO.'</b>:  <b class="text30 text-red">€. '.number_format($AccontoLibero,2,',','.').'</b><br><br>';
        $stripe_value = number_format($AccontoLibero ,2,'','');
    }
    if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
        if($AccontoImporto >= 1) {
            $stripe_txt = '<b>'.ACCONTO.'</b>:  <b class="text30 text-red">€. '.number_format($AccontoImporto,2,',','.').'</b><br><br>';
            $stripe_value = number_format($AccontoImporto ,2,'','');
        }else{
            $stripe_txt = '<b>'.CARTACREDITOGARANZIA.'</b><br><br>';
        }
    }
    $stripe .= '<hr>
                    <h4><b>'.$Pagamento_ss.'</b></h4>
                     <span class="text16">'.$Descrizione_ss.'</span><br><br>
                     '.$stripe_txt.'
                     <img src="'.BASE_URL_ROOT.'img/stripe.png" class="img-responsive" style="width:25%" />
                     <div class="clear"></div> ';

    $stripe .= '<label class="control-label text14">
                    <input name="pp_policy" id="pp_policy" type="radio" value="1" required />
                    '.$accetto_le_politche.' <small>(<a href="#" id="bf_politiche">'.$leggi_politiche.'</a>)</small>
                </label>
                <div class="clear"></div>';
                $stripe .= '  <form action="/stripe/ok.php" method="POST">   
                <script src="https://checkout.stripe.com/checkout.js" 
                    class="stripe-button"     
                    data-key="'.$ApiKeyStripe.'"     
                    data-amount="'.$stripe_value.'"   
                    data-email="'.$Email.'" 
                    data-currency="EUR"  
                    data-name="'.NOMEHOTEL.'"     
                    data-description="'.OFFERTA.' nr. '.$NumeroPrenotazione.' | '.$NomeCliente.'"    
                    data-image=""     
                    data-locale="auto">   
                </script> 
                <button id="card-button" class="btn btn-success" type="button">Paga con STRIPE </button>
              </form>
              <script>
                  $(document).ready(function(){
                      $(".stripe-button-el").attr("style","display:none");
                  })   
              </script>';

}

### NEXI ####
$nx = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito= ".IDSITO." AND Abilitato = 1  AND TipoPagamento = 'Nexi'";
$res_nx = $db->query($nx);
$row_nx = $db->row($res_nx);
if(is_array($row_nx)) {
  if($row_nx > count($row_nx)) // se la pagina richiesta non esiste
      $tt_nx = count($row_nx); // restituire la pagina con il numero più alto che esista
}else{
  $tt_nx = 0;
}
if(($tt_nx) > 0){

  $OrdineNX        = $row_nx['Ordine'];
  $ApiKeyNexi      = $row_nx['ApiKeyNexi'];
  $SegretKeyNexi   = $row_nx['SegretKeyNexi'];

  $x = "SELECT * FROM hospitality_tipo_pagamenti_lingua WHERE idsito= ".IDSITO." AND pagamenti_id = ".$row_nx['Id']." AND lingue = '".$Lingua."'";
  $res_x = $db->query($x);
  $row_x = $db->row($res_x);
  $Pagamento_nx   = $row_x['Pagamento'];
  $Descrizione_nx = $row_x['Descrizione'];

  if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
    $nexi_txt   = '<b>'.ACCONTO.'</b>: '.$AccontoRichiesta.' %  - <b class="t40 tcolor">€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b><br><br>';
    $nexi_value = number_format(($PrezzoPC*$AccontoRichiesta/100) ,2,'','');
  }
  if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
    $nexi_txt = '<b>'.ACCONTO.'</b>: '.$AccontoPercentuale.' %  - <b class="t40 tcolor">€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b><br><br>';
      $nexi_value = number_format(($PrezzoPC*$AccontoPercentuale/100) ,2,'','');
  }
  if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
      $nexi_txt   = '<b>'.ACCONTO.'</b>:  <b class="t40 tcolor">€. '.number_format($AccontoLibero,2,',','.').'</b><br><br>';
      $nexi_value = number_format($AccontoLibero ,2,'','');
  }
  if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
  if($AccontoImporto >= 1){      
      $nexi_txt   = '<b>'.ACCONTO.'</b>:  <b class="t40 tcolor">€. '.number_format($AccontoImporto,2,',','.').'</b><br><br>';
      $nexi_value = number_format($AccontoImporto ,2,'','');
    }else{
        $nexi_txt = '<b>'.CARTACREDITOGARANZIA.'</b><br><br>';
    }
  }

    $nexi .= '<hr>
                    <h4><b>'.$Pagamento_nx.'</b></h4>
                    <span class="text16">'.$Descrizione_nx.'</span><br><br>
                    '.$nexi_txt.'
                    <img src="'.BASE_URL_ROOT.'img/LogoNexi_XPay.jpg" class="img-responsive" style="width:25%"/>
                    <div class="clear"></div> ';
      $nexi .= '
                    <input name="nx_policy" id="nx_policy" type="radio" value="1" required oninvalid="this.setCustomValidity(\'Questo campo è obbligatorio\')" onchange="this.setCustomValidity(\'\')">
                    <label for="nx_policy" class="t14">'.$accetto_le_politche.' (<a href="javascript:;" id="sblocca_politiche_nx">'.$leggi_politiche.'</a>)</label>
                    <div class="clear"></div> 
                    <div id="politiche_nx" style="display:none">
                         <div class="t14">'.$rw['testo'].'</div>
                    </div>
                        <script>
                           $(document).ready(function() {
                                 $("#sblocca_politiche_nx").click(function(){
                                     $( "#politiche_nx" ).toggle();
                                 });
                             });
                        </script>
                        <div class="clear"></div> ';

                        $merchantServerUrl = BASE_URL_SITO;
                        $codTrans = 'QUOTO_'.IDSITO.'_'.$NumeroPrenotazione.'_' . date('YmdHis');
                        $divisa = "EUR";
                        $importo = $nexi_value;
    
                        // Calcolo MAC
                        $mac = sha1('codTrans=' . $codTrans . 'divisa=' . $divisa . 'importo=' . $importo . $CHIAVESEGRETA);
    
                        // Parametri obbligatori
                        $obbligatori = array(
                            'alias' => $ALIAS,
                            'importo' => $importo,
                            'divisa' => $divisa,
                            'codTrans' => $codTrans,
                            'url' => $merchantServerUrl .$_REQUEST['v'].'/bmV4aQ==/index/',
                            'url_back' => $merchantServerUrl .$_REQUEST['v'].'/index/',
                            'mac' => $mac,   
                        );
    
                        // Parametri facoltativi
                        $facoltativi = array(
                        );
    
                        $requestParams = array_merge($obbligatori, $facoltativi);
    
                        foreach ($requestParams as $name => $value) { 
                            $nexi .= '<input type="hidden" name="'.$name.'" value="'.htmlentities($value).'" />'."\r\n";
                        }
                            
                        if($ApiKeyNexi !=''){
                                $nexi .= '<div class="clear"></div>';
                                $nexi .= ' <button type="button"  class="btn btn-lg btn-primary" id="nexi-button">Paga con Xpay di NEXI</button>';
                        }else{
                          $nexi .= '<small class="text-red">API di riferimento Nexi, non è stata inserita!</small>';
                        }
                            
            $nexi .= '</div>';


}

if($Id!=''){
  $selPA = "SELECT * FROM hospitality_rel_pagamenti_preventivi WHERE idsito = ".IDSITO." AND id_richiesta = ".$Id."";
  $risPA = $db->query($selPA);
  $recordPA = $db->row($risPA);
  if(is_array($recordPA)) {
    if($recordPA > count($recordPA)) // se la pagina richiesta non esiste
        $tt_PA = count($recordPA); // restituire la pagina con il numero più alto che esista
  }else{
    $tt_PA = 0;
  }
  if(($tt_PA) > 0){
    if($recordPA['CC']==0){
        $carte_credito = '';
    }
    if($recordPA['BB']==0){
        $bonifico_bancario = '';
    }
    if($recordPA['VP']==0){
        $vaglia_posta = '';
    }
    if($recordPA['PP']==0){
      $paypal = '';
    }
    if($recordPA['GB']==0){
        $gateway_bancario = '';
    }
    if($recordPA['GBVP']==0){
        $gateway_bancario_virtualpay = '';
    }
    if($recordPA['GBS']==0){
      $stripe = '';
    }
    if($recordPA['GBNX']==0){
      $nexi = '';
    }
  }
}
$ordinamento_pagamenti = array( 
                                $OrdineVP   => $vaglia_posta, 
                                $OrdineBN   => $bonifico_bancario, 
                                $OrdineCC   => $carte_credito, 
                                $OrdinePP   => $paypal, 
                                $OrdineGB   => $gateway_bancario, 
                                $OrdineGBVP => $gateway_bancario_virtualpay, 
                                $OrdineSS   => $stripe, 
                                $OrdineNX   => $nexi
                              );
ksort($ordinamento_pagamenti);

#pulsante indietro per il preview
if($_REQUEST['azione']!=''){
  if($TipoRichiesta == 'Preventivo' && $Archivia == 0){
    $TornaA = BASE_URL_SITO.'preventivi/';
    $Etichetta = 'ai Preventivi';
  }elseif($TipoRichiesta == 'Conferma' && $Chiuso == 0 && $Archivia == 0){
    $TornaA = BASE_URL_SITO.'conferme/';
    $Etichetta = 'alle Conferme';
  }elseif($TipoRichiesta == 'Conferma' && $Chiuso == 1 && $Archivia == 0){
    $TornaA = BASE_URL_SITO.'prenotazioni/';
    $Etichetta = 'alle Prenotazioni';
  }elseif($Archivia == 1){
    $TornaA = BASE_URL_SITO.'archivio/';
    $Etichetta = 'all\'Archivio';
  }
  $PulsanteIndietro = '<a class="btn btn-warning" href="'.$TornaA.'"><i class="fa fa-arrow-left"></i> Torna indietro '.$Etichetta.'</a>';
}
