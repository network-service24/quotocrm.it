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
					hospitality_politiche.*	
				FROM 
					hospitality_politiche 
				WHERE 
					hospitality_politiche.idsito = ".$_REQUEST['idsito']." ";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){

                            $modale .=' <div class="modal fade" id="ModaleUpdateCondizioni'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleTargetLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Condizioni</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <form method="POST" id="form_mod_politiche'.$row['id'].'" name="form_mod_politiche">
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Nome</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-gavel fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="etichetta'.$row['id'].'" name="etichetta" value="'.$row['etichetta'].'" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Tipo</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-puzzle-piece fa-fw"></i></span>
                                                                                <select class="form-control" name="tipo" id="tipo'.$row['id'].'" style="height:auto">
                                                                                    <option value="0" '.($row['tipo']==0?'selected="selected"':'').'>Preventivi, conferme e prenotazioni</option>
                                                                                    <option value="1" '.($row['tipo']==1?'selected="selected"':'').'>Voucher</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-12 text-center">
                                                                        <input type="hidden" name="id" id="id'.$row['id'].'" value="'.$row['id'].'">
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
                                                                    $("#form_mod_politiche'.$row['id'].'").submit(function () {   
                                                                        var  etichetta  = $("#etichetta'.$row['id'].'").val(); 
                                                                        var  id         = $("#id'.$row['id'].'").val(); 
                                                                        var  tipo       = $("#tipo'.$row['id'].' option:selected").val(); 
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/generici/modifica_politiche.php",
                                                                            type: "POST",
                                                                            data: "action=mod_po&id="+id+"&idsito='.$row['idsito'].'&tipo="+tipo+"&etichetta="+etichetta+"",
                                                                            dataType: "html",
                                                                            success: function(data) {
                                                                                $("#ModaleUpdateCondizioni'.$row['id'].'").modal("hide");
                                                                                $("#condizioni").DataTable().ajax.reload();    
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
                                            <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'impostazioni-add_policy/'.$row['id'].'/"><i class="fa fa-comment-o text-green"></i> Gestione testi </a>                                         
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#modifica'.$row['id'].'").on("click",function(){
                                                            $("#ModaleUpdateCondizioni'.$row['id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                               
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_po'.$row['id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_po'.$row['id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo Record?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/generici/delete_politiche.php",
                                                                    type: "POST",
                                                                    data: "action=del_po&idsito='.$row['idsito'].'&id='.$row['id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#condizioni").DataTable().ajax.reload();    
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

                                        "etichetta"     =>    $row['etichetta'],
                                        "lingua"        =>    $fun->ControlloTestiInseritiPolitiche($row['id'],$row['idsito']),
                                        "tipo"          =>    ($row['tipo']==0?'Preventivi, conferme e prenotazioni':'Voucher'),
                                        "action"        =>    $action.$modale
 
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
