<?php

# PULSANTE AGGIUNGI

$content .=' <div class="modal fade" id="ModaleSconti" tabindex="-1" role="dialog" aria-labelledby="ModaleScontiLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi Codice Sconto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                <form method="POST" id="form_sconti" name="form_sconti">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Data Inizio</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                    <input type="datetime-local" class="form-control" id="data_inizio" name="data_inizio" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Data Scadenza</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                    <input type="datetime-local" class="form-control" id="data_fine" name="data_fine" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Codice Sconto</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="cod" name="cod" value="'.$fun->CodiceCasuale().'" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>
                                                    Percentuale di Sconto
                                                    <div class="clearfix f-11 text-center">(Inserire numeri interi!)</div>
                                                </label>                                               
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-percent fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="imp_sconto" name="imp_sconto" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Descrizione dello Sconto</label>
                                            </div>
                                            <div class="col-md-8">                                          	                                                     
                                                <textarea name="note" id="note" rows="5" style="width:100%"></textarea>
                                            </div>
                                        </div>
                                    </div>                                   
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                            </div>
                                        </div>
                                    </div>                                 
                                </form> 
                                </div> 
                                <div class="col-md-1"></div>
                                </div>                      
                                <script>
                                    $(document).ready(function() {
                                        $("#form_sconti").submit(function () {   
                                            var  data_inizio  = $("#data_inizio").val(); 
                                            var  data_fine    = $("#data_fine").val(); 
                                            var  cod          = $("#cod").val(); 
                                            var  imp_sconto   = $("#imp_sconto").val(); 
                                            var  note         = $("#note").val();         
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/aggiungi_sconti.php",
                                                type: "POST",
                                                data: "action=add_sc&idsito='.IDSITO.'&data_inizio="+data_inizio+"&data_fine="+data_fine+"&cod="+cod+"&imp_sconto="+imp_sconto+"&note="+note+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleSconti").modal("hide");
                                                    $("#sconti").DataTable().ajax.reload();    
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
               <table id="sconti" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='          
                            <th>Data Inizio validità</th>
                            <th>Data Scadenza</th>
                            <th>Codice Sconto</th>
                            <th>Percentuale Sconto</th>
                            <th>Note</th>
                            <th></th>
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
                $("#aggiungi").on("click",function(){
                    $("#ModaleSconti").modal("show");
                });

                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();

                // CONFIG DATATABLE
                var table = $("#sconti").DataTable( {
                                                               
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
							[ 10, 20, -1 ],
							[  \'10 record\', \'20 record\', \'Tutti\' ]
                        ],	
                        buttons: [
                        {
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi codice sconto\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                                $("#ModaleSconti").modal("show");
                            }
                        },
                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/setting/sconti.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='     
                        { "data": "data_inizio", "type": "date","class": "text-center"}, 
                        { "data": "data_fine", "type": "date","class": "text-center"},        
                        { "data": "codice_sconto" ,"class":"text-center"},
                        { "data": "percentuale_sconto","class":"text-center"},
                        { "data": "note"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"scontis": [2,3,4,5], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 1, \'DESC\' ] ).draw();
                    $("#sconti_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>