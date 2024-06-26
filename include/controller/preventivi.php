<?
$NumeroRecord = $fun->countRowsPreventivi(IDSITO);

$num_paginazione = $fun->get_pag(IDSITO);

if($num_paginazione != '' && $num_paginazione != 0){
    $RIGHE_PER_PAGINA = $num_paginazione;
}else{
    $RIGHE_PER_PAGINA = RIGHE_PER_PAGINA;
}

if(!$_REQUEST['action'] && $NumeroRecord > NUMERO_RECORD){

            // ----------------------------------------------------------------
            //    C A L C O L O   D E L   N U M E R O   D I   P A G I N E
            $righe_per_pagina = $RIGHE_PER_PAGINA;
            $url_base = BASE_URL_SITO."preventivi/";
            $pagine_vicine = PAGINE_VICINE;
            // ricavo il numero totale di record
            $tot_righe = $fun->numeroRecordPreventivi(IDSITO);
            // totale pagine
            $tot_pagine = ceil($tot_righe / $righe_per_pagina);

            // ----------------------------------------------------------------
            //                 P A G I N A   C O R R E N T E
            $pagina_corrente = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
            // se la pagina corrente è minore di 1
            if($pagina_corrente < 1)  {
            header('location: ' . $url_base);
            exit();
            }
            // se la pagina corrente è maggiore dell'ultima pagina
            if($pagina_corrente > $tot_pagine) {
            header('location: ' . $fun->crea_url($url_base, $tot_pagine));
            exit();
            }
            //               M E N U  P A G I N A Z I O N E
            $link_paginazione = $fun->paginazione($tot_pagine, $url_base, $pagina_corrente, $pagine_vicine);
            // ----------------------------------------------------------------
            # VARIABILI
            $variabili .= '&pagina_corrente='.$pagina_corrente.'';
            $variabili .= '&righe_per_pagina='.$righe_per_pagina.'';

}
$variabili .= ($_REQUEST['action']!=''?'&action='.$_REQUEST['action']:'');
$variabili .= ($_REQUEST['TipoSoggiorno']!=''?'&TipoSoggiorno='.$_REQUEST['TipoSoggiorno']:'');
$variabili .= ($_REQUEST['NumeroPrenotazione']!=''?'&NumeroPrenotazione='.$_REQUEST['NumeroPrenotazione']:'');
$variabili .= ($_REQUEST['Operatore']!=''?'&Operatore='.$_REQUEST['Operatore']:'');
$variabili .= ($_REQUEST['FontePrenotazione']!=''?'&FontePrenotazione='.$_REQUEST['FontePrenotazione']:'');
$variabili .= ($_REQUEST['TipoVacanza']!=''?'&TipoVacanza='.$_REQUEST['TipoVacanza']:'');
$variabili .= ($_REQUEST['Nome']!=''?'&Nome='.$_REQUEST['Nome']:'');
$variabili .= ($_REQUEST['Cognome']!=''?'&Cognome='.$_REQUEST['Cognome']:'');
$variabili .= ($_REQUEST['Email']!=''?'&Email='.$_REQUEST['Email']:'');
$variabili .= ($_REQUEST['NoDisponibilita']!=''?'&NoDisponibilita='.$_REQUEST['NoDisponibilita']:'');
$variabili .= ($_REQUEST['DataInvio']!=''?'&DataInvio='.$_REQUEST['DataInvio']:'');
$variabili .= ($_REQUEST['DataScadenza']!=''?'&DataScadenza='.$_REQUEST['DataScadenza']:'');
$variabili .= ($_REQUEST['DataArrivo']!=''?'&DataArrivo='.$_REQUEST['DataArrivo']:'');
$variabili .= ($_REQUEST['DataPartenza']!=''?'&DataPartenza='.$_REQUEST['DataPartenza']:'');
$variabili .= ($_REQUEST['DataRichiesta_dal']!=''?'&DataRichiesta_dal='.$_REQUEST['DataRichiesta_dal']:'');
$variabili .= ($_REQUEST['DataRichiesta_al']!=''?'&DataRichiesta_al='.$_REQUEST['DataRichiesta_al']:'');
$variabili .= ($_REQUEST['Lingua']!=''?'&Lingua='.$_REQUEST['Lingua']:'');
$variabili .= ($_REQUEST['Aperture']!=''?'&Aperture='.$_REQUEST['Aperture']:'');
$variabili .= ($_REQUEST['chat']!=''?'&chat='.$_REQUEST['chat']:'');
$variabili .= ($_REQUEST['campagna']!=''?'&campagna='.$_REQUEST['campagna']:'');

