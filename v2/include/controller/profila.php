<?php
  if($_REQUEST['azione'] == 'change' && $_REQUEST['param'] != '') {

      $id_richiesta       = $_REQUEST['param'];
      $valore_marketing   = 1;


      $db->query('UPDATE hospitality_guest SET CheckConsensoMarketing = '.$valore_marketing.'  WHERE Id = ' . $id_richiesta);

      $db->query("INSERT INTO log_consenso_notifiche (id_richiesta,data,log) VALUES('".$id_richiesta."','".date('Y-m-d H:i:s')."','Il consenso all\'invio di materiale marketing è stato abilitato da una vostra azione il ".date('d-m-Y H.i.s').", la responsabilità di questa scelta è totalmente a vostro carico liberando Network Service da ogni onere ed obbligo!')");

      header('Location:'.BASE_URL_SITO.'profila/');

  }

    $db->query("SELECT * FROM hospitality_target WHERE idsito = ".IDSITO." ORDER BY Id ASC");
    $row = $db->result();
    foreach($row as $chiave => $valore){
        $Target .='<option value="'.$valore['Target'].'" '.($_REQUEST['TipoVacanza']==$valore['Target']?'selected':'').' >'.$valore['Target'].'</option>';
    }
    $db->query("SELECT * FROM hospitality_fonti_prenotazione WHERE Abilitato = 1 AND idsito = ".IDSITO." ORDER BY FontePrenotazione ASC");
    $rws = $db->result();
    foreach($rws as $key => $v){
        $ListaFonti .='<option value="'.$v['FontePrenotazione'].'" '.($_REQUEST['FontePrenotazione']==$v['FontePrenotazione']?'selected':'').'>'.$v['FontePrenotazione'].'</option>';
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
    $form_ricerca .= '
                                    <div class="modal fade" id="myModalASearch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalASearch">Filtri avanzati</h4>
                                              </div>
                                              <div class="modal-body" style="line-height:10px!important">
                                                    <form  method="POST" id="form_search" name="form_search" action="'.$_SERVER['REQUEST_URI'].'">
                                                    <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                          <label for="TipoCamere" class="control-label">Camera</label>
                                                          <select name="TipoCamere" id="TipoCamere" class="form-control">
                                                          <option value="">--</option>
                                                            '.$ListaCamere.'
                                                          </select>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-4">
                                                          <div class="form-group">
                                                            <label for="TipoSoggiorno" class="control-label">Tipo Soggiorno</label>
                                                            <select name="TipoSoggiorno" id="TipoSoggiorno" class="form-control">
                                                            <option value="">--</option>
                                                              '.$ListaSoggiorno.'
                                                            </select>
                                                          </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                          <div class="form-group">
                                                            <label for="NoDisponibilita" class="control-label">Conf/Prev Annullata</label>
                                                            <select name="NoDisponibilita" id="NoDisponibilita" class="form-control">
                                                            <option value="">--</option>
                                                              <option value="1" '.($_REQUEST['NoDisponibilita']=='1'?'selected':'').'>SI</option>
                                                              <option value="0" '.($_REQUEST['NoDisponibilita']=='0'?'selected':'').'>NO</option>
                                                            </select>
                                                          </div>
                                                        </div>
                                                      </div>
                                                          <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label for="NumeroPrenotazione" class="control-label">Nr.</label>
                                                                  <input type="text" name="NumeroPrenotazione" id="NumeroPrenotazione" class="form-control" value="'.$_REQUEST['NumeroPrenotazione'].'">
                                                                </div>
                                                              </div>
                                                            <div class="col-md-4">
                                                              <div class="form-group">
                                                                <label for="TipoRichiesta" class="control-label">Richiesta</label>
                                                                <select name="TipoRichiesta" id="TipoRichiesta" class="form-control">
                                                                <option value="">--</option>
                                                                  <option value="Preventivo" '.($_REQUEST['TipoRichiesta']=='Preventivo'?'selected':'').'>Preventivo</option>
                                                                  <option value="Conferma" '.($_REQUEST['TipoRichiesta']=='Conferma'?'selected':'').'>Conferma</option>
                                                                  <option value="ConfermaC" '.($_REQUEST['TipoRichiesta']=='ConfermaC'?'selected':'').'>Prenotazione Chiusa</option>
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
                                                          </div>
                                                          <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label for="TipoVacanza" class="control-label">Tipo</label>
                                                                  <select name="TipoVacanza" id="TipoVacanza" class="form-control">
                                                                  <option value="">--</option>
                                                                    '.$Target.'
                                                                  </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label for="Nome" class="control-label">Nome</label>
                                                                  <input type="text" name="Nome" id="Nome" class="form-control" value="'.$_REQUEST['Nome'].'">
                                                                </div>
                                                            </div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                <label for="Cognome" class="control-label">Cognome</label>
                                                                <input type="text" name="Cognome" id="Cognome" class="form-control" value="'.$_REQUEST['Cognome'].'">
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
                                                                <label for="DataArrivo" class="control-label">Arrivo</label>
                                                                <input id="DataArrivo" name="DataArrivo" type="text" class="date-picker form-control" value="'.$_REQUEST['DataArrivo'].'" autocomplete="off">
                                                              </div>
                                                              </div>
                                                            <div class="col-md-4">
                                                              <div class="form-group">
                                                                <label for="DataPartenza" class="control-label">Partenza</label>
                                                                <input id="DataPartenza" name="DataPartenza" type="text" class="date-picker form-control" value="'.$_REQUEST['DataPartenza'].'" autocomplete="off">
                                                              </div>
                                                              </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                  <div class="form-group">
                                                                  <label for="Chiuso" class="control-label">Prenotazione Confermata</label>
                                                                  <select name="Chiuso" id="Chiuso" class="form-control">
                                                                  <option value="">--</option>
                                                                    <option value="1" '.($_REQUEST['Chiuso']=='1'?'selected':'').'>SI</option>
                                                                    <option value="0" '.($_REQUEST['Chiuso']=='0'?'selected':'').'>NO</option>
                                                                  </select>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label for="Disdetta" class="control-label">Prenotazione Disdetta</label>
                                                                  <select name="Disdetta" id="Disdetta" class="form-control">
                                                                  <option value="">--</option>
                                                                    <option value="1" '.($_REQUEST['Disdetta']=='1'?'selected':'').'>SI</option>
                                                                    <option value="0" '.($_REQUEST['Disdetta']=='0'?'selected':'').'>NO</option>
                                                                  </select>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label  class="control-label">Motivazione <small>Buono Voucher</small></label>
                                                                  <select name="IdMotivazione" id="IdMotivazione" class="form-control">
                                                                    <option value=""  data-id="0" >--</option>
                                                                    '.$motiv.'
                                                                  </select>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <div class="row">
                                                              <div class="col-md-4">
                                                                  <div class="form-group">
                                                                  <label for="CS_inviato" class="control-label">Questionario</label>
                                                                  <select name="CS_inviato" id="CS_inviato" class="form-control">
                                                                  <option value="">--</option>
                                                                    <option value="1" '.($_REQUEST['CS_inviato']=='1'?'selected':'').'>SI</option>
                                                                    <option value="0" '.($_REQUEST['CS_inviato']=='0'?'selected':'').'>NO</option>
                                                                  </select>
                                                                </div>
                                                              </div>
                                                               <div class="col-md-4">
                                                                <div class="form-group">
                                                                <label for="CheckConsensoPrivacy" class="control-label">Consenso Tratt. Dati</label>
                                                                <select name="CheckConsensoPrivacy" id="CheckConsensoPrivacy" class="form-control">
                                                                <option value="">--</option>
                                                                  <option value="1" '.($_REQUEST['CheckConsensoPrivacy']=='1'?'selected':'').'>SI</option>
                                                                  <option value="0" '.($_REQUEST['CheckConsensoPrivacy']=='0'?'selected':'').'>NO</option>
                                                                </select>
                                                              </div>
                                                            </div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                <label for="CheckConsensoMarketing" class="control-label">Consenso Marketing</label>
                                                                <select name="CheckConsensoMarketing" id="CheckConsensoMarketing" class="form-control">
                                                                <option value="">--</option>
                                                                  <option value="1" '.($_REQUEST['CheckConsensoMarketing']=='1'?'selected':'').'>SI</option>
                                                                  <option value="0" '.($_REQUEST['CheckConsensoMarketing']=='0'?'selected':'').'>NO</option>
                                                                </select>
                                                              </div>
                                                            </div>
                                                            </div>

                                                            <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label  class="control-label">Archiviata</label>
                                                                  <select name="Archivia" id="Archivia" class="form-control">
                                                                    <option value="">--</option>
                                                                    <option value="1" '.($_REQUEST['Archivia']=='1'?'selected':'').'>SI</option>
                                                                    <option value="0" '.($_REQUEST['Archivia']=='0'?'selected':'').'>NO</option>
                                                                  </select>
                                                                </div>
                                                              </div>
                                                              <div class="col-md-4">
                                                                <div class="form-group">
                                                                  <label  class="control-label">Cestinata</label>
                                                                  <select name="Hidden" id="Hidden" class="form-control">
                                                                    <option value="">--</option>
                                                                    <option value="1" '.($_REQUEST['Hidden']=='1'?'selected':'').'>SI</option>
                                                                    <option value="0" '.($_REQUEST['Hidden']=='0'?'selected':'').'>NO</option>
                                                                  </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">

                                                            </div>
                                                          </div>
                                                          <hr>
                                                            <div class="row">
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
                                                                <label  class="control-label">Data Richiesta Dal <small style="font-weight:normal!important">(>=)</small></label>
                                                                <input type="text" id="DataRichiesta_dal" autocomplete="off"  class="date-picker form-control" name="DataRichiesta_dal" value="'.$_REQUEST['DataRichiesta_dal'].'">
                                                              </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                              <div class="form-group">
                                                                  <label class="control-label">Data Richiesta Al <small style="font-weight:normal!important">(<=)</small></label>
                                                                  <input  type="text" id="DataRichiesta_al" autocomplete="off"  class="date-picker form-control" name="DataRichiesta_al" value="'.$_REQUEST['DataRichiesta_al'].'">
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
                                                          </div>
                                                            <div class="row">
                                                            <div class="col-md-12 text-right" style="padding-top:25px">
                                                              <div class="form-group">
                                                                <input type="hidden" name="action" value="search">
                                                                <a href="'.BASE_URL_SITO.'profila/" class="btn btn-success" >Reset Filtro</a>
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
                                                $( "#DataRichiesta_dal" ).datepicker({
                                                  numberOfMonths: 1,
                                                  language:\'it\',
                                                  showButtonPanel: true
                                                });
                                                $( "#DataRichiesta_al" ).datepicker({
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

    $s = "SELECT data FROM hospitality_data_esport WHERE idsito = ".IDSITO." ORDER BY id DESC";
    $r = $db->query($s);
    $w = $db->row($r);
    if($w > 0){

        $datS    =  explode(" ",$w['data']);
        $dataS   =  explode("-",$datS[0]);
        $dataH   =  explode(":",$datS[1]);
        $data_export    =  '<h4>Ultimo export del '.$dataS[2].'-'.$dataS[1].'-'.$dataS[0].' alle '.$dataH[0].':'.$dataH[1].':'.$dataH[2].'</h4>';
    }else{
        $data_export    =  '<h4>Ultimo export del .... alle ....</h4>';
    }


    $xcrud->table('hospitality_guest');
    $xcrud->where('hospitality_guest.idsito', IDSITO);
    if($_REQUEST['action']=='search'){
        if($_REQUEST['NumeroPrenotazione']!=''){
            $xcrud->where('hospitality_guest.NumeroPrenotazione', $_REQUEST['NumeroPrenotazione']);
        }
/*         if($_REQUEST['TipoRichiesta']!=''){
            $xcrud->where('hospitality_guest.TipoRichiesta', $_REQUEST['TipoRichiesta']);
        } */
        if($_REQUEST['TipoRichiesta']!=''){
          if($_REQUEST['TipoRichiesta']=='Preventivo'){
              $xcrud->where('hospitality_guest.TipoRichiesta =  "'.$_REQUEST['TipoRichiesta'].'"');
          }elseif($_REQUEST['TipoRichiesta']=='Conferma'){
              $xcrud->where('hospitality_guest.TipoRichiesta =  "'.$_REQUEST['TipoRichiesta'].'"');
              $xcrud->where('hospitality_guest.Chiuso =  0');
          }elseif($_REQUEST['TipoRichiesta']=='ConfermaC'){
              $xcrud->where('hospitality_guest.TipoRichiesta =  "Conferma"');
              $xcrud->where('hospitality_guest.Chiuso =  1');
          }
        }
        if($_REQUEST['FontePrenotazione']!=''){
            $xcrud->where('hospitality_guest.FontePrenotazione', $_REQUEST['FontePrenotazione']);
        }
        if($_REQUEST['TipoVacanza']!=''){
            $xcrud->where('hospitality_guest.TipoVacanza', $_REQUEST['TipoVacanza']);
        }
        if($_REQUEST['Nome']!=''){
            $xcrud->where('hospitality_guest.Nome LIKE "%'.$_REQUEST['Nome'].'%"');
        }
        if($_REQUEST['Cognome']!=''){
            $xcrud->where('hospitality_guest.Cognome LIKE "%'.$_REQUEST['Cognome'].'%"');
        }
        if($_REQUEST['DataArrivo']!='' && $_REQUEST['DataPartenza'] ==''){
            $data_dal_tmp = explode("/",$_REQUEST['DataArrivo']);
            $data_dal = $data_dal_tmp[2].'-'.$data_dal_tmp[1].'-'.$data_dal_tmp[0];
            $xcrud->where('hospitality_guest.DataArrivo >= "'.$data_dal.'"');
        }
        if($_REQUEST['DataArrivo']!='' && $_REQUEST['DataPartenza'] !=''){
            $data_dal_tmp = explode("/",$_REQUEST['DataArrivo']);
            $data_dal = $data_dal_tmp[2].'-'.$data_dal_tmp[1].'-'.$data_dal_tmp[0];
            $data_al_tmp = explode("/",$_REQUEST['DataPartenza']);
            $data_al = $data_al_tmp[2].'-'.$data_al_tmp[1].'-'.$data_al_tmp[0];
            $xcrud->where('hospitality_guest.DataArrivo >= "'.$data_dal.'" AND hospitality_guest.DataPartenza <= "'.$data_al.'"');
        }
        if($_REQUEST['DataPrenotazione_dal']!='' && $_REQUEST['DataPrenotazione_al'] ==''){
          $dataP_dal_tmp = explode("/",$_REQUEST['DataPrenotazione_dal']);
          $dataP_dal = $dataP_dal_tmp[2].'-'.$dataP_dal_tmp[1].'-'.$dataP_dal_tmp[0];
          $xcrud->where('hospitality_guest.DataChiuso >= "'.$dataP_dal.'"');
        }
        if($_REQUEST['DataPrenotazione_dal']!='' && $_REQUEST['DataPrenotazione_al'] !=''){
            $dataP_dal_tmp = explode("/",$_REQUEST['DataPrenotazione_dal']);
            $dataP_dal = $dataP_dal_tmp[2].'-'.$dataP_dal_tmp[1].'-'.$dataP_dal_tmp[0];
            $dataP_al_tmp = explode("/",$_REQUEST['DataPrenotazione_al']);
            $dataP_al = $dataP_al_tmp[2].'-'.$dataP_al_tmp[1].'-'.$dataP_al_tmp[0];
            $xcrud->where('hospitality_guest.DataChiuso >= "'.$dataP_dal.'" AND hospitality_guest.DataChiuso <= "'.$dataP_al.'"');
        }

        if($_REQUEST['DataRichiesta_dal']!='' && $_REQUEST['DataRichiesta_al'] ==''){
          $dataR_dal_tmp = explode("/",$_REQUEST['DataRichiesta_dal']);
          $dataR_dal = $dataR_dal_tmp[2].'-'.$dataR_dal_tmp[1].'-'.$dataR_dal_tmp[0];
          $xcrud->where('hospitality_guest.DataRichiesta >= "'.$dataR_dal.'"');
        }
        if($_REQUEST['DataRichiesta_dal']!='' && $_REQUEST['DataRichiesta_al'] !=''){
            $dataR_dal_tmp = explode("/",$_REQUEST['DataRichiesta_dal']);
            $dataR_dal = $dataR_dal_tmp[2].'-'.$dataR_dal_tmp[1].'-'.$dataR_dal_tmp[0];
            $dataR_al_tmp = explode("/",$_REQUEST['DataRichiesta_al']);
            $dataR_al = $dataR_al_tmp[2].'-'.$dataR_al_tmp[1].'-'.$dataR_al_tmp[0];
            $xcrud->where('hospitality_guest.DataRichiesta >= "'.$dataR_dal.'" AND hospitality_guest.DataRichiesta <= "'.$dataR_al.'"');
        }


        if($_REQUEST['Arrivo_dal']!='' && $_REQUEST['Arrivo_al'] ==''){
          $dataA_dal_tmp = explode("/",$_REQUEST['Arrivo_dal']);
          $dataA_dal = $dataA_dal_tmp[2].'-'.$dataA_dal_tmp[1].'-'.$dataA_dal_tmp[0];
          $xcrud->where('hospitality_guest.DataArrivo >= "'.$dataA_dal.'"');
        }
        if($_REQUEST['Arrivo_dal']!='' && $_REQUEST['Arrivo_al'] !=''){
            $dataA_dal_tmp = explode("/",$_REQUEST['Arrivo_dal']);
            $dataA_dal = $dataA_dal_tmp[2].'-'.$dataA_dal_tmp[1].'-'.$dataA_dal_tmp[0];
            $dataA_al_tmp = explode("/",$_REQUEST['Arrivo_al']);
            $dataA_al = $dataA_al_tmp[2].'-'.$dataA_al_tmp[1].'-'.$dataA_al_tmp[0];
            $xcrud->where('hospitality_guest.DataArrivo >= "'.$dataA_dal.'" AND hospitality_guest.DataArrivo <= "'.$dataA_al.'"');
        }


        if($_REQUEST['Lingua']!=''){
            $xcrud->where('hospitality_guest.Lingua', $_REQUEST['Lingua']);
        }
        if($_REQUEST['Chiuso']!=''){
            $xcrud->where('hospitality_guest.Chiuso', $_REQUEST['Chiuso']);
        }
        if($_REQUEST['Disdetta']!=''){
            $xcrud->where('hospitality_guest.Disdetta', $_REQUEST['Disdetta']);
        }
        if($_REQUEST['CS_inviato']!=''){
            $xcrud->where('hospitality_guest.CS_inviato', $_REQUEST['CS_inviato']);
        }
        if($_REQUEST['IdMotivazione']!=''){
          $xcrud->where('hospitality_guest.IdMotivazione', $_REQUEST['IdMotivazione']);
        }
        if($_REQUEST['NoDisponibilita']!=''){
          $xcrud->where('hospitality_guest.NoDisponibilita', $_REQUEST['NoDisponibilita']);
        }
        if($_REQUEST['CheckConsensoPrivacy']!=''){
            $xcrud->where('hospitality_guest.CheckConsensoPrivacy', $_REQUEST['CheckConsensoPrivacy']);
        }
        if($_REQUEST['CheckConsensoMarketing']!=''){
            $xcrud->where('hospitality_guest.CheckConsensoMarketing', $_REQUEST['CheckConsensoMarketing']);
        }
        if($_REQUEST['Archivia']!=''){
            $xcrud->where('hospitality_guest.Archivia', $_REQUEST['Archivia']);
        }
        if($_REQUEST['Hidden']!=''){
            $xcrud->where('hospitality_guest.Hidden', $_REQUEST['Hidden']);
        }
        if($_REQUEST['TipoCamere']!=''){
            $xcrud->join('hospitality_guest.Id', 'hospitality_richiesta', 'id_richiesta');
            $xcrud->where('hospitality_richiesta.TipoCamere', $_REQUEST['TipoCamere']);
        }
        if($_REQUEST['TipoSoggiorno']!=''){
            $xcrud->join('hospitality_guest.Id', 'hospitality_richiesta', 'id_richiesta');
            $xcrud->where('hospitality_richiesta.TipoSoggiorno', $_REQUEST['TipoSoggiorno']);
        }
    }
    //$xcrud->where('hospitality_guest.Hidden', '0');
    $xcrud->order_by('hospitality_guest.DataRichiesta','DESC');
    $xcrud->order_by('hospitality_guest.TipoRichiesta','ASC');
    $xcrud->order_by('hospitality_guest.Chiuso','DESC');
    $xcrud->order_by('hospitality_guest.DataChiuso','DESC');


    $xcrud->columns('NumeroPrenotazione,TipoRichiesta,FontePrenotazione,TipoVacanza,Nome,Email,Lingua,DataArrivo,DataPartenza,DataChiuso,CS_Inviato,Disdetta,NoDisponibilita,Archivia,Hidden,Id,Ip', false);
    //$xcrud->fields('NumeroPrenotazione,TipoRichiesta,FontePrenotazione,TipoVacanza,Nome,Cognome,Email,Lingua,DataArrivo,DataPartenza,Chiuso,CS_Inviato', false);
    $xcrud->column_callback('TipoVacanza','bg_tipo');
    $xcrud->column_callback('FontePrenotazione','bg_fonte');

    $xcrud->change_type('Chiuso','bool');
    $xcrud->change_type('CS_Inviato','bool');
    $xcrud->column_callback('Disdetta','si_no');
    $xcrud->column_callback('Archivia','si_no');
    $xcrud->column_callback('Hidden','si_no');
    $xcrud->column_callback('NoDisponibilita','si_no_annullate');
    $xcrud->column_callback('CS_Inviato','si_no');
    $xcrud->column_callback('Id','dettaglio');
    $xcrud->column_callback('TipoRichiesta','CheckTipoRichiesta');
    $xcrud->column_callback('Ip','dett_consenso_dgpr');

    $xcrud->column_pattern('Nome' , '<small><b>{value} {Cognome}</b></small>');
    $xcrud->column_pattern('Cognome' , '<small><b>{value}</b></small>');
    $xcrud->column_pattern('Email' , '<small style=" white-space: nowrap;">{value}</small>');
    $xcrud->column_pattern('DataRichiesta' , '<small>{value}</small>');
    $xcrud->column_pattern('Lingua' , '<small>{value}</small>');
    $xcrud->column_callback('DataArrivo' , 'get_data_arrivo_profila');
    $xcrud->column_callback('DataPartenza' , 'get_data_partenza_profila');
    $xcrud->column_pattern('DataChiuso' , '<small>{value}</small>');

    $xcrud->column_callback('Cognome','strips_small_b');

    $xcrud->column_pattern('NumeroPrenotazione' , '<a href="'.BASE_URL_SITO.'timeline/{NumeroPrenotazione}" title="Timeline"  data-toogle="tooltip"><small>{value}</small></a>');

    $xcrud->column_tooltip('CS_Inviato', 'Questionario customer satisfaction inviato!', 'fa fa-life-ring text-white');
    $xcrud->column_tooltip('Disdetta', 'Disdetta', 'fa fa-life-ring text-white');
    $xcrud->column_tooltip('NoDisponibilita', 'Annullata', 'fa fa-life-ring text-white');
    $xcrud->column_tooltip('Archivia', 'Archiviata', 'fa fa-life-ring text-white');
    $xcrud->column_tooltip('Hidden', 'Cestinata', 'fa fa-life-ring text-white');

    $xcrud->label(array('FontePrenotazione' => 'Fonte',
                        'NumeroPrenotazione' => 'Nr.',
                                'TipoVacanza' => 'Tipo',
                                'Nome' => 'Nome Cognome',
                                'TipoRichiesta' => 'Richiesta',
                                'DataRichiesta' => 'Data Richiesta',
                                'Lingua' => 'Lg',
                                'DataArrivo' => 'Arrivo',
                                'DataPartenza' => 'Partenza',
                                'DataChiuso' => 'Data Prenotazione',
                                'CS_Inviato' => 'Q.',
                                'Disdetta' => 'D.',
                                'NoDisponibilita' => 'A.',
                                'Archivia' => 'Ar.',
                                'Hidden' => 'C.',
                                'Id' => '',
                                'Ip' => ''));


    //$xcrud->column_callback('Lingua','show_flags');

    $xcrud->highlight_row('Disdetta', '=', '1', '#E1E1E1');
    $xcrud->highlight_row('NoDisponibilita', '=', '1', '#F0F0F0');

    $xcrud->search_columns('TipoRichiesta,FontePrenotazione,TipoVacanza,Nome,Cognome,Email,Lingua,DataArrivo,DataPartenza,Chiuso,DataChiuso,CS_Inviato,Disdetta,CheckConsensoPrivacy,CheckConsensoMarketing');

    $xcrud->unset_title();
    $xcrud->unset_add();
    $xcrud->unset_edit();
    $xcrud->unset_view();
    $xcrud->unset_remove();
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers();
    $numero = paginazione(IDSITO);
    if(!isset($numero) || is_null($numero) || empty($numero)){
      $numero = 15;
    }
    $numero2 = ($numero*2);
    $numero3 = ($numero*3);
    $numero4 = ($numero*4);
    $xcrud->limit($numero);
    $xcrud->limit_list($numero.','.$numero2.','.$numero3.','.$numero4);

  $js_script_data_export ='
  <script>
    function ajaxcsv(){
        $.ajax({
                url: "'.BASE_URL_SITO.'ajax/update_ora_export.php",
                type: "POST",
                data: "idsito='.IDSITO.'",
                dataType: "html",
                success: function(data) {
                        $("#id_ora_export").html(data);
                    }
              });
            return false; // con false senza refresh della pagina
    }

    $("#pulsante_esporta").click(function(){
            setInterval(ajaxcsv(), 1000);
    });
    $("document").ready(function() {
      $("th[data-orderby=\'hospitality_guest.CS_Inviato\']").addClass("text-center");
      $("th[data-orderby=\'hospitality_guest.Disdetta\']").addClass("text-center");
      $("th[data-orderby=\'hospitality_guest.NoDisponibilita\']").addClass("text-center");
      $("th[data-orderby=\'hospitality_guest.Archivia\']").addClass("text-center");
      $("th[data-orderby=\'hospitality_guest.Hidden\']").addClass("text-center");
    });
  </script>'."\r\n";
