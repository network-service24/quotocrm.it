<?php
# PULSANTE AGGIUNGI

$content .=' <div class="modal fade" id="ModaleInfoBox" tabindex="-1" role="dialog" aria-labelledby="ModaleTargetLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi InfoBox Tag nel template</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                <form method="POST" id="form_add_info_box" name="form_add_info_box">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3 nowrap">
                                                <label>Titolo</label>
                                            </div>
                                            <div class="col-md-9">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-sticky-note-o fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="Titolo" name="Titolo" required/>
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
                                        $("#form_add_info_box").submit(function () {   
                                            var  titolo          = $("#Titolo").val(); 
                                            var  abilitato       = $("#Abilitato").val(); 
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/aggiungi_info_box.php",
                                                type: "POST",
                                                data: "action=add_ib&idsito='.IDSITO.'&titolo="+titolo+"&abilitato="+abilitato+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleInfoBox").modal("hide");
                                                    $("#info_box").DataTable().ajax.reload();  
                                                    refresh_calc();  
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
               <table id="info_box" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='          
                            <th>Titolo</th>
                            <th>Testi presenti</th>
                            <th style="width:10%">Associa Template</th>
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

            function refresh_calc(){

                setTimeout(function(){ 
                    var val_tmp     = $("#info_box_info").text();
                    var array_count = val_tmp.split(" ");
                    var count       = array_count[6];
                    if(count == "entries"){
                        count = 0;
                    }
                    $("#count_infobox").text(count);
                    if(count >= '.NUM_INFOBOXTAG.'){
                        $(".buttonSelezioni").hide();                        
                    }else{
                        $(".buttonSelezioni").show();
                    }
                    }, 2000);

            }

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

                // CALCOLO I RECORD TOTALE INSERITI
                setTimeout(function(){ 
                    var val_tmp     = $("#info_box_info").text();
                    var array_count = val_tmp.split(" ");
                    var count       = array_count[6];
                    if(count == "entries"){
                        count = 0;
                    }
                    $("#count_infobox").text(count);
                    if(count >= '.NUM_INFOBOXTAG.'){
                        $(".buttonSelezioni").hide();
                    }else{
                        $(".buttonSelezioni").show();
                    }
                 }, 2000);

                // CONFIG DATATABLE
                var table = $("#info_box").DataTable( {
                   

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
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi InfoBox Tag\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                                $("#ModaleInfoBox").modal("show");
                            }
                     },
                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/setting/info_box.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "titolo"},  
                        { "data": "lingua","class":"text-center"},
                        { "data": "associa","class":"text-left"}, 
                        { "data": "abilitato","class":"text-center"},         
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,1,2,3], "orderable": false} 

                        ]

                    })

                    // ORDINAMENTO TABELLA
                    table.order( [ 0, \'ASC\' ] ).draw();
                    $("#info_box_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>


        