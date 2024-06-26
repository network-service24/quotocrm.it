<?php
#VARIABILI
$testi_inseriti = $fun->ContoTestiOggettoCheckin($_REQUEST['azione'],IDSITO);
# INSERT TESTI
$content .= '<div class="modal fade" id="ModaleOggettoCheckin" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Aggiungi contenuti per Oggetto Mail del Modulo Check-In Online</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">

                                <form method="POST" id="form_oggetto_checkin" name="form_oggetto_checkin" method="POST">                                          
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
                                                <label>Oggetto</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="testo" name="testo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input type="hidden" name="id_dizionario" id="id_dizionario" value="'.$_REQUEST['azione'].'">
                                                <input type="hidden" name="idsito"  value="'.IDSITO.'">
                                                <input type="hidden" name="action"  value="add_oggetto_checkin">
                                                <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                            </div>
                                        </div>
                                    </div>                                 
                                </form>
                                <script>
                                    $(document).ready(function() {
                                        $("#form_oggetto_checkin").submit(function () {   
                                            var  lingua         = $("#Lingua option:selected").val(); 
                                            var  oggetto        = $("#testo").val();  
                                            var  id_dizionario  = $("#id_dizionario").val();  
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/autoresponder/aggiungi_testo_oggetto_checkin.php",
                                                type: "POST",
                                                data: "action=add_t_checkin&idsito='.IDSITO.'&lingua="+lingua+"&oggetto="+oggetto+"&id_dizionario="+id_dizionario+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleOggettoCheckin").modal("hide");
                                                    $("#add_oggetto_checkin").DataTable().ajax.reload();    
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
               <table id="add_oggetto_checkin" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';
$content .='          
                            <th style="width:10%">Lingua</th>
                            <th>Oggetto</th>
                            <th style="width:4%"></th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                #add_oggetto_checkin_filter{
                    display: none !important;
                }
                .buttons-collection{
                    display: none !important;
                }
                #add_oggetto_checkin_info{
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
                var table = $("#add_oggetto_checkin").DataTable( {
                                                               
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
                            text:      \'<i class="fa fa-angle-double-left fa-2x fa-fw"></i> Torna alla configurazione del Check-In Online\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'tornaIndietro\'},
                            action: function () {
                                document.location=\''.BASE_URL_SITO.'autoresponder-configura_checkin/\';
                            }
                        },'."\r\n";
    if($testi_inseriti < 4){
        $content .='     {
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi testo oggetto\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                                $("#ModaleOggettoCheckin").modal("show");
                            }
                        },'."\r\n";
    }
        $content .='   \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/autoresponder/add_oggetto_checkin.crud.php?idsito='.IDSITO.'&id='.$_REQUEST['azione'].'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "lingua","class":"text-center"},        
                        { "data": "oggetto","class":"text-left"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,1,2], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table.order( [ 0, \'ASC\' ] ).draw();
                    $("#add_oggetto_checkin_processing").removeClass("card"); '."\r\n";


$content .='})
        </script>';
?>


        