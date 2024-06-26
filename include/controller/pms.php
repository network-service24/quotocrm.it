<?php
    $tipo_pms = check_pms(IDSITO);
    if($tipo_pms != '0'){
        if(check_person_pms(IDSITO) == 0){
            $button = '<p class="text-right"><a href="'.BASE_URL_SITO.'get_config_pms/sync/C/" class="btn btn-mini btn-primary" id="resynchBtn">Synch PMS</a> <br><small>Sincronizza la prima volta le configurazioni del tuo PMS!</small></p>';
        }else{
            $button = '<p class="text-right"><a href="'.BASE_URL_SITO.'get_config_pms/sync/C/" class="btn btn-mini btn-primary" id="resynchBtn">Synch PMS</a> <br><small>Ri-sincronizza le configurazioni del tuo PMS!</small></p>';

        }

    }
#VARIABILI
$check_compliato = $fun->Conto5stelle(IDSITO);
# PULSANTE AGGIUNGI

$content .=' <div class="modal fade" id="Modale5stelle" tabindex="-1" role="dialog" aria-labelledby="Modale5stelleLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi Codici per Cinque Stelle PMS</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                <form method="POST" id="form_5stelle" name="form_5stelle">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Gestionale Hotel</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="Pms" name="Pms" value="hotelcinquestelle.cloud" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Host</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="UrlHost" name="UrlHost" value="https://api.hotelcinquestelle.cloud/hotelProxy/" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Provider</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="Provider" name="Provider"  required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>
                                                    Codice Hotel o Api Key
                                                </label>                                               
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="Code" name="Code" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Abilitato</label>
                                            </div>
                                            <div class="col-md-1">                                            	                                                     
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
                                <div class="col-md-1"></div>
                                </div>                      
                                <script>
                                    $(document).ready(function() {
                                        $("#form_5stelle").submit(function () {   
                                            var  Pms                      = $("#Pms").val(); 
                                            var  UrlHost                  = $("#UrlHost").val(); 
                                            var  Provider                 = $("#Provider").val(); 
                                            var  Code                     = $("#Code").val(); 
                                            var  Abilitato                = $("#Abilitato").val();          
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/aggiungi_5stelle.php",
                                                type: "POST",
                                                data: "action=add_cs&idsito='.IDSITO.'&Pms="+Pms+"&UrlHost="+UrlHost+"&Provider="+Provider+"&Code="+Code+"&Abilitato="+Abilitato+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#Modale5stelle").modal("hide");
                                                    $("#5stelle").DataTable().ajax.reload();    
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
               <table id="5stelle" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='          
                            <th>PMS Hotel</th>
                            <th>Host</th>
                            <th>Provider</th>
                            <th>Codice Hotel o Api Key</th>
                            <th>Abilitato</th>
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
                $("#aggiungi").on("click",function(){
                    $("#Modale5stelle").modal("show");
                });

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
                var table = $("#5stelle").DataTable( {
                                                               
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
                            '."\r\n";
    if($check_compliato == 0){
        $content .='     {
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                               $("#Modale5stelle").modal("show");
                            }
                        },'."\r\n";
    }
        $content .='
                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/setting/5stelle.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='     
                        { "data": "pms", "class": "text-center"}, 
                        { "data": "url_host","class": "text-center"},        
                        { "data": "provider","class":"text-center"},
                        { "data": "code","class":"text-center"},
                        { "data": "abilitato","class":"text-center"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [1,2,3,4,5], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 0, \'DESC\' ] ).draw();
                    $("#5stelle_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>