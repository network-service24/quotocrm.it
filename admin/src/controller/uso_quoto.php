<?

  $meno_1mese = mktime (0,0,0,(date('m')-1),date('d'),date('Y'));
  $prima_data_ = date('Y-m-d',$meno_1mese);
  $prima_data   = $prima_data_.' 00:00:00';
  $seconda_data = date('Y').'-'.date('m').'-31 23:59:59';
  $filter_query = " AND DataChiuso>= '".$prima_data."' AND DataChiuso <= '".$seconda_data."' ";

      $sql = "SELECT siti.idsito,siti.web, siti.data_end_hospitality
              FROM siti
              WHERE siti.hospitality = 1
              AND siti.web != ''
              GROUP BY siti.web
              ORDER BY siti.web ASC";
    $risultati = $dbMysqli->query($sql);
    foreach($risultati as $k => $rw){
      $lista_siti .= '<option value="'.$rw['idsito'].'" '.($rw['idsito']==$_REQUEST['idsito']?'selected="selected"':'').' '.($rw['data_end_hospitality']<=date('Y-m-d')?'style="color:#FF0000!important"':'').'>'.$rw['web'].'</option>';
    }



    function totale_fatturato($idsito,$tipo=null){
        global $dbMysqli;

        $select = "SELECT
                    SUM(hospitality_proposte.PrezzoP) as fatturato
                  FROM
                    hospitality_guest
                  INNER JOIN
                    hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                  WHERE
                    1 = 1
                  AND
                    hospitality_guest.idsito = ".$idsito."
                  AND
                    hospitality_guest.NoDisponibilita = 0
                  AND
                    hospitality_guest.Disdetta = 0
                  AND
                      hospitality_guest.Hidden = 0
                  AND
                    hospitality_guest.TipoRichiesta = 'Conferma'";

        $res = $dbMysqli->query($select);
        $rwc = $res[0];

        if($tipo == 'format'){
            return number_format($rwc['fatturato'],0,'.','');
        }else{
            return number_format($rwc['fatturato'],2,',','.');
        }

    }

    function totale_fatturato_anno($idsito,$inizio,$fine){
      global $dbMysqli;

      $select = "SELECT
                  SUM(hospitality_proposte.PrezzoP) as fatturato
                FROM
                  hospitality_guest
                INNER JOIN
                  hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                WHERE
                  1 = 1
                  AND ((hospitality_guest.DataRichiesta >= '$inizio'
                  AND hospitality_guest.DataRichiesta <= '$fine')
                  OR (hospitality_guest.DataChiuso IS NOT NULL
                  AND DATE(hospitality_guest.DataChiuso) >= '$inizio'
                  AND DATE(hospitality_guest.DataChiuso) <= '$fine'))
                AND
                  hospitality_guest.idsito = ".$idsito."
                AND
                  hospitality_guest.NoDisponibilita = 0
                AND
                  hospitality_guest.Disdetta = 0
                AND
                    hospitality_guest.Hidden = 0
                AND
                  hospitality_guest.TipoRichiesta = 'Conferma'";

      $res = $dbMysqli->query($select);
      $rwc = $res[0];

      if($tipo == 'format'){
          return number_format($rwc['fatturato'],0,'.','');
      }else{
          return number_format($rwc['fatturato'],2,',','.');
      }

  }

    function scadenza_quoto($idsito){
      global $dbMysqli;

      $select     = "SELECT
                      DATEDIFF(siti.data_end_hospitality,siti.data_start_hospitality) AS DiffDate,
                      siti.data_end_hospitality,
                      siti.hospitality,
                      siti.no_rinnovo_hospitality
                    FROM
                      siti
                    WHERE
                      siti.idsito = ".$idsito."
                    AND
                      (siti.data_start_hospitality IS NOT NULL OR siti.data_start_hospitality  != '0000-00-00')
                    AND
                      (siti.data_end_hospitality IS NOT NULL OR siti.data_end_hospitality  != '0000-00-00')";

      $res        = $dbMysqli->query($select);
      $row        = $res[0];

      $differenza = ($row['DiffDate']);

      $diff_data  = (100-$differenza);

      $d_e_tmp    = explode("-",$row['data_end_hospitality']);
      $data_end   = $d_e_tmp[2].'-'.$d_e_tmp[1].'-'.$d_e_tmp[0];

      if($differenza < 60){
        $TestDemo = '&nbsp; <b class="text-green">TEST DEMO</b>';
      }else{
        $TestDemo = '';
      }
      if($differenza <= 31){
        $box ='&nbsp;&nbsp;&nbsp;<i class="fa fa-trophy '.($TestDemo!=''?'text-green':'').'"></i>&nbsp; Tempo di attivazione '.$differenza.' gg.'.$TestDemo;
      }elseif($differenza <= 180){
        $box ='&nbsp;&nbsp;&nbsp;<i class="fa fa-trophy '.($TestDemo!=''?'text-green':'').'"></i>&nbsp; Tempo di attivazione '.$differenza.' gg.'.$TestDemo;
      }else{
        if($row['data_end_hospitality'] <= date('Y-m-d')){

          if($row['no_rinnovo_hospitality'] == 1){
            $disdetto = '&nbsp; <b class="text-red">DISDETTO</b> ';
          }else{
            $disdetto = '';
          }

          $box = '&nbsp;&nbsp;&nbsp;<i class="fa fa-hourglass '.($disdetto!=''?'text-red':'').'"></i>&nbsp; Il software è stato attivo per '.$differenza.' gg.' .$disdetto;

        }else{

          $sel      = "SELECT
                        DATEDIFF(siti.data_end_hospitality,'".date('Y-m-d')."') AS giorni_mancanti
                      FROM
                        siti
                      WHERE
                        siti.idsito = ".$idsito."
                      AND
                        siti.hospitality = 1";

          $rs       = $dbMysqli->query($sel);
          $rw       = $rs[0];
          $mancanti = $rw['giorni_mancanti'];

          if($mancanti <= '15'){
            $colore_stile = 'text-red';
          }else{
            $colore_stile = '';
          }

          $box = '&nbsp;&nbsp;&nbsp;<i class="fa fa-hourglass-half text-blue"></i>&nbsp; <span class="'.$colore_stile.'">Alla scadenza mancano '.$mancanti.' gg.</span>';
        }

      }


        return $box;
    }

    function log_accessi($idsito){
      global $dbMysqli,$ips_network_service;
      $select = 'SELECT
                    hospitality_log_accessi.*
                  FROM
                    hospitality_log_accessi
                  WHERE
                    hospitality_log_accessi.idsito = '.$idsito.'
                  ORDER BY
                    data_ora DESC
                  LIMIT
                    5';
      $arr = $dbMysqli->query($select);

      if(sizeof($arr)>0){

        foreach($arr as $key => $rwc){

          if(in_array($rwc['remote'], $ips_network_service )){
            $etichettaNWS = '<b>Accesso effettuato da Network Service</b>';
            $opacity = 'opacity: 0.5;';
          }else{
            $etichettaNWS = '';
            $opacity = '';
          }
          $accessi .= ' <div class="card card-body" style="border:1px solid #E1E1E1; padding:10px; border-radius: 5px;'. $opacity.'">
                          <p class="nowrap f12"><i class="fa fa-vcard-o text-green" data-toogle="tooltip" title="Cliente" aria-hidden="true"></i> '.$rwc['utente'].'</p>
                          <p class="nowrap f12"><i class="fa fa-user text-info" data-toogle="tooltip" title="Utente" aria-hidden="true"></i> '.($rwc['nome_utente']!=''?$rwc['nome_utente']:' Operatore di default').' '.($etichettaNWS!=''?'<small>('.$etichettaNWS.')</small>':'').'</p>
                          <p class="nowrap f12"><i class="fa fa-server text-orange" data-toogle="tooltip" title="Ip Provenienza" aria-hidden="true"></i> '.$rwc['remote'].'</p>
                          <p class="nowrap f12"><i class="fa fa-laptop text-red" data-toogle="tooltip" title="User-Agent" aria-hidden="true"></i> <small>'.$rwc['user_agent'].'</small></p>
                          <p class="nowrap f12"><i class="fa fa-clock-o text-purple" data-toogle="tooltip" title="Data e Ora" aria-hidden="true"></i> '.date('d-m-Y H:i:s',$rwc['data_ora']).'</p>
                        </div><br />'."\r\n";
      }
      }else{
        $accessi = 'Accesso non ancora registrato!!';
      }
      return $accessi;
  }



  function comunicazioni_quoto($idsito){
    global $dbMysqli;

    $select  = "SELECT * FROM assistenze_quoto WHERE idsito = ".$idsito;
    $res = $dbMysqli->query($select);
    $rwc = $res[0];
    $output = ($rwc['comunicazioni']);

    return $output;
  }



