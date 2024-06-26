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

	$data         = array();
    $selectOrdine = '';

	# QUERY PER COMPILARE IL DATATABLE
	$select  = "SELECT 
                    astext(Coordinate),
					hospitality_pdi.*	
				FROM 
					hospitality_pdi 
				WHERE 
					hospitality_pdi.idsito = ".$_REQUEST['idsito']."";

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
        $modale .=' <div class="modal fade" id="ModaleUpdatePdi'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModalePdiLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Modifica Evento</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form_up_pdi'.$row['Id'].'" name="form_up_pdi">
                                            <div class="form-group">  
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Punto d\'interesse</label>
                                                    </div>
                                                    <div class="col-md-7">                                            	                                                     
                                                        <div class="input-group input-group-primary">
                                                            <span class="input-group-addon"><i class="fa fa-calendar-o fa-fw"></i></span>
                                                            <input type="text" class="form-control" id="PuntoInteresse'.$row['Id'].'" name="PuntoInteresse" value="'.$row['PuntoInteresse'].'" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Immagine PDI</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                    <span class="f-11 f-w-600 m-b-10">Calcola la posizione dell\'evento ricettiva inserendo l\'indirizzo e la località</span>
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
                                                        <label>Coordinate</label>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <span class="f-11 f-w-600 m-b-10">Calcola la posizione dell\'pdi ricettiva inserendo l\'indirizzo e la località</span>
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
                                                <div class="col-md-3">
                                                    <label>Ordine</label>
                                                </div>
                                                <div class="col-md-7">                                            	                                                     
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="fa fa-list fa-fw"></i></span>
                                                        <select class="form-control" id="Ordine'.$row['Id'].'" name="Ordine" style="height:auto">
                                                            <option value="1" '.($row['Ordine']==1?'selected="selected"':'').'>1</option>
                                                            <option value="2" '.($row['Ordine']==2?'selected="selected"':'').'>2</option>
                                                            <option value="3" '.($row['Ordine']==3?'selected="selected"':'').'>3</option>
                                                            <option value="4" '.($row['Ordine']==4?'selected="selected"':'').'>4</option>
                                                            <option value="5" '.($row['Ordine']==5?'selected="selected"':'').'>5</option>
                                                            <option value="6" '.($row['Ordine']==6?'selected="selected"':'').'>6</option>
                                                            <option value="7" '.($row['Ordine']==7?'selected="selected"':'').'>7</option>
                                                            <option value="8" '.($row['Ordine']==8?'selected="selected"':'').'>8</option>
                                                            <option value="9" '.($row['Ordine']==9?'selected="selected"':'').'>9</option>
                                                            <option value="10" '.($row['Ordine']==10?'selected="selected"':'').'>10</option>
                                                            <option value="11" '.($row['Ordine']==11?'selected="selected"':'').'>11</option>
                                                            <option value="12" '.($row['Ordine']==12?'selected="selected"':'').'>12</option>
                                                            <option value="13" '.($row['Ordine']==13?'selected="selected"':'').'>13</option>
                                                            <option value="14" '.($row['Ordine']==14?'selected="selected"':'').'>14</option>
                                                            <option value="15" '.($row['Ordine']==15?'selected="selected"':'').'>15</option>
                                                            <option value="16" '.($row['Ordine']==16?'selected="selected"':'').'>16</option>
                                                            <option value="17" '.($row['Ordine']==17?'selected="selected"':'').'>17</option>
                                                            <option value="18" '.($row['Ordine']==18?'selected="selected"':'').'>18</option>
                                                            <option value="19" '.($row['Ordine']==19?'selected="selected"':'').'>19</option>
                                                            <option value="20" '.($row['Ordine']==20?'selected="selected"':'').'>20</option>
                                                            <option value="21" '.($row['Ordine']==21?'selected="selected"':'').'>21</option>
                                                            <option value="22" '.($row['Ordine']==22?'selected="selected"':'').'>22</option>
                                                            <option value="23" '.($row['Ordine']==23?'selected="selected"':'').'>23</option>
                                                            <option value="24" '.($row['Ordine']==24?'selected="selected"':'').'>24</option>
                                                            <option value="25" '.($row['Ordine']==25?'selected="selected"':'').'>25</option>
                                                            <option value="26" '.($row['Ordine']==26?'selected="selected"':'').'>26</option>
                                                            <option value="27" '.($row['Ordine']==27?'selected="selected"':'').'>27</option>
                                                            <option value="28" '.($row['Ordine']==28?'selected="selected"':'').'>28</option>
                                                            <option value="29" '.($row['Ordine']==29?'selected="selected"':'').'>29</option>
                                                            <option value="30" '.($row['Ordine']==30?'selected="selected"':'').'>30</option>
                                                            <option value="31" '.($row['Ordine']==31?'selected="selected"':'').'>31</option>
                                                            <option value="32" '.($row['Ordine']==32?'selected="selected"':'').'>32</option>
                                                            <option value="33" '.($row['Ordine']==33?'selected="selected"':'').'>33</option>
                                                            <option value="34" '.($row['Ordine']==34?'selected="selected"':'').'>34</option>
                                                            <option value="35" '.($row['Ordine']==35?'selected="selected"':'').'>35</option>
                                                            <option value="36" '.($row['Ordine']==36?'selected="selected"':'').'>36</option>
                                                            <option value="37" '.($row['Ordine']==37?'selected="selected"':'').'>37</option>
                                                            <option value="38" '.($row['Ordine']==38?'selected="selected"':'').'>38</option>
                                                            <option value="39" '.($row['Ordine']==39?'selected="selected"':'').'>39</option>
                                                            <option value="40" '.($row['Ordine']==40?'selected="selected"':'').'>40</option>
                                                            <option value="41" '.($row['Ordine']==41?'selected="selected"':'').'>41</option>
                                                            <option value="42" '.($row['Ordine']==42?'selected="selected"':'').'>42</option>
                                                            <option value="43" '.($row['Ordine']==43?'selected="selected"':'').'>43</option>
                                                            <option value="44" '.($row['Ordine']==44?'selected="selected"':'').'>44</option>
                                                            <option value="45" '.($row['Ordine']==45?'selected="selected"':'').'>45</option>
                                                            <option value="46" '.($row['Ordine']==46?'selected="selected"':'').'>46</option>
                                                            <option value="47" '.($row['Ordine']==47?'selected="selected"':'').'>47</option>
                                                            <option value="48" '.($row['Ordine']==48?'selected="selected"':'').'>48</option>
                                                            <option value="49" '.($row['Ordine']==49?'selected="selected"':'').'>49</option>
                                                            <option value="50" '.($row['Ordine']==50?'selected="selected"':'').'>50</option>
                                                        </select>
                                                    </div>
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
                                                        url: "' . BASE_URL_SITO . 'ajax/generiche/upload_mod_img_pdi.php?idsito='.$row['idsito'].'",
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
                                                $("#form_up_pdi'.$row['Id'].'").submit(function () {   
                                                    var  PuntoInteresse = $("#PuntoInteresse'.$row['Id'].'").val(); 
                                                    var  Immagine   = $("#Immagine'.$row['Id'].'").val(); 
                                                    var  Indirizzo  = $("#address'.$row['Id'].'").val();
                                                    var  Coordinate = $("#coordinate'.$row['Id'].'").val();
                                                    var  Abilitato  = $("#Abilitato'.$row['Id'].'").val();        
                                                    var  Id         = $("#Id'.$row['Id'].'").val(); 
                                                    var  Ordine     = $("#Ordine'.$row['Id'].' option:selected").val(); 
                                                    $.ajax({
                                                        url: "'.BASE_URL_SITO.'ajax/generiche/modifica_pdi.php",
                                                        type: "POST",
                                                        data: "action=mod_pdi&Id="+Id+"&idsito='.$row['idsito'].'&PuntoInteresse="+PuntoInteresse+"&Immagine="+Immagine+"&Abilitato="+Abilitato+"&Indirizzo="+Indirizzo+"&Coordinate="+Coordinate+"&Ordine="+Ordine+"",
                                                        dataType: "html",
                                                        success: function(data) {
                                                            $("#ModaleUpdatePdi'.$row['Id'].'").modal("hide");
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

 							$action = ' <div class="btn-group dropdown-split-default"  id="azioniPrev">
											<a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
											</a>
											<div class="dropdown-menu">
                                            <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'generiche-punti_interesse_testi/'.$row['Id'].'/'.urlencode($row['PuntoInteresse']).'/"><i class="fa fa-comment-o text-green"></i> Gestione testi pdi </a>                                         
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
                                                            url: "'.BASE_URL_SITO.'ajax/generiche/switch_pdi.php",
                                                            type: "POST",
                                                            data: "action=switch_pdi&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=1",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#pdi").DataTable().ajax.reload();    
                                                            }
                                                        });
                                                        return false;
                                                    });
                                                    $("#disabilita'.$row['Id'].'").on("click",function(){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/generiche/switch_pdi.php",
                                                            type: "POST",
                                                            data: "action=switch_pdi&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=0",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#pdi").DataTable().ajax.reload();    
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
                                                            $("#ModaleUpdatePdi'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                               
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_pdi'.$row['Id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_pdi'.$row['Id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo PDI?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/generiche/delete_pdi.php",
                                                                    type: "POST",
                                                                    data: "action=del_pdi&idsito='.$row['idsito'].'&Id='.$row['Id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#pdi").DataTable().ajax.reload();    
                                                                    }
                                                                });
                                                                return false;
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </div>
										</div>'; 
                                        
                                        
                $selectOrdine = '  <select class="form-control ordina" id="OrdineRow'.$row['Id'].'" name="OrdineRow" style="height:auto;padding:2px!important;width:80%!important">
                                        <option value="1" '.($row['Ordine']==1?'selected="selected"':'').'>1</option>
                                        <option value="2" '.($row['Ordine']==2?'selected="selected"':'').'>2</option>
                                        <option value="3" '.($row['Ordine']==3?'selected="selected"':'').'>3</option>
                                        <option value="4" '.($row['Ordine']==4?'selected="selected"':'').'>4</option>
                                        <option value="5" '.($row['Ordine']==5?'selected="selected"':'').'>5</option>
                                        <option value="6" '.($row['Ordine']==6?'selected="selected"':'').'>6</option>
                                        <option value="7" '.($row['Ordine']==7?'selected="selected"':'').'>7</option>
                                        <option value="8" '.($row['Ordine']==8?'selected="selected"':'').'>8</option>
                                        <option value="9" '.($row['Ordine']==9?'selected="selected"':'').'>9</option>
                                        <option value="10" '.($row['Ordine']==10?'selected="selected"':'').'>10</option>
                                        <option value="11" '.($row['Ordine']==11?'selected="selected"':'').'>11</option>
                                        <option value="12" '.($row['Ordine']==12?'selected="selected"':'').'>12</option>
                                        <option value="13" '.($row['Ordine']==13?'selected="selected"':'').'>13</option>
                                        <option value="14" '.($row['Ordine']==14?'selected="selected"':'').'>14</option>
                                        <option value="15" '.($row['Ordine']==15?'selected="selected"':'').'>15</option>
                                        <option value="16" '.($row['Ordine']==16?'selected="selected"':'').'>16</option>
                                        <option value="17" '.($row['Ordine']==17?'selected="selected"':'').'>17</option>
                                        <option value="18" '.($row['Ordine']==18?'selected="selected"':'').'>18</option>
                                        <option value="19" '.($row['Ordine']==19?'selected="selected"':'').'>19</option>
                                        <option value="20" '.($row['Ordine']==20?'selected="selected"':'').'>20</option>
                                        <option value="21" '.($row['Ordine']==21?'selected="selected"':'').'>21</option>
                                        <option value="22" '.($row['Ordine']==22?'selected="selected"':'').'>22</option>
                                        <option value="23" '.($row['Ordine']==23?'selected="selected"':'').'>23</option>
                                        <option value="24" '.($row['Ordine']==24?'selected="selected"':'').'>24</option>
                                        <option value="25" '.($row['Ordine']==25?'selected="selected"':'').'>25</option>
                                        <option value="26" '.($row['Ordine']==26?'selected="selected"':'').'>26</option>
                                        <option value="27" '.($row['Ordine']==27?'selected="selected"':'').'>27</option>
                                        <option value="28" '.($row['Ordine']==28?'selected="selected"':'').'>28</option>
                                        <option value="29" '.($row['Ordine']==29?'selected="selected"':'').'>29</option>
                                        <option value="30" '.($row['Ordine']==30?'selected="selected"':'').'>30</option>
                                        <option value="31" '.($row['Ordine']==31?'selected="selected"':'').'>31</option>
                                        <option value="32" '.($row['Ordine']==32?'selected="selected"':'').'>32</option>
                                        <option value="33" '.($row['Ordine']==33?'selected="selected"':'').'>33</option>
                                        <option value="34" '.($row['Ordine']==34?'selected="selected"':'').'>34</option>
                                        <option value="35" '.($row['Ordine']==35?'selected="selected"':'').'>35</option>
                                        <option value="36" '.($row['Ordine']==36?'selected="selected"':'').'>36</option>
                                        <option value="37" '.($row['Ordine']==37?'selected="selected"':'').'>37</option>
                                        <option value="38" '.($row['Ordine']==38?'selected="selected"':'').'>38</option>
                                        <option value="39" '.($row['Ordine']==39?'selected="selected"':'').'>39</option>
                                        <option value="40" '.($row['Ordine']==40?'selected="selected"':'').'>40</option>
                                        <option value="41" '.($row['Ordine']==41?'selected="selected"':'').'>41</option>
                                        <option value="42" '.($row['Ordine']==42?'selected="selected"':'').'>42</option>
                                        <option value="43" '.($row['Ordine']==43?'selected="selected"':'').'>43</option>
                                        <option value="44" '.($row['Ordine']==44?'selected="selected"':'').'>44</option>
                                        <option value="45" '.($row['Ordine']==45?'selected="selected"':'').'>45</option>
                                        <option value="46" '.($row['Ordine']==46?'selected="selected"':'').'>46</option>
                                        <option value="47" '.($row['Ordine']==47?'selected="selected"':'').'>47</option>
                                        <option value="48" '.($row['Ordine']==48?'selected="selected"':'').'>48</option>
                                        <option value="49" '.($row['Ordine']==49?'selected="selected"':'').'>49</option>
                                        <option value="50" '.($row['Ordine']==50?'selected="selected"':'').'>50</option>
                                    </select>
                                    <script>
                                        $(document).ready(function(){ 
                                            $("#OrdineRow'.$row['Id'].'").on("change",function(){
                                                var OrdineRow = $("#OrdineRow'.$row['Id'].' option:selected").val(); 
                                                    $.ajax({
                                                        url: "'.BASE_URL_SITO.'ajax/generiche/ordine_pdi.php",
                                                        type: "POST",
                                                        data: "action=order_pdi&idsito='.$row['idsito'].'&Id='.$row['Id'].'&OrdineRow="+OrdineRow+"",
                                                        dataType: "html",
                                                        success: function(data) {
                                                            $("#pdi").DataTable().ajax.reload();    
                                                        }
                                                    });
                                                    return false;                                
                                            });
                                        });
                                    </script>';







							$data[] = array(
                                        "pdi"       => $row['PuntoInteresse'],
                                        "immagine"  => ($row['Immagine']!=''?'<a href="'.BASE_URL_SITO.'uploads/'.$row['idsito'].'/'.$row['Immagine'].'" data-lightbox="roadtrip"><img src="'.BASE_URL_SITO.'class/resize.class.php?src='.BASE_PATH_SITO.'uploads/'.$row['idsito'].'/'.$row['Immagine'].'&w=340&h=180&a=c&q=100"></a>': ''),
                                        "testi"     => $fun->ControlloTestiInseritiPdi($row['Id'],$row['idsito']),
                                        "ordine"    => '<span class="ordinamento">'.$row['Ordine'].'</span>'.$selectOrdine,
                                        "abilitato" => ($row['Abilitato']==0?'<i class="fa fa-times text-danger"></i>': '<i class = "fa fa-check text-success"></i>'),
                                        "action"    => $action.$modale
 
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
