<?php
/*     if(FORM_SUL_SITO==1){
        $FormMsg .='<h4 class="text-right"><i class="fa fa-exclamation-circle text-info"></i> <small>Per chi ha integrato nel proprio sito il <b>"form dedicato a QUOTO"</b>, potete utilizzare il flag di visibile/non visibile per la lista dei target!</small></h4>';
    } */
    $xcrud->table('hospitality_target');
    $xcrud->where('hospitality_target.idsito', IDSITO);

    $xcrud->pass_var('idsito',IDSITO);

    $xcrud->columns('Target', false);

    //$xcrud->label('Abilitato_form', 'Target visibile nel form del vs. sito');

    //$xcrud->change_type('Abilitato_form','bool');

    $xcrud->fields('Target', false);

    $xcrud->label('Target', 'Target Cliente');

  /*   $xcrud->create_action('Attiva_form_t', 'abilita_target_form'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva_form_t', 'disabilita_target_form');
    $xcrud->button('#', 'Disabilita vista nel form del vs sito', 'icon-close glyphicon glyphicon-ok text-green', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'Disattiva_form_t',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Abilitato_form',
            '=',
            '1')
    );
    $xcrud->button('#', 'Abilita vista nel form del vs sito', 'icon-checkmark glyphicon glyphicon-remove text-red', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'Attiva_form_t',
        'data-primary' => '{Id}'), array(
        'Abilitato_form',
        '!=',
        '1')); */

    $xcrud->create_action('Attiva', 'abilita_target'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_target');
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
    $xcrud->unset_remove(true,'NS','=','1');
    $xcrud->unset_edit(true,'NS','=','1');
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_search();
    $xcrud->unset_limitlist();
    $xcrud->limit(40);
    $xcrud->unset_numbers();
    $xcrud->hide_button('save_new');
    $xcrud->hide_button('save_edit');