function quoto_attivi(){
      global $dbMysqli;

        $quy         = 'SELECT
                            siti.idsito,
                            siti.web,
                            siti.no_rinnovo_hospitality,
                            siti.data_start_hospitality,
                            siti.data_end_hospitality,
                            siti.email,
                            siti.tel,
                            siti.cell,
                            siti.servizi_attivi,
                            siti.id_tipo_contratto
                        FROM
                            siti
                        WHERE
                            siti.idsito NOT IN(1740,1987)
                        AND
                            siti.hospitality = 1
                        AND
                            siti.id_status = 1
                        AND
                            siti.data_start_hospitality <= "'.date('Y-m-d').'"
                        AND
                            siti.data_end_hospitality > "'.date('Y-m-d').'"
                         ';
    if($_REQUEST['idsito']!=''){
      $quy         .= ' AND  siti.idsito = '.$_REQUEST['idsito'];
    }
    if($_REQUEST['ordina']==''){
      $quy         .= ' ORDER BY  siti.data_start_hospitality DESC';
    }elseif($_REQUEST['ordina']=='ASC' || $_REQUEST['ordina']=='DESC'){
      $quy         .= ' ORDER BY  siti.data_end_hospitality '.$_REQUEST['ordina'];
    }
    $rec        = $dbMysqli->query($quy);

    $tot_attivi = sizeof($rec);


    if($_REQUEST['ordina'] == 'fatturato_asc' || $_REQUEST['ordina'] == 'fatturato_desc'){
        $n = 1;
        $chiave = '';
        foreach ($rec as $arr  => $v) {
            $chiave = totale_fatturato($v['idsito'],'format');
            if($chiave==0)$chiave = $chiave.$n;
            $array[$chiave] = $v;
            $n++;
        }
        if($_REQUEST['ordina'] =='fatturato_desc'){
            krsort($array);
            reset($array);
        }
        if($_REQUEST['ordina'] =='fatturato_asc'){
            ksort($array);
            reset($array);
        }

        $record = $array;

    }elseif($_REQUEST['ordina'] == 'conversione_asc' || $_REQUEST['ordina'] == 'conversione_desc'){

        $x            = 1;
        //$chiaveC      = '';
        //$totale_invii = '';
        //$totale_prenotazioni = '';

        //foreach ($rec as $arr  => $v) {
          //$totale_invii        = totale_invii($v['idsito']);
          //$totale_prenotazioni = totale_prenotazioni($v['idsito']);
          //$chiaveC             = tot_conversion($totale_invii,$totale_prenotazioni,'format');

           // if($chiaveC==0)$chiaveC = $chiaveC.$x;
            //$ay[$chiaveC] = $v;
            //$x++;
        //}
        //$chiaveC = '';
        if($_REQUEST['ordina'] =='conversione_desc'){
            krsort($ay);
            reset($ay);
        }
        if($_REQUEST['ordina'] =='conversione_asc'){
            ksort($ay);
            reset($ay);
        }

        $record = $ay;

    }else{
        $record = $rec;
    }



      $report .= ' <a class="accordion-msg f-24 text-success">
                            <i class="fa fa-area-chart"></i>
                            Report QUOTO ATTIVI n° '.$tot_attivi.'
                        </a>
                        <div class="accordion-desc" >';

      $tot_conversione                 = '';
      $array_servizi                   = array();
      $tipo                            = "";
      $inizio                          = '';
      $data_start                      = '';
      $totale_invii                    = '';
      $totale_prenotazioni             = '';
      $comunicazioni_quoto             = '';
      $totale_fatturato                = '';
      $totale_fatturato_annoPrecendete = '';
      $totale_fatturato_anno           = '';
      $log_accessi                     = '';
      $scadenza_quoto                  = '';
      $tipo_contratto                  = '';

      foreach ($record as $ky  => $value) {
        //$totale_invii                    = totale_invii($value['idsito']);
        //$totale_prenotazioni             = totale_prenotazioni($value['idsito']);
        //$tot_conversione                 = tot_conversion($totale_invii,$totale_prenotazioni);
        $tot_conversione                = '<script>
                                              $(function(){
                                                totale_conversioni('.$value['idsito'].');
                                              })
                                            </script>
                                            <span id="totale_conversioni_pre'.$value['idsito'].'"></span>
                                            <span id="totale_conversioni'.$value['idsito'].'"></span>';

        $comunicazioni_quoto             = comunicazioni_quoto($value['idsito']);

        $tipo_contratto                  =  '<script>
                                                $(function(){
                                                  tipo_contratto('.$value['idsito'].','.$value['id_tipo_contratto'].');
                                                })
                                              </script>
                                              <span id="tipo_contratto_pre'.$value['idsito'].'"></span>
                                              <span id="tipo_contratto'.$value['idsito'].'"></span>';
        //$totale_fatturato                = totale_fatturato($value['idsito']);
        $totale_fatturato                = '<script>
                                            $(function(){
                                              totale_fatturato('.$value['idsito'].');
                                            })
                                          </script>
                                          <span id="totale_fatturato_pre'.$value['idsito'].'"></span>
                                          <span id="totale_fatturato'.$value['idsito'].'"></span>';
        //$totale_fatturato_annoPrecendete = totale_fatturato_anno($value['idsito'],(date('Y')-1).'-01-01',(date('Y')-1).'-12-31');
        $totale_fatturato_annoPrecendete = '<script>
                                              $(function(){
                                                totale_fatturato_anno_precedente('.$value['idsito'].',"'.(date('Y')-1).'-01-01","'.(date('Y')-1).'-12-31");
                                              })
                                            </script>
                                            <span id="totale_fatturato_anno_precedente_pre'.$value['idsito'].'"></span>
                                            <span id="totale_fatturato_anno_precedente'.$value['idsito'].'"></span>';
        //$totale_fatturato_anno           = totale_fatturato_anno($value['idsito'],date('Y').'-01-01',date('Y').'-12-31');
        $totale_fatturato_anno           = '<script>
                                              $(function(){
                                                totale_fatturato_anno('.$value['idsito'].',"'.date('Y').'-01-01","'.date('Y').'-12-31");
                                              })
                                            </script>
                                            <span id="totale_fatturato_anno_pre'.$value['idsito'].'"></span>
                                            <span id="totale_fatturato_anno'.$value['idsito'].'"></span>';
        //$log_accessi                     = log_accessi($value['idsito']);
        $log_accessi           = '<script>
                                    $(function(){
                                      log_accessi('.$value['idsito'].',"5.89.51.153");
                                    })
                                  </script>
                                  <span id="log_accessi_pre'.$value['idsito'].'"></span>
                                  <span id="log_accessi'.$value['idsito'].'"></span>';
        //$scadenza_quoto                  = scadenza_quoto($value['idsito']);
        $scadenza_quoto           = '<script>
                                        $(function(){
                                          scadenza_quoto('.$value['idsito'].');
                                        })
                                      </script>
                                      <span id="scadenza_quoto_pre'.$value['idsito'].'"></span>
                                      <span id="scadenza_quoto'.$value['idsito'].'"></span>';

        $inizio_ = explode ("-",$value['data_start_hospitality']);
        $inizio = $inizio_[0];

        $array_servizi = explode(",",$value['servizi_attivi']);

        if(in_array('Quoto TR',$array_servizi)){
            $tipo = "Quoto TR";
            $data_start_tmp = explode("-", $value['data_end_hospitality']);
            $nun_data = mktime (0,0,0,$data_start_tmp[1],$data_start_tmp[2],($data_start_tmp[0]-3));
            $data = date('d-m-Y',$nun_data);
            $data_start  = $data;
        }elseif(in_array('Quoto Demo',$array_servizi)){
            $tipo = "Quoto Demo";
            $data_start_tmp = explode("-", $value['data_end_hospitality']);
            $nun_data = mktime (0,0,0,$data_start_tmp[1],($data_start_tmp[2]-6),$data_start_tmp[0]);
            $data = date('d-m-Y',$nun_data);
            $data_start  = $data;
        }elseif(in_array('Quoto',$array_servizi)){
          $tipo = "Quoto";
          $data_start_tmp = explode("-", $value['data_end_hospitality']);
          $nun_data = mktime (0,0,0,$data_start_tmp[1],$data_start_tmp[2],($data_start_tmp[0]-1));
          $data = date('d-m-Y',$nun_data);
          $data_start  = $data;
        }


        $report .='
                    <div class="row">



                    <div class="col-md-5 col-sm-5 col-xs-12">
                      <div class="info-box animated zoomIn del4">
                        <span class="info-box-icon bg-c-cyan"><i class="fa fa-h-square text-white"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">
                            <a href="'.BASE_URL_ADMIN.'siti/ut/'.$value['idsito'].'" title="[IdSito: '.$value['idsito'].'] - vai al sito" data-toogle="tooltip"><b>'.$value['web'].'</b></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <small>
                              <i class="fa fa-arrow-right"></i>
                              &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" data-toggle="modal"  data-target="#accessi'.$value['idsito'].'" data-toogle="tooltip" title="Log ultimo accesso"><i class="fa fa-history"></i></a>
                              &nbsp;&nbsp;&nbsp;&nbsp;'.$tipo.'
                            </small>
                          </span>


                          <div class="modal fade" id="accessi'.$value['idsito'].'" tabindex="-1" role="dialog" aria-labelledby="progetto">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalASearch">Ultimo accesso a QUOTO di '.$value['web'].'</h4>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                  '.$log_accessi .'
                                </div>
                              </div>
                            </div>
                          </div>


                          <span class="info-box-number"><small>
                          <i class="fa fa-arrow-right"></i>&nbsp;&nbsp;Prima attivazione&nbsp;&nbsp<b data-toogle="tooltip" title="Data della attività  del progetto in essere: attivazione Quoto" style="cursor:pointer">'.gira_data($value['data_start_hospitality']).'</b>&nbsp;ultimo rinnovo&nbsp;<b>'.$data_start.'</b> scadenza&nbsp;&nbsp<b data-toogle="tooltip" title="Data di fine accesso al software" style="cursor:pointer">'.gira_data($value['data_end_hospitality']).'</b> <br><small style="font-size:80%!important;font-weight:normal!important">'.($value['no_rinnovo_hospitality']==0?'Si aggiorna automaticamente alla scadenza':'NON si aggiorna più alla scadenza').'</small>  &nbsp;'.$scadenza_quoto.'</small> &nbsp;&nbsp;&nbsp;&nbsp;'.($value['no_rinnovo_hospitality']==0?'<i title="Rinnovo Automatico Abilitato" data-toggle="tooltip" class="fa fa-refresh text-green"></i>':'<i title="Rinnovo Automatico Disattivato, alla scadenza non sarà più attivo!" data-toggle="tooltip" class="fa fa-refresh text-red"></i>').'
                          </span>
                          <small>Tipo contratto <i class="fa fa-arrow-right"></i>&nbsp;&nbsp; <b>'. $tipo_contratto .'</b></small>
                          <small>'.($value['note_servizio_quoto']).'</small>
                          <span class="info-box-text"></span>
                          </div><!-- /.info-box-content -->
                      </div><!-- /.info-box -->
                    </div><!-- /.col -->

                    <div class="col-md-2 col-sm-2 col-xs-12">
                    <div class="info-box">
                    <span class="info-box-icon bg-c-cyan"><i class="fa fa-server text-white"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Considerazioni/Assistenze</span>
                        <span class="info-box-number"><a href="javascript:;" data-toggle="modal"  data-target="#assitenza'.$value['idsito'].'" data-toogle="tooltip" title="Considerazioni/Assistenze">Apri <i class="fa fa-comment"></i></a></span>

                        <div class="modal fade" id="assitenza'.$value['idsito'].'" tabindex="-1" role="dialog" aria-labelledby="Assistenze">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalASearch">Considerazioni/Assistenze QUOTO di '.$value['web'].'</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form id="form_assistenze'.$value['idsito'].'" name="form_assistenze'.$value['idsito'].'" method="post">
                                  <textarea rows="6" name="comunicazioni" id="comunicazioni'.$value['idsito'].'" class="form-control">'.$comunicazioni_quoto.'</textarea>
                                  <input type="hidden" name="idsito" value="'.$value['idsito'].'">
                                  <div style="clear:both;height:5px"></div>
                                  <button type="submit" class="btn btn-info btn-xs">salva</button>
                              </form>
                              <script>
                                    $(document).ready(function() {
                                        $(\'#form_assistenze'.$value['idsito'].'\').submit(function() {

                                            var dati = $("#form_assistenze'.$value['idsito'].'").serialize();
                                                $.ajax({
                                                    url: "'.BASE_URL_ADMIN.'ajax/ins_assistenze_quoto.php",
                                                    type: "POST",
                                                    data: dati,
                                                        success: function(data) {
                                                            $("div#result'.$value['idsito'].'").html(\'<br><div class="alert alert-success alert-dismissable"><small>Salvato con successo!</small></div>\');
                                                                  $(\'#result'.$value['idsito'].'\').fadeOut(3000);
                                                        }
                                                  });
                                                return false; // con false senza refresh della pagina
                                        });
                                    });
                                </script>
                                <div id="result'.$value['idsito'].'"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                          <span class="info-box-text">&nbsp;</span>
                          <span class="info-box-text">&nbsp;</span>
                        </div><!-- /.info-box-content -->
                      </div><!-- /.info-box -->
                  </div><!-- /.col -->'."\r\n";

        $report .=' <div class="col-md-2 col-sm-2 col-xs-12">
                      <div class="info-box animated zoomIn del5">
                        <span class="info-box-icon bg-c-cyan"><i class="fa fa-calculator text-white"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Tasso conversione</span><b class="text-green">Anno '.date('Y').'</b>
                          <span class="info-box-number">'.$tot_conversione.'
                          </span>
                          <span class="info-box-text">&nbsp;</span>
                          <span class="info-box-text">&nbsp;</span>
                        </div><!-- /.info-box-content -->
                      </div><!-- /.info-box -->
                    </div><!-- /.col -->'."\r\n";

      $report .='   <div class="col-md-3 col-sm-3 col-xs-12">
                      <div class="info-box animated zoomIn del6">
                        <span class="info-box-icon bg-c-cyan"><i class="fa fa-euro text-white"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Fatturato</span>
                          <span class="info-box-number"><span class="text-info">Totale dall\'inizio</span>&nbsp; '.$totale_fatturato.'</span>
                          '.($inizio <= (date('Y')-1)?'<span class="info-box-number"><span class="text-orange">Anno '.(date('Y')-1).'</span>&nbsp; '.$totale_fatturato_annoPrecendete.'</span>':'').'
                          <span class="info-box-number"><span class="text-green">Anno '.date('Y').'</span>&nbsp; '.$totale_fatturato_anno.'</span>
                        </div><!-- /.info-box-content -->
                      </div><!-- /.info-box -->
                    </div><!-- /.col -->

                  </div><!-- /.row -->
                  ';

      }



      $report .= '  <p></p>
                  </div>';
      return $report;

}


function quoto_scaduti(){
      global $dbMysqli;

      $qy         = 'SELECT
                        siti.idsito,
                        siti.web,
                        siti.no_rinnovo_hospitality,
                        siti.data_start_hospitality,
                        siti.data_end_hospitality,
                        siti.email,
                        siti.tel,
                        siti.cell,
                        servizi_attivi
                    FROM
                        siti
                    WHERE
                        siti.idsito NOT IN(1740,1987)
                    AND
                        siti.id_status = 1
                    AND
                        siti.data_start_hospitality <= "'.date('Y-m-d').'"
                    AND
                        (siti.data_end_hospitality IS NOT NULL OR siti.data_end_hospitality  != "0000-00-00")
                    AND
                        siti.data_end_hospitality <= "'.date('Y-m-d').'"
                    ';
    if($_REQUEST['idsito']!=''){
      $qy         .= ' AND  siti.idsito = '.$_REQUEST['idsito'];
    }
    if($_REQUEST['ordina']==''){
      $qy         .= ' ORDER BY  siti.data_start_hospitality DESC';
    }elseif($_REQUEST['ordina']=='ASC' || $_REQUEST['ordina']=='DESC'){
      $qy         .= 'ORDER BY  siti.data_end_hospitality '.$_REQUEST['ordina'];
    }
    $rc         = $dbMysqli->query($qy);

    $tot_scaduti = sizeof($rc);

    if($_REQUEST['ordina'] == 'fatturato_asc' || $_REQUEST['ordina'] == 'fatturato_desc'){
      $nc = 1;
      $chiavec = '';
      foreach ($rc as $ar  => $vl) {
          $chiavec = totale_fatturato($vl['idsito'],'format');
          if($chiavce==0)$chiavec = $chiavec.$n;
          $arrayc[$chiavec] = $vl;
          $nc++;
      }
      if($_REQUEST['ordina'] =='fatturato_desc'){
          krsort($arrayc);
          reset($arrayc);
      }
      if($_REQUEST['ordina'] =='fatturato_asc'){
          ksort($arrayc);
          reset($arrayc);
      }

      $recordc = $arrayc;

  }elseif($_REQUEST['ordina'] == 'conversione_asc' || $_REQUEST['ordina'] == 'conversione_desc'){

      $x            = 1;
      //$chiaveCc     = '';
      //$totale_invii = '';
      //$totale_prenotazioni = '';

      //foreach ($rc as $ar  => $vl) {
         //$totale_invii        = totale_invii($vl['idsito']);
         //$totale_prenotazioni = totale_prenotazioni($vl['idsito']);
        // $chiaveCc            = tot_conversion($totale_invii,$totale_prenotazioni,'format');

          //if($chiaveCc==0)$chiaveCc = $chiaveCc.$x;
          //$ayc[$chiaveCc] = $vl;
          //$xc++;
      //}
        //$chiaveCc = '';
      if($_REQUEST['ordina'] =='conversione_desc'){
          krsort($ayc);
          reset($ayc);
      }
      if($_REQUEST['ordina'] =='conversione_asc'){
          ksort($ayc);
          reset($ayc);
      }

      $recordc = $ayc;

  }else{
      $recordc = $rc;
  }


      $reportKO .= '
                        <a class="accordion-msg f-24 text-danger">
                            <i class="fa fa-area-chart"></i>
                            Report QUOTO SCADUTI n° '.$tot_scaduti.'
                        </a>
                        <div class="accordion-desc" '.($_REQUEST['idsito']!=''?'':'style="display:none"').'>';

      //$tot_conversioneKo   = '';
      $array_servizi       = array();
      //$totale_invii        = '';
      //$totale_prenotazioni = '';
      $scadenza_quoto      = '';
      $comunicazioni_quoto = '';
      $totale_fatturato    = '';

      foreach ($recordc as $k => $val) {
        //$totale_invii        = totale_invii($val['idsito']);
        //$totale_prenotazioni = totale_prenotazioni($val['idsito']);
        //$tot_conversioneKo   = tot_conversion($totale_invii,$totale_prenotazioni);
        //$scadenza_quoto      = scadenza_quoto($val['idsito']);
        $scadenza_quoto           = '<script>
                                      $(function(){
                                        scadenza_quoto('.$val['idsito'].');
                                      })
                                    </script>
                                    <span id="scadenza_quoto_pre'.$val['idsito'].'"></span>
                                    <span id="scadenza_quoto'.$val['idsito'].'"></span>';
        $comunicazioni_quoto = comunicazioni_quoto($val['idsito']);
        //$totale_fatturato    = totale_fatturato($val['idsito']);
        $totale_fatturato                = '<script>
                                            $(function(){
                                              totale_fatturato('.$val['idsito'].');
                                            })
                                          </script>
                                          <span id="totale_fatturato_pre'.$val['idsito'].'"></span>
                                          <span id="totale_fatturato'.$val['idsito'].'"></span>';
        $array_servizi = explode(",",$val['servizi_attivi']);

        if(in_array('Quoto TR',$array_servizi)){
          $tipo = "Quoto TR";
        }elseif(in_array('Quoto Demo',$array_servizi)){
          $tipo = "Quoto Demo";
        }elseif(in_array('Quoto',$array_servizi)){
          $tipo = "Quoto";
        }
        $reportKO .='
                    <div class="row">

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="info-box animated zoomIn del4">
                        <span class="info-box-icon bg-c-cyan"><i class="fa fa-h-square text-white"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text"><a href="'.BASE_URL_ADMIN.'siti/ut/'.$val['idsito'].'" title="[IdSito: '.$val['idsito'].'] - vai al sito" data-toogle="tooltip"><b>'.$val['web'].'</b></a>  &nbsp;&nbsp;&nbsp;&nbsp;<small><i class="fa fa-arrow-right"></i>
                          &nbsp;&nbsp;&nbsp;&nbsp;'.$tipo.'
                          </small></span>

                          <span class="info-box-number"><small><i class="fa fa-arrow-right"></i>&nbsp;&nbsp;Attivazione&nbsp;dal &nbsp;&nbsp<b data-toogle="tooltip" title="Data della attività  del progetto in essere: attivazione Quoto" style="cursor:pointer">'.gira_data($val['data_start_hospitality']).'</b>&nbsp;&nbsp; al &nbsp;&nbsp<b data-toogle="tooltip" title="Data di fine accesso al software" style="cursor:pointer">'.gira_data($val['data_end_hospitality']).'</b>  &nbsp;&nbsp;'.$scadenza_quoto.'</small> &nbsp;&nbsp;&nbsp;&nbsp;'.($val['no_rinnovo_hospitality']==0?'<i title="Rinnovo Automatico Abilitato" data-toggle="tooltip" class="fa fa-refresh text-green"></i>':'<i title="Rinnovo Automatico Disattivato" data-toggle="tooltip" class="fa fa-refresh text-red"></i>').'

                          </span>
                          </div><!-- /.info-box-content -->
                      </div><!-- /.info-box -->
                    </div><!-- /.col -->

                    <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="info-box">
                    <span class="info-box-icon bg-c-cyan"><i class="fa fa-server text-white"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Considerazioni/Assistenze</span>
                        <span class="info-box-number"><a href="javascript:;" data-toggle="modal"  data-target="#assitenza'.$val['idsito'].'" data-toogle="tooltip" title="Considerazioni/Assistenze">Apri <i class="fa fa-comment"></i></a>
                        </span>

                        <div class="modal fade" id="assitenza'.$val['idsito'].'" tabindex="-1" role="dialog" aria-labelledby="Assistenze">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalASearch">Considerazioni/Assistenze QUOTO di '.$val['web'].'</h4>
                            </div>
                            <div class="modal-body">
                                <form id="form_assistenze'.$val['idsito'].'" name="form_assistenze'.$val['idsito'].'" method="post">
                                  <textarea rows="6" name="comunicazioni" id="comunicazioni'.$val['idsito'].'" class="form-control">'.$comunicazioni_quoto.'</textarea>
                                  <input type="hidden" name="idsito" value="'.$val['idsito'].'">
                                  <div style="clear:both;height:5px"></div>
                                  <button type="submit" class="btn btn-info btn-xs">salva</button>
                              </form>
                              <script>
                                    $(document).ready(function() {
                                        $(\'#form_assistenze'.$val['idsito'].'\').submit(function() {

                                            var dati = $("#form_assistenze'.$val['idsito'].'").serialize();
                                                $.ajax({
                                                    url: "'.BASE_URL_ADMIN.'ajax/ins_assistenze_quoto.php",
                                                    type: "POST",
                                                    data: dati,
                                                        success: function(data) {
                                                            $("div#result'.$val['idsito'].'").html(\'<br><div class="alert alert-success alert-dismissable"><small>Salvato con successo!</small></div>\');
                                                                  $(\'#result'.$val['idsito'].'\').fadeOut(3000);
                                                        }
                                                  });
                                                return false; // con false senza refresh della pagina
                                        });
                                    });
                                </script>
                                <div id="result'.$val['idsito'].'"></div>
                            </div>
                          </div>
                        </div>
                      </div>

                        </div><!-- /.info-box-content -->
                      </div><!-- /.info-box -->
                  </div><!-- /.col -->'."\r\n";
/*
      $reportKO .= '<div class="col-md-2 col-sm-2 col-xs-12">
                      <div class="info-box animated zoomIn del5">
                        <span class="info-box-icon bg-c-cyan"><i class="fa fa-calculator text-white"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Tasso conversione</span>
                          <span class="info-box-number">'.$tot_conversioneKo.'</span>
                        </div><!-- /.info-box-content -->
                      </div><!-- /.info-box -->
                    </div><!-- /.col -->'."\r\n";
*/
     $reportKO .= '<div class="col-md-3 col-sm-3 col-xs-12">
                      <div class="info-box animated zoomIn del6">
                        <span class="info-box-icon bg-c-cyan"><i class="fa fa-euro text-white"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Fatturato</span>
                          <span class="info-box-number">'.$totale_fatturato.'</span>
                        </div><!-- /.info-box-content -->
                      </div><!-- /.info-box -->
                    </div><!-- /.col -->

                  </div><!-- /.row -->';
      }
      $tot_conversioneKo = '';
      $reportKO .= '  <p></p>
                    </div> ';
      return $reportKO;
}
