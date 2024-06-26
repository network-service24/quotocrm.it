<?php
$db->query("SELECT * FROM hospitality_target WHERE idsito = ".IDSITO." ORDER BY Id ASC");
$row = $db->result();
foreach($row as $chiave => $valore){
    $Target .='<option value="'.$valore['Target'].'" '.($_REQUEST['TipoVacanza']==$valore['Target']?'selected':'').' >'.$valore['Target'].'</option>';
    if($_REQUEST['TipoVacanza']==$valore['Target'] && $_REQUEST['TipoVacanza'] != ''){$_array_query[] = $valore['Target'];}
}
$db->query("SELECT * FROM hospitality_fonti_prenotazione WHERE Abilitato = 1 AND idsito = ".IDSITO." ORDER BY FontePrenotazione ASC");
$rws = $db->result();
foreach($rws as $key => $v){
    $ListaFonti .='<option value="'.$v['FontePrenotazione'].'" '.($_REQUEST['FontePrenotazione']==$v['FontePrenotazione']?'selected':'').'>'.$v['FontePrenotazione'].'</option>';
    if($_REQUEST['FontePrenotazione']==$v['FontePrenotazione'] && $_REQUEST['FontePrenotazione'] != ''){$_array_query[] = $v['FontePrenotazione'];}
}
$db->query("SELECT * FROM hospitality_operatori WHERE Abilitato = 1 AND idsito = ".IDSITO." ORDER BY Id ASC");
$row = $db->result();
foreach($row as $chiave => $valore){
    $ListaOperatori .='<option value="'.$valore['NomeOperatore'].'" '.($_REQUEST['Operatore']==$valore['NomeOperatore']?'selected':'').'>'.$valore['NomeOperatore'].'</option>';
    if($_REQUEST['Operatore']==$valore['NomeOperatore'] && $_REQUEST['Operatore'] != ''){$_array_query[] = $valore['NomeOperatore'];}
}
// Query e ciclo per estrapolare i dati di tipologia camere
$rw = "SELECT *
        FROM hospitality_tipo_camere
        WHERE hospitality_tipo_camere.idsito = ".IDSITO."
        AND hospitality_tipo_camere.Abilitato = 1
        ORDER BY hospitality_tipo_camere.TipoCamere ASC";
$result_ = $db->query($rw);
$r       = $db->result($result_);
foreach($r as $k => $v){
  $ListaCamere .='<option value="'.$v['Id'].'" '.($_REQUEST['TipoCamere']==$v['Id']?'selected':'').'>'.$v['TipoCamere'].'</option>';
  if($_REQUEST['TipoCamere']==$v['Id'] && $_REQUEST['TipoCamere'] !=''){$_array_query[] = $v['TipoCamere'];}
}
// Query e ciclo per estrapolare i dati di tipologia soggiorno
$select_sog = "SELECT *
              FROM hospitality_tipo_soggiorno
              WHERE hospitality_tipo_soggiorno.idsito = ".IDSITO."
              AND hospitality_tipo_soggiorno.Abilitato = 1
              AND hospitality_tipo_soggiorno.Abilitato_form = 1
              ORDER BY hospitality_tipo_soggiorno.TipoSoggiorno ASC";
$record        = $db->query($select_sog);
$array_rows    = $db->result($record);
foreach($array_rows as $chiave => $valore){
    $ListaSoggiorno .='<option value="'.$valore['Id'].'" '.($_REQUEST['TipoSoggiorno']==$valore['Id']?'selected':'').'>'.mini_clean($valore['TipoSoggiorno']).'</option>';
    if($_REQUEST['TipoSoggiorno']==$valore['Id'] && $_REQUEST['TipoSoggiorno'] != ''){$_array_query[] = $valore['TipoSoggiorno'];}
}

$q  = " SELECT 
        hospitality_tipo_voucher_cancellazione.*
    FROM 
        hospitality_tipo_voucher_cancellazione 
    WHERE 
        hospitality_tipo_voucher_cancellazione.idsito = ".IDSITO." 
    AND 
        hospitality_tipo_voucher_cancellazione.Abilitato = 1 ";
