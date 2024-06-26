<?php

    $xcrud_suiteweb = Xcrud::get_instance();
    $xcrud_suiteweb->connection(DB_SUITEWEB_USER,DB_SUITEWEB_PASSWORD,DB_SUITEWEB_NAME,DB_SUITEWEB_HOST);
    $xcrud_suiteweb->table('siti');
    $xcrud_suiteweb->where('siti.idsito = ', IDSITO);

    $xcrud_suiteweb->columns('siti.API_hospitality', false);
    $xcrud_suiteweb->label('siti.API_hospitality','Il cliente usa le API di Quoto');
    $xcrud_suiteweb->fields('API_hospitality', false);
                                
    $xcrud_suiteweb->change_type('siti.API_hospitality','bool');

    $xcrud_suiteweb->unset_title(true);
    $xcrud_suiteweb->unset_add();
    $xcrud_suiteweb->unset_csv();
    $xcrud_suiteweb->unset_view();
    $xcrud_suiteweb->unset_numbers();
    $xcrud_suiteweb->unset_remove();
    $xcrud_suiteweb->unset_print();
    $xcrud_suiteweb->hide_button('return'); 
    $xcrud_suiteweb->hide_button('save_edit'); 
    $xcrud_suiteweb->hide_button('save_new');

    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_lingue_form');
    $xcrud->where('hospitality_lingue_form.idsito =',IDSITO);

    $xcrud->order_by('codlingua','DESC');

    $xcrud->columns('codlingua');

    $xcrud->column_callback('codlingua','show_flags');

    $xcrud->pass_var('idsito', IDSITO);

    $qy     = $db->query('SELECT * FROM hospitality_lista_lingue  ORDER BY id_lang ASC');
    $rows   = $db->result($qy);
    $lingue = array();
        foreach($rows as $key => $value) {

                $sel = $db->query('SELECT codlingua FROM hospitality_lingue_form  WHERE hospitality_lingue_form.idsito = '.IDSITO.' AND hospitality_lingue_form.codlingua ="'.$value['codice'].'"');
                $rs  = sizeof($db->result($sel));
                if($rs==1){
                    array_remove_item($lingue,$value['codice']);
                }else{
                    $lingue[$value['codice']] = $value['lingua'];
                }


        }

    $xcrud->change_type('codlingua','select','',$lingue);

    $xcrud->label('id','ID Lingua');
    $xcrud->label('codlingua','Lingua Assegnata');

    $xcrud->fields('codlingua');

    //$xcrud->button('javascript:;','Elimina Lingua','glyphicon glyphicon-remove text-white','btn-danger',array('onClick'=>'if(confirm("Cancellare questo Lingua?"))del_lang("'.IDSITO.'","{id}","{codlingua}")'));
    
    $xcrud->unset_title();
    //$xcrud->unset_remove();
    $xcrud->unset_edit();
    $xcrud->unset_numbers();
    $xcrud->unset_search();
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_view();
    $xcrud->hide_button('save_new');

