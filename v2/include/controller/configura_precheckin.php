<?php
    $select = "SELECT * FROM hospitality_giorni_precheckin WHERE idsito = ".IDSITO;
    $res    = $db->query($select);
    $rw     = $db->row($res);
    if(is_array($rw)) {
        if($rw > count($rw))
            $tot = count($rw); 
    }else{ 	
        $tot = 0;
    }
    if($tot == 0){
        $insert = "INSERT INTO hospitality_giorni_precheckin(idsito) VALUES('".IDSITO."')";
        $ins    = $db->query($insert);
        $id     = $db->insert_id($ins);
    }else{
        $id = $rw['id'];
    }

    $xcrud->table('hospitality_giorni_precheckin');
    $xcrud->where('hospitality_giorni_precheckin.idsito', IDSITO);                    

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
    $xcrud2->table('hospitality_giorni_precheckin');
    $xcrud2->where('hospitality_giorni_precheckin.idsito', IDSITO);                    

    $xcrud2->pass_var('idsito',IDSITO);

    $xcrud2->columns('numero_giorni', false);
    $xcrud2->fields('numero_giorni', false);

    $xcrud2->change_type('numero_giorni','select','','0,1,2,3,4,5');

    $xcrud2->table_name('<small>Scegliere quanti  giorni prima del Check-In deve partire automaticamente l\'email di Avviso informazioni generiche</small>');
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

    $xcrud3 = Xcrud::get_instance();
    $xcrud3->table('hospitality_precheckin');
    $xcrud3->where('hospitality_precheckin.idsito', IDSITO);
    $xcrud3->order_by('id', 'DESC');

    $xcrud3->pass_var('idsito',IDSITO);
    $xcrud3->pass_var('Lingua','it');

    $xcrud3->columns('etichetta,Testi presenti,abilitato');
    $xcrud3->column_callback('abilitato','invio_si_no');
    $xcrud3->fields('etichetta');

    $xcrud3->label('etichetta','Nome');

    $xcrud3->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud3->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_precheckin_lingua WHERE id_precheckin = {id}');
    $xcrud3->column_callback('Testi presenti','show_flags');


    $xcrud3->create_action('Attiva', 'abilita_txt_precheckin'); // action callback, function publish_action() in functions.php
    $xcrud3->create_action('Disattiva', 'disabilita_txt_precheckin');
    $xcrud3->button('#', 'Disabilita', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'Disattiva',
            'data-primary' => '{id}'),
        array(  // set condition ( when button must be shown)
            'abilitato',
            '=',
            '1')
    );
    $xcrud3->button('#', 'Abilita', 'icon-checkmark glyphicon glyphicon-remove', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'Attiva',
        'data-primary' => '{id}'), array(
        'abilitato',
        '!=',
        '1'));  

    $xcrud3->unset_sortable();
    $xcrud3->unset_title(true);
    $xcrud3->unset_print();
    $xcrud3->unset_csv();
    $xcrud3->unset_numbers(); 
    $xcrud3->hide_button('save_new'); 
   

    /* GESTIONE TABELLA TESTI */
    $diz_lang = $xcrud3->nested_table('Gestione testi in lingua','id','hospitality_precheckin_lingua','id_precheckin');

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
    $diz_lang->columns('Lingua,oggetto,testo');
    $diz_lang->fields('Lingua,oggetto,testo');
    $diz_lang->label('testo','Testo');

    $diz_lang->column_callback('Lingua','show_flags');
    $diz_lang->field_callback('testo','textarea_img');
    $diz_lang->validation_required('Lingua');
    $diz_lang->validation_required('oggetto',2);
    $diz_lang->validation_required('testo',2);

    $diz_lang->unset_csv();
    $diz_lang->unset_print();
    $diz_lang->unset_title();
    $diz_lang->unset_numbers(); 
    $diz_lang->hide_button('save_new');    