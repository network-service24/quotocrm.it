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

                $lista_servizi_aggiuntivi .='<table class="table no_border t16">
                                              <tr>
                                                      <td class="m-x-2 no_border m-x-tl t18 w300">'.SERVIZIO.'</td>
                                                      <td class="m-x-2 no_border m-x-tc  t18 w300 "></td>
                                                      <td class="m-x-3 no_border m-x-tc  t18 w300">'.CALCOLO.'</td>
                                                      <td class="m-x-1 no_border m-x-tc  t18 w300 nowrap">'.$ABILITA.'</td>
                                                      <td class="m-x-1 no_border m-x-tc  t18 w300"></td>
                                                      <td class="m-x-3 no_border m-x-tr  t18 w300 nowrap">'.PREZZO_SERVIZIO.'</td>

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
                    $rs = $db->row($ss);

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
                                                      <td class="m-x-2 no_border m-x-tl" style="position:relative">'.($campo['Icona']!=''?'<img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$campo['Icona'].'" class="iconaservizi" style="width:auto!important;height:32px!important;position:relative!important;">':'').'  <span style="margin-left:100px!important" class="nowrap">&nbsp;&nbsp;'.$rec['Servizio'].'</span></td>
                                                      <td class="m-x-2 no_border m-x-tc">'.($rec['Descrizione']!=''?'<a href="javascript:;" data-toggle="tooltip" title="'.(strlen($rec['Descrizione'])<=300?stripslashes(strip_tags($rec['Descrizione'])):substr(stripslashes(strip_tags($rec['Descrizione'])),0,300).'...').'"><i class="fa fa-info-circle text-green" aria-hidden="true"></i></a>':'').' </td>';                                                               
                        $lista_servizi_aggiuntivi .=' <td class="m-x-3 no_border m-x-tc">'.$calcoloprezzo.' '.$CalcoloPrezzoServizio.'</td> ';
                      
                        $lista_servizi_aggiuntivi .=' <td class="m-x-1 no_border m-x-tc">';
                      if($campo['CalcoloPrezzo'] == 'A percentuale' && $campo['PercentualeServizio'] != ''){ 
                          $lista_servizi_aggiuntivi .='   <div id="contenitore_switchery'.$campo['Id'].'" class="nowrap">
                                                            '.($campo['Obbligatorio']==1?$obbligatory.'<div class="text_explan_percent">'.$TEXT_EXPLANE.'</div>':($IdServizio[$campo['Id']]==1?'<small>('.$IMPOSTO.')</small>'.'<div class="text_explan_percent">'.$TEXT_EXPLANE.'</div>':'<input disabled="disabled" type="checkbox" class="PrezzoServizio'.$n.'"  id="PrezzoServizio'.$n.'_'.$campo['Id'].'" name="PrezzoServizio'.$n.'['.$campo['Id'].']" value="'.$campo['PercentualeServizio'].'#'.$campo['CalcoloPrezzo'].'#'.$campo['Id'].'"  '.($IdServizio[$campo['Id']]==1?'checked="checked"':'').'>'));
                      }else{
                          $lista_servizi_aggiuntivi .='   <div id="contenitore_switchery'.$campo['Id'].'" class="nowrap">
                                                            '.($campo['Obbligatorio']==1?$obbligatory:($IdServizio[$campo['Id']]==1?'<small>('.$IMPOSTO.')</small>':'<input disabled="disabled" type="checkbox" class="PrezzoServizio'.$n.'" id="PrezzoServizio'.$n.'_'.$campo['Id'].'" name="PrezzoServizio'.$n.'['.$campo['Id'].']" value="'.$campo['PrezzoServizio'].'#'.$campo['CalcoloPrezzo'].'#'.$campo['Id'].'" '.($campo['Obbligatorio']==1?'disabled="disabled"':'').' '.($IdServizio[$campo['Id']]==1?'checked="checked"':'').'>'));
                      }   
                        $lista_servizi_aggiuntivi .=' <td class="m-x-1 no_border m-x-tc">'.($recrel['num_notti']!= 0 || !is_null($recrel['num_notti']) || !empty($recrel['num_notti']) ? '<input type="hidden" name="notti'.$n.'_'.$campo['Id'].'" id="notti'.$n.'_'.$campo['Id'].'" data-tipo="notti'.$n.'_'.$campo['Id'].'" value="'.$recrel['num_notti'].'">':'').($recrel['num_persone']!= 0 || !is_null($recrel['num_persone']) || !empty($recrel['num_persone']) ? '<input type="hidden" name="num_persone_'.$n.'_'.$campo['Id'].'" id="num_persone'.$n.'_'.$campo['Id'].'" data-tipo="persone'.$n.'_'.$campo['Id'].'" value="'.$recrel['num_persone'].'" />':'').'<div id="valori_serv_'.$n.'_'.$campo['Id'].'" class="nowrap" style="font-size:75%"></div><div id="pulsante_calcola_'.$n.'_'.$campo['Id'].'" class="nowrap" style="font-size:75%"></div><div id="spiegazione_prezzo_servizio_'.$n.'_'.$campo['Id'].'" class="nowrap" style="font-size:75%"></div></div></td>';         
                        $lista_servizi_aggiuntivi .=' <td class="m-x-3 no_border m-x-tr"><div id="Prezzo_Servizio_'.$n.'_'.$campo['Id'].'">'.$PrezzoServizio.'</div><input type="hidden" id="RecPrezzo_Servizio_'.$n.'_'.$campo['Id'].'" name="RecPrezzo_Servizio_'.$n.'_'.$campo['Id'].'"></td>
              
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
                                            <td class="m-x-2 no_border m-x-tl" style="position:relative">'.($campo['Icona']!=''?'<img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$campo['Icona'].'" class="iconaservizi" style="width:auto!important;height:32px!important;position:relative!important;">':'').'  <span style="margin-left:100px!important" class="nowrap">&nbsp;&nbsp;'.$rec['Servizio'].'</span></td>
                                            <td class="m-x-2 no_border m-x-tc">'.($rec['Descrizione']!=''?'<a href="javascript:;" data-toggle="tooltip" title="'.(strlen($rec['Descrizione'])<=300?stripslashes(strip_tags($rec['Descrizione'])):substr(stripslashes(strip_tags($rec['Descrizione'])),0,300).'...').'"><i class="fa fa-info-circle text-green" aria-hidden="true"></i></a>':'').' </td>';                                                               
                      $lista_servizi_aggiuntivi .=' <td class="m-x-3 no_border m-x-tc">'.$calcoloprezzo.' '.$CalcoloPrezzoServizio.'</td> ';

                      $lista_servizi_aggiuntivi .=' <td class="m-x-1 no_border m-x-tc">';
                      if($campo['CalcoloPrezzo'] == 'A percentuale' && $campo['PercentualeServizio'] != ''){ 
                      $lista_servizi_aggiuntivi .='   <div id="contenitore_switchery'.$campo['Id'].'" class="nowrap">
                                                  '.($campo['Obbligatorio']==1?$obbligatory.'<div class="text_explan_percent">'.$TEXT_EXPLANE.'</div>':($IdServizio[$campo['Id']]==1?'<small>('.$IMPOSTO.')</small>'.'<div class="text_explan_percent">'.$TEXT_EXPLANE.'</div>':'<input disabled="disabled" type="checkbox" class="PrezzoServizio'.$n.'"  id="PrezzoServizio'.$n.'_'.$campo['Id'].'" name="PrezzoServizio'.$n.'['.$campo['Id'].']" value="'.$campo['PercentualeServizio'].'#'.$campo['CalcoloPrezzo'].'#'.$campo['Id'].'"  '.($IdServizio[$campo['Id']]==1?'checked="checked"':'').'>'));
                      }else{
                      $lista_servizi_aggiuntivi .='   <div id="contenitore_switchery'.$campo['Id'].'" class="nowrap">
                                                  '.($campo['Obbligatorio']==1?$obbligatory:($IdServizio[$campo['Id']]==1?'<small>('.$IMPOSTO.')</small>':'<input disabled="disabled" type="checkbox" class="PrezzoServizio'.$n.'" id="PrezzoServizio'.$n.'_'.$campo['Id'].'" name="PrezzoServizio'.$n.'['.$campo['Id'].']" value="'.$campo['PrezzoServizio'].'#'.$campo['CalcoloPrezzo'].'#'.$campo['Id'].'" '.($campo['Obbligatorio']==1?'disabled="disabled"':'').' '.($IdServizio[$campo['Id']]==1?'checked="checked"':'').'>'));
                      }   
                      $lista_servizi_aggiuntivi .=' <td class="m-x-1 no_border m-x-tc">'.($recrel['num_notti']!= 0 || !is_null($recrel['num_notti']) || !empty($recrel['num_notti']) ? '<input type="hidden" name="notti'.$n.'_'.$campo['Id'].'" id="notti'.$n.'_'.$campo['Id'].'" data-tipo="notti'.$n.'_'.$campo['Id'].'" value="'.$recrel['num_notti'].'">':'').($recrel['num_persone']!= 0 || !is_null($recrel['num_persone']) || !empty($recrel['num_persone']) ? '<input type="hidden" name="num_persone_'.$n.'_'.$campo['Id'].'" id="num_persone'.$n.'_'.$campo['Id'].'" data-tipo="persone'.$n.'_'.$campo['Id'].'" value="'.$recrel['num_persone'].'" />':'').'<div id="valori_serv_'.$n.'_'.$campo['Id'].'" class="nowrap" style="font-size:75%"></div><div id="pulsante_calcola_'.$n.'_'.$campo['Id'].'" class="nowrap" style="font-size:75%"></div><div id="spiegazione_prezzo_servizio_'.$n.'_'.$campo['Id'].'" class="nowrap" style="font-size:75%"></div></div></td>';         
                      $lista_servizi_aggiuntivi .=' <td class="m-x-3 no_border m-x-tr"><div id="Prezzo_Servizio_'.$n.'_'.$campo['Id'].'">'.$PrezzoServizio.'</div><input type="hidden" id="RecPrezzo_Servizio_'.$n.'_'.$campo['Id'].'" name="RecPrezzo_Servizio_'.$n.'_'.$campo['Id'].'"></td>

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
$css_script = "<style>
                .box{
                  border-top:0px !important;
                }
              </style>"."\r\n";
 $sql = 'SELECT astext(coordinate),
                    siti.abilita_mappa,
                    siti.nome,
                    siti.https,
                    siti.web,
                    siti.email,
                    siti.indirizzo,
                    siti.tel,
                    siti.cap,
                    siti.TagManager,
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

$NomeCliente   = $row['nome'];
$EmailCliente  = $row['email'];
$Indirizzo     = $row['indirizzo'];
$Localita      = $row['nome_comune'];
$Cap           = $row['cap'];
$abilita_mappa = $row['abilita_mappa'];
if(strstr($row['tel'],'+39') || strstr($row['tel'],'0039')){
  $tel          = $row['tel'];
}else{
  $tel          = '+39 '.$row['tel'];
}
$Provincia    = $row['sigla_provincia'];
$coor_tmp     = str_replace("POINT(","",$row['astext(coordinate)']);
$coor_tmp     = str_replace(")","",$coor_tmp);
$coor_tmp     = explode(" ",$coor_tmp);
$latitudine   = $coor_tmp[0];
$LatCliente   = $coor_tmp[0];
$LonCliente   = $coor_tmp[1];
$longitudine  = $coor_tmp[1];
$sito_tmp     = str_replace("http://","",$row['web']);
$sito_tmp     = str_replace("www.","",$sito_tmp);
if($row['https']==1){
    $http = 'https://';
}else{
    $http = 'http://';
}
$SitoWeb   = $http.'www.'.$sito_tmp;
$Logo         = $row['logo'];
$TagManager   = $row['TagManager'];

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

            </script>';
  }
}

