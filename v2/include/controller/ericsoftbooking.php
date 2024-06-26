<?php
    
    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_ericsoftbooking');
    $xcrud->where('hospitality_ericsoftbooking.idsito', IDSITO);

    $xcrud->pass_var('idsito',IDSITO); 

    $xcrud->columns('UrlHost,LicenzaId,ProviderCode,ProviderApiKey,PMS,Abilitato', false);
    $xcrud->fields('UrlHost,LicenzaId,ProviderCode,ProviderApiKey,PMS', false);

    $xcrud->change_type('PMS', 'bool');
    $xcrud->change_type('Abilitato', 'bool');

    $xcrud->set_attr('UrlHost', array('placeholder' => 'Inserire Url dell\'EndPoint API, https://booking.ericsoft.com/BookingEngine/'));
    $xcrud->set_attr('UrlHost', array('value' => 'https://booking.ericsoft.com/BookingEngine/'));
    
    $xcrud->label(array(
                        'UrlHost' => 'Url API',
                        'LicenzaId' => 'Licenza',
                        'ProviderCode' => 'Provider Code',
                        'ProviderApiKey' => 'Provider Api Key',
                        'PMS' => 'Abilitato PMS',
                        'Abilitato' => 'Abilitato Booking'
                        ));

    $xcrud->create_action('Attiva', 'abilita_ericsoftbooking'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_ericsoftbooking');
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

    
    $db->query("SELECT * FROM hospitality_ericsoftbooking WHERE idsito = ".IDSITO );
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
    
