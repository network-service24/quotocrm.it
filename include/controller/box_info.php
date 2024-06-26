<?php
    $sel = "SELECT * FROM hospitality_boxinfo_checkin_lang WHERE idsito = ".IDSITO;
    $rs  = $dbMysqli->query($sel);
    $rws = $rs[0];
    if(is_array($rws)) {
        if($rws > count($rws))
            $check = count($rws); 
    }else{ 	
        $check = 0;
    }

    $select = "SELECT * FROM hospitality_boxinfo_checkin WHERE idsito = ".IDSITO;
    $res    = $dbMysqli->query($select);
    $rw     = $res[0];
    if(is_array($rw)) {
        if($rw > count($rw))
            $tot = count($rw); 
    }else{ 	
        $tot = 0;
    }
    if($tot == 0){
        $insert = "INSERT INTO hospitality_boxinfo_checkin(idsito,Titolo) VALUES('".IDSITO."','Misure anti COVID-19')";
        $ins    = $dbMysqli->query($insert);
        $id     = $dbMysqli->getInsertId($ins);
    }else{
        $id = $rw['id'];
    }
 
 # INTERFACCIA CRUD DATATABLE
$content .='<!-- Table datatable-->
            <table id="box_info" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                <thead>
                    <tr>';

$content .='          
                        <th>Titolo</th>
                        <th>Testi presenti</th>
                        <th>Abilitato</th>
                        <th style="width:4%"></th>
                    </tr>
                </thead>

            </table> '."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                .dataTables_filter {
                    display: none;
                }
                .dt-buttons{
                    display: none !important;
                }
                #box_info_info{
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
 var table = $("#box_info").DataTable( {
                                                
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
     "ajax": "'.BASE_URL_SITO.'crud/proposte/box_info.crud.php?idsito='.IDSITO.'",
     "deferRender": true,
     "columns": ['."\r\n";

$content .='    { "data": "titolo"},  
                { "data": "lingua","class":"text-center"},
                { "data": "abilitato","class":"text-center"},         
                { "data": "action","class":"text-center"}
            ],';
$content .='    "columnDefs": [
               {"targets": [0,1,2,3], "orderable": false} 

         ]
     })


     // ORDINAMENTO TABELLA
     table.order( [ 0, \'ASC\' ] ).draw();
     $("#box_info_processing").removeClass("card");'."\r\n";


$content .='})
</script>';
?>      