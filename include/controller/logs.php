<?php


# INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
               <table id="logs" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='          
                            <th>ID Prev/Conf/Pren</th>
                            <th>Operatore</th>
                            <th>Azione</th>
                            <th>Tabella MySql Interessate</th>
                            <th>Data Operazione</th>
                            <th>Ip di Provenienza</th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;

                }
            </style>'."\r\n";
# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>

            $(document).ready(function() {'."\r\n";


$content .=' 


                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();

                // CONFIG DATATABLE
                var table = $("#logs").DataTable( {
                                                               
                    responsive: true,
                    processing:true,
                    oLanguage: {sProcessing: " <div class=\'cell preloader5 loader-block\'><div class=\'circle-5 l loader-warning\'></div><div class=\'circle-5 m loader-warning\'></div><div class=\'circle-5 r loader-warning\'></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>QUOTO! sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
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
							[ 50, 100, 200, 400, 800, -1 ],
							[  \'50 record\', \'100 record\', \'200 risultati\', \'400 risultati\', \'800 risultati\', \'Tutti\' ]
                        ],	
                        buttons: [

                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/setting/logs.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "id_richiesta","class":"text-center"},  
                        { "data": "operatore"},        
                        { "data": "azione"},
                        { "data": "tabella" },
                        { "data": "data_ora","type":"date","class":"text-center"},
                        { "data": "ip","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [1,2,3], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 0, \'DESC\' ] ).draw();
                    $("#logs_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>