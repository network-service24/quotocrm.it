<?php
    
    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_smtp');
    $xcrud->where('hospitality_smtp.idsito', IDSITO);

    $xcrud->pass_var('idsito',IDSITO); 

    $xcrud->columns('SMTPAuth,SMTPHost,SMTPPort,SMTPSecure,SMTPUsername,SMTPPassword,NumberSend, Abilitato', false);
    $xcrud->fields('SMTPAuth,SMTPHost,SMTPPort,SMTPSecure,SMTPUsername,SMTPPassword,NumberSend, Abilitato', false); 

    $xcrud->change_type('NumberSend','select','300','100,200,300,400,500,600,700,800,900,1000');
    $xcrud->change_type('SMTPAuth','select','True','True,False');
    $xcrud->change_type('SMTPPort','select','--','25,465,587');
    $xcrud->change_type('SMTPSecure','select','--',' ,tls,ssl');
    $xcrud->change_type('Abilitato','bool');


    $xcrud->label(array('NumberSend' => 'Numero Invii Settimanali','SMTPAuth' => 'Richiesta Autorizzazione','SMTPHost' => 'Host','SMTPPort' => 'Porta','SMTPSecure' => 'Sicurezza','SMTPUsername' => 'Username','SMTPPassword' => 'Password'));
    
    $xcrud->validation_required('NumberSend');
    $xcrud->validation_required('SMTPHost',3);
    $xcrud->validation_required('SMTPUsername',3);
    $xcrud->validation_required('SMTPPassword',3);
    $xcrud->validation_required('SMTPPort');

    $xcrud->create_action('AttivaSmtp', 'abilita_smtp'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('DisattivaSmtp', 'disabilita_smtp');
    $xcrud->button('#', 'Disabilita', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'DisattivaSmtp',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Abilitato',
            '=',
            '1')
    );
    $xcrud->button('#', 'Abilita', 'icon-checkmark glyphicon glyphicon-remove', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'AttivaSmtp',
        'data-primary' => '{Id}'), array(
        'Abilitato',
        '!=',
        '1')); 

    
    $db->query("SELECT * FROM hospitality_smtp WHERE idsito = ".IDSITO );
    $r = $db->result();
    $tot = sizeof($r);
    if($tot > 0) {    
        $xcrud->unset_add();
    }
    //if(IS_NETWORK_SERVICE_USER != 1){ 
        $xcrud->unset_remove();
    //}
    $xcrud->unset_title(true);
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->hide_button('save_new');