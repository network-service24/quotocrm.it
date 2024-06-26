<?php

    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_tipo_pagamenti');
    $xcrud->where('hospitality_tipo_pagamenti.idsito', IDSITO);

    $array_pag = array('','Carta di Credito','Bonifico Bancario','Vaglia Postale');

    if(check_configurazioni(IDSITO,'check_paypal')==1){
        $array_pag[] = 'PayPal';
        $OR .='OR hospitality_tipo_pagamenti.TipoPagamento = "PayPal" ';
    }
    if(check_configurazioni(IDSITO,'check_gateway_bancario')==1){
        $array_pag[]= 'Gateway Bancario';
        $OR .='OR hospitality_tipo_pagamenti.TipoPagamento = "Gateway Bancario" ';
    }
    if(check_configurazioni(IDSITO,'check_virtualpay')==1){
        $array_pag[]= 'Gateway Bancario Virtual Pay';
        $OR .='OR hospitality_tipo_pagamenti.TipoPagamento = "Gateway Bancario Virtual Pay" ';
    }
    if(check_configurazioni(IDSITO,'check_banca_sella')==1){
        $array_pag[]= 'Gateway Bancario Banca Sella';
        $OR .='OR hospitality_tipo_pagamenti.TipoPagamento = "Gateway Bancario Banca Sella" ';
    }
    if(check_configurazioni(IDSITO,'check_stripe')==1){
        $array_pag[] = 'Stripe';
        $OR .='OR hospitality_tipo_pagamenti.TipoPagamento = "Stripe" ';
    }
    if(check_configurazioni(IDSITO,'check_nexi')==1){
        $array_pag[] = 'Nexi';
        $OR .='OR hospitality_tipo_pagamenti.TipoPagamento = "Nexi" ';
    }
    $xcrud->where('hospitality_tipo_pagamenti.TipoPagamento = "Carta di Credito"
                    OR hospitality_tipo_pagamenti.TipoPagamento = "Bonifico Bancario"
                    OR hospitality_tipo_pagamenti.TipoPagamento = "Vaglia Postale"
                    '.$OR.'');

    $xcrud->order_by('Ordine','ASC');
    $xcrud->pass_var('idsito',IDSITO);
    $xcrud->pass_var('Lingua','it');

    $xcrud->validation_required('TipoPagamento',3);

    $xcrud->create_action('Attiva', 'abilita_pagamento'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('Disattiva', 'disabilita_pagamento');
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

    $xcrud->column_callback('Lingua','show_flags');

    $db->query('SELECT * FROM hospitality_lingue WHERE idsito ='.IDSITO);
    $row               = $db->result();
    $n_lg = sizeof($row);
    if($n_lg >0){
        foreach($row as $value) {
            $val[]  = $value['Sigla'];
        }
        $xcrud->change_type('Lingua','select','',implode(',',$val));
    }

    $xcrud->change_type('Abilitato','bool');


    $pagamenti = array();
    foreach ($array_pag as $key => $value) {
        $sel = $db->query('SELECT TipoPagamento FROM hospitality_tipo_pagamenti  WHERE hospitality_tipo_pagamenti.idsito = '.IDSITO.' AND TipoPagamento = "'.$value.'"');
        $r   = sizeof($db->result($sel));
        if($r==1){
             array_remove_item($pagamenti,$value);
        }else{
             $pagamenti[$value] = $value;
        }
    }

    $xcrud->change_type('TipoPagamento','select','',implode(',',$pagamenti));

    $xcrud->create_action('movetop', 'movetop');
    $xcrud->create_action('movebottom', 'movebottom');

    $xcrud->button('#', "Top", 'glyphicon glyphicon-arrow-up icon-arrow-up', 'btn xcrud-action', array(
        'data-action' => 'movetop',
        'data-task' => 'action',
        'data-primary' => '{Id}'));
    $xcrud->button('#', "Bottom", 'glyphicon glyphicon-arrow-down icon-arrow-down', 'btn xcrud-action', array(
        'data-action' => 'movebottom',
        'data-task' => 'action',
        'data-primary' => '{Id}'));


    $xcrud->label('TipoPagamento','Pagamento');


    $xcrud->columns('TipoPagamento, Testi presenti,Abilitato', false);

    $xcrud->column_callback('TipoPagamento','tipo_pagamento');

    $xcrud->fields('TipoPagamento', false, false, 'create');
    $xcrud->fields('ApiKeyNexi');
    $xcrud->fields('SegretKeyNexi');
    $xcrud->fields('ApiKeyStripe');
    $xcrud->fields('EmailPayPal');
    $xcrud->fields('serverURL,tid,kSig,ShopUserRef');

    $xcrud->label('ApiKeyNexi','Key (API) (ALIAS) per account NEXI');
    $xcrud->label('SegretKeyNexi','Segret Key (CHIAVE MAC) per account NEXI');
    
    $xcrud->label('ApiKeyStripe','Key (API) per account STRIPE');

    $xcrud->label('EmailPayPal','Email per account PayPal');

    $xcrud->label('serverURL','Server URL Gateway');
    $xcrud->label('tid','Id Cliente, ABI');
    $xcrud->label('kSig','API Key, Merchant ID');
    $xcrud->label('ShopUserRef','Email Cliente Associata');


    $xcrud->condition('TipoPagamento','=','Carta di Credito','disabled','ApiKeyNexi,SegretKeyNexi,ApiKeyStripe,EmailPayPal,serverURL,tid,kSig,ShopUserRef');
    $xcrud->condition('TipoPagamento','=','PayPal','disabled','ApiKeyNexi,SegretKeyNexi,ApiKeyStripe,serverURL,tid,kSig,ShopUserRef,mastercard,visa,amex,diners');
    $xcrud->condition('TipoPagamento','=','Bonifico Bancario','disabled','ApiKeyNexi,SegretKeyNexi,ApiKeyStripe,EmailPayPal,serverURL,tid,kSig,ShopUserRef,mastercard,visa,amex,diners');
    $xcrud->condition('TipoPagamento','=','Vaglia Postale','disabled','ApiKeyNexi,SegretKeyNexi,ApiKeyStripe,EmailPayPal,serverURL,tid,kSig,ShopUserRef,mastercard,visa,amex,diners');
    $xcrud->condition('TipoPagamento','=','Gateway Bancario','disabled','ApiKeyNexi,SegretKeyNexi,ApiKeyStripe,EmailPayPal,mastercard,visa,amex,diners');
    $xcrud->condition('TipoPagamento','=','Gateway Bancario Virtual Pay','disabled','ApiKeyNexi,SegretKeyNexi,ApiKeyStripe,EmailPayPal,mastercard,visa,amex,diners');
    $xcrud->condition('TipoPagamento','=','Gateway Bancario Banca Sella','disabled','ApiKeyNexi,SegretKeyNexi,ApiKeyStripe,EmailPayPal,mastercard,visa,amex,diners');
    $xcrud->condition('TipoPagamento','=','Stripe','disabled','ApiKeyNexi,SegretKeyNexi,EmailPayPal,serverURL,tid,kSig,ShopUserRef,mastercard,visa,amex,diners');
    $xcrud->condition('TipoPagamento','=','Nexi','disabled','ApiKeyStripe,EmailPayPal,serverURL,tid,kSig,ShopUserRef,mastercard,visa,amex,diners');

    $xcrud->field_tooltip('serverURL',' Questo campo viene dedicato all\'indirizzo del form dedicato al gateway');
    $xcrud->field_tooltip('tid','Questo campo viene dedicato per PayWay = ID Cliente; per VirtualPay = ABI;');
    $xcrud->field_tooltip('kSig','Questo campo viene dedicato per PayWay = API Key; per VirtualPay = MERCHANT ID;');
    $xcrud->field_tooltip('ShopUserRef','Questo campo viene dedicato per PayWay = Email Cliente; per VirtualPay = EMAIL;');

    $select = "SELECT * FROM hospitality_tipo_pagamenti WHERE TipoPagamento = 'Gateway Bancario' AND idsito = ".IDSITO." AND Abilitato = 1 ";
    $result = $db->query($select);
    $record = $db->row($result);
    if(is_array($record)) {
        if($record > count($record)) // se la pagina richiesta non esiste
            $tot = count($record); // restituire la pagina con il numero più alto che esista
    }else{
        $tot = 0;
    }
    if($tot > 0){
      $legenda .= '<div id="legenda" style="display:none">
                    <p><b>PAYWAY:</b> <br />Per poter usufruire del Gateway Bancario PayWay <button class="btn btn-default btn-xs"><img src="https://'.$_SERVER['HTTP_HOST'].'/img/logo-bcc.png"></button> dovete aprire un conto corrente presso <b>Riviera Banca BCC</b>, al momento della vostra richiesta presentatevi come clienti Network Service s.r.l. -> QUOTO,
                    riceverete un benefit sull\'apertura del CC, dopodichè il gateway bancario verrà attivato automaticamente e la filiale vi consegnerà i dati neccessari per la configurazione su QUOTO!</p>
                  </div>'."\r\n";
      $legenda .= '<script type="text/javascript">
                    $(document).ready(function(){
                      $(".xcrud-action[data-task=\'edit\']").on(\'click\', function(){
                          $("#legenda").removeAttr("style");
                      });
                      $(".xcrud-action[data-task=\'list\']").on(\'click\', function(){
                          $("#legenda").attr("style","display:none");
                      });
                      $(".xcrud-action[data-task=\'save\']").on(\'click\', function(){
                          $("#legenda").attr("style","display:none");
                      });
                    })
                    $( document ).ajaxComplete(function() {
                      $(".xcrud-action[data-task=\'edit\']").on(\'click\', function(){
                          $("#legenda").removeAttr("style");
                      });
                      $(".xcrud-action[data-task=\'list\']").on(\'click\', function(){
                          $("#legenda").attr("style","display:none");
                      });
                      $(".xcrud-action[data-task=\'save\']").on(\'click\', function(){
                          $("#legenda").attr("style","display:none");
                      });
                    })
                  </script>'."\r\n";
    }

    $select2 = "SELECT * FROM hospitality_tipo_pagamenti WHERE TipoPagamento = 'Gateway Bancario Virtual Pay' AND idsito = ".IDSITO." AND Abilitato = 1 ";
    $result2 = $db->query($select2);
    $record2 = $db->row($result2);
    if(is_array($record2)) {
        if($record2 > count($record2)) // se la pagina richiesta non esiste
            $tot2 = count($record2); // restituire la pagina con il numero più alto che esista
    }else{
        $tot2 = 0;
    }
    if($tot2 > 0){
      $legendaVP .= '<div id="legendaVP" style="display:none">
                    <p><b>VIRTUAL PAY:</b>  <br />Per poter usufruire del Gateway Virtual Pay <button class="btn btn-default btn-xs"><i class="fa fa-credit-card fa-fw bg-orange"></i></button> dovete aprire un conto corrente e richiedere <b>Virtual Pay come Gateway Bancario</b>.
                    A questo punto vi verrà attivato automaticamente, la filiale vi consegnerà i dati neccessari per la configurazione su QUOTO!</p>
                  </div>'."\r\n";
      $legendaVP .= '<script type="text/javascript">
                    $(document).ready(function(){
                      $(".xcrud-action[data-task=\'edit\']").on(\'click\', function(){
                          $("#legendaVP").removeAttr("style");
                      });
                      $(".xcrud-action[data-task=\'list\']").on(\'click\', function(){
                          $("#legendaVP").attr("style","display:none");
                      });
                      $(".xcrud-action[data-task=\'save\']").on(\'click\', function(){
                          $("#legendaVP").attr("style","display:none");
                      });
                    })
                    $( document ).ajaxComplete(function() {
                      $(".xcrud-action[data-task=\'edit\']").on(\'click\', function(){
                          $("#legendaVP").removeAttr("style");
                      });
                      $(".xcrud-action[data-task=\'list\']").on(\'click\', function(){
                          $("#legendaVP").attr("style","display:none");
                      });
                      $(".xcrud-action[data-task=\'save\']").on(\'click\', function(){
                          $("#legendaVP").attr("style","display:none");
                      });
                    })
                  </script>'."\r\n";
    }


    $xcrud->change_type('mastercard','bool');
    $xcrud->change_type('visa','bool');
    $xcrud->change_type('amex','bool');
    $xcrud->change_type('diners','bool');

    $xcrud->fields('mastercard,visa,amex,diners', false);
    $xcrud->fields('Abilitato', false);

    // disabilito il titolo - impostato da file tpl
    $xcrud->unset_title(true);
    $xcrud->column_callback('Lingua','show_flags');

         /* subselect per visualizzare le icone delle lingue relative ai testi presenti */
    $xcrud->subselect('Testi presenti','SELECT GROUP_CONCAT(DISTINCT CONCAT(lingue," ") SEPARATOR " ") AS lingue FROM hospitality_tipo_pagamenti_lingua WHERE pagamenti_id = {id}');
    $xcrud->column_callback('Testi presenti','show_flags');

    $xcrud->unset_title(true);
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_numbers();
    $xcrud->hide_button('save_new');

    /* GESTIONE TABELLA TESTI */
    $servizi_testo = $xcrud->nested_table('Gestione testi in lingua','id','hospitality_tipo_pagamenti_lingua','pagamenti_id');
    $servizi_testo->columns('lingue,Pagamento,Descrizione');
    $servizi_testo->fields('lingue,Pagamento,Descrizione');
    $servizi_testo->column_callback('lingue','show_flags');
    $servizi_testo->field_callback('Descrizione','textarea_doc');
    $servizi_testo->relation('lingue','hospitality_lingue','Sigla','Sigla','idsito='.IDSITO);
    $servizi_testo->language('it');
    $servizi_testo->pass_var('idsito',IDSITO);

    $servizi_testo->validation_required('lingue');
    $servizi_testo->validation_required('Pagamento',3);

    $servizi_testo->unset_csv();
    $servizi_testo->unset_print();
    $servizi_testo->unset_title();
    $servizi_testo->unset_numbers();
    $servizi_testo->hide_button('save_new');

    $select = "SELECT * FROM hospitality_acconto_pagamenti WHERE idsito = ".IDSITO;
    $res    = $db->query($select);
    $rw     = $db->result($res);
    $tot    = sizeof($rw);
    if($tot == 0){
        $insert = "INSERT INTO hospitality_acconto_pagamenti(idsito) VALUES('".IDSITO."')";
        $ins    = $db->query($insert);
        $id     = $db->insert_id($ins);
    }else{
        $id = $rw[0]['Id'];
    }
    $xcrud2 = Xcrud::get_instance();
    $xcrud2->table('hospitality_acconto_pagamenti');
    $xcrud2->where('hospitality_acconto_pagamenti.idsito', IDSITO);
    $xcrud2->order_by('Id','DESC');
    $xcrud2->columns('Acconto');
    $xcrud2->fields('Acconto');
    $xcrud2->label(array('Acconto' => 'Percentuale Caparra di default %'));
    $xcrud2->pass_var('idsito',IDSITO);
    $xcrud2->change_type('Acconto','select','',', 10, 15, 20, 25, 30, 40, 50, 60, 70, 80, 90, 100');

    $xcrud2->unset_title(true);
    $xcrud2->unset_print();
    $xcrud2->unset_add();
    $xcrud2->unset_remove();
    $xcrud2->unset_view();
    $xcrud2->unset_csv();
    $xcrud2->unset_search();
    $xcrud2->unset_limitlist();
    $xcrud2->unset_pagination();
    $xcrud2->unset_numbers();
    $xcrud2->hide_button('save_new');
    $xcrud2->hide_button('save_edit');
    $xcrud2->hide_button('return');

    $carta_credito_alert = '<div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="alert alert-danger text-center">
                                        <p>ATTENZIONE: Lo staff di Network Service s.r.l. vuole ricordarvi che dal Gennaio 2020 è scongliato usare <br><b>Il modulo di pagamento con Carta di Credito a garanzia</b> (utilizzando il POS alla reception)!<br>Il modulo in questione non rispetta le norme vigenti e non vi tutela!</p>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>'."\r\n";