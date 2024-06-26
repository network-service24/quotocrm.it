<?php

    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_fonti_prenotazione');
    $xcrud->where('hospitality_fonti_prenotazione.idsito', IDSITO);

    $xcrud->order_by('FontePrenotazione','ASC');

    $xcrud->columns('FontePrenotazione,Abilitato', false);
    $xcrud->fields('FontePrenotazione,Abilitato', false);

    $xcrud->before_insert('check_fonte');
    $xcrud->before_update('check_fonte');
    $xcrud->column_callback('FontePrenotazione','alert_fonte');

    $xcrud->pass_var('idsito',IDSITO);

    $xcrud->label(array('FontePrenotazione' => 'Fonte Prenotazione'));
    $xcrud->create_action('Attiva', 'abilita_fonti'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_fonti');
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
    $xcrud->change_type('Abilitato','bool');

    $xcrud->validation_required('FontePrenotazione',3);

    $xcrud->unset_title(true);
    if(IS_NETWORK_SERVICE_USER != 1){
        $xcrud->unset_remove(true,'NS','=','1');
    }
    $xcrud->unset_view(true,'NS','=','1');
    $xcrud->unset_edit(true,'NS','=','1');
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers();
    $xcrud->hide_button('save_new');
