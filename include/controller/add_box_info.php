<?php
#VARIABILI
$testi_inseriti = $fun->ContoTestiBoxInfo($_REQUEST['azione'], IDSITO);
# INSERT TESTI
$content .= '<div class="modal fade" id="ModaleBoxInfo" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Aggiungi contenuti per Banner Info sulla Modulo di Check-In Online</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">

                                <form method="POST" id="form_box_info" name="form_box_info" method="POST" action="' . BASE_URL_SITO . 'ajax/generici/aggiungi_testo_box_info.php">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Lingua</label>
                                            </div>
                                            <div class="col-md-9">
                                                    ' . $fun->SelectLingue('Lingua', 'Lingua', '') . '
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Titolo</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" name="Titolo" id="Titolo" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Descrizione</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <textarea class="form-control Width100" id="Descrizione"  name="Descrizione" style="width:100%"></textarea>
                                                    <!-- Custom js -->
                                                    <script type="text/javascript" src="' . BASE_URL_SITO . 'js/ckeditor/ckeditor.js"></script>
                                                    <script>
                                                        $(function() {
                                                                CKEDITOR.replace(\'Descrizione\');
                                                                $(".textarea").wysihtml5();
                                                        });
                                                        CKEDITOR.config.toolbar = [
                                                                    [\'Source\',\'-\',\'Maximize\'],
                                                                    [\'Bold\',\'Italic\',\'Underline\',\'StrikeThrough\',\'-\',\'Cut\',\'Copy\',\'Paste\',\'PasteText\',\'PasteFromWord\',\'-\',\'Outdent\',\'Indent\',\'NumberedList\',\'BulletedList\',\'-\',\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\',\'Table\',\'Link\',\'TextColor\',\'BGColor\'],
                                                                ] ;
                                                        CKEDITOR.config.autoGrow_onStartup = true;
                                                        CKEDITOR.config.extraPlugins = \'autogrow\';
                                                        CKEDITOR.config.autoGrow_minHeight = 250;
                                                        CKEDITOR.config.autoGrow_maxHeight = 500;
                                                        CKEDITOR.config.width = 800;
                                                        CKEDITOR.config.autoGrow_bottomSpace = 50;
                                                </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input type="hidden" name="Id_infohotel" id="Id_infohotel" value="' . $_REQUEST['azione'] . '">
                                                <input type="hidden" name="idsito"  value="' . IDSITO . '">
                                                <input type="hidden" name="action"  value="add_box_info">
                                                <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>' . "\r\n";
# INTERFACCIA CRUD DATATABLE
$content .= '   <!-- Table datatable-->
               <table id="add_box_info" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';
$content .= '
                            <th style="width:10%">Lingua</th>
                            <th>Titolo</th>
                            <th>Descrizione</th>
                            <th style="width:4%"></th>
                        </tr>
                    </thead>

                </table> ' . "\r\n";
$content .= '<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                #add_box_info_filter{
                    display: none !important;
                }
                .buttons-collection{
                    display: none !important;
                }
                #add_box_info_info{
                    display: none !important;
                }
            </style>' . "\r\n";
# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .= '<script>

            var editor; // use a global for the submit and return data rendering in the examples

            $(document).ready(function() {' . "\r\n";

$content .= '
                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();

                // CONFIG DATATABLE
                var table = $("#add_box_info").DataTable( {

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
                        {
                            text:      \'<i class="fa fa-angle-double-left fa-2x fa-fw"></i> Torna al Banner info\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'tornaIndietro\'},
                            action: function () {
                                document.location=\'' . BASE_URL_SITO . 'checkinonline-box_info/\';
                            }
                        },' . "\r\n";
if ($testi_inseriti < 4) {
 $content .= '     {
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi testo banner info\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                                $("#ModaleBoxInfo").modal("show");
                            }
                        },' . "\r\n";
}
$content .= '   \'pageLength\',


                    ],
                    "ajax": "' . BASE_URL_SITO . 'crud/setting/add_box_info.crud.php?idsito=' . IDSITO . '&id=' . $_REQUEST['azione'] . '",
                    "deferRender": true,
                    "columns": [' . "\r\n";

$content .= '    { "data": "lingua","class":"text-center"},
                        { "data": "titolo","class":"text-left"},
                        { "data": "descrizione","class":"text-left"},
                        { "data": "action","class":"text-center"}
                    ],';
$content .= '    "columnDefs": [
                              {"targets": [0,1,2,3], "orderable": false}

                        ]
                    })


                    // ORDINAMENTO TABELLA
                    table.order( [ 0, \'ASC\' ] ).draw();
                    $("#add_box_info_processing").removeClass("card");' . "\r\n";

$content .= '})
        </script>';
