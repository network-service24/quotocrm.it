<?php
/**
 * CRM and CMS
 * @author Marcello Visigalli < marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CRUD for insert, update, delete query in ajax
 */

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

$tabella   = $_REQUEST['tabella'];
        # in BASE ALLA TABELLA CAMBIANO I CAMPI
        switch($tabella){
			
            case 'siti';

                   
                    $id                      = $_REQUEST['id'];
                    $param_where             = $_REQUEST['parametro'];
                
                    # QUERY PER COMPILARE IL DATATABLE
                    $s  = " SELECT *  FROM ".$tabella." WHERE ".$param_where." = ".$id."";
                
                    $rec = $dbMysqli->query($s);
                
                    $row = $rec[0];

                    $tiposito                                     = $row['tiposito'];
                    $idsito                                       = $row['idsito'];	
                    $classe                                       = $row['classe'];
                    $https                                        = $row['https'];
                    $web                                          = addslashes($row['web']);
                    $nome                                         = addslashes($row['nome']);
                    $id_stato                                     = $row['id_stato'];
                    $codice_regione                               = $row['codice_regione'];
                    $nome_regione_                                = $fun->getRegione($codice_regione); 
                    $nome_regione                                 = $dbMysqli->escape($nome_regione_['nome_regione']);
                    $codice_provincia                             = $row['codice_provincia'];
                    $nome_provincia_                              = $fun->getProvincia($codice_provincia); 
                    $nome_provincia                               = $nome_provincia_['sigla_provincia'];
                    $codice_comune                                = $row['codice_comune'];
                    $nome_comune_                                 = $fun->getComune($codice_comune); 
                    $nome_comune                                  = $dbMysqli->escape($nome_comune_['nome_comune']);
                    $indirizzo                                    = addslashes($row['indirizzo']);
                    $cap                                          = $row['cap'];
                    $LatLng                                       = $row['LatLng'];
                    $coordinate                                   = $row['coordinate'];
                    $fax                                          = $row['fax'];
                    $cell                                         = $row['cell'];
                    $whatsapp                                     = $row['whatsapp'];
                    $tel                                          = $row['tel'];
                    $email                                        = $row['email'];
                    $email_alternativa_form_quoto                 = $row['email_alternativa_form_quoto'];
                    $data_creazione_x                             = explode("-",$row['data_creazione']);
                    $data_creazione_tmp                           = explode(" ",$data_creazione_x[2]);
                    $data_creazione_                              = $data_creazione_x[0].'-'.$data_creazione_x[1].'-'.$data_creazione_tmp[0]; 
                    $data_modifica_x                              = explode("-",$row['data_modifica']);
                    $data_modifica_tmp                            = explode(" ",$data_modifica_x[2]);
                    $data_modifica_                               = $data_modifica_x[0].'-'.$data_modifica_x[1].'-'.$data_modifica_tmp[0];
                    $data_creazione                               = $row['data_creazione'];
                    $data_scadenza                                = $row['data_scadenza'];
                    $data_modifica                                = $row['data_modifica'];
                    $link_gmap                                    = addslashes($row['link_gmap']);
                    $link_percorso_gmap                           = addslashes($row['link_percorso_gmap']);
                    $iframe_gmap                                  = addslashes($row['iframe_gmap']);
                    $chiave_sito_recaptcha                        = addslashes($row['chiave_sito_recaptcha']);
                    $chiave_segreta_recaptcha                     = addslashes($row['chiave_segreta_recaptcha']);
                    $chiave_sito_recaptcha_invisible              = addslashes($row['chiave_sito_recaptcha_invisible']);
                    $chiave_segreta_recaptcha_invisible           = addslashes($row['chiave_segreta_recaptcha_invisible']);
                    $note                                         = addslashes(str_replace("\r\n","",$row['note']));
                    $TagManager                                   = $row['TagManager'];
                    $IdAccountAnalytics                           = $row['IdAccountAnalytics'];
                    $IdPropertyAnalytics                          = $row['IdPropertyAnalytics'];
                    $ViewIdAnalytics                              = $row['ViewIdAnalytics'];
                    $PropertyIdAnalyticsGA4                       = $row['PropertyIdAnalyticsGA4'];
                    $measurement_id                               = $row['measurement_id'];
                    $api_secret                                   = $row['api_secret'];
                    $Adwords_ads_CSV                              = addslashes($row['Adwords_ads_CSV']);
                    $Facebook_ads_CSV                             = addslashes($row['Facebook_ads_CSV']);
                    $smtp                                         = $row['smtp'];
                    $authcode                                     = $row['authcode'];
                    $website                                      = $row['website'];
                    $italiaabc                                    = $row['italiaabc'];
                    $sito_migrato                                 = $row['sito_migrato'];
                    $id_status                                    = $row['id_status'];
                    $servizi_attivi                               = $row['servizi_attivi'];
                    $id_tipo_contratto                            = $row['id_tipo_contratto'];
                    $vip                                          = $row['vip'];
                    $hospitality                                  = $row['hospitality'];
                    $LatLng                                       = $row['LatLng'];
                    $no_rinnovo_hospitality                       = $row['no_rinnovo_hospitality'];
                    $API_hospitality                              = $row['API_hospitality'];
                    $WidgetFormQuoto                              = $row['WidgetFormQuoto'];
                    $data_start_hospitality                       = $row['data_start_hospitality'];
                    $data_end_hospitality                         = $row['data_end_hospitality'];
                    $data_start_hospitality_x                     = explode("-",$row['data_start_hospitality']);
                    $data_start_hospitality_                      = $data_start_hospitality_x[0].'-'.$data_start_hospitality_x[1].'-'.$data_start_hospitality_x[2];
                    $data_end_hospitality_x                       = explode("-",$row['data_end_hospitality']);
                    $data_end_hospitality_                        = $data_end_hospitality_x[0].'-'.$data_end_hospitality_x[1].'-'.$data_end_hospitality_x[2];


                    $arrayTipoSito        = $fun->getTipoSito();
                    foreach ($arrayTipoSito as $key => $value) {
                        $listaTipoSiti .= '<option value="'.$value['idtipo'].'" '.($tiposito==$value['idtipo']?'selected="selected"':'').'>'.$value['nome'].'</option>';
                        # code...
                    }
                    $arrayClasse        = $fun->getClassificazioniStutture();
                    foreach ($arrayClasse as $key => $value) {
                        $listaClassi .= '<option value="'.$value['id'].'" '.($classe==$value['id']?'selected="selected"':'').'>'.$value['classe'].'</option>';
                        # code...
                    }
                    $arrayStati        = $fun->getListaStati();
                    foreach ($arrayStati as $key => $value) {
                        $listaStati .= '<option value="'.$value['id_stato'].'" '.($id_stato==$value['id_stato']?'selected="selected"':'').'>'.$value['nome_stato'].'</option>';
                        # code...
                    }
                    $arrayStatus        = $fun->getIdStatus();
                    foreach ($arrayStatus as $key => $value) {
                        $listaStatus .= '<option value="'.$value['id_status'].'" '.($id_status==$value['id_status']?'selected="selected"':'').'>'.$value['descrizione_status'].'</option>';
                        # code...
                    }
                    $arrayServizi        = $fun->getServiziAttivi();
                    $listaServizi .= '<option value="null">--</option>';
                    foreach ($arrayServizi as $key => $value) {
                        $array_servizi_attivi = explode(",",$servizi_attivi);

                        $listaServizi .= '<option value="'.$value['nome_servizio'].'" '.(in_array($value['nome_servizio'],$array_servizi_attivi)?'selected="selected"':'').'>'.$value['nome_servizio'].'</option>';
                        # code...
                    }
                    $arrayContratti       = $fun->getTipoContratto();
                    foreach ($arrayContratti as $key => $value) {
                        $listaContratti .= '<option value="'.$value['id_tipo_contratto'].'" '.($id_tipo_contratto==$value['id_tipo_contratto']?'selected="selected"':'').'>'.$value['nome_contratto'].'</option>';
                        # code...
                    }

                    $output = '<script type="text/javascript">
                                    $(document).ready(function() {
                                        $("#tiposito_update").val(\''.$tiposito.'\');
                                        $("#idsito_update").val(\''.$idsito.'\');
                                        $("#id_update").val(\''.$idsito.'\');									
                                        $("#classe_update").val(\''.$classe.'\');
                                        $("#https_update_").val(\''.$https.'\');
                                        $("#https_update").val(\''.$https.'\');
                                        '.($https==1?'$("#https_update_").attr("checked",true);':'').'
                                        $("#web_update").val(\''.$web.'\');
                                        $("#nome_update").val(\''.$nome.'\');
                                        $("#id_stato_update").val(\''.$id_stato.'\');
                                        $("#codice_regione_update").html(\'<option value="'.$codice_regione.'" >'.$nome_regione.'</option>\');
                                        $("#codice_provincia_update").html(\'<option value="'.$codice_provincia.'">'.$nome_provincia.'</option>\');
                                        $("#codice_comune_update").html(\'<option value="'.$codice_comune.'">'.$nome_comune.'</option>\');
                                        $("#indirizzo_update").val(\''.$indirizzo.'\');                               
                                        $("#cap_update").val(\''.$cap.'\');  
                                        $("#LatLng_update").val(\''.$LatLng.'\');                               
                                        $("#link_gmap_update").val(\''.$link_gmap.'\');
                                        $("#link_percorso_gmap_update").val(\''.$link_percorso_gmap.'\');
                                        $("#iframe_gmap_update").val(\''.$iframe_gmap.'\');
                                        $("#chiave_sito_recaptcha_update").val(\''.$chiave_sito_recaptcha.'\');
                                        $("#chiave_segreta_recaptcha_update").val(\''.$chiave_segreta_recaptcha.'\');
                                        $("#chiave_sito_recaptcha_invisible_update").val(\''.$chiave_sito_recaptcha_invisible.'\');
                                        $("#chiave_segreta_recaptcha_invisible_update").val(\''.$chiave_segreta_recaptcha_invisible.'\');
                                        $("#TagManager_update").val(\''.$TagManager.'\');
                                        $("#IdAccountAnalytics_update").val(\''.$IdAccountAnalytics.'\');
                                        $("#IdPropertyAnalytics_update").val(\''.$IdPropertyAnalytics.'\');
                                        $("#ViewIdAnalytics_update").val(\''.$ViewIdAnalytics.'\');
                                        $("#PropertyIdAnalyticsGA4_update").val(\''.$PropertyIdAnalyticsGA4.'\');
                                        $("#measurement_id_update").val(\''.$measurement_id.'\');
                                        $("#api_secret_update").val(\''.$api_secret.'\');
                                        $("#Adwords_ads_CSV_update").val(\''.$Adwords_ads_CSV.'\');
                                        $("#Facebook_ads_CSV_update").val(\''.$Facebook_ads_CSV.'\');
                                        $("#tel_update").val(\''.$tel.'\');
                                        $("#fax_update").val(\''.$fax.'\');
                                        $("#cell_update").val(\''.$cell.'\');
                                        $("#whatsapp_update").val(\''.$whatsapp.'\');
                                        $("#email_update").val(\''.$email.'\');
                                        $("#email_alternativa_form_quoto_update").val(\''.$email_alternativa_form_quoto.'\');
                                        $("#smtp_update").val(\''.$smtp.'\');
                                        $("#note_update").val(\''.$note.'\');
                                        $("#data_creazione_update_").val(\''.$data_creazione_.'\');
                                        $("#data_creazione_update").val(\''.$data_creazione.'\');
                                        $("#data_modifica_update_").val(\''.$data_modifica_.'\');
                                        $("#data_modifica_").val(\''.$data_modifica.'\');
                                        $("#data_scadenza_update").val(\''.$data_scadenza.'\');
                                        $("#website_update_").val(\''.$website.'\');
                                        $("#website_update").val(\''.$website.'\');
                                        '.($website==1?'$("#website_update_").attr("checked",true);':'').'
                                        $("#italiaabc_update_").val(\''.$italiaabc.'\');
                                        $("#italiaabc_update").val(\''.$italiaabc.'\');
                                        '.($italiaabc==1?'$("#italiaabc_update_").attr("checked",true);':'').'
                                        $("#sito_migrato_update_").val(\''.$sito_migrato.'\');
                                        $("#sito_migrato_update").val(\''.$sito_migrato.'\');
                                        '.($sito_migrato==1?'$("#sito_migrato_update_").attr("checked",true);':'').'
                                        $("#id_status_update").val(\''.$id_status.'\');
                                        $("#servizi_attivi_update_").html(\''.$listaServizi.'\');
                                        $("#id_tipo_contratto_update").val(\''.$id_tipo_contratto.'\');
                                        $("#vip_update_").val(\''.$vip.'\');
                                        $("#vip_update").val(\''.$vip.'\');
                                        '.($vip==1?'$("#vip_update_").attr("checked",true);':'').'
                                        $("#hospitality_update_").val(\''.$hospitality.'\');
                                        $("#hospitality_update").val(\''.$hospitality.'\');
                                        '.($hospitality==1?'$("#hospitality_update_").attr("checked",true);':'').'
                                        $("#no_rinnovo_hospitality_update_").val(\''.$no_rinnovo_hospitality.'\');
                                        $("#no_rinnovo_hospitality_update").val(\''.$no_rinnovo_hospitality.'\');
                                        '.($no_rinnovo_hospitality==1?'$("#no_rinnovo_hospitality_update_").attr("checked",true);':'').'
                                        $("#API_hospitality_update_").val(\''.$API_hospitality.'\');
                                        $("#API_hospitality_update").val(\''.$API_hospitality.'\');
                                        '.($API_hospitality==1?'$("#API_hospitality_update_").attr("checked",true);':'').'
                                        $("#WidgetFormQuoto_update_").val(\''.$WidgetFormQuoto.'\');
                                        $("#WidgetFormQuoto_update").val(\''.$WidgetFormQuoto.'\');
                                        '.($WidgetFormQuoto==1?'$("#WidgetFormQuoto_update_").attr("checked",true);':'').'
                                        $("#data_start_hospitality_update_").val(\''.$data_start_hospitality_.'\');
                                        $("#data_start_hospitality_update").val(\''.$data_start_hospitality.'\');
                                        $("#data_end_hospitality_update_").val(\''.$data_end_hospitality_.'\');
                                        $("#data_end_hospitality_update").val(\''.$data_end_hospitality.'\');
                                    });
                            </script>';	
               
            break;
            case "profilo":
                $tabella                 = 'utenti';
                $action                  = $_REQUEST['action'];
                $param                   = $_REQUEST['param'];
                $id                      = $_REQUEST['id'];
                $order                   = $_REQUEST['order'];
                $typeorder               = $_REQUEST['typeorder'];
                $idVisibile              = $_REQUEST['idVisibile'];
                $where                   = urldecode($_REQUEST['where']);
                $join                    = urldecode($_REQUEST['join']);
                $campiQuery              = urldecode($_REQUEST['campiQuery']);
                $groupBy                 = urldecode($_REQUEST['groupBy']);

                $s  = " SELECT 
                ".($campiQuery!=''?$campiQuery:'*')." 
                    FROM ".$tabella." 
                ".($join!=''?$join:'')." 
                ".($where!=''?$where:'')." 
                ".($groupBy!=''?$groupBy:'')."
                ".($order!=''?'ORDER BY '.$order.' '.$typeorder.'':'')." ";

                $rec = $dbMysqli->query($s);
                
                $row = $rec[0];

                $idutente 	        = $row['idutente'];
                $idsito 	        = $row['idsito'];
                $idanagra 	        = $row['idanagra'];
                $username 	        = $row['username'];
                $password 	        = $row['password'];
                $logo               = ($row['logo']!=''?$row['logo']:'');
                $email              = $row['email'];
                $web 		        = $row['web'];
                $tel 		        = $row['tel'];
                $cell 		        = $row['cell'];
                $rag_soc	        = $row['rag_soc'];
                $id_stato           = $row['id_stato'];
                $nome_stato_        = $fun->getStato($id_stato);
                $nome_stato         = $nome_stato_['nome_stato'];
                $codice_regione     = $row['codice_regione'];
                $nome_regione_      = $fun->getRegione($codice_regione); 
                $nome_regione       = $dbMysqli->escape($nome_regione_['nome_regione']);
                $codice_provincia   = $row['codice_provincia'];
                $nome_provincia_    = $fun->getProvincia($codice_provincia); 
                $nome_provincia     = $nome_provincia_['sigla_provincia'];
                $codice_comune      = $row['codice_comune'];
                $nome_comune_       = $fun->getComune($codice_comune); 
                $nome_comune        = $dbMysqli->escape($nome_comune_['nome_comune']);
                $indirizzo          = addslashes($row['indirizzo']);
                $cap                = $row['cap']; 

                $arrayStati         = $fun->getListaStati();
                foreach ($arrayStati as $key => $value) {
                    $listaStati .= '<option value="'.$value['id_stato'].'" '.($id_stato==$value['id_stato']?'selected="selected"':'').'>'.$value['nome_stato'].'</option>';
                    # code...
                }

                $output = '<script type="text/javascript">
                             $(document).ready(function() {
                                    $("#idutente").val(\''.$idutente.'\');
                                    $("#idsito").val(\''.$idsito.'\');
                                    $("#idanagra").val(\''.$idanagra.'\');

                                    $("#logo").html(\'<a href="'.BASE_URL_SITO.'uploads/loghi_siti/'.$logo.'" class="img-link" data-lightbox="'.$idsito.'"><img src="'.BASE_URL_SITO.'class/resize.class.php?src='.BASE_PATH_SITO.'uploads/loghi_siti/'.$logo.'&w=140&h=140&a=c&q=100" class="img-fluid img-thumbnail"></a>\');
                                    $("#rag_soc_select").html(\''.$rag_soc.'\');
                                    $("#rag_soc").val(\''.$rag_soc.'\');      
                                    $("#username_select").html(\''.$username.'\');
                                    $("#username").val(\''.$username.'\');  
                                    $("#password_select").html(\''.$password.'\');
                                    $("#password").val(\''.$password.'\'); 
                                    $("#web_select").html(\''.$web.'\');
                                    $("#web").val(\''.$web.'\'); 
                                    $("#tel_select").html(\''.$tel.'\');
                                    $("#tel").val(\''.$tel.'\'); 
                                    $("#cell_select").html(\''.$cell.'\');
                                    $("#cell").val(\''.$cell.'\'); 
                                    $("#email_select").html(\''.$email.'\');
                                    $("#email").val(\''.$email.'\'); 
                                    $("#indirizzo_select").html(\''.$indirizzo.'\');
                                    $("#indirizzo").val(\''.$indirizzo.'\'); 
                                    $("#cap_select").html(\''.$cap.'\');
                                    $("#cap").val(\''.$cap.'\'); 
                                    $("#id_stato_select").html(\''.$nome_stato.'\');
                                    $("#id_stato").val(\''.$id_stato.'\');
                                    $("#codice_regione").html(\'<option value="'.$codice_regione.'" >'.$nome_regione.'</option>\');
                                    $("#codice_regione_select").html(\''.$nome_regione.'\');
                                    $("#codice_provincia").html(\'<option value="'.$codice_provincia.'">'.$nome_provincia.'</option>\');
                                    $("#codice_provincia_select").html(\''.$nome_provincia.'\');
                                    $("#codice_comune").html(\'<option value="'.$codice_comune.'">'.$nome_comune.'</option>\');
                                    $("#codice_comune_select").html(\''.$nome_comune.'\');
                            });
                        </script>';	
            break;
            case "anagrafica":

                $action                  = $_REQUEST['action'];
                $param                   = $_REQUEST['param'];
                $id                      = $_REQUEST['id'];
                $order                   = $_REQUEST['order'];
                $typeorder               = $_REQUEST['typeorder'];
                $idVisibile              = $_REQUEST['idVisibile'];
                $where                   = urldecode($_REQUEST['where']);
                $join                    = urldecode($_REQUEST['join']);
                $campiQuery              = urldecode($_REQUEST['campiQuery']);
                $groupBy                 = urldecode($_REQUEST['groupBy']);

                $s  = " SELECT
                            anagrafica.*,
                            status.descrizione_status
                        FROM
                            anagrafica
                        INNER JOIN 
                            status ON status.id_status = anagrafica.id_status
                        WHERE  
                            anagrafica.idanagra = ".$id;

                $rec = $dbMysqli->query($s);
                
                $row = $rec[0];

                $idanagra 	          = ($row['idanagra']==''?$id:$row['idanagra']);
                $id_adhoc 	          = $row['id_adhoc'];
                $id_status 	          = $row['id_status'];
                $nome 	              = $row['nome'];
                $cognome 	          = $row['cognome'];
                $rag_soc 	          = $row['rag_soc'];
                $p_iva 	              = $row['p_iva'];
                $codice_fiscale 	  = $row['codice_fiscale'];
                $id_stato             = $row['id_stato'];
                $codice_regione       = $row['codice_regione'];
                $nome_regione_        = $fun->getRegione($codice_regione); 
                $nome_regione         = $dbMysqli->escape($nome_regione_['nome_regione']);
                $codice_provincia     = $row['codice_provincia'];
                $nome_provincia_      = $fun->getProvincia($codice_provincia); 
                $nome_provincia       = $nome_provincia_['sigla_provincia'];
                $codice_comune        = $row['codice_comune'];
                $nome_comune_         = $fun->getComune($codice_comune); 
                $nome_comune          = $dbMysqli->escape($nome_comune_['nome_comune']);
                $indirizzo            = addslashes($row['indirizzo']);
                $cap                  = $row['cap'];
                $tel                  = $row['tel'];
                $fax                  = $row['fax'];
                $cell                 = $row['cell'];
                $email                = $row['email'];
                $pec1                 = $row['pec1'];
                $pec2                 = $row['pec2'];
                $contenzioso          = $row['contenzioso'];
                $note                 = addslashes($row['note']);
                $data_creazione_x      = explode("-",$row['data_creazione_anagra']);
                $data_creazione_tmp    = explode(" ",$data_creazione_x[2]);
                $data_creazione_anagra_       = $data_creazione_x[0].'-'.$data_creazione_x[1].'-'.$data_creazione_tmp[0];
                $data_modifica_x       = explode("-",$row['data_modifica_anagra']);
                $data_modifica_tmp     = explode(" ",$data_modifica_x[2]);
                $data_modifica_anagra_        = $data_modifica_x[0].'-'.$data_modifica_x[1].'-'.$data_modifica_tmp[0];
                $data_creazione_anagra        = $row['data_creazione_anagra'];
                $data_modifica_anagra         = $row['data_modifica_anagra'];

                $arrayStati         = $fun->getListaStati();
                foreach ($arrayStati as $key => $value) {
                    $listaStati .= '<option value="'.$value['id_stato'].'" '.($id_stato==$value['id_stato']?'selected="selected"':'').'>'.$value['nome_stato'].'</option>';
                    # code...
                }
                $arrayStatus          = $fun->getIdStatus();
                foreach ($arrayStatus as $key => $value) {
                    $listaStatus .= '<option value="'.$value['id_status'].'" '.($id_status==$value['id_status']?'selected="selected"':'').'>'.$value['descrizione_status'].'</option>';
                    # code...
                }
                $codice_destinatario  = $row['codice_destinatario'];


                $output = '<script type="text/javascript">
                             $(document).ready(function() {
                                    $("#id_").val(\''.$id.'\');
                                    $("#idanagra_").val(\''.$idanagra.'\');
                                    $("#id_adhoc_").val(\''.$id_adhoc.'\');
                                    $("#nome_").val(\''.$nome.'\');
                                    $("#cognome_").val(\''.$cognome.'\');
                                    $("#rag_soc_").val(\''.$rag_soc.'\');
                                    $("#p_iva_").val(\''.$p_iva.'\');
                                    $("#codice_fiscale_").val(\''.$codice_fiscale.'\');
                                    $("#codice_destinatario_").val(\''.$codice_destinatario.'\');
                                    $("#id_stato_").html(\''.$listaStati.'\');
                                    $("#codice_regione_").html(\'<option value="'.$codice_regione.'" >'.$nome_regione.'</option>\');                 
                                    $("#codice_provincia_").html(\'<option value="'.$codice_provincia.'">'.$nome_provincia.'</option>\');
                                    $("#codice_comune_").html(\'<option value="'.$codice_comune.'">'.$nome_comune.'</option>\');
                                    $("#indirizzo_").val(\''.$indirizzo.'\');
                                    $("#cap_").val(\''.$cap.'\');
                                    $("#tel_").val(\''.$tel.'\');
                                    $("#fax_").val(\''.$fax.'\');
                                    $("#cell_").val(\''.$cell.'\');
                                    $("#email_").val(\''.$email.'\');
                                    $("#pec1_").val(\''.$pec1.'\');
                                    $("#pec2_").val(\''.$pec2.'\');
                                    $("#contenzioso_").val(\''.$contenzioso.'\');
                                    $("#data_creazione_up").val(\''.$data_creazione_anagra_.'\');
                                    $("#data_creazione_anagra_").val(\''.$data_creazione_anagra.'\');
                                    $("#data_modifica_up").val(\''.$data_modifica_anagra_.'\');
                                    $("#data_modifica_anagra_").val(\''.$data_modifica_anagra.'\');

                                    $("#id_status_").html(\''.$listaStatus.'\');
                                    
                            });
                        </script>';	
            break;
            case 'utenti';

                   
            $id                      = $_REQUEST['id'];
            $param_where             = $_REQUEST['parametro'];
        
            # QUERY PER COMPILARE IL DATATABLE
            $s  = " SELECT *  FROM ".$tabella." WHERE ".$param_where." = ".$id."";
        
            $rec = $dbMysqli->query($s);
        
            $row = $rec[0];
           
         

            $idsito                 = $row['idsito'];	
            $idutente               = $row['idutente'];
            $idanagra               = $row['idanagra'];
            $logo                   = $row['logo'];
            $username               = addslashes($row['username']);
            $password               = base64_decode($row['password']);
            $blocco_accesso         = $row['blocco_accesso'];
            $is_admin               = $row['is_admin'];
            $matricola              = $row['matricola'];
            $data_creazione_x       = explode("-",$row['data_creazione']);
            $data_creazione_tmp     = explode(" ",$data_creazione_x[2]);
            $data_creazione_        = $data_creazione_x[0].'-'.$data_creazione_x[1].'-'.$data_creazione_tmp[0];
            $data_modifica_x        = explode("-",$row['data_modifica']);
            $data_modifica_tmp      = explode(" ",$data_modifica_x[2]);
            $data_modifica_         = $data_modifica_x[0].'-'.$data_modifica_x[1].'-'.$data_modifica_tmp[0];
            $data_creazione         = $row['data_creazione'];
            $data_modifica          = $row['data_modifica'];
            $ut_email               = $row['ut_email'];
            $ut_nome                = addslashes($row['ut_nome']);
            $ut_cognome             = addslashes($row['ut_cognome']);
            $ut_colore              = ($row['ut_color']);
            $flag_dashboard_view    = $row['flag_dashboard_view'];
            $flag_utente_view       = $row['flag_utente_view'];
            $ut_note                = addslashes($row['ut_cnote']);


            $arrayTipoUtenti  = $fun->getArrayTipoUtenti($idutente);
            $arTUtenti        = $fun->getTipoUtenti();
            $lTUtenti .= '<option value="null">--</option>'; 
             foreach ($arTUtenti as $key => $value) {    
                $lTUtenti .= '<option value="'.$value['id_tipo_utente'].'" '.(in_array($value['id_tipo_utente'],$arrayTipoUtenti)?'selected="selected"':'').'>'.$value['tipo_utente'].'</option>';

            }  
            $arrayClienti        = $fun->getClienti();
            foreach ($arrayClienti as $key => $value) {
                $listaClienti .= '<option value="'.$value['idanagra'].'" '.($idanagra==$value['idanagra']?'selected="selected"':'').'>'.addslashes($value['rag_soc']).'</option>';
                # code...
            }
            $arraySiti        = $fun->getSiti();
            foreach ($arraySiti as $key => $value) {
                $listaSiti .= '<option value="'.$value['idsito'].'" '.($idsito==$value['idsito']?'selected="selected"':'').'>'.$value['web'].'</option>';
                # code...
            }
                  // 
            $output = '<script type="text/javascript">
                            $(document).ready(function() {
                                $("#id_update").val(\''.$idutente.'\');
                                $("#idutente_update").val(\''.$idutente.'\');
                                $("#id_tipo_utente_update_").html(\''.$lTUtenti.'\');
                                $("#id_tipo_utente_update").val(\''.implode(",",$arrayTipoUtenti).'\');
                                $("#idsito_update").html(\''.$listaSiti.'\');								
                                $("#idanagra_update").html(\''.$listaClienti.'\');
                                '.($logo!=""?'
                                    $("#logo_view").html(\'<a href="'.BASE_URL_SITO.'uploads/loghi_siti/'.$logo.'" class="img-link" data-lightbox="'.$idsito.'"><img src="'.BASE_URL_SITO.'class/resize.class.php?src='.BASE_PATH_SITO.'uploads/loghi_siti/'.$logo.'&w=250&h=&a=c&q=100" class="img-fluid img-thumbnail"></a>\');
                                ':
                                    '$("#logo_view").html(\'<i class="fa fa-image fa-fw fa-3x"></i>\');
                                ').'
                                $("#logo").val(\''.$logo.'\');
                                $("#username_update").val(\''.$username.'\');
                                $("#password_update").val(\''.$password.'\');
                                $("#blocco_accesso_update").val(\''.$blocco_accesso.'\');
                                '.($blocco_accesso==1?'$("#blocco_accesso_update").attr("checked",true);':'').'
                                $("#is_admin_update").val(\''.$is_admin.'\');
                                '.($is_admin==1?'$("#is_admin_update").attr("checked",true);':'').'
                                $("#matricola_update").val(\''.$matricola.'\');
                                $("#data_creazione_update_").val(\''.$data_creazione_.'\');
                                $("#data_creazione_update").val(\''.$data_creazione.'\');
                                $("#data_modifica_update_").val(\''.$data_modifica_.'\');
                                $("#data_modifica_").val(\''.$data_modifica.'\');
                                $("#ut_email_update").val(\''.$ut_email.'\');
                                $("#ut_nome_update").val(\''.$ut_nome.'\');
                                $("#ut_cognome_update").val(\''.$ut_cognome.'\');
                                $("#ut_colore_update").val(\''.$ut_colore.'\');
                                $("#flag_dashboard_view_update").val(\''.$flag_dashboard_view.'\');
                                '.($flag_dashboard_view==1?'$("#flag_dashboard_view_update").attr("checked",true);':'').'
                                $("#flag_utente_view_update").val(\''.$flag_utente_view.'\');
                                '.($flag_utente_view==1?'$("#flag_utente_view_update").attr("checked",true);':'').'
                                $("#ut_note_update").val(\''.$ut_note.'\');
                            });
                    </script>';	
       
    break;
		}
        echo $output;
?>
