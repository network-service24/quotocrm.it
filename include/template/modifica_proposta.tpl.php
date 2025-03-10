<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>

<? include_once(BASE_PATH_SITO.'js/add_room.inc.js.php');?>

<? include_once(INC_PATH_CONTROLLER.'modello_crea_proposta.php'); ?>

<?=$check_control_modify?>

    <div class="pcoded-content">
        <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" name="ctrl_form" id="ctrl_form" enctype="multipart/form-data">
                        <div class="card bg_proposta_yellow" id="fixed_menu_proposte">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="col-md-8"><h3 class="text-primary">Modifica Proposta di Soggiorno</h3></div>
                                            <div class="col-md-3">
                                                <div class="bg_light_yellow">
                                                    <div class="row f-12">
                                                        <div class="col-md-6 f-w-900 nowrap"><?=$etichetta_numero?>:</div>
                                                        <div class="col-md-6 text-right"><?=$Id.'/'.$NumeroPrenotazione?></div>
                                                    </div>
                                                    <div class="row f-12">
                                                        <div class="col-md-6 f-w-900 nowrap"><?=$etichetta_data?>:</div>
                                                        <div class="col-md-6 text-right"><?=$data_proposta?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                        <div class="clearfix p-b-20"></div>
                                        <ul id="menu_proposta">
                                            <li><a href="#" onclick="scroll_to('richiesta',250, 1000);"  class="text-black f-16">Dati Richiesta</a></li>
                                            <li><a href="#" onclick="scroll_to('clienti',250, 1000);"  class="text-black f-16">Dati Clienti</a></li>
                                            <li><a href="#" onclick="scroll_to('prenotazione',250, 1000);" class="text-black f-16">Dati Prenotazione</a></li>
                                            <li><a href="#" onclick="scroll_to('soggiorno',250, 1000);" class="text-black f-16">Proposte Soggiorno</a></li>
                                            <li><a href="#" onclick="scroll_to('informazioni',250, 1000);" class="text-black f-16">Informazioni</a></li>
                                            <li></li>
                                            <li class="p-0">
                                            <?php if ($TipoRichiesta == 'Preventivo'){?>
                                                <a href="<?=BASE_URL_SITO?>preventivi/" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Torna ai preventivi!"><i class="fa fa-angle-double-left fa-2x"></i> <i class="ti-layout-media-right-alt fa-2x"></i></a>
                                            <?}elseif($TipoRichiesta == 'Conferma' && $Chiuso == 0){?>
                                                <a href="<?=BASE_URL_SITO?>conferme/" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Torna alle conferme!"><i class="fa fa-angle-double-left fa-2x"></i> <i class="fa fa-credit-card fa-2x"></i></a>
                                            <?}elseif($TipoRichiesta == 'Conferma'  && $Chiuso == 1){?>
                                                <a href="<?=BASE_URL_SITO?>prenotazioni/" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Torna alle prenotazioni!"><i class="fa fa-angle-double-left fa-2x"></i> <i class="fa fa-h-square fa-2x"></i></a>
                                            <?}?>
                                            </li>
                                            <?php if($occupato == 0){?>
                                                <li class="p-0">
                                                    <button id="bottone_salva" type="submit" class="btn btn-success" onclick="check_prezzo();enable_htmlarea('Testo');">
                                                        <?=($Chiuso==1?'Edita e/o riapri in trattativa':'Salva le Modifiche')?>
                                                    </button>
                                                </li>
                                            <?}else{?>
                                                    <li class="p-0">
                                                        <button id="bottone_salva" type="button" class="btn btn-disabled">
                                                            Bloccata
                                                        </button>
                                                    </li>
                                            <?}?>
                                            <? if($Chiuso != 1){?>
                                                <li class="p-0"><button data-toggle="modal" data-target="#calculator" type="button" class="btn btn-grd-inverse btn-out-dotted btn-inverse btn-sm"><i class="fa fa-calculator fa-2x fa-fw"></i></button></li>
                                            <?}?>
                                        </ul>
                                        <div id="view_form_loading"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <!-- CAMPI HIDDEN -->
                                        <input type="hidden" name="DataRichiesta" id="DataRichiesta" value="<?=($DataRichiesta==''?$DataDiOggi:$DataRichiesta)?>">
                                        <input type="hidden" name="Id" id="Id" value="<?=$Id?>">
                                        <input type="hidden" name="idsito" id="idsito" value="<?=IDSITO?>">
                                        <input type="hidden" name="Chiuso" id="Chiuso" value="<?=$Chiuso?>">
                                        <input type="hidden" name="DataChiuso" id="DataChiuso" value="<?=$DataChiuso?>">
                                        <input type="hidden" name="MultiStruttura" id="MultiStruttura" value="<?=$MultiStruttura?>">
                                        <input type="hidden" name="DataRiconferma" id="DataRiconferma" value="<?=($IdMotivazione!=''?$DataDiOggi:'')?>">
                                        <input type="hidden" name="action" value="modify">
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                            </div>
                        </div>
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <div class="row" id="content_modifica_proposte">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-8">
                                                <div class="card bg_blocchi_proposta" id="richiesta">
                                                    <div class="card-block">
                                                        <h5 class="text-primary f-w-600">Dati Richiesta</h5>
                                                        <div class="row m-t-30">
                                                            <div class="col-md-1 f-w-600">Lingua</div>
                                                            <div class="col-md-8">
                                                                <select name="Lingua" id="Lingua" onchange="contenuto_landing();"  class="form-control image-picker" required>
                                                                    <?=$ListaLingue?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3"></div>
                                                        </div>
                                                        <div class="row m-t-30">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="NumeroPrenotazione" class="control-label"><b>Numero di prenotazione</b></label>
                                                                    <input type="text" name="NumeroPrenotazione" id="NumeroPrenotazione" class="form-control" value="<?=$NumeroPrenotazione?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label  class="control-label"><b>Tipologia di richiesta</b></label>
                                                                        <select name="TipoRichiesta" id="TipoRichiesta" onchange="ctrl();contenuto_landing();" class="form-control">
                                                                        <? if($TipoRichiesta=='Conferma'){?>
                                                                            <option value="Conferma" <?=($TipoRichiesta=='Conferma' ?'selected="selected"':'')?>>Conferma</option>
                                                                        <?}else{?>
                                                                            <option value="Preventivo" <?=($TipoRichiesta=='Preventivo'?'selected="selected"':'')?>>Preventivo</option>
                                                                            <option value="Conferma" <?=($TipoRichiesta=='Conferma'?'selected="selected"':'')?>>Conferma</option>
                                                                        <?}?>
                                                                        </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label"><b>Operatore</b></label>
                                                                        <select name="ChiPrenota" id="ChiPrenota" class="form-control" required>
                                                                            <?=$Operatori?>
                                                                        </select>
                                                                        <input type="hidden" id="EmailSegretaria" name="EmailSegretaria" value="<?=$EmailOperatore?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--<div class="row m-t-10">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label  class="control-label"><b>Email Operatore</b></label>
                                                                    <select id="EmailSegretaria" name="EmailSegretaria" class="form-control" required>
                                                                        <option value="0">Attendere...</option>
                                                                        <? //echo $EmailAssociata?>
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
                                                                    <input type="text" name="Nome" id="Nome" class="form-control" value="<?=$Nome?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label  class="control-label"><b>Cognome</b></label>
                                                                    <input type="text" name="Cognome" id="Cognome" class="form-control" value="<?=$Cognome?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label  class="control-label"><b>Email</b></label>
                                                                    <input type="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" required name="Email" id="Email" class="form-control" value="<?=$Email?>">
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
                                                                    <input type="text" name="Cellulare" id="Cellulare" class="form-control" value="<?=$Cellulare?>">
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
                                                                        <input type="hidden" name="TipoVacanza" id="TipoVacanza" value="<?=$TipoVacanza?>">
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
                                                                    <input type="date" name="DataArrivo" id="DataArrivo" class="form-control" value="<?=$DataArrivo?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label"><b>Data principale di Partenza</b></label>
                                                                    <input type="date" name="DataPartenza" id="DataPartenza" class="form-control" value="<?=$DataPartenza?>" required>
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
                                                <div class="card bg_blocchi_proposta" id="editing">
                                                    <div class="card-block">
                                                        <div class="row">
                                                            <div class="col-md-7"><h5 class="text-primary f-w-600">Editing Testo Template</h5></div>
                                                            <div class="col-md-5 text-center">
                                                            <span class="f-12">Vuoi digitare del testo personalizzato, clicca qui &#10230;</span> <a href="javascript:;" onClick="enable_htmlarea('Testo');"  data-toggle="tooltip" data-html="true" title="Vuoi digitare del testo personalizzato?<br> <b>Abilita HtmlArea!</b>" class="p-r-10"><i class="fa fa-html5 fa-2x fa-fw"></i></a>
                                                            <a href="javascript:;" onClick="disable_htmlarea('Testo');" data-toggle="tooltip" data-html="true" title="Per il caricamento dinamico dei contenuti in base alla Lingua, Target e Template;<br> <b>Disabilita HtmlArea!</b>"><i class="fa fa-file-code-o fa-2x fa-fw"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="row m-t-10">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">
                                                                        <b><?=$EtichettaEditingTemplate?></b>
                                                                        <span class="f-11">
                                                                            inserendo la variabile <b>[cliente]</b>. QUOTO sostiuirà <b>[cliente]</b> con il <b>Nome</b> ed il <b>Cognome</b> del contatto
                                                                        </span>
                                                                    </label>
                                                                        <textarea id="Testo" name="Testo" rows="4" class="Testo form-control"><?=$TestoAlternativo?></textarea>
                                                                        <input type="hidden" id="id_testo_alternativo" name="id_testo_alternativo" value="<?=$IdTestoAlternativo?>">
                                                                        <!-- Custom js -->
                                                                        <script type="text/javascript" src="<?=BASE_URL_SITO?>js/ckeditor/ckeditor.js"></script>
                                                                        <script>
                                                                            CKEDITOR.config.toolbar = [
                                                                                            ['Source','-','Maximize'],['Format','Font','FontSize'],
                                                                                            ['Bold','Italic','Underline','StrikeThrough','-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Outdent','Indent'],
                                                                                            ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','Table','Link','TextColor','BGColor']
                                                                                        ] ;
                                                                            CKEDITOR.config.autoGrow_onStartup = true;
                                                                            CKEDITOR.config.extraPlugins = 'autogrow';
                                                                            CKEDITOR.config.autoGrow_minHeight = 100;
                                                                            CKEDITOR.config.autoGrow_maxHeight = 300;
                                                                            CKEDITOR.config.autoGrow_bottomSpace = 50;
                                                                    </script>
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
                                                        <? if($proposte !=''){ ?>
                                                            <div role="tablist" aria-multiselectable="true">
                                                                    <? echo $proposte?>
                                                                    <? include INC_PATH_CONTROLLER.'modello_modifica_proposta.php';?>
                                                            </div>
                                                        <?}else{?>
                                                            <div id="accordion" role="tablist" aria-multiselectable="true">
                                                                <div class="accordion-panel card card-block  m-t-30">
                                                                    <a class="f-16 f-w-600 text-black checkCaret" data-toggle="collapse" data-parent="#accordion" onclick="scroll_to('soggiorno',150, 500);" href="#collapse1" aria-expanded="true" aria-controls="collapseOne">
                                                                        PROPOSTA 1
                                                                        <i class="fa fa-caret-up fa-2x fa-fw f-right"></i>
                                                                    </a>
                                                                    <div id="collapse1" class="panel-collapse collapse in <?=($proposte !=''?'':'show')?>" role="tabpanel">
                                                                        <input type="hidden" name="id_proposta_1" value="1">
                                                                        <div class="Check1" style="display:none">
                                                                            <label for="CheckProposta"> Seleziona Proposta</label>
                                                                            <div class="form-group">
                                                                                <input type="checkbox" value="1" name="CheckProposta1" onclick="check(this);" class="controllo" id="CheckProposta_1">
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
                                                                                                <option value="">scegli</option>
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
                                                                                    </div>
                                                                                    -->
                                                                                    <input type="hidden" onclick="calcola_totale1();" name="PrezzoL1" id="PrezzoL_1" class="form-control" placeholder="0000.00">
                                                                                    <span id="sconto_P1"></span>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label"><b>Prezzo soggiorno proposto</b> <?php echo ($check_pms5==1?'<i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Se il totale soggiorno dopo l\'applicazione dello sconto contiene dei decimali, non modificate manualmente il valore arrotondandolo, perchè al momento della sincronia con 5 Stelle verrebbe rispristinato automaticamente sul PMS!"></i>':'')?></label>
                                                                                        <input type="text" title="Clicca per il calcolo del totale" onclick="calcola_totale1();" name="PrezzoP1" id="PrezzoP_1" class="form-control" placeholder="0000.00">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label"><b>Sconto</b> <i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Se usate la <b>sincronizzazione con un PMS</b>, una volta applicata la percentuale di sconto <b>non modificate più il Prezzo soggiorno proposto</b>!"></i></label>
                                                                                        <select name="SC1" id="SC_1" class="form-control">
                                                                                            <option value="0" selected="selected"></option>
                                                                                            <?=$percentuali_sconto?>
                                                                                        </select>
                                                                                        <input type="hidden" name="sconto_camere1" id="sconto_camere_1">
                                                                                        <div id="Imponibile_1"></div>
                                                                                    </div>
                                                                                    <?=$boxCodiceSconto?>
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
                                                                                                <?=$lista_tariffe?>
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
                                                                        <input type="hidden" name="id_proposta_2" value="2">
                                                                        <div class="Check2" style="display:none">
                                                                            <label for="CheckProposta"> Seleziona Proposta</label>
                                                                            <div class="form-group">
                                                                                <input type="checkbox" value="1" name="CheckProposta2" onclick="check(this);" class="controllo" id="CheckProposta_2">
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
                                                                                                <option value="">scegli</option>
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
                                                                                        <input type="text" onclick="calcola_totale2();" name="PrezzoL2" id="PrezzoL_2" class="form-control" placeholder="0000.00">
                                                                                    </div>
                                                                                    -->
                                                                                    <input type="hidden" onclick="calcola_totale2();" name="PrezzoL2" id="PrezzoL_2" class="form-control" placeholder="0000.00">
                                                                                    <span id="sconto_P2"></span>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label"><b>Prezzo soggiorno proposto</b> <?php echo ($check_pms5==1?'<i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Se il totale soggiorno dopo l\'applicazione dello sconto contiene dei decimali, non modificate manualmente il valore arrotondandolo, perchè al momento della sincronia con 5 Stelle verrebbe rispristinato automaticamente sul PMS!"></i>':'')?></label>
                                                                                        <input type="text" title="Clicca per il calcolo del totale" onclick="calcola_totale2();" name="PrezzoP2" id="PrezzoP_2" class="form-control" placeholder="0000.00">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label"><b>Sconto</b> <i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Se usate la <b>sincronizzazione con un PMS</b>, una volta applicata la percentuale di sconto <b>non modificate più il Prezzo soggiorno proposto</b>!"></i></label>
                                                                                        <select name="SC2" id="SC_2" class="form-control">
                                                                                            <option value="0" selected="selected"></option>
                                                                                            <?=$percentuali_sconto?>
                                                                                        </select>
                                                                                        <input type="hidden" name="sconto_camere2" id="sconto_camere_2">
                                                                                        <div id="Imponibile_2"></div>
                                                                                    </div>
                                                                                    <?=$boxCodiceSconto?>
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
                                                                                                <?=$lista_tariffe?>
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
                                                                        <input type="hidden" name="id_proposta_3" value="3">
                                                                        <div class="Check3" style="display:none">
                                                                            <label for="CheckProposta"> Seleziona Proposta</label>
                                                                            <div class="form-group">
                                                                                <input type="checkbox" value="1" name="CheckProposta3" onclick="check(this);" class="controllo" id="CheckProposta_3">
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
                                                                                                <option value="">scegli</option>
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
                                                                                        <label class="control-label"><b>Prezzo soggiorno proposto</b> <?php echo ($check_pms5==1?'<i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Se il totale soggiorno dopo l\'applicazione dello sconto contiene dei decimali, non modificate manualmente il valore arrotondandolo, perchè al momento della sincronia con 5 Stelle verrebbe rispristinato automaticamente sul PMS!"></i>':'')?></label>
                                                                                        <input type="text" title="Clicca per il calcolo del totale" onclick="calcola_totale3();" name="PrezzoP3" id="PrezzoP_3" class="form-control" placeholder="0000.00">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label"><b>Sconto</b> <i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Se usate la <b>sincronizzazione con un PMS</b>, una volta applicata la percentuale di sconto <b>non modificate più il Prezzo soggiorno proposto</b>!"></i></label>
                                                                                        <select name="SC3" id="SC_3" class="form-control">
                                                                                            <option value="0" selected="selected"></option>
                                                                                            <?=$percentuali_sconto?>
                                                                                        </select>
                                                                                        <input type="hidden" name="sconto_camere3" id="sconto_camere_3">
                                                                                        <div id="Imponibile_3"></div>
                                                                                    </div>
                                                                                    <?=$boxCodiceSconto?>
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
                                                                                                <?=$lista_tariffe?>
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
                                                                        <input type="hidden" name="id_proposta_4" value="4">
                                                                        <div class="Check4" style="display:none">
                                                                            <label for="CheckProposta"> Seleziona Proposta</label>
                                                                            <div class="form-group">
                                                                                <input type="checkbox" value="1" name="CheckProposta4" onclick="check(this);" class="controllo" id="CheckProposta_4">
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
                                                                                                <option value="">scegli</option>
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
                                                                                        <label class="control-label"><b>Prezzo soggiorno proposto</b> <?php echo ($check_pms5==1?'<i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Se il totale soggiorno dopo l\'applicazione dello sconto contiene dei decimali, non modificate manualmente il valore arrotondandolo, perchè al momento della sincronia con 5 Stelle verrebbe rispristinato automaticamente sul PMS!"></i>':'')?></label>
                                                                                        <input type="text" title="Clicca per il calcolo del totale" onclick="calcola_totale4();" name="PrezzoP4" id="PrezzoP_4" class="form-control" placeholder="0000.00">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label"><b>Sconto</b> <i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Se usate la <b>sincronizzazione con un PMS</b>, una volta applicata la percentuale di sconto <b>non modificate più il Prezzo soggiorno proposto</b>!"></i></label>
                                                                                        <select name="SC4" id="SC_4" class="form-control">
                                                                                            <option value="0" selected="selected"></option>
                                                                                            <?=$percentuali_sconto?>
                                                                                        </select>
                                                                                        <input type="hidden" name="sconto_camere4" id="sconto_camere_4">
                                                                                        <div id="Imponibile_4"></div>
                                                                                    </div>
                                                                                    <?=$boxCodiceSconto?>
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
                                                                                                <?=$lista_tariffe?>
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
                                                                        <input type="hidden" name="id_proposta_5" value="5">
                                                                        <div class="Check5" style="display:none">
                                                                            <label for="CheckProposta"> Seleziona Proposta</label>
                                                                            <div class="form-group">
                                                                                <input type="checkbox" value="1" name="CheckProposta5" onclick="check(this);" class="controllo" id="CheckProposta_5">
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
                                                                                                <option value="">scegli</option>
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
                                                                                        <label class="control-label"><b>Prezzo soggiorno proposto</b> <?php echo ($check_pms5==1?'<i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Se il totale soggiorno dopo l\'applicazione dello sconto contiene dei decimali, non modificate manualmente il valore arrotondandolo, perchè al momento della sincronia con 5 Stelle verrebbe rispristinato automaticamente sul PMS!"></i>':'')?></label>
                                                                                        <input type="text" title="Clicca per il calcolo del totale" onclick="calcola_totale5();" name="PrezzoP5" id="PrezzoP_5" class="form-control" placeholder="0000.00">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label"><b>Sconto</b> <i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Se usate la <b>sincronizzazione con un PMS</b>, una volta applicata la percentuale di sconto <b>non modificate più il Prezzo soggiorno proposto</b>!"></i></label>
                                                                                        <select name="SC5" id="SC_5" class="form-control">
                                                                                            <option value="0" selected="selected"></option>
                                                                                            <?=$percentuali_sconto?>
                                                                                        </select>
                                                                                        <input type="hidden" name="sconto_camere5" id="sconto_camere_5">
                                                                                        <div id="Imponibile_5"></div>
                                                                                    </div>
                                                                                    <?=$boxCodiceSconto?>
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
                                                                                                <?=$lista_tariffe?>
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
                                                        <?}?>
                                                    </div>
                                                </div>
                                                <div class="card bg_blocchi_proposta" id="informazioni">
                                                    <div class="card-block">
                                                        <h5 class="text-primary f-w-600">Informazioni</h5>
                                                        <div class="row m-t-10">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label"><b>Fonte Prenotazione</b></label>
                                                                    <?php if($FontePrenotazione != 'Sito Web'){?>
                                                                        <select name="FontePrenotazione" id="FontePrenotazione" class="form-control" required>
                                                                            <?=$fonti?>
                                                                        </select>
                                                                    <?}else{?>
                                                                    <input name="FontePrenotazione" id="FontePrenotazione" class="form-control" required readonly="readonly" value="Sito Web">
                                                                    <?}?>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label  class="control-label"><b>Data Scadenza della proposta</b></label>
                                                                    <input type="date" name="DataScadenza" id="DataScadenza" class="form-control" value="<?=$DataScadenza?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row m-t-10">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                        <label class="control-label"><b>Aggiungi Info Box a questa proposta</b>
                                                                            <i class="fa fa-question-circle" data-toggle="tooltip" aria-hidden="true" title="L'aggiunta di questi Info-Box è possibile solo per i nuovi template landing, per le vecchie versioni non vengono presi in considerazioni"></i>
                                                                        </label>
                                                                        <select name="id_infobox[]" id="id_infobox_" class="form-control" multiple="multiple">
                                                                            <?=$info_Box?>
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
                                                                    <textarea class="form-control" rows="6" name="Note" id="Note"><?=$Note?></textarea>
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
                                                    <?php if($FontePrenotazione=='Sito Web'){?>
                                                            <div class="card bg_blocchi_proposta">
                                                                <div class="card-block">
                                                                    <span class="f-16 f-w-600">Riepilogo richiesta proveniente dal form:</span>
                                                                        <br><br>
                                                                    <div class="f-12">
                                                                        <div class="card">
                                                                            <div class="card-block">
                                                                                <?=nl2br($Note)?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?}?>
                                                    <div id="storico_cliente"></div>
                                                    <script>
                                                        //al termine del caricamento ajax dello storico cliente
                                                        $( document ).on( "ajaxComplete", function() {
                                                            var id = <?=$Id?>;
                                                            var $el = $("div[id*='view" + id +"']");
                                                            //se il div output contenuti esiste controllo la lunghezza
                                                            if ( $el.length) {
                                                                //a questo punto nascondo il blocco
                                                                $("#block" + id +"").hide();
                                                            }
                                                            //dopo aver nasconsto il blocco  allora non ha senso stampare a video il box storico
                                                            var rd = <?=IDSITO;?>;
                                                            var $bx = $("div[id*='viewStorico" + rd +"']");
                                                            //cliclo il contenitore per quante card esitono
                                                            $($bx).each(function() {
                                                                var numCard = $('.card', this).length;
                                                                //se il dvi con classe card è 1 solo e nascosto
                                                                 if (numCard == 1) {
                                                                    if($("#block" + id +"").css('display') == 'none'){
                                                                        //nascondo anche tutto il contenitore
                                                                        $("#storico" + rd +"").hide();
                                                                    }
                                                                }
                                                            })
                                                        })
                                                    </script>
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
    <!-- modale calcolatore -->
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
    <!-- modali booking -->
    <?php if($fun->check_bedzzlebooking(IDSITO)  == 1){include(BASE_PATH_SITO.'include/controller/modale_bedzzle.inc.php');} ?>
    <?php if($fun->check_ericsoftbooking(IDSITO) == 1){include(BASE_PATH_SITO.'include/controller/modale_ericsoft.inc.php');} ?>
    <?php if($fun->check_simplebooking(IDSITO)   == 1){include(BASE_PATH_SITO.'include/controller/modale_simplebooking.inc.php');} ?>
    <?php include(BASE_PATH_SITO.'js/crea_proposta.inc.js.php'); ?>
    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>
