<?php


if($_REQUEST['azione']!='' && $_REQUEST['param']=='delete'){
        $db->query("DELETE FROM hospitality_guest WHERE Id = '".$_REQUEST['azione']."'");
        
        header('location:'.BASE_URL_SITO.'prenotazioni_esterne/');
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



    $xcrud->where('hospitality_guest.idsito', IDSITO);
    $xcrud->where('TipoRichiesta', 'Conferma');
    $xcrud->where('hospitality_guest.Chiuso', '1');
    $xcrud->where('hospitality_guest.CheckinOnlineClient', '1');
    $xcrud->where('hospitality_guest.Archivia', '0');
    $xcrud->where('hospitality_guest.Hidden', '0');
    $xcrud->order_by('DataChiuso','DESC');

    $xcrud->columns('ChiPrenota,NumeroPrenotazione,FontePrenotazione,TipoVacanza,DataRichiesta,Nome,Email,Lingua,DataArrivo,DataPartenza,NumeroAdulti,NumeroBambini,DataChiuso,idsito,CheckinInviato,Cellulare', false);


    $xcrud->column_callback('TipoVacanza','bg_tipo');
    $xcrud->column_callback('FontePrenotazione','bg_fonte');
    $xcrud->column_callback('Nome','gia_presente_chiuse');
    $xcrud->column_callback('DataChiuso','get_data_chiuso');
    $xcrud->column_callback('ChiPrenota' , 'get_operatore');
    $xcrud->column_callback('idsito' , 'check_campo_vuoto');


    $xcrud->column_pattern('Nome' , '<small><b>{value} {Cognome}</b></small>');
    $xcrud->column_pattern('Cognome' , '<small><b>{value}</b></small>');
    $xcrud->column_pattern('Email' , '<small style="white-space: nowrap;">{value}</small>');
    $xcrud->column_pattern('DataRichiesta' , '<small>{value}</small>');
    $xcrud->column_pattern('Lingua' , '<small>{value}</small>');
    $xcrud->column_callback('DataArrivo' , 'get_data_arrivo_conferma');
    $xcrud->column_callback('DataPartenza' , 'get_data_partenza_conferma');
    $xcrud->column_pattern('NumeroAdulti' , '<small>{value}</small>');
    $xcrud->column_pattern('NumeroBambini' , '<small>{value}</small>');
    $xcrud->column_pattern('NumeroPrenotazione' , '<small>{Prefisso} {value}</small>');
    $xcrud->column_pattern('Id' , '<small>{value}</small>');
    $xcrud->column_pattern('CheckinInviato' , '<small>{value}</small>');


    $xcrud->label(array('idsito' => '',
                                'TipoVacanza' => 'Tipo',
                                'Nome' => 'Nome Cognome',
                                'DataRichiesta' => 'Data inserimento',
                                'Lingua' => 'Lg',
                                'DataArrivo' => 'Arrivo',
                                'DataPartenza' => 'Partenza',
                                'NumeroAdulti' => 'A',
                                'NumeroBambini' => 'B',
                                'NumeroPrenotazione' => 'Nr.Rif.',
                                'EmailSegretaria' => 'Email Operatore',
                                'FontePrenotazione' => 'Fonte',
                                'DataChiuso' => 'Data Pren.',
                                'CheckinInviato' => '',
                                'Cellulare' => '',
                                'ChiPrenota' => 'Op.'));


    $xcrud->column_class('ChiPrenota,Email,NumeroAdulti,NumeroBambini,CheckinInviato', 'align-center');

    $xcrud->column_tooltip('CheckinInviato','Invio automatico per il modulo di Checkin OnLine', 'fa fa fa-ellipsis-h text-white');

    $xcrud->column_callback('Email','ico_mail');
    $xcrud->column_callback('Lingua','show_flags');

    $xcrud->column_callback('CheckinInviato','checkin_send');
    $xcrud->column_callback('Cellulare','get_whatsapp_ckeckin');

    $xcrud->search_columns('NumeroPrenotazione,FontePrenotazione,TipoVacanza,DataRichiesta,Nome,Cognome,Email,Lingua,DataArrivo,DataPartenza,DataChiuso');

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

  

    $qy = "SELECT * FROM hospitality_giorni_checkinonline WHERE idsito = ".IDSITO;
    $rc = $db->query($qy);
    $rs = $db->row($rc);
    $attivo = $rs['abilita'];
    $numero_giorni_ck = $rs['numero_giorni'];

    //if($attivo == 0){
        $xcrud->button(BASE_URL_SITO.'send_checkin_ext/send/{id}','Invia modulo Check-in OnLine tramite E-mail!','fa fa-vcard-o pul_checkin','Invia modulo Check-in OnLine tramite E-mail!',array('data-toogle' => 'tooltip'),array('email','!=',''));
   // }


    $xcrud->button(BASE_URL_SITO.'checkinonline-mod_checkin_online/edit/{id}','Modifica','icon-checkmark glyphicon glyphicon-edit','',array('data-toogle' => 'tooltip'));
      
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



    if($_REQUEST['azione'] == 'checkin' && $_REQUEST['param'] == 'ok') {
        $msg =  '<div class="alert alert-success">
                        <i class="fa fa-check"></i>Email per il Check-in Online inviata con successo.
                    </div>';
    }





    if($attivo == 1){
        $testo_auto_checkin .= '<p class="text-olive"><i class="fa fa-exclamation-circle text-info" aria-hidden="true"></i> <small><b>E-mail per il Check-In OnLine del cliente è configurata in automatico'.($numero_giorni_ck!='' && $numero_giorni_ck!=0 ?': '.$numero_giorni_ck.' '.($numero_giorni_ck==1?'giorno':'giorni').' prima ':' il giorno stesso ').' dal CheckIn</b></small></p>';
        $testo_auto_checkin .= (CHECKINONLINE == 0 ?'<p class="text-olive"><small>L\'invio manuale rimane comunque attivo anche se avete impostato la configurazione automatica d\'invio!</small></p>':'');
    }


    


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
