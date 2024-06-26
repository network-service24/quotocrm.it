<?php
function getlastNumPreno($IdRichiesta){
    global $db;
    $db->query("SELECT NumeroPrenotazione as NumeroPrenotazione FROM hospitality_guest WHERE Id = ".$IdRichiesta);
    $dato = $db->row();
    $NumeroPrenotazione = $dato['NumeroPrenotazione'];
    return($NumeroPrenotazione);
}

$giorni2 = mktime (0,0,0,date('m'),(date('d')+2),date('Y'));
$data_giorni2 = date('Y-m-d',$giorni2);
$data_giorni2_view = date('d-m-Y',$giorni2);
$giorni1 = mktime (0,0,0,date('m'),(date('d')+1),date('Y'));
$data_giorni1 = date('Y-m-d',$giorni1);
$data_giorni1_view = date('d-m-Y',$giorni1);

$data_arr_tmp = explode('-',$_REQUEST['date_arr']);
$data_arr = $data_arr_tmp[2].'-'.$data_arr_tmp[1].'-'.$data_arr_tmp[0];
$date_fl_tmp = explode('-',$_REQUEST['date_fl']);
$date_fl = $date_fl_tmp[2].'-'.$date_fl_tmp[1].'-'.$date_fl_tmp[0];

if($_REQUEST['azione'] == 'resend' && $_REQUEST['param'] == 'ok') {
    $msg = '<div class="alert alert-success">
               <i class="fa fa-check"></i> Il Buono Voucher è stao re-inviato con successo!.
           </div>';
}

if($_REQUEST['azione'] == 'disdetta' && $_REQUEST['param'] != '') {
         // upadte per archiviare un preventivo
        $db->query("UPDATE hospitality_guest SET Disdetta = 1 WHERE Id = ".$_REQUEST['param']);

        $NPre = getlastNumPreno($_REQUEST['param']);
        popola_status_parity(IDSITO,$NPre,7);

        header('Location:'.BASE_URL_SITO.'buoni_voucher/');

}

