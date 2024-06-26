<?php
# PULSANTE AGGIUNGI
$n=1;
$content .=' <div class="modal fade" id="ModaleDomande" tabindex="-1" role="dialog" aria-labelledby="ModaleTargetLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi Domande</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                <form method="POST" id="form_add_domande" name="form_add_domande">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3 nowrap">
                                                <label>Domanda</label>
                                            </div>
                                            <div class="col-md-9">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-question fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="Domanda" name="Domanda" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3 nowrap">
                                                <label>Ordine</label>
                                            </div>
                                            <div class="col-md-9">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                                                    <select class="form-control" id="Ordine" name="Ordine">
                                                        <option value="">--</option>';
                            for($n==1; $n<=50; $n++){
                                $content .='           <option value="'.$n.'">'.$n.'</option>';
                            }
$content .='                                        </select>
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
                                        $("#form_add_domande").submit(function () {   
                                            var  Domanda         = $("#Domanda").val();
                                            var  Ordine          = $("#Ordine option:selected").val(); 
                                            var  abilitato       = $("#Abilitato").val(); 
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/aggiungi_domande.php",
                                                type: "POST",
                                                data: "action=add_do&idsito='.IDSITO.'&Domanda="+Domanda+"&abilitato="+abilitato+"&Ordine="+Ordine+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleDomande").modal("hide");
                                                    $("#domande").DataTable().ajax.reload();    
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
               <table id="domande" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='          
                            <th>Domanda</th>
                            <th>Domande presenti</th>
                            <th style="width:5%">Ordine</th>
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
                var table = $("#domande").DataTable( {
                    order: [[2, \'asc\']],                           
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
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi domande\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                                $("#ModaleDomande").modal("show");
                            }
                        },
                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/setting/domande.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "domanda"},
                        { "data": "testi","class":"text-center"},  
                        { "data": "ordine","type": "formatted-num","class":"text-center"},
                        { "data": "abilitato","class":"text-center"},         
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,1,3,4], "orderable": false} 

                        ]
                    })
    
                    $("#domande_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>


        