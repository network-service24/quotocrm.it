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
					hospitality_tipo_servizi_lingua.*	
				FROM 
					hospitality_tipo_servizi_lingua 
				WHERE 
					hospitality_tipo_servizi_lingua.idsito = ".$_REQUEST['idsito']." 
                AND
                    hospitality_tipo_servizi_lingua.servizio_id = ".$_REQUEST['id']." ";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){

                        $modale = '<div class="modal fade" id="ModaleUpdateTestoServizi'.$row['Id'].'" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content" style="width:100%">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica contenuti per il Servizio</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body  p-l-50 p-r-50">

                                                                    <form method="POST" id="form_up_servizi'.$row['Id'].'" name="form_up_servizi">
                                                                    
                                                                        <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    <label>Lingua</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    '.$fun->SelectLingue('lingue','lingue'.$row['Id'],$row['lingue']).'
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                         <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    <label>Servizio</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="Servizio" id="Servizio'.$row['Id'].'" value="'.$row['Servizio'].'" class="form-control" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-md-2">
                                                                                <label>Descrizione</label>
                                                                            </div>
                                                                            <div class="col-md-9">
                                                                                <div class="input-group">
                                                                                    <textarea class="form-control Width100" id="Descrizione'.$row['Id'].'"  name="Descrizione" style="height:150px">'.$row['Descrizione'].'</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                        <div class="form-group">  
                                                                            <div class="row">
                                                                                <div class="col-md-12 text-center">
                                                                                    <input type="hidden" name="Id"  id="Id'.$row['Id'].'" value="'.$row['Id'].'">
                                                                                    <input type="hidden" name="idsito"  value="'.$row['idsito'].'">
                                                                                    <input type="hidden" name="action"  value="mod_servizio">
                                                                                    <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                                                    <button type="submit" class="btn btn-primary col-md-5">MODIFICA</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>                                 
                                                                    </form>
                                                                    <script>
                                                                        $(document).ready(function() {
                                                                            $("#form_up_servizi'.$row['Id'].'").submit(function () {   
                                                                                var  lingua      = $("#lingue'.$row['Id'].' option:selected").val(); 
                                                                                var  Servizio    = $("#Servizio'.$row['Id'].'").val(); 
                                                                                var  Descrizione = $("#Descrizione'.$row['Id'].'").val(); 
                                                                                var  Id          = $("#Id'.$row['Id'].'").val();    
                                                                                $.ajax({
                                                                                    url: "'.BASE_URL_SITO.'ajax/disponibilita/modifica_testo_servizio_aggiuntivo.php",
                                                                                    type: "POST",
                                                                                    data: "action=mod_servizi&idsito='.$row['idsito'].'&Id="+Id+"&lingua="+lingua+"&Servizio="+Servizio+"&Descrizione="+Descrizione+"",
                                                                                    dataType: "html",
                                                                                    success: function(data) {
                                                                                        $("#ModaleUpdateTestoServizi'.$row['Id'].'").modal("hide");
                                                                                        $("#add_servizi_aggiuntivi").DataTable().ajax.reload();    
                                                                                    }
                                                                                });
                                                                                return false; // con false senza refresh della pagina                                       
                                                                            });
                                                                        });
                                                                    </script>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>           
                                        </div>'."\r\n";

 							$action = ' <div class="btn-group dropdown-split-default"  id="azioniPrev">
											<a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
											</a>
											<div class="dropdown-menu">
                                            <a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['Id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#modifica'.$row['Id'].'").on("click",function(){
                                                            $("#ModaleUpdateTestoServizi'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                               
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_testo_servizi'.$row['Id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_testo_servizi'.$row['Id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo Record?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/disponibilita/delete_testo_servizio_aggiuntivo.php",
                                                                    type: "POST",
                                                                    data: "action=del_t_servizi&idsito='.$row['idsito'].'&Id='.$row['Id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#add_servizi_aggiuntivi").DataTable().ajax.reload();    
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

                                        "lingua"      => '<img src = "'.BASE_URL_SITO.'img/flags/mini/'.$row['lingue'].'.png">',
                                        "servizio"    => $row['Servizio'],
                                        "descrizione" => $row['Descrizione'],
                                        "action"      => $action.$modale
 
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
