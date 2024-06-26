<?php
    $xcrud_suiteweb->table('comunicazioni');
    $xcrud_suiteweb->where('Visibile', '1');
    $xcrud_suiteweb->order_by('Id','DESC');    
  
    $xcrud_suiteweb->columns('DataInizio,DataFine,Titolo,Testo', false);
    $xcrud_suiteweb->modal('Testo');         
    $xcrud_suiteweb->column_cut(100,'Titolo');
    
   /* $xcrud_suiteweb->column_pattern('DataInizio' , '<small>{value}</small>');
    $xcrud_suiteweb->column_pattern('DataFine' , '<small>{value}</small>');
    $xcrud_suiteweb->column_pattern('Titolo' , '<small>{value}</small>');
    $xcrud_suiteweb->column_pattern('Testo' , '<small>{value}</small>');*/

    $xcrud_suiteweb->label('DataInizio', 'Pubblicato dal');
    $xcrud_suiteweb->label('DataFine', 'Al'); 
    $xcrud_suiteweb->label('Titolo', 'Titolo'); 
    $xcrud_suiteweb->label('Testo', 'Comunicazione');  
        
    $xcrud_suiteweb->column_callback('DataFine','comunicazione_scaduta');

    $xcrud_suiteweb->unset_title(true);
    $xcrud_suiteweb->unset_view();
    $xcrud_suiteweb->unset_remove();  
    $xcrud_suiteweb->unset_add();
    $xcrud_suiteweb->unset_edit();
    $xcrud_suiteweb->unset_print();
    $xcrud_suiteweb->unset_csv();
    $xcrud_suiteweb->unset_numbers(); 
    $xcrud_suiteweb->unset_search();
    $xcrud_suiteweb->hide_button('save_new');
    $xcrud_suiteweb->hide_button('save_edit');
    $xcrud_suiteweb->limit(20);  
    $xcrud_suiteweb->limit_list('20,40,80,all'); 
