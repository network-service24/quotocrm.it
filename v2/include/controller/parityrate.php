<?php

    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_parityrate');
    $xcrud->where('hospitality_parityrate.idsito', IDSITO);

    $xcrud->pass_var('idsito',IDSITO);

    $xcrud->columns('HotelId,UserParity,PasswordParity,UrlApi,ApiKey', false);
    $xcrud->fields('HotelId,UserParity,PasswordParity,UrlApi,ApiKey', false);


    $xcrud->create_action('abilita_parity', 'abilita_parity'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('disabilita_parity', 'disabilita_parity');
    $xcrud->button('#', 'Disabilita', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'disabilita_parity',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Abilitato',
            '=',
            '1')
    );
    $xcrud->button('#', 'Abilita', 'icon-checkmark glyphicon glyphicon-remove', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'abilita_parity',
        'data-primary' => '{Id}'), array(
        'Abilitato',
        '!=',
        '1'));


    $db->query("SELECT * FROM hospitality_parityrate WHERE idsito = ".IDSITO );
    $r = $db->result();
    $tot = sizeof($r);
    if($tot > 0) {
        $xcrud->unset_add();
    }
    $xcrud->unset_title(true);
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers();
    $xcrud->hide_button('save_new');
