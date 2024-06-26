<?php
//header("Refresh:240; url=".BASE_URL_SITO."preventivi/");

if($_REQUEST['azione'] == 'res' && $_REQUEST['param'] == 'ok') {
     $mssg = '<div class="alert alert-success">
                <i class="fa fa-check"></i> Preventivo inviato con successo.
            </div>';
}
if($_REQUEST['azione'] == 'res' && $_REQUEST['param'] == 'ko') {
    $mssg = '<div class="alert alert-warning">
                <i class="fa fa-warning"></i> Preventivo non abilitato all\'invio. Si prega di modificare la sua abilitazione e/o la sua scadenza!
            </div>';
}
if($_REQUEST['azione'] == 'dispo' && $_REQUEST['param'] == 'ok') {
    $mssg = '<div class="alert alert-success">
                <i class="fa fa-check"></i>Email per assenza disponibilità inviata con successo!
            </div>';
}

// inclusione per import email dai form del sito
//if(CHECK_WEBSITE == 1){

    //syncro_form_sito();

    $data_syncro = check_syncro_form_sito(IDSITO);
//}
// fine ############################################################
//
// inclusione per import email di info algberghi
$InfoAlberghiButton = syncro_info_alberghi(IDSITO);
if(strlen($InfoAlberghiButton)>0){
    //syncronizzo i dati dei form richieste preventivi da Info Alberghi
    $data_import  = check_syncro_info_alberghi(IDSITO);
}
// fine ############################################################
//
$GabicceMareButton = syncro_gabiccemare(IDSITO);
if(strlen($GabicceMareButton)>0){
    //syncronizzo i dati dei form richieste preventivi da gabiccemare.com
    $data_import_gabicce  = check_syncro_gabiccemare(IDSITO);
}
// fine ############################################################
//
$ItalyFamilyHotelsButton = syncro_italyfamilyhotels(IDSITO);
if(strlen($ItalyFamilyHotelsButton)>0){
    //syncronizzo i dati dei form richieste preventivi da gabiccemare.com
    $data_import_italyfamilyhotels  = check_syncro_italyfamilyhotels(IDSITO);
}
// fine ############################################################
//
$RiccioneinHotelButton = syncro_riccioneinhotel(IDSITO);
if(strlen($RiccioneinHotelButton)>0){
    //syncronizzo i dati dei form richieste preventivi da gabiccemare.com
    $data_import_riccioneinhotel  = check_syncro_riccioneinhotel(IDSITO);
}
// fine ############################################################
//
$CesenaticoBellaVitaButton = syncro_cesenaticobellavita(IDSITO);
if(strlen($CesenaticoBellaVitaButton)>0){
    //syncronizzo i dati dei form richieste preventivi da cesenaticobellavita.it
    $data_import_cesenaticobellavita  = check_syncro_cesenaticobellavita(IDSITO);
}
// fine ############################################################
//
$FamilygoButton = syncro_familygo(IDSITO);
if(strlen($FamilygoButton)>0){
    //syncronizzo i dati dei form richieste preventivi da familygo.eu
    $data_import_familygo  = check_syncro_familygo(IDSITO);
}
// fine ############################################################
$ItalyBikeHotelsButton = syncro_italybikehotels(IDSITO);
if(strlen($ItalyBikeHotelsButton)>0){
    //syncronizzo i dati dei form richieste preventivi da 
    $data_import_italybikehotels  = check_syncro_italybikehotels(IDSITO);
}
// fine ############################################################
$BimboInViaggioButton = syncro_bimboinviaggio(IDSITO);
if(strlen($BimboInViaggioButton)>0){
    //syncronizzo i dati dei form richieste preventivi da 
    $data_import_bimboinviaggio  = check_syncro_bimboinviaggio(IDSITO);
}
// fine ############################################################


