<?php
    if(FORM_SUL_SITO==1){
        $FormMsg .='<h4 class="text-right"><i class="fa fa-exclamation-circle text-info"></i> <small>Per chi ha integrato nel proprio sito il <em>"form dedicato a QUOTO"</em> <b>API version</b>, potete utilizzare il flag di visibile/non visibile per la lista dei soggiorni!</small></h4>';
    }  
    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_tipo_soggiorno');
    $xcrud->where('hospitality_tipo_soggiorno.idsito', IDSITO);
    //$xcrud->order_by('TipoSoggiorno','ASC');
    $xcrud->order_by('Id','DESC');
    $xcrud->pass_var('idsito',IDSITO);
    $xcrud->pass_var('Lingua','it');

    $xcrud->validation_required('TipoSoggiorno',3);

    $xcrud->column_callback('Lingua','show_flags');

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

    $xcrud->label(array('TipoSoggiorno' => 'Soggiorno'));

     if(check_simplebooking(IDSITO)==1){
        $xcrud->columns('PlanCode');
        $xcrud->column_callback('PlanCode','flag_booking');
        $xcrud->column_tooltip('PlanCode', 'Codice Tipo Soggiorno di SimpleBooking ','fa fa-question text-red');
        $xcrud->label('PlanCode', 'PlanCode SB');
    }
    if(check_ericsoftbooking(IDSITO)==1){
        $xcrud->columns('PlanCode');
        $xcrud->column_callback('PlanCode','flag_ericsoftbooking');
        $xcrud->column_tooltip('PlanCode', 'Codice Tipo Soggiorno di EricsoftBooking ','fa fa-question text-red');
        $xcrud->label('PlanCode', 'PlanCode EB');
    }   
    if(check_bedzzlebooking(IDSITO)==1 && check_pms_bedzzle(IDSITO)==0){
        $xcrud->columns('PlanCode');
        $xcrud->column_callback('PlanCode','flag_bedzzlebooking');
        $xcrud->column_tooltip('PlanCode', 'Codice Tipo Soggiorno di Bedzzle Booking ','fa fa-question text-red');
        $xcrud->label('PlanCode', 'PlanCode BedzzleB');
    }elseif(check_bedzzlebooking(IDSITO)==1 && check_pms_bedzzle(IDSITO)==1){
        $xcrud->columns('PlanCode');
        $xcrud->column_callback('PlanCode','flag_pms_soggiorno_bedzzle');
        $xcrud->column_tooltip('PlanCode', 'Abbinamento tipologia di Soggiorno con il PMS ','');
        $xcrud->label('PlanCode', 'Tipo Soggiorno sul PMS');
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
    if($tipoP!='C'){
        $xcrud->columns('PlanTypePms');
        $xcrud->column_callback('PlanTypePms','flag_soggiorni_pms');
        $xcrud->column_tooltip('PlanTypePms', 'Abbinamento tipologia di Soggiorno con il PMS ','');
        $xcrud->label('PlanTypePms', 'Tipo Soggiorno sul PMS');
    }

    $parity = check_parity(IDSITO);

    if($parity != '0'){
        if(check_soggiorni_parity(IDSITO) == 0){
            $SyncroMsg = '<h4 class="text-right"><a href="'.BASE_URL_SITO.'get_config_parity/sync/" class="btn bg-green btn-xs" id="resynchBtn"><i class="fa fa-refresh"></i>  Synch ParityRate</a> <br><small>Sincronizza la prima volta le tipologie di soggiorono del Channel Manager Parity Rate!</small></h4>';
        }else{
            $SyncroMsg = '<h4 class="text-right"><a href="'.BASE_URL_SITO.'get_config_parity/sync/" class="btn bg-orange btn-xs" id="resynchBtn"><i class="fa fa-refresh"></i>  Re-Synch ParityRate</a> <br><small>Ri-sincronizza le tipologie di soggiorono del Channel Manager Parity Rate!</small></h4>';

        }
        $xcrud->columns('RateParityId');
        $xcrud->column_callback('RateParityId','flag_soggiorni_parity');
        $xcrud->column_tooltip('RateParityId', 'Abbinamento Soggiorno con ParityRate ','');
        $xcrud->label('RateParityId', 'Tipo Soggiorno su ParityRate');

    }
    $xcrud->columns('TipoSoggiorno, Testi presenti, Abilitato', false);

    $xcrud->label('Abilitato_form', 'Soggiorno visibile nel form del vs. sito');

    $xcrud->change_type('Abilitato_form','bool');

    $xcrud->fields('TipoSoggiorno,Abilitato', false);

    // disabilito il titolo - impostato da file tpl
    $xcrud->unset_title(true);
    $xcrud->column_callback('Lingua','show_flags');

         /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(lingue," ") SEPARATOR " ") AS lingue FROM hospitality_tipo_soggiorno_lingua WHERE soggiorni_id = {id}');
    $xcrud->column_callback('Testi presenti','show_flags');

    if(FORM_SUL_SITO==1){
        $xcrud->create_action('Attiva_form_s', 'abilita_soggiorno_form'); // action callback, function publish_action() in functions.php
        $xcrud->create_action('Disattiva_form_s', 'disabilita_soggiorno_form');
        $xcrud->button('#', 'Disabilita vista nel form del vs sito', 'icon-close glyphicon glyphicon-ok text-green', 'xcrud-action',
            array(  // set action vars to the button
                'data-task' => 'action',
                'data-action' => 'Disattiva_form_s',
                'data-primary' => '{Id}'),
            array(  // set condition ( when button must be shown)
                'Abilitato_form',
                '=',
                '1')
        );
        $xcrud->button('#', 'Abilita vista nel form del vs sito', 'icon-checkmark glyphicon glyphicon-remove text-red', 'xcrud-action', array(
            'data-task' => 'action',
            'data-action' => 'Attiva_form_s',
            'data-primary' => '{Id}'), array(
            'Abilitato_form',
            '!=',
            '1'));  
    }

    $xcrud->create_action('Attiva', 'abilita_soggiorno'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_soggiorno');
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


    $xcrud->unset_title(true);
    //puslante per duplicare
    $xcrud->button('javascript:;','Duplica','icon-checkmark glyphicon glyphicon-plus','',array('data-toogle' => 'tooltip','onclick' => 'duplicator(\''.BASE_URL_SITO.'duplica_soggiorno/{Id}/\')'),array('PlanCode','=',''));
    if(IS_NETWORK_SERVICE_USER==0){
        //$xcrud->unset_remove(true,'PlanCode','!=','');
        $xcrud->unset_remove();
   }
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers();
    $xcrud->hide_button('save_new');

    /* GESTIONE TABELLA TESTI */
    $servizi_testo = $xcrud->nested_table('Gestione testi in lingua','id','hospitality_tipo_soggiorno_lingua','soggiorni_id');
    $servizi_testo->columns('lingue,Soggiorno,Descrizione');
    $servizi_testo->fields('lingue,Soggiorno,Descrizione');
    $servizi_testo->column_callback('lingue','show_flags');
    $servizi_testo->field_callback('Descrizione','textarea_doc');
    $servizi_testo->relation('lingue','hospitality_lingue','Sigla','Sigla','idsito='.IDSITO);
    $servizi_testo->language('it');
    $servizi_testo->pass_var('idsito',IDSITO);

    $servizi_testo->validation_required('lingue');
    $servizi_testo->validation_required('Soggiorno',3);

    $servizi_testo->unset_remove(true,'PlanCode','!=','');
    $servizi_testo->unset_csv();
    $servizi_testo->unset_print();
    $servizi_testo->unset_title();
    $servizi_testo->unset_numbers();
    $servizi_testo->hide_button('save_new');

    $listino = $xcrud->nested_table('Gestione Prezzi','Id','hospitality_listino_soggiorni','IdSoggiorno');
    $listino->order_by('hospitality_listino_soggiorni.IdSoggiorno', 'ASC');
    $listino->order_by('hospitality_listino_soggiorni.PeriodoDal', 'ASC');
    $listino->order_by('hospitality_listino_soggiorni.PeriodoAl', 'ASC');
    $listino->relation('IdSoggiorno','hospitality_tipo_soggiorno','Id','TipoSoggiorno','idsito='.IDSITO);

    $listino->columns('IdSoggiorno,PeriodoDal,PeriodoAl,Prezzo');
    $listino->fields('PeriodoDal,PeriodoAl,Prezzo');

    $listino->column_callback('Prezzo','format_price');
    $listino->field_callback('Prezzo','campo_prezzo');

    $listino->pass_var('idsito',IDSITO);


    $listino->label('IdSoggiorno', 'Trattamento');
    $listino->label('PeriodoDal', 'Periodo Dal');
    $listino->label('PeriodoAl','Periodo Al');
    $listino->set_attr('PeriodoDal', array('autocomplete'=>'new_pasword'));
    $listino->set_attr('PeriodoAl', array('autocomplete'=>'new_pasword'));
    $listino->label('Prezzo','Prezzo Soggiorno');

    $listino->field_tooltip('Prezzo','Il Prezzo del tipo di Soggiorno andrà ad aggiungersi al prezzo della camera');

    $listino->validation_required('IdSoggiorno');
    $listino->validation_required('PeriodoDal');
    $listino->validation_required('PeriodoAl');
    $listino->validation_required('Prezzo');

    $listino->create_action('Attiva', 'abilita_listino_sog'); // action callback, function publish_action() in functions.php
    $listino->create_action('Disattiva', 'disabilita_listino_spg');
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

    $listino->button('javascript:;','Duplica','icon-checkmark glyphicon glyphicon-plus','',array('onclick' => 'duplicator(\''.BASE_URL_SITO.'duplica_listino_soggiorno/{Id}/{IdSoggiorno}/\')','data-toogle'=>'tooltip'));

    $listino->unset_csv();
    $listino->unset_view();
    $listino->unset_print();
    $listino->table_name('Imposta il periodo ed il prezzo','fa fa-comments');
    $listino->unset_numbers();
    $listino->unset_search();
    $listino->hide_button('save_new');

    if($_REQUEST['azione'] == 'ok') {
        $msg .= '<div class="alert alert-success" id="res_back">
                        <i class="fa fa-check"></i> Syncro avvenuta con successo.
                    </div>';
        $msg .= '<script>
                    $(document).ready(function() {
                            setTimeout(function(){
                                $(\'#res_back\').hide();
                            },3000);
                    });
                </script> '."\r\n";
    }