$contoAllaRovescia = $fun->contoallarovescia(MINUTI_RICARICA,'preventivi');

$checkNumberPrev = $fun->checkNumberRows(IDSITO);
if($checkNumberPrev == 1){
    $boxlegenda .= '<div class="clearfix p-t-20"></div>
                    <div class="row f-11">
                        <div class="col-md-1"><i class="fa fa-check fa-2x fa-fw text-black"></i></div>
                        <div class="col-md-11">
                            E\' stata limitata: la visualizzazione di tutti i Preventivi/Conferme/Prenotazioni/Profila... presenti del vostro DataBase perchè la lista supera il migliaio di righe!<br>
                            Selezionando questa opzione saranno visibili quelli con data dell\'anno in corso più i successivi sei mesi dell\'anno scorso.<br>
                            Se si desidera azzerare l\'opzione, portarsi alla voce di menù:<br>
                            Configurazioni ->  Impostazioni -> Configuratore Plugins -> Limita record, per re-settare il Check!
                        </div>
                    </div> '."\r\n";
}

$giorniRecall = $fun->check_recall_preventivi(IDSITO);
if($giorniRecall!='' || $giorniRecall=='0'){
    $boxRecall = '  <div class="col-md-6">
                        <div class="card col-eq-height">
                            <div class="card-header">
                                <h5 class="text-primary">AUTORESPONDER PREVENTIVI</h5>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-1"><i class="fa fa-send-o fa-2x fa-fw text-black"></i></div>
                                    <div class="col-md-11">E-mail di ReCall Preventivi è configurata per l\'invio automatico: <b>'.$giorniRecall .' giorni prima</b> della Scadenza</div>
                                </div>
                                '.$boxlegenda.'
                            </div>
                        </div>
                    </div>'."\r\n";
}

$boxPortali = ' <div class="col-md-6">
                        <div class="card col-eq-height">
                            <div class="card-header">
                                <h5 class="text-primary">SINCRO PORTALI  & INFO</h5>
                            </div>
                            <div class="card-block">


                                                        <div class="row">
                                                            <div class="col-md-6">';
                                                                $InfoAlberghiButton = $fun->syncro_info_alberghi(IDSITO);
                                                                if(strlen($InfoAlberghiButton)>0){
$boxPortali .= '                                                    <div class="row f-12">
                                                                        <div class="col-md-2">
                                                                            <i class="fa fa-refresh fa-2x fa-fw text-black"></i>
                                                                        </div>
                                                                        <div class="col-md-10">';
                                                                            //syncronizzo i dati dei form richieste preventivi da Info Alberghi
                                                                            $boxPortali .= $fun->check_syncro_info_alberghi(IDSITO);
                                                                            $boxPortali .= $InfoAlberghiButton;

$boxPortali .= '                                                        </div>
                                                                    </div>';
                                                                }
                                                                $SpaHotelsButton = $fun->syncro_spahotel(IDSITO);
                                                                if(strlen($SpaHotelsButton)>0){
$boxPortali .= '                                                    <div class="row f-12">
                                                                        <div class="col-md-2">
                                                                            <i class="fa fa-refresh fa-2x fa-fw text-black"></i>
                                                                        </div>
                                                                        <div class="col-md-10">';
                                                                            $boxPortali .= $fun->check_syncro_spahotel(IDSITO);
                                                                            $boxPortali .= $SpaHotelsButton;
$boxPortali .= '                                                        </div>
                                                                    </div>';
                                                                }
