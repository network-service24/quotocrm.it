<?php

$select = "SELECT astext(coordinate),siti.* FROM siti WHERE idsito = ".IDSITO;
$result = $dbMysqli->query($select);
$record = $result[0];

$web                                          = addslashes($record['web']);
$nome                                         = addslashes($record['nome']);
$email                                        = $record['email'];
$codice_provincia                             = $record['codice_provincia'];
$nome_provincia_                              = $fun->getProvincia($codice_provincia); 
$nome_provincia                               = $nome_provincia_['sigla_provincia'];
$codice_comune                                = $record['codice_comune'];
$nome_comune_                                 = $fun->getComune($codice_comune); 
$nome_comune                                  = $nome_comune_['nome_comune'];
$indirizzo                                    = addslashes($record['indirizzo']);
$cap                                          = $record['cap'];
$coor_tmp                                     = str_replace("POINT(","",$record['astext(coordinate)']);
$coor_tmp                                     = str_replace(")","",$coor_tmp);
$coor_tmp                                     = explode(" ",$coor_tmp);
$Lat                                          = $coor_tmp[0];
$Lon                                          = $coor_tmp[1];
$coordinate                                   = '('.$Lat.', '.$Lon.')';
$abilita_mappa                                = $record['abilita_mappa'];
$CheckNumberRows                              = $record['CheckNumberRows'];

$content .='<script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=geometry&key=AIzaSyCEhD0s4UEJdItPacNMZNLE_aoyLYGAHL8"></script>'."\r\n";
$content .='<script>
                var geocoder;
                var map;
                function initialize() {
                    geocoder = new google.maps.Geocoder();
                    var latlng = new google.maps.LatLng('.($record['astext(coordinate)']!=''?$Lat.','.$Lon:'44.0554175, 12.5440337').');
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
$content .= '<div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="row">
                    <div class="col-md-3">
                        <label class="f-w-600">Nome Struttura Ricettiva</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text"  value="'.$nome.'" name="Nome" readonly="readonly"/>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-3">
                        <label class="f-w-600">Indirizzo</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text"  value="'.$indirizzo.'" name="indirizzo" readonly="readonly"  />
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-3">
                        <label class="f-w-600">Comune</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text"  value="'.$nome_comune .'" name="codice_comune" readonly="readonly"  />
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-3">
                        <label class="f-w-600">Provincia</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text"  value="'.$nome_provincia .'" name="codice_provincia" readonly="readonly"  />
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-3">
                        <label class="f-w-600">CAP</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text"  value="'.$cap.'" name="cap" readonly="readonly"  />
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-3">
                        <label class="f-w-600">Email</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text"  value="'.$email.'" name="email" readonly="readonly"  />
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-3">
                        <label class="f-w-600">Web</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text"  value="'.$web.'" name="web" readonly="readonly"  />
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-3">
                        <label class="f-w-600">Coordinate</label>
                    </div>
                    <div class="col-md-9">
                        <span class="f-11 f-w-600 m-b-10">Calcola la posizione della struttura ricettiva inserendo l\'indirizzo e la località</span>
                        <div id="map" style="width: 720; height: 520px;"></div>
                        <div class="row m-t-10 m-b-10">
                            <div class="col-md-5"><input id="address" type="text" name="address" class="form-control" placeholder="Via xxxxxx NN, Comune" value="'.$indirizzo .', '.$nome_comune.'"></div>
                            <div class="col-md-5"><input id="coordinate" type="text" name="coordinate" class="form-control" value="'.$coordinate.'" readonly></div>
                            <div class="col-md-2"><input type="hidden" id="idsito" name="idsito" value="'.IDSITO.'"><button type="button"  onclick="codeAddress()" class="btn btn-warning btn-sm">Calcola</button></div>

                        </div> 
                        <div id="res"></div>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-3">
                        <label class="f-w-600">Abilita/Disabilita Mappa <i class="fa fa-exclamation-circle text-info" data-toggle="tooltip" title="Check utile ad escludere la mappa generica nei template"></i></label>
                    </div>
                    <div class="col-md-9 text-left">
                        <input type="checkbox"  name="abilita_mappa_" id="abilita_mappa_" '.($abilita_mappa==1?'checked="checked"':'').' value="'.$abilita_mappa.'" />
                        <input type="hidden"   id="abilita_mappa"  name="abilita_mappa" value="'.$abilita_mappa.'" /> 
                    </div>
                </div>
                <div class="row m-t-20">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <button type="button" class="btn btn-primary" id="salvaMappa">Salva</button>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>      
        <script>
                $(document).ready(function(){
                
                '.($coordinate!=''? 'codeAddress();':'').'

                    $("#abilita_mappa_").click(function() {
                        if($("#abilita_mappa_").is(":checked")){
                            $("#abilita_mappa_").attr("value","1");
                            $("#abilita_mappa").attr("value","1");
                        }else{
                            $("#abilita_mappa_").attr("value",0);
                            $("#abilita_mappa_").attr("checked",0);
                            $("#abilita_mappa").attr("value",0);
                        }
                    });
                    // UPDATE MAP
                    $("#salvaMappa").on("click",function(){
                        var idsito = $("#idsito").val();
                        var coordinate = $(\'#coordinate\').val();       
                        var abilita_mappa = $(\'#abilita_mappa\').val(); 
                            $.ajax({
                                url: "'.BASE_URL_SITO.'ajax/generici/mappa.update.php",
                                type: "POST",
                                data: "idsito="+idsito+"&coordinate="+coordinate+"&abilita_mappa="+abilita_mappa+"",
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