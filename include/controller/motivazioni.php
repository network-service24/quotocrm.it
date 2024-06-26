<?php
# PULSANTE AGGIUNGI

$content .=' <div class="modal fade" id="ModaleMotivazioni" tabindex="-1" role="dialog" aria-labelledby="ModaleTargetLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi TAG Motivazioni</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                <form method="POST" id="form_add_motivazioni" name="form_add_motivazioni">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Motivazione</label>
                                            </div>
                                            <div class="col-md-9">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="Motivazione" name="Motivazione" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Abilitato</label>
                                            </div>
                                            <div class="col-md-1 text-left">                                            	                                                     
                                                <input type="checkbox" class="form-control" id="Abilitato" name="Abilitato" value="1" checked="checked"/>
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
                                <div class="col-md-2"></div>
                                </div>                      
                                <script>
                                    $(document).ready(function() {
                                        $("#form_add_motivazioni").submit(function () {   
                                            var  motivazione  = $("#Motivazione").val(); 
                                            var  abilitato    = $("#Abilitato").val(); 
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/aggiungi_motivazioni.php",
                                                type: "POST",
                                                data: "action=add_mo&idsito='.IDSITO.'&motivazione="+motivazione+"&abilitato="+abilitato+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleMotivazioni").modal("hide");
                                                    $("#motivazioni").DataTable().ajax.reload();    
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
               <table id="motivazioni" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='          
                            <th>Motivazione</th>
                            <th>Testi presenti</th>
                            <th>Abilitato</th>
                            <th style="width:4%"></th>
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
                $("#Abilitato").click(function() {
                    if($("#Abilitato").is(":checked")){
                        $("#Abilitato").attr("value","1");
                    }else{
                        $("#Abilitato").attr("value",false);
                        $("#Abilitato").attr("checked",false);
                    }
                });

                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();

                // CONFIG DATATABLE
                var table = $("#motivazioni").DataTable( {
                                                               
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
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi Motivazioni\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                                $("#ModaleMotivazioni").modal("show");
                            }
                        },
                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/setting/tag_motivazioni.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "motivo"},  
                        { "data": "lingua","class":"text-center"},        
                        { "data": "abilitato","class":"text-center"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,1,2,3], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 1, \'ASC\' ] ).draw();
                    $("#motivazioni_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>


        