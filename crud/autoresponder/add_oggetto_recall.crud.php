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
					hospitality_dizionario_lingua.*	
				FROM 
                    hospitality_dizionario_lingua 
				WHERE 
                    hospitality_dizionario_lingua.idsito = ".$_REQUEST['idsito']." 
                AND
                    hospitality_dizionario_lingua.id_dizionario = ".$_REQUEST['id']." ";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){

                        $modale = '<div class="modal fade" id="ModaleUpdateTestoOggetto'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content" style="width:100%">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica contenuti per l\'oggetto mail di Recall Preventivi</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body  p-l-50 p-r-50">

                                                                    <form method="POST" id="form_up_oggetto'.$row['id'].'" name="form_up_oggetto" method="POST">
                                                                    
                                                                        <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    <label>Lingua</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    '.$fun->SelectLingue('Lingua','Lingua'.$row['id'],$row['Lingua']).'
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                         <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    <label>Oggetto</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                     <input type="text" class="form-control" id="testo'.$row['id'].'" name="testo" value="'.$row['testo'].'">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">  
                                                                            <div class="row">
                                                                                <div class="col-md-12 text-center">
                                                                                    <input type="hidden" name="id"  id="id'.$row['id'].'" value="'.$row['id'].'">
                                                                                    <input type="hidden" name="idsito"  value="'.$row['idsito'].'">
                                                                                    <input type="hidden" name="action"  value="mod_oggetto">
                                                                                    <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                                                    <button type="submit" class="btn btn-primary col-md-5">MODIFICA</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>                                 
                                                                    </form>
                                                                    <script>
                                                                        $(document).ready(function() {
                                                                            $("#form_up_oggetto'.$row['id'].'").submit(function () {   
                                                                                var  lingua   = $("#Lingua'.$row['id'].' option:selected").val(); 
                                                                                var  oggetto  = $("#testo'.$row['id'].'").val(); 
                                                                                var  id       = $("#id'.$row['id'].'").val();    
                                                                                $.ajax({
                                                                                    url: "'.BASE_URL_SITO.'ajax/autoresponder/modifica_testo_oggetto_recall.php",
                                                                                    type: "POST",
                                                                                    data: "action=mod_oggetto&idsito='.$row['idsito'].'&id="+id+"&lingua="+lingua+"&oggetto="+oggetto+"",
                                                                                    dataType: "html",
                                                                                    success: function(data) {
                                                                                        $("#ModaleUpdateTestoOggetto'.$row['id'].'").modal("hide");
                                                                                        $("#add_oggetto_recall").DataTable().ajax.reload();    
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
                                            <a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#modifica'.$row['id'].'").on("click",function(){
                                                            $("#ModaleUpdateTestoOggetto'.$row['id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                               
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_testo_oggetto'.$row['id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_testo_oggetto'.$row['id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo Record?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/autoresponder/delete_testo_oggetto_recall.php",
                                                                    type: "POST",
                                                                    data: "action=del_t_oggetto&idsito='.$row['idsito'].'&id='.$row['id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#add_oggetto_recall").DataTable().ajax.reload();    
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

                                        "lingua"               =>    '<img src="'.BASE_URL_SITO.'img/flags/'.$row['Lingua'].'.png" class="image_flag">',
                                        "oggetto"              =>    $row['testo'],
                                        "action"               =>    $action.$modale
 
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
