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
					hospitality_template_background.*	
				FROM 
					hospitality_template_background 
				WHERE 
					hospitality_template_background.idsito = ".$_REQUEST['idsito']."
                AND
                    hospitality_template_background.TemplateName = 'smart'";

	$rec = $dbMysqli->query($select);

	foreach($rec as $key => $row){

                           $modale =' <div class="modal fade" id="ModaleUpdateTemplateSmart'.$row['Id'].'" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Template Smart</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <form method="POST" id="form_mod_template_smart'.$row['Id'].'" name="form_mod_template_smart">
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3 text-left">
                                                                            <label>Font</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-font fa-fw"></i></span>
                                                                                <select name="Font" id="Font'.$row['Id'].'" class="form-control" style="height:auto"">   
                                                                                    <option value="\'Lato\', sans-serif" '.($row['Font']=='\'Lato\', sans-serif'?'selected="selected"':'').'>Lato</option>   
                                                                                    <option value="\'Lora\', serif" '.($row['Font']=='\'Lora\', serif'?'selected="selected"':'').'>Lora</option>   
                                                                                    <option value="\'Open Sans\', sans-serif" '.($row['Font']=='\'Open Sans\', sans-serif'?'selected="selected"':'').'>Open Sans</option>   
                                                                                    <option value="\'Playfair Display\', serif" '.($row['Font']=='\'Playfair Display\', serif'?'selected="selected"':'').'>PlayFair Display</option>   
                                                                                    <option value="\'Raleway\', sans-serif" '.($row['Font']=='\'Raleway\', sans-serif'?'selected="selected"':'').'>Raleway</option>   
                                                                                    <option value="\'Roboto\', sans-serif" '.($row['Font']=='\'Roboto\', sans-serif'?'selected="selected"':'').'>Roboto</option>   
                                                                                    <option value="\'Roboto Slab\', serif" '.($row['Font']=='\'Roboto Slab\', serif'?'selected="selected"':'').'>Roboto Slab</option>   
                                                                                    <option value="\'Ubuntu\', sans-serif" '.($row['Font']=='\'Ubuntu\', sans-serif'?'selected="selected"':'').'>Ubuntu</option>   
                                                                                    <option value="\'Montserrat\', sans-serif" '.($row['Font']=='\'Montserrat\', sans-serif'?'selected="selected"':'').'>Montserrat</option>
                                                                                </select>
                                                                            </div>  
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3 text-left">
                                                                            <label>Colore Principale Template</label>
                                                                        </div>
                                                                        <div class="col-md-1 text-left">                                            	                                                     
                                                                            '.$fun->color_selector($row['Id'],$row['idsito'],'').'
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-3 text-left">
                                                                            <label>Colore Pulsanti Template</label>
                                                                        </div>
                                                                        <div class="col-md-7">                                            	                                                     
                                                                            <div class="input-group input-group-primary">
                                                                                <span class="input-group-addon"><i class="fa fa-paint-brush fa-fw"></i></span>
                                                                                <input type="text" class="form-control" id="Pulsante'.$row['Id'].'" name="Pulsante" value="'.$row['Pulsante'].'" style="background-color:'.$row['Pulsante'].';color:#FFFFFF;" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-3 text-left">
                                                                            <label>Top Immagine Template</label>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <span class="text-black f-12 text-center">Una volta scelto il file, non dimenticare di cliccare sul pulsante "Upload"</span>
                                                                            <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-fw fa-photo"></i></span>
                                                                            <input type="file" class="form-control"  name="file_" id="file_'.$row['Id'].'">
                                                                            <button type="button" class="btn btn-mini" id="btn_upload'.$row['Id'].'">Upload</button>
                                                                            </div>
                                                                            <div id="result_file'.$row['Id'].'"></div>
                                                                            <input type="hidden"  id="Immagine'.$row['Id'].'" name="Immagine" />
                                                                        </div>
                                                                    </div>                            
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-3 text-left">
                                                                            <label>Background Immagine Proposte</label>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <span class="text-black f-12 text-center">Una volta scelto il file, non dimenticare di cliccare sul pulsante "Upload"</span>
                                                                            <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-fw fa-photo"></i></span>
                                                                            <input type="file" class="form-control"  name="file2_" id="file2_'.$row['Id'].'">
                                                                            <button type="button" class="btn btn-mini" id="btn_upload2'.$row['Id'].'">Upload</button>
                                                                            </div>
                                                                            <div id="result_file2'.$row['Id'].'"></div>
                                                                            <input type="hidden"  id="Immagine2'.$row['Id'].'" name="Immagine2" />
                                                                        </div>
                                                                    </div>                            
                                                                </div>                                                                                                                                                                                                   
                                                                <div class="form-group">  
                                                                    <div class="row">
                                                                        <div class="col-md-12 text-center">
                                                                            <input type="hidden" name="Id" id="Id'.$row['Id'].'" value="'.$row['Id'].'">
                                                                            <input type="hidden" name="BackgroundScelto" id="BackgroundScelto'.$row['Id'].'">
                                                                            <input type="hidden" name="action" value="mod_template_smart">
                                                                            <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                                            <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                                                        </div>
                                                                    </div>
                                                                </div>                                 
                                                            </form>  
                                                            <script>
                                                                $(document).ready(function(){ 

                                                                    $("#Background'.$row['Id'].'").on("change",function(){
                                                                        var Background = $("#Background'.$row['Id'].' option:selected").val();
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/templates/carica_colori_smart.php",
                                                                            type: "POST",
                                                                            data: "action=get_color&idsito='.$row['idsito'].'&Background="+Background+"",
                                                                            dataType: "html",
                                                                            success: function(msg) {
                                                                                $("#Pulsante'.$row['Id'].'").val(msg); 
                                                                                $("#Pulsante'.$row['Id'].'").css("background-color",msg);
                                                                                $("#Pulsante'.$row['Id'].'").css("color","#FFFFFF");
                                                                                $("#BackgroundScelto'.$row['Id'].'").val(Background);
                                                                            }
                                                                        });
                                                                        return false;
                                                                    });

                                                                    //CARICO IMMAGINE										
                                                                    $("#btn_upload'.$row['Id'].'").on("click",function(){
                                                                        formdata = new FormData();
                                                                        if($("#file_'.$row['Id'].'").prop(\'files\').length > 0)
                                                                        {
                                                                            file =$("#file_'.$row['Id'].'").prop(\'files\')[0];
                                                                            formdata.append("file_", file);
                                                                        }
                                                                        $.ajax({
                                                                            url: "' . BASE_URL_SITO . 'ajax/templates/upload_immagine_smart.php?idsito='.$row['idsito'].'",
                                                                            type: "POST",
                                                                            data: formdata,
                                                                            processData: false,
                                                                            contentType: false,
                                                                            success: function (result) {
                                                                                console.log(result);
                                                                                if(result != ""){
                                                                                    $("#Immagine'.$row['Id'].'").val(result);
                                                                                    $("#result_file'.$row['Id'].'").html("<small class=\"text-green\">Il file è stato caricato con successo!</small>");
                                                                                }else{
                                                                                    $("#result_file'.$row['Id'].'").html("<small class=\"text-red\">Prima di cliccare sul pulsante \"Upload\", scegli il file da caricare sul server!</small>");
                                                                                }
                                                                            }
                                                                        });
                                                                        return false;
                                                                    });

                                                                    //CARICO IMMAGINE 2										
                                                                    $("#btn_upload2'.$row['Id'].'").on("click",function(){
                                                                        formdata = new FormData();
                                                                        if($("#file2_'.$row['Id'].'").prop(\'files\').length > 0)
                                                                        {
                                                                            file =$("#file2_'.$row['Id'].'").prop(\'files\')[0];
                                                                            formdata.append("file2_", file);
                                                                        }
                                                                        $.ajax({
                                                                            url: "' . BASE_URL_SITO . 'ajax/templates/upload_immagine2_smart.php?idsito='.$row['idsito'].'",
                                                                            type: "POST",
                                                                            data: formdata,
                                                                            processData: false,
                                                                            contentType: false,
                                                                            success: function (result2) {
                                                                                console.log(result2);
                                                                                if(result2 != ""){
                                                                                    $("#Immagine2'.$row['Id'].'").val(result2);
                                                                                    $("#result_file2'.$row['Id'].'").html("<small class=\"text-green\">Il file è stato caricato con successo!</small>");
                                                                                }else{
                                                                                    $("#result_file2'.$row['Id'].'").html("<small class=\"text-red\">Prima di cliccare sul pulsante \"Upload\", scegli il file da caricare sul server!</small>");
                                                                                }
                                                                            }
                                                                        });
                                                                        return false;
                                                                    });

                                                                    $("#form_mod_template_smart'.$row['Id'].'").submit(function(){  
                                                                        var Font       = $("#Font'.$row['Id'].' option:selected").val();
                                                                        var Backgr     = $("#BackgroundScelto'.$row['Id'].'").val();
                                                                        var Pulsante   = $("#Pulsante'.$row['Id'].'").val();
                                                                        var Id         = $("#Id'.$row['Id'].'").val();
                                                                        var Immagine   = $("#Immagine'.$row['Id'].'").val();
                                                                        var Immagine2  = $("#Immagine2'.$row['Id'].'").val();
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/templates/save_template_smart.php",
                                                                            type: "POST",
                                                                            data: "action=save_template_smart&idsito='.$row['idsito'].'&Id="+Id+"&Font="+Font+"&Background="+Backgr+"&Pulsante="+Pulsante+"&Immagine="+Immagine+"&Immagine2="+Immagine2+"",
                                                                            dataType: "html",
                                                                            success: function(result) {
                                                                                $("#ModaleUpdateTemplateSmart'.$row['Id'].'").modal("hide");
                                                                                $("#template_smart").DataTable().ajax.reload();    
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

                                           
                        $action = ' <div class="btn-group dropdown-split-default"  id="azioniPrev">
                                        <a type="button"  class="cursore dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h fa-2x fa-fw"></i>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['Id'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                            <script>
                                                $(document).ready(function(){ 
                                                    $("#modifica'.$row['Id'].'").on("click",function(){
                                                        $("#ModaleUpdateTemplateSmart'.$row['Id'].'").modal("show"); 
                                                    });
                                                });
                                            </script>
                                            '.($row['Visibile']==0?
                                            '<a class="dropdown-item waves-effect waves-light" href="#" id="abilita'.$row['Id'].'"><i class="fa fa-eye text-green"></i> Visibile <span class="f-10">(in crea proposta)</span></a>'
                                            :
                                            '<a class="dropdown-item waves-effect waves-light" href="#" id="disabilita'.$row['Id'].'"><i class="fa fa-eye-slash text-gray"></i> Non Visibile  <span class="f-10">(in crea proposta)</span></a>'
                                            ).'
                                            <script>
                                                $(document).ready(function(){ 
                                                    $("#abilita'.$row['Id'].'").on("click",function(){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/templates/switch_template.php",
                                                            type: "POST",
                                                            data: "action=switch_t&idsito='.$row['idsito'].'&id='.$row['Id'].'&Visibile=1",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#template_smart").DataTable().ajax.reload();    
                                                            }
                                                        });
                                                        return false;
                                                    });
                                                    $("#disabilita'.$row['Id'].'").on("click",function(){
                                                        $.ajax({
                                                            url: "'.BASE_URL_SITO.'ajax/templates/switch_template.php",
                                                            type: "POST",
                                                            data: "action=switch_t&idsito='.$row['idsito'].'&id='.$row['Id'].'&Visibile=0",
                                                            dataType: "html",
                                                            success: function(data) {
                                                                $("#template_smart").DataTable().ajax.reload();    
                                                            }
                                                        });
                                                        return false;                                                           
                                                    });
                                                });
                                            </script>  
                                        </div>
                                    </div>';  
                        $selectOrdine = '  <select class="form-control ordina" id="OrdineRow'.$row['Id'].'" name="OrdineRow" style="height:auto;padding:2px!important;width:80%!important">
                                                <option value="0" '.($row['Ordine']==''?'selected="selected"':'').'></option>                       
                                                <option value="1" '.($row['Ordine']==1?'selected="selected"':'').'>1</option>
                                                <option value="2" '.($row['Ordine']==2?'selected="selected"':'').'>2</option>
                                                <option value="3" '.($row['Ordine']==3?'selected="selected"':'').'>3</option>
                                                <option value="4" '.($row['Ordine']==4?'selected="selected"':'').'>4</option>
                                                <option value="5" '.($row['Ordine']==5?'selected="selected"':'').'>5</option>
                                                <option value="6" '.($row['Ordine']==6?'selected="selected"':'').'>6</option>
                                                <option value="7" '.($row['Ordine']==7?'selected="selected"':'').'>7</option>
                                                <option value="8" '.($row['Ordine']==8?'selected="selected"':'').'>8</option>
                                                <option value="9" '.($row['Ordine']==9?'selected="selected"':'').'>9</option>
                                                <option value="10" '.($row['Ordine']==10?'selected="selected"':'').'>10</option>
                                            </select>
                                            <script>
                                                $(document).ready(function(){ 
                                                    $("#OrdineRow'.$row['Id'].'").on("change",function(){
                                                        var OrdineRow = $("#OrdineRow'.$row['Id'].' option:selected").val(); 
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/templates/ordine_template.php",
                                                                type: "POST",
                                                                data: "action=order_template&idsito='.$row['idsito'].'&Id='.$row['Id'].'&OrdineRow="+OrdineRow+"",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#template_custom").DataTable().ajax.reload();    
                                                                }
                                                            });
                                                            return false;                                
                                                    });
                                                });
                                            </script>';


							$data[] = array(
                                        "ico"        => '<img class="p-r-5" src="'.BASE_URL_SITO.'img/'.$row['Thumb'].'" style="width:40px" data-toggle="tooltip" title="Template '.$row['TemplateName'].'">',
                                        "nome"       => $row['TemplateName'],
                                        "font"       => $row['Font'],
                                        "colore"     => '<label class="badge f-11" style="background:'.$row['Background'].'">'.$row['Background'].'</label>',
                                        "pulsante"   => '<label class="badge f-11" style="background:'.$row['Pulsante'].'">'.$row['Pulsante'].'</label>',
                                        "top"        => ($row['Immagine']!=''?'<a href="'.BASE_URL_SITO.'uploads/'.$row['idsito'].'/'.$row['Immagine'].'" data-lightbox="roadtrip"><img src="'.BASE_URL_SITO.'class/resize.class.php?src='.BASE_PATH_SITO.'uploads/'.$row['idsito'].'/'.$row['Immagine'].'&w=140&a=c&q=100"></a>':''),
                                        "background" => ($row['Immagine2']!=''?'<a href="'.BASE_URL_SITO.'uploads/'.$row['idsito'].'/'.$row['Immagine2'].'" data-lightbox="roadtrip"><img src="'.BASE_URL_SITO.'class/resize.class.php?src='.BASE_PATH_SITO.'uploads/'.$row['idsito'].'/'.$row['Immagine2'].'&w=140&a=c&q=100"></a>':''),
                                        "ordine"     => '<span class="ordinamento">'.$row['Ordine'].'</span>'.$selectOrdine,
                                        "visibile"   => ($row['Visibile']==0?'<i class="fa fa-eye-slash text-gray"></i>':'<i class="fa fa-eye text-green"></i>'),
                                        "action"     => $action.$modale,
          
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
