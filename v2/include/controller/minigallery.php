<?php
    $qy = $db->query("SELECT * FROM hospitality_minigallery WHERE idsito = ".IDSITO);
    $res = $db->result($qy);
    $tot = sizeof($res);

    $xcrud->table('hospitality_minigallery');
    $xcrud->where('hospitality_minigallery.idsito', IDSITO);
    $xcrud->order_by('Id','DESC');


    $xcrud->pass_var('idsito',IDSITO);


    $xcrud->columns('Immagine', false); 
    $xcrud->fields('Immagine', false); 

    $xcrud->change_type('Immagine', 'image', '', array('manual_crop' => true,'ratio' => 2, 'path' => BASE_PATH_SITO."uploads/".IDSITO.'/'));

    if($tot >= 3){
            $xcrud->unset_add();
    }

    $xcrud->limit(3);
    $xcrud->unset_limitlist();
    $xcrud->unset_title(true);
    $xcrud->unset_print();
    $xcrud->unset_search();
    $xcrud->unset_pagination();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->hide_button('save_new');  