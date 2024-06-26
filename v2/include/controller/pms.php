<?php
    
    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_pms');
    $xcrud->where('hospitality_pms.idsito', IDSITO);

    $xcrud->pass_var('idsito',IDSITO); 

    $xcrud->columns('Pms,UrlHost,Provider,Code', false);
    $xcrud->fields('Pms,UrlHost,Provider,Code', false);
    $xcrud->set_attr('UrlHost',array('value' =>'https://api.hotelcinquestelle.cloud/hotelProxy/'));
    $xcrud->set_attr('Provider',array('value' =>'tokenQuoto0457689134289'));
/** 
 * * con PMS ERICOSFT  

    $xcrud->columns('Pms,UrlHost,Provider,Code,LicenzaId', false);
    $xcrud->fields('Pms,UrlHost,Provider,Code,LicenzaId', false); */

    $xcrud->change_type('Pms','select','--','--,hotelcinquestelle.cloud');

    ##booking.ericsoft.com
    ##oppure (https://booking.ericsoft.com/BookingEngine/...)

    $xcrud->set_attr('UrlHost', array('placeholder' => 'Inserire ulr dell\'EndPoint API, tranne la chiamata finale, esempio: (https://pcsandbox.hotelcinquestelle.cloud/HotelEndpoint/...)'));

    $xcrud->set_attr('LicenzaId', array('placeholder' => 'Solo per il PMS di Ericsoft'));

    $xcrud->label(array('Pms' => 'Gestionale Hotel','UrlHost' => 'Host','Provider' => 'Provider','Code' => 'Codice Hotel o Api Key','LicenzaId' => 'Chiave licenza'));

    $xcrud->create_action('Attiva', 'abilita_pms'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_pms');
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

    
    $db->query("SELECT * FROM hospitality_pms WHERE idsito = ".IDSITO );
    $r = $db->result();
    $tot = sizeof($r);
    if($tot > 0) {    
        $xcrud->unset_add();
    }
    $xcrud->unset_title(true);
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers(); 
    $xcrud->hide_button('save_new'); 
    
    $tipo_pms = check_pms(IDSITO);
    switch($tipo_pms){
        case "hotelcinquestelle.cloud":
            $tipoP = 'C';
        break;
        case "booking.ericsoft.com":
            $tipoP = 'E';
        break;
    } 
    if($tipo_pms != '0' && $tipoP  == 'E'){
        if(check_person_pms(IDSITO) == 0){
            $button = '<h4 class="text-right"><a href="'.BASE_URL_SITO.'get_config_pms/sync/'.$tipoP.'/" class="btn bg-orange btn-xs" id="resynchBtn">Synch PMS</a> <br><small>Sincronizza la prima volta le configurazioni del tuo PMS!</small></h4>';
        }else{
            $button = '<h4 class="text-right"><a href="'.BASE_URL_SITO.'get_config_pms/sync/'.$tipoP.'/" class="btn bg-green btn-xs" id="resynchBtn">Synch PMS</a> <br><small>Ri-sincronizza le configurazioni del tuo PMS!</small></h4>';

        }

    }