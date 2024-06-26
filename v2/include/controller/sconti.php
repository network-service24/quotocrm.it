<?

    $xcrud2 = Xcrud::get_instance();
    // imposto la tabella e le condizioni
    $xcrud2->table('hospitality_codice_sconto');
    $xcrud2->where('idsito', IDSITO);
    $xcrud2->where("data_fine != ''");

    $xcrud2->pass_var('idsito',IDSITO); 

    $xcrud2->field_callback('cod','cod_input');
    $xcrud2->pass_default('data_inizio',date('Y-m-d H:i:s'));
    $xcrud2->pass_default('data_fine',date('Y-m-d H:i:s'));


    $xcrud2->columns('data_inizio,data_fine,cod,imp_sconto,note', false);// visualizzo solo alcuni campi nella colonne a tabella

    $xcrud2->fields('data_inizio,data_fine,cod,imp_sconto,note ',false);

    $xcrud2->column_pattern('imp_sconto','{value} %');

    $xcrud2->no_editor('note');
    $xcrud2->set_attr('note',array('style' => 'height:200px'));

    $xcrud2->label('cod','Codice di Sconto');
    $xcrud2->label('imp_sconto','Percentuale di Sconto %');
    $xcrud2->label('data_inizio','Data Inizio dello Sconto');
    $xcrud2->label('data_fine','Data Scadenza dello Sconto');


    $xcrud2->table_name('<small>Creare uno sconto per scadenza temporale</small>');
    $xcrud2->unset_csv();
    $xcrud2->unset_print();
    $xcrud2->unset_numbers();
    $xcrud2->unset_search();
    $xcrud2->unset_pagination();
    $xcrud2->unset_limitlist();
    $xcrud2->hide_button('save_new');
    $xcrud2->hide_button('save_edit');

    $xcrud2->stile = '<style>
                        .btn-success:after{
                            content: \' Sconto\';

                        }                   
                    </style>';