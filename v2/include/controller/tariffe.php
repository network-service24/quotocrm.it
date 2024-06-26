<?php
    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_condizioni_tariffe');
    $xcrud->where('hospitality_condizioni_tariffe.idsito', IDSITO);

    $xcrud->pass_var('idsito',IDSITO);
    $xcrud->pass_var('Lingua','it');

    $xcrud->columns('etichetta,Testi presenti');
    $xcrud->fields('etichetta');

    $xcrud->label('etichetta','Tipologia Tariffa');

    $xcrud->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_condizioni_tariffe_lingua WHERE id_tariffe = {id}');
    $xcrud->column_callback('Testi presenti','show_flags');

    $xcrud->unset_title(true);

    //puslante per duplicare
    $xcrud->button('javascript:;','Duplica','icon-checkmark glyphicon glyphicon-plus','',array('data-toogle'=>'tooltip','onclick' => 'duplicator(\''.BASE_URL_SITO.'duplica_tariffa/{id}/\')'));

    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->hide_button('save_new'); 
   

    /* GESTIONE TABELLA TESTI */
    $diz_lang = $xcrud->nested_table('Gestione testi in lingua','id','hospitality_condizioni_tariffe_lingua','id_tariffe');

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
    $diz_lang->columns('Lingua,tariffa,testo');
    $diz_lang->fields('Lingua,tariffa,testo');
    $diz_lang->label('tariffa','Tariffa');
    $diz_lang->label('testo','Condizioni Tariffa');

    $diz_lang->column_callback('Lingua','show_flags');
    $diz_lang->no_editor('testo'); 
    $diz_lang->set_attr('testo',array('style'=>'height:200px'));

    //$diz_lang->field_callback('testo','textarea_doc');
    $diz_lang->validation_required('Lingua');
    $diz_lang->validation_required('tariffa',2);
    $diz_lang->validation_required('testo',2);

    $diz_lang->unset_csv();
    $diz_lang->unset_print();
    $diz_lang->unset_title();
    $diz_lang->unset_numbers(); 
    $diz_lang->hide_button('save_new');    


        