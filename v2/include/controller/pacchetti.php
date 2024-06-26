<?php

    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_tipo_pacchetto');
    $xcrud->where('hospitality_tipo_pacchetto.idsito', IDSITO);
    //$xcrud->order_by('TipoSoggiorno','ASC');
    $xcrud->order_by('Id','DESC');
    $xcrud->pass_var('idsito',IDSITO);
    $xcrud->pass_var('Lingua','it');

    $xcrud->validation_required('TipoPacchetto',3);

    $xcrud->create_action('Attiva', 'abilita_pacchetto'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_pacchetto');
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

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result()
;    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $xcrud->change_type('Lingua','select','',implode(',',$val));      
    }

    $xcrud->change_type('Abilitato','bool');

    $xcrud->label(array('TipoPacchetto' => 'Proposta/Pacchetto'));
 
    $xcrud->columns('TipoPacchetto, Testi presenti, Abilitato', false);
    $xcrud->fields('TipoPacchetto,Abilitato', false);
    
    // disabilito il titolo - impostato da file tpl
    $xcrud->unset_title(true);
    $xcrud->column_callback('Lingua','show_flags');
    
         /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(lingue," ") SEPARATOR " ") AS lingue FROM hospitality_tipo_pacchetto_lingua WHERE pacchetto_id = {id}');
    $xcrud->column_callback('Testi presenti','show_flags');
   
    $xcrud->unset_title(true);
    //puslante per duplicare
    $xcrud->button('javascript:;','Duplica','icon-checkmark glyphicon glyphicon-plus','',array('onclick' => 'duplicator(\''.BASE_URL_SITO.'duplica_pacchetto/{Id}/\')'));
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->hide_button('save_new'); 
    
    /* GESTIONE TABELLA TESTI */
    $servizi_testo = $xcrud->nested_table('Gestione testi in lingua','id','hospitality_tipo_pacchetto_lingua','pacchetto_id');
    $servizi_testo->columns('lingue,Pacchetto,Descrizione');
    $servizi_testo->fields('lingue,Pacchetto,Descrizione');

    $servizi_testo->label('Pacchetto', 'Proposta/Pacchetto');

    $servizi_testo->column_callback('lingue','show_flags');
    $servizi_testo->relation('lingue','hospitality_lingue','Sigla','Sigla','idsito='.IDSITO);
    $servizi_testo->language('it');
    $servizi_testo->pass_var('idsito',IDSITO); 

    $servizi_testo->no_editor('Descrizione'); 
    $servizi_testo->set_attr('Descrizione',array('style'=>'height:150px'));

    $servizi_testo->validation_required('lingue');
    $servizi_testo->validation_required('Pacchetto',3);

    $servizi_testo->unset_csv();
    $servizi_testo->unset_print();
    $servizi_testo->unset_title();
    $servizi_testo->unset_numbers(); 
    $servizi_testo->hide_button('save_new'); 