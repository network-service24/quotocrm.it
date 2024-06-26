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
                        hospitality_dizionario.*,
                        hospitality_dizionario_lingua.testo
                    FROM 
                        hospitality_dizionario 
                    INNER JOIN                 
                        hospitality_dizionario_lingua 
                    ON 
                        hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id 
                    WHERE 
                        hospitality_dizionario.idsito = ".$_REQUEST['idsito']." 
                    AND 
                        hospitality_dizionario_lingua.idsito = ".$_REQUEST['idsito']."
                    AND 
                        hospitality_dizionario_lingua.Lingua = 'it'";

	$rec = $dbMysqli->query($select);


	$numero = 1;
	foreach($rec as $key => $row){

                            $modale =' <div class="modal fade" id="ModaleUpdateDizionario'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Descrizione</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                
                                                            <form method="POST" id="form_mod_dizionario'.$row['id'].'" name="form_mod_dizionario">
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label>Descrizione</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-comment fa-fw"></i></span>
                                                                                <textarea class="form-control" rows="3" id="descrizione'.$row['id'].'" name="descrizione">'.$row['descrizione'].'</textarea>
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
                    
                                                            <script>
                                                                $(document).ready(function() {

                                                                    $("#form_mod_dizionario'.$row['id'].'").submit(function () {   
                                                                        var  descrizione  = $("#descrizione'.$row['id'].'").val(); 
                                                                        var  id           = $("#id'.$row['id'].'").val(); 
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/generici/modifica_descrizione_dizionario.php",
                                                                            type: "POST",
                                                                            data: "action=mod_dizionario&id="+id+"&idsito='.$row['idsito'].'&descrizione="+descrizione+"",
                                                                            dataType: "html",
                                                                            success: function(data) {
                                                                                $("#ModaleUpdateDizionario'.$row['id'].'").modal("hide");
                                                                                $("#Dizionario").DataTable().ajax.reload();    
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
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['id'].'"><i class="fa fa-edit text-orange"></i> Modifica descrizione [posizione] </a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#modifica'.$row['id'].'").on("click",function(){
                                                            $("#ModaleUpdateDizionario'.$row['id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>                                                             
                                                <div class="dropdown-divider"></div>                                                         
                                                <a class="dropdown-item waves-effect waves-light" href="'.BASE_URL_SITO.'setting-add_mod_dizionario/'.$row['id'].'/'.$row['etichetta'].'/"><i class="fa fa-comment-o text-green"></i> Gestione testi dizionario </a>                                         
                                            </div>
										</div>';                                               

							$data[] = array(
                                        "id"          => $numero,
                                        "etichetta"   => strip_tags($row['testo']),
                                        "descrizione" => $row['descrizione'],
                                        "variabile"   => $row['etichetta'],
                                        "testi"       => $fun->ControlloTestiInseritiDizionario($row['id'],$row['idsito']),
                                        "action"      => $action.$modale
 
							);
        $numero++;
	}

 	$json_data = array(
						"draw"            => 1,
						"recordsTotal"    => sizeof($rec),
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
