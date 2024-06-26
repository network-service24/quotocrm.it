<?php

# PULSANTE AGGIUNGI Portale,ServerEmail,UserEmail,PasswordEmail,HotelID,Type,UrlApi

$content .=' <div class="modal fade" id="ModaleImap" tabindex="-1" role="dialog" aria-labelledby="ModaleImapLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi Codici per IMAP</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                <form method="POST" id="form_imap" name="form_imap">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Portale</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                    <select class="form-control" id="Portale" name="Portale" required>
                                                        <option value="" selected="selected">---</option>
                                                        <option value="info-alberghi.com">info-alberghi.com</option>
                                                        <option value="gabiccemare.com">gabiccemare.com</option>
                                                        <option value="italyfamilyhotels.it">italyfamilyhotels.it</option>
                                                        <option value="riccioneinhotel.com">riccioneinhotel.com</option>
                                                        <option value="cesenaticobellavita.it">cesenaticobellavita.it</option>
                                                        <option value="familygo.eu">familygo.eu</option>
                                                        <option value="italybikehotels.it">italybikehotels.it</option>
                                                        <option value="spahotelscollection.it">spahotelscollection.it</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="campi_portali"> 
                                        <div class="form-group">  
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Server Email</label>
                                                </div>
                                                <div class="col-md-8">                                            	                                                     
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                        <input type="text" class="form-control" id="ServerEmail" name="ServerEmail" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group">  
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>User Email</label>
                                                </div>
                                                <div class="col-md-8">                                            	                                                     
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                        <input type="text" class="form-control" id="UserEmail" name="UserEmail"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">  
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>
                                                        Password Email
                                                    </label>                                               
                                                </div>
                                                <div class="col-md-8">                                            	                                                     
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                        <input type="text" class="form-control" id="PasswordEmail" name="PasswordEmail"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="campi_info_alberghi">
                                        <div class="form-group">  
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>
                                                        Hotel ID
                                                    </label>                                               
                                                </div>
                                                <div class="col-md-8">                                            	                                                     
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                        <input type="text" class="form-control" id="HotelID" name="HotelID"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">  
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>
                                                        Type
                                                    </label>                                               
                                                </div>
                                                <div class="col-md-8">                                            	                                                     
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                        <select class="form-control" id="Type" name="Type" >
                                                            <option value="">--</option>
                                                            <option value="tutte" selected="selected">tutte</option>
                                                            <option value="diretta">diretta</option>
                                                            <option value="multipla">multipla</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">  
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>
                                                        UrlApi
                                                    </label>                                               
                                                </div>
                                                <div class="col-md-8">                                            	                                                     
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                        <select class="form-control" id="UrlApi" name="UrlApi" >
                                                            <option value="">--</option>
                                                            <option value="https://api.alberghi.it/api/getEmailAll" selected="selected">https://api.alberghi.it/api/getEmailAll</option>
                                                            <option value="https://api.alberghi.it/api/getEmail">https://api.alberghi.it/api/getEmail</option>
                                                            <option value="https://api.alberghi.it/api/getEmailToday">https://api.alberghi.it/api/getEmailToday</option>
                                                        </select>
                                                    </div>
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

                                        $("#campi_info_alberghi").hide();

                                        $("#Portale").on("change",function () {  
                                            var  valore  = $("#Portale option:selected").val(); 

                                            if(valore == "info-alberghi.com"){
                                                $("#campi_info_alberghi").show();
                                                $("#campi_portali").hide();
                                            }else{
                                                $("#campi_portali").show();
                                                $("#campi_info_alberghi").hide();
                                            }
                                        });

                                        $("#form_imap").submit(function () {   
                                             var  Portale                            = $("#Portale option:selected").val(); 
                                             var  ServerEmail                        = $("#ServerEmail").val(); 
                                             var  UserEmail                          = $("#UserEmail").val(); 
                                             var  PasswordEmail                      = $("#PasswordEmail").val(); 
                                             var  HotelID                            = $("#HotelID").val();
                                             var  Type                               = $("#Type option:selected").val(); 
                                             var  UrlApi                             = $("#UrlApi option:selected").val(); 
                                             var  Abilitato                          = $("#Abilitato").val();          
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/aggiungi_imap.php",
                                                type: "POST",
                                                data: "action=add_im&idsito='.IDSITO.'&Portale="+Portale+"&ServerEmail="+ServerEmail+"&UserEmail="+UserEmail+"&PasswordEmail="+PasswordEmail+"&HotelID="+HotelID+"&Type="+Type+"&UrlApi="+UrlApi+"&Abilitato="+Abilitato+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleImap").modal("hide");
                                                    $("#imap").DataTable().ajax.reload();    
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
               <table id="imap" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='          
                            <th>Portale</th>
                            <th>Server E-mail</th>
                            <th>Username E-mail</th>
                            <th>Password E-mail</th>
                            <th>Hotel ID</th>
                            <th>Type</th>
                            <th>Url API</th>
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
                    $("#ModaleImap").modal("show");
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
                var table = $("#imap").DataTable( {
                                                               
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
                            '."\r\n";
 
        $content .='     {
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                               $("#ModaleImap").modal("show");
                            }
                        },'."\r\n";
 
        $content .='
                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/setting/imap.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='     
                        { "data": "portale", "class": "text-center"}, 
                        { "data": "server","class": "text-center"},        
                        { "data": "user" ,"class":"text-center"},
                        { "data": "pass","class":"text-center"},
                        { "data": "hotelid","class":"text-center"},
                        { "data": "type","class":"text-center"},
                        { "data": "url_api","class":"text-center"},
                        { "data": "abilitato","class":"text-center"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [1,2,3,4,5,6,7,8], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 0, \'DESC\' ] ).draw();
                    $("#imap_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';

$js_ajax = '
    <script>
        function ajaxdata(){
            $.ajax({
                    url: "'.BASE_URL_SITO.'ajax/imap/insert_ora_import.php",
                    type: "POST",
                    data: "idsito='.IDSITO.'",
                    dataType: "html",
                    success: function(data) {
                            //$("#id_ora_export").html(data);
                        }
                });
                return false; // con false senza refresh della pagina
        }

        $(".btn.btn-success.xcrud-action").click(function(){
            var task = $(this).attr(\'data-task\');
            if (task == \'create\') {
                setInterval(ajaxdata(), 1000);
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $(\'#openBtn\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/imap/check_imap.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });
            $(\'#openBtn2\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/imap/check_imap2.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo2").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });
            $(\'#openBtn3\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/imap/check_imap3.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo3").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });
            $(\'#openBtn4\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/imap/check_imap4.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo4").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });
            $(\'#openBtn5\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/imap/check_imap5.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo5").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });
            $(\'#openBtn6\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/imap/check_imap6.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo6").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });
            $(\'#openBtn7\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/imap/check_imap7.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo7").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });
            $(\'#openBtn8\').click(function(){
                var idsito   = '.IDSITO.';
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/imap/check_imap8.php",
                    data: "idsito=" + idsito,
                    dataType: "html",
                    success: function(data){
                        $("#controllo8").html(data);
                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            });

        });
    </script> '."\r\n";


?>