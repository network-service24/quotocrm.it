<?php

    $xcrud->table('hospitality_dizionario');
    $xcrud->where('hospitality_dizionario.idsito', IDSITO);
    $xcrud->where('hospitality_dizionario.etichetta = "INFORMATIVA_PRIVACY"');

    $xcrud->pass_var('idsito',IDSITO);

    $xcrud->columns('etichetta,Testi presenti');
    $xcrud->fields('etichetta');

    $xcrud->column_callback('etichetta','change_value');
    $xcrud->field_callback('etichetta','change_value');

    $xcrud->label('etichetta','Variabile');
    $xcrud->disabled('etichetta');

    $xcrud->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
    $xcrud->column_callback('Testi presenti','show_flags');

    $xcrud->table_name('Contenuti per l\'informativa privacy');
    $xcrud->unset_add();
    $xcrud->unset_remove();
    $xcrud->unset_view();
    $xcrud->unset_search();
    $xcrud->unset_pagination();
    $xcrud->unset_limitlist();
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->hide_button('save_new'); 
    $xcrud->hide_button('save_edit'); 
    $xcrud->hide_button('save_return'); 
    $xcrud->hide_button('save_new');


    /* GESTIONE TABELLA TESTI */
    $diz_lang = $xcrud->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $diz_lang->change_type('Lingua','select','',implode(',',$val));      
    }
    $diz_lang->pass_var('idsito',IDSITO);
    $diz_lang->columns('Lingua,testo,data_modifica');
    $diz_lang->fields('Lingua,testo');
    $diz_lang->label('testo','Traduzione');
    $diz_lang->label('data_modifica', 'Data ultima modifica dell\'informativa');

    $diz_lang->column_callback('Lingua','show_flags');
    $diz_lang->field_callback('testo','textarea_input');
    $diz_lang->set_attr('testo',array('style'=>'height:100px'));

    $diz_lang->disabled('Lingua');
    $diz_lang->validation_required('testo',2);

    $diz_lang->after_update('data_modifica');

    $diz_lang->unset_csv();
    $diz_lang->unset_print();
    $diz_lang->unset_title();
    $diz_lang->unset_add();
    $diz_lang->unset_view();
    $diz_lang->unset_remove();
    $diz_lang->unset_search();
    $diz_lang->unset_pagination();
    $diz_lang->unset_limitlist();
    $diz_lang->unset_print();
    $diz_lang->unset_csv();
    $diz_lang->unset_numbers();  
    $diz_lang->hide_button('save_new');   
