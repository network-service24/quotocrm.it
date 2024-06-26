<?php

    $xcrud->table('hospitality_checkin');
    $xcrud->where('hospitality_checkin.idsito', IDSITO);
    $xcrud->where('hospitality_checkin.session_id !=""');
    $xcrud->order_by('hospitality_checkin.Id','DESC');

    $xcrud->pass_var('idsito',IDSITO);
  
    $xcrud->columns('Prenotazione,idsito,lang,NumeroPersone,TipoComponente,TipoDocumento,Documento,ComuneEmissione,Nome,Cognome,Note,data_compilazione,Cittadinanza');


    $xcrud->column_pattern('Prenotazione' , '<a href="'.BASE_URL_SITO.'timeline/{Prenotazione}" title="Timeline"  data-toogle="tooltip"><small>{value}</small></a>'); 
    $xcrud->column_pattern('NumeroPersone' , '<small>{value}</small>');
    $xcrud->column_pattern('TipoComponente' , '<small>{value}</small>');
    $xcrud->column_pattern('TipoDocumento' , '<small>{value}</small>');    
    $xcrud->column_pattern('ComuneEmissione' , '<small>{value}</small>');
    $xcrud->column_pattern('Nome' , '<small><b>{value}</b></small>');  
    $xcrud->column_pattern('Cognome' , '<small><b>{value}</b></small>'); 
    $xcrud->column_pattern('Cittadinanza' , '<small>{value}</small>'); 
    $xcrud->column_pattern('data_compilazione' , '<small>{value}</small>');
    
    $xcrud->modal('Note');

    $xcrud->label(array('Prenotazione' => 'Nr.',
                                'idsito' => 'Soggiorno',
                                'lang' => 'Lg.',
                                'NumeroPersone' => 'Numero Persone',
                                'TipoComponente' => 'Componente',
                                'TipoDocumento' => 'Documento',
                                'ComuneEmissione' => 'Comune Emissione',
                                'Cittadinanza' => 'Esito Compilazione'));

    $xcrud->column_callback('Cittadinanza','count_row_compilate');
    $xcrud->column_callback('lang','show_flags');
    $xcrud->column_callback('idsito','get_checkin');
    $xcrud->column_callback('Documento','link_documento');
    $xcrud->column_class('Prenotazione,idsito,NumeroPersone', 'align-center');
 
    $xcrud->button(BASE_URL_SITO.'send_schedina/{idsito}/{NumeroPersone}/{Prenotazione}/','Invia mail alla Questura','fa fa-envelope text-blue','btn btn-default btn-sm',array('data-toogle'=>'tooltip'));
    $xcrud->button(BASE_URL_SITO.'include/controller/export_schedina.php?IdPrenotazione={Id}&idsito={idsito}&NumPreno={Prenotazione}','Esporta Schedina Alloggiati','fa fa-file-excel-o text-green','btn btn-default btn-sm',array('data-toogle'=>'tooltip'));
    $xcrud->button(BASE_URL_SITO.'print_schedina/{idsito}/{NumeroPersone}/{Prenotazione}/','Stampa schedina alloggiati','fa fa-print text-red','btn btn-default btn-sm',array('data-toogle'=>'tooltip'));
    $xcrud->button($_SERVER['REQUEST_URI'].'{id}/{Prenotazione}/','Modifica','glyphicon glyphicon-edit','bg-yellow btn-sm',array('data-toogle'=>'tooltip'));
    $xcrud->button('javascript:validator(\''.BASE_URL_SITO.'delete_schedina/{idsito}/{id}/{Prenotazione}/\');','Elimina Schedina P.S. e tutti i suoi componenti','glyphicon glyphicon-remove','btn btn-default btn-sm bg-red',array('data-toogle'=>'tooltip'));

    $xcrud->unset_title();
    $xcrud->unset_remove();
    $xcrud->unset_view();
    $xcrud->unset_edit();
    $xcrud->unset_add();
    $xcrud->unset_csv();
    $xcrud->unset_print();
    $xcrud->unset_numbers();
    $numero = paginazione(IDSITO);
    if(!isset($numero) || is_null($numero) || empty($numero)){
        $numero = 15;
    }    
    $numero2 = ($numero*2);
    $numero3 = ($numero*3);
    $numero4 = ($numero*4);
    $xcrud->limit($numero);  
    $xcrud->limit_list($numero.','.$numero2.','.$numero3.','.$numero4);    
    $xcrud->unset_pagination(); 
    $xcrud->hide_button('save_new');  

