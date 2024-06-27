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
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");

                   
                    $id                      = $_REQUEST['id'];
                
                    # QUERY PER COMPILARE IL DATATABLE
                    $s  = " SELECT * FROM hospitality_guest WHERE Id = ".$id."";
                
                    $rec = $dbMysqli->query($s);
                
                    $row = $rec[0];

                    $Id                                  = $row['Id'];
                    $idsito                              = $row['idsito'];	
                    $idTemplate                          = $row['id_template'];
                    $Nome                                = stripslashes($row['Nome']);
                    $Cognome                             = stripslashes($row['Cognome']);
                    $Operatore                           = stripslashes($row['ChiPrenota']);
                    $EmailOperatore                      = $row['EmailSegretaria'];
                    $Email                               = $row['Email'];
                    $Cellulare                           = $row['Cellulare'];
                    $Lingua                              = $row['Lingua'];
                    $DataRichiesta                       = gira_data($row['DataRichiesta']);
                    $TipoVacanza                         = $row['TipoVacanza'];
                    $FontePrenotazione                   = $row['FontePrenotazione'];
                    $NumeroPrenotazione                  = $row['NumeroPrenotazione'];
                    $PrefissoInternazionale              = $row['PrefissoInternazionale'];
                    $DataScadenza                        = $row['DataScadenza'];
                    $DataChiuso                          = $row['DataChiuso'];
                    $DataInvio                           = $row['DataInvio'];
                    $DataArrivo                          = $row['DataArrivo'];
                    $Visibile                            = $row['Visibile'];
                    $SendCS                              = $row['SendCS'];

                    $SendInfo                            = $row['SendInfo'];
                    $SendRE                              = $row['SendRE'];
                    $Note                                = $row['Note'];

                    if($idTemplate!= '' && $idTemplate!= 0){
                        $NomeTemplate = $fun->get_template($idsito,$idTemplate);
                        $NomeTemplate = ucfirst($NomeTemplate);
                    }else{
                        $NomeTemplate = '';
                    }

                    if($fun->check_recall_cs($idsito)!='' || $fun->check_recall_cs($idsito)=='0'){
                        $recall_cs_attivo = 1;
                    }else{
                        $recall_cs_attivo = 0;
                    }

                    if($fun->check_recall_precheckin($idsito)!='' || $fun->check_recall_precheckin($idsito)=='0'){
                        $recall_precheckin_attivo = 1;
                    }else{
                        $recall_precheckin_attivo = 0;
                    }
                    
                    if($fun->check_recall_checkinonline($idsito)!='' || $fun->check_recall_checkinonline($idsito)=='0'){
                        $recall_checkinonline_attivo = 1;
                    }else{
                        $recall_checkinonline_attivo = 0;
                    }

                    if($fun->check_recall_reselling($idsito)!='' || $fun->check_recall_reselling($idsito)== '0'){
                        $recall_reselling_attivo = 1;
                    }else{
                        $recall_reselling_attivo = 0;
                    }  

                    if($fun->check_recall_recensioni($idsito)!='' || $fun->check_recall_recensioni($idsito)=='0'){
                        $recall_recensioni_attivo = 1;
                    }else{
                        $recall_recensioni_attivo = 0;
                    }

                    if(strstr($FontePrenotazione,'Sito Web')){
                        $labelNote = ' Se la richiesta proviene dal proprio sito, le note si compilano automaticamente con i valori: età bambini, trattamento e sistemazione; naturalmente se i campi sono presenti e compilati dal richiedente! Il contenuto sarà utile all\'operatore di Quoto per compilare la proposta di soggiorno.';
                    }else{
                        $labelNote = 'Il campo è visibile solo all\'operatore di Quoto, il suo contenuto è individuabile nella stampa del PDF!';
                    }

                    if($TipoVacanza==''){
                        $TipoVacanza = '<label class="badge badge-inverse-danger f-11">Da impostare</label>';
                    }else{
                        $TipoVacanza = $TipoVacanza;
                    }

                    if($FontePrenotazione==''){
                        $FontePrenotazione = '<label class="badge badge-inverse-danger f-11">Da impostare</label>';
                    }else{
                        $FontePrenotazione = $FontePrenotazione;
                    }

                    // preparazione link anteprima
                    $grafica = $fun->check_template($idsito);
                    $chek_l_t = $fun->check_landing_template($idsito,$Id);

                    if($chek_l_t != 'smart'){
                        $chek_l_t = $fun->check_landing_type_template($idsito,$Id);
                    }

                    if($grafica != 'default'){
                        $grafica = $fun->check_landing_type_template($idsito,$Id);
                    }

                    $directory   = $fun->DirectorySito($idsito);

                    if($chek_l_t!=''){
                        if($chek_l_t=='default'){
                            $linkPreview = (BASE_URL_LANDING.$directory.'/'.base64_encode($Id.'_'.$idsito.'_c').'/index/');                        
                        }else{
                            $linkPreview = (BASE_URL_LANDING.$chek_l_t.'/'.$directory.'/'.base64_encode($Id.'_'.$idsito.'_c').'/index/');
                        }                
                    }else{
                        if($grafica=='default'){
                            $linkPreview = (BASE_URL_LANDING.$directory.'/'.base64_encode($Id.'_'.$idsito.'_c').'/index/');                 
                        }else{
                            $linkPreview = (BASE_URL_LANDING.$grafica.'/'.$directory.'/'.base64_encode($Id.'_'.$idsito.'_c').'/index/');
                        }                														
                    }	   

                    $linkPreviewVoucher =   (BASE_URL_LANDING.$directory.'/'.base64_encode($Id.'_'.$idsito.'_c').'/voucher/');                 

                    echo'<button class="btn btn-primary btn-sm f-right cursore" id="closeButtonInfoBox">Chiudi dettaglio <i class="fa fa-times" data-toggle="tooltip" title="Chiudi i Box detaglio"></i></button> 
                                    <div class="clearfix p-b-10"></div>           
                                        <div class="row row-eq-height" id="infobox">                                                   
                                            <div class="clearfix p-b-20"></div>
                                            <div class="col-md-4">
                                                <div class="card  col-eq-height">
                                                    <div class="card-header">';
                        echo'                           <h5 class="text-primary">DETTAGLIO PRENOTAZIONE <b class="text-black f-18 p-l-10">Nr. '.$NumeroPrenotazione.'</b> <b class="p-l-30 text-gray f-11">[ID: '.$Id.']</b></h5> ';                                                                                   
                        echo'                       </div>
                                                    <div class="card-block">
                                                            <ul class="nav nav-tabs md-tabs" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" data-toggle="tab" href="#anagrafica" role="tab"><b>ANAGRAFICA</b></a>
                                                                    <div class="slide"></div>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-toggle="tab" href="#proposte" role="tab"><b>PROPOSTA</b></a>
                                                                    <div class="slide"></div>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-toggle="tab" href="#timeline" role="tab"><b>TIMELINE</b></a>
                                                                    <div class="slide"></div>
                                                                </li>
                                                            </ul>
                                                            <!-- Tab panes -->
                                                            <div class="tab-content card-block">
                                                                <div class="tab-pane active f-13" id="anagrafica" role="tabpanel">
                                                                    
                                                                        <div class="row">
                                                                            <div class="col-md-5"><b>Nome</b></div>
                                                                            <div class="col-md-7">'.$Nome.'</div>
                                                                        </div>
                                                                        <div class="clearfix p-b-20"></div>
                                                                        <div class="row">
                                                                            <div class="col-md-5"><b>Cognome</b></div>
                                                                            <div class="col-md-7">'.$Cognome.'</div>
                                                                        </div>
                                                                        <div class="clearfix p-b-20"></div>
                                                                        <div class="row">
                                                                            <div class="col-md-5"><b>E-mail</b></div>
                                                                            <div class="col-md-7">'.$Email.'</div>
                                                                        </div>
                                                                        <div class="clearfix p-b-20"></div>
                                                                        <div class="row">
                                                                            <div class="col-md-5"><b>Lingua</b></div>
                                                                            <div class="col-md-7"><img src="'.BASE_URL_SITO.'img/flags/mini/'.$Lingua.'.png"></div>
                                                                        </div>
                                                                        <div class="clearfix p-b-20"></div>
                                                                        <div class="row">
                                                                            <div class="col-md-5"><b>Cellulare</b></div>
                                                                            <div class="col-md-7">'.($PrefissoInternazionale!=''?'+'.$PrefissoInternazionale:'').' '.$Cellulare.'</div>
                                                                        </div>
                                                                        '.($fun->utenti_online($idsito,$Id)!=''?
                                                                        '<div class="clearfix p-b-30"></div>
                                                                        <div class="row">
                                                                            <div class="col-md-5"><b>Utente OnLine</b></div>
                                                                            <div class="col-md-7"><span class="p-r-10">Sta visualizzando<br/> la prenotazione oppure il voucher!</span> '.$fun->utenti_online($idsito,$Id).'</div>
                                                                        </div>'
                                                                        :'').'                                                                   
                                                                </div>
                                                                <div class="tab-pane  f-13" id="proposte" role="tabpanel">
                                                                    <div class="row">
                                                                        <div class="col-md-12"  id="dettTab">
                                                                            '.$fun->dettaglio_richiesta($NumeroPrenotazione,$idsito).'
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix p-b-20"></div>
                                                                    '.($fun->check_proposta($NumeroPrenotazione,$idsito)==true?
                                                                        '<div class="row">
                                                                            <div class="col-md-6"><a href="'.$linkPreview.'" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Visualizza prenotazione</a></div>  
                                                                            <div class="col-md-6"><a href="'.$linkPreviewVoucher.'" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Visualizza voucher</a></div>                                                                         
                                                                        </div>
                                                                        <div class="clearfix p-b-30"></div>
                                                                        <div class="row">
                                                                            <div class="col-md-6"><b>Invia nuovamente il Voucher</b></div>
                                                                            <div class="col-md-6"><a href="'.BASE_URL_SITO.'send_voucher/send/'.$Id.'" class="btn btn-primary btn-sm"><i class="fa fa-send"></i> Re-invia voucher</a></div>
                                                                        </div>
                                                                        <div class="clearfix p-b-30"></div>
                                                                        <div class="row">
                                                                            <div class="col-md-6"><b>Riepilogo prenotazione in PDF</b></div>
                                                                            <div class="col-md-6"><a href="'.BASE_URL_SITO.'print_pdf/'.base64_encode($Id).'" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-file-pdf-o"></i> Stampa PDF</a></div>
                                                                        </div>
                                                                        <div class="clearfix p-b-30"></div>
                                                                        <div class="row">
                                                                            <div class="col-md-12 f-13"><span class="f-w-900">Template Usato:</span> '.$NomeTemplate.'</div>
                                                                        </div>'
                                                                    :'').'
                                                                </div>
                                                                <div class="tab-pane  f-13" id="timeline" role="tabpanel">  

                                                                    <div class="row">
                                                                        <div class="col-md-5"><b>Data Richiesta</b></div>
                                                                        <div class="col-md-7">'.$DataRichiesta.'</div>
                                                                    </div>    
                                                                    <div class="clearfix p-b-20"></div>                                                              
                                                                    <div class="row" id="datainvio'.$Id.'">
                                                                        <div class="col-md-5 nowrap"><b>Data Invio Conferma</b></div>
                                                                        <div class="col-md-7">'.$fun->get_invio($DataInvio,$Id).'</div>
                                                                    </div>
                                                                    <div class="clearfix p-b-20"></div>
                                                                    <div class="row">
                                                                        <div class="col-md-5"><b>Aperture</b></div>
                                                                        <div class="col-md-7">'.$fun->conta_click($Id,$idsito,$DataInvio,$DataScadenza).'</div>
                                                                    </div> 
                                                                    <div class="clearfix p-b-20"></div>
                                                                    <div class="row">
                                                                        <div class="col-md-5"><b>Target</b></div>
                                                                        <div class="col-md-7">'.$TipoVacanza.'</div>
                                                                    </div>
                                                                    <div class="clearfix p-b-20"></div>
                                                                    <div class="row">
                                                                        <div class="col-md-5"><b>Fonte</b></div>
                                                                        <div class="col-md-7">'.$FontePrenotazione.'</div>
                                                                    </div>    
                                                                    <div class="clearfix p-b-20"></div>                                                              
                                                                    <div class="row">
                                                                        <div class="col-md-5 nowrap"><b>Data Scadenza</b></div>  
                                                                        <div class="col-md-7">'.$fun->gira_data($DataScadenza).' '.(($DataScadenza != '' && $DataScadenza < date('Y-m-d'))?'<span class="text-danger p-l-10">Scaduta</span>':'').'</div>           
                                                                    </div>
                                                                    <div class="clearfix p-b-20"></div>
                                                                    <div class="row">
                                                                        <div class="col-md-5"><b>Pagamento</b></div>
                                                                        <div class="col-md-7">'.$fun->getPagamento($Id,$idsito).'</div>
                                                                    </div>
                                                                    '.$fun->ReferralAds($idsito,$NumeroPrenotazione).'  
                                                                    <div class="clearfix p-b-20">&nbsp;</div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card col-eq-height">
                                                    <div class="card-header">
                                                        <h5 class="text-primary">AZIONI PRENOTAZIONE</h5>                                                                                         
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="row" id="azioniPreno'.$Id.'">
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <i class="fa fa-edit fa-2x fa-fw text-black"></i>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <b>MODIFICA</b><br>
                                                                        <span class="f-12">Apri la maschera di modifica per variare la prenotazione confermata</span>
                                                                        <div class="clearfix p-b-10"></div>
                                                                        <a href="'.BASE_URL_SITO.'modifica_proposta/edit/'.$Id.'" class="btn btn-primary btn-sm">Apri</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <i class="fa fa-comments fa-2x fa-fw text-black"></i>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <b>CHAT</b><br>
                                                                        <span class="f-12">Chatta con il cliente, il quale ha confermato la proposta</span>
                                                                        <div class="clearfix p-b-10"></div>
                                                                        '.$fun->func_chat($NumeroPrenotazione,$DataInvio,$DataScadenza,$DataChiuso,$DataArrivo,$idsito,$id,'conferme').'
                                                                        <!-- MODALE CHAT -->
                                                                        <div class="modal fade" id="idChat'.$id.'"  role="dialog" aria-labelledby="idChat'.$id.'">
                                                                            <div class="modal-dialog modal-lg" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title nowrap" id="myModalLabel">Chat!</h4>
                                                                                            <div style="position:absolute;top:10px;right:10px;">
                                                                                                <i class="fa fa-times" id="pul_close'.$id.'" class="btn btn-out-dotted btn-inverse btn-square btn-sm" data-dismiss="modal" aria-label="Close" style="float:right"></i>
                                                                                            </div>
                                                                                            <div class="clearfix p-b-20"></div>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                            <iframe src="'.BASE_URL_SITO.'ajax/chat/dashboard_chat.php?NumeroPrenotazione='.$NumeroPrenotazione.'&idsito='.$idsito.'" frameborder="no" scrolling="yes" onload="resizeIframe(this)" style="min-height:800px;width:100%"></iframe>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <i class="fa fa-tag fa-2x fa-fw text-black"></i>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <b>BUONO VOUCHER</b><br>
                                                                        <span class="f-12">Clicca per inviare il template del buono voucher al cliente</span>
                                                                        <div class="clearfix p-b-10"></div>
                                                                        <a href="#" id="vau_rec_'.$Id.'" onclick="open_voucher_recupero(\'vau_rec_'.$Id.'\')"class="btn btn-primary btn-sm">Invia</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>';

                                        echo'           <div class="clearfix p-b-30"></div>
                                                        <div class="row">'."\r\n";
                                                    if($recall_cs_attivo==0){
                                                        echo'<div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <i class="fa fa-star fa-2x fa-fw text-black"></i>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <b>QUESTIONARIO</b><br>
                                                                        <span class="f-12">Invia questionario della customer satisfaction</span>
                                                                        <div class="clearfix p-b-10"></div>
                                                                        <a href="#" id="pul_send_questionario'.$Id.'" class="btn btn-primary btn-sm">Invia</a>
                                                                    </div>
                                                                </div>
                                                            </div>';
                                                    }else{
                                                        echo'<div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <i class="fa fa-star fa-2x fa-fw text-black"></i>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <b>DISABILITA INVIO QUESTIONARIO</b><br>
                                                                        <span class="f-12">Disabilita autoresponder invio del Questionario</span>
                                                                        <div class="clearfix p-b-10"></div>
                                                                        <div id="questionario'.$Id.'">
                                                                            <i class="fa fa-square-o fa-2x fa-fw text-black" data-id="'.$Id.'" id="Quest'.$Id.'" '.($SendCS==0?'style="display:none"':'').'></i>           
                                                                            <i class="fa fa-check-square-o fa-2x fa-fw text-black" data-id="'.$Id.'" id="noQuest'.$Id.'" '.($SendCS==1?'style="display:none"':'').'></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>';
                                                    }
                                                    if($recall_checkinonline_attivo == 0){
                                                        echo'<div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <i class="fa fa-vcard fa-2x fa-fw text-black"></i>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <b>CHECK-IN ONLINE</b><br>
                                                                        <span class="f-12">Invia il modulo per il Check-In Online</span>
                                                                        <div class="clearfix p-b-10"></div>
                                                                        <a href="#" id="pul_send_checkin'.$Id.'" class="btn btn-primary btn-sm">Invia</a>
                                                                    </div>
                                                                </div>
                                                            </div>'."\r\n";
                                                        }else{
/*                                                             echo'<div class="col-md-4">
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <i class="fa fa-vcard fa-2x fa-fw text-black"></i>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <b>DISABILITA INVIO CHECK-IN ONLINE</b><br>
                                                                            <span class="f-12">Disabilita autoresponder dell\'invio del modulo di Check-In OnLine</span>
                                                                            <div class="clearfix p-b-10"></div>
                                                                            <div id="checkinonline'.$Id.'">
                                                                                <i class="fa fa-square-o fa-2x fa-fw text-black" data-id="'.$Id.'" id="Chec'.$Id.'" '.($SendCheckin==0?'style="display:none"':'').'></i>           
                                                                                <i class="fa fa-check-square-o fa-2x fa-fw text-black" data-id="'.$Id.'" id="noChec'.$Id.'" '.($SendCheckin==1?'style="display:none"':'').'></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>'; */
                                                        }
                                                    echo'   <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <i class="fa fa-tripadvisor fa-2x fa-fw text-black"></i>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <b>RECENSIONE</b><br>
                                                                        <span class="f-12">Invia la richiesta di una recensione su TripAdvisor</span>
                                                                        <div class="clearfix p-b-10"></div>
                                                                        <a href="#" id="pul_send_recensione'.$Id.'" class="btn btn-primary btn-sm">Invia</a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        '.(($recall_reselling_attivo==1 || $recall_precheckin_attivo==1 || $recall_recensioni_attivo==1)?'
                                                        <div class="clearfix p-b-30"></div>
                                                        <div class="row">':'');
                                                        if($recall_reselling_attivo==1){
                                                            echo'<div class="col-md-4">
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <i class="fa fa-send-o fa-2x fa-fw text-black"></i>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <b>DISABILITA EMAIL DI BENVENUTO</b><br>
                                                                            <span class="f-12">Disabilita autoresponder dell\'invio della email di Benvenuto</span>
                                                                            <div class="clearfix p-b-10"></div>
                                                                            <div id="reselling'.$Id.'">
                                                                                <i class="fa fa-square-o fa-2x fa-fw text-black" data-id="'.$Id.'" id="Ben'.$Id.'" '.($Visibile==0?'style="display:none"':'').'></i>           
                                                                                <i class="fa fa-check-square-o fa-2x fa-fw text-black" data-id="'.$Id.'" id="noBen'.$Id.'" '.($Visibile==1?'style="display:none"':'').'></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                                                        }
                                                        if($recall_precheckin_attivo==1){
                                                            echo'<div class="col-md-4">
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <i class="fa fa-info fa-2x fa-fw text-black"></i>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <b>DISABILITA INVIO PRE-CHECK-IN</b><br>
                                                                            <span class="f-12">Disabilita autoresponder dell\'invio della email di Pre-check-in</span>
                                                                            <div class="clearfix p-b-10"></div>
                                                                            <div id="precheckin'.$Id.'">
                                                                                <i class="fa fa-square-o fa-2x fa-fw text-black" data-id="'.$Id.'" id="PreCheck'.$Id.'" '.($SendInfo==0?'style="display:none"':'').'></i>           
                                                                                <i class="fa fa-check-square-o fa-2x fa-fw text-black" data-id="'.$Id.'" id="noPreCheck'.$Id.'" '.($SendInfo==1?'style="display:none"':'').'></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                                                        }
                                                         if($recall_recensioni_attivo==1){
                                                            echo'<div class="col-md-4">
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <i class="fa fa-tripadvisor fa-2x fa-fw text-black"></i>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <b>DISABILITA AUTO-INVIO RECENSIONI</b><br>
                                                                            <span class="f-12">Disabilita autoresponder dell\'invio per la richiesta di recensioni su TripAdvisor</span>
                                                                            <div class="clearfix p-b-10"></div>
                                                                            <div id="recens'.$Id.'">
                                                                                <i class="fa fa-square-o fa-2x fa-fw text-black" data-id="'.$Id.'" id="Rec'.$Id.'" '.($SendRE==0?'style="display:none"':'').'></i>           
                                                                                <i class="fa fa-check-square-o fa-2x fa-fw text-black" data-id="'.$Id.'" id="noRec'.$Id.'" '.($SendRE==1?'style="display:none"':'').'></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                                                         }

                                            echo       (($recall_reselling_attivo==1 || $recall_precheckin_attivo==1 || $recall_recensioni_attivo==1)?'</div>':'');
                                            echo'       <div class="clearfix p-b-30"></div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <i class="fa fa-calendar fa-2x fa-fw text-black"></i>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <b>DATA SCADENZA</b><br>
                                                                        <span class="f-12"><b>Data scadenza visualizzazione prenotazione</b> '.(($DataScadenza != '' && $DataScadenza < date('Y-m-d'))?'<div class="clearfix "></div><span class="text-danger">Scaduta</span>':'').'</span>
                                                                        <div class="clearfix p-b-10"></div>
                                                                        <form method="POST" name="form_data">
                                                                            <div class="control-group">
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                                                    <input type="date" class="form-control form-control-sm" id="DataScadenza'.$Id.'"  name="DataScadenza" value="'.$DataScadenza.'" required/>
                                                                                    <input type="hidden" name="idrichiesta" id="idrichiesta'.$Id.'" value="'.$Id.'">
                                                                                    <input type="hidden" name="action" value="send_data">
                                                                                    <div class="p-l-10"><button type="button" id="pul_form_data'.$Id.'" class="btn btn-primary btn-sm">Salva</button></div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <i class="fa fa-minus-circle fa-2x fa-fw text-black"></i>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <b>DISDETTA</b><br>
                                                                        <span class="f-12">Invia email di disdetta per la prenotazione</span>
                                                                        <div class="clearfix p-b-10"></div>
                                                                        <a  href="javascript:validator_disdetta(\''.BASE_URL_SITO.'send_disdetta/send/'.$Id.'\');" class="btn btn-primary btn-sm">Invia</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix p-b-20">&nbsp;</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>'."\r\n";
 
 

                    echo '<script type="text/javascript">

                                    function open_voucher_recupero(id){
                                        $("#voucher_recupero").load("' . BASE_URL_SITO . 'ajax/sendmail/send_mail_voucher_rec.php?idsito=' . $idsito. '&id_preno='.$Id.'");
                                    }

                                    $(document).ready(function() {

                                        //EQUALIZZO BOX DETTAGLI
                                        var highestBox = 400;
                                        var heigthRow = $("#infobox").height();
                                        var new_height = (heigthRow - 20);
                                        if(highestBox > heigthRow){
                                            $("#dettTab").attr("style", "height:170px;overflow-y:auto;overflow-x:auto;");
                                            $("#dettTab").addClass("scroll");
                                        }else{
                                            $("#dettTab").attr("style", "height:170px;overflow-y:auto;overflow-x:auto;");
                                            $("#dettTab").addClass("scroll");
                                        }
                                        $(".row-eq-height").each(function() {
                                            var heights = $(this).find(".col-eq-height").map(function() {
                                            return $(this).outerHeight();
                                                }).get(), maxHeight = Math.max.apply(null, heights);
                                                $(this).find(".col-eq-height").outerHeight(maxHeight);
                                        });

                                        $("#closeButtonInfoBox").on("click",function(){
                                            $("#infobox").hide(300);
                                            $(this).hide(300);
                                        });


                                        $("#pul_form_data'.$Id.'").on("click",function(){
                                            var idrichiesta = $("#idrichiesta'.$Id.'").val();
                                            var DataScadenza = $("#DataScadenza'.$Id.'").val();
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/preventivi/update.data_scadenza.php",
                                                type: "POST",
                                                data: "action=send_data&DataScadenza="+DataScadenza+"&idrichiesta="+idrichiesta,
                                                dataType: "html",
                                                success: function(data) {
                                                   /*  $("#boxAzioni'.$Id.'").load(" #boxAzioni'.$Id.' > *"); */
                                                    get_content_update('.$Id.');
                                                    $("#conferme").DataTable().ajax.reload();
                                                    setTimeout(function() {
                                                       $("#conferme tbody tr").find("input[id=\"riga'.$Id.'\"]").parent().parent().addClass("selected");   
                                                    }, 2000);   
                                                }
                                            });                                             
                                        });

                                        $("#pul_send_disdetta'.$Id.'").on("click",function(){

                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/prenotazioni/update.disdetta.php",
                                                type: "POST",
                                                data: "id='.$Id.'",
                                                dataType: "html",
                                                success: function(data) {
                                                    _alert("<i class=\"fa fa-envelope\"></i> Invio E-mail Disdetta"," Prenotazione Nr.'.$NumeroPrenotazione.' inviata con successo!"); 
                                                    get_content_update('.$Id.');
                                                    $("#conferme").DataTable().ajax.reload();
                                                }
                                            });                                             
                                        });

                                        $("#pul_send_questionario'.$Id.'").on("click",function(){

                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/sendmail/send_quest.php",
                                                type: "POST",
                                                data: "id='.$Id.'&azione=send",
                                                dataType: "html",
                                                success: function(data) {
                                                    _alert("<i class=\"fa fa-envelope\"></i> Invio E-mail"," Questionario Customer Satisfaction sulla prenotazione Nr.'.$NumeroPrenotazione.' inviata con successo!"); 
                                                    $("#conferme").DataTable().ajax.reload(); 
                                                    setTimeout(function() {
                                                       $("#conferme tbody tr").find("input[id=\"riga'.$Id.'\"]").parent().parent().addClass("selected");   
                                                    }, 2000);                                                                                                 
                                                }
                                            });                                             
                                        });

                                        $("#pul_send_recensione'.$Id.'").on("click",function(){

                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/sendmail/send_recensioni.php",
                                                type: "POST",
                                                data: "id='.$Id.'&azione=send",
                                                dataType: "html",
                                                success: function(data) {
                                                    _alert("<i class=\"fa fa-envelope\"></i> Invio E-mail"," Richiesta recensione sulla prenotazione Nr.'.$NumeroPrenotazione.' inviata con successo!"); 
                                                    $("#conferme").DataTable().ajax.reload();
                                                    setTimeout(function() {
                                                       $("#conferme tbody tr").find("input[id=\"riga'.$Id.'\"]").parent().parent().addClass("selected");   
                                                    }, 2000);   
                                                }
                                            });                                             
                                        });

                                       $("#pul_send_checkin'.$Id.'").on("click",function(){

                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/sendmail/send_checkin.php",
                                                type: "POST",
                                                data: "id='.$Id.'&azione=send",
                                                dataType: "html",
                                                success: function(data) {
                                                    _alert("<i class=\"fa fa-envelope\"></i> Invio E-mail Check In OnLine"," Modulo per Check In Online sulla prenotazione Nr.'.$NumeroPrenotazione.' inviata con successo!"); 
                                                    $("#conferme").DataTable().ajax.reload();
                                                    setTimeout(function() {
                                                       $("#conferme tbody tr").find("input[id=\"riga'.$Id.'\"]").parent().parent().addClass("selected");   
                                                    }, 2000);   
                                                }
                                            });                                             
                                        });

                                        $("#Ben'.$Id.'").on("click",function(){
                                            $(this).hide(300);
                                            $("#noBen'.$Id.'").show(300);
                                            var id    = $(this).data("id");
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/prenotazioni/update.benvenuto.php",
                                                type: "POST",
                                                data: "id="+id+"&value=0",
                                                dataType: "html",
                                                success: function(data) {
                                                   
                                                }
                                            });
                                        });
                                        $("#noBen'.$Id.'").on("click",function(){
                                            $(this).hide(300);
                                            $("#Ben'.$Id.'").show(300);
                                            var id    = $(this).data("id");
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/prenotazioni/update.benvenuto.php",
                                                type: "POST",
                                                data: "id="+id+"&value=1",
                                                dataType: "html",
                                                success: function(data) {
                                                   
                                                }
                                            });
                                        });

                                        $("#Quest'.$Id.'").on("click",function(){
                                            $(this).hide(300);
                                            $("#noQuest'.$Id.'").show(300);
                                            var id    = $(this).data("id");
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/prenotazioni/update.questionario.php",
                                                type: "POST",
                                                data: "id="+id+"&value=0",
                                                dataType: "html",
                                                success: function(data) {
                                                   
                                                }
                                            });
                                        });
                                        $("#noQuest'.$Id.'").on("click",function(){
                                            $(this).hide(300);
                                            $("#Quest'.$Id.'").show(300);
                                            var id    = $(this).data("id");
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/prenotazioni/update.questionario.php",
                                                type: "POST",
                                                data: "id="+id+"&value=1",
                                                dataType: "html",
                                                success: function(data) {
                                                   
                                                }
                                            });
                                        });

                                        $("#PreCheck'.$Id.'").on("click",function(){
                                            $(this).hide(300);
                                            $("#noPreCheck'.$Id.'").show(300);
                                            var id    = $(this).data("id");
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/prenotazioni/update.precheckin.php",
                                                type: "POST",
                                                data: "id="+id+"&value=0",
                                                dataType: "html",
                                                success: function(data) {
                                                   
                                                }
                                            });
                                        });
                                        $("#noPreCheck'.$Id.'").on("click",function(){
                                            $(this).hide(300);
                                            $("#PreCheck'.$Id.'").show(300);
                                            var id    = $(this).data("id");
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/prenotazioni/update.precheckin.php",
                                                type: "POST",
                                                data: "id="+id+"&value=1",
                                                dataType: "html",
                                                success: function(data) {
                                                   
                                                }
                                            });
                                        });

                                        $("#Rec'.$Id.'").on("click",function(){
                                            $(this).hide(300);
                                            $("#noRec'.$Id.'").show(300);
                                            var id    = $(this).data("id");
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/prenotazioni/update.recensioni.php",
                                                type: "POST",
                                                data: "id="+id+"&value=0",
                                                dataType: "html",
                                                success: function(data) {
                                                   
                                                }
                                            });
                                        });
                                        $("#noRec'.$Id.'").on("click",function(){
                                            $(this).hide(300);
                                            $("#Rec'.$Id.'").show(300);
                                            var id    = $(this).data("id");
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/prenotazioni/update.recensioni.php",
                                                type: "POST",
                                                data: "id="+id+"&value=1",
                                                dataType: "html",
                                                success: function(data) {
                                                   
                                                }
                                            });
                                        });

                                        $("#Chec'.$Id.'").on("click",function(){
                                            $(this).hide(300);
                                            $("#noChec'.$Id.'").show(300);
                                            var id    = $(this).data("id");
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/prenotazioni/update.checkin.php",
                                                type: "POST",
                                                data: "id="+id+"&value=0",
                                                dataType: "html",
                                                success: function(data) {
                                                   
                                                }
                                            });
                                        });
                                        $("#noChec'.$Id.'").on("click",function(){
                                            $(this).hide(300);
                                            $("#Chec'.$Id.'").show(300);
                                            var id    = $(this).data("id");
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/prenotazioni/update.checkin.php",
                                                type: "POST",
                                                data: "id="+id+"&value=1",
                                                dataType: "html",
                                                success: function(data) {
                                                   
                                                }
                                            });
                                        });


                                    });
                            </script>';	  
 
        
?>
