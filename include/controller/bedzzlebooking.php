<?php
#VARIABILI
$check_compliato = $fun->ContoBedzzle(IDSITO);
# PULSANTE AGGIUNGI

$content .=' <div class="modal fade" id="ModaleBedzzle" tabindex="-1" role="dialog" aria-labelledby="ModaleBedzzleLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi Codici per Bedzzle</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                <form method="POST" id="form_bedzzle" name="form_bedzzle">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Url API</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="UrlHost" name="UrlHost" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Proxy Auth (Key)</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="ProxyAuth" name="ProxyAuth" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Vendor Account (API KEY)</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="VendorAccount" name="VendorAccount"  required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>
                                                    HotelAccount
                                                </label>                                               
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="HotelAccount" name="HotelAccount" value="" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Url API Setting</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="UrlHostSetting" name="UrlHostSetting" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Proxy Auth (Key) Setting</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="ProxyAuthSetting" name="ProxyAuthSetting" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Vendor Account (API KEY) Setting</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="VendorAccountSetting" name="VendorAccountSetting"  required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>
                                                    HotelAccount Setting
                                                </label>                                               
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="HotelAccountSetting" name="HotelAccountSetting" value="" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Abilitato PMS</label>
                                            </div>
                                            <div class="col-md-1">                                            	                                                     
                                                <input type="checkbox" class="form-control" id="PMS" name="PMS" value="1" checked="checked"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Abilitato Booking</label>
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
                                        $("#form_bedzzle").submit(function () {   
                                            var  UrlHost                  = $("#UrlHost").val(); 
                                            var  ProxyAuth                = $("#ProxyAuth").val(); 
                                            var  VendorAccount            = $("#VendorAccount").val(); 
                                            var  HotelAccount             = $("#HotelAccount").val();
                                            var  UrlHostSetting           = $("#UrlHostSetting").val(); 
                                            var  ProxyAuthSetting         = $("#ProxyAuthSetting").val(); 
                                            var  VendorAccountSetting     = $("#VendorAccountSetting").val(); 
                                            var  HotelAccountSetting      = $("#HotelAccountSetting").val();
                                            var  Abilitato                = $("#Abilitato").val();
                                            var  PMS                      = $("#PMS").val();           
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/aggiungi_bedzzle.php",
                                                type: "POST",
                                                data: "action=add_be&idsito='.IDSITO.'&UrlHost="+UrlHost+"&ProxyAuth="+ProxyAuth+"&VendorAccount="+VendorAccount+"&HotelAccount="+HotelAccount+"&UrlHostSetting="+UrlHostSetting+"&ProxyAuthSetting="+ProxyAuthSetting+"&VendorAccountSetting="+VendorAccountSetting+"&HotelAccountSetting="+HotelAccountSetting+"&PMS="+PMS+"&Abilitato="+Abilitato+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleBedzzle").modal("hide");
                                                    $("#bedzzle").DataTable().ajax.reload();    
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
               <table id="bedzzle" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='          
                            <th>Url API</th>
                            <th>Proxy Auth (key)</th>
                            <th>Vendor Account (API KEY)</th>
                            <th>Hotel Account</th>
                            <th>Url API Setting</th>
                            <th>Proxy Auth (key) Setting</th>
                            <th>Vendor Account (API KEY) Setting</th>
                            <th>Hotel Account Setting</th>
                            <th>Abilitato PMS</th>
                            <th>Abilitato Booking</th>
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
                    $("#ModaleBedzzle").modal("show");
                });

                $("#Abilitato").click(function() {
                    if($("#Abilitato").is(":checked")){
                        $("#Abilitato").attr("value","1");
                    }else{
                        $("#Abilitato").attr("value",false);
                        $("#Abilitato").attr("checked",false);
                    }
                });

                $("#PMS").click(function() {
                    if($("#PMS").is(":checked")){
                        $("#PMS").attr("value","1");
                    }else{
                        $("#PMS").attr("value",false);
                        $("#PMS").attr("checked",false);
                    }
                });

                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();

                // CONFIG DATATABLE
                var table = $("#bedzzle").DataTable( {
                                                               
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
                               $("#ModaleBedzzle").modal("show");
                            }
                        },'."\r\n";
    }
        $content .='
                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/setting/bedzzle.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='     
                        { "data": "url_api", "class": "text-center"}, 
                        { "data": "proxy","class": "text-center"},        
                        { "data": "vendor" ,"class":"text-center"},
                        { "data": "account","class":"text-center"},
                        { "data": "url_api_setting", "class": "text-center"}, 
                        { "data": "proxy_setting","class": "text-center"},        
                        { "data": "vendor_setting" ,"class":"text-center"},
                        { "data": "account_setting","class":"text-center"},
                        { "data": "pms","class":"text-center"},
                        { "data": "abilitato","class":"text-center"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [1,2,3,4,5,6,7,8,9,10], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 0, \'DESC\' ] ).draw();
                    $("#bedzzle_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>