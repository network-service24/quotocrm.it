<?php
if($_REQUEST['azione']!='' && $_REQUEST['param']=='delete'){

        $db->query("DELETE FROM hospitality_guest WHERE Id = '".$_REQUEST['azione']."'");
        $db->query("DELETE FROM hospitality_richiesta WHERE id_richiesta = '".$_REQUEST['azione']."'");
        $db->query("DELETE FROM hospitality_proposte WHERE id_richiesta = '".$_REQUEST['azione']."'");
        $db->query("DELETE FROM hospitality_chat WHERE id_guest = '".$_REQUEST['azione']."'"); 
        $db->query("DELETE FROM hospitality_customer_satisfaction WHERE id_richiesta = '".$_REQUEST['azione']."'");  

        header('location:'.BASE_URL_SITO.'archivio/');
}

    // imposto la tabella e le condizioni
    $xcrud->table('hospitality_guest');
        /**
     * ! SE IL PERMESSO E' IMPOSTATO LE RICHIESTE VENGONO FILTRATE PER OPERATORE
     */
    $permessi_unique = check_permessi();
    if($permessi_unique['UNIQUE']==1){
        $xcrud->where('hospitality_guest.ChiPrenota', NOMEUTENTEACCESSI);
    }
    ####################################################################
    if($_REQUEST['action']=='search'){
        if($_REQUEST['NumeroPrenotazione']!=''){
            $xcrud->where('hospitality_guest.NumeroPrenotazione', $_REQUEST['NumeroPrenotazione']);
        }     
        if($_REQUEST['Operatore']!=''){
            $xcrud->where('hospitality_guest.ChiPrenota', $_REQUEST['Operatore']);
        }     
        if($_REQUEST['FontePrenotazione']!=''){
            $xcrud->where('hospitality_guest.FontePrenotazione', $_REQUEST['FontePrenotazione']);
        } 
        if($_REQUEST['TipoVacanza']!=''){
            $xcrud->where('hospitality_guest.TipoVacanza', $_REQUEST['TipoVacanza']);
        }
        if($_REQUEST['TipoRichiesta']!=''){
            if($_REQUEST['TipoRichiesta']=='Preventivo'){
                $xcrud->where('hospitality_guest.TipoRichiesta =  "'.$_REQUEST['TipoRichiesta'].'"');
            }elseif($_REQUEST['TipoRichiesta']=='Conferma'){
                $xcrud->where('hospitality_guest.TipoRichiesta =  "'.$_REQUEST['TipoRichiesta'].'"');
                $xcrud->where('hospitality_guest.Chiuso =  0');
            }elseif($_REQUEST['TipoRichiesta']=='ConfermaC'){
                $xcrud->where('hospitality_guest.TipoRichiesta =  "Conferma"');
                $xcrud->where('hospitality_guest.Chiuso =  1');
            }
        }
        if($_REQUEST['Nome']!=''){
            $xcrud->where('hospitality_guest.Nome LIKE "%'.$_REQUEST['Nome'].'%"');
        }         
        if($_REQUEST['Cognome']!=''){
            $xcrud->where('hospitality_guest.Cognome LIKE "%'.$_REQUEST['Cognome'].'%"');
        }
        if($_REQUEST['Email']!=''){
            $xcrud->where('hospitality_guest.Email', $_REQUEST['Email']);
        }
        if($_REQUEST['NoDisponibilita']!=''){
            $xcrud->where('hospitality_guest.NoDisponibilita', $_REQUEST['NoDisponibilita']);
        }
        if($_REQUEST['DataScadenza']!=''){
            $data_scad_tmp = explode("/",$_REQUEST['DataScadenza']);
            $data_scad = $data_scad_tmp[2].'-'.$data_scad_tmp[1].'-'.$data_scad_tmp[0];
            $xcrud->where('hospitality_guest.DataScadenza >= "'.$data_scad.'"');            
        }        
        if($_REQUEST['DataArrivo']!='' && $_REQUEST['DataPartenza'] ==''){
            $data_dal_tmp = explode("/",$_REQUEST['DataArrivo']);
            $data_dal = $data_dal_tmp[2].'-'.$data_dal_tmp[1].'-'.$data_dal_tmp[0];
            $xcrud->where('hospitality_guest.DataArrivo >= "'.$data_dal.'"');            
        }
        if($_REQUEST['DataArrivo']!='' && $_REQUEST['DataPartenza'] !=''){
            $data_dal_tmp = explode("/",$_REQUEST['DataArrivo']);
            $data_dal = $data_dal_tmp[2].'-'.$data_dal_tmp[1].'-'.$data_dal_tmp[0];
            $data_al_tmp = explode("/",$_REQUEST['DataPartenza']);
            $data_al = $data_al_tmp[2].'-'.$data_al_tmp[1].'-'.$data_al_tmp[0];                        
            $xcrud->where('hospitality_guest.DataArrivo >= "'.$data_dal.'" AND hospitality_guest.DataPartenza <= "'.$data_al.'"');          
        }
        if($_REQUEST['DataRichiesta_dal']!='' && $_REQUEST['DataRichiesta_al'] ==''){
            $dataR_dal_tmp = explode("/",$_REQUEST['DataRichiesta_dal']);
            $dataR_dal = $dataR_dal_tmp[2].'-'.$dataR_dal_tmp[1].'-'.$dataR_dal_tmp[0];
            $xcrud->where('hospitality_guest.DataRichiesta >= "'.$dataR_dal.'"');            
        }
        if($_REQUEST['DataRichiesta_dal']!='' && $_REQUEST['DataRichiesta_al'] !=''){
            $dataR_dal_tmp = explode("/",$_REQUEST['DataRichiesta_dal']);
            $dataR_dal = $dataR_dal_tmp[2].'-'.$dataR_dal_tmp[1].'-'.$dataR_dal_tmp[0];
            $dataR_al_tmp = explode("/",$_REQUEST['DataRichiesta_al']);
            $dataR_al = $dataR_al_tmp[2].'-'.$dataR_al_tmp[1].'-'.$dataR_al_tmp[0];                        
            $xcrud->where('hospitality_guest.DataRichiesta >= "'.$dataR_dal.'" AND hospitality_guest.DataRichiesta <= "'.$dataR_al.'"');          
        }        
        if($_REQUEST['Lingua']!=''){
            $xcrud->where('hospitality_guest.Lingua', $_REQUEST['Lingua']);
        } 
    }  
    $xcrud->where('hospitality_guest.idsito', IDSITO);
    $xcrud->where('hospitality_guest.Archivia', '1');
    $xcrud->where('hospitality_guest.Hidden', '0');
    $xcrud->order_by('hospitality_guest.DataRichiesta','DESC');
    $xcrud->order_by('hospitality_guest.Id','DESC');
    $xcrud->order_by('hospitality_guest.DataInvio','DESC');
    

    $xcrud->subselect('Aperture','SELECT COUNT(Azione) as Aperture FROM hospitality_traccia_email WHERE Azione = \'Aperta\' AND IdRichiesta = {id}');
    $xcrud->subselect('Click','SELECT COUNT(Azione) as Click FROM hospitality_traccia_email WHERE Azione = \'Cliccata\' AND IdRichiesta = {id}');

    $xcrud->columns('Id,ChiPrenota,NumeroPrenotazione,TipoRichiesta,FontePrenotazione,TipoVacanza,DataRichiesta,Nome,Email,Lingua,DataArrivo,DataPartenza,Proposte,DataInvio,DataScadenza,DataChiuso,Provenienza,idsito,Disdetta,NoDisponibilita', false);        

    $xcrud->column_callback('FontePrenotazione','bg_fonte'); 
    $xcrud->column_callback('Provenienza','func_chat_riepilogo'); 
    $xcrud->column_callback('idsito','func_cc'); 
    $xcrud->column_callback('TipoVacanza','bg_tipo');
    $xcrud->column_callback('ChiPrenota' , 'get_operatore'); 
    $xcrud->column_callback('Id' , 'check_input');
    $xcrud->column_callback('NoDisponibilita','si_no_annullate');

    $xcrud->column_pattern('Nome' , '<small><b>{value} {Cognome}</b></small>');
    $xcrud->column_pattern('Cognome' , '<small><b>{value}</b></small>');
    $xcrud->column_pattern('Email' , '<small style="white-space: nowrap;">{value}</small>');
    $xcrud->column_pattern('DataRichiesta' , '<small>{value}</small>');
    $xcrud->column_pattern('Lingua' , '<small>{value}</small>'); 
    $xcrud->column_pattern('DataArrivo' , '<small>{value}</small>');
    $xcrud->column_pattern('DataPartenza' , '<small>{value}</small>');
    $xcrud->column_pattern('NumeroAdulti' , '<small>{value}</small>');
    $xcrud->column_pattern('NumeroBambini' , '<small>{value}</small>');    
    $xcrud->column_pattern('DataScadenza' , '<small style="white-space: nowrap;">{value}</small>'); 
    $xcrud->column_pattern('DataInvio' , '<small style="white-space: nowrap;">{value}</small>'); 
    $xcrud->column_pattern('DataChiuso' , '<small style="white-space: nowrap;">{value}</small>'); 
    $xcrud->column_pattern('NumeroPrenotazione' , '<a href="'.BASE_URL_SITO.'timeline/{NumeroPrenotazione}" title="Timeline"  data-toogle="tooltip"><small>{value}</small></a>');  
    $xcrud->column_pattern('Id' , '<small>{value}</small>'); 
    $xcrud->column_pattern('Click' , '<small>{value}</small>');  
    $xcrud->column_pattern('AbilitaInvio' , '<small>{value}</small>');   
    $xcrud->column_callback('TipoRichiesta','CheckTipoRichiesta'); 
    $xcrud->column_callback('Disdetta','si_no');      
    
    $xcrud->label(array('FontePrenotazione' => 'Fonte',
                                'TipoRichiesta' => 'Timeline',
                                'TipoVacanza' => 'Tipo',
                                'DataRichiesta' => 'Richiesta',
                                'Lingua' => 'Lg',
                                'DataArrivo' => 'Arrivo',
                                'DataPartenza' => 'Partenza',
                                'Nome' => 'Nome Cognome',
                                'NumeroAdulti' => 'Adulti',
                                'NumeroBambini' => 'Bimbi',
                                'NumeroPrenotazione' => 'Nr.',
                                'ChiPrenota' => 'Nome Operatore',
                                'EmailSegretaria' => 'Email Operatore',
                                'TipoPagamento' => 'Tipologia Pagamento',
                                'DataScadenza' => 'Scadenza',
                                'DataInvio' => 'Invio',
                                'DataChiuso' => 'Prenotazione',
                                'idsito' => '',
                                'Id' => '',
                                'Provenienza' => '',
                                'Proposte' => 'Proposta',
                                'ChiPrenota' => 'Op.',
                                'NoDisponibilita' => 'Annullata'));

    $xcrud->column_callback('Email','ico_mail');
    $xcrud->column_class('ChiPrenota,Email,Proposte,Chiuso,Disdetta', 'align-center');

    $xcrud->highlight_row('Disdetta', '=', '1', '#E1E1E1');  

    $xcrud->column_callback('Lingua','show_flags');
    $xcrud->column_callback('Proposte','get_archivio');
    $xcrud->column_callback('DataInvio','get_invio');
    $xcrud->column_callback('DataScadenza','get_scadenza');
    $xcrud->column_callback('DataChiuso','get_data_chiuso');
    $xcrud->highlight('DataInvio', '=', '', '#FDFDD3');  

    $xcrud->highlight_row('NoDisponibilita', '=', '1', '#F0F0F0');

    $xcrud->search_columns('Id,NumeroPrenotazione,FontePrenotazione,TipoVacanza,DataRichiesta,Nome,Cognome,Email,DataArrivo,DataPartenza,DataInvio,DataScadenza'); 
                                     
    $xcrud->unset_title(true);
    $xcrud->unset_add();
    $xcrud->unset_edit();
    $xcrud->unset_view();
    $xcrud->unset_remove();     
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

    $xcrud->create_action('NoArchivia', 'NoArchivia'); // action callback, function publish_action() in functions.php
    $xcrud->button('#', 'Ri-Abilita', 'icon-checkmark  fa fa-external-link', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'NoArchivia',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Archivia',
            '=',
            '1')
    );     
    $js_scripts .=  '<script>'."\r\n"; 
    $js_scripts .=  '$( document ).ready(function() {'."\r\n"; 
         $js_scripts .=  'checkScreenDimension();'."\r\n";
 
         $js_scripts .=  '$("#disarchivia_all").on(\'click\', function () {
                             var checkbox_value = "";
                             $("input[name=Id]").each(function () {
                                 var ischecked = $(this).is(":checked");
                                 if (ischecked) {
                                     checkbox_value += $(this).val() + ",";
                                 }
                             });
                             if(checkbox_value){
                             if (window.confirm("ATTENZIONE: Sicuro di voler ri-abilitare le richieste selezionate?")){
                                 $.ajax({
                                     url: "'.BASE_URL_SITO.'ajax/dis_archivia_all.php",
                                     type: "POST",
                                     data: "idsito='.IDSITO.'&checkbox_value="+checkbox_value,
                                     dataType: "html",
                                     success: function(data) { 
                                             $("#risultato").html(\'<br><div class="alert alert-success">Le richieste sono state <b>ri-abilitate</b>!! Attendi ora il reload della pagina!</div><br>\');  
                                             setTimeout(function(){
                                             $("#risultato").fadeOut(200);
                                             location.reload();
                                             }, 2000);                                                                                                                       
                                         }
                                 });                                                               
                                 return false; // con false senza refresh della pagina
                             }
                         }else{
                                 $("#risultato_dis").html(\'<br><div class="alert alert-danger"><b>Seleziona</b> le richieste prima di cliccare il pulsante! Attendi ora il reload della pagina!</div>\');  
                                 setTimeout(function(){
                                     $("#risultato_dis").fadeOut(200);
                                     location.reload();
                                 }, 2000); 
                         }
                         // alert(checkbox_value);
                         });'."\r\n";
 
         $js_scripts .=  '$("#delete_all").on(\'click\', function () {                                    
                             var checkbox_value = "";
                             $("input[name=Id]").each(function () {
                                 var ischecked = $(this).is(":checked");
                                 if (ischecked) {
                                     checkbox_value += $(this).val() + ",";
                                 }
                             });
                             if(checkbox_value){
                                 if (window.confirm("ATTENZIONE: Sicuro di voler mettere le richieste selezionate nel cestino?")){
                                     $.ajax({
                                         url: "'.BASE_URL_SITO.'ajax/delete_all.php",
                                         type: "POST",
                                         data: "idsito='.IDSITO.'&cestino=1&checkbox_value="+checkbox_value,
                                         dataType: "html",
                                         success: function(data) { 
                                             $("#risultato").html(\'<br><div class="alert alert-success">Le richieste archiviate sono state <b>eliminate</b>!! Attendi ora il reload della pagina!</div><br>\');  
                                             setTimeout(function(){
                                                 $("#risultato").fadeOut(200);
                                                 location.reload();
                                             }, 2000);                                                                                                                       
                                             }
                                     });                                                               
                                     return false; // con false senza refresh della pagina
                                 }
 
                         }else{
                                 $("#risultato").html(\'<br><div class="alert alert-danger"><b>Selezionare</b> le richieste prima di cliccare il pulsante! Attendi ora il reload della pagina!</div>\');  
                                 setTimeout(function(){
                                     $("#risultato").fadeOut(200);
                                     location.reload();
                                 }, 2000); 
                         }
                         // alert(checkbox_value);
                         });'."\r\n";
     $js_scripts .= '});'."\r\n";
     $js_scripts .= '$(document).load($(window).bind("resize", checkScreenDimension));  '."\r\n";
     $js_scripts .=  '</script>'."\r\n"; 
     if(check_configurazioni(IDSITO,'check_pagination')==1){
        $js_pagination = '
        <script>
            $(document).ajaxComplete(function(){
                $(\'.pagination li\').hasClass(\'active\');
                var Pagina = $(\'.pagination li span\').text();
                var Pagina_clean = Pagina.replace("\u2026","");
                console.log(Pagina_clean);
                scriviCookie(\'PaginationArch\',Pagina_clean,\'60\');
                $(\'.pagination li\').one("mouseover",function(){
                    $( "#legendaPagination" ).show( "slow", function() {
                        $(\'#legendaPagination\').html("<div class=\"alert alert-warning\">Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</div>");
                      });
                });
                $(\'.pagination li\').one("mouseout",function(){
                    $( "#legendaPagination" ).hide( "slow", function() {
                        $(\'#legendaPagination\').html("<div class=\"alert alert-warning\">Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</div>");
                      });
                });
            });
            $("document").ready(function() {
                $(\'.pagination li\').one("mouseover",function(){
                    $( "#legendaPagination" ).show( "slow", function() {
                        $(\'#legendaPagination\').html("<div class=\"alert alert-warning\">Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</div>");
                      });
                });
                $(\'.pagination li\').one("mouseout",function(){
                    $( "#legendaPagination" ).hide( "slow", function() {
                        $(\'#legendaPagination\').html("<div class=\"alert alert-warning\">Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</div>");
                      });
                });
                if(leggiCookie(\'PaginationArch\')) {
                    var numero = "";
                    console.log(leggiCookie(\'PaginationArch\'));
                    if(leggiCookie(\'PaginationArch\')!=1){
                        var moltiplicatore = (leggiCookie(\'PaginationArch\')-1);
                        var multi          = parseInt(moltiplicatore);
                        numero             = ('.$numero.'*multi);
                    setTimeout(function() {
                            $(\'.xcrud-action[data-start="\'+numero+\'"]\').trigger(\'click\');              
                        },1);
                    }
                }
            })
        </script>'."\r\n";
    }