// query per estrarre dati social del cliente
$db->query("SELECT * FROM hospitality_social WHERE idsito = '".IDSITO."'");
$rw =  $db->row();

if($rw['Facebook']!=''){
   $Facebook   = '<a  href="'.$rw['Facebook'].'" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a>';
}
if($rw['Twitter']!=''){
  $Twitter    = '<a  href="'.$rw['Twitter'].'" target="_blank"><i class="fa fa-twitter-square fa-2x"></i></a>';
}
if($rw['GooglePlus']!=''){
  $GooglePlus    = '<a  href="'.$rw['GooglePlus'].'" target="_blank"><i class="fa fa-google-plus-square fa-2x"></i></a>';
}
if($rw['Instagram']!=''){
  $Instagram    = '<a  href="'.$rw['Instagram'].'" target="_blank"><i class="fa fa-instagram fa-2x"></i></a>';
}
if($rw['Linkedin']!=''){
  $Linkedin    = '<a  href="'.$rw['Linkedin'].'" target="_blank"><i class="fa fa-linkedin fa-2x"></i></a>' ;
}
if($rw['Pinterest']!=''){
  $Pinterest    = '<a  href="'.$rw['Pinterest'].'" target="_blank"><i class="fa fa-pinterest-square fa-2x"></i></a>' ;
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
  if($rows > count($rows)) // se la pagina richiesta non esiste
      $tot = count($rows); // restituire la pagina con il numero più alto che esista
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
    $DataRichiestaCheck = $rows['DataRichiesta'];
    $DataR_tmp          = explode("-",$rows['DataRichiesta']);
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
    //$Notti              = ceil(abs($end - $start) / 86400);
    $formato="%a";
    $Notti = DiffNotti($rows['DataArrivo'],$rows['DataPartenza'],$formato);
/*     $marzo              = mktime(24,0,0,03,01,2020);
    $marzo2             = mktime(01,0,0,03,31,2020);
    $aprile             = mktime(24,0,0,04,01,2020);
    $aprile2            = mktime(01,0,0,04,30,2020);
    if(($start >= $marzo && $start <= $marzo2) && ($end >= $aprile && $end <= $aprile2)){
        $Notti = ($Notti+1);
    }else{
        $Notti = $Notti;
    } */

    $DataI_tmp          = explode("-",$rows['DataInvio']);
    $DataInvio          = $DataI_tmp[2].'/'.$DataI_tmp[1].'/'.$DataI_tmp[0];

    $Cliente            = $Nome.' '.$Cognome;


    $mesi=array('it'=>
            array("01" => "Gennaio","02" => "Febbraio","03" => "Marzo","04" => "Aprile","05" => "Maggio","06" => "Giugno","07" => "Luglio","08" => "Agosto","09" => "Settembre","10" => "Ottobre","11" => "Novembre","12" => "Dicembre"),
            'en'=>
            array("01" => "January","02" => "February","03" => "March","04" => "April","05" => "May","06" => "June","07" => "July","08" => "August","09" => "September","10" => "October","11" => "November","12" => "December"),
            'fr'=>
            array("01" => "Janvier","02" => "Février","03" => "Mars","04" => "Avril","05" => "Mai","06" => "Juin","07" => "Juillet","08" => "Août","09" => "Septembre","10" => "Octobre","11" => "Novembre","12" => "Décembre"),
            'de'=>
            array("01" => "Januar","02" => "Februar","03" => "März","04" => "April","05" => "Mai","06" => "Juni","07" => "Juli","08" => "August","09" => "September","10" => "Oktober","11" => "November","12" => "Dezember"),
            );

    $DataArrivo_estesa   = $DataA_tmp[2].' '.$mesi[$Lingua][$DataA_tmp[1]].' '.$DataA_tmp[0];
    $DataPartenza_estesa = $DataP_tmp[2].' '.$mesi[$Lingua][$DataP_tmp[1]].' '.$DataP_tmp[0];
    $DataScadenza_estesa = $DataS_tmp[2].' '.$mesi[$Lingua][$DataS_tmp[1]].' '.$DataS_tmp[0];


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


    #GESTIONE COLORI TEMPLATE
    $sel_color = "SELECT * FROM hospitality_template_background WHERE idsito = ".IDSITO." AND TemplateType = 'custom2' LIMIT 1";
    $res_color = $db->query($sel_color);
    $rCol      = $db->row($res_color);
    $colore1   = $rCol['Background'];
    $colore2   = $rCol['Pulsante'];
    $font      = $rCol['Font'];
    switch($font){
      case "'Lato', sans-serif";
        $font_libreria = 'Lato:100,100i,300,300i,400,400i,700,700i,900,900i';
      break;
      case "'Lora', serif";
        $font_libreria = 'Lora:400,400i,700,700i"';
      break;
      case "'Open Sans', sans-serif";
        $font_libreria = 'Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i';
      break;
      case "'Playfair Display', serif";
        $font_libreria = 'Playfair+Display:400,400i,700,700i,900,900i';
      break;
      case "'Raleway', sans-serif";
        $font_libreria = 'Raleway';
      break;
      case "'Roboto', sans-serif";
        $font_libreria = 'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i';
      break;
      case "'Roboto Slab', serif";
        $font_libreria = 'Roboto+Slab:100,300,400,700';
      break;
      case "'Ubuntu', sans-serif";
        $font_libreria = 'Ubuntu:300,300i,400,400i,500,500i,700,700i';
      break;
      case "'Montserrat', sans-serif";
        $font_libreria = 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
      break;
    }
    $immagine1 = BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$rCol['Immagine'];
    $immagine2 = BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$rCol['Immagine2'];
    //
    $logo                =($Logo ==''?'<i class="fa fa-bed fa-5x fa-fw"></i>':'<img src="'.BASE_URL_ROOT.'uploads/loghi_siti/'.$Logo.'" class="logo">');
    $logotitle           = $NomeCliente;
    $intestazionemobile1 = $NomeCliente;
    $intestazionemobile2 = $Localita;
    $coloresfondo        ="#A4A4A4";//colore di sfondo della pagina

    $ownerimg            = ($ImgOp==''?'<img src="'.BASE_URL_ROOT.'img/receptionists.png">':'<img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$ImgOp.'">');//immagine del proprietario




    $q_text = $db->query("SELECT * FROM hospitality_contenuti_web WHERE TipoRichiesta = '".$TipoRichiesta."' AND Lingua = '".$Lingua."' AND idsito = ".IDSITO." AND Abilitato = 1");
    $rs = $db->row($q_text);

    $q_text_alt = $db->query("SELECT * FROM hospitality_contenuti_web_lingua WHERE IdRichiesta = '".$Id."' AND Lingua = '".$Lingua."' AND idsito = ".IDSITO."");
    $rs_alt     = $db->row($q_text_lat);
    if(is_array($rs_alt)) {
      if($rs_alt > count($rs_alt)) // se la pagina richiesta non esiste
          $tt_alt = count($rs_alt); // restituire la pagina con il numero più alto che esista
    }else{
        $tt_alt = 0;
    }
    if(($rs_alt)>0 && $rs_alt['Testo']!=''){
        $Testo         = str_replace("[cliente]",$Cliente,$rs_alt['Testo']);
    }else{
        $Testo         = str_replace("[cliente]",$Cliente,$rs['Testo']);
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

    #ETICHETTE NUOVE
    $sconto              = SCONTO;
    $condizioni_tariffa  = CONDIZIONI_TARIFFA;
    $accetto_le_politche = ACCETTO_POLITICHE;
    $leggi_politiche     = LEGGI_POLITICHE;
    $CONDIZIONI          = CONDIZIONI;
    $VISUALIZZA          = VISUALIZZA;
    $NASCONDI            = NASCONDI;
    $CONVERSAZIONE       = CONVERSAZIONE;
    $FORM                = FORM;
    $PRENOTAOFFERTA      = PRENOTA_OFFERTA;
    $MAPPA               = MAPPA;
    $eti1                = ARRIVO;
    $eti2                = PARTENZA;
    $eti3                = PERSONE;
    $eti4                = CAMERE;
    $eti5                = TRATTAMENTO;
    $eti6                = PREZZO_TOTALE;
    $eti7                = SCONTO.':';
    $eti8                = SOGGIORNO;
    $eti9                = QUANTITA;
    $eti10               = PREZZO_UNITARIO;
    $eti11               = SUBTOTALE;
    $eti12               = '<i class="fa fa-check"></i> '.PRENOTA_SUBITO;
    $eti13               = CAPARRA_RICHIESTA.':';

    #ICONE
    $eti1fa='<i class="fa fa-arrow-right fa-fw fa-2x" style="position:absolute!important;left:25px!important;transform: translateY(-50%)!important;top: 50%;!important"></i>&nbsp;';
    $eti2fa='<i class="fa fa-arrow-left fa-fw fa-2x" style="position:absolute!important;left:25px!important;transform: translateY(-50%)!important;top: 50%;!important"></i>&nbsp;';
    $eti3fa='<i class="fa fa-male fa-fw fa-2x" style="position:absolute!important;left:25px!important;transform: translateY(-50%)!important;top: 50%;!important"></i>&nbsp;';
    $eti4fa='<i class="fa fa-star fa-fw fa-2x" style="position:absolute!important;left:25px!important;transform: translateY(-50%)!important;top: 50%;!important"></i>&nbsp;';
    $eti5fa='<i class="fa fa-bell fa-fw fa-2x" style="position:absolute!important;left:25px!important;transform: translateY(-50%)!important;top: 50%;!important"></i>&nbsp;';
    $eti6fa='<i class="fa fa-euro fa-fw fa-2x" style="position:absolute!important;left:25px!important;transform: translateY(-50%)!important;top: 50%;!important"></i>&nbsp;';


#TESTO DEL MESSAGGIO
$testo_messaggio .= ALLA_CO.' '.$NomeCliente.','."\r\n";
$testo_messaggio .= CONTENUTO_MSG."\r\n";
$testo_saluti.= CORDIALMENTE."\r\n";
$testo_saluti .= $Cliente;



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
            WHERE hospitality_proposte.id_richiesta = ".$Id."");
    $rec = $db->result();
    //print_r($rec);

$NomeProposta         = '';
$TestoProposta        = '';
$CheckProposta        = '';
$TipoCamere           = '';
$PrezzoL              = '';
$PrezzoP              = '';
$PrezzoPC             = '';
$sistemazione         = '';
$percentuale_sconto   = '';
$AccontoPercentuale   = '';
$AccontoImporto       = '';
$AccontoTariffa       = '';
$AccontoTesto         = '';
$valore               = '';
$servizi              = '';
$Servizi              = '';
$services             = '';
$id_servizio          = '';
$camere               = '';
$FCamere              = '';
$proposta_titolo      = '';
$proposta_specchietto = '';
$proposta_camera      = '';
$proposta_conteggio   = '';
$proposta_form        = '';
$Nomi_camera          = '';
$Subtotale            = '';
$totale               = '';
$Arrivo               = '';
$Partenza             = '';
$A                    = '';
$P                    = '';
$Arrivo_estesa        = '';
$Partenza_estesa      = '';
$alternative          = '';
$ANotti               = '';
$SERVIZIAGGIUNTIVI    = '';


    $n = 1;
    $EtaB = '';
    $EtaB_ = '';
    foreach ($rec as $key => $value) {

    $valore            = '';
    $servizi           = '';
    $Servizi           = '';
    $services          = '';
    $id_servizio       = '';
    $camere            = '';
    $FCamere           = '';
    $Nomi_camera       = '';
    $Arrivo            = '';
    $Partenza          = '';
    $A                 = '';
    $P                 = '';
    $Arrivo_estesa     = '';
    $Partenza_estesa   = '';
    $alternative       = '';
    $SERVIZIAGGIUNTIVI = '';


        $CheckProposta      = $value['CheckProposta'];
        $PrezzoL            = number_format($value['PrezzoL'],2,',','.');
        $PrezzoP            = number_format($value['PrezzoP'],2,',','.');
        //$ImportoSconto      = number_format(($value['PrezzoL']-$value['PrezzoP']),2,',','.');
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
        if($A!='') {
          $Astart             = mktime(24,0,0,$A_tmp[1],$A_tmp[2],$A_tmp[0]);
          $Arrivo_estesa      = $A_tmp[2].' '.$mesi[$Lingua][$A_tmp[1]].' '.$A_tmp[0];
         }
         if($P!=''){
          $Aend               = mktime(01,0,0,$P_tmp[1],$P_tmp[2],$P_tmp[0]);
          $Partenza_estesa    = $P_tmp[2].' '.$mesi[$Lingua][$P_tmp[1]].' '.$P_tmp[0];
         }
        //$ANotti             = ceil(abs($Aend - $Astart) / 86400);
        $formato="%a";
        $ANotti = DiffNotti($value['Arrivo'],$value['Partenza'],$formato);
/*         $marzo              = mktime(24,0,0,03,01,2020);
        $marzo2             = mktime(01,0,0,03,31,2020);
        $aprile             = mktime(24,0,0,04,01,2020);
        $aprile2            = mktime(01,0,0,04,30,2020);
        if(($Astart >= $marzo && $Astart <= $marzo2) && ($Aend >= $aprile && $Aend <= $aprile2)){
            $ANotti = ($ANotti+1);
        }else{
            $ANotti = $ANotti;
        } */

        $marzo              = mktime(24,0,0,03,01,2020);
        $marzo2             = mktime(01,0,0,03,31,2020);
        $aprile             = mktime(24,0,0,04,01,2020);
        $aprile2            = mktime(01,0,0,04,30,2020);
        if(($Astart >= $marzo && $Astart <= $marzo2) && ($Aend >= $aprile && $Aend <= $aprile2)){
            $ANotti = ($ANotti+1);
        }else{
            $ANotti = $ANotti;
        }

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
                $x = 1;
                $Servizi     = '';
                $serv        = '';
                $servizi     = '';
                $services    = '';
                $image_room  = '';


                $proposta_camera .= ' <div class="m m-x-12 camera" id="camera'.$n.'">';

                if($NomeProposta!='' || $TestoProposta!=''){
                  $proposta_camera .='
                              <div class="m m-x-12">
                                  <div class="box3">
                                    <b>'.$NomeProposta.'</b>
                                    <p>'.nl2br($TestoProposta).'</p>
                                  </div>
                              </div>
                              <div class="ca"></div>';
                }


                $EtaB = '';
                $EtaB_ = '';
                foreach ($res2 as $ky => $val) {
                    $Servizi         = $val['Servizi'];
                    $NumeroCamere    = $val['NumeroCamere'];
                    $IdCamera        = $val['IdCamera'];
                    $TipoCamere      = $val['TipoCamere'];
                    $TitoloCamera    = $val['TitoloCamera'];
                    $TestoCamera     = $val['TestoCamera'];
                    $TipoSoggiorno   = $val['TipoSoggiorno'];
                    $TitoloSoggiorno = $val['TitoloSoggiorno'];
                    $TestoSoggiorno  = $val['TestoSoggiorno'];
                    $Subtotale       = number_format(($NumeroCamere*$val['Prezzo']),2,',','.');
                    $Prezzo          = number_format($val['Prezzo'],2,',','.');
                    $totale_tmp      = (intval($val['NumeroCamere'])* intval($val['Prezzo']));
                    $totale          = (intval($totale_tmp) + intval($totale));
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


                $FCamere .= $val['TitoloSoggiorno'].' - Nr. '.$val['NumeroCamere'].' '.$val['TipoCamere'].' - €. '.number_format($val['Prezzo'],2,',','.').' - ';

                $VAUCHERCamere .= '<p>'.$val['TitoloSoggiorno'].' <i class=\'fa fa-angle-right\'></i> Nr. '.$val['NumeroCamere'].' '.$val['TipoCamere'].' '.($DataRichiestaCheck > DATA_QUOTO_V2 ?($NumAdulti!=0?$ico_adulti:'').' '.($NumBambini!=0?$ico_bimbi:'').' '.($EtaB!=''?''.ETA.' '.$EtaB.' ':''):'').' - €. '.number_format($val['Prezzo'],2,',','.').'</p>';

                if($Servizi != ''){

                  $serv = explode(",",$Servizi);
                  $services = array();
                  foreach ($serv as $key => $value) {
                          $q = "SELECT * FROM hospitality_servizi_camere_lingua WHERE Servizio LIKE '%".addslashes($serv[$key])."%' AND idsito = ".IDSITO." ";
                          $r = $db->query($q);
                          $record = $db->row($r);
                          $id_servizio = $record['servizi_id'];

                            if($id_servizio){
                              $qy = "SELECT * FROM hospitality_servizi_camere_lingua WHERE servizi_id = ".$id_servizio." AND lingue = '".$Lingua."' ";
                              $rs = $db->query($qy);
                              $val = $db->row($rs);
                              $services[$record['servizi_id']] = $val['Servizio'];
                            }

                  }
                  //print_r($services);
                  if(!empty($services)){
                    $servizi = implode(", ",$services);
                  }

                }



                    $sel    = "SELECT Foto FROM hospitality_gallery_camera WHERE IdCamera = ".$IdCamera." AND idsito = ".IDSITO;
                    $res    = $db->query($sel);
                    $ris = $db->result($res);
                    $image_room  = '';

                    foreach ($ris as $y => $v) {

                         $image_room .='<li style="height:425px!important"><img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$v['Foto'].'" /></li>';

                    }

            if ($x > 1){
                $proposta_camera .='<div class="ca twhite" style="margin:10px!important;"></div>';
            }

           $proposta_camera .='<!--CAMERE '.$x.'-->
                                  <script>
                                        $(document).ready(function(){
                                                $("#slider'.$x.'_'.$IdCamera.'_'.$IdProposta.'").responsiveSlides({
                                                        auto: true,
                                                        pager: false,
                                                        nav: true,
                                                        namespace: "centered-btns"
                                                    });
                                        });
                                    </script>

                                      <div class="m m-x-12 riga">
                                        <div class="m m-x-6 m-xs-12  m-img">
                                          <div class="callbacks_container">
                                            <ul class="rslides" id="slider'.$x.'_'.$IdCamera.'_'.$IdProposta.'">
                                              '.$image_room.'
                                            </ul>
                                          </div>
                                        </div>
                                        <div class="m m-x-6 m-xs-12 m-x-tl t18">
                                          <div class="box3">
                                            <h4><b>'.$TitoloCamera.'</b></h4>
                                            <div class="ca20"></div>
                                            '.$TestoCamera.'<br><br>
                                            <strong>'.SERVIZI_CAMERA.'</strong><br>
                                            '.$servizi.'<br><br>
                                            <strong>'.$TitoloSoggiorno.'</strong><br>
                                            '.$TestoSoggiorno.'
                                          </div>
                                        </div>
                                      </div>';

                      $camere  .='<div class="m m-x-12 riga t16">
                                      <div class="m m-x-3">
                                        <div class="box6">
                                        <a href="javascript:;" data-toggle="tooltip" data-placement="right" id="example'.$IdCamera.'" title="'.(strlen($TestoSoggiorno)>=300?strip_tags(substr($TestoSoggiorno,0,300).' ...'):strip_tags($TestoSoggiorno)).'"><i class="fa fa-info-circle text-green" aria-hidden="true"></i></a> '.$TitoloSoggiorno.' - '.($DataRichiestaCheck > DATA_QUOTO_V2?'nr.'.$NumeroCamere:'').' '.$TitoloCamera.'</div>
                                      </div>
                                      <div class="m m-x-3 m-x-tc">
                                        <div class="box6">'.($DataRichiestaCheck > DATA_QUOTO_V2 ?'<span data-toggle="tooltip" data-placement="right" data-html="true" title="'.($NumAdulti!=0?ADULTI.' <b>'.$NumAdulti.'</b>':'').' <br>'.($NumBambini!=0?BAMBINI.' <b>' .$NumBambini.'</b>':'').'">'.($NumAdulti!=0?$ico_adulti:'').' '.($NumBambini!=0?$ico_bimbi:'').' '.($EtaB!=''?''.ETA.' '.$EtaB.'':'').'</span>':'').'</div>
                                      </div>
                                      <div class="m m-x-3 m-x-tc">
                                        <div class="box6">'.($DataRichiestaCheck > DATA_QUOTO_V2?($ANotti!=''?$ANotti:$Notti):$NumeroCamere) .'</div>
                                      </div>
                                      <div class="m m-x-3 m-x-tr">
                                        <div class="box6"><i class="fa fa-euro"></i> '.$Prezzo .'</div>
                                      </div>
                                    </div>';



            $Nomi_camera .= $TitoloCamera.'<br>';

    $x++;

    }
    $EtaB = '';
    $EtaB_ = '';
            $proposta_camera .= '</div>';

            $FCamere = substr($FCamere,0,-2);


    if($TipoRichiesta == 'Preventivo') {

        $valore = ucfirst(strtolower(ARRIVO)).' '.$DataArrivo.' - '.ucfirst(strtolower(PARTENZA)).' '.$DataPartenza.' - '.$FCamere .'  -  '.ADULTI.' '.$NumeroAdulti.' '.($NumeroBambini!='0'?' - '.BAMBINI.' '.$NumeroBambini:'').'  - Totale €. '.$PrezzoP;

    }


  $proposta_titolo .= ' <div class="m m-eqtab tab2019" id="tab'.$n.'" proposta="'.$n.'">
                          <titolo>'.($TipoRichiesta == 'Preventivo'?PROPOSTA:SOLUZIONECONFERMATA).' '.$n.'</titolo>
                          <prezzo><i class="fa fa-euro"></i> '.$PrezzoP.'</prezzo>
                        </div>';
  $proposta_specchietto .='<div class="m m-x-4 contenitore" id="contenitore'.$n.'">';

  if($A != '' && $P != '' && $A != '0000-00-00' && $P != '0000-00-00'){

    if($TipoRichiesta=='Preventivo'){
      if($DataArrivo != $Arrivo || $DataPartenza != $Partenza){
        $proposta_specchietto .='<linea class="twhite">'.$eti1fa.' '.ARRIVO.' ('.strtoupper(DATEALTERNATIVE).')<div class="w300 t18">'.$Arrivo_estesa.'</div></linea>
                                  <linea class="twhite">'.$eti1fa.' '.PARTENZA.' ('.strtoupper(DATEALTERNATIVE).')<div class="w300 t18">'.$Partenza_estesa.'</div></linea>';
      }
    }elseif($TipoRichiesta=='Conferma'){
        if($DataArrivo != $Arrivo ){
            $DataArrivo_estesa   = $Arrivo_estesa;
            $Notti = $ANotti;
        }
        if($DataPartenza != $Partenza){
            $DataPartenza_estesa   = $Partenza_estesa;
            $Notti = $ANotti;
        }
    }

  }
  $proposta_specchietto .='<linea class="twhite">'.$eti1fa.$eti1.'<div class="w300 t18">'.$DataArrivo_estesa.'</div></linea>
                          <linea class="twhite">'.$eti2fa.$eti2.'<div class="w300 t18">'.$DataPartenza_estesa.'</div></linea>
                          <linea class="twhite">'.$eti3fa.$eti3.'<div class="w300 t18">'.ADULTI.' '.$NumeroAdulti .' '.($NumeroBambini!='0'?' - '.BAMBINI.' '.$NumeroBambini .' '.($EtaBambini1!='' && $EtaBambini1!='0'?'<br>'.$EtaBambini1.' '.ANNI.' ':'').($EtaBambini2!='' && $EtaBambini2!='0'?' - '.$EtaBambini2.' '.ANNI.' ':'').($EtaBambini3!='' && $EtaBambini3!='0'?' - '.$EtaBambini3.' '.ANNI.' ':'').($EtaBambini4!='' && $EtaBambini4!='0'?' - '.$EtaBambini4.' '.ANNI.' ':'').($EtaBambini5!='' && $EtaBambini5!='0'?' - '.$EtaBambini5.' '.ANNI.' ':'').($EtaBambini6!='' && $EtaBambini6!='0'?' - '.$EtaBambini6.' '.ANNI.' ':'').' '.($EtaB!=''?''.ETA.': '.$EtaB.'':''):'').'<br>'.NOTTI.' '.($DataRichiestaCheck > DATA_QUOTO_V2?($ANotti!=''?$ANotti:$Notti):$Notti).'</div></linea>
                          <linea class="twhite">'.$eti4fa.$eti4.'<div class="w300 t18">'.$Nomi_camera.'</div></linea>
                          <linea class="twhite">'.$eti5fa.$eti5.'<div class="w300 t18">'.$TitoloSoggiorno.'</div></linea>
                          <linea class="twhite">'.$eti6fa.$eti6.'<div class="w300 t12">'.SCADENZA.' '.$DataScadenza_estesa.'</div>
                            <totale>'.(($PrezzoL!='0,00' || $PrezzoL > $PrezzoP)?$PrezzoL:'').'</totale>
                            <sconto>'.(($PrezzoL!='0,00')?' '.$sconto.' '.$percentuale_sconto.' %':'').'</sconto>
                            <newtotale>'.$PrezzoP.'</newtotale>
                          </linea>';
if($TipoRichiesta == 'Preventivo'){
  //$proposta_specchietto .='<div class="pulsante" section="preno" propostaid="'.$n.'">'.$eti12 .'</div>';
}
  $proposta_specchietto .= '</div>';

  if($A != '' && $P != '' && $A != '0000-00-00' && $P != '0000-00-00'){

      if($TipoRichiesta=='Preventivo'){
        if($DataArrivo != $Arrivo || $DataPartenza != $Partenza){
          $alternative = ucfirst(strtolower(ARRIVO.' '.DATEALTERNATIVE)).' '.$Arrivo.' - '.ucfirst(strtolower(PARTENZA.' '.DATEALTERNATIVE)).' '.$Partenza.' - ';
        }
      }elseif($TipoRichiesta=='Conferma'){
          if($DataArrivo != $Arrivo ){
              $DataArrivo_estesa   = $Arrivo_estesa;
              $Notti = $ANotti;
          }
          if($DataPartenza != $Partenza){
              $DataPartenza_estesa   = $Partenza_estesa;
              $Notti = $ANotti;
          }
      }

  }
  $proposta_form .='   <div class="m m-x-12 fproposta twhite" id="fproposta'.$n.'" propostaid="'.$n.'" idprop="'. $IdProposta .'" propostatitolo="'.$alternative.$valore.'">
                        <i class="fa fa-circle"></i>
                        <i class="fa fa-check-circle"></i>
                        <div class="m m-x-12 riga titolo">'.PROPOSTA.' '.$n.'</div>
                        <div class="m m-x-12 specchietto">';
  if($A != '' && $P != '' && $A != '0000-00-00' && $P != '0000-00-00'){
    if($DataArrivo != $Arrivo || $DataPartenza != $Partenza){
      $proposta_form .='<linea class="twhite">'.$eti1fa.' '.ARRIVO.' ('.strtoupper(DATEALTERNATIVE).')<div class="w300 t18">'.$Arrivo_estesa.'</div></linea>
                                <linea class="twhite">'.$eti1fa.' '.PARTENZA.' ('.strtoupper(DATEALTERNATIVE).')<div class="w300 t18">'.$Partenza_estesa.'</div></linea>';
    }

  }
  $proposta_form .='     <linea class="twhite">'.$eti1fa.$eti1.'<div class="w300 t18">'.$DataArrivo_estesa.'</div></linea>
                          <linea class="twhite">'.$eti2fa.$eti2.'<div class="w300 t18">'.$DataPartenza_estesa.'</div></linea>
                          <linea class="twhite">'.$eti3fa.$eti3.'<div class="w300 t18">'.ADULTI.' '.$NumeroAdulti .' '.($NumeroBambini!='0'?' - '.BAMBINI.' '.$NumeroBambini .' '.($EtaBambini1!='' && $EtaBambini1!='0'?'<br>'.$EtaBambini1.' '.ANNI.' ':'').($EtaBambini2!='' && $EtaBambini2!='0'?' - '.$EtaBambini2.' '.ANNI.' ':'').($EtaBambini3!='' && $EtaBambini3!='0'?' - '.$EtaBambini3.' '.ANNI.' ':'').($EtaBambini4!='' && $EtaBambini4!='0'?' - '.$EtaBambini4.' '.ANNI.' ':'').($EtaBambini5!='' && $EtaBambini5!='0'?' - '.$EtaBambini5.' '.ANNI.' ':'').($EtaBambini6!='' && $EtaBambini6!='0'?' - '.$EtaBambini6.' '.ANNI.' ':'').' '.($EtaB!=''?''.ETA.': '.$EtaB.'':''):'').'<br>'.NOTTI.' '.($DataRichiestaCheck > DATA_QUOTO_V2?($ANotti!=''?$ANotti:$Notti):$Notti).'</div></linea>
                          <linea class="twhite">'.$eti4fa.$eti4.'<div class="w300 t18">'.$Nomi_camera.'</div></linea>
                          <linea class="twhite">'.$eti5fa.$eti5.'<div class="w300 t18">'.$TitoloSoggiorno.'</div></linea>
                          <linea class="twhite">'.$eti6fa.$eti6.'<div class="w300 t12">'.SCADENZA.' '.$DataScadenza_estesa.'</div>
                            <totale>'.(($PrezzoL!='0,00' || $PrezzoL > $PrezzoP)?$PrezzoL:'').'</totale>
                            <sconto>'.(($PrezzoL!='0,00')?' '.$sconto.' '.$percentuale_sconto.' %':'').'</sconto>
                            <newtotale>'.$PrezzoP.'</newtotale>
                            </linea>
                        </div>
                    </div>';

if($DataArrivo_estesa == $Arrivo_estesa && $DataPartenza_estesa == $Partenza_estesa){
  $etichetteDate =  '( '.$DataArrivo_estesa.' / '.$DataPartenza_estesa.' )';
}else{
 $etichetteDate = '( '.DATEALTERNATIVE.': '.$Arrivo_estesa.' / '.$Partenza_estesa.' ) ' .$DataArrivo_estesa.' / '.$DataPartenza_estesa;
}

$proposta_conteggio .= '<!--CONTEGGIO PROPOSTE-->
                          <div class="m m-x-12 conto" id="conto'.$n.'">
                          <div class="m m-x-12 titolo bcolor twhite">
                            <div class="box4">
                              <h3>'.($TipoRichiesta == 'Preventivo'?PROPOSTA:SOLUZIONECONFERMATA).' '.$n.' '.$etichetteDate.'</h3>
                              <div class="m m-x-12 t14">'.SCADENZA.' '.$DataScadenza_estesa.'</div>
                            </div>
                          </div>
                          <div class="m m-x-12 riga t18 w300 tu">
                            <div class="m m-x-3">
                              <div class="box6">'.$eti8.'</div>
                            </div>
                            <div class="m m-x-3 m-x-tc">
                              <div class="box6">
                              '.($DataRichiestaCheck > DATA_QUOTO_V2?ucfirst(strtolower(PERSONE)):'').'</div>
                            </div>
                            <div class="m m-x-3 m-x-tc">
                              <div class="box6">'.($DataRichiestaCheck > DATA_QUOTO_V2?NOTTI:'Nr. '.CAMERA).'</div>
                            </div>
                            <div class="m m-x-3 m-x-tr">
                              <div class="box6">'.PREZZO_CAMERA.'</div>
                            </div>
                            <div class="ca"></div>
                          </div>';
$proposta_conteggio .= $camere;

if($TipoRichiesta == 'Preventivo'){

  $ck_serv = check_controllo_servizi(IDSITO);
  
  if($ck_serv == 1){

    $SERVIZIAGGIUNTIVI  = get_modifica_servizi_aggiuntivi($n,$Id,$IdProposta ,$Lingua);

  }else{

    // Query per servizi aggiuntivi
    $query  = "SELECT hospitality_tipo_servizi.*,hospitality_relazione_servizi_proposte.num_persone,hospitality_relazione_servizi_proposte.num_notti FROM hospitality_relazione_servizi_proposte
    INNER JOIN hospitality_tipo_servizi ON hospitality_relazione_servizi_proposte.servizio_id = hospitality_tipo_servizi.Id
    WHERE hospitality_tipo_servizi.idsito = ".IDSITO."
    AND hospitality_relazione_servizi_proposte.id_proposta = '".$IdProposta."'
    ORDER BY hospitality_tipo_servizi.TipoServizio ASC";
    $risultato_query = $db->query($query);
    $record          = $db->result($risultato_query);
      if(sizeof($record)>0){
        $SERVIZIAGGIUNTIVI .='<div class="ca10"></div>
                                  <style>
                                        .iconaDimension {
                                          position: relative!important;
                                          width: auto !important;
                                          height: 32px !important;
                                          top: 0px!important;
                                        }
                                        .bg-transparent{
                                            background:transparent !important;
                                            background-color:transparent !important;
                                        }
                                        .small-padding{
                                            padding:2px !important;
                                        }
                                        .no_border{
                                          border:0px!important;
                                        }
                                    </style>
        <table class="'.($_SERVER['PHP_SELF']!='/vaucher.php'?'table table-bordered no_border':'table table-responsive bg-transparent').' t16">
                        <tr>
                            <td class="no_border w300 tu" colspan="4"> '.($_SERVER['PHP_SELF']!='/vaucher.php'?'':SERVIZI_AGGIUNTIVI).'</td>
                        </tr>
                        <tr>
                                <td class="m-x-3 no_border m-x-tl t18 w300">'.SERVIZIO.'</td>
                                <td class="m-x-3 no_border m-x-tc  t18 w300 "></td>
                                <td class="m-x-3 no_border m-x-tc  t18 w300">'.CALCOLO.'</td>
                                <td class="m-x-3 no_border m-x-tr  t18 w300">'.PREZZO_SERVIZIO.'</td>

                            </tr>';
        $n_notti = '';
        foreach($record as $chiave => $campo){

            $q   = "SELECT hospitality_tipo_servizi_lingua.* FROM hospitality_tipo_servizi_lingua  WHERE hospitality_tipo_servizi_lingua.servizio_id = ".$campo['Id']." AND hospitality_tipo_servizi_lingua.idsito = ".IDSITO." AND hospitality_tipo_servizi_lingua.lingue = '".$Lingua."'";
            $r   = $db->query($q);
            $rec = $db->row($r);

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
                $CalcoloPrezzoServizio = ($campo['PrezzoServizio']!=0?'<small>('.number_format($campo['PrezzoServizio'],2,',','.').' x '.$num_notti.' <span style="font-size:80%">gg</span> x '.$campo['num_persone'].' <small>pax</small>)</small>':'('.$num_notti.'  <small>gg</small> x '.$campo['num_persone'].' <small>pax</small>)');
                $PrezzoServizio = ($campo['PrezzoServizio']!=0?'<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format(($campo['PrezzoServizio']*$num_notti*$campo['num_persone']),2,',','.'):'<small class="text-green">Gratis</small>');
              break;
            }

            if($_SERVER['PHP_SELF']!='/vaucher.php'){
              $SERVIZIAGGIUNTIVI .='<tr class="riga">
                                    <td class="m-x-3 no_border m-x-tl"><img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$campo['Icona'].'" class="iconaDimension pad-left"> &nbsp;&nbsp;'.$rec['Servizio'].'</td>
                                    <td class="m-x-3 no_border m-x-tc">'.($rec['Descrizione']!=''?'<a href="javascript:;" data-toggle="tooltip" title="'.(strlen($rec['Descrizione'])<=300?stripslashes(strip_tags($rec['Descrizione'])):substr(stripslashes(strip_tags($rec['Descrizione'])),0,300).'...').'"><i class="fa fa-info-circle text-green" aria-hidden="true"></i></a>':'').' </td>
                                    <td class="m-x-3 no_border m-x-tc">'.$calcoloprezzo.' '.$CalcoloPrezzoServizio.'</td>
                                    <td class="m-x-3 no_border m-x-tr">'.$PrezzoServizio.'</td>

                                </tr>';
            }else{
              $SERVIZIAGGIUNTIVI .='<tr>
                                      <td class="no_border text-center small-padding"><img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$campo['Icona'].'" class="iconaDimension"></td>
                                      <td class="no_border text-left small-padding">'.$rec['Servizio'].'</td>
                                      <td class="no_border text-left small-padding">'.$calcoloprezzo.' '.$CalcoloPrezzoServizio.'</td>
                                      <td class="no_border text-left small-padding">'.$PrezzoServizio.'</td>

                                  </tr>';
            }


        }
        $SERVIZIAGGIUNTIVI .='</table>';
      }
  }

}else{
 // Query per servizi aggiuntivi
 $query  = "SELECT hospitality_tipo_servizi.*,hospitality_relazione_servizi_proposte.num_persone,hospitality_relazione_servizi_proposte.num_notti FROM hospitality_relazione_servizi_proposte
 INNER JOIN hospitality_tipo_servizi ON hospitality_relazione_servizi_proposte.servizio_id = hospitality_tipo_servizi.Id
 WHERE hospitality_tipo_servizi.idsito = ".IDSITO."
 AND hospitality_relazione_servizi_proposte.id_proposta = '".$IdProposta."'
 ORDER BY hospitality_tipo_servizi.TipoServizio ASC";
$risultato_query = $db->query($query);
$record          = $db->result($risultato_query);
  if(sizeof($record)>0){
    $SERVIZIAGGIUNTIVI .='<div class="ca10"></div>
                              <style>
                                    .iconaDimension {
                                      position: relative!important;
                                      width: auto !important;
                                      height: 32px !important;
                                      top: 0px!important;
                                    }
                                    .bg-transparent{
                                        background:transparent !important;
                                        background-color:transparent !important;
                                    }
                                    .small-padding{
                                        padding:2px !important;
                                    }
                                    .no_border{
                                      border:0px!important;
                                    }
                                </style>
    <table class="'.($_SERVER['PHP_SELF']!='/vaucher.php'?'table table-bordered no_border':'table table-responsive bg-transparent').' t16">
                    <tr>
                        <td class="no_border w300 tu" colspan="4"> '.($_SERVER['PHP_SELF']!='/vaucher.php'?'':SERVIZI_AGGIUNTIVI).'</td>
                    </tr>
                    <tr>
                            <td class="m-x-3 no_border m-x-tl t18 w300">'.SERVIZIO.'</td>
                            <td class="m-x-3 no_border m-x-tc  t18 w300 "></td>
                            <td class="m-x-3 no_border m-x-tc  t18 w300">'.CALCOLO.'</td>
                            <td class="m-x-3 no_border m-x-tr  t18 w300">'.PREZZO_SERVIZIO.'</td>

                        </tr>';
    $n_notti = '';
    foreach($record as $chiave => $campo){

        $q   = "SELECT hospitality_tipo_servizi_lingua.* FROM hospitality_tipo_servizi_lingua  WHERE hospitality_tipo_servizi_lingua.servizio_id = ".$campo['Id']." AND hospitality_tipo_servizi_lingua.idsito = ".IDSITO." AND hospitality_tipo_servizi_lingua.lingue = '".$Lingua."'";
        $r   = $db->query($q);
        $rec = $db->row($r);

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
            $CalcoloPrezzoServizio = ($campo['PrezzoServizio']!=0?'<small>('.number_format($campo['PrezzoServizio'],2,',','.').' x '.$num_notti.' <span style="font-size:80%">gg</span> x '.$campo['num_persone'].' <small>pax</small>)</small>':'('.$num_notti.'  <small>gg</small> x '.$campo['num_persone'].' <small>pax</small>)');
            $PrezzoServizio = ($campo['PrezzoServizio']!=0?'<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format(($campo['PrezzoServizio']*$num_notti*$campo['num_persone']),2,',','.'):'<small class="text-green">Gratis</small>');
          break;
        }

        if($_SERVER['PHP_SELF']!='/vaucher.php'){
          $SERVIZIAGGIUNTIVI .='<tr class="riga">
                                <td class="m-x-3 no_border m-x-tl"><img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$campo['Icona'].'" class="iconaDimension pad-left"> &nbsp;&nbsp;'.$rec['Servizio'].'</td>
                                <td class="m-x-3 no_border m-x-tc">'.($rec['Descrizione']!=''?'<a href="javascript:;" data-toggle="tooltip" title="'.(strlen($rec['Descrizione'])<=300?stripslashes(strip_tags($rec['Descrizione'])):substr(stripslashes(strip_tags($rec['Descrizione'])),0,300).'...').'"><i class="fa fa-info-circle text-green" aria-hidden="true"></i></a>':'').' </td>
                                <td class="m-x-3 no_border m-x-tc">'.$calcoloprezzo.' '.$CalcoloPrezzoServizio.'</td>
                                <td class="m-x-3 no_border m-x-tr">'.$PrezzoServizio.'</td>

                            </tr>';
        }else{
          $SERVIZIAGGIUNTIVI .='<tr>
                                  <td class="no_border text-center small-padding"><img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$campo['Icona'].'" class="iconaDimension"></td>
                                  <td class="no_border text-left small-padding">'.$rec['Servizio'].'</td>
                                  <td class="no_border text-left small-padding">'.$calcoloprezzo.' '.$CalcoloPrezzoServizio.'</td>
                                  <td class="no_border text-left small-padding">'.$PrezzoServizio.'</td>

                              </tr>';
        }


    }
    $SERVIZIAGGIUNTIVI .='</table>';
  }
}
$proposta_conteggio .= $SERVIZIAGGIUNTIVI;

if(($PrezzoL!='0,00' || $PrezzoL > $PrezzoP)){
  $proposta_conteggio .='<div class="m m-x-12 riga t16">
                              <div class="m m-x-3">
                                <div class="box6">'.$sconto.'</div>
                              </div>
                              <div class="m m-x-3 m-x-tc">
                                <div class="box6">1</div>
                              </div>
                              <div class="m m-x-3 m-x-tc">
                                <div class="box6">'.$percentuale_sconto.' %</div>
                              </div>
                              <div class="m m-x-3 m-x-tr">
                                <div class="box6">- <i class="fa fa-euro"></i> '.$ImportoSconto .'</div>
                              </div>
                            </div>';
}
$proposta_conteggio .='  <div class="ca1 bcolor"></div>
                          <div class="m m-x-12 totale">
                            <div class="m m-x-6">
                              <div class="box6">'.$eti6.'</div>
                            </div>
                            <div class="m m-x-6 m-x-tr">
                              <div class="box6">
                                <div class="tcolor t30 w700"><i class="fa fa-euro"></i> '.number_format($PrezzoPC,2,',','.').'</div>
                                <!--<div class="tcolor t14 w700">'.$DataScadenza_estesa.'</div>-->
                                <div class="ca10"></div>';
  if($TipoRichiesta == 'Preventivo'){
     $proposta_conteggio .='    <div class="pulsante" section="preno" propostaid="'.$n.'">'.$eti12.'</div>';
  }
     $proposta_conteggio .=' <div class="ca10"></div>';
  if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
      $proposta_conteggio .='<div class="t20">'.CAPARRA.' <span class="tcolor w700">'.$AccontoPercentuale.' %  &nbsp;&nbsp; <i class="fa fa-euro"></i> '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</span></div>';
  }
  if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
      if($AccontoImporto >= 1){
          $proposta_conteggio .='<div class="t20">'.CAPARRA.' <span class="tcolor w700"><i class="fa fa-euro"></i> '.number_format($AccontoImporto,2,',','.').'</span></div>';
      }else{
          $proposta_conteggio .= '<div class="t20">'.CARTACREDITOGARANZIA.'</div>';
      }
  }
      $proposta_conteggio .=' </div>
                            </div>
                          </div>';

        if($AccontoTariffa!='' || $AccontoTesto!=''){

            $proposta_conteggio .= '<div class="m m-x-12 bcolor3 t15">
                                    <div class="box5">
                                      <p><span id="tarif'.$n.'" style="cursor:pointer"><i class="fa fa-question-circle" aria-hidden="true"></i> '.($AccontoTariffa!=''?$AccontoTariffa:$condizioni_tariffa).'</span>
                                      <br />
                                        <div id="cond_tarif'.$n.'" style="display:none">
                                             '.nl2br($AccontoTesto).'
                                        </div>
                                      </p>
                                    </div>
                                </div>
                                <script>
                                    $( "#tarif'.$n.'" ).click(function() {
                                      $( "#cond_tarif'.$n.'" ).toggle( "slow", function() {
                                        // Animation complete.
                                      });
                                    });
                                </script>';

      }

      $proposta_conteggio .='</div>';

    $n++;

}//fine ciclo

}//fine if se esiste id richiesta

    $q_Gallery  = "SELECT Id FROM hospitality_tipo_gallery WHERE TargetType = 'custom2' AND idsito = ".IDSITO." AND Abilitato = 1 ";
    $qy_Gallery = $db->query($q_Gallery);
    $rec = $db->row($qy_Gallery);

    $q_car  = "SELECT * FROM hospitality_tipo_gallery_target WHERE IdTipoGallery = ".$rec['Id']." AND idsito = ".IDSITO." AND Abilitato = 1 ORDER BY rand() LIMIT 12";
    $qy_carosello = $db->query($q_car);
    $r = $db->result($qy_carosello);
    $n = 1;
      foreach($r as $pg =>$rs){
      $carosello .='<img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$rs['Immagine'].'" onclick="openModal();currentSlide('.$n.')" class="hover-shadow img-responsive img_gallery">';
        $slide .='     <div class="mySlides">
                            <div class="numbertext">'.$n.' / '.sizeof($r).'</div>
                            <img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$rs['Immagine'].'" style="width:100%">
                          </div>';
       $n++;
      }
         $carosello .= '<div id="myModal" class="modal">
                        <span class="closex cursor" onclick="closeModal()">&times;</span>
                        <div class="modal-content">';


          $carosello .= $slide;

        $carosello .='    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                          <a class="next" onclick="plusSlides(1)">&#10095;</a>

                          <div class="caption-container">
                            <p id="caption"></p>
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

    $Eventi .= '<div class="m m-x-4 m-s-6 m-xs-12">
                <div class="box5">
                  <div class="m m-x-12">
                      <img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$rec['Immagine'].'" width="100%" class="mbr">
                  </div>
                  <div class="ca10"></div>
                  <div class="m m-x-12">
                      <div class="bcolor3 mbr">
                       <div class="box5 LineHeight18 h200 scroll" style="height:240px!important;overflow:auto!important">
                          <h4>'.$rec['Titolo'].'</h4>
                          <p>'.$rec['Descrizione'].'</p>
                          <p>
                          <i class="fa fa-fw fa-calendar"></i> Dal '.$DataInizio.' <i class="fa fa-fw fa-calendar"></i> al '.$DataFine.'<br>
                           '.($rec['Indirizzo']!=''?'<i class="fa fa-fw fa-address-card"></i> '.$rec['Indirizzo'].', '.$NomeCliente:'').'  '.($lat!='0'?' a '.$distanceE:'').'
                           '.($lat!='0'?'<i class="fa fa-fw fa-map-marker"></i> <span id="open_map'.$rec['Id'].'" onclick="document.getElementById(\'frame_lp\').src = \''.BASE_URL_SITO.'include/controller/gmap.php?from_lati='.$lat.'&from_long='.$lon.'&travelmode=DRIVING&idsito='.$IdSito.'\'; document.location.href=\'#start_map\'; return false" style="cursor:pointer">'.VISUALIZZA_MAPPA.'</span>':'').'
                          </p>
                      </div>
                    </div>
                  </div>
                <script>
                    $("#open_map'.$rec['Id'].'").click(function(){
                        $("#b_map").removeAttr("style");
                    });
                </script>
              </div>
            </div> ';

    }
