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
					hospitality_ericsoftbooking.*	
				FROM 
					hospitality_ericsoftbooking 
				WHERE 
					hospitality_ericsoftbooking.idsito = ".$_REQUEST['idsito']." ";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){

                            $modale .=' <div class="modal fade" id="ModaleUpdateEricSoft'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Codici EricSoft</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <form method="POST" id="form_mod_ericsoft'.$row['Id'].'" name="form_mod_ericsoft">
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>Url API</label>
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="UrlHost'.$row['Id'].'" name="UrlHost" value="'.$row['UrlHost'].'" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>Licenza</label>
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="LicenzaId'.$row['Id'].'" name="LicenzaId" value="'.$row['LicenzaId'].'" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>Provider Code</label>
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="ProviderCode'.$row['Id'].'" name="ProviderCode" value="'.$row['ProviderCode'].'" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>
                                                                                Provider API KEY
                                                                            </label>                                               
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="ProviderApiKey'.$row['Id'].'" name="ProviderApiKey" value="'.$row['ProviderApiKey'].'" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>Abilitato PMS</label>
                                                                        </div>
                                                                        <div class="col-md-1">                                            	                                                     
                                                                             <input type="checkbox" class="form-control" id="PMS'.$row['Id'].'" name="PMS" value="'.$row['PMS'].'" '.($row['PMS']==1?'checked="checked"':'').'/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>Abilitato Booking</label>
                                                                        </div>
                                                                        <div class="col-md-1">                                            	                                                     
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

                                                                    $("#Abilitato'.$row['Id'].'").click(function() {
                                                                        if($("#Abilitato'.$row['Id'].'").is(":checked")){
                                                                            $("#Abilitato'.$row['Id'].'").attr("value","1");
                                                                        }else{
                                                                            $("#Abilitato'.$row['Id'].'").attr("value",false);
                                                                            $("#Abilitato'.$row['Id'].'").attr("checked",false);
                                                                        }
                                                                    });

                                                                    $("#PMS'.$row['Id'].'").click(function() {
                                                                        if($("#PMS'.$row['Id'].'").is(":checked")){
                                                                            $("#PMS'.$row['Id'].'").attr("value","1");
                                                                        }else{
                                                                            $("#PMS'.$row['Id'].'").attr("value",false);
                                                                            $("#PMS'.$row['Id'].'").attr("checked",false);
                                                                        }
                                                                    });

                                                                    $("#form_mod_ericsoft'.$row['Id'].'").submit(function () {   
                                                                        var  UrlHost                  = $("#UrlHost'.$row['Id'].'").val(); 
                                                                        var  LicenzaId                = $("#LicenzaId'.$row['Id'].'").val(); 
                                                                        var  ProviderCode             = $("#ProviderCode'.$row['Id'].'").val(); 
                                                                        var  ProviderApiKey           = $("#ProviderApiKey'.$row['Id'].'").val();
                                                                        var  Abilitato                = $("#Abilitato'.$row['Id'].'").val();
                                                                        var  PMS                      = $("#PMS'.$row['Id'].'").val();  
                                                                        var  id                       = $("#id'.$row['Id'].'").val(); 

                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/generici/modifica_ericsoft.php",
                                                                            type: "POST",
                                                                            data: "action=mod_es&id="+id+"&idsito='.$row['idsito'].'&UrlHost="+UrlHost+"&LicenzaId="+LicenzaId+"&ProviderCode="+ProviderCode+"&ProviderApiKey="+ProviderApiKey+"&PMS="+PMS+"&Abilitato="+Abilitato+"",
                                                                            dataType: "html",
                                                                            success: function(data) {
                                                                                $("#ModaleUpdateEricSoft'.$row['Id'].'").modal("hide");
                                                                                $("#ericsoft").DataTable().ajax.reload();    
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
                                                '.($row['PMS']==0?
                                                '<a class="dropdown-item waves-effect waves-light" href="#" id="abilitaPMS'.$row['Id'].'"><i class="fa fa-eye text-green"></i> Abilita PMS</a>'
                                                :
												'<a class="dropdown-item waves-effect waves-light" href="#" id="disabilitaPMS'.$row['Id'].'"><i class="fa fa-eye-slash text-gray"></i> Disabilita PMS</a>'
                                                ).'
											    <script>
                                                    $(document).ready(function(){ 
                                                        $("#abilitaPMS'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_ericsoft_pms.php",
                                                                type: "POST",
                                                                data: "action=switch_es&idsito='.$row['idsito'].'&id='.$row['Id'].'&PMS=1",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#ericsoft").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;
                                                        });
                                                        $("#disabilitaPMS'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_ericsoft_pms.php",
                                                                type: "POST",
                                                                data: "action=switch_es&idsito='.$row['idsito'].'&id='.$row['Id'].'&PMS=0",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#ericsoft").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;                                                           
                                                        });
                                                    });
                                                </script>                                               
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
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_ericsoft.php",
                                                                type: "POST",
                                                                data: "action=switch_es&idsito='.$row['idsito'].'&id='.$row['Id'].'&Abilitato=1",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#ericsoft").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;
                                                        });
                                                        $("#disabilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_ericsoft.php",
                                                                type: "POST",
                                                                data: "action=switch_es&idsito='.$row['idsito'].'&id='.$row['Id'].'&Abilitato=0",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#ericsoft").DataTable().ajax.reload();    
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
                                                            $("#ModaleUpdateEricSoft'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                                             
                                            </div>
										</div>';                                               

							$data[] = array(

                                        "url_api"                      =>    $row['UrlHost'],
                                        "licenza"                      =>    $row['LicenzaId'],
                                        "provider_code"                =>    $row['ProviderCode'],
                                        "provider_api_key"             =>    $row['ProviderApiKey'],
                                        "pms"                          =>    ($row['PMS']==0?'<i       class="fa fa-times text-danger"></i>':'<i class="fa fa-check text-success"></i>'),
                                        "abilitato"                    =>    ($row['Abilitato']==0?'<i class="fa fa-times text-danger"></i>':'<i class="fa fa-check text-success"></i>'),
                                        "action"                       =>    $action.$modale
 
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
