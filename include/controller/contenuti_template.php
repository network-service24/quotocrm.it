<?php
$select = "SELECT  hospitality_template_background.Id
                    ,hospitality_template_background.Visibile
            FROM hospitality_template_background
            WHERE hospitality_template_background.idsito = ".IDSITO."
            AND TemplateName = 'default'";
$result = $dbMysqli->query($select);
$record = $result[0];
$visibile = $record['Visibile'];
$idTemplate = $record['Id'];
$content = '<div class="row">
                <div class="col-md-8">
                    <div id="res"></div>
                    <div class="row m-t-10">
                        <div class="col-md-1"><img class="p-r-5" src="'.BASE_URL_SITO.'img/thumb-default.png" style="width:40px" data-toggle="tooltip" title="Template default"></div>
                        <div class="col-md-6 nowrap">
                            <label class="f-w-200">Rendi Visibile o Non Visibile (nel crea proposta) il template "default" </label>
                        </div>
                        <div class="col-md-1">
                            <select class="form-control ordina" id="Visibile" name="Visibile">
                                <option value="0" '.($visibile==0?'selected="selected"':'').'>No</option>                       
                                <option value="1" '.($visibile==1?'selected="selected"':'').'>Si</option>
                            </select>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
                <div class="col-md-3"></div>
                </div>      
                <script>
                $(document).ready(function(){
                    // UPDATE
                    $("#Visibile").on("change",function(){
                        var visibile = $(\'#Visibile option:selected\').val(); 
                            $.ajax({
                                url: "'.BASE_URL_SITO.'ajax/templates/switch_template.php",
                                type: "POST",
                                data: "action=switch_t&idsito='.IDSITO.'&id='.$idTemplate.'&Visibile="+visibile+"",
                                success: function(msg){  
                                    $("#res").html(\'<div class="clearfix p-b-30"></div><div class="alert alert-info"><p>Dati salvati con successo!</p></div>\');
                                    setTimeout(function(){ 
                                        $("#res").hide(); 
                                    }, 2000);
                                },
                                error: function(){
                                    alert("Chiamata fallita, si prega di riprovare...");
                                }
                            });
                            return false; // con false senza refresh della pagina
                    });
                });
                </script> 
                <div class="clearfix p-b-30"></div>'."\r\n";
# INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
               <table id="contenuto_template" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='                <th>Immagine</th>
                            <th>Lingua</th>
                            <th>Tipo</th>
                            <th>Testo</th>
                            <th>Abilitato</th>
                            <th style="width:4%"></th>
                        </tr>
                    </thead>

                </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                #contenuto_template_filter{
                    display: none !important;
                }
                .dt-buttons{
                    display: none !important;
                }
                #contenuto_template_info{
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
                var table = $("#contenuto_template").DataTable( {
                    order: [[2, \'desc\']],                                  
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
                    "ajax": "'.BASE_URL_SITO.'crud/templates/contenuto_template.crud.php?idsito='.IDSITO.'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='   { "data": "immagine","class":"text-left"},
                        { "data": "lingua","class":"text-center"},  
                        { "data": "tipo","class":"text-left"},
                        { "data": "testo"},        
                        { "data": "abilitato","class":"text-center"},
                        { "data": "action","class":"text-center"},
                    ],';
        $content .='    "columnDefs": [
                              {"targets": [0,1,3,4,5], "orderable": false} 

                        ]
                    })
    
                    $("#contenuto_template_processing").removeClass("card"); '."\r\n";


$content .='})
        </script>';


$content .='  
        <div class="clearfix p-b-30"></div>
        <h5 class="f-14 f-w-600">Altri contenuti per i "custom" Template!</h5>
        <!-- Table datatable-->
        <table id="altri_contenuti_template" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
             <thead>
                 <tr>';

$content .='         <th style="width:15%">Variabile dizionario</th>
                     <th>Variabile contenuti</th>
                     <th>Testi presenti</th>
                     <th style="width:4%"></th>
                 </tr>
             </thead>

         </table> '."\r\n";
$content .='<style>
         #azioniPrev .dropdown-toggle::after {
             display: none !important;
         }
         #altri_contenuti_template_filter{
             display: none !important;
         }
         .dt-buttons{
             display: none !important;
         }
         #altri_contenuti_template_info{
             display: none !important;
         }
         #altri_contenuti_template .ordinamento {
            display:none; 
        }
     </style>'."\r\n";

# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>

     $(document).ready(function() {'."\r\n";


$content .=' 


         //INIZIALIZZO I TOOLTIP
         $(\'[data-tooltip="tooltip"]\').tooltip();

         // CONFIG DATATABLE
         var table = $("#altri_contenuti_template").DataTable( {
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
             "ajax": "'.BASE_URL_SITO.'crud/templates/altri_contenuti_template.crud.php?idsito='.IDSITO.'",
             "deferRender": true,
             "columns": ['."\r\n";

 $content .='    { "data": "id","class":"text-left"},
                 { "data": "variabile","class":"text-left"},     
                 { "data": "testi","class":"text-center"},
                 { "data": "action","class":"text-center"},
             ],';
 $content .='    "columnDefs": [
                       {"targets": [1,2,3], "orderable": false} 

                 ]
             })

             $("#altri_contenuti_template_processing").removeClass("card"); '."\r\n";


$content .='})
 </script>';

?>