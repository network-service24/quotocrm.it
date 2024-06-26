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
					*		
				FROM 
					hospitality_codice_sconto  
				WHERE 
					hospitality_codice_sconto.idsito = ".$_REQUEST['idsito']." 
                AND
                    hospitality_codice_sconto.data_fine IS NOT NULL";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){

    $data_inizio_tmp = explode(" ",$row['data_inizio']);
    $data_inizio_h   = explode(":",$data_inizio_tmp[1]);
    $ore_inizio      = $data_inizio_h[0].':'.$data_inizio_h[1];
    $data_inizio_d   = explode("-",$data_inizio_tmp[0]);
    $data_inizio     = $data_inizio_d[0].'-'.$data_inizio_d[1].'-'.$data_inizio_d[2].'T'.$ore_inizio;

    $data_fine_tmp = explode(" ",$row['data_fine']);
    $data_fine_h   = explode(":",$data_fine_tmp[1]);
    $ore_fine      = $data_fine_h[0].':'.$data_fine_h[1];
    $data_fine_d   = explode("-",$data_fine_tmp[0]);
    $data_fine     = $data_fine_d[0].'-'.$data_fine_d[1].'-'.$data_fine_d[2].'T'.$ore_fine;    


                        $modalUpdate = '<div class="modal fade" id="ModaleUpdateSconti'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Codice Sconto</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">

                                                                <form method="POST" id="form_up_sconti'.$row['id'].'" name="form_up_sconti">
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-2">
                                                                                <label>Data Inizio</label>
                                                                            </div>
                                                                            <div class="col-md-8">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                                                    <input type="datetime-local" class="form-control" id="data_inizio'.$row['id'].'" name="data_inizio" value="'.$data_inizio.'" required/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-2">
                                                                                <label>Data Scadenza</label>
                                                                            </div>
                                                                            <div class="col-md-8">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                                                    <input type="datetime-local" class="form-control" id="data_fine'.$row['id'].'" name="data_fine" value="'.$data_fine.'" required/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-2">
                                                                                <label>Codice Sconto</label>
                                                                            </div>
                                                                            <div class="col-md-8">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                    <input type="text" class="form-control" id="cod'.$row['id'].'" name="cod" value="'.$row['cod'].'" required/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-2">
                                                                                <label>
                                                                                    Percentuale di Sconto
                                                                                    <div class="clearfix f-11 text-center">(Inserire numeri interi!)</div>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-8">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-percent fa-fw"></i></span>
                                                                                    <input type="text" class="form-control" id="imp_sconto'.$row['id'].'" name="imp_sconto" value="'.$row['imp_sconto'].'" required/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-2">
                                                                                <label>Descrizione dello Sconto</label>
                                                                            </div>
                                                                            <div class="col-md-8">                                          	                                                     
                                                                                <textarea name="note" id="note'.$row['id'].'" rows="5" style="width:100%">'.$row['note'].'</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-12 text-center">
                                                                            <input type="hidden" name="id" id="id'.$row['id'].'" value="'.$row['id'].'">
                                                                                <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                                                <button type="submit" class="btn btn-primary col-md-5">MODIFICA</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                 
                                                                </form>                   
                                                            <script>
                                                                $(document).ready(function() {

                                                                    $("#form_up_sconti'.$row['id'].'").submit(function () {   
                                                                        var  data_inizio  = $("#data_inizio'.$row['id'].'").val(); 
                                                                        var  data_fine    = $("#data_fine'.$row['id'].'").val(); 
                                                                        var  cod          = $("#cod'.$row['id'].'").val(); 
                                                                        var  imp_sconto   = $("#imp_sconto'.$row['id'].'").val(); 
                                                                        var  note         = $("#note'.$row['id'].'").val(); 
                                                                        var  id           = $("#id'.$row['id'].'").val();           
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/generici/modifica_sconti.php",
                                                                            type: "POST",
                                                                            data: "action=mod_sc&id="+id+"&idsito='.$row['idsito'].'&data_inizio="+data_inizio+"&data_fine="+data_fine+"&cod="+cod+"&imp_sconto="+imp_sconto+"&note="+note+"",
                                                                            dataType: "html",
                                                                            success: function(data) {
                                                                                $("#ModaleUpdateSconti'.$row['id'].'").modal("hide");
                                                                                $("#sconti").DataTable().ajax.reload();    
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
                                                            $("#ModaleUpdateSconti'.$row['id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>
												<div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_sc'.$row['id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_sc'.$row['id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo Codice Sconto?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/generici/delete_sconti.php",
                                                                    type: "POST",
                                                                    data: "action=del_sc&idsito='.$row['idsito'].'&id='.$row['id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#sconti").DataTable().ajax.reload();    
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

                  
                                        "data_inizio"                       =>    $fun->gira_data($row['data_inizio']),
                                        "data_fine"                         =>    $fun->gira_data($row['data_fine']),
                                        "codice_sconto"                     =>    $row['cod'],
                                        "percentuale_sconto"                =>    $row['imp_sconto'],
                                        "note"                              =>    $row['note'],
                                        "action"                            =>    $action.$modalUpdate
 
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
