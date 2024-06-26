<?php

    $xcrud->table('hospitality_contenuti_email');
    $xcrud->where('hospitality_contenuti_email.idsito', IDSITO);
    $xcrud->where('hospitality_contenuti_email.TipoRichiesta', 'Preventivo');
    $xcrud->order_by('TipoRichiesta','DESC');
    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $xcrud->change_type('Lingua','select','',implode(',',$val));      
    }
    $xcrud->change_type('TipoRichiesta','select','','Preventivo,Conferma');
    $xcrud->change_type('Abilitato','bool');

    $xcrud->columns('Lingua,TipoRichiesta,Oggetto,Messaggio,Abilitato');
    $xcrud->column_callback('Lingua','show_flags');
    
    $xcrud->fields('Lingua,TipoRichiesta,Oggetto,Messaggio,Abilitato');
    $xcrud->field_callback('Messaggio','messaggio_email');
    $xcrud->field_callback('Oggetto','custom_oggetto_preventivo');
    $xcrud->pass_var('idsito',IDSITO);

    $xcrud->set_attr('Oggetto',array('placeholder' => 'Inserire un Oggetto .....'));

    //$xcrud->validation_required('Lingua',1);
    $xcrud->disabled('Lingua');
    $xcrud->disabled('TipoRichiesta');


    $xcrud->validation_required('TipoRichiesta',3);
    $xcrud->validation_required('Oggetto',3);
    $xcrud->validation_required('Messaggio',3);

    $xcrud->create_action('Attiva', 'abilita_email'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_email');
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

    $xcrud->table_name('<small>Contenuti email: di Preventivo!</small>');
    $xcrud->unset_add();

    //if(IS_NETWORK_SERVICE_USER == 0){
           $xcrud->unset_remove(); 
    //}


    $xcrud->unset_view();
    $xcrud->unset_search();
    $xcrud->unset_pagination();
    $xcrud->unset_limitlist();
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->hide_button('save_new');   


    $xcrud_conferma = Xcrud::get_instance();
    $xcrud_conferma->table('hospitality_contenuti_email');
    $xcrud_conferma->where('hospitality_contenuti_email.idsito', IDSITO);
    $xcrud_conferma->where('hospitality_contenuti_email.TipoRichiesta', 'Conferma');
    $xcrud_conferma->order_by('TipoRichiesta','DESC');
    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $xcrud_conferma->change_type('Lingua','select','',implode(',',$val));      
    }
    $xcrud_conferma->change_type('TipoRichiesta','select','','Preventivo,Conferma');
    $xcrud_conferma->change_type('Abilitato','bool');

    $xcrud_conferma->columns('Lingua,TipoRichiesta,Oggetto,Messaggio,Abilitato');
    $xcrud_conferma->column_callback('Lingua','show_flags');
    
    $xcrud_conferma->fields('Lingua,TipoRichiesta,Oggetto,Messaggio,Abilitato');
    $xcrud_conferma->field_callback('Messaggio','messaggio_email');
    $xcrud_conferma->field_callback('Oggetto','custom_oggetto_conferma');
    $xcrud_conferma->pass_var('idsito',IDSITO);

    $xcrud_conferma->set_attr('Oggetto',array('placeholder' => 'Inserire un Oggetto .....'));

    //$xcrud_conferma->validation_required('Lingua',1);
    $xcrud_conferma->disabled('Lingua');
    $xcrud_conferma->disabled('TipoRichiesta');


    $xcrud_conferma->validation_required('TipoRichiesta',3);
    $xcrud_conferma->validation_required('Oggetto',3);
    $xcrud_conferma->validation_required('Messaggio',3);

    $xcrud_conferma->create_action('Attiva', 'abilita_email'); // action callback, function publish_action() in functions.php
    $xcrud_conferma->create_action('Disattiva', 'disabilita_email');
    $xcrud_conferma->button('#', 'Disabilita', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'Disattiva',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Abilitato',
            '=',
            '1')
    );
    $xcrud_conferma->button('#', 'Abilita', 'icon-checkmark glyphicon glyphicon-remove', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'Attiva',
        'data-primary' => '{Id}'), array(
        'Abilitato',
        '!=',
        '1')); 

    $xcrud_conferma->table_name('<small>Contenuti email: di Conferma!</small>');
    $xcrud_conferma->unset_add();

    //if(IS_NETWORK_SERVICE_USER == 0){
           $xcrud_conferma->unset_remove(); 
    //}

    $xcrud_conferma->unset_view();
    $xcrud_conferma->unset_search();
    $xcrud_conferma->unset_pagination();
    $xcrud_conferma->unset_limitlist();
    $xcrud_conferma->unset_print();
    $xcrud_conferma->unset_csv();
    $xcrud_conferma->unset_numbers(); 
    $xcrud_conferma->hide_button('save_new');   


    $xcrud_chat = Xcrud::get_instance();
    $xcrud_chat->table('hospitality_dizionario');
    $xcrud_chat->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_chat->where('hospitality_dizionario.etichetta = "TESTOMAIL_RE_CHAT" OR hospitality_dizionario.etichetta = "OGGETTO_RE_CHAT"');

    $xcrud_chat->pass_var('idsito',IDSITO);

    $xcrud_chat->columns('etichetta,Testi presenti');
    $xcrud_chat->fields('etichetta');

    $xcrud_chat->column_callback('etichetta','change_value');
    $xcrud_chat->field_callback('etichetta','change_value');

    $xcrud_chat->label('etichetta','Variabile');
    $xcrud_chat->disabled('etichetta');

    $xcrud_chat->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_chat->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_chat->column_callback('Testi presenti','show_flags');

    $xcrud_chat->table_name('<small>Contenuti email: avviso risposta in chat!</small>');
    $xcrud_chat->unset_add();
    $xcrud_chat->unset_remove();
    $xcrud_chat->unset_view();
    $xcrud_chat->unset_search();
    $xcrud_chat->unset_pagination();
    $xcrud_chat->unset_limitlist();
    $xcrud_chat->unset_print();
    $xcrud_chat->unset_csv();
    $xcrud_chat->unset_numbers(); 
    $xcrud_chat->hide_button('save_new'); 
    $xcrud_chat->hide_button('save_edit'); 
    $xcrud_chat->hide_button('save_return'); 
    $xcrud_chat->hide_button('save_new');


    /* GESTIONE TABELLA TESTI */
    $diz_lang = $xcrud_chat->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $diz_lang->change_type('Lingua','select','',implode(',',$val));      
    }
    $diz_lang->pass_var('idsito',IDSITO);
    $diz_lang->columns('Lingua,testo');
    $diz_lang->fields('Lingua,testo');
    $diz_lang->label('testo','Traduzione');

    $diz_lang->column_callback('Lingua','show_flags');
    $diz_lang->field_callback('testo','textarea_input_custom_custom');
    

    $diz_lang->disabled('Lingua');
    $diz_lang->validation_required('testo',2);

    $diz_lang->unset_csv();
    $diz_lang->unset_print();
    $diz_lang->unset_title();
    $diz_lang->unset_add();
    $diz_lang->unset_view();
    $diz_lang->unset_remove();
    $diz_lang->unset_search();
    $diz_lang->unset_pagination();
    $diz_lang->unset_limitlist();
    $diz_lang->unset_print();
    $diz_lang->unset_csv();
    $diz_lang->unset_numbers();  
    $diz_lang->hide_button('save_new');   


    $xcrud_vaucher = Xcrud::get_instance();
    $xcrud_vaucher->table('hospitality_dizionario');
    $xcrud_vaucher->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_vaucher->where('hospitality_dizionario.etichetta = "TESTOMAIL_VAUCHER" OR hospitality_dizionario.etichetta = "OGGETTO_VAUCHER"');

    $xcrud_vaucher->pass_var('idsito',IDSITO);

    $xcrud_vaucher->columns('etichetta,Testi presenti');
    $xcrud_vaucher->fields('etichetta');

    $xcrud_vaucher->column_callback('etichetta','change_vaucher');
    $xcrud_vaucher->field_callback('etichetta','change_vaucher');

    $xcrud_vaucher->label('etichetta','Variabile');
    $xcrud_vaucher->disabled('etichetta');

    $xcrud_vaucher->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_vaucher->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_vaucher->column_callback('Testi presenti','show_flags');

    $xcrud_vaucher->table_name('<small>Contenuti email: avviso conferma prenotazione ed invito a stampare il voucher!</small>');
    $xcrud_vaucher->unset_add();
    $xcrud_vaucher->unset_remove();
    $xcrud_vaucher->unset_view();
    $xcrud_vaucher->unset_search();
    $xcrud_vaucher->unset_pagination();
    $xcrud_vaucher->unset_limitlist();
    $xcrud_vaucher->unset_print();
    $xcrud_vaucher->unset_csv();
    $xcrud_vaucher->unset_numbers(); 
    $xcrud_vaucher->hide_button('save_new'); 
    $xcrud_vaucher->hide_button('save_edit'); 
    $xcrud_vaucher->hide_button('save_return'); 
    $xcrud_vaucher->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $diz_langV = $xcrud_vaucher->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $diz_langV->change_type('Lingua','select','',implode(',',$val));      
    }
    $diz_langV->pass_var('idsito',IDSITO);
    $diz_langV->columns('Lingua,testo');
    $diz_langV->fields('Lingua,testo');
    $diz_langV->label('testo','Traduzione');

    $diz_langV->column_callback('Lingua','show_flags');
    $diz_langV->field_callback('testo','textarea_input_custom');
    $diz_langV->set_attr('testo',array('style'=>'height:100px'));
    $diz_langV->disabled('Lingua');
    $diz_langV->validation_required('testo',2);

    $diz_langV->unset_csv();
    $diz_langV->unset_print();
    $diz_langV->unset_title();
    $diz_langV->unset_add();
    $diz_langV->unset_view();
    $diz_langV->unset_remove();
    $diz_langV->unset_search();
    $diz_langV->unset_pagination();
    $diz_langV->unset_limitlist();
    $diz_langV->unset_print();
    $diz_langV->unset_csv();
    $diz_langV->unset_numbers();  
    $diz_langV->hide_button('save_new');   


    $xcrud_questionario = Xcrud::get_instance();
    $xcrud_questionario->table('hospitality_dizionario');
    $xcrud_questionario->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_questionario->where('hospitality_dizionario.etichetta = "TESTOMAIL" OR hospitality_dizionario.etichetta = "OGGETTO"');

    $xcrud_questionario->pass_var('idsito',IDSITO);

    $xcrud_questionario->columns('etichetta,Testi presenti');
    $xcrud_questionario->fields('etichetta');

    $xcrud_questionario->column_callback('etichetta','change_value');
    $xcrud_questionario->field_callback('etichetta','change_value');

    $xcrud_questionario->label('etichetta','Variabile');
    $xcrud_questionario->disabled('etichetta');

    $xcrud_questionario->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_questionario->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_questionario->column_callback('Testi presenti','show_flags');

    $xcrud_questionario->table_name('<small>Contenuti email: richiesta di una opinione sui servizi relativi al hotel (Questionario)!</small>');
    $xcrud_questionario->unset_add();
    $xcrud_questionario->unset_remove();
    $xcrud_questionario->unset_view();
    $xcrud_questionario->unset_search();
    $xcrud_questionario->unset_pagination();
    $xcrud_questionario->unset_limitlist();
    $xcrud_questionario->unset_print();
    $xcrud_questionario->unset_csv();
    $xcrud_questionario->unset_numbers(); 
    $xcrud_questionario->hide_button('save_new'); 
    $xcrud_questionario->hide_button('save_edit'); 
    $xcrud_questionario->hide_button('save_return'); 
    $xcrud_questionario->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $diz_langQ = $xcrud_questionario->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $diz_langQ->change_type('Lingua','select','',implode(',',$val));      
    }
    $diz_langQ->pass_var('idsito',IDSITO);
    $diz_langQ->columns('Lingua,testo');
    $diz_langQ->fields('Lingua,testo');
    $diz_langQ->label('testo','Traduzione');

    $diz_langQ->column_callback('Lingua','show_flags');
    $diz_langQ->field_callback('testo','textarea_input_custom');
    $diz_langQ->set_attr('testo',array('style'=>'height:100px'));
    $diz_langQ->disabled('Lingua');
    $diz_langQ->validation_required('testo',2);

    $diz_langQ->unset_csv();
    $diz_langQ->unset_print();
    $diz_langQ->unset_title();
    $diz_langQ->unset_add();
    $diz_langQ->unset_view();
    $diz_langQ->unset_remove();
    $diz_langQ->unset_search();
    $diz_langQ->unset_pagination();
    $diz_langQ->unset_limitlist();
    $diz_langQ->unset_print();
    $diz_langQ->unset_csv();
    $diz_langQ->unset_numbers();  
    $diz_langQ->hide_button('save_new');   




    $xcrud_disdetta = Xcrud::get_instance();
    $xcrud_disdetta->table('hospitality_dizionario');
    $xcrud_disdetta->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_disdetta->where('hospitality_dizionario.etichetta = "TESTOMAIL_DISDETTA" OR hospitality_dizionario.etichetta = "OGGETTO_DISDETTA"');

    $xcrud_disdetta->pass_var('idsito',IDSITO);

    $xcrud_disdetta->columns('etichetta,Testi presenti');
    $xcrud_disdetta->fields('etichetta');

    $xcrud_disdetta->column_callback('etichetta','change_value');
    $xcrud_disdetta->field_callback('etichetta','change_value');

    $xcrud_disdetta->label('etichetta','Variabile');
    $xcrud_disdetta->disabled('etichetta');

    $xcrud_disdetta->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_disdetta->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_disdetta->column_callback('Testi presenti','show_flags');

    $xcrud_disdetta->table_name('<small>Contenuti email: avviso al cliente della disdetta della sua prenotazione (Disdetta)!</small>');
    $xcrud_disdetta->unset_add();
    $xcrud_disdetta->unset_remove();
    $xcrud_disdetta->unset_view();
    $xcrud_disdetta->unset_search();
    $xcrud_disdetta->unset_pagination();
    $xcrud_disdetta->unset_limitlist();
    $xcrud_disdetta->unset_print();
    $xcrud_disdetta->unset_csv();
    $xcrud_disdetta->unset_numbers(); 
    $xcrud_disdetta->hide_button('save_new'); 
    $xcrud_disdetta->hide_button('save_edit'); 
    $xcrud_disdetta->hide_button('save_return'); 
    $xcrud_disdetta->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $diz_langD = $xcrud_disdetta->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $diz_langD->change_type('Lingua','select','',implode(',',$val));      
    }
    $diz_langD->pass_var('idsito',IDSITO);
    $diz_langD->columns('Lingua,testo');
    $diz_langD->fields('Lingua,testo');
    $diz_langD->label('testo','Traduzione');

    $diz_langD->column_callback('Lingua','show_flags');
    $diz_langD->field_callback('testo','textarea_input_custom');
    $diz_langD->set_attr('testo',array('style'=>'height:100px'));
    $diz_langD->disabled('Lingua');
    $diz_langD->validation_required('testo',2);

    $diz_langD->unset_csv();
    $diz_langD->unset_print();
    $diz_langD->unset_title();
    $diz_langD->unset_add();
    $diz_langD->unset_view();
    $diz_langD->unset_remove();
    $diz_langD->unset_search();
    $diz_langD->unset_pagination();
    $diz_langD->unset_limitlist();
    $diz_langD->unset_print();
    $diz_langD->unset_csv();
    $diz_langD->unset_numbers();  
    $diz_langD->hide_button('save_new');   



    $xcrud_checkin = Xcrud::get_instance();
    $xcrud_checkin->table('hospitality_dizionario');
    $xcrud_checkin->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_checkin->where('hospitality_dizionario.etichetta = "TESTOMAIL_CHECKIN" OR hospitality_dizionario.etichetta = "OGGETTO_CHECKIN"');

    $xcrud_checkin->pass_var('idsito',IDSITO);

    $xcrud_checkin->columns('etichetta,Testi presenti');
    $xcrud_checkin->fields('etichetta');

    $xcrud_checkin->column_callback('etichetta','change_value');
    $xcrud_checkin->field_callback('etichetta','change_value');

    $xcrud_checkin->label('etichetta','Variabile');
    $xcrud_checkin->disabled('etichetta');

    $xcrud_checkin->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_checkin->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_checkin->column_callback('Testi presenti','show_flags');

    $xcrud_checkin->table_name('<small>Contenuti email: per il Check-In OnLine!!</small>');
    $xcrud_checkin->unset_add();
    $xcrud_checkin->unset_remove();
    $xcrud_checkin->unset_view();
    $xcrud_checkin->unset_search();
    $xcrud_checkin->unset_pagination();
    $xcrud_checkin->unset_limitlist();
    $xcrud_checkin->unset_print();
    $xcrud_checkin->unset_csv();
    $xcrud_checkin->unset_numbers(); 
    $xcrud_checkin->hide_button('save_new'); 
    $xcrud_checkin->hide_button('save_edit'); 
    $xcrud_checkin->hide_button('save_return'); 
    $xcrud_checkin->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $diz_langCK = $xcrud_checkin->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $diz_langCK->change_type('Lingua','select','',implode(',',$val));      
    }
    $diz_langCK->pass_var('idsito',IDSITO);
    $diz_langCK->columns('Lingua,testo');
    $diz_langCK->fields('Lingua,testo');
    $diz_langCK->label('testo','Traduzione');

    $diz_langCK->column_callback('Lingua','show_flags');
    $diz_langCK->field_callback('testo','textarea_input_custom');
    $diz_langCK->set_attr('testo',array('style'=>'height:100px'));
    $diz_langCK->disabled('Lingua');
    $diz_langCK->validation_required('testo',2);

    $diz_langCK->unset_csv();
    $diz_langCK->unset_print();
    $diz_langCK->unset_title();
    $diz_langCK->unset_add();
    $diz_langCK->unset_view();
    $diz_langCK->unset_remove();
    $diz_langCK->unset_search();
    $diz_langCK->unset_pagination();
    $diz_langCK->unset_limitlist();
    $diz_langCK->unset_print();
    $diz_langCK->unset_csv();
    $diz_langCK->unset_numbers();  
    $diz_langCK->hide_button('save_new');   


    $xcrud_disponibilita = Xcrud::get_instance();
    $xcrud_disponibilita->table('hospitality_dizionario');
    $xcrud_disponibilita->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_disponibilita->where('hospitality_dizionario.etichetta = "TESTOMAIL_DISPONIBILITA" OR hospitality_dizionario.etichetta = "OGGETTO_DISPONIBILITA"');

    $xcrud_disponibilita->pass_var('idsito',IDSITO);

    $xcrud_disponibilita->columns('etichetta,Testi presenti');
    $xcrud_disponibilita->fields('etichetta');

    $xcrud_disponibilita->column_callback('etichetta','change_value');
    $xcrud_disponibilita->field_callback('etichetta','change_value');

    $xcrud_disponibilita->label('etichetta','Variabile');
    $xcrud_disponibilita->disabled('etichetta');

    $xcrud_disponibilita->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_disponibilita->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_disponibilita->column_callback('Testi presenti','show_flags');

    $xcrud_disponibilita->table_name('<small>Contenuti email: avviso al cliente di assenza disponibilità per la sua richiesta di soggiorno (preventivo)!</small>');
    $xcrud_disponibilita->unset_add();
    $xcrud_disponibilita->unset_remove();
    $xcrud_disponibilita->unset_view();
    $xcrud_disponibilita->unset_search();
    $xcrud_disponibilita->unset_pagination();
    $xcrud_disponibilita->unset_limitlist();
    $xcrud_disponibilita->unset_print();
    $xcrud_disponibilita->unset_csv();
    $xcrud_disponibilita->unset_numbers(); 
    $xcrud_disponibilita->hide_button('save_new'); 
    $xcrud_disponibilita->hide_button('save_edit'); 
    $xcrud_disponibilita->hide_button('save_return'); 
    $xcrud_disponibilita->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $diz_langDispo = $xcrud_disponibilita->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $diz_langDispo->change_type('Lingua','select','',implode(',',$val));      
    }
    $diz_langDispo->pass_var('idsito',IDSITO);
    $diz_langDispo->columns('Lingua,testo');
    $diz_langDispo->fields('Lingua,testo');
    $diz_langDispo->label('testo','Traduzione');

    $diz_langDispo->column_callback('Lingua','show_flags');
    $diz_langDispo->field_callback('testo','textarea_input_custom');
    $diz_langDispo->set_attr('testo',array('style'=>'height:100px'));
    $diz_langDispo->disabled('Lingua');
    $diz_langDispo->validation_required('testo',2);

    $diz_langDispo->unset_csv();
    $diz_langDispo->unset_print();
    $diz_langDispo->unset_title();
    $diz_langDispo->unset_add();
    $diz_langDispo->unset_view();
    $diz_langDispo->unset_remove();
    $diz_langDispo->unset_search();
    $diz_langDispo->unset_pagination();
    $diz_langDispo->unset_limitlist();
    $diz_langDispo->unset_print();
    $diz_langDispo->unset_csv();
    $diz_langDispo->unset_numbers();  
    $diz_langDispo->hide_button('save_new'); 



    $xcrud_annulla = Xcrud::get_instance();
    $xcrud_annulla->table('hospitality_dizionario');
    $xcrud_annulla->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_annulla->where('hospitality_dizionario.etichetta = "TESTOMAIL_ANNULLA_CONFERMA_NODISPO" OR hospitality_dizionario.etichetta = "TESTOMAIL_ANNULLA_CONFERMA_RINUNCIA" OR hospitality_dizionario.etichetta = "TESTOMAIL_ANNULLA_CONFERMA_ALTRO"');

    $xcrud_annulla->pass_var('idsito',IDSITO);

    $xcrud_annulla->columns('etichetta,Testi presenti');
    $xcrud_annulla->fields('etichetta');

    $xcrud_annulla->column_callback('etichetta','change_value');
    $xcrud_annulla->field_callback('etichetta','change_value');

    $xcrud_annulla->label('etichetta','Variabile');
    $xcrud_annulla->disabled('etichetta');

    $xcrud_annulla->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_annulla->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_annulla->column_callback('Testi presenti','show_flags');

    $xcrud_annulla->table_name('<small>Contenuti email: avviso al cliente di conferma annullata (conferme)!</small>');
    $xcrud_annulla->unset_add();
    $xcrud_annulla->unset_remove();
    $xcrud_annulla->unset_view();
    $xcrud_annulla->unset_search();
    $xcrud_annulla->unset_pagination();
    $xcrud_annulla->unset_limitlist();
    $xcrud_annulla->unset_print();
    $xcrud_annulla->unset_csv();
    $xcrud_annulla->unset_numbers(); 
    $xcrud_annulla->hide_button('save_new'); 
    $xcrud_annulla->hide_button('save_edit'); 
    $xcrud_annulla->hide_button('save_return'); 
    $xcrud_annulla->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $diz_langAnnulla = $xcrud_annulla->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $diz_langAnnulla->change_type('Lingua','select','',implode(',',$val));      
    }
    $diz_langAnnulla->pass_var('idsito',IDSITO);
    $diz_langAnnulla->columns('Lingua,testo');
    $diz_langAnnulla->fields('Lingua,testo');
    $diz_langAnnulla->label('testo','Traduzione');

    $diz_langAnnulla->column_callback('Lingua','show_flags');
    $diz_langAnnulla->field_callback('testo','textarea_input_custom');
    $diz_langAnnulla->set_attr('testo',array('style'=>'height:100px'));
    $diz_langAnnulla->disabled('Lingua');
    $diz_langAnnulla->validation_required('testo',2);

    $diz_langAnnulla->unset_csv();
    $diz_langAnnulla->unset_print();
    $diz_langAnnulla->unset_title();
    $diz_langAnnulla->unset_add();
    $diz_langAnnulla->unset_view();
    $diz_langAnnulla->unset_remove();
    $diz_langAnnulla->unset_search();
    $diz_langAnnulla->unset_pagination();
    $diz_langAnnulla->unset_limitlist();
    $diz_langAnnulla->unset_print();
    $diz_langAnnulla->unset_csv();
    $diz_langAnnulla->unset_numbers();  
    $diz_langAnnulla->hide_button('save_new'); 



    $xcrud_annulla_p = Xcrud::get_instance();
    $xcrud_annulla_p->table('hospitality_dizionario');
    $xcrud_annulla_p->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_annulla_p->where('hospitality_dizionario.etichetta = "TESTOMAIL_ANNULLA_PREVENTIVO_NODISPO" OR hospitality_dizionario.etichetta = "TESTOMAIL_ANNULLA_PREVENTIVO_STRUTTURA_CHIUSA" OR hospitality_dizionario.etichetta = "TESTOMAIL_ANNULLA_PREVENTIVO_ALTRO"');

    $xcrud_annulla_p->pass_var('idsito',IDSITO);

    $xcrud_annulla_p->columns('etichetta,Testi presenti');
    $xcrud_annulla_p->fields('etichetta');

    $xcrud_annulla_p->column_callback('etichetta','change_value');
    $xcrud_annulla_p->field_callback('etichetta','change_value');

    $xcrud_annulla_p->label('etichetta','Variabile');
    $xcrud_annulla_p->disabled('etichetta');

    $xcrud_annulla_p->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_annulla_p->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_annulla_p->column_callback('Testi presenti','show_flags');

    $xcrud_annulla_p->table_name('<small>Contenuti email: avviso al cliente di preventivo annullato (preventivi)!</small>');
    $xcrud_annulla_p->unset_add();
    $xcrud_annulla_p->unset_remove();
    $xcrud_annulla_p->unset_view();
    $xcrud_annulla_p->unset_search();
    $xcrud_annulla_p->unset_pagination();
    $xcrud_annulla_p->unset_limitlist();
    $xcrud_annulla_p->unset_print();
    $xcrud_annulla_p->unset_csv();
    $xcrud_annulla_p->unset_numbers(); 
    $xcrud_annulla_p->hide_button('save_new'); 
    $xcrud_annulla_p->hide_button('save_edit'); 
    $xcrud_annulla_p->hide_button('save_return'); 
    $xcrud_annulla_p->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $diz_langAnnullaP = $xcrud_annulla_p->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $diz_langAnnullaP->change_type('Lingua','select','',implode(',',$val));      
    }
    $diz_langAnnullaP->pass_var('idsito',IDSITO);
    $diz_langAnnullaP->columns('Lingua,testo');
    $diz_langAnnullaP->fields('Lingua,testo');
    $diz_langAnnullaP->label('testo','Traduzione');

    $diz_langAnnullaP->column_callback('Lingua','show_flags');
    $diz_langAnnullaP->field_callback('testo','textarea_input_custom');
    $diz_langAnnullaP->set_attr('testo',array('style'=>'height:100px'));
    $diz_langAnnullaP->disabled('Lingua');
    $diz_langAnnullaP->validation_required('testo',2);

    $diz_langAnnullaP->unset_csv();
    $diz_langAnnullaP->unset_print();
    $diz_langAnnullaP->unset_title();
    $diz_langAnnullaP->unset_add();
    $diz_langAnnullaP->unset_view();
    $diz_langAnnullaP->unset_remove();
    $diz_langAnnullaP->unset_search();
    $diz_langAnnullaP->unset_pagination();
    $diz_langAnnullaP->unset_limitlist();
    $diz_langAnnullaP->unset_print();
    $diz_langAnnullaP->unset_csv();
    $diz_langAnnullaP->unset_numbers();  
    $diz_langAnnullaP->hide_button('save_new'); 




    $qy = $db->query("SELECT * FROM hospitality_minigallery WHERE idsito = ".IDSITO);
    $res = $db->result($qy);
    $tot = sizeof($res);

    $xcrud2 = Xcrud::get_instance();
    $xcrud2->table('hospitality_minigallery');
    $xcrud2->where('hospitality_minigallery.idsito', IDSITO);
    $xcrud2->order_by('Id','DESC');


    $xcrud2->pass_var('idsito',IDSITO);


    $xcrud2->columns('Immagine', false); 
    $xcrud2->fields('Immagine', false); 

    $xcrud2->change_type('Immagine', 'image', '', array('manual_crop' => true,'width' => 400,'ratio' => 2, 'path' => BASE_PATH_ROOT."uploads/".IDSITO.'/'));

    if($tot >= 3){
            $xcrud2->unset_add();
    }

    $xcrud2->limit(3);
    $xcrud2->unset_limitlist();
    $xcrud2->table_name('<small>Mini gallery per le 3 immagini che compongono le e-mail di PREVENTIVO e CONFERMA</small><br><div style="line-height:9px!important"><small><small><i class="fa fa-exclamation-triangle text-orange"></i> Perchè la mini-gallery possa avere un aspetto uniforme, vi consigliamo di salvare tutte le immagini della stessa dimensione. Al momento dell\'upload il software richiede un ridimensionamento dell\'immagine, adottate lo stesso criterio per tutte quelle che caricate!</small></small></div>');
    $xcrud2->unset_print();
    $xcrud2->unset_search();
    $xcrud2->unset_pagination();
    $xcrud2->unset_csv();
    $xcrud2->unset_numbers(); 
    $xcrud2->unset_remove();
    $xcrud2->hide_button('save_new');  