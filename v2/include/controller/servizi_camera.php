<?php

    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_servizi_camera');
    $xcrud->where('hospitality_servizi_camera.idsito', IDSITO);
    $xcrud->order_by('Servizio','ASC');
    $xcrud->order_by('Id','DESC');

    $xcrud->pass_var('Abilitato',1);
    $xcrud->pass_var('idsito',IDSITO); 
    $xcrud->pass_var('Lingua','it');

    $xcrud->validation_required('Servizio',2);

    $xcrud->before_insert('clean_servizio');
    $xcrud->before_update('clean_servizio');

    $xcrud->create_action('Attiva', 'abilita'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita');
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

    $xcrud->column_callback('Lingua','show_flags');
    $xcrud->columns('Servizio, Testi presenti, Abilitato', false);
    $xcrud->fields('Servizio', false);
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
     /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(lingue," ") SEPARATOR " ") AS lingue FROM hospitality_servizi_camere_lingua WHERE servizi_id = {id}');
    $xcrud->column_callback('Testi presenti','show_flags');

     // disabilito il titolo - impostato da file tpl
    $xcrud->unset_title(true);
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->limit(25);
    $xcrud->limit_list('30,35,40,all');
    $xcrud->hide_button('save_new'); 
    //puslante per duplicare
    $xcrud->button('javascript:;','Duplica','icon-checkmark glyphicon glyphicon-plus','',array('onclick' => 'duplicator(\''.BASE_URL_SITO.'duplica_servizio/{Id}/\')'));
    /* GESTIONE TABELLA TESTI */
    $servizi_testo = $xcrud->nested_table('Gestione testi in lingua','id','hospitality_servizi_camere_lingua','servizi_id');
    $servizi_testo->column_callback('lingue','show_flags');
    $servizi_testo->relation('lingue','hospitality_lingue','Sigla','Sigla','idsito='.IDSITO);
    $servizi_testo->language('it');
    $servizi_testo->pass_var('idsito',IDSITO); 
    $servizi_testo->columns('lingue,Servizio', false);
    $servizi_testo->fields('lingue,Servizio', false);

    $servizi_testo->validation_required('lingue');
    $servizi_testo->validation_required('Servizio',2);

    $servizi_testo->before_insert('clean_servizio');
    $servizi_testo->before_update('clean_servizio');

    $servizi_testo->unset_csv();
    $servizi_testo->unset_print();
    $servizi_testo->unset_title();
    $servizi_testo->unset_numbers();  
    $servizi_testo->hide_button('save_new');

    