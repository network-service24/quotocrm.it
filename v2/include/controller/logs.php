<?php
    
    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_log_operations');
    $xcrud->where('hospitality_log_operations.idsito', IDSITO);
    $xcrud->order_by('data_ora','DESC');

    $xcrud->columns('id_richiesta,operatore,azione,tabella,data_ora,Ip', false);
    $xcrud->fields('id_richiesta,operatore,azione,tabella,data_ora,Ip', false); 

    $xcrud->column_callback('id_richiesta' , 'from_id_to_numero');

    $xcrud->column_pattern('id_richiesta' , '<small>{value}</small>');
    $xcrud->column_pattern('operatore'    , '<small>{value}</small>');
    $xcrud->column_pattern('azione'       , '<small>{value}</small>');
    $xcrud->column_pattern('tabella'      , '<small>{value}</small>');
    $xcrud->column_pattern('data_ora'     , '<small>{value}</small>');
    $xcrud->column_pattern('Ip'           , '<small>{value}</small>');

    $xcrud->label('id_richiesta' , 'Numero Prev/Conf/Preno');
    $xcrud->label('tabella'      , 'Tabella MySql Interessate');
    $xcrud->label('data_ora'     , 'Data Operazione');
    $xcrud->label('Ip'           , 'Ip di Provenienza');

    $xcrud->unset_add();
    $xcrud->unset_edit();
    $xcrud->unset_view();
    $xcrud->unset_remove();
    $xcrud->unset_title(true);
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->limit(20);
    $xcrud->limit_list(array('40', '80', '200', 'all'));

