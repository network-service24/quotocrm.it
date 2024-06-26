<?

    $xcrud_quotodemo->table('anagrafica');
    $xcrud_quotodemo->order_by('Id','DESC');

    $xcrud_quotodemo->relation('codice_regione', 'regioni', 'id_regione', 'nome_regione');
    $xcrud_quotodemo->relation('codice_provincia', 'province', 'codice_provincia', 'sigla_provincia', '', '', '', ' ', '', 'codice_regione', 'codice_regione');
    $xcrud_quotodemo->relation('codice_comune', 'comuni', 'codice_comune', 'nome_comune', '', '', '', '', '', 'codice_provincia', 'codice_provincia');

    $xcrud_quotodemo->columns('
    					struttura,
					    nome,
					    cognome,
                        cellulare_referente,
                        email_referente,
                        username,
                        password,
                        data_start_hospitality,
                        data_end_hospitality,
                        hospitality');

    $xcrud_quotodemo->column_pattern('data_start_hospitality', '<span class="text-success">{value}</span>');

    $xcrud_quotodemo->column_callback('data_end_hospitality', 'check_demo_scaduta');

    //$xcrud_quotodemo->column_callback('idsito', 'check_send_auto_email');

    $xcrud_quotodemo->column_callback('hospitality', 'lucchetto');

    $xcrud_quotodemo->column_callback('password', 'hidden_password');

    $xcrud_quotodemo->fields('hospitality,
                        nome,
                        cognome,
                        cellulare_referente,
                        email_referente,
                        rag_soc,
                        struttura,
                        partita_iva,
                        codice_fiscale,
                        codice_regione,
                        codice_provincia,
                        codice_comune,
                        indirizzo,
                        sitoweb,
                        cell,
                        fax,
                        email,
                        Ip,
                        username,
                        password,
                        data_start_hospitality,
                        data_end_hospitality
                        ');
    $xcrud_quotodemo->field_callback('password','pass_input');

    
   // $xcrud_quotodemo->label('idsito','Email Temporizzate');
    $xcrud_quotodemo->label('cellulare_referente','Cellulare Referente');
    $xcrud_quotodemo->label('email_referente','E-Mail Referente');


    $xcrud_quotodemo->label('hospitality','Accesso a QUOTO');
    $xcrud_quotodemo->label('data_start_hospitality','Inizio uso QUOTO');
    $xcrud_quotodemo->label('data_end_hospitality','Fine uso QUOTO');

    $xcrud_quotodemo->label('codice_regione', 'Regione');
    $xcrud_quotodemo->label('codice_provincia', 'Provincia');
    $xcrud_quotodemo->label('codice_comune', 'Comune');
    $xcrud_quotodemo->label('cell', 'Telefono struttura');
    $xcrud_quotodemo->label('email', 'E-Mail struttura');

    $xcrud_quotodemo->label('Ip','Ip di provenienza');

    $xcrud_quotodemo->change_type('hospitality', 'bool');
    $xcrud_quotodemo->highlight_row('hospitality','=', '0','#E1E1E1');

    $xcrud_quotodemo->button('javascript:validator_send(\''.BASE_URL_SITO.'send_accessi_quoto_demo/{idsito}\');','Invia accessi QUOTO DEMO al cliente','glyphicon fa fa-envelope text-info');
    
    $xcrud_quotodemo->unset_add();
    $xcrud_quotodemo->unset_remove();
    $xcrud_quotodemo->unset_csv();
    $xcrud_quotodemo->unset_print();
    $xcrud_quotodemo->unset_numbers();
    $xcrud_quotodemo->limit(10);  
    $xcrud_quotodemo->limit_list('10,20,all');  
    $xcrud_quotodemo->unset_pagination(); 
    $xcrud_quotodemo->hide_button('save_edit');
    $xcrud_quotodemo->hide_button('save_new'); 
