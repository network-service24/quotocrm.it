<?php
    $xcrud_suiteweb = Xcrud::get_instance();
    $xcrud_suiteweb->connection(DB_SUITEWEB_USER,DB_SUITEWEB_PASSWORD,DB_SUITEWEB_NAME,DB_SUITEWEB_HOST);
    $xcrud_suiteweb->table('siti');
    $xcrud_suiteweb->where('siti.idsito = ', $_REQUEST['azione']);
    $xcrud_suiteweb->relation('codice_regione','regioni','id_regione','nome_regione','','','',' ','','id_stato','id_stato');
    $xcrud_suiteweb->relation('codice_provincia','province','codice_provincia','sigla_provincia','','','',' ','','codice_regione','codice_regione');
    $xcrud_suiteweb->relation('codice_comune','comuni','codice_comune','nome_comune','','','','','','codice_provincia','codice_provincia');



    $xcrud_suiteweb->columns('siti.nome,
                        siti.indirizzo,
                        siti.codice_comune,
                        siti.cap,
                        siti.codice_provincia,
                        siti.email,
                        siti.web', false);
          

         
    $xcrud_suiteweb->fields('siti.nome,
                        siti.indirizzo,
                        siti.codice_comune,
                        siti.cap,
                        siti.codice_provincia,
                        siti.email,
                        siti.web,
                        siti.coordinate', false);
                  
    $xcrud_suiteweb->field_tooltip('siti.email','Questa e-mail è l\'indirizzo associato al vostro sito ed al contratto di QUOTO!');                      
    $xcrud_suiteweb->change_type('siti.coordinate','point','44.0668947,12.5664285',array('text'=>'Sei qui'));

    $xcrud_suiteweb->unset_title(true);
    $xcrud_suiteweb->unset_add();
    $xcrud_suiteweb->unset_edit();
    $xcrud_suiteweb->unset_csv();
    $xcrud_suiteweb->unset_remove();
    $xcrud_suiteweb->unset_print();
    $xcrud_suiteweb->hide_button('return');  


#################################################################
#
    $select = "SELECT * FROM hospitality_social WHERE idsito =".$_REQUEST['azione'];
    $res = $db->query($select);
    $rws = $db->row($res);
    $tot = sizeof($rws);
    if($tot == 0){
        $insert = "INSERT INTO hospitality_social(idsito) VALUES('".$_REQUEST['azione']."')";
        $qy = $db->query($insert);
        $_SESSION['idsocial'] = $db->insert_id($qy);
    }else{
        $_SESSION['idsocial'] = $rws['idsocial'];
    }

   $xcrud->table('hospitality_social');
   $xcrud->where('hospitality_social.idsito = ', $_REQUEST['azione']);
   $xcrud->table_name('Inserire i collegamenti Social');

   $xcrud->pass_var('idsito',IDSITO);

   $xcrud->columns('BookingOnline,
                        Tripadvisor,
                        Facebook,
                        Twitter,
                        Instagram,
                        Linkedin,
                        Pinterest', false);
          

         
   $xcrud->fields('BookingOnline,
                        Tripadvisor,
                        Facebook,
                        Twitter,
                        Instagram,
                        Linkedin,
                        Pinterest', false);   
   $xcrud->set_attr('BookingOnline',array('placeholder' => 'Link del vostro Booking Online'));
   $xcrud->set_attr('Facebook',array('placeholder' => 'https://www.facebook.com/..............'));
   $xcrud->set_attr('Tripadvisor',array('placeholder' => 'https://www.tripadvisor.it/..............'));
   $xcrud->set_attr('Twitter',array('placeholder' => 'https://twitter.com/..............'));
   $xcrud->set_attr('GooglePlus',array('placeholder' => 'https://plus.google.com/..............'));
   $xcrud->set_attr('Instagram',array('placeholder' => 'https://www.instagram.com/..............'));
   $xcrud->set_attr('Linkedin',array('placeholder' => 'https://linkedin.com/..............'));
   $xcrud->set_attr('Pinterest',array('placeholder' => 'https://pinterest.com/..............'));

   $xcrud->field_tooltip('hospitality_social.BookingOnline','Inserire il link del vostro Booking Online');  
   $xcrud->field_tooltip('hospitality_social.Tripadvisor','Inserire il link del vostro TripAdvisor');   
   $xcrud->field_tooltip('hospitality_social.Facebook','Inserire il link della vostra pagina Facebook');            
   $xcrud->field_tooltip('hospitality_social.Twitter','Inserire il link della vostra pagina Twitter');
   $xcrud->field_tooltip('hospitality_social.GooglePlus','Inserire il link della vostra pagina Google Plus');
   $xcrud->field_tooltip('hospitality_social.Instagram','Inserire il link della vostra pagina Instagram');
   $xcrud->field_tooltip('hospitality_social.Linkedin','Inserire il link della vostra pagina Linkedin');
   $xcrud->field_tooltip('hospitality_social.Pinterest','Inserire il link della vostra pagina Pinterest');

   $xcrud->table_name('Inserisci i tuoi collegamenti Social e Booking Online');
   $xcrud->unset_add();
   $xcrud->unset_print();
   $xcrud->unset_csv();
   $xcrud->unset_numbers();
   $xcrud->unset_view();
   $xcrud->unset_search();
   $xcrud->unset_pagination();
   $xcrud->unset_limitlist();
   $xcrud->unset_sortable();
   $xcrud->hide_button('save_return');
   $xcrud->hide_button('return');
   $xcrud->hide_button('save_new');


#
#################################################################