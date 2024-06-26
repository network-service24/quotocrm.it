<?php
    $select = "SELECT * FROM hospitality_giorni_reselling WHERE idsito = ".IDSITO;
    $res    = $db->query($select);
    $rw     = $db->row($res);
    if(is_array($rw)) {
        if($rw > count($rw))
            $tot = count($rw); 
    }else{ 	
        $tot = 0;
    }
    if($tot == 0){
        $insert = "INSERT INTO hospitality_giorni_reselling(idsito) VALUES('".IDSITO."')";
        $ins    = $db->query($insert);
        $id     = $db->insert_id($ins);
    }else{
        $id = $rw['id'];
    }

    $xcrud->table('hospitality_giorni_reselling');
    $xcrud->where('hospitality_giorni_reselling.idsito', IDSITO);                    

    $xcrud->pass_var('idsito',IDSITO);


    $xcrud->columns('abilita', false);
    $xcrud->fields('abilita', false);

    $xcrud->change_type('abilita','radio','',array('values' => array(1 => 'Si', 0 => 'No')));

  
    $xcrud->table_name('<small>Abilita invio automatico</small>');
    $xcrud->unset_print();
    $xcrud->unset_add();
    $xcrud->unset_remove();
    $xcrud->unset_view();
    $xcrud->unset_csv();
    $xcrud->unset_search();
    $xcrud->unset_limitlist();
    $xcrud->unset_pagination();
    $xcrud->unset_numbers(); 
    $xcrud->hide_button('save_new');   
    $xcrud->hide_button('save_edit');  
    $xcrud->hide_button('return');  


    $xcrud2 = Xcrud::get_instance();
    $xcrud2->table('hospitality_giorni_reselling');
    $xcrud2->where('hospitality_giorni_reselling.idsito', IDSITO);                    

    $xcrud2->pass_var('idsito',IDSITO);

    $xcrud2->columns('numero_giorni', false);
    $xcrud2->fields('numero_giorni', false);

    $xcrud2->change_type('numero_giorni','select','','0,1,2,3,4,5');

    $xcrud2->table_name('<small>Scegliere quanti  giorni dopo il Check In deve partire automaticamente l\'email di Benvenuto</small>');
    $xcrud2->unset_print();
    $xcrud2->unset_add();
    $xcrud2->unset_remove();
    $xcrud2->unset_view();
    $xcrud2->unset_csv();
    $xcrud2->unset_search();
    $xcrud2->unset_limitlist();
    $xcrud2->unset_pagination();
    $xcrud2->unset_numbers(); 
    $xcrud2->hide_button('save_new');   
    $xcrud2->hide_button('save_edit');  
    $xcrud2->hide_button('return');  

    $xcrud_reselling = Xcrud::get_instance();
    $xcrud_reselling->table('hospitality_dizionario');
    $xcrud_reselling->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_reselling->where('hospitality_dizionario.etichetta = "TESTOMAIL_RESELLING" OR hospitality_dizionario.etichetta = "OGGETTO_RESELLING"');

    $xcrud_reselling->pass_var('idsito',IDSITO);

    $xcrud_reselling->columns('etichetta,Testi presenti');
    $xcrud_reselling->fields('etichetta');

    $xcrud_reselling->column_callback('etichetta','change_value');
    $xcrud_reselling->field_callback('etichetta','change_value');

    $xcrud_reselling->label('etichetta','Variabile');
    $xcrud_reselling->disabled('etichetta');

    $xcrud_reselling->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_reselling->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_reselling->column_callback('Testi presenti','show_flags');

    $xcrud_reselling->table_name('<small>Contenuti email: di Benvenuto! (Default) (Per tutti i Target, esclusi quelli sotto citati!)</small>');
    $xcrud_reselling->unset_add();
    $xcrud_reselling->unset_remove();
    $xcrud_reselling->unset_view();
    $xcrud_reselling->unset_search();
    $xcrud_reselling->unset_pagination();
    $xcrud_reselling->unset_limitlist();
    $xcrud_reselling->unset_print();
    $xcrud_reselling->unset_csv();
    $xcrud_reselling->unset_numbers(); 
    $xcrud_reselling->hide_button('save_new'); 
    $xcrud_reselling->hide_button('save_edit'); 
    $xcrud_reselling->hide_button('save_return'); 
    $xcrud_reselling->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $diz_lang_reselling = $xcrud_reselling->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val2[]  = $value['Sigla'];
        }
        $diz_lang_reselling->change_type('Lingua','select','',implode(',',$val2));      
    }
    $diz_lang_reselling->pass_var('idsito',IDSITO);
    $diz_lang_reselling->columns('Lingua,testo');
    $diz_lang_reselling->fields('Lingua,testo');
    $diz_lang_reselling->label('testo','Traduzione');

    $diz_lang_reselling->column_callback('Lingua','show_flags');    

    $diz_lang_reselling->field_callback('testo','textarea_input');

    $diz_lang_reselling->disabled('Lingua');
    $diz_lang_reselling->validation_required('testo',2);

    $diz_lang_reselling->unset_csv();
    $diz_lang_reselling->unset_print();
    $diz_lang_reselling->unset_title();
    $diz_lang_reselling->unset_add();
    $diz_lang_reselling->unset_view();
    $diz_lang_reselling->unset_remove();
    $diz_lang_reselling->unset_search();
    $diz_lang_reselling->unset_pagination();
    $diz_lang_reselling->unset_limitlist();
    $diz_lang_reselling->unset_print();
    $diz_lang_reselling->unset_csv();
    $diz_lang_reselling->unset_numbers();  
    $diz_lang_reselling->hide_button('save_new');   

    $xcrud_resellingF = Xcrud::get_instance();
    $xcrud_resellingF->table('hospitality_dizionario');
    $xcrud_resellingF->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_resellingF->where('hospitality_dizionario.etichetta = "TESTOMAIL_RESELLING_FAMILY" OR hospitality_dizionario.etichetta = "OGGETTO_RESELLING_FAMILY"');

    $xcrud_resellingF->pass_var('idsito',IDSITO);

    $xcrud_resellingF->columns('etichetta,Testi presenti');
    $xcrud_resellingF->fields('etichetta');

    $xcrud_resellingF->column_callback('etichetta','change_value');
    $xcrud_resellingF->field_callback('etichetta','change_value');

    $xcrud_resellingF->label('etichetta','Variabile');
    $xcrud_resellingF->disabled('etichetta');

    $xcrud_resellingF->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_resellingF->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_resellingF->column_callback('Testi presenti','show_flags');

    $xcrud_resellingF->table_name('<small>Contenuti email: di Benvenuto per profilo FAMILY!</small>');
    $xcrud_resellingF->unset_add();
    $xcrud_resellingF->unset_remove();
    $xcrud_resellingF->unset_view();
    $xcrud_resellingF->unset_search();
    $xcrud_resellingF->unset_pagination();
    $xcrud_resellingF->unset_limitlist();
    $xcrud_resellingF->unset_print();
    $xcrud_resellingF->unset_csv();
    $xcrud_resellingF->unset_numbers(); 
    $xcrud_resellingF->hide_button('save_new'); 
    $xcrud_resellingF->hide_button('save_edit'); 
    $xcrud_resellingF->hide_button('save_return'); 
    $xcrud_resellingF->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $diz_lang_resellingF = $xcrud_resellingF->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val2[]  = $value['Sigla'];
        }
        $diz_lang_resellingF->change_type('Lingua','select','',implode(',',$val2));      
    }
    $diz_lang_resellingF->pass_var('idsito',IDSITO);
    $diz_lang_resellingF->columns('Lingua,testo');
    $diz_lang_resellingF->fields('Lingua,testo');
    $diz_lang_resellingF->label('testo','Traduzione');

    $diz_lang_resellingF->column_callback('Lingua','show_flags');    

    $diz_lang_resellingF->field_callback('testo','textarea_input');

    $diz_lang_resellingF->disabled('Lingua');
    $diz_lang_resellingF->validation_required('testo',2);

    $diz_lang_resellingF->unset_csv();
    $diz_lang_resellingF->unset_print();
    $diz_lang_resellingF->unset_title();
    $diz_lang_resellingF->unset_add();
    $diz_lang_resellingF->unset_view();
    $diz_lang_resellingF->unset_remove();
    $diz_lang_resellingF->unset_search();
    $diz_lang_resellingF->unset_pagination();
    $diz_lang_resellingF->unset_limitlist();
    $diz_lang_resellingF->unset_print();
    $diz_lang_resellingF->unset_csv();
    $diz_lang_resellingF->unset_numbers();  
    $diz_lang_resellingF->hide_button('save_new');   



    $xcrud_resellingB = Xcrud::get_instance();
    $xcrud_resellingB->table('hospitality_dizionario');
    $xcrud_resellingB->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_resellingB->where('hospitality_dizionario.etichetta = "TESTOMAIL_RESELLING_BUSINESS" OR hospitality_dizionario.etichetta = "OGGETTO_RESELLING_BUSINESS"');

    $xcrud_resellingB->pass_var('idsito',IDSITO);

    $xcrud_resellingB->columns('etichetta,Testi presenti');
    $xcrud_resellingB->fields('etichetta');

    $xcrud_resellingB->column_callback('etichetta','change_value');
    $xcrud_resellingB->field_callback('etichetta','change_value');

    $xcrud_resellingB->label('etichetta','Variabile');
    $xcrud_resellingB->disabled('etichetta');

    $xcrud_resellingB->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_resellingB->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_resellingB->column_callback('Testi presenti','show_flags');

    $xcrud_resellingB->table_name('<small>Contenuti email: di Benvenuto per profilo BUSINESS! (Business,Fiera)</small>');
    $xcrud_resellingB->unset_add();
    $xcrud_resellingB->unset_remove();
    $xcrud_resellingB->unset_view();
    $xcrud_resellingB->unset_search();
    $xcrud_resellingB->unset_pagination();
    $xcrud_resellingB->unset_limitlist();
    $xcrud_resellingB->unset_print();
    $xcrud_resellingB->unset_csv();
    $xcrud_resellingB->unset_numbers(); 
    $xcrud_resellingB->hide_button('save_new'); 
    $xcrud_resellingB->hide_button('save_edit'); 
    $xcrud_resellingB->hide_button('save_return'); 
    $xcrud_resellingB->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $diz_lang_resellingB = $xcrud_resellingB->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val2[]  = $value['Sigla'];
        }
        $diz_lang_resellingB->change_type('Lingua','select','',implode(',',$val2));      
    }
    $diz_lang_resellingB->pass_var('idsito',IDSITO);
    $diz_lang_resellingB->columns('Lingua,testo');
    $diz_lang_resellingB->fields('Lingua,testo');
    $diz_lang_resellingB->label('testo','Traduzione');

    $diz_lang_resellingB->column_callback('Lingua','show_flags');    

    $diz_lang_resellingB->field_callback('testo','textarea_input');

    $diz_lang_resellingB->disabled('Lingua');
    $diz_lang_resellingB->validation_required('testo',2);

    $diz_lang_resellingB->unset_csv();
    $diz_lang_resellingB->unset_print();
    $diz_lang_resellingB->unset_title();
    $diz_lang_resellingB->unset_add();
    $diz_lang_resellingB->unset_view();
    $diz_lang_resellingB->unset_remove();
    $diz_lang_resellingB->unset_search();
    $diz_lang_resellingB->unset_pagination();
    $diz_lang_resellingB->unset_limitlist();
    $diz_lang_resellingB->unset_print();
    $diz_lang_resellingB->unset_csv();
    $diz_lang_resellingB->unset_numbers();  
    $diz_lang_resellingB->hide_button('save_new'); 

    $xcrud_resellingBen = Xcrud::get_instance();
    $xcrud_resellingBen->table('hospitality_dizionario');
    $xcrud_resellingBen->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_resellingBen->where('hospitality_dizionario.etichetta = "TESTOMAIL_RESELLING_BENESSERE" OR hospitality_dizionario.etichetta = "OGGETTO_RESELLING_BENESSERE"');

    $xcrud_resellingBen->pass_var('idsito',IDSITO);

    $xcrud_resellingBen->columns('etichetta,Testi presenti');
    $xcrud_resellingBen->fields('etichetta');

    $xcrud_resellingBen->column_callback('etichetta','change_value');
    $xcrud_resellingBen->field_callback('etichetta','change_value');

    $xcrud_resellingBen->label('etichetta','Variabile');
    $xcrud_resellingBen->disabled('etichetta');

    $xcrud_resellingBen->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_resellingBen->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_resellingBen->column_callback('Testi presenti','show_flags');

    $xcrud_resellingBen->table_name('<small>Contenuti email: di Benvenuto per profilo BENESSERE!</small>');
    $xcrud_resellingBen->unset_add();
    $xcrud_resellingBen->unset_remove();
    $xcrud_resellingBen->unset_view();
    $xcrud_resellingBen->unset_search();
    $xcrud_resellingBen->unset_pagination();
    $xcrud_resellingBen->unset_limitlist();
    $xcrud_resellingBen->unset_print();
    $xcrud_resellingBen->unset_csv();
    $xcrud_resellingBen->unset_numbers(); 
    $xcrud_resellingBen->hide_button('save_new'); 
    $xcrud_resellingBen->hide_button('save_edit'); 
    $xcrud_resellingBen->hide_button('save_return'); 
    $xcrud_resellingBen->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $diz_lang_resellingBen = $xcrud_resellingBen->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val2[]  = $value['Sigla'];
        }
        $diz_lang_resellingBen->change_type('Lingua','select','',implode(',',$val2));      
    }
    $diz_lang_resellingBen->pass_var('idsito',IDSITO);
    $diz_lang_resellingBen->columns('Lingua,testo');
    $diz_lang_resellingBen->fields('Lingua,testo');
    $diz_lang_resellingBen->label('testo','Traduzione');

    $diz_lang_resellingBen->column_callback('Lingua','show_flags');    

    $diz_lang_resellingBen->field_callback('testo','textarea_input');

    $diz_lang_resellingBen->disabled('Lingua');
    $diz_lang_resellingBen->validation_required('testo',2);

    $diz_lang_resellingBen->unset_csv();
    $diz_lang_resellingBen->unset_print();
    $diz_lang_resellingBen->unset_title();
    $diz_lang_resellingBen->unset_add();
    $diz_lang_resellingBen->unset_view();
    $diz_lang_resellingBen->unset_remove();
    $diz_lang_resellingBen->unset_search();
    $diz_lang_resellingBen->unset_pagination();
    $diz_lang_resellingBen->unset_limitlist();
    $diz_lang_resellingBen->unset_print();
    $diz_lang_resellingBen->unset_csv();
    $diz_lang_resellingBen->unset_numbers();  
    $diz_lang_resellingBen->hide_button('save_new'); 

    $xcrud_resellingS = Xcrud::get_instance();
    $xcrud_resellingS->table('hospitality_dizionario');
    $xcrud_resellingS->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_resellingS->where('hospitality_dizionario.etichetta = "TESTOMAIL_RESELLING_SPORT" OR hospitality_dizionario.etichetta = "OGGETTO_RESELLING_SPORT"');

    $xcrud_resellingS->pass_var('idsito',IDSITO);

    $xcrud_resellingS->columns('etichetta,Testi presenti');
    $xcrud_resellingS->fields('etichetta');

    $xcrud_resellingS->column_callback('etichetta','change_value');
    $xcrud_resellingS->field_callback('etichetta','change_value');

    $xcrud_resellingS->label('etichetta','Variabile');
    $xcrud_resellingS->disabled('etichetta');

    $xcrud_resellingS->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_resellingS->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_resellingS->column_callback('Testi presenti','show_flags');

    $xcrud_resellingS->table_name('<small>Contenuti email: di Benvenuto per profilo SPORT (Bike e Sport)!</small>');
    $xcrud_resellingS->unset_add();
    $xcrud_resellingS->unset_remove();
    $xcrud_resellingS->unset_view();
    $xcrud_resellingS->unset_search();
    $xcrud_resellingS->unset_pagination();
    $xcrud_resellingS->unset_limitlist();
    $xcrud_resellingS->unset_print();
    $xcrud_resellingS->unset_csv();
    $xcrud_resellingS->unset_numbers(); 
    $xcrud_resellingS->hide_button('save_new'); 
    $xcrud_resellingS->hide_button('save_edit'); 
    $xcrud_resellingS->hide_button('save_return'); 
    $xcrud_resellingS->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $diz_lang_resellingS = $xcrud_resellingS->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val2[]  = $value['Sigla'];
        }
        $diz_lang_resellingS->change_type('Lingua','select','',implode(',',$val2));      
    }
    $diz_lang_resellingS->pass_var('idsito',IDSITO);
    $diz_lang_resellingS->columns('Lingua,testo');
    $diz_lang_resellingS->fields('Lingua,testo');
    $diz_lang_resellingS->label('testo','Traduzione');

    $diz_lang_resellingS->column_callback('Lingua','show_flags');    

    $diz_lang_resellingS->field_callback('testo','textarea_input');

    $diz_lang_resellingS->disabled('Lingua');
    $diz_lang_resellingS->validation_required('testo',2);

    $diz_lang_resellingS->unset_csv();
    $diz_lang_resellingS->unset_print();
    $diz_lang_resellingS->unset_title();
    $diz_lang_resellingS->unset_add();
    $diz_lang_resellingS->unset_view();
    $diz_lang_resellingS->unset_remove();
    $diz_lang_resellingS->unset_search();
    $diz_lang_resellingS->unset_pagination();
    $diz_lang_resellingS->unset_limitlist();
    $diz_lang_resellingS->unset_print();
    $diz_lang_resellingS->unset_csv();
    $diz_lang_resellingS->unset_numbers();  
    $diz_lang_resellingS->hide_button('save_new'); 