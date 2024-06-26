<?php
#VARIABILI
$testi_inseriti = $fun->ContoTestiServiziAggiuntivi($_REQUEST['azione'],IDSITO);
# INSERT TESTI
$content .= '<div class="modal fade" id="ModaleServiziAggiuntivi" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Aggiungi contenuti per Servizio</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">

                                <form method="POST" id="form_add_servizi_aggiuntivi" name="form_add_servizi_aggiuntivi" method="POST">                                          
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Lingua</label>
                                            </div>
                                            <div class="col-md-9">
                                                    '.$fun->SelectLingue('lingue','lingue','').'
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Servizio</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" name="Servizio" id="Servizio" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Descrizione</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <textarea class="form-control Width100" id="Descrizione"  name="Descrizione" style="height:150px"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input type="hidden" name="servizio_id" id="servizio_id" value="'.$_REQUEST['azione'].'">
                                                <input type="hidden" name="idsito"  value="'.IDSITO.'">
                                                <input type="hidden" name="action"  value="add_servizi_aggiuntivi">
                                                <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                            </div>
                                        </div>
                                    </div>                                 
                                </form>
                                <script>
                                    $(document).ready(function() {
                                        $("#form_add_servizi_aggiuntivi").submit(function () {   
                                            var  lingua       = $("#lingue option:selected").val(); 
                                            var  Servizio     = $("#Servizio").val(); 
                                            var  servizio_id   = $("#servizio_id").val();  
                                            var  Descrizione   = $("#Descrizione").val(); 
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/disponibilita/aggiungi_testo_servizio_aggiuntivo.php",
                                                type: "POST",
                                                data: "action=add_t_servizio&idsito='.IDSITO.'&lingua="+lingua+"&Servizio="+Servizio+"&servizio_id="+servizio_id+"&Descrizione="+Descrizione+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleServiziAggiuntivi").modal("hide");
                                                    $("#add_servizi_aggiuntivi").DataTable().ajax.reload();    
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
               <table id="add_servizi_aggiuntivi" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';
$content .='          
                            <th style="width:20%">Lingua</th>
                            <th>Servizio</th>
                            <th>Descrizione</th>
                            <th style="width:4%"></th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                #add_servizi_aggiuntivi_filter{
                    display: none !important;
                }
                .buttons-collection{
                    display: none !important;
                }
                #add_servizi_aggiuntivi_info{
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
                var table = $("#add_servizi_aggiuntivi").DataTable( {
                                                               
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
                            text:      \'<i class="fa fa-angle-double-left fa-2x fa-fw"></i> Torna ai Servizi Aggiuntivi\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'tornaIndietro\'},
                            action: function () {
                                document.location=\''.BASE_URL_SITO.'disponibilita-servizi_aggiuntivi/\';
                            }
                        },'."\r\n";
    if($testi_inseriti < 4){
        $content .='     {
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi testo servizio\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                                $("#ModaleServiziAggiuntivi").modal("show");
                            }
                        },'."\r\n";
    }
        $content .='   \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/disponibilita/add_servizi_aggiuntivi.crud.php?idsito='.IDSITO.'&id='.$_REQUEST['azione'].'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "lingua","class":"text-center"},        
                        { "data": "servizio","class":"text-left"},
                        { "data": "descrizione","class":"text-left"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,1,2,3], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 0, \'ASC\' ] ).draw();
                    $("#add_servizi_processing").removeClass("card");'."\r\n";


$content .='})
        </script>';
?>


        