<?php


if($_GET['azione'] == 'res' && $_GET['param'] == 'ok') {
    $msg = '<div class="alert alert-success">
                    <i class="fa fa-check"></i>Richieste ripristinate con successo.
                </div>';
}
if($_GET['azione'] == 'res' && $_GET['param'] == 'ko') {
    $msg = '<div class="alert alert-warning">
                    <i class="fa fa-warning"></i>Richieste eliminate definitivamente!
                </div>';
}

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
    $xcrud->where('hospitality_guest.Hidden', '1');
    $xcrud->order_by('hospitality_guest.DataRichiesta','DESC');  


    $xcrud->columns('Id,ChiPrenota,NumeroPrenotazione,TipoRichiesta,FontePrenotazione,TipoVacanza,DataRichiesta,Nome,Email,Lingua,DataArrivo,DataPartenza,idsito,Disdetta,NoDisponibilita', false);        

    $xcrud->column_callback('FontePrenotazione','bg_fonte'); 
    $xcrud->column_callback('TipoVacanza','bg_tipo');
    $xcrud->column_callback('ChiPrenota' , 'get_operatore'); 
    $xcrud->column_callback('Id' , 'check_input');
    $xcrud->column_callback('idsito','func_cc');   

    $xcrud->column_pattern('Nome' , '<small><b>{value} {Cognome}</b></small>');
    $xcrud->column_pattern('Cognome' , '<small><b>{value}</b></small>');
    $xcrud->column_pattern('Email' , '<small style="white-space: nowrap;">{value}</small>');
    $xcrud->column_pattern('DataRichiesta' , '<small>{value}</small>');
    $xcrud->column_pattern('Lingua' , '<small>{value}</small>'); 
    $xcrud->column_callback('DataArrivo' , 'get_data_arrivo_profila');
    $xcrud->column_callback('DataPartenza' , 'get_data_partenza_profila');
    $xcrud->column_pattern('NumeroAdulti' , '<small>{value}</small>');
    $xcrud->column_pattern('NumeroBambini' , '<small>{value}</small>');    
    $xcrud->column_pattern('NumeroPrenotazione' , '<small>{value}</small>');  
    $xcrud->column_pattern('Id' , '<small>{value}</small>'); 
    $xcrud->column_pattern('Click' , '<small>{value}</small>');  
    $xcrud->column_callback('TipoRichiesta','CheckTipoRichiesta'); 
    $xcrud->column_callback('Disdetta','si_no'); 
    $xcrud->column_callback('NoDisponibilita','si_no_annullate'); 
  
    $xcrud->highlight_row('NoDisponibilita', '=', '1', '#F0F0F0');
    $xcrud->highlight_row('Disdetta', '=', '1', '#E1E1E1');  

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
                                'idsito' => '',
                                'Id' => '',
                                'Provenienza' => '',
                                'Proposte' => 'Proposta',
                                'ChiPrenota' => 'Op.',
                                'Disdetta' => 'Disdetta',
                                'NoDisponibilita' => 'Annullata'));

    $xcrud->column_callback('Email','ico_mail');
    $xcrud->column_class('ChiPrenota,Email,idsito', 'align-center');

    $xcrud->column_callback('Lingua','show_flags');

    $xcrud->create_action('NoHidden', 'NoHidden'); // action callback, function publish_action() in functions.php
    $xcrud->button('#', 'Ripristina', 'icon-checkmark  fa fa-repeat', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'NoHidden',
            'data-primary' => '{Id}'),
        array(  // set condition ( when button must be shown)
            'Hidden',
            '=',
            '1')
    ); 


    $xcrud->unset_title();
    $xcrud->unset_add();
    $xcrud->unset_edit();
    $xcrud->unset_view();
    $xcrud->unset_remove();
    $xcrud->unset_print();
    $xcrud->unset_csv();
    $xcrud->unset_search();
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

    if(check_configurazioni(IDSITO,'check_pagination')==1){
        $js_pagination = '
        <script>       
            $(document).ajaxComplete(function(){
                $(\'.pagination li\').hasClass(\'active\');
                var Pagina = $(\'.pagination li span\').text();
                console.log(Pagina);
                scriviCookie(\'PaginationConf\',Pagina,\'60\');
            });
            $("document").ready(function() {
                if(leggiCookie(\'PaginationConf\')) {
                    var numero = "";
                    console.log(leggiCookie(\'PaginationConf\'));
                    if(leggiCookie(\'PaginationConf\')!=1){
                        var moltiplicatore = (leggiCookie(\'PaginationConf\')-1);
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
    $js_script_delete ='
    <script>
        $(document).ready(function() {     
            $("#delete_all").on(\'click\', function () {                                    
                var checkbox_value = "";
                $("input[name=Id]").each(function () {
                    var ischecked = $(this).is(":checked");
                    if (ischecked) {
                        checkbox_value += $(this).val() + ",";
                    }
                });
                if(checkbox_value){
                    if (window.confirm("ATTENZIONE: Sicuro di voler eliminare definitivamente le richieste selezionate?")){
                        $.ajax({
                            url: "'.BASE_URL_SITO.'ajax/delete_all.php",
                            type: "POST",
                            data: "idsito='.IDSITO.'&checkbox_value="+checkbox_value,
                            dataType: "html",
                            success: function(data) { 
                                    $("#risultato_del").html(\'<br><div class="alert alert-success">Le richieste sono state <b>eliminate definitvamente</b>!! Attendi ora il reload della pagina!</div><br>\');  
                                    setTimeout(function(){
                                    $("#risultato_del").fadeOut(200);
                                    location.reload();
                                    }, 2000);                                                                                                                       
                                }
                        });                                                               
                        return false; // con false senza refresh della pagina
                    }

                }else{
                    $("#risultato_del").html(\'<br><div class="alert alert-danger"><b>Selezionare</b> le richieste prima di cliccare il pulsante! Attendi ora il reload della pagina!</div>\');  
                        setTimeout(function(){
                        $("#risultato_del").fadeOut(200);
                        location.reload();
                        }, 2000); 
                }
            });
        });                                                                                                                                                                                                                           
  </script>'."\r\n";
  $js_script_resave ='
  <script>
      $(document).ready(function() {     
          $("#resave_all").on(\'click\', function () {                                    
              var checkbox_value = "";
              $("input[name=Id]").each(function () {
                  var ischecked = $(this).is(":checked");
                  if (ischecked) {
                      checkbox_value += $(this).val() + ",";
                  }
              });
              if(checkbox_value){
                  if (window.confirm("ATTENZIONE: Sicuro di voler ripristinare le richieste selezionate?")){
                      $.ajax({
                          url: "'.BASE_URL_SITO.'ajax/re_save_all.php",
                          type: "POST",
                          data: "idsito='.IDSITO.'&checkbox_value="+checkbox_value,
                          dataType: "html",
                          success: function(data) { 
                                  $("#risultato_resave").html(\'<br><div class="alert alert-success">Le richieste sono state <b>ripristinate</b>!! Attendi ora il reload della pagina!</div><br>\');  
                                  setTimeout(function(){
                                  $("#risultato_resave").fadeOut(200);
                                  location.reload();
                                  }, 2000);                                                                                                                       
                              }
                      });                                                               
                      return false; // con false senza refresh della pagina
                  }

              }else{
                  $("#risultato_resave").html(\'<br><div class="alert alert-danger"><b>Selezionare</b> le richieste prima di cliccare il pulsante! Attendi ora il reload della pagina!</div>\');  
                      setTimeout(function(){
                      $("#risultato_resave").fadeOut(200);
                      location.reload();
                      }, 2000); 
              }
          });
      });                                                                                                                                                                                                                           
</script>'."\r\n";