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


    	$select  = "SELECT 
					hospitality_contenuti_email.*	
				FROM 
					hospitality_contenuti_email 
				WHERE 
					hospitality_contenuti_email.idsito = ".$_REQUEST['idsito']."";

	$rec = $dbMysqli->query($select);

	foreach($rec as $key => $row){

                           $modale .=' <div class="modal fade" id="ModaleUpdatePreventivo'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica contenuto Email di Preventivo </h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <form method="POST" id="form_mod_benvenuto'.$row['Id'].'" name="form_mod_benvenuto">
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Numero giorni DOPO del Check-in</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-navicon fa-fw"></i></span>
                                                                                <select class="form-control" id="numero_giorni'.$row['Id'].'" name="numero_giorni" required style="height:auto">
                                                                                    <option value="0" '.($row['numero_giorni']=='0'?'selected="selected"':'').'>0</option>
                                                                                    <option value="1" '.($row['numero_giorni']=='1'?'selected="selected"':'').'>1</option>
                                                                                    <option value="2" '.($row['numero_giorni']=='2'?'selected="selected"':'').'>2</option>
                                                                                    <option value="3" '.($row['numero_giorni']=='3'?'selected="selected"':'').'>3</option>
                                                                                    <option value="4" '.($row['numero_giorni']=='4'?'selected="selected"':'').'>4</option>
                                                                                    <option value="5" '.($row['numero_giorni']=='5'?'selected="selected"':'').'>5</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Abilita</label>
                                                                        </div>
                                                                        <div class="col-md-1">                                            	                                                     
                                                                            <input type="checkbox" class="form-control" id="abilita'.$row['Id'].'" name="abilita" value="'.$row['abilita'].'" '.($row['abilita']==1?'checked="checked"':'').'/>
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
                                                            </div> 
                                                            <div class="col-md-2"></div>
                                                            </div>                      
                                                            <script>
                                                                $(document).ready(function() {

                                                                    $("#abilita'.$row['Id'].'").click(function() {
                                                                        if($("#abilita'.$row['Id'].'").is(":checked")){
                                                                            $("#abilita'.$row['Id'].'").attr("value","1");
                                                                        }else{
                                                                            $("#abilita'.$row['Id'].'").attr("value",false);
                                                                            $("#abilita'.$row['Id'].'").attr("checked",false);
                                                                        }
                                                                    });

                                                                    $("#form_mod_benvenuto'.$row['Id'].'").submit(function () {   
                                                                        var  numero_giorni  = $("#numero_giorni'.$row['Id'].' option:selected").val(); 
                                                                        var  id             = $("#id'.$row['Id'].'").val(); 
                                                                        var  abilita        = $("#abilita'.$row['Id'].'").val(); 
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/autoresponder/modifica_benvenuto.php",
                                                                            type: "POST",
                                                                            data: "action=mod_benvenuto&id="+id+"&idsito='.$row['idsito'].'&numero_giorni="+numero_giorni+"&abilita="+abilita+"",
                                                                            dataType: "html",
                                                                            success: function(data) {
                                                                                $("#ModaleUpdatePreventivo'.$row['Id'].'").modal("hide");
                                                                                $("#benvenuto").DataTable().ajax.reload();    
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
                                        
                                                '.($row['abilita']==0?
                                                '<a class="dropdown-item waves-effect waves-light" href="#" id="check_abilita'.$row['Id'].'"><i class="fa fa-eye text-green"></i> Abilita</a>'
                                                :
												'<a class="dropdown-item waves-effect waves-light" href="#" id="check_disabilita'.$row['Id'].'"><i class="fa fa-eye-slash text-gray"></i> Disabilita</a>'
                                                ).'
											    <script>
                                                    $(document).ready(function(){ 
                                                        $("#check_abilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/autoresponder/switch_benvenuto.php",
                                                                type: "POST",
                                                                data: "action=switch_benvenuto&idsito='.$row['idsito'].'&id='.$row['Id'].'&abilita=1",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#benvenuto").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;
                                                        });
                                                        $("#check_disabilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/autoresponder/switch_benvenuto.php",
                                                                type: "POST",
                                                                data: "action=switch_benvenuto&idsito='.$row['idsito'].'&id='.$row['Id'].'&abilita=0",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#benvenuto").DataTable().ajax.reload();    
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
                                                            $("#ModaleUpdatePreventivo'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                            
                              
                                            </div>
										</div>';                                              

							$data[] = array(

                                        "lingua"    => '<img src="'.BASE_URL_SITO.'img/flags/mini/'.$row['Lingua'].'.png">',
                                        "tipo"      => $row['TipoRichiesta'],
                                        "oggetto"   => $row['Oggetto'],
                                        "messaggio" => $row['Messaggio'],
                                        "abilitato" => ($row['abilita'] == 0?'<i class="fa fa-times text-danger"></i>': '<i class="fa fa-check text-success"></i>'),
                                        "action"    =>   $action.$modale
 
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
