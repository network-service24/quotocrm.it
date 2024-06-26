<?php
    $xcrud->table('hospitality_gallery');
    $xcrud->where('hospitality_gallery.idsito', IDSITO);

    $xcrud->order_by('Id','DESC');

    $xcrud->pass_var('idsito',IDSITO);

    $xcrud->change_type('Abilitato','bool');
    $xcrud->columns('Id,idsito', true); // colonne non visibili
    $xcrud->fields('idsito', true); // colonne non visibili

    $xcrud->change_type('Immagine', 'image', '', array('manual_crop' => true,'width' => 800,'ratio' => 2, 'path' => BASE_PATH_ROOT."uploads/".IDSITO.'/'));

    $xcrud->create_action('Attiva', 'abilita_gallery'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_gallery');
    $xcrud->button('#', 'Disabilita', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'Disattiva',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Abilitato',
            '=',
            '1')
    );
    $xcrud->button('#', 'Abilita', 'icon-checkmark glyphicon glyphicon-remove', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'Attiva',
        'data-primary' => '{Id}'), array(
        'Abilitato',
        '!=',
        '1')); 

    $qy = $db->query("SELECT * FROM hospitality_gallery WHERE idsito = ".IDSITO);
    $res = $db->result($qy);
    $tot = sizeof($res);
    if($tot >= 12){
            $xcrud->unset_add();
    }
    $xcrud->limit(12);
    $xcrud->unset_title(true);
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->unset_search();
    $xcrud->unset_pagination();
    $xcrud->hide_button('save_new');  


    $select    = "SELECT * FROM hospitality_tipo_gallery WHERE idsito = ".IDSITO;
    $result    = $db->query($select);
    $check_rec = $db->result($result);
    if(sizeof($check_rec) == 0){
        $insert              = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".IDSITO."','custom1','Family','1')";
        $ins                 = $db->query($insert);
        $IdTipoGalleryFamily = $db->insert_id($ins);
        $insertF             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFamily."','family1.jpg','1')";
        $db->query($insertF);
        $insertF2             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFamily."','family2.jpg','1')";
        $db->query($insertF2);
        $insertF3             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFamily."','family3.jpg','1')";
        $db->query($insertF3);


        $insert2           = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".IDSITO."','custom2','Bike','1')";
        $ins2              = $db->query($insert2);
        $IdTipoGalleryBike = $db->insert_id($ins2);
        $insertB           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBike."','bike1.jpg','1')";
        $db->query($insertB);
        $insertB2           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBike."','bike2.jpg','1')";
        $db->query($insertB2);
        $insertB3           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBike."','bike3.jpg','1')";
        $db->query($insertB3);

        $insert3             = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".IDSITO."','custom3','Romantico','1')";
        $ins                 = $db->query($insert3);
        $IdTipoGalleryRomantico = $db->insert_id($ins3);
        $insertR             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryRomantico."','romantico1.jpg','1')";
        $db->query($insertR);
        $insertR2             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryRomantico."','romantico2.jpg','1')";
        $db->query($insertR2);
        $insertR3             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryRomantico."','romantico3.jpg','1')";
        $db->query($insertR3);
        // COPIA IMMAGINI DEMO
        $srcPath = $_SERVER['DOCUMENT_ROOT'].'/v2/uploads/demo_image/';
        $destPath =  $_SERVER['DOCUMENT_ROOT'].'/v2/uploads/'.IDSITO.'/';  

        $srcDir = opendir($srcPath);
        while($readFile = readdir($srcDir))
        {
            if($readFile == 'family1.jpg' || $readFile == 'family2.jpg' || $readFile == 'family3.jpg')
            {

                if (!file_exists($readFile)) 
                {
                    if(copy($srcPath . $readFile, $destPath . $readFile))
                    {
                        $copia = "Copy file";
                    }
                    else
                    {
                        $copia = "Canot Copy file";
                    }
                }
            }
            if($readFile == 'bike1.jpg' || $readFile == 'bike2.jpg' || $readFile == 'bike3.jpg')
            {

                if (!file_exists($readFile)) 
                {
                    if(copy($srcPath . $readFile, $destPath . $readFile))
                    {
                        $copia = "Copy file";
                    }
                    else
                    {
                        $copia = "Canot Copy file";
                    }
                }
            }
            if($readFile == 'romantico1.jpg' || $readFile == 'romantico2.jpg' || $readFile == 'romantico3.jpg')
            {

                if (!file_exists($readFile)) 
                {
                    if(copy($srcPath . $readFile, $destPath . $readFile))
                    {
                        $copia = "Copy file";
                    }
                    else
                    {
                        $copia = "Canot Copy file";
                    }
                }
            }
        }

        closedir($srcDir);
        // FINE COPIA IMMAGINI
    } 
    $xcrud2 = Xcrud::get_instance();
    $xcrud2->table('hospitality_tipo_gallery');
    $xcrud2->where('hospitality_tipo_gallery.idsito', IDSITO);
    $xcrud2->where("hospitality_tipo_gallery.TargetType != 'custom4'");
    $xcrud2->where("hospitality_tipo_gallery.TargetType != 'custom5'");
    $xcrud2->where("hospitality_tipo_gallery.TargetType != 'custom6'");
    $xcrud2->where("hospitality_tipo_gallery.TargetType != 'custom7'");
    $xcrud2->where("hospitality_tipo_gallery.TargetType != 'custom8'");
    $xcrud2->where("hospitality_tipo_gallery.TargetType != 'custom9'"); 

    $xcrud2->order_by('Id','DESC');

    $xcrud2->pass_var('idsito',IDSITO);

    $xcrud2->after_update('update_nome_template_from_target');

    $xcrud2->change_type('Abilitato','bool');
    $xcrud2->columns('TargetGallery,Immagini presenti', false); // colonne non visibili
    $xcrud2->fields('TargetGallery,Immagini presenti', false); // colonne non visibili
    $xcrud2->label('TargetGallery', 'Target Gallery');

    $xcrud2->before_insert('clean_tolower_nome_gallery');
    $xcrud2->before_update('clean_tolower_nome_gallery');

    $xcrud2->subselect('Immagini presenti','SELECT COUNT(Id) AS numero_foto FROM hospitality_tipo_gallery_target WHERE IdTipoGallery = {Id}');
