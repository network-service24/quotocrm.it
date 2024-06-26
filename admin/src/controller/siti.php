<?
    # VARIABILI DI SETTINGS
    $nomeTabella    = 'siti';
    $campiQuery     = urlencode('siti.*,utenti.username,utenti.password,utenti.is_admin');
    $join           = urlencode('LEFT JOIN utenti ON siti.idsito = utenti.idsito');
    if($_REQUEST['azione']=='ricerca' && $_REQUEST['idsito']!=''){
        $where          = urlencode('WHERE siti.idsito = '.$_REQUEST['idsito'].'');
    }
    if($_REQUEST['azione']=='ut' && $_REQUEST['param']!=''){
        $where          = urlencode('WHERE siti.idsito = '.$_REQUEST['param'].'');
    }
    if($_REQUEST['azione']=='cl' && $_REQUEST['param']!=''){
        $where          = urlencode('WHERE utenti.idanagra = '.$_REQUEST['param'].'');
    }
    if($_REQUEST['azione']=='ricerca' && $_REQUEST['sito']!=''){
        $where          = urlencode('WHERE siti.web LIKE "%'.$_REQUEST['sito'].'%"');
    }
    $order          = 'siti.idsito';
    $groupBy        = urlencode('GROUP BY siti.idsito');
    $typeorder      = 'DESC';
    $parametro      = 'idsito';
    $variabili      = 'tabella='.$nomeTabella.($campiQuery==''?'':'&campiQuery='.$campiQuery).($where==''?'':'&where='.$where).($join==''?'':'&join='.$join).($order==''?'':'&order='.$order).($groupBy==''?'':'&groupBy='.$groupBy).($typeorder==''?'':'&typeorder='.$typeorder).'';
    //$campi          = array();
    //$campi          =  $fun->ListaCampiTabella($nomeTabella); // per estrarre i campi in maniera dinamica, forse meglio usarli per tabelle con pochi campi
    $arrayTipoSito        = $fun->getTipoSito();
    foreach ($arrayTipoSito as $key => $value) {
        $listaTipoSiti .= '<option value="'.$value['idtipo'].'">'.$value['nome'].'</option>';
        # code...
    }
    $arrayClasse        = $fun->getClassificazioniStutture();
    foreach ($arrayClasse as $key => $value) {
        $listaClassi .= '<option value="'.$value['id'].'">'.$value['classe'].'</option>';
        # code...
    }
    $arrayStati        = $fun->getListaStati();
    foreach ($arrayStati as $key => $value) {
        $listaStati .= '<option value="'.$value['id_stato'].'">'.$value['nome_stato'].'</option>';
        # code...
    }
    $arrayStatus        = $fun->getIdStatus();
    foreach ($arrayStatus as $key => $value) {
        $listaStatus .= '<option value="'.$value['id_status'].'">'.$value['descrizione_status'].'</option>';
        # code...
    }
    $arrayServizi        = $fun->getServiziAttivi();
    foreach ($arrayServizi as $key => $value) {
        $listaServizi .= '<option value="'.$value['nome_servizio'].'">'.$value['nome_servizio'].'</option>';
        # code...
    }
    $arrayContratti       = $fun->getTipoContratto();
    foreach ($arrayContratti as $key => $value) {
        $listaContratti .= '<option value="'.$value['id_tipo_contratto'].'">'.$value['nome_contratto'].'</option>';
        # code...
    }
    # LISTA DINAMICA DEI CAMPI DELLA TABELLA
    ##########################################################################################################################################################

    ##########################################################################################################################################################
    if($_REQUEST['azione']){

        switch($_REQUEST['azione']){
            case "ut":
                $prov= 'utenti';
            break;
            case "sw":
                $prov= 'siti';
            break;
            case "cl":
                $prov= 'clienti';
            break;
            case "ricerca":
                $prov= 'Dashboard';
            break;
        }

        $provenienza .= '   <script>
                                $( document ).ajaxComplete(function() {
                                    $("#siti_filter").hide();
                                    $(".dt-buttons").hide();
                                });
                            </script>'."\r\n";
        $provenienza .= '<p><i class="fa fa-exclamation-triangle text-warning"></i> Provenienza attuale dall\'area <b>"'.$prov.'"</b>; per poter utilizzare il campo <b>"Filtra i risultati"</b>, resettare l\'attuale query cliccando sulla voce di menù <b>"Siti"</b> oppure su <a href="'.BASE_URL_ADMIN.'siti/" class="btn btn-inverse btn-sm">Reset</a></p>'."\r\n";
    }
    # INTERFACCIA PER INSERIMENTO DATI
    $content .= '<div class="row">
                    <!--
                    <div class="col-md-1 text-left">
                        <button type="button" class="btn btn-grd-primary btn-sm" id="aggiungi"><i class="fa fa-plus fa-fw"></i> Aggiungi record</button>
                    </div>
                    -->
                    <div class="col-md-2 text-center"   id="chiudi_insert_top" style="display:none">
                        <button type="button" class="btn btn-info btn-sm btn-out"><i class="fa fa-minus fa-fw"></i> Chiudi finestra aggiungi</button>
                        <div style="width:100%;height:30px"></div> 
                    </div>
                    <div class="col-md-10 text-left"></div>
                </div>
                <p></p>';
    $content .= '<div id="add" style="display:none">
                 <div class="p-20 z-depth-right-1 waves-effect">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="row">
                                    <div class="col-md-3 text-right">                            
                                    </div>
                                    <div class="col-md-9">
                                        <h2>Aggiungi un nuovo record!</h2>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div style="width:100%;height:30px"></div>';
    $content .= ' <form name="form_insert" id="form_insert" method="post" >
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 text-right">
                        <div id="view_form_ins_loading_up"></div>
                            <button type="submit" class="btn btn-success btn-sm btn-out-dotted" id="btn_save_ins_up"><i class="fa fa-save fa-fw"></i> Salva nuovo record</button>     
                        </div>
                        <div class="col-md-2"></div>
                    </div>  
                    <div style="width:100%;height:30px"></div>  
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">'."\r\n";

    $content .= '       <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 text-right"><label>ID Sito <br><small>(momentaneo da eliminare)</small></label></div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                            <input type="text" class="form-control" id="idsito_insert" name="idsito"  />
                                        </div>
                                    </div>
                                </div>
                            </div>  ';

    $content .= '      
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 text-right"><label>Tipo sito</label></div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-building"></i></span>
                                            <select class="form-control" id="tiposito"  name="tiposito" >
                                                <option value="">--</option>
                                                '.$listaTipoSiti.'
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right"><label>Classificazione Struttura (stelle)</label></div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-star"></i></span>
                                            <select class="form-control" id="classe"  name="classe" >
                                                <option value="">--</option>
                                                '.$listaClassi.'
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 text-right">
                                        <label>Web</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-edge"></i></span>
                                            <input type="text" class="form-control" id="web"  name="web" placeholder="www.dominio.xx" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 text-right">
                                        <label>Nome</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-building-o"></i></span>
                                            <input type="text" class="form-control" id="nome"  name="nome" placeholder="Nome della struttura ricettiva" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 text-right"><label>Nazione</label></div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-map-marker"></i></span>
                                            <select class="form-control" id="id_stato"  name="id_stato" required >
                                                <option selected="selected" value="">--</option>
                                                '.$listaStati.'
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 text-right"><label>Regione</label></div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-map-marker"></i></span>
                                            <select class="form-control" id="codice_regione"  name="codice_regione" required >
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 text-right">
                                        <label>Provincia</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-map-marker"></i></span>
                                            <select class="form-control" id="codice_provincia"  name="codice_provincia" required >
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 text-right">
                                        <label>Comune</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-map-marker"></i></span>
                                            <select class="form-control" id="codice_comune"  name="codice_comune" required >
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 text-right">
                                        <label>Indirizzo</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                            <input type="text" class="form-control" id="indirizzo"  name="indirizzo" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 text-right">
                                        <label>Cap</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                            <input type="text" class="form-control" id="cap"  name="cap" maxlength="5" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 text-right">
                                        <label>Coordinate</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                                    <button type="button" class="btn btn-default btn-sm" id="calcolaCoord">Ricava coordinate</button>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-map-marker"></i></span>
                                                    <input type="text" name="LatLng" id="LatLng"  class="form-control" placeholder="Latitudine e Longitudine" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="GmapCoordinate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Calcola le coordinate</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="'.BASE_URL_ADMIN.'ajax/siti/gmap.php"  width="100%" height="400" style="border:none;"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>Chiave Sito Recaptcha</label>
											</div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                                    <input type="text" class="form-control" id="chiave_sito_recaptcha"  name="chiave_sito_recaptcha" placeholder="Inserire la chiave sito recaptcha" />
                                                </div>
                                            </div>
										</div>
									</div>
                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>Chiave Segreta Recaptcha</label>
											</div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                                    <input type="text" class="form-control" id="chiave_segreta_recaptcha"  name="chiave_segreta_recaptcha" placeholder="Inserire la chiave segreta recaptcha" />
                                                </div>
                                            </div>
										</div>
                                    </div>
                                    <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3 text-right">
                                            <label>Chiave Sito Recaptcha v2 invisible</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                                <input type="text" class="form-control" id="chiave_sito_recaptcha_invisible"  name="chiave_sito_recaptcha_invisible" placeholder="Se il sito o landing page utilizza il WidgetFormQuoto inserire la chiave sito recaptcha v2 Invisible" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3 text-right">
                                            <label>Chiave Segreta Recaptcha v2 invisible</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                                <input type="text" class="form-control" id="chiave_segreta_recaptcha_invisible"  name="chiave_segreta_recaptcha_invisible" placeholder="Se il sito o landing page utilizza il WidgetFormQuoto inserire la chiave segreta recaptcha v2 Invisible" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>TagManager</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                    <input type="text" class="form-control" id="TagManager"  name="TagManager" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Id Account Analytics</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                    <input type="text" class="form-control" id="IdAccountAnalytics"  name="IdAccountAnalytics" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Id Property Analytics</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                    <input type="text" class="form-control" id="IdPropertyAnalytics"  name="IdPropertyAnalytics" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Id Vista Analytics</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                    <input type="text" class="form-control" id="ViewIdAnalytics"  name="ViewIdAnalytics" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Property Id Analytics GA4</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                    <input type="text" class="form-control" id="PropertyIdAnalyticsGA4"  name="PropertyIdAnalyticsGA4" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3 text-right">
                                                    <label>Measurement Id Analytics GA4</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                        <input type="text" class="form-control" id="measurement_id"  name="measurement_id" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Api Secret Analytics GA4</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                    <input type="text" class="form-control" id="api_secret"  name="api_secret" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>CSV AdWords Ads</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                    <input type="text" class="form-control" id="Adwords_ads_CSV"  name="Adwords_ads_CSV" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>CSV Facebook Ads</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                    <input type="text" class="form-control" id="Facebook_ads_CSV"  name="Facebook_ads_CSV" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                   
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Tel</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-phone"></i></span>
                                                    <input type="text" class="form-control" id="tel"  name="tel" />
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Fax</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-fax"></i></span>
                                                    <input type="text" class="form-control" id="fax"  name="fax" />
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>Cell</label>
											</div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-mobile-phone"></i></span>
                                                    <input type="text" class="form-control" id="cell"  name="cell" />
                                                </div>
                                            </div>
										</div>
									</div>
                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>Whatsapp</label>
											</div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-whatsapp"></i></span>
                                                    <input type="text" class="form-control" id="whatsapp"  name="whatsapp" />
                                                </div>
                                            </div>
										</div>
									</div>
                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>Email</label>
											</div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></span>
                                                    <input type="email" class="form-control" id="email"  name="email" required />
                                                </div>
                                            </div>
										</div>
									</div>
                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
                                            <label>Email Alternativa e/o aggiuntiva Widget <i class="fa fa-support text-info" data-toggle="tooltip" title="Email alternativa e/o aggiuntiva per il Widget form di QUOTO"></i></label><br><span class="f-11">(test@test.it,demo@demo.it)</span>
											</div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></span>
                                                    <input type="email" class="form-control" id="email_alternativa_form_quoto"  name="email_alternativa_form_quoto" />
                                                </div>
                                            </div>
										</div>
									</div>

                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>Note</label>
											</div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-comment-o"></i></span>
                                                    <textarea row="4" class="form-control" id="note"  name="note" /></textarea>
                                                </div>
                                            </div>
										</div>
									</div>
                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>Data Creazione</label>
											</div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                                    <input type="date" class="form-control" id="data_creazione_"  name="data_creazione" value="'.date('Y-m-d').'" required />
                                                    <!--<input type="hidden"  id="data_creazione" name="data_creazione" />-->
                                                </div>
                                            </div>
										</div>
									</div>
                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>Data Modifica</label>
											</div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                                    <input type="date" class="form-control" id="data_modifica_"  name="data_modifica" value="'.date('Y-m-d').'" required />
                                                    <!--<input type="hidden" id="data_modifica"  name="data_modifica" />-->
                                                </div>
                                            </div>
										</div>
                                    </div>


                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>Stato</label>
											</div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-sitemap"></i></span>
                                                    <select class="form-control" id="id_status"  name="id_status" required >
                                                        <option value="">--</option>
                                                        '.$listaStatus.'
                                                    </select>
                                                </div>
                                            </div>
										</div>
									</div>
                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>Servizi Attivi
                                                    <a data-toggle="tooltip" data-html="true" href="javascript:void(0)" title="E\' molto importante inserire il servizio QUOTO oppure QUOTO TR.<br> Un mancato inserimento di questi dati non farebbe funzionare i CRON del cliente!"><i class="fa fa-fw fa-question-circle text-red"></i></a>
                                                </label>
											</div>
                                            <div class="col-md-9">
                                                <span class="f-11">Il servizio, <b>Quoto</b> oppure <b>Quoto TR</b> deve essere sempre presente , anche se scaduto o disdetto!</span>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-list"></i></span>        
                                                    <select class="js-example-basic-multiple form-control servizi_attivi" id="servizi_attivi_" multiple="multiple" name="servizi_attivi_" />                                                   
                                                        <optgroup label="Servizi Attivi">
                                                            '.$listaServizi.'
                                                        </optgroup>
                                                    </select>
                                       
                                                    <input type="hidden"  id="servizi_attivi"  name="servizi_attivi" />
                                                </div>
                                            </div>
										</div>
									</div>
                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>Tipo Contratto</label>
											</div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-tasks"></i></span>
                                                    <select class="form-control" id="id_tipo_contratto"  name="id_tipo_contratto" >
                                                        <option value="">--</option>
                                                        '.$listaContratti.'
                                                    </select>
                                                </div>
                                            </div>
										</div>
									</div>


                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>Abilita a Quoto</label>
											</div>
											<div class="col-md-9">
												<input type="checkbox"   value="1" id="hospitality"  name="hospitality" />
											</div>
										</div>
                                    </div>
                                    <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3 text-right">
                                            <label>Solo Modulo Checkin Online Abilitato                                            
                                                    <a data-toggle="tooltip" href="javascript:void(0)" title="Se il checkbox viene selezionato, in QUOTO si avrà solo il modulo di chekin online abilitato e niente altro!"><i class="fa fa-support text-info"></i>
                                                </a>                                   
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="checkbox" id="checkin_online_hospitality"  name="checkin_online_hospitality" />
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>Clicca per bloccare rinnovo automatico a Quoto                                           
                                                    <a data-toggle="tooltip" href="javascript:void(0)" title=" Se il checkbox viene selezionato QUOTO NON si rinnova, se il checkbox NON viene selezionato il rinnovo è automatico"><i class="fa fa-support text-info"></i>
                                                </a>                                   
                                            </label>
											</div>
											<div class="col-md-9">
												<input type="checkbox"   value="1" id="no_rinnovo_hospitality"  name="no_rinnovo_hospitality" />
											</div>
										</div>
									</div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Monta WidgetFormQuoto!</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="checkbox"   value="1" id="WidgetFormQuoto"  name="WidgetFormQuoto" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>Data Inizio contratto Quoto</label>
											</div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                                    <input type="date" class="form-control" id="data_start_hospitality_"  name="data_start_hospitality" />
                                                    <!--<input type="hidden"  id="data_start_hospitality"  name="data_start_hospitality" />-->
                                                </div>
                                            </div>
										</div>
									</div>
                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>Data Fine contratto Quoto</label>
											</div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                                    <input type="date" class="form-control" id="data_end_hospitality_"  name="data_end_hospitality" />
                                                    <!--<input type="hidden" id="data_end_hospitality"  name="data_end_hospitality" />-->
                                                </div>
                                            </div>
										</div>
									</div>'."\r\n";
    $content .='        </div>
                    <div class="col-md-2"></div>
                </div>'."\r\n";

        $content .='<div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 text-right">
                                <input type="hidden" name="action" value="insert" />
                                <input type="hidden" name="tabella" value="'.$nomeTabella.'" />
                                <input type="hidden" name="order" value="idsito" />
                                <input type="hidden" name="typeorder" value="DESC" />
                                <div id="view_form_ins_loading_down"></div>
                                <button type="submit" class="btn btn-success btn-sm btn-out-dotted" id="btn_save_ins_down"><i class="fa fa-save fa-fw"></i> Salva nuovo record</button>
                            </div>
                            <div class="col-md-2"></div>
                    </div>';   

