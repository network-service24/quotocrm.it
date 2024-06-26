<?
$NumeroRecordArchivio = $fun->countRowsArchivio($_REQUEST['azione'],IDSITO);
if($NumeroRecordArchivio > NUMERO_RECORD){ 

            // ----------------------------------------------------------------
            //    C A L C O L O   D E L   N U M E R O   D I   P A G I N E
            $righe_per_pagina = RIGHE_PER_PAGINA;
            $url_base = BASE_URL_SITO."archivio_per_anno/".$_REQUEST['azione']."/";
            $pagine_vicine = PAGINE_VICINE;
            // ricavo il numero totale di record
            $tot_righe = $fun->numeroRecord('hospitality_guest',IDSITO,'Archivia',1,$_REQUEST['azione']);
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
# VARIABILI
$numP       = $fun->check_non_archiviate(IDSITO,$_REQUEST['azione']);

$variabili .= '&anno='.$_REQUEST['azione'].'';

# INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
               <table id="archivio" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='                <th class="notexport"></th>
                            <th>Nr.</th>
                            <th>Richiesta</th>
                            <th>Fonte</th>
                            <th>Target</th>
                            <th>Nome e Cognome</th>
                            <th>Email</th>
                            <th class="notexport">Lg</th>
                            <th>Arrivo</th>
                            <th>Partenza</th>
                            <th>Proposta</th>
                            <th>Disdetta</th>
                            <th>Annullata</th>
                            <th class="notexport"></th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .= '<div class="dataTables_info" id="archivio_info_serverSide" role="status" aria-live="polite">Visualizza pagina '.($_GET['pag']==''?1:$_GET['pag']).' di '.$tot_pagine.' per '.$tot_righe.' righe</div>'."\r\n";
$content .= $link_paginazione.''."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                '.($NumeroRecordArchivio > NUMERO_RECORD?'
                .pagination{
                    position:absolute!important;
                    right:20px!important;
                }
                #archivio_info{
                    display: none !important;
                } 
                .buttons-page-length {
                    display: none !important;
                }
                ':'
                #archivio_info_serverSide{
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
                 var table = $("#archivio").DataTable( {

                    responsive: true,
                    processing:true,
                    oLanguage: {sProcessing: "<div class=\'cell preloader5 loader-block\'><div class=\'circle-5 l loader-warning\'></div><div class=\'circle-5 m loader-warning\'></div><div class=\'circle-5 r loader-warning\'></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>QUOTO! sta caricando i dati...<span class=\'\'>Attendere!!</span></span>"},
                    "paging": '.($NumeroRecordArchivio > NUMERO_RECORD?'false':'true').',
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
                            text:      \'<i class="fa fa-repeat fa-2x fa-fw"></i> Ri-abilita\',
                            titleAttr: \'Ri-abilita selezionate\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'disarchivia_all\'},
                            action: function () {
                                    var checkbox_value = "";
                                    $("input[name=Id]").each(function () {
                                        var ischecked = $(this).is(":checked");
                                        if (ischecked) {
                                            checkbox_value += $(this).val() + ",";
                                        }
                                    });
                                    if(checkbox_value){
                                        if (window.confirm("ATTENZIONE: Sicuro di voler Ri-abilitare le richieste selezionate?")){
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/dis_archivia_all.php",
                                                type: "POST",
                                                data: "idsito='.IDSITO.'&checkbox_value="+checkbox_value,
                                                dataType: "html",
                                                success: function(data) {
                                                            _alert("<i class=\"fa fa-trash \"></i> Esito:","Le richieste sono state Ri-abilitate!"); 
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
                            text:      \'<i class="fa fa-trash fa-2x fa-fw"></i> Cestina \',
                            titleAttr: \'Cestina conferme selezionati\',
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
                                                            _alert("<i class=\"fa fa-trash \"></i> Esito:","Le richieste sono state cestinate!"); 
                                                            location.reload();    
                                                }
                                            });
                                            return false; // con false senza refresh della pagina
                                        }

                                    }else{
                                        _alert("<i class=\"fa fa-trash \"></i> Attenzione:","Selezionare prima di cliccare il pulsante!"); 
                                    }
                            }
                        }, '."\r\n";
            /** 
             ** Il pulsante per arichiare tutti i record 
             ** non è visibile per l'anno in corso
             */
            if($_REQUEST['azione'] != date('Y')){
                if($numP >0){                       
                    $content .='{
                                text:      \'<t data-toggle="tooltip" title="Ci sono ancora '.$numP .' record da archiviare!"><i class="fa fa-database fa-2x fa-fw"></i> Archivia tutto il '.$_REQUEST['azione'].'</t>\',
                                titleAttr: \'Archivi\',
                                className: \'buttonSelezioni\',
                                attr: {id: \'archivia_all_'.$_REQUEST['azione'].'\'},
                                action: function () {
                                            if (window.confirm("ATTENZIONE: Sicuro di voler archiviare '.$numP .' preventivi/prenotazioni delll\'anno '.$_REQUEST['azione'].'?")){
                                                $.ajax({
                                                    url: "'.BASE_URL_SITO.'ajax/generici/archivia_all_anno.php",
                                                    type: "POST",
                                                    data: "action=archiviaAnno&idsito='.IDSITO.'&anno='.$_REQUEST['azione'].'",
                                                    dataType: "html",
                                                    success: function(data) {
                                                                _alert("<i class=\"fa fa-trash \"></i> Esito:","Tutti i preventivi, ....in trattativa e prenotazioni del '.$_REQUEST['azione'].' sono state archiviate!"); 
                                                                setTimeout(function(){location.reload();}, 2000);  
                                                    }
                                                });
                                                return false; // con false senza refresh della pagina
                                            }
                                }
                            }, '."\r\n";
                }
            }
                $content .='                        {

                    text:      \'<i class="fa fa-search fa-2x fa-fw"></i> Ricerca avanzata\',
                    titleAttr: \'Ricerca Avanzata\',
                    className: \'buttonSearch\',
                    attr: {id: \'buttonSearch\'},
                    action: function ( e, dt, node, config ) {
                        $("#myModalASearchArchivio").modal("show");
                    }
                },'."\r\n";
                $content .='\'pageLength\',                    
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
                        /*{ extend: \'colvis\', text: \'Colonne visibili\' }*/
                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/proposte/archivio_anno.crud.php?idsito='.IDSITO.''.$variabili.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "id","class":"text-center"},
                        { "data": "nr","class":"text-center"},  
                        { "data": "richiesta"},        
                        { "data": "fonte"},
                        { "data": "tipo"},
                        { "data": "cliente","class":"nowrap"}, 
                        { "data": "email","class":"nowrap"}, 
                        { "data": "lingua","class":"text-center"}, 
                        { "data": "arrivo","type":"date","class":"text-center nowrap"}, 
                        { "data": "partenza","type":"date","class":"text-center nowrap"}, 
                        { "data": "riepilogo","class":"text-center"}, 
                        { "data": "disdetta","class":"text-center"},
                        { "data": "annullata","class":"text-center"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                             {"targets": [0,7,10,13], "orderable": false}  

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 1, \'DESC\' ] ).draw();
                    $("#archivio_processing").removeClass("card"); 

                    '.($NumeroRecordArchivio > NUMERO_RECORD?'$("#archivio_wrapper").prepend(\'<div class="dataTables_filter f-11" style="position:absolute;right:20px;top:80px">Filtro rapido disattivato finchè<br> non si riducono i record a meno di '.NUMERO_RECORD.'</div>\');$("#archivio_filter").hide();':'$(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");').'
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";
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

$content .='})
            </script>';     
  
  
?>
