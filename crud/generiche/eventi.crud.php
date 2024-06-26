<?php
/**
 * CRM and CMS
 * @author Marcello Visigalli <a marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CRUD for insert, update, delete query in ajax
 */

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");

	$data        = array();

	# QUERY PER COMPILARE IL DATATABLE
	$select  = "SELECT 
                    astext(Coordinate),
					hospitality_eventi.*	
				FROM 
					hospitality_eventi 
				WHERE 
					hospitality_eventi.idsito = ".$_REQUEST['idsito']."";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){

        $coor_tmp                                     = str_replace("POINT(","",$row['astext(Coordinate)']);
        $coor_tmp                                     = str_replace(")","",$coor_tmp);
        $coor_tmp                                     = explode(" ",$coor_tmp);
        $Lat                                          = $coor_tmp[0];
        $Lon                                          = $coor_tmp[1];
        $coordinate                                   = '('.$Lat.', '.$Lon.')';

        //$modale ='<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=geometry&key=AIzaSyCEhD0s4UEJdItPacNMZNLE_aoyLYGAHL8"></script>'."\r\n";
        $modale .='<script>
                        var geocoder'.$row['Id'].';
                        var map'.$row['Id'].';
                        function initialize'.$row['Id'].'() {
                            geocoder'.$row['Id'].' = new google.maps.Geocoder();
                            var latlng = new google.maps.LatLng('.($row['astext(Coordinate)']!=''?$Lat.','.$Lon:'44.0554175, 12.5440337').');
                            var mapOptions = {
                            zoom: 13,
                            center: latlng
                            }
                            map'.$row['Id'].' = new google.maps.Map(document.getElementById(\'map'.$row['Id'].'\'), mapOptions);
                        }
        
                        function codeAddress'.$row['Id'].'() {
                            var address'.$row['Id'].' = document.getElementById(\'address'.$row['Id'].'\').value;
                            geocoder'.$row['Id'].'.geocode( { \'address\': address'.$row['Id'].'}, function(results, status) {
                            if (status == \'OK\') {
                                map'.$row['Id'].'.setCenter(results[0].geometry.location);
                                var marker = new google.maps.Marker({
                                    map: map'.$row['Id'].',
                                    position: results[0].geometry.location                  
                                });
                                $("#coordinate'.$row['Id'].'").val(results[0].geometry.location);
                            } else {
                                alert(\'Il Geolocalizzatore non ha funzionato per: \' + status);
                            }
                            });
                        }
                        $(document).ready(function() {
        
                            // INIZIALIZZO LA GOOGLE MAP
                            initialize'.$row['Id'].'();
                        });
                    </script>'."\r\n";
        $modale .=' <div class="modal fade" id="ModaleUpdateEventi'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleEventiLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Modifica Evento</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form_up_eventi'.$row['Id'].'" name="form_up_eventi">
                                            <div class="form-group">  
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Evento</label>
                                                    </div>
                                                    <div class="col-md-7">                                            	                                                     
                                                        <div class="input-group input-group-primary">
                                                            <span class="input-group-addon"><i class="fa fa-calendar-o fa-fw"></i></span>
                                                            <input type="text" class="form-control" id="Evento'.$row['Id'].'" name="Evento" value="'.$row['Evento'].'" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Immagine Evento</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                    <small class="text-info">Una volta scelto il file, non dimenticare di cliccare sul pulsante "Upload"</small>
                                                    <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-photo"></i></span>
                                                    <input type="file" class="form-control"  name="file_" id="file_'.$row['Id'].'">
                                                    <button type="button" class="btn btn-mini" id="btn_up'.$row['Id'].'">Upload</button>
                                                    </div>
                                                    <div id="result_file'.$row['Id'].'"></div>
                                                    <input type="hidden"  id="Immagine'.$row['Id'].'" name="Immagine" />
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="form-group">  
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Data Inizio</label>
                                                    </div>
                                                    <div class="col-md-7">                                            	                                                     
                                                        <div class="input-group input-group-primary">
                                                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                            <input type="date" class="form-control" id="DataInizio'.$row['Id'].'" name="DataInizio" value="'.$row['DataInizio'].'" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                             <div class="form-group">  
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Data Fine</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="input-group input-group-primary">
                                                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                            <input type="date" class="form-control" id="DataFine'.$row['Id'].'" name="DataFine" value="'.$row['DataFine'].'" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">  
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Orario Inizio</label>
                                                    </div>
                                                    <div class="col-md-7">                                            	                                                     
                                                        <div class="input-group input-group-primary">
                                                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                            <input type="time" class="form-control" id="OraInizio'.$row['Id'].'" name="OraInizio" value="'.$row['OraInizio'].'" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="form-group">  
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Orario Fine</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="input-group input-group-primary">
                                                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                            <input type="time" class="form-control" id="OraFine'.$row['Id'].'" name="OraFine" value="'.$row['OraFine'].'" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group"> 
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Coordinate</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <span class="f-11 f-w-600 m-b-10">Calcola la posizione dell\'evento ricettiva inserendo l\'indirizzo e la località</span>
                                                        <div id="map'.$row['Id'].'" style="width: 320; height: 220px;"></div>
                                                        <div class="row m-t-10 m-b-10">
                                                            <div class="col-md-5"><input id="address'.$row['Id'].'" type="text" name="address" class="form-control" placeholder="Via xxxxxx NN, Comune" value="'.$row['Indirizzo'].'" ></div>
                                                            <div class="col-md-5"><input id="coordinate'.$row['Id'].'" type="text" name="coordinate" class="form-control" value="'.$coordinate.'" readonly></div>
                                                            <div class="col-md-2"><input type="hidden" id="idsito'.$row['Id'].'" name="idsito" value="'.$row['idsito'].'"><button type="button"  onclick="codeAddress'.$row['Id'].'()" class="btn btn-warning btn-sm">Calcola</button></div>                   
                                                        </div> 
                                                        <div id="res'.$row['Id'].'"></div>
                                                    </div>
                                                </div>                                    
                                            </div>
                                            <div class="form-group">  
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <input type="hidden"  id="Id'.$row['Id'].'" name="Id" value="'.$row['Id'].'" />
                                                        <input type="hidden"  id="Abilitato'.$row['Id'].'" name="Abilitato" value="'.$row['Abilitato'].'" />
                                                        <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                        <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                                    </div>
                                                </div>
                                            </div>                                 
                                    </form>                     
                                        <script>
                                            $(document).ready(function() {
                                                //CARICO ICONA										
                                                $("#btn_up'.$row['Id'].'").on("click",function(){
                                                    formdata = new FormData();
                                                    if($("#file_'.$row['Id'].'").prop(\'files\').length > 0)
                                                    {
                                                        file =$("#file_'.$row['Id'].'").prop(\'files\')[0];
                                                        formdata.append("file_", file);
                                                    }
                                                    $.ajax({
                                                        url: "' . BASE_URL_SITO . 'ajax/generiche/upload_mod_img_evento.php?idsito='.$row['idsito'].'",
                                                        type: "POST",
                                                        data: formdata,
                                                        processData: false,
                                                        contentType: false,
                                                        success: function (result) {
                                                            console.log(result);
                                                            if(result != ""){
                                                                $("#Immagine'.$row['Id'].'").val(result);
                                                                $("#result_file'.$row['Id'].'").html("<small class=\"text-green\">Il file è stato caricato con successo!</small>");
                                                            }else{
                                                                $("#result_file'.$row['Id'].'").html("<small class=\"text-red\">Prima di cliccare sul pulsante \"Upload\", scegli il file da caricare sul server!</small>");
                                                            }
                                                        }
                                                    });
                                                    return false;
                                                });   
                                                $("#form_up_eventi'.$row['Id'].'").submit(function () {   
                                                    var  Evento     = $("#Evento'.$row['Id'].'").val(); 
                                                    var  Immagine   = $("#Immagine'.$row['Id'].'").val(); 
                                                    var  DataInizio = $("#DataInizio'.$row['Id'].'").val();
                                                    var  DataFine   = $("#DataFine'.$row['Id'].'").val();
                                                    var  OraInizio  = $("#OraInizio'.$row['Id'].'").val();
                                                    var  OraFine    = $("#OraFine'.$row['Id'].'").val();
                                                    var  Indirizzo  = $("#address'.$row['Id'].'").val();
                                                    var  Coordinate = $("#coordinate'.$row['Id'].'").val();
                                                    var  Abilitato  = $("#Abilitato'.$row['Id'].'").val();        
                                                    var  Id         = $("#Id'.$row['Id'].'").val();  
                                                    $.ajax({
                                                        url: "'.BASE_URL_SITO.'ajax/generiche/modifica_evento.php",
                                                        type: "POST",
                                                        data: "action=mod_evento&Id="+Id+"&idsito='.$row['idsito'].'&Evento="+Evento+"&Immagine="+Immagine+"&Abilitato="+Abilitato+"&DataInizio="+DataInizio+"&DataFine="+DataFine+"&OraInizio="+OraInizio+"&OraFine="+OraFine+"&Indirizzo="+Indirizzo+"&Coordinate="+Coordinate+"",
                                                        dataType: "html",
                                                        success: function(data) {
                                                            $("#ModaleUpdateEventi'.$row['Id'].'").modal("hide");
                                                            $("#eventi").DataTable().ajax.reload();    
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

 							$action = ' <div class="btn-group dropdown-split-default"  id="azioniPrev">
											<a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
											</a>
											<div class="dropdown-menu">
                                            <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'generiche-eventi_testi/'.$row['Id'].'/'.urlencode($row['Evento']).'/"><i class="fa fa-comment-o text-green"></i> Gestione testi evento </a>                                         
                                            <div class="dropdown-divider"></div>
                                            '.($row['Abilitato']==0?
                                            '<a class="dropdown-item waves-effect waves-light" href="#" id="abilita'.$row['Id'].'"><i class="fa fa-eye text-green"></i> Abilita</a>'
                                            :
                                            '<a class="dropdown-item waves-effect waves-light" href="#" id="disabilita'.$row['Id'].'"><i class="fa fa-eye-slash text-gray"></i> Disabilita</a>'
                                            ).'
                                            <script>
                                                $(document).ready(function(){ 
                                                    $("#abilita'.$row['Id'].'").on("click",function(){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/generiche/switch_evento.php",
                                                            type: "POST",
                                                            data: "action=switch_evento&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=1",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#eventi").DataTable().ajax.reload();    
                                                            }
                                                        });
                                                        return false;
                                                    });
                                                    $("#disabilita'.$row['Id'].'").on("click",function(){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/generiche/switch_evento.php",
                                                            type: "POST",
                                                            data: "action=switch_evento&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=0",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#eventi").DataTable().ajax.reload();    
                                                            }
                                                        });
                                                        return false;                                                           
                                                    });
                                                });
                                            </script>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['Id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#modifica'.$row['Id'].'").on("click",function(){
                                                            $("#ModaleUpdateEventi'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                               
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_evento'.$row['Id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_evento'.$row['Id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo Evento?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/generiche/delete_evento.php",
                                                                    type: "POST",
                                                                    data: "action=del_evento&idsito='.$row['idsito'].'&Id='.$row['Id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#eventi").DataTable().ajax.reload();    
                                                                    }
                                                                });
                                                                return false;
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </div>
										</div>';                                               

							$data[] = array(
                                        "evento"      => $row['Evento'],
                                        "immagine"    => ($row['Immagine']!=''?'<a href="'.BASE_URL_SITO.'uploads/'.$row['idsito'].'/'.$row['Immagine'].'" data-lightbox="roadtrip"><img src="'.BASE_URL_SITO.'class/resize.class.php?src='.BASE_PATH_SITO.'uploads/'.$row['idsito'].'/'.$row['Immagine'].'&w=340&h=180&a=c&q=100"></a>':''),
                                        "data_inizio" => $fun->gira_data($row['DataInizio']),
                                        "data_fine"   => $fun->gira_data($row['DataFine']),
                                        "testi"       => $fun->ControlloTestiInseritiEventi($row['Id'],$row['idsito']),
                                        "abilitato"   => ($row['Abilitato']==0?'<i class="fa fa-times text-danger"></i>':'<i class="fa fa-check text-success"></i>'),
                                        "action"      => $action.$modale
 
							);

	}

 	$json_data = array(
						"draw"            => 1,
						"recordsTotal"    => sizeof($rec) ,
						"recordsFiltered" => sizeof($rec),
						"data" 			  => $data
						); 



if(empty($json_data) || is_null($json_data)){
	$json_data = NULL;
}else{
	$json_data = json_encode($json_data);
}
	  echo $json_data; 

#######################################################################################################################

?>
