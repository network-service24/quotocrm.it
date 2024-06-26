<?
    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_pdi');
    $xcrud->where('hospitality_pdi.idsito', IDSITO);
    $xcrud->order_by('Ordine','ASC');

    $xcrud->pass_var('idsito',IDSITO);  

    $xcrud->change_type('Abilitato','bool');
    $xcrud->change_type('Immagine', 'image', '', array('manual_crop' => true,'width' => 400,'ratio' => 2, 'path' => BASE_PATH_ROOT."uploads/".IDSITO.'/'));

    $xcrud->columns('PuntoInteresse,Immagine,Testi presenti, Abilitato,idsito');
    $xcrud->fields('PuntoInteresse,Immagine,Indirizzo,Coordinate, Abilitato');

    $xcrud->validation_required('PuntoInteresse',3);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_pdi_lang WHERE Id_pdi = {Id}');
    $xcrud->column_callback('Testi presenti','show_flags');

    $xcrud->column_callback('idsito','cambia_ordine_pdi');
    $xcrud->label('idsito','Ordine');


    $xcrud->create_action('Attiva', 'abilita_pdi'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_pdi');
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
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $evento_lang = $xcrud->nested_table('Gestione testi in lingua','id','hospitality_pdi_lang','Id_pdi');

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
    $evento_lang->field_callback('Descrizione','textarea_count');
    $evento_lang->relation('lingue','hospitality_lingue','Sigla','Sigla','idsito='.IDSITO);
    $evento_lang->language('it');

    $evento_lang->validation_required('Lingua');
    $evento_lang->validation_required('Titolo',3);   

    $evento_lang->unset_csv();
    $evento_lang->unset_print();
    $evento_lang->unset_title();
    $evento_lang->unset_numbers(); 
    $evento_lang->hide_button('save_new');    


        