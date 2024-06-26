<?php

$legenda = '<br /><div class="alert alert-warning text-center" id="legenda">
              <i class="fa fa-exclamation-triangle text-white"></i> Attenzione ad <b>eliminare delle camere</b> se avete già una attività di preventivi e/o prenotazioni in corso, perchè così facendo <b>andreste a svuotare le proposte di soggiorno in produzione</b> e le relative statistiche!
            </div>
            <script>
                $(document).ready(function() {
                        setTimeout(function(){
                            $(\'#legenda\').hide();
                        },15000);
                });
            </script>';

if(FORM_SUL_SITO==1){
      $FormMsg .='<h4 class="text-right"><i class="fa fa-exclamation-circle text-info"></i> <small>Per chi ha integrato nel proprio sito il <em>"form dedicato a QUOTO"</em> <b>API version</b>, potete utilizzare il flag di visibile/non visibile per la lista delle camere!</small></h4>';
      $FormMsg .=' <div class="alert alert-profila alert-default-profila alert-dismissable text-center">';
      $FormMsg .='    <b>CONSIGLIO:</b> Le etichette delle camere da abilitare nel form dovrebbero essere delle tipologie generiche, così da offrire all\'utente una scelta conosciuta per non spiazzarlo con nomi dedicati che solo l\'albergatore potrebbe conoscere<br> ';
                         
    $FormMsg .='        <img src="'.BASE_URL_SITO.'img/si_no.png"> <small>visibile nel form, non visibile nel crea proposta</small> <span class="text-green">(<b>ESEMPIO OTTIMALE</b>: Singola, doppia, matrimoniale, ecc.)</span> <img src="'.BASE_URL_SITO.'img/no_si.png"> <small>non visibile nel form, visibile nel crea proposta</small> <span class="text-red">(<b>ESEMPIO NON OTTIMALE</b>: Camera Standard, Comfort, ecc.)</span>
                  </div>';
  }  
    if($_REQUEST['azione']!='' || $REQUEST['azione'] != 'ok'){
        $script_salto ="
            <script>
                $(document).ready(function() {
                setTimeout(function() {
                    $('.xcrud-action[data-primary=".$_REQUEST['azione']."][data-task=edit]').trigger('click');
                    },1);
                });
            </script>"."\r\n";
    }
    if($REQUEST['azione'] == 'ok') {
        $msg = '<div class="alert alert-success" id="res_back">
                    <i class="fas fa-check"></i> Syncro avvenuta con successo.
                </div>
                <script>
                    $(document).ready(function() {
                            setTimeout(function(){
                                $(\'#res_back\').hide();
                            },3000);
                    });
                </script> ';
    }

    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_tipo_camere');
    $xcrud->where('hospitality_tipo_camere.idsito', IDSITO);
    $xcrud->order_by('Ordine','ASC');
    $xcrud->pass_var('idsito',IDSITO);
    $xcrud->pass_var('Lingua','it');

    $xcrud->before_insert('clean_tipo_camera');
    $xcrud->before_update('clean_tipo_camera');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $xcrud->change_type('Lingua','select','',implode(',',$val));
    }
    $xcrud->change_type('Abilitato','bool');
    $xcrud->set_attr('Abilitato',array('id'=>'chekAB'));

    $db->query("SELECT * FROM hospitality_servizi_camera WHERE Abilitato = 1 AND idsito = ".IDSITO." ORDER BY Servizio ASC");
    $row = $db->result();
    $n_sc = sizeof($row);
    if($n_sc >0){
        foreach($row as $chiave => $valore){
            $lista_servizi[]  = $valore['Servizio'];
        }
        $xcrud->change_type('Servizi','checkboxes','',implode(',',$lista_servizi));
    }else{
        $xcrud->no_editor('Servizi');
        //$xcrud->disabled('Servizi');
    }
    if(check_simplebooking(IDSITO)==1){
        $xcrud->columns('RoomCode');
        $xcrud->column_callback('RoomCode','flag_booking');
        $xcrud->column_tooltip('RoomCode', 'Codice Camera di SimpleBooking ','fa fa-question text-red');
        $xcrud->label('RoomCode', 'RoomCode SB');


        $SbMsg ='<h4 class="text-right"><a href="'.BASE_URL_SITO.'update_syncro_sb/cm/" class="btn bg-purple btn-xs" id="resynchBtn">Re-Synch</a> <br><small>Ri-sincronizza le camere se hai aggiunto una o più tipologie nuove su SimpleBooking!</small></h4>
                <h4 class="text-right"><i class="fa fa-exclamation-circle text-red"></i> <small>Se il lancio della sincronia dovesse aggiungere nuove camere...,ricordatevi di associare i servizi in camera, inserire i testi e le immagini relative!</small></h4>';
        if(IS_NETWORK_SERVICE_USER==1){
            $SbMsg .='<h4 class="text-right"><i class="fa fa-exclamation-triangle text-orange"></i> <small>Solo l\'operatore Network Service vede il pulsante per eliminare le camere sincronizzate, se dovesse essere neccessario re-sincronizzare da SimpleBooking:<br>per esempio se i nomi delle camere sono stati modificati, disabilitare le camere interessata, re-sincronizzare e successivamente eliminare le camere vecchie!</small></h4>';
        }
    }
    if(check_ericsoftbooking(IDSITO)==1){
        $xcrud->columns('RoomCode');
        $xcrud->column_callback('RoomCode','flag_ericsoftbooking');
        $xcrud->column_tooltip('RoomCode', 'Codice Camera di EricsoftBooking ','fa fa-question text-red');
        $xcrud->label('RoomCode', 'RoomCode EB');

        $SbMsg ='<h4 class="text-right"><a href="'.BASE_URL_SITO.'update_syncro_eb/cm/" class="btn bg-light-blue btn-xs" id="resynchBtn">Re-Synch</a> <br><small>Ri-sincronizza le camere se hai aggiunto una o più tipologie nuove su Ericsoft Booking!</small></h4>
        <h4 class="text-right"><i class="fa fa-exclamation-circle text-red"></i> <small>Se il lancio della sincronia dovesse aggiungere nuove camere...,ricordatevi di associare i servizi in camera e le immagini relative!</small></h4>';
        if(IS_NETWORK_SERVICE_USER==1){
            $SbMsg .='<h4 class="text-right"><i class="fa fa-exclamation-triangle text-orange"></i> <small>Solo l\'operatore Network Service vede il pulsante per eliminare le camere sincronizzate, se dovesse essere neccessario re-sincronizzare da Ericsoft Booking:<br>per esempio se i nomi delle camere sono stati modificati, disabilitare le camere interessata, re-sincronizzare e successivamente eliminare le camere vecchie!</small></h4>';
        }
    }
    if(check_bedzzlebooking(IDSITO)==1){
        $xcrud->columns('RoomCode');
        $xcrud->column_callback('RoomCode','flag_bedzzlebooking');
        $xcrud->column_tooltip('RoomCode', 'Codice Camera di Bedzzle ','fa fa-question text-red');
        $xcrud->label('RoomCode', 'RoomCode BedzzleB');

        $SbMsg ='<h4 class="text-right"><a href="'.BASE_URL_SITO.'update_syncro_bedzzle/cm/" class="btn btn-danger btn-xs" id="resynchBtn">Re-Synch</a> <br><small>Ri-sincronizza le camere se hai aggiunto una o più tipologie nuove su Bedzzle Booking/PMS!</small></h4>
        <h4 class="text-right"><i class="fa fa-exclamation-circle text-red"></i> <small>Se il lancio della sincronia dovesse aggiungere nuove camere...,ricordatevi di associare i servizi in camera e le immagini relative!</small></h4>';
        if(IS_NETWORK_SERVICE_USER==1){
            $SbMsg .='<h4 class="text-right"><i class="fa fa-exclamation-triangle text-orange"></i> <small>Solo l\'operatore Network Service vede il pulsante per eliminare le camere sincronizzate, se dovesse essere neccessario re-sincronizzare da Bedzzle Booking:<br>per esempio se i nomi delle camere sono stati modificati, disabilitare le camere interessata, re-sincronizzare e successivamente eliminare le camere vecchie!</small></h4>';
        }
    }
    if(check_pms_bedzzle(IDSITO)==1){
        $xcrud->columns('RoomTypePms');
        $xcrud->column_callback('RoomTypePms','flag_pms_bedzzle');
        $xcrud->column_tooltip('RoomTypePms', 'Abbinamento tipologia di Camera con il PMS ','');
        $xcrud->label('RoomTypePms', 'Tipo Camera sul PMS');
    } 

    $tipo_pms = check_pms(IDSITO);
    switch($tipo_pms){
        case "hotelcinquestelle.cloud":
            $tipoP = 'C';
        break;
        case "booking.ericsoft.com":
            $tipoP = 'E';
        break;
    }


    if($tipo_pms != '0'){
        if(check_camere_pms(IDSITO) == 0){
            $SyncroMsg = '<h4 class="text-right"><a href="'.BASE_URL_SITO.'get_rooms_pms/sync/'.$tipoP.'/camere/" class="btn bg-orange btn-xs" id="resynchBtn">Synch PMS</a> <br><small>Sincronizza la prima volta le tipologie di camera del tuo PMS!</small></h4>';
        }else{
            $SyncroMsg = '<h4 class="text-right"><a href="'.BASE_URL_SITO.'get_rooms_pms/sync/'.$tipoP.'/camere/" class="btn bg-green btn-xs" id="resynchBtn">Synch PMS</a> <br><small>Ri-sincronizza le tipologie di camera del tuo PMS!</small></h4>';

        }
        $PmsMsg = '<h4 class="text-right"><small>Per poter visualizzare la <b>colonna PMS</b> nelle "<b>Prenotazioni confermate</b>", è neccessario <b>abbinare tutte le tipologie di camera</b> con il PMS!</small></h4>';
    }
    if(check_pms(IDSITO)!='0'){
        $xcrud->columns('RoomTypePms');
        $xcrud->column_callback('RoomTypePms','flag_pms');
        $xcrud->column_tooltip('RoomTypePms', 'Abbinamento tipologia di Camera con il PMS ','');
        $xcrud->label('RoomTypePms', 'Tipo Camera sul PMS');
    }

    $parity = check_parity(IDSITO);

    if($parity == 1){
        if(check_camere_parity(IDSITO) == 0){
            $SyncroMsg = '<h4 class="text-right"><a href="'.BASE_URL_SITO.'get_rooms_parity/sync/" class="btn bg-green btn-xs" id="resynchBtn"><i class="fa fa-refresh"></i> Synch ParityRate</a> <br><small>Sincronizza la prima volta le tipologie di camera del Channel Manager Parity Rate!</small></h4>';
        }else{
            $SyncroMsg = '<h4 class="text-right"><a href="'.BASE_URL_SITO.'get_rooms_parity/sync/" class="btn bg-orange btn-xs" id="resynchBtn"><i class="fa fa-refresh"></i> Re-Synch ParityRate</a> <br><small>Ri-sincronizza le tipologie di camera del Channel Manager Parity Rate!</small></h4>';

        }
        $xcrud->columns('RoomParityId');
        $xcrud->column_callback('RoomParityId','flag_camere_parity');
        $xcrud->column_tooltip('RoomParityId', 'Abbinamento Camera con ParityRate ','');
        $xcrud->label('RoomParityId', 'Tipo Camera su ParityRate');

          $PmsMsg = '<h4 class="text-right"><small>ATTENZIONE:  è neccessario <b>abbinare tutte le tipologie di camera</b> con il Channel Manager Parity Rate!</small></h4>';
    }

    $xcrud->columns('TipoCamere, Servizi, Testi presenti');
    if(FORM_SUL_SITO==1){
        $xcrud->columns('Abilitato_form');
        $xcrud->label('Abilitato_form', 'Visibile nel form del vs. sito');
        $xcrud->change_type('Abilitato_form','bool');
    }
    $xcrud->columns('Abilitato,idsito');

    $xcrud->column_callback('idsito','cambia_ordine_camere');
    $xcrud->label('idsito','Ordine');
    
    $xcrud->fields('Servizi,TipoCamere,Abilitato');

    $xcrud->field_tooltip('Servizi','Scegliere uno o più servizi da abbinare alla camera');

    $xcrud->column_callback('Lingua','show_flags');

    $xcrud->validation_required('TipoCamere',3);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(lingue," ") SEPARATOR " ") AS lingue FROM hospitality_camere_testo WHERE camere_id = {id}');
    $xcrud->column_callback('Testi presenti','show_flags');

    $xcrud->unset_title(true);
   if(IS_NETWORK_SERVICE_USER==0){
        //$xcrud->unset_remove(true,'RoomCode','!=','');
        $xcrud->unset_remove();
    }
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers();
    $xcrud->hide_button('save_new');
    /* GESTIONE TABELLA TESTI */
    $servizi_testo = $xcrud->nested_table('Gestione testi in lingua','Id','hospitality_camere_testo','camere_id');
    $servizi_testo->columns('lingue,Camera,Descrizione');


    $servizi_testo->fields('lingue,Camera,Descrizione');
    $servizi_testo->field_callback('Descrizione','custom_textarea_camere');
    $servizi_testo->column_callback('lingue','show_flags');
    $servizi_testo->relation('lingue','hospitality_lingue','Sigla','Sigla','idsito='.IDSITO);
    $servizi_testo->language('it');
    $servizi_testo->pass_var('idsito',IDSITO);

    $servizi_testo->before_insert('clean_camera');
    $servizi_testo->before_update('clean_camera');

    $servizi_testo->validation_required('lingue');
    $servizi_testo->validation_required('Camera',3);

    $servizi_testo->unset_remove(true,'RoomCode','!=','');
    $servizi_testo->unset_csv();
    $servizi_testo->unset_print();
    $servizi_testo->table_name('Inserire il nome, la descrizione per questa camera in ogni lingua!', 'Inserire tipo camera e testo in ogni lingua','fa fa-comments');
    $servizi_testo->unset_numbers();
    $servizi_testo->unset_search();
    $servizi_testo->unset_pagination();
    $servizi_testo->unset_limitlist();
    $servizi_testo->hide_button('save_new');


    /* GESTIONE TABELLA TESTI */
    $select = "SELECT TipoListino FROM hospitality_tipo_listino WHERE idsito = ".IDSITO;
    $res    = $db->query($select);
    $rw     = $db->row($res);
    $Tipo   = $rw['TipoListino'];
    if($Tipo == 0){
        $TipoListino = 'a camera';
    }else{
        $TipoListino = 'a persona';
    }

    $listino = $xcrud->nested_table('Gestione Prezzi','Id','hospitality_listino_camere','IdCamera');
    $listino->order_by('hospitality_listino_camere.IdSoggiorno', 'ASC');
    $listino->order_by('hospitality_listino_camere.PeriodoDal', 'ASC');
    $listino->order_by('hospitality_listino_camere.PeriodoAl', 'ASC');
    $listino->relation('IdNumeroListino','hospitality_numero_listini','Id','Listino',array('idsito'=>IDSITO,'Abilitato'=>1));
    $listino->relation('IdSoggiorno','hospitality_tipo_soggiorno','Id','TipoSoggiorno','idsito='.IDSITO);

    $listino->columns('IdNumeroListino,IdSoggiorno,PeriodoDal,PeriodoAl,PrezzoCamera');
    $listino->fields('IdNumeroListino,IdSoggiorno,PeriodoDal,PeriodoAl,PrezzoCamera');

    $listino->column_callback('PrezzoCamera','format_price');
    $listino->field_callback('PrezzoCamera','campo_prezzo');

    $listino->pass_var('idsito',IDSITO);

    $listino->label('IdNumeroListino', 'Listino');
    $listino->label('IdSoggiorno', 'Trattamento');
    $listino->label('PeriodoDal', 'Periodo Dal');
    $listino->label('PeriodoAl','Periodo Al');
    $listino->label('PrezzoCamera','Prezzo Camera');

    $listino->validation_required('IdNumeroListino');
    $listino->validation_required('IdSoggiorno');
    $listino->validation_required('PeriodoDal');
    $listino->validation_required('PeriodoAl');
    $listino->validation_required('PrezzoCamera');

    $listino->create_action('Attiva', 'abilita_listino'); // action callback, function publish_action() in functions.php
    $listino->create_action('Disattiva', 'disabilita_listino');
    $listino->button('#', 'Disabilita', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'Disattiva',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Abilitato',
            '=',
            '1')
    );
    $listino->button('#', 'Abilita', 'icon-checkmark glyphicon glyphicon-remove', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'Attiva',
        'data-primary' => '{Id}'), array(
        'Abilitato',
        '!=',
        '1'));

    $listino->button('javascript:;','Duplica','icon-checkmark glyphicon glyphicon-plus','',array('onclick' => 'duplicator(\''.BASE_URL_SITO.'duplica_listino/{Id}/{IdCamera}/\')','data-toogle'=>'tooltip'));

    $listino->unset_csv();
    $listino->unset_view();
    $listino->unset_print();
    $listino->table_name('Inserire il trattamento, il periodo ed il prezzo <small><small><i class="fa fa-exclamation-triangle text-orange"></i> ATTENZIONE: il listino di QUOTO può essere usato solo se non ci sono moduli di sincronizzazioni con booking engine o channel manager, abilitati!</small></small><br> <small>(i prezzi sono stati impostati <b class="text-red">'.$TipoListino.'</b>)</small>', 'Inserire il trattamento, il periodo ed il prezzo (i prezzi sono stati impostati '.$TipoListino.')','fa fa-comments');
    $listino->unset_numbers();
    $listino->unset_search();
    $listino->hide_button('save_new');


    $gallery_camera = $xcrud->nested_table('Gestione Fotogallery per Camera','id','hospitality_gallery_camera','IdCamera');
    $gallery_camera->pass_var('idsito',IDSITO);
    $gallery_camera->columns('Foto', false);
    $gallery_camera->fields('Foto', false);

    $gallery_camera->label('IdCamera','Camera');

    $gallery_camera->change_type('Foto', 'image', '', array('manual_crop' => true,'width' => 800,'ratio' => 2, 'path' => BASE_PATH_ROOT."uploads/".IDSITO.'/'));
    $gallery_camera->validation_required('Foto');
    $gallery_camera->unset_csv();
    $gallery_camera->unset_print();
    $gallery_camera->table_name('Inserire una galleria fotografica per questa camera!<br><div style="line-height:18px!important"><small><small><i class="fa fa-exclamation-triangle text-orange"></i> <b>Dimensione max consigliata: 97.66 MByte (1MB) e 32 DPI di risoluzione (Formato Web)!!</b> Per ottenere un aspetto uniforme salvare tutte le immagini della stessa dimensione. Al momento dell\'upload il software richiede il ridimensionamento dell\'immagine, adottate lo stesso criterio per tutte le foto!</small></small></div>');
    $gallery_camera->unset_numbers();
    $gallery_camera->unset_search();
    $gallery_camera->unset_pagination();
    $gallery_camera->unset_limitlist();
    $gallery_camera->hide_button('save_edit');
    $gallery_camera->hide_button('save_new');

    if(FORM_SUL_SITO==1){
        $xcrud->create_action('Attiva_form', 'abilita_camera_form'); // action callback, function publish_action() in functions.php
        $xcrud->create_action('Disattiva_form', 'disabilita_camera_form');
        $xcrud->button('#', 'Disabilita vista nel form del vs sito', 'icon-close glyphicon glyphicon-ok text-green', 'xcrud-action',
            array(  // set action vars to the button
                'data-task' => 'action',
                'data-action' => 'Disattiva_form',
                'data-primary' => '{Id}'),
            array(  // set condition ( when button must be shown)
                'Abilitato_form',
                '=',
                '1')
        );
        $xcrud->button('#', 'Abilita vista nel form del vs sito', 'icon-checkmark glyphicon glyphicon-remove text-red', 'xcrud-action', array(
            'data-task' => 'action',
            'data-action' => 'Attiva_form',
            'data-primary' => '{Id}'), array(
            'Abilitato_form',
            '!=',
            '1'));  
    }

    $xcrud->create_action('Attiva', 'abilita_camera'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_camera');
    $xcrud->button('#', 'Disabilita', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'Disattiva',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Abilitato',
            '=',
            '1')
    );
    $xcrud->button('#', 'Abilita', 'icon-checkmark glyphicon glyphicon-remove', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'Attiva',
        'data-primary' => '{Id}'), array(
        'Abilitato',
        '!=',
        '1'));

   //puslante per duplicare la camera
    $xcrud->button('javascript:;','Duplica','icon-checkmark glyphicon glyphicon-plus','',array('onclick' => 'duplicator(\''.BASE_URL_SITO.'duplica_camera/{Id}/\')','data-toogle'=>'tooltip'),array('RoomCode','=',''));
