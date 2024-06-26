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
					hospitality_bedzzlebooking.*	
				FROM 
					hospitality_bedzzlebooking 
				WHERE 
					hospitality_bedzzlebooking.idsito = ".$_REQUEST['idsito']." ";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){

                            $modale .=' <div class="modal fade" id="ModaleUpdateBedzzle'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Codici Bedzzle</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <form method="POST" id="form_mod_bedzzle'.$row['Id'].'" name="form_mod_bedzzle">
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Url API</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="UrlHost'.$row['Id'].'" name="UrlHost" value="'.$row['UrlHost'].'" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Proxy Auth (Key)</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="ProxyAuth'.$row['Id'].'" name="ProxyAuth" value="'.$row['ProxyAuth'].'" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Vendor Account (API KEY)</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="VendorAccount'.$row['Id'].'" name="VendorAccount" value="'.$row['VendorAccount'].'" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>
                                                                                Hotel Account
                                                                            </label>                                               
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="HotelAccount'.$row['Id'].'" name="HotelAccount" value="'.$row['HotelAccount'].'" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Url API Setting</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="UrlHostSetting'.$row['Id'].'" name="UrlHostSetting" value="'.$row['UrlHostSetting'].'" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Proxy Auth (Key) Setting</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="ProxyAuthSetting'.$row['Id'].'" name="ProxyAuthSetting" value="'.$row['ProxyAuthSetting'].'" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Vendor Account (API KEY) Setting</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="VendorAccountSetting'.$row['Id'].'" name="VendorAccountSetting" value="'.$row['VendorAccountSetting'].'" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>
                                                                                Hotel Account Setting
                                                                            </label>                                               
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="HotelAccountSetting'.$row['Id'].'" name="HotelAccountSetting" value="'.$row['HotelAccountSetting'].'" required/>
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

                                                                    $("#form_mod_bedzzle'.$row['Id'].'").submit(function () {   
                                                                        var  UrlHost                  = $("#UrlHost'.$row['Id'].'").val(); 
                                                                        var  ProxyAuth                = $("#ProxyAuth'.$row['Id'].'").val(); 
                                                                        var  VendorAccount            = $("#VendorAccount'.$row['Id'].'").val(); 
                                                                        var  HotelAccount             = $("#HotelAccount'.$row['Id'].'").val();
                                                                        var  UrlHostSetting           = $("#UrlHostSetting'.$row['Id'].'").val(); 
                                                                        var  ProxyAuthSetting         = $("#ProxyAuthSetting'.$row['Id'].'").val(); 
                                                                        var  VendorAccountSetting     = $("#VendorAccountSetting'.$row['Id'].'").val(); 
                                                                        var  HotelAccountSetting      = $("#HotelAccountSetting'.$row['Id'].'").val();
                                                                        var  Abilitato                = $("#Abilitato'.$row['Id'].'").val();
                                                                        var  PMS                      = $("#PMS'.$row['Id'].'").val();  
                                                                        var  id                       = $("#id'.$row['Id'].'").val(); 

                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/generici/modifica_bedzzle.php",
                                                                            type: "POST",
                                                                            data: "action=mod_be&id="+id+"&idsito='.$row['idsito'].'&UrlHost="+UrlHost+"&ProxyAuth="+ProxyAuth+"&VendorAccount="+VendorAccount+"&HotelAccount="+HotelAccount+"&UrlHostSetting="+UrlHostSetting+"&ProxyAuthSetting="+ProxyAuthSetting+"&VendorAccountSetting="+VendorAccountSetting+"&HotelAccountSetting="+HotelAccountSetting+"&PMS="+PMS+"&Abilitato="+Abilitato+"",
                                                                            dataType: "html",
                                                                            success: function(data) {
                                                                                $("#ModaleUpdateBedzzle'.$row['Id'].'").modal("hide");
                                                                                $("#bedzzle").DataTable().ajax.reload();    
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
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_bedzzle_pms.php",
                                                                type: "POST",
                                                                data: "action=switch_be&idsito='.$row['idsito'].'&id='.$row['Id'].'&PMS=1",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#bedzzle").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;
                                                        });
                                                        $("#disabilitaPMS'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_bedzzle_pms.php",
                                                                type: "POST",
                                                                data: "action=switch_be&idsito='.$row['idsito'].'&id='.$row['Id'].'&PMS=0",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#bedzzle").DataTable().ajax.reload();    
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
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_bedzzle.php",
                                                                type: "POST",
                                                                data: "action=switch_be&idsito='.$row['idsito'].'&id='.$row['Id'].'&Abilitato=1",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#bedzzle").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;
                                                        });
                                                        $("#disabilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_bedzzle.php",
                                                                type: "POST",
                                                                data: "action=switch_be&idsito='.$row['idsito'].'&id='.$row['Id'].'&Abilitato=0",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#bedzzle").DataTable().ajax.reload();    
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
                                                            $("#ModaleUpdateBedzzle'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                                             
                                            </div>
										</div>';                                               

							$data[] = array(

                                        "url_api"                              =>    $row['UrlHost'],
                                        "proxy"                                =>    $row['ProxyAuth'],
                                        "vendor"                               =>    $row['VendorAccount'],
                                        "account"                              =>    $row['HotelAccount'],
                                        "url_api_setting"                      =>    $row['UrlHostSetting'],
                                        "proxy_setting"                        =>    $row['ProxyAuthSetting'],
                                        "vendor_setting"                       =>    $row['VendorAccountSetting'],
                                        "account_setting"                      =>    $row['HotelAccountSetting'],
                                        "pms"                                  =>    ($row['PMS']==0?'<i       class="fa fa-times text-danger"></i>':'<i class="fa fa-check text-success"></i>'),
                                        "abilitato"                            =>    ($row['Abilitato']==0?'<i class="fa fa-times text-danger"></i>':'<i class="fa fa-check text-success"></i>'),
                                        "action"                               =>    $action.$modale
 
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
