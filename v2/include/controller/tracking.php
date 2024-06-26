<?php
    
    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_tracking');
    $xcrud->where('hospitality_tracking.idsito', IDSITO);

    $xcrud->pass_var('idsito',IDSITO); 

    $xcrud->columns('Analytics,TagManager,FbTrackingCode,AbilitaAnalytics,AbilitaTagManager,AbilitaFbTrackingCode', false);
    $xcrud->fields('Analytics,TagManager,FbTrackingCode,AbilitaAnalytics,AbilitaTagManager,AbilitaFbTrackingCode', false);

    $xcrud->change_type('AbilitaAnalytics','bool');
    $xcrud->change_type('AbilitaTagManager','bool');
    $xcrud->change_type('AbilitaFbTrackingCode','bool');

    $xcrud->label(array('Analytics' => 'Google Analytics',
                        'TagManager' => 'Google TAG Manager',
                        'FbTrackingCode' => 'Facebook Tracking Code',
                        'AbilitaAnalytics' => 'Attiva Tracciamento Analitycs',
                        'AbilitaTagManager' => 'Attiva Tracciamento Tag Manager',
                        'AbilitaFbTrackingCode' => 'Attiva Tracciamento Facebook'));

    $xcrud->create_action('Attiva_Analytics', 'abilita_Analytics'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva_Analytics', 'disabilita_Analytics');
    $xcrud->button('#', 'Disabilita Analyics', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'Disattiva_Analytics',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'AbilitaAnalytics',
            '=',
            '1')
    );
    $xcrud->button('#', 'Abilita Analyics', 'icon-checkmark glyphicon glyphicon-remove', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'Attiva_Analytics',
        'data-primary' => '{Id}'), array(
        'AbilitaAnalytics',
        '!=',
        '1')); 

    $xcrud->create_action('Attiva_TagManager', 'abilita_TagManager'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva_TagManager', 'disabilita_TagManager');
    $xcrud->button('#', 'Disabilita TagManager', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
            array(  // set action vars to the button
                'data-task' => 'action',
                'data-action' => 'Disattiva_TagManager',
                'data-primary' => '{Id}'),
            array(  // set condition ( when button must be shown)
                'AbilitaTagManager',
                '=',
                '1')
        );
    $xcrud->button('#', 'Abilita TagManager', 'icon-checkmark glyphicon glyphicon-remove', 'xcrud-action', array(
            'data-task' => 'action',
            'data-action' => 'Attiva_TagManager',
            'data-primary' => '{Id}'), array(
            'AbilitaTagManager',
            '!=',
            '1')); 

    $xcrud->create_action('Attiva_FbTrackingCode', 'abilita_FbTrackingCode'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva_FbTrackingCode', 'disabilita_FbTrackingCode');
    $xcrud->button('#', 'Disabilita FbTrackingCode', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
                array(  // set action vars to the button
                    'data-task' => 'action',
                    'data-action' => 'Disattiva_FbTrackingCode',
                    'data-primary' => '{Id}'),
                array(  // set condition ( when button must be shown)
                    'AbilitaFbTrackingCode',
                    '=',
                    '1')
            );
    $xcrud->button('#', 'Abilita FbTrackingCode', 'icon-checkmark glyphicon glyphicon-remove', 'xcrud-action', array(
                'data-task' => 'action',
                'data-action' => 'Attiva_FbTrackingCode',
                'data-primary' => '{Id}'), array(
                'AbilitaFbTrackingCode',
                '!=',
                '1')); 

    
    $db->query("SELECT * FROM hospitality_tracking WHERE idsito = ".IDSITO );
    $r = $db->result();
    $tot = sizeof($r);
    if($tot > 0) {    
        $xcrud->unset_add();
    }
    $xcrud->unset_view();
    $xcrud->unset_remove();
    $xcrud->unset_title(true);
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->hide_button('save_new'); 
    