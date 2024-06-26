<?php
    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_politiche');
    $xcrud->where('hospitality_politiche.idsito', IDSITO);

    $xcrud->pass_var('idsito',IDSITO);
    $xcrud->pass_var('Lingua','it');

    $xcrud->columns('etichetta,Testi presenti,tipo');
    $xcrud->fields('etichetta,tipo');
    $valori_tipo  = array('0' => 'Preventivi, conferme e prenotazioni','1' => 'Voucher');
    $xcrud->change_type('tipo','select','',$valori_tipo);

    $xcrud->label('etichetta','Nome');

    $xcrud->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_politiche_lingua WHERE id_politiche = {id}');
    $xcrud->column_callback('Testi presenti','show_flags');

    $xcrud->unset_title(true);
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->hide_button('save_new'); 
   

    /* GESTIONE TABELLA TESTI */
    $diz_lang = $xcrud->nested_table('Gestione testi in lingua','id','hospitality_politiche_lingua','id_politiche');

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
    $diz_lang->columns('Lingua,testo');
    $diz_lang->fields('Lingua,testo');
    $diz_lang->label('testo','Testo');

    $diz_lang->column_callback('Lingua','show_flags');
    $diz_lang->field_callback('testo','textarea_doc');
    $diz_lang->validation_required('Lingua');
    $diz_lang->validation_required('testo',2);

    $diz_lang->unset_csv();
    $diz_lang->unset_print();
    $diz_lang->unset_title();
    $diz_lang->unset_numbers(); 
    $diz_lang->hide_button('save_new');    


        