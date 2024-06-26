<?php
    $xcrud_suiteweb = Xcrud::get_instance();
    $xcrud_suiteweb->connection(DB_SUITEWEB_USER,DB_SUITEWEB_PASSWORD,DB_SUITEWEB_NAME,DB_SUITEWEB_HOST);
    $xcrud_suiteweb->table('siti');
    $xcrud_suiteweb->where('siti.idsito = ', IDSITO);



    $xcrud_suiteweb->columns('siti.abilita_mappa', false);          
         
    $xcrud_suiteweb->fields('siti.abilita_mappa', false);
                  
    $xcrud_suiteweb->change_type('siti.abilita_mappa','bool');
    $xcrud_suiteweb->unset_title(true);
    $xcrud_suiteweb->unset_add();
    $xcrud_suiteweb->unset_view();
    $xcrud_suiteweb->unset_csv();
    $xcrud_suiteweb->unset_remove();
    $xcrud_suiteweb->unset_print();
    $xcrud_suiteweb->unset_numbers(); 
    $xcrud_suiteweb->unset_search();
    $xcrud_suiteweb->unset_pagination();
    $xcrud_suiteweb->unset_limitlist();
    $xcrud_suiteweb->hide_button('return');  


#################################################################
