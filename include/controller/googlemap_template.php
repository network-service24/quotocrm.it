<?php
    $xcrud->table('siti');
    $xcrud->where('siti.idsito = ', IDSITO);

    $xcrud->columns('siti.abilita_mappa', false);               
    $xcrud->fields('siti.abilita_mappa', false);
                  
    $xcrud->change_type('siti.abilita_mappa','bool');
    $xcrud->unset_title(true);
    $xcrud->unset_add();
    $xcrud->unset_view();
    $xcrud->unset_csv();
    $xcrud->unset_remove();
    $xcrud->unset_print();
    $xcrud->unset_numbers(); 
    $xcrud->unset_search();
    $xcrud->unset_pagination();
    $xcrud->unset_limitlist();
    $xcrud->hide_button('return');  