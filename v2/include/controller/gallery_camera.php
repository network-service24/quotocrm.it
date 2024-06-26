<?php
    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_gallery_camera');
    $xcrud->where('hospitality_gallery_camera.idsito', IDSITO);
    $xcrud->where('IdCamera = ', $_REQUEST['param']);
    $xcrud->order_by('Id','DESC');

    $xcrud->relation('IdCamera','hospitality_tipo_camere','Id','TipoCamere','Id ='.$_REQUEST['param']); 
    $xcrud->pass_var('idsito',IDSITO);
    $xcrud->columns('IdCamera,Foto', false);
    $xcrud->fields('IdCamera,Foto', false);

    $xcrud->pass_default('IdCamera',$_REQUEST['param']);

    $xcrud->label('IdCamera','Camera');

    $xcrud->change_type('Foto', 'image', '', array('manual_crop' => true,'ratio' => 2, 'path' => BASE_PATH_ROOT."uploads/".IDSITO.'/'));

    $xcrud->unset_title(true);
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->hide_button('save_new');  
