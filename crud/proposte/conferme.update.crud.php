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
                    $Note                                = $row['Note'];

                    if($idTemplate!= '' && $idTemplate!= 0){
                        $NomeTemplate = $fun->get_template($idsito,$idTemplate);
                        $NomeTemplate = ucfirst($NomeTemplate);
                    }else{
                        $NomeTemplate = '';
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
                                    
                    $utente_online  = $fun->utenti_online($idsito,$Id);

                    echo'<button class="btn btn-primary btn-sm f-right cursore" id="closeButtonInfoBox">Chiudi dettaglio <i class="fa fa-times" data-toggle="tooltip" title="Chiudi i Box detaglio"></i></button> 
                                    <div class="clearfix p-b-10"></div>           
                                        <div class="row row-eq-height" id="infobox">                                                   
                                            <div class="clearfix p-b-20"></div>
                                            <div class="col-md-4">
                                                <div class="card  col-eq-height">
                                                    <div class="card-header">
                                                        <h5 class="text-primary">DETTAGLIO CONFERMA <b class="text-black f-18 p-l-10">Nr. '.$NumeroPrenotazione.'</b> <b class="p-l-30 text-gray f-11">[ID: '.$Id.']</b></h5>                                                                                         
                                                    </div>
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
                                                                        '.($utente_online!=''?
                                                                        '<div class="clearfix p-b-30"></div>
                                                                        <div class="row">
                                                                            <div class="col-md-5"><b>Utente OnLine</b></div>
                                                                            <div class="col-md-7"><span class="p-r-10">Sta visualizzando<br/> la conferma oppure il voucher!</span> '.$utente_online.'</div>
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
                                                                            <div class="col-md-3 text-left"><a href="'.BASE_URL_SITO.'print_pdf/'.base64_encode($Id).'" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-file-pdf-o"></i> Stampa PDF</a></div>
                                                                            <div class="col-md-4 text-center"><a href="'.$linkPreview.'" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Visualizza conferma</a></div>
                                                                            <div class="col-md-5 text-right"><a href="'.$linkPreviewVoucher.'" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Visualizza voucher</a></div>
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
                                                                    <div class="clearfix p-b-20"></div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card col-eq-height">
                                                    <div class="card-header">
                                                        <h5 class="text-primary">AZIONI CONFERMA</h5>                                                                                         
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <i class="fa fa-edit fa-2x fa-fw text-black"></i>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <b>MODIFICA</b><br>
                                                                        <span class="f-12">Apri la maschera di modifica per completare la compilazione della conferma</span>
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
                                                                    <i class="fa fa-bed fa-2x fa-fw text-black"></i>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <b>CONFERMA PRENOTAZIONE</b><br>
                                                                        <span class="f-12">Chiudi la conferma in trattativa e rendila prenotazione confermata ed invia il voucher</span>
                                                                        <div class="clearfix p-b-10"></div>
                                                                        <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#chiudi_preno'.$Id.'">Conferma</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix p-b-30"></div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <i class="fa fa-paper-plane fa-2x fa-fw text-black"></i>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <b>INVIA  E-MAIL</b><br>
                                                                        <span class="f-12">Invia una mail al cliente con la richiesta di pagamento</span>
                                                                        <div class="clearfix p-b-10"></div>
                                                                        '.(($DataScadenza >= date('Y-m-d') && $DataScadenza!='')?'<a href="#" id="pul_send_mail'.$Id.'" class="btn btn-primary btn-sm">Invia</a>':'<label class="badge badge-inverse-danger f-11">Controlla la data di scadenza</label>').'
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <i class="fa fa-whatsapp fa-2x fa-fw text-black"></i>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <b>INVIA WHATSAPP</b><br>
                                                                        <span class="f-12">Invia un messaggio con il link della pagina di conferma</span>
                                                                        <div class="clearfix p-b-10"></div>
                                                                        '.(($DataScadenza >= date('Y-m-d') && $DataScadenza!='')?'
                                                                            '.(($Cellulare!='' && $PrefissoInternazionale!='')?'<a href="'.BASE_URL_SITO.'send_whatsapp/send/'.$Id.'" target="_blank" class="btn btn-primary btn-sm">invia conferma</a>':'<label class="badge badge-inverse-danger f-11">Cellulare non inserito</label>').''
                                                                        :'<label class="badge badge-inverse-danger f-11">Controlla la data di scadenza</label>').'
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <i class="fa fa-whatsapp fa-2x fa-fw text-black"></i>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <b>INVIA WHATSAPP</b><br>
                                                                        <span class="f-12">Invia un messaggio con il link della pagina voucher</span>
                                                                        <div class="clearfix p-b-10"></div>
                                                                        '.(($DataScadenza >= date('Y-m-d') && $DataScadenza!='')?'
                                                                            '.(($Cellulare!='' && $PrefissoInternazionale!='')?'<a href="'.BASE_URL_SITO.'send_whatsapp_voucher/send/'.$Id.'" target="_blank" class="btn btn-primary btn-sm">invia voucher</a>':'<label class="badge badge-inverse-danger f-11">Cellulare non inserito</label>').''
                                                                        :'<label class="badge badge-inverse-danger f-11">Controlla la data di scadenza</label>').'
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        <div class="clearfix p-b-30"></div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                    <i class="fa fa-calendar  fa-2x fa-fw text-black"></i>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <b>DATA SCADENZA</b><br>
                                                                        <span class="f-12">Data scadenza conferma in trattativa '.(($DataScadenza != '' && $DataScadenza < date('Y-m-d'))?'<div class="clearfix "></div><span class="text-danger">Scaduta</span>':'').'</span>
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
                                                                        <i class="fa fa-minus-circle  fa-2x fa-fw text-black"></i>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <b>MANCATA DISPONIBILITA\'</b><br>
                                                                        <span class="f-12">Invia mancata disponibilità, annulla!</span>
                                                                        <div class="clearfix p-b-10"></div>
                                                                        <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#no_disponibilita'.$Id.'">Invia</a>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <i class="fa fa-times-circle  fa-2x fa-fw text-black"></i>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <b>DISABILITA RECALL</b><br>
                                                                        <span class="f-12">Disabilita il Recall della conferma</span>
                                                                        <div class="clearfix p-b-10"></div>
                                                                        <div id="reload'.$Id.'">
                                                                            <i class="fa fa-square-o fa-2x fa-fw text-black" data-id="'.$Id.'" id="Recall'.$Id.'" '.($Visibile==0?'style="display:none"':'').'></i>           
                                                                            <i class="fa fa-check-square-o fa-2x fa-fw text-black" data-id="'.$Id.'" id="noRecall'.$Id.'" '.($Visibile==1?'style="display:none"':'').'></i>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        <div class="clearfix p-b-20"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="no_disponibilita'.$Id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Contenuto e-mail mancata disponibilità</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-left">
                                                        <iframe height="650px" width="100%" frameborder="0" scrolling="no" allowtransparency="true" src="'.BASE_URL_SITO.'non_disponibile/'.$Id.'/"></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="chiudi_preno'.$Id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Conferma Prenotazione Nr. '.$NumeroPrenotazione.'</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-left">
                                                        <div class="row">
                                                            <div class="col-md-6 text-right"><a href="'.BASE_URL_SITO.'send_voucher/send/'.$Id.'" class="btn btn-inverse btn-sm"><i class="fa fa-bed"></i> Chiudi ed invia &nbsp;<i class="fa fa-tag"></i> voucher!</a></div>
                                                            <div class="col-md-6 text-left"><a href="'.BASE_URL_SITO.'send_voucher/send/'.$Id.'/no/" class="btn btn-inverse btn-sm"><i class="fa fa-bed"></i> Chiudi prenotazione e basta!</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>'."\r\n";
 
 

                    echo '<script type="text/javascript">
                                    $(document).ready(function() {

                                        //EQUALIZZO BOX DETTAGLI
                                        var highestBox = 400;
                                        var heigthRow = $("#infobox").height();
                                        var new_height = (heigthRow - 20);
                                        if(highestBox > heigthRow){
                                            $("#dettTab").attr("style", "height:200px;overflow-y:auto;overflow-x:auto;");
                                            $("#dettTab").addClass("scroll");
                                        }else{
                                            $("#dettTab").attr("style", "height:200px;overflow-y:auto;overflow-x:auto;");
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
                                                    $("#boxAzioni'.$Id.'").load(" #boxAzioni'.$Id.' > *");
                                                    get_content_update('.$Id.');
                                                    $("#preventivi").DataTable().ajax.reload();
                                                }
                                            });                                             
                                        });

                                        $("#pul_send_mail'.$Id.'").on("click",function(){

                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/sendmail/send_mail.php",
                                                type: "POST",
                                                data: "azione=send&param='.$Id.'",
                                                dataType: "html",
                                                success: function(data) {
                                                    _alert("<i class=\"fa fa-envelope\"></i> Invio E-mail"," Conferma Nr.'.$NumeroPrenotazione.' inviata con successo!"); 
                                                    $("#datainvio'.$Id.'").load(" #datainvio'.$Id.' > *");
                                                    get_content_update('.$Id.');
                                                    $("#conferme").DataTable().ajax.reload();
                                                    setTimeout(function() {
                                                       $("#conferme tbody tr").find("input[id=\"riga'.$Id.'\"]").parent().parent().addClass("selected");   
                                                    }, 2000);  
                                                }
                                            });                                             
                                        });

                                        $("#Recall'.$Id.'").on("click",function(){
                                            $(this).hide(300);
                                            $("#noRecall'.$Id.'").show(300);
                                            var id    = $(this).data("id");
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/preventivi/update.recall.php",
                                                type: "POST",
                                                data: "id="+id+"&value=0",
                                                dataType: "html",
                                                success: function(data) {
                                                    /*$("#reload'.$Id.'").load(" #reload'.$Id.' > *");*/
                                                }
                                            });
                                        });
                                        $("#noRecall'.$Id.'").on("click",function(){
                                            $(this).hide(300);
                                            $("#Recall'.$Id.'").show(300);
                                            var id    = $(this).data("id");
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/preventivi/update.recall.php",
                                                type: "POST",
                                                data: "id="+id+"&value=1",
                                                dataType: "html",
                                                success: function(data) {
                                                    /*$("#Recall'.$Id.'").load(" #Recall'.$Id.' > *");*/
                                                }
                                            });
                                        });
                                    });
                            </script>';	  
 
        
?>
