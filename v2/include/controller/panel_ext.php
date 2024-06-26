<?php
    $xcrud->table('hospitality_pannelli_esterni');
    $xcrud->where('hospitality_pannelli_esterni.idsito', IDSITO);

    $xcrud->order_by('idpannello','DESC');

    $xcrud->pass_var('idsito',IDSITO);


    $xcrud->columns('font_awesome,ico_image,nome_pannello,url,method,target'); 
    $xcrud->fields('font_awesome,ico_image,nome_pannello,url,campo_1,valore_1,campo_2,valore_2,campo_3,valore_3,campo_4,valore_4,campo_5,valore_5,method,target');
    $xcrud->change_type('ico_image', 'image', '', array('path' => BASE_PATH_SITO."uploads/".IDSITO.'/','url' => BASE_URL_SITO.'uploads/'.IDSITO.'/'));

    $xcrud->label('campo_1','Nome del primo campo');
    $xcrud->label('valore_1','Valore del primo campo');
    $xcrud->label('campo_2','Nome del secondo campo');
    $xcrud->label('valore_2','Valore del secondo campo');
    $xcrud->label('campo_3','Nome del terzo campo');
    $xcrud->label('valore_3','Valore del terzo campo');
    $xcrud->label('campo_4','Nome del quarto campo');
    $xcrud->label('valore_4','Valore del quarto campo');
    $xcrud->label('campo_5','Nome del quinto campo');
    $xcrud->label('valore_5','Valore del quinto campo');
    $xcrud->label('font_awesome','Icona font Awesome');

    $xcrud->set_attr('font_awesome',array('placeholder' => 'fa fa-quora'));
    $xcrud->set_attr('url',array('placeholder' => 'http://www.nomedominio.it/login'));
    $xcrud->set_attr('campo_1',array('placeholder' => 'username'));
    $xcrud->set_attr('campo_2',array('placeholder' => 'password'));


    $xcrud->unset_title(true);
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->hide_button('save_new');  