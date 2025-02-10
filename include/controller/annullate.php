<?
$NumeroRecord = $fun->countRowsAnnullate(IDSITO);
if(!$_REQUEST['action'] && $NumeroRecord > NUMERO_RECORD){

            // ----------------------------------------------------------------
            //    C A L C O L O   D E L   N U M E R O   D I   P A G I N E
            $righe_per_pagina = RIGHE_PER_PAGINA;
            $url_base = BASE_URL_SITO."annullate/";
            $pagine_vicine = PAGINE_VICINE;
            // ricavo il numero totale di record
            $tot_righe = $fun->countRowsAnnullate(IDSITO);
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
# VARIABILI
$variabili .= '&action='.$_REQUEST['action'].'';
$variabili .= '&Motivo='.$_REQUEST['Motivo'].'';
$variabili .= '&TipoRichiesta='.$_REQUEST['TipoRichiesta'].'';
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

# INTERFACCIA LEGENDA
$button ='<div style="float:right">
                <button class="btn btn-primary btn-sm" id="closeButtonBoxInfo">
                    Chiudi legenda <i class="fa fa-times" data-toggle="tooltip" title="Chiudi legenda"></i>
                </button>
                <button class="btn btn-primary btn-sm" id="openButtonBoxInfo">
                    Visualizza legenda <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza legenda"></i>
                </button>
            </div>
            <div class="clearfix p-b-10"></div>
            <div class="alert alert-info text-black" id="legenda"  style="display:none">
                <ul>
                     <li>La possibilità di inviare un\'e-mail al cliente per un ritorno di disponibilità camere è abilitata alla motivazione annullata per: <b>"Assenza Disponibilità"</b> o <b>"Non Disponibile"</b> !</li>
                     <li><b>Pulsante per l\'interfaccia d\'invio e-mail:</b> <testo class="p-l-20 testoLegenda"><i class="fa fa-send text-orange"></i> Invia Email per ritorno della Disponibilità</testo></li>
                     <li><b>Ad invio effettuato, questa la dicitura:</b> <testo class="p-l-20 testoLegenda">Il cliente è stato ricontattato in data gg-mm-aaaa h:i:s</testo></li>
                </ul>
            </div>
            <script>
                $(document).ready(function(){
                    $("#closeButtonBoxInfo").hide();
                    $("#closeButtonBoxInfo").on("click",function(){
                            $("#closeButtonBoxInfo").hide();
                            $("#openButtonBoxInfo").show();
                            $("#legenda").hide(300);
                    });
                    $("#openButtonBoxInfo").on("click",function(){
                            $("#openButtonBoxInfo").hide();
                            $("#closeButtonBoxInfo").show();
                            $("#legenda").show(300);
                    });
                })
            </script>
        <div class="clearfix p-b-10"></div>'."\r\n";

# INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
               <table id="annullate" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='                <th>Nr.</th>
                            <th>Richiesta</th>
                            <th>Fonte</th>
                            <th>Target</th>
                            <th>Nome e Cognome</th>
                            <th>Email</th>
                            <th class="notexport">Lg</th>
                            <th>Arrivo</th>
                            <th>Partenza</th>
                            <th>Proposta</th>
                            <th>Invio</th>
                            <th class="nowrap f-12 notexport">Apertura Richiesta</th>
                            <th class="notexport"></th>
                            <th class="notexport">Motivazione</th>
                            <th class="notexport"></th>
                        </tr>
                    </thead>

                </table> '."\r\n";

$content .= '<div class="dataTables_info" id="annullate_info_serverSide" role="status" aria-live="polite">Visualizza pagina '.($_GET['pag']==''?1:$_GET['pag']).' di '.$tot_pagine.' per '.$tot_righe.' righe</div>'."\r\n";
$content .= $link_paginazione.''."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                '.(!$_REQUEST['action'] && $NumeroRecord > NUMERO_RECORD?'
                .pagination{
                    position:absolute!important;
                    right:20px!important;
                }
                #annullate_info{
                    display: none !important;
                }
                .buttons-page-length {
                    display: none !important;
                }
                ':'
                #annullate_info_serverSide{
                    display: none !important;
                }
                ').'
            </style>'."\r\n";
# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>
            function conta_click(id, idsito, data_invio, data_scadenza){

                $("#conta_click_pre"+id+"").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:40px;height:10px" />\');
                $("#conta_click"+id+"").load("'.BASE_URL_SITO.'ajax/preventivi/conta_click.php?idsito="+idsito+"&id="+id+"&data_invio="+data_invio+"&data_scadenza="+data_scadenza+"", function() {
                    $("#conta_click_pre"+id+"").hide();
                });
            }
            function motivazione_conferme_annullate(id, idsito){

                $("#motivazione_conferme_annullate_pre"+id+"").html(\'<img src="'.BASE_URL_SITO.'img/loader_performance.gif" style="width:40px;height:10px" />\');
                $("#motivazione_conferme_annullate"+id+"").load("'.BASE_URL_SITO.'ajax/conferme/motivazione_conferme_annullate.php?idsito="+idsito+"&id="+id+"", function() {
                    $("#motivazione_conferme_annullate_pre"+id+"").hide();
                });
            }
            $(document).ready(function() {


                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();


                // CONFIG DATATABLE
                var table = $("#annullate").DataTable( {
                    order: [[0, \'desc\']],
                    responsive: true,
                    processing:true,
                    oLanguage: {sProcessing: " <div class=\'cell preloader5 loader-block\'><div class=\'circle-5 l loader-warning\'></div><div class=\'circle-5 m loader-warning\'></div><div class=\'circle-5 r loader-warning\'></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>QUOTO! sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
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
							[ 10, 50, 100, 200, 400, -1 ],
							[  \'10 record\', \'50 record\', \'100 risultati\', \'200 risultati\', \'400 risultati\', \'Tutti\' ]
                        ],
                        buttons: [
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

                        {
                            extend: \'collection\',
                            className: \'buttonExport\',
                            text: \'Esporta\',
                            buttons: [
                                {
                                    extend: \'excel\',
                                    text: \'Excel\',
                                    exportOptions: {
                                        columns: \':not(.notexport)\'
                                    },
                                },
                                {
                                    extend: \'print\',
                                    text: \'Stampa\',
                                    exportOptions: {
                                        columns: \':not(.notexport)\'
                                    },
                                }
                            ]
                        },
                    ],
                    "ajax": "'.BASE_URL_SITO.'crud/proposte/annullate.crud.php?idsito='.IDSITO.''.$variabili.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "nr","class":"text-center"},
                        { "data": "richiesta"},
                        { "data": "fonte"},
                        { "data": "tipo"},
                        { "data": "cliente","class":"nowrap"},
                        { "data": "email","class":"nowrap"},
                        { "data": "lingua","class":"text-center"},
                        { "data": "arrivo","type":"date","class":"text-center nowrap"},
                        { "data": "partenza","type":"date","class":"text-center nowrap"},
                        { "data": "riepilogo","class":"text-center"},
                        { "data": "invio","class":"text-center"},
                        { "data": "aperto","class":"text-center"},
                        { "data": "check","class":"text-center"},
                        { "data": "motivo"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [1,5,6,9,10,11,12,13,14], "orderable": false}

                        ]
                    })


                    // ORDINAMENTO TABELLA

                    $("#annullate_processing").removeClass("card");

                    '.(!$_REQUEST['action']?($NumeroRecord > NUMERO_RECORD?'$("#annullate_wrapper").prepend(\'<div class="dataTables_filter f-11" style="position:absolute;right:20px;top:100px">Filtro rapido disattivato finchè<br> non si riducono i record a meno di '.NUMERO_RECORD.'</div>\');$("#annullate_filter").hide();':'$(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");'):'$(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");').'
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
            </script>';


?>
