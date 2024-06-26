<?php
# INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
               <table id="contenuto_email" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='          
                            <th>Lingua</th>
                            <th>Tipo</th>
                            <th style="width:20%">Oggetto</th>
                            <th>Messaggio</th>
                            <th>Abilitato</th>
                            <th style="width:4%"></th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                #contenuto_email_filter{
                    display: none !important;
                }
                .dt-buttons{
                    display: none !important;
                }
                #contenuto_email_info{
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
                var table = $("#contenuto_email").DataTable( {
                    order: [[1, \'desc\']],                                  
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
                    "ajax": "'.BASE_URL_SITO.'crud/templates/contenuto_email.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "lingua","class":"text-center"},  
                        { "data": "tipo","class":"text-left"},
                        { "data": "oggetto","class":"text-left"},
                        { "data": "messaggio"},        
                        { "data": "abilitato","class":"text-center"},
                        { "data": "action","class":"text-center"},
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,2,3,4,5], "orderable": false} 

                        ]
                    })
    
                    $("#contenuto_email_processing").removeClass("card"); '."\r\n";


$content .='})
        </script>';

# INTERFACCIA CRUD DATATABLE
$content .='   <div class="clearfix p-b-30"></div>
                <h5 class="f-14 f-w-600">Mini gallery per le 3 immagini che compongono l\'e-mail di PREVENTIVO e CONFERMA</h5>
                <span class="f-11">
                    Perchè la mini-gallery possa avere un aspetto uniforme, vi consigliamo di salvare tutte le immagini della stessa dimensione. Al momento dell\'upload il software richiede un ridimensionamento dell\'immagine, adottate lo stesso criterio per tutte quelle che caricate!
                </span>
                <!-- Table datatable-->
               <table id="mini_gallery" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';
$content .='          
                            <th>Immagine</th>
                            <th style="width:4%"></th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                #mini_gallery_filter{
                    display: none !important;
                }
                #mini_gallery_info{
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
                var table2 = $("#mini_gallery").DataTable( {
                    order: [[0, \'desc\']],                                       
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
                    "ajax": "'.BASE_URL_SITO.'crud/templates/mini_gallery.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='   
                        { "data": "immagine","class":"text-left"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,1], "orderable": false} 

                        ]
                    })
    

                    // ORDINAMENTO TABELLA
                    $("#mini_gallery_processing").removeClass("card"); '."\r\n";


$content .='})
        </script>';

$content .='  
        <div class="clearfix p-b-30"></div>
        <h5 class="f-14 f-w-600">Altri contenuti E-mail</h5>
        <span class="f-11">
           I primi 2 record della tabella (Oggetto e Testomail) , fanno riferimento ai contenuti email dedicati al <b>Questionario</b> della customer satisfaction!
        </span>
        <!-- Table datatable-->
        <table id="altri_contenuti_email" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
             <thead>
                 <tr>';

$content .='         <th style="width:2%">ID</th>
                     <th>Variabile dizionario</th>
                     <th>Testi presenti</th>
                     <th style="width:4%"></th>
                 </tr>
             </thead>

         </table> '."\r\n";
$content .='<style>
         #azioniPrev .dropdown-toggle::after {
             display: none !important;
         }
         #altri_contenuti_email_filter{
             display: none !important;
         }
         .dt-buttons{
             display: none !important;
         }
         #altri_contenuti_email_info{
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
         var table = $("#altri_contenuti_email").DataTable( {
             order: [[0, \'asc\']],                                  
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
             "ajax": "'.BASE_URL_SITO.'crud/templates/altri_contenuti_email.crud.php?idsito='.IDSITO.'",
             "deferRender": true,
             "columns": ['."\r\n";

 $content .='    { "data": "id","class":"text-left f-11"},
                 { "data": "variabile","class":"text-left"},     
                 { "data": "testi","class":"text-center"},
                 { "data": "action","class":"text-center"},
             ],';
 $content .='    "columnDefs": [
                       {"targets": [0,1,2,3], "orderable": false} 

                 ]
             })

             $("#altri_contenuti_email_processing").removeClass("card"); '."\r\n";


$content .='})
 </script>';

?>