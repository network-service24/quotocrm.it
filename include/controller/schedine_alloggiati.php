<?php
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
            </style>'."\r\n";
# INTERFACCIA CRUD DATATABLE
$content .=' <table id="schedine" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='               <th>Nr.</th>
                            <th>Soggiorno</th>
                            <th>Lg</th>
                            <th>N.persone</th>
                            <th>Componente</th>
                            <th>Tipo documento</th>
                            <th>Documento</th>
                            <th>Comune emissione</th>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Data compilazione</th>
                            <th style="width:15%">Esito compilazione</th>
                            <th class="notexport">Azioni</th>
                        </tr>
                    </thead>

                </table> '."\r\n";

# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>

            $(document).ready(function() {'."\r\n";

$content .=' 
                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();


                // CONFIG DATATABLE
                var table = $("#schedine").DataTable( {
                    order: [[0, \'DESC\']], 
                    responsive: true,
                    processing:true,
                    oLanguage: {sProcessing: "<div class=\'cell preloader5 loader-block\'><div class=\'circle-5 l loader-warning\'></div><div class=\'circle-5 m loader-warning\'></div><div class=\'circle-5 r loader-warning\'></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>QUOTO! sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
                    "paging": true,
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
                    "ajax": "'.BASE_URL_SITO.'crud/proposte/schedine.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "nr","class":"text-center"},
                        { "data": "soggiorno","class":"text-center"},
                        { "data": "lg","class":"text-center"},          
                        { "data": "n_persone","class":"text-center"},
                        { "data": "componente"},
                        { "data": "tipo_documento"},
                        { "data": "documento","class":"text-center"}, 
                        { "data": "emissione"}, 
                        { "data": "nome"}, 
                        { "data": "cognome"}, 
                        { "data": "data_compilazione","type":"date","class":"text-center"},
                        { "data": "esito_compilazione","class":"text-center"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                            {"targets": [1,2,3,4,5,6,7,8,11,12], "orderable": false}

                        ]
                    })

                    $("#schedine_processing").removeClass("card"); '."\r\n";


$content .='        $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";



$content .='})
        </script>';     
    

?>
