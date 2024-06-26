<?php
    
    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_tagmanager');
    $xcrud->where('hospitality_tagmanager.idsito', IDSITO);

    $xcrud->pass_var('idsito',IDSITO); 

    $xcrud->columns('TagManager', false);
    $xcrud->fields('TagManager', false);

    $xcrud->label('TagManager','TAG Manager');

    
    $db->query("SELECT * FROM hospitality_tagmanager WHERE idsito = ".IDSITO );
    $r = $db->result();
    $tot = sizeof($r);
    if($tot > 0) {    
        $xcrud->unset_add();
    }
    $xcrud->unset_title(true);
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->unset_search();
    $xcrud->unset_view(); 
    $xcrud->unset_limitlist();
    $xcrud->hide_button('save_new'); 
    
