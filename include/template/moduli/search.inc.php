<?php
$row = $dbMysqli->query("SELECT * FROM hospitality_target WHERE idsito = ".IDSITO." ORDER BY Id ASC");
foreach($row as $chiave => $valore){
    $Target .='<option value="'.$valore['Target'].'" '.($_REQUEST['TipoVacanza']==$valore['Target']?'selected':'').' >'.$valore['Target'].'</option>';
    if($_REQUEST['TipoVacanza']==$valore['Target'] && $_REQUEST['TipoVacanza'] != ''){$_array_query[] = $valore['Target'];}
}
$rws = $dbMysqli->query("SELECT * FROM hospitality_fonti_prenotazione WHERE Abilitato = 1 AND idsito = ".IDSITO." ORDER BY FontePrenotazione ASC");
foreach($rws as $key => $v){
    $ListaFonti .='<option value="'.$v['FontePrenotazione'].'" '.($_REQUEST['FontePrenotazione']==$v['FontePrenotazione']?'selected':'').'>'.$v['FontePrenotazione'].'</option>';
    if($_REQUEST['FontePrenotazione']==$v['FontePrenotazione'] && $_REQUEST['FontePrenotazione'] != ''){$_array_query[] = $v['FontePrenotazione'];}
}
$row = $dbMysqli->query("SELECT * FROM hospitality_operatori WHERE Abilitato = 1 AND idsito = ".IDSITO." ORDER BY Id ASC");
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
$r = $dbMysqli->query($rw);
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
$array_rows = $dbMysqli->query($select_sog);
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
$array_r = $dbMysqli->query($q);
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
                                          <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h4 class="modal-title" id="myModalASearch"><i class="fa fa-search fa-2x fa-fw text-black"></i> Ricerca Avanzata</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              </div>
                                              <div class="modal-body" style="line-height:10px!important">';
                                            if($_SERVER['REQUEST_URI']=='/preventivi/' || $_SERVER['REQUEST_URI']=='/conferme/'){

                                                      $form_ricerca .= '<h4 class="linea_bottom">Filtro Univoco</h4>
                                                                        <div class="clearfix p-b-10"></div>
                                                                          <form  method="POST" id="form_search" name="form_search" action="'.$_SERVER['REQUEST_URI'].'">
                                                                          <input type="hidden" name="action" value="unique_filter">
                                                                          <div class="row">
                                                                            <div class="col-md-6">


                                                                              <div class="form-group">
                                                                                <label><b>Aperture</b></label>
                                                                                    <div class="input-group input-group-primary">
                                                                                      <span class="input-group-addon"><i class="fa fa-eye fa-fw"></i></span>
                                                                                      <select name="Aperture" id="Aperture" class="form-control">
                                                                                        <option value="">--</option>
                                                                                        <option value="1" '.($_REQUEST['Aperture']=='1'?'selected':'').'>Aperte</option>
                                                                                        <option value="0" '.($_REQUEST['Aperture']=='0'?'selected':'').'>Non Aperte</option>
                                                                                      </select>
                                                                                  </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                              <div class="form-group p-b-10">
                                                                                <label>&nbsp;</label>
                                                                                <button type="submit" class="btn btn-primary col-md-12" id="bottone">Cerca</button>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </form>
                                                                        <hr>
                                                                        <h4 class="linea_bottom">Filtri avanzati concatenabili</h4>
                                                                        <div class="clearfix p-b-10"></div> ';

                                            }

                                      $form_ricerca .= '<form  method="POST" id="form_search" name="form_search" action="'.$_SERVER['REQUEST_URI'].'">';

                                      $form_ricerca .= '<div class="row">';
                                      if($_SERVER['REQUEST_URI']=='/preventivi/' || $_SERVER['REQUEST_URI']=='/prenotazioni/'){

                                        if($fun->check_vista(IDSITO)==true){
                                          $form_ricerca .= '
                                                              <div class="col-md-'.($_SERVER['REQUEST_URI']=='/prenotazioni/'?'4':'6').'">
                                                                <div class="form-group">
                                                                  <label  class="control-label"><b>Campagne ADS</b> <small>(utm)</small></label>
                                                                  <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="icofont icofont-queen fa-fw"></i></span>
                                                                      <select name="campagna" id="campagna" class="form-control">
                                                                        <option value="">--</option>
                                                                        <option value="facebook" '.($_REQUEST['campagna']=='facebook'?'selected="selected"':'').'>Facebook</option>
                                                                        <option value="google" '.($_REQUEST['campagna']=='google'?'selected="selected"':'').'>Google</option>
                                                                        <option value="newsletter" '.($_REQUEST['campagna']=='newsletter'?'selected="selected"':'').'>Newsletter</option>
                                                                      </select>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            ';
                                        }
                                      }

                                      $form_ricerca .= '</div>';

                                      $form_ricerca .= '
                                                          <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label for="NumeroPrenotazione" class="control-label"><b>Nr.</b></label>
                                                                    <div class="input-group input-group-primary">
                                                                      <span class="input-group-addon"><i class="fa fa-reorder fa-fw"></i></span>
                                                                      <input type="text" name="NumeroPrenotazione" id="NumeroPrenotazione" class="form-control" value="'.$_REQUEST['NumeroPrenotazione'].'">
                                                                  </div>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-4">';

                                      if($_SERVER['REQUEST_URI']=='/buoni_voucher/'){
                                        $form_ricerca .= '
                                                          <div class="form-group">
                                                            <label  class="control-label"><b>Motivazione <small>Buono Voucher</small></b></label>
                                                                <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="fa fa-tags fa-fw"></i></span>
                                                                    <select name="IdMotivazione" id="IdMotivazione" class="form-control">
                                                                      <option value=""  data-id="0" >--</option>
                                                                      '.$motiv.'
                                                                    </select>
                                                                </div>
                                                          </div>';
                                      }


                                      if($_SERVER['REQUEST_URI']=='/archivio/'){
                                          $form_ricerca .= '<div class="form-group">
                                                              <label for="TipoRichiesta" class="control-label"><b>Richiesta</b></label>
                                                                  <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="icofont icofont-presentation fa-fw"></i></span>
                                                                      <select name="TipoRichiesta" id="TipoRichiesta" class="form-control">
                                                                        <option value="">--</option>
                                                                        <option value="Preventivo" '.($_REQUEST['TipoRichiesta']=='Preventivo'?'selected':'').'>Preventivo</option>
                                                                        <option value="Conferma" '.($_REQUEST['TipoRichiesta']=='Conferma'?'selected':'').'>Conferma</option>
                                                                        <option value="ConfermaC" '.($_REQUEST['TipoRichiesta']=='ConfermaC'?'selected':'').'>Prenotazione Confermata</option>
                                                                      </select>
                                                                  </div>
                                                            </div>';
                                      }
                                      if($_SERVER['REQUEST_URI']=='/prenotazioni/'){
                                        $form_ricerca .= '<div class="form-group">
                                                            <label for="TipoCamere" class="control-label"><b>Camere</b></label>
                                                                <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="fa fa-bed fa-fw"></i></span>
                                                                  <select name="TipoCamere" id="TipoCamere" class = "form-control">
                                                                    <option value="">--</option>
                                                                    '.$ListaCamere.'
                                                                  </select>
                                                              </div>
                                                          </div>';
                                    }
                                    if($_SERVER['REQUEST_URI']=='/preventivi/' || $_SERVER['REQUEST_URI']=='/conferme/'){
                                      $form_ricerca .= '  <div class="form-group">
                                                              <label for="TipoSoggiorno" class="control-label"><b>Soggiorno</b></label>
                                                                  <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="fa fa-bed fa-fw"></i></span>
                                                                      <select name="TipoSoggiorno" id="TipoSoggiorno" class = "form-control">
                                                                        <option value="">--</option>
                                                                        '.$ListaSoggiorno.'
                                                                      </select>
                                                                  </div>
                                                            </div>';
                                    }
                                      $form_ricerca .= '</div>';
                                    if($_SERVER['REQUEST_URI']=='/prenotazioni/'){
                                      $form_ricerca .= '<div class="col-md-4">
                                                            <div class="form-group">
                                                              <label for="TipoSoggiorno" class="control-label"><b>Soggiorno</b></label>
                                                              <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="fa fa-bed fa-fw"></i></span>
                                                                    <select name="TipoSoggiorno" id="TipoSoggiorno" class = "form-control">
                                                                      <option value="">--</option>
                                                                      '.$ListaSoggiorno.'
                                                                    </select>
                                                                </div>
                                                            </div>
                                                          </div>';
                                    }
                                    if($_SERVER['REQUEST_URI']=='/preventivi/' || $_SERVER['REQUEST_URI']=='/conferme/'){
                                          $form_ricerca .= '
                                                            <div class="col-md-4">
                                                              <div class="form-group">
                                                                <label for="DataScadenza" class="control-label"><b>Scadenza</b> <span class="f-11">(>=)</span></label>
                                                                  <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                                    <input id="DataScadenza" name="DataScadenza" type="date" class="form-control" value="'.$_REQUEST['DataScadenza'].'" autocomplete="off">
                                                                  </div>
                                                              </div>
                                                            </div>';

                                    }

                                  if($_SERVER['REQUEST_URI']=='/annullate/' || strstr($_SERVER['REQUEST_URI'],'/annullate/')){
                                    $form_ricerca .= '
                                                      <div class="col-md-4">
                                                        <div class="form-group">
                                                          <label for="Motivo" class="control-label"><b>Motivazione</b></label>
                                                          <div class="input-group input-group-primary">
                                                          <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                                            <select name="Motivo" id="Motivo" class="form-control">
                                                              <option value="">--</option>
                                                              <option value="Assenza Disponibilità">Assenza Disponibilità</option>
                                                              <option value="Struttura Ricettiva Chiusa">Struttura Ricettiva Chiusa</option>
                                                              <option value="Rinuncia del Cliente">Rinuncia del Cliente</option>
                                                              <option value="Altro">Altro</option>
                                                            </select>
                                                          </div>
                                                        </div>
                                                      </div>';
                                  }
                                      $form_ricerca .= '</div>
                                                          <div class="row">
                                                            <div class="col-md-4">
	                                                              <div class="form-group">
	                                                                <label for="Operatore" class="control-label"><b>Operatore</b></label>
                                                                    <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                                                      <select name="Operatore" id="Operatore" class="form-control">
                                                                      <option value="">--</option>
                                                                      '.$ListaOperatori.'
                                                                      </select>
                                                                    </div>
	                                                              </div>
                                                              </div>
                                                              <div class="col-md-4">
                                                              <div class="form-group">
                                                                <label for="FontePrenotazione" class="control-label"><b>Fonte</b></label>
                                                                    <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="fa fa-shield fa-fw"></i></span>
                                                                      <select name="FontePrenotazione" id="FontePrenotazione" class="form-control">
                                                                      <option value="">--</option>
                                                                      '.$ListaFonti.'
                                                                      </select>
                                                                    </div>
                                                              </div>
                                                            </div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                <label for="TipoVacanza" class="control-label"><b>Target</b></label>
                                                                    <div class="input-group input-group-primary">
                                                                      <span class="input-group-addon"><i class="fa fa-suitcase fa-fw"></i></span>
                                                                      <select name="TipoVacanza" id="TipoVacanza" class="form-control">
                                                                      <option value="">--</option>
                                                                        '.$Target.'
                                                                      </select>
                                                                  </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <div class="row">
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                <label for="Nome" class="control-label"><b>Nome</b> <span class="f-11">(like)</span></label>
                                                                    <div class="input-group input-group-primary">
                                                                      <span class="input-group-addon"><i class="fa fa-male fa-fw"></i></span>
                                                                        <input type="text" name="Nome" id="Nome" class="form-control" value="'.$_REQUEST['Nome'].'">
                                                                  </div>
                                                              </div>
                                                            </div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                <label for="Cognome" class="control-label"><b>Cognome</b> <span class="f-11">(like)</span></label>
                                                                    <div class="input-group input-group-primary">
                                                                      <span class="input-group-addon"><i class="fa fa-male fa-fw"></i></span>
                                                                      <input type="text" name="Cognome" id="Cognome" class="form-control" value="'.$_REQUEST['Cognome'].'">
                                                                  </div>
                                                              </div>
                                                            </div>
                                                             <div class="col-md-4">
                                                                <div class="form-group">
                                                                <label for="Email" class="control-label"><b>Email</b> <span class="f-11">(=)</span></label>
                                                                  <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                                                                    <input type="text" name="Email" id="Email" class="form-control" value="'.$_REQUEST['Email'].'">
                                                                </div>
                                                              </div>
                                                          </div>
                                                          </div>
                                                          <div class="row">
                                                          <div class="col-md-4">
                                                              <div class="form-group">
                                                                <label for="Lingua" class="control-label"><b>Lingua</b></label>
                                                                    <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="fa fa-flag fa-fw"></i></span>
                                                                      <select name="Lingua" id="Lingua" class="form-control">
                                                                      <option value="">--</option>
                                                                        <option value="it" '.($_REQUEST['Lingua']=='it'?'selected':'').'>IT</option>
                                                                        <option value="en" '.($_REQUEST['Lingua']=='en'?'selected':'').'>EN</option>
                                                                        <option value="fr" '.($_REQUEST['Lingua']=='fr'?'selected':'').'>FR</option>
                                                                        <option value="de" '.($_REQUEST['Lingua']=='de'?'selected':'').'>DE</option>
                                                                      </select>
                                                                    </div>
                                                              </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                              <div class="form-group">
                                                                <label for="DataArrivo" class="control-label"><b>Arrivo</b> <span class="f-11">(>=)</span></label>
                                                                  <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                                    <input id="DataArrivo" name="DataArrivo" type="date" class="form-control" value="'.$_REQUEST['DataArrivo'].'" autocomplete="off">
                                                                </div>
                                                              </div>
                                                              </div>
                                                            <div class="col-md-4">
                                                              <div class="form-group">
                                                                <label for="DataPartenza" class="control-label"><b>Partenza</b> <span class="f-11">(<=)</span></label>
                                                                  <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                                    <input id="DataPartenza" name="DataPartenza" type="date" class="form-control" value="'.$_REQUEST['DataPartenza'].'" autocomplete="off">
                                                                </div>
                                                              </div>
                                                             </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">';

                                      $form_ricerca .= ' <div class="col-md-4">
                                                                  <div class="form-group">
                                                                    <label  class="control-label"><b>Data richiesta Dal</b> <span class="f-11">(>=)</span></label>
                                                                      <div class="input-group input-group-primary">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                                        <input type="date" id="DataRichiesta_dal_f" autocomplete="off"  class="form-control" name="DataRichiesta_dal" value="'.$_REQUEST['DataRichiesta_dal'].'">
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                  <div class="form-group">
                                                                      <label class="control-label"><b>Data richiesta Al</b> <span class="f-11">(<=)</span></label>
                                                                      <div class="input-group input-group-primary">
                                                                          <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                                          <input  type="date" id="DataRichiesta_al_f" autocomplete="off"  class="form-control" name="DataRichiesta_al" value="'.$_REQUEST['DataRichiesta_al'].'">
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <div class="col-md-4">';
                                    if(($_SERVER['REQUEST_URI']=='/preventivi/' || strstr($_SERVER['REQUEST_URI'],'/preventivi/')) || ($_SERVER['REQUEST_URI']=='/conferme/' || strstr($_SERVER['REQUEST_URI'],'/conferme/'))){

                                      $form_ricerca .= '          <div class="form-group">
                                                                      <label class="control-label"><b>Invio <small>Preventivo e/o ...in Trattativa</small></b> <span style="f-11">(=)</span></label>
                                                                      <div class="input-group input-group-primary">
                                                                          <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                                          <input  type="date" id="DataInvio" autocomplete="off"  class="form-control" name="DataInvio" value="'.$_REQUEST['DataInvio'].'">
                                                                      </div>
                                                                  </div>';
                                    }
                                  
                                      $form_ricerca .= '      </div>
                                                            </div>';
                                  if($_SERVER['REQUEST_URI']=='/annullate/' || strstr($_SERVER['REQUEST_URI'],'/annullate/')){
                                    if($_SERVER['REQUEST_URI']=='/prenotazioni/'){
                                      $form_ricerca .= '    <div class="row">
                                                              <div class="col-md-4">
                                                                  <div class="form-group">
                                                                    <label  class="control-label"><b>Data Prenotazione Dal</b> <span class="f-11">(>=)</span></label>
                                                                      <div class="input-group input-group-primary">
                                                                          <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                                        <input type="date" id="DataPrenotazione_dal" autocomplete="off"  class="form-control" name="DataPrenotazione_dal" value="'.$_REQUEST['DataPrenotazione_dal'].'">
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                  <div class="form-group">
                                                                      <label class="control-label"><b>Data Prenotazione Al</b> <span class="f-11">(<=)</span></label>
                                                                        <div class="input-group input-group-primary">
                                                                          <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                                            <input  type="date" id="DataPrenotazione_al" autocomplete="off"  class="form-control" name="DataPrenotazione_al" value="'.$_REQUEST['DataPrenotazione_al'].'">
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <div class="col-md-4"></div>
                                                            </div>
                                                            <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label  class="control-label"><b>Check-in (Arrivo) Dal</b> <span class="f-11">(>=)</span></label>
                                                                    <div class="input-group input-group-primary">
                                                                      <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                                      <input type="date" id="Arrivo_dal" autocomplete="off"  class="form-control" name="Arrivo_dal" value="'.$_REQUEST['Arrivo_dal'].'">
                                                                  </div>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label"><b>Check-in (Arrivo) Al</b> <span class="f-11">(<=)</span></label>
                                                                    <div class="input-group input-group-primary">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                                        <input  type="date" id="Arrivo_al" autocomplete="off"  class="form-control" name="Arrivo_al" value="'.$_REQUEST['Arrivo_al'].'">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4"></div>
                                                          </div>';
                                      }
                                    }
                                      $form_ricerca .= ' <div class="clearfix p-b-10"></div>
                                                          <div class="row">
                                                            <div class="col-md-12 text-center">
                                                              <label>Legenda: <span class="f-11">(like) contiene; (=) uguale; (>=) maggiore uguale; (<=) minore uguale;</span></label>
                                                            </div>
                                                          </div>
                                                          <div class="clearfix p-b-10"></div>
                                                          <div class="row">
                                                            <div class="col-md-12 text-center">
                                                              <div class="form-group">
                                                                <input type="hidden" name="action" value="search">
                                                                <a href="'.BASE_URL_SITO.'preventivi/" class="btn btn-inverse col-md-5">Reset</a>
                                                                <button type="submit" class="btn btn-primary col-md-5" id="bottone">Cerca</button>
                                                              </div>
                                                            </div>
                                                          </div>
                                                    </form>
                                                    </div>
                                                </div>
                                              </div>
                                            </div>';

echo $form_ricerca;
?>
