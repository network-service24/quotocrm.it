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
					hospitality_precheckin.*
				FROM 
                    hospitality_precheckin 
				WHERE 
                    hospitality_precheckin.idsito = ".$_REQUEST['idsito']."
                AND
                    hospitality_precheckin.Lingua = 'it'";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){

        $modale .= '<div class="modal fade" id="ModaleUpPrecheckin'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Modifica modulo per Info Utili</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">

                                    <form method="POST" id="form_up_precheckin'.$row['id'].'" name="form_up_precheckin" method="POST">                                          
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Etichetta Modulo</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="etichetta'.$row['id'].'" name="etichetta" value="'.$row['etichetta'].'">
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
                                            <input type="checkbox" class="form-control" id="abilitato'.$row['id'].'" name="abilitato" value="'.$row['abilitato'].'" '.($row['abilitato']==1?'checked="checked"':'').'/>
                                            </div>
                                        </div>
                                    </div> 
                                        <div class="form-group">  
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <input type="hidden" name="idsito"  value="'.IDSITO.'">
                                                    <input type="hidden" name="id" id="id'.$row['id'].'" value="'.$row['id'].'">
                                                    <input type="hidden" name="action"  value="mod_precheckin">
                                                    <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                    <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                                </div>
                                            </div>
                                        </div>                                 
                                    </form>
                                    <script>
                                        $(document).ready(function() {

                                            $("#abilitato'.$row['id'].'").click(function() {
                                                if($("#abilitato'.$row['id'].'").is(":checked")){
                                                    $("#abilitato'.$row['id'].'").attr("value","1");
                                                }else{
                                                    $("#abilitato'.$row['id'].'").attr("value",false);
                                                    $("#abilitato'.$row['id'].'").attr("checked",false);
                                                }
                                            });

                                            $("#form_up_precheckin'.$row['id'].'").submit(function () {   
                                                var  etichetta = $("#etichetta'.$row['id'].'").val();  
                                                var  abilitato = $("#abilitato'.$row['id'].'").val();  
                                                var  id        = $("#id'.$row['id'].'").val();
                                                $.ajax({
                                                    url: "'.BASE_URL_SITO.'ajax/autoresponder/modifica_modulo_precheckin.php",
                                                    type: "POST",
                                                    data: "action=mod_precheckin&id="+id+"&idsito='.IDSITO.'&etichetta="+etichetta+"&abilitato="+abilitato+"",
                                                    dataType: "html",
                                                    success: function(data) {
                                                        $("#ModaleUpPrecheckin'.$row['id'].'").modal("hide");
                                                        $("#precheckin_content").DataTable().ajax.reload();    
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
                                            <a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#modifica'.$row['id'].'").on("click",function(){
                                                            $("#ModaleUpPrecheckin'.$row['id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                               
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_precheckin'.$row['id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_precheckin'.$row['id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo Record?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/autoresponder/delete_modulo_precheckin.php",
                                                                    type: "POST",
                                                                    data: "action=del_precheckin&idsito='.$row['idsito'].'&id='.$row['id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#precheckin_content").DataTable().ajax.reload();    
                                                                    }
                                                                });
                                                                return false;
                                                            }
                                                        });
                                                    });
                                                </script>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'autoresponder-configura_contenuti_info_utili/'.$row['id'].'/"><i class="fa fa-comment-o text-green"></i> Gestione Contenuti Mail </a>  
                                                                           
                                            </div>
										</div>';                                               

							$data[] = array(

                                "nome"      => $row['etichetta'],
                                "oggetto"   => $fun->ControlloTestiInseritiOggettoInfoUtili($row['id'],$row['idsito']),
                                "testo"     => $fun->ControlloTestiInseritiMailInfoUtili($row['id'],$row['idsito']),
                                "abilitato" => ($row['abilitato'] == 0?'<i class = "fa fa-times text-danger"></i>': '<i class = "fa fa-check text-success"></i>'),
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
