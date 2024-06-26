<?php
    $sel = "SELECT * FROM hospitality_tipo_servizi WHERE idsito = ".IDSITO." AND CalcoloPrezzo = 'A Percentuale' AND Abilitato = 1";
    $res = $db->query($sel);
    $check_calc = $db->result($res);
    if(sizeof($check_calc) >= 1){
        $valore_tipo_config = 0;
        $etichetta_explane_percentuale = '  <div class="alert alert-profila  alert-default-profila alert-dismissable text-black">
                                                <i class="fa fa-exclamation-triangle text-orange"></i> <b>Importante!</b><br/>
                                                Se avete inserito nella lista uno o più servizi aggiuntivi  
                                                <b>"A Percentuale"</b>  è sconsigliato abilitare la gestione lato client (landing page)!
                                                <br/> 
                                                In alternativa se volete abilitare la gestione lato client, ricordatevi di non selezionare il servizio <b>"A percentuale"</b> durante la creazione della proposta di soggiorno!
                                                <br/> 
                                                Questo perchè se il servizio è pre-selezionato da voi, il calcolo della percentuale avverrà sempre e solo sull\'importo del soggiorno 
                                                da voi proposto e non sul totale modificato dal cliente finale che può aggiungere o meno nuovi servizi!
                                            </div>';
    }else{
        $valore_tipo_config = 1;
    }

    $select    = "SELECT * FROM hospitality_tipo_servizi_config WHERE idsito = ".IDSITO;
    $result    = $db->query($select);
    $check_rec = $db->result($result);
    if(sizeof($check_rec) == 0){
        $insert= "INSERT INTO hospitality_tipo_servizi_config (idsito,AbilitatoLatoLandingPage) VALUES ('".IDSITO."','".$valore_tipo_config."')";
        $db->query($insert);
    } 

    $xcrud_conf = Xcrud::get_instance();
    $xcrud_conf->table('hospitality_tipo_servizi_config');
    $xcrud_conf->where('hospitality_tipo_servizi_config.idsito', IDSITO);

    $xcrud_conf->order_by('Id','DESC');

    $xcrud_conf->pass_var('idsito',IDSITO);

    $xcrud_conf->change_type('AbilitatoLatoLandingPage','bool');
    $xcrud_conf->columns('AbilitatoLatoLandingPage', false); // colonne non visibili
    $xcrud_conf->fields('AbilitatoLatoLandingPage', false); // colonne non visibili
    $xcrud_conf->label('AbilitatoLatoLandingPage', 'Abilita o disabilita');
    $xcrud_conf->field_tooltip('AbilitatoLatoLandingPage', 'Se si abilitano i Servizi Aggiuntivi lato Landing Page, l \'utente finale (cliente) avrà la possibilità di aggiungere e/o modifcare i servizi in autonomia');
    $xcrud_conf->column_tooltip('AbilitatoLatoLandingPage', 'Abilita oppure disabilita la gestione dei SERVIZI AGGIUNTIVI lato landing page (cliente)','fa fa-question-circle text-white');

    $xcrud_conf->unset_title(true);
    $xcrud_conf->unset_add();
    $xcrud_conf->unset_view();
    $xcrud_conf->unset_remove();
    $xcrud_conf->unset_print();
    $xcrud_conf->unset_csv();
    $xcrud_conf->unset_numbers(); 
    $xcrud_conf->unset_limitlist();
    $xcrud_conf->unset_pagination();
    $xcrud_conf->unset_search();
    $xcrud_conf->hide_button('save_new'); 
    $xcrud_conf->hide_button('save_edit'); 



    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_tipo_servizi');
    $xcrud->where('hospitality_tipo_servizi.idsito', IDSITO);
    //$xcrud->order_by('TipoSoggiorno','ASC');
    $xcrud->order_by('TipoServizio','ASC');
    $xcrud->pass_var('idsito',IDSITO);
    $xcrud->pass_var('Lingua','it');
    $xcrud->pass_var('Abilitato',1);

    $xcrud->validation_required('TipoServizio',3);

    $xcrud->create_action('Attiva', 'abilita_servizio'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_servizio');
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

    $xcrud->create_action('Obbligatorio', 'abilita_servizio_obbligatorio'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('NoObbligatorio', 'disabilita_servizio_obbligatorio');
    $xcrud->button('#', 'Campo NON Obbligatorio', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'NoObbligatorio',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Obbligatorio',
            '=',
            '1')
    );
    $xcrud->button('#', 'Campo Obbligatorio', 'icon-checkmark glyphicon glyphicon-remove', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'Obbligatorio',
        'data-primary' => '{Id}'), array(
        'Obbligatorio',
        '!=',
        '1'));   
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
    $xcrud->change_type('Obbligatorio','bool');
    $xcrud->change_type('Icona', 'image', '', array('manual_crop' => true,'ratio' => 1, 'path' => BASE_PATH_ROOT."uploads/".IDSITO.'/'));

    $xcrud->label(array('TipoServizio' => 'Servizio','PrezzoServizio' => 'Prezzo Servizio','PercentualeServizio' => 'Percentuale Servizio','CalcoloPrezzo' => 'Calcolo del Prezzo','Obbligatorio' => 'Incluso'));
 
    $xcrud->columns('Icona,TipoServizio, Testi presenti, PrezzoServizio,PercentualeServizio,CalcoloPrezzo,Abilitato,Obbligatorio', false);
    $xcrud->fields('Icona,TipoServizio,PrezzoServizio,PercentualeServizio,CalcoloPrezzo', false);

    $xcrud->column_callback('PrezzoServizio','format_price_sevizi');
    $xcrud->column_callback('PercentualeServizio','format_percentuale_sevizi');
    $xcrud->field_callback('PrezzoServizio','campo_prezzo');
    $xcrud->field_callback('PercentualeServizio','percentuale_prezzo');
    
    // disabilito il titolo - impostato da file tpl
    $xcrud->unset_title(true);
    $xcrud->column_callback('Lingua','show_flags');
    
         /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(lingue," ") SEPARATOR " ") AS lingue FROM hospitality_tipo_servizi_lingua WHERE servizio_id = {id}');
    $xcrud->column_callback('Testi presenti','show_flags');

    $xcrud->unset_title(true);
    //puslante per duplicare
    $xcrud->button('javascript:;','Duplica','icon-checkmark glyphicon glyphicon-plus','',array('onclick' => 'duplicator(\''.BASE_URL_SITO.'duplica_servizio_aggiuntivo/{Id}/\')'));
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->hide_button('save_new'); 

    if(check_numero_servizi(IDSITO) >= NUMERO_SERVIZI) {   
        $xcrud->unset_add();
    }
    
    /* GESTIONE TABELLA TESTI */
    $servizi_testo = $xcrud->nested_table('Gestione testi in lingua','id','hospitality_tipo_servizi_lingua','servizio_id');
    $servizi_testo->columns('lingue,Servizio,Descrizione');
    $servizi_testo->fields('lingue,Servizio,Descrizione');
    $servizi_testo->column_callback('lingue','show_flags');
    $servizi_testo->field_callback('Descrizione','textarea_doc');
    $servizi_testo->relation('lingue','hospitality_lingue','Sigla','Sigla','idsito='.IDSITO);
    $servizi_testo->language('it');
    $servizi_testo->pass_var('idsito',IDSITO); 

    $servizi_testo->validation_required('lingue');
    $servizi_testo->validation_required('Servizio',3);

    $servizi_testo->unset_csv();
    $servizi_testo->unset_print();
    $servizi_testo->unset_title();
    $servizi_testo->unset_numbers(); 
    $servizi_testo->hide_button('save_new'); 