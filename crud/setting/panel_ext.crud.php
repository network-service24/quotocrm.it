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
					hospitality_pannelli_esterni.*		
				FROM 
                    hospitality_pannelli_esterni  
				WHERE 
                    hospitality_pannelli_esterni.idsito = ".$_REQUEST['idsito']." ";

	$rec = $dbMysqli->query($select);


	
	foreach($rec as $key => $row){


                        $modalUpdate = '<div class="modal fade" id="ModaleUpdatePanelExt'.$row['idpannello'].'" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifica Pannello Esterno</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-9">
                                                                    <form method="POST" id="form_up_panel_ext'.$row['idpannello'].'" name="form_up_panel_ext">
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <label>Icona font Awesome</label>
                                                                            </div>
                                                                            <div class="col-md-7">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                    <input type="text" class="form-control" id="font_awesome'.$row['idpannello'].'" name="font_awesome" value="'.$row['font_awesome'].'" placeholder="fa fa-quora" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <label>Logo</label>
                                                                            </div>
                                                                            <div class="col-md-7">
                                                                                <small class="text-info">Una volta scelto il file, non dimenticare di cliccare sul pulsante "Upload"</small>
                                                                                <div class="input-group">
                                                                                <span class="input-group-addon"><i class="fa fa-fw fa-tasks"></i></span>
                                                                                <input type="file" class="form-control"  name="ico_image_tmp" id="ico_image_tmp">
                                                                                <button type="button" class="btn btn-mini" id="btn_upload'.$row['idpannello'].'">Upload</button>
                                                                                </div>
                                                                                <div id="result_file"></div>
                                                                                <input type="hidden"  id="ico_image" name="ico_image" />
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                    
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <label>Nome Pannello</label>
                                                                            </div>
                                                                            <div class="col-md-7">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                    <input type="text" class="form-control" id="nome_pannello'.$row['idpannello'].'" name="nome_pannello" value="'.$row['nome_pannello'].'" required/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <label>Url</label>
                                                                            </div>
                                                                            <div class="col-md-7">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                    <input type="text" class="form-control" id="url'.$row['idpannello'].'" name="url" value="'.$row['url'].'" placeholder="https://nomedeldominio.xx/login" required/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <label>
                                                                                Nome del primo campo
                                                                                </label>                                               
                                                                            </div>
                                                                            <div class="col-md-7">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                    <input type="text" class="form-control" id="campo_1'.$row['idpannello'].'" name="campo_1" value="'.$row['campo_1'].'" placeholder="username" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <label>Valore del primo campo</label>
                                                                            </div>
                                                                            <div class="col-md-7">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                    <input type="text" class="form-control" id="valore_1'.$row['idpannello'].'" name="valore_1" value="'.$row['valore_1'].'" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <label>
                                                                                Nome del secondo campo
                                                                                </label>                                               
                                                                            </div>
                                                                            <div class="col-md-7">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                    <input type="text" class="form-control" id="campo_2'.$row['idpannello'].'" name="campo_2" value="'.$row['campo_2'].'" placeholder="password" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <label>Valore del secondo campo</label>
                                                                            </div>
                                                                            <div class="col-md-7">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                    <input type="text" class="form-control" id="valore_2'.$row['idpannello'].'" name="valore_2" value="'.$row['valore_2'].'" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <label>
                                                                                Nome del terzo campo
                                                                                </label>                                               
                                                                            </div>
                                                                            <div class="col-md-7">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                    <input type="text" class="form-control" id="campo_3'.$row['idpannello'].'" name="campo_3" value="'.$row['campo_3'].'" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <label>Valore del terzo campo</label>
                                                                            </div>
                                                                            <div class="col-md-7">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                    <input type="text" class="form-control" id="valore_3'.$row['idpannello'].'" name="valore_3" value="'.$row['valore_3'].'" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                     
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <label>Method</label>
                                                                            </div>
                                                                            <div class="col-md-7">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                    <select class="form-control" id="method'.$row['idpannello'].'" name="method" style="height:auto">
                                                                                            <option value="post" '.($row['method']=='post'?'selected="selected"':'').'>post</option>
                                                                                            <option value="get" '.($row['method']=='get'?'selected="selected"':'').'>get</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">  
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <label>Target</label>
                                                                            </div>
                                                                            <div class="col-md-7">                                            	                                                     
                                                                                <div class="input-group input-group-primary">
                                                                                    <span class="input-group-addon"><i class="fa fa-code fa-fw"></i></span>
                                                                                    <select class="form-control" id="target'.$row['idpannello'].'" name="target" style="height:auto">
                                                                                            <option value="iframe" '.($row['target']=='iframe'?'selected="selected"':'').'>iframe</option>
                                                                                            <option value="_blank" '.($row['target']=='_blank'?'selected="selected"':'').'>_blank</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                        <div class="form-group">  
                                                                            <div class="row">
                                                                                <div class="col-md-12 text-center">
                                                                                <input type="hidden" name="id" id="id'.$row['idpannello'].'" value="'.$row['idpannello'].'">
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

                                                                    //CARICO IL LOGO										
                                                                    $("#btn_upload'.$row['idpannello'].'").on("click",function(){
                                                                        formdata = new FormData();
                                                                        if($("#ico_image_tmp").prop(\'files\').length > 0)
                                                                        {
                                                                            file =$("#ico_image_tmp").prop(\'files\')[0];
                                                                            formdata.append("ico_image_tmp", file);
                                                                        }
                                                                        $.ajax({
                                                                            url: "' . BASE_URL_SITO . 'ajax/generici/upload_img_panel_ext.php?idsito='.$row['idsito'].'",
                                                                            type: "POST",
                                                                            data: formdata,
                                                                            processData: false,
                                                                            contentType: false,
                                                                            success: function (result) {
                                                                                console.log(result);
                                                                                if(result != ""){
                                                                            
                                                                                    $("#ico_image").val(result);
                                                                                    $("#result_file").html("<small class=\"text-green\">Il file è stato caricato con successo!</small>");
                                                                                }else{
                                                                                    $("#result_file").html("<small class=\"text-red\">Prima di cliccare sul pulsante \"Upload\", scegli il file da caricare sul server!</small>");
                                                                                }
                                                                            }
                                                                        });
                                                                        return false;
                                                                    });                                                                    

                                                                    $("#form_up_panel_ext'.$row['idpannello'].'").submit(function () {   
                                                                        var  font_awesome  = $("#font_awesome'.$row['idpannello'].'").val(); 
                                                                        var  ico_image     = $("#ico_image").val(); 
                                                                        var  nome_pannello = $("#nome_pannello'.$row['idpannello'].'").val(); 
                                                                        var  url           = $("#url'.$row['idpannello'].'").val(); 
                                                                        var  campo_1       = $("#campo_1'.$row['idpannello'].'").val();
                                                                        var  valore_1      = $("#valore_1'.$row['idpannello'].'").val();
                                                                        var  campo_2       = $("#campo_2'.$row['idpannello'].'").val();
                                                                        var  valore_2      = $("#valore_2'.$row['idpannello'].'").val();
                                                                        var  campo_3       = $("#campo_3'.$row['idpannello'].'").val();
                                                                        var  valore_3      = $("#valore_3'.$row['idpannello'].'").val(); 
                                                                        var  method        = $("#method'.$row['idpannello'].' option:selected").val();
                                                                        var  target        = $("#target'.$row['idpannello'].' option:selected").val();   
                                                                        var  id            = $("#id'.$row['idpannello'].'").val();         
                                                                        $.ajax({
                                                                            url: "'.BASE_URL_SITO.'ajax/generici/modifica_panel_ext.php",
                                                                            type: "POST",
                                                                            data: "action=mod_panel_ext&id="+id+"&idsito='.$row['idsito'].'&font_awesome="+font_awesome+"&ico_image="+ico_image+"&nome_pannello="+nome_pannello+"&url="+url+"&campo_1="+campo_1+"&valore_1="+valore_1+"&campo_2="+campo_2+"&valore_2="+valore_2+"&campo_3="+campo_3+"&valore_3="+valore_3+"&method="+method+"&target="+target+"",
                                                                            dataType: "html",
                                                                            success: function(data) {
                                                                                $("#ModaleUpdatePanelExt'.$row['idpannello'].'").modal("hide");
                                                                                $("#PanelExt").DataTable().ajax.reload();    
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
                                            <a class="dropdown-item waves-effect waves-light" href="#" id="modifica'.$row['idpannello'].'"><i class="fa fa-edit text-orange"></i> Modifica </a>
                                            <script>
                                                $(document).ready(function(){ 
                                                    $("#modifica'.$row['idpannello'].'").on("click",function(){
                                                        $("#ModaleUpdatePanelExt'.$row['idpannello'].'").modal("show"); 
                                                    });
                                                });
                                            </script> 
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item waves-effect waves-light" href="#" id="delete_pa'.$row['idpannello'].'"><i class="fa fa-times text-red"></i> Elimina</a>
                                            <script>
                                                $(document).ready(function(){ 
                                                    $("#delete_pa'.$row['idpannello'].'").on("click",function(){
                                                        if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo Record?")){
                                                            $.ajax({
                                                                url: "'.BASE_URL_SITO.'ajax/generici/delete_panel_ext.php",
                                                                type: "POST",
                                                                data: "action=del_panel_ext&idsito='.$row['idsito'].'&id='.$row['idpannello'].'",
                                                                dataType: "html",
                                                                success: function(data) {
                                                                    $("#PanelExt").DataTable().ajax.reload();    
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
                  
                                        "icona"  => ($row['font_awesome']!=''?'<i class="'.$row['font_awesome'].'"></i>':($row['ico_image']!=''?'<img src="'.BASE_URL_SITO.'class/resize.class.php?src='.BASE_PATH_SITO.'uploads/'.$row['idsito'].'/'.$row['ico_image'].'&w=32&a=c&q=100">':'')),
                                        "nome"   => $row['nome_pannello'],
                                        "url"    => $row['url'],
                                        "method" => $row['method'],
                                        "target" => $row['target'],
                                        "action" => $action.$modalUpdate
 
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
