<?php


    $xcrud->table('siti');
    $xcrud->where('siti.idsito = ', IDSITO);
    $xcrud->columns('siti.CheckNumberRows', false);       
    $xcrud->fields('siti.CheckNumberRows', false);
   
    $xcrud->label('siti.CheckNumberRows','Limita record in Preventivi ed in Profila ed Esporta');
    $xcrud->change_type('siti.CheckNumberRows','bool');

    $xcrud->unset_title(true);
    $xcrud->unset_add();
    $xcrud->unset_csv();
    $xcrud->unset_remove();
    $xcrud->unset_print();
    $xcrud->hide_button('return');  
    $xcrud->hide_button('save_return');  