$distanceE = '';
$distanzaE  = '';



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


    $PuntidiInteresse .= '<div class="m m-x-4 m-s-6 m-xs-12 ">
                            <div class="box5">
                                <div class="m m-x-12">
                                    <img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$rws['Immagine'].'" width="100%"  class="mbr" >
                                </div>
                                <div class="ca10"></div>
                                  <div class="m m-x-12 ">
                                      <div class="bcolor3 mbr">
                                      <div class="box5 LineHeight18 h200 scroll" style="height:240px!important;overflow:auto!important">
                                          <h4>'.$rws['Titolo'].'</h4>
                                          <p>'.$rws['Descrizione'].'</p>
                                          <p>
                                              '.($rws['Indirizzo']!=''?'<i class="fa fa-fw fa-address-card"></i> '.$rws['Indirizzo'].', '.$NomeCliente:'').'  '.($lati!='0'?' a '.$distance:'').'
                                              '.($lati!='0'?'<i class="fa fa-fw fa-map-marker"></i> <span id="open_map_pdi'.$rws['Id'].'" onclick="document.getElementById(\'frame_lp_pdi\').src = \''.BASE_URL_SITO.'include/controller/gmap.php?from_lati='.$lati.'&from_long='.$longi.'&travelmode=DRIVING&idsito='.$IdSito.'\'; document.location.href=\'#start_map_pdi\'; return false" style="cursor:pointer">'.VISUALIZZA_MAPPA.'</span>':'').'
                                          </p>
                                        </div>
                                      </div>
                                  </div>
                              <script>
                                  $("#open_map_pdi'.$rws['Id'].'").click(function(){
                                      $("#b_map_pdi").removeAttr("style");
                                  });
                              </script>
                              </div>
                         </div>   ';



    }
    $distance = '';
    $distanza = '';



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
      $tt = count($info); // restituire la pagina con il numero più alto che esista
}else{
  $tt = 0;
}
if(($tt)>0){
  $infohotel      = $info['Titolo'];
  $infohotelTesto = $info['Descrizione'];
}
if($tot > 0){ // esite almeno un preventivo inserito
    #PCONDIZIONI GENERALI E POLITICHE DI CANCELLAZIONE
    $sel_cg = "SELECT * FROM hospitality_politiche_lingua WHERE idsito = ".IDSITO." AND id_politiche = ".$id_politiche." AND Lingua = '".$Lingua."' ORDER BY id DESC";
    $re_cg  = $db->query($sel_cg);
    $rw     = $db->row($re_cg);
    $condizioni_generali = $rw['testo'];
}

