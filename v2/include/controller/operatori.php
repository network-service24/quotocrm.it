<?php
    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_operatori');
    $xcrud->where('hospitality_operatori.idsito', IDSITO);
    $xcrud->order_by('NomeOperatore','ASC');
    $xcrud->pass_var('idsito',IDSITO);  

    $xcrud->fields('img,NomeOperatore,EmailSegretaria,Abilitato', false);
    $xcrud->columns('img,NomeOperatore,EmailSegretaria,Abilitato', false);

    $xcrud->label(array('NomeOperatore' => 'Nome Operatore','EmailSegretaria' => 'Email Operatore','img' => 'Immagine Operatore'));
 	$xcrud->change_type('Abilitato','bool');

    $xcrud->change_type('img', 'image', '', array('width' => 200, 'height' => 200, 'manual_crop' => true, 'path' => BASE_PATH_ROOT."uploads/".IDSITO.'/'));

    $xcrud->field_tooltip('NomeOperatore','Inserire un Nome univoco, per ogni operatore. Una volta iniziate le attività di QUOTO, non modifcare più il Nome Operatore');
    $xcrud->set_attr('NomeOperatore',array('id'=>'n_op'));
    $xcrud->validation_required('NomeOperatore',3);
    $xcrud->validation_required('EmailSegretaria',3);

    $xcrud->create_action('Attiva', 'abilita_operatore'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_operatore');
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



    $xcrud->unset_title(true);
    $xcrud->unset_remove();
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->hide_button('save_new'); 

    $ajax_complete ="                   
    <script>
        $( document ).ajaxComplete(function() {
            $('#n_op').parent().prepend('<small class=\"text-red\"><b>Attenzione:</b> impostare il Nome Operatore durante la configurazione iniziale di QUOTO e non in corso d\'opera!<br>Se modificate il <b>Nome Operatore</b> durante le attività già in corso, i preventivi e/o le conferme e le prenotazioni chiuse, non avranno più l\'operatore associato!</small>');
        });
    </script>"."\r\n";
