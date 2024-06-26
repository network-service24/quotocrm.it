 <?php
    $row = $dbMysqli->query("SELECT * FROM hospitality_target WHERE idsito = ".IDSITO." ORDER BY Id ASC");
    foreach($row as $chiave => $valore){
        $Target .='<option value="'.$valore['Target'].'" '.($_REQUEST['TipoVacanza']==$valore['Target']?'selected':'').' >'.$valore['Target'].'</option>';
    }
    $rws = $dbMysqli->query("SELECT * FROM hospitality_fonti_prenotazione WHERE Abilitato = 1 AND idsito = ".IDSITO." ORDER BY FontePrenotazione ASC");

    foreach($rws as $key => $v){
        $ListaFonti .='<option value="'.$v['FontePrenotazione'].'" '.($_REQUEST['FontePrenotazione']==$v['FontePrenotazione']?'selected':'').'>'.$v['FontePrenotazione'].'</option>';
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
    }

    $q  = " SELECT 
            hospitality_tipo_voucher_cancellazione.*
        FROM 
            hospitality_tipo_voucher_cancellazione 
        WHERE 
            hospitality_tipo_voucher_cancellazione.idsito = ".IDSITO." 
        AND 
            hospitality_tipo_voucher_cancellazione.Abilitato = 1 ";
    $array_r     = $dbMysqli->query($q);
    foreach($array_r as $c => $vl){
        $motiv .= '<option value="'.$vl['Id'].'" data-id="'.$vl['Id'].'" '.($_REQUEST['IdMotivazione']==$vl['Id']?'selected':'').'>'.$vl['Motivazione'].'</option>';
    }
    $form_ricerca .= '
                                    <div class="modal fade" id="myModalASearch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h4 class="modal-title"><i class="fa fa-search fa-2x fa-fw text-black"></i>  Ricerca avanzata</h4>
                                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              </div>
                                              <div class="modal-body" style="line-height:10px!important">
                                                    <form  method="POST" id="form_search" name="form_search" action="'.$_SERVER['REQUEST_URI'].'">';
                                        if($fun->check_vista(IDSITO)==true){
                                          $form_ricerca .= '<div class="row">
                                                              <div class="col-md-4">
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
                                                            </div>';
                                        }                                                
  $form_ricerca .= '                              <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                          <label for="TipoCamere" class="control-label"><b>Camera</b></label>
                                                                <div class="input-group input-group-primary">
                                                                  <span class="input-group-addon"><i class="fa fa-bed fa-fw"></i></span>
                                                                  <select name="TipoCamere" id="TipoCamere" class="form-control">
                                                                  <option value="">--</option>
                                                                    '.$ListaCamere.'
                                                                  </select>
                                                                </div>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-4">
                                                          <div class="form-group">
                                                            <label for="TipoSoggiorno" class="control-label"><b>Tipo Soggiorno</b></label>
                                                                 <div class="input-group input-group-primary">
                                                                  <span class="input-group-addon"><i class="fa fa-bed fa-fw"></i></span>                                                           
                                                                    <select name="TipoSoggiorno" id="TipoSoggiorno" class="form-control">
                                                                    <option value="">--</option>
                                                                      '.$ListaSoggiorno.'
                                                                    </select>
                                                                </div>
                                                          </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                          <div class="form-group">
                                                            <label for="NoDisponibilita" class="control-label"><b>Conf/Prev Annullata</b></label>
                                                                <div class="input-group input-group-primary">
                                                                  <span class="input-group-addon"><i class="fa fa-minus-circle fa-fw"></i></span>   
                                                                  <select name="NoDisponibilita" id="NoDisponibilita" class="form-control">
                                                                  <option value="">--</option>
                                                                    <option value="1" '.($_REQUEST['NoDisponibilita']=='1'?'selected':'').'>SI</option>
                                                                    <option value="0" '.($_REQUEST['NoDisponibilita']=='0'?'selected':'').'>NO</option>
                                                                  </select>
                                                              </div>
                                                          </div>
                                                        </div>
                                                      </div>
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
                                                            <div class="col-md-4">
                                                              <div class="form-group">
                                                                <label for="TipoRichiesta" class="control-label"><b>Richiesta</b></label>                                                                
                                                                    <div class="input-group input-group-primary">
                                                                      <span class="input-group-addon"><i class="icofont icofont-queen fa-fw"></i></span>                                                                 
                                                                        <select name="TipoRichiesta" id="TipoRichiesta" class="form-control">
                                                                        <option value="">--</option>
                                                                          <option value="Preventivo" '.($_REQUEST['TipoRichiesta']=='Preventivo'?'selected':'').'>Preventivo</option>
                                                                          <option value="Conferma" '.($_REQUEST['TipoRichiesta']=='Conferma'?'selected':'').'>Conferma</option>
                                                                          <option value="ConfermaC" '.($_REQUEST['TipoRichiesta']=='ConfermaC'?'selected':'').'>Prenotazione Chiusa</option>
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
                                                          </div>
                                                          <div class="row">
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
                                                        </div>
                                                          <div class="row">
                                                              <div class="col-md-4">

                                                              <div class="form-group">
                                                                <label for="Email" class="control-label"><b>Email</b> <span class="f-11">(=)</span></label>
                                                                <div class="input-group input-group-primary">
                                                                  <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                                                                  <input type="text" name="Email" id="Email" class="form-control" value="'.$_REQUEST['Email'].'">
                                                                </div>
                                                              </div>

                                                            </div>
                                                            <div class="col-md-4">
                                                              <div class="form-group">
                                                                <label for="DataArrivo" class="control-label"><b>Arrivo</b> <span class="f-11">(>=)</span></label>
                                                                    <div class="input-group input-group-primary">
                                                                      <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>                                                                 
                                                                      <input id="DataArrivo" name="DataArrivo" type="date" class="date-picker form-control" value="'.$_REQUEST['DataArrivo'].'" autocomplete="off">
                                                                  </div>
                                                              </div>
                                                              </div>
                                                            <div class="col-md-4">
                                                              <div class="form-group">
                                                                <label for="DataPartenza" class="control-label"><b>Partenza</b> <span class="f-11">(<=)</span></label>
                                                                    <div class="input-group input-group-primary">
                                                                      <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>                                                                  
                                                                      <input id="DataPartenza" name="DataPartenza" type="date" class="date-picker form-control" value="'.$_REQUEST['DataPartenza'].'" autocomplete="off">
                                                                    </div>
                                                              </div>
                                                              </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                  <div class="form-group">
                                                                  <label for="Chiuso" class="control-label"><b>Prenotazione Confermata</b></label>
                                                                    <div class="input-group input-group-primary">
                                                                      <span class="input-group-addon"><i class="fa fa-euro fa-fw"></i></span>                                                                    
                                                                          <select name="Chiuso" id="Chiuso" class="form-control">
                                                                          <option value="">--</option>
                                                                            <option value="1" '.($_REQUEST['Chiuso']=='1'?'selected':'').'>SI</option>
                                                                            <option value="0" '.($_REQUEST['Chiuso']=='0'?'selected':'').'>NO</option>
                                                                          </select>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label for="Disdetta" class="control-label"><b>Prenotazione Disdetta</b></label>
                                                                    <div class="input-group input-group-primary">
                                                                      <span class="input-group-addon"><i class="fa fa-minus-circle fa-fw"></i></span>                                                                   
                                                                        <select name="Disdetta" id="Disdetta" class="form-control">
                                                                        <option value="">--</option>
                                                                          <option value="1" '.($_REQUEST['Disdetta']=='1'?'selected':'').'>SI</option>
                                                                          <option value="0" '.($_REQUEST['Disdetta']=='0'?'selected':'').'>NO</option>
                                                                        </select>
                                                                      </div>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label  class="control-label"><b>Motivazione</b> <small>Buono Voucher</small></label>
                                                                    <div class="input-group input-group-primary">
                                                                      <span class="input-group-addon"><i class="fa fa-tags fa-fw"></i></span>                                                                   
                                                                        <select name="IdMotivazione" id="IdMotivazione" class="form-control">
                                                                          <option value=""  data-id="0" >--</option>
                                                                          '.$motiv.'
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <div class="row">
                                                              <div class="col-md-4">
                                                                  <div class="form-group">
                                                                  <label for="CS_inviato" class="control-label"><b>Questionario</b></label>
                                                                    <div class="input-group input-group-primary">
                                                                      <span class="input-group-addon"><i class="fa fa-question-circle fa-fw"></i></span>                                                                     
                                                                        <select name="CS_inviato" id="CS_inviato" class="form-control">
                                                                        <option value="">--</option>
                                                                          <option value="1" '.($_REQUEST['CS_inviato']=='1'?'selected':'').'>Inviato</option>
                                                                          <option value="0" '.($_REQUEST['CS_inviato']=='0'?'selected':'').'>Non Inviato</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                               <div class="col-md-4">
                                                                <div class="form-group">
                                                                <label for="CheckConsensoPrivacy" class="control-label"><b>Consenso Tratt. Dati</b></label>
                                                                    <div class="input-group input-group-primary">
                                                                      <span class="input-group-addon"><i class="fa fa-legal fa-fw"></i></span>                                                                  
                                                                        <select name="CheckConsensoPrivacy" id="CheckConsensoPrivacy" class="form-control">
                                                                        <option value="">--</option>
                                                                          <option value="1" '.($_REQUEST['CheckConsensoPrivacy']=='1'?'selected':'').'>SI</option>
                                                                          <option value="0" '.($_REQUEST['CheckConsensoPrivacy']=='0'?'selected':'').'>NO</option>
                                                                        </select>
                                                                  </div>
                                                              </div>
                                                            </div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                <label for="CheckConsensoMarketing" class="control-label"><b>Consenso Marketing</b></label>
                                                                    <div class="input-group input-group-primary">
                                                                      <span class="input-group-addon"><i class="fa fa-legal fa-fw"></i></span>                                                                 
                                                                        <select name="CheckConsensoMarketing" id="CheckConsensoMarketing" class="form-control">
                                                                        <option value="">--</option>
                                                                          <option value="1" '.($_REQUEST['CheckConsensoMarketing']=='1'?'selected':'').'>SI</option>
                                                                          <option value="0" '.($_REQUEST['CheckConsensoMarketing']=='0'?'selected':'').'>NO</option>
                                                                        </select>
                                                                  </div>
                                                              </div>
                                                            </div>
                                                            </div>

                                                            <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label  class="control-label"><b>Archiviata</b></label>
                                                                     <div class="input-group input-group-primary">
                                                                      <span class="input-group-addon"><i class="fa fa-archive fa-fw"></i></span>                                                                   
                                                                        <select name="Archivia" id="Archivia" class="form-control">
                                                                          <option value="">--</option>
                                                                          <option value="1" '.($_REQUEST['Archivia']=='1'?'selected':'').'>SI</option>
                                                                          <option value="0" '.($_REQUEST['Archivia']=='0'?'selected':'').'>NO</option>
                                                                        </select>
                                                                
                                                                  </div>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label  class="control-label"><b>Cestinata</b></label>
                                                                    <div class="input-group input-group-primary">
                                                                      <span class="input-group-addon"><i class="fa fa-trash fa-fw"></i></span>  
                                                                        <select name="Hidden" id="Hidden" class="form-control">
                                                                          <option value="">--</option>
                                                                          <option value="1" '.($_REQUEST['Hidden']=='1'?'selected':'').'>SI</option>
                                                                          <option value="0" '.($_REQUEST['Hidden']=='0'?'selected':'').'>NO</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                                          </div>
                                                          <hr>
                                                            <div class="row">
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label  class="control-label"><b>Data Prenotazione Dal</b> <span class="f-11">(>=)</span></label>
                                                                    <div class="input-group input-group-primary">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>                                                                  
                                                                        <input type="date" id="DataPrenotazione_dal" autocomplete="off"  class="date-picker form-control" name="DataPrenotazione_dal" value="'.$_REQUEST['DataPrenotazione_dal'].'">
                                                                    </div>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label"><b>Data Prenotazione Al</b> <span class="f-11">(<=)</span></label>
                                                                    <div class="input-group input-group-primary">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>                                                                    
                                                                        <input  type="date" id="DataPrenotazione_al" autocomplete="off"  class="date-picker form-control" name="DataPrenotazione_al" value="'.$_REQUEST['DataPrenotazione_al'].'">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2"></div>
                                                          </div>
                                                          '.(!$_REQUEST['azione']?'':'
                                                            <div class="row">
                                                              <div class="col-md-12 text-center">
                                                                  <div class="alert alert-info text-black text-center f-11">
                                                                    <b>Suggerimenti e trucchi:</b><div class="clearfix p-b-10"></div> Impostando le <b>date richiesta</b>; il filtro per <b>anno</b> ('.$_REQUEST['azione'].') viene <b>annullato</b>, quindi siete liberi di andare '.($_REQUEST['azione']==date('Y')?'':'avanti e/o').' indietro nel tempo!
                                                                    <br><br>
                                                                    <em>Esempio: Dal 01/01/2020 ad oggi '.date('d/m/Y').',  ed effettuate una ricerca per Nome, Cognome e/o Numero prenotazione, ecc., il filtro viene applicato su tutto il DB dal 2020 al '.date('Y').', e non solo nell\'anno della schermata scelta!</em>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                          ').'                                                 
                                                          <div class="row">
                                                          <div class="col-md-2"></div>
                                                          <div class="col-md-4">
                                                              <div class="form-group">
                                                                <label  class="control-label"><b>Data Richiesta Dal</b> <span class="f-11">(>=)</span></label>
                                                                    <div class="input-group input-group-primary">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                                        <input type="date" id="DataRichiesta_dal" autocomplete="off"  class="date-picker form-control" name="DataRichiesta_dal" value="'.$_REQUEST['DataRichiesta_dal'].'">
                                                                    </div>
                                                              </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                              <div class="form-group">
                                                                  <label class="control-label"><b>Data Richiesta Al</b> <span class="f-11">(<=)</span></label>
                                                                    <div class="input-group input-group-primary">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                                        <input  type="date" id="DataRichiesta_al" autocomplete="off"  class="date-picker form-control" name="DataRichiesta_al" value="'.$_REQUEST['DataRichiesta_al'].'">
                                                                    </div> 
                                                             </div>
                                                          </div>
                                                          <div class="col-md-2"></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label  class="control-label"><b>Check-in (Arrivo) Dal</b> <span class="f-11">(>=)</span></label>
                                                                    <div class="input-group input-group-primary">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                                        <input type="date" id="Arrivo_dal" autocomplete="off"  class="date-picker form-control" name="Arrivo_dal" value="'.$_REQUEST['Arrivo_dal'].'">
                                                                     </div>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label"><b>Check-in (Arrivo) Al</b> <span class="f-11">(<=)</span></label>
                                                                       <div class="input-group input-group-primary">
                                                                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                                            <input  type="date" id="Arrivo_al" autocomplete="off"  class="date-picker form-control" name="Arrivo_al" value="'.$_REQUEST['Arrivo_al'].'">
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2"></div>
                                                          </div>
                                                          <div class="clearfix p-b-10"></div> 
                                                          <div class="row">
                                                            <div class="col-md-12 text-center">
                                                              <label><span class="f-11"><b>Legenda:</b> (like) contiene; (=) uguale; (>=) maggiore uguale; (<=) minore uguale;</span></label>
                                                            </div>
                                                          </div> 
                                                          <div class="clearfix p-b-10"></div>
                                                            <div class="row">
                                                            <div class="col-md-12 text-center">
                                                              <div class="form-group">
                                                                <input type="hidden" name="action" value="search">
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