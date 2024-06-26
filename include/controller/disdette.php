<?
$NumeroRecord = $fun->countRowsDisdette(IDSITO);
if($NumeroRecord > NUMERO_RECORD){ 

            // ----------------------------------------------------------------
            //    C A L C O L O   D E L   N U M E R O   D I   P A G I N E
            $righe_per_pagina = RIGHE_PER_PAGINA;
            $url_base = BASE_URL_SITO."disdette/";
            $pagine_vicine = PAGINE_VICINE;
            // ricavo il numero totale di record
            $tot_righe = $fun->numeroRecord('hospitality_guest',IDSITO,'Disdetta',1,'');
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

# INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
               <table id="disdette" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
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
                            <th class="notexport"></th>
                        </tr>
                    </thead>

                </table> '."\r\n";

$content .= '<div class="dataTables_info" id="disdette_info_serverSide" role="status" aria-live="polite">Visualizza pagina '.($_GET['pag']==''?1:$_GET['pag']).' di '.$tot_pagine.' per '.$tot_righe.' righe</div>'."\r\n";
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
                #disdette_info{
                    display: none !important;
                } 
                .buttons-page-length {
                    display: none !important;
                }
                ':'
                #disdette_info_serverSide{
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
                var table = $("#disdette").DataTable( {
                                                               
                    responsive: true,
                    processing:true,
                    oLanguage: {sProcessing: " <div class=\'cell preloader5 loader-block\'><div class=\'circle-5 l loader-warning\'></div><div class=\'circle-5 m loader-warning\'></div><div class=\'circle-5 r loader-warning\'></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>QUOTO! sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
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
                    "ajax": "'.BASE_URL_SITO.'crud/proposte/disdette.crud.php?idsito='.IDSITO.''.$variabili.'",
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
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [1,5,6,9,10], "orderable": false}  

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 0, \'DESC\' ] ).draw();
                    $("#disdette_processing").removeClass("card"); 

                    '.($NumeroRecord > NUMERO_RECORD?'':'$(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");').'
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
            </script>';     
  
?>
