<?php

$booking_attivo = '';
$pms_attivo     = '';

$legenda = '<div class="clearfix p-b-20"></div>
            <ul class="text-left">
                <li> <b>ATTENZIONE ad eliminare delle camere</b>: </li>
                <li> perchè così facendo se avete già una attività di preventivi e/o prenotazioni in corso, <b>andreste a svuotare le proposte di soggiorno in produzione</b> e le relative statistiche!</li>
            </ul>';

if(FORM_SUL_SITO==1){
    $FormMsg .='<ul>';
    $FormMsg .='<li>Per chi ha integrato nel proprio sito il <em>"form dedicato a QUOTO"</em> <b>API version</b>, potete utilizzare il flag di visibile/non visibile per la lista delle camere!</li>';                     
    $FormMsg .='<li><img src="'.BASE_URL_SITO.'img/si_no.png"> visibile nel form, non visibile nel crea proposta</li>';
    $FormMsg .='<li><img src="'.BASE_URL_SITO.'img/no_si.png"> non visibile nel form, visibile nel crea proposta</li>';
    $FormMsg .='</ul>';
  }  

    if($REQUEST['azione'] == 'ok') {
        $msg = '<div class="alert alert-success" id="res_back">
                    <i class="fas fa-check"></i> Syncro avvenuta con successo.
                </div>
                <script>
                    $(document).ready(function() {
                            setTimeout(function(){
                                $(\'#res_back\').hide();
                            },3000);
                    });
                </script> ';
    }


    if($fun->check_simplebooking(IDSITO)==1){
        $SbMsg ='<p class="text-right"><a href="'.BASE_URL_SITO.'update_syncro_sb/cm/" class="btn bg-purple btn-sm" id="resynchBtn">Re-Synch</a> <br><small>Ri-sincronizza le camere se hai aggiunto una o più tipologie nuove su SimpleBooking!</small></p>
                <p class="text-right"><i class="fa fa-exclamation-circle text-red"></i> <small>Se il lancio della sincronia dovesse aggiungere nuove camere...,<b class="text-warning">ricordatevi di associare i servizi in camera, inserire i testi e le immagini delle camere</b> (perchè quelle caricate sono solo dei rendering generici)!</small></p>';
        if(IS_NETWORK_SERVICE_USER==1){
            $SbMsg .='<p class="text-right"><i class="fa fa-exclamation-triangle text-orange"></i> <small>Solo l\'operatore Network Service vede il pulsante per eliminare le camere sincronizzate, se dovesse essere neccessario re-sincronizzare da SimpleBooking:<br>per esempio se i nomi delle camere sono stati modificati, disabilitare le camere interessata, re-sincronizzare e successivamente eliminare le camere vecchie!</small></p>';
        }
        $ThColumn  ='<th>Camera S.B. <i class="fa fa-info-circle text-black cursore" data-toggle="tooltip" title="Codice Camera SimpleBooking"></i></th>'."\r\n";
        $ThContent = '{ "data": "RoomCode"},'."\r\n";
    }
    if($fun->check_ericsoftbooking(IDSITO)==1){
        $SbMsg ='<p class="text-right"><a href="'.BASE_URL_SITO.'update_syncro_eb/cm/" class="btn bg-light-blue btn-sm" id="resynchBtn">Re-Synch</a> <br><small>Ri-sincronizza le camere se hai aggiunto una o più tipologie nuove su Ericsoft Booking!</small></p>
                <p class="text-right"><i class="fa fa-exclamation-circle text-red"></i> <small>Se il lancio della sincronia dovesse aggiungere nuove camere...,<b class="text-warning">ricordatevi di associare i servizi in camera e le immagini delle camere</b>  (perchè quelle caricate sono solo dei rendering generici)!</small></p>';
        if(IS_NETWORK_SERVICE_USER==1){
            $SbMsg .='<p class="text-right"><i class="fa fa-exclamation-triangle text-orange"></i> <small>Solo l\'operatore Network Service vede il pulsante per eliminare le camere sincronizzate, se dovesse essere neccessario re-sincronizzare da Ericsoft Booking:<br>per esempio se i nomi delle camere sono stati modificati, disabilitare le camere interessata, re-sincronizzare e successivamente eliminare le camere vecchie!</small></p>';
        }
        $ThColumn  ='<th>Camera E.B.  <i class="fa fa-info-circle text-black cursore" data-toggle="tooltip" title="Codice Camera Ericsoft Booking"></i></th>'."\r\n";
        $ThContent = '{ "data": "RoomCode"},'."\r\n";
    }
    if($fun->check_bedzzlebooking(IDSITO)==1){
        $SbMsg ='<p class="text-right"><a href="'.BASE_URL_SITO.'update_syncro_bedzzle/cm/" class="btn btn-danger btn-sm" id="resynchBtn">Re-Synch</a> <br><small>Ri-sincronizza le camere se hai aggiunto una o più tipologie nuove su Bedzzle Booking/PMS!</small></p>
                <p class="text-right"><i class="fa fa-exclamation-circle text-red"></i> <small>Se il lancio della sincronia dovesse aggiungere nuove camere...,<b class="text-warning">ricordatevi di associare i servizi in camera e le immagini delle camere</b>  (perchè quelle caricate sono solo dei rendering generici)!</small></p>';
        if(IS_NETWORK_SERVICE_USER==1){
            $SbMsg .='<p class="text-right"><i class="fa fa-exclamation-triangle text-orange"></i> <small>Solo l\'operatore Network Service vede il pulsante per eliminare le camere sincronizzate, se dovesse essere neccessario re-sincronizzare da Bedzzle Booking:<br>per esempio se i nomi delle camere sono stati modificati, disabilitare le camere interessata, re-sincronizzare e successivamente eliminare le camere vecchie!</small></p>';
        }
        $ThColumn  ='<th>Camera B.B. <i class="fa fa-info-circle text-black cursore" data-toggle="tooltip" title="Codice Camera Bedzzle Booking"></i></th>'."\r\n";
        $ThContent = '{ "data": "RoomCode"},'."\r\n";
    }
    if($fun->check_pms_bedzzle(IDSITO)==1){
        $ThColumn2  ='<th>Abbina Camera con PMS  <i class="fa fa-info-circle text-black cursore" data-toggle="tooltip" title="Abbinamento tipologia di Camera con il PMS "></i></th>'."\r\n";
        $ThContent2 = '{ "data": "RoomTypePms","class":"nowrap"},'."\r\n";
    } 

    $tipo_pms  = $fun->check_pms(IDSITO);
    $tipo_pmsE = $fun->check_pms_ericsoft(IDSITO);
    $tipo_pmsB = $fun->check_pms_bedzzle(IDSITO);

    if($tipo_pms !='0'){
        $tipoP = 'C';
    }
    if($tipo_pmsE!='0'){
        $tipoP = 'E';
    }


    if($tipo_pms != '0'){
        if($fun->check_camere_pms(IDSITO) == 0){
            $SyncroMsg = '<p class="text-right"><a href="'.BASE_URL_SITO.'get_rooms_pms/sync/'.$tipoP.'/camere/" class="btn bg-orange btn-sm" id="resynchBtn">Synch PMS</a> <br><small>Sincronizza la prima volta le tipologie di camera del tuo PMS!</small></p>';
        }else{
            $SyncroMsg = '<p class="text-right"><a href="'.BASE_URL_SITO.'get_rooms_pms/sync/'.$tipoP.'/camere/" class="btn bg-green btn-sm" id="resynchBtn">Synch PMS</a> <br><small>Ri-sincronizza le tipologie di camera del tuo PMS!</small></p>';

        }
        $PmsMsg = '<p class="text-right"><small>Per poter visualizzare la <b>colonna PMS</b> nelle "<b>Prenotazioni confermate</b>", è neccessario <b>abbinare tutte le tipologie di camera</b> con il PMS!</small></p>';
    }
    if($tipo_pms != '0'){
        $ThColumn2  ='<th>Abbina Camera con PMS  <i class="fa fa-info-circle text-black cursore" data-toggle="tooltip" title="Abbinamento tipologia di Camera con il PMS "></i></th>'."\r\n";
        $ThContent2 = '{ "data": "RoomTypePms","class":"nowrap"},'."\r\n";
    }

    $parity = $fun->check_parity(IDSITO);

    if($parity == 1){
        if($fun->check_camere_parity(IDSITO) == 0){
            $SyncroMsg = '<p class="text-right"><a href="'.BASE_URL_SITO.'get_rooms_parity/sync/" class="btn bg-green btn-sm" id="resynchBtn"><i class="fa fa-refresh"></i> Synch ParityRate</a> <br><small>Sincronizza la prima volta le tipologie di camera del Channel Manager Parity Rate!</small></p>';
        }else{
            $SyncroMsg = '<p class="text-right"><a href="'.BASE_URL_SITO.'get_rooms_parity/sync/" class="btn bg-orange btn-sm" id="resynchBtn"><i class="fa fa-refresh"></i> Re-Synch ParityRate</a> <br><small>Ri-sincronizza le tipologie di camera del Channel Manager Parity Rate!</small></p>';

        }
        $ThColumn2  ='<th>Abbina Camera con ParityRate  <i class="fa fa-info-circle text-black cursore" data-toggle="tooltip" title="Abbinamento tipologia di Camera con ParityRate "></i></th>'."\r\n";
        $ThContent2 = '{ "data": "RoomParityId","class":"nowrap"},'."\r\n";

        $PmsMsg = '<p class="text-right"><small>ATTENZIONE:  è neccessario <b>abbinare tutte le tipologie di camera</b> con il Channel Manager Parity Rate!</small></p>';
    }
    if ($fun->check_simplebooking(IDSITO)==1 || $fun->check_ericsoftbooking(IDSITO)==1 || $fun->check_bedzzlebooking(IDSITO)==1 ){
        $booking_attivo = 1;
    }else{
        $booking_attivo = 0;
    }
    if ($fun->check_pms_bedzzle(IDSITO)==1 || $fun->check_parity(IDSITO)==1 || $fun->check_pms(IDSITO)==1){
        $pms_attivo = 1;
    }else{
        $pms_attivo = 0;
    }
#AGGIUNGI
$content .=' <div class="modal fade" id="ModaleCamere" tabindex="-1" role="dialog" aria-labelledby="ModaleTargetLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi Tipologia di Camera</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                <form method="POST" id="form_add_camere" name="form_add_camere">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3 nowrap">
                                                <label>Associa Servizi</label>
                                            </div>
                                            <div class="col-md-9">                                          	                                                     
                                                <select name="Servizi_" id="Servizi_" class="Servizi_ form-control" multiple="multiple">
                                                    '.$fun->get_servizi_camera(IDSITO).'
                                                </select> 
                                                 <input type="hidden" name="Servizi" id="Servizi" />                                   
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3 nowrap">
                                                <label>Tipo Camera</label>
                                            </div>
                                            <div class="col-md-9">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-bed fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="TipoCamere" name="TipoCamere" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Ordine</label>
                                            </div>
                                            <div class="col-md-9">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                                                    <select class="form-control" id="Ordine" name="Ordine" style="height:auto">
                                                        <option value="">--</option>';
$n=1;
for($n==1; $n<=50; $n++){
    $content .='                                        <option value="'.$n.'">'.$n.'</option>';
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

                                        $("#Abilitato").click(function() {
                                            if($("#Abilitato").is(":checked")){
                                                $("#Abilitato").attr("value","1");
                                            }else{
                                                $("#Abilitato").attr("value",0);
                                                $("#Abilitato").attr("checked",0);
                                            }
                                        });

                                        $("#Servizi_").on("change",function(){
                                            var servizi_new = "" ;
                                            $(".Servizi_").each(function() {
                                                servizi_new =  $(this).val();
                                            });
                                            $("#Servizi").val(servizi_new);
                                        }); 

                                        $("#form_add_camere").submit(function () {   
                                            var  TipoCamere   = $("#TipoCamere").val();
                                            var  Servizi      = $("#Servizi").val();       
                                            var  Ordine       = $("#Ordine option:selected").val(); 
                                            var  Abilitato    = $("#Abilitato").val();                                    
                                             $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/disponibilita/aggiungi_camera.php",
                                                type: "POST",
                                                data: "action=add_camera&idsito='.IDSITO.'&TipoCamere="+TipoCamere+"&Abilitato="+Abilitato+"&Ordine="+Ordine+"&Servizi="+Servizi+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleCamere").modal("hide");
                                                    $("#camere").DataTable().ajax.reload();    
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
               <table id="camere" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='                '.$ThColumn.'
                            '.$ThColumn2.'
                            <th>Camera</th>
                            <th>Servizi Camera</th>
                            <th>Testi presenti</th>
                            <th>Listino</th>
                            <th>Galleria</th>
                            <th style="width:5%">Ordine</th>
                            <th style="width:5%">Abilitato</th>
                            <th style="width:4%"></th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                #camere_filter {
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
                var table = $("#camere").DataTable( {';

if ($booking_attivo == 1 && $pms_attivo == 1){      
    $content .='         order: [[7, \'asc\']], '; 
}elseif ($booking_attivo == 1){      
    $content .='         order: [[6, \'asc\']], '; 
}elseif($pms_attivo == 1){   
    $content .='         order: [[6, \'asc\']], '; 
}else{
    $content .='         order: [[5, \'asc\']], '; 
}
$content .='        responsive: true,
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
							[ 20, 30, 40, -1 ],
							[  \'20 record\', \'30 record\',\'40 record\', \'Tutti\' ]
                        ],	
                        buttons: [
                        {
                            text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi camere\',
                            className: \'buttonSelezioni\',
                            attr: {id: \'aggiungi\'},
                            action: function () {
                                $("#ModaleCamere").modal("show");
                            }
                        },
                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/disponibilita/camere.crud.php?idsito='.IDSITO.'&booking_attivo='.$booking_attivo.'&pms_attivo='.$pms_attivo.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    '.$ThContent.'
                        '.$ThContent2.'
                        { "data": "camera"},
                        { "data": "servizi"},
                        { "data": "testi","class":"text-center"},  
                        { "data": "listino","class":"text-center"},
                        { "data": "gallery","class":"text-center"},
                        { "data": "ordine","type": "formatted-num","class":"text-center"}, 
                        { "data": "abilitato","class":"text-center"},   
                  
                        { "data": "action","class":"text-center"}
                    ],';

                if($booking_attivo == 1 && $pms_attivo == 1){ 

        $content .='    "columnDefs": [
                            {"targets": [0,1,2,3,4,5,6,7,8,9], "orderable": false} 
    
                            ]
                        })';
    
                }              
                if ($booking_attivo == 1 && $pms_attivo == 0){      

        $content .='    "columnDefs": [
                              {"targets": [0,1,2,3,4,5,6,7,8], "orderable": false} 

                        ]
                    })';

                }
                if($booking_attivo == 0 && $pms_attivo == 1){ 
        $content .='    "columnDefs": [
                        {"targets": [0,1,2,3,4,5,6,7,8], "orderable": false} 

                        ]
                    })';

                }

                if ($booking_attivo == 0 && $pms_attivo == 0){  

        $content .='    "columnDefs": [
                            {"targets": [0,1,2,3,4,5,6,7], "orderable": false} 

                        ]
                    })';   
                                     
                }
    
        $content .='
                    $("#camere_processing").removeClass("card"); 

                    $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                    $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
        </script>';
?>