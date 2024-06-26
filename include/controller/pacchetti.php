<?php
# PULSANTE AGGIUNGI

$content .=' <div class="modal fade" id="ModalePacchetti" tabindex="-1" role="dialog" aria-labelledby="ModaleTargetLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi Proposte/Pacchetti</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                <form method="POST" id="form_add_pacchetti" name="form_add_pacchetti">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3 nowrap">
                                                <label>Tipo Pacchetto</label>
                                            </div>
                                            <div class="col-md-9">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-gift fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="TipoPacchetto" name="TipoPacchetto" required/>
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
                                        $("#form_add_pacchetti").submit(function () {   
                                            var  tipo_pacchetto  = $("#TipoPacchetto").val(); 
                                            var  abilitato       = $("#Abilitato").val(); 
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/aggiungi_pacchetti.php",
                                                type: "POST",
                                                data: "action=add_pa&idsito='.IDSITO.'&tipo_pacchetto="+tipo_pacchetto+"&abilitato="+abilitato+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModalePacchetti").modal("hide");
                                                    $("#pacchetti").DataTable().ajax.reload();    
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
               <table id="pacchetti" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='          
                            <th>Tipologia Pacchetti</th>
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
                $("#Abilitato'.$row['Id'].'").click(function() {
                    if($("#Abilitato'.$row['Id'].'").is(":checked")){
                        $("#Abilitato'.$row['Id'].'").attr("value","1");
                    }else{
                        $("#Abilitato'.$row['Id'].'").attr("value",false);
                        $("#Abilitato'.$row['Id'].'").attr("checked",false);
                    }
                });
                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();

                // CONFIG DATATABLE
                var table = $("#pacchetti").DataTable( {
                                                               
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
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi pacchetti\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                                $("#ModalePacchetti").modal("show");
                            }
                        },
                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/setting/pacchetti.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "tipo"},  
                        { "data": "lingua","class":"text-center"},
                        { "data": "abilitato","class":"text-center"},         
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,1,2,3], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 0, \'ASC\' ] ).draw();
                    $("#pacchetti_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>


        