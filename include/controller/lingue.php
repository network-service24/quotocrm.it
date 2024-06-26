<?php
$select = "SELECT siti.API_hospitality FROM siti WHERE siti.idsito = ".IDSITO;
$result = $dbMysqli->query($select);
$record = $result[0];

$API_hospitality = $record['API_hospitality'];

$content .= '<div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div id="res"></div>
                    <div class="row m-t-10">
                        <div class="col-md-3 nowrap text-left">
                            <label class="f-w-600">Il cliente usa le API di QUOTO!</label>
                        </div>
                        <div class="col-md-1 text-left">
                            <input type="checkbox"  name="API_hospitality_" id="API_hospitality_" '.($API_hospitality==1?'checked="checked"':'').' value="'.$API_hospitality.'"/>
                            <input type="hidden"   id="API_hospitality"  name="API_hospitality" value="'.$API_hospitality.'"/> 
                        </div>
                        <div class="col-md-1 text-left">
                            <button type="button" class="btn btn-primary btn-sm" id="salva">Salva</button>
                        </div>
                        <div class="col-md-9"></div>
                    </div>
                </div>
            <div class="col-md-2"></div>
        </div>      
        <script>
                $(document).ready(function(){


                    $("#API_hospitality_").click(function() {
                        if($("#API_hospitality_").is(":checked")){
                            $("#API_hospitality_").attr("value","1");
                            $("#API_hospitality").attr("value","1");
                        }else{
                            $("#API_hospitality_").attr("value",0);
                            $("#API_hospitality_").attr("checked",0);
                            $("#API_hospitality").attr("value",0);
                        }
                    });
                    // UPDATE MAP
                    $("#salva").on("click",function(){
                        var API_hospitality = $(\'#API_hospitality\').val(); 
                            $.ajax({
                                url: "'.BASE_URL_SITO.'ajax/generici/api_quoto.update.php",
                                type: "POST",
                                data: "idsito='.IDSITO.'&API_hospitality="+API_hospitality+"",
                                success: function(msg){  
                                    $("#res").html(\'<div class="clearfix p-b-30"></div><div class="alert alert-info text-center"><p>Dati salvati con successo!</p></div>\');
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
# ARRAY LINGUE
$array_lg = $fun->arrayLingue(IDSITO);
# INSERT TESTI
$content .= '<div class="modal fade" id="ModaleLingue" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Aggiungi lingua</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">

                                <form id="form_lingue" name="form_lingue" method="POST">                                          
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Lingua</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="input-group input-group-primary">
                                                <span class="input-group-addon"><i class="fa fa-euro fa-fw"></i></span>'."\r\n";
        $content .= '                            <select name="codlingua"  id="codlingua" class="form-control">'."\r\n";
                                    foreach($array_lg as $key => $value){
                                        $content .= '<option value="'.$key.'">'.$value.'</option>';
                                    }
        $content .= '                            </select>
                                                </div>
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
                                <script>
                                    $(document).ready(function() {

                                        $("#form_lingue").submit(function () {   
                                            var  codlingua   = $("#codlingua option:selected").val(); 
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/aggiungi_lingua.php",
                                                type: "POST",
                                                data: "action=add_lg&codlingua="+codlingua+"&idsito='.IDSITO.'",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleLingue").modal("hide");
                                                    $("#lingue").DataTable().ajax.reload();    
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
 <table id="lingue" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
      <thead>
          <tr>';

$content .='          
              <th>Lingue</th>
              <th style="width:4%"></th>
          </tr>
      </thead>

  </table> '."\r\n";
$content .='<style>
    #azioniPrev .dropdown-toggle::after {
        display: none !important;
    }
    #lingue_filter{
        display: none !important;
    }
    .buttons-collection{
        display: none !important;
    }
    #lingue_info{
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
  var table = $("#lingue").DataTable( {
      order: [0, \'DESC\'],           
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
                  $("#ModaleLingue").modal("show");
              }
          },
      \'pageLength\',                    


      ],			
      "ajax": "'.BASE_URL_SITO.'crud/setting/lingue.crud.php?idsito='.IDSITO.'",
      "deferRender": true,
      "columns": ['."\r\n";

$content .='    { "data": "lingua"},  
                { "data": "action","class":"text-center"}
      ],';
$content .='    "columnDefs": [
                    {"targets": [0,1], "orderable": false} 
                ]
            })
            
            $("#lingue_processing").removeClass("card"); '."\r\n";


$content .='})
</script>';
?>