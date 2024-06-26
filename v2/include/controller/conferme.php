<?php
//header("Refresh:240; url=".BASE_URL_SITO."conferme/");

if($_GET['azione'] == 'res' && $_GET['param'] == 'ok') {
    $mssg = '<div class="alert alert-success">
                    <i class="fa fa-check"></i>Conferma inviata con successo.
                </div>';
}
if($_GET['azione'] == 'res' && $_GET['param'] == 'ko') {
    $mssg = '<div class="alert alert-warning">
                    <i class="fa fa-warning"></i>Conferma non abilitata all\'invio. Si prega di modificare la sua abilitazione!
                </div>';
}

if($_GET['azione'] == 'qes' && $_GET['param'] == 'ok') {
    $mssg = '<div class="alert alert-success">
                    <i class="fa fa-check"></i>Questionario Customer Satisfaction inviato con successo.
                </div>';
}

if($_REQUEST['action']=='send_data'){
        $data_scadenza_tmp = explode("/",$_REQUEST['DataScadenza']);
        $data_scadenza = $data_scadenza_tmp[2].'-'.$data_scadenza_tmp[1].'-'.$data_scadenza_tmp[0];
        $db->query("UPDATE hospitality_guest SET DataScadenza = '".$data_scadenza."' WHERE Id = '".$_REQUEST['idrichiesta']."'");

        header('location:'.BASE_URL_SITO.'conferme/');
}