$content .='    </form>
            </div>
        <br><br>
    </div>
    <div class="row" id="chiudi_insert" style="display:none">
        <div class="col-md-12 text-left">
            <button type="button" class="btn btn-info btn-sm btn-out"><i class="fa fa-minus fa-fw"></i> Chiudi finestra aggiungi</button>
            <div style="width:100%;height:30px"></div> 
        </div>
    </div>';

# INTERFACCIA PER MODIFICA DATI
$content .=' <button type="button" class="btn btn-info btn-sm btn-out" id="chiudi_update" style="display:none"><i class="fa fa-minus fa-fw"></i> Chiudi finestra modifica</button>
                <div id="mod" style="display:none"><br><br>
                    <div class="p-20 z-depth-right-1 waves-effect">  
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="row">
                                    <div class="col-md-3 text-right">                            
                                    </div>
                                    <div class="col-md-9">
                                        <h2>Modifica il record!</h2>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div style="width:100%;height:30px"></div>                    
                        <form name="form_update" id="form_update" method="post" >
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8 text-right">
                                    <div id="view_form_loading_up"></div>
                                        <button type="submit" class="btn btn-success btn-sm btn-out-dotted" id="btn_save_up"><i class="fa fa-save fa-fw"></i> Modifica record</button>     
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>  
                                <div style="width:100%;height:30px"></div>  
                                <input type="hidden" id="param_update" name="param" value="'.$parametro.'">
                                <input type="hidden" id="action_update" name="action" value="update">
                                <input type="hidden" id="tabella_update" name="tabella" value="'.$nomeTabella.'">  
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div id="load_db_date"></div>
                                        <input type="hidden" id="id_update" name="id">  
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right"><label>ID Sito <br><small>(momentaneo da eliminare)</small></label></div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                    <input type="text" class="form-control" id="idsito_update" name="idsito"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                                                             
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right"><label>Tipo sito</label></div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-building"></i></span>
                                                <select class="form-control" id="tiposito_update"  name="tiposito" >
                                                    <option value="">--</option>
                                                    '.$listaTipoSiti.'
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3 text-right"><label>Classificazione Struttura (stelle)</label></div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-star"></i></span>
                                                <select class="form-control" id="classe_update"  name="classe" >
                                                    <option value="">--</option>
                                                    '.$listaClassi.'
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Web</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-edge"></i></span>
                                                <input type="text" class="form-control" id="web_update"  name="web" placeholder="www.dominio.xx" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Nome</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-building-o"></i></span>
                                                <input type="text" class="form-control" id="nome_update"  name="nome" placeholder="Nome della struttura ricettiva" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right"><label>Nazione</label></div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-map-marker"></i></span>
                                                <select class="form-control" id="id_stato_update"  name="id_stato" required >
                                                    <option selected="selected" value="">--</option>
                                                    '.$listaStati.'
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right"><label>Regione</label></div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-map-marker"></i></span>
                                                <select class="form-control" id="codice_regione_update"  name="codice_regione" required >
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Provincia</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-map-marker"></i></span>
                                                <select class="form-control" id="codice_provincia_update"  name="codice_provincia" required >
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Comune</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-map-marker"></i></span>
                                                <select class="form-control" id="codice_comune_update"  name="codice_comune" required >
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Indirizzo</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                                <input type="text" class="form-control" id="indirizzo_update"  name="indirizzo" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Cap</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                <input type="text" class="form-control" id="cap_update"  name="cap" maxlength="5" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Coordinate</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                                            <button  type="button" class="btn btn-default btn-sm" id="calcolaCoord_update">Ricava coordinate</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-fw fa-map-marker"></i></span>
                                                            <input type="text" name="LatLng" id="LatLng_update"  class="form-control" placeholder="Latitudine e Longitudine" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="GmapCoordinate_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Calcola le coordinate</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <iframe src="'.BASE_URL_ADMIN.'ajax/siti/gmap.php"  width="100%" height="400" style="border:none;"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Chiave Sito Recaptcha</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                     <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                                        <input type="text" class="form-control" id="chiave_sito_recaptcha_update"  name="chiave_sito_recaptcha" placeholder="Inserire la chiave sito recaptcha" />
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Chiave Segreta Recaptcha</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                                        <input type="text" class="form-control" id="chiave_segreta_recaptcha_update"  name="chiave_segreta_recaptcha" placeholder="Iinserire la chiave segreta recaptcha" />
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3 text-right">
                                                    <label>Chiave Sito Recaptcha v2 invisible</label>
                                                </div>
                                                <div class="col-md-9">
                                                 <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                                    <input type="text" class="form-control" id="chiave_sito_recaptcha_invisible_update"  name="chiave_sito_recaptcha_invisible" placeholder="Se il sito o landing page utilizza il WidgetFormQuoto inserire la chiave sito recaptcha v2 Invisible" />
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3 text-right">
                                                    <label>Chiave Segreta Recaptcha v2 invisible</label>
                                                </div>
                                                <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                                    <input type="text" class="form-control" id="chiave_segreta_recaptcha_invisible_update"  name="chiave_segreta_recaptcha_invisible" placeholder="Se il sito o landing page utilizza il WidgetFormQuoto inserire la chiave segreta recaptcha v2 Invisible" />
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                            <label>TagManager</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                            <input type="text" class="form-control" id="TagManager_update"  name="TagManager" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                     <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Id Account Analytics</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                    <input type="text" class="form-control" id="IdAccountAnalytics_update"  name="IdAccountAnalytics" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Id Property Analytics</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                    <input type="text" class="form-control" id="IdPropertyAnalytics_update"  name="IdPropertyAnalytics" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Id Vista Analytics</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                    <input type="text" class="form-control" id="ViewIdAnalytics_update"  name="ViewIdAnalytics" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Property Id Analytics GA4</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                    <input type="text" class="form-control" id="PropertyIdAnalyticsGA4_update"  name="PropertyIdAnalyticsGA4" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3 text-right">
                                                    <label>Measurement Id Analytics GA4</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                        <input type="text" class="form-control" id="measurement_id_update"  name="measurement_id" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>Api Secret Analytics GA4</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                    <input type="text" class="form-control" id="api_secret_update"  name="api_secret" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>CSV AdWords Ads</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                    <input type="text" class="form-control" id="Adwords_ads_CSV_update"  name="Adwords_ads_CSV" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3 text-right">
                                                <label>CSV Facebook Ads</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                    <input type="text" class="form-control" id="Facebook_ads_CSV_update"  name="Facebook_ads_CSV" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                             
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Tel</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-phone"></i></span>
                                                        <input type="text" class="form-control" id="tel_update"  name="tel" />
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Fax</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                       <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-fw fa-fax"></i></span>
                                                        <input type="text" class="form-control" id="fax_update"  name="fax" />
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Cell</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-mobile-phone"></i></span>
                                                        <input type="text" class="form-control" id="cell_update"  name="cell" />
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Whatsapp</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-fw fa-whatsapp"></i></span>
                                                        <input type="text" class="form-control" id="whatsapp_update"  name="whatsapp" />
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                        <div class="col-md-3 text-right">
                                                            <label>Email</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                        <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></span>
                                                            <input type="email" class="form-control" id="email_update"  name="email" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Email Alternativa e/o aggiuntiva Widget <i class="fa fa-support text-info" data-toggle="tooltip" title="Email alternativa e/o aggiuntiva per il Widget form di QUOTO"></i></label><br><span class="f-11">(test@test.it,demo@demo.it)</span>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></span>
                                                            <input type="email" class="form-control" id="email_alternativa_form_quoto_update"  name="email_alternativa_form_quoto" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                            

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Note</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                         <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-comment-o"></i></span>
                                                        <textarea row="4" class="form-control" id="note_update"  name="note" /></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Data Creazione</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                         <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                                        <input type="date" class="form-control" id="data_creazione_update_"  name="data_creazione" required />
                                                        <!--<input type="hidden"  id="data_creazione_update" name="data_creazione" />-->
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Data Modifica</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                                        <input type="date" class="form-control" id="data_modifica_update_"  name="data_modifica" required />
                                                        <!--<input type="hidden" id="data_modifica_update"  name="data_modifica" />-->
                                                    </div>
                                                </div>
                                            </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Stato</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-fw fa-sitemap"></i></span>
                                                        <select class="form-control" id="id_status_update"  name="id_status" required >
                                                            <option value="">--</option>
                                                            '.$listaStatus.'
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>
                                                        Servizi Attivi
                                                        <a data-toggle="tooltip" data-html="true" href="javascript:void(0)" title="E\' molto importante inserire il servizio QUOTO oppure QUOTO TR.<br> Un mancato inserimento di questi dati non farebbe funzionare i CRON del cliente!"><i class="fa fa-fw fa-question-circle text-red"></i></a>  
                                                        </label>
                                                    </div>
                                                    <div class="col-md-9">
                                                    <span class="f-11">Il servizio, <b>Quoto</b> oppure <b>Quoto TR</b> deve essere sempre presente , anche se scaduto o disdetto!</span>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-fw fa-list"></i></span>
                                                            <select class="js-example-basic-multiple  form-control servizi_attivi_update" id="servizi_attivi_update_" multiple="multiple" name="servizi_attivi_" />
                                                                <optgroup label="Servizi Attivi">
                                                                </optgroup>
                                                            </select>
                                                        <input type="hidden"  id="servizi_attivi_update"  name="servizi_attivi" />
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Tipo Contratto</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                       <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-tasks"></i></span>
                                                        <select class="form-control" id="id_tipo_contratto_update"  name="id_tipo_contratto" >
                                                            <option value="">--</option>
                                                            '.$listaContratti.'
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Abilita a Quoto</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="checkbox" id="hospitality_update_"  name="hospitality_" />
                                                        <input type="hidden" id="hospitality_update"  name="hospitality" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Solo Modulo Checkin Online Abilitato                                            
                                                            <a data-toggle="tooltip" href="javascript:void(0)" title="Se il checkbox viene selezionato, in QUOTO si avrà solo il modulo di chekin online abilitato e niente altro!"><i class="fa fa-support text-info"></i>
                                                        </a>                                   
                                                    </label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="checkbox" id="checkin_online_hospitality_update_"  name="checkin_online_hospitality_" />
                                                        <input type="hidden" id="checkin_online_hospitality_update"  name="checkin_online_hospitality" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                    <label>Clicca per bloccare rinnovo automatico a Quoto                                           
                                                            <a data-toggle="tooltip" href="javascript:void(0)" title=" Se il checkbox viene selezionato QUOTO NON si rinnova, se il checkbox NON viene selezionato il rinnovo è automatico"><i class="fa fa-support text-info"></i>
                                                        </a>                                   
                                                    </label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="checkbox"    id="no_rinnovo_hospitality_update_"  name="no_rinnovo_hospitality_" />
                                                        <input type="hidden"    id="no_rinnovo_hospitality_update"  name="no_rinnovo_hospitality" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Il cliente usa il form sul sito o landing tramite API Quoto</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="checkbox" id="API_hospitality_update_"  name="API_hospitality_" />
                                                        <input type="hidden" id="API_hospitality_update"  name="API_hospitality" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Monta WidgetFormQuoto!</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="checkbox" id="WidgetFormQuoto_update_"  name="WidgetFormQuoto_" />
                                                        <input type="hidden" id="WidgetFormQuoto_update"  name="WidgetFormQuoto" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Data Inizio contratto Quoto</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                                        <input type="date" class="form-control" id="data_start_hospitality_update_"  name="data_start_hospitality" />
                                                        <!-- <input type="hidden"  id="data_start_hospitality_update"  name="data_start_hospitality" /> -->
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 text-right">
                                                        <label>Data Fine contratto Quoto</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                                        <input type="date" class="form-control" id="data_end_hospitality_update_"  name="data_end_hospitality" />
                                                        <!--<input type="hidden" id="data_end_hospitality_update"  name="data_end_hospitality" />-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8 text-right">
                                    <div id="view_form_loading_down"></div>
                                        <button type="submit" class="btn btn-success btn-sm btn-out-dotted" id="btn_save_down"><i class="fa fa-save fa-fw"></i> Modifica record</button>     
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>                     
                        </form>
                    </div>
                    <br><br>
                </div>
                <div  id="chiudi_update_down" style="display:none">
                    <button type="button" class="btn btn-info btn-sm btn-out"><i class="fa fa-minus fa-fw"></i> Chiudi finestra modifica</button>
                    <div style="width:100%;height:30px"></div> 
                </div>'."\r\n";
