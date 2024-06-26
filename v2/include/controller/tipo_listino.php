<?php
    //inserimento ACAMERA in tipologia listino per tutte le camere
    $select = "SELECT * FROM hospitality_tipo_listino WHERE idsito = ".IDSITO;
    $res    = $db->query($select);
    $rw     = $db->row($res);
    if(is_array($rw)) {
        if($rw > count($rw)) // se la pagina richiesta non esiste
            $tot = count($rw); // restituire la pagina con il numero più alto che esista
    }else{
        $tot = 0;
    }
    if($tot == 0){
        $insert = "INSERT INTO hospitality_tipo_listino(idsito,TipoListino) VALUES('".IDSITO."','0')";
        $ins    = $db->query($insert);
        $id     = $db->insert_id($ins);
    }else{
        $id = $rw['Id'];
    }

    $xcrud->table('hospitality_tipo_listino');
    $xcrud->where('hospitality_tipo_listino.idsito', IDSITO);

    $xcrud->columns('TipoListino');
    $xcrud->fields('TipoListino');

    $xcrud->column_callback('TipoListino', 'block_value_parity');

    $xcrud->column_tooltip('TipoListino', 'ATTENZIONE se impostate il listino a Persona, il prezzo inserito verrà moltiplicato solo per il numero di adulti');
    $xcrud->field_tooltip('TipoListino', 'ATTENZIONE se impostate il listino a Persona, il prezzo inserito verrà moltiplicato solo per il numero di adulti');

    $xcrud->pass_var('idsito',IDSITO);
    $val = array('0' => 'a camera', '1' => 'a persona');
    $xcrud->change_type('TipoListino','select','0',$val);

    $xcrud->set_attr('TipoListino',array('id'=>'tipo_listino'));

    $xcrud->label('TipoListino', 'Tipologia Prezzi');

    $xcrud->validation_required('TipoListino');

    $xcrud->table_name('Scegliere la tipologia di prezzo se applicabile a camera oppure a persona');
    $xcrud->unset_print();
    $xcrud->unset_add();
    $xcrud->unset_remove();
    $xcrud->unset_view();
    $xcrud->unset_csv();
    $xcrud->unset_search();
    $xcrud->unset_limitlist();
    $xcrud->unset_pagination();
    $xcrud->unset_numbers();
    $xcrud->hide_button('save_new');
    $xcrud->hide_button('save_edit');
    $xcrud->hide_button('return');

    $legenda = '<div id="LEGEND" class="alert alert-success">
                    <i class="fa fa-exclamation-triangle text-white fa-2x fa-fw" aria-hidden="true"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <b>ATTENZIONE:</b>
                    <ul>
                        <li>l\'impostazione della tipologia dei prezzi, ha <b>valore per tutti i listini</b> creati</li>
                        <li>se impostate il listino <b>a Persona</b>, il calcolo del prezzo verrà moltiplicato <b>SOLO per il numero di adulti</b> ed il numero di notti.</li>
                        <li>se impostate il listino <b>a Camera</b>, il calcolo del prezzo verrà moltiplicato per il numero di camere ed il numero di notti.</li>
                        <!--                         
                        <li>
                            Il listino è un applicativo basico per QUOTO, perchè i calcoli siano correto dovrebbe essere impostato in maniera molto semplice<br>
                            ESEMPIO: <br>
                            Camera X dal 1/6 al 1/9 euro 20,00<br>
                            Camera Y dal 1/6 al 1/9 euro 30,00<br>
                            Camera Z dal 1/6 al 1/9 euro 40,00<br>
                            ecc.<br>
                            (i calcoli a cavallo di tempo non vengono eseguiti)
                        </li> 
                        -->
                    </ul>
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#LEGEND").insertBefore("#tipo_listino");
                    })
                </script>'."\r\n";

    $TipoListino = Xcrud::get_instance();
    $TipoListino->table('hospitality_numero_listini');
    $TipoListino->where('hospitality_numero_listini.idsito', IDSITO);

    $TipoListino->columns('Listino,Abilitato');
    $TipoListino->fields('Listino');

    $TipoListino->pass_var('idsito',IDSITO);

    $TipoListino->label('Listino', 'Tipologia Listino');

    $TipoListino->validation_required('Listino');

    $TipoListino->create_action('Attiva', 'abilita_Nlistino'); // action callback, function publish_action() in functions.php
    $TipoListino->create_action('Disattiva', 'disabilita_Nlistino');
    $TipoListino->button('#', 'Disabilita', 'icon-close glyphicon glyphicon-ok text-green', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'Disattiva',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Abilitato',
            '=',
            '1')
    );
    $TipoListino->button('#', 'Abilita', 'icon-checkmark glyphicon glyphicon-remove text-red', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'Attiva',
        'data-primary' => '{Id}'), array(
        'Abilitato',
        '!=',
        '1'));

    $TipoListino->column_callback('Abilitato','listino_si_no');

    $TipoListino->table_name('Inserire il nome del Listino');
    $TipoListino->unset_print();
    //$TipoListino->unset_add();

    $TipoListino->unset_remove();
    $TipoListino->unset_edit(true,'Parity','=','1');
    $TipoListino->button('javascript:validator(\''.BASE_URL_SITO.'delete_listino/{id}/\');','Elimina Listino','glyphicon glyphicon-remove','btn btn-default btn-sm bg-red',array('data-toogle'=>'tooltip'),array('Parity','!=','1'));
    $TipoListino->unset_view(true,'Parity','=','0');
    $TipoListino->unset_csv();
    $TipoListino->unset_search();
    $TipoListino->unset_limitlist();
    $TipoListino->unset_pagination();
    $TipoListino->unset_numbers();
    $TipoListino->hide_button('save_new');
    //$TipoListino->hide_button('save_edit');
    //$TipoListino->hide_button('return');

    $listino = $TipoListino->nested_table('Gestione Listino','Id','hospitality_listino_camere','IdNumeroListino');
    $listino->where('hospitality_listino_camere.idsito',IDSITO);
    $listino->order_by('hospitality_listino_camere.IdCamera', 'ASC');
    $listino->order_by('hospitality_listino_camere.IdSoggiorno', 'ASC');
    $listino->order_by('hospitality_listino_camere.PeriodoDal', 'ASC');
    $listino->order_by('hospitality_listino_camere.PeriodoAl', 'ASC');
    $listino->relation('IdSoggiorno','hospitality_tipo_soggiorno','Id','TipoSoggiorno','idsito='.IDSITO);
    $listino->relation('IdCamera','hospitality_tipo_camere','Id','TipoCamere','idsito='.IDSITO);

    $listino->columns('IdCamera,IdSoggiorno,PeriodoDal,PeriodoAl,PrezzoCamera');
    $listino->fields('IdCamera,IdSoggiorno,PeriodoDal,PeriodoAl,PrezzoCamera');


    $listino->pass_var('idsito',IDSITO);

    $listino->relation('IdCamera','hospitality_tipo_camere','Id','TipoCamere','idsito='.IDSITO);

    $listino->columns('IdCamera,IdSoggiorno,PeriodoDal,PeriodoAl,PrezzoCamera');
    $listino->fields('IdCamera,IdSoggiorno,PeriodoDal,PeriodoAl,PrezzoCamera');

    $listino->column_callback('PrezzoCamera','format_price');
    $listino->field_callback('PrezzoCamera','campo_prezzo');

    $listino->pass_var('idsito',IDSITO);

    $listino->label('IdSoggiorno', 'Trattamento');
    $listino->label('IdCamera', 'Camera');
    $listino->label('PeriodoDal', 'Periodo Dal');
    $listino->label('PeriodoAl','Periodo Al');
    $listino->label('PrezzoCamera','Prezzo Camera');

    $listino->validation_required('IdSoggiorno');
    $listino->validation_required('IdCamera');
    $listino->validation_required('PeriodoDal');
    $listino->validation_required('PeriodoAl');
    $listino->validation_required('PrezzoCamera');

    $listino->create_action('Attiva', 'abilita_listino'); // action callback, function publish_action() in functions.php
    $listino->create_action('Disattiva', 'disabilita_listino');
    $listino->button('#', 'Disabilita', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'Disattiva',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Abilitato',
            '=',
            '1')
    );
    $listino->button('#', 'Abilita', 'icon-checkmark glyphicon glyphicon-remove', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'Attiva',
        'data-primary' => '{Id}'), array(
        'Abilitato',
        '!=',
        '1'));
    
    $listino->button('javascript:;','Duplica','icon-checkmark glyphicon glyphicon-plus','',array('onclick' => 'duplicator(\''.BASE_URL_SITO.'duplica_listino/{Id}/{IdCamera}/sum/\')','data-toogle'=>'tooltip'),array('RoomId','=',''));

    $listino->unset_csv();
    $listino->unset_view();
    $listino->unset_print();
    $listino->unset_title();
    $listino->unset_numbers();
   // $listino->unset_search();
    $listino->hide_button('save_new');
