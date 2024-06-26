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
					hospitality_imap_email.*	
				FROM 
					hospitality_imap_email 
				WHERE 
					hospitality_imap_email.idsito = ".$_REQUEST['idsito']." ";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){

                            $modale .=' <div class="modal fade" id="ModaleUpdateImap'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Codici IMAP</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <form method="POST" id="form_mod_imap'.$row['Id'].'" name="form_mod_imap">
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>Portale</label>
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <select  class="form-control" id="Portale'.$row['Id'].'" name="Portale" style="height:auto" required>
                                                                                    <option value="info-alberghi.com" '.($row['Portale']=='info-alberghi.com'?'selected="selected"':'').'>info-alberghi.com</option>
                                                                                    <option value="gabiccemare.com" '.($row['Portale']=='gabiccemare.com'?'selected="selected"':'').'>gabiccemare.com</option>
                                                                                    <option value="italyfamilyhotels.it" '.($row['Portale']=='italyfamilyhotels.it'?'selected="selected"':'').'>italyfamilyhotels.it</option>
                                                                                    <option value="riccioneinhotel.com" '.($row['Portale']=='riccioneinhotel.com'?'selected="selected"':'').'>riccioneinhotel.com</option>
                                                                                    <option value="cesenaticobellavita.it" '.($row['Portale']=='cesenaticobellavita.it'?'selected="selected"':'').'>cesenaticobellavita.it</option>
                                                                                    <option value="familygo.eu" '.($row['Portale']=='familygo.eu'?'selected="selected"':'').'>familygo.eu</option>
                                                                                    <option value="italybikehotels.it" '.($row['Portale']=='italybikehotels.it'?'selected="selected"':'').'>italybikehotels.it</option>
                                                                                    <option value="spahotelscollection.it" '.($row['Portale']=='spahotelscollection.it'?'selected="selected"':'').'>spahotelscollection.it</option>
                                                                                </select>                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> ';

                        if($row['Portale']!='info-alberghi.com'){
                            $modale .='                        <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>Server Email</label>
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="ServerEmail'.$row['Id'].'" name="ServerEmail" value="'.$row['ServerEmail'].'" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>User Email</label>
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="UserEmail'.$row['Id'].'" name="UserEmail"  value="'.$row['UserEmail'].'" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>
                                                                                Password Email
                                                                            </label>                                               
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="PasswordEmail'.$row['Id'].'" name="PasswordEmail" value="'.$row['PasswordEmail'].'" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                            }

                            if($row['Portale']=='info-alberghi.com'){
                                $modale .='                     <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>
                                                                                Hotel ID
                                                                            </label>                                               
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="HotelID'.$row['Id'].'" name="HotelID" value="'.$row['HotelID'].'" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>
                                                                                Type
                                                                            </label>                                               
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <select class="form-control" id="Type'.$row['Id'].'" name="Type" style="height:auto">
                                                                                    <option value="tutte" '.($row['Type']=='tutte'?'selected="selected"':'').'>tutte</option>
                                                                                    <option value="diretta" '.($row['Type']=='diretta'?'selected="selected"':'').'>diretta</option>
                                                                                    <option value="multipla" '.($row['Type']=='multipla'?'selected="selected"':'').'>multipla</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>
                                                                                Url API
                                                                            </label>                                               
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <select class="form-control" id="UrlApi'.$row['Id'].'" name="UrlApi" style="height:auto">
                                                                                    <option value="https://api.info-alberghi.com/api/getEmailAll" '.($row['UrlApi']=='https://api.info-alberghi.com/api/getEmailAll'?'selected="selected"':'').'>https://api.info-alberghi.com/api/getEmailAll</option>
                                                                                    <option value="https://api.info-alberghi.com/api/getEmail" '.($row['UrlApi']=='https://api.info-alberghi.com/api/getEmail'?'selected="selected"':'').'>https://api.info-alberghi.com/api/getEmail</option>
                                                                                    <option value="https://api.info-alberghi.com/api/getEmailToday" '.($row['UrlApi']=='https://api.info-alberghi.com/api/getEmailToday'?'selected="selected"':'').'>https://api.info-alberghi.com/api/getEmailToday</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                            }

                                $modale .='                     <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>Abilitato</label>
                                                                        </div>
                                                                        <div class="col-md-1 text-left">                                            	                                                     
                                                                            <input type="checkbox" class="form-control" id="Abilitato'.$row['Id'].'" name="Abilitato" value="'.$row['Abilitato'].'" '.($row['Abilitato']==1?'checked="checked"':'').'/>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-12 text-center">
                                                                            <input type="hidden" name="id" id="id'.$row['Id'].'" value="'.$row['Id'].'">
                                                                            <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                                            <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                                                        </div>
                                                                    </div>
                                                                </div>                                 
                                                            </form>                     
                                                            <script>
                                                                $(document).ready(function() {
                                                                

                                                                    $("#campi_info_alberghi'.$row['Id'].'").hide();

                                                                    $("#Portale'.$row['Id'].'").on("change",function () {  
                                                                        var  valore  = $("#Portale'.$row['Id'].' option:selected").val(); 

                                                                        if(valore == "info-alberghi.com"){
                                                                            $("#campi_info_alberghi'.$row['Id'].'").show();
                                                                            $("#campi_portali'.$row['Id'].'").hide();
                                                                        }else{
                                                                            $("#campi_portali'.$row['Id'].'").show();
                                                                            $("#campi_info_alberghi'.$row['Id'].'").hide();
                                                                        }
                                                                    });

                                                                    $("#Abilitato'.$row['Id'].'").click(function() {
                                                                        if($("#Abilitato'.$row['Id'].'").is(":checked")){
                                                                            $("#Abilitato'.$row['Id'].'").attr("value","1");
                                                                        }else{
                                                                            $("#Abilitato'.$row['Id'].'").attr("value",false);
                                                                            $("#Abilitato'.$row['Id'].'").attr("checked",false);
                                                                        }
                                                                    });

                                                                    $("#form_mod_imap'.$row['Id'].'").submit(function () {   
                                                                        var  Portale                            = $("#Portale'.$row['Id'].' option:selected").val(); 
                                                                        var  ServerEmail                        = $("#ServerEmail'.$row['Id'].'").val(); 
                                                                        var  UserEmail                          = $("#UserEmail'.$row['Id'].'").val(); 
                                                                        var  PasswordEmail                      = $("#PasswordEmail'.$row['Id'].'").val(); 
                                                                        var  HotelID                            = $("#HotelID'.$row['Id'].'").val();
                                                                    var  Type                               = $("#Type'.$row['Id'].' option:selected").val(); 
                                                                    var  UrlApi                             = $("#UrlApi'.$row['Id'].' option:selected").val();
                                                                        var  Abilitato                = $("#Abilitato'.$row['Id'].'").val();  
                                                                        var  id                       = $("#id'.$row['Id'].'").val(); 

                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/generici/modifica_imap.php",
                                                                            type: "POST",
                                                                            data: "action=mod_im&id="+id+"&idsito='.$row['idsito'].'&Portale="+Portale+"&ServerEmail="+ServerEmail+"&UserEmail="+UserEmail+"&PasswordEmail="+PasswordEmail+"&HotelID="+HotelID+"&Type="+Type+"&UrlApi="+UrlApi+"&Abilitato="+Abilitato+"",
                                                                            dataType: "html",
                                                                            success: function(data) {
                                                                                $("#ModaleUpdateImap'.$row['Id'].'").modal("hide");
                                                                                $("#imap").DataTable().ajax.reload();    
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
                                                '.($row['Abilitato']==0?
                                                '<a class="dropdown-item waves-effect waves-light" href="#" id="abilita'.$row['Id'].'"><i class="fa fa-eye text-green"></i> Abilita</a>'
                                                :
												'<a class="dropdown-item waves-effect waves-light" href="#" id="disabilita'.$row['Id'].'"><i class="fa fa-eye-slash text-gray"></i> Disabilita</a>'
                                                ).'
											    <script>
                                                    $(document).ready(function(){ 
                                                        $("#abilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_imap.php",
                                                                type: "POST",
                                                                data: "action=switch_im&idsito='.$row['idsito'].'&id='.$row['Id'].'&Abilitato=1",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#imap").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;
                                                        });
                                                        $("#disabilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_imap.php",
                                                                type: "POST",
                                                                data: "action=switch_im&idsito='.$row['idsito'].'&id='.$row['Id'].'&Abilitato=0",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#imap").DataTable().ajax.reload();    
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
                                                            $("#ModaleUpdateImap'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>   
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_im'.$row['Id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_im'.$row['Id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo Portale?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/generici/delete_imap.php",
                                                                    type: "POST",
                                                                    data: "action=del_im&idsito='.$row['idsito'].'&id='.$row['Id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#imap").DataTable().ajax.reload();    
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

                                        "portale"                             =>    $row['Portale'],
                                        "server"                              =>    ($row['Portale']!='info-alberghi.com'?$row['ServerEmail']:''),
                                        "user"                                =>    ($row['Portale']!='info-alberghi.com'?$row['UserEmail']:''),
                                        "pass"                                =>    ($row['Portale']!='info-alberghi.com'?$row['PasswordEmail']:''),
                                        "hotelid"                             =>    ($row['Portale']=='info-alberghi.com'?$row['HotelID']:''),
                                        "type"                                =>    ($row['Portale']=='info-alberghi.com'?$row['Type']:''),
                                        "url_api"                             =>    ($row['Portale']=='info-alberghi.com'?$row['UrlApi']:''),
                                        "abilitato"                           =>    ($row['Abilitato']==0?'<i class="fa fa-times text-danger"></i>':'<i class="fa fa-check text-success"></i>'),
                                        "action"                              =>    $action.$modale
 
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
