<?php
# INTERFACCIA CRUD DATATABLE
$content =' <div style="float:right">
                <button class="btn btn-primary btn-sm" id="closeButtonBoxInfo1">
                    Chiudi legenda <i class="fa fa-times" data-toggle="tooltip" title="Chiudi"></i>
                </button> 
                <button class="btn btn-primary btn-sm" id="openButtonBoxInfo1">
                    Visualizza legenda <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza"></i>
                </button> 
            </div>
            <div class="clearfix p-b-10"></div>
            <div class="alert alert-default text-black f-12" id="legenda1"  style="display:none">
                <b class="f-12">LEGENDA:</b> 
                <ol>
                    <li style="list-style-type: none;" class="f-12">Scegli il template predefinito! Il colore identificativo del template, definisce sopra ogni cosa il colore secondario delle email inviate al cliente</li>
                    <li style="list-style-type: none;" class="f-12">All\'interno di ogni proposta hai comunque la possibilità di cambiarlo per ogni cliente!</li>                
                </ol>
            </div> 
                <script>
                $(document).ready(function(){
                    $("#closeButtonBoxInfo1").hide();
                    $("#closeButtonBoxInfo1").on("click",function(){
                            $("#closeButtonBoxInfo1").hide();
                            $("#openButtonBoxInfo1").show();
                            $("#legenda1").hide(300);                           
                    });
                    $("#openButtonBoxInfo1").on("click",function(){
                            $("#openButtonBoxInfo1").hide();
                            $("#closeButtonBoxInfo1").show();
                            $("#legenda1").show(300);                           
                    });
                })
            </script>   
            <!-- Table datatable-->
               <table id="template_default" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='          
                            <th>Icona</th>
                            <th>Sito</th>
                            <th>Template</th>
                            <th>Colore Identificativo</th>
                            <th style="width:4%"></th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                #template_default_filter{
                    display: none !important;
                }
                .dt-buttons{
                    display: none !important;
                }
                #template_default_info{
                    display: none !important;
                }
            </style>'."\r\n";
# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>

            $(document).ready(function() {'."\r\n";


$content .=' 


                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();

                // CONFIG DATATABLE
                var table = $("#template_default").DataTable( {                             
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
							[ 50, 100, 200, 400, 800, -1 ],
							[  \'50 record\', \'100 record\', \'200 risultati\', \'400 risultati\', \'800 risultati\', \'Tutti\' ]
                        ],	
                        buttons: [

                    \'pageLength\',                    


                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/templates/template_default.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "preview","class":"text-left"},  
                        { "data": "sito","class":"text-left"},
                        { "data": "template","class":"text-left"},
                        { "data": "colore"},        
                        { "data": "action","class":"text-center"},
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,1,2,3,4], "orderable": false} 

                        ]
                    })
                    table.order( [ 0, \'ASC\' ] ).draw();
                    $("#template_deafult_processing").removeClass("card"); '."\r\n";


$content .='})
        </script>';

# INTERFACCIA CRUD DATATABLE
$content .='   <div class="clearfix p-b-30"></div>
                <h5 class="f-14 f-w-600">Configura e personalizza il template SMART</h5>
                <div class="clearfix p-b-20"></div>
                <div style="float:right">
                    <button class="btn btn-primary btn-sm" id="closeButtonBoxInfo">
                        Chiudi legenda <i class="fa fa-times" data-toggle="tooltip" title="Chiudi"></i>
                    </button> 
                    <button class="btn btn-primary btn-sm" id="openButtonBoxInfo">
                        Visualizza legenda <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza"></i>
                    </button> 
                </div>
                <div class="clearfix p-b-10"></div>
                <div class="alert alert-default text-black f-12" id="legenda"  style="display:none">
                <b class="f-12">LEGENDA:</b> 
                    <ol>
                        <li style="list-style-type: none;" class="f-12">Inserire un\'immagine TOP ed un\'immagine di BACKGROUND! Il software pre-carica i templates con immagini demo!</li>
                        <li style="list-style-type: none;" class="f-12">Per il <b>template DEFAULT</b>, il TOP Immagine viene gestito (come sempre) alla voce di menù <b>"Contenuti Templates"</b>!</li>
                    </ol>
                </div> 
                <script>
                    $(document).ready(function(){
                        $("#closeButtonBoxInfo").hide();
                        $("#closeButtonBoxInfo").on("click",function(){
                                $("#closeButtonBoxInfo").hide();
                                $("#openButtonBoxInfo").show();
                                $("#legenda").hide(300);                           
                        });
                        $("#openButtonBoxInfo").on("click",function(){
                                $("#openButtonBoxInfo").hide();
                                $("#closeButtonBoxInfo").show();
                                $("#legenda").show(300);                           
                        });
                    })
                </script>
                <!-- Table datatable-->
               <table id="template_smart" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';
$content .='                <th>Icona</th>
                            <th>Nome Template</th>
                            <th>Font Template</th>
                            <th>Colore principale Template</th>
                            <th>Colore pulsanti Template</th>
                            <th>Top immagine Template</th>
                            <th>Background immagine proposte</th>
                            <th>Ordine</th>
                            <th>Visibile</th>
                            <th style="width:4%"></th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                #template_smart_filter{
                    display: none !important;
                }
                #template_smart_info{
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
                var table2 = $("#template_smart").DataTable( {                                    
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
                        \'pageLength\',                    

                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/templates/template_smart.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "ico","class":"text-left"},
                        { "data": "nome","class":"text-left"},
                        { "data": "font","class":"text-left"},
                        { "data": "colore","class":"text-left"},
                        { "data": "pulsante","class":"text-left"},
                        { "data": "top","class":"text-left"},
                        { "data": "background","class":"text-left"},
                        { "data": "ordine","type": "formatted-num","class":"text-center"},
                        { "data": "visibile","class":"text-center"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,1,2,3,4,5,6,7,8,9], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    table2.order( [ 0, \'ASC\' ] ).draw();
                    $("#template_smart_processing").removeClass("card"); '."\r\n";


$content .='})
        </script>';

$content .='  
        <div class="clearfix p-b-30"></div>
        <h5 class="f-14 f-w-600">Configura e personalizza i custom templates - E\' possibile modificarli ed anche rinominarli</h5>
        <div class="clearfix p-b-20"></div>
        <div style="float:right">
            <button class="btn btn-primary btn-sm" id="closeButtonBoxInfo2">
                Chiudi legenda <i class="fa fa-times" data-toggle="tooltip" title="Chiudi"></i>
            </button> 
            <button class="btn btn-primary btn-sm" id="openButtonBoxInfo2">
                Visualizza legenda <i class="fa fa-angle-double-down" data-toggle="tooltip" title="Visualizza"></i>
            </button> 
        </div>
        <div class="clearfix p-b-10"></div>
        <div class="alert alert-default text-black f-12" id="legenda2"  style="display:none">
            <b class="f-12">LEGENDA:</b> 
            <ol>
                <li style="list-style-type: none;" class="f-12">Modificando il nome del template, contemporaneamente andrete a rinominare anche il nome della <b>"Gallery Target"</b> ed il nome dei <b>"Contenuti Template per target"</b>, associati al template stesso!</li>
                <li style="list-style-type: none;" class="f-12">Inserire il nome del template con caratteri minuscoli, senza trattini, underscore o caratteri particolari, stando attenti a <b>non creare template con nomi già presenti</b>! Comunque il software pulirà in automatico il testo digitato!</li>
                <li style="list-style-type: none;" class="f-12">Perchè l\'associazione tra il template con la gallery target avvenga nel miglior modo possibile deve essere presente lo stesso nome anche nelle <b>"Impostazioni->Target Clienti"</b></li>             
            </ol>
        </div> 
        <script>
            $(document).ready(function(){
                $("#closeButtonBoxInfo2").hide();
                $("#closeButtonBoxInfo2").on("click",function(){
                        $("#closeButtonBoxInfo2").hide();
                        $("#openButtonBoxInfo2").show();
                        $("#legenda2").hide(300);                           
                });
                $("#openButtonBoxInfo2").on("click",function(){
                        $("#openButtonBoxInfo2").hide();
                        $("#closeButtonBoxInfo2").show();
                        $("#legenda2").show(300);                           
                });
            })
        </script> 
        <!-- Table datatable-->
        <table id="template_custom" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
             <thead>
                 <tr>';

$content .='            <th>Icona</th>
                        <th>Nome Template</th>
                        <th>Font Template</th>
                        <th>Colore principale Template</th>
                        <th>Colore pulsanti Template</th>
                        <th>Top immagine Template</th>
                        <th>Background immagine proposte</th>
                        <th>Video Template <i class="fa fa-exclamation-circle text-info" data-toggle="tooltip" title="Il link per un video inserito nel template di proposta soggiorno è attivo solo per l\'ultimo custom template aggiunto!"></i></th>
                        <th>Ordine</th>
                        <th>Visibile</th>
                        <th style="width:4%"></th>
                 </tr>
             </thead>

         </table> '."\r\n";
$content .='<style>
         #azioniPrev .dropdown-toggle::after {
             display: none !important;
         }
         #template_custom_filter{
             display: none !important;
         }
         .dt-buttons{
             display: none !important;
         }
         #template_custom_info{
             display: none !important;
         }
     </style>'."\r\n";
# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>

     $(document).ready(function() {'."\r\n";


$content .=' 


         //INIZIALIZZO I TOOLTIP
         $(\'[data-tooltip="tooltip"]\').tooltip();

         // CONFIG DATATABLE
         var table3 = $("#template_custom").DataTable( {     
            order: [[8, \'asc\']],                            
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
                     [ 50, 100, 200, 400, 800, -1 ],
                     [  \'50 record\', \'100 record\', \'200 risultati\', \'400 risultati\', \'800 risultati\', \'Tutti\' ]
                 ],	
                 buttons: [

             \'pageLength\',                    


             ],			
             "ajax": "'.BASE_URL_SITO.'crud/templates/template_custom.crud.php?idsito='.IDSITO.'",
             "deferRender": true,
             "columns": ['."\r\n";

 $content .='       { "data": "ico","class":"text-left"},
                    { "data": "nome","class":"text-left"},
                    { "data": "font","class":"text-left"},
                    { "data": "colore","class":"text-left"},
                    { "data": "pulsante","class":"text-left"},
                    { "data": "top","class":"text-center"},
                    { "data": "background","class":"text-center"},
                    { "data": "video","class":"text-center"},
                    { "data": "ordine","type": "formatted-num","class":"text-center"},
                    { "data": "visibile","class":"text-center"},
                    { "data": "action","class":"text-center"}
             ],';
 $content .='    "columnDefs": [
                       {"targets": [0,1,2,3,4,5,6,7,9,10], "orderable": false} 

                 ]
             })
             $("#template_custom_processing").removeClass("card"); '."\r\n";


$content .='})
 </script>';

?>