#### VAGLIA ####
$vp = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito= ".IDSITO." AND Abilitato = 1  AND TipoPagamento = 'Vaglia Postale'";
$res_vp = $db->query($vp);
$row_vp = $db->row($res_vp);
if(is_array($row_vp)) {
  if($row_vp > count($row_vp)) // se la pagina richiesta non esiste
      $tt_vp = count($row_vp); // restituire la pagina con il numero più alto che esista
}else{
  $tt_vp = 0;
}
if(($tt_vp) > 0){

  $OrdineVP = $row_vp['Ordine'];

  $v = "SELECT * FROM hospitality_tipo_pagamenti_lingua WHERE idsito= ".IDSITO." AND pagamenti_id = ".$row_vp['Id']." AND lingue = '".$Lingua."'";
  $res_v = $db->query($v);
  $row_v = $db->row($res_v);
  $Pagamento_vp = $row_v['Pagamento'];
  $Descrizione_vp = $row_v['Descrizione'];

    $vaglia_posta .= ' <div class="ca20"></div>
                          <hr>
                            <h3 class="w400">'.$Pagamento_vp.'</h3>
                            <div class="ca10"></div>
                              <span class="t16">'.$Descrizione_vp.'</span><br><br>
                              <div class="t30">';

                                  if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                                       $vaglia_posta .= '<b>'.ACCONTO.'</b>: '.$AccontoRichiesta.' %  - <b class="t40 tcolor">€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b><br><br>';
                                  }
                                  if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                                       $vaglia_posta .= '<b>'.ACCONTO.'</b>: '.$AccontoPercentuale.' %  - <b class="t40 tcolor">€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b><br><br>';
                                  }
                                  if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                                       $vaglia_posta .= '<b>'.ACCONTO.'</b>:  <b class="t40 tcolor">€. '.number_format($AccontoLibero,2,',','.').'</b><br><br>';
                                  }
                                  if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                                       $vaglia_posta .= '<b>'.ACCONTO.'</b>:  <b class="t40 tcolor">€. '.number_format($AccontoImporto,2,',','.').'</b><br><br>';
                                  }

    $vaglia_posta .= '  </div>
                              <div id="response_vp"></div>
                              <form  method="POST" id="form_vaglia" name="form_vaglia">
                                    <input type="hidden" name="id_richiesta" value="'.$Id.'">
                                    <input type="hidden" name="idsito" value="'.$IdSito.'">
                                    <input type="hidden" name="TipoPagamento" value="Vaglia Postale">
                                    <input type="hidden" name="action" value="add_payment">
                                    <input name="vg_policy" id="vg_policy" type="radio" value="1" required oninvalid="this.setCustomValidity(\'Questo campo è obbligatorio\')" onchange="this.setCustomValidity(\'\')">
                                    <label for="vg_policy" class="t14">'.$accetto_le_politche.'(<a href="javascript:;" id="sblocca_politich_vp">'.$leggi_politiche.'</a>)</label>
                                    <div class="ca10"></div>
                                    <div id="politiche_vp" style="display:none">
                                        <div class="t14">'.$rw['testo'].'</div>
                                     </div>
                                       <script>
                                          $(document).ready(function() {
                                                $("#sblocca_politich_vp").click(function(){
                                                    $( "#politiche_vp" ).toggle();
                                                });
                                            });
                                      </script>
                                    <div class="ca20"></div>
                                    <button type="button" class="pulsante" id="bottone_bonifico" >'.SCELGO_VAGLIA.'</button>
                              </form>
                            <div class="ca10"></div>';


}
#### BONIFICO ####
$bn = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito= ".IDSITO." AND Abilitato = 1  AND TipoPagamento = 'Bonifico Bancario'";
$res_bn = $db->query($bn);
$row_bn = $db->row($res_bn);
if(is_array($row_bn)) {
  if($row_bn > count($row_bn)) // se la pagina richiesta non esiste
      $tt_bn = count($row_bn); // restituire la pagina con il numero più alto che esista
}else{
  $tt_bn = 0;
}
if(($tt_bn) > 0){

  $OrdineBN = $row_bn['Ordine'];

  $b = "SELECT * FROM hospitality_tipo_pagamenti_lingua WHERE idsito= ".IDSITO." AND pagamenti_id = ".$row_bn['Id']." AND lingue = '".$Lingua."'";
  $res_b = $db->query($b);
  $row_b = $db->row($res_b);
  $Pagamento_bn = $row_b['Pagamento'];
  $Descrizione_bn = $row_b['Descrizione'];


   $bonifico_bancario .= '<div class="ca20"></div>
                            <hr>
                            <h3 class="w400">'.$Pagamento_bn.'</h3>
                            <div class="ca10"></div>
                              <span class="t16">'.$Descrizione_bn.'</span><br><br>
                              <div class="t30">';

                                  if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                                      $bonifico_bancario .= '<b>'.ACCONTO.'</b>: '.$AccontoRichiesta.' %  - <b class="t40 tcolor">€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b><br><br>';
                                  }
                                  if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                                      $bonifico_bancario .= '<b>'.ACCONTO.'</b>: '.$AccontoPercentuale.' %  - <b class="t40 tcolor">€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b><br><br>';
                                  }
                                  if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                                      $bonifico_bancario .= '<b>'.ACCONTO.'</b>:  <b class="t40 tcolor">€. '.number_format($AccontoLibero,2,',','.').'</b><br><br>';
                                  }
                                  if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                                      $bonifico_bancario .= '<b>'.ACCONTO.'</b>:  <b class="t40 tcolor">€. '.number_format($AccontoImporto,2,',','.').'</b><br><br>';
                                  }

    $bonifico_bancario .= '  </div>
                              <div id="response_bf"></div>
                              <form  method="POST" id="form_bonifico" name="form_bonifico">
                                    <input type="hidden" name="id_richiesta" value="'.$Id.'">
                                    <input type="hidden" name="idsito" value="'.$IdSito.'">
                                    <input type="hidden" name="TipoPagamento" value="Bonifico">
                                    <input type="hidden" name="action" value="add_payment">
                                    <input name="bf_policy" id="bf_policy" type="radio" value="1" required oninvalid="this.setCustomValidity(\'Questo campo è obbligatorio\')" onchange="this.setCustomValidity(\'\')">
                                    <label for="bf_policy" class="t14">'.$accetto_le_politche.' (<a href="javascript:;" id="sblocca_politich_bf">'.$leggi_politiche.'</a>)</label>
                                    <div class="ca10"></div>
                                    <div id="politiche_bf" style="display:none">
                                        <div class="t14">'.$rw['testo'].'</div>
                                     </div>
                                       <script>
                                          $(document).ready(function() {
                                                $("#sblocca_politich_bf").click(function(){
                                                    $( "#politiche_bf" ).toggle();
                                                });
                                            });
                                      </script>
                                    <div class="ca20"></div>
                                    <button type="button" class="pulsante" id="bottone_bonifico" >'.SCELGO_BONIFICO.'</button>
                              </form>

                            <div class="ca10"></div>';

}
#### CARTA DI CREDITO####
$cc = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito= ".IDSITO." AND Abilitato = 1  AND TipoPagamento = 'Carta di Credito'";
$res_cc = $db->query($cc);
$row_cc = $db->row($res_cc);
if(is_array($row_cc)) {
  if($row_cc > count($row_cc)) // se la pagina richiesta non esiste
      $tt_cc = count($row_cc); // restituire la pagina con il numero più alto che esista
}else{
  $tt_cc = 0;
}
if(($tt_cc) > 0){

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


    $carte_credito .= ' <div class="ca20"></div>
                            <hr>
                            <h3 class="w400">'.$Pagamento_cc.'</h3>
                            <div class="ca10"></div>
                             <span class="t16">'.$Descrizione_cc.'</span>
                             <div class="ca20"></div>
                             <div class="t30">';

                                  if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                                      $carte_credito .= '<b>'.ACCONTO.'</b>: '.$AccontoRichiesta.' %  - <b class="t40 tcolor">€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b><br><br>';
                                  }
                                  if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                                      $carte_credito .= '<b>'.ACCONTO.'</b>: '.$AccontoPercentuale.' %  - <b class="t40 tcolor">€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b><br><br>';
                                  }
                                  if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                                      $carte_credito .= '<b>'.ACCONTO.'</b>:  <b class="t40 tcolor">€. '.number_format($AccontoLibero,2,',','.').'</b><br><br>';
                                  }
                                  if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                                    if($AccontoImporto >= 1) {
                                        $carte_credito .= '<b>'.ACCONTO.'</b>:  <b class="t40 tcolor">€. '.number_format($AccontoImporto,2,',','.').'</b><br><br>';
                                    }else{
                                        $carte_credito .= '<b>'.CARTACREDITOGARANZIA.'</b><br><br>';
                                    }

                                  }

    $carte_credito .= '  </div>';
    $carte_credito .= ($amex==1?'<i class="fa fa-cc-amex fa-4x fa-fw text-aqua"></i>':'');
    $carte_credito .= ($diners==1?'<i class="fa fa-cc-diners-club fa-4x fa-fw text-light-blue"></i>':'');
    $carte_credito .= ($mastercard==1?'<i class="fa fa-cc-mastercard fa-4x fa-fw text-orange"></i>&nbsp;':'');
    $carte_credito .= ($visa==1?'<i class="fa fa-cc-visa fa-4x fa-fw text-blue"></i>':'');

    $carte_credito .= ' <br><br>
                              <div id="response_cc"></div>
                              <div class="m m-x-6 m-m-12 m-s-12 m-s-ha">
                                <form  method="POST" id="form_cc" name="form_cc">
                                  <div class="form-g">
                                    <label for="cc-number" class="">'.N_CARTA.'<small class="text-muted text-orange">[<span class="cc-brand"></span>]</small></label>
                                   <input name="nomecartacc" type="hidden" id="nomecartacc">
                                    <input name="cc_number" id="cc-number" type="tel" class="input-lg  cc-number err_cc" autocomplete="cc-number" placeholder="•••• •••• •••• ••••" required>
                                  </div>
                                  <div class="form-g">
                                    <label for="cc-exp" class="">'.SCADENZA.'</label>
                                    <input name="cc_expiration" id="cc-exp" type="tel" class="input-lg  cc-exp err_cc" autocomplete="cc-exp" placeholder="•• / ••" required>
                                  </div>
                                  <div class="form-g">
                                    <label for="cc-cvc" class="">'.CODICE.'</label>
                                    <input name="cc_codice" id="cc-cvc" type="tel" class="input-lg  cc-cvc err_cc" autocomplete="off" placeholder="•••" required>
                                  </div>
                                  <div class="form-g">
                                    <label for="numeric" class="">'.INTESTATARIO.'</label>
                                    <input name="cc_intestatario" id="numeric" type="text" class="input-lg " required>
                                  </div>
                                  <div class="ca10"></div>
                                  <div class="form-g text14">
                                    <input name="cc_policy" id="cc_policy" type="radio" value="1" required>
                                     <label for="cc_policy" class="">'.ACCONSENTI_PRIVACY_POLICY.'</label>
                                     <div class="ca10"></div>
                                     <div id="politiche" style="display:none">
                                        <div class="t14">'.$rw['testo'].'</div>
                                     </div>
                                       <script>
                                          $(document).ready(function() {
                                                $("#sblocca_politiche").click(function(){
                                                    $( "#politiche" ).toggle();
                                                });
                                            });
                                      </script>
                                  </div>
                                  <div class="ca10"></div>
                                    <input type="hidden" name="id_richiesta" value="'.$Id.'">
                                    <input type="hidden" name="idsito" value="'.$IdSito.'">
                                    <input type="hidden" name="action" value="add_carta">
                                    <button type="button" class="pulsante" id="bottone_cc" disabled>'.SALVA_CARTA_CREDITO.'</button>
                                    <div class="ca10"></div>
                                    <h3 class="validation"></h3>';

}
### PAYPAL####
$pp = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito= ".IDSITO." AND Abilitato = 1  AND TipoPagamento = 'PayPal'";
$res_pp = $db->query($pp);
$row_pp = $db->row($res_pp);
if(is_array($row_pp)) {
  if($row_pp > count($row_pp)) // se la pagina richiesta non esiste
      $tt_pp = count($row_pp); // restituire la pagina con il numero più alto che esista
}else{
  $tt_pp = 0;
}
if(($tt_pp) > 0){

  $OrdinePP    = $row_pp['Ordine'];
  $EmailPayPal = $row_pp['EmailPayPal'];

  $p = "SELECT * FROM hospitality_tipo_pagamenti_lingua WHERE idsito= ".IDSITO." AND pagamenti_id = ".$row_pp['Id']." AND lingue = '".$Lingua."'";
  $res_p = $db->query($p);
  $row_p = $db->row($res_p);
  $Pagamento_pp = $row_p['Pagamento'];
  $Descrizione_pp = $row_p['Descrizione'];

  $paypal .= '<div class="ca20"></div>
              <hr>
              <h3 class="w400">'.$Pagamento_pp.'</h3>
              <div class="ca10"></div>
                <span class="t16">'.$Descrizione_pp.'</span><br><br>
                <div class="t30">
                     <form method="post" name="paypal_form" id="paypal_form" action="#" disabled="disabled">
                        <input type="hidden" name="business" value="'.$EmailPayPal.'" />
                            <input type="hidden" name="cmd" value="_xclick" />
                            <input type="hidden" name="return" value="" />
                            <input type="hidden" name="cancel_return" value="" />
                            <input type="hidden" name="notify_url" value="" />
                            <input type="hidden" name="rm" value="2" />
                            <input type="hidden" name="currency_code" value="EUR" />
                            <input type="hidden" name="lc" value="'.strtoupper($Lingua).'" />
                            <input type="hidden" name="cs" value="0" />
                            <input type="hidden" name="item_name" value="'.OFFERTA.' nr. '.$NumeroPrenotazione.' | '.$NomeCliente.'" />
                            <input type="hidden" name="image_url" value="'.BASE_URL_ROOT.'uploads/loghi_siti/'.$Logo.'">

                            <input type="hidden" name="item_number" value="'.$NumeroPrenotazione.'#'.$IdSito.'#'.$Id.'" />

                            <input type="hidden" name="first_name" value="'.$Nome.'" />
                            <input type="hidden" name="last_name" value="'.$Cognome.'" />
                            <input type="hidden" name="country" value="'.strtoupper($Lingua).'" />
                            <input type="hidden" name="email" value="'.$Email.'" />';

                            if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                              $paypal .= '<b>'.ACCONTO.'</b>: '.$AccontoRichiesta.' %  - <b class="t40 tcolor">€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b><br><br>';
                              $paypal .= '<input type="hidden" name="amount" value="'.number_format(($PrezzoPC*$AccontoRichiesta/100) ,2,'.','').'" />';
                         }
                         if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                              $paypal .= '<b>'.ACCONTO.'</b>: '.$AccontoPercentuale.' %  - <b class="t40 tcolor">€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b><br><br>';
                              $paypal .= '<input type="hidden" name="amount" value="'.number_format(($PrezzoPC*$AccontoPercentuale/100) ,2,'.','').'" />';
                         }
                         if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                              $paypal .= '<b>'.ACCONTO.'</b>:  <b class="t40 tcolor">€. '.number_format($AccontoLibero,2,',','.').'</b><br><br>';
                              $paypal .= '<input type="hidden" name="amount" value="'.number_format($AccontoLibero ,2,'.','').'" />';
                         }
                         if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                           if($AccontoImporto >= 1){
                               $paypal .= '<b>'.ACCONTO.'</b>:  <b class="t40 tcolor">€. '.number_format($AccontoImporto,2,',','.').'</b><br><br>';
                               $paypal .= '<input type="hidden" name="amount" value="'.number_format($AccontoImporto ,2,'.','').'" />';
                             }else{
                                 $paypal .= '<b>'.CARTACREDITOGARANZIA.'</b><br><br>';
                             }
                         }

      $paypal .= '
                         <input name="pp_policy" id="pp_policy" type="radio" value="1" required oninvalid="this.setCustomValidity(\'Questo campo è obbligatorio\')" onchange="this.setCustomValidity(\'\')">
                         <label for="pp_policy" class="t14">'.$accetto_le_politche.' (<a href="javascript:;" id="sblocca_politiche_pp">'.$leggi_politiche.'</a>)</label>
                         <div class="ca10"></div>
                         <div id="politiche_pp" style="display:none">
                         <div class="t14">'.$rw['testo'].'</div>
                      </div>
                        <script>
                           $(document).ready(function() {
                                 $("#sblocca_politiche_pp").click(function(){
                                     $( "#politiche_pp" ).toggle();
                                 });
                             });
                       </script>
                         <div class="ca20"></div>';
        if($EmailPayPal !=''){
          $paypal .= ' <img src="'.BASE_URL_ROOT.'img/paypal.png" class="img-responsive" style="width:25%" />
                        <div class="ca20"></div>
                        <button type="button" class="pulsante"><i class="fa fa-paypal fa-lg"></i> '.PAGA_PAYPAL.'</button>';
        }else{
          $paypal .= '<small class="tcolor">Email di riferimento PayPal, non è stata inserita!</small>';
        }
        $paypal .= '</form>
                  </div>';



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

  $gateway_bancario .= '<div class="ca20"></div>
                      <hr>
                      <h3 class="w400">'.$Pagamento_gb.'</h3>
                      <div class="ca10"></div>
                        <span class="t16">'.$Descrizione_gb.'</span><br><br>
                        <div class="t30">
                        <form method="post" name="payway_form" id="payway_form" action="#">
                        <input type="hidden" name="serverURL" value="'.$serverURL.'">
                        <input type="hidden" name="tid" value="'.$tid.'">
                        <input type="hidden" name="kSig" value="'.$kSig.'">
                        <input type="hidden" name="ShopUserRef" value="'.$ShopUserRef.'">
                        <input type="hidden" name="landID" value="'.strtoupper($Lingua).'" />
                        <input type="hidden" name="shopID" value="'.$NumeroPrenotazione.'" />
                        <input type="hidden" name="v" value="'.$_REQUEST['v'].'" />
                        <input type="hidden" name="url_back" value="#">';

                        if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                          $gateway_bancario .= '<b>'.ACCONTO.'</b>: '.$AccontoRichiesta.' %  - <b class="t40 tcolor">€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b><br><br>';
                          $gateway_bancario .= '<input type="hidden" name="amount" value="'.number_format(($PrezzoPC*$AccontoRichiesta/100) ,2,'.','').'" />';
                      }
                      if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                          $gateway_bancario .= '<b>'.ACCONTO.'</b>: '.$AccontoPercentuale.' %  - <b class="t40 tcolor">€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b><br><br>';
                          $gateway_bancario .= '<input type="hidden" name="amount" value="'.number_format(($PrezzoPC*$AccontoPercentuale/100) ,2,'.','').'" />';
                      }
                      if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                          $gateway_bancario .= '<b>'.ACCONTO.'</b>:  <b class="t40 tcolor">€. '.number_format($AccontoLibero,2,',','.').'</b><br><br>';
                          $gateway_bancario .= '<input type="hidden" name="amount" value="'.number_format($AccontoLibero ,2,'.','').'" />';
                      }
                      if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                          if($AccontoImporto >= 1) {
                              $gateway_bancario .= '<b>'.ACCONTO.'</b>:  <b class="t40 tcolor">€. '.number_format($AccontoImporto,2,',','.').'</b><br><br>';
                              $gateway_bancario .= '<input type="hidden" name="amount" value="'.number_format($AccontoImporto ,2,'.','').'" />';
                          }
                      }

  $gateway_bancario .= '<img src="'.BASE_URL_ROOT.'img/payway_pwsmage.jpg" class="img-responsive" style="width:25%"/>
                      <div class="ca10"></div> ';

  $gateway_bancario .= '
                          <input name="gb_policy" id="gb_policy" type="radio" value="1" required oninvalid="this.setCustomValidity(\'Questo campo è obbligatorio\')" onchange="this.setCustomValidity(\'\')">
                          <label for="gb_policy" class="t14">'.$accetto_le_politche.' (<a href="javascript:;" id="sblocca_politiche_gb">'.$leggi_politiche.'</a>)</label>
                          <div class="ca10"></div>
                          <div id="politiche_gb" style="display:none">
                          <div class="t14">'.$rw['testo'].'</div>
                       </div>
                         <script>
                            $(document).ready(function() {
                                  $("#sblocca_politiche_gb").click(function(){
                                      $( "#politiche_gb" ).toggle();
                                  });
                              });
                        </script>
                          <div class="ca20"></div>
                          <button type="button" class="pulsante">'.PAGA_CARTA_CREDITO.' PayWay</button>
                          </form>
                          </div>';

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

  $gateway_bancario_virtualpay .= '<div class="ca20"></div>
                      <hr>
                      <h3 class="w400">'.$Pagamento_gbvp.'</h3>
                      <div class="ca10"></div>
                        <span class="t16">'.$Descrizione_gbvp.'</span><br><br>
                        <div class="t30">
                        <input type="hidden" name="DIVISA" value="EUR">
                        <input type="hidden" name="ABI" value="'.$ABI.'">
                        <input type="hidden" name="MERCHANT_ID" value="'.$MERCHANT_ID.'">
                        <input type="hidden" name="MAC" value="">
                        <input type="hidden" name="EMAIL" value="'.$EMAIL.'">
                        <input type="hidden" name="LINGUA" value="'.strtoupper($Lingua).'" />
                        <input type="hidden" name="ORDER_ID" value="'.$NumeroPrenotazione.'" />
                        <input type="hidden" name="v" value="'.$_REQUEST['v'].'" />
                        <input type="hidden" name="ITEMS" value="Prenotazione soggiorno presso '.NOMEHOTEL.'">
                        <input type="hidden" name="URLACK" value="#">
                        <input type="hidden" name="URLNACK" value="#">';

                        if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                          $gateway_bancario_virtualpay .= '<b>'.ACCONTO.'</b>: '.$AccontoRichiesta.' %  - <b class="t40 tcolor">€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b><br><br>';
                          $gateway_bancario_virtualpay .= '<input type="hidden" name="IMPORTO" value="'.number_format(($PrezzoPC*$AccontoRichiesta/100) ,2,'.','').'" />';
                      }
                      if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                          $gateway_bancario_virtualpay .= '<b>'.ACCONTO.'</b>: '.$AccontoPercentuale.' %  - <b class="t40 tcolor">€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b><br><br>';
                          $gateway_bancario_virtualpay .= '<input type="hidden" name="IMPORTO" value="'.number_format(($PrezzoPC*$AccontoPercentuale/100) ,2,'.','').'" />';
                      }
                      if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                          $gateway_bancario_virtualpay .= '<b>'.ACCONTO.'</b>:  <b class="t40 tcolor">€. '.number_format($AccontoLibero,2,',','.').'</b><br><br>';
                          $gateway_bancario_virtualpay .= '<input type="hidden" name="IMPORTO" value="'.number_format($AccontoLibero ,2,'.','').'" />';
                      }
                      if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                          if($AccontoImporto >= 1) {
                              $gateway_bancario_virtualpay .= '<b>'.ACCONTO.'</b>:  <b class="t40 tcolor">€. '.number_format($AccontoImporto,2,',','.').'</b><br><br>';
                              $gateway_bancario_virtualpay .= '<input type="hidden" name="IMPORTO" value="'.number_format($AccontoImporto ,2,'.','').'" />';
                          }
                      }

  $gateway_bancario_virtualpay .= '<img src="'.BASE_URL_ROOT.'img/virtualpay_form.jpg" class="img-responsive" />
                      <div class="ca10"></div> ';

  $gateway_bancario_virtualpay .= '
                          <input name="gbvp_policy" id="gbvp_policy" type="radio" value="1" required oninvalid="this.setCustomValidity(\'Questo campo è obbligatorio\')" onchange="this.setCustomValidity(\'\')">
                          <label for="gbvp_policy" class="t14">'.$accetto_le_politche.' (<a href="javascript:;" id="sblocca_politiche_gbvp">'.$leggi_politiche.'</a>)</label>
                          <div class="ca10"></div>
                          <div id="politiche_gbvp" style="display:none">
                            <div class="t14">'.$rw['testo'].'</div>
                          </div>
                         <script>
                            $(document).ready(function() {
                                  $("#sblocca_politiche_gbvp").click(function(){
                                      $( "#politiche_gbvp" ).toggle();
                                  });
                              });
                        </script>
                          <div class="ca20"></div>
                          <button type="button" class="pulsante">'.PAGA_CARTA_CREDITO.' Virtual Pay</button>
                          </div>';

}