if($_REQUEST['azione']!='' && $_REQUEST['param']=='delete'){
        $db->query("UPDATE hospitality_guest SET Hidden = 1 WHERE Id = '".$_REQUEST['azione']."'");
        // $db->query("DELETE FROM hospitality_guest WHERE Id = '".$_REQUEST['azione']."'");
        // $db->query("DELETE FROM hospitality_richiesta WHERE id_richiesta = '".$_REQUEST['azione']."'");
        // $db->query("DELETE FROM hospitality_proposte WHERE id_richiesta = '".$_REQUEST['azione']."'");
        // $db->query("DELETE FROM hospitality_chat WHERE id_guest = '".$_REQUEST['azione']."'");
        // $db->query("DELETE FROM hospitality_customer_satisfaction WHERE id_richiesta = '".$_REQUEST['azione']."'");
        // $db->query("DELETE FROM hospitality_recensioni_send WHERE id_richiesta = '".$_REQUEST['azione']."' AND idsito = '".IDSITO."'");
        // $db->query("DELETE FROM hospitality_altri_pagamenti WHERE id_richiesta = '".$_REQUEST['azione']."'");
        // $db->query("DELETE FROM hospitality_carte_credito WHERE id_richiesta = '".$_REQUEST['azione']."'");
        // $db->query("DELETE FROM hospitality_template_link_landing WHERE id_richiesta = '".$_REQUEST['azione']."' AND idsito = '".IDSITO."'");
        // $db->query("DELETE FROM hospitality_contenuti_web_lingua WHERE IdRichiesta = '".$_REQUEST['azione']."' AND idsito = '".IDSITO."'");
        // $db->query("DELETE FROM hospitality_traccia_email WHERE IdRichiesta = '".$_REQUEST['azione']."' AND Idsito = '".IDSITO."'");

        header('location:'.BASE_URL_SITO.'conferme/');
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
    if($_REQUEST['action']=='unique_filter'){

        if($_REQUEST['Aperture']!=''){

            $lista_id_     = array();
            $lista_id_full = array();
            $lista_id      = array();
            $aperture      = '';

            if($_REQUEST['Aperture'] == 0){

                $select = "SELECT hospitality_guest.Id,hospitality_guest.DataRichiesta,COUNT(hospitality_traccia_email.Id) as conteggio
                            FROM
                                hospitality_guest
                            RIGHT OUTER JOIN
                                hospitality_traccia_email ON hospitality_traccia_email.IdRichiesta = hospitality_guest.Id
                            WHERE hospitality_guest.idsito = ".IDSITO."
                                AND hospitality_guest.TipoRichiesta = 'Conferma'
                                AND hospitality_guest.Archivia = 0
                                AND hospitality_guest.Chiuso = 0
                            GROUP BY hospitality_traccia_email.IdRichiesta";
                $result   = $db->query($select);
                $array_id = $db->result($result);
                if(sizeof($array_id)>0){
                    foreach ($array_id as $key => $value) {
                        if($value['DataRichiesta']>=$_SESSION['DATA_DOWGRADE_SHORTURL']){
                            $aperture = $value['conteggio'];
                        }else{
                            $aperture = ($value['conteggio'] > 0 ? ($value['conteggio']-1) : $value['conteggio'] );
                        }
                        if($aperture!= 0){
                            $lista_id_[] = $value['Id'];
                        }
                    }
                }

                $select2 = "SELECT hospitality_guest.Id,hospitality_guest.DataRichiesta
                            FROM
                                hospitality_guest
                            WHERE hospitality_guest.idsito = ".IDSITO."
                                AND hospitality_guest.TipoRichiesta = 'Conferma'
                                AND hospitality_guest.Archivia = 0
                                AND hospitality_guest.Chiuso = 0";
                $result2   = $db->query($select2);
                $array_id2 = $db->result($result2);
                if(sizeof($array_id2)>0){
                    foreach ($array_id2 as $ky => $val) {
                        $lista_id_full[] = $val['Id'];
                    }
                }

                $lista_id = array_diff($lista_id_full,$lista_id_);

            }


            if($_REQUEST['Aperture'] == 1){

                $select = "SELECT hospitality_guest.Id,hospitality_guest.DataRichiesta, COUNT(hospitality_traccia_email.Id) as conteggio
                            FROM
                            hospitality_guest
                            LEFT JOIN
                            hospitality_traccia_email ON hospitality_traccia_email.IdRichiesta = hospitality_guest.Id
                            WHERE hospitality_guest.idsito = ".IDSITO."
                            AND hospitality_guest.TipoRichiesta = 'Conferma'
                            AND hospitality_guest.Archivia = 0
                            AND hospitality_guest.Chiuso = 0
                            GROUP BY hospitality_traccia_email.IdRichiesta";
                $result   = $db->query($select);
                $array_id = $db->result($result);
                if(sizeof($array_id)>0){
                    foreach ($array_id as $key => $value) {
                        if($value['DataRichiesta']>=$_SESSION['DATA_DOWGRADE_SHORTURL']){
                            $aperture = $value['conteggio'] ;
                        }else{
                            $aperture = ($value['conteggio'] > 0 ? ($value['conteggio']-1) : $value['conteggio'] );
                        }
                        if($aperture!= 0){
                            $lista_id[] = $value['Id'];
                        }
                    }
                }
            }

            if(empty($lista_id)  || is_null($lista_id)){
                $lista_id[] = 0;
            }
            $xcrud->where('hospitality_guest.Id IN('.implode(",",$lista_id).')');

        }
    }
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
        if($_REQUEST['DataScadenza']!=''){
            $data_scad_tmp = explode("/",$_REQUEST['DataScadenza']);
            $data_scad = $data_scad_tmp[2].'-'.$data_scad_tmp[1].'-'.$data_scad_tmp[0];
            $xcrud->where('hospitality_guest.DataScadenza >= "'.$data_scad.'"');
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
        if($_REQUEST['Lingua']!=''){
            $xcrud->where('hospitality_guest.Lingua', $_REQUEST['Lingua']);
        }
        if($_REQUEST['TipoSoggiorno']!=''){
            $xcrud->join('hospitality_guest.Id', 'hospitality_richiesta', 'id_richiesta');
            $xcrud->where('hospitality_richiesta.TipoSoggiorno', $_REQUEST['TipoSoggiorno']);
        }
    }
    $xcrud->where('hospitality_guest.idsito', IDSITO);
    $xcrud->where('TipoRichiesta', 'Conferma');
    $xcrud->where('hospitality_guest.Chiuso', '0');
    $xcrud->where('hospitality_guest.NoDisponibilita', '0');
    $xcrud->where('hospitality_guest.CheckinOnlineClient', '0');
    $xcrud->where('hospitality_guest.Archivia', '0');
    $xcrud->where('hospitality_guest.Hidden', '0');
    $xcrud->order_by('DataRichiesta','DESC');
    $xcrud->order_by('hospitality_guest.Id','DESC');
    $xcrud->order_by('DataInvio','DESC');

    $xcrud->subselect('ReSend','SELECT COUNT(*) FROM hospitality_traccia_email_cron WHERE IdRichiesta = {Id} AND idsito = {idsito} AND TipoReInvio = "ReSend"','Id');
    
    $xcrud->subselect('Pms', 'SELECT Pms  AS pms FROM hospitality_pms WHERE idsito = {idsito} AND Abilitato = 1 LIMIT 1');

    $xcrud->columns('ChiPrenota,NumeroPrenotazione,FontePrenotazione,TipoVacanza,DataRichiesta,Nome,Email,Lingua,DataArrivo,DataPartenza,NumeroAdulti,NumeroBambini,Proposte,DataInvio,Id,Provenienza,idsito,DataScadenza,ReSend,DataVoucherRecSend,Cellulare,NoDisponibilita', false);
   
    $sele = "SELECT Pms  AS pms FROM hospitality_pms WHERE idsito = " . IDSITO . " AND Abilitato = 1 LIMIT 1";
    $ris = $db->query($sele);
    $res = $db->row($ris);
    if (is_array($res)) {
        if ($res > count($res)) // se la pagina richiesta non esiste
            $tot = count($res); // restituire la pagina con il numero più alto che esista
    } else {
        $tot = 0;
    }
    if ($tot > 0) {
    
        $selP = "SELECT * FROM  hospitality_tipo_camere  WHERE (RoomTypePms IS NOT NULL OR RoomTypePms != '') AND idsito = " . IDSITO . " ";
        $rsP = $db->query($selP);
        $rCP = $db->result($rsP);
        $totP = sizeof($rCP);
    
        if ($totP > 0) {
            $xcrud->column_callback('Pms', 'func_pms');
            $xcrud->column_class('Pms', 'align-center');
            $xcrud->columns('Pms', false);
            $xcrud->label('Pms', '5 Stelle');
        } else {
            $legenda_pms = '<h5><i class="fa fa-exclamation-circle text-success"></i> Per poter visualizzare <b>il bottone per sincronizzare con PMS ParityRate</b>, è neccessario <b>abbinare</b> tutte le tipologie di camera con il PMS!</h5>';
        }
    }
    
    if (check_ericsoftpms(IDSITO) == 1) {
        $xcrud->column_callback('Pms', 'func_pms_ericsoft');
        $xcrud->column_class('Pms', 'align-center');
        $xcrud->columns('Pms', false);
        $xcrud->label('Pms', 'Ericsoft');
    }
    if(check_bedzzlePMS(IDSITO) == 1){
        $xcrud->column_callback('Pms', 'func_pms_bedzzle');
        $xcrud->column_class('Pms', 'align-center');
        $xcrud->column_tooltip('Pms', 'Le Prenotazioni verranno salvate in coda e successivamente dopo tot secondi verranno prese in carico da un bot per il trasferimento dei dati nel PMS.');
        $xcrud->columns('Pms', false);
        $xcrud->label('Pms', 'Bedzzle');
    }

    $xcrud->column_callback('Provenienza','func_chat');
    $xcrud->column_callback('idsito','func_cc');
    $xcrud->column_callback('TipoVacanza','bg_tipo');
    $xcrud->column_callback('FontePrenotazione','bg_fonte');
    $xcrud->column_callback('Nome','gia_presente_conf');
    $xcrud->column_callback('ChiPrenota' , 'get_operatore');
    $xcrud->column_callback('Id' , 'conta_click');

    $xcrud->column_callback('DataVoucherRecSend' , 'check_voucher_recupero_send');

    $xcrud->column_callback('ReSend','re_email_send');
    $xcrud->column_pattern('ReSend' , '<small>{value}</small>');

    $xcrud->column_callback('NoDisponibilita' , 'check_no_disponibilita');

    $xcrud->column_pattern('Nome' , '<small><b>{value} {Cognome}</b></small>');
    $xcrud->column_pattern('Cognome' , '<small><b>{value}</b></small>');
    $xcrud->column_pattern('Email' , '<small style="white-space: nowrap;">{value}</small>');
    $xcrud->column_pattern('DataRichiesta' , '<small>{value}</small>');
    $xcrud->column_pattern('Lingua' , '<small>{value}</small>');
    $xcrud->column_callback('DataArrivo' , 'get_data_arrivo_conferma');
    $xcrud->column_callback('DataPartenza' , 'get_data_partenza_conferma');
    $xcrud->column_pattern('NumeroAdulti' , '<small>{value}</small>');
    $xcrud->column_pattern('NumeroBambini' , '<small>{value}</small>');
    $xcrud->column_pattern('DataInvio' , '<small>{value}</small>');
    $xcrud->column_pattern('DataScadenza' , '<small>{value}</small>');
    $xcrud->column_pattern('NumeroPrenotazione' , '<a href="'.BASE_URL_SITO.'timeline/{NumeroPrenotazione}" title="Timeline"  data-toogle="tooltip"><small>{value}</small></a>');
    $xcrud->column_pattern('Id' , '<small>{value}</small>');
    $xcrud->column_pattern('Click' , '<small>{value}</small>');


    $xcrud->label(array('Proposte' => 'Proposta',
                                'TipoVacanza' => 'Tipo',
                                'Nome' => 'Nome Cognome',
                                'DataRichiesta' => 'Richiesta',
                                'Lingua' => 'Lg',
                                'DataArrivo' => 'Arrivo',
                                'DataPartenza' => 'Partenza',
                                'NumeroAdulti' => 'A',
                                'NumeroBambini' => 'B',
                                'NumeroPrenotazione' => 'Nr.',
                                'ChiPrenota' => 'Nome Operatore',
                                'EmailSegretaria' => 'Email Operatore',
                                'FontePrenotazione' => 'Fonte',
                                'Provenienza' => '',
                                'DataScadenza' => 'Scadenza',
                                'idsito' => '',
                                'Id' => 'Aperta',
                                'TipoPagamento' => 'Tipologia Pagamento',
                                'DataInvio' => 'Invio',
                                'ChiPrenota' => 'Op.',
                                'ReSend' => '',
                                'DataVoucherRecSend' => '',
                                'Cellulare' => '',
                                'NoDisponibilita' => ''));

    $xcrud->column_callback('Email','ico_mail');
    $xcrud->column_class('ChiPrenota,Email,Proposte,Provenienza,idsito,NumeroAdulti,NumeroBambini,Id,ReSend', 'align-center');

    $xcrud->column_tooltip('ReSend','Invio ReSend Conferma', 'fa fa fa-ellipsis-h text-white');
    $xcrud->column_tooltip('Provenienza','Chat', 'fa fa fa-ellipsis-h text-white');
    $xcrud->column_tooltip('idsito','Tipo Pagamento', 'fa fa fa-ellipsis-h text-white');

    $xcrud->column_callback('Lingua','show_flags');
    $xcrud->column_callback('Proposte','get_conferma');

    $xcrud->column_callback('DataInvio','get_invio');
    $xcrud->column_callback('DataScadenza','data_scadenza');

    $xcrud->column_callback('Cellulare','get_whatsapp_conf');

    $xcrud->highlight('DataInvio', '=', '', '#FDFDD3');

    $xcrud->search_columns('Id,NumeroPrenotazione,FontePrenotazione,TipoVacanza,DataRichiesta,Nome,Cognome,Email,Lingua,DataArrivo,DataPartenza,DataInvio,DataScadenza');
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
    $numero5 = ($numero*6);
    $numero6 = ($numero*8); 
    $xcrud->limit($numero);
    $xcrud->limit_list($numero.','.$numero2.','.$numero3.','.$numero4.','.$numero5.','.$numero6);

    $xcrud->button(BASE_URL_SITO.'send_mail/send/{id}','Invia conferma e modalità pagamento','icon-checkmark glyphicon glyphicon-envelope text-green pul_send','',array('data-toogle' => 'tooltip'),array('DataScadenza','>=',date('Y-m-d')));
    $xcrud->button(BASE_URL_SITO.'modifica_modulo_hospitality/edit/{id}','Modifica','icon-checkmark glyphicon glyphicon-edit','',array('data-toogle' => 'tooltip'));
    $xcrud->button(BASE_URL_SITO.'prenotazioni/sendVoucherW/{id}','<div class="text-left">ATTENZIONE: disabilitare il BLOCCO POPUP del vostro Browser prima di utilizzare questa funzione!<br><br>Conferma prenotazione ed invia Voucher tramite Whatsapp</div>','icon-checkmark fa fa-whatsapp fa-flip-horizontal','text-olive',array('data-toogle' => 'tooltip', 'data-html' => true),array('DataScadenza','>=',date('Y-m-d')));
    $xcrud->button('#','Conferma prenotazione ed invia voucher','icon-checkmark fa fa-bed','',array('data-toogle' => 'tooltip','onclick'=>'val_vaucher(\''.BASE_URL_SITO.'send_vaucher/send/{id}\')'));
    $xcrud->create_action('Visibile', 'visibile'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Invisibile', 'invisibile');
    $xcrud->button('#', 'Disabilita conferma all\'autoresponder di Re-Send', 'icon-checkmark glyphicon glyphicon-eye-open', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'Invisibile',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Visibile',
            '=',
            '1')
    );
    $xcrud->button('#', 'Abilita conferma all\'autoresponder di Re-Send', 'icon-close glyphicon glyphicon-eye-close text-white', 'xcrud-action bg-black', array(
        'data-task' => 'action',
        'data-action' => 'Visibile',
        'data-primary' => '{Id}'),
        array(
        'Visibile',
        '!=',
        '1'));

    $xcrud->button('javascript:;','Aperture Analytics','icon-checkmark fa fa-hand-pointer-o','xcrud_modal',array('data-toogle' => 'tooltip','data-header' =>'Aperture contate da Google Analytics', 'data-content' => '<iframe height="20px" width="100%" frameborder="0" scrolling="no" allowtransparency="true" src="'.BASE_URL_SITO.'click/conf/{id}/"></iframe>'),array('DataRichiesta','<',DATA_DOWGRADE_SHORTURL));
    
    $xcrud->button('javascript:;','Annulla conferma e motivala','icon-checkmark fa fa-minus-circle text-red','xcrud_modal',array('data-toogle' => 'tooltip','data-header' =>'Invia email al cliente per conferma annullata e motivala', 'data-content' => '<iframe height="650px" width="100%" frameborder="0" scrolling="no" allowtransparency="true" src="'.BASE_URL_SITO.'non_disponibile/{id}/"></iframe>'),array('NoDisponibilita','!=',1));

    $xcrud->create_action('Archivia', 'Archivia'); // action callback, function publish_action() in functions.php
    $xcrud->button('#', 'Archivia conferma', 'icon-checkmark glyphicon glyphicon-inbox', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'Archivia',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Archivia',
            '=',
            '0')
    );
    $xcrud->button('javascript:validator_cestino(\''.$_SERVER['REQUEST_URI'].'{id}/delete/\');','Cestina','glyphicon glyphicon-remove','bg-red',array('data-toogle' => 'tooltip'));


    $sel = "SELECT * FROM hospitality_giorni_recall_conferme WHERE idsito = ".IDSITO;
    $res = $db->query($sel);
    $row = $db->row($res);
    $abilita_resend = $row['abilita'];
    $numero_giorni_resend = $row['numero_giorni'];

    if($abilita_resend == 1){
        $txt_resend = '<p class="text-blue"><i class="fa fa-exclamation-circle text-info" aria-hidden="true"></i> <small><b>E-mail di ReSend Conferme è configurata per l\'invio automatico'.($numero_giorni_resend!='' && $numero_giorni_resend!=0 ?': '.$numero_giorni_resend.' '.($numero_giorni_resend==1?'giorno':'giorni').' prima ':' il giorno stesso ').' della Scadenza</b></small></p>';
    }

    $alert_voucher = '<div id="dialog" title="ATTENZIONE!" style="display:none">
                            <small><small> 
                                    CLICCA su <b>SI</b>:<br>
                                    Se desideri <b>confermare la prenotazione ed inviare il voucher</b> al cliente!<br><br>
                                    CLICCA <b>NO</b>:<br>
                                    Se desideri <b>confermare la prenotazione MA NON inviare il voucher</b> al cliente!<br><br>
                                    CLICCA SULLA <b>X</b>:<br>
                                    Se desideri chiudere la finestra e non effettuare nessuna azione!
                                </small></small>
                        </div>'."\r\n";

    if(check_configurazioni(IDSITO,'check_notifiche_push')==1){
        if(n_conferme_send(1)>0){
            $notifiche_js = '<script>$( document ).ready(function() {open_notifica("Ciao <b>" + NomeHotel + "</b> ricordati che hai ancora <b class=\"text16\">" + ContatoreConferme + "</b> conferme da inviare"," ","plain","bottom-right","success",5000,"#ff6849");});</script>'."\r\n";
        }
    }

    if(check_configurazioni(IDSITO,'check_pagination')==1){
        $js_pagination = '
        <script>
            $(document).ajaxComplete(function(){
                $(\'.pagination li\').hasClass(\'active\');
                var Pagina = $(\'.pagination li span\').text();
                var Pagina_clean = Pagina.replace("\u2026","");
                console.log(Pagina_clean);
                scriviCookie(\'PaginationConf\',Pagina_clean,\'60\');
            });
            $("document").ready(function() {

                if(leggiCookie(\'PaginationConf\')) {
                    var numero = "";
                    console.log(leggiCookie(\'PaginationConf\'));
                    if(leggiCookie(\'PaginationConf\')!=1){
                        var moltiplicatore = (leggiCookie(\'PaginationConf\')-1);
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
