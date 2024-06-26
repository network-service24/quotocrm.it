<?php
# INSERT TESTI
$content .= '<div class="modal fade" id="ModaleListino" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Aggiungi periodi e prezzi</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">

                                <form method="POST" id="form_listino" name="form_listino">   
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><b>Camera</b></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label><b>Trattamento soggiorno</b></label>
                                            </div>
                                        </div>
                                    </div>                                       
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select name="IdCamera" id="IdCamera" class="form-control">
                                                    '.$fun->lista_camere(IDSITO).'
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="IdSoggiorno" id="IdSoggiorno" class="form-control" >
                                                    '.$fun->lista_soggiorni(IDSITO).'
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <b>Dal</b>
                                            </div>
                                            <div class="col-md-4">
                                                <b>Al</b>
                                            </div>
                                            <div class="col-md-4">
                                                <b>Prezzo Camera</b>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="date" name="PeriodoDal" id="PeriodoDal" class="form-control" required/>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="date" name="PeriodoAl" id="PeriodoAl" class="form-control" required />
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="PrezzoCamera" id="PrezzoCamera" class="form-control" placeholder="000.00" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input type="hidden" name="IdNumeroListino" id="IdNumeroListino"  value="'.$_REQUEST['azione'].'">
                                                <input type="hidden" name="idsito"  value="'.IDSITO.'">
                                                <input type="hidden" name="action"  value="add_listino">
                                                <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                            </div>
                                        </div>
                                    </div>                                 
                                </form>
                                <script>
                                $(document).ready(function() {
                                    $("#form_listino").submit(function () { 
                                        var  IdNumeroListino = $("#IdNumeroListino").val();  
                                        var  IdCamera        = $("#IdCamera option:selected").val();
                                        var  IdSoggiorno     = $("#IdSoggiorno option:selected").val();
                                        var  PeriodoDal      = $("#PeriodoDal").val();
                                        var  PeriodoAl       = $("#PeriodoAl").val(); 
                                        var  PrezzoCamera    = $("#PrezzoCamera").val(); 
                                        $.ajax({
                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/aggiungi_tabella_listino.php",
                                            type: "POST",
                                            data: "action=add_l&idsito='.IDSITO.'&PeriodoDal="+PeriodoDal+"&PeriodoAl="+PeriodoAl+"&PrezzoCamera="+PrezzoCamera+"&IdNumeroListino="+IdNumeroListino+"&IdCamera="+IdCamera+"&IdSoggiorno="+IdSoggiorno+"",
                                            dataType: "html",
                                            success: function(data) {
                                                $("#ModaleListino").modal("hide");
                                                $("#add_listino").DataTable().ajax.reload();    
                                            }
                                        });
                                        return false; // con false senza refresh della pagina                                       
                                    });
                                });
                            </script>
                            </div>
                        </div>
                    </div>           
                </div>'."\r\n";
# INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
               <table id="add_listino" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';
$content .='          
                            <th>Camera</th>
                            <th>Trattamento</th>
                            <th>Periodo Dal</th>
                            <th>Periodo Al</th>
                            <th>Prezzo Camera</th>
                            <th>Abilitato</th>
                            <th style="width:4%"></th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                #add_listino_filter{
                    display: none !important;
                }
                #add_listino_info{
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
                var table = $("#add_listino").DataTable( {
                    order: [[0, \'asc\']],                              
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
							[ 15, 30, 60, -1 ],
							[  \'15 record\', \'30 record\', \'60 record\', \'Tutti\' ]
                        ],	
                        buttons: [
                        {
                            text:      \'<i class="fa fa-angle-double-left fa-2x fa-fw"></i> Torna ai Listini\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'tornaIndietro\'},
                            action: function () {
                                document.location=\''.BASE_URL_SITO.'disponibilita-tipo_listino/\';
                            }
                        },'."\r\n";

        $content .='     {
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi periodi e prezzi\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                                $("#ModaleListino").modal("show");
                            }
                        },'."\r\n";
    
        $content .='   \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/disponibilita/listino_tabella.crud.php?idsito='.IDSITO.'&id='.$_REQUEST['azione'].'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "camera","class":"text-left"},        
                        { "data": "soggiorno","class":"text-left"},
                        { "data": "dal","type":"date","class":"text-center"},
                        { "data": "al","type":"date","class":"text-center"},
                        { "data": "prezzo","class":"text-left"},
                        { "data": "abilitato","class":"text-center"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [1,4,5,6], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    $("#add_listino_processing").removeClass("card");
                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>


        