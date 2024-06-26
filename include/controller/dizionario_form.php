<?php
 # INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
               <table id="DizionarioForm" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='                
                            <th style="width:40%">Etichetta [Italiano]</th>
                            <th style="width:6%" class="nowrap">Testi Presenti</th>
                            <th style="width:5%"></th>
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

            var editor; // use a global for the submit and return data rendering in the examples

            $(document).ready(function() {'."\r\n";


$content .='                                                                     

                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();

                // CONFIG DATATABLE
                var table = $("#DizionarioForm").DataTable( {

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
                          [ 30, 50, 100, -1 ],
                          [  \'30 record\', \'50 record\', \'100 record\', \'Tutti\' ]
                        ],	
                        buttons: [

                    \'pageLength\',                    

                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/setting/dizionario_form.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='   
                        { "data": "etichetta"},  
                        { "data": "testi","class":"text-center"},             
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,1,2], "orderable": false}

                        ]
                    })
    
                    $("#DizionarioForm_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>


        