### STRIPE ####
$ss = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito= ".IDSITO." AND Abilitato = 1  AND TipoPagamento = 'Stripe'";
$res_ss = $db->query($ss);
$row_ss = $db->row($res_ss);
if(is_array($row_ss)) {
  if($row_ss > count($row_ss)) // se la pagina richiesta non esiste
      $tt_ss = count($row_ss); // restituire la pagina con il numero più alto che esista
}else{
  $tt_ss = 0;
}
if(($tt_ss) > 0){

  $OrdineSS     = $row_ss['Ordine'];
  $ApiKeyStripe = $row_ss['ApiKeyStripe'];

  $s = "SELECT * FROM hospitality_tipo_pagamenti_lingua WHERE idsito= ".IDSITO." AND pagamenti_id = ".$row_ss['Id']." AND lingue = '".$Lingua."'";
  $res_s = $db->query($s);
  $row_s = $db->row($res_s);
  $Pagamento_ss = $row_s['Pagamento'];
  $Descrizione_ss = $row_s['Descrizione'];

  if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
    $stripe_txt   = '<b>'.ACCONTO.'</b>: '.$AccontoRichiesta.' %  - <b class="t40 tcolor">€. '.number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.').'</b><br><br>';
    $stripe_value = number_format(($PrezzoPC*$AccontoRichiesta/100) ,2,'','');
  }
  if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
    $stripe_txt = '<b>'.ACCONTO.'</b>: '.$AccontoPercentuale.' %  - <b class="t40 tcolor">€. '.number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.').'</b><br><br>';
      $stripe_value = number_format(($PrezzoPC*$AccontoPercentuale/100) ,2,'','');
  }
  if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
      $stripe_txt   = '<b>'.ACCONTO.'</b>:  <b class="t40 tcolor">€. '.number_format($AccontoLibero,2,',','.').'</b><br><br>';
      $stripe_value = number_format($AccontoLibero ,2,'','');
  }
  if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
  if($AccontoImporto >= 1){      
      $stripe_txt   = '<b>'.ACCONTO.'</b>:  <b class="t40 tcolor">€. '.number_format($AccontoImporto,2,',','.').'</b><br><br>';
      $stripe_value = number_format($AccontoImporto ,2,'','');
    }else{
        $stripe_txt = '<b>'.CARTACREDITOGARANZIA.'</b><br><br>';
    }
  }

  $stripe .= '<div class="ca20"></div>
              <hr>
              <h3 class="w400">'.$Pagamento_ss.'</h3>
              <div class="ca10"></div>
                <span class="t16">'.$Descrizione_ss.'</span><br><br>
                <div class="t30">
                '.$stripe_txt.'
                  <img src="'.BASE_URL_ROOT.'img/stripe.png" class="img-responsive" />
                  <div class="ca10"></div> ';
      $stripe .= '
                  <input name="pp_policy" id="pp_policy" type="radio" value="1" required oninvalid="this.setCustomValidity(\'Questo campo è obbligatorio\')" onchange="this.setCustomValidity(\'\')">
                  <label for="pp_policy" class="t14">'.$accetto_le_politche.' (<a href="javascript:;" id="sblocca_politiche_pp">'.$leggi_politiche.'</a>)</label>
                  <div class="ca10"></div>
                    <div id="politiche_pp" style="display:none">
                         <div class="t14">'.$rw['testo'].'</div>
                    </div>
                      <script>
                           $(document).ready(function() {
                                 $("#sblocca_politiche_pp").click(function(){
                                     $( "#politiche_pp" ).toggle();
                                 });
                             });
                       </script>
                        <div class="ca20"></div>';
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
                      </script>                     
       
                  </div>';



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

  $nexi .= '<div class="ca20"></div>
              <hr>
              <h3 class="w400">'.$Pagamento_nx.'</h3>
              <div class="ca10"></div>
                <span class="t16">'.$Descrizione_nx.'</span><br><br>
                <div class="t30">
                '.$nexi_txt.'
                  <img src="'.BASE_URL_ROOT.'img/LogoNexi_XPay.jpg" class="img-responsive" style="width:25%"/>
                  <div class="ca10"></div> ';
      $nexi .= '
                  <input name="nx_policy" id="nx_policy" type="radio" value="1" required oninvalid="this.setCustomValidity(\'Questo campo è obbligatorio\')" onchange="this.setCustomValidity(\'\')">
                  <label for="nx_policy" class="t14">'.$accetto_le_politche.' (<a href="javascript:;" id="sblocca_politiche_nx">'.$leggi_politiche.'</a>)</label>
                  <div class="ca10"></div>
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
                        <div class="ca20"></div>';

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
                                $nexi .= '<div class="ca20"></div>';
                                $nexi .= ' <button type="button"  class="pulsante" id="nexi-button">Paga con Xpay di NEXI</button>';
                        }else{
                          $nexi .= '<small class="tcolor t14">API di riferimento Nexi, non è stata inserita!</small>';
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
#
if($abilita_mappa == 1){
  if($latitudine !='' && $longitudine != ''){
    $Mappa ='<div class="GM2">
                  <div id="map-container" class="google"></div>
              </div>';
  }
}
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
