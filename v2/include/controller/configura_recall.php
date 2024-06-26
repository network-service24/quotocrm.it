<?php
    $select = "SELECT * FROM hospitality_giorni_recall_preventivi WHERE idsito = ".IDSITO;
    $res    = $db->query($select);
    $rw     = $db->row($res);
    if(is_array($rw)) {
        if($rw > count($rw))
            $tot = count($rw); 
    }else{ 	
        $tot = 0;
    }
    if($tot == 0){
        $insert = "INSERT INTO hospitality_giorni_recall_preventivi(idsito) VALUES('".IDSITO."')";
        $ins    = $db->query($insert);
        $id     = $db->insert_id($ins);
    }else{
        $id = $rw['id'];
    }

    $xcrud->table('hospitality_giorni_recall_preventivi');
    $xcrud->where('hospitality_giorni_recall_preventivi.idsito', IDSITO);                    

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
    $xcrud2->table('hospitality_giorni_recall_preventivi');
    $xcrud2->where('hospitality_giorni_recall_preventivi.idsito', IDSITO);                    

    $xcrud2->pass_var('idsito',IDSITO);

    $xcrud2->columns('numero_giorni', false);
    $xcrud2->fields('numero_giorni', false);

    $xcrud2->change_type('numero_giorni','select','','0,1,2,3,4,5');

    $xcrud2->table_name('<small>Scegliere quanti  giorni prima della Scadenza deve ripartire automaticamente l\'email di ReCall Preventivi</small>');
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

    $xcrud_resend = Xcrud::get_instance();
    $xcrud_resend->table('hospitality_dizionario');
    $xcrud_resend->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud_resend->where('hospitality_dizionario.etichetta = "TESTOMAIL_RECALL_PREVENTIVI" OR hospitality_dizionario.etichetta = "OGGETTO_RECALL_PREVENTIVI"');

    $xcrud_resend->pass_var('idsito',IDSITO);

    $xcrud_resend->columns('etichetta,Testi presenti');
    $xcrud_resend->fields('etichetta');

    $xcrud_resend->label('etichetta','Variabile');
    $xcrud_resend->disabled('etichetta');

    $xcrud_resend->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud_resend->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud_resend->column_callback('Testi presenti','show_flags');

    $xcrud_resend->column_callback('etichetta','change_value');
    $xcrud_resend->field_callback('etichetta','change_value');

    $xcrud_resend->table_name('<small>Contenuti email: di ReCall di Preventivi!</small>');
    $xcrud_resend->unset_add();
    $xcrud_resend->unset_remove();
    $xcrud_resend->unset_view();
    $xcrud_resend->unset_search();
    $xcrud_resend->unset_pagination();
    $xcrud_resend->unset_limitlist();
    $xcrud_resend->unset_print();
    $xcrud_resend->unset_csv();
    $xcrud_resend->unset_numbers(); 
    $xcrud_resend->hide_button('save_new'); 
    $xcrud_resend->hide_button('save_edit'); 
    $xcrud_resend->hide_button('save_return'); 
    $xcrud_resend->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $diz_lang_resend = $xcrud_resend->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val2[]  = $value['Sigla'];
        }
        $diz_lang_resend->change_type('Lingua','select','',implode(',',$val2));      
    }
    $diz_lang_resend->pass_var('idsito',IDSITO);
    $diz_lang_resend->columns('Lingua,testo');
    $diz_lang_resend->fields('Lingua,testo');
    $diz_lang_resend->label('testo','Traduzione');

    $diz_lang_resend->column_callback('Lingua','show_flags');  


    $diz_lang_resend->field_callback('testo','textarea_input');

    $diz_lang_resend->disabled('Lingua');
    $diz_lang_resend->validation_required('testo',2);

    $diz_lang_resend->unset_csv();
    $diz_lang_resend->unset_print();
    $diz_lang_resend->unset_title();
    $diz_lang_resend->unset_add();
    $diz_lang_resend->unset_view();
    $diz_lang_resend->unset_remove();
    $diz_lang_resend->unset_search();
    $diz_lang_resend->unset_pagination();
    $diz_lang_resend->unset_limitlist();
    $diz_lang_resend->unset_print();
    $diz_lang_resend->unset_csv();
    $diz_lang_resend->unset_numbers();  
    $diz_lang_resend->hide_button('save_new');   