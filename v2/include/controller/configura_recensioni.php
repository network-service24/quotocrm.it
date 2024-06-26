<?php
    $select = "SELECT * FROM hospitality_giorni_recensioni WHERE idsito = ".IDSITO;
    $res    = $db->query($select);
    $rw     = $db->row($res);
    if(is_array($rw)) {
        if($rw > count($rw))
            $tot = count($rw); 
    }else{ 	
        $tot = 0;
    }
    if($tot == 0){
        $insert = "INSERT INTO hospitality_giorni_recensioni(idsito) VALUES('".IDSITO."')";
        $ins    = $db->query($insert);
        $id     = $db->insert_id($ins);
    }else{
        $id = $rw['id'];
    }

    $xcrud->table('hospitality_giorni_recensioni');
    $xcrud->where('hospitality_giorni_recensioni.idsito', IDSITO);                    

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
    $xcrud2->table('hospitality_giorni_recensioni');
    $xcrud2->where('hospitality_giorni_recensioni.idsito', IDSITO);                    

    $xcrud2->pass_var('idsito',IDSITO);

    $xcrud2->columns('numero_giorni', false);
    $xcrud2->fields('numero_giorni', false);

    $xcrud2->label('numero_giorni', 'Numero Giorni PRIMA o DOPO il CheckOut');

    $xcrud2->change_type('numero_giorni','select','','0,-5,-4,-3,-2,-1,+1,+2,+3,+4,+5');


    $xcrud2->table_name('<small>Scegliere quanti  giorni PRIMA o DOPO il Check Out deve partire automaticamente l\'email di Richiesta Recensioni su TripAdvisor</small>');
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
    $xcrud_reselling->where('hospitality_dizionario.etichetta = "TESTOMAIL_RECENSIONE" OR hospitality_dizionario.etichetta = "OGGETTO_RECENSIONE"');

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

    $xcrud_reselling->table_name('<small>Contenuti email: della Richiesta Recensioni TripAdvisor!</small>');
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