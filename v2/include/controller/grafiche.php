<?php
    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_template_landing');
    $xcrud->where('hospitality_template_landing.idsito', IDSITO);
    $xcrud->pass_var('idsito',IDSITO); 


    $xcrud->fields('Template,BackgroundCellLink', false);
    $xcrud->columns('idsito,Directory,Template,BackgroundCellLink', false);

    $xcrud->label('idsito','Preview');
    $xcrud->label('Directory','Sito');
    $xcrud->label('BackgroundCellLink','Colore Identificativo Template');

    $xcrud->column_tooltip('BackgroundCellLink','Il colore identificativo del template, definisce sopra ogni cosa il colore secondario delle email inviate al cliente');
    $xcrud->field_tooltip('BackgroundCellLink','Il colore identificativo del template, definisce sopra ogni cosa il colore secondario delle email inviate al cliente');

    $xcrud->column_callback('idsito','check_screenshot');
    $xcrud->column_pattern('BackgroundCellLink','<span class="badge" style="background-color:{value}">{value}</span>');
    $xcrud->column_pattern('Template','<span style="text-transform:uppercase">{value}</span>');

    $xcrud->relation('Template','hospitality_template_background','TemplateName','TemplateName','idsito='.IDSITO.'  AND TemplateName = "default" OR TemplateName = "smart"','Id ASC');
    $xcrud->relation('BackgroundCellLink','hospitality_template_background','Background','Background','idsito='.IDSITO,'','',' ','','TemplateName','Template');
    
    $xcrud->validation_required('Template',1);
    $xcrud->validation_required('BackgroundCellLink',1);

    $xcrud->unset_title(true);
    $xcrud->unset_add(); 
    $xcrud->unset_remove();
    $xcrud->unset_view();
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->unset_search();
    $xcrud->unset_pagination();
    $xcrud->unset_limitlist();
    $xcrud->hide_button('save_new'); 

    $xcrud_smart = Xcrud::get_instance();
    $xcrud_smart->table('hospitality_template_background');
    $xcrud_smart->where('hospitality_template_background.idsito', IDSITO);
    $xcrud_smart->where('hospitality_template_background.TemplateName = "smart"');

    $xcrud_smart->pass_var('idsito',IDSITO); 

    $xcrud_smart->fields('TemplateName,Font,Background,Pulsante,Immagine,Immagine2', false);
    $xcrud_smart->readonly('TemplateName');
    $xcrud_smart->columns('TemplateName,Font,Background,Pulsante,Immagine,Immagine2', false);

    $xcrud_smart->column_pattern('TemplateName','<span style="text-transform:uppercase">{value}</span>');
    $xcrud_smart->column_pattern('Background','<span class="badge" style="background-color:{value}">{value}</span>');
    $xcrud_smart->column_pattern('Pulsante','<span class="badge" style="background-color:{value}">{value}</span>');

    $xcrud_smart->field_callback('Background','color_selector');
    $xcrud_smart->field_callback('Font','help_font');


    $xcrud_smart->relation('Pulsante','hospitality_template_colori','Pulsante','Pulsante','idsito='.IDSITO,'','','','','Background','Background');


    $xcrud_smart->change_type('Immagine', 'image', '', array('manual_crop' => true,'width' => 800, 'ratio' => 1.6, 'path' => BASE_PATH_ROOT."uploads/".IDSITO.'/'));
    $xcrud_smart->change_type('Immagine2', 'image', '', array('manual_crop' => true,'width' => 1500, 'ratio' => 2, 'path' => BASE_PATH_ROOT."uploads/".IDSITO.'/'));

    $xcrud_smart->label('TemplateName','Nome Template');
    $xcrud_smart->label('Font','Tipo Font Template');
    $xcrud_smart->label('Immagine','Top Immagine Template');
    $xcrud_smart->label('Immagine2','Background Immagine Proposte');
    $xcrud_smart->label('Background','Colore Principale Template');
    $xcrud_smart->label('Pulsante','Colore Pulsanti Template');
    $xcrud_smart->field_tooltip('Pulsante','Associare il colore del pulsante in base al colore principale scelto!');
    $xcrud_smart->set_attr('Pulsante',array('id'=>'pulsante'));

    $xcrud_smart->field_tooltip('Immagine','Inserire una immagine di almeno 800px di larghezza');
    $xcrud_smart->field_tooltip('Immagine2','Inserire una immagine di almeno 1500px di larghezza');

    $xcrud_smart->validation_required('Font',1);
    $xcrud_smart->validation_required('Background',1);
    $xcrud_smart->validation_required('Pulsante',1);

    //$xcrud_smart->table_name ('Configurazione Template SMART','paperino');
    $xcrud_smart->unset_title(true);
    $xcrud_smart->unset_add(); 
    $xcrud_smart->unset_remove();
    $xcrud_smart->unset_view();
    $xcrud_smart->unset_print();
    $xcrud_smart->unset_csv();
    $xcrud_smart->unset_numbers();
    $xcrud_smart->unset_search();
    $xcrud_smart->unset_pagination();
    $xcrud_smart->unset_limitlist(); 
    $xcrud_smart->hide_button('save_new'); 

    $xcrud2 = Xcrud::get_instance();
    $xcrud2->table('hospitality_template_background');
    $xcrud2->where('hospitality_template_background.idsito', IDSITO);
    $xcrud2->where('hospitality_template_background.TemplateName != "default"');
    $xcrud2->where('hospitality_template_background.TemplateName != "smart"');
    $xcrud2->where('hospitality_template_background.TemplateType != "custom4"');
    $xcrud2->where('hospitality_template_background.TemplateType != "custom5"');
    $xcrud2->where('hospitality_template_background.TemplateType != "custom6"');
    $xcrud2->where('hospitality_template_background.TemplateType != "custom7"');
    $xcrud2->where('hospitality_template_background.TemplateType != "custom8"');
    $xcrud2->where('hospitality_template_background.TemplateType != "custom9"');
    $xcrud2->pass_var('idsito',IDSITO); 

    $xcrud2->after_update('update_nome_target_from_template');

    $xcrud2->fields('TemplateName,Font,Background,Pulsante,Immagine,Immagine2', false);

    $xcrud2->columns('TemplateName,Font,Background,Pulsante,Immagine,Immagine2', false);

    $xcrud2->column_pattern('TemplateName','<span style="text-transform:uppercase">{value}</span>');
    $xcrud2->column_pattern('Background','<span class="badge" style="background-color:{value}">{value}</span>');
    $xcrud2->column_pattern('Pulsante','<span class="badge" style="background-color:{value}">{value}</span>');

    $xcrud2->field_callback('Background','color_selector');
    $xcrud2->field_callback('Font','help_font');

    $xcrud2->relation('Pulsante','hospitality_template_colori','Pulsante','Pulsante','idsito='.IDSITO,'','','','','Background','Background');


    $xcrud2->change_type('Immagine', 'image', '', array('manual_crop' => true,'width' => 800, 'ratio' => 1.6, 'path' => BASE_PATH_ROOT."uploads/".IDSITO.'/'));
    $xcrud2->change_type('Immagine2', 'image', '', array('manual_crop' => true,'width' => 1500, 'ratio' => 2, 'path' => BASE_PATH_ROOT."uploads/".IDSITO.'/'));

    $xcrud2->label('TemplateName','Nome Template');
    $xcrud2->label('Font','Tipo Font Template');
    $xcrud2->label('Immagine','Top Immagine Template');
    $xcrud2->label('Immagine2','Background Immagine Proposte');
    $xcrud2->label('Video','Video Template');
    $xcrud2->label('Background','Colore Principale Template');
    $xcrud2->label('Pulsante','Colore Pulsanti Template');
    $xcrud2->field_tooltip('Pulsante','Associare il colore del pulsante in base al colore principale scelto!');
    $xcrud2->set_attr('Pulsante',array('id'=>'pulsante'));

    $xcrud2->field_tooltip('Immagine','Inserire una immagine di almeno 800px di larghezza');
    $xcrud2->field_tooltip('Immagine2','Inserire una immagine di almeno 1500px di larghezza');
    $xcrud2->field_tooltip('Video','Se possedete un canale YouTube:inserire IdVideo, esempio: https://www.youtube.com/watch?v=sH-dI5BkljY&t=5s; IdVideo = sH-dI5BkljY');

    $xcrud2->validation_required('Font',1);
    $xcrud2->validation_required('Background',1);
    $xcrud2->validation_required('Pulsante',1);

    $xcrud2->before_insert('clean_tolower_nome_template');
    $xcrud2->before_update('clean_tolower_nome_template');

    //$xcrud2->table_name ('Configurazione Template SMART','paperino');
    $xcrud2->unset_title(true);
    $xcrud2->unset_add(); 
    $xcrud2->unset_remove();
    $xcrud2->unset_view();
    $xcrud2->unset_print();
    $xcrud2->unset_csv();
    $xcrud2->unset_numbers();
    $xcrud2->unset_search();
    $xcrud2->unset_pagination();
    $xcrud2->unset_limitlist(); 
    $xcrud2->hide_button('save_new'); 