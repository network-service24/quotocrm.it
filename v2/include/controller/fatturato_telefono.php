<?php 

                $output .=' <style>
                                #relazioni .ordinamento {
                                    display:none; 
                                }
                                @keyframes spinner {
                                    to {transform: rotate(360deg);}
                                  }
                                   
                                  .spinner:before {
                                    content: \'\';
                                    box-sizing: border-box;
                                    position: absolute;
                                    top: 50%;
                                    left: 50%;
                                    width: 60px;
                                    height: 60px;
                                    margin-top: -10px;
                                    margin-left: -10px;
                                    border-radius: 50%;
                                    border: 2px solid #ccc;
                                    border-top-color: #333;
                                    animation: spinner .6s linear infinite;
                                  }
                            </style> 
                        <!-- Table datatable-->
                                <table id="relazioni" class="display dataTable table table-striped table-hover table-bordered table-sm"  style="width:100%">
                                    <thead>
                                        <tr>
                                        <th style="text-align:center;width:1%;"><b>Nr.</b></th>
                                        <th style="text-align:center;width:11%;"><b>Tipo</b></th>
                                        <th style="text-align:center;width:16%;white-space:nowrap"><b>Cliente</b></th>
                                        <th style="text-align:center;width:11%;white-space:nowrap"><b>Tel.Richiesta</b></th>
                                        <th style="text-align:center;width:11%;"><b>Campagna</b></th>
                                        <th style="text-align:center;width:16%;"><b>Fatt.</b></th>
                                        </tr>
                                    </thead> 
                                    <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-right">Totale</th>
                                        <th id="fat" class="text-right"></th>
                                     </tr>
                                </tfoot>
                                </table> '."\r\n";


                        # CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
                        $output .='<link href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css" rel="stylesheet">'."\r\n";
                        $output .='<link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css" rel="stylesheet"> '."\r\n";  
                        $output .='<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet">'."\r\n";
   
                        $output .='<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>'."\r\n";
                        $output .='<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.3/js/buttons.flash.min.js"></script> '."\r\n";
                        $output .='<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> '."\r\n";
                        $output .='<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> '."\r\n";
                        $output .='<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> '."\r\n";
                        $output .='<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.3/js/buttons.html5.min.js"></script> '."\r\n";
                        $output .='<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.3/js/buttons.print.min.js"></script>  '."\r\n";
                        $output .='<script>

                                    $(document).ready(function() {


                                            // CONFIG DATATABLE
                                            var table = $("#relazioni").DataTable( {
                                                "paging": true,
                                                "pagingType": "simple_numbers",
                                                "processing": true,
                                                "language": {
                                                    "loadingRecords": "&nbsp;",
                                                    "processing": "<div class=\"spinner\"></div>",
                                                     "search": "Filtra i risultati:",
                                                     "info": "Visualizza pagina _PAGE_ di _PAGES_ per _TOTAL_ righe",
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
                                                            { extend: \'excel\', text: \'Excel\' },  
                                                            { extend: \'csv\', text: \'CSV\' },  
                                                            { extend: \'print\', text: \'Stampa\' },                                
                                                        ]
                                                    },
                                                ],			
                                                "ajax": "'.BASE_URL_SITO.'ajax/crud/fatturato.telefono.quoto.crud.php?idsito='.IDSITO.'",
                                                "columns": [
                                                    { "data": "nr" },
                                                    { "data": "tipo" },
                                                    { "data": "nome" },
                                                    { "data": "cell" },
                                                    { "data": "campagna" },
                                                    { "data": "fatturato", "class":"text-right" }
                                                ],
                                                footerCallback: function( row, data, start, end, display ) {'."\r\n";

                                            $output .='var totale = $("#fat").load("'.BASE_URL_SITO.'ajax/crud/tot.fatturato.tel.qt.crud.php?idsito='.IDSITO.'", function() {
                                                            console.log(totale);
                                                        });'."\r\n";
                                                  
                            $output .='        }
                                            }); 
                                            // ORDINAMENTO TABELLA
                                            table.order( [ 0, \'ASC\' ],[ 4, \'ASC\' ]).draw();
                                            $(\'.dataTables_length\').addClass(\'bs-select\');
                                    }); 

                                </script>'; 




?>