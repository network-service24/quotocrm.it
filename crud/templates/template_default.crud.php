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


    	$select  = "SELECT 
					hospitality_template_landing.*	
				FROM 
					hospitality_template_landing 
				WHERE 
					hospitality_template_landing.idsito = ".$_REQUEST['idsito']."";

	$rec = $dbMysqli->query($select);

	foreach($rec as $key => $row){

                           $modale =' <div class="modal fade" id="ModaleUpdateTemplateDefault'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Template Default</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <form method="POST" id="form_mod_template_default'.$row['Id'].'" name="form_mod_template_default">
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3 text-left">
                                                                            <label>Template</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-laptop fa-fw"></i></span>
                                                                                <select class="form-control" id="Template'.$row['Id'].'" name="Template" style="height:auto">
                                                                                    <option value="default" '.($row['Template']=='default'?'selected="selected"':'').'>default</option>
                                                                                    <option value="smart" '.($row['Template']=='smart'?'selected="selected"':'').'>smart</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3 text-left">
                                                                            <label>Colore Indetificativo Template</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-paint-brush fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="BackgroundCellLink'.$row['Id'].'" name="BackgroundCellLink" value="'.$row['BackgroundCellLink'].'" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-12 text-center">
                                                                            <input type="hidden" name="Id" id="Id'.$row['Id'].'" value="'.$row['Id'].'">
                                                                            <input type="hidden" name="TemplateScelto" id="TemplateScelto'.$row['Id'].'">
                                                                            <input type="hidden" name="action" value="mod_template_default">
                                                                            <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                                            <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                                                        </div>
                                                                    </div>
                                                                </div>                                 
                                                            </form>  
                                                            <script>
                                                                $(document).ready(function(){ 

                                                                    $("#Template'.$row['Id'].'").on("change",function(){
                                                                        var Template = $("#Template'.$row['Id'].' option:selected").val();
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/templates/carica_colori_default.php",
                                                                            type: "POST",
                                                                            data: "action=get_color&idsito='.$row['idsito'].'&Template="+Template+"",
                                                                            dataType: "html",
                                                                            success: function(msg) {
                                                                                $("#BackgroundCellLink'.$row['Id'].'").val(msg); 
                                                                                $("#TemplateScelto'.$row['Id'].'").val(Template);
                                                                            }
                                                                        });
                                                                        return false;
                                                                    });

                                                                    $("#form_mod_template_default'.$row['Id'].'").submit(function(){  
                                                                        var Temp                = $("#TemplateScelto'.$row['Id'].'").val();
                                                                        var BackgroundCellLink  = $("#BackgroundCellLink'.$row['Id'].'").val();
                                                                        var Id                  = $("#Id'.$row['Id'].'").val();
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/templates/save_template_default.php",
                                                                            type: "POST",
                                                                            data: "action=save_template_default&idsito='.$row['idsito'].'&Id="+Id+"&Template="+Temp+"&BackgroundCellLink="+BackgroundCellLink+"",
                                                                            dataType: "html",
                                                                            success: function(result) {
                                                                                $("#ModaleUpdateTemplateDefault'.$row['Id'].'").modal("hide");
                                                                                $("#template_default").DataTable().ajax.reload();    
                                                                            }
                                                                        });
                                                                        return false;                                     
                                                                    });

                                                                });
                                                            </script>                  
                                                    </div>
                                                </div>
                                            </div>           
                                        </div>'."\r\n";

 							$action = ' <a href="#" id="modifica'.$row['Id'].'"><i class="fa fa-edit fa-2x fa-fw text-orange"></i></a>
                                        <script>
                                            $(document).ready(function(){ 
                                                $("#modifica'.$row['Id'].'").on("click",function(){
                                                    $("#ModaleUpdateTemplateDefault'.$row['Id'].'").modal("show"); 
                                                });
                                            });
                                        </script>';                                              

							$data[] = array(

                                        "preview"   => $fun->check_screenshot($row['Template']),
                                        "sito"      => $row['Directory'],
                                        "template"  => $row['Template'],
                                        "colore"    => '<label class="badge f-11" style="background:'.$row['BackgroundCellLink'].'">'.$row['BackgroundCellLink'].'</label>',
                                        "action"    => $action.$modale,
          
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
