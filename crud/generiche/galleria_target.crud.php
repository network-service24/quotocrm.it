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
					hospitality_tipo_gallery.*	
				FROM 
					hospitality_tipo_gallery 
				WHERE 
					hospitality_tipo_gallery.idsito = ".$_REQUEST['idsito']."";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){

        $modale = '<div class="modal fade" id="ModaleUpdateTarget'.$row['Id'].'" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Modifica Target Gallery</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form_mod_galleria_target'.$row['Id'].'" name="form_mod_galleria_target">                                          
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3 text-center">
                                                    <label>Target Gallery</label>
                                                </div>
                                                <div class="col-md-7">
                                                <div class="input-group input-group-primary">
                                                <span class="input-group-addon"><i class="fa fa-bed fa-fw"></i></span>
                                                <input type="text" class="form-control" id="TargetGallery'.$row['Id'].'" name="TargetGallery" value="'.$row['TargetGallery'].'" required/>
                                            </div>
                                                </div>
                                            </div>                            
                                        </div>
                                        <div class="form-group">  
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <input type="hidden"  id="Id'.$row['Id'].'" name="Id" value="'.$row['Id'].'" />
                                                    <input type="hidden"  id="TargetType'.$row['Id'].'" name="TargetType" value="'.$row['TargetType'].'" />
                                                    <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                    <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                                </div>
                                            </div>
                                        </div>                                 
                                    </form> 
                                    <script>
                                    $(document).ready(function() {
                                     

                                        $("#form_mod_galleria_target'.$row['Id'].'").submit(function () {  
                                            var  TargetGallery = $("#TargetGallery'.$row['Id'].'").val();
                                            var TargetType     = $("#TargetType'.$row['Id'].'").val();
                                            var  Id            = $("#Id'.$row['Id'].'").val();  
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generiche/modifica_target_gallery.php",
                                                type: "POST",
                                                data: "action=mod_target_gallery&idsito='.$row['idsito'].'&TargetGallery="+TargetGallery+"&Id="+Id+"&TargetType="+TargetType+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleUpdateTarget'.$row['Id'].'").modal("hide");
                                                    $("#galleria_target").DataTable().ajax.reload();    
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
                                            <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'generiche-gallery_target/'.$row['Id'].'/'.urlencode($row['TargetGallery']).'/"><i class="fa fa-photo text-blue"></i> Gestione galleria  </a>                                         
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['Id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#modifica'.$row['Id'].'").on("click",function(){
                                                            $("#ModaleUpdateTarget'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                             
                                            </div>
										</div>';                                               

							$data[] = array(

                                        "etichetta"    => $row['TargetGallery'],
                                        "img_inserite" => $fun->ControlloGalleryTargetInserito($row['Id'],$row['idsito']),
                                        "action"       => $action.$modale
 
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
