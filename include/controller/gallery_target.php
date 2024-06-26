<?php
$content .= '<div class="modal fade" id="ModaleGalleryTarget" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Aggiungi immagini per il target: '.urldecode($_REQUEST['param']).'</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" id="form_add_gallery_target" name="form_add_gallery_target">                                          
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-8">
                                                <span class="text-back f-12 text-center">Una volta scelto il file, cliccare sul pulsante "Upload"</span>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-photo"></i></span>
                                                    <input type="file" class="form-control"  name="file" id="file">
                                                    <button type="button" class="btn btn-mini" id="btn_add">Upload</button>
                                                </div>
                                                <div id="result_file"></div>
                                                <input type="hidden"  id="Immagine" name="Immagine" />
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>                            
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input type="hidden"  id="IdTipoGallery" name="IdTipoGallery" value="'.$_REQUEST['azione'].'" />
                                                <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                            </div>
                                        </div>
                                    </div>                                 
                                </form> 
                                <script>
                                $(document).ready(function() {

                                    //CARICO ICONA										
                                    $("#btn_add").on("click",function(){
                                        formdata = new FormData();
                                        if($("#file").prop(\'files\').length > 0)
                                        {
                                            file =$("#file").prop(\'files\')[0];
                                            formdata.append("file", file);
                                        }
                                        $.ajax({
                                            url: "' . BASE_URL_SITO . 'ajax/generiche/add_foto_gallery_target.php?idsito='.IDSITO.'",
                                            type: "POST",
                                            data: formdata,
                                            processData: false,
                                            contentType: false,
                                            success: function (risultato) {
                                                console.log(risultato);
                                                if(risultato != ""){
                                                    $("#Immagine").val(risultato);
                                                    $("#result_file").html("<small class=\"text-green\">Il file è stato caricato con successo!</small>");
                                                }else{
                                                    $("#result_file").html("<small class=\"text-red\">Prima di cliccare sul pulsante \"Upload\", scegli il file da caricare sul server!</small>");
                                                }
                                            }
                                        });
                                        return false;
                                    });                                        

                                    $("#form_add_gallery_target").submit(function () {  
                                        var Immagine      = $("#Immagine").val(); 
                                        var IdTipoGallery = $("#IdTipoGallery").val(); 
                                        $.ajax({
                                            url: "'.BASE_URL_SITO.'ajax/generiche/aggiungi_foto_gallery_target.php",
                                            type: "POST",
                                            data: "action=add_foto_target&idsito='.IDSITO.'&Immagine="+Immagine+"&IdTipoGallery="+IdTipoGallery+"",
                                            dataType: "html",
                                            success: function(data) {
                                                $("#ModaleGalleryTarget").modal("hide");
                                                $("#add_gallery_target").DataTable().ajax.reload();    
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
$content .= '<div class="modal fade" id="ModalePhotoEditor" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi immagini per il target</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="https://fengyuanchen.github.io/photo-editor" scrolling="no" marginwidth="0px" marginheight="0px" widht="800px" height="600px" style="widht:800px"></iframe>                           
                        </div>
                    </div>
                </div>           
            </div>'."\r\n";


# INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
               <table id="add_gallery_target" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';
$content .='          
                            <th>Immagine</th>
                            <th>Abilitata</th>
                            <th style="width:4%"></th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                #add_gallery_target_filter{
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
                var table = $("#add_gallery_target").DataTable( {
                                                               
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
                            text:      \'<i class="fa fa-angle-double-left fa-2x fa-fw"></i> Torna alla Gallery\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'tornaIndietro\'},
                            action: function () {
                                document.location=\''.BASE_URL_SITO.'generiche-gallery/\';
                            }
                        },

                        {
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi immagine per target\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                                $("#ModaleGalleryTarget").modal("show");
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
                    "ajax": "'.BASE_URL_SITO.'crud/generiche/add_galleria_target.crud.php?idsito='.IDSITO.'&id='.$_REQUEST['azione'].'&etichetta='.urlencode($_REQUEST['param']).'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='   
                        { "data": "immagine","class":"text-left"},
                        { "data": "abilitato","class":"text-center"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,1,2], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 0, \'ASC\' ] ).draw();
                    $("#add_gallery_target_processing").removeClass("card"); '."\r\n";


$content .='})
        </script>';
?>       