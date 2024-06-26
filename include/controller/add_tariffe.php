<?php
#VARIABILI
$testi_inseriti = $fun->ContoTestiTariffe($_REQUEST['azione'],IDSITO);
# INSERT TESTI
$content .= '<div class="modal fade" id="ModaleTariffe" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Aggiungi contenuti per le Condizioni Tariffarie e Politiche di Cancellazione</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">

                                <form method="POST" id="form_tariffe" name="form_tariffe" method="POST">                                          
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Lingua</label>
                                            </div>
                                            <div class="col-md-9">
                                                    '.$fun->SelectLingue('Lingua','Lingua','').'
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Tariffa</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" name="tariffa" id="tariffa" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Condizioni Tariffa</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <textarea class="form-control Width100" id="testo" rows="10" name="testo" style="height:350px"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input type="hidden" name="id_tariffe" id="id_tariffe" value="'.$_REQUEST['azione'].'">
                                                <input type="hidden" name="idsito"  value="'.IDSITO.'">
                                                <input type="hidden" name="action"  value="add_tariffe">
                                                <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                            </div>
                                        </div>
                                    </div>                                 
                                </form>
                                <script>
                                    $(document).ready(function() {
                                        $("#form_tariffe").submit(function () {   
                                            var  lingua   = $("#Lingua option:selected").val(); 
                                            var  tariffa  = $("#tariffa").val(); 
                                            var  testo    = $("#testo").val();  
                                            var  id_tariffe = $("#id_tariffe").val();  
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/aggiungi_testo_tariffe.php",
                                                type: "POST",
                                                data: "action=add_t_ta&idsito='.IDSITO.'&lingua="+lingua+"&tariffa="+tariffa+"&testo="+testo+"&id_tariffe="+id_tariffe+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleTariffe").modal("hide");
                                                    $("#add_tariffe").DataTable().ajax.reload();    
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
               <table id="add_tariffe" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';
$content .='          
                            <th style="width:10%">Lingua</th>
                            <th>Tariffa</th>
                            <th>Condizioni Tariffa</th>
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
                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();

                // CONFIG DATATABLE
                var table = $("#add_tariffe").DataTable( {
                                                               
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
                            text:      \'<i class="fa fa-angle-double-left fa-2x fa-fw"></i> Torna alle Tariffe\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'tornaIndietro\'},
                            action: function () {
                                document.location=\''.BASE_URL_SITO.'disponibilita-tariffe/\';
                            }
                        },'."\r\n";
    if($testi_inseriti < 4){
        $content .='     {
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi codizioni tariffarie\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                                $("#ModaleTariffe").modal("show");
                            }
                        },'."\r\n";
    }
        $content .='   \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/setting/add_tariffe.crud.php?idsito='.IDSITO.'&id='.$_REQUEST['azione'].'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "lingua","class":"text-center"},        
                        { "data": "tariffa","class":"text-left"},
                        { "data": "testo","class":"text-left"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,1,2,3], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 0, \'ASC\' ] ).draw();
                    $("#add_tariffe_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>


        