$boxPortali .= '                                            </div>
                                                            <div class="col-md-6">';
                                                                $GabicceMareButton = $fun->syncro_gabiccemare(IDSITO);
                                                                if(strlen($GabicceMareButton)>0){
$boxPortali .= '                                                    <div class="row f-12">
                                                                        <div class="col-md-2">
                                                                            <i class="fa fa-refresh fa-2x fa-fw text-black"></i>
                                                                        </div>
                                                                        <div class="col-md-10">';
                                                                            //syncronizzo i dati dei form richieste preventivi da Info Alberghi
                                                                            $boxPortali .= $fun->check_syncro_gabiccemare(IDSITO);
                                                                            $boxPortali .= $GabicceMareButton;

$boxPortali .= '                                                        </div>
                                                                    </div>';
                                                                }

                                                                $ItalyFamilyHotelsButton = $fun->syncro_italyfamilyhotels(IDSITO);
                                                                if(strlen($ItalyFamilyHotelsButton)>0){
$boxPortali .= '                                                    <div class="row f-12">
                                                                        <div class="col-md-2">
                                                                            <i class="fa fa-refresh fa-2x fa-fw text-black"></i>
                                                                        </div>
                                                                        <div class="col-md-10">';
                                                                            //syncronizzo i dati dei form richieste preventivi da Info Alberghi
                                                                            $boxPortali .= $fun->check_syncro_italyfamilyhotels(IDSITO);
                                                                            $boxPortali .= $ItalyFamilyHotelsButton;

$boxPortali .= '                                                        </div>
                                                                    </div>';
                                                                }
$boxPortali .= '                                            </div>
                                                            <div class="col-md-6">';
                                                                $RiccioneinHotelButton = $fun->syncro_riccioneinhotel(IDSITO);
                                                                if(strlen($RiccioneinHotelButton)>0){
$boxPortali .= '                                                    <div class="row f-12">
                                                                        <div class="col-md-2">
                                                                            <i class="fa fa-refresh fa-2x fa-fw text-black"></i>
                                                                        </div>
                                                                        <div class="col-md-10">';
                                                                            //syncronizzo i dati dei form richieste preventivi da Info Alberghi
                                                                            $boxPortali .= $fun->check_syncro_riccioneinhotel(IDSITO);
                                                                            $boxPortali .= $RiccioneinHotelButton;

$boxPortali .= '                                                        </div>
                                                                    </div>';
                                                                }
                                                                $CesenaticoBellaVitaButton = $fun->syncro_cesenaticobellavita(IDSITO);
                                                                if(strlen($CesenaticoBellaVitaButton)>0){
$boxPortali .= '                                                    <div class="row f-12">
                                                                        <div class="col-md-2">
                                                                            <i class="fa fa-refresh fa-2x fa-fw text-black"></i>
                                                                        </div>
                                                                        <div class="col-md-10">';
                                                                            //syncronizzo i dati dei form richieste preventivi da Info Alberghi
                                                                            $boxPortali .= $fun->check_syncro_cesenaticobellavita(IDSITO);
                                                                            $boxPortali .= $CesenaticoBellaVitaButton;

$boxPortali .= '                                                        </div>
                                                                    </div>';
                                                                }
$boxPortali .= '                                            </div>
                                                            <div class="col-md-6">';
                                                                $FamilygoButton = $fun->syncro_familygo(IDSITO);
                                                                if(strlen($FamilygoButton)>0){
$boxPortali .= '                                                    <div class="row f-12">
                                                                        <div class="col-md-2">
                                                                            <i class="fa fa-refresh fa-2x fa-fw text-black"></i>
                                                                        </div>
                                                                        <div class="col-md-10">';
                                                                            //syncronizzo i dati dei form richieste preventivi da Info Alberghi
                                                                            $boxPortali .= $fun->check_syncro_familygo(IDSITO);
                                                                            $boxPortali .= $FamilygoButton;

$boxPortali .= '                                                        </div>
                                                                    </div>';
                                                                }

                                                                $ItalyBikeHotelsButton = $fun->syncro_italybikehotels(IDSITO);
                                                                if(strlen($ItalyBikeHotelsButton)>0){
$boxPortali .= '                                                    <div class="row f-12">
                                                                        <div class="col-md-2">
                                                                            <i class="fa fa-refresh fa-2x fa-fw text-black"></i>
                                                                        </div>
                                                                        <div class="col-md-10">';
                                                                            //syncronizzo i dati dei form richieste preventivi da Info Alberghi
                                                                            $boxPortali .= $fun->check_syncro_italybikehotels(IDSITO);
                                                                            $boxPortali .= $ItalyBikeHotelsButton;

$boxPortali .= '                                                        </div>
                                                                    </div>';
                                                                }

$boxPortali .= '                                            </div>
                                                            ';

$boxPortali .= '
                                                 </div> '."\r\n";

