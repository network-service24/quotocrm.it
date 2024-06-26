<?php
    $select = "SELECT * FROM hospitality_giorni_reselling WHERE idsito = ".IDSITO;
    $res    = $dbMysqli->query($select);
    $rw     = $res[0];
    if(is_array($rw)) {
        if($rw > count($rw))
            $tot = count($rw); 
    }else{ 	
        $tot = 0;
    }
    if($tot == 0){
        $insert = "INSERT INTO hospitality_giorni_reselling(idsito) VALUES('".IDSITO."')";
        $ins    = $dbMysqli->query($insert);
        $id     = $dbMysqli->getInsertId($ins);
    }else{
        $id = $rw['id'];
    }

# INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
     <table id="benvenuto" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
          <thead>
              <tr>';

$content .='          
                  <th>Numero giorni DOPO del Check-In</th>
                  <th>Abilita Invio Automatico</th>
                  <th style="width:4%"></th>
              </tr>
          </thead>

      </table> '."\r\n";
$content .='  
        <div class="clearfix p-b-30"></div>
        <!-- Second Table datatable-->
        <table id="benvenuto_content" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
           <thead>
               <tr>';
 
$content .='        <th style="width:2%">ID</th>   
                    <th>Nome Modulo</th>   
                    <th>Contenuti presenti</th>
                    <th style="width:4%"></th>
               </tr>
           </thead>
 
       </table> '."\r\n";
$content .='<style>
        #azioniPrev .dropdown-toggle::after {
            display: none !important;
        }
        #benvenuto_filter{
            display: none !important;
        }
        #benvenuto_info{
            display: none !important;
        }
        #benvenuto_wrapper .dt-buttons{
            display: none !important;
        }
        #benvenuto_content_filter{
            display: none !important;
        }
        .dt-buttons{
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
      var table = $("#benvenuto").DataTable( {
                                                     
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
                  [ 1],
                  [  \'1 record\']
              ],	
              buttons: [

          \'pageLength\',                    

          ],			
          "ajax": "'.BASE_URL_SITO.'crud/autoresponder/configura_benvenuto.crud.php?idsito='.IDSITO.'",
          "deferRender": true,
          "columns": ['."\r\n";

$content .='  { "data": "numero","class":"text-center"},  
              { "data": "abilitato","class":"text-center"},         
              { "data": "action","class":"text-center"}
          ],';
$content .='    "columnDefs": [
                    {"targets": [0,1,2], "orderable": false} 

              ]
          })


          // ORDINAMENTO TABELLA
          table.order( [ 0, \'SC\' ] ).draw();
          $("#benvenuto_processing").removeClass("card");'."\r\n";


$content .='                                                                     

      // CONFIG 2° DATATABLE
      var table2 = $("#benvenuto_content").DataTable( {
                                                     
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
          "ajax": "'.BASE_URL_SITO.'crud/autoresponder/configura_benvenuto_content.crud.php?idsito='.IDSITO.'",
          "deferRender": true,
          "columns": ['."\r\n";

$content .='    { "data": "id","class":"text-left f-11"}, 
                { "data": "variabile"},  
                { "data": "content","class":"text-center"},    
                { "data": "action","class":"text-center"}
          ],';
$content .='    "columnDefs": [
                    {"targets": [1,2,3], "orderable": false} 

              ]
          })


          // ORDINAMENTO TABELLA
         
          $("#benvenuto_content_processing").removeClass("card");'."\r\n";

$content .='})
</script>';
?>