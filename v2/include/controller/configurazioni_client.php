<?php

    $xcrud->table('hospitality_configurazioni');
    $xcrud->where('hospitality_configurazioni.idsito', IDSITO);

    $xcrud->pass_var('idsito',IDSITO);

    $xcrud->columns('parametro,descrizione,valore', false);

    $xcrud->change_type('valore','bool');

    $xcrud->column_width('descrizione','40%');
    $xcrud->column_cut(500,'descrizione');

    $xcrud->label('valore','Abilitato');

    $xcrud->column_callback('parametro','descr_parametro_config');

    $xcrud->create_action('Attiva', 'abilita_plugin'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_plugin');
    $xcrud->button('#', 'Disabilita', 'icon-close glyphicon glyphicon-ok text-green', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'Disattiva',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'valore',
            '=',
            '1')
    );
    $xcrud->button('#', 'Abilita', 'icon-checkmark glyphicon glyphicon-remove text-red', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'Attiva',
        'data-primary' => '{Id}'), array(
        'valore',
        '!=',
        '1'));


    $xcrud->table_name('<small>Configura alcuni parametri del software</small>');
    $xcrud->unset_print();

    $xcrud->unset_add();
    $xcrud->unset_remove();
    $xcrud->unset_edit();
    $xcrud->unset_view();
    $xcrud->unset_csv();
    $xcrud->unset_search();
    $xcrud->unset_limitlist();
    $xcrud->unset_pagination();
    $xcrud->unset_numbers();
    $xcrud->hide_button('save_new');
    $xcrud->hide_button('save_edit');
    //$xcrud->hide_button('return');