if($_REQUEST['azione']!=''){



        $xcrud2 = Xcrud::get_instance();
        $xcrud2->table('hospitality_checkin');
        $xcrud2->where('hospitality_checkin.Id',$_REQUEST['azione']);
        $xcrud2->where('hospitality_checkin.idsito', IDSITO);
        $xcrud2->where('hospitality_checkin.session_id !=""');


        $xcrud2->relation('Cittadinanza','stati','nome_stato','nome_stato','nome_stato != ""');
        $xcrud2->relation('Provincia','province','sigla_provincia','sigla_provincia','sigla_provincia != ""');

        $xcrud2->relation('StatoNascita','stati','nome_stato','nome_stato','nome_stato != ""');
        $xcrud2->relation('ProvinciaNascita','province','sigla_provincia','sigla_provincia','sigla_provincia != ""');


        $xcrud2->pass_var('idsito',IDSITO);

        $xcrud2->change_type('TipoDocumento','select','','Carta d\'identità,Passaporto,Patente');
        $xcrud2->change_type('Sesso','select','','Maschio,Femmina');

        $xcrud2->field_callback('Documento','link_documento');
        
        $xcrud2->fields('Prenotazione,
            TipoComponente,
            TipoDocumento,
            Documento,
            NumeroDocumento,
            ComuneEmissione,
            StatoEmissione,
            DataRilascio,
            DataScadenza,
            Nome,
            Cognome,
            Sesso,
            Cittadinanza,
            Provincia,
            Citta,
            ProvinciaBis,
            CittaBis,            
            Indirizzo,
            Cap,
            DataNascita,
            StatoNascita,
            ProvinciaNascita,
            LuogoNascita,
            ProvinciaNascitaBis,
            LuogoNascitaBis,
            Note');
   

            $xcrud2->label(array('Prenotazione' => 'Nr.Preno',
                                        'TipoComponente' => 'Componente',
                                        'TipoDocumento' => 'Documento',
                                        'NumeroDocumento' => 'Nr.Documento',
                                        'ComuneEmissione' => 'Comune Emissione',
                                        'StatoEmissione' => 'Stato Emissione',
                                        'DataRilascio' => 'Data Rilascio',
                                        'DataScadenza' => 'Data Scadenza',
                                        'ProvinciaBis' => 'Stato/regione/provincia (ESTERO)',
                                        'CittaBis' => 'Città (ESTERO)',
                                        'DataNascita' => 'Data Nascita',
                                        'StatoNascita' => 'Stato Nascita',
                                        'ProvinciaNascita' => 'Provincia Nascita',
                                        'LuogoNascita' => 'Luogo Nascita',
                                        'ProvinciaNascitaBis' => 'Stato/regione/provincia (NASCITA ESTERO)',
                                        'LuogoNascitaBis' => 'Luogo Nascita (NASCITA ESTERO)'));


        $xcrud2->no_editor('Note');
        $xcrud2->set_attr('Prenotazione',array('readonly'=>'readonly'));
        $xcrud2->set_attr('TipoComponente',array('readonly'=>'readonly'));
        $xcrud2->set_attr('TipoDocumento',array('readonly'=>'readonly'));
        $xcrud2->set_attr('NumeroDocumento',array('readonly'=>'readonly'));
        $xcrud2->set_attr('ComuneEmissione',array('readonly'=>'readonly'));
        $xcrud2->set_attr('StatoEmissione',array('readonly'=>'readonly'));
        $xcrud2->set_attr('DataRilascio',array('readonly'=>'readonly'));
        $xcrud2->set_attr('DataScadenza',array('readonly'=>'readonly'));





        $xcrud2->table_name('Componente principale!');
        $xcrud2->hide_button('return');
        $xcrud2->hide_button('save_return');
        $xcrud2->hide_button('save_new');


        $select = "SELECT * FROM hospitality_checkin WHERE idsito = ".IDSITO." AND Prenotazione = ".$_REQUEST['param']." AND session_id IS NULL";
        $res = $db->query($select);
        $tot_componenti = sizeof($db->result($res));
        //if($tot_componenti>0){
            $componenti = Xcrud::get_instance();
            $componenti->table('hospitality_checkin');
            $componenti->where('hospitality_checkin.idsito',IDSITO);    
            $componenti->where('hospitality_checkin.Prenotazione',$_REQUEST['param']);     
            $componenti->where('hospitality_checkin.session_id IS NULL');
            $componenti->order_by('hospitality_checkin.Id','ASC');      
            
            $componenti->relation('Cittadinanza','stati','nome_stato','nome_stato','nome_stato != ""');
            $componenti->relation('Provincia','province','sigla_provincia','sigla_provincia','sigla_provincia != ""');

            $componenti->relation('StatoEmissione','stati','nome_stato','nome_stato','nome_stato != ""');
            $componenti->relation('ProvinciaNascita','province','sigla_provincia','sigla_provincia','sigla_provincia != ""');
            $componenti->relation('StatoNascita','stati','nome_stato','nome_stato','nome_stato != ""');

            $componenti->pass_var('idsito',IDSITO);

            $s  = "SELECT lang FROM hospitality_checkin WHERE idsito = ".IDSITO." AND Prenotazione = ".$_REQUEST['param']." AND session_id IS NULL";
            $r  = $db->query($s);
            $rw = $db->row($r);
            if($tot_componenti>0){
                $componenti->pass_var('lang',$rw['lang']);
            }else{
                $componenti->change_type('lang','select','it','it,en,fr,de');
            }

            $componenti->columns('Prenotazione,lang,TipoDocumento,TipoComponente,Documento,Nome,Cognome,Cittadinanza,Note');

            $componenti->column_callback('lang','show_flags');
            $componenti->column_callback('Documento','link_documento');

            $componenti->column_pattern('Prenotazione' , '<small>{value}</small>');
            $componenti->column_pattern('lang' , '<small>{value}</small>');
            $componenti->column_pattern('TipoComponente' , '<small>{value}</small>');
            $componenti->column_pattern('TipoDocumento' , '<small>{value}</small>');
            $componenti->column_pattern('Nome' , '<small><b>{value}</b></small>');  
            $componenti->column_pattern('Cognome' , '<small><b>{value}</b></small>'); 
            $componenti->column_pattern('Cittadinanza' , '<small>{value}</small>'); 
            $componenti->column_pattern('Note' , '<small>{value}</small>');             

            $componenti->fields('Prenotazione');
            if($tot_componenti==0){
                $componenti->fields('lang');
            }
            $componenti->fields('TipoComponente,TipoDocumento');
            $componenti->fields('Documento');
            $componenti->fields('NumeroDocumento,
                ComuneEmissione,
                StatoEmissione,
                DataRilascio,
                DataScadenza,
                Documento,
                Nome,
                Cognome,
                Sesso,
                Cittadinanza,
                Citta,
                Provincia,
                CittaBis,
                ProvinciaBis,
                Indirizzo,
                Cap,
                DataNascita,
                StatoNascita,
                ProvinciaNascita,
                LuogoNascita,
                ProvinciaNascitaBis,
                LuogoNascitaBis,
                Note');

            $componenti->field_callback('Documento','link_documento');

            $componenti->label(array('Prenotazione' => 'Nr.Preno',
                                        'TipoComponente' => 'Componente',
                                        'TipoDocumento' => 'Documento',
                                        'NumeroDocumento' => 'Nr.Documento',
                                        'ComuneEmissione' => 'Comune Emissione',
                                        'StatoEmissione' => 'Stato Emissione',
                                        'DataRilascio' => 'Data Rilascio',
                                        'DataScadenza' => 'Data Scadenza',
                                        'ProvinciaBis' => 'Stato/regione/provincia (ESTERO)',
                                        'CittaBis' => 'Città (ESTERO)',
                                        'DataNascita' => 'Data Nascita',
                                        'StatoNascita' => 'Stato Nascita',
                                        'ProvinciaNascita' => 'Provincia Nascita',
                                        'LuogoNascita' => 'Luogo Nascita',
                                        'ProvinciaNascitaBis' => 'Stato/regione/provincia (NASCITA ESTERO)',
                                        'LuogoNascitaBis' => 'Luogo Nascita (NASCITA ESTERO)'));

            $componenti->change_type('TipoComponente','select','','--,Capo Famiglia,Familiare,Capo Gruppo,Membro Gruppo,Ospite Singolo');
            $componenti->change_type('TipoDocumento','select','','--,Carta di Identità,Passaporto,Patente');

            $componenti->change_type('Sesso','select','','--,Maschio,Femmina');

            $componenti->no_editor('Note');
            $componenti->set_attr('Prenotazione',array('readonly'=>'readonly'));
            $componenti->set_attr('Prenotazione',array('value'=>$_REQUEST['param']));
 
            /*$componenti->set_attr('TipoComponente',array('readonly'=>'readonly'));
            $componenti->set_attr('TipoDocumento',array('readonly'=>'readonly'));
            $componenti->set_attr('NumeroDocumento',array('readonly'=>'readonly'));
            $componenti->set_attr('ComuneEmissione',array('readonly'=>'readonly'));
            $componenti->set_attr('StatoEmissione',array('readonly'=>'readonly'));
            $componenti->set_attr('DataRilascio',array('readonly'=>'readonly'));
            $componenti->set_attr('DataScadenza',array('readonly'=>'readonly'));*/

            $componenti->table_name('Lista altri componenti nucleo!', '','');
           

            //$componenti->unset_add();
            $componenti->unset_csv();
            $componenti->unset_print();
            $componenti->unset_numbers();
            $componenti->unset_search(); 
            $componenti->limit(40);  
            $componenti->limit_list('40,50,60,all');  
            $componenti->unset_pagination(); 
            $componenti->hide_button('save_edit');
            $componenti->hide_button('save_new');
        //}

}

$pulsante_indietro ='<style>#td{padding-right:20px}</style><table><tr><td><a class="btn btn-warning " href="'.BASE_URL_SITO.'schedine_alloggiati/"><i class="fa fa-arrow-left"></i> torna alla schedine</a></td></tr></table>';

if(check_configurazioni(IDSITO,'check_notifiche_push')==1){
    if(n_checkin(1)>0){ 
        $notifiche_js = '<script>$( document ).ready(function() {open_notifica("Ciao " + NomeHotel + " oggi sono stati compilati <b class=\"text16\">" + ContatoreSchedine + "</b>  checkin online"," ","plain","bottom-right","warning",5000,"#ff6849");});</script>'."\r\n";
    }
}