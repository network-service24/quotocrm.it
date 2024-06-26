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
					hospitality_numero_listini.*	
				FROM 
					hospitality_numero_listini 
				WHERE 
					hospitality_numero_listini.idsito = ".$_REQUEST['idsito']." ";

	$rec = $dbMysqli->query($select);


	foreach($rec as $key => $row){

                            $modale .=' <div class="modal fade" id="ModaleUpdateListini'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Listino</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <form method="POST" id="form_mod_listini'.$row['Id'].'" name="form_mod_listini">
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Listino</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-euro fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="Listino'.$row['Id'].'" name="Listino" value="'.$row['Listino'].'" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Abilitato</label>
                                                                        </div>
                                                                        <div class="col-md-1">                                            	                                                     
                                                                            <input type="checkbox" class="form-control" id="Abilitato'.$row['Id'].'" name="Abilitato" value="'.$row['Abilitato'].'" '.($row['Abilitato']==1?'checked="checked"':'').'/>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-12 text-center">
                                                                            <input type="hidden" name="Id" id="Id'.$row['Id'].'" value="'.$row['Id'].'">
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

                                                                    $("#Abilitato'.$row['Id'].'").click(function() {
                                                                        if($("#Abilitato'.$row['Id'].'").is(":checked")){
                                                                            $("#Abilitato'.$row['Id'].'").attr("value","1");
                                                                        }else{
                                                                            $("#Abilitato'.$row['Id'].'").attr("value",false);
                                                                            $("#Abilitato'.$row['Id'].'").attr("checked",false);
                                                                        }
                                                                    });

                                                                    $("#form_mod_listini'.$row['Id'].'").submit(function () {   
                                                                        var  Listino  = $("#Listino'.$row['Id'].'").val(); 
                                                                        var  Id        = $("#Id'.$row['Id'].'").val(); 
                                                                        var  Abilitato = $("#Abilitato'.$row['Id'].'").val(); 
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/modifica_listino.php",
                                                                            type: "POST",
                                                                            data: "action=mod_listino&Id="+Id+"&idsito='.$row['idsito'].'&Listino="+Listino+"&Abilitato="+Abilitato+"",
                                                                            dataType: "html",
                                                                            success: function(data) {
                                                                                $("#ModaleUpdateListini'.$row['Id'].'").modal("hide");
                                                                                $("#listini").DataTable().ajax.reload();    
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
                                            <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'disponibilita-listino_tabella/'.$row['Id'].'/"><i class="fa fa-euro text-yellow"></i> Gestione periodi e prezzi listino </a>                                         
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
                                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/switch_listino.php",
                                                            type: "POST",
                                                            data: "action=switch_listino&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=1",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#listini").DataTable().ajax.reload();    
                                                            }
                                                        });
                                                        return false;
                                                    });
                                                    $("#disabilita'.$row['Id'].'").on("click",function(){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/disponibilita/switch_listino.php",
                                                            type: "POST",
                                                            data: "action=switch_listino&idsito='.$row['idsito'].'&Id='.$row['Id'].'&Abilitato=0",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#listini").DataTable().ajax.reload();    
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
                                                            $("#ModaleUpdateListini'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                                             
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_listino'.$row['Id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_listino'.$row['Id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di eliminare il listino e la tabella dei periodi e prezzi?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/disponibilita/delete_listino.php",
                                                                    type: "POST",
                                                                    data: "action=del_listino&idsito='.$row['idsito'].'&Id='.$row['Id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#listini").DataTable().ajax.reload();    
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

                                        "tipo"      => $row['Listino'],
                                        "abilitato" => ($row['Abilitato'] == 0?'<i class = "fa fa-times text-danger"></i>': '<i class = "fa fa-check text-success"></i>'),
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
