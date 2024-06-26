<?php
#VARIABILI
$check_compliato = $fun->ContoParityRate(IDSITO);
# PULSANTE AGGIUNGI

$content .=' <div class="modal fade" id="ModaleParityRate" tabindex="-1" role="dialog" aria-labelledby="ModaleParityRateLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi Codici per Parity Rate</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                <form method="POST" id="form_parityrate" name="form_parityrate">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>ID Hotel</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="HotelId" name="HotelId" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>User Parity</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="UserParity" name="UserParity" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Password Parity</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="PasswordParity" name="PasswordParity"  required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>
                                                    Url Api
                                                </label>                                               
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="UrlApi" name="UrlApi"  required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>
                                                    Api Key
                                                </label>                                               
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="ApiKey" name="ApiKey"  required/>
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
                                        $("#form_parityrate").submit(function () {   
                                            var  HotelId                   = $("#HotelId").val(); 
                                            var  UserParity                = $("#UserParity").val(); 
                                            var  PasswordParity            = $("#PasswordParity").val(); 
                                            var  UrlApi                    = $("#UrlApi").val(); 
                                            var  ApiKey                    = $("#ApiKey").val();
                                            var  Abilitato                 = $("#Abilitato").val();          
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/aggiungi_parityrate.php",
                                                type: "POST",
                                                data: "action=add_pr&idsito='.IDSITO.'&HotelId="+HotelId+"&UserParity="+UserParity+"&PasswordParity="+PasswordParity+"&UrlApi="+UrlApi+"&ApiKey="+ApiKey+"&Abilitato="+Abilitato+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleParityRate").modal("hide");
                                                    $("#parityrate").DataTable().ajax.reload();    
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
               <table id="parityrate" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='          
                            <th>ID Hotel</th>
                            <th>User Parity</th>
                            <th>Pass Parity</th>
                            <th>Url Api</th>
                            <th>Api Key</th>
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
                    $("#ModaleParityRate").modal("show");
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
                var table = $("#parityrate").DataTable( {
                                                               
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
                               $("#ModaleParityRate").modal("show");
                            }
                        },'."\r\n";
   }
        $content .='
                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/setting/parityrate.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='     
                        { "data": "id_hotel", "class": "text-center"}, 
                        { "data": "user_parity","class": "text-center"},        
                        { "data": "pass_parity" ,"class":"text-center"},
                        { "data": "url_api","class":"text-center"},
                        { "data": "api_key","class":"text-center"},
                        { "data": "abilitato","class":"text-center"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [1,2,3,4,5,6], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 0, \'DESC\' ] ).draw();
                    $("#parityrate_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>