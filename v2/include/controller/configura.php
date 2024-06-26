<?php
/*
    $select = "SELECT * FROM hospitality_invio_questionario WHERE idsito = ".IDSITO;
    $res    = $db->query($select);
    $rw     = $db->row($res);
    $tot    = sizeof($rw);
    if($tot == 0){
        $insert = "INSERT INTO hospitality_invio_questionario(idsito) VALUES('".IDSITO."')";
        $ins    = $db->query($insert);
        $id     = $db->insert_id($ins);
    }else{
        $id = $rw['id'];
    }

    $xcrud->table('hospitality_invio_questionario');
    $xcrud->where('hospitality_invio_questionario.idsito', IDSITO);                    

    $xcrud->pass_var('idsito',IDSITO);

    $xcrud->columns('invio_automatico', false);
    $xcrud->fields('invio_automatico', false);

    $xcrud->change_type('invio_automatico','radio','',array('values' => array(1 => 'Si', 0 => 'No')));

  
    $xcrud->unset_title(true);
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
*/
