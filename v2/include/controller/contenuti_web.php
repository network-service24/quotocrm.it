<?php

    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_contenuti_web');
    $xcrud->where('hospitality_contenuti_web.idsito', IDSITO);
    $xcrud->where('hospitality_contenuti_web.TipoRichiesta', 'Preventivo');
    


    $xcrud->column_callback('Lingua','show_flags');    
    $xcrud->change_type('TipoRichiesta','select','','Preventivo,Conferma');
    $xcrud->change_type('Moduli','checkboxes','','Eventi,Punti di Interesse');
    $xcrud->change_type('Abilitato','bool');

    $xcrud->columns('Immagine,Lingua,TipoRichiesta,Moduli,Testo,Abilitato');
    $xcrud->column_callback('Lingua','show_flags');
    
    $xcrud->fields('Immagine,Lingua,TipoRichiesta,Moduli,Testo,Abilitato');
    $xcrud->field_callback('Testo','messaggio_web');
    $xcrud->pass_var('idsito',IDSITO);

    $xcrud->set_attr('Oggetto',array('placeholder' => 'Inserire un Oggetto .....'));

    $xcrud->field_tooltip('TipoRichiesta','Scegliere la tipologia di richiesta');
    $xcrud->field_tooltip('Immagine','Inserire una immagine per il TOP IMAGE della pagina web');            
    $xcrud->field_tooltip('Lingua','Segliere la lingua riferita al testo da inserire');
    $xcrud->field_tooltip('Moduli','Scegliere uno o più moduli da abilitare nella pagina web');
    $xcrud->field_tooltip('Testo','Inserire il contenuto testuale generico della pagina web!<br>E\' possibile personalizzare il testo del messaggio inserendo la variabile <strong>[cliente]</strong><br> 
                                        Al momento dell\'invio il sistema sostituirà <strong>[cliente] con il Nome ed il Cognome</strong> del contatto contenuto nelle varie richieste');
  
    $xcrud->label(array('TipoRichiesta' => 'Tipo Richiesta'));
    
    //$xcrud->validation_required('Immagine',3);
    //$xcrud->validation_required('TipoRichiesta',3);
    //$xcrud->validation_required('Moduli',3);
    $xcrud->disabled('Lingua');
    $xcrud->disabled('TipoRichiesta');
     
    
    $db->query("SELECT * FROM hospitality_lingue WHERE idsito = ".IDSITO." ORDER BY Id ASC");
    $row = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $chiave => $valore){
            
            $ListaLingua[] = $valore['Sigla'];
        }
        $ListaLingua = implode(",",$ListaLingua);
        
        $xcrud->change_type('Lingua','select','',$ListaLingua);
    }
    $xcrud->change_type('Immagine', 'image', '', array('height' => 1400,'ratio' => 3,'manual_crop' => true, 'path' => BASE_PATH_ROOT."uploads/".IDSITO.'/')); 


    $xcrud->create_action('Attiva', 'abilita_web'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_web');
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

    
    $xcrud->table_name('<small>Contenuti Template: Preventivo!</small>');
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

    $xcrud_conferma->table('hospitality_contenuti_web');
    $xcrud_conferma->where('hospitality_contenuti_web.idsito', IDSITO);
    $xcrud_conferma->where('hospitality_contenuti_web.TipoRichiesta', 'Conferma');
    


    $xcrud_conferma->column_callback('Lingua','show_flags');    
    $xcrud_conferma->change_type('TipoRichiesta','select','','Preventivo,Conferma');
    $xcrud_conferma->change_type('Moduli','checkboxes','','Eventi,Punti di Interesse');
    $xcrud_conferma->change_type('Abilitato','bool');

    $xcrud_conferma->columns('Immagine,Lingua,TipoRichiesta,Moduli,Testo,Abilitato');
    $xcrud_conferma->column_callback('Lingua','show_flags');
    
    $xcrud_conferma->fields('Immagine,Lingua,TipoRichiesta,Moduli,Testo,Abilitato');
    $xcrud_conferma->field_callback('Testo','messaggio_web');
    $xcrud_conferma->pass_var('idsito',IDSITO);

    $xcrud_conferma->set_attr('Oggetto',array('placeholder' => 'Inserire un Oggetto .....'));

    $xcrud_conferma->field_tooltip('TipoRichiesta','Scegliere la tipologia di richiesta');
    $xcrud_conferma->field_tooltip('Immagine','Inserire una immagine per il TOP IMAGE della pagina web');            
    $xcrud_conferma->field_tooltip('Lingua','Segliere la lingua riferita al testo da inserire');
    $xcrud_conferma->field_tooltip('Moduli','Scegliere uno o più moduli da abilitare nella pagina web');
    $xcrud_conferma->field_tooltip('Testo','Inserire il contenuto testuale generico della pagina web!<br>E\' possibile personalizzare il testo del messaggio inserendo la variabile <strong>[cliente]</strong><br> 
                                        Al momento dell\'invio il sistema sostituirà <strong>[cliente] con il Nome ed il Cognome</strong> del contatto contenuto nelle varie richieste');
  
    $xcrud_conferma->label(array('TipoRichiesta' => 'Tipo Richiesta'));
    
    //$xcrud_conferma->validation_required('Immagine',3);
    //$xcrud_conferma->validation_required('TipoRichiesta',3);
    //$xcrud_conferma->validation_required('Moduli',3);
    $xcrud_conferma->disabled('Lingua');
    $xcrud_conferma->disabled('TipoRichiesta');
     
    
    $db->query("SELECT * FROM hospitality_lingue WHERE idsito = ".IDSITO." ORDER BY Id ASC");
    $row = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $chiave => $valore){
            
            $ListaLingua2[] = $valore['Sigla'];
        }
        $ListaLingua2 = implode(",",$ListaLingua2);
        
        $xcrud_conferma->change_type('Lingua','select','',$ListaLingua2);
    }
    $xcrud_conferma->change_type('Immagine', 'image', '', array('height' => 1400,'ratio' => 3,'manual_crop' => true, 'path' => BASE_PATH_ROOT."uploads/".IDSITO.'/')); 


    $xcrud_conferma->create_action('Attiva', 'abilita_web'); // action callback, function publish_action() in functions.php
    $xcrud_conferma->create_action('Disattiva', 'disabilita_web');
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

    
    $xcrud_conferma->table_name('<small>Contenuti Template: Conferma!</small>');
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



    $xcrud_family = Xcrud::get_instance();
    $xcrud_family->table('hospitality_dizionario');
    $xcrud_family->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_family->where('hospitality_dizionario.etichetta = "PREVENTIVO_CUSTOM1" OR hospitality_dizionario.etichetta = "CONFERMA_CUSTOM1"');

    $xcrud_family->pass_var('idsito',IDSITO);

    $xcrud_family->columns('etichetta,Testi presenti');
    $xcrud_family->fields('etichetta');

    $xcrud_family->column_callback('etichetta','change_value_custom');
    $xcrud_family->field_callback('etichetta','change_value_custom');

    $xcrud_family->label('etichetta','Variabile');
    $xcrud_family->disabled('etichetta');

    $xcrud_family->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_family->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_family->column_callback('Testi presenti','show_flags');

    $xcrud_family->table_name('<small>Contenuti Template per target: '.get_name_template(IDSITO,'custom1').' !</small>');
    $xcrud_family->unset_add();
    $xcrud_family->unset_remove();
    $xcrud_family->unset_view();
    $xcrud_family->unset_search();
    $xcrud_family->unset_pagination();
    $xcrud_family->unset_limitlist();
    $xcrud_family->unset_print();
    $xcrud_family->unset_csv();
    $xcrud_family->unset_numbers(); 
    $xcrud_family->hide_button('save_new'); 
    $xcrud_family->hide_button('save_edit'); 
    $xcrud_family->hide_button('save_return'); 
    $xcrud_family->hide_button('save_new');    


    /* GESTIONE TABELLA TESTI */
    $diz_family = $xcrud_family->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $diz_family->change_type('Lingua','select','',implode(',',$val));      
    }
    $diz_family->pass_var('idsito',IDSITO);
    $diz_family->columns('Lingua,testo');
    $diz_family->fields('Lingua,testo');
    $diz_family->label('testo','Traduzione');

    $diz_family->column_callback('Lingua','show_flags');
    $diz_family->field_callback('testo','textarea_input');
    $diz_family->set_attr('testo',array('style'=>'height:100px'));
    $diz_family->disabled('Lingua');
    $diz_family->validation_required('testo',2);

    $diz_family->unset_csv();
    $diz_family->unset_print();
    $diz_family->unset_title();
    $diz_family->unset_add();
    $diz_family->unset_view();
    $diz_family->unset_remove();
    $diz_family->unset_search();
    $diz_family->unset_pagination();
    $diz_family->unset_limitlist();
    $diz_family->unset_print();
    $diz_family->unset_csv();
    $diz_family->unset_numbers();  
    $diz_family->hide_button('save_new');   





    $xcrud_bike = Xcrud::get_instance();
    $xcrud_bike->table('hospitality_dizionario');
    $xcrud_bike->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_bike->where('hospitality_dizionario.etichetta = "PREVENTIVO_CUSTOM2" OR hospitality_dizionario.etichetta = "CONFERMA_CUSTOM2"');

    $xcrud_bike->pass_var('idsito',IDSITO);

    $xcrud_bike->columns('etichetta,Testi presenti');
    $xcrud_bike->fields('etichetta');

    $xcrud_bike->column_callback('etichetta','change_value_custom');
    $xcrud_bike->field_callback('etichetta','change_value_custom');

    $xcrud_bike->label('etichetta','Variabile');
    $xcrud_bike->disabled('etichetta');

    $xcrud_bike->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_bike->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_bike->column_callback('Testi presenti','show_flags');

    $xcrud_bike->table_name('<small>Contenuti Template per target: '.get_name_template(IDSITO,'custom2').' !</small>');
    $xcrud_bike->unset_add();
    $xcrud_bike->unset_remove();
    $xcrud_bike->unset_view();
    $xcrud_bike->unset_search();
    $xcrud_bike->unset_pagination();
    $xcrud_bike->unset_limitlist();
    $xcrud_bike->unset_print();
    $xcrud_bike->unset_csv();
    $xcrud_bike->unset_numbers(); 
    $xcrud_bike->hide_button('save_new'); 
    $xcrud_bike->hide_button('save_edit'); 
    $xcrud_bike->hide_button('save_return'); 
    $xcrud_bike->hide_button('save_new'); 

    /* GESTIONE TABELLA TESTI */
    $diz_bike = $xcrud_bike->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $diz_bike->change_type('Lingua','select','',implode(',',$val));      
    }
    $diz_bike->pass_var('idsito',IDSITO);
    $diz_bike->columns('Lingua,testo');
    $diz_bike->fields('Lingua,testo');
    $diz_bike->label('testo','Traduzione');

    $diz_bike->column_callback('Lingua','show_flags');
    $diz_bike->field_callback('testo','textarea_input');
    $diz_bike->set_attr('testo',array('style'=>'height:100px'));
    $diz_bike->disabled('Lingua');
    $diz_bike->validation_required('testo',2);

    $diz_bike->unset_csv();
    $diz_bike->unset_print();
    $diz_bike->unset_title();
    $diz_bike->unset_add();
    $diz_bike->unset_view();
    $diz_bike->unset_remove();
    $diz_bike->unset_search();
    $diz_bike->unset_pagination();
    $diz_bike->unset_limitlist();
    $diz_bike->unset_print();
    $diz_bike->unset_csv();
    $diz_bike->unset_numbers();  
    $diz_bike->hide_button('save_new');  

    $xcrud_romantico = Xcrud::get_instance();
    $xcrud_romantico->table('hospitality_dizionario');
    $xcrud_romantico->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_romantico->where('hospitality_dizionario.etichetta = "PREVENTIVO_CUSTOM3" OR hospitality_dizionario.etichetta = "CONFERMA_CUSTOM3"');

    $xcrud_romantico->pass_var('idsito',IDSITO);

    $xcrud_romantico->columns('etichetta,Testi presenti');
    $xcrud_romantico->fields('etichetta');

    $xcrud_romantico->column_callback('etichetta','change_value_custom');
    $xcrud_romantico->field_callback('etichetta','change_value_custom');

    $xcrud_romantico->label('etichetta','Variabile');
    $xcrud_romantico->disabled('etichetta');

    $xcrud_romantico->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_romantico->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_romantico->column_callback('Testi presenti','show_flags');

    $xcrud_romantico->table_name('<small>Contenuti Template per target: '.get_name_template(IDSITO,'custom3').' !</small>');
    $xcrud_romantico->unset_add();
    $xcrud_romantico->unset_remove();
    $xcrud_romantico->unset_view();
    $xcrud_romantico->unset_search();
    $xcrud_romantico->unset_pagination();
    $xcrud_romantico->unset_limitlist();
    $xcrud_romantico->unset_print();
    $xcrud_romantico->unset_csv();
    $xcrud_romantico->unset_numbers(); 
    $xcrud_romantico->hide_button('save_new'); 
    $xcrud_romantico->hide_button('save_edit'); 
    $xcrud_romantico->hide_button('save_return'); 
    $xcrud_romantico->hide_button('save_new'); 

    /* GESTIONE TABELLA TESTI */
    $diz_romantico = $xcrud_romantico->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $diz_romantico->change_type('Lingua','select','',implode(',',$val));      
    }
    $diz_romantico->pass_var('idsito',IDSITO);
    $diz_romantico->columns('Lingua,testo');
    $diz_romantico->fields('Lingua,testo');
    $diz_romantico->label('testo','Traduzione');

    $diz_romantico->column_callback('Lingua','show_flags');
    $diz_romantico->field_callback('testo','textarea_input');
    $diz_romantico->set_attr('testo',array('style'=>'height:100px'));
    $diz_romantico->disabled('Lingua');
    $diz_romantico->validation_required('testo',2);

    $diz_romantico->unset_csv();
    $diz_romantico->unset_print();
    $diz_romantico->unset_title();
    $diz_romantico->unset_add();
    $diz_romantico->unset_view();
    $diz_romantico->unset_remove();
    $diz_romantico->unset_search();
    $diz_romantico->unset_pagination();
    $diz_romantico->unset_limitlist();
    $diz_romantico->unset_print();
    $diz_romantico->unset_csv();
    $diz_romantico->unset_numbers();  
    $diz_romantico->hide_button('save_new');  

    $xcrud_questionario = Xcrud::get_instance();
    $xcrud_questionario->table('hospitality_dizionario');
    $xcrud_questionario->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_questionario->where('hospitality_dizionario.etichetta = "QUESTIONARIO" OR hospitality_dizionario.etichetta = "TESTO_QUESTIONARIO"');

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

    $xcrud_questionario->table_name('<small>Contenuti Template: Questionario (Customer Satisfaction)!</small>');
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
    $diz_langQ->field_callback('testo','textarea_input');
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

    $xcrud_voucher = Xcrud::get_instance();
    $xcrud_voucher->table('hospitality_dizionario');
    $xcrud_voucher->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_voucher->where('hospitality_dizionario.etichetta = "TESTO_VOUCHER"');

    $xcrud_voucher->pass_var('idsito',IDSITO);

    $xcrud_voucher->columns('etichetta,Testi presenti');
    $xcrud_voucher->fields('etichetta');

    $xcrud_voucher->column_callback('etichetta','change_value');
    $xcrud_voucher->field_callback('etichetta','change_value');

    $xcrud_voucher->label('etichetta','Variabile');
    $xcrud_voucher->disabled('etichetta');

    $xcrud_voucher->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_voucher->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_voucher->column_callback('Testi presenti','show_flags');

    $xcrud_voucher->table_name('<small>Contenuti Testuali: Voucher!</small>');
    $xcrud_voucher->unset_add();
    $xcrud_voucher->unset_remove();
    $xcrud_voucher->unset_view();
    $xcrud_voucher->unset_search();
    $xcrud_voucher->unset_pagination();
    $xcrud_voucher->unset_limitlist();
    $xcrud_voucher->unset_print();
    $xcrud_voucher->unset_csv();
    $xcrud_voucher->unset_numbers(); 
    $xcrud_voucher->hide_button('save_new'); 
    $xcrud_voucher->hide_button('save_edit'); 
    $xcrud_voucher->hide_button('save_return'); 
    $xcrud_voucher->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $diz_langV = $xcrud_voucher->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

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
    $diz_langV->field_callback('testo','textarea_input');
    $diz_langV->field_tooltip('testo','Se NON si desidera nessun testo nel voucher, copia ed incolla il codice tra parentesi (&nbsp;) nella textarea lato SORGENTE!');
    $diz_langV->set_attr('testo',array('style'=>'height:100px'));
    $diz_langV->disabled('Lingua');

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


    $xcrud_voucher_recupero = Xcrud::get_instance();
    $xcrud_voucher_recupero->table('hospitality_dizionario');
    $xcrud_voucher_recupero->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_voucher_recupero->where('hospitality_dizionario.etichetta = "TESTO_VOUCHER_RECUPERO"');


    $xcrud_voucher_recupero->pass_var('idsito',IDSITO);

    $xcrud_voucher_recupero->columns('etichetta,Testi presenti');
    $xcrud_voucher_recupero->fields('etichetta');

    $xcrud_voucher_recupero->column_callback('etichetta','change_value');
    $xcrud_voucher_recupero->field_callback('etichetta','change_value');

    $xcrud_voucher_recupero->label('etichetta','Variabile');
    $xcrud_voucher_recupero->disabled('etichetta');

    $xcrud_voucher_recupero->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_voucher_recupero->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_voucher_recupero->column_callback('Testi presenti','show_flags');

    $xcrud_voucher_recupero->table_name('<small>Contenuti Testuali: Buono Voucher!</small>');
    $xcrud_voucher_recupero->unset_add();
    $xcrud_voucher_recupero->unset_remove();
    $xcrud_voucher_recupero->unset_view();
    $xcrud_voucher_recupero->unset_search();
    $xcrud_voucher_recupero->unset_pagination();
    $xcrud_voucher_recupero->unset_limitlist();
    $xcrud_voucher_recupero->unset_print();
    $xcrud_voucher_recupero->unset_csv();
    $xcrud_voucher_recupero->unset_numbers(); 
    $xcrud_voucher_recupero->hide_button('save_new'); 
    $xcrud_voucher_recupero->hide_button('save_edit'); 
    $xcrud_voucher_recupero->hide_button('save_return'); 
    $xcrud_voucher_recupero->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $diz_langV_R = $xcrud_voucher_recupero->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $diz_langV_R->change_type('Lingua','select','',implode(',',$val));      
    }
    $diz_langV->pass_var('idsito',IDSITO);
    $diz_langV->columns('Lingua,testo');
    $diz_langV->fields('Lingua,testo');
    $diz_langV->label('testo','Traduzione');

    $diz_langV->column_callback('Lingua','show_flags');
    $diz_langV->field_callback('testo','textarea_input');
    $diz_langV->field_tooltip('testo','Se NON si desidera nessun testo nel voucher di recupero, copia ed incolla il codice tra parentesi (&nbsp;) nella textarea lato SORGENTE!');
    $diz_langV->set_attr('testo',array('style'=>'height:100px'));
    $diz_langV->disabled('Lingua');

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