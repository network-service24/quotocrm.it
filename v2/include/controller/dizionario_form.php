<?php
    // imposto la tabella e le condizioni
    $xcrud->table('dizionario_form_quoto');
    $xcrud->where('dizionario_form_quoto.idsito', IDSITO);

    $xcrud->pass_var('idsito',IDSITO);

    $xcrud->pass_var('Lingua','it');

    $xcrud->columns('etichetta,Testi presenti');
    $xcrud->fields('etichetta');

    $xcrud->column_callback('etichetta','change_value');
    $xcrud->field_callback('etichetta','change_value');

    $xcrud->label('etichetta','Variabile');
    $xcrud->disabled('etichetta');

    $xcrud->validation_required('etichetta',2);

  /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
   $xcrud->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua," ") SEPARATOR " ") AS lingue FROM dizionario_form_quoto_lingue WHERE id_dizionario = {id}');
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
    $diz_lang = $xcrud->nested_table('Gestione testi in lingua','id','dizionario_form_quoto_lingue','id_dizionario');
    $diz_lang->relation('Lingua','hospitality_lingue','Sigla','Sigla','idsito='.IDSITO);

    $diz_lang->pass_var('idsito',IDSITO);

    $diz_lang->columns('Lingua,testo');
    $diz_lang->fields('Lingua,testo');

    $diz_lang->column_callback('Lingua','show_flags');    
    $diz_lang->field_callback('testo','custom_input');   

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


