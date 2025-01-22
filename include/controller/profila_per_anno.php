<?
$NumeroRecord = $fun->countRowsProfila($_REQUEST['azione'],IDSITO);
if($NumeroRecord > NUMERO_RECORD){ 

            // ----------------------------------------------------------------
            //    C A L C O L O   D E L   N U M E R O   D I   P A G I N E
            $righe_per_pagina = RIGHE_PER_PAGINA;
            $url_base = BASE_URL_SITO."profila_per_anno/".$_REQUEST['azione']."/";
            $pagine_vicine = PAGINE_VICINE;
            // ricavo il numero totale di record
            $postdata = new ArrayObject($_POST,ArrayObject::ARRAY_AS_PROPS);
            $tot_righe = $fun->numeroRecordProfila(IDSITO,$postdata,$_REQUEST['azione']);
            //$tot_righe = $fun->numeroRecord('hospitality_guest',IDSITO,'','',$_REQUEST['azione']);
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

$variabili .= '&action='.$_REQUEST['action'].'';
$variabili .= '&anno='.$_REQUEST['azione'].'';
$variabili .= '&TipoSoggiorno='.$_REQUEST['TipoSoggiorno'].'';
$variabili .= '&TipoCamere='.$_REQUEST['TipoCamere'].'';
$variabili .= '&NumeroPrenotazione='.$_REQUEST['NumeroPrenotazione'].'';
$variabili .= '&TipoRichiesta='.$_REQUEST['TipoRichiesta'].'';
$variabili .= '&FontePrenotazione='.$_REQUEST['FontePrenotazione'].'';
$variabili .= '&TipoVacanza='.$_REQUEST['TipoVacanza'].'';
$variabili .= '&Nome='.$_REQUEST['Nome'].'';
$variabili .= '&Cognome='.$_REQUEST['Cognome'].'';
$variabili .= '&Email='.$_REQUEST['Email'].'';
$variabili .= '&NoDisponibilita='.$_REQUEST['NoDisponibilita'].'';
$variabili .= '&DataScadenza='.$_REQUEST['DataScadenza'].'';
$variabili .= '&DataArrivo='.$_REQUEST['DataArrivo'].'';
$variabili .= '&DataPartenza='.$_REQUEST['DataPartenza'].'';
$variabili .= '&DataRichiesta_dal='.$_REQUEST['DataRichiesta_dal'].'';
$variabili .= '&DataRichiesta_al='.$_REQUEST['DataRichiesta_al'].'';
$variabili .= '&Lingua='.$_REQUEST['Lingua'].'';
$variabili .= '&Chiuso='.$_REQUEST['Chiuso'].'';
$variabili .= '&Disdetta='.$_REQUEST['Disdetta'].'';
$variabili .= '&IdMotivazione='.$_REQUEST['IdMotivazione'].'';
$variabili .= '&CS_inviato='.$_REQUEST['CS_inviato'].'';
$variabili .= '&CheckConsensoPrivacy='.$_REQUEST['CheckConsensoPrivacy'].'';
$variabili .= '&CheckConsensoMarketing='.$_REQUEST['CheckConsensoMarketing'].'';
$variabili .= '&Archivia='.$_REQUEST['Archivia'].'';
$variabili .= '&Hidden='.$_REQUEST['Hidden'].'';
$variabili .= '&DataPrenotazione_dal='.$_REQUEST['DataPrenotazione_dal'].'';
$variabili .= '&DataPrenotazione_al='.$_REQUEST['DataPrenotazione_al'].'';
$variabili .= '&Arrivo_dal='.$_REQUEST['Arrivo_dal'].'';
$variabili .= '&Arrivo_al='.$_REQUEST['Arrivo_al'].'';
$variabili .= '&campagna='.$_REQUEST['campagna'].'';

$checkNumberPrev = $fun->checkNumberRows(IDSITO);
if($checkNumberPrev == 1){                                                 
    $infobox = '        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-primary">INFO SETTING</h5>                                                                                        
                                </div>
                                <div class="card-block">
                                    <div class="row f-11">
                                        <div class="col-md-1"><i class="fa fa-check fa-2x fa-fw text-black"></i></div>
                                        <div class="col-md-11">
                                            E\' stata limitata: la visualizzazione di tutti i record presenti del vostro DataBase perchè la lista supera il migliaio di righe!<br>
                                            Selezionando questa opzione saranno visibili i record con data dell\'anno in corso più i successivi sei mesi dell\'anno scorso.<br>
                                            Se si desidera azzerare l\'opzione, portarsi alla voce di menù configurazioni ->  Impostazioni -> Limita record, per re-settare il Check!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                             '."\r\n";    
} 
# INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
               <table id="profila" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-11"  style="width:100%">
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
                            <th data-togggle="tooltip" title="Questionario Customer Satisfaction">Questionario</th>
                            <th data-togggle="tooltip" title="Disdetta">Disdetta</th>
                            <th data-togggle="tooltip" title="Annullata">Annullata</th>
                            <th data-togggle="tooltip" title="Archiviata">Archiviata</th>
                            <th data-togggle="tooltip" title="Cestinata">Cestinata</th>
                            <th>Proposta</th>
                            <th style="width:15%">Consensi</th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .= '<div class="dataTables_info" id="profila_info_serverSide" role="status" aria-live="polite">Visualizza pagina '.($_GET['pag']==''?1:$_GET['pag']).' di '.$tot_pagine.' per '.$tot_righe.' righe</div>'."\r\n";
$content .= $link_paginazione.''."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                '.($NumeroRecord > NUMERO_RECORD?'
                .pagination{
                    position:absolute!important;
                    right:20px!important;
                }
                #profila_info{
                    display: none !important;
                } 
                .buttons-page-length {
                    display: none !important;
                }
                ':'
                #profila_info_serverSide{
                    display: none !important;
                }

                ').'                
            </style>'."\r\n";
# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>

            $(document).ready(function() {

            //EQUALIZZO BOX DETTAGLI
                var highestBox = 400;
                var heigthRow = $("#infobox").height();
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
                var table = $("#profila").DataTable( {
                                                               
                    responsive: true,
                    processing:true,
                    oLanguage: {sProcessing: " <div class=\'cell preloader5 loader-block\'><div class=\'circle-5 l loader-warning\'></div><div class=\'circle-5 m loader-warning\'></div><div class=\'circle-5 r loader-warning\'></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>QUOTO! sta caricando i dati...<span class=\'\'>Attendere!!</span></span>"},
                    "paging": '.($NumeroRecord > NUMERO_RECORD?'false':'true').',
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
							[ 50, 100, 200, 400, 800, -1 ],
							[  \'50 record\', \'100 record\', \'200 risultati\', \'400 risultati\', \'800 risultati\', \'Tutti\' ]
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
                        text: \'Esporta EXCEL\',
                        buttons: [
                              {
                                extend: \'excel\',
                                text: \'Excel\',
                                exportOptions: {
                                    columns: \':not(.notexport)\'
                                },
                            },
                        ]
                    }, 
                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/proposte/profila_anno.crud.php?idsito='.IDSITO.''.$variabili.'",
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
                        { "data": "questionario","class":"text-center"},
                        { "data": "disdetta","class":"text-center"},
                        { "data": "annullata","class":"text-center"}, 
                        { "data": "archiviata","class":"text-center"},
                        { "data": "cestinata","class":"text-center"}, 
                        { "data": "riepilogo","class":"text-center"}, 
                        { "data": "consensi","class":"nowrap"}
                    ],';
        $content .='    "columnDefs": [
                             {"targets": [1,4,14,15], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 0, \'DESC\' ] ).draw();
                    $("#profila_processing").removeClass("card"); 

                 '.(!$_REQUEST['action']?($NumeroRecord > NUMERO_RECORD?
                    '$("#profila_wrapper").prepend(\'<div class="dataTables_filter f-11" style="position:absolute;right:20px;top:80px">Filtro rapido disattivato finchè<br> non si riducono i record a meno di '.NUMERO_RECORD.'</div>\');
                    $("#profila_filter").hide();
                    $(".buttonSearch").after("<button class=\"dt-button buttons-collection buttonExportFull\" onclick=\"document.getElementById(\'form_export\').submit();\" id=\"pulsante_esporta\" data-toggle=\"tooltip\" title=\"Questo Export scarica il totale dei record per l\'anno scelto in CSV!\"><i class=\"fa fa-file-archive-o fa-2x fa-fw\"></i> Esporta CSV</button>");'
                    :'$(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>"); $(".buttons-page-length").after("<button class=\"dt-button buttons-collection buttonExportFull\" onclick=\"document.getElementById(\'form_export\').submit();\" id=\"pulsante_esporta\" data-toggle=\"tooltip\" title=\"Questo Export scarica il totale dei record per l\'anno scelto in CSV!\"><i class=\"fa fa-file-archive-o fa-2x fa-fw\"></i> Esporta CSV</button>");'):'').'
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\" data-toggle=\"tooltip\" title=\"Questo Export scarica i record per pagina in EXCEL!\"></i>").attr(\'data-toggle\',\'tooltip\').attr(\'title\',\'Questo Export scarica i record per pagina in EXCEL!\');'."\r\n";


$content .='})
            </script>';     
$bt_export .='<form method="POST" id="form_export" name="form_export" action="'.BASE_URL_SITO.'include/controller/export_clienti_quoto.php">
                    <input type="hidden" name="action" value="export">
                    <input type="hidden" name="idsito" value="'.IDSITO.'">
                    <input type="hidden" name="Lingua" value="'.$_REQUEST['Lingua'].'">
                    <input type="hidden" name="TipoRichiesta" value="'.$_REQUEST['TipoRichiesta'].'">
                    <input type="hidden" name="FontePrenotazione" value="'.$_REQUEST['FontePrenotazione'].'">
                    <input type="hidden" name="TipoVacanza" value="'.$_REQUEST['TipoVacanza'].'">
                    <input type="hidden" name="Nome" value="'.$_REQUEST['Nome'].'">
                    <input type="hidden" name="Cognome" value="'.$_REQUEST['Cognome'].'">
                    <input type="hidden" name="DataArrivo" value="'.$_REQUEST['DataArrivo'].'">
                    <input type="hidden" name="DataPartenza" value="'.$_REQUEST['DataPartenza'].'">
                    <input type="hidden" name="DataPrenotazione_dal" value="'.$_REQUEST['DataPrenotazione_dal'].'">
                    <input type="hidden" name="DataPrenotazione_al" value="'.$_REQUEST['DataPrenotazione_al'].'">
                    <input type="hidden" name="DataRichiesta_dal" value="'.$_REQUEST['DataRichiesta_dal'].'">
                    <input type="hidden" name="DataRichiesta_al" value="'.$_REQUEST['DataRichiesta_al'].'">
                    <input type="hidden" name="Arrivo_dal" value="'.$_REQUEST['Arrivo_dal'].'">
                    <input type="hidden" name="Arrivo_al" value="'.$_REQUEST['Arrivo_al'].'">
                    <input type="hidden" name="CS_inviato" value="'.$_REQUEST['CS_inviato'].'">
                    <input type="hidden" name="Chiuso" value="'.$_REQUEST['Chiuso'].'">
                    <input type="hidden" name="Disdetta" value="'.$_REQUEST['Disdetta'].'">
                    <input type="hidden" name="CheckConsensoPrivacy" value="'.$_REQUEST['CheckConsensoPrivacy'].'">
                    <input type="hidden" name="CheckConsensoMarketing" value="'.$_REQUEST['CheckConsensoMarketing'].'">
                    <input type="hidden" name="TipoCamere" value="'.$_REQUEST['TipoCamere'].'">
                    <input type="hidden" name="TipoSoggiorno" value="'.$_REQUEST['TipoSoggiorno'].'">
                    <input type="hidden" name="IdMotivazione" value="'.$_REQUEST['IdMotivazione'].'">
                    <input type="hidden" name="NoDisponibilita" value="'.$_REQUEST['NoDisponibilita'].'">  
                    <input type="hidden" name="anno" value="'.$_REQUEST['azione'].'">               
            </form>'."\r\n";

?>