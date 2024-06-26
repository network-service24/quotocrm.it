<?php
    $sel = "SELECT * FROM hospitality_boxinfo_checkin_lang WHERE idsito = ".IDSITO;
    $rs  = $db->query($sel);
    $rws = $db->row($rs);
    if(is_array($rws)) {
        if($rws > count($rws))
            $check = count($rws); 
    }else{ 	
        $check = 0;
    }

    $select = "SELECT * FROM hospitality_boxinfo_checkin WHERE idsito = ".IDSITO;
    $res    = $db->query($select);
    $rw     = $db->row($res);
    if(is_array($rw)) {
        if($rw > count($rw))
            $tot = count($rw); 
    }else{ 	
        $tot = 0;
    }
    if($tot == 0){
        $insert = "INSERT INTO hospitality_boxinfo_checkin(idsito,Titolo) VALUES('".IDSITO."','Misure anti COVID-19')";
        $ins    = $db->query($insert);
        $id     = $db->insert_id($ins);
    }else{
        $id = $rw['id'];
    }
    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_boxinfo_checkin');
    $xcrud->where('hospitality_boxinfo_checkin.idsito', IDSITO);

    $xcrud->pass_var('idsito',IDSITO);

    $xcrud->change_type('Abilitato','bool');

    $xcrud->columns('Titolo,Testi presenti, Abilitato');
    $xcrud->fields('Titolo,Abilitato');

    $xcrud->validation_required('Titolo',3);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_boxinfo_checkin_lang WHERE Id_infohotel = {Id}');
    $xcrud->column_callback('Testi presenti','show_flags');


    $xcrud->create_action('Attiva', 'abilita_info_checkin'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_info_checkin');
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


    $xcrud->unset_remove();
    $xcrud->unset_add();
    $xcrud->unset_title(true);
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $evento_lang = $xcrud->nested_table('Gestione testi in lingua','id','hospitality_boxinfo_checkin_lang','Id_infohotel');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $evento_lang->change_type('Lingua','select','',implode(',',$val));      
    }
    $evento_lang->pass_var('idsito',IDSITO);
    $evento_lang->columns('Lingua,Titolo,Descrizione');
    $evento_lang->fields('Lingua,Titolo,Descrizione');

    $evento_lang->column_callback('Lingua','show_flags');
    $evento_lang->field_callback('Descrizione','textarea_doc');

    $evento_lang->relation('lingue','hospitality_lingue','Sigla','Sigla','idsito='.IDSITO);
    $evento_lang->language('it');

    $evento_lang->validation_required('Lingua');
    $evento_lang->validation_required('Titolo',3);

    $evento_lang->unset_csv();
    $evento_lang->unset_print();
    $evento_lang->unset_title();
    $evento_lang->unset_numbers(); 
    $evento_lang->hide_button('save_new');    


        