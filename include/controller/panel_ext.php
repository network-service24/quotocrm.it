<?php
# PULSANTE AGGIUNGI
$content .=' <div class="modal fade" id="ModalePanelExt" tabindex="-1" role="dialog" aria-labelledby="ModalePanelExtLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi Codici per Panelli Esterni</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                <form method="POST" id="form_PanelExt" name="form_PanelExt">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Icona font Awesome</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="font_awesome" name="font_awesome" placeholder="fa fa-quora" />
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Nome Pannello</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="nome_pannello" name="nome_pannello" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Url</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="url" name="url" placeholder="https://nomedeldominio.xx/login" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>
                                                   Nome del primo campo
                                                </label>                                               
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="campo_1" name="campo_1" placeholder="username" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Valore del primo campo</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="valore_1" name="valore_1" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>
                                                   Nome del secondo campo
                                                </label>                                               
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="campo_2" name="campo_2" placeholder="password" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Valore del secondo campo</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="valore_2" name="valore_2" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>
                                                Nome del terzo campo
                                                </label>                                               
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="campo_3" name="campo_3" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Valore del terzo campo</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="valore_3" name="valore_3" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                     
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Method</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <select class="form-control" id="method" name="method">
                                                        <option value="post">post</option>
                                                        <option value="get">get</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Target</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <select class="form-control" id="target" name="target">
                                                            <option value="iframe">iframe</option>
                                                            <option value="_blank">_blank</option>
                                                    </select>
                                                </div>
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
                                        $("#form_PanelExt").submit(function () {   
                                            var  font_awesome  = $("#font_awesome").val(); 
                                            var  nome_pannello = $("#nome_pannello").val(); 
                                            var  url           = $("#url").val(); 
                                            var  campo_1       = $("#campo_1").val();
                                            var  valore_1      = $("#valore_1").val();
                                            var  campo_2       = $("#campo_2").val();
                                            var  valore_2      = $("#valore_2").val();
                                            var  campo_3       = $("#campo_3").val();
                                            var  valore_3      = $("#valore_3").val(); 
                                            var  method        = $("#method option:selected").val();
                                            var  target        = $("#target option:selected").val();       
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/aggiungi_panel_ext.php",
                                                type: "POST",
                                                data: "action=add_panel_ext&idsito='.IDSITO.'&font_awesome="+font_awesome+"&nome_pannello="+nome_pannello+"&url="+url+"&campo_1="+campo_1+"&valore_1="+valore_1+"&campo_2="+campo_2+"&valore_2="+valore_2+"&campo_3="+campo_3+"&valore_3="+valore_3+"&method="+method+"&target="+target+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModalePanelExt").modal("hide");
                                                    $("#PanelExt").DataTable().ajax.reload();    
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
               <table id="PanelExt" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='          
                            <th>Icona</th>
                            <th>Nome Pannello</th>
                            <th>Url</th>
                            <th>Method</th>
                            <th>Target</th>
                            <th></th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;

                }
                .dataTables_filter {
                    display: none;
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
                var table = $("#PanelExt").DataTable( {
                                                               
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
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                                $("#ModalePanelExt").modal("show");
                            }
                        },
                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/setting/panel_ext.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "icona","class":"text-center"},  
                        { "data": "nome","class":"text-center"},        
                        { "data": "url","class":"text-center"},
                        { "data": "method","class":"text-center"},
                        { "data": "target","class":"text-center"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,2,3,4,5], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 1, \'ASC\' ] ).draw();
                    $("#PanelExt_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>
