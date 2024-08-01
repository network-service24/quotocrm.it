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
	$select = "SELECT * FROM hospitality_configurazioni  WHERE idsito = ".$_REQUEST['idsito']." AND parametro != 'check_pagination'";
	$rec = $dbMysqli->query($select);
	
	foreach($rec as $key => $row){

							$action = ' <div class="btn-group dropdown-split-default"  id="azioniPrev">
											<a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
											</a>
											<div class="dropdown-menu">
 												'.($row['valore']==0?
                                                '<a class="dropdown-item waves-effect waves-light" href="#" id="abilita'.$row['Id'].'"><i class="fa fa-eye text-green"></i> Abilita</a>'
                                                :
												'<a class="dropdown-item waves-effect waves-light" href="#" id="disabilita'.$row['Id'].'"><i class="fa fa-eye-slash text-gray"></i> Disabilita</a>'
                                                ).'
											    <script>
                                                    $(document).ready(function(){ 
                                                        $("#abilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_plugin.php",
                                                                type: "POST",
                                                                data: "action=switch_pl&idsito='.$row['idsito'].'&id='.$row['Id'].'&valore=1",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#configurazioni").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;
                                                        });
                                                        $("#disabilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_plugin.php",
                                                                type: "POST",
                                                                data: "action=switch_pl&idsito='.$row['idsito'].'&id='.$row['Id'].'&valore=0",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#configurazioni").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;                                                           
                                                        });
                                                    });
                                                </script> 

											</div>
										</div>';

							$data[] = array(
                                "parametro"             => $fun->descr_parametro_config($row['parametro']),
                                "descrizione"           => nl2br($row['descrizione']),																	
                                "valore"                => ($row['valore']==0?'<i class="fa fa-times text-red"></i>':'<i class="fa fa-check text-green"></i>'),
								"action"                => $action
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