/* 
    $xcrud2->create_action('AttivaTipo', 'abilita_tipo_gallery'); // action callback, function publish_action() in functions.php
    $xcrud2->create_action('DisattivaTipo', 'disabilita_tipo_gallery');
    $xcrud2->button('#', 'Disabilita', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'DisattivaTipo',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Abilitato',
            '=',
            '1')
    );
    $xcrud2->button('#', 'Abilita', 'icon-checkmark glyphicon glyphicon-remove', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'AttivaTipo',
        'data-primary' => '{Id}'), array(
        'Abilitato',
        '!=',
        '1'));  */

    $xcrud2->unset_title(true);
    $xcrud2->unset_add();
    $xcrud2->unset_view();
    $xcrud2->unset_remove();
    $xcrud2->unset_print();
    $xcrud2->unset_csv();
    $xcrud2->unset_numbers(); 
    $xcrud2->unset_search();
    $xcrud2->unset_pagination();
    $xcrud2->hide_button('save_new');  

    $xcrud3 = $xcrud2->nested_table('Foto','Id','hospitality_tipo_gallery_target','IdTipoGallery');

    $xcrud3->where('hospitality_tipo_gallery_target.idsito', IDSITO);

    $xcrud3->order_by('Id','DESC');

    $xcrud3->pass_var('idsito',IDSITO);

    $xcrud3->change_type('Abilitato','bool');
    $xcrud3->columns('Immagine,Abilitato', false); 
    $xcrud3->fields('Immagine,Abilitato', false);

    $xcrud3->change_type('Immagine', 'image', '', array('manual_crop' => true,'width' => 800,'ratio' => 2, 'path' => BASE_PATH_ROOT."uploads/".IDSITO.'/'));

    $xcrud3->create_action('AttivaGTarget', 'abilita_tipo_gallery_target'); // action callback, function publish_action() in functions.php
    $xcrud3->create_action('DisattivaGTarget', 'disabilita_tipo_gallery_target');
    $xcrud3->button('#', 'Disabilita', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'DisattivaGTarget',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Abilitato',
            '=',
            '1')
    );
    $xcrud3->button('#', 'Abilita', 'icon-checkmark glyphicon glyphicon-remove', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'AttivaGTarget',
        'data-primary' => '{Id}'), array(
        'Abilitato',
        '!=',
        '1'));  

    $qy = $db->query("SELECT * FROM hospitality_tipo_gallery_target WHERE idsito = ".IDSITO);
    $res = $db->result($qy);
    $tot = sizeof($res);
    if($tot >= 36){
            $xcrud3->unset_add();
    }
    $xcrud3->limit(12);
    $xcrud3->unset_title(true);
    $xcrud3->unset_print();
    $xcrud3->unset_csv();
    $xcrud3->unset_numbers(); 
    $xcrud3->unset_search();
    $xcrud3->unset_pagination();
    $xcrud3->hide_button('save_new');  