<?php
# PULSANTE AGGIUNGI

$content .=' <div class="modal fade" id="ModaleOperatori" tabindex="-1" role="dialog" aria-labelledby="ModaleOperatoriLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi Operatore</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                <form method="POST" id="form_ass_op" name="form_ass_op">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Immagine Operatore</label>
                                            </div>
                                            <div class="col-md-8">
                                                <small class="text-info">Una volta scelto il file, non dimenticare di cliccare sul pulsante "Upload"</small>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-photo"></i></span>
                                                <input type="file" class="form-control"  name="file_img" id="file_img">
                                                <button type="button" class="btn btn-mini" id="btn_upload">Upload</button>
                                                </div>
                                                <div id="result_file"></div>
                                                <input type="hidden"  id="img" name="img" />
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Nome Operatore</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="NomeOperatore" name="NomeOperatore" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                     <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Email Operatore</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="EmailSegretaria" name="EmailSegretaria" required />
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
                                        $("#btn_upload").on("click",function(){
                                            formdata = new FormData();
                                            if($("#file_img").prop(\'files\').length > 0)
                                            {
                                                file = $("#file_img").prop(\'files\')[0];
                                                formdata.append("file_img", file);
                                            }
                                            $.ajax({
                                                url: "' . BASE_URL_SITO . 'ajax/generici/upload_img_operatore.php?idsito='.IDSITO.'",
                                                type: "POST",
                                                data: formdata,
                                                processData: false,
                                                contentType: false,
                                                success: function (result) {
                                                    console.log(result);
                                                    if(result != ""){                                               
                                                        $("#img").val(result);
                                                        $("#result_file").html("<small class=\"text-green\">Il file è stato caricato con successo!</small>");
                                                    }else{
                                                        $("#result_file").html("<small class=\"text-red\">Prima di cliccare sul pulsante \"Upload\", scegli il file da caricare sul server!</small>");
                                                    }
                                                }
                                            });
                                            return false;
                                        });
                                        $("#form_ass_op").submit(function () {   
                                            var  NomeOperatore  = $("#NomeOperatore").val(); 
                                            var  EmailOperatore = $("#EmailSegretaria").val(); 
                                            var  img            = $("#img").val();
                                            var  Abilitato      = 1;         
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/aggiungi_operatore.php",
                                                type: "POST",
                                                data: "action=add_op&idsito='.IDSITO.'&NomeOperatore="+NomeOperatore+"&EmailOperatore="+EmailOperatore+"&Abilitato="+Abilitato+"&img="+img+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleOperatori").modal("hide");
                                                    $("#operatori").DataTable().ajax.reload();    
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
               <table id="operatori" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='          
                            <th>Immagine Opeatore</th>
                            <th>Nome Operatore</th>
                            <th>Email operatore</th>
                            <th>Abilitato</th>
                            <th></th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                #operatori_filter{
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
                $("#aggiungi").on("click",function(){
                    $("#ModaleOperatori").modal("show");
                });

                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();

                // CONFIG DATATABLE
                var table = $("#operatori").DataTable( {
                                                               
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
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi operatore\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                                $("#ModaleOperatori").modal("show");
                            }
                        },                          
                        {
                            text:      \'<t data-toggle="tooltip" title="Editor per ridimensionare, croppare, tagliare le immagini"><i class="fa fa-photo fa-2x fa-fw"></i> Free Photo Editor Crop</t>\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                                /*$("#ModalePhotoEditor").modal("show");*/
                                window.open("https://fengyuanchen.github.io/photo-editor","PhotoEditor","left=500,top=200,width=1024,height=768");
                            },
                        }, 
                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/setting/operatori.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "img"},  
                        { "data": "nome"},        
                        { "data": "email"},
                        { "data": "abilitato" ,"class":"text-center"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,2,3,4], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 1, \'ASC\' ] ).draw();
                    $("#operatori_processing").removeClass("card");'."\r\n";


$content .='})
        </script>';
?>