/* MODALE DI DETTAGLIO */
$content .= '<div id="recupero_dettaglio_cliente"></div>'."\r\n";
# INTERFACCIA CRUD DATATABLE
$content .='<style>			
                #'.$nomeTabella.' .ordinamento {
                    display:none; 
                }
            </style>'."\r\n";	
$content .='   <!-- Table datatable-->
               <table id="'.$nomeTabella.'" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='                <th>IdSito</th>';
$content .='                <th class="nowrap">Servizi Attivi <a data-toggle="tooltip" data-html="true" href="javascript:void(0)" title="E\' molto importante inserire il servizio QUOTO oppure QUOTO TR.<br> Un mancato inserimento di questi dati non farebbe funzionare i CRON del cliente!"><i class="fa fa-fw fa-question-circle text-red"></i></a></th>
                            <th>Web</th>
                            <th>Email</th>
                            <th>Stato</th>
                            <th>Inizio Contratto Quoto</th>
                            <th>Fine Contratto Quoto</th>
                            <th>Login</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
     
                </table> '."\r\n";


# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>

            $(document).ready(function() {



                // VALORIZZO I CHECKBOX PER UPDATE
                $("#https_update_").click(function() {
                    if($("#https_update_").is(":checked")){
                        $("#https_update_").attr("value","1");
                        $("#https_update").attr("value","1");
                    }else{
                        $("#https_update_").attr("value",false);
                        $("#https_update_").attr("checked",false);
                        $("#https_update").attr("value",false);
                    }
                });
                $("#website_update_").click(function() {
                    if($("#website_update_").is(":checked")){
                        $("#website_update_").attr("value","1");
                        $("#website_update").attr("value","1");
                    }else{
                        $("#website_update_").attr("value",false);
                        $("#website_update_").attr("checked",false);
                        $("#website_update").attr("value",false);
                    }
                });
                $("#italiaabc_update_").click(function() {
                    if($("#italiaabc_update_").is(":checked")){
                        $("#italiaabc_update_").attr("value","1");
                        $("#italiaabc_update").attr("value","1");
                    }else{
                        $("#italiaabc_update_").attr("value",false);
                        $("#italiaabc_update_").attr("checked",false);
                        $("#italiaabc_update").attr("value",false);
                    }
                });
                $("#sito_migrato_update_").click(function() {
                    if($("#sito_migrato_update_").is(":checked")){
                        $("#sito_migrato_update_").attr("value","1");
                        $("#sito_migrato_update").attr("value","1");
                    }else{
                        $("#sito_migrato_update_").attr("value",false);
                        $("#sito_migrato_update_").attr("checked",false);
                        $("#sito_migrato_update").attr("value",false);
                    }
                });
                $("#vip_update_").click(function() {
                    if($("#vip_update_").is(":checked")){
                        $("#vip_update_").attr("value","1");
                        $("#vip_update").attr("value","1");
                    }else{
                        $("#vip_update_").attr("value",false);
                        $("#vip_update_").attr("checked",false);
                        $("#vip_update").attr("value",false);
                    }
                });
                $("#hospitality_update_").click(function() {
                    if($("#hospitality_update_").is(":checked")){
                        $("#hospitality_update_").attr("value","1");
                        $("#hospitality_update").attr("value","1");
                    }else{
                        $("#hospitality_update_").attr("value",false);
                        $("#hospitality_update_").attr("checked",false);
                        $("#hospitality_update").attr("value",false);
                    }
                });
                $("#checkin_online_hospitality_update_").click(function() {
                    if($("#checkin_online_hospitality_update_").is(":checked")){
                        $("#checkin_online_hospitality_update_").attr("value","1");
                        $("#checkin_online_hospitality_update").attr("value","1");
                    }else{
                        $("#checkin_online_hospitality_update_").attr("value",false);
                        $("#checkin_online_hospitality_update_").attr("checked",false);
                        $("#checkin_online_hospitality_update").attr("value",false);
                    }
                });
                $("#no_rinnovo_hospitality_update_").click(function() {
                    if($("#no_rinnovo_hospitality_update_").is(":checked")){
                        $("#no_rinnovo_hospitality_update_").attr("value","1");
                        $("#no_rinnovo_hospitality_update").attr("value","1");
                    }else{
                        $("#no_rinnovo_hospitality_update_").attr("value",false);
                        $("#no_rinnovo_hospitality_update_").attr("checked",false);
                        $("#no_rinnovo_hospitality_update").attr("value",false);
                    }
                });  
                $("#API_hospitality_update_").click(function() {
                    if($("#API_hospitality_update_").is(":checked")){
                        $("#API_hospitality_update_").attr("value","1");
                        $("#API_hospitality_update").attr("value","1");
                    }else{
                        $("#API_hospitality_update_").attr("value",false);
                        $("#API_hospitality_update_").attr("checked",false);
                        $("#API_hospitality_update").attr("value",false);
                    }
                });  
                $("#WidgetFormQuoto_update_").click(function() {
                    if($("#WidgetFormQuoto_update_").is(":checked")){
                        $("#WidgetFormQuoto_update_").attr("value","1");
                        $("#WidgetFormQuoto_update").attr("value","1");
                    }else{
                        $("#WidgetFormQuoto_update_").attr("value",false);
                        $("#WidgetFormQuoto_update_").attr("checked",false);
                        $("#WidgetFormQuoto_update").attr("value",false);
                    }
                });
                $("#id_status_update").on("change",function(){
                    if($("#id_status_update").val()==5){
                        $("#website_update_").attr("value",false);
                        $("#website_update").attr("value",false);
                        $("#website_update_").attr("checked",false);
                    }
                });

                //INIZIALIZZO I DATEPICKER DROPPER


                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();

                // CONFIG DATATABLE
                var table = $("#'.$nomeTabella.'").DataTable( {
                    responsive: true,
                    processing:true,
                                       oLanguage: {sProcessing: "<div class=\'loader-block\' style=\'z-index:9999999!important\'><div class=\'preloader3\'><div class=\'circ1 loader-warning\'></div><div class=\'circ2 loader-warning\'></div><div class=\'circ3 loader-warning\'></div><div class=\'circ4 loader-warning\'></div></div></div><span class=\'text-warning f-w-400 f-13 f-s-intial\'>QUOTO! Manager sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
                    "paging": true,
						"pagingType": "simple_numbers",    
						"language": {
							 "search": "Filtra i risultati:",
							 "info": "Visualizza pagina _PAGE_ di _PAGES_ per _TOTAL_ righe",
                             "emptyTable": " ",
							 "paginate": {
								 "previous": "Precedente",
								 "next":"Successivo",
							 },
							 buttons: {
								pageLength: {
									_: "Mostra %d elementi",
                                    \'-1\': "Mostra tutto"
								}
							}
						},
                        dom: \'Bfrtip\',
						lengthMenu: [
							[ 10, 25, 50, 100, -1 ],
							[ \'10 risultati\', \'25 risultati\', \'50 risultati\', \'100 risultati\', \'Tutti\' ]
                        ],	
                        buttons: [\'pageLength\',
                        {
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi\',
                            className: \'buttonSelezioni  f-left p-r-10\',
                            attr: {id: \'aggiungi\'},
                        },
                        {
                            extend: \'collection\',
                            className: \'buttonExport\',
                            text: \'Esporta\',
                            buttons: [  
                                { extend: \'copy\', text: \'Copia\' }, 
                                { extend: \'excel\', text: \'Excel\' },  
                                { extend: \'csv\', text: \'CSV\' },  
                                { extend: \'pdf\', text: \'PDF\' },  
                                { extend: \'print\', text: \'Stampa\' },
                                
                            ]
                        },
                    ],			
                    "ajax": "'.BASE_URL_ADMIN.'crud/function.crud.php?'.trim($variabili).'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "idsito","class":"text-center"},
                        { "data": "servizi_attivi"},          
                        { "data": "web"},
                        { "data": "email"},
                        { "data": "id_status","class":"text-center"}, 
                        { "data": "start","class":"text-center nowrap"}, 
                        { "data": "end","class":"text-center nowrap"}, 
                        { "data": "login","class":"text-center"}, 
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                            {"targets": [1,3,7,8], "orderable": false}

                        ]'."\r\n";
           
    $content .=' }); 

                // ORDINAMENTO TABELLA
                table.order( [ 0, \''.$typeorder.'\' ] ).draw();
                $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");

                $("#siti_processing").removeClass("card");

                // SLIDE TOOGLE
                $( "#aggiungi" ).click(function() {
                    $( "#add" ).show("slow");
                    $( "#chiudi_insert" ).show("slow");
                    $( "#chiudi_insert_top" ).show("slow");
                });
                $( "#chiudi_insert_top" ).click(function() {
                    $( "#add" ).hide("slow");
                    $( "#chiudi_insert" ).hide("slow");
                    $( "#chiudi_insert_top" ).hide("slow");
                });
                $( "#chiudi_insert" ).click(function() {
                    $( "#add" ).hide("slow");
                    $( "#chiudi_insert" ).hide("slow");
                    $( "#chiudi_insert_top" ).hide("slow");
                });

                // ARRAY DEI SERVIZI ATTIVI PER INSERT
                $("#servizi_attivi_").on("change",function(){
                    var servizi_attivi_new = "" ;
                    $(".servizi_attivi").each(function() {
                        servizi_attivi_new =  $(this).val();
                    });
                    $("#servizi_attivi").val(servizi_attivi_new);
                    console.log(servizi_attivi_new);
                });  

                // ARRAY DEI SERVIZI ATTIVI PER UPLOAD
                $("#servizi_attivi_update_").on("change",function(){
                    var servizi_attivi_ = "" ;
                    $(".servizi_attivi_update").each(function() {
                        servizi_attivi_ =  $(this).val();
                    });
                    $("#servizi_attivi_update").val(servizi_attivi_);
                    console.log(servizi_attivi_);
                });         

                $("#chiudi_update").on("click",function(){
                    $("#mod").hide("slow");
                    $("#aggiungi").show("slow");
                    $("#chiudi_update").hide("slow");
                    $("#chiudi_update_down").hide("slow");
                });
                $("#chiudi_update_down").on("click",function(){
                    $("#mod").hide("slow");
                    $("#aggiungi").show("slow");
                    $("#chiudi_update_down").hide("slow");
                    $("#chiudi_update").hide("slow");
                });

                //CALCOLO COORDINATE GMAP
                $("#calcolaCoord").on("click",function(){
                    $("#GmapCoordinate").modal("show");
                });

                //UPDATE CALCOLO COORDINATE GMAP
                $("#calcolaCoord_update").on("click",function(){
                    $("#GmapCoordinate_update").modal("show");
                });

                // INSERT
                $("#form_insert").submit(function(){
                    var dati  = $("#form_insert").serialize();
                    var table = $(\'#'.$nomeTabella.'\').DataTable();

                    $("#view_form_ins_loading_up").html(\'<div class="col-md-12 text-center"><div class="loader-block"><div class="preloader3"><div class="circ1 loader-warning"></div><div class="circ2 loader-warning"></div><div class="circ3 loader-warning"></div><div class="circ4 loader-warning"></div></div></div></div><div class="col-md-12 text-center"><small class="text-success">Salvataggio in corso..., attendere il termine!</small></div>\');
                    $("#view_form_ins_loading_down").html(\'<div class="col-md-12 text-center"><div class="loader-block"><div class="preloader3"><div class="circ1 loader-warning"></div><div class="circ2 loader-warning"></div><div class="circ3 loader-warning"></div><div class="circ4 loader-warning"></div></div></div></div><div class="col-md-12 text-center"><small class="text-success">Salvataggio in corso..., attendere il termine!</small></div>\');
                    $("#bnt_save_ins_up").hide();   
                    $("#bnt_save_ins_down").hide();

                        $.ajax({
                            url: "'.BASE_URL_ADMIN.'crud/function.crud.php",
                            type: "POST",
                            data: dati,
                                success: function(data) {
                                    _alert("<i class=\"fa fa-plus\"></i> Aggiunta record","Aggiunto record con successo!");  
                                    $("#add").slideToggle();                         
                                    table.ajax.reload();
                                    $("#chiudi_insert").hide(300);
                                    $("#chiudi_insert_top").hide(300);
                                    $("#view_form_ins_loading_up").hide();
                                    $("#view_form_ins_loading_down").hide();
                                    $("#bnt_save_ins_up").show();   
                                    $("#bnt_save_ins_down").show();
                                },
                                error: function(){
                                    alert("Chiamata fallita, si prega di riprovare...");
                                }
                        });
                        return false; // con false senza refresh della pagina
                    });                  

                // UPDATE
                $("#form_update").submit(function(){
                    var dati = $("#form_update").serialize();
                    var table = $(\'#'.$nomeTabella.'\').DataTable();       

                    $("#view_form_loading_up").html(\'<div class="col-md-12 text-center"><div class="loader-block"><div class="preloader3"><div class="circ1 loader-warning"></div><div class="circ2 loader-warning"></div><div class="circ3 loader-warning"></div><div class="circ4 loader-warning"></div></div></div></div><div class="col-md-12 text-center"><small class="text-success">Salvataggio in corso..., attendere il termine!</small></div>\');
                    $("#view_form_loading_down").html(\'<div class="col-md-12 text-center"><div class="loader-block"><div class="preloader3"><div class="circ1 loader-warning"></div><div class="circ2 loader-warning"></div><div class="circ3 loader-warning"></div><div class="circ4 loader-warning"></div></div></div></div><div class="col-md-12 text-center"><small class="text-success">Salvataggio in corso..., attendere il termine!</small></div>\');
                    $("#bnt_save_up").hide();   
                    $("#bnt_save_down").hide();

                        $.ajax({
                            url: "'.BASE_URL_ADMIN.'crud/function.crud.php",
                            type: "POST",
                            data: dati,
                            success: function(msg){  
                                _alert("<i class=\"fa fa-edit\"></i> Modifica record","Record aggiornato con successo!");  
                                    table.ajax.reload();
                                    $("#mod").slideToggle(); 
                                    $("#chiudi_update").hide(300);
                                    $("#chiudi_update_down").hide(300);
                                    $("#aggiungi").show(300);
                                    $("#view_form_loading_up").hide();
                                    $("#view_form_loading_down").hide();
                                    $("#bnt_save_up").show();   
                                    $("#bnt_save_down").show();
                            },
                            error: function(){
                                alert("Chiamata fallita, si prega di riprovare...");
                            }
                        });
                        return false; // con false senza refresh della pagina
                });

                //UPDATE LAT LON IN COORDINATE

                    $("#LatLng_update").on("change keyup input",function(){
                        var LatLng = $("#LatLng_update").val();
                        var idsito = $("#idsito_update").val();
                        $.ajax({
                            url: "'.BASE_URL_ADMIN.'ajax/siti/save.mappa.php",
                            type: "POST",
                            data: "idsito="+idsito+"&LatLng="+LatLng+"",
                            success: function(msg){  
                                console.log(msg);  
                            },
                            error: function(){
                                alert("Chiamata fallita, si prega di riprovare...");
                            }
                        });
                        return false; 
                });

                // AJAX STATI-REGIONI-PROVINCE-COMUNI
                $("#id_stato").on("click",function(){
                    var id_stato = $("#id_stato").val();
                        $.ajax({
                            url: "'.BASE_URL_ADMIN.'ajax/crm/stato-regione-prov-com.php",
                            type: "POST",
                            data: "id_stato="+id_stato,
                            success: function(data){
                                    $(\'#codice_regione\').html(data);
                            },
                            error: function(){
                                console.log("Chiamata fallita, si prega di riprovare...");
                            }
                        });
                        return false; // con false senza refresh della pagina
                });

                $("#codice_regione").on("click",function(){
                    var codice_regione = $("#codice_regione").val();
                        $.ajax({
                            url: "'.BASE_URL_ADMIN.'ajax/crm/stato-regione-prov-com.php",
                            type: "POST",
                            data: "codice_regione="+codice_regione,
                            success: function(data){
                                    $(\'#codice_provincia\').html(data);
                            },
                            error: function(){
                                console.log("Chiamata fallita, si prega di riprovare...");
                            }
                        });
                        return false; // con false senza refresh della pagina
                });

                $("#codice_provincia").on("click",function(){
                    var codice_provincia = $("#codice_provincia").val();
                        $.ajax({
                            url: "'.BASE_URL_ADMIN.'ajax/crm/stato-regione-prov-com.php",
                            type: "POST",
                            data: "codice_provincia="+codice_provincia,
                            success: function(data){
                                    $(\'#codice_comune\').html(data);
                            },
                            error: function(){
                                console.log("Chiamata fallita, si prega di riprovare...");
                            }
                        });
                        return false; // con false senza refresh della pagina
                });

                //####################################UPDATE######################################

                //INIZIALIZZO I DATEPICKER DROPPER




                // AJAX STATI-REGIONI-PROVINCE-COMUNI
                $("#id_stato_update").on("click",function(){
                    var id_stato = $("#id_stato_update").val();
                        $.ajax({
                            url: "'.BASE_URL_ADMIN.'ajax/crm/stato-regione-prov-com.php",
                            type: "POST",
                            data: "id_stato="+id_stato,
                            success: function(data){
                                    $(\'#codice_regione_update\').html(data);
                            },
                            error: function(){
                                console.log("Chiamata fallita, si prega di riprovare...");
                            }
                        });
                        return false; // con false senza refresh della pagina
                });

                $("#codice_regione_update").on("click",function(){
                    var codice_regione = $("#codice_regione_update").val();
                        $.ajax({
                            url: "'.BASE_URL_ADMIN.'ajax/crm/stato-regione-prov-com.php",
                            type: "POST",
                            data: "codice_regione="+codice_regione,
                            success: function(data){
                                    $(\'#codice_provincia_update\').html(data);
                            },
                            error: function(){
                                console.log("Chiamata fallita, si prega di riprovare...");
                            }
                        });
                        return false; // con false senza refresh della pagina
                });

                $("#codice_provincia_update").on("click",function(){
                    var codice_provincia = $("#codice_provincia_update").val();
                        $.ajax({
                            url: "'.BASE_URL_ADMIN.'ajax/crm/stato-regione-prov-com.php",
                            type: "POST",
                            data: "codice_provincia="+codice_provincia,
                            success: function(data){
                                    $(\'#codice_comune_update\').html(data);
                            },
                            error: function(){
                                console.log("Chiamata fallita, si prega di riprovare...");
                            }
                        });
                        return false; // con false senza refresh della pagina
                });
                

                //################################################################################



                
            }); 

            // PER COMPILARE I CAMPI DELLA MODALE DI DETTAGLIO DEL CLIENTE
            function get_content_dettaglio(id){         
                $("#recupero_dettaglio_cliente").load("'.BASE_URL_ADMIN.'ajax/crm/dettaglio_modale_cliente.php?idsito="+id);
            }

            //FUNZIONE CHE POPOLA CONTENUTI INPUT PER LA MODIFICA
            function get_content_update(id){

                var idsito = id;

                    $("#chiudi_update").show(300);
                    $("#chiudi_update_down").show(300);
                    $("#mod").show(300);
                    $("#add").hide(300);
                    $("#aggiungi").hide(300);

                   
                   $.ajax({								 
                        type: "POST",								 
                        url: "'.BASE_URL_ADMIN.'crud/date.update.crud.php",								 
                        data: "tabella='.$nomeTabella.'&parametro='.$parametro.'&id=" + idsito,
                        dataType: "html",
                            success: function(data){
                                $("#load_db_date").html(data);
                                scroll(\'mod\', 50, 5000); 
                                $("#chiudi_insert").hide(300);
                                $("#chiudi_insert_top").hide(300);
                            },
                            error: function(){
                                alert("Chiamata fallita, si prega di riprovare..."); 
                            }
                    });  
                        
            }

            //FUNZIONE PER ELIMINARE RECORD
            function get_delete(id){
                var tabella = "'.$nomeTabella.'";
                var action  = "delete";
                var param   = "'.$parametro.'";
                var table   = $(\'#'.$nomeTabella.'\').DataTable();

                    $.ajax({
                        url: "'.BASE_URL_ADMIN.'crud/function.crud.php",
                        type: "POST",
                        data: "action="+action+"&tabella="+tabella+"&id="+id+"&param="+param,
                        success: function(data){
                                _alert("<i class=\"fa fa-remove\"></i> Eliminazione record","Record cancellato con successo!"); 
                                table.ajax.reload();
                        },
                        error: function(){
                            alert("Chiamata fallita, si prega di riprovare...");
                        }
                    });
                    return false; // con false senza refresh della pagina
                
            }
            </script>';
?>