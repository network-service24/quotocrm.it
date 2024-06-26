<?php
    
    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_bedzzlebooking');
    $xcrud->where('hospitality_bedzzlebooking.idsito', IDSITO);

    $xcrud->pass_var('idsito',IDSITO); 

    $xcrud->columns('UrlHost,ProxyAuth,VendorAccount,HotelAccount,UrlHostSetting,ProxyAuthSetting,VendorAccountSetting,HotelAccountSetting,PMS,Abilitato', false);
    $xcrud->fields('UrlHost,ProxyAuth,VendorAccount,HotelAccount,UrlHostSetting,ProxyAuthSetting,VendorAccountSetting,HotelAccountSetting,PMS', false);

    $xcrud->change_type('PMS', 'bool');
    $xcrud->change_type('Abilitato', 'bool');

    $xcrud->column_cut(20,'UrlHost,ProxyAuth,VendorAccount,HotelAccount,UrlHostSetting,ProxyAuthSetting,VendorAccountSetting,HotelAccountSetting');
    $xcrud->column_class('ProxyAuth','nowrap');
    $xcrud->column_class('VendorAccount','nowrap');
    $xcrud->column_class('HotelAccount','nowrap');
    $xcrud->column_class('UrlHostSetting','nowrap');
    $xcrud->column_class('ProxyAuthSetting','nowrap');
    $xcrud->column_class('VendorAccountSetting','nowrap');
    $xcrud->column_class('HotelAccountSetting','nowrap');

    $xcrud->set_attr('UrlHost', array('placeholder' => 'Inserire Url dell\'EndPoint, https://connect.bedzzle.com/oapi/v1/'));
    $xcrud->set_attr('ProxyAuth', array('placeholder' => 'Inserire la Key'));
    $xcrud->set_attr('VendorAccount', array('placeholder' => 'Inserire X-API-KEY'));
    $xcrud->set_attr('HotelAccount', array('placeholder' => 'Inserire il propertyId'));
    
    $xcrud->field_tooltip('UrlHost','Questo valore è utile per interrogare il booking Bedzzle in tempo reale','fa fa-life-ring text-orange');
    $xcrud->field_tooltip('ProxyAuth','Questo valore è utile per interrogare il booking Bedzzle in tempo reale','fa fa-life-ring text-orange');
    $xcrud->field_tooltip('VendorAccount','Questo valore è utile per interrogare il booking Bedzzle in tempo reale','fa fa-life-ring text-orange');
    $xcrud->field_tooltip('HotelAccount','Questo valore è utile per interrogare il booking Bedzzle in tempo reale','fa fa-life-ring text-orange');

    $xcrud->set_attr('UrlHostSetting', array('placeholder' => 'Inserire Url dell\'EndPoint, https://connect.bedzzle.com/oapi/v1/'));
    $xcrud->set_attr('ProxyAuthSetting', array('placeholder' => 'Inserire la Key'));
    $xcrud->set_attr('VendorAccountSetting', array('placeholder' => 'Inserire X-API-KEY'));
    $xcrud->set_attr('HotelAccountSetting', array('placeholder' => 'Inserire il propertyId'));

    $xcrud->field_tooltip('UrlHostSetting','Questo valore è utile per sincronizzare le tipologie di Soggiorno e le Camere, sia per il Booking che il PMS!','fa fa-exclamation-triangle text-aqua');
    $xcrud->field_tooltip('ProxyAuthSetting','Questo valore è utile per sincronizzare le tipologie di Soggiorno e le Camere, sia per il Booking che il PMS!','fa fa-exclamation-triangle  text-aqua');
    $xcrud->field_tooltip('VendorAccountSetting','Questo valore è utile per sincronizzare le tipologie di Soggiorno e le Camere, sia per il Booking che il PMS!','fa fa-exclamation-triangle  text-aqua');
    $xcrud->field_tooltip('HotelAccountSetting','Questo valore è utile per sincronizzare le tipologie di Soggiorno e le Camere, sia per il Booking che il PMS!','fa fa-exclamation-triangle  text-aqua');

    $xcrud->field_tooltip('PMS','Questo valore ablita la sincronizzazione con il PMS Bedzzle','fa fa-life-ring text-green');

    $xcrud->validation_required('UrlHost',3);
    $xcrud->validation_required('ProxyAuth',3);
    $xcrud->validation_required('VendorAccount',3);
    $xcrud->validation_required('HotelAccount',3);

    $xcrud->validation_required('UrlHostSetting',3);
    $xcrud->validation_required('ProxyAuthSetting',3);
    $xcrud->validation_required('VendorAccountSetting',3);
    $xcrud->validation_required('HotelAccountSetting',3);

    $xcrud->label(array('UrlHost'              => 'Url API',
                        'ProxyAuth'            => 'Proxy  Auth    (Key)',
                        'VendorAccount'        => 'Vendor Account (API  KEY)',
                        'HotelAccount'         => 'Hotel  Account',
                        'UrlHostSetting'       => 'Url    API     Setting',
                        'ProxyAuthSetting'     => 'Proxy  Auth    (Key) Setting',
                        'VendorAccountSetting' => 'Vendor Account (API  KEY) Setting',
                        'HotelAccountSetting'  => 'Hotel  AccountSetting'));

    $xcrud->create_action('Attiva', 'abilita_bedzzlebooking'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_bedzzlebooking');
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

    
    $db->query("SELECT * FROM hospitality_bedzzlebooking WHERE idsito = ".IDSITO );
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
    
