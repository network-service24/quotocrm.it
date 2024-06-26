<?php
    
    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_simplebooking');
    $xcrud->where('hospitality_simplebooking.idsito', IDSITO);

    $xcrud->pass_var('idsito',IDSITO); 

    $xcrud->columns('IdHotel,UserHotel,PasswordHotel,UserProvider,PasswordProvider', false);
    $xcrud->fields('IdHotel,UserHotel,PasswordHotel,UserProvider,PasswordProvider', false);

    $xcrud->label(array('IdHotel' => 'ID Hotel','UserHotel' => 'User Name Hotel','PasswordHotel' => 'Password Hotel','UserProvider' => 'User Name Provider','PasswordProvider' => 'Password Provider'));

    $xcrud->create_action('Attiva', 'abilita_simplebooking'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_simplebooking');
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

    
    $db->query("SELECT * FROM hospitality_simplebooking WHERE idsito = ".IDSITO );
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
    
