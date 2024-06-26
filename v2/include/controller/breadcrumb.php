<?php
    $select = "SELECT * FROM hospitality_breadcrumb WHERE idsito = ".IDSITO;
    $res    = $db->query($select);
    $rw     = $db->row($res);
    $tot    = sizeof($rw);
    if($tot == 0){
        $insert = "INSERT INTO hospitality_breadcrumb(idsito,numero) VALUES('".IDSITO."','30')";
        $ins    = $db->query($insert);
        $id     = $db->insert_id($ins);
    }else{
        $id = $rw['Id'];
    }

    $xcrud->table('hospitality_breadcrumb');
    $xcrud->where('hospitality_breadcrumb.idsito', IDSITO);                    

    $xcrud->pass_var('idsito',IDSITO);

    $xcrud->columns('numero', false);
    $xcrud->fields('numero', false);

    $xcrud->label('numero', 'Numero di partenza per la paginazione');

    $xcrud->change_type('numero','select','15','15,30,45,60,90,120');


    $xcrud->table_name('<small>Abilita invio automatico</small>');
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