$boxPortali .= '            </div>
                        </div>
                    </div>'."\r\n";
 if(
    strlen($InfoAlberghiButton)>0 ||
    strlen($GabicceMareButton)>0 ||
    strlen($ItalyFamilyHotelsButton)>0 ||
    strlen($RiccioneinHotelButton)>0 ||
    strlen($CesenaticoBellaVitaButton)>0 ||
    strlen($FamilygoButton)>0 ||
    strlen($ItalyBikeHotelsButton)>0 ||
    strlen($SpaHotelsButton)>0
){
   $portali = true;
}else{
    $portali = false;
}
if($giorniRecall != '' || $portali ==true){
    $infoBox ='<button class="btn btn-primary btn-sm f-left cursore" id="closeButtonBoxInfo">
                    Chiudi box sincronizzazioni e autoresponder attivi <i class="fa fa-times" data-toggle="tooltip" title="Chiudi sincronizzazioni e autoresponder attivi"></i>
                </button>
                <button class="btn btn-primary btn-sm f-left cursore" id="openButtonBoxInfo">
                    Visualizza sincronizzazioni e autoresponder attivi <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza sincronizzazioni e autoresponder attivi"></i>
                </button>
                <div class="clearfix p-b-10"></div>
                <div class="row row-eq-height"  id="boxInfo">
                    '.$boxRecall.'
                    '.($portali ==true?$boxPortali:'').'
                </div>'."\r\n";
}
# INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
               <table id="preventivi" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='               <th></th>
                            <th>Op</th>
                            <th>Nr.</th>
                            <th>Fonte</th>
                            <th>Target</th>
                            <th><span data-toggle="tooltip" title="Data Richiesta">Data</span></th>
                            <th>Nome e Cognome</th>
                            <th>Email</th>
                            <th><span data-toggle="tooltip" title="Lingua">Lg</span></th>
                            <th>Arrivo</th>
                            <th>Partenza</th>
                            <th>A</th>
                            <th>B</th>
                            <th><span data-toggle="tooltip" title="Data e metodo d\'invio">Invio</span></th>
                            <th>Aperto</th>
                            <th>Chat</th>
                            <th><span data-toggle="tooltip" title="Data Scadenza">Scadenza</span></th>
                            <th style="width:4%"></th>
                            <th>Azioni</th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .= '<div class="dataTables_info" id="preventivi_info_serverSide" role="status" aria-live="polite">Visualizza pagina '.($_GET['pag']==''?1:$_GET['pag']).' di '.$tot_pagine.' per '.$tot_righe.' righe</div>'."\r\n";
$content .= $link_paginazione.''."\r\n";
$content .='<style>
                '.(!$_REQUEST['action'] && $NumeroRecord > NUMERO_RECORD?'
                .pagination{
                    position:absolute!important;
                    right:20px!important;
                }
                #preventivi_info{
                    display: none !important;
                }
                .buttons-page-length {
                    display: none !important;
                }
                ':'
                #preventivi_info_serverSide{
                    display: none !important;
                }
                ').'
            </style>'."\r\n";
# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>
            //FUNZIONI UTILI A POPOLARE IL TABELLARE RIGA PER RIGA IN AJAX
                function get_operatore(Operatore, idsito, id){

                    $("#get_operatore_pre"+id+"").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:40px;height:10px" />\');
                    $("#get_operatore"+id+"").load("'.BASE_URL_SITO.'ajax/preventivi/get_operatore.php?idsito="+idsito+"&id="+id+"&Operatore="+Operatore+"", function() {
                        $("#get_operatore_pre"+id+"").hide();
                    });
                }
                function check_proposta(NumeroPrenotazione,idsito){
                    $("#check_proposta_pre"+NumeroPrenotazione+"").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:40px;height:10px" />\');
                    $("#check_proposta"+NumeroPrenotazione+"").load("'.BASE_URL_SITO.'ajax/preventivi/check_proposta.php?idsito="+idsito+"&NumeroPrenotazione="+NumeroPrenotazione+"", function() {
                        $("#check_proposta_pre"+NumeroPrenotazione+"").hide();
                    });
                }
                function conta_click(id, idsito, data_invio, data_scadenza){

                    $("#conta_click_pre"+id+"").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:40px;height:10px" />\');
                    $("#conta_click"+id+"").load("'.BASE_URL_SITO.'ajax/preventivi/conta_click.php?idsito="+idsito+"&id="+id+"&data_invio="+data_invio+"&data_scadenza="+data_scadenza+"", function() {
                        $("#conta_click_pre"+id+"").hide();
                    });
                }
                function utenti_online(idsito, IdRichiesta){

                    $("#utenti_online_pre"+IdRichiesta+"").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:40px;height:10px" />\');
                    $("#utenti_online"+IdRichiesta+"").load("'.BASE_URL_SITO.'ajax/preventivi/utenti_online.php?idsito="+idsito+"&IdRichiesta="+IdRichiesta+"", function() {
                        $("#utenti_online_pre"+IdRichiesta+"").hide();
                    });
                }
                function re_email_call(id,idsito){

                    $("#re_email_call_pre"+id+"").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:40px;height:10px" />\');
                    $("#re_email_call"+id+"").load("'.BASE_URL_SITO.'ajax/preventivi/re_email_call.php?idsito="+idsito+"&id="+id+"", function() {
                        $("#re_email_call_pre"+id+"").hide();
                    });
                }
                function func_chat_column(NumeroPrenotazione, DataInvio, DataScadenza, DataChiuso, DataArrivo, idsito, id, provenienza){

                    $("#func_chat_column_pre"+id+"").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:40px;height:10px" />\');
                    $("#func_chat_column"+id+"").load("'.BASE_URL_SITO.'ajax/preventivi/func_chat_column.php?idsito="+idsito+"&id="+id+"&NumeroPrenotazione="+NumeroPrenotazione+"&DataInvio="+DataInvio+"&DataScadenza="+DataScadenza+"&DataChiuso="+DataChiuso+"&DataArrivo="+DataArrivo+"&provenienza="+provenienza+"", function() {
                        $("#func_chat_column_pre"+id+"").hide();
                    });
                }
                function gia_presente(id, idsito, Nome, Cognome, Email){

                    $("#gia_presente_pre"+id+"").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:30px;height:6px" />\');
                    $("#gia_presente"+id+"").load("'.BASE_URL_SITO.'ajax/preventivi/gia_presente.php?idsito="+idsito+"&Nome="+Nome+"&Cognome="+Cognome+"&Email="+Email+"", function() {
                        $("#gia_presente_pre"+id+"").hide();
                    });
                }
            //FINE
            //FUNZIONE CHE POPOLA CONTENUTI INPUT PER LA MODIFICA
            function get_content_update(id){

                   $.ajax({
                        type: "POST",
                        url: "'.BASE_URL_SITO.'crud/proposte/preventivi.update.crud.php",
                        data: "id="+id+"'.($_GET['pag']!=''?'&pag='.$_GET['pag']:'').'",
                        dataType: "html",
                            success: function(data){
                                $("#load_db_date").html(data);
                            },
                            error: function(){
                                alert("Chiamata fallita, si prega di riprovare...");
                            }
                    });

            }
            $(document).ready(function() {'."\r\n";



$content .='   //EQUALIZZO BOX DETTAGLI
                var highestBox = 400;
                var heigthRow = $("#boxInfo").height();
                var new_height = (heigthRow - 20);
                $(".row-eq-height").each(function() {
                    var heights = $(this).find(".col-eq-height").map(function() {
                    return $(this).outerHeight();
                        }).get(), maxHeight = Math.max.apply(null, heights);
                        $(this).find(".col-eq-height").outerHeight(maxHeight);
                });

                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();


                // CONFIG DATATABLE
                var table = $("#preventivi").DataTable( {
                    order: [[2, \'desc\'],[5, \'desc\']], 
                    responsive: true,
                    processing:true,
                    oLanguage: {sProcessing: "<div class=\'cell preloader5 loader-block\'><div class=\'circle-5 l loader-warning\'></div><div class=\'circle-5 m loader-warning\'></div><div class=\'circle-5 r loader-warning\'></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>QUOTO! sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
                    "paging": '.(!$_REQUEST['action']?($NumeroRecord > NUMERO_RECORD?'false':'true'):'true').',
						"pagingType": "simple_numbers",
						"language": {
							 "search": "Filtro rapido:",
							 "info": "Visualizza pagina _PAGE_ di _PAGES_ per _TOTAL_ righe",
                             "emptyTable": " ",
							 "paginate": {
								 "previous": "Precedente",
								 "next":"Successivo",
							 },
							 buttons: {
								pageLength: {
									_: "Mostra %d record",
                                    \'-1\': "Mostra tutto"
								}
							}
						},
                        dom: \'Bfrtip\',
						lengthMenu: [
							[ 30, 40, 60, 100, -1 ],
							[ \'30 record\', \'40 record\', \'60 record\', \'100 record\', \'Tutti\' ]
                        ],
                        buttons: [
                        {
                            text:      \'<i class="fa fa-square-o fa-2x fa-fw"></i> seleziona\',
                            titleAttr: \'Seleziona tutti\',
                            className: \'buttonSelect\',
                            attr: {id: \'buttSelect\'},
                            action: function () {
                                $(".seleziona").prop("checked", true);

                            }
                        },
                        {
                            text:      \'<i class="fa fa-check-square-o fa-2x fa-fw"></i> deseleziona\',
                            titleAttr: \'Togli selezione a tutti\',
                            className: \'buttonUnSelect\',
                            attr: {id: \'buttUnSelect\'},
                            action: function () {
                                $(".seleziona").prop("checked", false);
                            }
                        },
                        {
                            text:      \'<i class="fa fa-2x fa-fw '.($_REQUEST['chat']=='last_contact'?'fa-comments-o text-red':'fa-comments text-black').'"></i> '.($_REQUEST['chat']=='last_contact'?'Reset Ultime Chat':'Ultime Chat').'\',
                            titleAttr: \'Ultime Chat\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'check_last_chat\'},
                            action: function () {
                                '.($_REQUEST['chat']=='last_contact'?'document.location=\''.BASE_URL_SITO.'preventivi/\';':'$("#form_last_contact").submit();').'
                            }
                        },

                        {
                            text:      \'<i class="fa fa-inbox fa-2x fa-fw"></i> Archivia\',
                            titleAttr: \'Archivia preventivi selezionati\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'archivia_all\'},
                            action: function () {

                                    var checkbox_value = "";
                                    $("input[name=Id]").each(function () {
                                        var ischecked = $(this).is(":checked");
                                        if (ischecked) {
                                            checkbox_value += $(this).val() + ",";
                                        }
                                    });
                                    if(checkbox_value){
                                        if (window.confirm("ATTENZIONE: Sicuro di voler archiviare i preventivi selezionati?")){
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/archivia_all.php",
                                                type: "POST",
                                                data: "idsito='.IDSITO.'&checkbox_value="+checkbox_value,
                                                dataType: "html",
                                                success: function(result) {
                                                            _alert("<i class=\"fa fa-inbox \"></i> Esito:","Preventivo/i sono stati archiviati!");
                                                            location.reload();
                                                }
                                            });
                                            return false; // con false senza refresh della pagina
                                        }
                                    }else{
                                        _alert("<i class=\"fa fa-inbox \"></i> Attenzione:","Selezionare prima di cliccare il pulsante!");
                                    }

                            }
                        },
                        {
                            text:      \'<i class="fa fa-user fa-2x fa-fw"></i> Assegna operatore\',
                            titleAttr: \'Assegna Operatore ai selezionati\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'assegna_ol_op\'},
                            action: function () {
                                $("#ModaleOperatori").modal("show");
                            }
                        },
                         {
                            text:      \'<i class="fa fa-trash fa-2x fa-fw"></i> Cestina \',
                            titleAttr: \'Cestina preventivi selezionati\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'delete_all\'},
                            action: function () {
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
                                                url: "'.BASE_URL_SITO.'ajax/generici/delete_all.php",
                                                type: "POST",
                                                data: "idsito='.IDSITO.'&cestino=1&checkbox_value="+checkbox_value,
                                                dataType: "html",
                                                success: function(data) {
                                                            _alert("<i class=\"fa fa-trash \"></i> Esito:","Preventivo/i sono stati cestinati!");
                                                            location.reload();
                                                    }
                                            });
                                            return false; // con false senza refresh della pagina
                                        }

                                    }else{
                                        _alert("<i class=\"fa fa-trash \"></i> Attenzione:","Selezionare prima di cliccare il pulsante!");
                                    }
                            }
                        },
                        {

                            text:      \'<i class="fa fa-search fa-2x fa-fw"></i> Ricerca avanzata\',
                            titleAttr: \'Ricerca Avanzata\',
                            className: \'buttonSearch\',
                            attr: {id: \'buttonSearch\'},
                            action: function ( e, dt, node, config ) {
                                $("#myModalASearch").modal("show");
                            }
                        },
                    \'pageLength\',
                    /* {
                            extend: \'collection\',
                            className: \'buttonExport\',
                            text: \'Esporta\',
                            buttons: [
                                { extend: \'excel\', text: \'Excel\' },
                                { extend: \'copy\', text: \'Copia\' },
                                { extend: \'print\', text: \'Stampa\' },

                            ]
                        },
                       { extend: \'colvis\', text: \'Colonne visibili\' }*/
                    ],
                    "ajax": "'.BASE_URL_SITO.'crud/proposte/preventivi.crud.php?idsito='.IDSITO.''.$variabili.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "id","class":"text-center"},
                        { "data": "op","class":"text-center"},
                        { "data": "nr","class":"text-center"},
                        { "data": "fonte"},
                        { "data": "tipo"},
                        { "data": "data","type":"date","class":"text-center nowrap"},
                        { "data": "cliente","class":"nowrap"},
                        { "data": "email","class":"text-center"},
                        { "data": "lingua","class":"text-center"},
                        { "data": "arrivo","type":"date","class":"text-center nowrap"},
                        { "data": "partenza","type":"date","class":"text-center nowrap"},
                        { "data": "a","class":"text-center"},
                        { "data": "b","class":"text-center"},
                        { "data": "invio","class":"text-center"},
                        { "data": "aperto","class":"text-center"},
                        { "data": "chat","class":"text-center"},
                        { "data": "scadenza","class":"text-center nowrap"},
                        { "data": "recall","class":"text-center nowrap"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                            {"targets": [0,1,7,8,11,12,14,15,17,18], "orderable": false}

                        ]
                    })


                    // ORDINAMENTO TABELLA
                   // table.order( [ 2, \'DESC\' ],[ 5, \'DESC\' ] ).draw();

                    $("#preventivi_processing").removeClass("card");

                    $(\'#preventivi tbody\').on( \'click\', \'td:last-child\', function () {

                        $(\'#preventivi tbody\').find("i").removeClass("colorArrow");
                        $(\'#preventivi tbody\').find("td").removeClass("selected");
                        $(\'#preventivi tbody\').find("a[title=\"Timeline\"]").removeClass("linkNumP");

                        if ($(this).hasClass(\'selected\') ) {

                            $(this).removeClass(\'selected\');
                            $(this).parent().find("td").removeClass(\'selected\');
                            $(this).parent().find("a[title=\"Timeline\"]").removeClass("linkNumP");
                            $(this).find("i").removeClass("colorArrow");
                            $("#infobox").hide(300);
                            $("#closeButtonInfoBox").hide(300);

                        }else{

                            table.$(\'td:last-child.selected\').removeClass(\'selected\');
                            $(this).parent().find("td").addClass(\'selected\');
                            $(this).find("i").addClass("colorArrow");
                            $(this).parent().find("a[title=\"Timeline\"]").addClass("linkNumP");
                            $("#infobox").show(300);
                            $("#closeButtonInfoBox").show(300);
                            if($("#boxInfo").is(":visible")){
                                $("html, body").animate({
                                    scrollTop: 350
                                }, 200);
                            }else{
                                $("html, body").animate({
                                    scrollTop: 0
                                }, 200);

                            }
                        }
                    });

                    '."\r\n";


$content .='
                        if($("input[class=\'seleziona\']").prop(\'checked\')==true) {
                            $("button[class=\'dt-button buttonUnSelect\']").show();
                            $("button[class=\'dt-button buttonSelect\']").hide();
                        }else{
                            $("button[class=\'dt-button buttonUnSelect\']").hide();
                            $("button[class=\'dt-button buttonSelect\']").show();
                        }

                        $("button[class=\'dt-button buttonSelect\']").on("click",function(){
                            $("button[class=\'dt-button buttonUnSelect\']").show();
                            $("button[class=\'dt-button buttonSelect\']").hide();
                        });
                        $("button[class=\'dt-button buttonUnSelect\']").on("click",function(){
                            $("button[class=\'dt-button buttonUnSelect\']").hide();
                            $("button[class=\'dt-button buttonSelect\']").show();
                        });'."\r\n";


$content .='        $("#boxInfo").hide();
                    $("#openButtonBoxInfo").show();
                    $("#closeButtonBoxInfo").hide();
                    $("#closeButtonBoxInfo").on("click",function(){
                            $("#closeButtonBoxInfo").hide();
                            $("#openButtonBoxInfo").show();
                            $("#boxInfo").hide(300);
                    });
                     $("#openButtonBoxInfo").on("click",function(){
                            $("#openButtonBoxInfo").hide();
                            $("#closeButtonBoxInfo").show();
                            $("#boxInfo").show(300);
                    });

                    '.(!$_REQUEST['action']?($NumeroRecord > NUMERO_RECORD?'$("#preventivi_wrapper").prepend(\'<div class="dataTables_filter f-11" style="position:absolute;right:20px;top:10px">Filtro rapido disattivato finchè<br> non verranno archiviati preventivi,<br>o riducendo i record a meno di '.NUMERO_RECORD.'</div>\');$("#preventivi_filter").hide();':'$(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");'):'').'
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";



$content .='})
        </script>
        <div id="modale_upselling"></div>';

if($fun->check_configurazioni(IDSITO,'check_notifiche_push')==1){
    $content .= $fun->notifica_mancata_click(IDSITO,'Preventivo');
    $content .='<script>$( document ).ready(function() {if(ContatorePreventivi > 0){open_notifica("Ciao <b>" + NomeHotel + "</b> ricordati che hai ancora <b class=\"text16\">" + ContatorePreventivi + "</b> preventivi da inviare"," ","plain","bottom-right","error",5000,"#000000");}});</script>'."\r\n";
}

$lista_op = $fun->lista_operatori(IDSITO);
foreach($lista_op as $k => $v){
    $opList .='<option value="'.$v['Id'].'">'.$v['NomeOperatore'].'</option>';
}

$content .=' <div class="modal fade" id="ModaleOperatori" tabindex="-1" role="dialog" aria-labelledby="ModaleOperatoriLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Seleziona Operatore da associare</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                                <form method="POST" id="form_ass_op" name="form_ass_op">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="AssOperatore" class="control-label">Operatore</label>
                                                <select name="AssOperatore" id="AssOperatore" class="form-control" required="">
                                                    <option value="">--</option>
                                                    '.$opList.'
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Associa</button>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                                <script>
                                    $(document).ready(function() {
                                        $("#form_ass_op").submit(function () {
                                            var checkbox_op = "";
                                            $("input[name=Id]").each(function () {
                                                var ischecked = $(this).is(":checked");
                                                if (ischecked) {
                                                    checkbox_op += $(this).val() + ",";
                                                }
                                            });
                                            var operatore = $("#AssOperatore").val();
                                            if(checkbox_op){
                                                if (window.confirm("ATTENZIONE: Sicuro di voler associare l\'operatore scelto, ai preventivi selezionati?")){
                                                    $.ajax({
                                                        url: "'.BASE_URL_SITO.'ajax/preventivi/associa_operatore.php",
                                                        type: "POST",
                                                        data: "idsito='.IDSITO.'&checkbox_op="+checkbox_op+"&operatore="+operatore+"",
                                                        dataType: "html",
                                                        success: function(data) {
                                                            location.reload();
                                                        }
                                                    });
                                                    return false; // con false senza refresh della pagina
                                                }

                                            }else{
                                                    location.reload();
                                            }
                                        });
                                    });
                                </script>

                            <div id="risultato_op"></div>
                            <div id="risultato_ko_op"></div>
                        </div>
                    </div>
                </div>
            </div>'."\r\n";

/** CODICE PER FILTRO ULTIME CHAT */
$content .= '   <form name="form_last_contact" id="form_last_contact" method="POST" action="'.$_SERVER['REQUEST_URI'].'">
                    <input type="hidden" name="idsito" value="'.IDSITO.'">
                    <input type="hidden" name="chat" value="last_contact">
                </form>'."\r\n";

/** CODICE PER FAR RIAPRIRE IL BOX DI DETTAGLIO DELLO STESSO PREVENTIVO MODIFICATO */
if($_REQUEST['id_preventivo']){
    $content .= '   <script>
                        $(document).ready(function(){
                            get_content_update('.$_REQUEST['id_preventivo'].');
                            setTimeout(function() {
                                $("#row_'.$_REQUEST['id_preventivo'].'").find("td").addClass(\'selected\');
                            }, 2000);
                        });
                    </script>'."\r\n";
}
?>
