<?
# INTERFACCIA CRUD DATATABLE
$content ='<table id="anagrafiche" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Cognome</th> 
                        <th>E-mail</th>  
                        <th>Telefono/Cellulare</th>
                        <th class="notexport"></th>
                        <th class="notexport">More Info</th>
                    </tr>
                </thead>
            </table>'."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
            </style>'."\r\n";
# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>
            $(document).ready(function() {

                $(\'[data-tooltip="tooltip"]\').tooltip();

                // CONFIG DATATABLE
                var table = $("#anagrafiche").DataTable( {
                    order: [[ 0, \'desc\' ]],  
                    responsive: true,
                    processing:true,
                    oLanguage: {sProcessing: "<div class=\'cell preloader5 loader-block\'><div class=\'circle-5 l loader-warning\'></div><div class=\'circle-5 m loader-warning\'></div><div class=\'circle-5 r loader-warning\'></div></div><span class=\'text-primary f-w-400 f-13 f-s-intial\'>QUOTO sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
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
									_: "Mostra %d elementi",
                                    \'-1\': "Mostra tutto"
								}
							}
						},
                        dom: \'Bfrtip\',
						lengthMenu: [
							[ 50, 100, 200, 400, -1 ],
							[ \'50 risultati\', \'100 risultati\', \'200 risultati\', \'400 risultati\', \'Tutti\' ]
						],						
                        buttons: [ \'pageLength\',
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

                        "ajax": "'.BASE_URL_SITO.'crud/anagrafiche/anagrafiche.crud.php?idsito='.IDSITO.'",
                                    "deferRender": true,
                                    "columns": [
                                        { "data": "Id","class":"small text-center" },
                                        { "data": "nome" },
                                        { "data": "cognome"}, 
                                        { "data": "email"}, 
                                        { "data": "cellulare" },
                                        { "data": "action","class": "text-center" },
                                        { "data": "action2","class":"text-center"}
                                    ],

                        "columnDefs": [
                              {"targets": [3,4,5], "orderable": false}

                        ]    

                }); 

                // ORDINAMENTO TABELLA
                //table.order( [ 0, \'ASC\' ] ).draw();

                $("#anagrafiche_processing").removeClass("card");

                $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");


            });

    </script>'."\r\n";  
?>