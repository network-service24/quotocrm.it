<?php
$content .='<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=geometry&key=AIzaSyCEhD0s4UEJdItPacNMZNLE_aoyLYGAHL8"></script>'."\r\n";
$content .='<script>
                var geocoder;
                var map;
                function initialize() {
                    geocoder = new google.maps.Geocoder();
                    var latlng = new google.maps.LatLng("44.0554175, 12.5440337");
                    var mapOptions = {
                    zoom: 13,
                    center: latlng
                    }
                    map = new google.maps.Map(document.getElementById(\'map\'), mapOptions);
                }

                function codeAddress() {
                    var address = document.getElementById(\'address\').value;
                    geocoder.geocode( { \'address\': address}, function(results, status) {
                    if (status == \'OK\') {
                        map.setCenter(results[0].geometry.location);
                        var marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location                  
                        });
                        $("#coordinate").val(results[0].geometry.location);
                    } else {
                        alert(\'Il Geolocalizzatore non ha funzionato per: \' + status);
                    }
                    });
                }
                $(document).ready(function() {

                    // INIZIALIZZO LA GOOGLE MAP
                    initialize();
                });
            </script>'."\r\n";
$content .=' <div class="modal fade" id="ModalePdi" tabindex="-1" role="dialog" aria-labelledby="ModalePdiLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi Punto d\'interesse</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                <form method="POST" id="form_pdi" name="form_pdi">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Punto Interesse</label>
                                            </div>
                                            <div class="col-md-8">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-calendar-o fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="PuntoInteresse" name="PuntoInteresse" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Immagine PDI</label>
                                            </div>
                                            <div class="col-md-8">
                                                <span class="f-11 f-w-600 m-b-10">Una volta scelto il file, clicca sul pulsante "Upload"</span>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-photo"></i></span>
                                                <input type="file" class="form-control"  name="file_img" id="file_img">
                                                <button type="button" class="btn btn-mini" id="btn_upload">Upload</button>
                                                </div>
                                                <div id="result_file"></div>
                                                <input type="hidden"  id="Immagine" name="Immagine" />
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group"> 
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Coordinate</label>
                                            </div>
                                            <div class="col-md-8">
                                                <span class="f-11 f-w-600 m-b-10">Calcola la posizione dell\'evento ricettiva inserendo l\'indirizzo e la località</span>
                                                <div id="map" style="width: 320; height: 220px;"></div>
                                                <div class="row m-t-10 m-b-10">
                                                    <div class="col-md-5"><input id="address" type="text" name="address" class="form-control" placeholder="Via xxxxxx NN, Comune" ></div>
                                                    <div class="col-md-5"><input id="coordinate" type="text" name="coordinate" class="form-control" readonly></div>
                                                    <div class="col-md-2"><input type="hidden" id="idsito" name="idsito" value="'.IDSITO.'"><button type="button"  onclick="codeAddress()" class="btn btn-warning btn-sm">Calcola</button></div>                   
                                                </div> 
                                                <div id="res"></div>
                                            </div>
                                        </div>                                    
                                    </div>
                                    <div class="form-group">  
                                    <div class="row">
                                        <div class="col-md-4 nowrap">
                                            <label>Ordine</label>
                                        </div>
                                        <div class="col-md-8">                                            	                                                     
                                            <div class="input-group input-group-primary">
                                                <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                                                <select class="form-control" id="Ordine" name="Ordine">
                                                    <option value="">--</option>';
                        for($n==1; $n<=50; $n++){
                            $content .='           <option value="'.$n.'">'.$n.'</option>';
                        }
$content .='                                        </select>
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
                                </div> 
                                <div class="col-md-1"></div>
                                </div>                      
                                <script>
                                    $(document).ready(function() {
                                        $("#btn_upload").on("click",function(){
                                            formdata = new FormData();
                                            if($("#file_img").prop(\'files\').length > 0)
                                            {
                                                file = $("#file_img").prop(\'files\')[0];
                                                formdata.append("file_img", file);
                                            }
                                            $.ajax({
                                                url: "' . BASE_URL_SITO . 'ajax/generiche/upload_img_pdi.php?idsito='.IDSITO.'",
                                                type: "POST",
                                                data: formdata,
                                                processData: false,
                                                contentType: false,
                                                success: function (result) {
                                                    console.log(result);
                                                    if(result != ""){                                               
                                                        $("#Immagine").val(result);
                                                        $("#result_file").html("<small class=\"text-green\">Il file è stato caricato con successo!</small>");
                                                    }else{
                                                        $("#result_file").html("<small class=\"text-red\">Prima di cliccare sul pulsante \"Upload\", scegli il file da caricare sul server!</small>");
                                                    }
                                                }
                                            });
                                            return false;
                                        });
                                        $("#form_pdi").submit(function () {   
                                            var  PuntoInteresse = $("#PuntoInteresse").val(); 
                                            var  Immagine       = $("#Immagine").val(); 
                                            var  Indirizzo      = $("#address").val();
                                            var  Coordinate     = $("#coordinate").val();
                                            var  Ordine         = $("#Ordine option:selected").val();
                                            var  Abilitato      = 1;         
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generiche/aggiungi_pdi.php",
                                                type: "POST",
                                                data: "action=add_pdi&idsito='.IDSITO.'&PuntoInteresse="+PuntoInteresse+"&Immagine="+Immagine+"&Abilitato="+Abilitato+"&Indirizzo="+Indirizzo+"&Coordinate="+Coordinate+"&Ordine="+Ordine+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModalePdi").modal("hide");
                                                    $("#pdi").DataTable().ajax.reload();    
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
 <table id="pdi" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
      <thead>
          <tr>';

$content .='          
              <th>Punto d\'interesse</th>
              <th>Immagine</th>
              <th>Testi presenti</th>
              <th style="width:5%">Ordine</th>
              <th>Abilitato</th>
              <th style="width:4%"></th>
          </tr>
      </thead>

  </table> '."\r\n";
$content .='<style>
    #azioniPrev .dropdown-toggle::after {
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
  var table = $("#pdi").DataTable( {
      order: [[3, \'asc\']],           
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
                  $("#ModalePdi").modal("show");
              }
          },
      \'pageLength\',                    


      ],			
      "ajax": "'.BASE_URL_SITO.'crud/generiche/pdi.crud.php?idsito='.IDSITO.'",
      "deferRender": true,
      "columns": ['."\r\n";

$content .='    { "data": "pdi"}, 
                { "data": "immagine"},  
                { "data": "testi","class":"text-center"}, 
                { "data": "ordine","type": "formatted-num","class":"text-center"},      
                { "data": "abilitato","class":"text-center"},
                { "data": "action","class":"text-center"}
      ],';
$content .='    "columnDefs": [
                    {"targets": [0,1,3,4,5], "orderable": false} 
                ]
            })
            
            $("#pdi_processing").removeClass("card"); 
            $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
            $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";


$content .='})
</script>';
?>    