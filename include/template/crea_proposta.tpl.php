<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>

<? include_once(BASE_PATH_SITO.'js/add_room.inc.js.php');?>

<? include_once(BASE_PATH_SITO.'include/controller/modello_crea_proposta.php'); ?>

    <div class="pcoded-content">
            <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" name="ctrl_form" id="ctrl_form" enctype="multipart/form-data">
                        <div class="card bg_proposta_yellow" id="fixed_menu_proposte">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-8">
                                        <h3 class="text-primary">Crea Proposta di Soggiorno</h3> 
                                        <div class="clearfix p-b-20"></div>
                                        <ul id="menu_proposta">
                                            <li><a href="#" onclick="scroll_to('richiesta',250, 1000);"  class="text-black f-16">Dati Richiesta</a></li>
                                            <li><a href="#" onclick="scroll_to('clienti',250, 1000);"  class="text-black f-16">Dati Clienti</a></li>
                                            <li><a href="#" onclick="scroll_to('prenotazione',250, 1000);" class="text-black f-16">Dati Prenotazione</a></li>
                                            <li><a href="#" onclick="scroll_to('soggiorno',250, 1000);" class="text-black f-16">Proposte Soggiorno</a></li>
                                            <li><a href="#" onclick="scroll_to('informazioni',250, 1000);" class="text-black f-16">Informazioni</a></li>
                                            <li></li>
                                            <li class="p-0"><a href="<?=BASE_URL_SITO?>preventivi/" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Torna ai preventivi!"><i class="fa fa-angle-double-left fa-2x"></i> <i class="ti-layout-media-right-alt fa-2x"></i></a></li>
                                            <li class="p-0"><button type="submit" id="bottone_salva" onclick="check_prezzo()" class="btn btn-success">Salva e crea proposta</button></li>
                                            <li class="p-0"><button data-toggle="modal" data-target="#calculator" type="button" class="btn btn-grd-inverse btn-out-dotted btn-inverse btn-sm"><i class="fa fa-calculator fa-2x fa-fw"></i></button></li>
                                        </ul> 
                                        <div id="view_form_loading"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <!-- CAMPI HIDDEN --> 
                                        <input type="hidden" name="AbilitaInvio" id="AbilitaInvio" value="1">
                                        <input type="hidden" name="Lingua" id="Lg" value="">
                                        <input type="hidden" name="idsito" id="idsito" value="<?=IDSITO?>">
                                        <input type="hidden" name="DataRichiesta" id="DataRichiesta" value="<?=$DataDiOggi?>">
                                        <input type="hidden" name="action" id="action" value="create">
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                                <div class="row" id="content_proposte">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-8">            
                                                        <div class="card bg_blocchi_proposta" id="richiesta">
                                                            <div class="card-block">
                                                                <h5 class="text-primary f-w-600">Dati Richiesta</h5>
                                                                <div class="row m-t-30">
                                                                    <div class="col-md-1 f-w-600">Lingua</div>
                                                                    <div class="col-md-8"> 
                                                                        <select name="Lingua" id="Lingua" class="form-control image-picker" required>
                                                                            <?=$ListaLingue?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3"></div>
                                                                </div>
                                                                <div class="row m-t-30">
                                                                    <div class="col-md-4"> 
                                                                        <div class="form-group">
                                                                            <label for="NumeroPrenotazione" class="control-label"><b>Numero di prenotazione</b></label>
                                                                            <input type="text" name="NumeroPrenotazione" id="NumeroPrenotazione" class="form-control" value="<?=$nuovoNumeroPreventivo?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label  class="control-label"><b>Tipologia di richiesta</b></label>
                                                                                <select name="TipoRichiesta" id="TipoRichiesta" onchange="ctrl();" class="form-control">
                                                                                    <option value="Preventivo">Preventivo</option>
                                                                                    <option value="Conferma">Conferma</option>
                                                                                </select>
                                                                        </div>                                                        
                                                                    </div>
                                                                    <div class="col-md-4"> 
                                                                        <div class="form-group">
                                                                            <label for="" class="control-label"><b>Operatore</b></label>
                                                                                <select name="ChiPrenota" id="ChiPrenota" class="form-control" required>
                                                                                    <?=$Operatori?>
                                                                                </select>
                                                                                <input type="hidden" id="EmailSegretaria" name="EmailSegretaria">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--<div class="row m-t-10">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label  class="control-label"><b>Email Operatore</b></label>
                                                                            <select id="EmailSegretaria" name="EmailSegretaria" class="form-control" required>
                                                                                <option value="0">Attendere...</option>
                                                                            </select>
                                                                        </div>                                                        
                                                                    </div>
                                                                </div>-->
                                                            </div>
                                                        </div>
                                                        <div class="card bg_blocchi_proposta" id="clienti">
                                                            <div class="card-block">
                                                                <h5 class="text-primary f-w-600">Dati Clienti</h5>
                                                                 <div class="row m-t-10">
                                                                    <div class="col-md-8"> 
                                                                        <div id="parent" class="form-group">
                                                                            <label  class="control-label"><b>Cerca in rubrica</b></label>
                                                                            <div class="input-group">
                                                                                <span id="rubrica" class="btn btn-inverse btn-outline-inverse"><i class="fa fa-search fa-fw"></i></span>
                                                                                <input type="text" name="Anagrafica" id="myAutocomplete" class="form-control" style="display:none">        
                                                                            </div>                                                                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>        
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-4"> 
                                                                        <div  class="form-group">
                                                                            <label  class="control-label"><b>Nome</b></label>                                                                          
                                                                            <input type="text" name="Nome" id="Nome" class="form-control" value="<?=$_REQUEST['Nome']?>" required>                                                                           
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label  class="control-label"><b>Cognome</b></label>
                                                                            <input type="text" name="Cognome" id="Cognome" class="form-control" value="<?=$_REQUEST['Cognome']?>" required>
                                                                        </div>                                                        
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label  class="control-label"><b>Email</b></label>
                                                                            <input type="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" required name="Email" id="Email" class="form-control" value="<?=$_REQUEST['Email']?>">
                                                                            <span id="check_email"></span>
                                                                        </div>                                                                                                                          
                                                                    </div>
                                                                </div>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-4"> 
                                                                        <div class="form-group">
                                                                            <label for="NumeroPrenotazione" class="control-label"><b>Prefisso Internazionale</b></label>
                                                                            <select id="PrefissoInternazionale" name="PrefissoInternazionale" class="form-control">
                                                                                <?=$ListaPrefissi?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label  class="control-label"><b>Telefono Mobile</b> <i class="fa fa-question-circle" data-toggle="tooltip" title="" aria-hidden="true" data-original-title="Per inviare messaggi da WhatsApp è necessario l'utilizzo di WhatsApp Business, altrimenti bisogna inserire il numero del cliente nella rubrica"></i></label>
                                                                            <input type="text" name="Cellulare" id="Cellulare" class="form-control" value="<?=$_REQUEST['Cellulare']?>">
                                                                            <span id="check_phone"></span>
                                                                        </div>                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label  class="control-label"><b>Target Cliente</b></label>
                                                                                <select name="TipoVacanza_" id="TipoVacanza_" class="js-example-basic-multiple form-control TipoVacanza" multiple="multiple" required>
                                                                                    <?=$target?>
                                                                                </select>
                                                                                <input type="hidden" name="TipoVacanza" id="TipoVacanza">
                                                                        </div>                                                        
                                                                    </div>
                                                                </div>
                                                                 <div class="row m-t-30">
                                                                    <div class="col-md-3 f-w-600">Template Landing Page <i class="fa fa-question-circle  cursor" data-toggle="tooltip" title="Se vengono associati più Target con relativi template, verrà inserito sempre l'ultimo selezionato verso destra"></i></div>
                                                                    <div class="col-md-9" id="IMGTHUMB"> 
                                                                        <select name="id_template" id="id_template" class="form-control image-picker" required>
                                                                            <?=$ListaTemplate?>
                                                                        </select>
                                                                        <?=$js_target_template?>
                                                                    </div>
                                                                </div>  
                                                            </div>
                                                        </div>
                                                        <div class="card bg_blocchi_proposta" id="prenotazione">
                                                            <div class="card-block">
                                                                <h5 class="text-primary f-w-600">Dati Prenotazione  <text id="notti"></text>  </h5>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-4"> 
                                                                        <div class="form-group">
                                                                            <label for="DataArrivo" class="control-label"><b>Data principale di Arrivo</b></label>
                                                                            <input type="date" name="DataArrivo" id="DataArrivo" class="form-control" value="" min="<?=$DataDiOggi?>" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="control-label"><b>Data principale di Partenza</b></label>
                                                                            <input type="date" name="DataPartenza" id="DataPartenza" class="form-control" value="" min="<?=$DataDiDomani?>" required>
                                                                        </div>                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-4"> 
                                                                        <div class="form-group">
                                                                            <label class="control-label"><b>Numero totale Adulti</b></label>            
                                                                                <select name="NumeroAdulti" id="NumeroAdulti" class="form-control" required>
                                                                                    <?=$NumeroAdulti?>
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label  class="control-label"><b>Numero totale Bambini</b></label>
                                                                                <select name="NumeroBambini" id="NumeroBambini" class="form-control">
                                                                                    <?=$NumeroBambini?>
                                                                                </select>
                                                                        </div>                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card bg_blocchi_proposta" id="soggiorno">
                                                            <div class="card-block">
                                                                <h5 class="text-primary  f-w-600">Proposte Soggiorno</h5>
                                                                <div id="load_db_date"></div>
                                                                <div id="load_db_tariffe"></div>
                                                                 <div id="accordion" role="tablist" aria-multiselectable="true">
                                                                    <div class="accordion-panel card card-block  m-t-30">                                                                                                                                                
                                                                        <a class="f-w-600 text-black checkCaret" data-toggle="collapse" data-parent="#accordion" onclick="scroll_to('soggiorno',150, 500);" href="#collapse1" aria-expanded="true" aria-controls="collapseOne">
                                                                            PROPOSTA 1  
                                                                            <i class="fa fa-caret-up fa-2x fa-fw f-right"></i>
                                                                        </a>                                                                        
                                                                        <div id="collapse1" class="panel-collapse collapse in show" role="tabpanel">                                                                           
                                                                            <input type="hidden" name="id_proposta" value="1">
                                                                            <div class="Check1" style="display:none">
                                                                                <label for="CheckProposta"> Seleziona Proposta</label>
                                                                                <div class="form-group">
                                                                                    <input type="checkbox" value="1" name="CheckProposta1" id="CheckProposta_1">
                                                                                </div>
                                                                            </div>
                                                                            <?=$BookingOnline?>                                                                           
                                                                               <div class="row m-t-10">
                                                                                    <div class="col-md-4"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Data di Arrivo</b> (alternativa)</label>
                                                                                            <input type="date" name="DataArrivo1" id="DataArrivo_1" class="form-control" value="" min="<?=$DataDiOggi?>" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Data di Partenza</b> (alternativa)</label>
                                                                                            <input type="date" name="DataPartenza1" id="DataPartenza_1" class="form-control" value="" min="<?=$DataDiDomani?>" required>
                                                                                        </div>                                                        
                                                                                    </div>
                                                                                </div>                                                                               
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Nome proposta o del pacchetto</b></label>
                                                                                                <select name="NomeProposta1" id="NomeProposta_1" class="form-control">
                                                                                                    <?=$lista_pacchetti?>
                                                                                                </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Descrizione proposta o del pacchetto</b></label>
                                                                                                <textarea class="form-control" name="TestoProposta1" id="TestoProposta_1" rows="3" placeholder="Non è obbligatoria la compilazione di questo campo, ma offre qualche informazione in più per la proposta"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <?=$resultBookingOnline?>
                                                                                <!-- $riga_camere_proposta_1: variabile che nasce dentro il file modello_crea_proposta -->
                                                                                <?=$riga_camere_proposta_1?>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-3">
                                                                                    <!--
                                                                                        <div class="form-group">                                                                                           
                                                                                            <label for="Prezzo"><b>Prezzo Soggiorno <strike>Listino</strike></b></label>
                                                                                            <input type="text" onclick="calcola_totale1();" name="PrezzoL1" id="PrezzoL_1" class="form-control" placeholder="0000.00">                                                                                            
                                                                                        </div>-->
                                                                                        <input type="hidden" onclick="calcola_totale1();" name="PrezzoL1" id="PrezzoL_1" class="form-control" placeholder="0000.00">
                                                                                        <span id="sconto_P1"></span>                                                               
                                                                                    </div>
                                                                                    <div class="col-md-3"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Prezzo soggiorno proposto</b></label>
                                                                                            <input type="text" title="Clicca per il calcolo del totale" onclick="calcola_totale1();" name="PrezzoP1" id="PrezzoP_1" class="form-control" placeholder="0000.00">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Sconto</b></label>
                                                                                            <select name="SC1" id="SC_1" class="form-control">
                                                                                                <option value="0" selected="selected"></option>
                                                                                                <?=$percentuali_sconto?>
                                                                                            </select>
                                                                                            <input type="hidden" name="sconto_camere1" id="sconto_camere_1">
                                                                                            <div id="Imponibile_1"></div>
                                                                                        </div>                                                        
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <label for="acconto_richiesta">
                                                                                                <b>Caparra</b> <i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Se usate:<br> <b>Carta di Credito a garanzia</b> ricordatevi di disabilitare qualsiasi altro metodo di pagamento che non sia Carta di Credito"></i>
                                                                                            </label>
                                                                                            <select name="AccontoPercentuale1" id="AccontoPercentuale_1" class="form-control">
                                                                                                <?=$AccontoRichiesta?>
                                                                                            </select>
                                                                                            <div id="acconto_l1"></div>
                                                                                        </div>                                                        
                                                                                    </div>
                                                                                </div>                  
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Tipologia tariffa</b></label>
                                                                                                <select name="EtichettaTariffa1" id="EtichettaTariffa_1" class="form-control">
                                                                                                    <option value="">scegli</option>
                                                                                                </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Condizioni e politiche di cancellazione per tariffa</b></label>
                                                                                                <textarea class="form-control" name="AccontoTesto1" id="AccontoTesto_1" rows="3" placeholder="Il campo si auto-compila scegliendo la tipologia di tariffa"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-panel card card-block">                                                                                                                                    
                                                                        <a  class="f-w-600 text-black checkCaret" data-toggle="collapse" data-parent="#accordion" onclick="scroll_to('soggiorno',150, 500);" href="#collapse2" aria-expanded="true" aria-controls="collapseOne">
                                                                             PROPOSTA 2  
                                                                            <i class="fa fa-caret-down fa-2x fa-fw f-right"></i>
                                                                        </a>                                                                
                                                                        <div id="collapse2" class="panel-collapse collapse in" role="tabpanel">                                                                           
                                                                            <input type="hidden" name="id_proposta" value="2">
                                                                            <div class="Check2" style="display:none">
                                                                                <label for="CheckProposta"> Seleziona Proposta</label>
                                                                                <div class="form-group">
                                                                                    <input type="checkbox" value="1" name="CheckProposta2" id="CheckProposta_2">
                                                                                </div>
                                                                            </div>
                                                                            <?=$BookingOnline2?>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-4"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Data di Arrivo</b> (alternativa)</label>
                                                                                            <input type="date" name="DataArrivo2" id="DataArrivo_2" class="form-control" value="" min="<?=$DataDiOggi?>" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Data di Partenza</b> (alternativa)</label>
                                                                                            <input type="date" name="DataPartenza2" id="DataPartenza_2" class="form-control" value="" min="<?=$DataDiDomani?>" required>
                                                                                        </div>                                                        
                                                                                    </div>
                                                                                </div>                                                                               
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Nome proposta o del pacchetto</b></label>
                                                                                                <select name="NomeProposta2" id="NomeProposta_2" class="form-control">
                                                                                                    <?=$lista_pacchetti?>
                                                                                                </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Descrizione proposta o del pacchetto</b></label>
                                                                                                <textarea class="form-control" name="TestoProposta2" id="TestoProposta_2" rows="3" placeholder="Non è obbligatoria la compilazione di questo campo, ma offre qualche informazione in più per la proposta"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?=$resultBookingOnline2?>
                                                                            <!-- $riga_camere_proposta_2: variabile che nasce dentro il file modello_crea_proposta -->
                                                                            <?=$riga_camere_proposta_2?>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-3">
                                                                                        <!-- 
                                                                                        <div class="form-group">
                                                                                            <label for="Prezzo"><b>Prezzo Soggiorno <strike>Listino</strike></b></label>
                                                                                            <input type="text" onclick="calcola_totale1();" name="PrezzoL2" id="PrezzoL_2" class="form-control" placeholder="0000.00">
                                                                                        </div>                                                                                       
                                                                                        -->
                                                                                        <input type="hidden" onclick="calcola_totale1();" name="PrezzoL2" id="PrezzoL_2" class="form-control" placeholder="0000.00">
                                                                                        <span id="sconto_P2"></span> 
                                                                                    </div>
                                                                                    <div class="col-md-3"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Prezzo soggiorno proposto</b></label>
                                                                                            <input type="text" title="Clicca per il calcolo del totale" onclick="calcola_totale2();" name="PrezzoP2" id="PrezzoP_2" class="form-control" placeholder="0000.00">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Sconto</b></label>
                                                                                            <select name="SC2" id="SC_2" class="form-control">
                                                                                                <option value="0" selected="selected"></option>
                                                                                                <?=$percentuali_sconto?>
                                                                                            </select>
                                                                                            <input type="hidden" name="sconto_camere2" id="sconto_camere_2">
                                                                                            <div id="Imponibile_2"></div>
                                                                                        </div>                                                        
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <label for="acconto_richiesta">
                                                                                                <b>Caparra</b> <i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Se usate:<br> <b>Carta di Credito a garanzia</b> ricordatevi di disabilitare qualsiasi altro metodo di pagamento che non sia Carta di Credito"></i>
                                                                                            </label>
                                                                                            <select name="AccontoPercentuale2" id="AccontoPercentuale_2" class="form-control">
                                                                                                <?=$AccontoRichiesta?>
                                                                                            </select>
                                                                                            <div id="acconto_l2"></div>
                                                                                        </div>                                                        
                                                                                    </div>
                                                                                </div>                  
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Tipologia tariffa</b></label>
                                                                                                <select name="EtichettaTariffa2" id="EtichettaTariffa_2" class="form-control">
                                                                                                    <option value="">scegli</option>
                                                                                                </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Condizioni e politiche di cancellazione per tariffa</b></label>
                                                                                                <textarea class="form-control" name="AccontoTesto2" id="AccontoTesto_2" rows="3" placeholder="Il campo si auto-compila scegliendo la tipologia di tariffa"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>  
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-panel card card-block">                                                                                                                                                                                                              
                                                                        <a  class="f-w-600 text-black checkCaret" data-toggle="collapse" data-parent="#accordion" onclick="scroll_to('soggiorno',150, 500);" href="#collapse3" aria-expanded="true" aria-controls="collapseOne">
                                                                            PROPOSTA 3
                                                                            <i class="fa fa-caret-down fa-2x fa-fw f-right"></i>
                                                                        </a>                                                                    
                                                                        <div id="collapse3" class="panel-collapse collapse in" role="tabpanel">                                                                           
                                                                            <input type="hidden" name="id_proposta" value="3">
                                                                            <div class="Check3" style="display:none">
                                                                                <label for="CheckProposta"> Seleziona Proposta</label>
                                                                                <div class="form-group">
                                                                                    <input type="checkbox" value="1" name="CheckProposta3" id="CheckProposta_3">
                                                                                </div>
                                                                            </div>
                                                                            <?=$BookingOnline3?>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-4"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Data di Arrivo</b> (alternativa)</label>
                                                                                            <input type="date" name="DataArrivo3" id="DataArrivo_3" class="form-control" value="" min="<?=$DataDiOggi?>" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Data di Partenza</b> (alternativa)</label>
                                                                                            <input type="date" name="DataPartenza3" id="DataPartenza_3" class="form-control" value="" min="<?=$DataDiDomani?>" required>
                                                                                        </div>                                                        
                                                                                    </div>
                                                                                </div>                                                                               
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Nome proposta o del pacchetto</b></label>
                                                                                                <select name="NomeProposta3" id="NomeProposta_3" class="form-control">
                                                                                                    <?=$lista_pacchetti?>
                                                                                                </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Descrizione proposta o del pacchetto</b></label>
                                                                                                <textarea class="form-control" name="TestoProposta3" id="TestoProposta_3" rows="3" placeholder="Non è obbligatoria la compilazione di questo campo, ma offre qualche informazione in più per la proposta"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?=$resultBookingOnline3?>
                                                                            <!-- $riga_camere_proposta_3: variabile che nasce dentro il file modello_crea_proposta -->
                                                                            <?=$riga_camere_proposta_3?>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-3">
                                                                                        <!--                                                                                         
                                                                                        <div class="form-group">
                                                                                            <label for="Prezzo"><b>Prezzo Soggiorno <strike>Listino</strike></b></label>
                                                                                            <input type="text" onclick="calcola_totale3();" name="PrezzoL3" id="PrezzoL_3" class="form-control" placeholder="0000.00">
                                                                                        </div> 
                                                                                        -->
                                                                                        <input type="hidden" onclick="calcola_totale3();" name="PrezzoL3" id="PrezzoL_3" class="form-control" placeholder="0000.00">
                                                                                        <span id="sconto_P3"></span>
                                                                                    </div>
                                                                                    <div class="col-md-3"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Prezzo soggiorno proposto</b></label>
                                                                                            <input type="text" title="Clicca per il calcolo del totale" onclick="calcola_totale3();" name="PrezzoP3" id="PrezzoP_3" class="form-control" placeholder="0000.00">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Sconto</b></label>
                                                                                            <select name="SC3" id="SC_3" class="form-control">
                                                                                                <option value="0" selected="selected"></option>
                                                                                                <?=$percentuali_sconto?>
                                                                                            </select>
                                                                                            <input type="hidden" name="sconto_camere3" id="sconto_camere_3">
                                                                                            <div id="Imponibile_3"></div>
                                                                                        </div>                                                        
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <label for="acconto_richiesta">
                                                                                                <b>Caparra</b> <i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Se usate:<br> <b>Carta di Credito a garanzia</b> ricordatevi di disabilitare qualsiasi altro metodo di pagamento che non sia Carta di Credito"></i>
                                                                                            </label>
                                                                                            <select name="AccontoPercentuale3" id="AccontoPercentuale_3" class="form-control">
                                                                                                <?=$AccontoRichiesta?>
                                                                                            </select>
                                                                                            <div id="acconto_l3"></div>
                                                                                        </div>                                                        
                                                                                    </div>
                                                                                </div>                  
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Tipologia tariffa</b></label>
                                                                                                <select name="EtichettaTariffa3" id="EtichettaTariffa_3" class="form-control">
                                                                                                    <option value="">scegli</option>
                                                                                                </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Condizioni e politiche di cancellazione per tariffa</b></label>
                                                                                                <textarea class="form-control" name="AccontoTesto3" id="AccontoTesto_3" rows="3" placeholder="Il campo si auto-compila scegliendo la tipologia di tariffa"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>                                                                              
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-panel card card-block">                                                                                                                                                                                                                     
                                                                        <a  class="f-w-600 text-black checkCaret" data-toggle="collapse" data-parent="#accordion" onclick="scroll_to('soggiorno',150, 500);" href="#collapse4" aria-expanded="true" aria-controls="collapseOne">
                                                                            PROPOSTA 4
                                                                            <i class="fa fa-caret-down fa-2x fa-fw f-right"></i>
                                                                        </a>                                                                            
                                                                        <div id="collapse4" class="panel-collapse collapse in" role="tabpanel">                                                                            
                                                                            <input type="hidden" name="id_proposta" value="4">
                                                                            <div class="Check4" style="display:none">
                                                                                <label for="CheckProposta"> Seleziona Proposta</label>
                                                                                <div class="form-group">
                                                                                    <input type="checkbox" value="1" name="CheckProposta4" id="CheckProposta_4">
                                                                                </div>
                                                                            </div>                                                                       
                                                                            <?=$BookingOnline4?>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-4"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Data di Arrivo</b> (alternativa)</label>
                                                                                            <input type="date" name="DataArrivo4" id="DataArrivo_4" class="form-control" value="" min="<?=$DataDiOggi?>" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Data di Partenza</b> (alternativa)</label>
                                                                                            <input type="date" name="DataPartenza4" id="DataPartenza_4" class="form-control" value="" min="<?=$DataDiDomani?>" required>
                                                                                        </div>                                                        
                                                                                    </div>
                                                                                </div>                                                                               
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Nome proposta o del pacchetto</b></label>
                                                                                                <select name="NomeProposta4" id="NomeProposta_4" class="form-control">
                                                                                                    <?=$lista_pacchetti?>
                                                                                                </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Descrizione proposta o del pacchetto</b></label>
                                                                                                <textarea class="form-control" name="TestoProposta4" id="TestoProposta_4" rows="3" placeholder="Non è obbligatoria la compilazione di questo campo, ma offre qualche informazione in più per la proposta"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?=$resultBookingOnline4?>
                                                                            <!-- $riga_camere_proposta_4: variabile che nasce dentro il file modello_crea_proposta -->
                                                                            <?=$riga_camere_proposta_4?>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-3">
                                                                                        <!-- 
                                                                                        <div class="form-group">
                                                                                            <label for="Prezzo"><b>Prezzo Soggiorno <strike>Listino</strike></b></label>
                                                                                            <input type="text" onclick="calcola_totale4();" name="PrezzoL4" id="PrezzoL_4" class="form-control" placeholder="0000.00">
                                                                                        </div>
                                                                                        -->
                                                                                        <input type="hidden" onclick="calcola_totale4();" name="PrezzoL4" id="PrezzoL_4" class="form-control" placeholder="0000.00">
                                                                                        <span id="sconto_P4"></span> 
                                                                                    </div>
                                                                                    <div class="col-md-3"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Prezzo soggiorno proposto</b></label>
                                                                                            <input type="text" title="Clicca per il calcolo del totale" onclick="calcola_totale4();" name="PrezzoP4" id="PrezzoP_4" class="form-control" placeholder="0000.00">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Sconto</b></label>
                                                                                            <select name="SC4" id="SC_4" class="form-control">
                                                                                                <option value="0" selected="selected"></option>
                                                                                                <?=$percentuali_sconto?>
                                                                                            </select>
                                                                                            <input type="hidden" name="sconto_camere4" id="sconto_camere_4">
                                                                                            <div id="Imponibile_4"></div>
                                                                                        </div>                                                        
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <label for="acconto_richiesta">
                                                                                                <b>Caparra</b> <i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Se usate:<br> <b>Carta di Credito a garanzia</b> ricordatevi di disabilitare qualsiasi altro metodo di pagamento che non sia Carta di Credito"></i>
                                                                                            </label>
                                                                                            <select name="AccontoPercentuale4" id="AccontoPercentuale_4" class="form-control">
                                                                                                <?=$AccontoRichiesta?>
                                                                                            </select>
                                                                                            <div id="acconto_l4"></div>
                                                                                        </div>                                                        
                                                                                    </div>
                                                                                </div>                  
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Tipologia tariffa</b></label>
                                                                                                <select name="EtichettaTariffa4" id="EtichettaTariffa_4" class="form-control">
                                                                                                    <option value="">scegli</option>
                                                                                                </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Condizioni e politiche di cancellazione per tariffa</b></label>
                                                                                                <textarea class="form-control" name="AccontoTesto4" id="AccontoTesto_4" rows="3" placeholder="Il campo si auto-compila scegliendo la tipologia di tariffa"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>                                                                               
                                                                        </div>
                                                                    </div>
                                                                    <div class="accordion-panel card card-block">                                                                                                                                                                                                                 
                                                                        <a  class="f-w-600 text-black checkCaret" data-toggle="collapse" data-parent="#accordion" onclick="scroll_to('soggiorno',150, 500);" href="#collapse5" aria-expanded="true" aria-controls="collapseOne">
                                                                            PROPOSTA 5
                                                                            <i class="fa fa-caret-down fa-2x fa-fw f-right"></i>
                                                                        </a>                                                                  
                                                                        <div id="collapse5" class="panel-collapse collapse in" role="tabpanel">                                                                            
                                                                            <input type="hidden" name="id_proposta" value="5">
                                                                            <div class="Check4" style="display:none">
                                                                                <label for="CheckProposta"> Seleziona Proposta</label>
                                                                                <div class="form-group">
                                                                                    <input type="checkbox" value="1" name="CheckProposta5" id="CheckProposta_5">
                                                                                </div>
                                                                            </div> 
                                                                            <?=$BookingOnline5?>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-4"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Data di Arrivo</b> (alternativa)</label>
                                                                                            <input type="date" name="DataArrivo5" id="DataArrivo_5" class="form-control" value="" min="<?=$DataDiOggi?>" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Data di Partenza</b> (alternativa)</label>
                                                                                            <input type="date" name="DataPartenza5" id="DataPartenza_5" class="form-control" value="" min="<?=$DataDiDomani?>" required>
                                                                                        </div>                                                        
                                                                                    </div>
                                                                                </div>                                                                               
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Nome proposta o del pacchetto</b></label>
                                                                                                <select name="NomeProposta5" id="NomeProposta_5" class="form-control">
                                                                                                    <?=$lista_pacchetti?>
                                                                                                </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Descrizione proposta o del pacchetto</b></label>
                                                                                                <textarea class="form-control" name="TestoProposta5" id="TestoProposta_5" rows="3" placeholder="Non è obbligatoria la compilazione di questo campo, ma offre qualche informazione in più per la proposta"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?=$resultBookingOnline5?>
                                                                            <!-- $riga_camere_proposta_5: variabile che nasce dentro il file modello_crea_proposta -->
                                                                            <?=$riga_camere_proposta_5?>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-3">
                                                                                        <!--
                                                                                         <div class="form-group">
                                                                                            <label for="Prezzo"><b>Prezzo Soggiorno <strike>Listino</strike></b></label>
                                                                                            <input type="text" onclick="calcola_totale5();" name="PrezzoL5" id="PrezzoL_5" class="form-control" placeholder="0000.00">
                                                                                        </div>
                                                                                        -->
                                                                                        <input type="hidden" onclick="calcola_totale5();" name="PrezzoL5" id="PrezzoL_5" class="form-control" placeholder="0000.00">
                                                                                        <span id="sconto_P5"></span> 
                                                                                    </div>
                                                                                    <div class="col-md-3"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Prezzo soggiorno proposto</b></label>
                                                                                            <input type="text" title="Clicca per il calcolo del totale" onclick="calcola_totale5();" name="PrezzoP5" id="PrezzoP_5" class="form-control" placeholder="0000.00">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Sconto</b></label>
                                                                                            <select name="SC5" id="SC_5" class="form-control">
                                                                                                <option value="0" selected="selected"></option>
                                                                                                <?=$percentuali_sconto?>
                                                                                            </select>
                                                                                            <input type="hidden" name="sconto_camere5" id="sconto_camere_5">
                                                                                            <div id="Imponibile_5"></div>
                                                                                        </div>                                                        
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <label for="acconto_richiesta">
                                                                                                <b>Caparra</b> <i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Se usate:<br> <b>Carta di Credito a garanzia</b> ricordatevi di disabilitare qualsiasi altro metodo di pagamento che non sia Carta di Credito"></i>
                                                                                            </label>
                                                                                            <select name="AccontoPercentuale5" id="AccontoPercentuale_5" class="form-control">
                                                                                                <?=$AccontoRichiesta?>
                                                                                            </select>
                                                                                            <div id="acconto_l5"></div>
                                                                                        </div>                                                        
                                                                                    </div>
                                                                                </div>                  
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Tipologia tariffa</b></label>
                                                                                                <select name="EtichettaTariffa5" id="EtichettaTariffa_5" class="form-control">
                                                                                                    <option value="">scegli</option>
                                                                                                </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row m-t-10">
                                                                                    <div class="col-md-8"> 
                                                                                        <div class="form-group">
                                                                                            <label class="control-label"><b>Condizioni e politiche di cancellazione per tariffa</b></label>
                                                                                                <textarea class="form-control" name="AccontoTesto5" id="AccontoTesto_5" rows="3" placeholder="Il campo si auto-compila scegliendo la tipologia di tariffa"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>                                                                               
                                                                        </div>
                                                                    </div>                                                                  
                                                                </div>                                                              
                                                            </div>
                                                        </div>
                                                        <div class="card bg_blocchi_proposta" id="informazioni">
                                                                <div class="card-block">
                                                                <h5 class="text-primary f-w-600">Informazioni</h5>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-4"> 
                                                                        <div class="form-group">
                                                                            <label class="control-label"><b>Fonte Prenotazione</b></label>            
                                                                                <select name="FontePrenotazione" id="FontePrenotazione" class="form-control" required>
                                                                                    <?=$fonti?>
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label  class="control-label"><b>Data Scadenza della proposta</b></label>
                                                                            <input type="date" name="DataScadenza" id="DataScadenza" class="form-control" value="" min="<?=$DataDiOggi?>" required>
                                                                        </div>                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-4"> 
                                                                        <div class="form-group">
                                                                            <label class="control-label"><b>Aggiungi Info Box a questa proposta</b>
                                                                                <i class="fa fa-question-circle" data-toggle="tooltip" aria-hidden="true" title="L'aggiunta di questi Info-Box è possibile solo per i nuovi template landing, per le vecchie versioni non vengono presi in considerazioni"></i>
                                                                            </label>            
                                                                                <select name="id_infobox[]" id="id_infobox" class=" form-control" multiple="multiple">
                                                                                    <?=$infoBox?>
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4"> 
                                                                        <div class="form-group">
                                                                            <label class="control-label"><b>Condizioni generali</b></label>            
                                                                                <select name="id_politiche" id="id_politiche" class="form-control" required>
                                                                                    <?=$politiche?>
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-8"> 
                                                                        <div class="form-group">
                                                                            <label class="control-label"><b>Note</b><br>        
                                                                                Il campo è visibile solo all'operatore di Quoto, il suo contenuto è individuabile nella stampa del PDF!</label>            
                                                                           <textarea class="form-control" rows="6" name="Note" id="Note"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row m-t-10">
                                                                    <div class="col-md-12"> 
                                                                        <div class="form-group">
                                                                            <label class="control-label"><b>Tipologie di pagamento</b></label> 
                                                                            <?=$TipiPagamento?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <? include_module('backtop.inc.php'); ?> 
                                                            </div>
                                                        </div>

                                                    </div> 
                                                    <div class="col-md-3">
                                                        <div class="scrollingBox">
                                                            <div id="storico_cliente"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    <div class="modal fade modale_drag draggable" id="calculator">
        <div class="modal-dialog">
            <div class="modal-content modal-calculator">
                <div class="modal-header">
                    <h5 class="modal-title">Calcolatrice &nbsp;&nbsp;<small><small>Drag & Drop <i class="fa fa-arrows" aria-hidden="true"></i></small></small></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <iframe width="100%" height="280" src="<?=BASE_URL_SITO?>calculator/index.php" scrolling="no" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <?php if($fun->check_bedzzlebooking(IDSITO)  == 1){include(BASE_PATH_SITO.'include/controller/modale_bedzzle.inc.php');} ?>
    <?php if($fun->check_ericsoftbooking(IDSITO) == 1){include(BASE_PATH_SITO.'include/controller/modale_ericsoft.inc.php');} ?>
    <?php if($fun->check_simplebooking(IDSITO)   == 1){include(BASE_PATH_SITO.'include/controller/modale_simplebooking.inc.php');} ?>
    <?php include(BASE_PATH_SITO.'js/crea_proposta.inc.js.php'); ?>
    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>