if($_REQUEST['azione']!='' && $_REQUEST['param']=='delete'){
        $db->query("UPDATE hospitality_guest SET Hidden = 1 WHERE Id = '".$_REQUEST['azione']."'");

        $NPre = getlastNumPreno($_REQUEST['azione']);
        popola_status_parity(IDSITO,$NPre,7);
        
        header('location:'.BASE_URL_SITO.'buoni_voucher/');
}
    $xcrud->table('hospitality_guest');
    /**
     * ! SE IL PERMESSO E' IMPOSTATO LE RICHIESTE VENGONO FILTRATE PER OPERATORE
     */
    $permessi_unique = check_permessi();
    if($permessi_unique['UNIQUE']==1){
        $xcrud->where('hospitality_guest.ChiPrenota', NOMEUTENTEACCESSI);
    }
    ####################################################################

    if($_REQUEST['action']=='search'){
        if($_REQUEST['NumeroPrenotazione']!=''){
            $xcrud->where('hospitality_guest.NumeroPrenotazione', $_REQUEST['NumeroPrenotazione']);
        }
        if($_REQUEST['Operatore']!=''){
            $xcrud->where('hospitality_guest.ChiPrenota', $_REQUEST['Operatore']);
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
        if($_REQUEST['Email']!=''){
            $xcrud->where('hospitality_guest.Email', $_REQUEST['Email']);
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
        if($_REQUEST['Lingua']!=''){
            $xcrud->where('hospitality_guest.Lingua', $_REQUEST['Lingua']);
        }
        if($_REQUEST['TipoCamere']!=''){
            $xcrud->join('hospitality_guest.Id', 'hospitality_richiesta', 'id_richiesta');
            $xcrud->where('hospitality_richiesta.TipoCamere', $_REQUEST['TipoCamere']);
        }
        if($_REQUEST['TipoSoggiorno']!=''){
            $xcrud->join('hospitality_guest.Id', 'hospitality_richiesta', 'id_richiesta');
            $xcrud->where('hospitality_richiesta.TipoSoggiorno', $_REQUEST['TipoSoggiorno']);
        }
        if($_REQUEST['IdMotivazione']!=''){
            $xcrud->where('hospitality_guest.IdMotivazione', $_REQUEST['IdMotivazione']);
        }
        $js_fatt = '<script>
                        function number_format( number, decimals, dec_point, thousands_sep ) {
                          var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
                          var d = dec_point == undefined ? "," : dec_point;
                          var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
                          var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;

                          return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
                        }
                        $(document).ready(function() {
                          var valore_tot = 0;
                          var etichetta = leggiCookie(\'etichetta_filtro'.IDSITO.'\');
                          $(".fatturato").each(function() {
                               valore_tot += parseInt($(this).text());
                           });
                            valore_fatt = number_format(valore_tot,2, ",", ".");
                           $("#totale_fatt").html("<p class=\"text-success\"><small>Totale fatturato dopo l\'applicazione del filtro " + etichetta + " &nbsp;<b style=\"font-size:14px\"><i class=\"fa fa-euro\"></i> " + valore_fatt + "</b></small></p>");
                        });
                    </script>';
    }
    if($_REQUEST['ggg']!=''){
        $data_arr_tmp = explode('-',$_REQUEST['date_arr']);
        $data_arr = $data_arr_tmp[2].'-'.$data_arr_tmp[1].'-'.$data_arr_tmp[0];
        $date_fl_tmp = explode('-',$_REQUEST['date_fl']);
        $date_fl = $date_fl_tmp[2].'-'.$date_fl_tmp[1].'-'.$date_fl_tmp[0];
        $xcrud->where("hospitality_guest.DataArrivo = '".($_REQUEST['date_fl']==''?($_REQUEST['date_arr']==''?date('Y-m-d'):$data_arr):$date_fl)."'");

        if($_REQUEST['date_fl']){
            $data_fl_tmp     = explode("-",$_REQUEST['date_fl']);
            $data_fl_estesa_ = date('D, d M Y',mktime(0,0,0,$data_fl_tmp[1],$data_fl_tmp[0],$data_fl_tmp[2]));
            $dt_tmp          = explode(",",$data_fl_estesa_);
            $dt_tmp_         = explode(" ",$dt_tmp[1]);
            $data_fl_estesa  = $array_giorni[$dt_tmp[0]].', '.$dt_tmp_[1].' '.$array_mesi[$dt_tmp_[2]].' '.$dt_tmp_[3];
        }
        if($_REQUEST['date_arr']){
            $data_d_tmp            = explode("-",$_REQUEST['date_arr']);
            $data_dinamica_estesa_ = date('D, d M Y',mktime(0,0,0,$data_d_tmp[1],$data_d_tmp[0],$data_d_tmp[2]));
            $dt_d_tmp              = explode(",",$data_dinamica_estesa_);
            $dt_d_tmp_             = explode(" ",$dt_d_tmp[1]);
            $data_dinamica_estesa  = $array_giorni[$dt_d_tmp[0]].', '.$dt_d_tmp_[1].' '.$array_mesi[$dt_d_tmp_[2]].' '.$dt_d_tmp_[3];
        }
        $arrivi = 'Arrivi di '.($_REQUEST['ggg']!='dinamica'?($_REQUEST['ggg']==''?'oggi':$data_dinamica_estesa):$data_fl_estesa).'!';

    }
    $xcrud->where('hospitality_guest.idsito', IDSITO);
    $xcrud->where('TipoRichiesta', 'Conferma');
    $xcrud->where('hospitality_guest.IdMotivazione is Not Null');
    $xcrud->where('hospitality_guest.DataValiditaVoucher is Not Null');
    $xcrud->where('hospitality_guest.DataRiconferma is Null');
    $xcrud->where('hospitality_guest.Chiuso', '1');
    $xcrud->where('hospitality_guest.Archivia', '0');
    $xcrud->where('hospitality_guest.Hidden', '0');
    $xcrud->order_by('DataChiuso','DESC');

    $xcrud->relation('IdMotivazione', 'hospitality_tipo_voucher_cancellazione', 'Id', 'Motivazione');

    $xcrud->subselect('fatturato','SELECT SUM(hospitality_proposte.PrezzoP)  FROM hospitality_proposte WHERE hospitality_proposte.id_richiesta = {Id} AND hospitality_guest.idsito = {idsito}','Id');
    $xcrud->column_class('fatturato','fatturato');
    $xcrud->column_callback('fatturato','func_fatturato');
    $xcrud->label('fatturato','');

    $xcrud->subselect('UpSelling','SELECT COUNT(*) FROM hospitality_traccia_email_cron WHERE IdRichiesta = {Id} AND idsito = {idsito} AND TipoReInvio = "UpSelling"','Id');
    $xcrud->subselect('PreCheckin','SELECT COUNT(*) FROM hospitality_traccia_email_cron WHERE IdRichiesta = {Id} AND idsito = {idsito} AND TipoReInvio = "PreCheckin"','Id');
    $xcrud->subselect('EmailUpSelling','SELECT COUNT(*) FROM hospitality_traccia_email_upselling WHERE id_richiesta = {Id} AND idsito = {idsito}','Voucher_send');

    $xcrud->subselect('Pms', 'SELECT Pms  AS pms FROM hospitality_pms WHERE idsito = {idsito} AND Abilitato = 1 LIMIT 1');

    $xcrud->columns('Id,ChiPrenota,NumeroPrenotazione,FontePrenotazione,TipoVacanza,DataRichiesta,Nome,Email,Lingua,DataArrivo,DataPartenza,NumeroAdulti,NumeroBambini,Proposte,DataChiuso,Provenienza,idsito,UpSelling,PreCheckin,EmailUpSelling,Voucher_send,CheckinInviato,cs_inviato,IdMotivazione,recensione_inviata,fatturato', false);

    $sele = "SELECT Pms  AS pms FROM hospitality_pms WHERE idsito = ".IDSITO." AND Abilitato = 1 LIMIT 1";
    $ris  = $db->query($sele);
    $res  = $db->row($ris);
    if(is_array($res)) {
        if($res > count($res)) // se la pagina richiesta non esiste
            $tot = count($res); // restituire la pagina con il numero più alto che esista
    }else{
        $tot = 0;
    }
    if($tot > 0){

         $selP = "SELECT * FROM  hospitality_tipo_camere  WHERE (RoomTypePms IS NOT NULL OR RoomTypePms != '') AND idsito = ".IDSITO." ";
         $rsP = $db->query($selP);
         $rCP = $db->result($rsP);
         $totP = sizeof($rCP);

         if($totP > 0){
            $xcrud->column_callback('Pms', 'func_pms');
            $xcrud->column_class('Pms', 'align-center');
            $xcrud->columns('Pms', false);
            $xcrud->label('Pms','PMS');
          }else{
              $legenda_pms = '<h5><i class="fa fa-exclamation-circle text-success"></i> Per poter visualizzare <b>il bottone per sincronizzare con PMS ParityRate</b>, è neccessario <b>abbinare</b> tutte le tipologie di camera con il PMS!</h5>';
          }
    }



    $xcrud->column_callback('Provenienza','func_chat_riepilogo');
    $xcrud->column_callback('idsito','func_cc');
    $xcrud->column_callback('TipoVacanza','bg_tipo');
    $xcrud->column_callback('FontePrenotazione','bg_fonte');
    $xcrud->column_callback('Nome','gia_presente_chiuse');
    $xcrud->column_callback('DataChiuso','get_data_chiuso');
    $xcrud->column_callback('ChiPrenota' , 'get_operatore');
    $xcrud->column_callback('Id' , 'check_input');

    $xcrud->column_callback('EmailUpSelling' , 'check_email_upselling');
    $xcrud->column_callback('UpSelling','re_email_upselling');
    $xcrud->column_pattern('UpSelling' , '<small>{value}</small>');
    $xcrud->column_callback('PreCheckin','re_email_precheckin');
    $xcrud->column_pattern('PreCheckin' , '<small>{value}</small>');

    $xcrud->column_callback('IdMotivazione','motivazione_scadenza');

    $xcrud->column_pattern('Nome' , '<small><b>{value} {Cognome}</b></small>');
    $xcrud->column_pattern('Cognome' , '<small><b>{value}</b></small>');
    $xcrud->column_pattern('Email' , '<small style="white-space: nowrap;">{value}</small>');
    $xcrud->column_pattern('DataRichiesta' , '<small>{value}</small>');
    $xcrud->column_pattern('Lingua' , '<small>{value}</small>');
    $xcrud->column_callback('DataArrivo' , 'get_data_arrivo_conferma');
    $xcrud->column_callback('DataPartenza' , 'get_data_partenza_conferma');
    $xcrud->column_pattern('NumeroAdulti' , '<small>{value}</small>');
    $xcrud->column_pattern('NumeroBambini' , '<small>{value}</small>');
    $xcrud->column_pattern('DataChiuso' , '<small>{value}</small>');
    $xcrud->column_pattern('NumeroPrenotazione' , '<a href="'.BASE_URL_SITO.'timeline/{NumeroPrenotazione}" title="Timeline"  data-toogle="tooltip"><small>{value}</small></a>');
    $xcrud->column_pattern('Id' , '<small>{value}</small>');
    $xcrud->column_pattern('cs_inviato' , '<small>{value}</small>');
    $xcrud->column_pattern('CheckinInviato' , '<small>{value}</small>');


    $xcrud->label(array('Proposte' => 'Proposta',
                                'TipoVacanza' => 'Tipo',
                                'Nome' => 'Nome Cognome',
                                'DataRichiesta' => 'Richiesta',
                                'Lingua' => 'Lg',
                                'DataArrivo' => 'Arrivo',
                                'DataPartenza' => 'Partenza',
                                'NumeroAdulti' => 'A',
                                'NumeroBambini' => 'B',
                                'Id' => '',
                                'NumeroPrenotazione' => 'Nr.',
                                'ChiPrenota' => 'Nome Operatore',
                                'EmailSegretaria' => 'Email Operatore',
                                'FontePrenotazione' => 'Fonte',
                                'Provenienza' => '',
                                'idsito' => '',
                                'TipoPagamento' => 'Tipologia Pagamento',
                                'DataChiuso' => 'Data Pren.',
                                'cs_inviato' => '',
                                'CheckinInviato' => '',
                                'Voucher_send' => '',
                                'ChiPrenota' => 'Op.',
                                'UpSelling' => '',
                                'PreCheckin' => '',
                                'IdMotivazione' => 'Motivazione',
                                'recensione_inviata' => '',
                                'EmailUpSelling' => 'UP'));


    $xcrud->column_class('ChiPrenota,Email,Proposte,Provenienza,idsito,NumeroAdulti,NumeroBambini,EmailUpSelling,PreCheckin,UpSelling,Voucher_send,CheckinInviato,cs_inviato,IdMotivazione', 'align-center');

    $xcrud->column_tooltip('cs_inviato','Invio email per la compilazione del Questionario', 'fa fa fa-ellipsis-h text-white');
    $xcrud->column_tooltip('CheckinInviato','Invio automatico per il modulo di Checkin OnLine', 'fa fa fa-ellipsis-h text-white');
    $xcrud->column_tooltip('UpSelling','Invio automatico per Benvenuto e/o ReSelling', 'fa fa fa-ellipsis-h text-white');
    $xcrud->column_tooltip('PreCheckin','Invio automatico per PreCheckin', 'fa fa fa-ellipsis-h text-white');
    $xcrud->column_tooltip('Voucher_send','Voucher inviato si/no', 'fa fa fa-ellipsis-h text-white');
    $xcrud->column_tooltip('Provenienza','Chat', 'fa fa fa-ellipsis-h text-white');
    $xcrud->column_tooltip('idsito','Tipo Pagamento', 'fa fa fa-ellipsis-h text-white');

    $xcrud->column_callback('Email','ico_mail');
    $xcrud->column_callback('Lingua','show_flags');
    $xcrud->column_callback('Proposte','get_buono_voucher');
    $xcrud->column_callback('DataInvio','get_invio');
    $xcrud->column_callback('MessageId','msg_import');
    $xcrud->column_callback('cs_inviato','check_quest');
    $xcrud->column_callback('recensione_inviata','check_recensione');
    $xcrud->column_callback('CheckinInviato','checkin_send');
    $xcrud->column_callback('Voucher_send','check_buonivoucher');

    $xcrud->highlight_row('Disdetta', '=', '1', '#E1E1E1');

    $xcrud->search_columns('Id,NumeroPrenotazione,FontePrenotazione,TipoVacanza,DataRichiesta,Nome,Cognome,Email,Lingua,DataArrivo,DataPartenza,DataChiuso');

    $xcrud->unset_title();
    $xcrud->unset_add();
    $xcrud->unset_edit();
    $xcrud->unset_view();
    $xcrud->unset_remove();
    $xcrud->unset_csv();
    $xcrud->unset_print();
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

    $xcrud->button(BASE_URL_SITO.'reinvia_buono_voucher/send/{id}','Re-Invia Buono Voucher','fa fa-tag text-red','',array('data-toogle'=>'tooltip'),array('Disdetta','=','0')); 
    $xcrud->button(BASE_URL_SITO.'ri_abilita_preno/{id}','Ri-abilita la prenotazione, NON più disdetta','fa fa-minus-circle text-white',' bg-red',array('data-toogle'=>'tooltip'),array('Disdetta','=','1')); 
    $xcrud->button(BASE_URL_SITO.'modifica_modulo_hospitality/edit/{id}/{IdMotivazione}','Edita la prenotazione per variare le date del soggiorno','icon-checkmark glyphicon glyphicon-edit','',array('data-toogle'=>'tooltip'),array('Disdetta','=','0')); 

    $xcrud->button('javascript:validator_cestino(\''.$_SERVER['REQUEST_URI'].'{id}/delete/\');','Elimina','glyphicon glyphicon-remove','bg-red',array('data-toogle'=>'tooltip'));


    $css = '
            <style>
                .ui-dialog-titlebar-close:after {
                    content: \'x\';
                    position: absolute;
                    top: -4px;
                    left: 3px;
                    color:#000;
                }

            </style>'."\r\n";

    if($_REQUEST['azione'] == 'disd' && $_REQUEST['param'] == 'ok') {
        $msg =  '<div class="alert alert-success">
                        <i class="fa fa-check"></i>Email per Disdetta Prenotazione inviata con successo.
                    </div>';
    }
    if($_REQUEST['azione'] == 'disd' && $_REQUEST['param'] == 'ok_no') {
        $msg =  '<div class="alert alert-success">
                        <i class="fa fa-check"></i>Prenotazione Disdetta senza invio della email al cliente.
                    </div>';
    }




    $js_ajax = '
        <script>
            $(document).ready(function() {

                checkScreenDimension();

            });

            function open_voucher_recupero(id){
                var stringa = id;
                var new_    = stringa. split("_");
                var new_id  = new_[2];
                $("#voucher_recupero").load("'.BASE_URL_SITO.'ajax/send_mail_voucher_rec.php?idsito='.IDSITO.'&id_preno="+new_id+"&avatar='.AVATAR.'&nome_hotel='.urlencode(NOMEHOTEL).'&email_hotel='.urlencode(EMAILHOTEL).'&dir_sito='.urlencode(DIRECTORYSITO).'");
            }

    </script>'."\r\n";


    $js_script_delete ='
    <script>
        $(document).ready(function() {
            $("#delete_all").on(\'click\', function () {
                var checkbox_value = "";
                $("input[name=Id]").each(function () {
                    var ischecked = $(this).is(":checked");
                    if (ischecked) {
                        checkbox_value += $(this).val() + ",";
                    }
                });
                if(checkbox_value){
                    if (window.confirm("ATTENZIONE: Sicuro di voler mettere le richieste selezionate nel cestino?")){
                        $.ajax({
                            url: "'.BASE_URL_SITO.'ajax/delete_all.php",
                            type: "POST",
                            data: "idsito='.IDSITO.'&cestino=1&checkbox_value="+checkbox_value,
                            dataType: "html",
                            success: function(data) {
                                    $("#risultato_del").html(\'<br><div class="alert alert-success">I preventivi sono stati <b>eliminati</b>!! Attendi ora il reload della pagina!</div><br>\');
                                    setTimeout(function(){
                                    $("#risultato_del").fadeOut(200);
                                    location.reload();
                                    }, 2000);
                                }
                        });
                        return false; // con false senza refresh della pagina
                    }

                }else{
                    $("#risultato_del").html(\'<br><div class="alert alert-danger"><b>Selezionare</b> i preventivi prima di cliccare il pulsante! Attendi ora il reload della pagina!</div>\');
                        setTimeout(function(){
                        $("#risultato_del").fadeOut(200);
                        location.reload();
                        }, 2000);
                }
            });
        });
  </script>'."\r\n";
  
  $js_script_mailing ='
  <script>
      $(document).ready(function() {
          $("#add_all_newsletter").on(\'click\', function () {
              var checkbox_value = "";
              $("input[name=Id]").each(function () {
                  var ischecked = $(this).is(":checked");
                  if (ischecked) {
                      checkbox_value += $(this).val() + ",";
                  }
              });

              if(checkbox_value){
                  if (window.confirm("ATTENZIONE: Sicuro di voler aggiungere questo/i utente/i a '.NOME_CLIENT_EMAIL.'?")){

                    $("#modale_upselling").load("'.BASE_URL_SITO.'ajax/add_inlist_mailing.php?idsito='.IDSITO.'&checkbox="+checkbox_value);

                  }

              }else{
                  $("#risultato_newsletter").html(\'<br><div class="alert alert-danger"><b>Selezionare</b> le prenotazioni prima di cliccare il pulsante! Attendi ora il reload della pagina!</div>\');
                      setTimeout(function(){
                      $("#risultato_newsletter").fadeOut(200);
                        location.reload();
                      }, 2000);
              }

          });
      });
</script>'."\r\n";

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
  </script>'."\r\n";


if(check_configurazioni(IDSITO,'check_pagination')==1){
    $js_pagination = '
    <script>
        $(document).ajaxComplete(function(){
            $(\'.pagination li\').hasClass(\'active\');
            var Pagina = $(\'.pagination li span\').text();
            var Pagina_clean = Pagina.replace("\u2026","");
            console.log(Pagina_clean);
            scriviCookie(\'PaginationPreno\',Pagina_clean,\'60\');
            $(\'.pagination li\').one("mouseover",function(){
                $( "#legendaPagination" ).show( "slow", function() {
                    $(\'#legendaPagination\').html("<div class=\"alert alert-warning\">Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</div>");
                  });
            });
            $(\'.pagination li\').one("mouseout",function(){
                $( "#legendaPagination" ).hide( "slow", function() {
                    $(\'#legendaPagination\').html("<div class=\"alert alert-warning\">Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</div>");
                  });
            });
        });
        $("document").ready(function() {
            $(\'.pagination li\').one("mouseover",function(){
                $( "#legendaPagination" ).show( "slow", function() {
                    $(\'#legendaPagination\').html("<div class=\"alert alert-warning\">Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</div>");
                  });
            });
            $(\'.pagination li\').one("mouseout",function(){
                $( "#legendaPagination" ).hide( "slow", function() {
                    $(\'#legendaPagination\').html("<div class=\"alert alert-warning\">Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</div>");
                  });
            });
            if(leggiCookie(\'PaginationPreno\')) {
                var numero = "";
                console.log(leggiCookie(\'PaginationPreno\'));
                if(leggiCookie(\'PaginationPreno\')!=1){
                    var moltiplicatore = (leggiCookie(\'PaginationPreno\')-1);
                    var multi          = parseInt(moltiplicatore);
                    numero             = ('.$numero.'*multi);
                setTimeout(function() {
                        $(\'.xcrud-action[data-start="\'+numero+\'"]\').trigger(\'click\');
                    },1);
                }
            }
        })
    </script>'."\r\n";
}