$rec     = $db->query($q);
$array_r = $db->result($rec);
foreach($array_r as $c => $vl){
    $motiv .= '<option value="'.$vl['Id'].'" data-id="'.$vl['Id'].'" '.($_REQUEST['IdMotivazione']==$vl['Id']?'selected':'').'>'.$vl['Motivazione'].'</option>';
}

if($_REQUEST['action']=='search'){
  if(is_array($_array_query) && !empty($_array_query) && !is_null($_array_query)){

    $etichetta = implode(", ",$_array_query);
    $form_ricerca .= '<script>
                        scriviCookie(\'etichetta_filtro'.IDSITO.'\',\''.$etichetta.'\',\'60\');
                      </script>'."\r\n";
  }
}
    $form_ricerca .= '
                                    <div class="modal fade" id="myModalASearch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalASearch">Filtri Avanzati</h4>
                                              </div>
                                              <div class="modal-body" style="line-height:10px!important">';
                                            if($_SERVER['REQUEST_URI']!='/v2/cestino/'){
                                              if($_SERVER['REQUEST_URI']!='/v2/archivio/'){
                                                if($_SERVER['REQUEST_URI']!='/v2/prenotazioni/'){
                                                  if($_SERVER['REQUEST_URI']!='/v2/buoni_voucher/'){
                                                    $form_ricerca .= '<h4 class="linea_bottom">Filtri Univoco</h4>
                                                                        <form  method="POST" id="form_search" name="form_search" action="'.$_SERVER['REQUEST_URI'].'">
                                                                        <div class="row">
                                                                          <div class="col-md-6">
                                                                            <div class="form-group">
                                                                              <label>Aperture</label>
                                                                                <select name="Aperture" id="Aperture" class="form-control">
                                                                                  <option value="">--</option>
                                                                                  <option value="1" '.($_REQUEST['Aperture']=='1'?'selected':'').'>Aperte</option>
                                                                                  <option value="0" '.($_REQUEST['Aperture']=='0'?'selected':'').'>Non Aperte</option>
                                                                                </select>
                                                                              </div>
                                                                          </div>
                                                                          <div class="col-md-2">
                                                                            <div class="form-group">
                                                                                <label>&nbsp;</label>
                                                                                <input type="hidden" name="action" value="unique_filter">
                                                                                <a href="'.$_SERVER['REQUEST_URI'].'" class="btn btn-success" >Reset Filtro</a>
                                                                            </div>
                                                                          </div>
                                                                          <div class="col-md-1">
                                                                            <div class="form-group">
                                                                              <label>&nbsp;</label>
                                                                              <button type="submit" class="btn btn-primary" id="bottone">Filtra</button>
                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                      </form>
                                                                      <h4 class="linea_bottom">Filtri avanzati concatenabili</h4>';
                                                  }
                                                }
                                              }
                                            }

                                      $form_ricerca .= '<form  method="POST" id="form_search" name="form_search" action="'.$_SERVER['REQUEST_URI'].'">';

                                      $form_ricerca .= '<div class="row">';
                                      if($_SERVER['REQUEST_URI']=='/v2/v2/preventivi/' || $_SERVER['REQUEST_URI']=='/v2/v2/prenotazioni/'){
                                       
                                        if(check_vista()==true){
                                          $form_ricerca .= '
                                                              <div class="col-md-'.($_SERVER['REQUEST_URI']=='/v2/v2/prenotazioni/'?'4':'6').'">
                                                                <div class="form-group">
                                                                  <label  class="control-label">Campagne ADS <small>(utm)</small></label>
                                                                  <select name="campagna" id="campagna" class="form-control">
                                                                    <option value="">--</option>
                                                                    <option value="facebook" '.($_REQUEST['campagna']=='facebook'?'selected="selected"':'').'>Facebook</option>
                                                                    <option value="google" '.($_REQUEST['campagna']=='google'?'selected="selected"':'').'>Google</option>
                                                                    <option value="newsletter" '.($_REQUEST['campagna']=='newsletter'?'selected="selected"':'').'>Newsletter</option>
                                                                  </select>
                                                                </div>
                                                              </div>
                                                            ';
                                        }
                                      }
                                      if($_SERVER['REQUEST_URI']=='/v2/preventivi/' || $_SERVER['REQUEST_URI']=='/v2/archivio/'){
                                          $form_ricerca .= '
                                                            <div class="col-md-6">
                                                              <div class="form-group">
                                                                <label  class="control-label">Preventivi Annullati</label>
                                                                <select name="NoDisponibilita" id="NoDisponibilita" class="form-control">
                                                                <option value="">--</option>
                                                                <option value="1" '.($_REQUEST['NoDisponibilita']=='1'?'selected="selected"':'').'>Si</option>
                                                                <option value="0" '.($_REQUEST['NoDisponibilita']=='0'?'selected="selected"':'').'>No</option>
                                                                </select>
                                                              </div>
                                                            </div>
                                                          ';
                                      }
                                        $form_ricerca .= '</div>';

                                      $form_ricerca .= '
                                                          <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label for="NumeroPrenotazione" class="control-label">Nr.</label>
                                                                  <input type="text" name="NumeroPrenotazione" id="NumeroPrenotazione" class="form-control" value="'.$_REQUEST['NumeroPrenotazione'].'">
                                                                </div>
                                                              </div>
                                                              <div class="col-md-4">';

                                      if($_SERVER['REQUEST_URI']=='/v2/buoni_voucher/'){
                                        $form_ricerca .= '
                                                          <div class="form-group">
                                                            <label  class="control-label">Motivazione <small>Buono Voucher</small></label>
                                                            <select name="IdMotivazione" id="IdMotivazione" class="form-control">
                                                              <option value=""  data-id="0" >--</option>
                                                              '.$motiv.'
                                                            </select>
                                                          </div>';
                                      }


                                      if($_SERVER['REQUEST_URI']=='/v2/archivio/'){
                                          $form_ricerca .= '<div class="form-group">
                                                              <label for="TipoRichiesta" class="control-label">Richiesta</label>
                                                              <select name="TipoRichiesta" id="TipoRichiesta" class="form-control">
                                                                <option value="">--</option>
                                                                <option value="Preventivo" '.($_REQUEST['TipoRichiesta']=='Preventivo'?'selected':'').'>Preventivo</option>
                                                                <option value="Conferma" '.($_REQUEST['TipoRichiesta']=='Conferma'?'selected':'').'>Conferma</option>
                                                                <option value="ConfermaC" '.($_REQUEST['TipoRichiesta']=='ConfermaC'?'selected':'').'>Prenotazione Confermata</option>
                                                              </select>
                                                            </div>';
                                      }
                                      if($_SERVER['REQUEST_URI']=='/v2/prenotazioni/'){
                                        $form_ricerca .= '<div class="form-group">
                                                            <label for="TipoCamere" class="control-label">Camere</label>
                                                            <select name="TipoCamere" id="TipoCamere" class = "form-control">
                                                              <option value="">--</option>
                                                              '.$ListaCamere.'
                                                            </select>
                                                          </div>';
                                    }
                                    if($_SERVER['REQUEST_URI']=='/v2/preventivi/' || $_SERVER['REQUEST_URI']=='/v2/conferme/'){
                                      $form_ricerca .= '  <div class="form-group">
                                                              <label for="TipoSoggiorno" class="control-label">Soggiorno</label>
                                                              <select name="TipoSoggiorno" id="TipoSoggiorno" class = "form-control">
                                                                <option value="">--</option>
                                                                '.$ListaSoggiorno.'
                                                              </select>
                                                            </div>';
                                    }
                                      $form_ricerca .= '</div>';
                                    if($_SERVER['REQUEST_URI']=='/v2/prenotazioni/'){
                                      $form_ricerca .= '<div class="col-md-4">
                                                            <div class="form-group">
                                                              <label for="TipoSoggiorno" class="control-label">Soggiorno</label>
                                                              <select name="TipoSoggiorno" id="TipoSoggiorno" class = "form-control">
                                                                <option value="">--</option>
                                                                '.$ListaSoggiorno.'
                                                              </select>
                                                            </div>
                                                          </div>';
                                    }
                                    if($_SERVER['REQUEST_URI']!='/v2/cestino/'){
                                      if($_SERVER['REQUEST_URI']!='/v2/prenotazioni/'){
                                        if($_SERVER['REQUEST_URI']!='/v2/buoni_voucher/'){
                                          $form_ricerca .= '
                                                            <div class="col-md-4">
                                                              <div class="form-group">
                                                                <label for="DataScadenza" class="control-label">Scadenza <small style="font-weight:normal!important">(>=)</small></label>
                                                                <input id="DataScadenza" name="DataScadenza" type="text" class="date-picker form-control" value="'.$_REQUEST['DataScadenza'].'" autocomplete="off">
                                                              </div>
                                                            </div>';
                                        }
                                      }
                                    }
                                      $form_ricerca .= '</div>
                                                          <div class="row">
                                                            <div class="col-md-4">
	                                                              <div class="form-group">
	                                                                <label for="Operatore" class="control-label">Operatore</label>
	                                                                <select name="Operatore" id="Operatore" class="form-control">
	                                                                <option value="">--</option>
	                                                                 '.$ListaOperatori.'
	                                                                </select>
	                                                              </div>
                                                              </div>
                                                              <div class="col-md-4">
                                                              <div class="form-group">
                                                                <label for="FontePrenotazione" class="control-label">Fonte</label>
                                                                <select name="FontePrenotazione" id="FontePrenotazione" class="form-control">
                                                                <option value="">--</option>
                                                                 '.$ListaFonti.'
                                                                </select>
                                                              </div>
                                                            </div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                <label for="TipoVacanza" class="control-label">Tipo</label>
                                                                <select name="TipoVacanza" id="TipoVacanza" class="form-control">
                                                                <option value="">--</option>
                                                                  '.$Target.'
                                                                </select>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <div class="row">
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                <label for="Nome" class="control-label">Nome <small style="font-weight:normal!important">(like)</small></label>
                                                                <input type="text" name="Nome" id="Nome" class="form-control" value="'.$_REQUEST['Nome'].'">
                                                              </div>
                                                            </div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                <label for="Cognome" class="control-label">Cognome <small style="font-weight:normal!important">(like)</small></label>
                                                                <input type="text" name="Cognome" id="Cognome" class="form-control" value="'.$_REQUEST['Cognome'].'">
                                                              </div>
                                                            </div>
                                                             <div class="col-md-4">
                                                                <div class="form-group">
                                                                <label for="Email" class="control-label">Email <small style="font-weight:normal!important">(=)</small></label>
                                                                <input type="text" name="Email" id="Email" class="form-control" value="'.$_REQUEST['Email'].'">
                                                              </div>
                                                          </div>
                                                          </div>
                                                          <div class="row">
                                                          <div class="col-md-4">
                                                              <div class="form-group">
                                                                <label for="Lingua" class="control-label">Lingua</label>
                                                                <select name="Lingua" id="Lingua" class="form-control">
                                                                <option value="">--</option>
                                                                  <option value="it" '.($_REQUEST['Lingua']=='it'?'selected':'').'>IT</option>
                                                                  <option value="en" '.($_REQUEST['Lingua']=='en'?'selected':'').'>EN</option>
                                                                  <option value="fr" '.($_REQUEST['Lingua']=='fr'?'selected':'').'>FR</option>
                                                                  <option value="de" '.($_REQUEST['Lingua']=='de'?'selected':'').'>DE</option>
                                                                </select>
                                                              </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                              <div class="form-group">
                                                                <label for="DataArrivo" class="control-label">Arrivo <small style="font-weight:normal!important">(>=)</small></label>
                                                                <input id="DataArrivo" name="DataArrivo" type="text" class="date-picker form-control" value="'.$_REQUEST['DataArrivo'].'" autocomplete="off">
                                                              </div>
                                                              </div>
                                                            <div class="col-md-4">
                                                              <div class="form-group">
                                                                <label for="DataPartenza" class="control-label">Partenza <small style="font-weight:normal!important">(<=)</small></label>
                                                                <input id="DataPartenza" name="DataPartenza" type="text" class="date-picker form-control" value="'.$_REQUEST['DataPartenza'].'" autocomplete="off">
                                                              </div>
                                                             </div>
                                                            </div>';
                                    if($_SERVER['REQUEST_URI']=='/v2/preventivi/'){
                                          $form_ricerca .=' <div class="row">
                                                              <div class="col-md-4"></div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                      <label class="control-label">Data invio preventivo <small style="font-weight:normal!important">(=)</small></label>
                                                                      <input  type="text" id="DataInvio" autocomplete="off"  class="date-picker form-control" name="DataInvio" value="'.$_REQUEST['DataInvio'].'">
                                                                </div>
                                                              </div>
                                                              <div class="col-md-4"></div>
                                                            </div>';
                                    }

                                      $form_ricerca .=' <div class="row">
                                                              <div class="col-md-2"></div>';
                                
                                      $form_ricerca .= ' <div class="col-md-4">
                                                                  <div class="form-group">
                                                                    <label  class="control-label">Data richiesta Dal <small style="font-weight:normal!important">(>=)</small></label>
                                                                    <input type="text" id="DataRichiesta_dal_f" autocomplete="off"  class="date-picker form-control" name="DataRichiesta_dal" value="'.$_REQUEST['DataRichiesta_dal'].'">
                                                                  </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                  <div class="form-group">
                                                                      <label class="control-label">Data richiesta Al <small style="font-weight:normal!important">(<=)</small></label>
                                                                      <input  type="text" id="DataRichiesta_al_f" autocomplete="off"  class="date-picker form-control" name="DataRichiesta_al" value="'.$_REQUEST['DataRichiesta_al'].'">
                                                                  </div>
                                                              </div>
                                                              <div class="col-md-2"></div>
                                                            </div>';
                                    if($_SERVER['REQUEST_URI']=='/v2/prenotazioni/'){
                                      $form_ricerca .= '    <div class="row">
                                                              <div class="col-md-2"></div>
                                                              <div class="col-md-4">
                                                                  <div class="form-group">
                                                                    <label  class="control-label">Data Prenotazione Dal <small style="font-weight:normal!important">(>=)</small></label>
                                                                    <input type="text" id="DataPrenotazione_dal" autocomplete="off"  class="date-picker form-control" name="DataPrenotazione_dal" value="'.$_REQUEST['DataPrenotazione_dal'].'">
                                                                  </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                  <div class="form-group">
                                                                      <label class="control-label">Data Prenotazione Al <small style="font-weight:normal!important">(<=)</small></label>
                                                                      <input  type="text" id="DataPrenotazione_al" autocomplete="off"  class="date-picker form-control" name="DataPrenotazione_al" value="'.$_REQUEST['DataPrenotazione_al'].'">
                                                                  </div>
                                                              </div>
                                                              <div class="col-md-2"></div>
                                                            </div>
                                                            <div class="row">
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label  class="control-label">Check-in (Arrivo) Dal <small style="font-weight:normal!important">(>=)</small></label>
                                                                  <input type="text" id="Arrivo_dal" autocomplete="off"  class="date-picker form-control" name="Arrivo_dal" value="'.$_REQUEST['Arrivo_dal'].'">
                                                                </div>
                                                              </div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Check-in (Arrivo) Al <small style="font-weight:normal!important">(<=)</small></label>
                                                                    <input  type="text" id="Arrivo_al" autocomplete="off"  class="date-picker form-control" name="Arrivo_al" value="'.$_REQUEST['Arrivo_al'].'">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2"></div>
                                                          </div>';
                                      }
                                      $form_ricerca .= ' <div class="row">
                                                            <div class="col-md-12 text-center">
                                                              <div class="form-group">
                                                              <label>Legenda: <small style="font-weight:normal!important">(like) contiene; (=) uguale; (>=) maggiore uguale; (<=) minore uguale;</small></label>
                                                              </div>
                                                            </div>
                                                          </div>
                                                            <div class="row">
                                                            <div class="col-md-12 text-center">
                                                              <div class="form-group">
                                                                <input type="hidden" name="action" value="search">
                                                                <a href="'.$_SERVER['REQUEST_URI'].'" class="btn btn-success" >Reset Filtro</a>
                                                                <button type="submit" class="btn btn-primary" id="bottone">Filtra</button>
                                                              </div>
                                                            </div>
                                                          </div>
                                                    </form>
                                                    </div>
                                                </div>
                                              </div>
                                            </div>';
                        $form_ricerca .= '  <link rel="stylesheet" href="'.BASE_URL_SITO.'plugins/datepicker/datepicker3.css">'."\r\n";
                        $form_ricerca .= '  <script src="'.BASE_URL_SITO.'plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>'."\r\n";
                        $form_ricerca .= '  <script src="'.BASE_URL_SITO.'plugins/datepicker/locales/bootstrap-datepicker.it.js" type="text/javascript"></script>'."\r\n";
                        $form_ricerca .= '  <script>
                                              $(function() {
                                                $( "#DataInvio" ).datepicker({
                                                    numberOfMonths: 1,
                                                    language:\'it\',
                                                    showButtonPanel: true
                                                });
                                                $( "#DataScadenza" ).datepicker({
                                                    numberOfMonths: 1,
                                                    language:\'it\',
                                                    showButtonPanel: true
                                                });
                                                $( "#DataArrivo" ).datepicker({
                                                    numberOfMonths: 1,
                                                    language:\'it\',
                                                    showButtonPanel: true
                                                });
                                                $("#DataArrivo").datepicker({dateFormat: \'dd/mm/yy\'}).change(function () {
                                                     var $picker = $("#DataArrivo");
                                                     var $picker2 = $("#DataPartenza");
                                                     var date=new Date($picker.datepicker(\'getDate\'));
                                                     date.setDate(date.getDate()+1);
                                                     $picker2.datepicker(\'setDate\', date);
                                                });
                                                $( "#DataPartenza" ).datepicker({
                                                    numberOfMonths: 1,
                                                    language:\'it\',
                                                    showButtonPanel: true
                                                });
                                                $( "#DataRichiesta_dal_f" ).datepicker({
                                                  numberOfMonths: 1,
                                                  language:\'it\',
                                                  showButtonPanel: true
                                                });
                                                $( "#DataRichiesta_al_f" ).datepicker({
                                                    numberOfMonths: 1,
                                                    language:\'it\',
                                                    showButtonPanel: true
                                                });
                                                $( "#DataPrenotazione_dal" ).datepicker({
                                                  numberOfMonths: 1,
                                                  language:\'it\',
                                                  showButtonPanel: true
                                                });
                                                $( "#DataPrenotazione_al" ).datepicker({
                                                    numberOfMonths: 1,
                                                    language:\'it\',
                                                    showButtonPanel: true
                                                });
                                                $( "#Arrivo_dal" ).datepicker({
                                                  numberOfMonths: 1,
                                                  language:\'it\',
                                                  showButtonPanel: true
                                                });
                                                $( "#Arrivo_al" ).datepicker({
                                                    numberOfMonths: 1,
                                                    language:\'it\',
                                                    showButtonPanel: true
                                                });

                                              });
                                            </script>'."\r\n";
echo $form_ricerca;
?>
