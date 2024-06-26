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
					hospitality_fonti_prenotazione  
				WHERE 
					hospitality_fonti_prenotazione.idsito = ".$_REQUEST['idsito']." ";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){


                        $modalUpdate = '<div class="modal fade" id="ModaleUpdateFonti'.$row['Id'].'" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Operatore</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-9">
                                                                    <form method="POST" id="form_up_ft'.$row['Id'].'" name="form_up_ft">

                                                                        <div class="form-group">  
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <label>Fonte Prenotazione</label>
                                                                                </div>
                                                                                <div class="col-md-7">                                            	                                                     
                                                                                    <div class="input-group input-group-primary">
                                                                                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                                                                        <input type="text" class="form-control" id="FontePrenotazione'.$row['Id'].'" name="FontePrenotazione" value="'.$row['FontePrenotazione'].'" required/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="form-group">  
                                                                            <div class="row">
                                                                                <div class="col-md-12 text-center">
                                                                                <input type="hidden" name="id" id="id'.$row['Id'].'" value="'.$row['Id'].'">
                                                                                    <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                                                    <button type="submit" class="btn btn-primary col-md-5">MODIFICA</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>                                 
                                                                    </form>
                                                                </div>
                                                                <div class="col-md-2"></div>
                                                            </div>                     
                                                            <script>
                                                                $(document).ready(function() {

                                                                    $("#form_up_ft'.$row['Id'].'").submit(function () {   
                                                                        var  Fonte  = $("#FontePrenotazione'.$row['Id'].'").val(); 
                                                                        var  id     = $("#id'.$row['Id'].'").val();         
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/generici/modifica_fonte.php",
                                                                            type: "POST",
                                                                            data: "action=mod_ft&id="+id+"&idsito='.$row['idsito'].'&Fonte="+Fonte+"",
                                                                            dataType: "html",
                                                                            success: function(data) {
                                                                                $("#ModaleUpdateFonti'.$row['Id'].'").modal("hide");
                                                                                $("#fonti").DataTable().ajax.reload();    
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
                                            '.($row['NS']!=1?
												'<a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['Id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#modifica'.$row['Id'].'").on("click",function(){
                                                            $("#ModaleUpdateFonti'.$row['Id'].'").modal("show"); 
                                                        });
                                                    });
                                                </script>
												<div class="dropdown-divider"></div>'
                                                :'').'
                                                '.($row['Abilitato']==0?
                                                '<a class="dropdown-item waves-effect waves-light" href="#" id="abilita'.$row['Id'].'"><i class="fa fa-eye text-green"></i> Abilita</a>'
                                                :
												'<a class="dropdown-item waves-effect waves-light" href="#" id="disabilita'.$row['Id'].'"><i class="fa fa-eye-slash text-gray"></i> Disabilita</a>'
                                                ).'
											    <script>
                                                    $(document).ready(function(){ 
                                                        $("#abilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_fonte.php",
                                                                type: "POST",
                                                                data: "action=switch_ft&idsito='.$row['idsito'].'&id='.$row['Id'].'&Abilitato=1",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#fonti").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;
                                                        });
                                                        $("#disabilita'.$row['Id'].'").on("click",function(){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/generici/switch_fonte.php",
                                                                type: "POST",
                                                                data: "action=switch_ft&idsito='.$row['idsito'].'&id='.$row['Id'].'&Abilitato=0",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#fonti").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;                                                           
                                                        });
                                                    });
                                                </script> 
                                                '.($row['NS']!=1?
                                                '<div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-effect waves-light" href="#" id="delete_ft'.$row['Id'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                                <script>
                                                    $(document).ready(function(){ 
                                                        $("#delete_ft'.$row['Id'].'").on("click",function(){
                                                            if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo Fonte di prenotazione?")){
                                                                $.ajax({
                                                                    url: "'.BASE_URL_SITO.'ajax/generici/delete_fonte.php",
                                                                    type: "POST",
                                                                    data: "action=del_ft&idsito='.$row['idsito'].'&id='.$row['Id'].'",
                                                                    dataType: "html",
                                                                    success: function(data) {
                                                                        $("#fonti").DataTable().ajax.reload();    
                                                                    }
                                                                });
                                                                return false;
                                                            }
                                                        });
                                                    });
                                                </script>'
                                                :'').'
                                            </div>
										</div>';


							$data[] = array(

                  
                                        "fonte"                 =>    ($row['FontePrenotazione']=='La fonte che avete inserito era già presente, elimina questo record!'?'<span class="text-red">La fonte che avete inserito era già presente, elimina questo record!</span>':$row['FontePrenotazione']),
                                        "abilitato"             =>    ($row['Abilitato']==1?'<i class="fa fa-check text-green"></i>':'<i class="fa fa-times text-red"></i>'),
                                        "action"                =>    ($row['FontePrenotazione']=='Sito Web'?'<label class="badge badge-default bg-danger f-11">Voce obbligata da Network Service</label>':$action.$modalUpdate)
 
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
