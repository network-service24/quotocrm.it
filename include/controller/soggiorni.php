<?php
$legenda = '<div class="clearfix p-b-20"></div>
            <ul>
                <li> <b>ATTENZIONE ad eliminare delle tipologie di soggiorno</b>: </li>
                <li> perchè così facendo se avete già una attività di preventivi e/o prenotazioni in corso, <b>andreste a svuotare le proposte di soggiorno in produzione</b> e le relative statistiche!</li>
                <li> se dopo la prima sincronizzazione vengono modificati i nomi soggiorno o i testi di quelli già presenti; è neccessario modificare manualmente gli stessi anche su QUOTO!</li>
            </ul>';
            
    if(FORM_SUL_SITO==1){
        $FormMsg .='<ul>';
        $FormMsg .='<li>Per chi ha integrato nel proprio sito il <em>"form dedicato a QUOTO"</em> <b>API version</b>, potete utilizzare il flag di Abilita voce nel form/Disabilita voce nel form, per la lista dei soggiorni!</li>';                     
        $FormMsg .='<li><img src="'.BASE_URL_SITO.'img/si_no.png"> Abilitato nel form, non visibile nel crea proposta</li>';
        $FormMsg .='<li><img src="'.BASE_URL_SITO.'img/no_si.png"> non visibile nel form, visibile nel crea proposta</li>';
        $FormMsg .='</ul>';
    }  

    $parity = $fun->check_parity(IDSITO);

    if($parity != '0'){
        if($fun->check_soggiorni_parity(IDSITO) == 0){
            $SyncroMsg = '<p class="text-right"><a href="'.BASE_URL_SITO.'get_config_parity/sync/" class="btn bg-green btn-sm" id="resynchBtn"><i class="fa fa-refresh"></i>  Synch ParityRate</a> <br><small>Sincronizza la prima volta le tipologie di soggiorono del Channel Manager Parity Rate!</small></p>';
        }else{
            $SyncroMsg = '<p class="text-right"><a href="'.BASE_URL_SITO.'get_config_parity/sync/" class="btn bg-orange btn-sm" id="resynchBtn"><i class="fa fa-refresh"></i>  Re-Synch ParityRate</a> <br><small>Ri-sincronizza le tipologie di soggiorono del Channel Manager Parity Rate!</small></p>';

        }

        $ThColumn  ='<th>Tipo Soggiorno su ParityRate <i class="fa fa-info-circle text-black cursore" data-toggle="tooltip" title="Abbinamento tipologia Soggiorno su ParityRate"></i></th>'."\r\n";
        $ThContent = '{ "data": "plancode"},'."\r\n";

    }

    if($_REQUEST['azione'] == 'ok') {
        $msg .= '<div class="alert alert-success" id="res_back">
                        <i class="fa fa-check"></i> Syncro avvenuta con successo.
                    </div>';
        $msg .= '<script>
                    $(document).ready(function() {
                            setTimeout(function(){
                                $(\'#res_back\').hide();
                            },3000);
                    });
                </script> '."\r\n";
    }
# CONFIG IN BASE HAI BOOOKING O AI PMS ATTIVI

if($fun->check_simplebooking(IDSITO)==1){

    $ThColumn  ='<th>PlanCode SB <i class="fa fa-info-circle text-black cursore" data-toggle="tooltip" title="Codice Tipo Soggiorno di SimpleBooking"></i></th>'."\r\n";
    $ThContent = '{ "data": "plancode"},'."\r\n";

}
if($fun->check_ericsoftbooking(IDSITO)==1){

    $ThColumn  ='<th>PlanCode EB <i class="fa fa-info-circle text-black cursore" data-toggle="tooltip" title="Codice Tipo Soggiorno di EricsoftBooking"></i></th>'."\r\n";
    $ThContent = '{ "data": "plancode"},'."\r\n";
    
}   
if($fun->check_bedzzlebooking(IDSITO)==1){

    $ThColumn  ='<th>PlanCode BedzzleB <i class="fa fa-info-circle text-black cursore" data-toggle="tooltip" title="Codice Tipo Soggiorno di Bedzzle Booking"></i></th>'."\r\n";
    $ThContent = '{ "data": "plancode"},'."\r\n";

}
if($fun->check_pms_bedzzle(IDSITO)==1){

    $ThColumn  ='<th>Tipo Soggiorno sul PMS <i class="fa fa-info-circle text-black cursore" data-toggle="tooltip" title="Abbinamento tipologia di Soggiorno con il PMS"></i></th>'."\r\n";
    $ThContent = '{ "data": "plancode"},'."\r\n";

}
 if ($fun->check_parity(IDSITO)){
    $ThColumn  ='<th>Tipo Soggiorno sul PMS <i class="fa fa-info-circle text-black cursore" data-toggle="tooltip" title="Abbinamento tipologia di Soggiorno con il PMS"></i></th>'."\r\n";
    $ThContent = '{ "data": "plancode"},'."\r\n";
} 

# PULSANTE AGGIUNGI
$content .=' <div class="modal fade" id="ModaleSoggiorni" tabindex="-1" role="dialog" aria-labelledby="ModaleTargetLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi Tipologia di Soggiorno</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                <form method="POST" id="form_add_soggiorni" name="form_add_soggiorni">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3 nowrap">
                                                <label>Tipo Soggiorno</label>
                                            </div>
                                            <div class="col-md-9">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-suitcase fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="TipoSoggiorno" name="TipoSoggiorno" required/>
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

                                        $("#Abilitato").click(function() {
                                            if($("#Abilitato").is(":checked")){
                                                $("#Abilitato").attr("value","1");
                                            }else{
                                                $("#Abilitato").attr("value",0);
                                                $("#Abilitato").attr("checked",0);
                                            }
                                        });

                                        $("#form_add_soggiorni").submit(function () {   
                                            var  TipoSoggiorno   = $("#TipoSoggiorno").val();
                                            var  Abilitato       = $("#Abilitato").val(); 
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/disponibilita/aggiungi_soggiorno.php",
                                                type: "POST",
                                                data: "action=add_soggiorno&idsito='.IDSITO.'&TipoSoggiorno="+TipoSoggiorno+"&Abilitato="+Abilitato+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleSoggiorni").modal("hide");
                                                    $("#soggiorni").DataTable().ajax.reload();    
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
               <table id="soggiorni" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='                '.$ThColumn.'
                            <th>Soggiorno</th>
                            <th>Testi presenti</th>
                            <th>Listino</th>
                            <th>Abilitato</th>
                            <th style="width:4%"></th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                #soggiorni_filter {
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
                var table = $("#soggiorni").DataTable( {
                          
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
							[ 15, 30, -1 ],
							[  \'15 record\', \'30 record\', \'Tutti\' ]
                        ],	
                        buttons: [
                        {
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi soggiorni\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                                $("#ModaleSoggiorni").modal("show");
                            }
                        },
                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/disponibilita/soggiorni.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    '.$ThContent.'
                        { "data": "soggiorno"},
                        { "data": "testi","class":"text-center"},  
                        { "data": "listino","class":"text-center"},
                        { "data": "abilitato","class":"text-center"},      
                        { "data": "action","class":"text-center"}
                    ],';
                    
                if ($fun->check_simplebooking(IDSITO)==1 ||
                    $fun->check_ericsoftbooking(IDSITO)==1 ||
                    $fun->check_bedzzlebooking(IDSITO)==1 ||
                    $fun->check_pms_bedzzle(IDSITO)==1 ||
                    $fun->check_parity(IDSITO)==1){      

        $content .='    "columnDefs": [
                              {"targets": [0,1,2,3,4,5], "orderable": false} 

                        ]
                    })';

                }else{

        $content .='    "columnDefs": [
                            {"targets": [0,1,2,3,4], "orderable": false} 

                        ]
                    })';   
                                     
                }
    
        $content .='
                    $("#soggiorni_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>