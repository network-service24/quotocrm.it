<?php
    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_dizionario');
    $xcrud->join('id','hospitality_dizionario_lingua','id_dizionario');
    $xcrud->where('hospitality_dizionario_lingua.idsito', IDSITO);
    $xcrud->where('hospitality_dizionario_lingua.Lingua', 'it');
    $xcrud->where('hospitality_dizionario.idsito', IDSITO);

    $xcrud->pass_var('idsito',IDSITO);

    $xcrud->pass_var('Lingua','it');

    $xcrud->columns('hospitality_dizionario_lingua.testo,etichetta,Testi presenti');
    $xcrud->fields('hospitality_dizionario_lingua.testo,etichetta');

    $xcrud->no_editor('hospitality_dizionario_lingua.testo');

    $xcrud->column_callback('etichetta','change_value');
    $xcrud->field_callback('etichetta','change_value');

    $xcrud->label('etichetta','Variabile [Template]');
    $xcrud->label('hospitality_dizionario_lingua.testo','Etichetta [Italiano]');

    $xcrud->disabled('etichetta');
    $xcrud->readonly('hospitality_dizionario_lingua.testo');

    $xcrud->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
   $xcrud->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = {id}');
   $xcrud->column_callback('Testi presenti','show_flags');

    $xcrud->unset_title(true);
    $xcrud->unset_add();
    $xcrud->unset_remove();
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->limit(100);
    $xcrud->limit_list('100,150,all');
    $xcrud->hide_button('save_edit'); 
    $xcrud->hide_button('save_return'); 
    $xcrud->hide_button('save_new');    

    /* GESTIONE TABELLA TESTI */
    $diz_lang = $xcrud->nested_table('Gestione testi in lingua','id','hospitality_dizionario_lingua','id_dizionario');
    $diz_lang->relation('Lingua','hospitality_lingue','Sigla','Sigla','idsito='.IDSITO);

    $diz_lang->pass_var('idsito',IDSITO);

    $diz_lang->columns('Lingua,testo');
    $diz_lang->fields('Lingua,testo');

    $diz_lang->column_callback('Lingua','show_flags');    
    $diz_lang->field_callback('testo','textarea_input');   

    $diz_lang->label('testo','Traduzione');

    $diz_lang->validation_required('Lingua');
    $diz_lang->validation_required('testo',2);

    $diz_lang->unset_add();

    $diz_lang->unset_remove();
    $diz_lang->unset_csv();
    $diz_lang->unset_print();
    $diz_lang->unset_title();
    $diz_lang->unset_numbers(); 
    $diz_lang->hide_button('save_new');    