if($_REQUEST['action']=='send_data'){
        $data_scadenza_tmp = explode("/",$_REQUEST['DataScadenza']);
        $data_scadenza = $data_scadenza_tmp[2].'-'.$data_scadenza_tmp[1].'-'.$data_scadenza_tmp[0];
        if($data_scadenza>=date('Y-m-d')){
            $and = ', AbilitaInvio = 1 ';
        }
        $db->query("UPDATE hospitality_guest SET DataScadenza = '".$data_scadenza."' ".$and." WHERE Id = '".$_REQUEST['idrichiesta']."'");

        header('location:'.BASE_URL_SITO.'preventivi/');
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
                                AND hospitality_guest.TipoRichiesta = 'Preventivo'
                                AND hospitality_guest.Archivia = 0
                                AND hospitality_guest.Chiuso = 0
                                AND hospitality_guest.Accettato = 0
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
                                AND hospitality_guest.TipoRichiesta = 'Preventivo'
                                AND hospitality_guest.Archivia = 0
                                AND hospitality_guest.Chiuso = 0
                                AND hospitality_guest.Accettato = 0";
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
                            AND hospitality_guest.TipoRichiesta = 'Preventivo'
                            AND hospitality_guest.Archivia = 0
                            AND hospitality_guest.Chiuso = 0
                            AND hospitality_guest.Accettato = 0
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

        if($_REQUEST['campagna']!=''){
                    $select = " SELECT 
                                    hospitality_guest.Id
                                FROM
                                    hospitality_guest
                                INNER JOIN
									hospitality_utm_ads ON hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                                WHERE 
                                    hospitality_guest.idsito = ".IDSITO."
                                AND 
                                    hospitality_guest.TipoRichiesta = 'Preventivo'
                                AND 
                                    hospitality_guest.Archivia = 0
                                AND 
                                    hospitality_guest.Chiuso = 0
                                AND 
                                    hospitality_guest.Accettato = 0
                                AND 
                                    hospitality_guest.FontePrenotazione = 'Sito Web'
                                AND
                                    hospitality_utm_ads.idsito = ".IDSITO."
                                AND 
									hospitality_utm_ads.utm_source = '".$_REQUEST['campagna']."'";
                $result   = $db->query($select);
                $array_id = $db->result($result);
                if(sizeof($array_id)>0){
                    foreach ($array_id as $key => $value) {
                            $lista_id[] = $value['Id'];
                
                    }
                }
            if(empty($lista_id)  || is_null($lista_id)){
                $lista_id[] = 0;
            }
            $xcrud->where('hospitality_guest.Id IN('.implode(",",$lista_id).')');
        }

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
        if($_REQUEST['Nome']!='' && $_REQUEST['Cognome']==''){
            $xcrud->where('hospitality_guest.Nome LIKE "%'.$_REQUEST['Nome'].'%"');
        }
        if($_REQUEST['Cognome']!='' && $_REQUEST['Nome']==''){
            $xcrud->where('hospitality_guest.Cognome LIKE "%'.$_REQUEST['Cognome'].'%"');
        }
        if($_REQUEST['Nome']!='' && $_REQUEST['Cognome']!=''){
            $xcrud->where('hospitality_guest.Nome LIKE "%'.$_REQUEST['Nome'].'%" AND hospitality_guest.Cognome LIKE "%'.$_REQUEST['Cognome'].'%"');
        }
        if($_REQUEST['Email']!=''){
            $xcrud->where('hospitality_guest.Email', $_REQUEST['Email']);
        }
        if($_REQUEST['NoDisponibilita']!=''){
            $xcrud->where('hospitality_guest.NoDisponibilita', $_REQUEST['NoDisponibilita']);
        }
        if($_REQUEST['DataInvio']!=''){
            $data_invio_tmp = explode("/",$_REQUEST['DataInvio']);
            $data_invio = $data_invio_tmp[2].'-'.$data_invio_tmp[1].'-'.$data_invio_tmp[0];
            $xcrud->where('hospitality_guest.DataInvio = "'.$data_invio.'"');
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
    $xcrud->where('hospitality_guest.TipoRichiesta', 'Preventivo');
    $xcrud->where('hospitality_guest.Hidden', '0');
    $xcrud->where('hospitality_guest.Archivia', '0');
    $xcrud->where('hospitality_guest.Chiuso', '0');
    $xcrud->where('hospitality_guest.Accettato', '0');
    $xcrud->where('hospitality_guest.NoDisponibilita', '0');
    if($_REQUEST['Inviata']==1){
            $xcrud->where('hospitality_guest.Inviata is Null AND DataInvio is Null');
    }

    $xcrud->order_by('hospitality_guest.DataRichiesta','DESC');
    $xcrud->order_by('hospitality_guest.Id','DESC');
    $xcrud->order_by('hospitality_guest.DataInvio','DESC');

    $xcrud->subselect('ReCall','SELECT COUNT(*) FROM hospitality_traccia_email_cron WHERE IdRichiesta = {Id} AND idsito = {idsito} AND TipoReInvio = "ReCall"','Id');

    $xcrud->columns('Id,ChiPrenota,NumeroPrenotazione,FontePrenotazione,TipoVacanza,DataRichiesta,Nome,Email,Lingua,DataArrivo,DataPartenza,NumeroAdulti,NumeroBambini,Proposte,DataInvio,Provenienza,idsito,DataScadenza,ReCall,Cellulare,NoDisponibilita', false);
    $xcrud->change_type('AbilitaInvio','bool');
    $xcrud->column_callback('idsito','func_chat');
    $xcrud->column_callback('TipoVacanza','bg_tipo');
    $xcrud->column_callback('FontePrenotazione','bg_fonte');
    $xcrud->column_callback('Nome','gia_presente');
    $xcrud->column_callback('ChiPrenota' , 'get_operatore');
    $xcrud->column_callback('Id' , 'check_input');
    $xcrud->column_callback('Provenienza' , 'conta_click');

    $xcrud->column_callback('ReCall','re_email_call');
    $xcrud->column_pattern('ReCall' , '<small>{value}</small>');

    $xcrud->column_pattern('Nome' , '<small><b>{value} {Cognome}</b></small>');
    $xcrud->column_pattern('Cognome' , '<small><b>{value}</b></small>');
    $xcrud->column_pattern('Email' , '<small style=" white-space: nowrap;">{value}</small>');
    $xcrud->column_pattern('DataRichiesta' , '<small>{value}</small>');
    $xcrud->column_pattern('Lingua' , '<small>{value}</small>');
    $xcrud->column_callback('DataArrivo' , 'date_it');
    $xcrud->column_callback('DataPartenza' , 'date_it');
    $xcrud->column_class('DataArrivo,DataPartenza', 'nowrap');
    // $xcrud->column_pattern('DataArrivo' , '<small>{value}</small>');
    // $xcrud->column_pattern('DataPartenza' , '<small>{value}</small>');
    $xcrud->column_pattern('DataScadenza' , '<small>{value}</small>');
    $xcrud->column_pattern('NumeroAdulti' , '<small>{value}</small>');
    //$xcrud->column_pattern('NumeroBambini' , '<small>{value}</small>');
    $xcrud->column_callback('NumeroBambini' ,'num_bambini_eta_tooltip');
    $xcrud->column_pattern('Proposte' , '<small>{value}</small>');
    $xcrud->column_pattern('NumeroPrenotazione' , '<a href="'.BASE_URL_SITO.'timeline/{NumeroPrenotazione}" title="Timeline"  data-toogle="tooltip"><small>{value}</small></a>');
    $xcrud->column_pattern('Id' , '<small>{value}</small>');
    $xcrud->column_pattern('Provenienza' , '<small>{value}</small>');
    $xcrud->column_pattern('AbilitaInvio' , '<small>{value}</small>');

    $xcrud->label(array('FontePrenotazione' => 'Fonte',
                                'TipoVacanza' => 'Tipo',
                                'Nome' => 'Nome Cognome',
                                'DataRichiesta' => 'Richiesta',
                                'Lingua' => 'Lg',
                                'DataArrivo' => 'Arrivo',
                                'DataPartenza' => 'Partenza',
                                'NumeroAdulti' => 'A',
                                'Proposte' => 'Proposta',
                                'Provenienza' => 'Aperta',
                                'NumeroBambini' => 'B',
                                'NumeroPrenotazione' => 'Nr.',
                                'ChiPrenota' => 'Nome Operatore',
                                'EmailSegretaria' => 'Email Operatore',
                                'TipoPagamento' => 'Tipologia Pagamento',
                                'idsito' => '',
                                'DataInvio' => 'Invio',
                                'DataScadenza' => 'Scadenza',
                                'Id' => '',
                                'AbilitaInvio' => 'Abilita Invio',
                                'ChiPrenota' => 'Op.',
                                'ReCall' => '',
                                'Cellulare' => '',
                                'NoDisponibilita' =>''));

    $xcrud->column_callback('Email','ico_mail');
    $xcrud->column_class('ChiPrenota,Email,Proposte,NumeroAdulti,NumeroBambini,Provenienza,ReCall', 'align-center');

    $xcrud->column_tooltip('ReCall','Invio ReCall Preventivo', 'fa fa fa-ellipsis-h text-white');
    $xcrud->column_tooltip('idsito','Chat', 'fa fa fa-ellipsis-h text-white');

    $xcrud->column_callback('Lingua','show_flags');
    $xcrud->column_callback('Proposte','get_preventivo');

    $xcrud->column_callback('DataInvio','get_invio');
    $xcrud->column_callback('DataScadenza','get_scadenza');

    $xcrud->column_callback('Cellulare','get_whatsapp');
    $xcrud->column_callback('NoDisponibilita' , 'check_no_disponibilita_p');

    $xcrud->highlight('DataInvio', '=', '', '#FDFDD3');
    //$xcrud->highlight_row('Visibile', '=', '0', '#E1E1E1');
    $xcrud->highlight_row('NoDisponibilita', '=', '1', '#F0F0F0');

    $xcrud->create_action('Attiva', 'abilita_invio'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_invio');
    $xcrud->button('#', 'Disabilita invio email', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'Disattiva',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'AbilitaInvio',
            '=',
            '1')
    );
    $xcrud->button('#', 'Abilita invio email', 'icon-checkmark glyphicon glyphicon-remove', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'Attiva',
        'data-primary' => '{Id}'), array(
        'AbilitaInvio',
        '!=',
        '1'));


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



    $xcrud->button(BASE_URL_SITO.'send_mail/send/{id}','Invia preventivo','icon-checkmark glyphicon glyphicon-envelope text-green pul_send','',array('data-toogle' => 'tooltip'),array('DataScadenza','!=',''));

    $xcrud->button(BASE_URL_SITO.'modifica_modulo_hospitality/edit/{id}','Modifica','icon-checkmark glyphicon glyphicon-edit','',array('data-toogle' => 'tooltip'));
    $xcrud->button('javascript:validator_copia(\''.BASE_URL_SITO.'duplica_preventivo/{id}\');','Duplica','icon-checkmark glyphicon glyphicon-plus','',array('data-toogle' => 'tooltip'));


    $xcrud->button('javascript:;','Invia la mancata disponibilità e motivala','icon-checkmark fa fa-minus-circle text-red','xcrud_modal',array('data-toogle' => 'tooltip','data-header' =>'Motiva mancata disponibilità ed invia email al cliente', 'data-content' => '<iframe height="650px" width="100%" frameborder="0" scrolling="no" allowtransparency="true" src="'.BASE_URL_SITO.'non_disponibile_p/{id}/"></iframe>'),array('NoDisponibilita','!=',1));
    $xcrud->button('javascript:validator_ri_abilita_p(\''.BASE_URL_SITO.'ri_abilita_preventivo/{id}\');','Ri Abilita il preventivo annullato','icon-checkmark fa fa-minus-circle text-green','','',array('NoDisponibilita','=',1));


/*     $xcrud->create_action('Disponibilita', 'disponibilita');
    $xcrud->create_action('NoDisponibilita', 'no_disponibilita');
    $xcrud->button('javascript:;', 'Assenza disponibilità già inviata', 'icon-checkmark glyphicon glyphicon-envelope', 'xcrud-action   bg-red',
        array(),
        array(  // set condition ( when button must be shown)
            'NoDisponibilita',
            '=',
            '1')
    );
    $xcrud->button('#', 'Invia assenza disponibilità', 'icon-checkmark glyphicon glyphicon-envelope text-red', 'xcrud-action', array(
        'onclick'=>'validator_disponibilita(\''.BASE_URL_SITO.'send_no_disponibile/send/{id}\')',
        'data-task' => 'action',
        'data-action' => 'Disponibilita',
        'data-primary' => '{Id}'), array(
        'NoDisponibilita',
        '!=',
        '1')); */
  
    $xcrud->button('javascript:;','Aperture Analytics','icon-checkmark fa fa-hand-pointer-o','xcrud_modal',array('data-toogle' => 'tooltip','data-header' =>'Aperture contate da Google Analytics', 'data-content' => '<iframe height="20px" width="100%" frameborder="0" scrolling="no" allowtransparency="true" src="'.BASE_URL_SITO.'click/prev/{id}/"></iframe>'),array('DataRichiesta','<',DATA_DOWGRADE_SHORTURL));


    $xcrud->create_action('Visibile', 'visibile'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Invisibile', 'invisibile');
    $xcrud->button('#', 'Disabilita preventivo all\'autoresponder di ReCall', 'icon-checkmark glyphicon glyphicon-eye-open', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'Invisibile',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Visibile',
            '=',
            '1')
    );
    $xcrud->button('#', 'Abilita preventivo all\'autoresponder di ReCall', 'icon-close glyphicon glyphicon-eye-close text-white', 'xcrud-action bg-black', array(
        'data-task' => 'action',
        'data-action' => 'Visibile',
        'data-primary' => '{Id}'), array(
        'Visibile',
        '!=',
        '1'));

    $sel = "SELECT * FROM hospitality_giorni_recall_preventivi WHERE idsito = ".IDSITO;
    $res = $db->query($sel);
    $row = $db->row($res);
    $abilita_recall = $row['abilita'];
    $numero_giorni_recall = $row['numero_giorni'];

    $qy_op  = $db->query("SELECT * FROM hospitality_operatori WHERE Abilitato = 1 AND idsito = ".IDSITO." ORDER BY Id ASC");
    $arr_op = $db->result($qy_op);
    foreach($arr_op as $chy => $rec_op){
        $lista_op .= '<option value="'.$rec_op['Id'].'" '.($_REQUEST['AssOperatore']==$rec_op['Id']?'selected':'').'>'.$rec_op['NomeOperatore'].'</option>';
    }
    if(check_configurazioni(IDSITO,'check_notifiche_push')==1){
        if(n_preventivi_send(1)>0){
            $notifiche_js = '<script>$( document ).ready(function() {open_notifica("Ciao <b>" + NomeHotel + "</b> ricordati che hai ancora <b class=\"text16\">" + ContatorePreventivi + "</b> preventivi da inviare"," ","plain","bottom-right","maroon",5000,"#00acc1");});</script>'."\r\n";
        }
    }

    $js = ' <script>
                $(document).ready(function(){

                    checkScreenDimension();

                    if($(\'input[name=IdPrev]\').length <= 0){
                        $(\'#assegna_all_op\').hide();
                        $(\'#checkAllOp\').hide();
                    }
                });
                $(document).load($(window).bind("resize", checkScreenDimension));

            </script>'."\r\n";

    if($abilita_recall == 1){
        $testo_recall = '<p class="text-blue"><i class="fa fa-exclamation-circle text-info" aria-hidden="true"></i> <small><b>E-mail di ReCall Preventivi è configurata per l\'invio automatico'.($numero_giorni_recall!='' && $numero_giorni_recall!=0 ?': '.$numero_giorni_recall.' '.($numero_giorni_recall==1?'giorno':'giorni').' prima ':' il giorno stesso ').' della Scadenza</b></small></p>';
    }

    $js_script_archivia ='
    <script>
        $(document).ready(function() {
            $("#archivia_all").on(\'click\', function () {
                var checkbox_value = "";
                $("input[name=Id]").each(function () {
                    var ischecked = $(this).is(":checked");
                    if (ischecked) {
                        checkbox_value += $(this).val() + ",";
                    }
                });
                if(checkbox_value){
                    if (window.confirm("ATTENZIONE: Sicuro di voler archiviare i preventivi selezionati?")){
                        $.ajax({
                            url: "'.BASE_URL_SITO.'ajax/archivia_all.php",
                            type: "POST",
                            data: "idsito='.IDSITO.'&checkbox_value="+checkbox_value,
                            dataType: "html",
                            success: function(data) {
                                $("#risultato").html(\'<br><div class="alert alert-success">I <b>preventivi</b> sono stati <b>archiviati</b>!! Attendi ora il reload della pagina!</div><br>\');
                                setTimeout(function(){
                                    $("#risultato").fadeOut(200);
                                    location.reload();
                                }, 2000);
                                }
                        });
                        return false; // con false senza refresh della pagina
                    }
                }else{
                    $("#risultato").html(\'<br><div class="alert alert-danger"><b>Selezionare</b> i preventivi prima di cliccare il pulsante! Attendi ora il reload della pagina!</div>\');
                        setTimeout(function(){
                        $("#risultato").fadeOut(200);
                        location.reload();
                        }, 2000);
                }

            });
        });
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
                  $("#risultato_newsletter").html(\'<br><div class="alert alert-danger"><b>Selezionare</b> i preventivi prima di cliccare il pulsante! Attendi ora il reload della pagina!</div>\');
                      setTimeout(function(){
                      $("#risultato_newsletter").fadeOut(200);
                        location.reload();
                      }, 2000);
              }
          });
      });
</script>'."\r\n";

    $js_script_modale_op ='
    <script>
        $(document).ready(function() {
            $("#form_ass_op").submit(function () {
                var checkbox_op = "";
                $("input[name=IdPrev]").each(function () {
                    var ischecked = $(this).is(":checked");
                    if (ischecked) {
                        checkbox_op += $(this).val() + ",";
                    }
                });
                var operatore = $("#AssOperatore").val();
                if(checkbox_op){
                    if (window.confirm("ATTENZIONE: Sicuro di voler associare l\'operatore scelto, ai preventivi selezionati?")){
                        $.ajax({
                            url: "'.BASE_URL_SITO.'ajax/associa_operatore.php",
                            type: "POST",
                            data: "idsito='.IDSITO.'&checkbox_op="+checkbox_op+"&operatore="+operatore+"",
                            dataType: "html",
                            success: function(data) {
                                $("#risultato_op").html("<br><div class=\"alert alert-success\">I preventivi sono stati <b>associati</b> all\'operatore scelto!! Attendi il reload pagina!</div><br>");
                                setTimeout(function(){
                                    $("#risultato_ko_op").fadeOut(200);
                                    location.reload();
                                }, 2000);
                            }
                        });
                        return false; // con false senza refresh della pagina
                    }

                }else{
                        $("#risultato_ko_op").html(\'<br><div class="alert alert-danger"><b>Selezionare</b> i preventivi dove associare un operatore, prima di cliccare il pulsante! Attendi il reload pagina!</div>\');
                        setTimeout(function(){
                            $("#risultato_op").fadeOut(900);
                            location.reload();
                        }, 2000);
                }
            });
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
                scriviCookie(\'PaginationPrev\',Pagina_clean,\'60\');
/*                 $(\'.pagination li\').one("mouseover",function(){
                    $( "#legendaPagination" ).show( "slow", function() {
                        $(\'#legendaPagination\').html("<div class=\"alert alert-warning\">Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</div>");
                      });
                });
                $(\'.pagination li\').one("mouseout",function(){
                    $( "#legendaPagination" ).hide( "slow", function() {
                        $(\'#legendaPagination\').html("<div class=\"alert alert-warning\">Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</div>");
                      });
                }); */

            });
            $("document").ready(function() {
/*                 $(\'.pagination li\').one("mouseover",function(){
                    $( "#legendaPagination" ).show( "slow", function() {
                        $(\'#legendaPagination\').html("<div class=\"alert alert-warning\">Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</div>");
                      });
                });
                $(\'.pagination li\').one("mouseout",function(){
                    $( "#legendaPagination" ).hide( "slow", function() {
                        $(\'#legendaPagination\').html("<div class=\"alert alert-warning\">Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</div>");
                      });
                }); */
                if(leggiCookie(\'PaginationPrev\')) {
                    var numero = "";
                    console.log(leggiCookie(\'PaginationPrev\'));
                    if(leggiCookie(\'PaginationPrev\')!=1){
                        var moltiplicatore = (leggiCookie(\'PaginationPrev\')-1);
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
