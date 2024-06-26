<?
    # VARIABILI DI SETTINGS
    $nomeTabella    = 'anagrafica';
    $join           = urlencode('LEFT JOIN status ON anagrafica.id_status = status.id_status LEFT JOIN stati ON anagrafica.id_stato = stati.id_stato');
    if($_REQUEST['azione']=='ut' && $_REQUEST['param']!=''){
        $where          = urlencode('WHERE anagrafica.idanagra = '.$_REQUEST['param'].'');
    }
    if($_REQUEST['azione']=='sw' && $_REQUEST['param']!=''){
        $where          = urlencode('WHERE anagrafica.idanagra = '.$_REQUEST['param'].'');
    }
    $order          = 'anagrafica.idanagra';
    $typeorder      = 'DESC';
    $parametro      = 'idanagra';
    $campiQuery     = urlencode('anagrafica.*,stati.nome_stato,status.descrizione_status');
    $groupBy        = '';//urlencode('');
    $variabili      = 'tabella='.$nomeTabella.($campiQuery==''?'':'&campiQuery='.$campiQuery).($where==''?'':'&where='.$where).($join==''?'':'&join='.$join).($order==''?'':'&order='.$order).($groupBy==''?'':'&groupBy='.$groupBy).($typeorder==''?'':'&typeorder='.$typeorder).'';

    $arrayStati        = $fun->getListaStati();
    $selected = '';
    foreach ($arrayStati as $key => $value) {

        $listaStati .= '<option value="'.$value['id_stato'].'">'.$value['nome_stato'].'</option>';
        # code...
    }
    $arrayStatus        = $fun->getIdStatus();
    foreach ($arrayStatus as $key => $value) {
        $listaStatus .= '<option value="'.$value['id_status'].'">'.$value['descrizione_status'].'</option>';
        # code...
    }

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
                                    $("#anagrafica_filter").hide();
                                    $(".dt-buttons").hide();
                                });
                            </script>'."\r\n";
        $provenienza .= '<p><i class="fa fa-exclamation-triangle text-warning"></i> Provenienza attuale dall\'area <b>"'.$prov.'"</b>; per poter utilizzare il campo <b>"Filtra i risultati"</b>, resettare l\'attuale query cliccando sulla voce di menù <b>"Clienti"</b> oppure su <a href="'.BASE_URL_ADMIN.'clienti/" class="btn btn-inverse btn-sm">Reset</a></p>'."\r\n";
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

    //$content .= $campi.'<hr>';

    $content .= '      
                      
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 text-right"><label>Nome</label></div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                            <input type="text" class="form-control" id="nome"  name="nome" placeholder=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right"><label>Cognome</label></div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                            <input type="text" class="form-control" id="cognome"  name="cognome" placeholder=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 text-right">
                                        <label>Ragione Sociale</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                            <input type="text" class="form-control" id="rag_soc"  name="rag_soc" placeholder="" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 text-right">
                                        <label>Partita IVA</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                            <input type="text" class="form-control" id="p_iva"  name="p_iva" placeholder="" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 text-right">
                                        <label>Codice Fiscale</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                            <input type="text" class="form-control" id="codice_fiscale"  name="codice_fiscale" placeholder=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 text-right">
                                        <label>Codice Destinatario</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                            <input type="text" class="form-control" id="codice_destinatario"  name="codice_destinatario" placeholder=""/>
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
                                            <select class="form-control" id="id_stato"  name="id_stato" >
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
                                            <select class="form-control" id="codice_regione"  name="codice_regione" >
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
                                            <select class="form-control" id="codice_provincia"  name="codice_provincia" >
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
                                            <select class="form-control" id="codice_comune"  name="codice_comune" >
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
                                            <input type="text" class="form-control" id="indirizzo"  name="indirizzo" />
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
                                            <input type="text" class="form-control" id="cap"  name="cap" maxlength="5"/>
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
                                                    <input type="text" class="form-control" id="tel"  name="tel" required />
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
												<label>PEC 1</label>
											</div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-paper-plane-o"></i></span>
                                                    <input type="text" class="form-control" id="pec1"  name="pec1" />
                                                </div>
                                            </div>
										</div>
									</div>
                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>PEC 2</label>
											</div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-paper-plane-o"></i></span>
                                                    <input type="text" class="form-control" id="pec2"  name="pec2" />
                                                </div>
                                            </div>
										</div>
									</div>
                                    <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>Contenzioso</label>
											</div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-sitemap"></i></span>
                                                    <select class="form-control" id="contenzioso"  name="contenzioso" >
                                                        <option>--</option>
                                                        <option value="N" selected="selected">No</option>
                                                        <option value="S">Si</option>
                                                    </select>
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
                                                    <input type="date" class="form-control" id="data_creazione_"  name="data_creazione_anagra" value="'.date('Y-m-d').'" required />
                                                    <!--<input type="hidden"  id="data_creazione_anagra" name="data_creazione_anagra" />-->
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
                                                    <input type="date" class="form-control" id="data_modifica_"  name="data_modifica_anagra" value="'.date('Y-m-d').'" required />
                                                    <!--<input type="hidden" id="data_modifica_anagra"  name="data_modifica_anagra" />-->
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
                                <input type="hidden" id="param" name="param" value="'.$parametro.'">
                                <input type="hidden" id="action" name="action" value="update">
                                <input type="hidden" id="tabella" name="tabella" value="'.$nomeTabella.'">  
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div id="load_db_date"></div>
                                        <input type="hidden" id="id_" name="id">  
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3 text-right"><label>ID Anagrafica</label></div>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                        <input type="text" class="form-control" id="idanagra_" name="idanagra" readonly="readonly" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                                                             

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3 text-right"><label>Nome</label></div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                <input type="text" class="form-control" id="nome_"  name="nome" placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3 text-right"><label>Cognome</label></div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                <input type="text" class="form-control" id="cognome_"  name="cognome" placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3 text-right">
                                            <label>Ragione Sociale</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                <input type="text" class="form-control" id="rag_soc_"  name="rag_soc" placeholder="" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3 text-right">
                                            <label>Partita IVA</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                <input type="text" class="form-control" id="p_iva_"  name="p_iva" placeholder="" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3 text-right">
                                            <label>Codice Fiscale</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                <input type="text" class="form-control" id="codice_fiscale_"  name="codice_fiscale" placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3 text-right">
                                            <label>Codice Destinatario</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                                <input type="text" class="form-control" id="codice_destinatario_"  name="codice_destinatario" placeholder=""/>
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
                                                <select class="form-control" id="id_stato_"  name="id_stato" >
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
                                                <select class="form-control" id="codice_regione_"  name="codice_regione" >
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
                                                <select class="form-control" id="codice_provincia_"  name="codice_provincia" >
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
                                                <select class="form-control" id="codice_comune_"  name="codice_comune" >
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
                                                <input type="text" class="form-control" id="indirizzo_"  name="indirizzo" />
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
                                                <input type="text" class="form-control" id="cap_"  name="cap" maxlength="5"/>
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
                                                        <input type="text" class="form-control" id="tel_"  name="tel" required />
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
                                                        <input type="text" class="form-control" id="fax_"  name="fax" />
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
                                                        <input type="text" class="form-control" id="cell_"  name="cell" />
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
                                                        <input type="email" class="form-control" id="email_"  name="email" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3 text-right">
                                                    <label>PEC 1</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-paper-plane-o"></i></span>
                                                        <input type="text" class="form-control" id="pec1_"  name="pec1" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3 text-right">
                                                    <label>PEC 2</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-paper-plane-o"></i></span>
                                                        <input type="text" class="form-control" id="pec2_"  name="pec2" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3 text-right">
                                                    <label>Contenzioso</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-sitemap"></i></span>
                                                        <select class="form-control" id="contenzioso_"  name="contenzioso" >
                                                            <option>--</option>
                                                            <option value="N">No</option>
                                                            <option value="S">Si</option>
                                                        </select>
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
                                                        <textarea row="4" class="form-control" id="note_"  name="note" /></textarea>
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
                                                        <input type="date" class="form-control" id="data_creazione_up"  name="data_creazione_anagra"  required />
                                                        <!--<input type="hidden"  id="data_creazione_anagra_" name="data_creazione_anagra" />-->
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
                                                        <input type="date" class="form-control" id="data_modifica_up"  name="data_modifica_anagra" required />
                                                        <!--<input type="hidden" id="data_modifica_anagra_"  name="data_modifica_anagra" />-->
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
                                                        <select class="form-control" id="id_status_"  name="id_status" required >
                                                            <option value="">--</option>
                                                            '.$listaStatus.'
                                                        </select>
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
    $content .='<table id="'.$nomeTabella.'" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13" style="width:100%">
                <thead>
                    <tr>';

    $content .='        <th class="nowrap">IdAnagra</th>
                        <th>Stato</th> 
                        <th>Contenzioso</th>  
                        <th class="nowrap">Rag Soc</th>
                        <th>Indirizzo</th>
                        <th>Tel/Cell</th>
                        <th>Email</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
            </table>'."\r\n";

# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>
            $(document).ready(function() {

                $(\'[data-tooltip="tooltip"]\').tooltip();

                 //INIZIALIZZO I DATEPICKER DROPPER

                $("#data_creazione_").on("change",function() {
                    var data_tmp_ = $("#data_creazione_").val();
                    var data_tmp = data_tmp_.split("-");
                    var new_date = data_tmp[2]+"-"+data_tmp[1]+"-"+data_tmp[0];
                    $("#data_creazione_anagra").val(new_date);
                }); 

                $("#data_modifica_").on("change",function() {
                    var data_tmp_ = $("#data_modifica_").val();
                    var data_tmp = data_tmp_.split("-");
                    var new_date = data_tmp[2]+"-"+data_tmp[1]+"-"+data_tmp[0];
                    $("#data_modifica_anagra").val(new_date);
                });

                // CONFIG DATATABLE
                var table = $("#'.$nomeTabella.'").DataTable( {'."\r\n";

$content .='        responsive: true,
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
                        buttons: [ \'pageLength\',
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
                                { extend: \'print\', text: \'Stampa\' }
                            ]
                        },
                                ],'."\r\n";

$content .='                    "ajax": "'.BASE_URL_ADMIN.'crud/function.crud.php?'.trim($variabili).'",
                            "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "idanagra","class":"text-center" },
                        { "data": "status","class":"text-center" }, 
                        { "data": "contenzioso","class":"text-center" }, 
                        { "data": "rag_soc" },
                        { "data": "comune" },
                        { "data": "tel","class":"text-center" },
                        { "data": "email" ,"class":"text-center"},
                        { "data": "action","class":"text-center" }
                    ],';

        $content .='    "columnDefs": [
                            {"targets": [2,7], "orderable": false}

                        ]'."\r\n";
           

        $content .='}); 

                // ORDINAMENTO TABELLA
                table.order( [ 0, \''.$typeorder.'\' ] ).draw();

                $("#anagrafica_processing").removeClass("card");
                $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");


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
                                    location.reload();
                                    //alert("Chiamata fallita, si prega di riprovare...");
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
                            success: function(data){
                                _alert("<i class=\"fa fa-edit\"></i> Modifica record","Record aggiornato con successo!");  
                                    table.ajax.reload();
                                    $("#mod").slideToggle();  
                                    $("#chiudi_update").hide(300);
                                    $("#chiudi_update_down").hide(300);
                                    $("#aggiungi").show("slow");
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

                 $("#data_creazione_up").on("change",function() {
                    var data_tmp_update_ = $("#data_creazione_up").val();
                    var data_tmp_update = data_tmp_update_.split("-");
                    var new_date_update = data_tmp_update[2]+"-"+data_tmp_update[1]+"-"+data_tmp_update[0];
                    $("#data_creazione_anagra_").val(new_date_update);
                }); 


               $("#data_modifica_up").on("change",function() {
                    var data_tmp_update_ = $("#data_modifica_up").val();
                    var data_tmp_update = data_tmp_update_.split("-");
                    var new_date_update = data_tmp_update[2]+"-"+data_tmp_update[1]+"-"+data_tmp_update[0];
                    $("#data_modifica_anagra_").val(new_date_update);
                }); 

            });


            //FUNZIONE CHE POPOLA CONTENUTI INPUT PER LA MODIFICA
            function get_content_update(id){

                var idanagra = id;

                    $("#chiudi_update").show(300);
                    $("#chiudi_update_down").show(300);
                    $("#mod").show(300);
                    $("#add").hide(300);
                    $("#aggiungi").hide(300);

                   $.ajax({								 
                        type: "POST",								 
                        url: "'.BASE_URL_ADMIN.'crud/date.update.crud.php",								 
                        data: "tabella='.$nomeTabella.'&parametro='.$parametro.'&id=" + idanagra,
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
            </script>'."\r\n";




    
?>
