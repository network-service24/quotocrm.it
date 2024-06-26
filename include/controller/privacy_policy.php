<?php
# INTERFACCIA CRUD DATATABLE
$content .='<style>
                .dataTables_filter {
                    display: none;
                }
            </style>'."\r\n";
$content .='   <!-- Table datatable-->
               <table id="policy" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='          
                            <th style="width:21%">Etichetta variabile</th>
                            <th style="width:21%">Lingua</th>
                            <th style="width:21%">Contenuto</th>
                            <th style="width:21%">Data ultima modifica dell\'informativa</th>
                            <th style="width:4%"></th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;

                }
                .dt-buttons{
                    display: none !important;
                }
                #policy_info{
                    display: none !important;
                }
            </style>'."\r\n";
# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>

            var editor; // use a global for the submit and return data rendering in the examples

            $(document).ready(function() {'."\r\n";


$content .=' 
                $("#aggiungi").on("click",function(){
                    $("#ModalePolicy").modal("show");
                });

                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();

                // CONFIG DATATABLE
                var table = $("#policy").DataTable( {
                                                               
                    responsive: true,
                    processing:true,
                    oLanguage: {sProcessing: " <div class=\'cell preloader5 loader-block\'><div class=\'circle-5 l loader-warning\'></div><div class=\'circle-5 m loader-warning\'></div><div class=\'circle-5 r loader-warning\'></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>QUOTO! sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
                    "paging": false,
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
							[ 10, 20, -1 ],
							[  \'10 record\', \'20 record\', \'Tutti\' ]
                        ],	
                        buttons: [

                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/setting/privacy_policy.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "variabile"},  
                        { "data": "lingua","class":"text-center"},        
                        { "data": "contenuto","class":"text-center"},
                        { "data": "data_modifica","type":"date","class":"text-center"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,2,3,4], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 1, \'ASC\' ] ).draw();
                    $("#policy_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>