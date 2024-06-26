<?php

# INSERT TESTI
$content .= '<div class="modal fade" id="ModaleListinoSoggiorno" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Aggiungi listino per il soggiorno</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">

                                <form method="POST" id="form_listino_soggiorno" name="form_listino_soggiorno">                                          

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <b>Dal</b>
                                            </div>
                                            <div class="col-md-4">
                                                <b>Al</b>
                                            </div>
                                            <div class="col-md-4">
                                                <b>Prezzo</b>
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
                                                <input type="text" name="Prezzo" id="Prezzo" class="form-control" placeholder="000.00" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input type="hidden" name="IdSoggiorno" id="IdSoggiorno"  value="'.$_REQUEST['azione'].'">
                                                <input type="hidden" name="idsito"  value="'.IDSITO.'">
                                                <input type="hidden" name="action"  value="add_listino_soggiorno">
                                                <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                            </div>
                                        </div>
                                    </div>                                 
                                </form>
                                <script>
                                $(document).ready(function() {
                                    $("#form_listino_soggiorno").submit(function () { 
                                        var  IdSoggiorno = $("#IdSoggiorno").val();  
                                        var  PeriodoDal  = $("#PeriodoDal").val();
                                        var  PeriodoAl   = $("#PeriodoAl").val(); 
                                        var  Prezzo      = $("#Prezzo").val(); 
                                        $.ajax({
                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/aggiungi_listino_soggiorno.php",
                                            type: "POST",
                                            data: "action=add_l_soggiorno&idsito='.IDSITO.'&PeriodoDal="+PeriodoDal+"&PeriodoAl="+PeriodoAl+"&Prezzo="+Prezzo+"&IdSoggiorno="+IdSoggiorno+"",
                                            dataType: "html",
                                            success: function(data) {
                                                $("#ModaleListinoSoggiorno").modal("hide");
                                                $("#add_listino_soggiorno").DataTable().ajax.reload();    
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
               <table id="add_listino_soggiorno" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';
$content .='          
                            <th>Dal</th>
                            <th>Al</th>
                            <th>Prezzo</th>
                            <th style="width:4%"></th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                #add_listino_soggiorno_filter{
                    display: none !important;
                }
                .buttons-collection{
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
                var table = $("#add_listino_soggiorno").DataTable( {
                                                               
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
                            text:      \'<i class="fa fa-angle-double-left fa-2x fa-fw"></i> Torna ai Soggiorni\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'tornaIndietro\'},
                            action: function () {
                                document.location=\''.BASE_URL_SITO.'disponibilita-soggiorni/\';
                            }
                        },'."\r\n";
    if($testi_inseriti < 4){
        $content .='     {
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi listino soggiorno\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                                $("#ModaleListinoSoggiorno").modal("show");
                            }
                        },'."\r\n";
    }
        $content .='   \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/disponibilita/listino_soggiorno.crud.php?idsito='.IDSITO.'&id='.$_REQUEST['azione'].'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "dal","class":"text-left"},        
                        { "data": "al","class":"text-left"},
                        { "data": "prezzo","class":"text-left"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,1,2,3], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 0, \'ASC\' ] ).draw();
                    $("#add_listino_soggiorno_processing").removeClass("card"); '."\r\n";


$content .='})
        </script>';
?>


        