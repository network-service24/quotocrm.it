<?php

    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_tipo_voucher_cancellazione');
    $xcrud->where('hospitality_tipo_voucher_cancellazione.idsito', IDSITO);
    $xcrud->order_by('Id','DESC');
    $xcrud->pass_var('idsito',IDSITO);
    $xcrud->pass_var('Lingua','it');

    $xcrud->validation_required('Motivazione',3);

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

    //$xcrud->label('DataValidita', 'Data di Validità utile per lo short tag nel contenuto email');

    $xcrud->columns('Motivazione, Testi presenti,  Abilitato', false);

    $xcrud->fields('Motivazione,Abilitato', false);

         /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(lingue," ") SEPARATOR " ") AS lingue FROM hospitality_tipo_voucher_cancellazione_lingua WHERE motivazione_id = {id}');
    
    $xcrud->column_callback('Testi presenti','show_flags');



    $xcrud->create_action('Attiva', 'abilita_motivazione'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_motivazione');
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
    $servizi_testo = $xcrud->nested_table('Gestione testi in lingua','Id','hospitality_tipo_voucher_cancellazione_lingua','motivazione_id');

    $servizi_testo->columns('lingue,Motivazione,Oggetto,Descrizione');

    $servizi_testo->fields('lingue,Motivazione,Oggetto,Descrizione');

    $servizi_testo->label('Descrizione','Contenuto email');
    
    $servizi_testo->label('Oggetto','Oggetto email');

    $servizi_testo->column_callback('lingue','show_flags');

    $servizi_testo->field_callback('Oggetto','oggetto_motivazioni');

    $servizi_testo->field_callback('Descrizione','textarea_motivazioni');

    $servizi_testo->relation('lingue','hospitality_lingue','Sigla','Sigla','idsito='.IDSITO);

    $servizi_testo->pass_var('idsito',IDSITO);

    $servizi_testo->validation_required('lingue');
    $servizi_testo->validation_required('Motivazione',3);

    $servizi_testo->unset_csv();
    $servizi_testo->unset_print();
    $servizi_testo->unset_title();
    $servizi_testo->unset_numbers();
    $servizi_testo->hide_button('save_new');

