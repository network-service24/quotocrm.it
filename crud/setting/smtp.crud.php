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
					hospitality_smtp.*	
				FROM 
					hospitality_smtp 
				WHERE 
					hospitality_smtp.idsito = ".$_REQUEST['idsito']." ";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){

                            $modale .=' <div class="modal fade" id="ModaleUpdateSmtp'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Codici SMTP</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <form method="POST" id="form_mod_smtp'.$row['Id'].'" name="form_mod_smtp">
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>Autorizzazione</label>
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="SMTPAuth'.$row['Id'].'" name="SMTPAuth" value="'.$row['SMTPAuth'].'" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>Host</label>
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="SMTPHost'.$row['Id'].'" name="SMTPHost" value="'.$row['SMTPHost'].'" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>Porta</label>
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="SMTPPort'.$row['Id'].'" name="SMTPPort"  value="'.$row['SMTPPort'].'" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>
                                                                                Sicurezza
                                                                            </label>                                               
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="SMTPSecure'.$row['Id'].'" name="SMTPSecure" value="'.$row['SMTPSecure'].'" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>
                                                                                Username
                                                                            </label>                                               
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="SMTPUsername'.$row['Id'].'" name="SMTPUsername" value="'.$row['SMTPUsername'].'" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>
                                                                                Password
                                                                            </label>                                               
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="SMTPPassword'.$row['Id'].'" name="SMTPPassword" value="'.$row['SMTPPassword'].'" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <label>
                                                                                Numero Invii Settimanali
                                                                            </label>                                               
                                                                        </div>
                                                                        <div class="col-md-8">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="NumberSend'.$row['Id'].'" name="NumberSend" value="'.$row['NumberSend'].'" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">  
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

                                                                    $("#Abilitato'.$row['Id'].'").click(function() {
                                                                        if($("#Abilitato'.$row['Id'].'").is(":checked")){
                                                                            $("#Abilitato'.$row['Id'].'").attr("value","1");
                                                                        }else{
                                                                            $("#Abilitato'.$row['Id'].'").attr("value",false);
                                                                            $("#Abilitato'.$row['Id'].'").attr("checked",false);
                                                                        }
                                                                    });

                                                                    $("#form_mod_smtp'.$row['Id'].'").submit(function () {   
                                                                        var  SMTPAuth                        = $("#SMTPAuth'.$row['Id'].'").val(); 
                                                                        var  SMTPHost                        = $("#SMTPHost'.$row['Id'].'").val(); 
                                                                        var  SMTPPort                        = $("#SMTPPort'.$row['Id'].'").val(); 
                                                                        var  SMTPSecure                      = $("#SMTPSecure'.$row['Id'].'").val(); 
                                                                        var  SMTPUsername                    = $("#SMTPUsername'.$row['Id'].'").val();
                                                                        var  SMTPPassword                    = $("#SMTPPassword'.$row['Id'].'").val();
                                                                        var  NumberSend                      = $("#NumberSend'.$row['Id'].'").val();
                                                                        var  Abilitato                = $("#Abilitato'.$row['Id'].'").val();  
                                                                        var  id                       = $("#id'.$row['Id'].'").val(); 

                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/generici/modifica_smtp.php",
                                                                            type: "POST",
                                                                            data: "action=mod_sm&id="+id+"&idsito='.$row['idsito'].'&SMTPAuth="+SMTPAuth+"&SMTPHost="+SMTPHost+"&SMTPPort="+SMTPPort+"&SMTPSecure="+SMTPSecure+"&SMTPUsername="+SMTPUsername+"&SMTPPassword="+SMTPPassword+"&NumberSend="+NumberSend+"&Abilitato="+Abilitato+"",
                                                                            dataType: "html",
                                                                            success: function(data) {
                                                                                $("#ModaleUpdateSmtp'.$row['Id'].'").modal("hide");
                                                                                $("#smtp").DataTable().ajax.reload();    
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
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_smtp.php",
                                                                type: "POST",
                                                                data: "action=switch_sm&idsito='.$row['idsito'].'&id='.$row['Id'].'&Abilitato=1",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#smtp").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;
                                                        });
                                                        $("#disabilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_smtp.php",
                                                                type: "POST",
                                                                data: "action=switch_sm&idsito='.$row['idsito'].'&id='.$row['Id'].'&Abilitato=0",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#smtp").DataTable().ajax.reload();    
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
                                                            $("#ModaleUpdateSmtp'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                                             
                                            </div>
										</div>';                                               

							$data[] = array(

                                        "autorizzazione"                   =>    $row['SMTPAuth'],
                                        "host"                             =>    $row['SMTPHost'],
                                        "porta"                            =>    $row['SMTPPort'],
                                        "sicurezza"                        =>    $row['SMTPSecure'],
                                        "user"                             =>    $row['SMTPUsername'],
                                        "pass"                             =>    $row['SMTPPassword'],
                                        "n_invii"                          =>    $row['NumberSend'],
                                        "abilitato"                        =>    ($row['Abilitato']==0?'<i class="fa fa-times text-danger"></i>':'<i class="fa fa-check text-success"></i>'),
                                        "action"                           =>    $action.$modale
 
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
