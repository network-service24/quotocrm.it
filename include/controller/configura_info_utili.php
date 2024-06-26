<?php
    $select = "SELECT * FROM hospitality_giorni_precheckin WHERE idsito = ".IDSITO;
    $res    = $dbMysqli->query($select);
    $rw     = $res[0];
    if(is_array($rw)) {
        if($rw > count($rw))
            $tot = count($rw); 
    }else{ 	
        $tot = 0;
    }
    if($tot == 0){
        $insert = "INSERT INTO hospitality_giorni_precheckin(idsito) VALUES('".IDSITO."')";
        $ins    = $dbMysqli->query($insert);
        $id     = $dbMysqli->getInsertId($ins);
    }else{
        $id = $rw['id'];
    }


    $content .= '<div class="modal fade" id="ModalePrecheckinContent" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Aggiungi nuovo modulo per Info Utili</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <form method="POST" id="form_precheckin" name="form_precheckin" method="POST">                                          
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Etichetta Modulo</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="etichetta" name="etichetta">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Abilitato</label>
                                            </div>
                                            <div class="col-md-1">                                            	                                                     
                                                <input type="checkbox" class="form-control" id="abilitato" name="abilitato" value="1" checked="checked" />
                                            </div>
                                        </div>
                                    </div> 
                                        <div class="form-group">  
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <input type="hidden" name="idsito"  value="'.IDSITO.'">
                                                    <input type="hidden" name="action"  value="add_mod_precheckin">
                                                    <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                    <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                                </div>
                                            </div>
                                        </div>                                 
                                    </form>
                                    <script>
                                        $(document).ready(function() {

                                            $("#abilitato").click(function() {
                                                if($("#abilitato").is(":checked")){
                                                    $("#abilitato").attr("value","1");
                                                }else{
                                                    $("#abilitato").attr("value",false);
                                                    $("#abilitato").attr("checked",false);
                                                }
                                            });

                                            $("#form_precheckin").submit(function () {   
                                                var  etichetta   = $("#etichetta").val();  
                                                var  abilitato   = $("#abilitato").val();  
                                                $.ajax({
                                                    url: "'.BASE_URL_SITO.'ajax/autoresponder/aggiungi_modulo_precheckin.php",
                                                    type: "POST",
                                                    data: "action=add_precheckin&idsito='.IDSITO.'&etichetta="+etichetta+"&abilitato="+abilitato+"",
                                                    dataType: "html",
                                                    success: function(data) {
                                                        $("#ModalePrecheckinContent").modal("hide");
                                                        $("#precheckin_content").DataTable().ajax.reload();    
                                                    }
                                                });
                                                return false; // con false senza refresh della pagina                                       
                                            });
                                        });
                                    </script>
                                </div>
                                <div class="col-md-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>           
                </div>'."\r\n";
# INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
     <table id="precheckin" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
          <thead>
              <tr>';

$content .='          
                  <th>Numero giorni PRIMA del Check-In</th>
                  <th>Abilita Invio Automatico</th>
                  <th style="width:4%"></th>
              </tr>
          </thead>

      </table> '."\r\n";
$content .='  
        <div class="clearfix p-b-30"></div>
        <p><i class="fa fa-exclamation-circle text-black"></i> IMPORTANTE: <b>se si abilitano più contenuti</b>, quelli presi in considerazione dal software saranno gli ultimi inseriti, ossia quelli più in alto!</p>
        <div class="clearfix p-b-10"></div>
        <!-- Second Table datatable-->
        <table id="precheckin_content" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
           <thead>
               <tr>';
 
$content .='          
                   <th>Etichetta Modulo</th>
                   <th>Contenuti Oggetto Mail presenti</th>
                   <th>Contenuti Testo Mail presenti</th>
                   <th>Contenuto Abilitato</th>
                   <th style="width:4%"></th>
               </tr>
           </thead>
 
       </table> '."\r\n";
$content .='<style>
        #azioniPrev .dropdown-toggle::after {
            display: none !important;
        }
        #precheckin_filter{
            display: none !important;
        }
        #precheckin_info{
            display: none !important;
        }
        #precheckin_wrapper .dt-buttons{
            display: none !important;
        }
        #precheckin_content_filter{
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
      var table = $("#precheckin").DataTable( {
                                                     
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
          "ajax": "'.BASE_URL_SITO.'crud/autoresponder/configura_precheckin.crud.php?idsito='.IDSITO.'",
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
          table.order( [ 0, \'ASC\' ] ).draw();
          $("#precheckin_processing").removeClass("card");'."\r\n";


$content .='                                                                     

      // CONFIG 2° DATATABLE
      var table2 = $("#precheckin_content").DataTable( {
                                                     
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
                text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi\',
                className: \'buttonSelezioni\',
                attr: {id: \'aggiungi\'},
                action: function () {
                    $("#ModalePrecheckinContent").modal("show");
                },
            },
          \'pageLength\',                    

          ],			
          "ajax": "'.BASE_URL_SITO.'crud/autoresponder/configura_precheckin_content.crud.php?idsito='.IDSITO.'",
          "deferRender": true,
          "columns": ['."\r\n";

$content .='    { "data": "nome"},  
                { "data": "oggetto","class":"text-center"},
                { "data": "testo","class":"text-center"},
                { "data": "abilitato","class":"text-center"},        
                { "data": "action","class":"text-center"}
          ],';
$content .='    "columnDefs": [
                    {"targets": [0,1,2,3,4], "orderable": false} 

              ]
          })


          // ORDINAMENTO TABELLA
          table2.order( [ 0, \'ASC\' ] ).draw();
          $("#precheckin_content_processing").removeClass("card");
          
          $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
          $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";

$content .='})
</script>';
?>